# Just One KISS - Proto Public Site Fresh Expert Coding Boot Prompt

Use this prompt to boot a fresh expert coding LLM session into the `Just One KISS` repository when the work target is the standalone public-facing website under `proto/`.

This is **not** a greenfield website. The repository already contains master planning documents, SSOT JSON companions, private owner/admin applications, and an active public PHP prototype. Your job is to understand the current tree before making claims, then answer questions or make the smallest safe code/documentation changes while preserving the project truth, public-content posture, safety warnings, and deployable `proto/public/` runtime.

---

## 0. First response posture

Start concise and operational:

> I will verify the live repository state, read the project/source-of-truth docs and the `proto/` public-site docs, inspect the active `proto/public/` runtime, then make the smallest safe change while preserving public public-readyty, event facts, form/data integrity, and deployable vanilla PHP behavior.

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
find proto -maxdepth 3 -type f | sort
find proto/public/assets -maxdepth 3 -type f | sort
```

Use `rg`, `find`, `sed`, `nl -ba`, `php -l`, `python3 -m json.tool`, and `curl` for inspection. Do **not** use slow recursive commands such as `ls -R` or `grep -R`.

If the working tree is dirty, classify changes before touching files:

1. user changes;
2. previous-agent changes;
3. your own changes.

Do not overwrite or casually clean up unrelated changes.

---

## 2. Required reading order

Read enough of these files to understand both the project truth and the current public-site implementation before planning or editing.

### Repository and project truth

```text
README.md
docs/knowledge.md
docs/prompt.md
docs/qwen_model_routing.md
docs/mastergameplan.md
docs/timeline_moment_registry.md
docs/cue.txt
docs/styleguide.md
```

Read `docs/inventory_reference.md` and `docs/rig.md` whenever work touches public claims about lighting, QLC+/DMX, fog, strobes, projection, rig capability, venue safety, or show-control workflow.

### Prompt history and site-specific prompt context

```text
docs/prompts/full_project_fresh_expert_coding_boot_prompt.md
docs/prompts/proto_public_site_fresh_expert_coding_prompt.md
```

Use older owner-site prompts only as context if the user asks about owner/admin systems; do not let owner-app assumptions override the public-site runtime.

### Active `proto/` site docs

```text
proto/README.md
proto/docs/website_ssot.md
proto/docs/routes_and_supporting_pages.md
proto/docs/launch_checklist.md
proto/docs/asset_placeholders.md
proto/docs/image_generation_inventory.md
proto/docs/image_generation_requests.txt
proto/docs/image_generation_prompt_list.txt
proto/docs/language_map.md
```

### Active `proto/` runtime files

```text
proto/public/index.php
proto/public/*/index.php
proto/app/view.php
proto/app/site_data.php
proto/app/language.php
proto/app/helpers.php
proto/app/csrf.php
proto/app/db.php
proto/app/mailer.php
proto/app/forms/lead_submit.php
proto/app/forms/inquiry_submit.php
proto/public/assets/css/site.css
proto/public/assets/js/site.js
proto/docs/language.json
proto/database/schema.sql
proto/database/seed.sql
proto/admin/index.php
proto/public/admin-language-save.php
```

---

## 3. Core project truth to preserve

The project is **Just One KISS**: a Gene Simmons tribute theatrical stage event inspired by Gene Simmons/KISS-style spectacle. It is intended to become a repeatable, bookable, streamlined theatrical production.

Current public/event focus:

- Interlochen, Michigan-area event.
- Cycle Moore Legacy, 11075 US 31 South, Interlochen, Michigan.
- Date: July 25, 2026.
- Public offer: free show admission; no ticket required; RSVP/update-list signup is appreciated.
- Camping: overnight camping is currently represented as `$10/night`; regular Cycle Moore charges apply for stays more than one night before or after the event.
- Tone: black-first, chrome-edged, fire-lit, theatrical, mythic, loud, fan-facing, never generic.

Non-negotiables:

1. Public copy must remain original, public-ready, and review-ready.
2. Do not imply outside partnership, partnership, sponsorship, ownership, content, or clearance by KISS, Gene Simmons, Pophouse, or related content holders unless cleared.
3. Treat strongly presentation-adjacent phrasing, exact makeup/costume/logo resemblance, outside media, album art, restricted marks, and official-sounding claims as content-sensitive.
4. Keep fog, strobe, bright-light, loud-sound, projection, and venue-dependent claims safety-gated and clearly warned.
5. Preserve the Gene Simmons tribute / show-control baseline unless marked as optional future expansion.
6. `docs/cue.txt` is an internal working cue/setlist draft, not a public-safe final show bible.
7. If event data is incomplete or uncertain, say so and recommend reconciliation. Do not invent facts.
8. Prefer the existing vanilla PHP/HTML/CSS/JS approach unless the user explicitly asks for another stack.
9. Public-route changes must keep `proto/public/` deployable as the web document root.

---

## 4. Source-of-truth hierarchy for public-site work

When docs, JSON, code, or assumptions disagree, use this order:

1. `README.md` for repository-level structure and project rules.
2. `docs/mastergameplan.md` for broad project architecture.
3. `docs/styleguide.md` for public tone, visual direction, and public-readyty posture.
4. `docs/timeline_moment_registry.md` for Timeline/`GEN` classification and ID governance.
5. `docs/cue.txt` only as internal draft show-flow context, not final public-ready setlist truth.
6. `docs/inventory_reference.md` for exact lighting/DMX/fixture facts; `docs/rig.md` as show-control digest.
7. `proto/docs/website_ssot.md` for public-site implementation canon.
8. `proto/docs/routes_and_supporting_pages.md` for route purpose and status.
9. `proto/docs/language.json` as the runtime language-token inventory consumed by PHP helpers.
10. `proto/docs/language_map.md` as the human review map generated from `language.json`; if JSON changes, the map may need regeneration or explicit sync notes.
11. PHP/CSS/JS runtime files as the current implementation truth.

When changing public copy, update the runtime source that actually renders it. If the same copy is represented in `proto/docs/language.json` or `proto/docs/language_map.md`, update the companion or explicitly report the remaining sync gap.

---

## 5. Current `proto/` architecture to understand

### Active document root

`proto/public/` is the active public document root.

Run locally with:

```bash
php -S 127.0.0.1:8000 -t proto/public
```

Open `http://127.0.0.1:8000/`.

Do not assume the top-level legacy route copies under `proto/*.php` or `proto/*/index.php` are the active deployment root. Inspect them if needed, but public runtime work should target `proto/public/` unless the user explicitly asks otherwise.

### Runtime layout

```text
proto/
  README.md
  app/
    config.example.php
    csrf.php
    db.php
    helpers.php
    language.php
    mailer.php
    site_data.php
    view.php
    forms/
      lead_submit.php
      inquiry_submit.php
  admin/
    index.php
  database/
    schema.sql
    seed.sql
  docs/
    website_ssot.md
    routes_and_supporting_pages.md
    launch_checklist.md
    asset_placeholders.md
    image_generation_inventory.md
    image_generation_requests.txt
    image_generation_prompt_list.txt
    language.json
    language_map.md
    language_backups/*.json
  public/
    index.php
    admin-language-save.php
    assets/css/site.css
    assets/js/site.js
    assets/img/*.webp
    july-25-2026/index.php
    directions/index.php
    what-is-just-one-kiss/index.php
    spectacle/index.php
    vault/index.php
    video/index.php
    technical/index.php
    faq-disclaimer/index.php
    contact/index.php
    contact-press/index.php
```

### Shared rendering/data flow

- `proto/public/index.php` and supporting routes include `proto/app/view.php`.
- `proto/app/view.php` loads helpers, CSRF, language helpers, and site data.
- `site_pages()` in `proto/app/site_data.php` defines route labels, summaries, and nav inclusion.
- `render_header()` outputs the document shell, CSS link, inline CSS fallback, skip link, presentation, and nav.
- `render_footer()` outputs shared bottom event information, footer safety/content copy, mobile CTA, language-admin payload when logged in, JavaScript link, and inline JS fallback.
- `lang_text()`, `lang_editable()`, and related helpers read from `proto/docs/language.json` and escape public output by default.
- `proto/public/assets/css/site.css` owns the public visual system.
- `proto/public/assets/js/site.js` owns countdown, form status enhancement, checkbox grouping, in-memory tracking, hover enhancement, and inline language editing when admin is active.

### Forms and persistence

- Lead/update form lives in `render_lead_form()` and posts through `proto/app/forms/lead_submit.php`.
- Inquiry/contact form lives in `render_inquiry_form()` and posts through `proto/app/forms/inquiry_submit.php`.
- Both forms use CSRF, honeypot fields, server-side validation, and required consent.
- `proto/app/db.php` returns `null` unless DB is enabled in `proto/app/config.php`; without DB config, valid submissions return honest local fallback messages and are not persisted.
- `proto/app/mailer.php` is a no-op until an approved notification workflow exists.
- `proto/database/schema.sql` and `proto/database/seed.sql` are optional MySQL/MariaDB setup files.

### Language/admin tooling

- `proto/docs/language.json` is the runtime language-token inventory.
- `proto/docs/language_map.md` is the human review companion.
- `proto/admin/index.php` and `proto/public/admin-language-save.php` are prototype admin tooling, not production-grade auth.
- Hardcoded/admin prototype behavior must be treated as a launch blocker unless secured or disabled.
- Language edits may create timestamped backups under `proto/docs/language_backups/`; do not bulk-delete or rewrite these unless asked.

### Current approved image assets

Keep `image_inventory()` aligned with actual approved files in `proto/public/assets/img/`. As of this prompt, the expected runtime inventory is:

```text
costume-chrome-detail.webp
fog-strobe-atmosphere.webp
gear-control-dossier.webp
hero-stage-portal.webp
interlochen-dispatch-map.webp
press-performer-portrait.webp
road-case-vault-bg.webp
spectacle-lighting-rig.webp
trailer-poster-stage-portal.webp
```

If adding/removing image assets, reconcile:

- `proto/public/assets/img/`
- `proto/app/site_data.php`
- `proto/docs/asset_placeholders.md`
- `proto/docs/image_generation_inventory.md`
- relevant page `asset_style()` / `render_media_grid()` references
- content/safety notes for public image use

---

## 6. Current public route responsibilities

Verify current code before editing, but expect these route jobs:

| Route | Job |
| --- | --- |
| `/` | Main landing page: hero, countdown, event facts, spectacle proof, lead form, final CTA, Fan Vault, shared event footer. |
| `/july-25-2026/` | Free-show event page with verified date/location/admission/camping/parking/safety facts and update-list conversion. |
| `/directions/` | Arrival page with Cycle Moore Legacy address, phone, map/link, camping/parking/access notes. |
| `/what-is-just-one-kiss/` | “Ritual”/about page explaining the independent tribute from fan love while preserving public-ready framing. |
| `/spectacle/` | Capability/atmosphere page for lights, projection, fog/strobes, costume transformation, venue appeal, and safety-aware effects. |
| `/vault/` | Fan Vault/gallery/media guidance route for approved original media and fan-sharing instructions. |
| `/video/` | Trailer/clip route for approved original video and fan-sharing guidance. |
| `/technical/` | Public technical overview for QLC+/DMX, projection, fog/strobes, emergency-state posture, and venue-aware limitations. |
| `/faq-disclaimer/` | FAQ, safety, accessibility, content/disclaimer route. |
| `/contact/` | Contact/update/inquiry route for fans, press/media, access/safety, directions, and technical questions. |
| `/contact-press/` | Retired legacy route; should redirect to `/contact/`. |

---

## 7. Public copy rules

Public-facing copy must be:

- original;
- public-ready;
- review-ready;
- clear that the project is independent and not official unless content clearance exists;
- free of restricted logo copying, exact makeup designs, official imagery, album art, or official-sounding claims;
- aligned with the styleguide: black-first, chrome-edged, fire-lit, mythic, theatrical, loud, fan-facing, never generic.

Keep practical event facts plain and readable:

- Date: July 25, 2026.
- Location: Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643.
- Admission: free show; no ticket required; RSVP/update-list appreciated.
- Camping: `$10/night`; regular Cycle Moore charges apply for longer stays before/after unless newer verified info exists.
- Parking: inside campground around pavilion on grass as directed/marked when stated.
- Safety: loud sound, bright lights, fog, flashing patterns/strobe-style looks may be used.
- Content: independent theatrical tribute; no outside partnership is claimed.

When using phrases strongly associated with KISS/Gene/KISS mythology, flag them as content-sensitive and do not strengthen official-seeming claims.

---

## 8. Safety and technical-production rules for public pages

When public pages mention technical show capability:

- Treat fog, strobes, projection, bright lights, blackout, moving lights, platform/drop effects, and emergency states as safety-gated and venue-aware.
- Do not imply pyrotechnics, flame, explosives, or unapproved effects unless documentation and content/venue review explicitly clear them.
- Prefer “fire-lit,” “fire-colored,” “fire energy,” or “theatrical fire language” when describing visual tone without actual fire.
- Keep one-show-control feasibility visible for show-control claims.
- Defer to `docs/inventory_reference.md` for exact DMX/fixture facts and `docs/rig.md` as a digest.
- Do not publish internal cue/setlist specifics from `docs/cue.txt` unless reviewed and explicitly public-safe.

---

## 9. Recommended verification commands

Run the smallest relevant checks after changes. For broad `proto/` work, use:

### PHP syntax

```bash
find proto -name '*.php' -print0 | xargs -0 -n1 php -l
```

### JSON validity

```bash
python3 -m json.tool proto/docs/language.json >/dev/null
```

### Language inventory smoke check

```bash
php -r 'require "proto/app/language.php"; echo count(language_entries())." language entries\n";'
```

### Image inventory smoke check

```bash
php -r 'require "proto/app/site_data.php"; foreach (image_inventory() as $f) { $p="proto/public/assets/img/$f"; echo (is_file($p)?"OK ":"MISS ").$f."\n"; }'
```

### Public route smoke check

```bash
timeout 15 bash -c 'php -S 127.0.0.1:8010 -t proto/public >/tmp/proto_server.log 2>&1 & pid=$!; sleep 1; for path in / /july-25-2026/ /directions/ /what-is-just-one-kiss/ /spectacle/ /vault/ /video/ /technical/ /faq-disclaimer/ /contact/ /contact-press/; do curl -fsS -o /tmp/proto_${path//\//_}.html -w "%{http_code} %{size_download} ${path}\n" "http://127.0.0.1:8010${path}" || echo "ERR ${path}"; done; kill $pid; wait $pid 2>/dev/null || true'
```

### Stale path/reference smoke check

```bash
rg -n "thesite|regular Arrival tips for fans charges apply|button-fire-flare|section-fire|cycle-moore-map|campground-parking|pavilion-stage|family-friendly-firelight|facebook-share-flame" proto/README.md proto/docs/website_ssot.md proto/docs/language.json proto/docs/language_map.md proto/public/index.php proto/app/site_data.php proto/public/assets/css/site.css || true
```

If a visible web UI change is made and browser automation is available, capture a screenshot. If no browser is available, say so and provide HTTP/HTML/CSS verification instead.

---

## 10. Common task routing inside `proto/`

| User request | Default files/areas |
| --- | --- |
| Homepage copy/layout | `proto/public/index.php`, `proto/docs/language.json`, `proto/docs/language_map.md`, `proto/public/assets/css/site.css` |
| Supporting page copy/layout | `proto/public/<route>/index.php`, language JSON/map, CSS as needed |
| Header/footer/nav | `proto/app/view.php`, `proto/app/site_data.php`, language JSON/map |
| Route list/nav status | `proto/app/site_data.php`, `proto/docs/routes_and_supporting_pages.md`, `proto/docs/website_ssot.md` |
| Visual styling | `proto/public/assets/css/site.css`, image docs/assets as needed |
| Progressive enhancement | `proto/public/assets/js/site.js` |
| Lead/update form | `proto/app/view.php`, `proto/app/forms/lead_submit.php`, `proto/database/schema.sql`, language JSON/map |
| Inquiry/contact form | `proto/app/view.php`, `proto/app/forms/inquiry_submit.php`, `proto/database/schema.sql`, language JSON/map |
| Runtime language tokens | `proto/docs/language.json`, `proto/docs/language_map.md`, `proto/app/language.php`, admin tooling if needed |
| Public images/assets | `proto/public/assets/img/`, `proto/app/site_data.php`, `proto/docs/asset_placeholders.md`, image-generation docs |
| Public-site docs/SSOT | `proto/docs/website_ssot.md`, `proto/docs/routes_and_supporting_pages.md`, `proto/docs/launch_checklist.md` |
| Admin language tooling | `proto/admin/index.php`, `proto/public/admin-language-save.php`, `proto/app/language.php` |
| Database persistence | `proto/app/config.example.php`, `proto/app/db.php`, `proto/database/schema.sql`, `proto/database/seed.sql` |

---

## 11. Things not to do

- Do not rebuild the site from scratch unless explicitly asked.
- Do not move the active public site away from `proto/public/` without explicit direction.
- Do not treat top-level legacy route copies as the active document root unless the user explicitly asks to fix that deployment mode.
- Do not add a framework, build pipeline, package manager, database dependency, or auth system unless requested.
- Do not make public copy more official-sounding or imply partnership/content.
- Do not publish internal setlist/cue details from `docs/cue.txt` by default.
- Do not hide missing data behind decorative UI.
- Do not add generated images that mimic restricted logos, exact makeup, official stage designs, outside media, or restricted marks.
- Do not casually rewrite `proto/docs/language.json` or `language_map.md` without validating JSON and explaining sync implications.
- Do not delete language backups or runtime artifacts unless specifically asked and after checking git status.

---

## 12. How to answer questions

When answering questions about the public site:

1. Inspect the relevant files and run targeted commands first.
2. Separate confirmed facts from inference.
3. Cite exact files and line numbers when possible.
4. Name contradictions between docs and runtime, then identify the more authoritative source.
5. Include terminal commands used when useful.
6. Do not overstate certainty if event/content/safety data is incomplete.

Suggested answer structure:

- **Confirmed:** what the files/runtime say.
- **Mismatch:** where docs/code/data disagree.
- **Impact:** why it matters for deployment, public copy, content, safety, forms, or data integrity.
- **Recommended fix:** smallest safe next step.

---

## 13. How to make changes

1. Confirm scope: public-site work defaults to `proto/`, especially `proto/public/` and `proto/app/`.
2. Inspect before editing.
3. Preserve user changes and avoid unrelated cleanup.
4. Make the smallest correct patch.
5. If public copy changes, check whether the rendered source is hardcoded PHP fallback, language JSON, or both.
6. If docs change source-of-truth facts, update the matching runtime/data/doc companions or report the sync gap.
7. Validate with the smallest relevant commands.
8. If there is a perceptible UI change and screenshot tooling is available, capture a screenshot; otherwise report HTTP/HTML/CSS verification.
9. Commit changes and prepare a PR summary when the environment requires it.

---

## 14. Final response requirements after changes

When code or docs are changed, summarize:

- changed files with citations;
- why the change was made;
- validation commands and results;
- any limitations or follow-ups;
- commit hash and PR creation if the environment requires them.

For each test/check in the final message, prefix the exact command with:

- ✅ for pass;
- ⚠️ for environmental limitation or expected warning;
- ❌ for agent error/failure.

---

## 15. Mental model

The `proto/` site is the public-facing prototype for a review-ready, safety-gated theatrical tribute event. It must sell the July 25, 2026 Cycle Moore Legacy event with force and clarity while never outrunning content review, safety readiness, verified event facts, or the streamlined show-control model. The code is intentionally simple vanilla PHP/CSS/JS; maintain that simplicity, keep the active document root deployable, and keep public copy original, caveated, and reviewable.
