# `/center` Scaffold Inventory

Purpose: This document inventories the new centralized owner-management scaffold so future sessions can see which placeholder files exist, why each file exists, and which modules/components are expected before implementation deepens.

Planned contents and components:

- App entry: `index.php` front controller.
- Config: `config/app.php` runtime-safe settings and source paths.
- Data contracts: `data/navigation.php` and `data/schema.php` until settings-backed registries are wired.
- Includes: bootstrap, functions, settings loader, SSOT loader, and records normalizer.
- Partials: header, sidebar, topbar, footer, components, forms, and tables.
- Pages: owner modules for dashboard, settings inventory, SSOT library, records, record detail, timeline, cue staging, assets, media, rights/safety, tasks, CMS drafts, marketing, operator outputs, system map, and integrity.
- Runtime folders: overlays, uploads, exports, and cache are placeholders only and need security/audit design before production use.


## Immediate scaffold expansion targets

The inception pass should add richer scaffolding before feature implementation deepens:

- Action layer: priority board, today/next actions, owner decision log, recovery bin, and movement metadata rules.
- Governance layer: public-release gates, provenance ledger, canon sync policy, rights/safety evidence checklists, and launch-blocker severity levels.
- Planning layer: contacts/booking, rehearsal/prep, output templates, venue/event instances, commerce/ticketing placeholders, and performance metrics placeholders.
- Data layer: typed relationship edges, audit placeholders, manifest/index path checks, stale app-local SSOT detection, and future overlay/database migration notes.

See `center/docs/center_scaffolding_inception_expansion_report.md` for module-by-module instructions.


## Fresh-session boot prompt

Use `docs/prompts/center_first_full_scaffolding_fresh_expert_coding_prompt.md` to boot the next expert coding session that will build the first full `/center` scaffolding pass. That primer ties this inventory, the inception expansion report, the SSOT settings layer, previous owner renditions, public prototype, and required validation checks into one actionable handoff.
