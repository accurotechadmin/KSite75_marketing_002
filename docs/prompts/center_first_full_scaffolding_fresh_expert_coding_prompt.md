# Just One KISS - Center First Full Scaffolding Fresh Expert Coding Prompt

Use this primer to boot a fresh expert coding LLM session whose mission is to build out the **first full scaffolding pass** for the `center/` centralized owner-management website. This prompt ties together the repository canon, SSOT settings layer, prior owner-site renditions, public prototype, the `/center` scaffold inventory, and the inception expansion report so the next coding session can move immediately from orientation into safe implementation.

This is **not** a greenfield build. The repository already contains mature planning documents, SSOT JSON companions, multiple owner-command prototypes, a public-site prototype, a starter settings manifest, and an inception-stage `/center` scaffold. Your task is to verify the live tree, preserve existing work, then build fuller and more functional scaffolding files that explain what each component, sub-component, data contract, page, partial, storage placeholder, and settings surface should contain later.

---

## 0. First-response posture

Start concise, operational, and repository-aware:

> I will verify the live repository state, read the authoritative project and `/center` scaffolding sources, inspect the SSOT settings layer and reference owner renditions, then build the smallest coherent first full scaffolding pass while preserving Timeline/GEN classification, provenance, rights/safety/public-release gates, JSON integrity, and future migration paths.

Then inspect before making claims or edits.

---

## 1. Immediate boot commands

Run these from the repository root before making claims about the codebase. Use `find`, `rg`, `sed`, `nl -ba`, `php -l`, `python3 -m json.tool`, and targeted scripts. Do **not** use slow recursive commands such as `ls -R` or `grep -R`.

```bash
pwd
find .. -name AGENTS.md -print
git status --short
git log --oneline -5
find docs/prompts -maxdepth 1 -type f | sort
find docs/ssot -maxdepth 2 -type f | sort
find center -maxdepth 4 -type f | sort
find owner -maxdepth 3 -type f | sort
find owner_arena_command -maxdepth 3 -type f | sort
find secondrendition -maxdepth 3 -type f | sort
find thirdrendition -maxdepth 3 -type f | sort
find proto -maxdepth 3 -type f | sort
rg -n "TODO|FIXME|launch blocker|prototype-only|out of sync|SSOT|Timeline|GEN|settings_manifest|settings/|priority-board|release-gates|provenance-ledger|decision-log" README.md docs center owner owner_arena_command secondrendition thirdrendition proto -g '!vendor' -g '!node_modules'
```

If the working tree is dirty, classify every change before touching files:

1. user changes;
2. previous-agent changes;
3. your own changes.

Never overwrite or reformat unrelated work.

---

## 2. Required study order

Read enough of these files to understand the current truth before planning substantive changes.

### 2.1 Repository canon and project truth

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
```

### 2.2 Owner/public website truth

```text
docs/website_system_plan.md
docs/owner_admin_build_readiness.md
docs/owner_site_boot_plan.md
```

### 2.3 SSOT settings and machine-readable truth

```text
docs/ssot/master_index.json
docs/ssot/settings_manifest.json
docs/ssot/settings/*.json
docs/ssot/*.json
```

Treat `docs/ssot/settings_manifest.json` as the discovery manifest for settings files. Treat `docs/ssot/settings/*.json` as starter contracts for labels, option sets, workflow states, vocabulary, CTAs, routes, style guidance, brand stories, technical disclosure rules, integrations, and developer workflow. Do not hard-code settings-backed facts when a loader or seed contract can be prepared.

### 2.4 Active `/center` scaffold truth

```text
center/README.md
center/docs/scaffold_inventory.md
center/docs/center_scaffolding_inception_expansion_report.md
center/config/app.php
center/data/navigation.php
center/data/schema.php
center/includes/bootstrap.php
center/includes/functions.php
center/includes/settings.php
center/includes/ssot.php
center/includes/records.php
center/partials/*.php
center/pages/*.php
center/assets/css/center.css
center/assets/js/center.js
center/storage/*/README.md
```

### 2.5 Reference app surfaces to borrow from, not blindly copy

```text
owner/README.md
owner_arena_command/README.md
secondrendition/README.md
thirdrendition/README.md
proto/README.md
```

Use the earlier owner renditions for proven patterns: dashboard cards, record cards, source detail pages, JSON library views, integrity checks, run-book outputs, black/chrome/fire visual language, and owner-first navigation. Use `proto/` as the public-facing content target that `/center` should eventually govern, not as a source to expose internal mechanics.

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
2. Every managed item, asset, cue, task, record, option, and content unit must be either tied to a Timeline Moment ID or marked `GEN` / GENERAL / NOT TIMELINE-SPECIFIC.
3. Timeline-specific records use governed ID families such as `PRE-###`, `OPEN-###`, `SET-###`, `SONG-###`, `TRN-###`, `CST-###`, `VID-###`, `LGT-###`, `FOG-###`, `STR-###`, `SPK-###`, `FIN-###`, `ENC-###`, `POST-###`, or `GEN`.
4. `docs/cue.txt` is an internal working cue/setlist draft until migrated, reviewed, and promoted.
5. Public output must not imply official endorsement, sponsorship, clearance, partnership, ownership, or authorization by KISS, Gene Simmons, Pophouse, or related rightsholders unless written approval exists.
6. Exact costume/makeup/logo/media resemblance, restricted marks, outside media, album art, and official-sounding claims are content-sensitive and require review.
7. Fog, strobes, bright lights, projection, loud sound, blackout states, moving lights, drops/platforms, and venue-dependent effects must remain safety-gated and venue-aware.
8. Internal production mechanics, cue timings, emergency states, owner workflows, and show-control details should stay internal unless an authoritative public document explicitly approves disclosure.
9. If event facts, permissions, assets, or technical data are incomplete, mark them incomplete and recommend reconciliation. Do not invent certainty.
10. Prefer the existing vanilla PHP/HTML/CSS/JS approach unless the user explicitly requests another stack.

---

## 4. Mission for the first full `/center` scaffolding pass

Build out the first full scaffolding layer so a future session can implement real data and workflows without asking what each file is supposed to do.

The deliverable should include:

1. Fuller but still concise descriptions in every `/center` scaffold file.
2. Module stubs that render safely through the existing shell.
3. Data seed contracts or schema placeholders for each new module where useful.
4. Local `/center/docs/` policies for priority board behavior, public-release gates, canon sync, module scaffolding, and future auth/persistence.
5. Navigation entries only when the corresponding page template exists.
6. A decision-making report explaining why each module, sub-component, and contract was chosen.
7. Tests/checks proving PHP syntax, JSON syntax, route rendering, and navigation-template consistency.

The scaffold should become richer, not falsely complete. Use words like `placeholder`, `prototype-only`, `read-only`, `draft overlay`, `future`, and `requires auth/audit/backups` when applicable.

---

## 5. Required first full scaffolding components

### 5.1 Command/action layer

Add or deepen:

- `center/pages/priority-board.php`
- `center/pages/decision-log.php`
- `center/data/priority_board_seed.php`
- `center/data/decision_schema.php`
- `center/docs/priority_board_model.md`

Minimum content:

- Board columns: `Notes`, `Questions`, `Now`, `Next`, `Later`, `Finished`, `Recovery`.
- Card fields: `record_id`, `title`, `module`, `type`, `classification`, `status`, `priority`, `owner_role`, `next_action`, `due_or_target`, `source_files`, `linked_records`, `summary`, `details`, `last_updated`.
- Movement semantics: `Questions` suggests `needs_decision`; `Now` suggests `in_progress`; `Finished` requires a closing note; delete moves to `Recovery` first.
- Decision fields: `decision_id`, `question`, `context`, `options`, `chosen_option`, `decision_status`, `decision_owner`, `needed_by`, `source_records`, `impact_area`, `reversal_cost`, `follow_up_record_id`.

Reasoning: the owner needs an action-first layer before all modules are feature-complete. It prevents `/center` from becoming only a document browser.

### 5.2 Governance/release layer

Add or deepen:

- `center/pages/release-gates.php`
- `center/pages/provenance-ledger.php`
- `center/data/release_gate_matrix.php`
- `center/data/source_provenance_schema.php`
- `center/docs/public_release_gate_policy.md`
- `center/docs/canon_sync_policy.md`

Minimum content:

- Gate families: rights, safety, privacy, venue, accessibility, copy, media, technical disclosure, brand affiliation.
- Gate states: blocked, needs review, conditional, approved internal, approved public, not applicable.
- Provenance statuses: canonical, derived copy, needs sync review, deprecated reference, prototype-only, generated output.
- Public blocker rule: no public copy may imply official endorsement, sponsorship, authorization, ownership, or clearance unless written approval exists.
- Safe-edit rule: seed SSOT JSON is read-only or draft-overlay-only until auth, backups, permissions, and audit trails exist.

Reasoning: public pages, marketing, media, booking, and operator outputs all require the same gate logic. Building it once prevents policy drift.

### 5.3 Planning/operations layer

Add or deepen:

- `center/pages/booking-contacts.php`
- `center/pages/rehearsal-prep.php`
- `center/data/booking_contacts_seed.php`
- `center/data/rehearsal_prep_seed.php`
- optional starter docs for booking/contact and rehearsal/prep behavior.

Minimum content:

- Booking/contact concepts: venue buyers, press, vendors, follow-ups, buyer packet readiness, inquiry source, next touch, last touch, status, owner role.
- Rehearsal/prep concepts: practice notes, readiness drills, cue fixes, packing prep, rehearsal next actions, source records, Timeline/GEN classification.
- Explicit separation between internal rehearsal/show-control detail and public-safe booking/press summaries.

Reasoning: the owner site must command the setup, planning, execution, and related business/booking work, not only website content.

### 5.4 Data/schema layer

Deepen:

- `center/data/schema.php`
- `center/includes/records.php`
- `center/includes/settings.php`
- `center/includes/ssot.php`
- `center/pages/integrity.php`

Minimum content:

- Typed relationship edges: `blocks`, `depends_on`, `uses_asset`, `appears_on_page`, `derived_from`, `requires_review`, `outputs_to`.
- Audit placeholders: `created_at`, `created_by`, `updated_at`, `updated_by`, `change_reason`, `source_revision`.
- Integrity findings shape: `finding_id`, `severity`, `source_file`, `record_id`, `message`, `recommended_action`.
- Checks to scaffold: JSON validity, manifest paths, master-index paths, PHP syntax, required fields, Timeline/GEN pattern, duplicate IDs, broken links, stale app-local SSOT copies, public-approved records with unresolved gates.

Reasoning: these contracts allow JSON/PHP seeds to migrate later to a database/API/CMS adapter without rewriting the module vocabulary.

### 5.5 Owner modules to keep and deepen

Retain and deepen every existing module:

- Dashboard.
- Settings Inventory.
- SSOT Library.
- Records.
- Record Detail.
- Timeline Registry.
- Cue Staging.
- Asset Inventory.
- Media Intake.
- Rights & Safety Queue.
- Tasks / Launch.
- Website CMS Drafts.
- Marketing Planner.
- Operator Outputs.
- System Map.
- Integrity Checks.

Each module should have:

1. A concise purpose.
2. Intended contents.
3. Required source files.
4. Required fields or sub-records.
5. Owner actions.
6. Gate warnings.
7. Timeline/GEN rule.
8. Future persistence/auth/audit note.

---

## 6. Decision-making and reasoning framework

When choosing what to add, apply this hierarchy:

1. **Owner usefulness first:** the surface must help the owner see, decide, act, or verify.
2. **Governance before publishing:** public copy, media, effects, and booking claims must pass gates before public use.
3. **Provenance before editing:** every displayed fact should point to a source or declare itself a placeholder.
4. **Timeline/GEN everywhere:** every record-like unit must carry a governed Timeline Moment ID or `GEN`.
5. **Scaffold before persistence:** add contracts, seeds, and read-only surfaces before promising writes/uploads/publishing.
6. **Serious private software, not decoration:** the UI may look theatrical, but the content must support real owner command.
7. **Adapter-ready design:** do not lock the app into ad hoc arrays when a future database/API/CMS adapter should be able to take over.
8. **Reference, do not fork:** borrow patterns from earlier renditions, but keep `/center` as the new central surface.

Write a report that proves these choices. The report should explain:

- why each new module exists;
- what owner problem it solves;
- which source documents justify it;
- what data it should eventually contain;
- what gates or warnings apply;
- why it belongs in the first scaffolding pass rather than later;
- what should remain placeholder-only until auth, audit, backups, and persistence are approved.

Suggested report path:

```text
center/docs/center_first_full_scaffolding_decision_report.md
```

---

## 7. Expected implementation style

Use the existing vanilla PHP structure:

- No package manager unless explicitly requested.
- No framework migration.
- No secrets or credentials.
- No try/catch around imports.
- Keep PHP includes direct and readable.
- Prefer small PHP arrays for scaffold seeds that can later become JSON/database records.
- Keep page templates safe if data files are missing.
- Avoid writing upload/edit/publish behavior unless the user explicitly asks and auth/audit/backups are addressed.
- Reuse `center_placeholder_panel` or create similarly simple reusable components.
- If adding navigation, add the page template in the same change.
- If adding a scaffold data file, document its purpose and future migration path in a header comment.

---

## 8. Recommended first work plan

1. Verify repository state and read required files.
2. Build a concise work map listing files to add/update.
3. Add missing local docs:
   - `center/docs/priority_board_model.md`
   - `center/docs/public_release_gate_policy.md`
   - `center/docs/canon_sync_policy.md`
   - `center/docs/module_scaffolding_checklist.md`
   - `center/docs/future_persistence_and_auth_plan.md`
   - `center/docs/center_first_full_scaffolding_decision_report.md`
4. Add or deepen seed data files for priority board, decisions, release gates, provenance, booking/contacts, rehearsal/prep, and output templates.
5. Ensure every navigation item has a page template.
6. Expand each module placeholder so it names intended contents, source dependencies, gate warnings, owner actions, Timeline/GEN rule, and future persistence note.
7. Add or deepen integrity scaffolding for path, JSON, PHP, required-field, Timeline/GEN, duplicate ID, and gate checks.
8. Run validation.
9. Commit the coherent change.

---

## 9. Validation checklist

Run relevant checks before finalizing:

```bash
find center -type f -name '*.php' -print0 | xargs -0 -n1 php -l
find docs/ssot -type f -name '*.json' -print0 | xargs -0 -n1 python3 -m json.tool >/dev/null
php -S 127.0.0.1:8092 -t center >/tmp/center-server.log 2>&1 & echo $! > /tmp/center-server.pid
sleep 1
curl -fsS 'http://127.0.0.1:8092/?page=dashboard' >/tmp/center-dashboard.html
curl -fsS 'http://127.0.0.1:8092/?page=priority-board' >/tmp/center-priority-board.html
curl -fsS 'http://127.0.0.1:8092/?page=release-gates' >/tmp/center-release-gates.html
kill $(cat /tmp/center-server.pid)
git status --short
```

If a command fails because of an environment limitation, report it clearly. If it fails because of your code, fix it before committing.

---

## 10. Definition of done

A first full `/center` scaffolding pass is successful when:

- The new session can understand the site from `/center` files without rereading every historical prompt.
- Each module has a real, concise, functional description of what should populate it.
- Action, governance, provenance, planning, website, marketing, technical, rehearsal, booking, and output surfaces are represented.
- Every new record-like concept has a Timeline/GEN classification rule.
- Public-facing material is guarded by rights/safety/public-copy rules.
- Runtime editing/upload/publish behavior remains explicitly prototype-only until auth, backups, permissions, audit trails, and persistence are approved.
- A decision report proves why the chosen components and sub-components are the correct first scaffolding set.
- PHP syntax, JSON syntax, and route smoke checks pass.
