# Just One KISS `/proto` — Developer and Editor Change Guide

**Classification:** `GEN`  
**Status:** Implementation-backed maintenance guide  
**Scope:** The active standalone public site under `proto/`  
**Read first:** `proto/README.md`, `proto/docs/website_ssot.md`, and this guide.

## 1. Purpose and non-negotiable boundaries

This guide is a map for making safe, reviewable changes to the active Just One KISS public site. It is intended to eliminate the two most costly maintenance mistakes:

1. editing a legacy/provenance file rather than the active site; and
2. changing a public fact, asset, form, or route in one place while leaving the dependent code and documentation inconsistent.

### Active versus historical files

| Treat as | Paths | Rule |
| --- | --- | --- |
| **Active document root** | `proto/public/` | Serve this directory. Edit public routes, active assets, and `admin-language-save.php` here. |
| **Active shared application** | `proto/app/` | Shared rendering, routes/data, language loading, CSRF, forms, JSON lead storage, optional DB, and mail helpers. |
| **Active documentation** | `proto/docs/` | Canon, copy source, inventories, change guidance, image planning, and launch checklist. |
| **Optional persistence** | `proto/database/` | MySQL/MariaDB schema and seed data; not required for DB-disabled local development. |
| **Historical/provenance only** | top-level `proto/*.php` and `proto/*/index.php` outside `proto/public/` | Do not edit for a normal public-site change. They are not the deployed route files. |

The active app is intentionally plain PHP plus local CSS/JS. Do not introduce a framework, build pipeline, external asset dependency, browser canvas effect, or analytics dependency as incidental cleanup. The runtime posture is static presentation with progressive enhancement.

## 2. System map

```text
Browser request
  └─ proto/public/<route>/index.php
       ├─ requires proto/app/view.php
       │    ├─ helpers.php       escaping, config, POST helpers
       │    ├─ csrf.php          session token creation/verification
       │    ├─ language.php      language.json loading and admin wrappers
       │    └─ site_data.php     route registry and image inventory
       ├─ handles POST (lead or inquiry) when relevant
       ├─ renders route-specific sections
       └─ render_footer()
            ├─ shared Event information cards
            ├─ footer + mobile CTA
            ├─ external CSS/JS tags
            └─ inline CSS/JS fallbacks

Form persistence and notifications
  lead handler → form_storage.php → proto/storage/leads/YYYY-MM.json
               → mailer.php → owner notification + visitor confirmation after JSON storage succeeds; failures are written to PHP error_log and recorded under proto/storage/mail-failures/
               ↘ db.php → optional PDO → site_leads/site_form_events when DB is enabled
  inquiry handler → db.php → optional PDO → site_inquiries/site_form_events

Copy source
  route/view helper token → language.php → proto/docs/language.json
```

### Ownership map

| Concern | Primary place to change | Then review |
| --- | --- | --- |
| Public event fact or public claim | `website_ssot.md`, matching `language.json` token(s) | all routes/shared footer using the claim, `website_inventory.md`, launch checklist |
| Page wording/CTA/label | `language.json` | `language_map.md`; regenerate/update it after copy changes |
| Route body/layout | relevant `proto/public/**/index.php` | `site_pages()`, CSS, route docs, smoke tests |
| Header/footer/shared forms | `proto/app/view.php` | every public route, nested-route links, desktop/mobile behavior |
| Navigation/route metadata | `proto/app/site_data.php` | header, sitemap-like route references, smoke test list |
| Colors/layout/animation | `proto/public/assets/css/site.css` | CSS guide, all breakpoints, reduced motion |
| Client-side behavior | `proto/public/assets/js/site.js` | no-JS behavior, reduced motion, copy tokens used by JS |
| Managed inserted public sections | `proto/editor/index.php`, `proto/app/page_sections.php`, `proto/docs/page_sections.json` | route slots, approved images, public-ready/rights/safety flags, JSON validity, public route smoke |
| Form validation/persistence | `proto/app/forms/*.php`, `db.php`, schema | form markup, config, DB schema, privacy/notification policy |
| Public media | `proto/public/assets/img/`, `site_data.php` | image inventory, image policy, image-generation docs |

## 3. Route map and safe route changes

### Active routes

| URL | Active entry point | Primary responsibility | Nav |
| --- | --- | --- | --- |
| `/` | `public/index.php` | Hero, event facts, proof cards, lead form, final CTA, six-card Fan Vault | Home link only |
| `/july-25-2026/` | `public/july-25-2026/index.php` | Complete free-show details and lead capture | Yes |
| `/what-is-just-one-kiss/` | `public/what-is-just-one-kiss/index.php` | The Ritual / public tribute explanation | Yes |
| `/spectacle/` | `public/spectacle/index.php` | Venue/capability-oriented spectacle overview | Yes |
| `/directions/` | `public/directions/index.php` | Address, phone, Google Maps outbound link and embed, arrival notes | Yes |
| `/faq-disclaimer/` | `public/faq-disclaimer/index.php` | FAQ, safety, accessibility, independent-tribute disclaimer | Yes |
| `/contact/` | `public/contact/index.php` | Direct contact information, lead form, inquiry form | Yes |
| `/vault/` | `public/vault/index.php` | Fan media and future approved media slots | No |
| `/video/` | `public/video/index.php` | Future original trailers/clips and sharing guidance | No |
| `/technical/` | `public/technical/index.php` | Location-facing show-control/effects overview | No |
| `/contact-press/` | `public/contact-press/index.php` | Permanent 301 redirect to `/contact/` | No |

### Adding a route without breaking nested links

1. Create `proto/public/<slug>/index.php` and require `../../app/view.php`.
2. Use `render_header()` and `render_footer()`; do not duplicate the shell.
3. Use `page_url()` and `rel_url()` for internal links and asset links. Do not hard-code root-relative paths such as `/assets/...`; the app intentionally supports nested deployment paths.
4. Add route metadata in `site_pages()`. Set `nav` deliberately instead of assuming every page belongs in primary navigation.
5. Add tokenized metadata/copy to `language.json` and update `language_map.md`.
6. Decide whether the page is main-navigation, a Fan Vault destination, a utility page, or a redirect. Update `routes_and_supporting_pages.md`, `website_inventory.md`, and `website_ssot.md` when the public information architecture changes.
7. Add it to the route smoke-test list and test it both directly and from an existing nested page.

### Why relative URL helpers are high-risk code

`page_depth()` derives a prefix from the executing script path, and `rel_url()`/`page_url()` build all internal paths from it. A seemingly harmless change to route nesting, script placement, or `SCRIPT_NAME` assumptions can break navigation, CSS, JavaScript, fonts, form endpoints, or the inline language admin only on nested pages. Test `/` and at least one nested route after changes in `view.php` or route placement.

## 4. Editor guide: copy, facts, rights, and assets


### Managed page sections are schema-driven, not freeform PHP writes

The standalone section editor in `proto/editor/index.php` writes managed blocks to `proto/docs/page_sections.json` and the public homepage renders those records through explicit slots in `proto/app/page_sections.php`. Use it for controlled text, image, text+image, callout, and CTA sections. Published records render publicly; draft records and insertion plus rails are admin-only. Keep image filenames limited to the approved `image_inventory()` list, keep every managed section classified with `timeline_moment_id_or_gen`, and preserve rights/safety/public-ready review flags before publishing.

### Copy is tokenized; do not make route files the source of truth

Routes contain fallback strings to keep the site readable if a token is absent, but `proto/docs/language.json` is the runtime canonical copy source. `language.php` builds a token-to-text map and emits escaped public text. Use route PHP for **placement and semantic structure**, not routine editing of wording.

When changing copy:

1. Find the token with `rg -n 'exact phrase or token' proto/docs/language.json proto/public proto/app`.
2. Change the matching entry's `canonical_text` in `language.json`.
3. Preserve the entry's token, role, component, safety/public-ready flags, and other metadata unless the content model itself is changing.
4. Update/regenerate `language_map.md` so human documentation remains aligned.
5. Search for the fact/phrase across `proto/`; a verified event fact often appears in a route, shared Event information block, title/description, and docs.
6. Validate `language.json` with `jq` before testing pages.

### Public-fact guardrails

These facts are intentionally repeated and must move together when verified information changes:

- July 25, 2026 date.
- Free show / no ticket required / RSVP appreciated.
- Cycle Moore Legacy address and public phone.
- $10/night camping and regular-charge caveat for longer stays.
- Parking around the pavilion as directed/marked.
- Loud sound, bright lights, fog, flashing patterns/strobe-style looks.
- Independent theatrical tribute; no official affiliation/endorsement/authorization claim.

Do not invent arrival control, campground policy, accessibility, safety, venue, schedule, ticketing, or contact-response promises. Keep safety language visible where users make a conversion decision and in the shared event-information/footer area.

### Asset rules

- Homepage sections may use approved local `.webp` backgrounds through `asset_style()`.
- Supporting routes intentionally use `render_image_placeholder()` until route-specific images are generated, reviewed, and approved. Do not replace a placeholder with a new image merely because a file exists.
- Put approved files in `proto/public/assets/img/` and register them in `image_inventory()`.
- Follow `image_generation_inventory.md`: images must be original, public-ready black/chrome/fire imagery. Do not add outside logos, outside photos, album art, exact makeup designs, restricted fonts, or partnership implications.
- The image plan distinguishes assets that exist locally from assets that still need review; “present in the directory” does not mean “cleared for public deployment.”

## 5. Shared rendering and front-end guide

### `view.php` responsibilities

`view.php` is the most consequential shared file. It provides:

- depth-aware URLs and assets;
- inline CSS/JS fallback rendering;
- image placeholders and media grids;
- shared header/navigation and notices;
- universal Event information/footer/mobile CTA;
- shared lead and inquiry form markup.

Any edit here has whole-site impact. Verify every route after changing shared markup, especially:

- the header/nav and screen-reader labels;
- form fields and hidden form type/CSRF inputs;
- the shared Event information cards;
- local font URL rewriting in inline CSS fallback;
- the script/style tag plus inline fallback behavior.

### CSS rules

`public/assets/css/site.css` is the only active stylesheet and is also inlined as a fallback. It contains sequential override passes; later rules may intentionally supersede earlier declarations. Before removing a rule, search both the selector and the entire stylesheet for later overrides.

Key design contracts:

- Keep the dark black/chrome/fire palette and display hierarchy unless a visual-system change is explicitly intended.
- Preserve the homepage six-card Fan Vault contract.
- Preserve supporting-page placeholder styling while that image policy remains active.
- Preserve keyboard focus visibility, readable form labels, and the mobile CTA behavior.
- Every new animation must have an equivalent reduced-motion treatment. CSS has two `prefers-reduced-motion` blocks; inspect both before declaring motion work complete.

### JavaScript rules

`public/assets/js/site.js` is optional enhancement. The site should remain navigable and forms should remain server-validatable with JavaScript disabled.

Existing responsibilities are countdown updates, local click/form-event logging, topic-checkbox state, submit-status text, inline language editing, and Fan Vault hover state. When changing JS:

- Do not turn `window.siteEvents` into a claim that data is transmitted or analytically processed; it is local in-memory tracking.
- Keep countdown source date synchronized with verified event timing.
- Do not rely on JS for consent, CSRF, validation, or persistence; PHP remains authoritative.
- Check reduced-motion behavior before adding pointer/animation effects.

## 6. Forms, database, and security change map

### Lead form contract

The shared lead form posts `form_type=lead`, `csrf_token`, honeypot `website`, email, city/ZIP, `interest_tags[]`, and required consent. `handle_lead_submit()` validates CSRF, honeypot, email, consent, and an allowlisted set of interest tags, then stores a server-side JSON record before sending owner and visitor emails.

If adding/removing a topic, update all of:

1. the checkbox markup in `render_lead_form()`;
2. `$allowedTags` in `lead_submit.php`;
3. `site_interest_tags` seed data when persistence/reporting needs the new tag;
4. language tokens/map for the label;
5. privacy/consent copy if the subscription scope changes.

### Inquiry form contract

The inquiry form posts `form_type=inquiry`, CSRF/honeypot fields, email, organization, category, message, consent, and optional routing details. The handler validates the category allowlist and stores details only when PDO is enabled.

**Known data-model warning:** the form allows the `technical` category, but the present SQL `site_inquiries.category` enum does not contain `technical`; the handler maps it to `general` before insertion. Do not remove that mapping without first migrating the enum/schema and validating existing reporting expectations. If technical inquiries need distinct reporting, add the enum value in a migration and remove/update the mapping in the same deployment.

### Database and notifications

- No `proto/app/config.php` means normal local configuration, with lead submissions still written to server JSON under `proto/storage/leads/` when the PHP process can write there.
- `jok_pdo()` returns `null` whenever DB is disabled or connection fails; lead JSON storage remains the durable update-list store, while DB insertion is optional. Inquiry submissions still require DB-enabled persistence to be stored.
- Form-event audit rows are only stored when the DB works.
- `queue_notification()` sends owner notification mail to the configured `notification_email` after lead JSON storage succeeds; `send_lead_confirmation_email()` sends the visitor confirmation. If PHP `mail()` cannot hand off a message, the form returns an error-style notice, writes a PHP `error_log()` entry, records the failed attempt under `proto/storage/mail-failures/`, and the browser logs a console warning for the rendered notice. Server mail transport must be configured for real delivery.
- Never commit a secret-bearing `proto/app/config.php` or runtime JSON lead records.

### Admin language editor

The inline language editor is gated by session state and a separate admin CSRF token. Its save endpoint writes `language.json` and creates a backup under `proto/docs/language_backups/`.

This is prototype tooling. Before public launch, secure it properly or disable/remove it. Changes to its authorization/session flow require manual security review, write-permission review, backup verification, and a post-edit `language_map.md` synchronization check.

## 7. Change recipes

### A. Change an event fact

1. Confirm the new fact from an approved source.
2. Update the relevant canonical statement in `website_ssot.md`.
3. Update `language.json` tokens and any required route structure/fallbacks.
4. Search all `proto/` references to the former value.
5. Update `website_inventory.md`, routes doc, and launch checklist if behavior or a blocker changed.
6. Test all routes and inspect the shared Event information/footer.

### B. Change homepage design

1. Identify markup in `public/index.php` and shared styles in `site.css`.
2. Preserve the six homepage section purposes and six-card Fan Vault unless the SSOT decision changes.
3. If changing a background, use approved inventory/rights workflow and `asset_style()`.
4. Check desktop, tablet, and mobile layouts plus reduced motion.
5. Screenshot or visually inspect the runnable page after a perceptible change.

### C. Add a new form field

1. Add accessible markup and tokenized labels in `render_lead_form()` or `render_inquiry_form()`.
2. Add server-side extraction, normalization/length limit, and validation in the matching handler.
3. Add DB column/migration and prepared-statement binding if persistence is needed.
4. Consider consent/privacy impact and update documentation.
5. Test validation failure, success with DB disabled, and DB-enabled persistence in an appropriate environment.

### D. Add a visual effect or interaction

1. Prefer CSS and small progressive JS.
2. Do not reintroduce browser particle/canvas/fire/smoke/heat effects without an explicit product decision.
3. Add keyboard/accessibility behavior where interactive.
4. Add/verify `prefers-reduced-motion` handling.
5. Test without JS and on mobile.

## 8. Required investigation and verification checklist

### Before editing

- Read the SSOT and identify whether the change touches a public fact, route, asset, copy token, form, or shared component.
- Run `git status --short --branch` and preserve unrelated working-tree changes.
- Search before editing: `rg -n 'token|phrase|selector|field_name' proto`.
- Identify active files before acting; do not modify legacy copies by accident.

### After every code change

Run from repository root:

```bash
find proto -name '*.php' -print0 | xargs -0 -n1 php -l
php -r '$css=file_get_contents("proto/public/assets/css/site.css"); echo substr_count($css,"{")===substr_count($css,"}") ? "CSS brace balance OK\n" : "CSS brace mismatch\n";'
jq -e '.schema_version and (.entries|type == "array") and (.text_groups|type == "array")' proto/docs/language.json
```

### Route smoke test

```bash
php -S 127.0.0.1:8000 -t proto/public
```

In another terminal:

```bash
for path in / /july-25-2026/ /what-is-just-one-kiss/ /spectacle/ /directions/ /faq-disclaimer/ /contact/ /vault/ /video/ /technical/ /contact-press/; do
  printf '%-28s' "$path"
  curl -sS -o /dev/null -w '%{http_code} %{redirect_url}\n' "http://127.0.0.1:8000$path"
done
```

Expected: `200` for active pages and `301` from `/contact-press/` to `/contact/`.

### Change-specific checks

| Change type | Additional checks |
| --- | --- |
| Copy/facts | Search former/new value; validate JSON; update language map and SSOT-dependent docs. |
| CSS/layout | Inspect desktop and mobile; confirm no horizontal overflow; inspect reduced motion. |
| Route/shared view | Visit every route and verify nested-route CSS/JS/font/link paths. |
| Form | Test invalid CSRF, honeypot, required fields, consent, invalid email/category/tag, and DB-disabled success. |
| DB | Import/test schema in MySQL/MariaDB; verify enum compatibility and prepared inserts. |
| Asset | Confirm filename, inventory registration, image policy/rights approval, responsive crop/readability. |
| Admin editor | Verify unauthenticated rejection, CSRF rejection, backup creation, JSON validity, and map synchronization. |

## 9. Known risk register

| Risk | Why it can surprise a developer | Safe response |
| --- | --- | --- |
| Editing legacy routes | They resemble active pages but are not the public document root. | Edit `proto/public/` unless intentionally preserving provenance. |
| Relative URL breakage | A root URL can work while nested pages lose CSS, JS, fonts, or links. | Use helpers and smoke-test nested routes. |
| Duplicated public facts | The same fact exists in tokens, fallback text, docs, and shared footer. | Search globally and update canon first. |
| CSS cascade confusion | Later readability/shimmer passes override earlier selectors. | Search full selector history before deleting/overriding. |
| DB-disabled “success” | Forms validate locally without storage by design. | Do not mistake it for production delivery; test with DB config separately. |
| Schema/handler drift | The technical category mapping demonstrates model/UI mismatch risk. | Migrate schema and handler together; test inserts. |
| Inline fallback duplication | CSS and JS are linked and inlined as a host-misrouting fallback. | Test behavior with normal assets and avoid assumptions about single execution. |
| Placeholder image policy | An image file can exist but still not be public-approved. | Follow inventory and approval status, not just file existence. |
| Motion regressions | Effects may be fine visually but unsafe/unpleasant for motion-sensitive users. | Update and test reduced-motion rules. |
| Prototype admin exposure | Language editor can write public copy and backups. | Secure or disable before public deployment. |

## 10. Documentation maintenance contract

Update these alongside the corresponding change:

| If you change… | Update… |
| --- | --- |
| Active route/component/asset inventory | `website_inventory.md` |
| Homepage role, public fact, image policy, route job, form behavior, or decision | `website_ssot.md` |
| Route list/status | `routes_and_supporting_pages.md` |
| Runtime public copy | `language.json` and `language_map.md` |
| Styling system | `css_style_reference.md` |
| Image assets/approval requests | image inventory/placeholders/request documents |
| Launch requirement/blocker | `launch_checklist.md` |
| Maintenance workflow/known risk | this guide |

Do not leave a behavioral code change undocumented when the existing documentation has a canonical section for it. The documentation is part of the application’s safety system, not an optional afterthought.
