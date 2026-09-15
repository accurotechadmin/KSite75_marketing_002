#!/usr/bin/env python3
"""Build the empty SSOT compendium scaffold from the approved catalog.

This script intentionally creates document-control shells only. It does not
extract source facts or mark any future SSOT document approved.
"""

from __future__ import annotations

import argparse
import json
import re
import shutil
from collections import Counter
from dataclasses import dataclass
from datetime import date
from pathlib import Path


ROOT = Path(__file__).resolve().parents[2]
CATALOG = ROOT / "extract" / "ssot_compendium_document_inventory.md"
OUTPUT = ROOT / "extract" / "compendium"
SCAFFOLD_DATE = date(2026, 8, 13).isoformat()

ROW_PATTERN = re.compile(
    r"^\| `(?P<path>[^`]+\.(?:json|md))` "
    r"\| `?(?P<class>[^|`]+)`? "
    r"\| (?P<scope>[^|]+) "
    r"\| (?P<sources>[^|]+) \|$",
    re.MULTILINE,
)
SECTION_PATTERN = re.compile(
    r"^# (?P<number>00|01|02|03|04|05|06|07|08|09|10|11|90|99)"
    r" — (?P<title>.+)$",
    re.MULTILINE,
)

VALID_CLASSES = {
    "authority",
    "registry",
    "plan",
    "procedure",
    "release",
    "record",
    "schema",
    "index",
    "view",
}


@dataclass(frozen=True)
class CatalogEntry:
    relative_path: str
    document_class: str
    scope: str
    source_families: str

    @property
    def document_id(self) -> str:
        return self.relative_path.rsplit("/", 1)[-1].rsplit(".", 1)[0]

    @property
    def title(self) -> str:
        return self.document_id.replace("_", " ").title()

    @property
    def section(self) -> str:
        return self.relative_path.split("/", 1)[0]

    @property
    def extension(self) -> str:
        return Path(self.relative_path).suffix


def parse_catalog() -> tuple[list[CatalogEntry], dict[str, str]]:
    text = CATALOG.read_text(encoding="utf-8")
    entries = [
        CatalogEntry(
            relative_path=match.group("path").strip(),
            document_class=match.group("class").strip(),
            scope=match.group("scope").strip(),
            source_families=match.group("sources").strip(),
        )
        for match in ROW_PATTERN.finditer(text)
    ]
    sections = {
        match.group("number"): match.group("title").strip()
        for match in SECTION_PATTERN.finditer(text)
    }

    if len(entries) != 209:
        raise ValueError(f"Expected 209 catalog entries, found {len(entries)}")
    paths = [entry.relative_path for entry in entries]
    if len(paths) != len(set(paths)):
        raise ValueError("Catalog contains duplicate proposed paths")
    invalid_classes = sorted({entry.document_class for entry in entries} - VALID_CLASSES)
    if invalid_classes:
        raise ValueError(f"Unsupported document classes: {invalid_classes}")
    if len(sections) != 14:
        raise ValueError(f"Expected 14 catalog sections, found {len(sections)}")
    return entries, sections


def visibility_for(entry: CatalogEntry) -> str:
    restricted_words = ("contact", "submission", "mail_delivery", "secret")
    if any(word in entry.document_id for word in restricted_words):
        return "restricted"
    return "internal"


def timeline_scope_for(entry: CatalogEntry) -> str:
    timeline_words = (
        "program",
        "timeline",
        "cue",
        "show_control",
        "performance_timing",
        "performer_track",
        "transition",
        "finale",
    )
    if any(word in entry.document_id for word in timeline_words):
        return "MIXED_PENDING_EXTRACTION"
    return "GEN"


def schema_ref_for(entry: CatalogEntry) -> str | None:
    if entry.document_class == "schema":
        return None
    return "../90_schemas_and_vocabularies/document.schema.json"


def json_scaffold(entry: CatalogEntry) -> dict[str, object]:
    payload: dict[str, object] = {
        "scaffold_state": "empty",
        "components_and_subcomponents": entry.scope,
        "source_family_notes": entry.source_families,
        "records": [],
    }
    if entry.document_class == "schema":
        payload["schema_target"] = entry.document_id
        payload["definitions"] = {}
    elif entry.document_class in {"index", "view"}:
        payload["generated_entries"] = []
    elif entry.document_class == "release":
        payload["included_document_revisions"] = []
        payload["release_checksums"] = {}

    document: dict[str, object] = {
        "schema_version": "0.1.0-scaffold",
        "document_id": entry.document_id,
        "document_class": entry.document_class,
        "title": entry.title,
        "description": entry.scope,
        "status": "draft",
        "revision": "0.1.0",
        "effective_date": None,
        "owner_role": "TBD",
        "approver_role": "TBD",
        "visibility": visibility_for(entry),
        "timeline_scope": timeline_scope_for(entry),
        "schema_ref": schema_ref_for(entry),
        "source_refs": [],
        "conflict_refs": [],
        "supersedes": [],
        "superseded_by": None,
        "created_at": SCAFFOLD_DATE,
        "updated_at": SCAFFOLD_DATE,
        "review_due_at": None,
        "scaffold_notice": (
            "Structure only. No source facts have been extracted or approved."
        ),
        "data": payload,
    }
    return document


def markdown_scaffold(entry: CatalogEntry) -> str:
    schema_ref = schema_ref_for(entry) or "Not assigned"
    return f"""# {entry.title}

> **SCAFFOLD ONLY — NO EXTRACTED OR APPROVED FACTS**

## Document control

| Field | Value |
|---|---|
| Document ID | `{entry.document_id}` |
| Document class | `{entry.document_class}` |
| Status | `draft` |
| Revision | `0.1.0` |
| Effective date | Not assigned |
| Owner role | `TBD` |
| Approver role | `TBD` |
| Visibility | `{visibility_for(entry)}` |
| Timeline scope | `{timeline_scope_for(entry)}` |
| Schema reference | `{schema_ref}` |
| Created | `{SCAFFOLD_DATE}` |
| Updated | `{SCAFFOLD_DATE}` |
| Review due | Not assigned |

## Intended component and sub-components

{entry.scope}.

## Principal source families to reconcile

{entry.source_families}.

## Source references

No source records have been extracted.

## Conflict references

No conflicts have been registered in this scaffold.

## Generated content

This view remains empty until its upstream canonical documents are populated,
reconciled, validated, and approved.
"""


def section_readme(section: str, title: str, entries: list[CatalogEntry]) -> str:
    class_counts = Counter(entry.document_class for entry in entries)
    inventory = "\n".join(
        f"- `{Path(entry.relative_path).name}` — `{entry.document_class}` — {entry.scope}."
        for entry in entries
    )
    counts = ", ".join(f"{name}: {count}" for name, count in sorted(class_counts.items()))
    return f"""# {section} — {title}

> **SCAFFOLD SECTION — NO EXTRACTED OR APPROVED FACTS**

This folder was generated from
`extract/ssot_compendium_document_inventory.md`. It contains {len(entries)}
planned documents ({counts}). Do not treat an empty shell as an approved record.

## Planned documents

{inventory}
"""


def manifest_data(entries: list[CatalogEntry], sections: dict[str, str]) -> dict[str, object]:
    documents = []
    for entry in entries:
        documents.append(
            {
                "document_id": entry.document_id,
                "path": entry.relative_path,
                "document_class": entry.document_class,
                "section": entry.section,
                "status": "draft",
                "revision": "0.1.0",
                "visibility": visibility_for(entry),
                "timeline_scope": timeline_scope_for(entry),
                "schema_ref": schema_ref_for(entry),
                "scaffold_state": "empty",
            }
        )
    return {
        "scaffold_state": "empty",
        "components_and_subcomponents": (
            "Every document ID, path, class, status, revision, owner, visibility, "
            "dependencies, schema, and generated view"
        ),
        "source_family_notes": (
            "docs/ssot/master_index.json; settings manifest; complete repository inventory"
        ),
        "section_count": len(sections),
        "document_count": len(entries),
        "sections": [
            {
                "section": next(entry.section for entry in entries if entry.section.startswith(number)),
                "title": title,
                "document_count": sum(entry.section.startswith(number) for entry in entries),
            }
            for number, title in sections.items()
        ],
        "class_counts": dict(sorted(Counter(entry.document_class for entry in entries).items())),
        "documents": documents,
    }


def build(clean: bool) -> None:
    entries, sections = parse_catalog()
    if clean and OUTPUT.exists():
        shutil.rmtree(OUTPUT)
    OUTPUT.mkdir(parents=True, exist_ok=True)

    for entry in entries:
        destination = OUTPUT / entry.relative_path
        destination.parent.mkdir(parents=True, exist_ok=True)
        if entry.extension == ".json":
            content = json.dumps(json_scaffold(entry), indent=2, ensure_ascii=False) + "\n"
        else:
            content = markdown_scaffold(entry)
        destination.write_text(content, encoding="utf-8")

    by_section: dict[str, list[CatalogEntry]] = {}
    for entry in entries:
        by_section.setdefault(entry.section, []).append(entry)
    for section, section_entries in by_section.items():
        number = section.split("_", 1)[0]
        (OUTPUT / section / "README.md").write_text(
            section_readme(section, sections[number], section_entries),
            encoding="utf-8",
        )

    manifest_path = OUTPUT / "00_control_and_governance" / "compendium_manifest.json"
    manifest = json.loads(manifest_path.read_text(encoding="utf-8"))
    manifest["data"] = manifest_data(entries, sections)
    manifest_path.write_text(
        json.dumps(manifest, indent=2, ensure_ascii=False) + "\n",
        encoding="utf-8",
    )

    print(f"Generated {len(entries)} document shells in {len(sections)} sections.")


def main() -> None:
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument(
        "--clean",
        action="store_true",
        help="Remove the existing compendium tree before rebuilding it.",
    )
    args = parser.parse_args()
    build(clean=args.clean)


if __name__ == "__main__":
    main()
