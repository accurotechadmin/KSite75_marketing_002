# Just One KISS - Current Documentation Groundwork Plan

**Purpose:** Define the authoritative next-generation documentation system for Just One KISS: a lean current layer that can refresh the project without losing any existing repository knowledge, while making logging, evidence, and record-keeping the default fabric of every future planning, build, rehearsal, launch, and maintenance action.

**Status:** Current guiding documentation plan / migration blueprint.

**Timeline classification:** `GEN` / GENERAL / NOT TIMELINE-SPECIFIC.

**Last repo-wide documentation audit:** 2026-07-14.

---

## 1. Executive Decision

The repository already contains enough knowledge to build a strong public site, owner command center, cue bible, rig manual, launch tracker, and asset system. The problem is not missing raw information; the problem is that the information is distributed across historical plans, prompts, generated inventories, app-specific READMEs, SSOT JSON files, and prototype docs that use overlapping language.

The next documentation chapter should therefore be an **additive consolidation**, not a rewrite that discards the past.

Create a new current layer under `docs/current/` that:

1. treats old documents as preserved evidence, not current prose authority;
2. assigns every fact to exactly one current authority document;
3. keeps public copy focused on the Gene Simmons tribute performer, the audience experience, practical event facts, and theatrical spectacle;
4. keeps internal review mechanics, implementation caveats, and production staffing out of audience-facing copy;
5. links every major fact to a source path, SSOT record, route, image filename, fixture address, Timeline Moment ID, or decision-log entry;
6. makes logs, status, owner, evidence, and next action fields mandatory for current docs; and
7. turns documentation maintenance into a normal operating habit rather than an occasional cleanup project.

---

## 2. Truth Check Against the Repository

This plan has been compared against the repository documentation set, including the root README, planning docs, cue draft, Timeline registry, rig and inventory manuals, public-site docs, owner-app READMEs, fire-effect docs, and prompt files.

### 2.1 Claims this plan should keep

| Prior claim | Audit result | Current interpretation |
| --- | --- | --- |
| Existing material should be preserved. | Confirmed. The repo contains planning, technical, website, owner-app, and prompt knowledge that should remain available for audit and recovery. | Keep all legacy docs unless a separate cleanup task explicitly archives or moves them. |
| The current docs should be concise and current-authoritative. | Confirmed. Many docs repeat similar source-of-truth, public-copy, launch, and owner-app concepts. | Build a small `docs/current/` layer and make older docs reference material. |
| Timeline Moment IDs are central. | Confirmed by `README.md`, `docs/timeline_moment_registry.md`, and `docs/cue.txt`. | Preserve Timeline/GENERAL classification as a universal metadata field. |
| `docs/cue.txt` is working draft, not final show-ready canon. | Confirmed. It explicitly requires migration into the Timeline registry and later cue-bible/run-sheet treatment. | Current cue authority should become `docs/current/cue_bible.md`, sourced from the cue draft and Timeline registry. |
| `docs/inventory_reference.md` is more authoritative than `docs/rig.md` for DMX details. | Confirmed by root README and rig quick-reference relationship. | Current rig authority should absorb both but cite the inventory manual for fixture truth. |
| `proto/` is the active public website. | Confirmed by `proto/README.md`, `proto/docs/website_ssot.md`, and `proto/docs/website_inventory.md`. | Current public website canon must point to `proto/public/` as document root and preserve route/form/image truths. |
| Public copy should not expose internal review mechanics. | Confirmed by current plan, README posture, website SSOT guardrails, and style guidance. | Public-copy bank must separate approved public wording from internal notes. |

### 2.2 Claims that needed correction or sharper wording

| Earlier wording / implication | Correction from audit | Required update |
| --- | --- | --- |
| “Recommended fresh base documents” could sound optional. | The user wants an ultimate guiding document for a pristine complete set. | Treat the fresh set as the target operating documentation layer, not merely a recommendation. |
| Owner/admin currentness was under-specified. | `owner/` is a generic scaffold, `owner_arena_command/` is a first implementation, `secondrendition/` improves findability, and `thirdrendition/` is the most owner-actionable command center. | Current owner canon must make `thirdrendition/` the latest studied owner-command reference while preserving earlier renditions as provenance. |
| Browser fire/ember/smoke/heat effects were removed. | The standalone effect lab and public-site browser effect assets have been deleted. | Current docs should not describe a reusable browser-effect module or active browser effect integration. |
| Logging was not strong enough. | Multiple docs contain status, launch checklists, generated inventories, decision logs, backups, and data-integrity posture. | Add mandatory record-keeping rules, decision logs, change logs, evidence fields, and generated-inventory refresh rules to the current documentation standard. |
| Public website copy source was named as `proto/docs/language.json`, but the earlier table implied it lived under `proto/docs/language.json` while only listing Markdown docs. | Runtime public copy is indeed JSON-backed, with `proto/docs/language_map.md` as generated human map and backups in `proto/docs/language_backups/`. | Current public-copy bank must cite the JSON token system and generated map together. |
| “No unneeded redundancy” needed operational enforcement. | Existing docs repeat event facts, active app info, route jobs, source hierarchy, launch blockers, and copy posture. | Add a one-fact/one-authority matrix and explicit anti-duplication rules. |

---

## 3. Current Copy and Public-Presentation Posture

All current and future public copy should keep the attraction centered on the **Gene Simmons tribute performer**, the audience experience, the event facts, and the theatrical spectacle.

Use this standard:

- Sell the performer and the show experience.
- Describe lighting, fog, video, costumes, songs, fan energy, venue details, dates, arrival information, and booking value.
- Keep internal review mechanics, data-integrity warnings, launch blockers, staffing assumptions, and implementation caveats out of public copy.
- Keep independent-tribute guardrails visible where needed: do not claim outside partnership, do not rely on outside logos/media/restricted fonts/restricted makeup unless approved, and keep safety language practical.
- Keep documentation concise enough that developers and owners can quickly find the current source of truth.

Verified public event facts currently preserved by website documentation:

| Fact | Current truth | Current authority target |
| --- | --- | --- |
| Event date | July 25, 2026. | `docs/current/public_website_canon.md` and `docs/current/public_copy_bank.md` |
| Admission | Free show; no ticket required; RSVP/update-list appreciated where stated. | `docs/current/public_website_canon.md` |
| Location | Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643. | `docs/current/public_website_canon.md` |
| Camping | Overnight camping is `$10/night`; regular Cycle Moore charges apply for longer stays before/after. | `docs/current/public_website_canon.md` |
| Safety | Loud sound, bright lights, fog, flashing patterns/strobe-style looks may be used. | `docs/current/public_copy_bank.md` and route/footer copy |

---

## 4. Target Current Documentation Set

Create these files under `docs/current/`. This is the target operating set.

| Current document | Authority domain | Absorbs / reconciles |
| --- | --- | --- |
| `project_brief.md` | One-page identity, event posture, current active apps, audience, tone, and top priorities. | `README.md`, `docs/knowledge.md`, `docs/mastergameplan.md`, website SSOT. |
| `source_of_truth_map.md` | Human docs, SSOT JSON, public app, owner apps, generated inventories, and legacy/reference hierarchy. | Root README hierarchy, `docs/ssot/master_index.json`, app READMEs. |
| `timeline_registry.md` | Clean current Timeline Moment ID registry with approved/proposed/parked status. | `docs/timeline_moment_registry.md`, `docs/cue.txt`, SSOT timeline JSON. |
| `cue_bible.md` | Run-of-show, set blocks, songs, transitions, costume holds, video cues, lighting/fog/strobe seeds, fallbacks, rehearsal state. | `docs/cue.txt`, Timeline registry, rig docs, master gameplan show sections. |
| `technical_rig_manual.md` | Canonical QLC+/DMX/fixture/show-control reference. | `docs/inventory_reference.md`, `docs/rig.md`, vendor PDF/JSON references. |
| `public_website_canon.md` | Active public website truth: document root, routes, page jobs, forms, language source, event claims, image policy, launch blockers. | `proto/README.md`, `proto/docs/website_ssot.md`, `proto/docs/routes_and_supporting_pages.md`, `proto/docs/website_inventory.md`, `proto/docs/launch_checklist.md`. |
| `public_copy_bank.md` | Approved audience-facing wording, CTAs, FAQ answers, event facts, booking blurbs, social snippets, safety copy. | `proto/docs/language.json`, `proto/docs/language_map.md`, `docs/styleguide.md`, website plan copy notes. |
| `visual_style_system.md` | Black/chrome/fire visual system, typography roles, layout patterns, image direction, static motion guidance, UI motifs. | `docs/styleguide.md`, `proto/docs/css_style_reference.md`, `proto/docs/image_generation_*`. |
| `media_asset_catalog.md` | Image/media inventory, route slots, filenames, source status, replacement needs, alt-text and approval state. | `proto/docs/asset_placeholders.md`, `proto/docs/image_generation_inventory.md`, `proto/public/assets/img/README.md`, generated request lists. |
| `owner_command_center_canon.md` | Current owner/admin app lineage, latest owner-actionable reference, SSOT JSON loading posture, edit/read-only boundaries. | `owner/README.md`, `owner_arena_command/README.md`, `secondrendition/README.md`, `thirdrendition/README.md`, data READMEs, owner readiness docs. |
| `launch_readiness_tracker.md` | Practical launch checklist with severity, owner, status, evidence, next action, and done criteria. | `proto/docs/launch_checklist.md`, `proto/docs/website_ssot.md`, `docs/owner_admin_build_readiness.md`. |
| `developer_boot.md` | Short onboarding path: commands, active files, safe edit workflow, generated-doc refresh, test matrix, deploy roots. | Prompt docs, root README, app READMEs, launch checklist. |
| `legacy_index.md` | Complete audit index of historical docs, their contents, absorbed-by target, current/legacy status, and “do not treat as current copy” notes. | Entire repository documentation set. |
| `operations_log.md` | Cross-project decision log, change log, evidence log, open questions, verification history, and documentation refresh ledger. | Decision logs in website SSOT, launch checklists, language backups, app data-integrity notes. |

---

## 5. One-Fact / One-Authority Rule

The current set must remove unneeded redundancy by assigning each fact family to one authority.

| Fact family | Authoritative current document | Other docs may do this only |
| --- | --- | --- |
| Project identity and top-level posture | `project_brief.md` | Link or summarize in one sentence. |
| Where truth lives | `source_of_truth_map.md` | Link to the map. |
| Timeline IDs and status | `timeline_registry.md` | Reference IDs only. |
| Show order and cue behavior | `cue_bible.md` | Link to cue rows or Timeline IDs. |
| Fixture addresses, channel maps, DMX behavior | `technical_rig_manual.md` | Mention fixture names only. |
| Public site routes/forms/image policy/event facts | `public_website_canon.md` | Link and avoid duplicate route tables. |
| Approved public wording | `public_copy_bank.md` | Quote token IDs or approved snippets only. |
| Style and visual direction | `visual_style_system.md` | Reference style tokens or asset IDs. |
| Asset filenames/status | `media_asset_catalog.md` | Reference filenames/asset IDs. |
| Owner command center lineage/current app | `owner_command_center_canon.md` | Link only. |
| Launch blockers and checks | `launch_readiness_tracker.md` | Link and include status badge only. |
| Developer commands/workflow | `developer_boot.md` | Link only. |
| Historical docs | `legacy_index.md` | Link only. |
| Decisions, changes, evidence, verification | `operations_log.md` | Link to log IDs. |

If two current documents need the same detail, choose the authority, then replace the duplicate with a reference.

---

## 6. Required Metadata and Logging Fabric

Every `docs/current/*.md` file should begin with this document-control block:

| Field | Required value |
| --- | --- |
| Owner | Human role or project owner responsible for approval. |
| Classification | `GEN` or Timeline Moment ID family. |
| Status | Draft, current, needs verification, parked, retired. |
| Last audited | ISO date. |
| Sources absorbed | Paths, SSOT IDs, routes, fixture IDs, Timeline IDs, or asset filenames. |
| Current authority domain | One sentence naming what this file owns. |
| Not authority for | One sentence naming common facts this file must not duplicate. |
| Next action | The next concrete maintenance/build action. |
| Completion criteria | What makes the file useful enough for future sessions. |

Every current document should maintain one or more of these compact logs where relevant:

- **Decision log:** date, decision, reason, evidence, reversal trigger.
- **Change log:** date, changed area, source/evidence, affected files, follow-up.
- **Verification log:** date, command/check, result, limitation, next check date.
- **Open questions:** question, owner, blocker severity, needed evidence, target resolution.
- **Record ledger:** IDs added/changed/retired, source path, status, reviewer.

Logging rules:

1. Never bury important decisions only in prose.
2. Every launch blocker needs severity, owner, next action, and evidence link.
3. Every generated inventory needs generator/source path and refresh trigger.
4. Every public fact needs source and last verification date.
5. Every Timeline/cue/fixture/media item needs a stable ID or filename.
6. Every legacy-to-current migration needs an entry in `legacy_index.md`.

---

## 7. Legacy Preservation Rule

Nothing from the existing documentation set should be discarded during this migration. The current repository already contains valuable material about:

- event identity and audience promise;
- Timeline Moment IDs and show-flow organization;
- cue and setlist drafts;
- DMX patching, fixture behavior, vendor manuals, and show-control references;
- public website structure, language tokens, forms, images, routes, launch blockers, and local checks;
- owner command-center scaffolds, first implementation, second rendition, third rendition, read-only SSOT JSON data, and data-integrity posture;
- marketing, booking, media, inventory, launch planning, and LLM boot prompts;

Legacy documents remain available for audit, migration, and recovery, but the current layer should not depend on legacy wording. It should cite and absorb facts, then state the current version cleanly.

---

## 8. Initial Legacy Index Seed

The future `docs/current/legacy_index.md` must include every document. Seed it with at least these groups.

| Legacy/source group | Contents | Current absorption target |
| --- | --- | --- |
| Root orientation | `README.md` | `project_brief.md`, `source_of_truth_map.md`, `legacy_index.md` |
| Core planning | `docs/knowledge.md`, `docs/mastergameplan.md`, `docs/website_system_plan.md` | `project_brief.md`, `public_website_canon.md`, `launch_readiness_tracker.md` |
| Timeline/cue | `docs/timeline_moment_registry.md`, `docs/cue.txt` | `timeline_registry.md`, `cue_bible.md` |
| Rig/technical | `docs/inventory_reference.md`, `docs/rig.md`, vendor PDFs, `docs/ssot/*manual*.json` | `technical_rig_manual.md` |
| Style/media | `docs/styleguide.md`, `proto/docs/css_style_reference.md`, `proto/docs/image_generation_*`, `proto/docs/asset_placeholders.md`, `proto/public/assets/img/README.md` | `visual_style_system.md`, `media_asset_catalog.md` |
| Public website | `proto/README.md`, `proto/docs/website_ssot.md`, `routes_and_supporting_pages.md`, `website_inventory.md`, `launch_checklist.md`, `language_map.md`, `language.json` | `public_website_canon.md`, `public_copy_bank.md`, `launch_readiness_tracker.md` |
| Owner apps | `owner/README.md`, `owner_arena_command/README.md`, `secondrendition/README.md`, `thirdrendition/README.md`, data READMEs | `owner_command_center_canon.md`, `source_of_truth_map.md` |
| Prompts | `docs/prompt.md`, `docs/prompts/*.md`, `proto/docs/proto_expert_coding_boot_prompt.md` | `developer_boot.md`, `legacy_index.md` |
| Machine SSOT | `docs/ssot/*.json`, rendition `data/ssot/*.json` | `source_of_truth_map.md`, domain-specific current docs |

---

## 9. Migration Sequence

Do not create all current documents as empty shells. Build them in this order so each file can reference stable authorities.

1. **Create `legacy_index.md`.** Inventory every Markdown, text, PDF/manual reference, SSOT JSON group, and app README. Mark current/legacy/reference/generated.
2. **Create `source_of_truth_map.md`.** Define the active hierarchy and where structured JSON, generated docs, app roots, and historical docs fit.
3. **Create `project_brief.md`.** Summarize the project only after the authority map is clear.
4. **Create public-site cluster:** `public_website_canon.md`, `public_copy_bank.md`, `visual_style_system.md`, `media_asset_catalog.md`.
5. **Create show-production cluster:** `timeline_registry.md`, `cue_bible.md`, `technical_rig_manual.md`.
6. **Create owner/developer cluster:** `owner_command_center_canon.md`, `launch_readiness_tracker.md`, `developer_boot.md`.
7. **Create `operations_log.md`.** Seed it with major decisions already visible in website SSOT, app READMEs, launch checklists, and this migration.
8. **Backfill sources absorbed.** Add source paths and evidence IDs to every current doc.
9. **Refresh SSOT companion.** Create `docs/ssot/current_documentation_groundwork_plan.json` only after this plan is accepted and the current-doc structure is stable.

---

## 10. Acceptance Criteria for the Pristine Documentation Refresh

The refresh is complete when a new expert can do the following without reading historical docs first:

- identify the project, show promise, active public site, latest owner-command reference, and current launch posture;
- find the authoritative source for every major fact family;
- distinguish public copy from private planning notes;
- find every route, form, image slot, event fact, and launch blocker for the public website;
- find every fixture family, patch/address rule, QLC+/DMX convention, and emergency state;
- find every set block, song row, transition, costume/video/lighting/fog/strobe seed, and Timeline Moment ID status;
- trace every current statement back to source evidence;
- see the decision/change/verification history for major project moves;
- update docs without duplicating facts; and
- preserve legacy material for audit without treating old prose as current authority.

---

## 11. Machine-Readable SSOT Companion

A structured companion should be created at `docs/ssot/current_documentation_groundwork_plan.json` after this plan is accepted.

Minimum fields:

- `document_id`
- `title`
- `status`
- `last_audited`
- `timeline_classification`
- `current_doc_targets[]`
- `authority_domains[]`
- `legacy_source_groups[]`
- `migration_sequence[]`
- `logging_requirements[]`
- `acceptance_criteria[]`

The JSON should not become a second prose authority. It should mirror this plan for indexing, owner-app loading, validation, and data-integrity checks.
