# Operational Handoff — Section 03.03 Geometry Authority

> Operational work-session record only. This is not approved SSOT and does not authorize construction, rigging, loading, access, clearance, venue, equipment, or safety decisions.

## Session boundary and starting audit

- Date: 2026-08-18 UTC.
- Starting commit/tree: `01fa3f8`; clean `work` branch.
- Remote/upstream: none configured; fetch/fast-forward was unavailable and the audited local history was used.
- Verified starting state matched the rolling handoff: Section `90` `R24`, `00` `R13`, `01` `R12`, `02` `R14`, `03` `R4/S25`; repository `R67/S142`; all other states zero.

## Completed transitions

1. `coordinate_system.json`: `S -> R`. Defined feet/degrees, origin and deck datum, right-handed x/y/z axes, performer-perspective orientation, precision limits, transformations, and an explicit prototype/unverified default.
2. `pavilion_geometry.json`: `S -> R`. Preserved 16 pavilion, roof, cradle, and masking measurements as low-confidence prototype candidates with evidence and verification state. No clearance, attachment point, roof capacity, or load approval was inferred.
3. `stage_geometry.json`: `S -> R`. Preserved 20 main-stage, rear-platform, transition, octagon, and audience-floor measurements plus finish candidates. Added machine-checkable candidate bounds and relationships while keeping access, clearance, structural capacity, and audience-floor origin absent.
4. Synchronized the manifest and freshness coverage (`R70/S139`), Section `03` and extraction READMEs, rolling boot baseline/queue, validator, session handoff, and dependent source hashes.

## Principal evidence and locators

- `proto_prob/data/global/project.json` (`c88c77164a4e70da55ae651bf62c4911f776c6d988e30b05a821d0a6f32296d0`), `units` and `coordinate_system`; prototype convention only.
- `proto_prob/data/global/pavilion.json` (`dc1e7dbd6fc045e7dc48a684c75526dd28bf10216e95ff123a991f3e16d6157c`), complete pavilion record; prototype dimensions/descriptions only.
- `proto_prob/data/global/stage.json` (`b1940be0c073c371b1924bf637b0b192f61d4292c1518d451143b8a5b0f21011`), complete stage record; prototype dimensions/finishes only. `proto_prob/data/global/zones.json` was used only for relationship/visualization cross-checks.
- The authoritative cue-book DOCX (`6c7fdff...96d0`) supplied deck/platform/scenic checks and TECH completion requirements; the authoritative supporting-standard DOCX (`08a9d21...b2291`) supplied documentation/inspection/approval requirements. Neither verifies a dimension.
- `docs/rig.md` (`af32084...9141c`) supplied secondary planning context, and `extract/ssot_source_inventory.md` supplied the explicit measured/estimated/prototype caution.

## Decisions, rejected alternatives, conflicts, and blockers

- Chose a right-handed interpretation consistent with the prototype axes, but retained it as an unapproved candidate authority; rejected calling the origin surveyed or venue-confirmed.
- Preserved source decimal precision without inventing tolerance. Rejected treating decimal places as measurement accuracy.
- Registered the octagon center beyond the main-stage candidate y bound as a relationship requiring field confirmation rather than silently changing either source value.
- Left audience-floor origin/bounds, all access routes, clearances, and structural capacities null/empty. Rejected inferring safe/usable envelopes from visualization dimensions.
- Controlled human approval, venue/as-built evidence, qualified field measurement, tolerances/control points, roof/attachment/load data, rigging review, access/egress and clearance verification, finish safety evidence, and physical applicability remain promotion blockers, not blockers to review-ready extraction.

## Validation record and limitations

- `python3 extract/scripts/validate_compendium.py` — passed manifest, hashes, cross-links, prior invariants, coordinate authority, pavilion/stage measurement coverage, bounds, and fail-closed geometry checks; warned that `jsonschema` is unavailable.
- JSON parse loop, `git diff --check`, state audit, stale-handoff search, and touched-diff review were required final checks.
- Full Draft 2020-12 metaschema and format assertions were not run because `jsonschema` is unavailable. PDF text/page tools remain unavailable; no vendor claim was promoted.

## Final audit and next work

Final live state is Section `90` `R24`, `00` `R13`, `01` `R12`, `02` `R14`, `03` `R7/S22`; repository `R70/S139`; all `W/C/B/A/G/X/!` counts zero. Review-ready is not approved or generated canon. The first unfinished leaf is `03_technical_systems_and_stage/scaffold_and_rigging_geometry.json`; the root boot queues scaffold/rigging geometry, stage zones, and stage layers in dependency order.
