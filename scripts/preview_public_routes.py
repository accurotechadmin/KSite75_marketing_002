#!/usr/bin/env python3
"""Capture the declared public preview matrix with a pinned Playwright adapter."""
from __future__ import annotations

import argparse
import hashlib
import importlib.metadata
import json
import socket
import subprocess
import sys
import time
from datetime import datetime, timezone
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
PINNED_PLAYWRIGHT = "1.54.0"


def validate(inv: dict, matrix: dict, root: Path) -> list[str]:
    errors = []
    public = {r["id"] for r in inv["routes"] if r["surface"] == "public"}
    routes, modes = matrix.get("routes", []), matrix.get("modes", {})
    required = matrix.get("required_route_modes", [])
    if len(routes) != len(set(routes)):
        errors.append("duplicate preview route")
    if set(routes) != public:
        errors.append("preview routes must exactly cover public inventory routes")
    if len(required) != len(set(required)) or set(required) != set(modes):
        errors.append("required modes must uniquely and exactly cover modes")
    out = matrix.get("evidence_root", "")
    resolved = (root / out).resolve()
    if not out or not resolved.is_relative_to(root.resolve()) or resolved.is_relative_to((root / "proto").resolve()):
        errors.append("evidence root must remain inside repository and outside proto")
    for name, mode in modes.items():
        viewport = mode.get("viewport", {})
        if not all(isinstance(viewport.get(k), int) and viewport[k] > 0 for k in ("width", "height")):
            errors.append(f"invalid viewport: {name}")
        if not isinstance(mode.get("javascript"), bool) or not isinstance(mode.get("reduced_motion"), bool):
            errors.append(f"invalid JavaScript/motion contract: {name}")
    return errors


def probe_browser() -> dict:
    result = {"package": "playwright", "required_version": PINNED_PLAYWRIGHT,
              "package_version": None, "executable": None, "executable_version": None,
              "available": False, "limitation": None}
    try:
        result["package_version"] = importlib.metadata.version("playwright")
        from playwright.sync_api import sync_playwright
        with sync_playwright() as driver:
            executable = Path(driver.chromium.executable_path)
        result["executable"] = str(executable)
        if executable.is_file():
            proc = subprocess.run([str(executable), "--version"], text=True, capture_output=True, timeout=10)
            result["executable_version"] = (proc.stdout or proc.stderr).strip() or None
        if result["package_version"] != PINNED_PLAYWRIGHT:
            result["limitation"] = f"playwright {result['package_version']} is installed; {PINNED_PLAYWRIGHT} is required"
        elif not executable.is_file():
            result["limitation"] = "the pinned Playwright Chromium executable is not installed"
        else:
            result["available"] = True
    except (ImportError, importlib.metadata.PackageNotFoundError):
        result["limitation"] = f"playwright {PINNED_PLAYWRIGHT} is not installed"
    except Exception as exc:
        result["limitation"] = f"browser dependency probe failed: {exc}"
    return result


def storage_hashes(root: Path) -> dict[str, str]:
    found = {}
    for rel in ("proto/storage", "proto/docs/site_layer_controls_state.json"):
        path = root / rel
        for item in (path.rglob("*") if path.is_dir() else [path]):
            if item.is_file():
                found[str(item.relative_to(root))] = hashlib.sha256(item.read_bytes()).hexdigest()
    return found


def start_server(root: Path) -> tuple[subprocess.Popen, int]:
    with socket.socket() as sock:
        sock.bind(("127.0.0.1", 0)); port = sock.getsockname()[1]
    server = subprocess.Popen(["php", "-S", f"127.0.0.1:{port}", "-t", str(root / "proto/public")],
                              stdout=subprocess.DEVNULL, stderr=subprocess.PIPE, text=True)
    deadline = time.time() + 5
    while time.time() < deadline:
        with socket.socket() as sock:
            if sock.connect_ex(("127.0.0.1", port)) == 0:
                return server, port
        if server.poll() is not None:
            raise RuntimeError("PHP server exited before becoming ready")
        time.sleep(.05)
    raise RuntimeError("PHP server did not become ready")


def stop_server(server: subprocess.Popen) -> None:
    server.terminate()
    try:
        server.wait(timeout=3)
    except subprocess.TimeoutExpired:
        server.kill(); server.wait()


def route_url(inventory: dict, route_id: str) -> str:
    return next(route["url"] for route in inventory["routes"] if route["id"] == route_id)


def inspect_page(page, base_url: str) -> tuple[list[str], list[str]]:
    """Assert same-origin GET navigation and inspect forms without submitting."""
    navigation_errors, form_errors = [], []
    links = page.locator("a[href]")
    for index in range(links.count()):
        href = links.nth(index).get_attribute("href") or ""
        if href.startswith(("/", "#", "?")) and not href.startswith("//"):
            # Core navigation must resolve to the owned origin and remain GET-capable.
            target = page.evaluate("(href) => new URL(href, document.baseURI).href", href)
            if not target.startswith(base_url + "/") and target != base_url:
                navigation_errors.append(f"same-origin link escaped origin: {href}")
            elif not href.startswith("#"):
                response = page.request.get(target, fail_on_status_code=False)
                if response.status >= 400:
                    navigation_errors.append(f"core GET navigation returned {response.status}: {href}")
    forms = page.locator("form")
    for index in range(forms.count()):
        form = forms.nth(index)
        method = (form.get_attribute("method") or "get").lower()
        action = form.get_attribute("action") or page.url
        controls = form.locator("input, select, textarea, button")
        if method not in ("get", "post"):
            form_errors.append(f"form {index + 1} has unsupported method {method}")
        if not action:
            form_errors.append(f"form {index + 1} has no action")
        if controls.count() == 0:
            form_errors.append(f"form {index + 1} has no controls")
    return navigation_errors, form_errors


def capture(root: Path, inventory: dict, matrix: dict, selected: list[str]) -> int:
    from playwright.sync_api import sync_playwright
    before = storage_hashes(root)
    output = (root / matrix["evidence_root"]).resolve(); output.mkdir(parents=True, exist_ok=True)
    revision = subprocess.run(["git", "rev-parse", "HEAD"], cwd=root, text=True, capture_output=True, check=True).stdout.strip()
    server = None
    try:
        server, port = start_server(root); base = f"http://127.0.0.1:{port}"
        with sync_playwright() as driver:
            browser = driver.chromium.launch(headless=True)
            try:
                version = f"playwright/{importlib.metadata.version('playwright')} chromium/{browser.version}"
                for route_id in selected:
                    for mode_name in matrix["required_route_modes"]:
                        mode = matrix["modes"][mode_name]
                        context = browser.new_context(viewport=mode["viewport"], java_script_enabled=mode["javascript"],
                                                      reduced_motion="reduce" if mode["reduced_motion"] else "no-preference")
                        try:
                            page = context.new_page(); console_errors, page_errors = [], []
                            page.on("console", lambda msg: console_errors.append(msg.text) if msg.type == "error" else None)
                            page.on("pageerror", lambda exc: page_errors.append(str(exc)))
                            response = page.goto(base + route_url(inventory, route_id), wait_until="networkidle")
                            if response is None or response.status >= 400:
                                raise RuntimeError(f"{route_id}/{mode_name}: navigation failed")
                            nav_errors, form_errors = inspect_page(page, base)
                            failures = console_errors + page_errors + nav_errors + form_errors
                            if failures:
                                raise RuntimeError(f"{route_id}/{mode_name}: " + "; ".join(failures))
                            stem = f"{route_id}--{mode_name}"; shot = output / f"{stem}.png"
                            page.screenshot(path=str(shot), full_page=True)
                            metadata = {"route_id": route_id, "mode": mode_name, "viewport": mode["viewport"],
                                        "javascript": mode["javascript"], "reduced_motion": mode["reduced_motion"],
                                        "tool_version": version, "source_revision": revision, "console_errors": [],
                                        "page_errors": [], "navigation_errors": [], "form_errors": [],
                                        "captured_at": datetime.now(timezone.utc).isoformat(), "screenshot": shot.name,
                                        "sha256": hashlib.sha256(shot.read_bytes()).hexdigest()}
                            (output / f"{stem}.json").write_text(json.dumps(metadata, indent=2) + "\n")
                            print(f"PASS {route_id} {mode_name}")
                        finally:
                            context.close()
            finally:
                browser.close()
    finally:
        if server is not None:
            stop_server(server)
    if storage_hashes(root) != before:
        print("browser preview changed restricted runtime storage", file=sys.stderr); return 1
    return 0


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("--root", type=Path, default=ROOT); parser.add_argument("--inventory", type=Path)
    parser.add_argument("--matrix", type=Path); parser.add_argument("--dry-run", action="store_true")
    parser.add_argument("--require-browser", action="store_true"); parser.add_argument("--probe", action="store_true")
    parser.add_argument("--route", action="append", dest="routes")
    args = parser.parse_args()
    inventory = json.loads((args.inventory or args.root / "docs/website_pipeline/public_site_inventory.json").read_text())
    matrix = json.loads((args.matrix or args.root / "docs/website_pipeline/preview_matrix.json").read_text())
    errors = validate(inventory, matrix, args.root)
    selected = args.routes or matrix["routes"]
    if len(selected) != len(set(selected)) or not set(selected).issubset(matrix["routes"]):
        errors.append("selected routes must be unique declared public routes")
    if errors:
        print("preview contract failed: " + "; ".join(errors), file=sys.stderr); return 1
    probe = probe_browser(); print("DEPENDENCY " + json.dumps(probe, sort_keys=True))
    if args.probe:
        return 0 if probe["available"] else 2
    for route in selected:
        for mode in matrix["required_route_modes"]:
            print(f"CAPTURE {route} {mode} -> {matrix['evidence_root']}/{route}--{mode}.png")
    if args.dry_run:
        print(f"preview dry run: {len(selected) * len(matrix['required_route_modes'])} captures; browser_available={str(probe['available']).lower()}"); return 0
    if not probe["available"]:
        print(f"LIMITATION: {probe['limitation']}; no browser evidence produced.", file=sys.stderr)
        return 2 if args.require_browser else 0
    return capture(args.root, inventory, matrix, selected)


if __name__ == "__main__":
    raise SystemExit(main())
