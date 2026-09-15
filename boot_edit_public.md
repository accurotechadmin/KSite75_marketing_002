# Just One KISS Public Website Editing Primer

Use this secondary primer **after `boot.md` has already been loaded and followed**. It equips a fresh expert coding LLM session to analyze, answer questions about, and safely edit the active public website under `proto/public/`.

This primer does not replace repository canon. It narrows the already-booted session onto the deployed public-site surface and the exact supporting files that keep it truthful, rights-aware, accessible, and vanilla-PHP deployable.

---

## 1. First-response posture for public-site work

Start concise and specific:

> I will treat `proto/public/` as the active public document root, read the public-site canon, language tokens, shared PHP, route files, CSS/JS, forms, and assets before editing, then make the smallest public-ready change while preserving free-show facts, camping-cost separation, independent-tribute disclaimers, safety warnings, accessibility, static-runtime posture, and language/SSOT alignment.

Do not edit top-level legacy route copies under `proto/*.php` or `proto/*/index.php` unless the user explicitly asks for legacy parity.

---

## 2. Public-site boot commands

Run these from the repository root after the main `boot.md` commands, before public-site edits:

```bash
pwd
git status --short
find proto/public -maxdepth 4 -type f | sort
find proto/app -maxdepth 3 -type f | sort
find proto/docs -maxdepth 2 -type f ! -path 'proto/docs/language_backups/*' | sort
find proto/database -maxdepth 2 -type f | sort
find proto/public/assets -maxdepth 3 -type f | sort
rg -n "TODO|FIXME|launch blocker|placeholder|language_backups|admin|inline|token|lang_editable|lang_text|lang_editable_lines|lang_editable_with_strong_prefix|render_image_placeholder|render_event_information|render_lead_form|render_inquiry_form|asset_style|image_inventory|site_pages|csrf|honeypot|consent|free show|ticket|camping|parking|Cycle Moore|Interlochen|strobe|fog|flashing|independent|affiliation|sponsorship|authorization|endorsement|accessibility|reduced-motion|route|legacy|public-ready" proto/README.md proto/app proto/public proto/docs -g '!proto/docs/language_backups/*'
```

If the tree is dirty, classify changes before editing. Treat any changes not made in the current turn as user or previous-agent work and do not overwrite them.

---

## 3. Required reading order

Read enough to understand the public site before planning an edit. Use `sed -n`, `nl -ba`, `rg`, and targeted file reads.

### 3.1 Public-site canon and inventory

1. `proto/README.md` — active document root, runtime notes, optional DB fallback, effect posture.
2. `proto/docs/website_ssot.md` — active website canon, homepage section truth, public facts, forms, route jobs, launch readiness, decision log.
3. `proto/docs/routes_and_supporting_pages.md` — route purposes, active supporting page status, redirect truth.
4. `proto/docs/website_inventory.md` — active route/component/asset/form inventory and active-versus-legacy file map.
5. `proto/docs/launch_checklist.md` — public launch blockers and local verification expectations.
6. `proto/docs/developer_editor_guide.md` — edit workflow, route/copy/form/admin cautions, testing matrix.
7. `proto/docs/css_style_reference.md` when touching layout, CSS, responsive behavior, component classes, visual rhythm, or inline admin styling.

### 3.2 Copy, language, and public facts

1. `proto/docs/language.json` — active runtime public copy source.
2. `proto/docs/language_map.md` — human review map; update/regenerate when language entries change.
3. `proto/app/language.php` — token loader, `lang_text()`, editable wrappers, inline admin helpers, JS payload helpers.
4. Relevant route files under `proto/public/` — placement and semantic structure, not routine copy source.
5. `docs/brand_story_style_guide_inventory.md` and `docs/styleguide.md` for tone/brand guardrails when changing public-facing wording.

### 3.3 Shared runtime and route structure

1. `proto/app/view.php` — header, footer, shared event information, forms, asset helpers, relative URL helpers, inline admin injection.
2. `proto/app/site_data.php` — route registry and approved image inventory.
3. `proto/app/helpers.php` — escaping, POST helpers, current path/source helpers, local fallback note.
4. `proto/app/csrf.php` — CSRF token behavior.
5. `proto/app/forms/lead_submit.php` and `proto/app/forms/inquiry_submit.php` when touching forms or form-adjacent copy.
6. `proto/app/db.php`, `proto/app/mailer.php`, and `proto/app/config.example.php` when touching persistence, local fallback behavior, or notifications.

### 3.4 Active public route files

Read the exact active route(s) before editing. Current active routes live under `proto/public/`:

- `proto/public/index.php` — homepage with hero, event details, spectacle proof, lead form, final CTA, Fan Vault, shared event info/footer.
- `proto/public/july-25-2026/index.php` — Free Show page with verified event facts, camping/free-admission separation, parking, safety, update-list conversion.
- `proto/public/directions/index.php` — arrival, address/phone, map, camping, parking, access-routing notes.
- `proto/public/what-is-just-one-kiss/index.php` — Ritual/about page preserving independent-tribute framing.
- `proto/public/spectacle/index.php` — capability-oriented spectacle page.
- `proto/public/vault/index.php` — Fan Vault/future media guidance.
- `proto/public/video/index.php` — approved trailer/clip slots and sharing guidance.
- `proto/public/technical/index.php` — public technical overview, QLC+/DMX/fog/strobe/emergency-state/event info.
- `proto/public/faq-disclaimer/index.php` — FAQ, safety, practical information, independent-tribute disclaimer.
- `proto/public/contact/index.php` — update and inquiry forms, placeholder editable email/Facebook values, public routing.
- `proto/public/contact-press/index.php` — retired legacy redirect to `/contact/`.

### 3.5 Assets, images, and generated-media planning

1. `proto/app/site_data.php` for the approved `image_inventory()` filenames.
2. `proto/public/assets/img/README.md` and files in `proto/public/assets/img/` for current active assets.
3. `proto/docs/asset_placeholders.md`, `proto/docs/image_generation_inventory.md`, `proto/docs/image_generation_requests.txt`, and `proto/docs/image_generation_prompt_list.txt` before replacing placeholders, adding images, or changing image strategy.
4. `docs/marketing_still_image_inventory.md`, `docs/first_run_marketing_campaign.md`, and marketing prompt/mockup specs only when public website work crosses into campaign assets or generated image planning.

---

## 4. Public website truths to preserve

- Active document root is `proto/public/`.
- Shared app/runtime code is `proto/app/`.
- Runtime copy comes from `proto/docs/language.json` through `proto/app/language.php`.
- Top-level copies under `proto/*.php` and `proto/*/index.php` are legacy/provenance, not active deployment files.
- The July 25, 2026 Interlochen/Cycle Moore Legacy event facts must stay visible as real text.
- Free show admission is the public offer; no ticket is required; RSVP/update-list signup is appreciated where stated.
- Camping is separate: $10 per night per person for one night before and one night after the show; electric hookup is $35 per person.
- Parking is outside the gate; overflow and handicap parking available.
- Loud sound, bright lights, fog, flashing patterns, and strobe-style looks may be used; keep warnings near conversion points and in shared event/footer contexts.
- Public posture is independent theatrical tribute; do not claim official affiliation, sponsorship, authorization, endorsement, ownership, clearance, or approval.
- Public runtime remains static/plain: no browser fire/ember/smoke/heat lab, particle emitters, distortion filters, or runtime effect canvases unless explicitly requested and reviewed.
- Homepage generated backgrounds are approved; supporting pages keep visible placeholder prompt blocks until route-specific images are generated, reviewed, and approved.

---

## 5. Editing rules by change type

### 5.1 Copy edits

1. Search for the phrase/token:

   ```bash
   rg -n "phrase or token" proto/docs/language.json proto/docs/language_map.md proto/public proto/app
   ```

2. Prefer changing `canonical_text` in `proto/docs/language.json` when the route is tokenized.
3. Preserve route fallback strings unless intentionally improving failure-mode readability.
4. Update or regenerate `proto/docs/language_map.md` when language JSON changes.
5. Search for duplicated public facts across route files, shared footer/event block, metadata, and docs.
6. Validate JSON after any language edit.

### 5.2 Route/layout edits

1. Edit active files under `proto/public/`, not legacy route copies.
2. Keep semantic headings, skip link target, form labels, ARIA labels, keyboard focus, and readable text.
3. Use `page_url()`, `rel_url()`, and shared helpers; do not hard-code nested-relative paths casually.
4. If adding a route, add active route file, route metadata in `site_pages()`, language tokens, route docs, inventory docs, smoke test, and launch-checklist impacts.
5. Smoke-test `/` plus at least one nested route after route or shared view changes.

### 5.3 CSS/visual edits

1. Read `proto/docs/css_style_reference.md` first.
2. Preserve black-first, chrome-edged, fire-lit, high-contrast theatrical style.
3. Keep layout staged and readable, not generic brochure/SaaS styling.
4. Maintain mobile layout, focus visibility, color contrast, and reduced-motion behavior.
5. If the change is perceptible in the browser, run the local server and take/review a screenshot when tooling allows.

### 5.4 JavaScript edits

1. Keep `proto/public/assets/js/site.js` progressive-enhancement only.
2. The page must remain usable without JavaScript.
3. Preserve existing responsibilities: countdown, local click/form event logging, topic-checkbox behavior, submit-status text, inline language editing, Fan Vault hover state.
4. Honor reduced-motion preferences and avoid runtime spectacle/effect systems unless explicitly requested.

### 5.5 Form edits

1. Read `proto/app/view.php`, `proto/app/forms/lead_submit.php`, `proto/app/forms/inquiry_submit.php`, `proto/app/csrf.php`, `proto/app/db.php`, and schema/seed SQL.
2. Preserve CSRF, honeypot, server-side validation, required consent, and optional DB behavior.
3. Do not promise instant replies, production email workflow, official recordings, official media, or external approvals unless verified.
4. If adding fields, update form markup, handlers, validation, DB schema/seed if needed, language tokens/map, docs, and tests.

### 5.6 Asset/image edits

1. Keep event facts in selectable/readable text, not only images.
2. Register approved local images in `image_inventory()` and place active files under `proto/public/assets/img/`.
3. Supporting route placeholders stay until route-specific images are approved.
4. Do not use official logos, exact protected makeup, official photos, album art, or official-sounding affiliation language.

---

## 6. Recommended public-site checks

Run the subset relevant to changed files.

### PHP syntax

```bash
find proto -name '*.php' -print0 | xargs -0 -n1 php -l
```

### Language JSON

```bash
python3 -m json.tool proto/docs/language.json >/tmp/jok-language.json
```

### Repository JSON excluding language archives

```bash
python3 - <<'PY'
import json, pathlib
for p in sorted(pathlib.Path('.').rglob('*.json')):
    if any(part in {'vendor', 'node_modules', '.git', 'language_backups'} for part in p.parts):
        continue
    json.loads(p.read_text())
print('json ok')
PY
```

### Public route smoke test

```bash
php -S 127.0.0.1:8000 -t proto/public
curl -I http://127.0.0.1:8000/
curl -I http://127.0.0.1:8000/july-25-2026/
curl -I http://127.0.0.1:8000/directions/
curl -I http://127.0.0.1:8000/what-is-just-one-kiss/
curl -I http://127.0.0.1:8000/spectacle/
curl -I http://127.0.0.1:8000/vault/
curl -I http://127.0.0.1:8000/video/
curl -I http://127.0.0.1:8000/technical/
curl -I http://127.0.0.1:8000/faq-disclaimer/
curl -I http://127.0.0.1:8000/contact/
curl -I http://127.0.0.1:8000/contact-press/
```

### Diff review

```bash
git diff --check
git diff --stat
git diff -- proto/public proto/app proto/docs proto/database
```

---

## 7. Public-site boot completion report

Before editing public-site files, report:

1. **Public docs studied** — docs/source files read and their roles.
2. **Active files** — exact active route/app/CSS/JS/language files involved.
3. **Public truths at risk** — event facts, free-show/camping distinction, safety, disclaimer, accessibility, forms, assets.
4. **Planned smallest change** — exact files and why.
5. **Docs/SSOT synchronization** — whether language map, website SSOT/inventory/routes docs, launch checklist, or paired SSOT JSON need updates.
6. **Checks to run** — targeted commands.

End with:

> I am booted for `proto/public/`, current on the public website truth, and ready to edit the active public site safely.
