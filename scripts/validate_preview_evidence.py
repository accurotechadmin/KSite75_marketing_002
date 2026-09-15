#!/usr/bin/env python3
"""Validate selected M3 evidence exactly, or plan affected/unaffected captures."""
from __future__ import annotations
import argparse, hashlib, json, subprocess, sys
from datetime import datetime, timezone
from pathlib import Path
ROOT = Path(__file__).resolve().parents[1]


def expected_stems(matrix: dict, routes: list[str]) -> set[str]:
    return {f"{route}--{mode}" for route in routes for mode in matrix["required_route_modes"]}


def validate_selection(inventory: dict, matrix: dict, selection: dict, affected: list[str], unaffected: list[str]) -> list[str]:
    errors = []; public = {r["id"] for r in inventory["routes"] if r["surface"] == "public"}
    if len(affected) != len(set(affected)) or len(unaffected) != len(set(unaffected)):
        errors.append("selected route IDs must be unique")
    if set(affected) & set(unaffected): errors.append("affected and unaffected routes must be disjoint")
    if not set(affected + unaffected).issubset(public): errors.append("selected routes must be public inventory routes")
    if affected and len(unaffected) < selection["minimum_representative_unaffected"]:
        errors.append("an affected selection requires a representative unaffected route")
    if not affected and unaffected: errors.append("unaffected routes require a nonempty affected set")
    return errors


def validate_evidence(root: Path, matrix: dict, routes: list[str], revision: str, now: datetime) -> list[str]:
    base = (root / matrix["evidence_root"]).resolve(); errors = []
    if not base.is_relative_to(root.resolve()) or base.is_relative_to((root / "proto").resolve()):
        return ["unsafe evidence root"]
    expected = expected_stems(matrix, routes)
    actual_meta = {p.stem for p in base.glob("*.json")} if base.exists() else set()
    actual_shots = {p.stem for p in base.glob("*.png")} if base.exists() else set()
    for stem in sorted(expected - actual_meta): errors.append(f"missing metadata: {stem}.json")
    for stem in sorted(expected - actual_shots): errors.append(f"missing screenshot: {stem}.png")
    for stem in sorted(actual_meta - expected): errors.append(f"unexpected metadata: {stem}.json")
    for stem in sorted(actual_shots - expected): errors.append(f"orphan screenshot: {stem}.png")
    for stem in sorted(expected & actual_meta):
        path = base / f"{stem}.json"
        try: meta = json.loads(path.read_text())
        except Exception as exc: errors.append(f"invalid metadata {path.name}: {exc}"); continue
        required = ("route_id","mode","viewport","javascript","reduced_motion","tool_version","source_revision",
                    "console_errors","page_errors","navigation_errors","form_errors","captured_at","screenshot","sha256")
        if any(key not in meta for key in required): errors.append(f"incomplete metadata: {path.name}"); continue
        expected_name = f"{stem}.png"
        if meta["screenshot"] != expected_name or Path(meta["screenshot"]).name != meta["screenshot"]:
            errors.append(f"unsafe or misnamed screenshot: {path.name}"); continue
        route, mode = stem.rsplit("--", 1); contract = matrix["modes"].get(mode)
        if meta["route_id"] != route or meta["mode"] != mode or contract is None:
            errors.append(f"route/mode mismatch: {path.name}")
        elif any(meta[key] != contract[key] for key in ("viewport", "javascript", "reduced_motion")):
            errors.append(f"mode contract mismatch: {path.name}")
        if not isinstance(meta["tool_version"], str) or not meta["tool_version"]:
            errors.append(f"missing tool version: {path.name}")
        if meta["source_revision"] != revision: errors.append(f"stale source revision: {path.name}")
        for field in ("console_errors", "page_errors", "navigation_errors", "form_errors"):
            if meta[field] != []: errors.append(f"nonempty {field}: {path.name}")
        shot = base / expected_name
        if not shot.is_file() or hashlib.sha256(shot.read_bytes()).hexdigest() != meta["sha256"]:
            errors.append(f"screenshot hash mismatch: {path.name}")
        try:
            captured = datetime.fromisoformat(meta["captured_at"])
            if captured.tzinfo is None or (now - captured.astimezone(timezone.utc)).total_seconds() / 3600 > matrix["freshness"]["maximum_age_hours"]:
                errors.append(f"stale capture age: {path.name}")
            if captured > now: errors.append(f"future capture time: {path.name}")
        except (ValueError, TypeError): errors.append(f"invalid capture time: {path.name}")
    return errors


def main() -> int:
    parser=argparse.ArgumentParser(); parser.add_argument("--root",type=Path,default=ROOT)
    parser.add_argument("--matrix",type=Path); parser.add_argument("--inventory",type=Path); parser.add_argument("--selection",type=Path)
    parser.add_argument("--affected",action="append",default=[]); parser.add_argument("--unaffected",action="append",default=[])
    parser.add_argument("--dry-run",action="store_true"); parser.add_argument("--revision"); parser.add_argument("--now")
    args=parser.parse_args(); matrix=json.loads((args.matrix or args.root/"docs/website_pipeline/preview_matrix.json").read_text())
    inventory=json.loads((args.inventory or args.root/"docs/website_pipeline/public_site_inventory.json").read_text())
    selection=json.loads((args.selection or args.root/"docs/website_pipeline/preview_selection.json").read_text())
    errors=validate_selection(inventory,matrix,selection,args.affected,args.unaffected); routes=args.affected+args.unaffected
    if args.dry_run:
        for stem in sorted(expected_stems(matrix,routes)): print(f"REQUIRE {stem}.png {stem}.json")
    elif routes:
        revision=args.revision or subprocess.run(["git","rev-parse","HEAD"],cwd=args.root,text=True,capture_output=True,check=True).stdout.strip()
        now=datetime.fromisoformat(args.now) if args.now else datetime.now(timezone.utc)
        errors.extend(validate_evidence(args.root,matrix,routes,revision,now))
    else:
        base=args.root/matrix["evidence_root"]
        if base.exists() and any(base.iterdir()): errors.append("evidence exists but no explicit selection was supplied")
        else: print("preview evidence absent (browser capture not claimed)")
    if errors: print("preview evidence validation failed:\n- " + "\n- ".join(errors),file=sys.stderr); return 1
    print(f"preview evidence contract passed ({len(routes)} selected routes)"); return 0
if __name__=="__main__": raise SystemExit(main())
