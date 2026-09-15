# `currsite` Visual and Engineering Reference

**Prepared:** 2026-09-14  
**Audience:** expert coding LLMs, designers, front-end engineers, accessibility reviewers, and maintainers  
**Evidence set:** 35 PNG screenshots in repository-root `currsite/`  
**Related implementation:** active public application under `proto/public/`

## 1. Purpose and evidence boundary

This document describes every screenshot in `currsite/`, reconstructs the page sequence, and translates visual observations into implementation guidance. The images are desktop viewport captures of seven pages, not 35 independent creative assets. Adjacent captures overlap vertically and should be interpreted as scroll-position evidence.

The screenshots are a visual baseline, not proof that the current runtime emits byte-for-byte identical pages. The active site is PHP under `proto/public/`; legacy copies also exist directly under `proto/`. When screenshot content, code, JSON language tokens, or documentation disagree, establish which artifact is authoritative before editing.

## 2. Capture-set facts

- Count: **35 PNG files**.
- Width: **2,878 px for every capture**.
- Height range: **1,722–1,789 px**.
- Approximate aspect ratio: **1.61–1.67:1**.
- All images show a desktop layout with a right-side browser scrollbar.
- The small height variations suggest browser viewport or capture-boundary differences rather than different responsive breakpoints.
- Capture filenames encode an ordered session on 2026-09-14; a large timestamp gap between `165116` and `165227` aligns with navigation from the homepage to the Free Show route.
- These are unusually wide, high-density captures. Do not infer CSS pixels or breakpoint behavior directly from PNG pixel dimensions without knowing browser device-pixel ratio and zoom.

### Reconstructed page groups

| Page | Screenshots | Likely active route |
| --- | --- | --- |
| Landing page | `165002`–`165116` | `/` |
| Free Show | `165227`–`165309` | `/july-25-2026/` |
| The Ritual | `165322`–`165400` | `/what-is-just-one-kiss/` |
| Spectacle | `165418`–`165439` | `/spectacle/` |
| Directions | `165449`–`165512` | `/directions/` |
| FAQ | `165521`–`165539` | `/faq-disclaimer/` |
| Contact | `165549`–`165616` | `/contact/` |

## 3. Individual screenshot descriptions

### 3.1 Landing page

1. **`Screenshot 2026-09-14 165002.png`** — Homepage hero with a black navigation bar, angular white Just One KISS logo, gray-white navigation links, and glowing orange-red update button. The hero uses an enormous white “You wanted the best? You got the best!” headline on the left and a full-length demon-style, face-painted bassist in black/silver armor and platform boots on the right. A dark red infernal haze and skull-like arch create an arena-poster composition.

2. **`Screenshot 2026-09-14 165022.png`** — Lower hero and opening event-details content. Yellow pill badges summarize admission and camping, red and dark buttons provide primary actions, and a burgundy quote card reinforces fan motivation. The event-details panel combines large white type, red stage smoke, a poster-like date badge, and a small illustrated performer/fan sticker.

3. **`Screenshot 2026-09-14 165040.png`** — “About the Show” section. Four translucent black cards sit over a red/chrome abstract background beneath “A full-blown KISS experience!!” A large silver-armored, face-painted bassist cutout breaks the right panel boundary, adding depth and poster-like layering.

4. **`Screenshot 2026-09-14 165056.png`** — “Get the July 25 Drop” signup area. The left column overlays copy on a dim control-table/backstage image. The right column is a black form card with email, city/ZIP, expandable interests, consent, and a red-orange gradient submit button. The next stage-based panel begins below.

5. **`Screenshot 2026-09-14 165104.png`** — Centered event-summary CTA over an empty red/amber/green-lit stage with low fog. The multi-line headline states date, free show, venue, and location. The beginning of the Fan Vault appears below.

6. **`Screenshot 2026-09-14 165111.png`** — Fan Vault styled as an equipment-case interface. Six numbered translucent cards advertise free-show information, video posts, fan pictures, tips, Q&A, and chat. The next practical-information panel starts beneath.

7. **`Screenshot 2026-09-14 165116.png`** — Homepage conclusion. Five narrow cards cover admission, location/parking, camping, fog/strobes, and safety. A subdued, two-column footer repeats core event and legal information.

### 3.2 Free Show page

8. **`Screenshot 2026-09-14 165227.png`** — Free Show hero with a huge “July 25, 2026 Free Show” title, short explanatory copy, yellow fact pills, and three actions. Beneath it begins a dramatic image of a lone guitarist silhouetted in a fiery, pointed metallic portal.

9. **`Screenshot 2026-09-14 165240.png`** — Full portal image: a dark, spiked guitarist stands against red-orange smoke inside a symmetrical metal arch. The image reads like a heavy-metal album cover. “The Signal Is Clear” information cards begin below.

10. **`Screenshot 2026-09-14 165250.png`** — Four “Signal” cards summarize the free show, venue, camping, and parking. A new panel introduces “A family-friendly blast with teeth,” balancing intense branding with a highlighted safety warning.

11. **`Screenshot 2026-09-14 165257.png`** — Complete family-friendly expectations panel. A large empty concert rig shows black trusses, red/amber beams, green fog, and a glossy floor. It promises spectacle while preserving the performer reveal.

12. **`Screenshot 2026-09-14 165303.png`** — Update-list signup with oversized stacked headline on the left and polished form card on the right. A smaller image below shows laptop/control equipment, cables, trussing, red light, and green fog.

13. **`Screenshot 2026-09-14 165309.png`** — Closing practical-information panel repeating admission, location/parking, camping, lighting-effects, and safety guidance, followed by the standard footer.

### 3.3 The Ritual page

14. **`Screenshot 2026-09-14 165322.png`** — “What Is Just One KISS?” hero and opening image. A backstage control station contains a DMX console, laptop, lamp, water, phone, notes, road cases, green fog, and three playful KISS-style figurines; one figurine appears to emit sparks.

15. **`Screenshot 2026-09-14 165337.png`** — Closer continuation of the backstage tableau, emphasizing illuminated faders, figurines, cables, and production equipment. “A love letter with a crowd around it” begins below.

16. **`Screenshot 2026-09-14 165346.png`** — Text-led “Love Letter” section with four cards: The Fans, The Songs, The Place, and The Memory. Yellow numeric capsules make the content read as a structured manifesto.

17. **`Screenshot 2026-09-14 165353.png`** — “The vibe is big because the fans made it big first.” A detailed close-up of black leather, chrome piping, buckles, silver studs, and red-lit armor conveys tactile glam-rock luxury and danger without showing a face.

18. **`Screenshot 2026-09-14 165400.png`** — Closing statement: “Not a lecture. Not a reveal sheet. Not homework.” The upper crop retains the costume image; the footer returns to practical venue/camping information.

### 3.4 Spectacle page

19. **`Screenshot 2026-09-14 165418.png`** — “The Spectacle” hero above an empty stage engulfed by red, green, and white fog. Red side trusses, spotlights, reflective flooring, and the absent performer preserve anticipation.

20. **`Screenshot 2026-09-14 165425.png`** — “KISS fans understand over the top.” Three cards cover shared memory, crowd voice, and summer ritual. The next headline reframes the crowd as the true spectacle.

21. **`Screenshot 2026-09-14 165432.png`** — Four cards describe road-trip energy, favorite-song loyalty, pictures with friends, and a night worth retelling. Beneath is a bright black-on-white KISS wordmark filled with rows of marquee bulbs, creating the sharpest tonal break in the set.

22. **`Screenshot 2026-09-14 165439.png`** — “Show Up and Find Out” conclusion with the familiar symmetrical lighting-rig image, red/amber beams, green fog, and standard event footer.

### 3.5 Directions page

23. **`Screenshot 2026-09-14 165449.png`** — Directions hero and a custom mission-control map. US-31 glows red, Interlochen is marked with a target reticle, and a side panel lists dispatch coordinates, address, route vector, and status. Metallic framing and fiery corners turn navigation into event mythology.

24. **`Screenshot 2026-09-14 165455.png`** — Venue-address card paired with a conventional pale embedded street map. The practical map intentionally contrasts with the cinematic custom map. Arrival notes begin below.

25. **`Screenshot 2026-09-14 165504.png`** — “Get there. Park. Camp if you want. And find your people.” Four cards cover road, parking, camping, and updates. The packing-preparation section starts underneath.

26. **`Screenshot 2026-09-14 165512.png`** — “Make it easy on yourself” packing advice above two stacked black-and-silver Just One KISS road cases. The partly open top case emits intense orange light and smoke, turning equipment storage into a theatrical reveal.

### 3.6 FAQ page

27. **`Screenshot 2026-09-14 165521.png`** — FAQ hero with “FAQ and Show Notes,” action buttons, and the glowing road-case image as its main visual anchor.

28. **`Screenshot 2026-09-14 165527.png`** — First FAQ grid. Eight tall cards address admission, location, arrival time, parking, camping, event character, suitability for casual fans, and show expectations.

29. **`Screenshot 2026-09-14 165534.png`** — Second FAQ grid covering chairs/blankets, photography, food/vendors, what to bring, children, changing details, unlisted questions, and the over-the-top presentation. The short-version summary begins below.

30. **`Screenshot 2026-09-14 165539.png`** — Concise event recap over a second custom route map. US-31 runs vertically through a red Interlochen reticle, with dispatch panel, compass, route shields, and flame-like corners.

### 3.7 Contact page

31. **`Screenshot 2026-09-14 165549.png`** — Contact hero paired with the set’s only candid real-world photograph: a gray-haired man in glasses and a colorful KISS shirt poses with tongue out and rock hand signs beside a golf cart at a campground. RVs, grass, trees, and a dirt lane humanize the otherwise cinematic campaign.

32. **`Screenshot 2026-09-14 165555.png`** — “Send the Signal” contact cards for email, phone, Facebook/social, and routing. The update-list form begins below; styling remains consistent through yellow labels, black cards, and red glow.

33. **`Screenshot 2026-09-14 165603.png`** — Lower update form beside a small repeat of the campground portrait. A longer “Ask Before the Amps Wake Up” inquiry section starts beneath.

34. **`Screenshot 2026-09-14 165610.png`** — Full inquiry form. The left column carries headline, routing copy, and a highlighted privacy warning. The right contains fields for identity, organization/location, Facebook, date, city/state, inquiry type, message, consent, and submission.

35. **`Screenshot 2026-09-14 165616.png`** — Contact-page conclusion with a small red/green stage image and bulb-studded KISS wordmark. The standard five-card “Before You Roll In” block and footer close the sequence.

## 4. Overall visual system

### 4.1 Brand vocabulary

The experience is a digital concert poster, fan manifesto, and operational event guide. Its recurring vocabulary is:

- black and near-black page grounds;
- burgundy, ember-red, orange, and occasional purple gradients;
- yellow-gold labels and number capsules;
- bone-white display type and light-gray body text;
- red-to-orange CTA gradients with atmospheric glow;
- chrome, leather, spikes, armor, road cases, trusses, control consoles, flames, fog, and reflective floors;
- cinematic, often symmetrical imagery resembling album covers or stage backdrops;
- rounded cards and panels that temper the aggressive visual material.

### 4.2 Emotional structure

The design alternates between two worlds:

1. **Fantasy/spectacle:** costumed performers, fiery portals, tactical maps, colored fog, glowing cases, and theatrical lighting.
2. **Community/practicality:** admission, camping prices, parking, warnings, maps, forms, contact details, and a candid campground portrait.

That contrast is the core message: an intentionally oversized rock experience grounded in a small, real campground gathering.

### 4.3 Layout grammar

- Sticky-looking black global header with logo left, navigation right, and a high-emphasis update CTA.
- Centered content column with generous black margins.
- Very large uppercase headings, often constrained to several dramatic lines.
- Reusable rounded section shells and bordered black cards.
- Numbered content grids for proof points, instructions, and FAQ material.
- Full-width or near-full-width feature imagery placed between text panels.
- Repeated practical-information block above a two-column footer.

## 5. Implementation correlation

### 5.1 Active runtime

The relevant implementation is a dependency-light, server-rendered PHP site. The correct document root is `proto/public/`; similarly named files directly under `proto/` are legacy copies. The application has no Composer, npm, framework, bundler, or front-end library requirement.

The effective render model is:

```text
PHP route template
  + shared renderer/helpers
  + language.json overrides
  + managed page sections
  + Site Layer Controls output-buffer transformations
  + site.css and site.js
  = browser response
```

This matters when recreating a screenshot: final HTML may be mutated after template output, and visible copy may originate in JSON rather than the literal fallback string in a PHP file.

### 5.2 Route-to-capture mapping

| Capture group | Active template |
| --- | --- |
| Landing | `proto/public/index.php` |
| Free Show | `proto/public/july-25-2026/index.php` |
| The Ritual | `proto/public/what-is-just-one-kiss/index.php` |
| Spectacle | `proto/public/spectacle/index.php` |
| Directions | `proto/public/directions/index.php` |
| FAQ | `proto/public/faq-disclaimer/index.php` |
| Contact | `proto/public/contact/index.php` |

Shared rendering and behavior primarily live in:

- `proto/app/view.php`
- `proto/app/site_data.php`
- `proto/app/language.php`
- `proto/app/page_sections.php`
- `proto/app/layer_runtime.php`
- `proto/public/assets/css/site.css`
- `proto/public/assets/js/site.js`

### 5.3 Approved image assets visible or strongly correlated with the screenshots

| Asset | Visual role inferred from captures |
| --- | --- |
| `trailer-poster-stage-portal.webp` | landing-page performer/portal hero |
| `hero-stage-portal.webp` | lone guitarist inside fiery metallic arch |
| `spectacle-lighting-rig.webp` | empty truss stage with red/amber light and green fog |
| `fog-strobe-atmosphere.webp` | fog-heavy empty stage environment |
| `costume-chrome-detail.webp` | leather/chrome/stud armor close-up or section background |
| `gear-control-dossier.webp` | backstage laptop/DMX/control-table scene |
| `road-case-vault-bg.webp` | glowing branded road cases |
| `interlochen-dispatch-map.webp` | dark red tactical/dispatch map |
| `press-performer-portrait.webp` | contact-related portrait slot; verify current content against screenshot |

Uploaded `layer-upload-*.png` assets also exist. Because Site Layer Controls can change section imagery after route rendering, inspect published/draft layer state before assuming every screenshot image maps directly to a named `.webp` asset.

### 5.4 CSS design tokens

The current stylesheet defines the core palette and layout primitives approximately as follows:

| Token | Value / purpose |
| --- | --- |
| `--black` | `#050505` |
| `--black-2` | `#0d0d10` |
| `--panel` | near-opaque dark panel |
| `--panel-2` | translucent secondary panel |
| `--bone` | `#f2f2ee`, primary light text |
| `--muted` | `#c8c8c2`, secondary text |
| `--chrome` | `#b8bcc2` |
| `--red` | `#b20d18` |
| `--orange` | `#f06a21` |
| `--gold` | `#d8a31a` |
| `--yellow` | `#f2c230` |
| `--purple` | `#6d3fa9` |
| `--max` | `1180px`, principal content maximum |
| `--radius` | `22px` |

Two local OpenType fonts are bundled: `nasty.otf` and `script.otf`. The display system uses `JOK Nasty Logo` with Impact/Haettenschweiler/Arial Narrow fallbacks, while body content uses the system sans-serif stack. Because the custom display face is visually central, font loading failures will substantially change wrapping, section height, and screenshot parity.

### 5.5 Responsive behavior observed in code

- Primary collapse breakpoint: **980 px**, where hero, forms, footer, and event poster become single-column and many grids become two columns.
- Primary mobile breakpoint: **640 px**, where most content grids become single-column.
- Additional component breakpoints occur at 1,180, 1,100, 760, 720, 700, 480, and 360 px.
- The desktop screenshots validate only the wide state. They are not evidence of mobile success.
- Several CSS rules use explicit `min-width` values for tools or specialized controls; test for horizontal overflow rather than presuming all operational UI is mobile-safe.
- Reduced-motion media queries exist, but require behavioral verification.

### 5.6 Client-side behaviors

The shared vanilla JavaScript provides:

- navigation toggle and Escape-to-close behavior;
- event tracking hooks through `data-track`;
- event countdown updates;
- interest-group “check all” synchronization;
- form status messaging;
- inline language-editing tools for authorized contexts;
- hover/pointer treatment for Fan Vault cards.

The screenshots show static states only. They do not validate menu keyboard behavior, countdown rollover, form validation, asynchronous status announcements, editor behavior, hover states, or error states.

## 6. Engineering findings inferred from the visual baseline

### 6.1 Screenshot/source drift risks

The captures repeatedly say parking is **outside the gate**, while at least one legacy template has previously carried contradictory “inside the campground” language. Treat route text, `language.json`, legacy templates, screenshots, and venue truth as separate evidence. Search the whole active dependency chain before changing a fact.

The event date in the screenshots is **July 25, 2026**, while the capture/report date is **September 14, 2026**. The event is already in the past. Before any launch or content refresh, determine whether this is an archival site, a stale prototype, or a template for a future event. Countdown and update-list behavior deserve explicit review.

### 6.2 Accessibility considerations

- The display font is distinctive but difficult to parse in long headings and FAQ questions. Preserve it for short brand statements; consider a more legible face for dense cards and form labels.
- Giant headings create visually strong hierarchy but can produce awkward line breaks, excessive scroll, and clipping at intermediate widths.
- Yellow focus outlines exist in CSS; verify visible keyboard focus on every dark, red, and photographic background.
- Body copy generally has strong light-on-dark contrast, but muted gray text, placeholder text, thin panel borders, and text over imagery should be measured—not judged only by appearance.
- Safety warnings about loud sound, fog, bright light, strobes, and flashing patterns are visually highlighted. Preserve their prominence and ensure the text is available semantically, not baked into images.
- Forms use consent controls and status regions; validate label association, error summaries, focus movement, required-state communication, and screen-reader announcements.
- Embedded maps require useful titles and a non-map textual address/directions alternative.
- Custom imagery needs concise alt text based on its functional purpose. Decorative atmosphere should normally use empty alt text; content-bearing maps and portraits require meaningful alternatives.
- `prefers-reduced-motion` rules exist, but flashing media, animated glow, countdown changes, and any autoplay content must also be reviewed.

### 6.3 Performance considerations

- The 35 evidence PNGs total many tens of megabytes and are documentation artifacts, not suitable production delivery assets.
- Production imagery is WebP, which is appropriate, but verify intrinsic dimensions, compression, responsive `srcset`/`sizes`, and lazy loading below the fold.
- Hero images should prioritize the largest contentful paint without blocking all other rendering. Consider explicit dimensions or aspect ratio to limit layout shift.
- Local fonts should use deliberate preload/subsetting and suitable `font-display`; their failure affects both branding and layout.
- Shared rendering can include external CSS/JS plus inline fallback copies. This can duplicate bytes, apply CSS twice, and initialize JavaScript twice unless guarded. Prefer one intentional production strategy and idempotent initialization.
- Heavy full-section background images plus layered gradients are visually effective but should be profiled on lower-end mobile GPUs.

### 6.4 Layout and maintainability considerations

- The site successfully reuses visual primitives: section shells, proof/fact grids, badges, CTA rows, safety callouts, form cards, and the shared event footer. Preserve and extend these components rather than introducing page-local variants.
- Repeated identical event facts should be sourced from one structured event-data model. Visual repetition is intentional; data duplication is not.
- The wide screenshot state has substantial black gutters and an approximately 1,180 px content rail. Compare using layout geometry and typography, not by scaling screenshot pixels 1:1.
- Performer cutouts that escape panel bounds require careful `overflow`, stacking-context, pointer-event, and mobile-crop handling.
- Background focal points are controlled with CSS custom properties such as asset position, scrim, hotspot, and veil. Use those controls before modifying source images.
- Repeated card grids become monotonous across routes. If evolving the design, preserve identity while varying composition rather than inventing new colors or components.

### 6.5 Forms, privacy, and security

The site is not purely static. It includes lead/update and inquiry forms, CSRF protection, server-side JSON persistence, optional database mirroring, and mail integration. A visual match alone is insufficient.

Before deployment:

- verify POST validation and sanitization;
- protect personally identifiable data in JSON storage;
- ensure storage is outside the public document root and correctly permissioned;
- review mail failure logging for leaked content;
- rate-limit and add abuse controls;
- implement a clear privacy/retention policy;
- consider POST/Redirect/GET to prevent resubmission;
- repopulate safe form fields after validation errors;
- secure or remove admin/editor/layer-control utilities from public exposure;
- configure secure session cookies and standard response security headers.

### 6.6 Legal/content integrity

The screenshots repeatedly identify the project as an independent tribute with no claimed official affiliation. Keep that disclaimer visible and consistent. Do not infer permission to use protected logos, costumes, photographs, likenesses, or generated derivatives merely because they appear in the repository. An asset-rights/provenance review remains distinct from technical implementation.

Venue address, phone, admission terms, camping rates, parking instructions, accessibility information, and safety claims are operational facts. They should be owner-verified and centralized before publication.

## 7. Recommended workflow for a coding LLM

1. Read `proto/README.md`, `proto/docs/website_ssot.md`, and `proto/docs/public_site_expert_engineering_handoff.md`.
2. Confirm that work targets `proto/public/`, not legacy route copies.
3. Identify the screenshot group and active route involved.
4. Trace visible text through the route fallback and `proto/docs/language.json`.
5. Check `page_sections.json` and Site Layer Controls state for post-template inserts or mutations.
6. Check `site_data.php` before adding or renaming an image.
7. Reuse CSS tokens and existing component classes.
8. Verify event facts with the owner before changing operational copy.
9. Run PHP lint and repository validation.
10. Run the local server with `php -S 127.0.0.1:8000 -t proto/public` and exercise all affected routes.
11. Test desktop and responsive states at least around 1,180, 980, 760, 640, 480, and 360 px.
12. Test keyboard navigation, focus, reduced motion, form success/failure, missing assets, and JavaScript-disabled behavior.
13. Capture comparison screenshots for any perceptible UI change.

## 8. Visual regression checklist

For each affected route, compare:

- logo size and header height;
- navigation spacing and CTA glow;
- headline font load, line breaks, and maximum width;
- section-shell width, radius, border, and vertical rhythm;
- correct image, focal position, crop, and scrim strength;
- card column count and equal-height behavior;
- button size, hierarchy, and focus outline;
- body-copy contrast and line length;
- performer cutout stacking and overflow;
- warning/callout prominence;
- embedded map sizing and fallback address;
- form labels, consent rows, validation, and status messages;
- repeated event-information block and footer;
- absence of horizontal overflow at responsive breakpoints.

## 9. Suggested automated and manual checks

```bash
# Syntax
find proto -name '*.php' -type f -print0 | xargs -0 -n1 php -l

# Repository-level validation
python scripts/validate_repository.py
python scripts/validate_website_pipeline.py

# Existing automated tests
python -m unittest discover -s tests

# Local runtime
php -S 127.0.0.1:8000 -t proto/public

# Locate potentially conflicting event facts
rg -n "July 25|parking|camping|11075 US 31|231-276-9091" proto/public proto/app proto/docs
```

Also perform manual browser checks for all seven captured routes plus `/vault/`, `/video/`, and `/technical/`, which are implemented but not represented in this screenshot set.

## 10. Overall assessment

The screenshot set establishes a highly cohesive, memorable visual direction. It treats every component—from a hero image to a parking card—as part of the same theatrical world. The strongest engineering principle to preserve is the contrast between **spectacle** and **usable event information**.

An implementation should not merely reproduce red gradients and an angular font. It should retain semantic hierarchy, truthful centralized facts, accessible warnings and forms, responsive behavior, strong image focal control, and safe operational workflows. The repository already contains most of the necessary primitives; expert work should consolidate authority, eliminate drift, test non-desktop states, and harden the dynamic portions without flattening the campaign’s intentionally oversized personality.
