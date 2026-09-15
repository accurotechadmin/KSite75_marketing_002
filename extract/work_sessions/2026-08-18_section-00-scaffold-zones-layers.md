# Operational Handoff — Section 03.03 Scaffold, Zones, and Layers

> Operational work-session record only. This is not approved SSOT and does not authorize construction, rigging, loading, access, occupancy, effects, egress, clearance, venue, equipment, or safety decisions.

## Session boundary and starting audit

- Date: 2026-08-18 UTC.
- Starting commit/tree: `e4822b2`; clean `work` branch.
- Remote/upstream: none configured; fetch/fast-forward was unavailable and the audited local history was used.
- Verified starting state matched the rolling handoff: Section `90` `R24`, `00` `R13`, `01` `R12`, `02` `R14`, `03` `R7/S22`; repository `R70/S139`; all other states zero.

## Completed transitions

1. `scaffold_and_rigging_geometry.json`: `S -> R`. Preserved 11 scaffold, tower, rail, and position measurements plus a material candidate with low-confidence prototype evidence. Added a reversible candidate visualization envelope and explicit stage/pavilion relationships; kept tower count/positions and every load, attachment, roof-capacity, clearance, and approval fact null or blocked.
2. `stage_zone_registry.json`: `S -> R`. Preserved all eight prototype zones with stable IDs, candidate anchors, planning purposes, evidence/confidence, and verification. Bounds and all access, performer-occupancy, hazard, effect, egress, and clearance permissions fail closed.
3. `stage_layer_registry.json`: `S -> R`. Preserved all 13 prototype layers with stable IDs, source order, visibility semantics, domains, ownership roles, upstream references, and generated-view boundaries. Default visibility is explicitly not activation, clearance, or approval.
4. Synchronized the manifest and freshness coverage (`R73/S136`), Section `03` and extraction READMEs, rolling boot baseline/queue, validator, dependent source hashes, and this handoff.

## Principal evidence and locators

- `proto_prob/data/global/scaffold.json` (`89947ec77c1ec245f4136ca5610b2a67c8b9c2c62957c8c5f2dfb38d2f2ac917`), all records; prototype geometry/material candidates only.
- `proto_prob/data/global/zones.json` (`8753185a373e3c922fb9d52ac01e6767e075abe4627f61874feb4b4332f56199`), all eight center-point records; a point is not a permission or safe volume.
- `proto_prob/data/global/layers.json` (`0ca322b6f9af75402debd0626b5730f1c2598cd9f2a7ab509dfde3c30ec795c5`), all 13 ordered visibility records; visualization preference only.
- The authoritative cue-book DOCX (`6c7fdff...96d0`) supplied TECH requirements for positions, travel, loads, clear zones, interlocks, emergency stop, abort, and recovery. The supporting-standard DOCX (`08a9d21...b2291`) supplied STG-01/AUTO-01/VEN-01, performer, effect, route, zone, inspection, and approval requirements. Neither verifies prototype geometry or grants permission.
- Live coordinate, pavilion, stage, equipment, and newly authored geometry/zone registries supplied dependency boundaries and were referenced with full SHA-256 values in each leaf.

## Decisions, rejected alternatives, conflicts, and blockers

- Treated the scaffold source position as x/y center and z base only for a reversible visualization envelope, explicitly marking the interpretation unverified. Rejected presenting the derived bounds as surveyed placement, containment, or clearance.
- Retained tower dimensions without inventing tower count or positions. Retained rail elevations without inventing purpose or guard/load rating.
- Preserved zone centers but left bounds null. Rejected deriving occupancy, effect, hazard, access, egress, or clearance permission from labels or points.
- Preserved prototype layer order/default visibility but rejected equating either with compositing/cue precedence, physical presence, operational activation, or approval.
- Controlled human approval, qualified survey and structural evidence, venue/as-built and roof capacity data, engineered loads/attachments, field inspection, zone bounds, performer/department/effect reconciliation, access/egress/fire-lane/clearance evidence, and active configuration/release remain promotion blockers, not blockers to review-ready extraction.

## Validation record and limitations

- `python3 extract/scripts/validate_compendium.py` validates manifest/source hashes, 11 scaffold measurements/bounds and null structural facts, eight zones and fail-closed permissions, and 13 ordered non-operational layers, in addition to prior invariants.
- JSON parse loop, `git diff --check`, state audit, stale-handoff search, and touched-diff review are final completion checks.
- Full Draft 2020-12 metaschema and format assertions were not run because `jsonschema` is unavailable. PDF text/page utilities remain unavailable; no vendor claim was promoted. DOCX XML was extracted to `/tmp` only for targeted study.

## Final audit and next work

Final live state is Section `90` `R24`, `00` `R13`, `01` `R12`, `02` `R14`, `03` `R10/S19`; repository `R73/S136`; all `W/C/B/A/G/X/!` counts zero. Review-ready is not approved or generated canon. The first unfinished leaf is `03_technical_systems_and_stage/stage_plot.json`; the root boot next queues that view, then the Section `03.02` DMX universe registry and patch plan.
