# Just One KISS `/proto/public` Mobile-Responsive Success Guide

## Document control
| Field | Value |
| --- | --- |
| Owner | Site maintainer / project owner |
| Classification | `GEN` / GENERAL / NOT TIMELINE-SPECIFIC |
| Status | Working implementation guide for mobile-responsive edits |
| Last audited | 2026-07-23 |
| Current authority domain | Practical responsive-design checklist for the active `proto/public/` vanilla PHP site. |
| Not authority for | Event facts, public copy approval, image rights, CMS auth, database production readiness, or show-control safety canon. |
| Sources inspected | `proto/README.md`, `proto/docs/website_ssot.md`, `proto/docs/css_style_reference.md`, `proto/app/view.php`, `proto/public/index.php`, `proto/public/assets/css/site.css`, `proto/public/assets/js/site.js`. |
| Next action | Use this guide before and after any perceptible public-site layout, route, CSS, form, CMS/page-layer, or media-slot change. |
| Completion criteria | A maintainer can make a responsive change without breaking the active document root, mobile navigation, forms, safety/disclaimer visibility, image behavior, or CMS/page-layer affordances. |

## 1. Purpose

Use this guide when making the active Just One KISS public site work cleanly across phones, tablets, laptops, and desktop displays.

The active web app is not a greenfield build. It is a vanilla PHP public site with a custom page-layer/CMS system, tokenized public copy, local image assets, route templates, shared rendering helpers, and a single shared stylesheet. Responsive work must preserve that architecture instead of adding a framework or rebuilding the layout system.

## 2. Non-negotiable responsive goals

A responsive change succeeds only when all of these remain true:

1. **No horizontal page scrolling** at common phone widths unless a deliberately scrollable admin/CMS table or code-like region requires it.
2. **Event facts remain readable text**, especially date, free admission, no-ticket language, Cycle Moore Legacy address, camping cost language, parking/access notes, and safety warnings.
3. **Conversion paths remain usable by touch**, including hero CTAs, update-list forms, contact forms, and the fixed mobile CTA.
4. **Independent-tribute and safety language stay visible** near conversion areas and in the shared event/footer information.
5. **Images crop intentionally**, using `object-fit`, `aspect-ratio`, `--asset-position`, `--asset-size`, and section scrims rather than layout-breaking fixed image dimensions.
6. **CMS/page-layer controls still work** when `?site_layer_editor=1` is active; editor affordances, overlays, media cards, and operation forms must not become unreachable on mobile.
7. **Reduced-motion behavior is preserved**; do not add browser fire, ember, smoke, heat, canvas, particle, or motion-heavy effects.
8. **The site remains vanilla deployable** from `proto/public/` without a build step, package manager, or front-end framework.

## 3. Active responsive work surface

Edit these files for responsive public-site work:

| Need | Active file(s) |
| --- | --- |
| Shared responsive CSS | `proto/public/assets/css/site.css` |
| Shared header, footer, mobile CTA, event footer, forms, media rendering | `proto/app/view.php` |
| Homepage structure | `proto/public/index.php` |
| Supporting route structure | `proto/public/*/index.php` |
| Route labels / image inventory | `proto/app/site_data.php` |
| Shared behavior and reduced-motion-sensitive enhancements | `proto/public/assets/js/site.js` |
| Public copy tokens | `proto/docs/language.json` |
| CMS/page-layer behavior | `proto/app/layer_controls.php`, `proto/app/layer_control_views.php`, `proto/app/layer_runtime.php`, `proto/public/site-layer-save.php` |

Do **not** edit top-level legacy route copies under `proto/*.php` or `proto/*/index.php` for normal responsive fixes unless the task explicitly names those legacy files.

## 4. Current responsive foundation to preserve

The site already has a mobile-aware foundation:

- `proto/app/view.php` emits `<meta name="viewport" content="width=device-width, initial-scale=1">`.
- `.container` and `.section-shell` use `width: min(var(--max), calc(100% - 2rem))` for a fluid page shell.
- Major headline, body, logo, and spacing values use `clamp()`.
- Primary grids use `minmax(0, 1fr)` so cards can shrink instead of forcing overflow.
- Shared breakpoints currently appear around `1180px`, `1100px`, `980px`, `760px`, `720px`, `700px`, and `640px`.
- The layout already collapses major grids from desktop columns to tablet and phone columns.
- `.mobile-cta` is hidden by default and displayed on small screens.
- Images rendered by `render_media_grid()` and `render_page_image()` use real `<img>` elements with `loading="lazy"`; CSS controls aspect ratio and cropping.
- `@media (prefers-reduced-motion: reduce)` disables meaningful animation and transitions.

When adding new layout patterns, match these conventions before inventing new ones.

## 5. Design mobile-first, then scale up

For new responsive CSS, prefer this order:

1. Write the base selector so it works on phone screens first.
2. Add `@media (min-width: ...)` only if a larger layout needs enhancement.
3. If working inside existing desktop-first sections, keep the current breakpoints but verify the smallest state first.
4. Use `minmax(0, 1fr)` for grid tracks so long text, buttons, image labels, and CMS-generated labels can shrink.
5. Use `repeat(auto-fit, minmax(..., 1fr))` for card groups that do not need a strict marketing layout.
6. Keep touch targets at least comfortable button size; current `.button` patterns use generous `min-height` and pill spacing.

Recommended pattern for a new card grid:

```css
.new-card-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 1rem;
}

@media (min-width: 700px) {
  .new-card-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

@media (min-width: 980px) {
  .new-card-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}
```

If adding to an existing section, reuse the existing grid class where possible instead of creating a near-duplicate.

## 6. Header and navigation rules

The shared header is one of the highest-risk mobile areas because it combines a large theatrical logo, many navigation links, a sticky/desktop posture, and a CTA.

Responsive header success means:

- The brand mark never overlaps navigation.
- Navigation can wrap without forcing the viewport wider than the device.
- The `Join Updates` CTA remains visible and tappable.
- At small widths, the header may become non-sticky if needed to recover vertical space.
- Do not replace the current nav with a JavaScript-only hamburger unless specifically requested; no-JS navigation should remain understandable.

Checklist before changing header CSS:

- Inspect `.site-header`, `.brand-mark`, `.top-nav`, `.top-nav a`, and `.top-nav .nav-cta` in `site.css`.
- Inspect `render_header()` in `proto/app/view.php` for nav markup and `site_pages()` in `proto/app/site_data.php` for nav items.
- Test with current route count, not a simplified mockup.
- Check 320px, 360px, 390px, 414px, 640px, 760px, 980px, and desktop widths.

## 7. Hero, subhero, and headline rules

The theatrical headline system uses large custom font sizing. It must stay dramatic without breaking phone layouts.

Use these rules:

- Keep `h1`, `h2`, `h3`, `.brand-mark`, `.hero-brand-echo`, and `.hero__poster strong` on `clamp()` sizing.
- Prefer reducing letter spacing or max width before shrinking the entire visual identity too far.
- Add `overflow-wrap: anywhere` to isolated problem labels/headlines when copy is tokenized or CMS-controlled.
- Preserve real text for the event date and CTA copy; do not move essential facts into images.
- If a headline wraps badly, adjust the token or line-break helper deliberately rather than hiding text.

## 8. Section-grid rules

The active site relies on several shared grid classes:

- `.facts-grid`
- `.proof-grid`
- `.proof-grid--feature`
- `.system-grid`
- `.faq-grid`
- `.media-grid`
- `.image-list`
- `.route-grid`
- `.relic-grid`
- `.dossier-images`
- `.event-footer__grid`
- `.form-section`
- `.contact-section`
- `.event-poster`

Before adding CSS, ask whether one of these existing classes already expresses the layout you need. Responsive fixes should usually tune these shared selectors rather than patch one page in isolation.

When a section overflows on mobile:

1. Check for fixed `min-width`, long unbreakable text, large `clamp()` upper/lower bounds, or grid columns lacking `minmax(0, 1fr)`.
2. Check nested children such as buttons, badges, labels, and images.
3. Prefer `overflow-wrap: anywhere` on long labels, filenames, URLs, or generated operator text.
4. Only use `overflow-x: auto` for data tables, code blocks, admin operation lists, or intentionally scrollable controls.

## 9. Images, background art, and crop rules

Images appear in two main ways:

1. **CSS background images** through `asset_style()` setting `--asset-image` for hero/section background art.
2. **Real image elements** through `render_page_image()` and `render_media_grid()`.

Responsive image success means:

- Use `aspect-ratio` and `object-fit: cover` for `<img>` cards.
- Use `--asset-position` and `--asset-size` when a background image needs mobile crop tuning.
- Keep scrims strong enough that text remains readable over art.
- Do not hard-code image widths in PHP templates.
- Do not rename image files to solve label problems; CMS image labels are display-only.
- Keep alt text meaningful for content images and empty/decorative only when the image is truly decorative.

Mobile crop pattern:

```css
.section-with-bg--example {
  --asset-position: 58% center;
}

@media (max-width: 640px) {
  .section-with-bg--example {
    --asset-position: 64% center;
    --asset-size: cover;
  }
}
```

## 10. Forms and conversion areas

Update-list and contact forms are conversion-critical and safety/privacy-sensitive.

A form responsive change must preserve:

- Server-side validation fields and names.
- CSRF and honeypot inputs.
- Required consent visibility.
- Accessible labels and fieldsets.
- Clear success/error notices with `aria-live` behavior.
- No promise of instant replies or guaranteed mail delivery unless production mail is verified.

Mobile form rules:

- Keep `.form-section` and `.contact-section` as one column below tablet widths.
- Do not place form controls side-by-side on narrow screens unless each field remains readable and tappable.
- Keep checkbox rows legible; `.consent--required` should not compress the text into an unreadable column.
- Buttons should remain full-width or easy to tap when stacked.
- After any form layout change, submit through the local server if practical or at least verify the PHP route renders without syntax errors.

## 11. CMS/page-layer responsive rules

The `site-layers` suite is the current v2 MVP CMS/page-layer control surface. Its responsive work must account for editor operations, POST state writes, media uploads, image labels, crop/position metadata, overlays, and runtime affordances.

For CMS-responsive changes, map this chain before editing:

UI form field names → JavaScript synchronization/population → `proto/public/site-layer-save.php` → `jok_layer_apply_operation()` → validation/sanitization → state/published JSON write → public runtime rendering → CSS/custom properties.

Responsive CMS requirements:

- Operation forms must stay reachable and readable on phones.
- Media cards must not lose filenames, display labels, alt/decorative controls, or selected asset values.
- Overlay controls must remain usable by keyboard and touch.
- Preview panels may scroll horizontally only when a visual preview truly exceeds the phone width.
- Do not hide launch-critical review metadata on mobile.
- Do not commit generated backup files from `proto/docs/site_layer_control_backups/` unless explicitly requested.

## 12. Accessibility requirements

Responsive work is not successful if it only looks good visually. Preserve:

- The skip link.
- The semantic heading order for each route.
- Accessible names for navigation and CTAs.
- Labels for inputs, selects, textareas, and checkbox groups.
- Visible focus styling from `:focus-visible`.
- Color contrast over background images and gradients.
- Reduced-motion behavior.
- Keyboard reachability for nav, CTAs, forms, cards, CMS controls, and overlays.

Do not remove text just because it is long on mobile. Edit the token with approval or improve the layout.

## 13. Public copy and event-fact safeguards during responsive edits

Do not solve mobile crowding by deleting or hiding required public facts. These must remain visible and selectable as text somewhere appropriate on public routes:

- July 25, 2026.
- Free show / no ticket required.
- RSVP or update-list language where relevant.
- Cycle Moore Legacy and address.
- Camping costs only as verified in current canon.
- Parking/access notes only as verified in current canon.
- Loud sound, bright lights, fog, flashing-pattern/strobe-style safety warning.
- Independent tribute disclaimer.

If a text block is too long for mobile, prefer:

1. better wrapping;
2. clearer line breaks;
3. token-level concise wording with the same facts;
4. stacking cards; or
5. moving detail to a nearby accessible expandable/linked route only if the fact remains discoverable.

## 14. Responsive testing matrix

Run the smallest useful set for the change, then expand if layout risk is high.

### Static and syntax checks

```bash
git status --short
git diff --check
find proto -name '*.php' -print0 | xargs -0 -n1 php -l
python3 - <<'PY'
import json, pathlib
for p in sorted(pathlib.Path('proto').rglob('*.json')):
    if any(part in {'language_backups', 'site_layer_control_backups'} for part in p.parts):
        continue
    json.loads(p.read_text())
    print(p)
PY
```

### Local route smoke checks

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
```

### Manual viewport checks

Check these widths at minimum:

| Width | Why it matters |
| --- | --- |
| 320px | Small/older phone stress test. |
| 360px | Common Android narrow width. |
| 390px | Common modern phone width. |
| 414px | Larger phone portrait. |
| 640px | Existing small breakpoint. |
| 760px | Existing header/managed-section breakpoint. |
| 980px | Existing tablet/grid breakpoint. |
| 1180px+ | Desktop/max-width behavior. |

At each width, check:

- Header/nav wrapping.
- Hero headline and CTAs.
- Event-fact chips.
- Section grids.
- Image crops and text contrast.
- Forms and consent rows.
- Shared event footer.
- Fixed mobile CTA.
- No horizontal scrolling on public pages.
- Focus style and keyboard order.

## 15. Common fixes for this codebase

| Symptom | Likely cause | Preferred fix |
| --- | --- | --- |
| Horizontal scroll on phone | Fixed-width child, long token, grid track without `minmax(0, 1fr)`, large logo/nav | Use `minmax(0, 1fr)`, reduce clamp lower bound, add `overflow-wrap: anywhere`, stack layout earlier. |
| Header takes too much vertical space | Nav wrapping plus sticky header | Tune `.site-header` gap/padding, allow static positioning below small breakpoint, avoid JS-only nav. |
| Hero text unreadable over image | Weak scrim or bad mobile crop | Adjust section scrim and `--asset-position`; keep facts as text. |
| Cards too narrow at tablet width | Too many columns remain active | Collapse from 4→2→1 or use `auto-fit`. |
| Buttons overflow | Long token and inline-flex sizing | Allow wrapping container, use full-width mobile button only where needed, shorten token if approved. |
| Filename/URL breaks layout | Unbreakable text | Add `overflow-wrap: anywhere` to `code`, labels, card headings, or generated display text. |
| Form checkbox text crushes | Checkbox grid/flex conflict | Keep checkbox column auto + text column `minmax(0, 1fr)`; stack only if necessary. |
| CMS media cards unusable on phone | Desktop-only grid/control layout | Collapse operation cards, preserve labels/filenames/inputs, allow preview scroll only where needed. |

## 16. Final pre-commit checklist

Before committing a responsive change:

- [ ] Confirm the changed files are in the active `proto/public`, `proto/app`, or `proto/docs` work surface.
- [ ] Confirm no legacy route copies were edited accidentally.
- [ ] Confirm public event facts, safety language, and independent-tribute disclaimer remain visible.
- [ ] Confirm no browser fire/ember/smoke/heat/canvas effect was added.
- [ ] Confirm no framework, bundler, dependency, or build step was introduced.
- [ ] Confirm no generated backup files were added.
- [ ] Run `git diff --check`.
- [ ] Run PHP lint if PHP changed.
- [ ] Validate JSON if JSON changed.
- [ ] Smoke routes if markup/CSS/shared rendering changed.
- [ ] Take/review screenshots for perceptible web-app changes when tooling is available.

## 17. Guiding principle

Mobile responsiveness for `proto/public` should make the same theatrical site easier to read, tap, and trust on smaller screens. Do not dilute the black/chrome/fire identity, do not hide safety or event facts, and do not bypass the existing vanilla PHP, tokenized copy, image inventory, and CMS/page-layer architecture.
