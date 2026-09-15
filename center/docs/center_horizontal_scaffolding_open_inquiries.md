# Center Horizontal Scaffolding Open Inquiries

Purpose: Capture unresolved questions, collisions, and production-direction choices discovered while evaluating `docs/prompts/center_horizontal_scaffolding_refinement_fresh_expert_coding_prompt.md` before executing the next `/center` horizontal refinement pass.

Status: Owner review needed. This document does **not** resolve the questions below; it preserves them so the first production-leaning owner-site instantiation can be built with explicit direction instead of inferred certainty.

Source prompt reviewed: `docs/prompts/center_horizontal_scaffolding_refinement_fresh_expert_coding_prompt.md`.

## Review method

Each inquiry below is included only where the prompt implies a production-facing decision, unresolved boundary, or possible collision. Clear instructions that require no owner decision were left out.

## Open inquiries

### OI-001 — What is the intended production target for `/center` after scaffolding?

- **Prompt area:** Mission describes a horizontal scaffold refinement pass, while later language says the scaffold should determine the direction of the full centralized owner-management website.
- **Unresolved issue:** Should `/center` remain a long-lived vanilla PHP owner app that gradually gains persistence, or is it a disposable prototype whose contracts later migrate into a separate production stack?
- **Why it matters:** This affects file naming, adapter design, storage docs, route contracts, and whether future data models should optimize for PHP arrays, JSON overlays, a database, or a CMS/API boundary.
- **Owner decision needed:** Choose the expected production path: `vanilla PHP evolves`, `prototype only`, `database-backed PHP`, `headless CMS/API`, or another target.

### OI-002 — What level of owner interactivity should the first instantiation expose?

- **Prompt area:** The prompt forbids CRUD, uploads, auth, database work, publishing, and complete workflows, but asks for owner actions, future overlays, disabled controls, and adapter-ready paths.
- **Unresolved issue:** Should the next pass render only text/metadata, or should it include disabled forms/buttons that demonstrate future interactions?
- **Why it matters:** Disabled controls are useful for direction, but they can imply functionality or confuse reviewers if the app is not yet interactive.
- **Owner decision needed:** Decide whether prototype UI should show disabled action controls, read-only action checklists, or no controls until auth/persistence are approved.

### OI-003 — Which module set is mandatory for the first owner-facing site?

- **Prompt area:** The prompt lists major first-pass pages and retained modules, but also says not every suggested addition is required.
- **Unresolved issue:** It is not explicit which modules must be considered part of the first owner-facing minimum viable command center.
- **Why it matters:** Navigation, dashboard priority, module contracts, acceptance checks, and route smoke tests depend on whether every listed module is first-class or some are future placeholders.
- **Owner decision needed:** Mark modules as `required for first instantiation`, `visible placeholder`, `hidden until later`, or `remove/defer`.

### OI-004 — Should `/center` govern `proto/` directly or only track readiness?

- **Prompt area:** `/center` should govern `proto/` as the public output target, but public publishing behavior is forbidden.
- **Unresolved issue:** Should `/center` eventually write/update public-site language tokens and assets, or only report gate status and export handoff packages?
- **Why it matters:** This determines whether CMS draft records need one-way export fields, bidirectional sync metadata, token references, or manual release-package workflow.
- **Owner decision needed:** Choose the eventual relationship: `readiness tracker only`, `manual export package`, `writes to proto language/assets`, or `separate public CMS adapter`.

### OI-005 — What is the authoritative definition of `public-ready` versus `show-ready`?

- **Prompt area:** The prompt mentions public-ready, show-ready, release gates, cue promotion, and internal mechanics.
- **Unresolved issue:** The exact difference between public-facing approval and live-production/show-control approval is implied but not fully formalized.
- **Why it matters:** Records may be safe for public copy but not show-ready, or show-ready internally but not public-disclosable.
- **Owner decision needed:** Approve definitions and required gate families for `public-ready`, `show-ready`, `approved_internal`, and `approved_public`.

### OI-006 — Who are the owner roles and reviewer roles?

- **Prompt area:** Seeds should include `owner_role`, review gates, approval placeholders, and future permissions.
- **Unresolved issue:** The role vocabulary is not finalized.
- **Why it matters:** Permissions, workflow lanes, reviewer placeholders, and audit fields should use stable role names rather than ad hoc labels.
- **Owner decision needed:** Define role names such as owner, performer, show-control reviewer, safety reviewer, rights reviewer, booking lead, marketing lead, venue contact reviewer, and admin.

### OI-007 — What should happen to contradictory source facts?

- **Prompt area:** The prompt says to resolve collisions/conflicts and not invent certainty, while the repository has canonical docs, SSOT JSON, app-local seeds, and earlier renditions.
- **Unresolved issue:** The escalation path for conflicts is not fully specified when two sources appear authoritative in different ways.
- **Why it matters:** A future integrity page needs deterministic severity, ownership, and recommended action rules.
- **Owner decision needed:** Define a conflict workflow: block implementation, create open inquiry, trust human-readable canon over JSON, trust newest source, or require owner adjudication.

### OI-008 — What exact field name should be canonical for Timeline/GEN classification?

- **Prompt area:** The prompt references both `classification` and `timeline_moment_id_or_gen`.
- **Unresolved issue:** Both field names appear useful but could create translation glue later.
- **Why it matters:** Data seeds, normalized records, tables, filters, integrity checks, exports, and future database columns need a stable canonical field.
- **Owner decision needed:** Choose whether `timeline_moment_id_or_gen` is canonical with `classification` as a display alias, or whether both fields remain distinct with defined meanings.

### OI-009 — Should `GEN-PENDING-REVIEW` be an allowed value?

- **Prompt area:** The prompt requires Timeline IDs or `GEN`, while current scaffold language also references `GEN-PENDING-REVIEW` in places.
- **Unresolved issue:** `GEN-PENDING-REVIEW` is useful for migrations but may conflict with strict Timeline/GEN discipline.
- **Why it matters:** Integrity validation either needs to allow this transitional value or flag it as invalid.
- **Owner decision needed:** Approve or reject `GEN-PENDING-REVIEW` as a temporary scaffold-only classification.

### OI-010 — What is the cue migration policy from `docs/cue.txt`?

- **Prompt area:** `docs/cue.txt` is internal draft until migrated, reviewed, and promoted.
- **Unresolved issue:** The prompt does not define whether cue rows should be imported as provisional records, summarized only, or ignored until a separate migration pass.
- **Why it matters:** Cue staging, Timeline Registry, operator outputs, rehearsal prep, and safety gates depend on how much draft cue detail can appear in `/center`.
- **Owner decision needed:** Choose `summary only`, `provisional private records`, `manual reviewed rows only`, or `defer all cue migration`.

### OI-011 — How much technical show-control detail may appear in owner pages?

- **Prompt area:** Internal production mechanics should stay private, but `/center` itself is private and needs operator outputs and technical planning.
- **Unresolved issue:** The boundary between private owner-visible mechanics and too-sensitive-to-render scaffold content is not explicit.
- **Why it matters:** Operator outputs, cue staging, rig summaries, safety warnings, and export templates may need technical detail, but those details must not leak to public output.
- **Owner decision needed:** Define owner-visible technical detail tiers: `summary`, `operator-private`, `emergency-private`, `venue-shareable`, and `public-safe`.

### OI-012 — What should booking/contact data store before privacy approval?

- **Prompt area:** Booking/contact placeholders are encouraged, but real private contacts and contact storage are forbidden until auth, privacy, audit, and backups exist.
- **Unresolved issue:** It is unclear whether non-sensitive organization names, placeholder contact roles, or outreach statuses are allowed before privacy approval.
- **Why it matters:** Booking workflows need useful structure without accidentally storing private data.
- **Owner decision needed:** Define allowed pre-auth contact fields and whether all names/emails/phone numbers must remain out of the repo.

### OI-013 — What are the first release gate families and required evidence fields?

- **Prompt area:** Gate families are listed, but evidence requirements are not fully defined.
- **Unresolved issue:** Release gates need evidence fields, reviewer roles, timestamps, source references, and blocking rules to become enforceable.
- **Why it matters:** Without evidence shape, gate rows remain descriptive instead of actionable.
- **Owner decision needed:** Define required evidence fields per gate family or approve a generic scaffold evidence contract.

### OI-014 — Should settings files drive navigation labels and route metadata now?

- **Prompt area:** `settings_manifest.json` is discovery truth, and settings-backed facts should not be hard-coded if loader/schema/seed contracts can preserve configurability.
- **Unresolved issue:** The current navigation is PHP-seeded, while settings may eventually drive route labels, CTAs, vocabulary, and architecture.
- **Why it matters:** Building module contracts in PHP may duplicate settings facts unless the relationship is explicit.
- **Owner decision needed:** Decide whether navigation remains app-local PHP for now, references settings metadata, or should be generated from settings contracts in a future pass.

### OI-015 — What should count as a canonical source in the provenance ledger?

- **Prompt area:** Canonical, derived copy, generated output, prototype-only, and draft overlay statuses are requested.
- **Unresolved issue:** The hierarchy between human-readable docs, SSOT JSON, settings JSON, app-local seeds, and earlier owner renditions needs final labels.
- **Why it matters:** Provenance pages and integrity checks need to know what can be trusted, edited, derived, or retired.
- **Owner decision needed:** Approve a provenance status matrix for each source family.

### OI-016 — Should earlier owner renditions remain reference-only forever?

- **Prompt area:** Earlier renditions should be borrowed from, not forked.
- **Unresolved issue:** It is unclear whether useful runtime features from `owner_arena_command`, `secondrendition`, or `thirdrendition` should be migrated into `/center`, left as references, or eventually removed.
- **Why it matters:** This affects duplicated code, maintenance cost, visual consistency, and the future source map.
- **Owner decision needed:** Decide whether prior renditions are permanent references, migration sources, archive candidates, or alternate deployable apps.

### OI-017 — What visual style should be locked for `/center` versus public `proto/`?

- **Prompt area:** The tone is black-first, chrome-edged, fire-lit, mythic, loud, high-contrast, and arena-scale, but `/center` is private governance software.
- **Unresolved issue:** The prompt does not define how theatrical the private owner UI should be compared with the public site.
- **Why it matters:** CSS decisions can make the command center distinctive but could reduce readability if pushed too far.
- **Owner decision needed:** Choose a private UI style target: `practical admin with theatrical accents`, `full arena-command visual identity`, or `minimal neutral admin`.

### OI-018 — What accessibility bar applies to scaffold UI?

- **Prompt area:** Accessible labels and focus states are mentioned, and accessibility is a release gate family.
- **Unresolved issue:** The target standard for internal owner UI and public outputs is not explicit.
- **Why it matters:** Component structure, color contrast, keyboard support, table markup, status pills, and warnings should be built to a known baseline.
- **Owner decision needed:** Approve a baseline such as WCAG 2.2 AA-inspired internal scaffolding, or define a different target.

### OI-019 — What retention/backup policy should storage placeholders anticipate?

- **Prompt area:** Storage docs should mention retention, backups, rollback, cache invalidation, generated output warnings, and privacy boundaries.
- **Unresolved issue:** Actual retention periods, backup scope, and rollback expectations are unspecified.
- **Why it matters:** Storage contracts should avoid overpromising while still shaping future production behavior.
- **Owner decision needed:** Define placeholder retention language or approve `TBD until deployment architecture is selected` for all runtime storage areas.

### OI-020 — Should the repository include validation scripts or only one-line commands?

- **Prompt area:** Validation scripts are allowed only if they fit the vanilla repo without dependency weight.
- **Unresolved issue:** The prompt suggests route/navigation consistency checks but does not specify whether to create reusable scripts.
- **Why it matters:** Scripts improve repeatability but add maintenance surface.
- **Owner decision needed:** Choose `inline validation commands only`, `add scripts under center/scripts`, or `add repo-level tools`.

### OI-021 — Where should the required horizontal refinement report sit in the review flow?

- **Prompt area:** The prompt requires `center/docs/horizontal_scaffolding_refinement_report.md` after implementation.
- **Unresolved issue:** It is unclear whether that report should be an implementation changelog, an owner-facing review memo, or a durable policy artifact.
- **Why it matters:** The report could become stale if treated as policy, but too shallow if only a changelog.
- **Owner decision needed:** Define the report type and whether future passes append to it or create dated pass reports.

### OI-022 — What should happen when an open inquiry blocks implementation?

- **Prompt area:** The prompt says to mark incomplete facts and recommend reconciliation, while the current user request asks for open inquiries before building.
- **Unresolved issue:** Future agents need to know whether unanswered inquiries stop work or allow safe placeholder scaffolding.
- **Why it matters:** This determines whether the next build pass can proceed with conservative defaults or must wait for owner answers.
- **Owner decision needed:** Define inquiry severity levels such as `blocking`, `safe placeholder allowed`, and `future-pass only`.

## Suggested owner response format

For each inquiry, answer with one of:

- **Decision:** final direction to implement.
- **Default allowed:** safe placeholder language may proceed until final direction exists.
- **Blocked:** do not build related scaffold until answered.
- **Defer:** leave out of the first instantiation.

## Immediate recommendation

Before the next build pass, prioritize answers for OI-001 through OI-015. The remaining inquiries can be handled as second-order refinement unless they affect an implementation area selected for the next pass.
