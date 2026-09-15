# SSOT Extraction Workspace

This directory is the isolated workspace for the planned repository-wide Single
Source of Truth (SSOT) compendium. Nothing in this directory supersedes an
existing source yet.

Start a fresh expert extraction session with [`BOOT.md`](BOOT.md). It defines the
required sequential reading order, live scaffold-versus-completion audit,
completion rules, and ANSI-style interactive menu for viewing or working on
sections, sub-sections, and individual documents.

For dependency-ordered execution, use
[`SEQUENTIAL_BUILD_BOOT.md`](SEQUENTIAL_BUILD_BOOT.md). It pairs with the full
[`ssot_compendium_sequential_build_plan.md`](ssot_compendium_sequential_build_plan.md)
and treats bare section or sub-section numbers as instructions to execute and
finish those scopes, while explicit letter commands open inspection menus.

After initial instantiation, use
[`ONGOING_BUILD_BOOT.md`](ONGOING_BUILD_BOOT.md) to start a fresh continuation
session. It verifies and reconciles the first development handoff, then executes
the dependency-ordered continuation slices, maintains a durable operational
session log, validates results, and refreshes the root boot handoff for the next
unfinished control work.

The first artifact is
[`ssot_source_inventory.md`](ssot_source_inventory.md), a verified,
SSOT-focused source inventory. It identifies the datasets that merit deeper
study, distinguishes originals from deployed copies and runtime history, and
records likely authority and extraction risks.

The second artifact is
[`ssot_compendium_document_inventory.md`](ssot_compendium_document_inventory.md),
the proposed document catalog for the future compendium. It records the major
sections, components, sub-components, intended file paths, authority boundaries,
and source families that the later scaffolding and extraction passes should use.

The generated [`compendium/`](compendium/) tree originally implemented that
catalog as 14 section folders, 209 empty document-control shells, and a README
for each section. That initial scaffold is reproducible with:

```bash
python3 extract/scripts/build_compendium_scaffold.py --clean
```

The generator reads the catalog tables rather than maintaining a second manual
file list. Rebuilding the tree never extracts source facts and never changes a
document from `draft` to `approved`.

## Current phase

**Sections 90, 00, 01, and 02 are authored for review, and Section 03 is in progress; controlled approval is pending.** The 209-leaf catalog currently contains 24 review-ready Section `90` leaves, 13 review-ready Section `00` leaves, 12 review-ready Section `01` leaves, 14 review-ready Section `02` leaves, 10 review-ready Section `03` leaves, and 136 scaffolds. No populated file is approved or generated canon. Section `03.01` equipment evidence and the coordinate/pavilion/stage/scaffold/zone/layer portion of `03.03` are complete for review without activating configuration, measured geometry, zone permissions, clearance, or structural authority; the first unfinished leaf is `03_technical_systems_and_stage/stage_plot.json`. Fresh sessions must audit live content and follow the rolling queue in the root `boot.md`.
