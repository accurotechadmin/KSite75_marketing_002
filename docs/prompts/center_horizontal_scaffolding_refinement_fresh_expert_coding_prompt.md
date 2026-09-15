# Just One KISS - Center Horizontal Scaffolding Refinement Fresh Expert Coding Prompt

Use this primer to boot a fresh expert coding LLM session whose mission is to **refresh the repository after the merged first full `/center` scaffolding pass** and perform the next horizontal refinement pass across the seed codebases that will determine the direction of the full centralized owner-management website.

This is **not** a request to vertically build one module to production depth. Do not spend the session implementing full CRUD, uploads, auth, a database, publishing, or complete feature workflows. The goal is to move across the whole `center/` surface and add the small but important scaffold details, helper contracts, field names, warnings, source hooks, comments, route checks, and documentation refinements that make every file a better foundation for later production work.

---

## 0. First-response posture

Start concise, operational, and repository-aware:

> I will refresh and verify the merged repository state, read the current `/center` scaffold and canon sources, then perform a horizontal site-wide refinement pass that improves scaffold consistency, source provenance, Timeline/GEN discipline, release gates, seed contracts, and adapter-ready future paths without overbuilding vertical workflows.

Then inspect before making claims or edits.

---

## 1. Refresh and immediate boot commands

Run these from the repository root before making claims. Use `find`, `rg`, `sed`, `nl -ba`, `php -l`, `python3 -m json.tool`, and targeted scripts. Do **not** use `ls -R` or `grep -R`.

If network/remotes are available, refresh from the current branch before editing. If refresh is impossible because the environment has no remote or credentials, state that and continue from the live tree.

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
find center/docs -maxdepth 1 -type f | sort
find owner -maxdepth 3 -type f | sort
find owner_arena_command -maxdepth 3 -type f | sort
find secondrendition -maxdepth 3 -type f | sort
find thirdrendition -maxdepth 3 -type f | sort
find proto -maxdepth 3 -type f | sort
rg -n "TODO|FIXME|launch blocker|prototype-only|read-only|placeholder|draft overlay|out of sync|SSOT|Timeline|GEN|settings_manifest|settings/|priority-board|release-gates|provenance-ledger|decision-log|auth|audit|backup|permission|public-ready|show-ready" README.md docs center owner owner_arena_command secondrendition thirdrendition proto -g '!vendor' -g '!node_modules'
```

If the working tree is dirty, classify every change before touching files:

1. user changes;
2. previous-agent changes;
3. your own changes.

Never overwrite or reformat unrelated work.

---

## 2. Required study order

Read enough of these files to understand the current truth before planning edits.

### 2.1 Repository canon and owner/public truth

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

### 2.2 Prompt and previous-pass truth

```text
docs/prompts/center_first_full_scaffolding_fresh_expert_coding_prompt.md
center/docs/scaffold_inventory.md
center/docs/center_scaffolding_inception_expansion_report.md
center/docs/center_first_full_scaffolding_decision_report.md
center/docs/module_scaffolding_checklist.md
center/docs/priority_board_model.md
center/docs/public_release_gate_policy.md
center/docs/canon_sync_policy.md
center/docs/future_persistence_and_auth_plan.md
```

### 2.3 SSOT and settings truth

```text
docs/ssot/master_index.json
docs/ssot/settings_manifest.json
docs/ssot/settings/*.json
docs/ssot/*.json
```

Treat `docs/ssot/settings_manifest.json` as the discovery manifest. Treat `docs/ssot/settings/*.json` as settings-backed starter contracts for labels, option sets, workflow states, vocabulary, CTAs, routes, style guidance, brand stories, technical disclosure rules, integrations, and developer workflow. Do not hard-code settings-backed facts if a loader helper, schema contract, or seed declaration can preserve future configurability.

### 2.4 Active `/center` files to inspect horizontally

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

### 2.5 Reference surfaces to borrow from, not fork

```text
owner/README.md
owner_arena_command/README.md
secondrendition/README.md
thirdrendition/README.md
proto/README.md
```

Use earlier owner renditions for proven scaffold patterns such as dashboard cards, record cards, source drilldowns, JSON library views, integrity checks, run-book outputs, owner-first navigation, and black/chrome/fire visual language. Use `proto/` as the public-facing output target that `/center` should govern, not as a place to leak internal mechanics.

---

## 3. Core truths to preserve

The project is **Just One KISS**: a Gene Simmons tribute theatrical stage event inspired by Gene Simmons/KISS-style spectacle. It is being developed as a repeatable, bookable, streamlined theatrical production with a private owner command center and a public-facing event/booking web presence.

Current documented public focus:

- Interlochen, Michigan-area event.
- Date: July 25, 2026.
- Public posture: theatrical tribute, independent, original, rights-aware, safety-aware, fan-facing, public-ready only after review.
- Creative tone: black-first, chrome-edged, fire-lit, mythic, loud, high-contrast, arena-scale, never generic.

Non-negotiables:

1. The operating baseline is the Gene Simmons tribute performer plus a show-control system, not a large hidden crew assumption.
2. Every managed item, asset, cue, task, record, option, decision, gate, contact placeholder, rehearsal note, output, setting, route, and content unit must be tied to a Timeline Moment ID or marked `GEN` / GENERAL / NOT TIMELINE-SPECIFIC.
3. Timeline-specific records use governed ID families such as `PRE-###`, `OPEN-###`, `SET-###`, `SONG-###`, `TRN-###`, `CST-###`, `VID-###`, `LGT-###`, `FOG-###`, `STR-###`, `SPK-###`, `FIN-###`, `ENC-###`, `POST-###`, or `GEN`.
4. `docs/cue.txt` is an internal working cue/setlist draft until migrated, reviewed, and promoted.
5. Public output must not imply official endorsement, sponsorship, clearance, partnership, ownership, or authorization by KISS, Gene Simmons, Pophouse, or related rightsholders unless written approval exists.
6. Exact costume/makeup/logo/media resemblance, restricted marks, outside media, album art, official-sounding claims, and endorsement-adjacent language are content-sensitive and require review.
7. Fog, strobes, bright lights, projection, loud sound, blackout states, moving lights, drops/platforms, venue-dependent effects, and safety-sensitive show-control detail must remain safety-gated and venue-aware.
8. Internal production mechanics, cue timings, emergency states, owner workflows, contact data, private pricing, and show-control details should stay internal unless an authoritative public document explicitly approves disclosure.
9. If event facts, permissions, assets, contacts, approvals, or technical data are incomplete, mark them incomplete and recommend reconciliation. Do not invent certainty.
10. Prefer the existing vanilla PHP/HTML/CSS/JS approach unless explicitly instructed otherwise.

---

## 4. Mission: horizontal refinement, not vertical feature build

Perform a repository-aware horizontal refinement pass over the merged `/center` inception scaffold.

The desired result is that **every seed codebase file becomes a better directional foundation** for future sessions. This means adding small, consistent, high-leverage details across many files rather than deeply implementing one feature.

Focus on:

1. Consistent file header comments that state purpose, contents, source dependencies, prototype/read-only status, and future migration path.
2. Consistent module scaffolding vocabulary across pages, data seeds, docs, includes, partials, storage docs, CSS, and JS.
3. Missing seed fields that future modules will need, especially provenance, review gates, Timeline/GEN classification, owner actions, linked records, audit placeholders, and adapter metadata.
4. Reusable helpers that make existing scaffolds more consistent without adding a framework or package manager.
5. Tiny page-level improvements that make every route render more informative and safer.
6. Documentation polish that helps future coding sessions understand how to extend the scaffold without rereading every historical prompt.
7. Validation scripts or simple checks only if they fit the vanilla repo and do not introduce dependency weight.

Do **not**:

- Build full CRUD.
- Add login/auth implementation.
- Add upload handling.
- Add database migrations unless asked.
- Add package managers or frameworks.
- Create public publishing behavior.
- Store real private contacts, secrets, credentials, or approvals.
- Promote `docs/cue.txt` to show-ready truth.
- Treat placeholder seeds as canonical production data.

---

## 5. Horizontal refinement targets

### 5.1 `/center` documentation

Review and improve, as needed:

```text
center/README.md
center/docs/scaffold_inventory.md
center/docs/center_scaffolding_inception_expansion_report.md
center/docs/center_first_full_scaffolding_decision_report.md
center/docs/module_scaffolding_checklist.md
center/docs/priority_board_model.md
center/docs/public_release_gate_policy.md
center/docs/canon_sync_policy.md
center/docs/future_persistence_and_auth_plan.md
```

Look for small additions such as:

- a shared glossary of scaffold terms (`placeholder`, `prototype-only`, `read-only`, `draft overlay`, `canonical`, `derived copy`, `generated output`, `public-ready`, `show-ready`);
- a site-wide module acceptance checklist;
- explicit “what not to implement yet” language;
- a cross-file map linking each docs policy to pages/data/includes that enforce it;
- clearer statement that public releases require gate approval and internal mechanics stay private;
- better future-session handoff instructions.

### 5.2 Data seeds and schema contracts

Review and improve, as needed:

```text
center/data/navigation.php
center/data/schema.php
center/data/priority_board_seed.php
center/data/decision_schema.php
center/data/release_gate_matrix.php
center/data/source_provenance_schema.php
center/data/booking_contacts_seed.php
center/data/rehearsal_prep_seed.php
```

Look for small additions such as:

- uniform `classification` / `timeline_moment_id_or_gen` presence;
- uniform `source_files`, `linked_records`, `owner_role`, `next_action`, `last_updated`, `review_gate`, `public_private_boundary`, `migration_target`, and `adapter_notes` fields where relevant;
- enums for statuses/columns/gate states/provenance states/contact types/prep types;
- schema sections for module contracts, route contracts, output contracts, source contracts, setting contracts, and integrity findings;
- field names that align across seeds so later normalization does not require translation glue;
- comments explaining whether a data file is canonical seed, prototype-only app seed, or future overlay contract.

Keep seed data intentionally small. Improve the contract more than the number of example rows.

### 5.3 Includes, loaders, and helpers

Review and improve, as needed:

```text
center/includes/bootstrap.php
center/includes/functions.php
center/includes/settings.php
center/includes/ssot.php
center/includes/records.php
```

Look for small additions such as:

- helper functions for safe array access, list formatting, file existence checks, module metadata, route-template consistency, status normalization, Timeline/GEN validation, or source path display;
- read-only guardrail constants or comments;
- manifest/master-index path-check scaffolds;
- integrity helper functions that return structured findings instead of only comments;
- adapter boundary comments so later database/API/CMS work knows where to plug in.

Keep all includes direct and readable. Do not wrap imports in try/catch blocks.

### 5.4 Partials and UI scaffolding

Review and improve, as needed:

```text
center/partials/*.php
center/assets/css/center.css
center/assets/js/center.js
```

Look for small additions such as:

- reusable warning, empty-state, source-list, metadata, status-pill, and disabled-action components;
- accessible labels and focus states;
- CSS classes for scaffold tables, cards, warning strips, status pills, source lists, and module metadata;
- JS that is clearly progressive enhancement only and safe if disabled;
- comments that distinguish theatrical styling from private data governance.

Do not add a build step.

### 5.5 Page templates

Review every page in `center/pages/*.php` horizontally. Each page should consistently communicate:

1. purpose;
2. intended contents;
3. required source files;
4. required fields or sub-records;
5. owner actions;
6. gate warnings;
7. Timeline/GEN rule;
8. future persistence/auth/audit note;
9. whether visible data is placeholder, prototype-only, read-only, canonical, derived, or generated;
10. what route or seed contract it depends on.

For the major first-pass pages, verify they render seed contracts safely:

```text
center/pages/priority-board.php
center/pages/decision-log.php
center/pages/release-gates.php
center/pages/provenance-ledger.php
center/pages/booking-contacts.php
center/pages/rehearsal-prep.php
center/pages/integrity.php
```

For retained modules, improve consistency without overbuilding:

```text
center/pages/dashboard.php
center/pages/settings-inventory.php
center/pages/ssot-library.php
center/pages/records.php
center/pages/record-detail.php
center/pages/timeline-registry.php
center/pages/cue-staging.php
center/pages/asset-inventory.php
center/pages/media-intake.php
center/pages/rights-safety-queue.php
center/pages/tasks-launch.php
center/pages/website-cms-drafts.php
center/pages/marketing-planner.php
center/pages/operator-outputs.php
center/pages/system-map.php
```

### 5.6 Storage placeholders

Review and improve, as needed:

```text
center/storage/README.md
center/storage/cache/README.md
center/storage/exports/README.md
center/storage/overlays/README.md
center/storage/uploads/README.md
```

Look for small additions such as:

- what may eventually live there;
- what must not live there now;
- privacy/security boundaries;
- retention and backup notes;
- audit and rollback requirements;
- public/private separation;
- generated-output and cache invalidation warnings.

---

## 6. Site-wide consistency checks to perform manually while editing

As you inspect files, build a brief work map and look for gaps:

- Does every navigation item have a template?
- Does every new template have a navigation entry only if intended?
- Do pages use shared components rather than each inventing markup?
- Do seed contracts use aligned field names?
- Are Timeline/GEN rules present wherever record-like data appears?
- Are public-release blockers present wherever public copy, media, booking, marketing, or outputs are mentioned?
- Are internal show-control details kept private?
- Is `docs/ssot/settings_manifest.json` treated as discovery truth?
- Are SSOT files read-only/draft-overlay-only from `/center`?
- Are missing facts marked incomplete instead of invented?
- Are future persistence/auth/audit/backups mentioned where edits, uploads, deletes, approvals, contacts, or exports are implied?
- Are comments concise enough to guide future coding without becoming noise?

---

## 7. Suggested high-leverage additions

Choose the smallest coherent set that improves the whole scaffold. Good candidates include:

1. A shared module metadata helper and component that renders the same scaffold facts on every page.
2. A `center/data/module_contracts.php` seed that maps every module to required sources, fields, actions, gates, Timeline/GEN rule, and future persistence note.
3. A `center/data/integrity_checks_seed.php` or expanded schema section that lists checks with IDs, severity, implementation status, and recommended action.
4. A docs page such as `center/docs/horizontal_scaffolding_refinement_report.md` explaining what was improved and why.
5. More complete storage README policies for overlays/uploads/exports/cache.
6. Small CSS/component improvements to display source lists, status pills, warning strips, and disabled prototype actions consistently.
7. Tiny helper functions that reduce repeated escaping/formatting/path logic.
8. A route/navigation consistency check script if the repo conventions support it without dependencies.

You do not need to implement all of these. Prefer a coherent horizontal pass over a large scattered diff.

---

## 8. Required report

Write or update a report at:

```text
center/docs/horizontal_scaffolding_refinement_report.md
```

The report should explain:

- what files or file families were refined;
- why the refinements are horizontal rather than vertical;
- how the pass improves future implementation direction;
- how Timeline/GEN classification, provenance, release gates, and safe-edit boundaries were preserved;
- what intentionally remains placeholder-only or read-only;
- recommended next pass after this one.

---

## 9. Expected implementation style

Use the existing vanilla PHP structure:

- No package manager unless explicitly requested.
- No framework migration.
- No secrets or credentials.
- No try/catch around imports.
- Keep PHP includes direct and readable.
- Prefer small PHP arrays for scaffold seeds that can later become JSON/database records.
- Keep page templates safe if data files are missing.
- Avoid writing upload/edit/publish behavior unless the user explicitly asks and auth/audit/backups are addressed.
- Reuse existing components or add similarly simple reusable components.
- If adding navigation, add the page template in the same change.
- If adding a scaffold data file, document its purpose, placeholder status, and future migration path in a header comment.
- Avoid broad reformat-only churn. Make every changed line carry scaffolding value.

---

## 10. Validation checklist

Run relevant checks before finalizing:

```bash
find center -type f -name '*.php' -print0 | xargs -0 -n1 php -l
find docs/ssot -type f -name '*.json' -print0 | xargs -0 -n1 python3 -m json.tool >/dev/null
php -r '$nav=require "center/data/navigation.php"; foreach($nav as $id=>$m){$p="center/pages/".$m["template"]; if(!is_file($p)){fwrite(STDERR,"missing $id $p\n"); exit(1);} } echo "navigation templates ok\n";'
php -S 127.0.0.1:8093 -t center >/tmp/center-horizontal-server.log 2>&1 & echo $! > /tmp/center-horizontal-server.pid
sleep 1
curl -fsS 'http://127.0.0.1:8093/?page=dashboard' >/tmp/center-horizontal-dashboard.html
curl -fsS 'http://127.0.0.1:8093/?page=priority-board' >/tmp/center-horizontal-priority-board.html
curl -fsS 'http://127.0.0.1:8093/?page=decision-log' >/tmp/center-horizontal-decision-log.html
curl -fsS 'http://127.0.0.1:8093/?page=release-gates' >/tmp/center-horizontal-release-gates.html
curl -fsS 'http://127.0.0.1:8093/?page=provenance-ledger' >/tmp/center-horizontal-provenance-ledger.html
curl -fsS 'http://127.0.0.1:8093/?page=booking-contacts' >/tmp/center-horizontal-booking-contacts.html
curl -fsS 'http://127.0.0.1:8093/?page=rehearsal-prep' >/tmp/center-horizontal-rehearsal-prep.html
curl -fsS 'http://127.0.0.1:8093/?page=integrity' >/tmp/center-horizontal-integrity.html
kill $(cat /tmp/center-horizontal-server.pid)
git status --short
```

If a command fails because of an environment limitation, report it clearly. If it fails because of your code, fix it before committing.

---

## 11. Definition of done

The horizontal refinement pass is successful when:

- The fresh session has refreshed or explicitly attempted to refresh the merged repository state.
- Every changed file improves the scaffold direction without pretending the feature is complete.
- The `/center` files are more consistent across modules, seeds, helpers, pages, storage docs, and local policies.
- Seed contracts are more adapter-ready and aligned across fields.
- Timeline/GEN classification rules are visible across record-like concepts.
- Public-facing material remains protected by rights/safety/public-copy/brand-affiliation/technical-disclosure gates.
- Runtime editing/upload/publish/delete/approval behavior remains explicitly prototype-only until auth, backups, permissions, audit trails, rollback, and persistence are approved.
- A horizontal refinement report explains the decisions.
- PHP syntax, JSON syntax, navigation-template consistency, and route smoke checks pass.
