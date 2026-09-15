#!/usr/bin/env python3
"""Positive and deliberately broken fixture checks for the pipeline validator."""
from __future__ import annotations

import copy
import json
import subprocess
import sys
import tempfile
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
VALIDATOR = ROOT / "scripts/validate_website_pipeline.py"
INVENTORY = json.loads((ROOT / "docs/website_pipeline/public_site_inventory.json").read_text())
GRAPH = json.loads((ROOT / "docs/website_pipeline/impact_graph.json").read_text())


def invoke(inventory: dict, graph: dict) -> int:
    with tempfile.TemporaryDirectory() as directory:
        base = Path(directory)
        inv, gra = base / "inventory.json", base / "graph.json"
        inv.write_text(json.dumps(inventory)); gra.write_text(json.dumps(graph))
        return subprocess.run([sys.executable, str(VALIDATOR), "--root", str(ROOT),
                               "--inventory", str(inv), "--graph", str(gra), "--skip-hashes"],
                              stdout=subprocess.DEVNULL, stderr=subprocess.DEVNULL).returncode


def main() -> int:
    failures = []
    if invoke(INVENTORY, GRAPH) != 0:
        failures.append("positive fixture rejected")
    duplicate = copy.deepcopy(INVENTORY)
    duplicate["records"].append(copy.deepcopy(duplicate["records"][0]))
    if invoke(duplicate, GRAPH) == 0:
        failures.append("duplicate-ID fixture accepted")
    broken = copy.deepcopy(GRAPH)
    broken["edges"].append({"from": broken["nodes"][0]["id"], "to": "missing.node", "relation": "depends_on"})
    if invoke(INVENTORY, broken) == 0:
        failures.append("broken-reference fixture accepted")
    cycle = copy.deepcopy(GRAPH)
    cycle["edges"].extend([{"from": "authority.website", "to": "authority.style", "relation": "constrained_by"},
                           {"from": "authority.style", "to": "authority.website", "relation": "constrained_by"}])
    if invoke(INVENTORY, cycle) == 0:
        failures.append("cycle fixture accepted")
    missing = copy.deepcopy(INVENTORY)
    missing["records"][0]["path"] = "does/not/exist.php"
    if invoke(missing, GRAPH) == 0:
        failures.append("missing-path fixture accepted")
    forbidden = copy.deepcopy(INVENTORY)
    forbidden["records"][0]["path"] = "proto/app/config.php"
    if invoke(forbidden, GRAPH) == 0:
        failures.append("private/runtime fixture accepted")
    if failures:
        print("; ".join(failures), file=sys.stderr)
        return 1
    print("website pipeline positive and negative fixtures ok")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
