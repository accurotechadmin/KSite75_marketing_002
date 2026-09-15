# Just One KISS — CSS Style Reference Cheat Sheet

Classification: `GEN`
Status: Working reference for site styling changes
Last updated: 2026-07-13

## Purpose

Use this guide when you want to change the look of the active `/proto` public site. The active stylesheet is:

- `proto/public/assets/css/site.css`

The active PHP markup that uses those classes is under:

- `proto/public/index.php`
- `proto/public/*/index.php`
- shared render helpers in `proto/app/view.php`

Do **not** edit legacy top-level route copies under `proto/*.php` or `proto/*/index.php` unless you are intentionally updating legacy/provenance files. The active document root is `proto/public/`.

## Quick rules

1. Start with `proto/public/assets/css/site.css` for styling.
2. If you need to change the HTML structure, find the markup in the active route file or in `proto/app/view.php`.
3. If you need to change text, use `proto/docs/language.json` tokens rather than hard-coded CSS or route edits.
4. If you need to change homepage background images, check `proto/app/site_data.php`, `proto/public/assets/img/`, and the image policy docs before replacing files.
5. Supporting routes should keep visible image placeholders until route-specific images are generated, reviewed, and approved.

## Logo and global typography

### Top-left logo: “Just One” and “KISS”

Files to inspect:

- CSS: `proto/public/assets/css/site.css`
- Header markup: `proto/app/view.php`
- Font file currently used by both logo lines: `proto/public/assets/font/nasty.otf`

Selectors / variables:

- `@font-face` registers the local logo fonts.
- `:root --logo-script` is retained as a logo-font variable, but currently points at the same `nasty.otf` stack.
- `:root --logo-nasty` controls the active font stack for both the “Just One” and “KISS” lines.
- `.presentation-mark span` styles “Just One”.
- `.presentation-mark strong` styles “KISS”.

How to change the font:

```css
:root {
  --logo-script: 'Your Logo Font', Impact, sans-serif;
  --logo-nasty: 'Your Logo Font', Impact, sans-serif;
}
```

If using new local font files, add or update `@font-face` near the top of `site.css` and put the font files in `proto/public/assets/font/`. The current visual request uses `nasty.otf` for both logo lines.

How to change size/color/spacing:

```css
.presentation-mark {
  justify-items: center;
  gap: .18rem;
  text-align: center;
}

.presentation-mark span {
  color: #fff;
  font-family: var(--logo-nasty);
  font-size: clamp(1.78rem, 2.22vw, 2.55rem);
  letter-spacing: .025em;
}

.presentation-mark strong {
  color: #fff;
  font-size: clamp(3.38rem, 4.62vw, 5.2rem);
  letter-spacing: .03em;
}
```

### Page heading font

Files/selectors:

- `proto/public/assets/css/site.css`
- `:root --display`
- `h1, h2, h3`
- Component-specific overrides like `.hero__poster strong`, `.event-ticket strong`, `.relic-card strong`, and `.image-slot strong`

Change `--display` to alter the main blocky headline look across most of the site.

### Body font and normal text

Files/selectors:

- `proto/public/assets/css/site.css`
- `:root --body`
- `body`
- `p`
- `.hero__lede`
- `.section-lede`

Change `--body` for the default UI/body font. Tune paragraph readability with `body`, `p`, `.hero__lede`, and `.section-lede`.

## Global colors, spacing, radius, and glow

File:

- `proto/public/assets/css/site.css`

Primary location:

- `:root`

Important variables:

| Variable | What it affects |
| --- | --- |
| `--black`, `--black-2` | Global dark background base. |
| `--panel`, `--panel-2` | Panel/card backgrounds. |
| `--bone`, `--muted`, `--chrome` | Text and chrome colors. |
| `--red`, `--orange`, `--gold`, `--yellow`, `--purple` | Fire/accent palette. |
| `--line`, `--line-hot` | Borders and hover borders. |
| `--glow` | Shared glow used on CTAs, posters, tickets, and hover states. |
| `--max` | Site content max width. |
| `--radius` | Shared rounded-corner radius. |

Change these first when you want a broad theme adjustment.

## Header and navigation

Files to inspect:

- Markup: `proto/app/view.php`
- Route labels: `proto/app/site_data.php`
- CSS: `proto/public/assets/css/site.css`

Selectors:

- `.site-header` — sticky header shell, padding, background, blur, border.
- `.presentation-mark` — logo layout container.
- `.presentation-mark span` — “Just One”.
- `.presentation-mark strong` — “KISS”.
- `.top-nav` — nav flex layout, uppercase styling, spacing.
- `.top-nav a` — nav link styling.
- `.top-nav .nav-cta` — “Join Updates” header CTA.

To add/remove nav items, edit `site_pages()` in `proto/app/site_data.php` and set each route’s `nav` value. To change nav text, prefer the related language token where one exists.

## Buttons and CTAs

File:

- `proto/public/assets/css/site.css`

Selectors:

- `.button` — base button shape, typography, sizing, hover behavior.
- `.button--fire` — red/orange primary button.
- `.button--chrome` — chrome secondary button.
- `.button--ghost` — low-emphasis dark button.
- `.cta-row`, `.button-row` — flex layout around button groups.
- `.mobile-cta` and `.mobile-cta .button` — fixed mobile bottom CTA.

Common edits:

- Border radius: `.button { border-radius: ... }`
- Height/padding: `.button { min-height: ...; padding: ... }`
- Fire gradient: `.button--fire { background-image: ... }`
- Hover movement: `.button:hover, .button:focus { transform: ... }`

## Homepage hero

Files to inspect:

- Markup: `proto/public/index.php`
- CSS: `proto/public/assets/css/site.css`
- Background image registration: `proto/app/site_data.php`
- Image file: `proto/public/assets/img/trailer-poster-stage-portal.webp`

Selectors:

- `.hero` — large top panel layout, background/scrim, border, shadow, grid.
- `.hero--portal` — homepage-specific background positioning.
- `.hero__copy` — left-column copy width.
- `.hero__lede` — hero intro paragraph.
- `.hero-countdown` — countdown pill.
- `.hero-facts` and `.hero-facts span` — yellow fact chips.
- `.hero__poster` — right-side poster/callout card.
- `.hero__poster strong` — poster headline.
- `.microcopy` — small disclaimer with left border.

Background image flow:

1. `proto/public/index.php` calls `asset_style('trailer-poster-stage-portal.webp')`.
2. `asset_style()` sets CSS variable `--asset-image` inline.
3. `.hero` uses `var(--asset-image)` in its background stack.

## Event details / date card

Files to inspect:

- Markup: `proto/public/index.php` for homepage event section.
- Markup: supporting pages may reuse `.date-card`.
- CSS: `proto/public/assets/css/site.css`

Selectors:

- `.date-card` — outer panel.
- `.event-poster` — two-column layout.
- `.event-ticket` — boxed date/ticket summary.
- `.event-ticket strong` — large date text.
- `.event-ticket span` — ticket fact lines.
- `.coming-next`, `.event-list`, `.coming-next span` — practical detail chips.
- `.safety-strip` — yellow-left-border safety warning.

## Proof cards / about sections

Files to inspect:

- Homepage about markup: `proto/public/index.php`
- Supporting route card markup: route-specific files under `proto/public/*/index.php`
- CSS: `proto/public/assets/css/site.css`

Selectors:

- `.proof-section` — outer proof/about panel.
- `.proof-grid` — card grid.
- `.proof-grid--feature` — two-column featured grid used on homepage.
- `.proof-grid article` — individual card styling.
- `.proof-badge` and `.proof-grid span` — numbered badge styling.
- `.section-lede` — larger intro text.

## Forms: update list and contact/inquiry

Files to inspect:

- Shared form markup: `proto/app/view.php`
- Lead handler: `proto/app/forms/lead_submit.php`
- Inquiry handler: `proto/app/forms/inquiry_submit.php`
- CSS: `proto/public/assets/css/site.css`
- JS enhancement: `proto/public/assets/js/site.js`

Selectors:

- `.form-section` — two-column update-list section shell.
- `.contact-section` — two-column contact form section shell.
- `.site-form` — form panel.
- `label`, `fieldset` — label and field grouping styles.
- `input`, `select`, `textarea` — shared control styles.
- `.optional-topics` — details drawer around update topics.
- `.check-all` — “select all update topics” row.
- `.consent`, `.consent--required` — required consent row.
- `.form-help`, `.form-status` — helper/status text.
- `.hp` — hidden honeypot field; do not make visible.

Important behavior:

- CSS changes only affect appearance.
- Required fields, consent, CSRF, honeypot, and DB behavior live in PHP handlers and should stay intact.
- Checkbox select-all and form status are enhanced by `site.js`.

## Fan Vault cards

Files to inspect:

- Homepage markup: `proto/public/index.php`
- Vault route: `proto/public/vault/index.php`
- CSS: `proto/public/assets/css/site.css`
- JS hover enhancement: `proto/public/assets/js/site.js`

Selectors:

- `.vault-section` — outer vault section.
- `.relic-grid` — six-card grid layout.
- `.relic-card` — individual road-case cards.
- `.relic-card strong` — card title text.
- `.relic-card span` — subtitle/stamp text.
- `.relic-card__stamp` — small numbered capsule.
- `.relic-card:hover`, `.relic-card:focus`, `.relic-card.is-open` — hover/open state.

The six-card homepage layout should remain six cards unless the content model changes.

## Shared Event information footer block

Files to inspect:

- Markup/data: `render_event_information()` in `proto/app/view.php`
- CSS: `proto/public/assets/css/site.css`

Selectors:

- `.event-footer` — outer shared event-info panel.
- `.event-footer__grid` — card grid.
- `.event-footer__card` — individual card.
- `.event-footer__card span` — numbered badge.
- `.event-footer__card h3` — card heading.
- `.event-footer__card p` — card body.

This block is rendered on every public page immediately before the footer.

## Site footer

Files to inspect:

- Markup: `render_footer()` in `proto/app/view.php`
- CSS: `proto/public/assets/css/site.css`

Selectors:

- `.site-footer` — footer shell, border, spacing.
- `.footer-grid` — two-column footer layout.
- `.mobile-cta` — mobile sticky CTA area.

Footer copy is language-tokenized; change copy in `proto/docs/language.json`, not CSS.

## Supporting-page subheroes and placeholders

Files to inspect:

- Route markup: `proto/public/july-25-2026/index.php`, `proto/public/what-is-just-one-kiss/index.php`, `proto/public/spectacle/index.php`, `proto/public/directions/index.php`, `proto/public/faq-disclaimer/index.php`, `proto/public/contact/index.php`, `proto/public/vault/index.php`, `proto/public/video/index.php`, `proto/public/technical/index.php`
- Placeholder helper: `render_image_placeholder()` in `proto/app/view.php`
- CSS: `proto/public/assets/css/site.css`

Selectors:

- `.subhero` — supporting-page hero shell.
- `.image-placeholder` — route-specific image generation placeholder box.
- `.image-placeholder strong` — placeholder filename.
- `.image-placeholder small` — placeholder prompt text.
- `.image-inventory` — approved media plan sections.
- `.media-grid`, `.image-slot`, `.image-slot--placeholder` — media slot grids/cards.

Policy reminder: supporting route images stay as placeholders until approved.

## Directions/map page

Files to inspect:

- Markup: `proto/public/directions/index.php`
- CSS: `proto/public/assets/css/site.css`

Selectors:

- `.map-section` — map/address section shell.
- `.map-frame` — embedded map wrapper.
- `.route-grid` — link/card grid used on route-style sections.

If changing the map embed itself, edit route markup. If changing framing, spacing, or responsive shape, edit CSS.

## FAQ and system/technical grids

Files to inspect:

- FAQ markup: `proto/public/faq-disclaimer/index.php`
- Technical markup: `proto/public/technical/index.php`
- Spectacle markup: `proto/public/spectacle/index.php`
- CSS: `proto/public/assets/css/site.css`

Selectors:

- `.faq-section` — FAQ page panels.
- `.faq-grid` — FAQ card grid.
- `.system-grid` — technical/spectacle system card grid.
- `.system-grid article`, `.faq-grid article` — shared card styling.

## Background image sections

Files to inspect:

- Markup: mostly `proto/public/index.php`
- Helper: `asset_style()` in `proto/app/view.php`
- CSS: `proto/public/assets/css/site.css`
- Image files: `proto/public/assets/img/`

Selectors:

- `.section-with-bg` — generic background-image section shell.
- `.section-with-bg--lights` — event/details background tuning.
- `.section-with-bg--armor` — about/proof background tuning.
- `.section-with-bg--control` — update form background tuning.
- `.section-with-bg--fog` — final CTA background tuning.
- `.section-with-bg--vault` — Fan Vault background tuning.

To change background placement without changing the image, adjust each modifier’s `--asset-position`, `--section-scrim`, `--section-hotspot`, or `--section-veil` variables.

## Responsive layout

File:

- `proto/public/assets/css/site.css`

Selectors / areas:

- `@media (max-width: 980px)` — major grid collapse from desktop to tablet.
- `@media (max-width: 640px)` — mobile one-column layouts and mobile CTA.
- Later mobile refinements around the bottom of the file may override earlier rules.

Check both the early responsive block and later appended responsive refinements when a mobile change does not appear to work.

## Animation and reduced motion

File:

- `proto/public/assets/css/site.css`

Selectors / keyframes:

- `border-shimmer` — varied border glow animation.
- `header-line-shimmer` — header border shimmer.
- `text-glow-pulse` — logo/text glow pulse.
- `page-gradient-drift` — subtle page background drift.
- `@media (prefers-reduced-motion: reduce)` — disables or neutralizes motion for motion-sensitive users.

When adding animations, also update the reduced-motion block.

## JavaScript-enhanced visual states

File:

- `proto/public/assets/js/site.js`

CSS hooks affected by JS:

- `[data-countdown]` updates countdown text.
- `[data-check-group]` and `[data-check-all]` manage update-topic checkbox state.
- `[data-enhance-form]` sets form status text on submit.
- `.relic-card.is-open` is added/removed on pointer hover unless reduced motion is active.
- `.jok-lang-token` and `.jok-lang-toolbar` are used only when the inline language admin is active.

## Language/copy versus CSS

If you want to change words, labels, headings, CTA text, disclaimers, or public facts, do not use CSS. Use:

- Runtime copy: `proto/docs/language.json`
- Human map/reference: `proto/docs/language_map.md`
- Route structure/placement: active route PHP files under `proto/public/`
- Shared header/footer/form text placement: `proto/app/view.php`

After changing `language.json`, regenerate or update `language_map.md` so the map stays aligned.

## Common tasks

### Make the top-left logo bigger

Edit `proto/public/assets/css/site.css`:

```css
.presentation-mark span {
  font-size: clamp(2rem, 2.8vw, 3rem);
}

.presentation-mark strong {
  font-size: clamp(4rem, 5.4vw, 6rem);
}
```

### Change the “Just One” logo font

1. Add the new font file to `proto/public/assets/font/`.
2. Register it near the top of `site.css`:

```css
@font-face {
  font-family: 'My New Logo Font';
  src: url('../font/my-new-logo-font.otf') format('opentype');
  font-weight: 400;
  font-style: normal;
  font-display: swap;
}
```

3. Change the root variable:

```css
:root {
  --logo-script: 'My New Logo Font', Impact, sans-serif;
}
```

### Change the “KISS” logo font

1. Add/register the new heavy font with `@font-face`.
2. Change:

```css
:root {
  --logo-nasty: 'My New Logo Font', Impact, sans-serif;
}
```

### Change all big headings

Edit `--display` in `:root`:

```css
:root {
  --display: 'My Display Font', Impact, sans-serif;
}
```

### Change the red/orange site accent palette

Edit the root color variables:

```css
:root {
  --red: #b20d18;
  --orange: #f06a21;
  --yellow: #f2c230;
  --glow: 0 0 32px rgba(240, 106, 33, .34), 0 0 80px rgba(178, 13, 24, .18);
}
```

### Change homepage background images

1. Put the approved `.webp` in `proto/public/assets/img/`.
2. Register the filename in `image_inventory()` in `proto/app/site_data.php` if it should be part of the approved public image list.
3. Update the relevant `asset_style('filename.webp')` call in `proto/public/index.php`.
4. Tune placement in the matching CSS modifier, for example `.section-with-bg--fog` or `.hero--portal`.

### Change form field appearance

Edit:

```css
.site-form { ... }
label, fieldset { ... }
input, select, textarea { ... }
.consent--required { ... }
```

Do not remove hidden CSRF, honeypot, consent, or required validation fields from the PHP form renderers.
