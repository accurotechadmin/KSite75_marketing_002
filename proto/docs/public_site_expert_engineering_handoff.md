# Just One KISS `/proto/public` — Expert Engineering Handoff

**Status:** implementation-backed technical handoff  
**Prepared:** 2026-09-14  
**Scope:** the active public application in `proto/public/` and every material repository dependency it uses  
**Intended reader:** a fresh expert coding LLM or senior engineer who must safely understand, run, change, test, secure, or deploy the site

---

## 1. Read this first

The active website is a server-rendered, dependency-light vanilla PHP application for the Just One KISS event. The only correct public document root is:

```text
proto/public/
```

Do **not** serve `proto/` itself. Files directly under `proto/` such as `proto/index.php` and `proto/spectacle/index.php` are legacy copies. The active homepage is `proto/public/index.php`; active supporting routes are directory-index files beneath `proto/public/`.

The shortest accurate mental model is:

```text
hard-coded public PHP route templates
  + language.json canonical-text overrides
  + page_sections.json published insertions
  + Site Layer Controls output-buffer transformations
  + shared site.css and site.js
  = final browser response
```

This is not merely a static marketing site. It contains public forms, JSON persistence, optional database persistence, email handoff, three overlapping editing systems, and owner utilities capable of writing source/content files. Those operational tools are prototype-grade and must not be exposed without hardening.

At the time of this audit:

- PHP source passes syntax linting.
- All tested public and operational routes render without PHP warnings or fatals.
- `proto/docs/language.json` contains 526 unique runtime entries.
- `proto/docs/page_sections.json` contains zero managed section records; visible structure is therefore currently dominated by hard-coded templates.
- Draft and published Site Layer Controls state are effectively empty seeds.
- The repository working tree was clean before this document was added.
- The advertised event date, July 25, 2026, is in the past relative to this report. A new session must ask whether the site is now historical or should be migrated to a newly verified event before changing countdown/copy.

---

## 2. Authority and study order

When sources disagree, use this precedence:

1. Explicit current owner instruction.
2. Active code and active JSON read by that code.
3. `proto/docs/website_ssot.md` for product/content canon.
4. `proto/README.md` for deployment basics.
5. `proto/docs/website_inventory.md` and `routes_and_supporting_pages.md` for implementation maps.
6. Older image-planning, placeholder, and generated inventory documents.
7. Legacy route copies outside `proto/public/`.

Recommended first-read sequence:

1. `proto/README.md`
2. `proto/docs/website_ssot.md`
3. This document
4. `proto/app/view.php`
5. `proto/app/site_data.php`
6. `proto/app/language.php`
7. `proto/app/forms/lead_submit.php`
8. `proto/app/forms/inquiry_submit.php`
9. `proto/app/page_sections.php`
10. `proto/app/layer_runtime.php`
11. `proto/app/layer_controls.php`
12. Every active route template being changed
13. `proto/public/assets/css/site.css` and `assets/js/site.js`
14. `proto/docs/launch_checklist.md`

Documentation is not perfectly synchronized. For example, older inventory prose says supporting routes retain placeholders, while the newer SSOT and active templates show approved images. Prefer newer canon plus observed implementation and repair stale documentation when making related changes.

---

## 3. Repository map

```text
proto/
├── README.md
├── public/                         # ACTIVE web document root
│   ├── index.php                   # homepage
│   ├── july-25-2026/index.php
│   ├── what-is-just-one-kiss/index.php
│   ├── spectacle/index.php
│   ├── directions/index.php
│   ├── faq-disclaimer/index.php
│   ├── contact/index.php
│   ├── vault/index.php
│   ├── video/index.php
│   ├── technical/index.php
│   ├── contact-press/index.php     # permanent redirect
│   ├── preserve-backup/index.php   # owner utility; unsafe to expose
│   ├── site-layers/                # operations UI; unsafe to expose
│   ├── site-layer-save.php         # mutation endpoint; critical risk
│   ├── admin-language-save.php     # authenticated inline-copy endpoint
│   └── assets/
│       ├── css/site.css
│       ├── js/site.js
│       ├── font/{nasty,script}.otf
│       └── img/*
├── app/
│   ├── view.php                    # shared rendering and form HTML
│   ├── helpers.php                 # config, escaping, POST helpers
│   ├── csrf.php                    # public/session CSRF
│   ├── language.php                # tokenized copy runtime
│   ├── site_data.php               # route and approved-image registries
│   ├── page_sections.php           # managed insertion engine
│   ├── layer_runtime.php           # buffered HTML mutation runtime
│   ├── layer_controls.php          # discovery, state, direct-write operations
│   ├── layer_control_views.php     # operations UI render helpers
│   ├── form_storage.php            # monthly JSON append storage
│   ├── db.php                      # optional PDO
│   ├── mailer.php                  # PHP mail() integration
│   ├── config.php                  # current local config; contains hazards
│   ├── config.example.php          # fallback config
│   └── forms/{lead,inquiry}_submit.php
├── admin/index.php                 # language + section admin, outside docroot
├── editor/index.php                # older section editor, outside docroot
├── docs/
│   ├── language.json               # runtime canonical copy
│   ├── language_map.md
│   ├── page_sections.json          # managed block state
│   ├── site_layer_controls_state.json
│   ├── site_layer_controls_published.json
│   ├── site_layer_controls_snapshot.json
│   ├── preserve_backup_files.json
│   └── canon/inventory/guides/backups
├── storage/
│   ├── leads/YYYY-MM.json
│   ├── mail-failures/YYYY-MM.json
│   └── site-preserve-backups/      # ignored generated archives
└── database/{schema,seed}.sql
```

No Composer, npm, bundler, framework, router, templating library, or front-end dependency is required by the active public runtime. A server needs PHP, filesystem access, sessions, and optionally PDO/MySQL and a functional PHP mail transport.

---

## 4. Local and production runtime

From repository root:

```bash
php -S 127.0.0.1:8000 -t proto/public
```

Open `http://127.0.0.1:8000/`.

Directory-index routing provides friendly paths: `/spectacle/` resolves to `proto/public/spectacle/index.php`. There is no application router or rewrite requirement for normal directory URLs. A production web server should:

- Point its document root exactly to `proto/public/`.
- Prefer HTTPS and redirect HTTP to HTTPS.
- Deny hidden files, backup files, JSON diagnostics, and accidental source artifacts.
- Decide explicitly whether operational endpoints are omitted or protected.
- Ensure storage directories are outside the document root (they currently are).
- Give the PHP worker only the minimum required write permissions.
- Configure session cookies as `Secure`, `HttpOnly`, and appropriate `SameSite`.
- Set response security headers and asset caching.

PHP 8.x is the intended baseline. Code uses modern features such as `str_starts_with`, `str_contains`, union-era typing conventions, arrow functions, `never`, and strict types, so PHP 7 is not supported. The audit ran under PHP 8.5.7-dev; production compatibility should also be checked on the actual target PHP version.

---

## 5. Request and rendering lifecycle

### 5.1 Normal GET

```text
request
→ public route index.php
→ require app/view.php
→ view.php requires helpers, csrf, language, site_data, layer_runtime
→ route usually requires page_sections.php
→ route calls render_header()
→ route emits managed slots + hard-coded sections
→ route calls render_footer()
→ layer runtime flushes buffered, transformed HTML
→ response
```

`view.php` indirectly loads `layer_controls.php` through `layer_runtime.php` for ordinary public requests. Thus a large file-writing/control subsystem is coupled to public rendering even when no editor is in use.

### 5.2 Output buffer

`jok_layer_runtime_start()` installs `ob_start('jok_layer_runtime_apply')`. At footer completion, `jok_layer_runtime_finish()` flushes the buffer. The callback identifies the current route, discovers route metadata, loads draft layer state, and mutates rendered HTML.

This means final HTML is not necessarily identical to template output. Debugging a surprising class, hidden section, image, style attribute, or overlay must inspect both the template and Site Layer Controls state.

### 5.3 Public POST

Public forms post back to the same route. Route controllers inspect `form_type`, include the appropriate handler, collect an array result, and display it through `render_notice()`.

There is no POST/Redirect/GET for these forms. Browser refresh can prompt resubmission. Validation failures do not repopulate submitted fields. Both are worthwhile usability improvements.

---

## 6. URL and asset helpers

`proto/app/view.php` supplies the URL model:

- `public_depth()` infers nesting from `SCRIPT_NAME`.
- `rel_url()` prefixes `../` according to route depth.
- `page_url('/')` targets root `index.php`.
- `page_url('/route/')` targets a directory URL.
- `asset_base_url()` targets `assets/img/` safely at any depth.
- `asset_style()` validates an approved image and writes `--asset-image`.

Do not replace these with root-relative URLs unless the deployment contract is intentionally changed. Relative URLs are what permit deployment in a subdirectory.

The shared renderer includes both an external CSS/JS reference and a full inline fallback. `render_inline_asset()` rewrites relative font/image URLs when inlining. This makes the site resilient to static-asset routing errors, but has important costs:

- Every response includes roughly 60 KB of CSS and 8 KB of JS before compression.
- Browsers also request the external copies.
- CSS is applied twice.
- The JavaScript IIFE can execute twice and register duplicate event handlers.
- Strict CSP deployment becomes harder because inline style/script is required unless hashes/nonces are added.

Production should choose one deliberate strategy: external versioned assets, or truly conditional inline fallback. At minimum, make JS initialization idempotent.

---

## 7. Public route inventory

| URL | File | Primary nav | Job |
| --- | --- | --- | --- |
| `/` | `public/index.php` | brand/home only | Hero, event facts, proof, update form, final CTA, six-card Fan Vault |
| `/july-25-2026/` | `public/july-25-2026/index.php` | yes | Full event facts, admission/camping distinction, safety, signup |
| `/what-is-just-one-kiss/` | `public/what-is-just-one-kiss/index.php` | yes | Tribute concept, fan ritual, independent status |
| `/spectacle/` | `public/spectacle/index.php` | yes | Public-facing show capability and venue appeal |
| `/directions/` | `public/directions/index.php` | yes | Address, phone, outbound and embedded Google Maps, arrival |
| `/faq-disclaimer/` | `public/faq-disclaimer/index.php` | yes | FAQ, safety, access, practical and legal notes |
| `/contact/` | `public/contact/index.php` | yes | Direct contacts, lead form, inquiry form |
| `/vault/` | `public/vault/index.php` | no | Approved original/fan media hub |
| `/video/` | `public/video/index.php` | no | Trailer/clip slots and sharing guidance |
| `/technical/` | `public/technical/index.php` | no | Public location-facing technical overview |
| `/contact-press/` | `public/contact-press/index.php` | no | 301 redirect to `../contact/` |
| `/site-layers/*` | several files | no | Operational controls, not public marketing content |
| `/preserve-backup/` | `public/preserve-backup/index.php` | no | Backup/restore utility, not public marketing content |

`site_pages()` in `app/site_data.php` is the navigation and route-metadata registry. Adding a route requires updating the physical file, this registry, managed-section route inventory, language dependencies, Site Layer Controls discovery, docs, and tests.

### Homepage order

1. Hero: `trailer-poster-stage-portal.webp`
2. Event details: `spectacle-lighting-rig.webp`
3. About/proof: `costume-chrome-detail.webp`
4. Update form: `gear-control-dossier.webp`
5. Final CTA: `fog-strobe-atmosphere.webp`
6. Fan Vault: `road-case-vault-bg.webp`
7. Shared event information and footer

The homepage contains both new route-wide managed slots and old `home` aliases. Preserve both unless migrating existing section records intentionally.

### External integrations

The site is almost entirely local. Notable external browser integrations are:

- Google Maps outbound URL.
- Google Maps iframe on `/directions/`.
- `mailto:` links.
- `tel:` link.
- A tokenized Facebook/social URL.

There is no external analytics SDK, tag manager, CDN, webfont provider, or JavaScript library in the active public runtime.

---

## 8. Shared presentation components

`render_header()` emits document metadata, skip link, brand mark, responsive navigation, global update CTA, external stylesheet, and inline stylesheet fallback.

`render_footer()` optionally emits `render_event_information()`, then the site footer, fixed mobile CTA, inline language toolbar for logged-in admins, JavaScript language payload, external JS, inline JS fallback, and buffer finalization.

The shared event-information block covers:

1. Admission.
2. Location and parking.
3. Camping.
4. Fog/strobes.
5. Independent tribute status.

Do not assume every route includes this block. Some supporting pages call `render_footer(false, ...)` and provide a shorter custom footer, despite older docs saying the grid appears everywhere.

Accessibility-positive patterns already present include semantic headings, labelled sections, a skip link, native form controls, explicit labels, map iframe title, button/link distinction, mobile navigation ARIA state, and reduced-motion rules. Areas still needing formal review include color contrast over variable imagery, focus order in editors, screen-reader behavior of notices, alt-text quality, and automated axe/WCAG checks.

---

## 9. Language/copy subsystem

Default file:

```text
proto/docs/language.json
```

Override:

```text
JOK_LANGUAGE_FILE=/absolute/path/to/language.json
```

The loader caches by file path for the request. Missing, unreadable, blank, invalid, or wrongly shaped JSON yields an empty token map, after which route fallbacks appear. That is a useful resilience characteristic.

Each entry can carry canonical text, source scope, component, text role, tone, reuse policy, occurrences, route/form/database dependencies, review flags, and canonical hash relationships. Runtime collapses this to token → canonical text.

Use helpers correctly:

- `lang_text()` returns unescaped text; escape it when placing it into HTML.
- `lang_editable()` returns safely escaped visible text or an admin wrapper.
- `lang_editable_lines()` preserves line breaks safely.
- `lang_editable_with_strong_prefix()` supports a controlled bold prefix.
- `lang_json_for_js()` safely JSON-encodes selected JS strings.

When editing copy, synchronize both `language.json` and PHP fallback strings. Updating only the fallback appears ineffective whenever a token exists. Updating only JSON leaves stale emergency fallback text.

### Inline language administration

`proto/admin/index.php` establishes `$_SESSION['jok_admin_logged_in']`. Once present, public `lang_editable*()` calls render token-bearing spans and `site.js` displays a floating editing toolbar. Saves go to `public/admin-language-save.php`, which checks login and CSRF, backs up the language file, and then rewrites it.

The endpoint can auto-register an unknown active token using `language_default_entry()`. Backups go beneath `proto/docs/language_backups/`.

Concurrency caveat: language writes use file locks during writes but perform read-modify-write as separate operations, so two editors can still overwrite one another's changes. There is no revision/ETag conflict check.

---

## 10. Managed page sections

Default file:

```text
proto/docs/page_sections.json
```

Override:

```text
JOK_PAGE_SECTIONS_FILE=/absolute/path/to/page_sections.json
```

Supported types: `text`, `image`, `text_image`, `callout`, `cta`.  
Supported status values: `draft`, `published`, `archived`.  
Supported styles: `fit`, `plain`, `chrome_panel`, `fire_panel`, `vault_case`, `safety_strip`.  
Supported alignments: `fit`, `left`, `center`, `right`.  
Supported width modes: `fit`, `full`, `wide`, `narrow`, `custom`.

Public requests render only records whose route and slot match and whose status is `published`; archived items remain excluded. Records sort by `sort_order`. Image filenames are limited through `image_inventory()`.

The current document has zero records. The editor machinery is active but contributes no current visible section content.

There are two management UIs outside the public docroot:

- `proto/admin/index.php`: combined language and section administration.
- `proto/editor/index.php`: older/standalone section editor.

Both use the same session flag and hard-coded credentials. They create timestamped JSON backups before writes. The backup directory is ignored by Git.

---

## 11. Site Layer Controls

This is separate from managed page sections. Its six conceptual layers are structure, copy, media, style, behavior, and review.

It can:

- Discover routes and hard-coded `<section>` elements.
- Add route/section handles to output.
- Apply alignment, headline, placement, and animation classes.
- Apply image focus, crop, zoom, removal, and replacement metadata.
- Hide sections.
- Record/reapply ordering metadata.
- Add decorative corner-overlay images.
- Edit language tokens.
- Upload images.
- Patch image handles directly in PHP templates.
- Append arbitrary operator CSS directly to `site.css`.
- Append template notes and create constrained custom files.
- Save draft state and copy it to a published state file.

### State files

- Draft: `docs/site_layer_controls_state.json`
- Published: `docs/site_layer_controls_published.json`
- Descriptive snapshot: `docs/site_layer_controls_snapshot.json`
- Backups: `docs/site_layer_control_backups/`
- Custom writes: `docs/site_layer_writes/`

Important implementation fact: the public runtime currently reads `jok_layer_state()`, whose default path is the **draft** `site_layer_controls_state.json`. Publishing copies state to a published file, but the public runtime does not appear to switch to that published file. Therefore "publish" is not a true public promotion boundary in the current design; draft state is already the runtime source. Confirm and redesign this before treating it as a CMS workflow.

### HTML transformation fragility

Runtime transformation uses regex and section sequence. Risks include:

- Adding a nested or new `<section>` can shift handle association.
- Formatting/attribute variations can defeat regex assumptions.
- Global asset filename replacement can affect unintended occurrences.
- Reordering expressed as a CSS variable only works where CSS/layout consumes it.
- Hidden sections remain in source/output and are only marked hidden.
- Runtime mutations can obscure the true origin of output during debugging.

Prefer explicit stable IDs/handles in templates and structured rendering over regex HTML rewriting in future refactors.

### Critical access-control defect

`public/site-layer-save.php` accepts POST and forwards `$_POST`/`$_FILES` directly to mutation logic without checking authentication or CSRF. It can reach direct file writes. This is a critical production blocker.

The Site Layer Controls UI itself also lacks a central authenticated guard. Removing navigation links is not protection. Remove the suite from public deployment, move it outside the document root, or enforce robust server-side authentication/authorization and CSRF on every operation.

### Upload validation defect

Uploads are checked by filename extension but not robustly by decoded image type, MIME, dimensions, file size, or decompression limits. Add server-side content inspection/re-encoding and size/pixel caps before allowing uploads.

---

## 12. Admin and owner utilities

### Hard-coded credentials

Both `proto/admin/index.php` and `proto/editor/index.php` contain the literal credentials `admin1` / `adminpw`. They share `$_SESSION['jok_admin_logged_in']` and `jok_admin_csrf`.

This is unacceptable for deployment. Replace it with password hashing and secrets outside Git, ideally a proper identity/authorization boundary. Also add login rate limiting, audit logs, secure session configuration, expiration, and role checks.

Because these directories are siblings of `public/`, they are not reachable when the document root is correctly configured. They become exposed if a host mistakenly serves `proto/` or the repository root—another reason document-root configuration is security-critical.

### Preserve Backup

`public/preserve-backup/index.php` is inside the active document root. It supports selecting, archiving, downloading, and restoring files under allowed prefixes including `proto/app`, `proto/docs`, `proto/public/assets`, and `proto/storage`. It uses public-form CSRF but has no authentication check.

CSRF is not authorization: any visitor can obtain their own session token and invoke the utility. Move this tool outside the document root or protect it with strong authorization. Backups may contain personal data and configuration, so generated archives must never be publicly enumerable.

The root `.gitignore` excludes generated preserve archives and managed-section backups, but it does not make them safe from HTTP exposure or filesystem compromise.

---

## 13. Public forms

### Shared security baseline

Both forms use strict server-side validation, a PHP-session CSRF token, honeypot field, input length caps, email validation, whitelisted array/category values, and required consent. Form HTML uses `novalidate`, so server validation is authoritative and JS is progressive enhancement only.

CSRF tokens are 32 random bytes encoded as hex and checked with `hash_equals()`.

### Lead/update form

Renderer: `render_lead_form($csrf)` in `app/view.php`  
Handler: `app/forms/lead_submit.php`  
Rendered on: homepage, `/july-25-2026/`, `/contact/`

Inputs include email, optional name, city/ZIP, interest tags, consent, honeypot, CSRF, and form type. Server validation requires email, consent, and at least one approved tag.

Success sequence:

1. Construct random-ID consent record.
2. Append it to `storage/leads/YYYY-MM.json`.
3. Optionally insert it into MySQL/MariaDB.
4. Attempt owner notification.
5. Attempt visitor confirmation.
6. Optionally record a form event in DB.
7. Return a success or stored-but-mail-failed notice.

JSON storage is the primary durable layer and must be writable. A mail failure does not undo the stored lead.

### Inquiry form

Renderer: `render_inquiry_form($csrf)`  
Handler: `app/forms/inquiry_submit.php`  
Rendered on: `/contact/`

It validates contact data, organization/location, category, message length, consent, honeypot, and CSRF. It persists and notifies only when PDO is available. With DB disabled it returns a locally validated fallback message but does not durably save the inquiry or send it.

This is a high-priority correctness risk: the UI can look successful while losing the inquiry. Implement JSON fallback plus mail, require DB, or disable the inquiry form until persistence is real.

### Missing controls

- No rate limiting or request quotas.
- No duplicate/idempotency protection.
- No CAPTCHA or proof-of-work.
- No POST/Redirect/GET.
- No field repopulation after validation failure.
- No verified opt-in/double opt-in.
- No unsubscribe workflow visible in this code.
- No retention/deletion interface.
- No explicit IP capture, but referrer and user agent are stored.

Use server/WAF throttling before promotion and decide a privacy-compliant mailing-list lifecycle.

---

## 14. JSON storage mechanics

`jok_store_json_record()` writes monthly JSON arrays. It sanitizes the collection name, creates a `0775` directory if necessary, opens the monthly file using `c+`, takes an exclusive `flock`, decodes the full array, appends, truncates, rewrites, flushes, and unlocks.

Strengths:

- Storage is outside the public document root.
- Concurrent writers are serialized under ordinary local filesystems.
- Invalid existing JSON causes a safe error rather than destructive overwrite.
- Monthly partitioning limits individual file growth.

Limitations:

- Every append rewrites the full month.
- No atomic temp-file-and-rename transaction.
- Network filesystems can have surprising lock semantics.
- No encryption at rest.
- No formal retention, deletion, export, or backup policy.
- Sample/runtime PII-bearing files exist in the repository and should be audited.

Do not commit real production lead or mail-failure records.

---

## 15. Optional database

`jok_pdo()` reads `config.php`, connects only when `database.enabled === true`, caches one attempt per request, and returns `null` on any failure. The catch suppresses operational detail, so production should log sanitized connection errors.

Schema tables:

- `site_leads`
- `site_inquiries`
- `site_interest_tags`
- `site_form_events`

Before enabling DB, verify the SQL import on the exact MySQL/MariaDB version, PDO driver availability, database character set, permissions, backups, migrations, and failure alerts.

Vocabulary drift exists:

- Lead handler allows `contact_info`, but seed data does not define it.
- Seed data defines `technical`, but the lead handler does not allow it.
- Inquiry UI/handler categories and the SQL ENUM are not identical sets.
- The handler maps `technical` inquiries to `general` specifically to fit the current schema.

Treat form option, whitelist, seed, and ENUM changes as one migration.

---

## 16. Mail delivery

The active mailer uses PHP `mail()`, not SMTP/PHPMailer. Only `app.notification_email` and `app.mail_from` are read. The `mail` configuration block in `config.php` is currently inert.

Failed handoffs are:

- Written to PHP `error_log()`.
- Appended to `storage/mail-failures/YYYY-MM.json`.
- Returned as an error-style form notice.
- Reflected into browser-console diagnostics by public JS.

`mail()` returning true means the local transport accepted the message, not that a mailbox received it.

Configuration hazards:

- `config.php` is tracked even though docs say secret-bearing config should not be committed.
- Its SMTP password expression uses a password-looking literal as the argument to `getenv()`, i.e. as the environment variable **name**.
- SMTP settings are not used by the mailer.
- Example and active notification addresses differ.

Production work:

1. Choose PHP MTA or authenticated SMTP deliberately.
2. Use conventional environment variable names.
3. Remove secrets from Git and rotate anything ever exposed.
4. Configure SPF/DKIM/DMARC.
5. Test owner and visitor delivery end-to-end.
6. Add bounce/suppression/unsubscribe handling if this becomes a real mailing list.

---

## 17. CSS and visual system

Single source: `public/assets/css/site.css`; no preprocessing/build.

Design vocabulary:

- Black/dark stage base.
- Bone and chrome foregrounds.
- Red/orange/yellow fire accents.
- Purple vault accent.
- Local display/script faces.
- Glows, bordered dark panels, poster-scale headings.
- Background art driven through `--asset-image` and related crop/focus variables.
- Responsive card/grid collapse.
- Sticky header and fixed mobile CTA.

The stylesheet also contains all admin/layer-control presentation. Public and operational styles are coupled in a single payload.

Multiple generations of media queries overlap around 1180, 1100, 980, 760, 700, and 640 pixels. Refactor only with route screenshot regression coverage. New motion must honor `prefers-reduced-motion`.

Formal visual QA should cover:

- 320, 375, 390, 768, 980, 1180, 1440+ widths.
- Long language-token substitutions.
- Keyboard focus and mobile nav.
- Text contrast over every background crop.
- Six-card vault wrapping.
- Form consent alignment.
- Map iframe sizing.
- Reduced motion.
- High zoom and large default fonts.

---

## 18. JavaScript

Single public source: `public/assets/js/site.js`; dependency-free IIFE.

Responsibilities:

- Responsive nav toggle and ARIA state.
- In-memory event tracking through `window.siteEvents`.
- `[data-track]` CTA click records.
- Countdown updates.
- Select-all/indeterminate checkbox behavior.
- Form focus/submit status enhancements.
- Form-notice logging.
- Inline admin language editor.
- Relic-card pointer state.

Tracking does not leave the browser; it is debugging instrumentation, not durable analytics.

Because the script is both external and inlined, audit duplicate initialization. Use a global initialization guard if dual delivery remains.

Countdown logic and every July 25 CTA require product review now that the event date has passed. Never invent a new date; obtain verified owner instruction.

---

## 19. Images and media

The hard-coded approved allowlist in `image_inventory()` contains nine WebP assets:

- `costume-chrome-detail.webp`
- `fog-strobe-atmosphere.webp`
- `gear-control-dossier.webp`
- `hero-stage-portal.webp`
- `interlochen-dispatch-map.webp`
- `press-performer-portrait.webp`
- `road-case-vault-bg.webp`
- `spectacle-lighting-rig.webp`
- `trailer-poster-stage-portal.webp`

Physical files also include several `layer-upload-*.png` images. Site Layer Controls state can know about uploaded assets even though the static allowlist does not. This creates two approval models that should be unified.

Rights/content guardrails:

- Use original, rights-safe, intentionally approved assets.
- Do not add official recordings, album art, outside logos, exact restricted makeup, protected media, or restricted fonts without approval.
- Do not imply official affiliation.
- Maintain useful alt text for semantic images; decorative overlays should remain empty-alt/hidden from assistive technology.

Performance opportunities:

- Existing images are often 1–4 MB.
- Generate responsive variants and `srcset`.
- Re-encode large PNG uploads to optimized WebP/AVIF where appropriate.
- Add intrinsic dimensions to prevent layout shifts.
- Lazy-load below-fold content.
- Preload only the LCP hero.
- Add versioned immutable caching.

---

## 20. Public facts and non-negotiable guardrails

Do not change these without newer verified owner/venue information:

- Event date: July 25, 2026.
- Show admission: free; no ticket required.
- RSVP/update-list: appreciated, not required.
- Venue: Cycle Moore Legacy.
- Address: 11075 US 31 South, Interlochen, MI 49643.
- Public venue/event phone currently shown: 231-276-9091.
- Camping: $10 per night per person, one night before and one night after.
- Electric hookup: $35 per person.
- Parking: outside the gate; overflow and handicap parking available.
- Safety: loud sound, bright lights, fog, and flashing/strobe-style patterns may be used.
- Status: independent theatrical tribute; no affiliation, sponsorship, authorization, endorsement, ownership, or approval is claimed.

Keep safety and independent-status language near conversion points and in shared/footer content. Do not let editable CMS operations silently erase verified facts or required warnings.

---

## 21. Security priority list

### Critical — block launch

1. Unauthenticated, non-CSRF `site-layer-save.php` can invoke file mutations.
2. Unauthenticated `preserve-backup` can archive/download/restore sensitive files using only self-obtainable CSRF.
3. Hard-coded admin/editor credentials are checked in plaintext.

### High

4. Inquiry submissions are lost under the default DB-disabled configuration.
5. Privacy/retention/deletion policy for stored PII is undefined.
6. Upload content validation is extension-based and incomplete.
7. Public runtime unnecessarily loads the control/file-writing layer.
8. Configuration/secret handling is inconsistent and `config.php` is tracked.

### Medium

9. No rate limiting or abuse controls.
10. Database connection failures are silently suppressed.
11. Regex output transformation is structurally brittle.
12. Read-modify-write JSON workflows lack revision-conflict protection.
13. Duplicate inline/external JS can double-bind listeners.
14. No application-level security-header configuration is evident.
15. No automated accessibility/browser regression suite targets this app.

Recommended headers: Content-Security-Policy, `X-Content-Type-Options: nosniff`, Referrer-Policy, Permissions-Policy, `frame-ancestors`, and HSTS over HTTPS. CSP must account for or eliminate current inline CSS/JS and the Google Maps iframe.

---

## 22. Safe change recipes

### Change copy

1. Find the token use in PHP.
2. Change canonical text in `docs/language.json`.
3. Synchronize the PHP fallback.
4. Preserve escaping helper choice.
5. Update language map/inventory if required.
6. Revalidate facts, safety, and rights posture.
7. Render every route using that token.

### Add a route

1. Create `public/<slug>/index.php` using a current supporting route as a pattern.
2. Require `view.php` and `page_sections.php`.
3. Add managed insertion slots.
4. Use URL and asset helpers.
5. Register it in `site_pages()`.
6. Add language tokens and docs.
7. Verify Site Layer Controls discovery.
8. Test nested assets, nav, footer, mobile, and direct URL.

### Add an image

1. Confirm rights and public approval.
2. Optimize it.
3. Place it in `public/assets/img/`.
4. Add it to the approved registry or deliberately unify the upload registry.
5. Add alt-language tokens.
6. Use `asset_style()` for decorative backgrounds or `render_page_image()` for semantic images.
7. Review crops and contrast across breakpoints.

### Change a form

Update as one unit: renderer, handler validation, JSON record, DB schema, seed vocabulary, mail payloads, consent/privacy copy, JS hooks, docs, and integration tests.

### Change route section markup

After adding/reordering any `<section>`, inspect Site Layer Controls discovery/handles and rendered data attributes. Nested sections are especially risky. Test current state application even if state files appear empty, because production state may differ.

---

## 23. Recommended architectural evolution

1. Separate public render code from all write-capable administration code.
2. Move owner/admin tools outside the document root.
3. Introduce one centralized authentication/authorization service.
4. Require authorization and CSRF for every mutation.
5. Replace hard-coded credentials with password hashes/secrets or external identity.
6. Make published state—not draft state—the explicit public runtime source.
7. Replace regex output rewriting with stable template-level section handles.
8. Converge managed sections and Site Layer Controls into one versioned content model.
9. Add atomic/revision-aware JSON persistence or move content state to a transactional store.
10. Implement durable inquiry storage.
11. Implement a real mail transport abstraction and delivery observability.
12. Externalize config, rotate secrets, and keep environment-specific files untracked.
13. Stop unconditional duplicate inline/external asset delivery.
14. Split public CSS from operations CSS.
15. Add route/form/security/accessibility/browser regression tests.

---

## 24. Verification playbook

### Syntax and structured files

```bash
find proto -name '*.php' -print0 | xargs -0 -n1 php -l
python3 -m json.tool proto/docs/language.json >/dev/null
python3 -m json.tool proto/docs/page_sections.json >/dev/null
python3 -m json.tool proto/docs/site_layer_controls_state.json >/dev/null
python3 -m json.tool proto/docs/site_layer_controls_published.json >/dev/null
php -r '$css=file_get_contents("proto/public/assets/css/site.css"); exit(substr_count($css,"{")===substr_count($css,"}")?0:1);'
```

### Manual route smoke

```bash
php -S 127.0.0.1:8000 -t proto/public
```

Then check at least:

```text
/
/july-25-2026/
/what-is-just-one-kiss/
/spectacle/
/directions/
/faq-disclaimer/
/contact/
/vault/
/video/
/technical/
/contact-press/
```

Also verify operational routes are **unreachable** in production, rather than merely functional.

### Form matrix

- GET form and capture session cookie + CSRF.
- Submit missing/invalid email.
- Submit honeypot.
- Submit without consent.
- Submit without required tags/message.
- Submit valid lead with writable JSON and DB disabled.
- Simulate unwritable lead storage.
- Simulate mail failure after successful storage.
- Submit inquiry with DB disabled and confirm desired durable behavior.
- Submit both forms with DB enabled against imported schema.
- Test duplicate and rapid submissions.

Never run valid-form tests against production addresses/storage without explicit approval.

### Visual/accessibility matrix

- Desktop and mobile screenshots of every perceptible change.
- Keyboard-only nav and forms.
- 200%/400% zoom.
- Reduced motion.
- Long token text.
- Automated HTML/accessibility scan.
- Contrast over all image crops.
- No-JS behavior.
- Failed-static-asset behavior if inline fallback remains a supported contract.

### Existing generic script caveat

The repository-root `scripts/smoke_public_routes.py` belongs to a broader website-pipeline contract and expects inventory files under the supplied root. Passing `--root proto/public` currently makes it search for `proto/public/docs/website_pipeline/public_site_inventory.json`, which is not part of this app. Use manual HTTP smoke or add a dedicated `/proto` integration suite rather than interpreting that mismatch as an application failure.

---

## 25. Definition of done for future work

A `/proto/public` change is not complete until:

- The correct active files—not legacy copies—were edited.
- Relevant canonical docs and fallback/token text agree.
- PHP lint passes.
- All changed JSON parses.
- Affected routes return expected status and content.
- Nested relative assets and links work.
- Form behavior is tested if touched.
- Desktop/mobile and reduced-motion behavior are reviewed for visual changes.
- Layer Runtime handles still map to intended sections.
- Safety, venue, price, and independent-status facts remain accurate.
- No PII, credentials, backups, or runtime diagnostics were committed.
- Security impact of any admin/write surface change was explicitly reviewed.
- Changes are committed on the current branch and PR metadata is prepared.

---

## 26. Immediate questions for the owner before substantive development

1. Is July 25, 2026 now historical, or is there a newly verified event date?
2. Should public update-list capture remain active after that event?
3. Which administrative tools, if any, must exist in production?
4. What authentication provider or hosting-level protection is available?
5. Should Site Layer Controls be retained, replaced, or removed?
6. Is MySQL/MariaDB intended for production, or should all forms use durable JSON/another service?
7. What real mail transport and sender domain are approved?
8. What privacy, retention, deletion, unsubscribe, and backup policies apply?
9. Which uploaded `layer-upload-*` images are actually approved?
10. Is subdirectory deployment still a requirement?

Until answered, preserve existing verified facts, avoid inventing event details, and treat every write-capable operational surface as non-public.

---

## 27. Readiness statement

After reading the authority documents and active implementation named above, an expert session should be able to explain the route registry, relative-URL system, shared renderer, language-token overrides, managed insertions, output-buffer layer mutations, asset allowlists, both form workflows, JSON/DB/mail persistence, public design system, and launch risks before changing code.

**I am ready to answer questions and work on the `/proto` codebase.**
