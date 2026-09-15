#!/usr/bin/env python3
"""Dependency-light, read-only repository validation orchestrator."""
from __future__ import annotations

import json
import shutil
import subprocess
import sys
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]


def run(label: str, command: list[str]) -> bool:
    print(f"\n== {label} ==\n$ {' '.join(command)}", flush=True)
    result = subprocess.run(command, cwd=ROOT)
    print(f"[{label}: {'PASS' if result.returncode == 0 else 'FAIL'}]", flush=True)
    return result.returncode == 0


def main() -> int:
    checks = [
        ("compendium", [sys.executable, "extract/scripts/validate_compendium.py"]),
        ("center", ["php", "center/scripts/validate.php"]),
        ("website pipeline", [sys.executable, "scripts/validate_website_pipeline.py"]),
        ("pipeline fixtures", [sys.executable, "tests/test_website_pipeline_validator.py"]),
        ("HTTP route smoke", [sys.executable, "scripts/smoke_public_routes.py"]),
        ("route/preview fixtures", [sys.executable, "tests/test_route_preview_pipeline.py"]),
        ("browser/evidence fixtures", [sys.executable, "tests/test_browser_preview_adapter.py"]),
        ("preview contract dry run", [sys.executable, "scripts/preview_public_routes.py", "--dry-run"]),
        ("preview evidence freshness", [sys.executable, "scripts/validate_preview_evidence.py"]),
    ]
    php_files = sorted(str(path.relative_to(ROOT)) for path in (ROOT / "proto").rglob("*.php"))
    checks.extend((f"PHP lint {path}", ["php", "-l", path]) for path in php_files)
    results = [run(label, command) for label, command in checks]
    passed = all(results)

    print("\n== governed JSON ==")
    try:
        count = 0
        for base in ("docs/ssot", "proto/docs", "extract/compendium", "docs/website_pipeline"):
            for path in sorted((ROOT / base).rglob("*.json")):
                json.loads(path.read_text(encoding="utf-8"))
                count += 1
        print(f"Parsed {count} governed JSON files. [PASS]")
    except (OSError, json.JSONDecodeError) as exc:
        print(f"Governed JSON parse failed: {exc} [FAIL]", file=sys.stderr)
        passed = False

    print("\n== explicit limitations ==")
    print("WARN: The pinned browser adapter is implemented, but browser claims require the optional pinned Playwright/Chromium environment and generated evidence.")
    print("WARN: Database, mail, network, deployment, approval, backup, and rollback services are not exercised.")
    if shutil.which("jsonschema") is None:
        print("WARN: optional jsonschema CLI is unavailable; component validator reports its own schema limitation.")
    print(f"\nRepository validation {'PASSED' if passed else 'FAILED'}.")
    return 0 if passed else 1


if __name__ == "__main__":
    raise SystemExit(main())
