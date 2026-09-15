# Center Horizontal Scaffolding Open Inquiry Answers

Purpose: Provide best-guess answers and alternative suggestions for every open inquiry in `center/docs/center_horizontal_scaffolding_open_inquiries.md`, based on the repository ethos, canon documents, and the center horizontal scaffolding prompt.

Status: Draft recommendation set for owner review. These answers are intentionally opinionated but still reviewable. Each bracketed item is a discrete answer candidate that can be accepted, modified, or rejected.

## OI-001 — What is the intended production target for `/center` after scaffolding?

[Best answer 1: Treat `/center` as the production-intended owner command center that starts as vanilla PHP and evolves in place. Keep the current PHP/HTML/CSS/JS architecture, but make every data contract adapter-ready so PHP arrays can later be backed by JSON overlays, SQLite/MySQL, or an API without changing module vocabulary.]

[Best answer 2: The first instantiation should be a durable read-mostly owner app, not a throwaway prototype. It should prioritize governance, source visibility, decision support, readiness, and safe handoff packages before runtime writes.]

[Best answer 3: The production direction should be database-capable PHP, but not database-dependent yet. The scaffold should name future persistence boundaries clearly while leaving storage inactive until auth, audit, backups, rollback, and permissions are designed.]

[Alternative 1: If deployment simplicity is the overriding priority, `/center` can remain a static-ish PHP control room with generated exports and manual repo updates rather than a live database-backed application.]

[Alternative 2: If long-term multi-user workflows become central, `/center` should eventually migrate behind a small authenticated API while preserving the current pages as the owner-facing UI layer.]

[Alternative 3: If public-site editing becomes the main value, `/center` should become a private CMS adapter for `proto/` rather than a broad production command center.]

## OI-002 — What level of owner interactivity should the first instantiation expose?

[Best answer 1: Show disabled action controls and read-only action checklists, but label them unmistakably as prototype-only. This best communicates future workflow intent without pretending persistence exists.]

[Best answer 2: Use owner action panels, status pills, and next-action fields as the primary interaction model for now. Avoid active forms except harmless filters/search that do not write data.]

[Best answer 3: Any button that implies save, approve, publish, upload, delete, import, export, or notify should be disabled and paired with a requirement note naming auth, audit, permissions, backups, rollback, and persistence.]

[Alternative 1: Omit buttons entirely and use only tables/cards until the persistence architecture is approved, minimizing confusion.]

[Alternative 2: Allow browser-only UI interactions such as sorting, filtering, expanding details, and copying source paths because they do not mutate project records.]

[Alternative 3: Create mock form layouts in documentation rather than rendered pages if the owner prefers the app surface to stay strictly read-only.]

## OI-003 — Which module set is mandatory for the first owner-facing site?

[Best answer 1: Required first-instantiation modules should be Dashboard, Priority Board, Decision Log, Release Gates, Provenance Ledger, Settings Inventory, SSOT Library, Records, Record Detail, Timeline Registry, Cue Staging, Asset Inventory, Rights & Safety, Tasks / Launch, Website CMS Drafts, Operator Outputs, System Map, and Integrity Checks.]

[Best answer 2: Booking / Contacts, Rehearsal / Prep, Media Intake, and Marketing Planner should remain visible placeholders with strong contracts because they are important, but their real workflows depend on privacy, uploads, content review, and campaign decisions.]

[Best answer 3: No listed module should be removed yet. The current instruction set favors full-surface horizontal refinement, so every module should stay in navigation unless it lacks a matching template or creates a privacy/security risk.]

[Alternative 1: Hide Booking / Contacts and Media Intake until auth/privacy/upload policy exists, while keeping their contracts in data/docs.]

[Alternative 2: Collapse some retained modules into grouped dashboards for the first instantiation, then split them out later when real records exist.]

[Alternative 3: Make Dashboard, Priority Board, Release Gates, Provenance Ledger, and Integrity the only first-class modules, with all other pages accessible through System Map until populated.]

## OI-004 — Should `/center` govern `proto/` directly or only track readiness?

[Best answer 1: `/center` should govern `proto/` through readiness tracking and release-package metadata first, not direct writes. It should know which `proto/` routes, language tokens, assets, and CTAs are affected, but public changes should remain manual until publishing controls exist.]

[Best answer 2: The owner site should eventually produce a reviewed export/handoff package for `proto/`, including source records, gate states, public-safe copy, asset references, and unresolved blockers.]

[Best answer 3: `/center` should never bypass gates. Even when direct public-site updates are added later, they should require explicit approval state, reviewer identity, audit log, rollback, and preview review.]

[Alternative 1: If speed matters more than strict separation, add a future one-way token export from approved center records to `proto/docs/language.json`, but keep it disabled until auth/audit exists.]

[Alternative 2: If `proto/` will be replaced, track public outputs abstractly by route and content token rather than by file path.]

[Alternative 3: If the public site remains manually edited, `/center` can be a checklist-only command layer with no export ambitions.]

## OI-005 — What is the authoritative definition of `public-ready` versus `show-ready`?

[Best answer 1: `public-ready` means content can be shown to audiences, buyers, press, or public web visitors after rights, affiliation, copy, media, privacy, accessibility, and public technical-disclosure gates are clear.]

[Best answer 2: `show-ready` means an internal production item is ready for rehearsal/performance use after safety, venue, technical, operator, fallback, timing, asset, and performer-readiness checks are clear. It does not automatically mean public-disclosable.]

[Best answer 3: `approved_internal` should mean owner/team use is permitted; `approved_public` should mean external publishing is permitted. A record can be approved_internal but blocked_public.]

[Alternative 1: Use four explicit statuses: `draft`, `internal-ready`, `venue-ready`, and `public-ready`, with `show-ready` as a separate checklist result rather than a content status.]

[Alternative 2: Replace `show-ready` with `performance-ready` to avoid ambiguity with public show marketing.]

[Alternative 3: Treat `public-ready` as page/output-level only, not record-level, so individual records feed gate decisions but outputs receive final approval.]

## OI-006 — Who are the owner roles and reviewer roles?

[Best answer 1: Use a stable first role set: Owner, Performer, Admin Maintainer, Show-Control Reviewer, Safety Reviewer, Rights/Brand Reviewer, Public Copy Reviewer, Media Reviewer, Booking Lead, Marketing Lead, Venue Readiness Reviewer, and Operator/Runbook Reviewer.]

[Best answer 2: Until real users exist, store roles as responsibility labels rather than account permissions. The scaffold should say role names are placeholders for future permission groups.]

[Best answer 3: Every approval-like field should store `reviewer_role` now and reserve `reviewer_user`, `reviewed_at`, and `review_evidence` for the future audited system.]

[Alternative 1: Collapse roles into three groups for the first instantiation: Owner/Admin, Creative/Public Review, and Technical/Safety Review.]

[Alternative 2: Use module-specific owner roles only, avoiding formal permission-group language until authentication is designed.]

[Alternative 3: Add a future `roles.php` seed so role vocabulary can be governed centrally instead of repeated in each module.]

## OI-007 — What should happen to contradictory source facts?

[Best answer 1: Contradictions should become Integrity findings and Decision Log entries. Do not silently choose a truth when two authoritative sources conflict.]

[Best answer 2: The hierarchy should be: human-readable canon source first, paired SSOT JSON second, `/center` PHP seeds third, previous rendition copies fourth, generated outputs last. If JSON conflicts with its human source, mark JSON out of sync.]

[Best answer 3: If a conflict affects public claims, safety, rights, dates, contacts, approvals, cue details, or technical limits, treat it as blocking until owner review.]

[Alternative 1: Prefer newest modified source only for low-risk wording and labels, but never for legal/safety/event facts.]

[Alternative 2: Allow `/center` to display both conflicting values with source provenance and a recommended resolution path.]

[Alternative 3: Create a dedicated `source_conflicts_seed.php` later if conflicts become numerous enough to deserve their own module contract.]

## OI-008 — What exact field name should be canonical for Timeline/GEN classification?

[Best answer 1: Make `timeline_moment_id_or_gen` the canonical data field because it describes the rule precisely and matches SSOT direction. Use `classification` only as a UI/display alias or broad grouping label.]

[Best answer 2: In every future schema, require `timeline_moment_id_or_gen`; if legacy seeds contain `classification`, normalize it into `timeline_moment_id_or_gen` at load time.]

[Best answer 3: Use `classification_label` only when a human-readable phrase is needed, such as `General / not timeline-specific`, while the stored value remains `GEN` or a governed Timeline Moment ID.]

[Alternative 1: Keep both fields where `timeline_moment_id_or_gen` stores `GEN` or `SONG-001`, and `classification` stores `timeline-specific`, `general`, or `pending-review`.]

[Alternative 2: Rename the canonical field to `timeline_scope` for shorter UI labels, but map it back to `timeline_moment_id_or_gen` in exports.]

[Alternative 3: Add a helper that accepts both fields for scaffold tolerance but emits warnings when both are present and disagree.]

## OI-009 — Should `GEN-PENDING-REVIEW` be an allowed value?

[Best answer 1: Allow `GEN-PENDING-REVIEW` only as a temporary scaffold/migration value for records imported from ambiguous sources. It must never be considered public-ready or show-ready.]

[Best answer 2: Integrity checks should warn on `GEN-PENDING-REVIEW`, not fail hard, unless the record is marked approved, exported, or public/show-ready.]

[Best answer 3: Any `GEN-PENDING-REVIEW` record should carry `next_action`, `source_files`, `review_gate`, and `owner_role` so it can be resolved to `GEN` or a Timeline Moment ID.]

[Alternative 1: Reject `GEN-PENDING-REVIEW` entirely and use `GEN` plus `status: needs_timeline_review` instead.]

[Alternative 2: Use `PENDING-TIMELINE` as a clearer non-GEN placeholder, but keep it blocked from release.]

[Alternative 3: Permit `UNKNOWN` for imported data only, then require immediate conversion during normalization.]

## OI-010 — What is the cue migration policy from `docs/cue.txt`?

[Best answer 1: Use `docs/cue.txt` as summary/provenance input only in the first instantiation. Do not bulk-promote cue rows into show-ready records.]

[Best answer 2: Cue Staging may display provisional private records derived from the cue draft if each is visibly marked draft, internal-only, not show-ready, and pending Timeline/GEN review.]

[Best answer 3: Only reviewed cue rows should become Timeline Registry records. The default path should be manual reviewed migration, not automatic bulk import.]

[Alternative 1: Defer all cue migration until a dedicated Cue Bible pass can handle timing, safety, fallback states, performer actions, and venue constraints.]

[Alternative 2: Create a separate `cue_draft_overlay` data shape that never mixes with canonical Timeline records.]

[Alternative 3: Import only set/song titles and high-level sequence, excluding cue timings, emergency states, and safety-sensitive operator detail.]

## OI-011 — How much technical show-control detail may appear in owner pages?

[Best answer 1: Owner pages may show private technical summaries, source links, fixture families, safety gates, and operator-output placeholders, but detailed cue timings, emergency mechanics, and venue-dependent instructions should be marked internal and excluded from public exports.]

[Best answer 2: Use disclosure tiers: `public-safe`, `venue-shareable`, `owner-private`, `operator-private`, and `safety-sensitive`. Every technical record should carry one tier.]

[Best answer 3: Operator Outputs should default to internal/private and require explicit gate clearance before producing a venue-facing or public-facing derivative.]

[Alternative 1: Keep all technical details out of rendered pages until authentication exists, showing only counts and source references.]

[Alternative 2: Render detailed technical information only in local development mode and hide it in deployed mode.]

[Alternative 3: Split technical content into Rig Summary, Operator Private, and Public Technical Summary modules later.]

## OI-012 — What should booking/contact data store before privacy approval?

[Best answer 1: Before privacy/auth approval, store only placeholder contact roles, organization categories, inquiry sources, packet readiness, follow-up statuses, and public-safe summaries. Do not store real names, emails, phone numbers, addresses, private pricing, or private notes.]

[Best answer 2: Use fields like `name_placeholder`, `organization_placeholder`, `contact_type`, `next_action`, and `public_private_boundary` until real contact storage is approved.]

[Best answer 3: Any future contact record containing personal data must require private deployment, authentication, access control, audit logging, backups, retention rules, and deletion/rollback policy.]

[Alternative 1: Store real organization names only if they are already public and non-sensitive, but still omit individual contact data.]

[Alternative 2: Keep contact workflow entirely outside the repository until a production private database exists.]

[Alternative 3: Use anonymized contact IDs and an external owner-held contact sheet until secure storage is implemented.]

## OI-013 — What are the first release gate families and required evidence fields?

[Best answer 1: Keep the first gate families as rights, safety, privacy, venue, accessibility, copy, media, technical disclosure, and brand affiliation.]

[Best answer 2: Each gate should require `gate_family`, `gate_state`, `reviewer_role`, `evidence_needed`, `evidence_source_files`, `blocking_reason`, `next_action`, `last_reviewed`, and `public_private_boundary`.]

[Best answer 3: Public release should be blocked when any relevant gate is `blocked`, `needs_review`, or `conditional` without a stated condition and owner approval path.]

[Alternative 1: Add separate gates for finance/pricing and sponsor/partner claims if booking materials start making commercial promises.]

[Alternative 2: Use a generic evidence object now and specialize evidence per gate family later.]

[Alternative 3: Represent gates at output level first, then inherit unresolved record-level gates into each page/export.]

## OI-014 — Should settings files drive navigation labels and route metadata now?

[Best answer 1: Keep navigation in app-local PHP for now, but add metadata fields that point toward settings-backed labels, routes, CTAs, and vocabulary. Do not generate routes from settings yet.]

[Best answer 2: Treat `docs/ssot/settings_manifest.json` as discovery truth for settings inventory and future configurability, while `center/data/navigation.php` remains the scaffold router registry.]

[Best answer 3: Avoid duplicating settings-backed facts where a loader can display them directly. Navigation labels may be stable app UI labels; content labels, CTAs, style guidance, and option sets should come from settings where available.]

[Alternative 1: Add a future `module_contracts.php` that references settings documents by ID and bridges navigation to settings without generating one from the other.]

[Alternative 2: Generate a read-only route proposal page from settings, but keep actual routing hand-authored.]

[Alternative 3: If settings become robust enough, move route metadata into settings and make PHP navigation a cache/generated artifact later.]

## OI-015 — What should count as a canonical source in the provenance ledger?

[Best answer 1: Human-readable repository canon documents are canonical for narrative/planning truth; paired `docs/ssot/*.json` files are machine-readable canonical companions only when synced to those documents.]

[Best answer 2: `docs/ssot/settings_manifest.json` is canonical for settings discovery, and `docs/ssot/settings/*.json` are canonical starter contracts for configurable labels, option sets, vocabulary, routes, style guidance, brand stories, technical disclosure rules, integrations, and developer workflow.]

[Best answer 3: `/center/data/*.php` is prototype-only app seed/contract data, not canonical production truth. Prior renditions are reference patterns. Generated outputs are derived and must show source provenance.]

[Alternative 1: Treat SSOT JSON as the canonical application input layer, but require linked human-readable canon for disputed facts.]

[Alternative 2: Add provenance levels: `source canon`, `machine companion`, `settings contract`, `app seed`, `owner overlay`, `generated output`, `archived reference`.]

[Alternative 3: If the owner site becomes primary later, owner-approved overlays can become canonical operational truth while historical docs remain source provenance.]

## OI-016 — Should earlier owner renditions remain reference-only forever?

[Best answer 1: Prior renditions should remain reference-only until their useful patterns are deliberately migrated into `/center`; they should not be forked or maintained as competing truths.]

[Best answer 2: Borrow concrete patterns from earlier renditions, especially record cards, source drilldowns, JSON library views, integrity checks, run-book outputs, owner-first navigation, and black/chrome/fire visual language.]

[Best answer 3: Once `/center` becomes clearly superior, earlier renditions should be documented as archives/reference implementations rather than active deploy targets.]

[Alternative 1: Keep `thirdrendition/` as a production-reference fallback until `/center` reaches feature parity.]

[Alternative 2: Preserve all renditions indefinitely as design studies, but exclude them from production route and data authority.]

[Alternative 3: Create a migration checklist that maps each retained prior-rendition feature to the `/center` module that absorbs it.]

## OI-017 — What visual style should be locked for `/center` versus public `proto/`?

[Best answer 1: `/center` should use practical admin UX with theatrical accents: black-first, chrome-edged, fire-lit highlights, strong contrast, and arena-command tone without sacrificing readability.]

[Best answer 2: Public `proto/` can be more mythic, fan-facing, and spectacle-driven; private `/center` should be denser, clearer, and governance-first.]

[Best answer 3: Use the visual style to reinforce hierarchy: warnings and release gates should feel serious and unmistakable, while decorative effects should stay minimal and non-blocking.]

[Alternative 1: Make `/center` full arena-command style if the owner wants the private tool to feel like mission control.]

[Alternative 2: Keep `/center` almost neutral/admin-like and reserve theatrical styling for public pages and marketing previews.]

[Alternative 3: Offer a future theme toggle between `Command`, `Plain Admin`, and `Print/Export` modes.]

## OI-018 — What accessibility bar applies to scaffold UI?

[Best answer 1: Use WCAG 2.2 AA-inspired internal scaffolding as the default bar: strong contrast, keyboard-visible focus, semantic headings, descriptive links/buttons, table headers, reduced ambiguity in color-only statuses, and readable mobile layouts.]

[Best answer 2: Public-facing outputs should aim for at least the same accessibility baseline before public release, with accessibility included as a formal gate family.]

[Best answer 3: The scaffold should include accessible components now, even before production, because retrofitting accessibility later would create avoidable churn.]

[Alternative 1: Add an Accessibility Checklist module or integrity check later if public outputs become numerous.]

[Alternative 2: Keep accessibility guidance in docs only until the component system stabilizes.]

[Alternative 3: Add print/export accessibility notes for operator outputs and venue summaries.]

## OI-019 — What retention/backup policy should storage placeholders anticipate?

[Best answer 1: Use conservative placeholder language: no production runtime storage until deployment architecture, private hosting, backups, retention, rollback, permissions, audit logs, and deletion rules are approved.]

[Best answer 2: Future storage categories should be separated: overlays are backed up and versioned; uploads are private and scanned/reviewed; exports are timestamped and revocable; cache is disposable and invalidatable.]

[Best answer 3: No secrets, credentials, private contacts, approvals, or sensitive files should be committed to repo storage folders.]

[Alternative 1: Default retention can remain `TBD until deployment architecture is selected` across all storage docs.]

[Alternative 2: Use short cache retention, medium export retention, and long overlay retention once production storage exists.]

[Alternative 3: Externalize backups entirely to hosting/deployment infrastructure and keep repo docs as policy references only.]

## OI-020 — Should the repository include validation scripts or only one-line commands?

[Best answer 1: Start with one-line validation commands and inline PHP checks, because the repo is intentionally lightweight and vanilla.]

[Best answer 2: Add reusable scripts only when a check is repeated across multiple sessions or becomes too long/error-prone for a prompt.]

[Best answer 3: If scripts are added, put them under `center/scripts/` or `scripts/` with no external dependencies and document their exact purpose.]

[Alternative 1: Create a single `center/scripts/validate.php` later that checks PHP syntax, navigation templates, SSOT paths, Timeline/GEN fields, and release gate consistency.]

[Alternative 2: Keep all validation in documentation so the application surface stays minimal.]

[Alternative 3: Add CI-style checks only after the repository has stable production expectations.]

## OI-021 — Where should the required horizontal refinement report sit in the review flow?

[Best answer 1: Treat `center/docs/horizontal_scaffolding_refinement_report.md` as an implementation pass report: what changed, why it stayed horizontal, what was preserved, what remains placeholder-only, and recommended next pass.]

[Best answer 2: Keep durable policies in separate policy docs; do not let the report become the canonical policy source except as a changelog/handoff summary.]

[Best answer 3: Future passes should append dated sections or create dated reports only if the single report becomes too long.]

[Alternative 1: Create `center/docs/reports/` later if reports become numerous.]

[Alternative 2: Keep one living report that is updated each pass, with a top summary and change history.]

[Alternative 3: Convert accepted report conclusions into checklist/policy docs after owner review.]

## OI-022 — What should happen when an open inquiry blocks implementation?

[Best answer 1: Use inquiry severity levels: `blocking`, `safe placeholder allowed`, and `future-pass only`. Only blocking inquiries should stop implementation.]

[Best answer 2: If unanswered, proceed with conservative scaffolding only when the prompt already supplies a safe boundary: read-only, prototype-only, no public publishing, no private data, no invented facts, and no runtime writes.]

[Best answer 3: When a question affects rights, safety, private data, approvals, show-control detail, public claims, or production storage, default to blocked or internal-only until owner review.]

[Alternative 1: Add an `open_inquiry_ids` field to module contracts and seed records so pages can display which unresolved questions affect them.]

[Alternative 2: Maintain an owner-facing inquiry board in Priority Board or Decision Log later, rather than a static Markdown list.]

[Alternative 3: Allow build work to continue behind visible warnings, but require inquiry resolution before any public-ready or show-ready status can be assigned.]
