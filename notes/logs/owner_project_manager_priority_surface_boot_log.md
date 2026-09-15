# Owner Project Manager Priority Surface Boot Log

- Timestamp: 2026-07-19T00:00:00Z
- Repository path: `/workspace/KSite37`
- Boot objective: prepare to build a Just One KISS owner-facing project manager that starts with a priority board and grows into the full owner command surface.
- Method: read the requested canon in order, using full file reads for small/medium files and structured extraction plus targeted section reads for very large files (`proto/docs/language_map.md`, `docs/notes/language.json`, large manuals, and large prompt/note files). No requested file was silently skipped.

## Highest-authority truths

1. `docs/owner_project_manager_surface_blueprint.md` is the north-star product blueprint: one-man backstage command desk, not a generic Jira/CMS/CRM/file cabinet.
2. The central UX promise is: open the app, see what matters, drill into the right module, update the record, and leave with the next action clearer than before.
3. Every record must belong to a module and carry either a Timeline Moment ID or `GEN`; show-specific records must not float unclassified.
4. The shared record shape must include `record_id`, `title`, `module`, `type`, `classification`, `status`, `priority`, `area`, `owner_role`, `next_action`, `due_or_target`, `linked_records`, `source_files`, `summary`, `details`, and `last_updated`.
5. The global owner-manager status vocabulary is `inbox`, `not_started`, `in_progress`, `needs_decision`, `paused`, `blocked`, `ready_for_review`, `approved`, `show_ready`, `publish_ready`, `finished`, and `archived`.
6. The first usable manager surface should include Command Dashboard, Today / Next Actions, Notes Inbox and Decision Log, Timeline / Show Spine, Cue Matrix draft, Inventory / Assets, Media & Files intake, Website Manager, Marketing Manager, Docs & SSOT Library, and Reports / Exports.
7. `docs/cue.txt` is a working draft only; cue, setlist, and show-control content must be labeled proposed until migrated, reviewed, and approved.
8. Public copy, marketing assets, AI/voice/catchphrase ideas, official-KISS-adjacent styling, fog/strobe messaging, camping facts, and ticket/RSVP wording need rights/content/fact/safety review metadata before public use.

## Documents read in order

| # | Document | Status | Key truths | App implications | Seed candidates / conflicts |
|---:|---|---|---|---|---|
| 1 | `docs/owner_project_manager_surface_blueprint.md` | Read first | Defines app shell, modules, record schema, statuses, workflows, structural integrity, MVP, and success definition. | Build a fitted owner cockpit with priority board plus canonical rail modules, shared records, cross-links, inspector, and explainable counts. | Now: build priority board over canonical record shape. Questions: exact first module route/folder name. |
| 2 | `README.md` | Read | Repository identity, source-of-truth hierarchy, Timeline-vs-GENERAL rule, Interlochen July 25 2026 focus, technical baseline. | Treat README as orientation; route domain facts to specific authority docs. | Finished: master orientation exists. Conflict guard: specific docs outrank summaries for domain details. |
| 3 | `docs/knowledge.md` | Read | Concise identity, timeline family list, technical baseline, cue draft caveat, website/marketing direction, style hierarchy. | Use as onboarding summary only; do not let it override authoritative manuals/blueprints. | Now: timeline classification enforcement. |
| 4 | `docs/prompt.md` | Read | Session posture, documentation rules, public copy caution, project identity, technical and style constraints. | Preserve canon and do not invent facts; log changes and keep legacy context. | Finished: LLM operating prompt exists. |
| 5 | `docs/current_documentation_groundwork_plan.md` | Read | Current docs should be streamlined, logged, source-owned, and legacy-preserving. | Owner app should include document health/library records and not erase raw notes. | Next: Docs & SSOT Library with health/status fields. |
| 6 | `docs/mastergameplan.md` | Read via structured extraction and headings | Broad project architecture across production, marketing, sales, launch, operations, documentation, staffing, finance, and timeline-specific planning. | Owner manager must preserve distinct record types beyond tasks. | Later: reports for launch, packing, sales, ops. |
| 7 | `docs/timeline_moment_registry.md` | Read | Authoritative Timeline Moment ID families, registry fields, starter reservations, cue migration approach. | Every show record form/drop must enforce Timeline ID or `GEN`; cue import remains proposed. | Now: Timeline / Show Spine records. |
| 8 | `docs/owner_project_manager_surface_blueprint.md` | Re-read | Confirmed full module inventory, status model, structural rules, MVP, success definition. | Highest authority for app structure. | Critical-path source for seeded board. |
| 9 | `docs/website_system_plan.md` | Read | Two connected systems: private command center and public marketing site; bird's-eye-to-microscope pattern; universal fields and relationships. | Website Manager and public-copy workbench must gate output by public/private, content, and safety status. | Next: website page/section records. |
| 10 | `docs/owner_admin_build_readiness.md` | Read | Admin mission, non-negotiable product rules, universal schema, source-of-truth core modules, dashboard panels. | Use JSON overlays; cue draft import must not imply final show bible. | Now: source-of-truth core and overlay strategy. |
| 11 | `docs/owner_site_boot_plan.md` | Read | Build target, initial module order, minimum data contract, boot sequence, public spokes after owner core. | Load master_index/SSOT first and gate public outputs. | Finished: build boot plan exists. |
| 12 | `docs/prompts/full_project_fresh_expert_coding_boot_prompt.md` | Read | Fresh coding sessions must verify state, read canon, respect source hierarchy, and record changes. | Start any coding pass with repo/document state verification. | Finished: boot prompt available. |
| 13 | `docs/prompts/current_project_fresh_expert_development_boot_prompt.md` | Read | Current project boot emphasizes public prototype, owner app truths, SSOT layer, and prompt history. | Reuse current app truths; avoid stale assumptions. | Next: align app with current docs. |
| 14 | `docs/prompts/owner_site_codebase_boot_prompt.md` | Read | Owner-site readiness session reads owner-site boot/admin/timeline/technical/creative docs before coding. | Confirms owner site needs shared record schema first. | Finished. |
| 15 | `docs/prompts/owner_site_first_rendition_build_prompt.md` | Read | Earlier instruction for first owner-site rendition and new folder scaffold. | Treat as historical/prototype guidance, not current north star. | Conflict: new priority-board surface supersedes first-rendition emphasis. |
| 16 | `docs/prompts/owner_arena_command_fresh_expert_maintenance_prompt.md` | Read | Owner Arena Command maintenance focuses active prototype verification and data source rules. | Reuse proven JSON/overlay concepts. | Next: inspect active app structure. |
| 17 | `owner/README.md` | Read | Minimal scaffold with `public/`, `src/`, and `data/`; design rule says records must remain structured. | Historical scaffold; not enough for MVP alone. | Finished/reference. |
| 18 | `owner_arena_command/README.md` | Read | PHP app on port 8088; data folder stores nav/schema/status/dashboard/module blueprints; bundled SSOT seeds are not mutated; runtime JSON overlays store owner edits. | Strong persistence precedent: inspectable JSON overlays. | Now: save named board sets under server storage. |
| 19 | `secondrendition/README.md` | Read | PHP server on 8090; data folder; improved dashboard and integrity posture. | Reference concepts only. | Finished/reference. |
| 20 | `thirdrendition/README.md` | Read | PHP server on 8091; owner-facing sections; data posture. | Reference concepts only. | Finished/reference. |
| 21 | `proto/README.md` | Read | Public landing site with PHP partials, CSS/JS, progressive effects. | Public prototype informs style and language, not private app workflow. | Finished/reference. |
| 22 | `proto/docs/website_ssot.md` | Read | Active public site canon, homepage/supporting-page rules, form workflow, launch readiness. | Website Manager should expose page map/readiness and source tokens. | Next: Docs/Website Manager seeds. |
| 23 | `proto/docs/website_inventory.md` | Read | Route, section, component, form, CSS, JS, and asset inventories. | Seed Docs & SSOT Library and Website Manager with route/component records. | Finished: existing public inventory. |
| 24 | `proto/docs/routes_and_supporting_pages.md` | Read | Route/supporting page map. | Use for Website Manager page list. | Finished/reference. |
| 25 | `proto/docs/developer_editor_guide.md` | Read | Safe editing boundaries, route map, public copy/facts/rights/assets guide. | Owner app should surface public copy cautions and token links. | Now/Next: public-copy workbench. |
| 26 | `proto/docs/css_style_reference.md` | Read | Public visual tokens: dark base, chrome, fire accents, CTAs, typography, component rules. | Owner app can adapt cockpit variant without breaking public style. | Finished/reference. |
| 27 | `proto/docs/language_map.md` | Structured read | Very large language token map generated from runtime language data. | Do not hand-edit casually; owner app should link tokens and regenerate maps. | Question: language regeneration workflow confirmation. |
| 28 | `docs/inventory_reference.md` | Structured read | Authoritative DMX/QLC+ lighting inventory, patch, fixture behavior, recipes, troubleshooting. | Inventory/Assets and Cue modules must be safety-aware and patch-aware. | Now: inventory records; Questions: missing condition/storage photos. |
| 29 | `docs/rig.md` | Read | Quick rig reference, patch, programming doctrine, fast tests, operating reminders. | Useful for run-sheet/test exports; lower authority than inventory reference on conflicts. | Next: technical quick tests report. |
| 30 | `docs/cue.txt` | Read | Working set/cue draft with six set blocks and song/cue seeds; not final. | Cue Matrix imports proposed rows only. | Now: cue draft cards; conflict: no show-ready claim. |
| 31 | `docs/ssot/timeline_moment_registry.json` | Read | Machine-readable timeline registry companion. | Seed Timeline module and validation picklists. | Finished data source. |
| 32 | `docs/ssot/inventory_reference.json` | Read | Machine-readable inventory summary companion. | Seed Inventory/Docs library. | Finished data source. |
| 33 | `docs/ssot/rig.json` | Read | Machine-readable rig summary companion. | Seed Technical/Docs library. | Finished data source. |
| 34 | `docs/ssot/colorstrip_manual.json` | Read | Vendor manual companion for COLORstrip Mini. | Link fixture records to source manual. | Finished data source. |
| 35 | `docs/ssot/honeycomb_manual.json` | Read | Vendor manual companion for Honeycomb PAR fixtures. | Link fixture records to source manual. | Finished data source. |
| 36 | `docs/ssot/freedompar_manual.json` | Read | Vendor manual companion for Freedom Par RGBA. | Link fixture records to source manual. | Finished data source. |
| 37 | `docs/styleguide.md` | Read | Public creative system: black first, chrome second, fire third, mythic theatrical scale. | Owner UI tone should be backstage cockpit, not public hype page. | Finished style source. |
| 38 | `docs/brand_story_style_guide_inventory.md` | Read | Preserves brand/story/style inputs, copy/rules, rights guardrails, implementation hooks. | Marketing and Website modules need brand-token/source links. | Next: brand library cards. |
| 39 | `docs/first_run_marketing_campaign.md` | Read | Five-piece still-image funnel: Awareness, Interest, Consideration, Conversion, Retention/Nurture. | Marketing Manager should include campaign-stage records. | Now/Next seed campaign board. |
| 40 | `docs/marketing_still_image_inventory.md` | Read | Platform/placement inventory and guardrails for still-image campaigns. | Seed media/creative and marketing placement records. | Next: platform prompt inventory. |
| 41-48 | `docs/marketing_image_mockup_specs/*` | Read all files | Shared mockup data, how-to, five stage specs, Facebook production briefs. | Marketing Manager can list stage specs and asset tickets. | Finished/reference; seed campaign cards. |
| 49-54 | `docs/marketing_image_prompt_templates/*` | Read all files | Adaptable prompt contract and five stage templates with guardrails. | Prompt templates become Docs/Media records, not loose files. | Finished/reference. |
| 55-64 | `docs/marketing_image_prompts/*` | Read all platform prompt inventories | Platform-specific still-image prompts exist for Bluesky, Meta, Google, Instagram, LinkedIn, Pinterest, Snapchat, TikTok, X/Twitter, YouTube. | Marketing Manager should support platform-specific creative records. | Finished/reference. |
| 65-68 | `docs/ssot/website_system_plan.json`, `brand_story_style_guide_inventory.json`, `first_run_marketing_campaign.json`, `knowledge.json` | Read | Machine-readable companions for website, brand, campaign, and project brief. | Seed module metadata and Docs library. | Finished data sources. |
| 69 | `docs/notes/super_ssot_status_notes_tracking_app.md` | Read | Notes/status tracking canon with notes inbox, dashboard, canon comparison, task board, review queue, exports, and seed records. | Priority board should absorb this canon but map statuses to the owner-manager vocabulary. | Now: seed TRACK items. Conflict: older status set differs from manager status model. |
| 70 | `docs/notes/compiled_notes_status_report.md` | Read | Classifies raw notes as current, stale, or unknown. | Populate Notes/Questions/Finished columns with source-backed items. | Now: raw note seed import. |
| 71-82 | `docs/notes/KISS01.txt`, `KISS02.txt`, `kiss03.txt` ... `kiss12.txt` | Read all matching raw note files | Raw notes include logo/copy ideas, AI announcer/voice and video timing ideas, volume fix, black burning sun prompt, stage effects ideas, stale dot-sign prompt, catchphrases, typography/countdown tweaks, camping/BYOB facts, marketing boot report, share phrase. | Preserve raw source text, promote only as notes/questions/tasks with review metadata. | Questions: rights/safety/fact approval for many public or show-control ideas. |
| 83 | `docs/notes/language.json` | Structured read | Runtime-backed structured website language inventory; status notes say `language_map.md` may need regeneration. | Use token links; do not mutate directly via priority board. | Question: canonical update workflow. |
| 84 | `docs/ssot/master_index.json` | Read | Machine-readable index of SSOT JSON documents, source documents, categories, and policy. | Docs & SSOT Library should load this first. | Finished data source. |
| 85-93 | Remaining mapped `docs/ssot/*.json` companions (`cue`, `mastergameplan`, `owner_admin_build_readiness`, `owner_site_boot_plan`, `prompt`, `qwen_model_routing`, `readme`, `styleguide`) | Read | JSON summaries of already-read docs plus model-routing policy. | Seed source-document cards and app metadata. | Finished data sources. |

## Seed data candidates discovered

### Notes column
- Unprocessed logo placement note from `docs/notes/KISS01.txt`.
- Audio/video edit and AI announcer/Gene-style voice concept from `docs/notes/KISS02.txt`.
- Vague `volume fix` note from `docs/notes/kiss03.txt`.
- Black burning sun / supernova video prompt from `docs/notes/kiss04.txt`.
- Stage/show interaction ideas from `docs/notes/kiss05.txt`.
- Additional catchphrases from `docs/notes/kiss07.txt` and `docs/notes/kiss08.txt`.
- Typography/countdown/italic style notes from `docs/notes/kiss09.txt`.
- Earl visual reference and BYOB/camping fragments from `docs/notes/kiss10.txt`.
- Share phrase from `docs/notes/kiss12.txt`.

### Questions column
- Should the new priority surface live in a new folder or extend `owner_arena_command/`?
- Which raw notes are approved, rejected, stale, or campaign-only?
- Should `GEN-PENDING-REVIEW` be used despite the new prompt specifying `GEN` or Timeline ID only?
- Who verifies camping/electrical prices and no-ticket/RSVP wording before public use?
- What rights/safety posture should apply to AI announcer, AI Gene-style voice, catchphrases, KISS-like fonts, flames/spark waterfall, fog/strobe language, and official-KISS-adjacent styling?
- What is the accepted workflow for updating `docs/notes/language.json` and regenerating `proto/docs/language_map.md`?

### Now column
- Create owner command shell with top bar, left rail, main canvas, right inspector, and bottom utility strip.
- Implement draggable priority board with Notes, Questions, Now, Next, Later, Finished.
- Use the owner-manager shared record shape and global status model.
- Persist board state through inspectable JSON storage, import/export, named saves, and page-level load/list controls.
- Seed cards from actual repo notes, status reports, blueprint MVP, SSOT docs, and current prototype readiness.
- Add module information architecture for all blueprint modules.
- Add Docs & SSOT Library from `docs/ssot/master_index.json`.

### Next column
- Today / Next Actions and Notes & Decisions views backed by the same records.
- Timeline / Show Spine and Cue Matrix draft views using registry/cue SSOT.
- Inventory / Assets view using inventory, rig, and manual companions.
- Website Manager with language-token/source links and public-copy review states.
- Marketing Manager with five-stage campaign and platform prompt records.
- Reports for board snapshot, next actions, blockers, open questions, and source-document health.

### Later column
- Advanced automation, bulk import, full media upload metadata extraction, public CMS publishing, QLC+ export integration, richer search, command palette, and visual polish.

### Finished column
- Canonical blueprint, README, knowledge brief, prompt docs, website system plan, owner admin readiness, owner boot plan, public prototype docs, SSOT JSON companions, marketing prompt/spec libraries, and status report exist as source inputs.
- `owner_arena_command/` already demonstrates PHP + JSON overlay persistence and can inform storage strategy.

## Implementation choices made

1. Build the priority-board MVP as an owner-command module, not a generic kanban clone.
2. Use a simple inspectable JSON storage model first, consistent with existing owner-app prototype overlay precedent.
3. Treat bundled SSOT and docs as read-only seeds; save owner-managed board sets separately.
4. Map legacy notes-tracking statuses (`canon_current`, `needs_owner_decision`, `archived_stale`) into the owner-manager status model for the new board while preserving original status/canon-comparison metadata in card details.
5. Make every seed card source-backed with `source_files` and either `GEN` or a Timeline Moment ID.
6. Use functional module cards/stubs for full canonical IA if full module implementation is too large for the first pass.

## Conflicts and uncertainty

- The notes-tracking app canon uses statuses such as `canon_current`, `needs_owner_decision`, `cancelled`, and `archived_stale`, while the owner project manager blueprint defines the controlling status vocabulary. The new app should use the blueprint model and preserve legacy status as metadata.
- `owner_admin_build_readiness.md` mentions `GEN-PENDING-REVIEW`; the current task requires `GEN` or Timeline Moment ID. Use `GEN` plus `status: needs_decision`/review metadata unless the owner confirms otherwise.
- `docs/cue.txt` contains draft show-flow data and must never be marked show-ready without migration/review.
- Public claims/facts around free show, RSVP, camping prices, BYOB, venue details, fog/strobes, and no-ticket language require source/owner verification before publication.
- Official-KISS-adjacent visual/copy ideas and AI voice likeness concepts require rights/content review.

## Final boot readiness report

Boot complete. I am prepared with the project canon, source-of-truth hierarchy, owner-manager blueprint, required module inventory, shared schema, status model, prototype persistence precedent, public website/language guardrails, technical rig/cue caveats, marketing funnel/spec libraries, notes backlog, SSOT companion structure, seed-card candidates, implementation choices, and owner questions. Recommended first build: create the app shell and implement the repository-derived draggable priority board with JSON import/export and server-side named board saves before expanding the other modules.

---

## Application richness expansion — details to carry into the first build

This section extends the boot findings into a richer implementation brief for the functionality the app already plans to offer. The intent is not to expand into an enterprise system; it is to deepen the owner cockpit so each existing module becomes more useful, more source-grounded, and more immediately actionable.

### Priority board enrichment

The priority board should remain the first visible surface, but each interaction should preserve the project canon rather than behaving like a generic kanban board.

- **Board as triage cockpit:** columns represent owner attention states, not software-team workflow states. `Notes`, `Questions`, `Now`, `Next`, `Later`, and `Finished` should be editable labels, but the seeded default board should remain available as a recoverable template.
- **Card metadata density:** each card should display title, module chip, classification chip, priority chip, status chip, next-action line, source-file count, and last-updated age without requiring a detail open.
- **Source-first inspector:** selecting a card should open the right inspector with source files, original note excerpts where available, linked records, classification, review warnings, and the current next action.
- **Smart drop behavior:** moving a card between columns should update context metadata automatically. For example, dropping into `Questions` should set `status: needs_decision`; dropping into `Now` should set `status: in_progress` or prompt for `not_started` if the work is merely accepted; dropping into `Finished` should set `status: finished` only after a confirmation that source links and next-action closure are present.
- **Recovery pattern:** deleted columns and cards should move into a board-level recovery bin before permanent deletion. The recovery bin should preserve source files, timestamps, order indexes, and previous column identity.
- **Bulk triage mode:** the owner should be able to select several raw note cards and assign module, classification, priority, status, and next action in one compact bulk action panel.
- **Decision capture:** when a card is closed from `Questions`, the app should ask for the decision made, decision date, and affected records so the Notes & Decisions module remains complete.
- **Canonical seed reset:** the app should offer “reload canonical seed board” separately from “load saved board” so owner changes are not confused with repository-derived defaults.
- **Explainable counts:** every badge, readiness count, and column count must open the filtered list that produced it.

### Command Dashboard enrichment

The Command Dashboard should be more than a decorative landing screen.

- **Readiness pulse:** show a compact pulse made from show, technical, inventory, website, marketing, booking, notes, and docs readiness. Each pulse segment should state whether it is calculated from blocked items, needs-decision items, missing source links, overdue next actions, or review status.
- **Today lane:** surface cards with critical/high priority, due/target today, blocked dependencies that changed, or `needs_decision` status.
- **Launch focus:** keep the July 25, 2026 Cycle Moore Legacy / Interlochen focus visible, but label it as the current public focus rather than assuming every internal record is event-specific.
- **Risk strip:** show top blockers, draft-only cue warnings, public-copy review warnings, and source-document health warnings.
- **Recent activity:** list recent saved board sets, imported notes, status changes, source-link changes, and exported reports.

### Today / Next Actions enrichment

- **Action-first list:** flatten only the `next_action` field while preserving each source record type and module.
- **Owner-role filters:** performer, operator, owner, venue, designer, collaborator, and unassigned filters should be one-click chips.
- **Fast closure:** completing a next action should require either a new next action, a finished status, or a paused/blocked reason.
- **Staleness warnings:** records with old `last_updated` values and active statuses should surface for review.

### Notes & Decisions enrichment

- **Raw-note preservation:** imported note fragments must be preserved exactly and attached to promoted cards rather than rewritten away.
- **Promotion paths:** raw notes can become a note, question, decision, task, asset, cue, website-copy item, marketing item, or archival reference.
- **Decision log:** each decision should include the question answered, decision, rationale, source files, affected modules, and reopening conditions.
- **Canon comparison:** public-copy notes should show whether they match, partially match, are absent from, or conflict with the language inventory.

### Timeline / Show Spine enrichment

- **Timeline registry first:** Timeline IDs and `GEN` classifications should come from the registry/SSOT seed layer.
- **Cue migration state:** show whether a moment is reserved, proposed from cue draft, approved, rehearsing, show-ready, or blocked by safety/content review.
- **Moment detail:** each moment should show performer action, show-control action, linked songs/cues/costumes/media/assets/rehearsal notes, safety review, and fallback state.
- **Draft warning:** any item imported from `docs/cue.txt` should carry a visible “working draft” warning until explicitly reviewed.

### Cue & Run Sheet enrichment

- **Operator-ready row shape:** cue rows should include timeline ID, trigger, music reference, lighting state, projection state, fog/strobe state, performer action, fallback, safety notes, rehearsal status, and source files.
- **Run-sheet export:** export a compact Markdown or JSON run sheet grouped by set block, song, transition, costume change, finale, and emergency state.
- **Safety defaults:** fog, strobes, blackout, and projection cues should default to `needs_review` unless a source explicitly approves them.
- **No false readiness:** the UI must distinguish cue draft, rehearsed, approved, and show-ready states.

### Inventory / Assets enrichment

- **Asset detail cards:** show asset type, category, physical/digital status, condition, storage location, patch/manual references, public/private flag, content status, safety status, linked timeline IDs, and missing-photo warnings.
- **Fixture awareness:** lighting assets should link to patch/address data and vendor-manual companions.
- **Packing connection:** every physical asset should be eligible for packing and maintenance views without duplicate entry.
- **Evidence intake:** uploaded photos or files should either create a media/file record or attach to an existing asset; uploads should not become unattached gallery items.

### Media & Files enrichment

- **Not a file cabinet:** every media file should have a record type, module link, classification, source/origin, public/private flag, content status, rights review, intended use, and linked records.
- **Creative lifecycle:** media can move through raw reference, mockup, prompt output, selected candidate, approved asset, publish-ready asset, archived reference.
- **Prompt/spec linkage:** marketing prompt templates, mockup specs, and platform prompt inventories should appear as source documents linked to generated creative records.

### Website Manager enrichment

- **Page map:** list public routes, sections, CTAs, forms, disclaimers, media needs, SEO notes, language tokens, and publish readiness.
- **Public-copy workbench:** each copy block should show source document, language token if present, review status, CTA family, public/private posture, and owner decision state.
- **Guarded publishing:** no item should be marked `publish_ready` if it has unresolved rights, fact, safety, or source-link warnings.
- **Token-aware editing:** edits should produce proposals rather than silently mutating runtime language JSON unless an explicit language-update workflow is implemented.

### Marketing Manager enrichment

- **Campaign-stage board:** include Awareness, Interest, Consideration, Conversion, and Retention/Nurture as campaign-stage groupings.
- **Platform adaptation records:** represent each platform prompt inventory as planned creative variants with placement, crop, safe-zone, CTA, audience, public-copy tokens, source files, and review status.
- **Fact chips:** show “free show,” “RSVP/update list,” “Cycle Moore Legacy / Interlochen,” camping, BYOB, and safety/practical claims as verifiable chips rather than casual text.
- **Creative guardrails:** show warnings against official logos, exact makeup/costume replication, restricted fonts, outside photos, implied official partnership, and unreviewed likeness/voice claims.

### Booking / Contacts enrichment

- **Lightweight relationship view:** track venue, buyer, press, collaborator, vendor, and sponsor-style contacts without building a corporate CRM.
- **Follow-up cards:** every contact should have next action, status, last touch, related documents, EPK/rider readiness, and public-approved materials needed.
- **Buyer packet readiness:** reports should identify which booking assets are missing, draft, review-needed, or publish-ready.

### Rehearsal & Prep enrichment

- **Practice-to-record linkage:** rehearsal notes should connect to timeline moments, cues, costumes, technical states, media, and next actions.
- **Readiness checklists:** show what must be rehearsed, what failed last run, what needs reset/fallback practice, and what is ready for review.
- **One-operator reality:** rehearsal views should emphasize performer/operator load and the minimum next useful practice action.

### Packing / Maintenance enrichment

- **Road-case mode:** generate packing lists from inventory records by show area, case/bin, fixture family, cable/power need, and venue dependency.
- **Maintenance queue:** show repair, battery, cleaning, labeling, storage, missing-photo, and purchase-needed items.
- **Preflight/postflight reports:** export loadout, preshow test, postshow reset, and missing/damaged item reports.

### Docs & SSOT Library enrichment

- **Source document cards:** load `docs/ssot/master_index.json` first, then show each source document with document ID, authority domain, source path, machine-readable companion, classification, status, last-updated clue when available, and linked app modules.
- **Health states:** current, needs review, generated companion exists, generated companion missing, map may need regeneration, legacy/raw note, vendor manual, prototype reference.
- **Traceability:** every card in the priority board should be able to trace back to source document cards.

### Reports / Exports enrichment

- **Board snapshot:** export current columns/cards/order/source references as JSON and a readable Markdown summary.
- **Next actions:** export active next actions grouped by module, owner role, priority, and blocked state.
- **Open questions:** export decision-needed cards with source files and owner-confirmation prompts.
- **Cue/run-sheet draft:** export proposed cue rows with draft warnings.
- **Docs health:** export source-document gaps, stale/generated-map warnings, and records missing `source_files`.

## Visual presentation, styling, and brand-awareness guidance

The owner project manager should feel visually related to Just One KISS without becoming a noisy public poster. It is a backstage cockpit: theatrical, dark, practical, fast to scan, and built for one operator making real decisions.

### Visual thesis

- **Backstage cockpit, not audience landing page:** use the public brand's black/chrome/fire/gold language, but reduce spectacle density so the owner can read, triage, and act quickly.
- **Black first:** the base should be deep black and near-black stage-void tones.
- **Chrome/gunmetal second:** rails, dividers, panels, borders, and inspector frames should use gunmetal/chrome neutrals.
- **Fire third:** red/orange should signal urgency, active work, destructive actions, critical blockers, and high-energy CTAs.
- **Gold/yellow as fact/status light:** gold/yellow chips should mark verified facts, source links, classifications, and readiness states.
- **Mythic restraint:** use theatrical labels and occasional arena language, but avoid turning the manager into a parody or fan-facing hype page.

### Layout rules

- **Persistent shell:** every page uses top bar, left rail, main canvas, right inspector, and bottom utility strip.
- **Dense but readable:** cards should be compact, with strong headings, small metadata rows, and clear spacing between action zones.
- **Module consistency:** board cards, table rows, detail panels, filters, chips, buttons, and warnings should behave the same across modules.
- **Inspector-first details:** keep the main canvas fast; put source files, linked records, warnings, and edit controls in the inspector or detail drawer.
- **Explainable navigation:** left-rail count badges should always map to a real filtered list.

### Color-role guidance

| UI role | Suggested treatment | Meaning |
|---|---|---|
| App background | deep black / stage void | persistent backstage base |
| Panel surfaces | near-black, charcoal, gunmetal | working surfaces and cards |
| Borders/dividers | muted chrome / steel | structure without glare |
| Primary action | hot red to orange | create, save, act now |
| Dangerous action | darker red with confirmation | delete/archive/destructive flow |
| Verified fact/source chip | gold/yellow | canonical fact, source, classification |
| Draft/review warning | amber | needs owner/content/safety/fact review |
| Blocked/critical | saturated red | dependency or immediate risk |
| Finished/approved | restrained green or cool steel with check icon | accepted/closed without breaking brand |
| Show-ready/publish-ready | gold plus clear label | ready for performance/public use, only when supported |

### Typography and hierarchy

- **Headings:** use bold, condensed, theatrical-feeling headings where already consistent with the repository's public style, but keep forms and tables in highly readable system fonts.
- **Body text:** prioritize legibility over theme. Small metadata may be condensed but must remain readable.
- **Status labels:** use explicit text labels alongside color; never rely on color alone.
- **Public-copy caution:** avoid applying official-KISS-like fonts or restricted visual references to editable public-copy surfaces unless the content is already approved by the relevant canon/review.

### Component language

- **Readiness pulse:** compact segmented meter using module labels and count-driven warning badges.
- **Priority card:** title, module, type, classification, priority, status, next action, source-file badge, linked-record badge, updated-age badge.
- **Fact chip:** gold chip for verified event facts, timeline IDs, source paths, or language tokens.
- **Review chip:** amber/red chip for rights, safety, content, fact, or owner-decision review.
- **Draft ribbon:** visible ribbon for `docs/cue.txt` imports and any proposed public-copy/marketing material.
- **Source drawer:** file path, document authority, companion JSON, relevant line/range if available, and related records.
- **Recovery bin:** subdued chrome/charcoal panel, not a trash-can-only pattern; deletion should feel reversible first.

### Copy and microcopy rules

- Use practical owner-command language: “Next action,” “Needs decision,” “Source missing,” “Draft cue,” “Review before public,” “Load saved board,” and “Export snapshot.”
- Use project-flavored names sparingly: “Command Dashboard,” “Show Spine,” “Road Case,” “Fan Vault Pipeline,” “Launch Countdown.”
- Do not use public marketing claims as internal truth unless they are source-linked and review-cleared.
- Do not label anything “show-ready” or “publish-ready” unless the source and review metadata support that label.
- Use warnings that explain the reason and the next action, not just a red icon.

### Brand and rights guardrails

- Preserve the tribute posture: original, theatrical, fan-facing, and not implying official partnership.
- Avoid official KISS logos, exact makeup replication, exact official costumes, album-art copying, restricted fonts, outside photos, or unreviewed likeness/voice claims in app-generated public materials.
- Treat AI announcer/Gene-style voice notes, catchphrases, fire/spark/fog/strobe concepts, and venue/camping claims as review-needed until owner/fact/safety decisions are recorded.
- Keep internal production mechanics private by default; public surfaces should center the event, audience promise, and approved facts.

### Accessibility and calm-operator rules

- Keep contrast high and text readable against dark panels.
- Pair color with text and icons for all status states.
- Avoid constant flashing, pulsing, or strobe-like UI effects; theatrical energy should come from shape, color, hierarchy, and copy, not motion that distracts from work.
- Make drag-and-drop keyboard-accessible or provide move controls for columns/cards.
- Confirm destructive actions and preserve recovery options.

## Build-ready feature acceptance notes

A richer first implementation should be accepted when:

1. the priority board can be used without rereading raw notes;
2. every seeded card has `source_files`, classification, module, status, priority, and next action;
3. drag/drop updates order and context metadata in a visible, reversible way;
4. named JSON board saves, imports, exports, and canonical seed reloads are available;
5. left-rail modules exist with coherent counts and source-backed starter cards or stubs;
6. the right inspector explains source, links, warnings, and next action for selected records;
7. visual presentation follows backstage cockpit rules rather than generic SaaS or noisy fan-poster styling;
8. no cue, public copy, marketing creative, rights-sensitive idea, or safety-sensitive effect is marked ready without supporting source/review metadata.
