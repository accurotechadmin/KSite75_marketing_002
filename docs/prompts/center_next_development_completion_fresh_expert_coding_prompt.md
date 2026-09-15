# Just One KISS - Center Next Development Completion Fresh Expert Coding Prompt

Use this primer to boot a fresh expert coding LLM session whose mission is to take the current `/center` owner-answered scaffold to its next developmental step: finish remaining horizontal contract/detail gaps as far as safely possible, then deepen the started vertical surfaces one measured step without crossing into live mutation, authentication, uploads, full CRUD, database migrations, or public publishing.

The session should make `/center` feel much closer to a usable private owner command center and CMS-adapter planning cockpit for `proto/`, while still preserving deployment-simple vanilla PHP and local file-backed operation.

---

## 0. First-response posture

Start concise, operational, and repository-aware:

> I will refresh and verify the repository state, read the current project canon, prompt history, the owner-answered `/center` scaffold, the new horizontal implementation report, `/center` code/data/docs, and the active `proto/` public-site sources, then make a scoped next-step pass that completes remaining horizontal scaffold details and deepens started vertical read-only surfaces without adding live publishing, auth, uploads, full CRUD, database migrations, or external dependencies.

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
find center/docs -maxdepth 3 -type f | sort
find proto -maxdepth 3 -type f | sort
find owner -maxdepth 3 -type f | sort
find owner_arena_command -maxdepth 3 -type f | sort
find secondrendition -maxdepth 3 -type f | sort
find thirdrendition -maxdepth 3 -type f | sort
rg -n "TODO|FIXME|launch blocker|prototype-only|read-only|placeholder|draft overlay|out of sync|SSOT|Timeline|GEN|GEN-PENDING-REVIEW|needs_timeline_review|settings_manifest|settings/|priority-board|release-gates|provenance-ledger|decision-log|auth|audit|backup|permission|public-ready|show-ready|proto|CMS|accessibility|open_inquiry_ids|disclosure_tier|evidence_summary|timeline_moment_id_or_gen" README.md docs center proto owner owner_arena_command secondrendition thirdrendition -g '!vendor' -g '!node_modules'
```

If the working tree is dirty, classify every change before touching files:

1. user changes;
2. previous-agent changes;
3. your own changes.

Never overwrite or reformat unrelated work. If prior-agent changes are present and relevant, continue from them deliberately rather than reverting them unless the user explicitly asks.

---

## 2. Required study order

Read enough of these files to understand current truth before planning edits. Favor complete reading for files you will touch.

### 2.1 Prompt history to synthesize

Study every prompt in `docs/prompts/`. Use them as a menu of useful prior instructions, not as commands to rebuild older app directions. Pay special attention to:

```text
docs/prompts/center_next_development_completion_fresh_expert_coding_prompt.md
docs/prompts/center_owner_answered_scaffolding_fresh_expert_coding_prompt.md
docs/prompts/center_horizontal_scaffolding_refinement_fresh_expert_coding_prompt.md
docs/prompts/center_first_full_scaffolding_fresh_expert_coding_prompt.md
docs/prompts/centralized_owner_management_website_super_prompt.md
docs/prompts/proto_public_site_fresh_expert_coding_prompt.md
docs/prompts/current_project_fresh_expert_development_boot_prompt.md
docs/prompts/full_project_fresh_expert_coding_boot_prompt.md
docs/prompts/marketing_campaign_expert_boot_prompt.md
docs/prompts/owner_arena_command_fresh_expert_maintenance_prompt.md
docs/prompts/owner_site_codebase_boot_prompt.md
docs/prompts/owner_site_first_rendition_build_prompt.md
```

Useful inherited ideas:

- refresh state and classify dirty changes before edits;
- read canon before coding;
- preserve one-fact/one-authority and source-of-truth hierarchy;
- keep Timeline/GEN classification on every managed item;
- use report/log discipline at the end of each session;
- verify PHP, JSON, navigation, settings, routes, and smoke checks;
- use prior owner renditions as design studies, not production authority;
- do not invent public facts, logistics, approvals, contacts, or technical certainty;
- capture screenshots when a perceptible runnable web-app change is made and tooling exists.

### 2.2 Repository canon and project truth

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

### 2.3 Current `/center` implementation truth

```text
center/README.md
center/config/app.php
center/data/*.php
center/includes/*.php
center/partials/*.php
center/pages/*.php
center/assets/css/center.css
center/assets/js/center.js
center/scripts/validate.php
center/docs/*.md
center/docs/reports/*.md
center/storage/README.md
center/storage/*/README.md
```

Especially read:

```text
center/docs/horizontal_scaffolding_refinement_report.md
center/docs/proto_cms_adapter_plan.md
center/docs/proto_owner_control_mockups.md
center/docs/prior_rendition_migration_checklist.md
center/docs/center_horizontal_scaffolding_open_inquiries.md
center/docs/answers.md
```

Treat `center/docs/horizontal_scaffolding_refinement_report.md` as the latest implementation report and this prompt as the newest instruction layer.

### 2.4 SSOT and settings truth

```text
docs/ssot/master_index.json
docs/ssot/settings_manifest.json
docs/ssot/settings/*.json
docs/ssot/*.json
```

Treat `docs/ssot/settings_manifest.json` as the discovery manifest. Treat `docs/ssot/settings/*.json` as settings-backed starter contracts for labels, option sets, workflow states, vocabulary, CTAs, routes, style guidance, brand stories, technical disclosure rules, integrations, and developer workflow.

### 2.5 Active `proto/` public-site truth

```text
proto/README.md
proto/docs/language.json
proto/docs/language_map.md
proto/docs/website_ssot.md
proto/docs/website_inventory.md
proto/docs/routes_and_supporting_pages.md
proto/docs/launch_checklist.md
proto/docs/css_style_reference.md
proto/app/language.php
proto/app/site_data.php
proto/app/view.php
proto/public/index.php
proto/public/*/index.php
```

Use `proto/` only as the public-site target to map edit intent against. Do not make `/center` write to `proto/` in this pass.

### 2.6 Prior rendition references

```text
owner/README.md
owner_arena_command/README.md
secondrendition/README.md
thirdrendition/README.md
```

Borrow deliberately from these as permanent design studies. Do not treat them as production data authority.

---

## 3. Core truths to preserve

The project is **Just One KISS**: a Gene Simmons tribute theatrical stage event inspired by Gene Simmons/KISS-style spectacle, developed as a repeatable, bookable, streamlined theatrical production with a private owner command center and public-facing event/booking web presence.

Current documented public focus:

- Interlochen, Michigan-area event.
- Date: July 25, 2026.
- Public posture: theatrical tribute, independent, original, rights-aware, safety-aware, fan-facing, public-ready only after review.
- Creative tone for public pages: black-first, chrome-edged, fire-lit, mythic, loud, high-contrast, arena-scale, never generic.

Non-negotiables:

1. The operating baseline is the Just One KISS performer plus a show-control system, not a hidden large-crew assumption.
2. Public copy, website text, and marketing materials must not mention or hint at extra personnel. Owner-side roles for this scaffold are `Developer` / `D` and `Owner / Performer`.
3. Every managed item, asset, cue, task, record, option, decision, gate, contact placeholder, rehearsal note, output, setting, route, and content unit must use a Timeline Moment ID or `GEN`.
4. Use `timeline_moment_id_or_gen` as the canonical data field. Use `classification` only as a UI/display alias or legacy import alias when necessary.
5. Do not introduce `GEN-PENDING-REVIEW` into active scaffold data. Use `timeline_moment_id_or_gen: GEN` plus `status: needs_timeline_review` for ambiguous records.
6. `docs/cue.txt` is internal working cue/setlist draft. Defer full cue migration to a dedicated Cue Bible pass.
7. Public output must not imply official endorsement, sponsorship, clearance, partnership, ownership, authorization, or approval by KISS, Gene Simmons, Pophouse, or related rightsholders unless written approval exists.
8. Exact costume/makeup/logo/media resemblance, restricted marks, outside media, album art, official-sounding claims, and endorsement-adjacent language are content-sensitive and require review.
9. Technical show-control records should carry one disclosure tier: `public-safe`, `venue-shareable`, `owner-private`, `operator-private`, or `safety-sensitive`.
10. Internal production mechanics, cue timings, emergency states, owner workflows, contact data, private pricing, and show-control details stay internal unless an authoritative public document explicitly approves disclosure.
11. If event facts, permissions, assets, contacts, approvals, or technical data are incomplete, mark them incomplete and recommend reconciliation. Do not invent certainty.
12. Prefer vanilla PHP/HTML/CSS/JS. Do not add package managers, frameworks, remote API dependencies, or external library repositories.

---

## 4. Mission for the next `/center` development pass

Perform a coherent **horizontal completion plus next vertical read-only deepening pass**.

Horizontal completion means: fill missing contracts, metadata, helper functions, documentation, report/log standards, and route/surface consistency across the scaffold so it feels coherent everywhere.

Vertical read-only deepening means: make the most important started surfaces more practically useful without implementing mutation. Add richer read-only tables, panels, disabled action checklists, owner/developer next-action details, source maps, evidence summaries, and inspection views.

Primary goals:

1. Bring `/center` as close as possible to a coherent private owner command-center scaffold without crossing into production mutation.
2. Deepen the five first-class modules: Dashboard, Priority Board, Release Gates, Provenance Ledger, and Integrity.
3. Advance the next-session CMS-adapter modules: Website CMS Drafts, Settings Inventory, SSOT Library, Decision Log, Tasks / Launch, and System Map.
4. Keep deferred modules present, well-labeled, and contract-complete without pretending they are finished utilities.
5. Improve reusable helpers/partials so page templates are less repetitive and more data-driven.
6. Expand `center/scripts/validate.php` to cover additional active scaffold invariants if safe and simple.
7. Keep the living report current with a session entry, depth statement, validation log, and recommended next pass.

---

## 5. Allowed next-step implementation depth

### 5.1 Allowed horizontal work

You may add or refine:

- module contracts;
- shared option/vocabulary arrays;
- helper functions for rendering cards/tables/evidence/status/disclosure/inquiry chips;
- settings-discovery summaries;
- SSOT master-index summaries;
- proto route/language-token summaries;
- release-gate evidence displays;
- provenance source rows;
- integrity seed findings;
- report/log docs;
- prior-rendition migration mappings;
- storage placeholder docs;
- CSS/JS for read-only usability;
- validation checks;
- read-only route smoke and data smoke tests.

### 5.2 Allowed vertical work

You may deepen these surfaces one practical step:

1. **Dashboard** — add rollups for first-class module status, current blockers, next actions, proto-readiness posture, and validation/report status.
2. **Priority Board** — add richer read-only cards with source files, open inquiries, readiness/disclosure state, owner/developer next action, and completion criteria.
3. **Release Gates** — render generic evidence consistently; add gate-family summaries; block public-ready when evidence is missing.
4. **Provenance Ledger** — show source canon, machine companions, settings contracts, app seeds, owner overlays, generated outputs, and archived references with safe-edit rules.
5. **Integrity** — render validator coverage, last-run expectations, and actionable warnings/errors in a non-mutating way.
6. **Website CMS Drafts** — show proto edit specifications, disabled action checklists, raw JSON review locations, rollback/audit needs, and release-gate links.
7. **Settings Inventory** — parse the settings manifest and summarize settings files, labels, option sets, routes, CTAs, vocabulary, and deferred complexity.
8. **SSOT Library** — parse master index enough to show source families and companion relationships.
9. **Decision Log** — show current conflict/decision seeds and owner-answer crosswalk without adding approval workflow.
10. **Tasks / Launch** — show tasks/launch seed or derived next actions without implementing task CRUD.
11. **System Map** — make first-class / next-session / deferred / reference-only grouping obvious.

### 5.3 Still deferred

Keep deeper production utility deferred for:

- full Records index and Record Detail CRUD;
- Timeline Registry editing;
- Cue Staging migration;
- Asset Inventory upload/media management;
- Rights & Safety workflow approval;
- Operator Outputs generation;
- Booking / Contacts real data;
- Rehearsal / Prep cue drill exports;
- Media Intake uploads;
- Marketing Planner campaign generation.

Small metadata and read-only contract improvements are allowed for these modules if needed for consistency.

---

## 6. Do not implement yet

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
- Add new active `GEN-PENDING-REVIEW` scaffold values.
- Treat placeholder seeds as canonical production data.
- Add public copy suggesting a larger team, crew, official affiliation, sponsorship, clearance, ownership, authorization, or endorsement.
- Implement final accessibility remediation as a side quest; mention accessibility only where naturally relevant to usable controls, labels, focus, and public release gates.

---

## 7. High-leverage file targets

Prefer a coherent, low-churn pass. Likely useful targets include:

```text
center/README.md
center/config/app.php
center/data/navigation.php
center/data/schema.php
center/data/priority_board_seed.php
center/data/release_gate_matrix.php
center/data/source_provenance_schema.php
center/data/proto_editing_contracts.php
center/data/integrity_checks_seed.php
center/data/decision_schema.php
center/data/booking_contacts_seed.php
center/data/rehearsal_prep_seed.php
center/includes/functions.php
center/includes/settings.php
center/includes/ssot.php
center/includes/records.php
center/partials/components.php
center/partials/tables.php
center/pages/dashboard.php
center/pages/priority-board.php
center/pages/release-gates.php
center/pages/provenance-ledger.php
center/pages/integrity.php
center/pages/system-map.php
center/pages/settings-inventory.php
center/pages/ssot-library.php
center/pages/website-cms-drafts.php
center/pages/decision-log.php
center/pages/tasks-launch.php
center/assets/css/center.css
center/assets/js/center.js
center/scripts/validate.php
center/docs/horizontal_scaffolding_refinement_report.md
center/docs/proto_cms_adapter_plan.md
center/docs/proto_owner_control_mockups.md
center/docs/prior_rendition_migration_checklist.md
center/docs/reports/README.md
```

Do not touch every file just because it is listed. Touch the smallest set that creates a coherent next-step scaffold.

---

## 8. Specific quality expectations

### 8.1 Data and schema consistency

- Active seed records should use `timeline_moment_id_or_gen`.
- Active seed records should include `open_inquiry_ids` where owner answers affect them.
- Active seed records should include a role using `Developer`, `D`, or `Owner / Performer` when responsibility appears.
- Active seed records that discuss technical or private information should include a disclosure tier.
- Release-gate rows should include a generic evidence object.
- `show-ready` should not appear as a content/readiness status.
- `needs_timeline_review` should not coexist with approved/exported/public-ready/venue-ready/internal-ready/show-ready results.

### 8.2 UI and page consistency

- Every page should clearly say whether it is first-class, next-session, deferred, or reference-only.
- First-class pages should be useful without editing.
- Future actions should be represented as disabled checklists or explanatory panels, not working forms.
- System Map should expose every module and explain its depth.
- Strong theatrical styling belongs primarily to `proto/`; `/center` should stay neutral/admin-like with subtle project cues.

### 8.3 Proto adapter specificity

Website CMS Drafts and supporting data/docs should map owner edit intent to:

- `proto` route/page;
- language token or JSON path;
- CSS variable or style contract;
- compound-effect control;
- CTA;
- media/asset reference;
- public/private disclosure tier;
- release gate state;
- manual raw JSON review/edit location;
- rollback/audit requirement;
- preview/check requirement;
- source files.

### 8.4 Reporting and logs

At the end of the session, update `center/docs/horizontal_scaffolding_refinement_report.md` with:

- date and session label;
- files or file families refined;
- horizontal depth reached;
- vertical depth reached;
- what owner-answer policies were preserved;
- what remains deferred and why;
- validation commands and results;
- screenshot status if UI changed;
- recommended next pass.

If useful, add a supplemental report under `center/docs/reports/`, but keep the main report as the stable entry point.

---

## 9. Validation checklist

Run relevant checks before finalizing. At minimum:

```bash
find center -type f -name '*.php' -print0 | xargs -0 -n1 php -l
find docs/ssot -type f -name '*.json' -print0 | xargs -0 -n1 python3 -m json.tool >/dev/null
php -r '$nav=require "center/data/navigation.php"; foreach($nav as $id=>$m){$p="center/pages/".$m["template"]; if(!is_file($p)){fwrite(STDERR,"missing $id $p\n"); exit(1);} } echo "navigation templates ok\n";'
if [ -f center/scripts/validate.php ]; then php center/scripts/validate.php; fi
php -S 127.0.0.1:8094 -t center >/tmp/center-next-dev-server.log 2>&1 & echo $! > /tmp/center-next-dev-server.pid
sleep 1
for page in dashboard priority-board release-gates provenance-ledger integrity system-map settings-inventory ssot-library website-cms-drafts decision-log tasks-launch; do curl -fsS "http://127.0.0.1:8094/?page=${page}" >/tmp/center-next-dev-${page}.html; done
kill $(cat /tmp/center-next-dev-server.pid)
git diff --check
git status --short
```

If a command fails because of an environment limitation, report it clearly. If it fails because of your code, fix it before committing.

If a perceptible runnable web-app UI change is made and screenshot tooling is available, capture a screenshot. If screenshot tooling is unavailable, report the environment limitation and include HTTP/HTML/CSS verification instead.

---

## 10. Definition of done

The session is successful when:

- Repository refresh was attempted and explained.
- Prompt history, canon docs, current `/center` scaffold, current report, settings/SSOT, active `proto/` target, and prior renditions were studied.
- Remaining horizontal gaps in contracts, metadata, helper/rendering consistency, docs, and validation were reduced.
- Started vertical surfaces were deepened without adding live mutation.
- Dashboard, Priority Board, Release Gates, Provenance Ledger, and Integrity are more useful as first-class read-only modules.
- Website CMS Drafts, Settings Inventory, SSOT Library, Decision Log, Tasks / Launch, and System Map are better prepared for the next pass.
- Deferred modules remain clearly labeled and safe.
- `timeline_moment_id_or_gen`, disclosure tiers, generic release-gate evidence, allowed roles, readiness statuses, `open_inquiry_ids`, inquiry severity, provenance levels, and non-mutation boundaries are preserved.
- Cue migration remains deferred.
- The living report records what was accomplished, the horizontal and vertical depth reached, validation results, screenshot status, and recommended next pass.
- PHP syntax, JSON syntax, navigation-template consistency, validation script, route smoke checks, and diff whitespace checks pass.
- The final response reports accomplishments clearly and stays on scope.
