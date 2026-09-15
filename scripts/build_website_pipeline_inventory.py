#!/usr/bin/env python3
"""Build the deterministic M0 inventory and M1 website impact graph."""
from __future__ import annotations

import hashlib
import json
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
OUT = ROOT / "docs/website_pipeline"


def digest(path: Path) -> str:
    return hashlib.sha256(path.read_bytes()).hexdigest()


def record(record_id: str, path: str, classification: str, role: str) -> dict:
    target = ROOT / path
    return {"id": record_id, "path": path, "classification": classification,
            "role": role, "sha256": digest(target)}


def main() -> None:
    routes = []
    for entry in sorted((ROOT / "proto/public").glob("**/index.php")):
        relative = entry.relative_to(ROOT).as_posix()
        suffix = entry.relative_to(ROOT / "proto/public").parent.as_posix()
        url = "/" if suffix == "." else f"/{suffix}/"
        surface = "owner_tool" if url.startswith(("/site-layers/", "/preserve-backup/")) else "public"
        routes.append({"id": "route." + (suffix.replace("/", ".") if suffix != "." else "home"),
                       "url": url, "entrypoint": relative, "surface": surface})

    fixed = [
        ("loader.view", "proto/app/view.php", "implementation", "shared renderer"),
        ("loader.language", "proto/app/language.php", "implementation", "language loader"),
        ("loader.data", "proto/app/site_data.php", "implementation", "route and asset registry"),
        ("loader.sections", "proto/app/page_sections.php", "implementation", "managed-section loader"),
        ("runtime.layers", "proto/app/layer_runtime.php", "runtime", "public render-time layer state adapter"),
        ("content.language", "proto/docs/language.json", "derived", "runtime copy token store"),
        ("content.sections", "proto/docs/page_sections.json", "derived", "managed-section prototype store"),
        ("style.public", "proto/public/assets/css/site.css", "implementation", "active public stylesheet"),
        ("script.public", "proto/public/assets/js/site.js", "implementation", "active progressive enhancement"),
        ("form.lead", "proto/app/forms/lead_submit.php", "implementation", "lead form handler"),
        ("form.inquiry", "proto/app/forms/inquiry_submit.php", "implementation", "inquiry handler"),
        ("storage.contract", "proto/storage/README.md", "implementation", "restricted runtime storage boundary"),
        ("database.schema", "proto/database/schema.sql", "implementation", "optional persistence schema"),
        ("authority.website", "proto/docs/website_ssot.md", "authority", "current website canon"),
        ("authority.style", "docs/styleguide.md", "authority", "public presentation authority"),
        ("settings.architecture", "docs/ssot/settings/site_architecture.json", "authority_companion", "architecture settings"),
        ("release.matrix", "center/data/release_gate_matrix.php", "review", "read-only release gate candidates"),
        ("validator.center", "center/scripts/validate.php", "validation", "center integrity validator"),
        ("validator.compendium", "extract/scripts/validate_compendium.py", "validation", "compendium validator"),
        ("history.pipeline_boot", "website_editing_pipeline_boot.md", "history", "rolling pipeline handoff"),
    ]
    records = [record(*row) for row in fixed]
    for route in routes:
        records.append(record("entry." + route["id"].removeprefix("route."), route["entrypoint"],
                              "implementation", "route entrypoint"))
    for asset in sorted((ROOT / "proto/public/assets/img").glob("*")):
        if asset.is_file():
            records.append(record("asset." + asset.name.replace(".", "_"), asset.relative_to(ROOT).as_posix(),
                                  "implementation", "public image asset"))

    inventory = {
        "schema_version": "1.0.0", "generated_by": "scripts/build_website_pipeline_inventory.py",
        "timeline_moment_id_or_gen": "GEN", "active_application": "proto",
        "active_document_root": "proto/public", "records": records, "routes": routes,
        "excluded_sensitive_patterns": ["proto/app/config.php", "proto/storage/leads/**",
                                        "proto/storage/mail-failures/**", "**/site_layer_controls_state.json"],
        "known_boundaries": [
            "Top-level proto route copies are historical compatibility context, not active entrypoints.",
            "Center is read-mostly and supplies review contracts, not approval or publishing authority.",
            "Runtime submissions, mail diagnostics, configuration values, and layer state are excluded.",
            "Compendium Sections 05, 06, and 08-11 remain scaffold contracts, not approved canon."
        ]
    }

    shared = ["loader.view", "loader.language", "loader.data", "loader.sections",
              "runtime.layers", "content.language", "content.sections", "style.public", "script.public"]
    nodes = [{"id": r["id"], "kind": r["classification"], "path": r["path"]} for r in records]
    edges = []
    for route in routes:
        rid, eid = route["id"], "entry." + route["id"].removeprefix("route.")
        nodes.append({"id": rid, "kind": "surface", "path": route["entrypoint"]})
        edges.append({"from": rid, "to": eid, "relation": "implemented_by"})
        if route["surface"] == "public":
            edges.extend({"from": rid, "to": dep, "relation": "depends_on"} for dep in shared)
    edges += [
        {"from": "content.language", "to": "authority.website", "relation": "derived_from"},
        {"from": "content.sections", "to": "authority.website", "relation": "governed_by"},
        {"from": "release.matrix", "to": "authority.website", "relation": "reviews"},
        {"from": "authority.website", "to": "authority.style", "relation": "constrained_by"},
    ]
    graph = {
        "schema_version": "1.0.0", "timeline_moment_id_or_gen": "GEN",
        "direction_rule": "Edges point from affected/derived consumer to dependency or governing source.",
        "nodes": nodes, "edges": edges,
        "gaps": [
            {"id": "gap.fact-token-bindings", "status": "not_started", "reason": "Per-fact and per-token authority bindings require controlled content records."},
            {"id": "gap.asset-rights", "status": "blocked", "reason": "Compendium rights and asset leaves are scaffolds; no clearance is inferred."},
            {"id": "gap.release-history", "status": "not_started", "reason": "Immutable edit/release history is an M5/M6 dependency."}
        ]
    }
    OUT.mkdir(parents=True, exist_ok=True)
    (OUT / "public_site_inventory.json").write_text(json.dumps(inventory, indent=2) + "\n")
    (OUT / "impact_graph.json").write_text(json.dumps(graph, indent=2) + "\n")
    print(f"Wrote {len(records)} inventory records, {len(routes)} routes, {len(nodes)} graph nodes, and {len(edges)} edges.")


if __name__ == "__main__":
    main()
