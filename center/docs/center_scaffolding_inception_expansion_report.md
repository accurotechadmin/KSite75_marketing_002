# Center Scaffolding Inception Expansion Report

**Purpose:** Recommend what should be added while the `/center` owner-management site is still in scaffolding, before deeper feature implementation locks in assumptions.

**Timeline classification:** `GEN` / GENERAL / NOT TIMELINE-SPECIFIC. This report concerns the project-wide owner command surface. Future records created from these recommendations must still carry either `GEN` or a governed Timeline Moment ID.

**Prepared date:** 2026-07-19

## 1. Boot posture and current preparedness

The repository is prepared for a centralized owner-management build with these starting assets already in place:

- `/center` exists as a vanilla PHP scaffold with a front controller, config, loaders, record normalizer, reusable partials, module pages, CSS/JS, and prototype-only storage folders.
- `docs/ssot/settings_manifest.json` and starter `docs/ssot/settings/*.json` files provide the beginnings of a settings-backed control layer for identity, architecture, content model, voice, visual style, stories, marketing, assets, timeline, show-control, integrations, and developer workflow.
- Existing owner-site renditions (`owner/`, `owner_arena_command/`, `secondrendition/`, and `thirdrendition/`) provide reference patterns for dashboards, record cards, source drilldowns, integrity checks, run-book outputs, and owner-first navigation.
- The public prototype in `proto/` provides a concrete public-facing content target that the owner site should eventually govern rather than duplicate manually.

The immediate scaffolding opportunity is to add enough structure that future implementation can deepen modules without rethinking naming, provenance, review gates, owner decisions, or Timeline/GEN classification.

## 2. Cross-cutting scaffolding that should be added now

### 2.1 Priority Board and Owner Decision Center

Add files:

- `center/pages/priority-board.php`
- `center/pages/decision-log.php`
- `center/data/priority_board_seed.php`
- `center/data/decision_schema.php`

Add these concepts:

- Board columns: `Notes`, `Questions`, `Now`, `Next`, `Later`, `Finished`, and `Recovery`.
- Required card fields: `record_id`, `title`, `module`, `type`, `classification`, `status`, `priority`, `owner_role`, `next_action`, `due_or_target`, `source_files`, `linked_records`, `summary`, `details`, `last_updated`.
- Movement rules: moving to `Questions` sets or suggests `needs_decision`; moving to `Now` sets or suggests `in_progress`; moving to `Finished` requires a closing note; deleting moves to `Recovery` first.
- Decision records: `decision_id`, `question`, `context`, `options`, `chosen_option`, `decision_status`, `decision_owner`, `needed_by`, `source_records`, `impact_area`, and `reversal_cost`.

Why now: the owner will need one action-first surface before modules become feature-complete. This prevents the command center from becoming only a library browser.

### 2.2 Global Source Provenance and Canon Ledger

Add files:

- `center/pages/provenance-ledger.php`
- `center/data/source_provenance_schema.php`
- `center/docs/canon_sync_policy.md`

Add these concepts:

- Source ledger rows for every human-readable source, SSOT JSON companion, settings JSON file, app-local copy, and generated overlay.
- Fields: `source_id`, `path`, `source_type`, `authority_level`, `paired_source`, `last_verified`, `sync_status`, `known_drift`, `owner_notes`, `safe_to_edit_in_ui`.
- Drift statuses: `canonical`, `derived-copy`, `needs-sync-review`, `deprecated-reference`, `prototype-only`, `generated-output`.
- UI warnings when app-local SSOT copies are older than upstream `docs/ssot` sources.

Why now: the repository already has multiple owner renditions and local SSOT copies. A provenance ledger prevents accidental edits to derived data or stale copies.

### 2.3 Rights, Safety, and Public-Release Gate Matrix

Add files:

- `center/pages/release-gates.php`
- `center/data/release_gate_matrix.php`
- `center/docs/public_release_gate_policy.md`

Add these concepts:

- Gate families: `rights`, `safety`, `privacy`, `venue`, `accessibility`, `copy`, `media`, `technical_disclosure`, `brand_affiliation`.
- Gate decisions: `blocked`, `needs_review`, `conditional`, `approved_internal`, `approved_public`, `not_applicable`.
- Required gate fields: `gate_id`, `record_id`, `gate_family`, `current_state`, `reviewer_role`, `evidence_needed`, `public_use_limit`, `expires_or_review_by`, `notes`.
- Explicit public-copy blocker for any text implying official endorsement, sponsorship, authorization, ownership, or rightsholder clearance unless written approval exists.

Why now: public-page, media, marketing, and booking modules will all need the same gate logic. Scaffolding it once prevents copy-paste policy drift.

## 3. Module-by-module scaffolding expansions

### 3.1 Dashboard

Bolster with:

1. A readiness score model with explainable component weights for show, technical, inventory, website, marketing, booking, safety, content, and launch.
2. A risk strip that groups urgent blockers by rights, safety, venue, missing source, and owner decision.
3. A “today focus” panel pulling cards from the priority board rather than hard-coded dashboard copy.

### 3.2 Settings Inventory

Bolster with:

1. A settings-file detail panel showing manifest status, domain, purpose, schema version, last updated date, and future migration notes.
2. A missing-settings candidate queue seeded from the manifest future candidates: commerce/ticketing, venue/event instances, press kit, legal-rights-safety, localization, and performance metrics.
3. A read-only/draft-overlay rule that explains which settings can be viewed, staged, or edited once authentication and audit trails exist.

### 3.3 SSOT Library

Bolster with:

1. A source-type filter for human docs, SSOT JSON, settings JSON, vendor/manual JSON, app-local copies, and generated reports.
2. Pairing indicators that show whether a Markdown source has a JSON companion and whether a JSON file is listed in the master index or settings manifest.
3. Raw-fragment preview placeholders with safe truncation, source citations, and copy-to-path helpers.

### 3.4 Universal Records

Bolster with:

1. A record-family field that distinguishes timeline moments, assets, media, website sections, marketing creatives, contacts, booking assets, tasks, decisions, gates, and outputs.
2. A relationship map contract with typed edges such as `blocks`, `depends_on`, `uses_asset`, `appears_on_page`, `derived_from`, `requires_review`, and `outputs_to`.
3. A migration-safe audit shell with `created_at`, `created_by`, `updated_at`, `updated_by`, `change_reason`, and `source_revision` placeholders.

### 3.5 Timeline Registry

Bolster with:

1. A reservation workflow for proposed IDs, including reason, source, parent moment, expected ordering, and promotion requirements.
2. A cue-readiness matrix that requires performer action, show-control action, fallback state, safety status, content status, and rehearsal status before show-ready promotion.
3. A gap report for missing transitions, costume holds, projection cues, fog/strobe review, and emergency fallbacks.

### 3.6 Cue Staging

Bolster with:

1. An import-staging model that keeps `docs/cue.txt` rows separate from approved timeline records.
2. Proposed mappings for set blocks, songs, transitions, costume changes, platform-drop notes, screen-drop notes, finale, and encore candidates.
3. Review warnings that raw song titles, era labels, and KISS-adjacent descriptors are internal until content review approves public use.

### 3.7 Asset Inventory

Bolster with:

1. Separate metadata presets for physical assets, digital assets, wardrobe/costume pieces, lighting fixtures, projection assets, documents, and marketing files.
2. Packing/location fields: `storage_location`, `case_or_bin`, `condition`, `missing_parts`, `repair_needed`, `purchase_needed`, `owner_source`, and `show_pack_required`.
3. Public-placement fields: `candidate_pages`, `allowed_channels`, `caption_status`, `alt_text_status`, `rights_status`, and `content_review_notes`.

### 3.8 Media Intake

Bolster with:

1. Intake states from upload to cataloged asset to public candidate to public approved.
2. Capture metadata: who/what/where/when, consent or source note, original filename, derivative filename, and edit status.
3. Media-use warnings for resemblance, restricted marks, outside media, album art, third-party clips, and technical disclosure.

### 3.9 Rights & Safety Queue

Bolster with:

1. Separate lanes for rights/affiliation, costume/makeup resemblance, media clearance, fog/strobe safety, venue dependency, privacy, and accessibility.
2. Evidence-needed checklists for each lane.
3. A public-release gate summary per record showing the most restrictive unresolved gate.

### 3.10 Tasks / Launch

Bolster with:

1. Task types: build, documentation, rehearsal, venue, marketing, booking, content review, safety review, asset capture, owner decision, and follow-up.
2. Blocker model: `blocked_by_record`, `blocked_by_decision`, `blocked_by_external_party`, `blocked_by_missing_fact`, `blocked_by_safety_review`, `blocked_by_rights_review`.
3. Launch milestone sets for scaffolding, owner alpha, content intake, public copy review, venue readiness, marketing launch, rehearsal readiness, and show-day readiness.

### 3.11 Website CMS Drafts

Bolster with:

1. Page-section records with CTA, SEO, media slots, source facts, disclaimer needs, and publication state.
2. A guarded publish-readiness checklist that refuses public-ready status while rights/safety/copy gates are unresolved.
3. Links to public prototype routes and language-token references so the owner site can become the command layer for `proto/` rather than a parallel copy repository.

### 3.12 Marketing Planner

Bolster with:

1. Campaign stages: awareness, interest, conversion, reminder, post-show/booking reuse.
2. Creative records by channel with format, audience, CTA, landing page, required asset, timeline/GEN classification, and review gate.
3. Tracking placeholders for UTM naming, pixel status, lead source, conversion event, budget, and performance notes, with no secrets stored in repo JSON.

### 3.13 Operator Outputs

Bolster with:

1. Output templates for run sheet, cue sheet, emergency sheet, packing list, rehearsal checklist, venue tech summary, and owner show-day checklist.
2. Export readiness fields: source records included, filters applied, generated date, intended audience, public/private level, and unresolved warnings.
3. Strict separation between internal show-control mechanics and public-safe technical summaries.

### 3.14 System Map

Bolster with:

1. A data-flow diagram inventory: docs → SSOT JSON → settings manifest → center loaders → normalized records → overlays/exports → public prototype.
2. Environment assumptions: vanilla PHP, no package build step, prototype storage placeholders, no secrets, future auth/audit/backups required.
3. App-surface comparison table for `owner/`, `owner_arena_command/`, `secondrendition/`, `thirdrendition/`, `center/`, and `proto/`.

### 3.15 Integrity Checks

Bolster with:

1. Checks for JSON validity, PHP syntax, manifest paths, master-index paths, required record fields, Timeline/GEN pattern, duplicate record IDs, stale app-local SSOT copies, broken linked files, and unsafe public-approved records.
2. Severity levels: `info`, `warning`, `blocking`, and `launch_blocker`.
3. A machine-readable findings shape so future UI can display check output consistently.

## 4. New documentation/SSOT files that should exist soon

Create these planning documents as the next documentation layer:

1. `center/docs/public_release_gate_policy.md` — owner-readable gate rules for public copy, media, safety, venue, privacy, accessibility, and technical disclosure.
2. `center/docs/canon_sync_policy.md` — rules for authoritative docs, SSOT companions, settings files, app-local copies, overlays, and generated exports.
3. `center/docs/priority_board_model.md` — board columns, card fields, movement semantics, recovery behavior, and owner decision links.
4. `center/docs/module_scaffolding_checklist.md` — per-module required scaffolding before feature implementation.
5. `center/docs/future_persistence_and_auth_plan.md` — authentication, permissions, backup, audit, drafts, overlays, and migration-to-database/API plan.

Create or graduate these settings files once the current starter files are expanded:

1. `docs/ssot/settings/legal_rights_safety.json`
2. `docs/ssot/settings/venue_event_instances.json`
3. `docs/ssot/settings/press_kit.json`
4. `docs/ssot/settings/commerce_ticketing.json`
5. `docs/ssot/settings/performance_metrics.json`
6. `docs/ssot/settings/localization.json`
7. `docs/ssot/settings/contacts_booking.json`
8. `docs/ssot/settings/priority_board.json`
9. `docs/ssot/settings/rehearsal_prep.json`
10. `docs/ssot/settings/output_templates.json`

## 5. Recommended immediate implementation order

1. Expand `center/README.md`, `center/docs/scaffold_inventory.md`, `center/data/navigation.php`, and `center/data/schema.php` so the scaffold itself documents the richer intended component contracts.
2. Add the Priority Board, Decision Log, Provenance Ledger, and Release Gates as scaffolding pages and navigation entries before deepening individual modules.
3. Add `center/docs/public_release_gate_policy.md`, `center/docs/canon_sync_policy.md`, and `center/docs/priority_board_model.md` so future code has local module-specific policy references.
4. Expand `docs/ssot/settings_manifest.json` future candidates to include priority board, contacts/booking, rehearsal prep, output templates, and legal-rights-safety as first-class candidates.
5. Add integrity checks that verify manifest paths, JSON validity, PHP syntax, Timeline/GEN classification, and public-ready gate consistency.

## 6. Definition of done for the inception scaffolding stage

The inception stage is sufficiently prepared when `/center` can show, even with placeholder data:

- a command dashboard;
- an action-first priority board;
- a decision log;
- settings and SSOT inventories;
- universal record search/detail contracts;
- timeline and cue staging contracts;
- asset and media intake contracts;
- release gate and rights/safety queue contracts;
- website, marketing, booking/contact, rehearsal/prep, and operator-output module contracts;
- system map and integrity-check contracts;
- explicit warnings that runtime storage, UI editing, uploads, and publishing are prototype-only until auth, backups, permissions, and audit trails exist.
