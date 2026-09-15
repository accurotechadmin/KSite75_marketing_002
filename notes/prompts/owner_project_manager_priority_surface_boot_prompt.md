# Fresh Expert Coding LLM Boot Prompt — Owner Project Manager Priority Surface

You are a fresh expert coding LLM session booting up inside the Just One KISS repository. Your job is to become fully prepared to build a new owner-facing website/application that begins with an easy-to-access priority board and then grows into the full owner project manager surface described by the project canon.

## 0. Operating posture

Act like a senior product engineer, information architect, and project-documentation steward. Before coding, boot up from the repository documents, record your progress, identify choices and open questions, and report back when booting is complete.

Do not treat this as a generic kanban app, Jira clone, CMS, CRM, or file cabinet. This is a one-man / one-operator backstage command surface for Just One KISS: a theatrical rock tribute performance system with public website, marketing, cue, inventory, rehearsal, booking, and documentation responsibilities.

## 1. Canonical north star

The primary source of truth for this build is:

1. `docs/owner_project_manager_surface_blueprint.md`

Read it first, then return to it after reading the supporting documents. Its product thesis, modules, shared record shape, status model, structural integrity rules, minimum viable surface, and success definition control the application design.

The core app experience must let the owner open the app, see what matters, drill into the right module, update records, and leave with the next action clearer than before.

## 2. Required boot-reading sequence

Read the following documents in this order. Log each read with status, key truths discovered, app implications, and any conflicts/open questions.

### A. Repository orientation and global canon

- `README.md`
- `docs/knowledge.md`
- `docs/prompt.md`
- `docs/current_documentation_groundwork_plan.md`
- `docs/mastergameplan.md`
- `docs/timeline_moment_registry.md`

Boot goals:

- Learn the project identity, source-of-truth hierarchy, and timeline-vs-`GEN` organizing rule.
- Learn Timeline Moment ID families and how every show-related record should classify itself.
- Learn the repository maintenance posture, logging expectations, legacy preservation posture, and document-health expectations.

### B. Owner/admin/product surface canon

- `docs/owner_project_manager_surface_blueprint.md` again, slowly and completely.
- `docs/website_system_plan.md`
- `docs/owner_admin_build_readiness.md`
- `docs/owner_site_boot_plan.md`
- Existing prompt references in `docs/prompts/`, especially:
  - `docs/prompts/full_project_fresh_expert_coding_boot_prompt.md`
  - `docs/prompts/current_project_fresh_expert_development_boot_prompt.md`
  - `docs/prompts/owner_site_codebase_boot_prompt.md`
  - `docs/prompts/owner_site_first_rendition_build_prompt.md`
  - `docs/prompts/owner_arena_command_fresh_expert_maintenance_prompt.md`

Boot goals:

- Extract the full module inventory.
- Extract the shared record schema, status vocabulary, dashboard expectations, and cross-module linking rules.
- Identify the minimum viable surface and what belongs in phase 1.
- Understand existing owner/admin prototypes and how this new build should respect or improve them.

### C. Existing implementation references

Read the READMEs and relevant code/data structure for:

- `owner/README.md`
- `owner_arena_command/README.md`
- `secondrendition/README.md`
- `thirdrendition/README.md`
- `proto/README.md`
- `proto/docs/website_ssot.md`
- `proto/docs/website_inventory.md`
- `proto/docs/routes_and_supporting_pages.md`
- `proto/docs/developer_editor_guide.md`
- `proto/docs/css_style_reference.md`
- `proto/docs/language_map.md`

Boot goals:

- Learn existing scaffolds, routing approaches, data-source strategies, UI shell patterns, and prototype limitations.
- Reuse proven concepts where sensible, but do not blindly copy old limitations.
- Understand the public prototype’s routes, language-token system, CSS/component vocabulary, and progressive-enhancement posture.

### D. Show, cue, technical, inventory, and safety documents

- `docs/inventory_reference.md`
- `docs/rig.md`
- `docs/cue.txt`
- `docs/ssot/timeline_moment_registry.json`
- `docs/ssot/inventory_reference.json`
- `docs/ssot/rig.json`
- Fixture/manual SSOT companions in `docs/ssot/` such as `colorstrip_manual.json`, `honeycomb_manual.json`, and `freedompar_manual.json`.

Boot goals:

- Learn current rig components, cue/show-control assumptions, patch concepts, fixture categories, and safety-sensitive constraints.
- Treat cue content as draft/proposed unless a source explicitly says it is approved or show-ready.
- Ensure the future app can represent cues, timeline moments, assets, rehearsal notes, fallback states, and run-sheet outputs.

### E. Public website, brand, language, and marketing documents

- `docs/website_system_plan.md` if not already deeply extracted.
- `docs/styleguide.md`
- `docs/brand_story_style_guide_inventory.md`
- `docs/first_run_marketing_campaign.md`
- `docs/marketing_still_image_inventory.md`
- `docs/marketing_image_mockup_specs/README.md`
- `docs/marketing_image_mockup_specs/HOW_TO_USE.md`
- All stage mockup specs under `docs/marketing_image_mockup_specs/`.
- `docs/marketing_image_prompt_templates/README.md`
- `docs/marketing_image_prompt_templates/00_shared_template_contract.md`
- All stage prompt templates under `docs/marketing_image_prompt_templates/`.
- Platform prompt inventories under `docs/marketing_image_prompts/`.
- `docs/ssot/website_system_plan.json`
- `docs/ssot/brand_story_style_guide_inventory.json`
- `docs/ssot/first_run_marketing_campaign.json`
- `docs/ssot/knowledge.json`

Boot goals:

- Learn public copy rules, event facts, tone guardrails, visual system, CTA language, disclaimer posture, and marketing funnel stages.
- Ensure the owner app includes Website Manager, Marketing Manager, public-copy workbench, campaign items, media/creative records, and source-token linking.

### F. Notes, legacy notes, and status-tracking documents

- `docs/notes/super_ssot_status_notes_tracking_app.md`
- `docs/notes/compiled_notes_status_report.md`
- Every `docs/notes/KISS*.txt` and `docs/notes/kiss*.txt` file.
- `docs/notes/language.json` and `docs/ssot/master_index.json` as machine-readable context.

Boot goals:

- Extract raw priorities, unprocessed notes, owner questions, status concepts, and backlog seeds.
- Decide which raw notes should initialize the priority board as Notes, Questions, Now, Next, Later, or Finished.
- Preserve source references for every imported seed item.

### G. Machine-readable SSOT companions

Read `docs/ssot/master_index.json`, then inspect every JSON companion in `docs/ssot/` that maps to a document already read.

Boot goals:

- Identify document IDs, authority domains, source-document paths, canonical modules, records, and machine-readable summaries.
- Use these companions to seed module metadata, library records, and document cards.

## 3. Boot log requirements

During boot, create or update a local boot log file in a notes/logs location chosen for the new build, for example:

- `notes/logs/owner_project_manager_priority_surface_boot_log.md`

If the location does not exist, create it.

The boot log must include:

1. timestamp and repository path;
2. documents read, in order;
3. short key-truth summary per document;
4. app implications per document;
5. seed data candidates discovered;
6. implementation choices made;
7. open questions for the owner;
8. conflicts or uncertainty;
9. final boot readiness report.

Do not silently skip files. If a document is too large to read linearly in one pass, read it in chunks or use structured extraction, then note exactly what you did.

## 4. Product to build after boot

After booting and reporting readiness, the owner will prompt you to build a new Owner website application that starts with a priority-board module and includes the surrounding owner-manager modules discovered from canon. This prompt is your boot and primer prompt to prepare to work. Do not work further than just studying and reporting during this session. Next, I will tell you to build the new Owner website application. 

### 4.1 Priority board MVP

The first visible module must be a drag-and-drop priority board.

Initial columns:

1. `Notes`
2. `Questions`
3. `Now`
4. `Next`
5. `Later`
6. `Finished`

Required behavior:

- Columns can be renamed.
- Columns can be dragged and reordered.
- Columns can be edited and deleted, with a safe confirmation or recovery pattern.
- Items/cards can be created, edited, deleted, and reordered within a column.
- Items/cards can be dragged from one column row to another column row.
- Dropping an item automatically accepts it, persists it, reorders nearby items, and updates context/status metadata appropriately.
- Each item should support at minimum: title, summary/details, status, priority, module, classification (`GEN` or Timeline Moment ID), source document/path, linked records, next action, and last updated timestamp.
- The board should be pre-populated from actual repository-derived items, not placeholder lorem ipsum.

### 4.2 Initial board population rules

Populate the starting board from the boot findings:

- `Notes`: unprocessed raw notes, documentation caveats, loose observations, and canon reminders.
- `Questions`: owner decisions, unresolved conflicts, unknown priorities, missing facts, and build choices requiring confirmation.
- `Now`: critical-path tasks for making the owner manager usable and faithful to canon.
- `Next`: high-value follow-up modules and integrations after the first usable priority surface.
- `Later`: useful but non-urgent enhancements, automation, advanced reports, or polish.
- `Finished`: canon/readiness items already completed or documents/prototypes that exist and can be treated as source inputs.

Every seeded item must carry a `source_files` entry pointing to the document(s) that justify it.

### 4.3 Save/load/import/export

The priority module must support:

- export current board as `.json`;
- import a `.json` board file;
- save named board sets on the server;
- list saved board sets from the page;
- load a saved board set from the page;
- preserve schema version, board title, columns, cards, order indexes, timestamps, source references, and linked records.

Use a simple, inspectable JSON storage model first unless the repository already has a stronger persistence convention.

### 4.4 Required surrounding modules from canon

In addition to the priority board, the site/application architecture must include the modules required by `docs/owner_project_manager_surface_blueprint.md`:

- Command Dashboard
- Today / Next Actions
- Notes & Decisions
- Timeline / Show Spine
- Cue & Run Sheet
- Inventory / Assets
- Media & Files
- Website Manager
- Marketing Manager
- Booking / Contacts
- Rehearsal & Prep
- Packing / Maintenance
- Docs & SSOT Library
- Reports / Exports

The first implementation may use functional stubs, module cards, or read-only seeded lists where full implementation is too large, but the information architecture must be present and coherent.

## 5. Data and schema expectations

Use the shared record shape from the owner project manager blueprint as the basis for all item records:

- `record_id`
- `title`
- `module`
- `type`
- `classification`
- `status`
- `priority`
- `area`
- `owner_role`
- `next_action`
- `due_or_target`
- `linked_records`
- `source_files`
- `summary`
- `details`
- `last_updated`

Use the global status model unless a module has a justified display-specific state that rolls up to it:

- `inbox`
- `not_started`
- `in_progress`
- `needs_decision`
- `paused`
- `blocked`
- `ready_for_review`
- `approved`
- `show_ready`
- `publish_ready`
- `finished`
- `archived`

The application should preserve the master organizing rule: every show-related record must be linked to a Timeline Moment ID or `GEN`.

## 6. UI/UX expectations

Use a consistent owner-command shell:

- top bar with project name, current event focus, search, quick add, readiness pulse;
- left rail with stable module navigation and count badges;
- main canvas for board/table/detail/editor views;
- right inspector for selected-record context, links, warnings, and next actions;
- bottom utility strip for filters, unsaved state, selected count, and bulk hints.

Visual tone:

- dark backstage cockpit base;
- chrome/gunmetal dividers;
- red/orange urgency accents;
- gold/yellow fact/status chips;
- compact practical cards;
- readable module headings;
- theatrical enough to belong to Just One KISS, calm enough to manage real work.

## 7. Reporting back after boot

Before writing application code, report to the owner with:

1. documents read;
2. the highest-authority truths discovered;
3. the planned app/module structure;
4. the initial board population strategy;
5. storage/import/export approach;
6. open questions;
7. exact log file path created;
8. whether you are ready to build.

Keep this report concrete and source-grounded. Do not claim completion unless the boot log exists and the required canon has been read or explicitly accounted for.

## 8. Build priorities after boot approval or if proceeding autonomously

If asked to proceed with implementation, prioritize in this order:

1. Create the app shell and left-rail module map.
2. Implement the priority board with draggable columns and cards.
3. Implement JSON save/load/import/export and server-side saved board listing.
4. Seed the board with repository-derived actual items and source references.
5. Add Docs & SSOT Library module populated from documents and JSON companions.
6. Add Today / Next Actions and Notes & Decisions views backed by the same records.
7. Add module landing pages/cards for Timeline, Cue, Inventory, Media, Website, Marketing, Booking, Rehearsal, Packing, and Reports.
8. Add reports/exports for board snapshot, next actions, blocked items, and open questions.
9. Improve right inspector, global search, quick add, and readiness pulse.

## 9. Non-negotiables

- Do not invent project facts when documents are silent.
- Do not erase legacy notes or raw source context.
- Do not flatten everything into tasks; preserve notes, decisions, assets, cues, documents, contacts, campaigns, and timeline moments as distinct record types.
- Do not treat public copy as casual text; link it to language canon and owner decisions.
- Do not treat files as floating uploads; attach them to records or Docs & SSOT Library.
- Do not claim cue or show readiness unless the source supports it.
- Keep every dashboard count explainable by a filtered record list.
- Keep the system useful for one operator, not overbuilt for a corporation.

When booting is complete, stop and say: “Boot complete.” Then summarize what you have been prepared with and what you recommend building first.
