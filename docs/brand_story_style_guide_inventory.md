# Just One KISS - Brand Story Style Guide Inventory

**Purpose:** Exhaustive seed inventory for a future centralized brand-story style guide document set. This document inventories the current public website look, language, claims, KISS-adjacent ethos, project-specific facts, technical implementation hooks, and guardrails that should be considered when the brand story style guide is created.

**Status:** Inventory only / pre-style-guide source document.

**Timeline classification:** `GEN` / GENERAL / NOT TIMELINE-SPECIFIC.

**Do not treat this as the finished brand story guide.** It is the engineering/development inventory that captures what already works in the current public site so later style-guide documents can preserve the exact approved direction.

**Primary sources reviewed:** user-provided current-site screenshot, `proto/docs/language.json`, `proto/public/index.php`, `proto/public/assets/css/site.css`, `proto/docs/website_ssot.md`, `docs/styleguide.md`, `README.md`, `docs/knowledge.md`, and the broader documentation boot set.

---

## 1. Preserve-Exactly Baseline

The current public site direction is approved as-is by the owner for the purposes of this inventory. Future brand-story work should preserve the following without drifting into a new concept:

1. The current visual styling is the desired look.
2. The current wording in `proto/docs/language.json` is the desired public-copy basis.
3. The current color, typography, section rhythm, card framing, badges, CTA language, and overall theatrical presentation are correct.
4. The site should continue to feel like a dramatic event portal, not a generic local-band page, arts listing, corporate landing page, or neutral brochure.
5. The brand story should explain and codify the current direction rather than redesigning it.
6. Public materials must remain original, rights-aware, safety-aware, fan-facing, and independent-tribute framed.
7. Internal production mechanics can inform the atmosphere, but public copy should not expose private cue timing, owner workflows, or safety-control internals unless a public document explicitly calls for them.

---

## 2. Source-of-Truth Inputs for the Future Guide

### 2.1 Public Language SSOT

`proto/docs/language.json` is the current runtime-backed public language inventory. It includes 422 entries grouped by token, component, canonical text, tone, reuse policy, source occurrences, dependency metadata, and review flags.

Items to extract into the future guide:

- Exact headline patterns.
- Exact CTA patterns.
- Exact verified event fact language.
- Exact disclaimer language.
- Exact safety-warning language.
- Exact form consent and update-list language.
- Exact section naming conventions.
- Exact page-role naming conventions.
- Exact fan-facing vocabulary.
- Utility language that must stay clear and accessible.

### 2.2 Visual Implementation Source

`proto/public/assets/css/site.css` is the current implementation source for:

- Typefaces and fallback font roles.
- CSS custom-property color palette.
- Dark page background system.
- Sticky header and brand mark behavior.
- Hero composition.
- Section shells and rounded framed panels.
- Yellow pill badges and practical fact chips.
- Fire/chrome CTA buttons.
- Card grids and road-case vault cards.
- Form presentation.
- Safety callouts.
- Responsive breakpoints.
- Reduced-motion handling.

### 2.3 Public Website Canon

`proto/docs/website_ssot.md` should inform the future guide's factual guardrails:

- Active public site is `proto/` with `proto/public/` as document root.
- Homepage backgrounds are approved assets.
- Supporting routes intentionally keep placeholder image blocks until generated images are approved.
- Event facts, admission/camping distinction, safety language, forms, and launch blockers must remain controlled.

### 2.4 Root Project Ethos

`README.md`, `docs/knowledge.md`, and `docs/styleguide.md` should inform the future guide's project-level posture:

- Just One KISS is a Gene Simmons tribute theatrical stage event.
- The creative direction is black-first, chrome-second, fire-third, mythic-scale always.
- Every item belongs to a Timeline Moment ID or `GEN`.
- Public copy must stay original and independent-tribute framed.
- Technical show-control details belong in internal docs unless public-facing docs explicitly use them.

---

## 3. Brand Identity Inventory

### 3.1 Core Name and Marking

Include these identity elements:

| Inventory item | Current expression | Guide implication |
| --- | --- | --- |
| Project name | `Just One KISS` | Always preserve capitalization and spacing unless a logo treatment intentionally stylizes it. |
| Header mark line 1 | `Just One` | Two-line compact mark structure is part of the current identity. |
| Header mark line 2 | `KISS` | High-impact display treatment carries the recognizable punch. |
| Home aria label | `Just One KISS home` | Accessibility text should remain plain and non-theatrical. |
| Browser title pattern | `Just One KISS — [page promise]` | Use em-dash title structure for page metadata. |
| Public identity posture | Independent theatrical rock tribute | Do not imply official affiliation, sponsorship, authorization, or endorsement. |

### 3.2 Identity Tension to Preserve

The brand works because it balances these paired forces:

- Tribute energy + original expression.
- Fan devotion + public rights restraint.
- Arena scale + campground/local event facts.
- Mythic threat + family-friendly practical warning language.
- Dangerous-looking stage picture + controlled, safe, reviewed production posture.
- Heavy theatrical copy + clear utility details.
- Loud visual style + accessible forms and route navigation.

### 3.3 One-Sentence Brand Foundation Candidates

These are not final taglines; they are source inventory for a future guide:

- Independent theatrical rock tribute built from fan love, transformation, stage light, chrome, fog, and fire-colored atmosphere.
- One towering Gene Simmons tribute attraction with tight cues, hard light, smoke in the air, and no dead space.
- A free July 25, 2026 Cycle Moore Legacy event that turns a pavilion and campground into a mythic rock-arena ritual.
- A stage takeover, not a polite cover night.

---

## 4. Event Fact Inventory

Future brand-story documents must distinguish immutable/current public facts from mood language.

### 4.1 Current Verified Public Facts

| Fact category | Current language/fact |
| --- | --- |
| Event name | Just One KISS |
| Date | July 25, 2026 |
| Admission | Free show / free admission / no ticket required |
| RSVP | RSVP or update-list signup is appreciated |
| Venue | Cycle Moore Legacy |
| Address | 11075 US 31 South, Interlochen, MI 49643 |
| Area shorthand | Interlochen / US 31 |
| Venue phone in current copy | 231-276-9091 |
| Camping | $10 per night per person for one night before and one night after the show; electric hookup is $35 per person |
| Electric hookup | $35 per person |
| Parking | Outside the gate; overflow and handicap parking available |
| Show environment | Pavilion stage, full lighting, loud music, bright lights, fog, flashing patterns / strobe-style looks |
| Photos/videos | Allowed and encouraged where current route copy says so, with original/approved media guardrails |

### 4.2 Fact Phrasing Patterns to Preserve

- `Free show · July 25, 2026 · Cycle Moore Legacy · Interlochen / US 31`
- `July 25 at Cycle Moore Legacy.`
- `July 25, 2026 in Interlochen on US 31.`
- `The show is free.`
- `No ticket required.`
- `RSVP appreciated.`
- `Camping $10/night/person before/after.`
- `Camping $10/night/person before/after; electric hookup $35/person.`
- `Interlochen on US 31.`
- `Before you roll in...`

### 4.3 Fact Guardrails

The future guide should explicitly prevent:

- Inventing paid-ticket language for show admission.
- Inventing VIP packages, official ticketing, or reserved seating.
- Inventing expanded campground policies beyond the current verified camping distinction.
- Overstating parking control, accessibility promises, traffic control, security, or weather policy.
- Making official KISS, Gene Simmons, venue partnership, sponsor, or authorization claims unless later cleared.

---

## 5. Voice and Copy Inventory

### 5.1 Voice Pillars

| Pillar | Current evidence | Guide use |
| --- | --- | --- |
| Direct fan call | `You wanted the best? You got the best!` | Lead with recognizability, punch, and invitation. |
| Ritual framing | `The Ritual`, `fan fire`, `the crowd keeps the night alive` | Treat attendance as participation, not passive viewing. |
| Stage takeover | `A stage takeover, not a polite cover night.` | Define the show by impact and transformation. |
| Fire/chrome/smoke image bank | `fire-colored light`, `chrome glare`, `smoke curling low` | Use sensory shorthand repeatedly. |
| Practical clarity | `Free show`, `No ticket required`, `Camping $10/night/person before/after` | Keep facts short, visible, and repeated. |
| Rights restraint | `Independent theatrical rock tribute. No outside partnership is claimed or implied.` | Keep disclaimers plain and consistent. |
| Safety visibility | `loud sound, bright lights, fog... flashing lights and patterns` | Safety copy is visible but not panic-driven. |

### 5.2 Approved Tone Modes

Future guide should define these modes:

1. **Hero mode** — huge, declarative, compressed, fan-recognition first.
2. **Ritual mode** — mythic, emotional, fan-love language.
3. **Spectacle mode** — technical capability translated into public-facing excitement.
4. **Utility mode** — clear, concise, factual, accessible.
5. **Safety mode** — direct warnings, no hype that weakens practical clarity.
6. **Disclaimer mode** — plain legal/rights language, not theatrical jokes.
7. **Form mode** — friendly but unambiguous consent, routing, and update-list language.
8. **Footer mode** — compact event summary, independent-tribute disclaimer, safety reminders.

### 5.3 Copy Length and Rhythm

Observed rhythm to preserve:

- Massive 4- to 9-word headline punches.
- Short eyebrow labels in uppercase.
- One-sentence ledes that combine spectacle + fact.
- Practical facts repeated as chips/pills/cards.
- Cards use short title + short body + badge number.
- CTAs are action-oriented and brief.
- Disclaimers are short and direct.
- Safety warnings are one compact paragraph with key hazard terms.

### 5.4 Headline Inventory

Current headline and title patterns that should seed the guide:

- `You wanted the best? You got the best!`
- `July 25 at Cycle Moore Legacy.`
- `A stage takeover, not a polite cover night.`
- `Get the July 25 drop.`
- `July 25, 2026 / Free show / Cycle Moore Legacy / Interlochen on US 31`
- `Open the road case.`
- `Before you roll in...`
- `What Is Just One KISS?`
- `A love letter with volume.`
- `The Spectacle`
- `Built to land, load in, and light the fuse.`
- `Directions`
- `FAQ, Safety, and Practical Info`
- `Before the first chord.`
- `Contact`
- `Send the signal.`
- `Fan Vault`
- `Trailer and Clips`
- `Technical Overview`

### 5.5 CTA Inventory

Current action-language families:

| CTA family | Current examples | Usage note |
| --- | --- | --- |
| Update capture | `Join Updates`, `Get the July 25 drop`, `Join the July 25 update list` | Primary conversion pattern. |
| Directions | `Get directions`, `Open in Google Maps`, `Use the map` | Practical route support. |
| Contact | `Contact the show`, `Chat the show`, `Ask a question`, `Use the contact form`, `Email the show` | Human routing without promising instant reply. |
| Spectacle exploration | `See the spectacle` | Route-to-route exploration. |
| Event detail | `See the free show` | Public event page movement. |
| Form action | `Get the July 25 drop` | Lead form submit language. |

### 5.6 Vocabulary Bank

The future guide should include these current/project-compatible word banks.

#### Core brand words

- Just One KISS
- theatrical rock tribute
- independent theatrical tribute
- Gene Simmons tribute performer
- tribute attraction
- show
- stage performance
- free show
- July 25
- Cycle Moore Legacy
- Interlochen / US 31

#### Spectacle words

- fire
- chrome
- smoke
- fog
- hard light
- bright lights
- flashing patterns
- strobe-style looks
- stage light
- full lighting
- projection
- cue-driven light
- blackouts
- red washes
- gold punches
- fog reveals
- armor shine
- hard shadows
- pavilion stage
- arena-sized

#### Fan/community words

- faithful
- rally
- Fan Vault
- road case
- crowd
- fan posts
- fan media
- photos
- clips
- Q&A
- chats
- arrival tips
- useful crowd notes
- love letter
- fan fire

#### Mythic/impact words

- takeover
- ritual
- transformation
- giant attitude
- mythic rock arena
- thunder
- fire-lit
- chrome-blood
- Demon-scale
- controlled blast
- towering
- no dead space
- hit hard
- light the fuse
- first chord
- first blast

#### Utility words

- free admission
- no ticket required
- RSVP appreciated
- camping separate
- update list
- arrival notes
- parking
- access notes
- safety details
- Facebook event link
- contact
- directions
- location

### 5.7 Words and Phrases to Avoid or Control

Future guide should flag these categories:

- Official-affiliation language unless legally cleared.
- `KISS concert` if it could imply the official band rather than the tribute show.
- `authorized`, `sponsored`, `endorsed`, `official`, unless explicitly negated in disclaimers.
- Exact protected makeup/logo promises in generated-image instructions or public copy.
- Overly bland phrases: `local entertainment`, `nice evening out`, `arts presentation`, `music program`, `cover act`.
- Overly technical internal phrases in public copy: cue IDs, QLC+ internals, owner-admin status, launch blockers, review states.
- Safety guarantees such as `safe for everyone`, `no risk`, `fully accessible` unless verified and approved.
- Unverified logistics such as final schedule, food, campground capacity, weather plans, traffic control, or emergency services.

---

## 6. Visual System Inventory

### 6.1 Color Palette

Current CSS custom properties inventory:

| Token | Hex / value | Brand function |
| --- | --- | --- |
| `--black` | `#050505` | Stage void, leather darkness, page foundation. |
| `--black-2` | `#0d0d10` | Secondary dark panels. |
| `--panel` | `rgba(17, 17, 22, .92)` | Dense card/shell overlay. |
| `--panel-2` | `rgba(24, 24, 31, .78)` | Lighter translucent panel overlay. |
| `--bone` | `#f2f2ee` | Main white text / face-paint contrast. |
| `--muted` | `#c8c8c2` | Body copy on dark fields. |
| `--chrome` | `#b8bcc2` | Metallic borders, dividers, frames. |
| `--chrome-dark` | `#656a72` | Dim hardware depth. |
| `--red` | `#b20d18` | Demon/blood/fire danger energy. |
| `--orange` | `#f06a21` | Pyro heat, CTA flame, motion. |
| `--gold` | `#d8a31a` | Classic grandeur and warmth. |
| `--yellow` | `#f2c230` | Visibility, badges, fact pills, countdowns. |
| `--purple` | `#6d3fa9` | Night fantasy / vault atmosphere. |
| `--line` | `rgba(184, 188, 194, .32)` | Standard chrome line. |
| `--line-hot` | `rgba(240, 106, 33, .72)` | Hover/active hot border. |
| `--glow` | Orange/red multi-shadow | Fire glow and heat aura. |

### 6.2 Color Behavior Rules

- Black is the dominant field.
- Bone white carries display headlines and critical readable text.
- Yellow is used for high-visibility badges, fact chips, countdown energy, and safety accents.
- Red/orange gradients carry CTAs and fire heat.
- Chrome/silver lines frame content like stage hardware.
- Purple appears selectively in atmospheric/vault contexts, not as the core brand color.
- Gradients should feel like stage light, smoke, fire, chrome, or heat; never pastel SaaS gradients.

### 6.3 Typography Inventory

Current CSS font roles:

| Role | Current CSS source | Brand function |
| --- | --- | --- |
| Logo/display custom font | `JOK Nasty Logo` from `nasty.otf` | Brand mark, oversized headline punch. |
| Script/logo source | `JOK Script Logo` from `script.otf` | Available custom logo role. |
| Display fallback | `Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif` | Heavy poster/arena headline feel. |
| Body font | system UI sans stack | Readable utility, forms, body copy. |

Typography behaviors to inventory:

- All major headings uppercase.
- Tight line-height around `.92` or lower for display impact.
- Large clamp-based headings for responsive scale.
- Heavy weights (`900`, `950`) used throughout.
- Eyebrows uppercase with wide tracking.
- CTAs uppercase with heavy weight and letter spacing.
- Utility/body text stays readable and not over-stylized.

### 6.4 Layout and Composition Inventory

Current layout patterns:

- Sticky dark header with compact two-line brand mark and uppercase navigation.
- Hero section with full-screen/min-height impact, large left headline, practical fact chips, CTA row, disclaimer, and right-side promise poster.
- Sequential section-shell rhythm down the page, each framed by rounded corners and chrome/fire borders.
- Major homepage story arc: hero → event details → about/show proof → update form → final CTA → Fan Vault → event information → footer.
- Cards use dark translucent panels, chrome borders, internal shadows, and badge numbers.
- Fact chips use yellow pill style for quick scanning.
- Safety notes use left-border callout styling with yellow emphasis.
- The Fan Vault uses road-case/card-grid language with six relic cards.
- Event information footer uses numbered practical cards.
- Forms are dark panels with strong labels, required-consent framing, and a prominent fire CTA.

### 6.5 Section Inventory from Current Homepage

| Section | Current brand job | Must preserve |
| --- | --- | --- |
| Header | Immediate brand recognition and route access | Logo scale, uppercase nav, Join Updates CTA. |
| Hero | Announce free show and emotional promise | Giant headline, date/venue eyebrow, countdown/facts, disclaimer. |
| Event Details | Ground the spectacle in real logistics | Free vs camping distinction, venue address, fact chips, safety strip. |
| About the Show | Define the theatrical promise | Stage takeover language and four proof cards. |
| Join the Rally | Convert interest to update-list consent | Direct value proposition and clear consent. |
| Final CTA | Repeat core facts with maximum poster energy | July/date/free/venue/Interlochen stack. |
| Fan Vault | Make audience participation feel like road-case culture | Six-card grid, fan media/tips/Q&A/chats. |
| Event Information | Shared practical safety/fact footer | Admission/location/camping/fog-strobes/BYOB cards. |
| Footer | Compact legal/fact/safety close | Independent tribute disclaimer and route facts. |

### 6.6 Image and Atmosphere Inventory

Current image/atmosphere categories to codify:

- Stage portal / trailer poster energy.
- Lighting rig / spectacle background.
- Chrome costume detail / armor texture.
- Gear-control dossier / production-action atmosphere.
- Fog and strobe / final CTA atmosphere.
- Road-case vault / fan archive texture.
- Dark background gradients with red/orange/purple hotspots.
- Smoke and low fog as section atmosphere.
- Stage truss, hard beams, red wash, gold glow.
- No official logos, no exact protected makeup, no unapproved official memorabilia in generated/approved image policy.

---

## 7. Narrative Architecture Inventory

### 7.1 Homepage Story Arc

The future guide should codify this current narrative sequence:

1. **Call the faithful** — the hero opens with an instantly recognizable fan call and core facts.
2. **Prove the event is real** — date, venue, address, free admission, camping, parking, and safety details.
3. **Define the promise** — this is a stage takeover, not a polite cover night.
4. **Show the proof points** — Demon-scale entrance, fire-lit singalong, controlled blast, chrome-blood spectacle.
5. **Capture the crowd** — update-list form framed as joining the rally/getting the drop.
6. **Repeat the poster facts** — date, free show, venue, Interlochen.
7. **Open the fan hub** — Fan Vault gives audience participation a home.
8. **Close with practical info** — admission, location/parking, camping, fog/strobes, BYOB/safety.

### 7.2 Supporting Route Roles

Future guide should inventory route-level story roles:

| Route | Brand-story job |
| --- | --- |
| `/` | Full theatrical landing page and conversion hub. |
| `/july-25-2026/` | Verified free-show fact center. |
| `/what-is-just-one-kiss/` | Ritual/identity explanation from fan love and transformation. |
| `/spectacle/` | Capability and show-package explanation in public-facing language. |
| `/directions/` | Arrival, map, venue, parking, camping, practical route details. |
| `/faq-disclaimer/` | Useful answers, safety, independent tribute disclaimer, practical boundaries. |
| `/contact/` | Human routing for show, safety, access, technical/location, press, Facebook/media, general questions. |
| `/vault/` | Approved media/fan asset posture and road-case archive energy. |
| `/video/` | Original clips/fan-sharing posture and media restrictions. |
| `/technical/` | Location-facing technical overview without exposing internal cue-control details. |

### 7.3 Emotional Arc Words

The future guide should map sections to emotional jobs:

- Hero: recognition, impact, countdown, invitation.
- Event details: trust, clarity, logistics.
- About: transformation, theatrical promise.
- Update form: belonging, preparedness, consent.
- Final CTA: poster-like memory imprint.
- Fan Vault: participation, archive, community.
- Event information: safety, confidence, readiness.

---

## 8. Rights, Tribute, and KISS-Related Guardrail Inventory

### 8.1 Independent Tribute Framing

Current disclaimer language family:

- `Independent theatrical rock tribute. No outside partnership is claimed or implied.`
- `Independent theatrical tribute presentation; no outside partnership is claimed.`
- Similar variants may include no official affiliation, sponsorship, authorization, or endorsement.

The future guide should define one canonical disclaimer family and rules for when each length is used.

### 8.2 KISS-Adjacent but Original Lane

The guide should preserve:

- KISS-inspired theatricality, spectacle, fire, chrome, black, mythic scale.
- Gene Simmons tribute performer focus.
- Demon-adjacent mood: black armor, bat-wing geometry, blood-red accents, smoke, menace, tongue-forward attitude only where safe/original.
- Era mood as inspiration, not a claim to official album/tour/brand use.
- Fan-recognition language used carefully and originally.

### 8.3 Restricted/Review-Required Categories

Future guide should mark these as review-required before public use:

- Official KISS logos or exact wordmark recreation.
- Exact protected face-paint designs.
- Official album art, tour art, merch art, or stage designs.
- Official recordings, official clips, official photos, official memorabilia, or archive material.
- Claims of endorsement, authorization, partnership, sponsorship, or official status.
- Generated images that too closely imitate protected makeup, official logos, album art, named performers, or proprietary staging.
- Phrases that imply the official band is performing.

### 8.4 Safe Inspiration Categories

Future guide can allow these with review:

- Black, chrome, fire, fog, smoke, hard light, stage truss, red/gold wash.
- Original armor textures and road-case textures.
- Original performer photography.
- Generic theatrical rock iconography.
- Original fan-media instructions.
- Public-domain-style poster scale and comic-book drama without copying protected artwork.
- Original copy about fan love, tribute performance, and theatrical spectacle.

---

## 9. Safety and Practical Information Inventory

### 9.1 Current Safety Hazard Language

Hazards consistently named:

- Loud sound.
- Bright lights.
- Fog.
- Flashing lights.
- Flashing patterns.
- Strobe-style looks.
- Sensitive guests should plan accordingly.
- No concessions sold in current footer language.
- BYOB and refreshments language appears with prepare-if-carrying guidance.

### 9.2 Safety Tone Requirements

- Keep safety visible near conversion points and footer/practical info.
- Avoid burying safety in legal copy only.
- Do not dramatize safety warnings so much that they become unclear.
- Do not promise universal safety or accessibility beyond verified details.
- Keep family-friendly warning distinct from guarantees.
- Use practical terms guests understand.

### 9.3 Practical Information Categories for Guide

- Admission.
- RSVP/update list.
- Location.
- Parking.
- Camping.
- Fog/strobes/bright lights/loud sound.
- BYOB/no concessions if current facts remain verified.
- Contact/routing.
- Directions/Google Maps.
- Facebook event link updates.
- Photo/video sharing instructions.
- Accessibility/safety questions routed through contact.

---

## 10. Form, Consent, and Data-Capture Inventory

### 10.1 Update-List Form Brand Role

The update form is not positioned as a sterile newsletter. It is framed as:

- `Join the rally`.
- `Get the July 25 drop.`
- A way to receive arrival notes, schedule reminders, camping/parking notes, safety/access updates, Facebook event link updates, and photo/video sharing instructions.

### 10.2 Consent/Privacy Language Categories

Future guide should preserve plain consent language for:

- Required consent checkbox.
- Optional update topics.
- Honeypot fields hidden from normal users.
- CSRF-backed forms.
- No-spam/safety/access note.
- Inquiry routing.
- No promise of instant replies unless a future notification workflow is approved.

### 10.3 Form Tone Balance

- Labels must be clear: Email, City / ZIP, Name, Organization / location, Category, Message.
- Placeholders are practical: `you@example.com`, `Interlochen, MI`.
- Submit buttons can be theatrical.
- Consent text must not be over-theatrical or ambiguous.

---

## 11. Accessibility and Utility Inventory

Future guide should include accessibility/utility standards derived from current implementation:

- Preserve skip link language: `Skip to content`.
- Preserve aria-label clarity for brand, navigation, facts, event summary, practical details, and forms.
- Keep visible focus styles with yellow outline.
- Keep reduced-motion support for users who request it.
- Keep utility text readable against dark backgrounds.
- Do not sacrifice form clarity to theatrical language.
- Use real text for event facts rather than embedding critical facts in images.
- Keep addresses selectable/readable.
- Use link text that describes actions clearly.

---

## 12. Component-Level Inventory

### 12.1 Header Components

- Brand mark.
- Primary navigation.
- Join Updates CTA.
- Sticky, dark, blurred header.
- Uppercase nav labels.
- Compact mobile wrapping.

### 12.2 Hero Components

- Eyebrow facts line.
- Giant headline.
- Lede.
- Countdown.
- Fact chips.
- CTA row.
- Independent-tribute disclaimer.
- Side poster/promise card.

### 12.3 Section Shell Components

- Rounded dark panels.
- Chrome/fire borders.
- Background images with scrims.
- Hotspot gradients.
- Large uppercase section title.
- Eyebrow label.
- Lede paragraph.

### 12.4 Cards and Badges

- Numbered badges `01`, `02`, etc.
- Yellow/chrome capsule badges.
- Dark translucent cards.
- Short title and body copy.
- Slight hover lift/rotation on relic cards.
- Grid structure: 2-column proof cards, 3-column vault cards on desktop, responsive collapse.

### 12.5 CTA Buttons

- Fire button: red/orange gradient, white text, glow.
- Chrome button: dark/chrome gradient, bone text, chrome border.
- Ghost button: dark utility option.
- Rounded pill shape.
- Uppercase heavy labels.

### 12.6 Practical Fact Chips

- Yellow pill shape.
- Black text.
- Uppercase heavy label.
- Used for free show/no ticket/RSVP/camping and event details.

### 12.7 Safety Callouts

- Left yellow border.
- Dark translucent yellow background.
- Plain text with bold prefix where appropriate.
- Used near event details and forms.

### 12.8 Forms

- Dark panel.
- Uppercase labels.
- Strong required consent block.
- Styled inputs with dark backgrounds and chrome borders.
- Fire submit button.
- Progressive enhancement allowed but not required for core rendering.

### 12.9 Footer/Event Information

- Shared event information card grid.
- Numbered cards.
- Practical categories.
- Footer summary with independent-tribute disclaimer and location/safety facts.

---

## 13. Technical Token Inventory Strategy

The future guide should not manually duplicate every runtime string without a process. Recommended inventory treatment:

1. Treat `proto/docs/language.json` as the canonical string source.
2. Generate guide appendices by component and `text_role` when needed.
3. Preserve token names in guide examples so developers can trace each phrase.
4. Mark whether a string is:
   - brand phrase,
   - event fact,
   - safety warning,
   - rights disclaimer,
   - CTA,
   - form/consent text,
   - accessibility/utility text,
   - route metadata,
   - page heading,
   - card body.
5. Keep repeated event facts synchronized by token, not by hand-copying prose into templates.
6. Regenerate `proto/docs/language_map.md` when `language.json` canonical text changes.

### 13.1 High-Priority Token Families for the Brand Guide

- `landing.hero.*`
- `landing.event.*`
- `landing.about.*`
- `landing.updates.*`
- `landing.final.*`
- `landing.vault.*`
- `landing.event_footer.*`
- `landing.footer.*`
- `pages.ritual.*`
- `pages.spectacle.*`
- `pages.free_show.*`
- `pages.directions.*`
- `pages.faq.*`
- `pages.contact.*`
- `pages.vault.*`
- `pages.video.*`
- `pages.technical.*`
- `landing.form.*`

### 13.2 Token Metadata Worth Preserving

- `classification`.
- `status`.
- `source_scope`.
- `canonical_text`.
- `text_role`.
- `component`.
- `tone`.
- `reuse_policy`.
- `occurrences.file` and `occurrences.line_start`.
- `dependencies.webpages`.
- `review.practical info_safe`.
- `review.safety_related`.
- `review.verified_fact`.
- `review.needs_owner_review`.
- `same_text_tokens`.

---

## 14. Future Brand Story Guide Document Set Candidates

This inventory suggests the future guide may become a document set rather than one large file:

1. **Brand Story Canon** — core story, identity, promise, audience, and emotional arc.
2. **Voice and Copy Guide** — vocabulary, headline patterns, CTA patterns, disclaimers, safety tone, fact rules.
3. **Visual System Guide** — color, typography, layout, imagery, cards, buttons, section rhythm.
4. **Public Facts and Claims Guide** — verified event facts, update workflow, camping/parking/address/safety claims.
5. **Rights and Tribute Guardrails** — KISS-adjacent inspiration vs restricted claims/assets.
6. **Component Language Guide** — per-component tokens, microcopy, forms, footer, accessibility labels.
7. **Image/Media Direction Guide** — approved assets, placeholder policy, generated-image prompt boundaries.
8. **Developer Implementation Guide** — mapping from style guide rules to PHP templates, CSS variables, language tokens, and SSOT docs.
9. **Change-Control Guide** — how to update brand story, language JSON, screenshots, SSOT companions, and launch checklists together.

---

## 15. Open Questions for the Future Guide

These should be resolved when creating the final guide, not in this inventory:

1. Which independent-tribute disclaimer length should be canonical for hero, footer, FAQ, media pages, and metadata?
2. Should `You wanted the best? You got the best!` remain the primary hero headline everywhere or only on the homepage?
3. Which phrases are owner-approved permanent brand phrases versus current page copy that can evolve?
4. Should the future guide define a formal `Demon-scale` language lane and a separate `utility` lane?
5. How should BYOB/no-concessions language be verified and maintained over time?
6. What is the approval workflow for new generated images and route-specific imagery?
7. Which KISS-adjacent words require rights review before being used in paid advertising?
8. Should the future guide include examples of unacceptable copy rewrites?
9. Should future public copy continue saying `outside partnership` or use a fuller `official affiliation, sponsorship, authorization, or endorsement` disclaimer?
10. How often should screenshots be recaptured as visual evidence for the approved look?

---

## 16. Engineering Handoff Notes

When this inventory is later used to create the brand story style guide:

1. Do not overwrite `docs/styleguide.md` without a deliberate migration plan.
2. Consider placing the new guide set under a future `docs/current/` layer if the documentation consolidation plan is accepted.
3. Keep this inventory as evidence of the approved current site look and copy direction.
4. If the final guide adds durable project facts, update the most authoritative source first and then update paired SSOT JSON where applicable.
5. If public copy changes in `proto/docs/language.json`, regenerate or update any human-readable language maps required by the prototype docs.
6. Run JSON validation after language changes.
7. Run PHP syntax checks after template changes.
8. Capture screenshots after perceptible visual changes.
9. Do not silently change public facts, safety warnings, or independent-tribute disclaimers while producing style-guide prose.
