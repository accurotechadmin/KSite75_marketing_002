# Just One KISS - Centralized Owner Management Website Super-Prompt

Use this prompt to boot a fresh expert development session into the `Just One KISS` repository when the mission is to command, build, maintain, or extend the new centralized Owner management website. It synthesizes the best operating rules from every primer boot document in `docs/prompts/` and adds the new SSOT settings layer as the first-class control surface for canon data, information, settings, options, vocabulary, style guidance, brand stories, developer workflow, public-page configuration, and owner/admin module behavior.

This is **not** a greenfield instruction. The repository already contains mature planning documents, SSOT JSON companions, historical and active owner command-center renditions, a public-site prototype, and a starter website settings inventory. Your job is to verify the live tree, learn the current truth from the files, protect existing work, then make the smallest coherent change that moves the centralized Owner management website toward a durable production command center.

---

## 0. First-response posture

Start concise, operational, and repository-aware:

> I will verify the live repository state, read the source-of-truth docs, inspect the owner/public app surfaces and SSOT settings layer, identify the correct work area, then make the smallest safe change while preserving Timeline/GEN classification, rights/safety gates, public-copy discipline, JSON integrity, and owner-command usefulness.

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
find owner -maxdepth 3 -type f | sort
find owner_arena_command -maxdepth 3 -type f | sort
find secondrendition -maxdepth 3 -type f | sort
find thirdrendition -maxdepth 3 -type f | sort
find proto -maxdepth 3 -type f | sort
rg -n "TODO|FIXME|launch blocker|prototype-only|out of sync|SSOT|Timeline|GEN|settings_manifest|settings/" README.md docs owner owner_arena_command secondrendition thirdrendition proto -g '!vendor' -g '!node_modules'
```

If the working tree is dirty, classify changes before touching files:

1. user changes;
2. previous-agent changes;
3. your own changes.

Never overwrite, reformat, or clean up unrelated work casually.

---

## 2. Required study order

Read enough of these files to understand the current truth before planning substantive work. Historical prompts are context, not live commands to rebuild work that already exists.

### 2.1 Repository canon and project truth

```text
README.md
docs/knowledge.md
docs/prompt.md
docs/qwen_model_routing.md
docs/current_documentation_groundwork_plan.md
docs/mastergameplan.md
docs/timeline_moment_registry.md
docs/cue.txt
docs/inventory_reference.md
docs/rig.md
docs/styleguide.md
```

### 2.2 Website, owner/admin, and SSOT settings truth

```text
docs/website_system_plan.md
docs/owner_admin_build_readiness.md
docs/owner_site_boot_plan.md
docs/ssot/master_index.json
docs/ssot/settings_manifest.json
docs/ssot/settings/*.json
```

Treat `docs/ssot/settings_manifest.json` as the discovery manifest for the centralized settings/control surface, and treat `docs/ssot/settings/*.json` as starter contracts that website code should consume before hard-coding labels, options, copy seeds, workflow states, routes, style tokens, vocabulary, brand stories, or developer defaults.

### 2.3 Active and historical app surfaces

```text
owner/README.md
owner_arena_command/README.md
secondrendition/README.md
thirdrendition/README.md
proto/README.md
```

Then inspect the relevant app's routing, config, includes, data loaders, pages, partials, CSS, JavaScript, runtime overlay behavior, and app-local SSOT copies before changing code.

### 2.4 Primer prompt history to synthesize, not blindly execute

```text
docs/prompts/current_project_fresh_expert_development_boot_prompt.md
docs/prompts/full_project_fresh_expert_coding_boot_prompt.md
docs/prompts/marketing_campaign_expert_boot_prompt.md
docs/prompts/owner_arena_command_fresh_expert_maintenance_prompt.md
docs/prompts/owner_site_codebase_boot_prompt.md
docs/prompts/owner_site_first_rendition_build_prompt.md
docs/prompts/proto_public_site_fresh_expert_coding_prompt.md
docs/prompts/center_first_full_scaffolding_fresh_expert_coding_prompt.md
```

Use these to preserve intent, product standards, caution rules, and verification habits. Do not let older scaffold/build instructions override the current repository state.


### 2.5 Current `/center` inception expansion prompt

When the mission is specifically to build the first full `/center` scaffolding pass, read `docs/prompts/center_first_full_scaffolding_fresh_expert_coding_prompt.md` after this super-prompt. It converts the inception expansion report into a concrete coding-session primer for fuller scaffold descriptions, action/governance/provenance modules, local policy docs, seed contracts, validation checks, and the required decision-making report.

---

## 3. Core project truth to preserve

The project is **Just One KISS**: a Gene Simmons tribute theatrical stage event inspired by Gene Simmons/KISS-style spectacle. The project is being developed as a repeatable, bookable, streamlined theatrical production with a private owner command center and a public-facing event/booking web presence.

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

## 4. Source-of-truth hierarchy

When documents, JSON, code, prompts, app-local copies, or assumptions disagree, resolve conflicts in this order:

1. `README.md` for repository structure, collaboration rules, Timeline/GEN expectations, and cross-document conventions.
2. `docs/mastergameplan.md` for broad project architecture.
3. `docs/timeline_moment_registry.md` for Timeline Moment ID governance and timeline-versus-`GEN` classification.
4. `docs/cue.txt` for current internal cue/setlist draft context only; not final public or show-bible truth.
5. `docs/inventory_reference.md` for exact lighting/DMX/fixture/QLC+ facts; `docs/rig.md` as the show-control digest that should match it.
6. `docs/styleguide.md` for public tone, visual direction, and public presentation posture.
7. `docs/website_system_plan.md`, `docs/owner_admin_build_readiness.md`, and `docs/owner_site_boot_plan.md` for owner/public website product intent.
8. `docs/ssot/master_index.json`, `docs/ssot/settings_manifest.json`, `docs/ssot/settings/*.json`, and relevant `docs/ssot/*.json` as machine-readable contracts/seeds.
9. Active app READMEs and runtime code as implementation truth.
10. Primer prompts as onboarding aids and historical intent, not authority over current files.

When adding durable facts, update the most authoritative human-readable source first when one exists, then update paired SSOT JSON and manifest/index references in the same change. If you intentionally leave a companion out of sync, state the reason and follow-up.

---

## 5. Centralized Owner management website mission

The centralized Owner management website should become the private command surface for the whole project. It should help the owner move from executive overview to specific records without losing provenance, review state, or Timeline/GEN classification.

It should command:

- project-wide readiness and launch priorities;
- SSOT settings, options, vocabulary, style rules, and brand stories;
- website page/copy drafting and public-readiness gates;
- timeline registry, cue draft staging, and show-flow review;
- asset, media, costume, prop, venue, marketing, and technical inventory;
- rights, safety, accessibility, and venue-dependency queues;
- show-control references, emergency states, and operator outputs;
- marketing campaign planning and platform-specific creative production;
- task, blocker, owner decision, and follow-up tracking;
- source drilldowns, JSON library views, integrity checks, and migration notes.

The site must be serious owner software, not a decorative mockup. It may start as file-backed PHP/JSON, but it should be designed so JSON/PHP-array seeds can later be swapped for a database, API, or CMS adapter without rewriting every module.

---

## 6. SSOT settings layer rules

The new centralized settings layer is a first-class source for developer and owner control surfaces.

### 6.1 Settings files to understand first

- `docs/ssot/settings_manifest.json` — inventory and policy manifest.
- `docs/ssot/settings/project_identity.json` — identity, posture, public facts, guardrails, roles.
- `docs/ssot/settings/site_architecture.json` — routes, owner modules, page purposes, launch priorities.
- `docs/ssot/settings/content_model.json` — record fields, statuses, priorities, visibility, rights, safety states.
- `docs/ssot/settings/brand_voice.json` — tone, vocabulary, avoided terms, CTA patterns.
- `docs/ssot/settings/visual_style.json` — color roles, layout, imagery, accessibility baselines.
- `docs/ssot/settings/brand_stories.json` — reusable narrative arcs, proof points, audience promises.
- `docs/ssot/settings/marketing_channels.json` — campaign stages, channels, CTAs, tracking placeholders.
- `docs/ssot/settings/asset_taxonomy.json` — asset types, metadata, gates, placements.
- `docs/ssot/settings/show_timeline.json` — Timeline ID families and cue-to-website policy.
- `docs/ssot/settings/technical_show_control.json` — rig families, operating rules, emergency states.
- `docs/ssot/settings/integrations.json` — future CMS/forms/analytics/email/ad/media/AI placeholders.
- `docs/ssot/settings/developer_workflow.json` — naming rules, loading order, validation checks, next steps.

### 6.2 Loading and editing policy

1. Load `settings_manifest.json` before individual settings files.
2. Discover settings files from the manifest rather than duplicating inventory lists in code.
3. Treat settings IDs as stable. Add migration notes when evolving schemas.
4. Do not hard-code settings-backed labels, option sets, route purposes, vocabulary, CTAs, review states, or brand defaults in templates.
5. Do not store secrets, live credentials, private tokens, or production API keys in SSOT JSON.
6. Web UI editing of seed SSOT JSON must be disabled, staged as draft overlays, or explicitly marked prototype-only until persistence, auth, backups, and audit trails are approved.
7. When app-local copies exist, identify upstream source and whether synchronization is needed.

---

## 7. Repository architecture to verify

Expect, but verify, these major areas:

- `docs/` — human-readable planning, technical, style, website, owner-admin, marketing, prompt, and SSOT documentation.
- `docs/ssot/` — machine-readable JSON companions, master index, and centralized settings layer.
- `owner/` — generic vanilla PHP owner scaffold retained for reference and reusable baseline patterns.
- `owner_arena_command/` — first styled private owner command-center rendition with black/chrome/fire arena-command visual direction, runtime overlays/uploads where implemented, and placeholder/disabled publishing controls.
- `secondrendition/` — owner-first command center focused on findability, links, source drilldowns, and integrity.
- `thirdrendition/` — owner-actionable command center focused on production home, DMX fixtures, cue sheets, run books, project sections, search, JSON library, and integrity checks.
- `proto/` — standalone public-facing July 25, 2026 landing-site prototype; active public document root is `proto/public/`.

Do not rely on summaries alone. Inspect the active files in the area you are changing.

---

## 8. Product model for the centralized Owner site

### 8.1 Global shell requirements

A strong centralized Owner site should provide:

- persistent navigation with project sections and owner workflows;
- topbar with current module, launch focus, quick search, and filters;
- executive readiness panels, red-flag strips, and next-action queues;
- reusable cards, tables, status pills, metrics, detail panels, forms, and source-link components;
- module-level summaries with drilldowns to individual records;
- mobile-responsive layout;
- accessible landmarks, labels, keyboard support, focus states, and contrast.

### 8.2 Universal record schema

Every visible managed item should map into this shape or visibly mark missing data as review-needed:

```text
record_id
title
section
category
timeline_moment_id_or_gen
status
priority
owner_or_responsible_role
public_private_flag
rights_status
safety_status
description
notes
linked_files
linked_records
last_updated
source_file
source_title
source_type
```

Use `content_status` as a companion where the active module or older data model expects it; do not silently lose either rights/safety/content review meaning.

### 8.3 Core modules to preserve and enrich

The centralized site should support at least these modules:

- Dashboard / command home.
- Timeline Registry.
- Cue Draft Import / cue staging.
- Asset Inventory.
- Media Intake.
- Rights and Safety Queue.
- Tasks / Launch.
- Website CMS Drafts.
- Operator Outputs / Show-Control Outputs.
- Records and Record Detail.
- System Map.
- SSOT Library / Source Drilldowns.
- Settings Inventory / Control Surfaces.
- Marketing Campaign Planner.
- Integrity Checks.

Favor rich, useful first-draft pages over one-line placeholders. If a module is not fully implemented, label it honestly and provide the next useful action.

---

## 9. Public-site and marketing rules to carry into Owner tooling

Owner tools may prepare public copy, marketing prompts, images, CTAs, and page drafts, but they must preserve review gates.

Rules:

1. Public copy must be original, independent-tribute framed, rights-aware, safety-aware, and review-ready.
2. Never claim official endorsement, authorization, partnership, sponsorship, or ownership unless authoritative documentation proves it.
3. Avoid exact restricted marks, logos, makeup designs, album art, outside photos, and official-sounding language unless cleared.
4. Separate internal inspiration/research from public-approved copy.
5. Safety notices for loud sound, bright lights, fog, flashing/strobe-style looks, projection, and venue conditions must remain visible where relevant.
6. Marketing images and mockups must carry asset/source, rights, safety, platform, and review metadata.
7. Placeholder prompts are allowed, but public pages should clearly distinguish placeholders from approved final assets.
8. Accessibility should be considered in copy length, contrast, alt text, motion, form labels, and CTA clarity.

---

## 10. Technical-production rules

1. Normal show operation is DMX-controlled; avoid standalone, sound-active, master/slave, IR remote, fixture-run, and accidental macro behavior unless a cue intentionally calls for it.
2. Emergency states such as visual blackout, safe work light, projection black screen, fog off, strobes off, music stop, system reset, and performer safe look must remain internal/operator-gated unless explicitly approved for public description.
3. Technical facts about fixture identity, addresses, channel maps, QLC+, recipes, and troubleshooting must trace back to `docs/inventory_reference.md`, `docs/rig.md`, or their SSOT JSON companions.
4. Venue-specific safety, rigging, power, fog, strobe, blackout, and moving-light claims must be marked review-needed until confirmed.
5. Owner pages can summarize technical readiness, but should not imply show-ready certification when data is draft/prototype-only.

---

## 11. Development workflow

1. Restate the user request and identify the relevant document/app/settings domain.
2. Verify live state and protect unrelated changes.
3. Read scoped source-of-truth docs, settings JSON, active app README, and implementation files.
4. Plan the smallest coherent change.
5. Keep vanilla PHP/HTML/CSS/JS conventions unless explicitly directed otherwise.
6. Prefer data-driven settings from `docs/ssot/settings_manifest.json` and `docs/ssot/settings/*.json` over hard-coded values.
7. Preserve Timeline/GEN classification, source provenance, rights status, safety status, content status, and review flags.
8. Keep public-facing copy original, rights-aware, safety-aware, and independent-tribute framed.
9. If changing Markdown paired with SSOT JSON, update both or record the sync gap.
10. If changing generated or app-local copied data, identify the upstream and propagation plan.
11. Run targeted checks for touched files.
12. Review the diff before committing.
13. Commit with a concise descriptive message when the active environment requires commits.
14. Prepare a clear PR title/body with summary, tests, documentation impact, and known follow-up.

---

## 12. Recommended verification commands

Choose the relevant subset for the files touched.

### 12.1 JSON validation

```bash
python3 - <<'PY'
import json, pathlib
for p in sorted(pathlib.Path('.').rglob('*.json')):
    if any(part in {'vendor', 'node_modules'} for part in p.parts):
        continue
    json.loads(p.read_text())
    print(p)
PY
```

### 12.2 PHP syntax

```bash
find proto owner owner_arena_command secondrendition thirdrendition -name '*.php' -print0 | xargs -0 -n1 php -l
```

### 12.3 Owner command-center smoke checks

```bash
php -r 'require "owner_arena_command/includes/bootstrap.php"; echo count(ac_records())." records\n";'
php -r 'require "secondrendition/includes/bootstrap.php"; $s=sr_data_status(); echo $s["active_root"]."\n".count(sr_records())." records\n";'
php -r 'require "thirdrendition/includes/bootstrap.php"; $s=tr_data_status(); echo $s["active_root"]."\n".count(tr_records())." records\n";'
```

### 12.4 Settings layer smoke check

```bash
python3 - <<'PY'
import json, pathlib
manifest = json.loads(pathlib.Path('docs/ssot/settings_manifest.json').read_text())
missing = []
for item in manifest.get('settings_file_inventory', []):
    path = pathlib.Path(item['path'])
    if not path.is_file():
        missing.append(str(path))
    else:
        json.loads(path.read_text())
if missing:
    raise SystemExit('Missing settings files: ' + ', '.join(missing))
print(f"settings files discovered: {len(manifest.get('settings_file_inventory', []))}")
PY
```

### 12.5 Public site checks when `proto/` is touched

```bash
php -l proto/public/index.php
php -S 127.0.0.1:8000 -t proto/public
```

If a perceptible runnable web-app change is made, run the relevant local server, inspect the page, and take a screenshot when the active environment requires it.

---

## 13. Boot completion report

When asked to boot or prepare before implementation, report in this structure:

1. **Documentation studied** — files read and what each controls.
2. **Current truths** — project purpose, active apps, source-of-truth hierarchy, Timeline/GEN rule, SSOT settings layer, public event facts, rights/safety gates, and prototype limitations.
3. **Architecture map** — docs/SSOT/settings, owner apps, public site, app-local data, and data flow.
4. **Task plan** — smallest safe path for the requested work.
5. **Risks and checks** — verification commands, launch blockers, security/prototype caveats, and likely sync concerns.

End with:

> I am booted, current on the repository truth, and ready to command the centralized Owner management website.

---

## 14. Non-negotiable cautions

- Do not rebuild existing apps from old prompts unless explicitly asked.
- Do not treat historical build prompts as stronger than current files.
- Do not mutate seed SSOT JSON from a web UI without approved persistence, auth, audit, and backup behavior.
- Do not add a database, authentication, uploads, framework, build step, package manager, or external service unless explicitly requested or already part of the active implementation.
- Do not invent public claims, event logistics, ticketing rules, venue guarantees, partnerships, rights clearances, or safety assurances.
- Do not weaken independent-tribute disclaimers, rights review, safety review, source provenance, or Timeline/GEN classification.
- Do not publish or mark content public-ready merely because it exists in a draft, prompt, or generated asset inventory.
- Do not delete runtime uploads, language backups, app-local overlays, or user-managed drafts unless specifically instructed.
- Do not hide launch blockers, security caveats, prototype limitations, or sync gaps.
- Do not leave changes without tests/checks, a clear commit, and a useful PR summary when the active environment requires them.

---

## 15. Mental model

Think of the repository as a staged production system:

- Human documents define canon, story, safety, and planning nuance.
- SSOT JSON files and the settings layer convert canon into machine-readable contracts.
- The centralized Owner management website is the command bridge where the owner can inspect, prioritize, edit drafts, route reviews, and prepare public or operator outputs.
- Public pages are downstream expressions, not the place where internal truth is invented.
- Technical runbooks and cue data are operational sources, not marketing copy.
- Every useful change should make the system more findable, more source-linked, more review-aware, more data-driven, and easier for the next session to continue.
