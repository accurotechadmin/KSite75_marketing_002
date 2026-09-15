# Operational Handoff — Section 03.01 Equipment Evidence

> Operational work-session record only. This is not approved SSOT and does not authorize a patch, configuration, equipment use, maintenance clearance, rigging, or safety decision.

## Session boundary and starting audit

- Date: 2026-08-15 UTC.
- Starting commit/tree: `4d9f3fa`; clean `work` branch.
- Remote/upstream: none configured; fetch/fast-forward was unavailable and local audited history was used.
- Verified starting state: Section `90` `R24`, `00` `R13`, `01` `R12`, `02` `R14`, `03` `R1/S28`; repository `R64/S145`; all other states zero. This matched the rolling handoff even though its prose named the older preparation commit `2e89f81`; Git history showed that work merged locally through `4d9f3fa`.

## Completed transitions

1. `equipment_instance_registry.json`: `S -> R`. Extracted all 59 fixture identities from the index and individual records, linked all nine provisional types, and retained source tag, status, role, and estimated location only as candidates. Serial numbers, physical verification, maintenance clearance, active patch/configuration, and safety approval remain null, empty, false, or unresolved.
2. `vendor_document_registry.json`: `S -> R`. Registered three PDFs by stable ID, path, SHA-256, metadata companion, revision state, model-applicability candidate, and supersession questions. Paired JSON files remain discovery metadata rather than manuals. Because PDF text/page tools are absent, no vendor claim was extracted or promoted without a locator.
3. `equipment_capability_and_mode_catalog.json`: `S -> R`. Reconciled all nine equipment families and their prototype candidate modes with contiguous channel offsets/counts, explicit evidence/applicability, null defaults/home/ranges, and safe verification constraints. Verified modes/capabilities, selected working/avoided modes, patch, active configuration, and safety approvals remain absent.
4. Synchronized the manifest, freshness coverage (`R67/S142`), Section `03` README, extraction README, root rolling handoff/queue, validator, and dependent source hashes.

## Principal evidence and locators

- `proto_prob/data/indexes/fixtures.json` (`3861ae86092f0e9b2e1990054a60fd8f19dcd31c14837201b0246dd96b4d8a57`), `count` and 59 entries; completeness and stable IDs.
- `proto_prob/data/fixtures/*.json`, each complete record and independently hashed in the instance registry; candidate tag, serial, category/status, location, and unresolved questions.
- `proto_prob/schemas/fixture.schema.json` (`5faff52f55bed91943ca032d655a4b0491437b2445148917229bc66fca53ff17`), complete record contract.
- `proto_prob/data/global/fixture-types.json` (`c9fa23bbda2b94acfcdd04b82e61373d8efbd3ec86be303ad5cd8ccef483d113`), all nine type/mode candidates.
- `docs/inventory_reference.md` (`20380ccad4db027357e1aaefd26701bc9697f451d18131b7933b6d18492786d8`), fixture inventory, channel maps, and verification cautions; `docs/rig.md` (`af32084d9b27d8d9f8b1cff0b4a47141a6fe5bbe5cba0de76e39fe212149141c`) only as a secondary digest.
- Vendor PDFs: COLORstrip Mini `0cccae10...31f4`, Freedom Par/Strip Mini RGBA `7b6f8baf...1231b7`, and ZQ01082 `2c4f841d...2c175`; entire binary files were hashed, while claim extraction was withheld. The paired manual JSON files and `docs/ssot/master_index.json` were used only for identity/discovery metadata.

## Decisions, rejected alternatives, and blockers

- Preserved prototype `status: active` only as `source_status_candidate`; rejected treating it as controlled operational readiness.
- Preserved asset tags and estimated positions as candidates; rejected inferring serials or physical verification.
- Rejected treating PDF filenames or metadata companions as fully verified revisions/applicability. The Freedom manual's `Rev4` filename is explicitly only a filename-derived candidate.
- Rejected importing channel ranges/defaults from unlocated recollection or selecting a working/avoided mode. These require a page-located applicable manual plus physical verification.
- Controlled human approval, physical inventory/label inspection, vendor revision/model applicability, manual claim extraction, bench testing, maintenance/safety evidence, and active patch/configuration decisions remain blockers to promotion—not blockers to this review-ready extraction.

## Validation record and limitations

- `python3 extract/scripts/validate_compendium.py` — passed structural, manifest, hash, cross-link, 59-instance, three-manual, nine-family mode, and fail-closed invariants; warned that `jsonschema` is unavailable.
- JSON parse loop across `extract/compendium/**/*.json` — required final check.
- `git diff --check`, state audit, stale-handoff search, and touched-diff review — required final checks before commit.
- Environment limitation: `pdfinfo` and `pdftotext` are unavailable. No claim was promoted in their absence.

## Final audit and next work

Final live state is Section `90` `R24`, `00` `R13`, `01` `R12`, `02` `R14`, `03` `R4/S25`; repository `R67/S142`; all `W/C/B/A/G/X/!` counts zero. Review-ready is not approved or generated canon. The first unfinished leaf is `03_technical_systems_and_stage/coordinate_system.json`; the root boot queues coordinate authority, pavilion geometry, and stage geometry in dependency order.
