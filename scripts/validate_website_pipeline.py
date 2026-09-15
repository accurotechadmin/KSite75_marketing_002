#!/usr/bin/env python3
"""Read-only structural and freshness validation for M0/M1 artifacts."""
from __future__ import annotations

import argparse
import hashlib
import json
import sys
from pathlib import Path

FORBIDDEN = ("proto/app/config.php", "proto/storage/leads/", "proto/storage/mail-failures/",
             "site_layer_controls_state.json")


def unique(items: list[dict], label: str, errors: list[str]) -> set[str]:
    ids = [item.get("id") for item in items]
    duplicates = sorted({item for item in ids if ids.count(item) > 1})
    if duplicates:
        errors.append(f"duplicate {label} IDs: {', '.join(duplicates)}")
    return set(ids)


def validate(root: Path, inventory_path: Path, graph_path: Path, check_hashes: bool = True) -> list[str]:
    errors: list[str] = []
    inventory = json.loads(inventory_path.read_text())
    graph = json.loads(graph_path.read_text())
    record_ids = unique(inventory.get("records", []), "inventory", errors)
    route_ids = unique(inventory.get("routes", []), "route", errors)
    for rec in inventory.get("records", []):
        rel = rec.get("path", "")
        if rel.startswith("/") or ".." in Path(rel).parts:
            errors.append(f"unsafe inventory path: {rel}")
            continue
        if any(pattern in rel for pattern in FORBIDDEN):
            errors.append(f"forbidden private/runtime inventory path: {rel}")
        target = root / rel
        if not target.is_file():
            errors.append(f"missing inventory path: {rel}")
        elif check_hashes and hashlib.sha256(target.read_bytes()).hexdigest() != rec.get("sha256"):
            errors.append(f"stale inventory hash: {rel}")
    for route in inventory.get("routes", []):
        if not (root / route.get("entrypoint", "")).is_file():
            errors.append(f"missing route entrypoint: {route.get('entrypoint')}")

    nodes = graph.get("nodes", [])
    node_ids = unique(nodes, "graph node", errors)
    if not route_ids.issubset(node_ids):
        errors.append("graph does not contain every inventory route ID")
    if not record_ids.issubset(node_ids):
        errors.append("graph does not contain every inventory record ID")
    adjacency: dict[str, list[str]] = {node: [] for node in node_ids}
    for edge in graph.get("edges", []):
        source, target = edge.get("from"), edge.get("to")
        if source not in node_ids or target not in node_ids:
            errors.append(f"broken graph reference: {source} -> {target}")
        else:
            adjacency[source].append(target)
    visiting: set[str] = set()
    visited: set[str] = set()
    def walk(node: str) -> None:
        if node in visiting:
            errors.append(f"authority/dependency cycle detected at: {node}")
            return
        if node in visited:
            return
        visiting.add(node)
        for target in adjacency[node]:
            walk(target)
        visiting.remove(node)
        visited.add(node)
    for node in sorted(node_ids):
        walk(node)
    return sorted(set(errors))


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("--root", type=Path, default=Path(__file__).resolve().parents[1])
    parser.add_argument("--inventory", type=Path)
    parser.add_argument("--graph", type=Path)
    parser.add_argument("--skip-hashes", action="store_true", help="fixture-only: skip source hash freshness")
    args = parser.parse_args()
    inventory = args.inventory or args.root / "docs/website_pipeline/public_site_inventory.json"
    graph = args.graph or args.root / "docs/website_pipeline/impact_graph.json"
    try:
        errors = validate(args.root, inventory, graph, not args.skip_hashes)
    except (OSError, json.JSONDecodeError) as exc:
        errors = [str(exc)]
    if errors:
        print("website pipeline validation failed:", file=sys.stderr)
        for error in errors:
            print(f"- {error}", file=sys.stderr)
        return 1
    print("website pipeline inventory and impact graph validation ok")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
