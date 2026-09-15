# Just One KISS — Public Website Inventory

Classification: `GEN`
Status: Current operational inventory for `proto/`
Maturity level: 3 — Implementation-backed working inventory
Last updated: 2026-07-13

## Purpose

This document inventories the active public website under `proto/`: the app structure, public routes, shared PHP components, forms, data/configuration files, language/copy sources, media assets, styles, scripts, database files, and launch-sensitive operational notes.

Use this document with:

- `proto/README.md` for deployment basics.
- `proto/docs/website_ssot.md` for current public facts and canon decisions.
- `proto/docs/routes_and_supporting_pages.md` for route jobs/status.
- `proto/docs/language_map.md` and `proto/docs/language.json` for copy inventory.
- `proto/docs/image_generation_inventory.md`, `proto/docs/image_generation_requests.txt`, and `proto/docs/asset_placeholders.md` for media planning.
- `proto/docs/launch_checklist.md` for pre-launch verification.

## Active app inventory

| Item | Path | Role / notes |
| --- | --- | --- |
| Active app root | `proto/` | Standalone public-facing vanilla PHP website for the Just One KISS July 25, 2026 public event site. |
| Public document root | `proto/public/` | Serve this directory directly in production/local development. |
| Active homepage | `proto/public/index.php` | Landing page with hero, event details, show proof, update form, final CTA, Fan Vault, shared event footer. |
| Shared application code | `proto/app/` | PHP helpers, rendering, language loader, forms, JSON lead storage, optional DB access, CSRF, mail helpers, site data. |
| Public assets | `proto/public/assets/` | CSS, JS, image assets, and local font assets. |
| Documentation | `proto/docs/` | Canon, inventories, language maps, launch checklist, image-generation planning, boot prompts. |
| Optional database files | `proto/database/` | MySQL/MariaDB schema and seed data for optional form persistence. |
| Legacy route copies | `proto/*.php`, `proto/*/index.php` | Historical/top-level copies. They are not the active deployment root; prefer `proto/public/`. |

## Public route inventory

| Route | Active file | Navigation? | Public job |
| --- | --- | --- | --- |
| `/` | `proto/public/index.php` | Home is presentation link only | Primary landing page: free show hero, event details, proof cards, update-list lead capture, final CTA, Fan Vault. |
| `/july-25-2026/` | `proto/public/july-25-2026/index.php` | Yes | Free show detail page: admission, date, camping distinction, parking, safety, update-list conversion. |
| `/what-is-just-one-kiss/` | `proto/public/what-is-just-one-kiss/index.php` | Yes | “The Ritual” page explaining the independent theatrical tribute, approved live-production baseline, fan-love framing. |
| `/spectacle/` | `proto/public/spectacle/index.php` | Yes | Capability page: lighting, projection, fog/strobe-style looks, cue discipline, travel-minded show package, venue appeal. |
| `/directions/` | `proto/public/directions/index.php` | Yes | Arrival page: Cycle Moore Legacy address/phone, map, parking, camping, access-routing notes. |
| `/faq-disclaimer/` | `proto/public/faq-disclaimer/index.php` | Yes | FAQ, safety, accessibility, public-ready independent tribute disclaimer, practical fan questions. |
| `/contact/` | `proto/public/contact/index.php` | Yes | Contact route with update form, inquiry form, placeholder editable email/Facebook, public phone/location routing. |
| `/vault/` | `proto/public/vault/index.php` | No | Fan Vault/gallery route for approved original media, fan media guidance, media slot labels. |
| `/video/` | `proto/public/video/index.php` | No | Trailer/clips route for approved original media and fan-sharing instructions. |
| `/technical/` | `proto/public/technical/index.php` | No | Location-facing technical overview: QLC+/DMX, projection, fog/strobes, emergency states. |
| `/contact-press/` | `proto/public/contact-press/index.php` | No | Retired legacy route; redirects to `/contact/`. |

## Homepage section inventory

| Section | File / selector | Background asset | Components / behavior |
| --- | --- | --- | --- |
| Hero | `proto/public/index.php`, `#top.hero` | `trailer-poster-stage-portal.webp` | Headline, live countdown, fact pills, update CTA, directions CTA, content disclaimer, poster callout. |
| Event details | `#event.date-card` | `spectacle-lighting-rig.webp` | Free admission, camping price distinction, venue/address/phone, event-ticket panel, safety strip. |
| About the show | `.proof-section.section-with-bg--armor` | `costume-chrome-detail.webp` | Four proof cards: entrance, singalong, controlled blast, chrome-blood spectacle. |
| Join the rally | `#updates.form-section` | `gear-control-dossier.webp` | Update-list copy, safety/parking callout, shared lead form. |
| Final CTA | `.final-cta.section-with-bg--fog` | `fog-strobe-atmosphere.webp` | Repeats date/free show/location facts and routes to updates/contact. |
| Fan Vault | `.vault-section.section-with-bg--vault` | `road-case-vault-bg.webp` | Six-card road-case navigation hub: Free Show, Video Posts, Fan Media, Tips, Q&A, Chat. |
| Shared event footer | `render_event_information()` | CSS gradient panel | Bottom card grid on every public page: admission, location/parking, camping, fog/strobes, independent tribute. |

## Shared PHP component inventory

| File | Responsibility |
| --- | --- |
| `proto/app/view.php` | Shared renderer: URL depth helpers, relative/page URL helpers, public asset helpers, inline CSS/JS fallback, media grid, image placeholder, header, notice, shared event information, footer, lead form, inquiry form, and the site-layer runtime buffer hook. |
| `proto/app/layer_runtime.php` | Applies saved Site Layer Controls state to active public routes at render time by injecting section handles, visual-control classes, saved ordering variables, and hide/show attributes into discovered public sections. |
| `proto/app/site_data.php` | Route registry for navigation and route summaries; approved image filename inventory. |
| `proto/app/page_sections.php` | Schema-driven managed section loader/renderer for approved public-page insertion slots; renders published blocks and admin-only plus/edit rails. |
| `proto/app/language.php` | Runtime language-token loader; token lookup; editable token wrappers; inline language-admin payload; JSON payloads for JS copy. |
| `proto/app/helpers.php` | Config loading, HTML escaping, POST string/tag helpers, email validation, current path, site source, local DB-disabled fallback messaging. |
| `proto/app/csrf.php` | CSRF token generation and verification for public/admin forms. |
| `proto/app/db.php` | Optional PDO connection and form-event storage. Returns `null` when DB is disabled/unavailable. |
| `proto/app/mailer.php` | PHP mail helpers for update-list owner notifications and visitor confirmation emails after JSON storage succeeds; failed PHP mail handoffs are written to `error_log()` and recorded as runtime JSON diagnostics. |
| `proto/app/forms/lead_submit.php` | Lead/update-list server-side validation, JSON storage, owner notification, visitor confirmation email, and optional DB mirroring. |
| `proto/app/forms/inquiry_submit.php` | Inquiry/contact server-side validation and optional DB persistence. |
| `proto/app/config.example.php` | Safe default configuration used when `proto/app/config.php` is absent. |
| `proto/app/config.php` | Optional local/production config; should not be committed if it contains secrets. |

## Form inventory

| Form | Render helper | Handler | Fields | Storage behavior |
| --- | --- | --- | --- | --- |
| Lead/update form | `render_lead_form($csrf)` | `handle_lead_submit()` in `proto/app/forms/lead_submit.php` | `form_type`, `csrf_token`, honeypot `website`, `email`, `city_zip`, `interest_tags[]`, required `consent` | Validates server-side, writes `proto/storage/leads/YYYY-MM.json`, attempts owner notification and visitor confirmation through PHP mail, returns/logs an error-style notice if mail handoff fails, and optionally mirrors into `site_leads` when DB is enabled. |
| Inquiry/contact form | `render_inquiry_form($csrf)` | `handle_inquiry_submit()` in `proto/app/forms/inquiry_submit.php` | `form_type`, `csrf_token`, honeypot `website`, `inquiry_email`, `inquiry_name`, `organization`, `facebook_contact`, `event_date`, `city_state`, `inquiry_category` including venue availability, textarea `message`, required `consent` | Validates server-side. Inserts into `site_inquiries` only when DB is enabled; otherwise returns local fallback success. |
| Inline language editor | Admin-only inline toolbar + `proto/public/admin-language-save.php` | Language admin save route | `csrf_token`, `token`, `canonical_text` | Prototype tooling only; secure or disable before launch. |
| Managed section editor | `proto/editor/index.php` standalone editor + `proto/app/page_sections.php` | `proto/docs/page_sections.json` | Route, slot, type, status, sort order, Timeline/GEN, layout modes, approved image filename, text, CTA, review flags | Prototype schema-driven structural editor; published sections render only at explicit slots and drafts remain admin-only. |
| Site Layer Controls runtime | `proto/public/site-layers/` forms + `proto/public/site-layer-save.php` | `proto/docs/site_layer_controls_state.json` | Route, discovered section handle, visual treatment controls, hide/show state, language edits, CSS appends, asset replacements | Saves now affect active public route output at render time for supported section visual controls, section ordering, and visibility; copy, CSS, and selected asset/template operations continue to write their active files directly. |

## CSS / design-system inventory

| Area | Selectors / files | Notes |
| --- | --- | --- |
| Main stylesheet | `proto/public/assets/css/site.css` | Single active stylesheet, also inlined by `render_inline_asset()` as fallback. |
| Fonts | `proto/public/assets/font/script.otf`, `proto/public/assets/font/nasty.otf` | Local logo/display font assets loaded by `@font-face`. |
| Color tokens | `:root` CSS variables | Dark stage palette: black, bone, chrome, red, orange, gold/yellow, purple, line/glow values. |
| Page shell | `body`, `.container`, `.section-shell`, `.site-header`, `.top-nav`, `.site-footer` | Dark background, sticky desktop header, responsive shell, footer and mobile CTA. |
| Hero/poster | `.hero`, `.hero__copy`, `.hero__poster`, `.hero-countdown`, `.hero-facts` | Large poster layout with image/scrim, countdown and fact pills. |
| Panels/cards | `.date-card`, `.proof-section`, `.spectacle-section`, `.vault-section`, `.event-footer`, `.fact-card`, `.proof-grid article`, `.event-footer__card` | Reusable bordered, glowing dark panels and grids. |
| Fan Vault | `.relic-grid`, `.relic-card`, `.relic-card__stamp` | Six-card road-case navigation layout. |
| Forms | `.form-section`, `.contact-section`, `.site-form`, `.optional-topics`, `.consent--required`, `.check-all` | Responsive form grids with required consent highlighting. |
| Image slots/placeholders | `.image-slot`, `.image-slot--placeholder`, `.image-placeholder`, `.media-grid` | Approved media slots and route-specific placeholder blocks. |
| Map | `.map-section`, `.map-frame` | Directions route embedded map layout. |
| Animation | `border-shimmer`, `header-line-shimmer`, `text-glow-pulse`, `page-gradient-drift` | Current shimmer system uses varied border colors/timings by section group; no sweeping overlay line. |
| Reduced motion | `@media (prefers-reduced-motion: reduce)` | Disables animation for motion-sensitive users. |

## JavaScript inventory

| File / global | Responsibility |
| --- | --- |
| `proto/public/assets/js/site.js` | Single active public script, also inlined by `render_inline_asset()` as fallback. |
| `window.JOK_LANGUAGE` | Server-rendered language subset used by JS for countdown/form status text. |
| `window.siteEvents` | Lightweight local event log array for click/form/notice events. |
| `window.trackSiteEvent()` | Pushes local tracking events into `window.siteEvents`; no external analytics dependency. |
| `[data-track]` click listeners | Tracks CTA clicks with event names and hrefs. |
| `[data-countdown]` | Computes time to July 25, 2026 target and updates once per minute unless reduced motion is active. |
| `[data-check-group]` | Implements “select all update topics” checkbox behavior and indeterminate state. |
| `[data-enhance-form]` | Adds form-focus and submit-attempt local tracking plus status text. |
| `window.JOK_INLINE_LANGUAGE_ADMIN` | Enables inline language editing toolbar when an admin session supplies CSRF/endpoint data. |
| `.relic-card` pointer listeners | Adds/removes `.is-open` hover state unless reduced motion is active. |

## Approved public image asset inventory

Approved homepage/background/media assets should live in `proto/public/assets/img/` and match the filenames registered in `proto/app/site_data.php`.

| Filename | Current role |
| --- | --- |
| `trailer-poster-stage-portal.webp` | Homepage hero background and trailer/poster media slot. |
| `spectacle-lighting-rig.webp` | Homepage event details background and spectacle media slot. |
| `costume-chrome-detail.webp` | Homepage about/proof background and costume media slot. |
| `gear-control-dossier.webp` | Homepage update-list/control background. |
| `fog-strobe-atmosphere.webp` | Homepage final CTA background and fog/strobe media slot. |
| `road-case-vault-bg.webp` | Homepage Fan Vault background and vault road-case media slot. |
| `hero-stage-portal.webp` | Approved stage portal image slot. |
| `interlochen-dispatch-map.webp` | Approved dispatch/map image slot. |
| `press-performer-portrait.webp` | Approved press/portrait media slot. |

## Documentation inventory

| File | Role |
| --- | --- |
| `proto/README.md` | Local development, deployment root, runtime notes. |
| `proto/docs/website_ssot.md` | Current canon for active app, homepage sections, public claims, forms, route jobs, launch blockers, decisions. |
| `proto/docs/routes_and_supporting_pages.md` | Route table and implementation status. |
| `proto/docs/language.json` | Runtime-backed source of public copy tokens. |
| `proto/docs/page_sections.json` | Runtime-backed schema for editor-created managed page sections, layout/style options, placement slots, and publish/draft/archive status. |
| `proto/docs/language_map.md` | Human-readable generated inventory from `language.json`. |
| `proto/docs/language_backups/` | Backups of prior language JSON revisions. |
| `proto/docs/asset_placeholders.md` | Media slot filenames and timeline IDs. |
| `proto/docs/css_style_reference.md` | CSS/component style cheat sheet for finding and changing major visual systems. |
| `proto/docs/image_generation_inventory.md` | Image-generation inventory and creative constraints. |
| `proto/docs/image_generation_requests.txt` | Working prompt/request list for route-specific image generation. |
| `proto/docs/image_generation_prompt_list.txt` | Prompt list for image generation work. |
| `proto/docs/launch_checklist.md` | Local verification and public launch blockers. |
| `proto/docs/website_inventory.md` | This inventory document. |
| `proto/docs/proto_expert_coding_boot_prompt.md` | Fresh-session boot prompt for an expert coding LLM. |
| `proto/docs/developer_editor_guide.md` | Implementation-backed change map, safe-editing recipes, verification checklist, and known-risk register for developers and editors. |

## Database inventory

| File | Role |
| --- | --- |
| `proto/database/schema.sql` | Optional MySQL/MariaDB schema for site leads, inquiries, and form events. |
| `proto/database/seed.sql` | Optional seed data. |

Expected logical tables from the PHP handlers:

| Table | Producer |
| --- | --- |
| `site_leads` | `handle_lead_submit()` when DB is enabled. |
| `site_inquiries` | `handle_inquiry_submit()` when DB is enabled. |
| `site_form_events` | `store_form_event()` for validation failures, local fallback, and stored events when DB is enabled. |

## Public facts and guardrails inventory

| Area | Current public truth / guardrail |
| --- | --- |
| Event date | July 25, 2026. |
| Admission | Free show; no ticket required; RSVP/update-list appreciated. |
| Camping | Camping is `$10/night/person` for one night before and one night after the show; electric hookup is `$35/person`. |
| Location | Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643. |
| Phone | Public location/event phone currently shown as `231-276-9091`. |
| Parking | Outside the gate; overflow and handicap parking available. |
| Safety | Loud sound, bright lights, fog, flashing patterns/strobe-style looks may be used; sensitive guests should plan accordingly. |
| Content | Independent theatrical tribute; no outside partnership is claimed. Avoid outside logos, outside media, exact restricted makeup, album art, and restricted fonts unless approved. |
| Contact/privacy | Update-list notification destination is configured; final privacy/retention policy and production mail transport remain launch-sensitive content items. |

## Local verification command inventory

Run from repository root unless noted.

```bash
php -S 127.0.0.1:8000 -t proto/public
```

```bash
find proto -name '*.php' -print0 | xargs -0 -n1 php -l
```

```bash
php -r '$css=file_get_contents("proto/public/assets/css/site.css"); echo substr_count($css,"{")===substr_count($css,"}") ? "CSS brace balance OK\n" : "CSS brace mismatch\n";'
```

```bash
curl -I http://127.0.0.1:8000/
```

## Maintenance notes

- Keep `proto/docs/website_ssot.md` synchronized whenever public event facts, route jobs, form behavior, image policy, or launch blockers change.
- Keep this inventory synchronized whenever files/routes/assets/components are added, renamed, retired, or meaningfully repurposed.
- Keep `proto/docs/language_map.md` synchronized with `proto/docs/language.json` after copy-token changes.
- Keep managed public-page section changes in `proto/docs/page_sections.json` and render them only through reviewed route slots in `proto/app/page_sections.php`.
- Supporting routes should continue using visible image placeholders until route-specific images are generated, reviewed, and explicitly approved.
- Do not commit secret-bearing `proto/app/config.php` values.
- Secure or disable the admin language editor before public deployment.
