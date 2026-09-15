# Just One KISS — Bolt-On Image and Animation Location Report

**Purpose:** Inventory whimsical, iconic, and brand-safe decorative image/animation opportunities for the current Just One KISS homepage rendition.

**Status:** Creative implementation planning reference. No production code has been changed by this document.

**Screenshot basis:** Current full-page homepage screenshot reviewed in-session, approximately `768px × 3022px`. Coordinates are approximate visual-center coordinates measured from the screenshot's top-left corner.

**Markup companion:** `docs/just_one_kiss_bolt_on_markup.svg` contains the original numbered coordinate markup board for these same opportunities.

**New visual companions:**

- `docs/website_bolt_on_screenshot_annotated.svg` — screenshot-style homepage markup with every place of interest highlighted and labeled.
- `docs/just_one_kiss_bolt_on_markup_upgraded.svg` — upgraded planning-map version with clearer callouts, larger labels, connector wires, section cues, and small art indicators that match the website coordinates.

**Relevant active implementation:** The current homepage stacks the hero, event details, about/proof, update form, final CTA, Fan Vault, and shared Event Information/footer blocks in `proto/public/index.php`. Shared header, footer, event information, and forms are rendered from `proto/app/view.php`; styling and motion constraints live in `proto/public/assets/css/site.css` and `proto/public/assets/js/site.js`.

## Creative guardrails

1. **Decorative only:** These bolt-ons should be ornamental layers that do not replace event facts, form labels, safety warnings, or navigation.
2. **Rights-safe:** Use original creatures, props, silhouettes, stage hardware, smoke, chrome, fire, road-case motifs, and cartoon theatrical-rock energy. Do not use official KISS logos, exact protected makeup designs, album art, official photography, or any partnership implication.
3. **Readable first:** Decorative art must not reduce contrast on headings, form fields, CTA buttons, safety strips, or practical facts.
4. **Reduced motion:** Any animation must respect `prefers-reduced-motion: reduce` and degrade to a still image.
5. **Pointer safety:** Most decorative layers should be `pointer-events: none` and `aria-hidden="true"` unless deliberately interactive.
6. **Build approach:** Favor absolutely positioned bolt-on elements inside existing section wrappers, not baked-in text-bearing raster art.

## Coordinate key

| Marker | Short name | Section | Approx. coordinate |
| --- | --- | --- | --- |
| 01 | Header logo gremlin | Header | `x=72, y=44` |
| 02 | Bat-wing portal creature | Hero | `x=560, y=145` |
| 03 | Headline spark bursts | Hero | `x=110, y=116` |
| 04 | Countdown fuse/bomb | Hero | `x=230, y=438` |
| 05 | Poster-card peek creature | Hero | `x=625, y=445` |
| 06 | Falling road case | Event details | `x=585, y=705` |
| 07 | Camper/van on parking pills | Event details | `x=520, y=980` |
| 08 | Fog goblin from safety strip | Event details | `x=610, y=1045` |
| 09 | Chrome hand on about panel | About | `x=96, y=1160` |
| 10 | Mascot between proof cards | About | `x=386, y=1390` |
| 11 | Falling guitar pick | Updates | `x=530, y=1518` |
| 12 | Email input gremlin | Updates | `x=645, y=1595` |
| 13 | Update drawer monster | Updates | `x=520, y=1710` |
| 14 | Stage-light bats | Final CTA | `x=384, y=1880` |
| 15 | Pyro dragon | Final CTA | `x=545, y=2035` |
| 16 | Road-case mimic | Fan Vault | `x=560, y=2450` |
| 17 | Spilling fan Polaroids | Fan Vault | `x=150, y=2420` |
| 18 | Earplug safety mascot | Event Information | `x=690, y=2870` |
| 19 | Camping tent icon | Event Information | `x=384, y=2915` |
| 20 | Footer roadie rat | Footer | `x=620, y=3005` |


## Plain image creation list

These are the new decorative character/prop images to create. Keep every piece original and rights-safe: use dark theatrical-rock archetypes inspired by the Demon, Starchild, Spaceman, and Catman energy, but do not copy official makeup, logos, costumes, album art, or photography. Each image should feel playful but dastardly dangerous, wild and volatile, and still disciplined enough to belong naturally in its exact website location.

1. Header logo gremlin — A tiny Demon-roadie imp with chrome cable horns, yellow ember eyes, and a stolen laminate badge, perched on the wordmark as if the header has always been its lookout post.
2. Bat-wing portal creature — A Spaceman-adjacent shard phantom with folded bat wings, meteor-burn armor, and red rim light, half-emerging from the hero portal while the chrome around it bends in recognition.
3. Headline spark bursts — Starchild welding sprites shaped like mischievous star-flare fireflies, biting tiny sparks off the hero headline and leaving scorch freckles on nearby letter edges.
4. Countdown fuse bomb — A disciplined Catman pyrotechnic goblin hugging a stage-safe countdown fuse, tail wrapped around the timer, grinning like it knows exactly when the cue lands.
5. Poster-card peek creature — A Demon/Starchild hybrid peeker with lacquer claws and one glittering star eye, holding the poster card up from behind with suspiciously calm backstage confidence.
6. Falling road case — A Spaceman road-case mimic tumbling in from orbit, dented chrome corners glowing, with tiny teeth in the latch line and dust that recoils from it.
7. Camper van on parking pills — A Catman-driven micro camper with whisker headlights, flame decals, and drumstick roof racks, cruising across the info pills like the campground is its private runway.
8. Fog goblin safety mascot — A smoke-bodied Starchild safety sprite offering earplugs from velvet claws, smiling sweetly while the fog curls away as if saluting.
9. Chrome hand on about panel — A Demon-inspired armored glove gripping the panel edge, black leather knuckles and molten chrome nails flexing like the section itself has been seized.
10. Mascot between proof cards — A tiny Spaceman stage marshal with a cue sheet, miniature spotlight, and gravity-defying boots, calmly directing attention between the cards.
11. Falling guitar pick — An oversized Starchild meteor pick, red-orange and scorch-marked, landing beside the form with a souvenir-booth wink and a crater-shaped glow.
12. Email input gremlin — A Catman keyboard gremlin crouched by the email field, whiskers made of fiber-optic cable, guarding the form like it is backstage credentials.
13. Update drawer monster — A Demon drawer-beast with accordion-fold wings and receipt-paper fangs, peeking from the update drawer as if it organizes every secret.
14. Stage-light bats — Four persona-variant bat silhouettes, one Demon, one Starchild, one Spaceman, one Catman, hanging in the final CTA beams like disciplined aerial roadies.
15. Pyro dragon — A Demon/Spaceman chrome fire dragon coiled behind the CTA headline, breathing controlled stage flame while every truss bolt leans away from it.
16. Road-case mimic — A Catman road-case creature with velvet-black fur in the seams, chrome latch eyes, and a lazy predator grin, pretending to be normal Fan Vault gear.
17. Spilling fan Polaroids — Starchild ghost-photo imps escaping from Polaroids, each image corner curling as the little fame-hungry creatures pose mid-spill.
18. Earplug safety mascot — A Spaceman safety bat with oversized earplugs, tiny hazard-stripe cape, and a clipboard, looking absurdly official while standing on the Yard and Safe card.
19. Camping tent icon — A Demon camp-tent familiar with glowing zipper teeth and tiny smoke horns, planted on the Camping card like a haunted pavilion mascot.
20. Footer roadie rat — A Catman/Demon roadie rat dragging a coiled cable twice its size, wearing a cracked headset and acting like footer cleanup is sacred stagecraft.

## Detailed opportunity inventory

### 01 — Header Logo Gremlin

**Placement:** Top-left header, perched near the stacked Just One KISS brand mark.
**Approx. coordinate:** `x=72, y=44`
**Suggested asset type:** Tiny transparent PNG/WebP creature, or CSS/SVG micro-character.

A small black-and-chrome roadie gremlin can perch on the logo like it has been living in the amp rack since load-in. It might have bright yellow eyes, tiny chrome shoulder spikes, a coiled cable over one shoulder, and one hand gripping the edge of the wordmark. The creature should be small enough to feel like a discovery rather than a mascot takeover.

**Animation concept:** A slow blink every few seconds, a tiny cable twitch, or a single tail flick. Keep this subtle because the header is global and always visible.

**Implementation notes:** Place as an absolutely positioned decorative child of the header or brand mark. Keep it `aria-hidden="true"`. Avoid moving the header height or shifting navigation.

**Best use:** Adds personality immediately, before the hero even starts.

---

### 02 — Bat-Wing Portal Creature

**Placement:** Upper-right hero, tucked into the chrome portal/shard background.
**Approx. coordinate:** `x=560, y=145`
**Suggested asset type:** Dark semi-transparent silhouette or low-opacity WebP overlay.

The hero already feels like a doorway into a theatrical-rock underworld. A bat-winged chrome creature half-hidden behind the portal would make the background feel alive. It should be mostly silhouette, with only red rim light and chrome accents catching the eye. The viewer should wonder whether it is a creature, a stage prop, or just the metal portal moving.

**Animation concept:** Very slow parallax drift on scroll, a one-time wing twitch, or a faint ember glow around the edge. Do not flap continuously; that would compete with the headline.

**Implementation notes:** This belongs behind text but above or blended with the hero background. Use low opacity and preserve headline contrast.

**Best use:** Turns the hero background from static poster art into a lurking show-world entrance.

---

### 03 — Headline Spark Bursts

**Placement:** Left/top edges of the giant hero headline.
**Approx. coordinate:** `x=110, y=116`
**Suggested asset type:** CSS particle pseudo-elements, short Lottie-style effect, or tiny transparent spark sprites.

The headline feels stamped into the page like a hot-metal concert poster. Small sparks could spit from the corners of letters as though the typography is being welded into the screen. These should be tiny and intermittent, not a constant glitter effect.

**Animation concept:** Randomized 1-second spark flicker every 8–15 seconds, with sparks moving only a few pixels before fading.

**Implementation notes:** A CSS-only implementation may be enough: a few absolutely positioned pseudo-elements with box-shadow glows. Respect reduced motion by freezing sparks into a static ember dot.

**Best use:** Adds energy to the most important brand statement without adding new character art.

---

### 04 — Countdown Fuse / Cartoon Bomb

**Placement:** Next to or slightly underneath the hero countdown pill.
**Approx. coordinate:** `x=230, y=438`
**Suggested asset type:** Small animated prop sprite.

The live countdown is already the most dynamic functional element in the hero. A sizzling fuse, tiny alarm clock, or cartoon stage-safe “pyro timer” could make the countdown feel like it is physically ticking toward the event. This should read as theatrical and playful, not threatening.

**Animation concept:** A little fuse spark travels along a short cord and resets. Alternatively, a tiny clock hand ticks while the countdown text updates.

**Implementation notes:** Because the countdown is controlled by JavaScript, this decorative prop should not change the countdown logic. It can sit next to the countdown element and animate independently.

**Best use:** Strong first-pass candidate because it enhances an existing live element.

---

### 05 — Poster-Card Peek Creature

**Placement:** Right edge or lower edge of the hero poster card.
**Approx. coordinate:** `x=625, y=445`
**Suggested asset type:** Transparent character cutout.

A little demon-roadie or chrome goblin could peek from behind the poster card, as if it is holding the card up from backstage. Only the eyes, fingers, and maybe a tiny horn or headset should show. It should feel like a hidden Easter egg: funny, not distracting.

**Animation concept:** Peek out on hover, blink twice, then duck back behind the card. For non-hover devices, trigger once after page load or on scroll into view.

**Implementation notes:** The card already reads as a layered object, making it ideal for a behind-the-card gag. Clip with overflow if needed so the creature appears to emerge from behind the panel.

**Best use:** Adds a memorable character moment right inside the hero composition.

---

### 06 — Falling Road Case Crash

**Placement:** Above or on top of the event ticket card.
**Approx. coordinate:** `x=585, y=705`
**Suggested asset type:** Road-case prop cutout plus dust puff.

A tiny touring road case could fall from the ceiling and land crooked on the event ticket summary. It should feel like a backstage prop got dropped into the page. Chrome latches, red glow leaking from the seams, and a small cartoon dust puff would make the gag readable.

**Animation concept:** Scroll-triggered drop: case enters from above, squashes/bounces once, then settles at a slight angle. Optional dust puff fades quickly.

**Implementation notes:** Avoid covering ticket facts. The case can land on the top-right corner or partly behind the ticket border. Provide a still settled state for reduced-motion users.

**Best use:** Great for adding a physical comedy beat to the practical event-details section.

---

### 07 — Tiny Camper / Van on Parking Pills

**Placement:** Across the event practical fact pills, especially the parking/camping row.
**Approx. coordinate:** `x=520, y=980`
**Suggested asset type:** Small vehicle sprite.

A tiny camper van, motorcycle, or golf cart could drive across the yellow practical-info pills. It might have a little flame decal, chrome wheels, and a puff of cartoon exhaust. This ties directly to Interlochen arrival, camping, and grass parking.

**Animation concept:** A slow drive-by from left to right when the event details section scrolls into view. Let it exit and remain gone to avoid looping distraction.

**Implementation notes:** Keep the vehicle above the pill row but below surrounding body copy. Do not cover important text for more than a split second.

**Best use:** Turns practical parking/camping information into a memorable visual beat.

---

### 08 — Fog Goblin From Safety Strip

**Placement:** Event safety warning strip.
**Approx. coordinate:** `x=610, y=1045`
**Suggested asset type:** Semi-transparent smoke creature or CSS fog puff.

A small fog goblin can rise out of the safety strip holding tiny earplugs or sunglasses. The purpose is to make the warning feel friendly while still keeping the safety message visible and serious. The goblin should be made of smoke, with yellow eyes and a harmless grin.

**Animation concept:** Slow smoke puff rise, blink, then dissolve. Could repeat rarely, but should not loop constantly near safety text.

**Implementation notes:** The safety strip is important public information. Any creature must stay to the side or behind a translucent layer, never over the actual wording.

**Best use:** Makes safety feel approachable and on-brand.

---

### 09 — Chrome Demon-Hand on About Panel

**Placement:** Left edge of the About section panel.
**Approx. coordinate:** `x=96, y=1160`
**Suggested asset type:** Large partial prop cutout.

A chrome-gloved theatrical hand could grip the left edge of the About panel, as if the show creature is pulling itself out of the background. It should be more prop than monster: armor plates, black leather texture, chrome highlights, red rim light, and cartoon exaggeration.

**Animation concept:** Finger tap or slow flex. Keep movement subtle because this section contains important explanatory copy.

**Implementation notes:** Use the panel edge as a mask. The hand should visually sit behind the content frame while fingers overlap the border.

**Best use:** Reinforces the “stage takeover” story with a physical, theatrical gesture.

---

### 10 — Mascot Between Proof Cards

**Placement:** Center gap between the four proof cards.
**Approx. coordinate:** `x=386, y=1390`
**Suggested asset type:** Small character or spotlight prop.

A tiny mascot could pop up between the proof cards, holding a miniature spotlight, flame, or cue sheet. The character acts like the unofficial master of ceremonies for the proof grid, pointing viewers toward the cards.

**Animation concept:** Pop up on section hover or scroll into view, look left and right, then freeze.

**Implementation notes:** This works best if the mascot stays in the gutters between cards. Do not cover card titles or body text.

**Best use:** Adds a playful surprise to a dense information grid.

---

### 11 — Falling Guitar Pick on Update Form

**Placement:** Above the right-side update form card.
**Approx. coordinate:** `x=530, y=1518`
**Suggested asset type:** Oversized guitar pick prop.

A giant orange/red guitar pick could drop from above and land against the form card like a thrown souvenir from the stage. It might be blank, or carry a simple original lightning/scorch mark with no protected logo. This should direct attention toward the signup form.

**Animation concept:** Drop, bounce, rotate slightly, then settle. A tiny spark can pop at impact.

**Implementation notes:** Do not place readable text on the pick unless it is original and short. The prop must not obscure the email field or submit button.

**Best use:** Strong conversion-support animation for the lead form.

---

### 12 — Email Input Gremlin

**Placement:** Right edge of the email input.
**Approx. coordinate:** `x=645, y=1595`
**Suggested asset type:** Tiny mail/envelope creature.

A small email gremlin could peek out of the email input field, clutching an envelope with a red wax seal or tiny stage pass. It should be charming and restrained, since form clarity matters.

**Animation concept:** On input focus, the gremlin ducks away or stamps a tiny spark. On blur, it peeks back out.

**Implementation notes:** This one can be tied to form focus events, but the field must remain fully usable. Keep all focus outlines and labels intact.

**Best use:** Adds delight at the exact moment of user interaction.

---

### 13 — Update Drawer Monster

**Placement:** Inside or behind the “Open the update drawer” details summary.
**Approx. coordinate:** `x=520, y=1710`
**Suggested asset type:** Small hidden monster revealed when the drawer opens.

The wording “update drawer” practically begs for a little monster hiding inside it. When opened, a friendly drawer creature could rise holding tiny labels for event updates, directions, media drops, and Fan Vault chats.

**Animation concept:** The creature pops up when the `<details>` element opens. It ducks down when closed.

**Implementation notes:** This is one of the most natural interactive bolt-ons because it maps directly to an existing UI state. It should be hidden from assistive tech and never interfere with checkbox labels.

**Best use:** Highest-value whimsical interaction candidate.

---

### 14 — Stage-Light Bats Above Final CTA

**Placement:** Top of the Final CTA stage panel.
**Approx. coordinate:** `x=384, y=1880`
**Suggested asset type:** Small silhouette swarm or CSS pseudo-element group.

A few tiny bat-like silhouettes or spotlight moths could drift through the upper part of the final CTA. They should read as stage atmosphere, not Halloween decoration. Their scale should be small against the big truss/stage background.

**Animation concept:** Very slow left-to-right drift with slight vertical bobbing. Disable fully for reduced-motion users.

**Implementation notes:** Keep above the headline and avoid crossing large text. Use low opacity and mix with the background haze.

**Best use:** Adds motion to a big open poster section without introducing a focal character.

---

### 15 — Pyro Dragon Behind Final CTA Headline

**Placement:** Behind the large final CTA date/location headline.
**Approx. coordinate:** `x=545, y=2035`
**Suggested asset type:** Semi-transparent dragon/smoke cutout.

A little pyro dragon could curl behind the final CTA text, breathing a tiny flame that becomes part of the red/orange background glow. It should be whimsical, compact, and subordinate to the words “July 25, 2026,” “Free Show,” and “Cycle Moore Legacy.”

**Animation concept:** Tiny flame puff every 10–20 seconds, plus a faint tail glow. Avoid constant fire loops near text.

**Implementation notes:** The dragon should sit behind text with a dark scrim ensuring contrast. In reduced motion, freeze at a non-flame frame.

**Best use:** Makes the final rally feel mythic and playful.

---

### 16 — Road-Case Mimic in Fan Vault

**Placement:** Fan Vault card grid, especially right-side cards.
**Approx. coordinate:** `x=560, y=2450`
**Suggested asset type:** Card-face decorative state or small overlay.

One Fan Vault card could act like a road-case mimic: chrome latch eyes, a tiny mouth seam, and a mischievous expression hidden in the road-case texture. It should look like the Vault itself is alive.

**Animation concept:** On hover, the latch-eyes blink and the card lifts a little more than the others. On touch devices, a one-time blink when scrolled into view.

**Implementation notes:** This can build on the existing `.relic-card:hover` behavior. Avoid making every card animated; one mimic is fun, six mimics is noisy.

**Best use:** Perfect thematic match for the Fan Vault concept.

---

### 17 — Fan Polaroids Spilling From Vault

**Placement:** Left/top edge of Fan Vault, near heading and intro copy.
**Approx. coordinate:** `x=150, y=2420`
**Suggested asset type:** Stack of blank/original photo cards.

A few original blank Polaroid-style cards could spill from behind the Vault heading. They should not contain real fan images yet unless approved; instead use abstract stage light, smoke, or tiny unreadable silhouettes.

**Animation concept:** On scroll, the top photo slides out slightly, rotates 3 degrees, and settles.

**Implementation notes:** Keep the photos decorative and rights-safe. No official media, no identifiable people, no readable platform UI.

**Best use:** Visually explains that the Vault is for fan media, posts, and photos.

---

### 18 — Earplug Safety Mascot

**Placement:** Event Information block, near the safety/fog/strobe side.
**Approx. coordinate:** `x=690, y=2870`
**Suggested asset type:** Small safety character.

A little safety mascot wearing oversized earplugs and sunglasses could stand near the practical info cards. It should be funny but useful: it visually reinforces that loud sound and bright lights are part of the event.

**Animation concept:** Thumbs-up, earplug wiggle, or tiny flashlight blink.

**Implementation notes:** Keep it outside card text. If implemented as a character, give it a still fallback and ensure it does not make the safety information feel optional or unserious.

**Best use:** Friendly safety reinforcement near the bottom facts.

---

### 19 — Camping Tent Icon

**Placement:** Event Information Camping card.
**Approx. coordinate:** `x=384, y=2915`
**Suggested asset type:** Small icon/prop.

A tiny black tent with a yellow fire glow could sit in or near the Camping card. It can make the camping cost distinction easier to scan and more visually memorable.

**Animation concept:** Tiny campfire flicker only. This can also be a static icon.

**Implementation notes:** This could be implemented as a simple CSS/SVG icon rather than a raster image. Keep it small enough that the camping text remains primary.

**Best use:** A practical icon that also fits the campground show story.

---

### 20 — Footer Roadie Rat

**Placement:** Footer bottom/right edge.
**Approx. coordinate:** `x=620, y=3005`
**Suggested asset type:** Tiny creature/prop animation.

A tiny backstage rat or miniature roadie could carry a cable across the footer. This is a reward for people who scroll to the bottom: a final wink from the show world after the practical facts are complete.

**Animation concept:** Slow crawl from right to left once per page load, dragging a cable that trails behind.

**Implementation notes:** Keep the footer text readable and avoid looping forever. This can be disabled entirely on mobile if space is tight.

**Best use:** Low-risk Easter egg with strong personality.

## Recommended first build batch

If we choose a first implementation pass, prioritize locations that are thematically strong and technically low-risk:

1. **04 — Countdown fuse/bomb:** best match for existing dynamic countdown.
2. **05 — Poster-card peek creature:** best hero personality moment.
3. **13 — Update drawer monster:** best interactive gag because it maps to an existing details drawer.
4. **16 — Road-case mimic:** best Fan Vault-specific idea.
5. **18 — Earplug safety mascot:** best safety-friendly public-information reinforcement.

## Suggested code pattern for future implementation

Use decorative spans or images inside existing section wrappers:

```html
<span class="bolt-on bolt-on--countdown-fuse" aria-hidden="true"></span>
```

Suggested base CSS:

```css
.bolt-on {
  position: absolute;
  display: block;
  pointer-events: none;
  z-index: 2;
}

@media (prefers-reduced-motion: reduce) {
  .bolt-on,
  .bolt-on::before,
  .bolt-on::after {
    animation: none !important;
    transition: none !important;
  }
}
```

This keeps the decorations modular, removable, and accessible while preserving the existing layout and public information hierarchy.
