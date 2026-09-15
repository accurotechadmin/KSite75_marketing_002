# Website-editing pipeline M0-M2 foundations

Date: 2026-08-18. Branch: `work`. Starting commit: `eed0413`. Timeline: `GEN`.
Starting tree: clean. Remote/upstream: absent. Final state: review-ready, not
approved, released, deployed, or proved.

## Audit and milestone transition

The verified active application is `proto/`, document root `proto/public/`.
Authority is layered: domain Markdown authorities and controlled companions;
website canon; derived runtime tokens/sections; implementation; mutable runtime;
review/release records; and history. Prototype observations and scaffold leaves
were not promoted. M0, M1, and the M2 foundation moved from `not_started` to
`review_ready`. M3-M8 remain `not_started`.

The live compendium manifest contains 209 leaves (`R73/S136`), contrary to the
prompt's older prose that implied Section 03 remained entirely scaffold. No leaf
was changed. `/center` remains read-mostly and no approval was inferred.

## Artifacts and sources

Created `docs/website_pipeline/current_state_report.md`, a deterministic inventory
and graph, their README, build/validation scripts, an orchestrator, and validator
tests. Inputs were live route entrypoints, shared app loaders, website documents,
settings, center release contracts, validators, public assets, storage/database
contracts, and the pipeline boot. SHA-256 is calculated over recorded source
bytes by `scripts/build_website_pipeline_inventory.py`; locators are repository-
relative paths. Public runtime behavior and files were intentionally untouched.

The inventory excludes configuration values, submissions, mail diagnostics,
layer state, contacts, and restricted operational data. Rights, affiliation,
privacy, safety, accessibility, and technical-disclosure gates remain fail-closed.
No screenshot was required because no perceptible application change occurred.

## Decisions, limits, and reconciliation

A generated inventory was chosen over manually maintained hashes. Generation is
explicit and separate from the read-only validator. Shared dependencies are
modeled once and linked from routes. Per-token/fact, rights, approval, release,
and history gaps are machine-readable rather than guessed. Negative temporary
fixtures cover duplicate IDs, missing paths, private/runtime inclusion, broken
references, and cycles without committing sensitive fixtures.

All changed files belong to the M0-M2 impact set: pipeline records, generator,
validators, fixtures, rolling handoff, and this log. No public route, content,
asset, form, CSS, JS, compendium leaf, center runtime, or runtime record changed.
Browser/HTTP, accessibility, database, mail, network, deployment, backup, and
rollback behavior remain unproved. Optional `jsonschema` is unavailable.

## Commands and results

Boot audit, compendium validation, center validation, and PHP lint passed. The
inventory generator wrote 54 records, 19 routes, 73 graph nodes, and 122 edges.
Pipeline validation and all positive/negative fixtures passed. Final commands
and their results are recorded in the commit report and unified validator output.

Next unfinished milestone: M3 deterministic preview and regression harness. The
rolling queue in `website_editing_pipeline_boot.md` now covers HTTP smoke, browser
capability/preview contracts, and affected/unaffected evidence.
