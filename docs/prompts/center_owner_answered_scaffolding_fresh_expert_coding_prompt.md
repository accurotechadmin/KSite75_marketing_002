# Just One KISS - Center Owner-Answered Scaffolding Fresh Expert Coding Prompt

Use this primer to boot a fresh expert coding LLM session whose mission is to apply the owner’s resolved answers from the open-inquiry review and convert the current `/center` scaffold into a clearer first owner-facing instantiation plan and code scaffold.

This pass is still **scaffolding-first**, not a full production implementation. Its near-term purpose is to make `/center` the production-intended, deployment-simple, vanilla PHP owner command center and private CMS-adapter direction for `proto/`, with the first practical emphasis on general inventory, SSOT canon visibility, and owner-friendly public-site editing intent. Do not build live public publishing, real authentication, real uploads, full CRUD, database migrations, or external-service integrations in this pass.

---

## 0. First-response posture

Start concise, operational, and repository-aware:

> I will refresh and verify the repository state, read the project canon, all prompt files, the `/center` scaffold, the public `proto/` target, and the owner-resolved open-inquiry answers, then implement a deployment-simple vanilla PHP scaffolding pass that positions `/center` as the private owner CMS adapter for `proto/` without adding live publishing, auth, uploads, or external dependencies.

Then inspect before making claims or edits.

---

## 1. Refresh and immediate boot commands

Run these from the repository root before making claims. Use `find`, `rg`, `sed`, `nl -ba`, `php -l`, `python3 -m json.tool`, and targeted scripts. Do **not** use `ls -R` or `grep -R`.

If network/remotes are available, refresh from the current branch before editing. If refresh is impossible because the environment has no remote, no credentials, or no branch tracking, state that and continue from the live tree.

```bash
pwd
find .. -name AGENTS.md -print
git status --short
git branch --show-current
git remote -v
git fetch --all --prune
git pull --ff-only
git log --oneline -8
find docs/prompts -maxdepth 1 -type f | sort
find docs/ssot -maxdepth 2 -type f | sort
find center -maxdepth 4 -type f | sort
find center/docs -maxdepth 2 -type f | sort
find owner -maxdepth 3 -type f | sort
find owner_arena_command -maxdepth 3 -type f | sort
find secondrendition -maxdepth 3 -type f | sort
find thirdrendition -maxdepth 3 -type f | sort
find proto -maxdepth 3 -type f | sort
rg -n "TODO|FIXME|launch blocker|prototype-only|read-only|placeholder|draft overlay|out of sync|SSOT|Timeline|GEN|GEN-PENDING-REVIEW|needs_timeline_review|settings_manifest|settings/|priority-board|release-gates|provenance-ledger|decision-log|auth|audit|backup|permission|public-ready|show-ready|proto|CMS|accessibility" README.md docs center owner owner_arena_command secondrendition thirdrendition proto -g '!vendor' -g '!node_modules'
```

If the working tree is dirty, classify every change before touching files:

1. user changes;
2. previous-agent changes;
3. your own changes.

Never overwrite or reformat unrelated work.

---

## 2. Required study order

Read enough of these files to understand the current truth before planning edits.

### 2.1 All prompts

Study every prompt in `docs/prompts/` before implementation. Pay special attention to:

```text
docs/prompts/center_horizontal_scaffolding_refinement_fresh_expert_coding_prompt.md
docs/prompts/center_first_full_scaffolding_fresh_expert_coding_prompt.md
docs/prompts/centralized_owner_management_website_super_prompt.md
docs/prompts/proto_public_site_fresh_expert_coding_prompt.md
docs/prompts/owner_arena_command_fresh_expert_maintenance_prompt.md
docs/prompts/owner_site_codebase_boot_prompt.md
docs/prompts/owner_site_first_rendition_build_prompt.md
```

Use the prompt set to understand intent, but treat the owner decisions in this prompt as newer and controlling when they conflict.

### 2.2 Repository canon and owner/public truth

```text
README.md
docs/knowledge.md
docs/prompt.md
docs/current_documentation_groundwork_plan.md
docs/mastergameplan.md
docs/timeline_moment_registry.md
docs/cue.txt
docs/inventory_reference.md
docs/rig.md
docs/styleguide.md
docs/website_system_plan.md
docs/owner_admin_build_readiness.md
docs/owner_site_boot_plan.md
```

### 2.3 Owner inquiry and answer truth

```text
center/docs/center_horizontal_scaffolding_open_inquiries.md
center/docs/answers.md
```

Treat this prompt’s owner-answer policy section as the cleaned, resolved implementation version of those answers. If `center/docs/answers.md` conflicts with this prompt, follow this prompt.

### 2.4 SSOT and settings truth

```text
docs/ssot/master_index.json
docs/ssot/settings_manifest.json
docs/ssot/settings/*.json
docs/ssot/*.json
```

Treat `docs/ssot/settings_manifest.json` as the discovery manifest. Treat `docs/ssot/settings/*.json` as settings-backed starter contracts for labels, option sets, workflow states, vocabulary, CTAs, routes, style guidance, brand stories, technical disclosure rules, integrations, and developer workflow.

### 2.5 Active `/center` files

Inspect every current file under `center/`, including:

```text
center/README.md
center/config/app.php
center/data/*.php
center/includes/*.php
center/partials/*.php
center/pages/*.php
center/assets/css/center.css
center/assets/js/center.js
center/docs/*.md
center/storage/README.md
center/storage/*/README.md
```

### 2.6 Reference surfaces to borrow from, not fork

```text
owner/README.md
owner_arena_command/README.md
secondrendition/README.md
thirdrendition/README.md
proto/README.md
proto/docs/language.json
proto/app/language.php
proto/app/site_data.php
proto/public/index.php
proto/public/*/index.php
```

Use prior owner renditions as permanent design studies, not production data authority. Borrow proven patterns deliberately and document where each retained prior-rendition feature maps into `/center`.

---

## 3. Core project truths to preserve

The project is **Just One KISS**: a Gene Simmons tribute theatrical stage event inspired by Gene Simmons/KISS-style spectacle. It is being developed as a repeatable, bookable, streamlined theatrical production with a private owner command center and public-facing event/booking web presence.

Current documented public focus:

- Interlochen, Michigan-area event.
- Date: July 25, 2026.
- Public posture: theatrical tribute, independent, original, rights-aware, safety-aware, fan-facing, public-ready only after review.
- Creative tone for public pages: black-first, chrome-edged, fire-lit, mythic, loud, high-contrast, arena-scale, never generic.

Non-negotiables:

1. The operating baseline is the Just One KISS performer plus a show-control system, not a large hidden crew assumption.
2. Public copy, website text, and marketing materials must not mention or hint at extra personnel. There are only two owner-side roles for this scaffold: `Developer` / `D` and `Owner / Performer`. The performance should let the “Just One” identity speak for itself without using the word “solo” or overexplaining it.
3. Every managed item, asset, cue, task, record, option, decision, gate, contact placeholder, rehearsal note, output, setting, route, and content unit must be tied to a Timeline Moment ID or marked `GEN` / GENERAL / NOT TIMELINE-SPECIFIC.
4. Use `timeline_moment_id_or_gen` as the canonical data field for Timeline/GEN classification. Use `classification` only as a UI/display alias or broad grouping label.
5. Reject `GEN-PENDING-REVIEW`. Use `timeline_moment_id_or_gen: GEN` plus `status: needs_timeline_review` for ambiguous records. Warn on that status; fail/block only if the record is approved, exported, public-ready, venue-ready, internal-ready, or show-ready.
6. `docs/cue.txt` is an internal working cue/setlist draft. Defer all cue migration until a dedicated Cue Bible pass can handle timing, safety, fallback states, performer actions, and venue constraints.
7. Public output must not imply official endorsement, sponsorship, clearance, partnership, ownership, or authorization by KISS, Gene Simmons, Pophouse, or related rightsholders unless written approval exists.
8. Exact costume/makeup/logo/media resemblance, restricted marks, outside media, album art, official-sounding claims, and endorsement-adjacent language are content-sensitive and require review.
9. Technical show-control records should carry one disclosure tier: `public-safe`, `venue-shareable`, `owner-private`, `operator-private`, or `safety-sensitive`.
10. Internal production mechanics, cue timings, emergency states, owner workflows, contact data, private pricing, and show-control details stay internal unless an authoritative public document explicitly approves disclosure.
11. If event facts, permissions, assets, contacts, approvals, or technical data are incomplete, mark them incomplete and recommend reconciliation. Do not invent certainty.
12. Prefer vanilla PHP/HTML/CSS/JS. Do not add package managers, frameworks, remote API dependencies, or external library repositories.

---

## 4. Owner-resolved implementation policy

### 4.0 Open-inquiry answer crosswalk

This prompt incorporates the owner decisions for `OI-001` through `OI-022` from `center/docs/center_horizontal_scaffolding_open_inquiries.md` and `center/docs/answers.md` as implementation policy:

| Inquiry | Resolved direction in this prompt |
|---|---|
| `OI-001` | `/center` is production-intended, vanilla, deployment-simple, local-file-backed, and first operates as a private CMS adapter for `proto/`. |
| `OI-002` | Use documentation mockups first; prepare for disabled controls later. |
| `OI-003` | First-class now: Dashboard, Priority Board, Release Gates, Provenance Ledger, Integrity. Prepare next-session `proto` editing modules; defer deeper modules. |
| `OI-004` | Track `proto` readiness and release-package metadata now; defer direct writes and owner control cabinets. |
| `OI-005` | Use `draft`, `internal-ready`, `venue-ready`, `public-ready`; treat `show-ready` as a separate checklist result. |
| `OI-006` | Use only `Developer` / `D` and `Owner / Performer` roles; avoid implying additional personnel in public copy. |
| `OI-007` | Newest source may settle low-risk labels only; serious conflicts become Integrity findings and Decision Log entries. |
| `OI-008` | `timeline_moment_id_or_gen` is canonical; `classification` is a display alias or broad grouping label only. |
| `OI-009` | Reject `GEN-PENDING-REVIEW`; use `GEN` plus `status: needs_timeline_review`. |
| `OI-010` | Defer cue migration to a dedicated Cue Bible pass. |
| `OI-011` | Use disclosure tiers: `public-safe`, `venue-shareable`, `owner-private`, `operator-private`, `safety-sensitive`. |
| `OI-012` | Use placeholder contact fields only until real contact storage is approved. |
| `OI-013` | Use generic release-gate evidence now; specialize later. |
| `OI-014` | Move toward settings-driven navigation and route metadata; document any deferred complexity. |
| `OI-015` | Use the approved provenance levels listed below. |
| `OI-016` | Preserve prior renditions as design studies; exclude them from production authority and map migration patterns. |
| `OI-017` | Keep `/center` neutral/admin-like; reserve theatrical styling for `proto` and marketing previews. |
| `OI-018` | Reserve dedicated accessibility work for a final quality pass; mention only where naturally relevant. |
| `OI-019` | Keep retention as `TBD until deployment architecture is selected`. |
| `OI-020` | Use one-line checks and add one dependency-free `center/scripts/validate.php` if safe and simple. |
| `OI-021` | Use `center/docs/reports/` and a living `horizontal_scaffolding_refinement_report.md` with summary/change history. |
| `OI-022` | Add `open_inquiry_ids` where useful and use `blocking`, `safe placeholder allowed`, and `future-pass only` severity. |

### 4.1 Production target and deployment model

`/center` is the production-intended private owner command center. It must remain vanilla PHP, CSS, JavaScript, and HTML. Deployment simplicity is the overriding priority: the owner should be able to download the repository files, upload them to a PHP server, keep the JSON files intact, and have the site work without GitHub calls, package installation, external libraries, or remote services.

The first rendition of `/center` should operate as a private CMS adapter for `proto/`. Its first practical function is to help a non-technical owner specify public-site edits, understand which JSON/source files those edits affect, and prepare excellent, precise public-site changes. Direct write/publish behavior is **not** part of this pass, but the code/doc structure should make it obvious where direct writes, CSS variable controls, compound-effect controls, and manual JSON editing review surfaces will eventually plug in.

### 4.2 First-pass interactivity

For this pass, create mock form layouts in documentation rather than rendered live forms when the interaction would imply editing, saving, publishing, uploading, deleting, approving, or direct public-site control.

Prepare the next session for disabled action controls and read-only action checklists, but do not overbuild them now. If a rendered page needs to mention a future action, express it as a read-only checklist or explanatory panel, not a working form.

### 4.3 First-class modules for this pass

For this immediate pass, make these the first-class owner-facing modules:

1. Dashboard.
2. Priority Board.
3. Release Gates.
4. Provenance Ledger.
5. Integrity Checks.

All other pages may remain accessible through System Map until populated, but they should not be visually promoted as first-class production modules yet.

Prepare the next session to elevate these modules for the `/center`-to-`proto` editing workflow:

1. Dashboard.
2. Priority Board.
3. Settings Inventory.
4. SSOT Library.
5. Decision Log.
6. Tasks / Launch.
7. Website CMS Drafts.
8. System Map.
9. Integrity Checks.

Defer deeper production utility work for Release Gates, Provenance Ledger, Records, Record Detail, Timeline Registry, Cue Staging, Asset Inventory, Rights & Safety, Operator Outputs, Booking / Contacts, Rehearsal / Prep, Media Intake, and Marketing Planner until later sessions, except where minimal metadata is needed to keep the current scaffold coherent.

### 4.4 `/center` relationship to `proto/`

`/center` should govern `proto/` through readiness tracking and release-package metadata first. It should know which `proto/` routes, language tokens, assets, CTAs, CSS variables, and future UI controls are affected by an intended owner edit.

Direct writes to `proto/`, direct CSS variable updates, direct language-token saves, and compound effect controls are in the immediate future pipeline but are deferred. Public changes remain manual until publishing controls, auth, audit, backups, rollback, review gates, and preview checks exist.

The long-term owner UI should become a cabinet of buttons, sliders, text fields, checkboxes, radio buttons, color pickers, dropdowns, and context-aware raw JSON review/editing surfaces that let a non-technical owner control the public website precisely. This pass should document and scaffold that direction without implementing live mutation.

### 4.5 Readiness status model

Use four explicit content/readiness statuses:

- `draft`.
- `internal-ready`.
- `venue-ready`.
- `public-ready`.

Treat `show-ready` as a separate checklist result, not a content status.

### 4.6 Role model

Use only these owner-side roles in scaffold data and documentation unless a canonical source requires otherwise:

- `Developer` or `D`: the author/developer of the scripts and codebase direction.
- `Owner / Performer`: the owner of the production and the only performer.

Do not introduce crew/team/personnel claims into public copy, marketing copy, or public-site scaffolding. If internal pages need responsibility labels, phrase them around `Developer` and `Owner / Performer` rather than inventing a larger team.

### 4.7 Conflict and provenance policy

For low-risk wording and label conflicts, prefer the newest modified source only when it does not affect legal, safety, event, rights, date, contact, approval, technical, or public claims.

For legal, safety, event facts, rights, contacts, approvals, cue details, technical limits, public claims, or contradictory authoritative sources, create Integrity findings and Decision Log entries. Do not silently choose a truth.

Use these provenance levels:

- `source canon`.
- `machine companion`.
- `settings contract`.
- `app seed`.
- `owner overlay`.
- `generated output`.
- `archived reference`.

Preserve all prior owner renditions indefinitely as design studies, but exclude them from production route and data authority. Create or update a migration checklist mapping retained prior-rendition features into `/center` modules.

### 4.8 Release gate evidence

Use a generic evidence object now and specialize evidence per gate family later. The generic shape should be scaffold-ready and may include:

- `evidence_summary`.
- `evidence_source_files`.
- `evidence_status`.
- `review_state`.
- `reviewer_role` using only the allowed role model unless otherwise required.
- `last_reviewed`.
- `blocking_reason`.
- `next_action`.

Do not claim a gate is approved without evidence.

### 4.9 Settings-driven routing direction

Move navigation direction away from purely app-local PHP. Add or prepare metadata that points toward settings-backed labels, routes, CTAs, and vocabulary. Generate routes from settings for all pages where practical in this pass.

If any part of settings-driven routing is not included because of complexity, missing source data, risk, or scope, document exactly what was not included and why.

Do not break the current router. Keep pages safe if settings files are missing or incomplete.

### 4.10 Visual style and accessibility posture

For `/center`, keep the UI almost neutral/admin-like. Reserve the strongest theatrical styling for public `proto/` pages and marketing previews. It is acceptable to retain subtle black/chrome/fire accents as orientation cues, but readability and deployment simplicity come first.

Reserve dedicated accessibility work until a final quality pass after the core system settles. Do not add accessibility language merely for the sake of mentioning accessibility. If accessibility naturally belongs to another topic, such as labels, focus, semantic controls, public release gates, or usable owner controls, it may be mentioned briefly.

### 4.11 Storage and backup posture

Default retention can remain `TBD until deployment architecture is selected` across all storage docs. Do not store secrets, credentials, real private contacts, approvals, private pricing, or sensitive files in repository storage placeholders.

### 4.12 Validation policy

Start with one-line validation commands and inline PHP checks because the repo is lightweight and vanilla. Also create a single dependency-free `center/scripts/validate.php` that checks PHP syntax, navigation templates, SSOT paths, Timeline/GEN fields, and release gate consistency if it can be done safely and simply.

### 4.13 Report flow

Create `center/docs/reports/` if it does not exist. Keep one living implementation report with a top summary and change history. Treat `center/docs/horizontal_scaffolding_refinement_report.md` as the implementation pass report: what changed, why it stayed horizontal, what was preserved, what remains placeholder-only, and recommended next pass.

### 4.14 Inquiry severity and traceability

Add an `open_inquiry_ids` field to module contracts and seed records where applicable so pages can display which unresolved or owner-answered questions affect them.

Use inquiry severity levels:

- `blocking`.
- `safe placeholder allowed`.
- `future-pass only`.

Only blocking inquiries should stop implementation. Build work may continue behind visible warnings, but unresolved inquiries must be resolved before any public-ready status or show-ready checklist result is assigned.

---

## 5. Implementation mission for this fresh session

Perform a coherent horizontal implementation pass that applies the owner-answer policy above.

Prioritize:

1. A deployment-simple `/center` direction that can be uploaded to a PHP server with local JSON files intact and no external dependency calls.
2. Documentation and data contracts that make `/center` a private CMS adapter for `proto/` in direction, without live mutation yet.
3. First-class treatment for Dashboard, Priority Board, Release Gates, Provenance Ledger, and Integrity Checks.
4. System Map access and contracts for all other modules without overpromoting unfinished pages.
5. Settings-driven navigation metadata and route generation where practical, with documented reasons for anything deferred.
6. Mock form layouts in docs for future owner controls over `proto/` edits, CSS variables, compound effects, raw JSON review, route edits, language-token edits, CTA edits, and asset references.
7. Generic release-gate evidence objects.
8. Provenance level alignment.
9. `timeline_moment_id_or_gen` as canonical and removal/avoidance of `GEN-PENDING-REVIEW` in favor of `GEN` plus `status: needs_timeline_review`.
10. `open_inquiry_ids` and inquiry severity metadata where useful.
11. A lightweight `center/scripts/validate.php` if simple enough to implement safely.
12. A clear implementation report and, if useful, a prior-rendition migration checklist.

---

## 6. Suggested high-leverage files to add or update

Choose the smallest coherent set that accomplishes the mission. Likely targets include:

```text
center/README.md
center/config/app.php
center/data/navigation.php
center/data/schema.php
center/data/priority_board_seed.php
center/data/release_gate_matrix.php
center/data/source_provenance_schema.php
center/data/module_contracts.php
center/data/proto_editing_contracts.php
center/data/integrity_checks_seed.php
center/includes/bootstrap.php
center/includes/functions.php
center/includes/settings.php
center/includes/ssot.php
center/includes/records.php
center/partials/components.php
center/pages/dashboard.php
center/pages/priority-board.php
center/pages/release-gates.php
center/pages/provenance-ledger.php
center/pages/integrity.php
center/pages/system-map.php
center/pages/settings-inventory.php
center/pages/ssot-library.php
center/pages/website-cms-drafts.php
center/assets/css/center.css
center/assets/js/center.js
center/storage/README.md
center/storage/cache/README.md
center/storage/exports/README.md
center/storage/overlays/README.md
center/storage/uploads/README.md
center/scripts/validate.php
center/docs/horizontal_scaffolding_refinement_report.md
center/docs/reports/README.md
center/docs/prior_rendition_migration_checklist.md
center/docs/proto_cms_adapter_plan.md
center/docs/proto_owner_control_mockups.md
```

You do **not** need to touch every file listed. Prefer a coherent, low-churn pass over a scattered diff.

---

## 7. Specific module and content expectations

### 7.1 Dashboard

The Dashboard should clearly state that `/center` is the private owner command center and first-stage CMS adapter direction for `proto/`. It should surface the first-class modules, unresolved blockers, current readiness posture, and next owner/developer actions.

### 7.2 Priority Board

The Priority Board should focus on implementation sequence and owner/developer decisions for `proto` editing, SSOT canon visibility, release readiness, provenance, and integrity. It may reference deferred modules, but should not pretend they are production utilities yet.

### 7.3 Release Gates

Release Gates should use generic evidence objects and the four readiness statuses. It should never mark public-ready without evidence. It should protect brand affiliation, rights, copy, media, privacy, technical disclosure, venue, and safety-sensitive content.

### 7.4 Provenance Ledger

Provenance Ledger should use the owner-approved provenance levels and make clear which files are source canon, machine companions, settings contracts, app seeds, owner overlays, generated outputs, and archived references.

### 7.5 Integrity Checks

Integrity should check or scaffold checks for:

- PHP syntax.
- JSON syntax.
- Navigation template existence.
- Settings manifest path resolution.
- SSOT/master-index path resolution.
- Missing `timeline_moment_id_or_gen`.
- Presence of deprecated `GEN-PENDING-REVIEW`.
- `status: needs_timeline_review` records that are also approved/exported/public-ready/show-ready.
- Release gate rows with missing generic evidence.
- Source conflicts needing Decision Log entries.
- Missing or invalid `open_inquiry_ids` where applicable.

### 7.6 System Map

System Map should expose all modules and deferred pages without overpromoting them. It should clearly distinguish first-class modules, next-session modules, deferred modules, and reference-only prior renditions.

### 7.7 Settings Inventory and SSOT Library

These modules should support the immediate `/center`-to-`proto` edit-specification direction by showing where settings, language tokens, route definitions, CTAs, style guidance, technical-disclosure rules, and data contracts come from.

### 7.8 Website CMS Drafts and proto edit mockups

Do not implement live edits. Instead, add documentation and/or data contracts that show how future owner-friendly controls will map to:

- `proto` route/page.
- language token or JSON path.
- CSS variable.
- compound-effect control.
- CTA.
- media/asset reference.
- public/private disclosure tier.
- release gate state.
- manual raw JSON review/edit location.
- rollback/audit requirements.

### 7.9 Deferred modules

Keep deeper work deferred for Records, Record Detail, Timeline Registry, Cue Staging, Asset Inventory, Rights & Safety, Operator Outputs, Booking / Contacts, Rehearsal / Prep, Media Intake, and Marketing Planner unless small metadata changes are needed for consistency.

Cue migration is explicitly deferred.

---

## 8. Do not implement yet

Do **not**:

- Add full CRUD.
- Add login/auth implementation.
- Add upload handling.
- Add database migrations.
- Add composer/npm/package managers/frameworks.
- Add external API or GitHub runtime calls.
- Add live public publishing behavior.
- Add direct writes from `/center` to `proto/`.
- Store real private contacts, secrets, credentials, approvals, private pricing, or sensitive files.
- Promote `docs/cue.txt` to show-ready truth.
- Use `GEN-PENDING-REVIEW`.
- Treat placeholder seeds as canonical production data.
- Mention accessibility merely for the sake of mentioning accessibility.
- Add public copy that suggests a larger team, crew, official affiliation, sponsorship, clearance, ownership, authorization, or endorsement.

---

## 9. Required report

Write or update:

```text
center/docs/horizontal_scaffolding_refinement_report.md
```

Also create `center/docs/reports/` if helpful for report organization.

The report must explain:

- what files or file families were refined;
- how the owner’s open-inquiry answers were applied;
- why the pass stayed horizontal and did not build live publishing/auth/uploads/CRUD;
- how `/center` now points toward being a private CMS adapter for `proto/`;
- how the five first-class modules were emphasized;
- what remains deferred and why;
- how Timeline/GEN, provenance, release gates, readiness statuses, inquiry severity, and safe-edit boundaries were preserved;
- what validation was run;
- recommended next pass.

---

## 10. Validation checklist

Run relevant checks before finalizing:

```bash
find center -type f -name '*.php' -print0 | xargs -0 -n1 php -l
find docs/ssot -type f -name '*.json' -print0 | xargs -0 -n1 python3 -m json.tool >/dev/null
php -r '$nav=require "center/data/navigation.php"; foreach($nav as $id=>$m){$p="center/pages/".$m["template"]; if(!is_file($p)){fwrite(STDERR,"missing $id $p\n"); exit(1);} } echo "navigation templates ok\n";'
if [ -f center/scripts/validate.php ]; then php center/scripts/validate.php; fi
php -S 127.0.0.1:8093 -t center >/tmp/center-owner-answered-server.log 2>&1 & echo $! > /tmp/center-owner-answered-server.pid
sleep 1
curl -fsS 'http://127.0.0.1:8093/?page=dashboard' >/tmp/center-owner-answered-dashboard.html
curl -fsS 'http://127.0.0.1:8093/?page=priority-board' >/tmp/center-owner-answered-priority-board.html
curl -fsS 'http://127.0.0.1:8093/?page=release-gates' >/tmp/center-owner-answered-release-gates.html
curl -fsS 'http://127.0.0.1:8093/?page=provenance-ledger' >/tmp/center-owner-answered-provenance-ledger.html
curl -fsS 'http://127.0.0.1:8093/?page=integrity' >/tmp/center-owner-answered-integrity.html
curl -fsS 'http://127.0.0.1:8093/?page=system-map' >/tmp/center-owner-answered-system-map.html
kill $(cat /tmp/center-owner-answered-server.pid)
git status --short
```

If a command fails because of an environment limitation, report it clearly. If it fails because of your code, fix it before committing.

---

## 11. Definition of done

This owner-answered scaffolding pass is successful when:

- The repository state has been refreshed or refresh was explicitly attempted and explained.
- The prompt set, canon docs, SSOT/settings layer, `/center`, `proto`, prior renditions, open inquiries, and answer docs have been studied.
- `/center` is clearly documented as the production-intended vanilla PHP private owner command center and first-stage CMS adapter direction for `proto/`.
- Deployment simplicity is preserved: no package manager, no external runtime services, no remote GitHub dependency, and local JSON/file structure remains usable after upload to a PHP server.
- Dashboard, Priority Board, Release Gates, Provenance Ledger, and Integrity are treated as the first-class modules for this pass.
- Other modules remain accessible through System Map or documented contracts without pretending they are production-ready utilities.
- Settings-driven route/navigation metadata is advanced where practical, with deferred parts documented.
- Mock owner-control form layouts are documented, not implemented as live writes.
- `timeline_moment_id_or_gen` is canonical and `GEN-PENDING-REVIEW` is removed or flagged for replacement with `GEN` plus `status: needs_timeline_review`.
- Cue migration remains deferred.
- Provenance levels, generic release-gate evidence, readiness statuses, disclosure tiers, owner roles, conflict handling, storage TBD retention, and open-inquiry severity are reflected in code/docs/data contracts where useful.
- A report explains what changed and what remains deferred.
- PHP syntax, JSON syntax, navigation-template consistency, optional validation script, and route smoke checks pass.
