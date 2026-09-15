# Just One KISS Admin Language Editor Primer

Use this secondary primer **after `boot.md` has already been loaded and followed**. It equips a fresh expert coding LLM session to analyze, answer questions about, and safely edit the administrative public-page-editor suite under `proto/admin/` and its active public save endpoint.

This is not a general admin/CMS rebuild prompt. It narrows the session to the existing prototype admin language/editor tooling for the `proto/` public website and the exact files that make it work.

---

## 1. First-response posture for admin-editor work

Start concise and specific:

> I will treat `proto/admin/index.php` as the prototype admin language-editor UI and `proto/public/admin-language-save.php` as the active inline-save endpoint, read the public-site boot/canon first, inspect language/session/CSRF/backup/write behavior before claims, then make the smallest safe admin-editor change while preserving prototype warnings, authorization/session gates, CSRF checks, timestamped backups, language JSON validity, language-map synchronization, and public-copy guardrails.

Do not present this suite as production-secure. It is prototype tooling that must be secured or disabled before public deployment unless the task explicitly implements and verifies a hardened deployment plan.

---

## 2. Admin-editor boot commands

Run these from the repository root after the main `boot.md` commands, before editing admin tooling:

```bash
pwd
git status --short
find proto/admin -maxdepth 3 -type f | sort
find proto/public -maxdepth 3 -type f \( -name 'admin-language-save.php' -o -name 'index.php' \) | sort
find proto/app -maxdepth 2 -type f | sort
find proto/docs -maxdepth 2 -type f ! -path 'proto/docs/language_backups/*' | sort
rg -n "admin|login|logout|password|session|csrf|jok_admin|language_admin|inline|save|backup|language_backups|canonical_text|token|review|rights_safe|safety_related|verified_fact|needs_owner_review|language_map|writable|LOCK_EX|json_encode|json_decode|prototype|secure|disable" proto/admin proto/public/admin-language-save.php proto/app proto/docs/developer_editor_guide.md proto/docs/website_inventory.md proto/docs/language_map.md -g '!proto/docs/language_backups/*'
```

If the working tree is dirty, classify changes before editing and do not overwrite unrelated work.

---

## 3. Admin-editor surface map

### 3.1 Active admin/editor files

- `proto/admin/index.php` — prototype admin page/editor UI. Handles login/session state, admin CSRF, loads `language.json`, displays token cards, supports token metadata edits, creates backups, writes language JSON, and shows language-map/raw JSON context.
- `proto/public/admin-language-save.php` — active inline public-page save endpoint used by logged-in admin sessions. It requires POST, logged-in session state, admin CSRF, token lookup, backup creation, JSON encoding, and write success.
- `proto/app/language.php` — runtime language loader and inline admin helper functions used by public routes and JS payloads.
- `proto/app/view.php` — calls `language_admin_maybe_start_session()`, renders public pages, and injects inline admin toolbar/payload only when `language_admin_is_logged_in()` returns true.
- `proto/public/assets/js/site.js` — public progressive-enhancement JS, including inline language editor behavior when admin payload is present.
- `proto/public/assets/css/site.css` — public/admin-visible inline editing styles such as `.jok-lang-token` and `.jok-lang-toolbar`.
- `proto/docs/language.json` — canonical editable runtime language inventory.
- `proto/docs/language_map.md` — human review map that must be synchronized after language edits.
- `proto/docs/language_backups/` — generated timestamped backups; skip archives during normal repo-wide validation/review unless backup behavior is the task.

### 3.2 Required admin docs

Read these before changing the admin editor:

1. `proto/README.md` — admin language editor is prototype tooling and must be secured or disabled before public deployment.
2. `proto/docs/developer_editor_guide.md` — admin editor behavior, security caution, backup verification, language-map sync, and admin testing matrix.
3. `proto/docs/website_inventory.md` — active files, language/copy sources, form/admin notes, launch-sensitive operational notes.
4. `proto/docs/website_ssot.md` — public facts and launch blocker truth affected by language edits.
5. `proto/docs/language.json` and `proto/docs/language_map.md` — editable data and human map.
6. `proto/docs/css_style_reference.md` if changing inline admin styles or public visual wrappers.
7. `boot_edit_public.md` if admin edits affect how public pages render, route helpers, language wrappers, CSS, or JS behavior.

---

## 4. Current admin/editor behavior to preserve

- Admin tooling edits `proto/docs/language.json`; it does not edit route PHP directly.
- Public routes use token wrappers such as `lang_editable()`, `lang_editable_lines()`, and `lang_editable_with_strong_prefix()`.
- Inline public-page editing only activates when the admin session is logged in.
- Save operations must require POST, admin login/session state, and CSRF validation.
- Save operations must create a timestamped backup under `proto/docs/language_backups/` before overwriting `language.json`.
- Writes must preserve valid JSON with `JSON_PRETTY_PRINT`, `JSON_UNESCAPED_SLASHES`, and `JSON_UNESCAPED_UNICODE` behavior unless intentionally changed.
- On language edits, document control/status must indicate that `language_map.md` may need regeneration or synchronization.
- Admin/editor changes can affect every public page; route smoke tests must include `/` and nested routes.
- The suite is prototype-only. Security, auth, permissions, write access, backup retention, audit trails, rollback, rate limiting, deployment exposure, and privacy/fact review remain launch-sensitive.

---

## 5. Editing rules by admin change type

### 5.1 Login/session/auth behavior

1. Read all session and CSRF functions in `proto/admin/index.php`, `proto/public/admin-language-save.php`, and `proto/app/language.php` before editing.
2. Do not weaken login, logout, session, CSRF, or token checks.
3. Do not hard-code production credentials into tracked files.
4. If adding configuration, keep deployability simple and document required environment/server settings.
5. If claiming security improvement, test unauthenticated rejection, bad-CSRF rejection, valid login/save path, logout behavior, and nested public-page inline behavior.

### 5.2 Language entry editing

1. Preserve the `entries` array schema in `proto/docs/language.json`.
2. Preserve token identity; avoid renaming tokens unless all route/app references and language map entries are updated.
3. Preserve editable fields unless intentionally migrating schema: `canonical_text`, `status`, `tone`, `text_role`, `component`, `reuse_policy`, `context_notes`, and review flags.
4. Truncate/limit text only deliberately and consistently with existing max-length behavior.
5. After language changes, validate JSON and update/regenerate `language_map.md`.

### 5.3 Backup/write behavior

1. Do not remove timestamped backup creation.
2. Preserve `LOCK_EX` write behavior unless replacing it with a better documented atomic write path.
3. Verify the language file is readable/writable before writes.
4. If backup paths change, update boot/admin docs, `.gitignore` assumptions, validation exclusions, and deployment notes.
5. Do not commit generated language backup archives unless explicitly requested.

### 5.4 Inline public-page editor behavior

1. Read `proto/app/view.php`, `proto/app/language.php`, `proto/public/admin-language-save.php`, `proto/public/assets/js/site.js`, and `proto/public/assets/css/site.css` together.
2. Keep public pages clean for non-admin visitors.
3. Keep inline editor payload minimal and escaped.
4. Preserve keyboard/focus accessibility and avoid blocking normal public-page navigation for non-admin users.
5. Test both root and nested public routes because relative URLs and endpoint paths can break only on nested pages.

### 5.5 Admin UI styling/JS

1. Preserve black/chrome/fire owner-facing visual system while keeping form controls readable.
2. Keep the admin UI usable without build tooling or package managers.
3. Do not introduce framework dependencies unless explicitly requested.
4. Use vanilla PHP/CSS/JS patterns matching the current app.
5. Avoid try/catch blocks around imports.

### 5.6 Public-copy guardrails inside admin edits

Even admin UI changes must keep public copy safe:

- No paid-admission implication for the show.
- No invented camping, parking, schedule, accessibility, safety, venue, traffic, response-time, media-rights, or official partnership claims.
- No weakening independent-tribute disclaimer language.
- Safety warnings must remain visible where conversion decisions happen and in shared footer/event-info contexts.
- Changes to verified facts require source verification and docs/language-map synchronization.

---

## 6. Admin-editor checks

Run the subset relevant to changed files.

### PHP syntax

```bash
php -l proto/admin/index.php
php -l proto/public/admin-language-save.php
find proto/app -name '*.php' -print0 | xargs -0 -n1 php -l
```

### Language JSON validity

```bash
python3 -m json.tool proto/docs/language.json >/tmp/jok-language.json
```

### Admin security/endpoint smoke checks

With the PHP server running:

```bash
php -S 127.0.0.1:8000 -t proto/public
curl -i http://127.0.0.1:8000/admin-language-save.php
curl -i -X POST http://127.0.0.1:8000/admin-language-save.php
curl -I http://127.0.0.1:8000/
curl -I http://127.0.0.1:8000/contact/
```

Expected endpoint posture without a logged-in session: non-POST requests and unauthenticated POSTs should be rejected with JSON error responses, not write language data.

### Backup and language-map checks

```bash
find proto/docs/language_backups -maxdepth 1 -type f | sort | tail
rg -n "Edited by admin|language_map.md may need regeneration|last_edited_via|public_inline_admin|admin_page" proto/docs/language.json proto/docs/language_map.md proto/admin proto/public/admin-language-save.php
```

### Diff review

```bash
git diff --check
git diff --stat
git diff -- proto/admin proto/public/admin-language-save.php proto/app proto/public/assets proto/docs/language.json proto/docs/language_map.md
```

---

## 7. Admin-editor boot completion report

Before editing admin/editor files, report:

1. **Admin docs/source studied** — files read and roles.
2. **Admin surface involved** — `proto/admin/index.php`, inline save endpoint, language helpers, public injection, JS/CSS, language JSON/map.
3. **Security/write risks** — auth/session, CSRF, backup, permissions, JSON validity, map sync, public exposure.
4. **Public-copy risks** — event facts, disclaimers, safety warnings, free/camping distinction.
5. **Planned smallest change** — exact files and why.
6. **Checks to run** — syntax, JSON, endpoint rejection, smoke routes, backup/map checks.

End with:

> I am booted for `proto/admin/`, current on the prototype admin language-editor truth, and ready to edit the administrative public-page-editor suite safely.
