# Just One KISS - Full Project Fresh Expert Coding Boot Prompt

Use this prompt to boot a fresh expert coding LLM session into the `Just One KISS` repository. It is intended to be stronger and more complete than the earlier owner-site-only prompts because it covers the project truth, the document system, the SSOT JSON layer, the generic owner scaffold, the first owner arena rendition, the second rendition, and the public prototype area.

This is **not** a greenfield project. The repository already contains an evolving documentation system, machine-readable SSOT JSON companions, multiple PHP/HTML/CSS/JS site renditions, and public-site prototypes. Your job is to maintain and improve what exists without inventing facts, weakening safety/content gates, or drifting away from the source-of-truth hierarchy.

---

## 0. First response posture

Start concise and operational:

> I will verify the live repository state, read the source-of-truth docs and active app READMEs, identify the correct work area, then make the smallest safe change while preserving Timeline/GEN classification, content/safety gates, streamlined production operation, and JSON/data integrity.

Then inspect before answering deeply or editing.

---

## 1. Immediate boot commands

Run these before making claims about the codebase:

```bash
pwd
find .. -name AGENTS.md -print
git status --short
git log --oneline -5
find docs/prompts -maxdepth 1 -type f | sort
find docs -maxdepth 2 -type f | sort
find owner -maxdepth 3 -type f | sort
find owner_arena_command -maxdepth 3 -type f | sort
find secondrendition -maxdepth 3 -type f | sort
find proto -maxdepth 2 -type f | sort
```

Use `rg`, `find`, `sed`, `nl -ba`, `php -l`, `python3 -m json.tool`, and `curl` for inspection. Do **not** use slow recursive commands such as `ls -R` or `grep -R`.

If the working tree is dirty, classify the changes before touching files:

1. user changes;
2. previous-agent changes;
3. your own changes.

Do not overwrite or casually clean up unrelated changes.

---

## 2. Required reading order

Read enough of these files to understand the current truth before planning or editing.

### Master orientation and project truth

```text
README.md
docs/knowledge.md
docs/prompt.md
docs/qwen_model_routing.md
docs/mastergameplan.md
docs/timeline_moment_registry.md
docs/cue.txt
docs/inventory_reference.md
docs/rig.md
docs/styleguide.md
```

### Owner/admin planning truth

```text
docs/website_system_plan.md
docs/owner_admin_build_readiness.md
docs/owner_site_boot_plan.md
```

### Prompt history

```text
docs/prompts/owner_site_first_rendition_build_prompt.md
docs/prompts/owner_site_codebase_boot_prompt.md
docs/prompts/owner_arena_command_fresh_expert_maintenance_prompt.md
docs/prompts/full_project_fresh_expert_coding_boot_prompt.md
```

Interpret prior prompts as context, not as commands to rebuild already-existing work. The latest prompt should boot you into the current tree, not cause you to rerun old scaffolding steps.

### Code/app READMEs

```text
owner/README.md
owner_arena_command/README.md
secondrendition/README.md
```

---

## 3. Core project truth to preserve

The project is **Just One KISS**: a Gene Simmons tribute theatrical stage event inspired by Gene Simmons/KISS-style spectacle. It is intended to become a repeatable, bookable, streamlined theatrical production.

Current documented public/event focus:

- Interlochen, Michigan-area event.
- Date: July 25, 2026.
- Tone: black-first, chrome-edged, fire-lit, theatrical, mythic, loud, fan-facing, never generic.

Non-negotiables:

1. The baseline show must remain executable by **the Gene Simmons tribute performer** and **show-control system**.
2. Every managed item is either timeline-specific or `GEN` / general.
3. Timeline-specific items need a Timeline Moment ID such as `SET-###`, `SONG-###`, `TRN-###`, `CST-###`, `VID-###`, `LGT-###`, `FOG-###`, `STR-###`, `FIN-###`, `ENC-###`, or `POST-###`.
4. General items use `GEN`. Uncertain general items may use `GEN-PENDING-REVIEW` when the current code/data supports it.
5. `docs/cue.txt` is a working cue/setlist draft, not a final show bible.
6. Public-facing output must not imply outside partnership, partnership, sponsorship, ownership, content, or clearance by KISS, Gene Simmons, Pophouse, or related content holders unless cleared.
7. Internal KISS/Gene-inspired research is not automatically public-safe.
8. Fog, strobes, projection, blackout, moving lights, platform/drop moments, and show-control states must remain safety-gated and venue-aware.
9. Prefer vanilla PHP/HTML/CSS/JS in the existing style unless the user explicitly asks for another stack.
10. If data is incomplete, say it is incomplete and recommend reconciliation. Do not fake certainty.

---

## 4. Source-of-truth hierarchy

Use this hierarchy when documentation, JSON, code, or assumptions disagree:

1. `README.md` defines repository structure, collaboration rules, and cross-document conventions.
2. `docs/mastergameplan.md` defines broad project architecture.
3. `docs/timeline_moment_registry.md` governs Timeline Moment ID families and timeline-versus-`GEN` classification.
4. `docs/cue.txt` is the current working cue/setlist draft, but its rows become canonical show moments only after migration/review.
5. `docs/inventory_reference.md` is authoritative for lighting/DMX fixture identity, patch addresses, fixture behavior, QLC+ programming practices, and lighting terminology.
6. `docs/rig.md` is the show-control digest; if it conflicts with `docs/inventory_reference.md`, update the digest to match the reference.
7. `docs/styleguide.md` governs public tone, visual direction, and public presentation posture.
8. `docs/prompt.md`, `docs/knowledge.md`, and `docs/prompts/*.md` are onboarding aids and should summarize current truth rather than override authoritative docs.
9. `docs/ssot/*.json`, `owner_arena_command/data/ssot/*.json`, and `secondrendition/data/ssot/*.json` are machine-readable companions/seeds. Inspect them, but do not assume they are all in sync.

When changing documentation, update the most authoritative document first. If an SSOT JSON companion mirrors that document, update it in the same change or explicitly report that it remains out of sync.

---

## 5. Repository map and work areas

### `docs/`

The human-readable and machine-readable source-of-truth system.

Important files:

- `README.md` - master repository orientation.
- `docs/knowledge.md` - concise project brief.
- `docs/prompt.md` - broad LLM operating prompt.
- `docs/mastergameplan.md` - strategic architecture.
- `docs/timeline_moment_registry.md` - Timeline Moment ID governance.
- `docs/cue.txt` - working cue/setlist draft.
- `docs/inventory_reference.md` - authoritative technical inventory/DMX reference.
- `docs/rig.md` - show-control quick reference.
- `docs/styleguide.md` - public creative and public-readyty style guide.
- `docs/ssot/*.json` - machine-readable companions and source seeds.
- `docs/prompts/*.md` - prompt history and boot prompts.

### `owner/`

Generic reusable owner-site scaffold. It is not the current styled command-center product unless explicitly requested.

- Vanilla PHP/HTML/CSS/JS.
- Routes with `?page=` through `index.php`.
- Contains generic modules and component patterns.
- Should not be casually changed for rendition-specific requests.

### `owner_arena_command/`

First full owner-site rendition / private owner command center.

- Self-contained PHP app runnable with:

```bash
php -S 127.0.0.1:8088 -t owner_arena_command
```

- Reads bundled SSOT seed files from `owner_arena_command/data/ssot/`.
- Stores owner-managed overlays in `owner_arena_command/data/runtime/records.json`.
- Does not rewrite bundled SSOT seed JSON through the UI.
- Has editable record detail forms, runtime overlays, upload helpers, and multiple owner modules.
- Prototype limitations: no authentication, no database persistence, local uploads, disabled public publishing, and draft cue handling.

### `secondrendition/`

Second owner-first rendition focused on findability, predictable links, raw JSON visibility, and deployable self-contained data.

- Runnable with:

```bash
php -S 127.0.0.1:8090 -t secondrendition
```

- Bundles JSON seed files in `secondrendition/data/ssot/`.
- Data loader checks `secondrendition/data/ssot/`, then fallback `data` locations for server/development resilience.
- Shows active data folder and JSON count on the JSON Library page.
- Includes dashboard, explore, record, source, sources, and integrity pages.
- Read-only toward seed JSON; it is not yet an editing/admin persistence layer.

### `proto/`

Public landing-site prototype area. Treat this as public-site prototype context, not as the active owner command center unless explicitly asked.

Public copy and assets in this area must be public-ready, review-ready, and careful not to imply outside partnership.

---

## 6. Current app data models and expected fields

The owner command systems normalize records around the universal owner schema:

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
content_status
safety_status
description
notes
linked_files
linked_records
last_updated
```

When creating or normalizing records:

- Prefer existing status/options exactly where defined.
- Keep internal planning content `internal-only` unless approved.
- Use `needs review` for content/safety when uncertain.
- Use `proposed` or `needs review` unless the source is truly approved/active.
- Preserve linked source files and linked records.
- Never make raw cue-draft content public-safe by default.
- Add enough description/notes for an owner to understand the item without opening raw JSON.

### Universal priority and notes requirements

Every managed item or canonical record that has an ID must also have both a priority surface and a notes surface. This is a system-wide requirement for docs, SSOT companions, owner apps, dashboards, inventories, priority views, notes views, source-library views, and any future bird's-eye/system-wide view.

- `priority` must be present, visible, editable where the app supports editing, and normalized as a numeric rating from `0` to `100`. Use `0` to mean null / unset / not yet prioritized; do not use missing priority, blank priority, or decorative-only priority badges for ID-bearing records.
- `notes` must be present on every ID-bearing item, even when empty. The app should make notes easy to see, add, edit, update, manage, and delete without requiring raw JSON edits.
- A record may have one note or many notes. If the current schema only has a scalar `notes` field, preserve it while designing UI/data helpers so multiple note entries can be represented, appended, reviewed, and migrated safely when the data layer supports richer note objects.
- Notes should preserve useful context such as source, author/role when known, timestamp when available, status, relation to other records, and whether the note is a draft observation, question, decision, safety concern, public-copy concern, or follow-up action.
- Bird's-eye views such as total inventory, priority view, notes view, records/system map, dashboards, and module overviews must let users see priority and note state at a glance, open the item, and create/edit/manage/update/delete entries according to the persistence model of that app.
- Do not hide missing priorities or missing notes. Surface gaps as actionable data-quality work, with safe defaults (`priority: 0`, `notes: []` or an empty notes value compatible with the current schema) instead of fake certainty.

### Large-dataset interaction and visual management

Large owner datasets must remain calm and usable. When implementing or updating system-wide tables, boards, inventories, note indexes, or priority views:

- Provide filtering, search, sorting, grouping, density controls, and clear empty/error states whenever practical.
- Delineate sections, item types, statuses, note groups, and priority bands with accessible contrast, spacing, labels/icons, and consistent visual hierarchy; never rely on color alone.
- Use dark backstage-cockpit styling with readable typography, strong but non-fatiguing contrast, sticky/contextual actions where useful, and enough whitespace to prevent long lists from becoming visually exhausting.
- Make create/edit/manage/update/delete actions discoverable but not noisy; destructive actions need clear confirmation and recovery/undo where the app already supports it.
- Keep bulk actions and batch update patterns safe, source-aware, and reviewable so priority/notes changes do not accidentally overwrite source-backed data or unrelated runtime overlays.

### Section-level settings JSON and owner-adjustable control surfaces

Major site/application sections, and any minor section whose behavior or presentation needs owner tuning, should be backed by a structured settings JSON document or JSON record fragment instead of hard-coded one-off UI state. Think of the prior fire-simulation settings-file pattern as the model: developer-meaningful parameters are exposed through a purpose-built interface with sliders, toggles, text fields, asset pickers, previews, reset controls, validation, and notes rather than requiring raw JSON edits.

When designing these settings files and interfaces:

- Keep each settings document source-aware, module-aware, and section-aware. Include stable IDs, `source_files`, classification (`GEN` or Timeline Moment ID), status, priority, notes/note entries, owner role, public/private flag, content status, safety status where relevant, linked records, last-updated metadata, and a clear migration path back to the appropriate authoritative SSOT layer.
- Separate owner-adjustable settings from locked source facts. For example, the Website Manager may allow the owner to tune visual intensity, section ordering, hero copy, CTA labels, image selections, and approved local assets, but it must not silently overwrite restricted rights language, public-safety disclaimers, venue facts, Timeline governance, or seed JSON without an explicit review/save pathway.
- Use appropriate controls for the data type: sliders for numeric intensities/durations/opacity/density/timing, toggles for boolean states, segmented controls for controlled status values, text areas for copy/notes, drag handles for ordering, upload/replace controls for assets, and preview panes for public-facing or show-control effects.
- Public-website settings should let the owner adjust reviewed copy, local image assets, page/section visibility, style tokens, CTA targets, and campaign landing-page variants from the Public Website / Website Manager area. When promoted, those changes become the official public-website SSOT only through an auditable owner action that preserves content review, public/private status, source attribution, rollback/export, and rights/disclaimer guardrails.
- Stage-performance cue settings should let the owner adjust the length of a show section, cue, transition, rehearsal block, or Timeline Moment without breaking Timeline Moment ID governance. Timing changes must preserve original source duration when known, proposed duration, review status, safety dependencies, fallback state, operator notes, and last-updated metadata.
- Timeline editors should support layered timeline structures: the main timeline remains the canonical show spine, up to seven optional super-timelines may sit above it for high-level arcs or macro planning, and any number of sub-timelines may sit below it for cue, lighting, fog, strobe, projection, costume, rehearsal, media, asset, or operator layers. Each layer must remain linkable to Timeline Moment IDs or `GEN`, source-backed where possible, and safety/content-gated where relevant.
- Do not treat visually rich settings as decorative-only state. Every adjustable parameter that affects public output, show-control output, cue timing, assets, or owner workflow should be represented in JSON, displayed in the relevant management UI, exportable/importable where practical, and validated before becoming canonical.
- Preserve preview-versus-publish separation. The owner may experiment with sliders, copy, image replacements, cue timings, and layer layouts in draft/runtime overlays, but official SSOT promotion should require an explicit save/promote step, a clear diff or summary, and rollback/recovery where the app supports it.
- Notes and priorities must be editable in context and globally. The same item should allow note and priority changes while viewing its detail page, while working inside its module, and from dedicated Notes View or Priority View surfaces with drag/drop reordering, click-to-edit fields, filters, grouping, source links, and safe persistence.
- Drag/drop note and priority changes should update only the intended owner-managed overlay or canonical settings target; never let a board reorder, priority drag, or inline note edit accidentally erase source-backed data, linked records, or review metadata.

---

## 7. SSOT JSON integrity checks

Do not assume `docs/ssot`, `owner_arena_command/data/ssot`, and `secondrendition/data/ssot` are identical or equally granular.

Use these checks when data questions arise:

```bash
python3 - <<'PY'
import json, glob, os
for root in ['docs/ssot', 'owner_arena_command/data/ssot', 'secondrendition/data/ssot']:
    print('---', root)
    for p in sorted(glob.glob(root + '/*.json')):
        data = json.load(open(p))
        print(os.path.basename(p), len(data.get('canonical_records', [])), list(data.keys()))
PY
```

```bash
python3 - <<'PY'
import json, glob, os
names = sorted({os.path.basename(p) for root in ['docs/ssot','owner_arena_command/data/ssot','secondrendition/data/ssot'] for p in glob.glob(root+'/*.json')})
for name in names:
    counts=[]
    for root in ['docs/ssot','owner_arena_command/data/ssot','secondrendition/data/ssot']:
        path=root+'/'+name
        if os.path.exists(path):
            counts.append(f"{root}: {len(json.load(open(path)).get('canonical_records', []))}")
    print(name, ' | '.join(counts))
PY
```

Important maintenance rule: if a page shows little/no data, find the actual cause before changing UI or inventing records. Common causes:

1. source JSON has no granular `canonical_records`;
2. the app points at the wrong data folder;
3. copied data is in the wrong deployment path;
4. page filters are too narrow;
5. record normalization discards fields;
6. runtime overlays hide/replace seed records;
7. UI links are inert text instead of detail/source/search links;
8. JavaScript filtering hides rows;
9. stale docs describe an older tree.

---

## 8. App-specific verification commands

### Generic PHP syntax checks

```bash
find owner owner_arena_command secondrendition -name '*.php' -print0 | xargs -0 -n1 php -l
```

### JSON syntax checks

```bash
find docs/ssot owner_arena_command/data/ssot secondrendition/data/ssot -name '*.json' -print0 | xargs -0 -n1 python3 -m json.tool >/dev/null
```

### Owner arena record smoke check

```bash
php -r 'require "owner_arena_command/includes/bootstrap.php"; echo count(ac_records())." records\n"; foreach (["cue.json", "inventory_reference.json", "rig.json", "website_system_plan.json", "timeline_moment_registry.json"] as $f) { echo $f.": ".count(ac_filter_records(fn($r)=>$r["source_file"]===$f))."\n"; }'
```

### Second rendition record/data smoke check

```bash
php -r 'require "secondrendition/includes/bootstrap.php"; $s=sr_data_status(); echo "active_root: ".$s["active_root"]."\njson_count: ".$s["json_count"]."\nrecords: ".count(sr_records())."\n"; $report=sr_integrity_report(); foreach($report as $k=>$v) echo $k.": ".count($v)."\n";'
```

### Owner arena HTTP smoke check

```bash
timeout 12 bash -c 'php -S 127.0.0.1:8088 -t owner_arena_command >/tmp/arena_server.log 2>&1 & pid=$!; sleep 1; for page in dashboard timeline-registry cue-draft-import asset-inventory media-intake public-readyty-queue tasks-launch website-cms-drafts show-control-outputs records system-map ssot-library; do curl -fsS -o /tmp/owner_arena_${page}.html -w "%{http_code} %{size_download} ${page}\n" "http://127.0.0.1:8088/?page=${page}"; done; kill $pid; wait $pid 2>/dev/null || true'
```

### Second rendition HTTP smoke check

```bash
timeout 12 bash -c 'php -S 127.0.0.1:8090 -t secondrendition >/tmp/secondrendition_server.log 2>&1 & pid=$!; sleep 1; for page in dashboard explore sources integrity; do curl -fsS -o /tmp/secondrendition_${page}.html -w "%{http_code} %{size_download} ${page}\n" "http://127.0.0.1:8090/?page=${page}"; done; curl -fsS -o /tmp/secondrendition_record.html -w "%{http_code} %{size_download} record\n" "http://127.0.0.1:8090/?page=record&id=admin.first_build_modules"; curl -fsS -o /tmp/secondrendition_source.html -w "%{http_code} %{size_download} source\n" "http://127.0.0.1:8090/?page=source&file=cue.json"; kill $pid; wait $pid 2>/dev/null || true'
```

If a visible web UI change is made and a browser automation tool is available, capture a screenshot. If no browser is available, say so and provide HTTP/HTML/CSS verification instead.

---

## 9. How to answer questions

When the user asks a question:

1. Inspect the relevant files and commands first.
2. Cite exact repository files and line numbers when possible.
3. Separate confirmed facts from inferences.
4. If docs and code disagree, name the contradiction and identify the authoritative source.
5. Include the terminal commands used to answer when useful.
6. Do not overstate certainty if data is incomplete.

Example answer posture:

- **Confirmed:** what the file/code says.
- **Mismatch:** where another file or app disagrees.
- **Impact:** why it matters to owner operations, public safety, content, or data integrity.
- **Recommended fix:** smallest safe next step.

---

## 10. How to make code or documentation changes

1. Confirm the intended scope. Default owner-app work should target the app the user names. If they do not name one, ask yourself which app is active for the request: `owner_arena_command/` for first-rendition admin/editing work, `secondrendition/` for owner-first read/discovery work, `owner/` for generic scaffold work, or `proto/` for public prototype work.
2. Inspect current code/data before editing.
3. Preserve user changes and avoid unrelated cleanup.
4. Make the smallest correct patch.
5. Keep seed JSON read-only unless the user explicitly asks for data migration/seed updates and the authoritative source supports the change.
6. Validate with the smallest relevant commands.
7. If documentation changes alter source-of-truth facts, update the corresponding SSOT JSON or explicitly report the remaining sync gap.
8. Commit changes when required by the environment and prepare a PR summary.

---

## 11. Public-facing content rules

Any public copy, public prototype page, ad, EPK text, booking material, press text, or fan-facing output must be:

- original;
- public-ready;
- review-ready;
- clear that the project is not official unless content clearance exists;
- free of restricted logo copying, exact makeup designs, official-sounding claims, or implied partnership;
- aligned with the styleguide: black-first, chrome-edged, fire-lit, mythic, theatrical, and never generic.

Public-facing data should come only from records that are public-approved or explicitly reviewed. Draft cue rows, song lists, internal set labels, and KISS/Gene research are not automatically public-safe.

---

## 12. Technical-production and safety rules

When working on show-control, show-control outputs, inventory, cue data, or technical pages:

- Defer to `docs/inventory_reference.md` for exact DMX/fixture facts.
- Use `docs/rig.md` as the show-control digest, but update it if it conflicts with the inventory reference.
- Treat fog, strobes, blackout, moving heads, projection, platform/drop effects, and emergency states as safety-gated.
- Preserve venue-dependent statuses unless venue/content/safety data explicitly clears them.
- Keep one-show-control feasibility visible. Do not design cue workflows that require unseen expanded production support unless marked as optional future expansion.

---

## 13. Common task routing

| User request | Default work area |
|---|---|
| Improve generic owner scaffold | `owner/` |
| Maintain first admin/editing command center | `owner_arena_command/` |
| Improve owner-first browsing, source visibility, raw JSON access | `secondrendition/` |
| Public landing page/prototype | `proto/` |
| Source-of-truth project docs | `docs/*.md` |
| Machine-readable companions | `docs/ssot/*.json` plus app-bundled copies when needed |
| Prompt/session guidance | `docs/prompts/*.md` |
| Lighting/DMX truth | `docs/inventory_reference.md` first, then `docs/rig.md` |
| Cue/setlist draft review | `docs/cue.txt`, then registry migration rules |

---

## 14. Things not to do

- Do not rebuild existing apps from scratch unless the user explicitly asks.
- Do not treat old prompts as if the corresponding site has not already been built.
- Do not mutate bundled SSOT seed JSON through a web UI.
- Do not add a database, package manager, framework, auth system, or production upload pipeline unless requested.
- Do not copy restricted KISS logos, exact makeup designs, official marks, or official-sounding partnership language into public output.
- Do not promote `docs/cue.txt` or internal song/set labels as final show-ready or public-safe.
- Do not hide missing data behind decorative UI. Make missing data visible and actionable.
- Do not bulk-generate canonical records without tying them back to authoritative source documents.
- Do not ignore deployment paths. If data is missing on a server, inspect the configured data roots and make the UI report what it actually found.

---

## 15. Final response requirements after changes

When code or docs are changed, summarize:

- changed files with citations;
- why the change was made;
- validation commands and results;
- any limitations or follow-ups.

For each test/check in the final message, prefix the exact command with:

- ✅ for pass;
- ⚠️ for environmental limitation or expected warning;
- ❌ for agent error/failure.

Always mention if a commit and PR were created when the environment requires them.

---

## 16. Mental model to carry through the session

This repository is a staged system for turning a theatrical tribute concept into a repeatable, bookable, review-ready, safety-gated, streamlined production. The docs define truth, the SSOT JSON makes that truth machine-readable, the owner apps make it manageable, and the public prototypes must never outrun content/safety readiness.

Maintain that system. Do not flatten it into a generic website project.

---

## 17. Owner Project Manager Priority Surface Boot Addendum

When the user asks to boot, build, extend, or maintain the owner-facing project manager / priority surface, treat `docs/owner_project_manager_surface_blueprint.md` as the highest-authority product blueprint and specifically read its priority-board richness, visual-presentation, and rich first-build acceptance sections before coding.

### 17.1 Priority-board requirements to preserve

The first visible owner-manager surface should be a source-backed priority board, not a generic kanban clone. It should begin with these default columns:

1. `Notes`
2. `Questions`
3. `Now`
4. `Next`
5. `Later`
6. `Finished`

The implementation should support editable/reorderable columns, editable/reorderable cards, card movement across columns, safe deletion/recovery, JSON import/export, named JSON board saves, canonical seed reload, and automatic context/status metadata updates on drop.

Every seeded card must come from repository-derived source material and include `source_files`, module, type, classification (`GEN` or Timeline Moment ID), status, priority, notes/note count, area, owner role, next action, linked records, summary/details, and last-updated timestamp. Priority must follow the universal `0`-to-`100` scale, where `0` means null/unset, and notes must be accessible from the card or inspector without hunting through raw JSON.

### 17.2 Richness expected in already-planned modules

Do not stop at empty navigation stubs if a lightweight useful card/list/report can be derived from existing docs or SSOT companions. Carry these first-pass expectations into implementation:

- Command Dashboard: readiness pulse, today lane, risk strip, launch focus, explainable badges.
- Today / Next Actions: action-first list with owner-role, priority, and blocked filters.
- Notes & Decisions: raw-note preservation, promotion paths, decision log, and canon comparison.
- Timeline / Show Spine: registry-first Timeline IDs, cue-draft migration state, and draft warnings.
- Cue & Run Sheet: proposed operator rows, editable section/cue durations, layered Timeline views, fallback/safety fields, and draft run-sheet export.
- Inventory / Assets: total-inventory views with priority and notes on every ID-bearing item, condition/storage/source/manual/packing fields, missing-photo warnings, and direct create/edit/manage/update/delete access for records and notes.
- Media & Files: record-linked files with rights/content/public-private status.
- Website Manager: page map, section-level settings JSON, slider/toggle/text/asset controls, language-token references, public-copy review, preview-versus-publish separation, and guarded SSOT promotion/publish readiness.
- Marketing Manager: five-stage campaign board, platform creative records, fact chips, and rights guardrails.
- Booking / Contacts: lightweight contacts, next follow-ups, and buyer-packet readiness.
- Rehearsal & Prep: practice notes linked to timeline/cue/assets and next rehearsal actions.
- Packing / Maintenance: road-case mode, maintenance queue, and preflight/postflight export targets.
- Docs & SSOT Library: source-document cards from `docs/ssot/master_index.json`.
- Priority View: cross-system priority index with editable `0`-to-`100` ratings, unset-priority gap surfacing, filters by priority band/status/source/module, and direct record/note management links.
- Notes View: cross-system notes index that supports one or more notes per item, shows note counts and note types, preserves raw-note context, and provides direct add/edit/update/delete/manage paths.
- Reports / Exports: board snapshot, total inventory, priority index, notes index, next actions, open questions, cue draft, and docs-health exports.

### 17.2.1 Settings-file and control-surface richness

When a module has owner-tunable behavior, presentation, timing, or asset choices, do not bury that configuration in code. Create or preserve a JSON-backed settings layer that can drive an appropriate owner/developer UI:

- For visual/effect-like configuration, expose developer-meaningful parameters with sliders, numeric fields, toggles, grouped controls, preview states, reset buttons, validation messages, notes, and priority controls.
- For public website sections, expose copy, local asset replacement, section ordering, intensity/style tokens, CTA settings, publication status, rights/content review flags, and source attribution so approved owner changes can be promoted into the public-website SSOT.
- For cue and performance sections, expose duration editing, moment/layer assignment, operator/fallback/safety fields, and dependencies while preserving canonical Timeline Moment IDs and original source context.
- For timeline workspaces, preserve one canonical main timeline, allow up to seven optional super-timelines above it, and allow unlimited sub-timelines below it for operational layers such as lighting, fog, strobes, projection, costume, media, rehearsal, asset, and operator notes.
- For notes and priorities, allow edit-in-place from record detail, module views, Notes View, Priority View, and board/card inspectors. Drag/drop reordering must preserve IDs, sources, linked records, review gates, and undo/recovery behavior where available.

### 17.3 Visual and brand rules to carry into code

The owner app should look like a dark backstage cockpit. It should be theatrical enough to belong to Just One KISS and calm enough to manage real work.

- Black/near-black is the base.
- Chrome/gunmetal/steel is the structural layer.
- Red/orange marks urgency, active work, blockers, destructive confirmations, and primary actions.
- Gold/yellow marks source facts, Timeline/`GEN` chips, verified details, and readiness highlights.
- Headings may be bold/condensed/theatrical, but forms, cards, tables, and metadata must stay readable.
- Statuses and warnings must use labels/icons in addition to color.
- Avoid constant flashing, pulsing, or strobe-like UI effects.
- Do not use official KISS logos, exact makeup replication, exact official costumes, album-art copying, restricted fonts, outside photos, implied official partnership, or unreviewed likeness/voice claims in generated public materials.
- Do not mark cue, public-copy, marketing, rights-sensitive, or safety-sensitive records `show_ready` or `publish_ready` without supporting source and review metadata.

### 17.4 Acceptance reminder

Before reporting a first owner-priority implementation as ready, verify that the board can be used without rereading raw notes, all seeded cards are source-backed, drag/drop preserves metadata and recovery, JSON save/load/import/export works, module counts are explainable, the inspector shows sources/links/warnings/next actions, owner-tunable settings are represented in JSON-backed controls rather than hidden code, public-site changes have preview/promote/rollback guardrails, timeline/cue settings preserve main/super/sub-timeline structure and safety gates, and the visual presentation follows the backstage-cockpit rules.
