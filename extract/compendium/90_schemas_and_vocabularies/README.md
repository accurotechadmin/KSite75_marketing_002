# 90_schemas_and_vocabularies — Schemas and Controlled Vocabularies

> **LIVE FOUNDATION — REVIEW PENDING; NOTHING HERE IS APPROVED CANON**

All 24 planned Section `90` leaves are substantively populated and currently in
`review`. Their embedded Draft 2020-12 schemas and controlled vocabularies are an
authoring foundation pending controlled human approval. Status must be audited
from content and evidence, not inferred from file length or this summary.

## Live per-leaf inventory

| Leaf | Class | State |
|---|---|---|
| `document.schema.json` | schema | R — review |
| `entity_record.schema.json` | schema | R — review |
| `source_reference.schema.json` | schema | R — review |
| `conflict.schema.json` | schema | R — review |
| `release.schema.json` | schema | R — review |
| `program_event.schema.json` | schema | R — review |
| `timeline_moment.schema.json` | schema | R — review |
| `department_cue.schema.json` | schema | R — review |
| `equipment_type.schema.json` | schema | R — review |
| `equipment_instance.schema.json` | schema | R — review |
| `scene_profile.schema.json` | schema | R — review |
| `asset.schema.json` | schema | R — review |
| `content_token.schema.json` | schema | R — review |
| `campaign.schema.json` | schema | R — review |
| `public_route_section.schema.json` | schema | R — review |
| `form_submission.schema.json` | schema | R — review |
| `owner_work_item.schema.json` | schema | R — review |
| `inspection_report.schema.json` | schema | R — review |
| `status_vocabularies.json` | authority | R — review |
| `id_namespace_registry.json` | authority | R — review |
| `relationship_type_registry.json` | authority | R — review |
| `role_vocabulary.json` | authority | R — review |
| `asset_taxonomy.json` | authority | R — review |
| `channel_and_placement_vocabulary.json` | authority | R — review |

## Validation and approval boundary

Embedded schemas use file-relative `$id` and `$ref` values so references resolve
to the embedded schema at `/data/schema` in sibling controlled-envelope files.
Structural parsing, reference resolution, manifest synchronization, and
representative valid/invalid cases are covered by the continuation validation
script. Full Draft 2020-12 metaschema checking with format assertions remains an
environment warning when a conforming validator is unavailable. Cross-record
rules—such as DMX footprint end-address and universe overlap—remain application
validation responsibilities. Controlled approval evidence is still required
before any leaf may move from `review` to `approved`.
