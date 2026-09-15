# Just One KISS — Website Style / Look / Feel SSOT Report

**Document purpose:** A controlled, plain-language synthesis of what the current public website makes a visitor see, feel, experience, enjoy, and remember. It is intended to seed a future “marketing menu of SSOT material options” across web, social, print, direct mail, postcards, magazine advertising, billboards, landing pages, mobile products, games, and merchandise.

**Classification:** `GEN` / GENERAL / NOT TIMELINE-SPECIFIC  
**Report status:** Current-source synthesis for owner and marketing review  
**Prepared:** 2026-09-11  
**Scope:** Public brand experience and its safe translation into public-facing assets  
**Authority note:** This report consolidates existing controlled and runtime-backed sources; it does not independently approve a new claim, image, event fact, affiliation, right, or safety promise.

---

## Contents

1. Executive brand experience
2. How to use this report
3. Repository study and authority findings
4. The experience in one sentence, one paragraph, and one page
5. What a visitor sees
6. What a visitor feels
7. What a visitor experiences
8. What a visitor enjoys
9. What a visitor remembers
10. Brand character and productive tensions
11. Visual world
12. Typography, composition, and interface behavior
13. Imagery and art direction
14. Voice, vocabulary, and sentence music
15. Story architecture and emotional pacing
16. Audience relationships
17. Sensory and material vocabulary
18. Signature brand devices
19. Consistency rules: invariants and variables
20. Translation by marketing format
21. Marketing-option families
22. Copy construction kit
23. Visual construction kit
24. Accessibility, clarity, rights, and safety guardrails
25. Anti-patterns and drift tests
26. Review scorecard
27. SSOT operating model and change control
28. Source ledger
29. Final brand memory statement

---

# 1. Executive Brand Experience

## 1.1 The shortest faithful description

**Just One KISS feels like the doors to a compact arena opening inside a dark pavilion: black stage void, chrome armor, red-and-gold heat, smoke, hard light, a towering central presence, a call to the faithful, and a clear invitation to join one free, specific, real night.**

The public presentation is not merely “rock themed.” It is a theatrical event portal. It takes the emotional scale of an arena ritual and makes it feel close enough to attend, photograph, talk about, and remember. It promises transformation rather than imitation, participation rather than passive viewing, and disciplined spectacle rather than casual bar-band drift.

## 1.2 The governing creative formula

> **Black first. Chrome second. Fire third. Mythic scale always. Ordinary never.**

This formula controls more than color:

- **Black first** means mystery, stage depth, anticipation, leather, silhouette, and enough darkness for every highlight to strike.
- **Chrome second** means hardware, armor, craft, touring credibility, sharpness, collectibility, and reflected light.
- **Fire third** means urgency, arrival, action, crowd heat, danger-looking spectacle, and conversion energy.
- **Mythic scale always** means a local visitor should feel invited to something larger than a listing, a flyer, or a routine night out.
- **Ordinary never** means every expressive choice should earn its place in the theatrical world while utility information remains exceptionally clear.

## 1.3 The lasting promise

The brand promises a **“you had to be there” rock spectacle** built around a Gene Simmons tribute performer, original theatrical expression, show-control discipline, and fan love. The public should anticipate a Demon-scale entrance, hard shadows, smoke, chrome glare, fire-colored light, big chorus energy, and a stage picture that appears dangerous while remaining controlled behind the scenes.

## 1.4 The intended aftertaste

After leaving the page, a visitor should retain five things:

1. **The name:** Just One KISS.
2. **The silhouette:** a central black-armored figure framed by a monumental chrome portal and fire.
3. **The sensation:** smoke, heat, hard light, noise, and arena-sized anticipation.
4. **The invitation:** one night; join the rally; the crowd completes the ritual.
5. **The practical confidence:** the event is real, the essential facts are findable, and warnings are plainly stated.

---

# 2. How to Use This Report

This report is a **brand-story seed and translation reference**, not a license to copy every website element into every asset. Use it to choose a consistent combination of story, mood, visual ingredients, voice, proof, practical information, and call to action.

Every public piece should answer:

1. **What is this?** An independent theatrical rock tribute centered on a Gene Simmons tribute performance.
2. **Why does it matter?** It brings arena-scaled spectacle, transformation, and communal fan energy close.
3. **What does it feel like?** Black, chrome, fire, smoke, hard light, ritual, impact.
4. **What should I do?** Attend, get details, watch, join updates, share, or inquire for booking.
5. **What must I know?** Only verified event, access, safety, rights, and contact facts appropriate to that placement.

Do not treat all details as equally portable. The emotional system is durable. Event facts can change. Rights clearance is asset-specific. Safety language is placement-specific. Runtime copy tokens are more authoritative for exact current website language than paraphrases in this report.

---

# 3. Repository Study and Authority Findings

## 3.1 Study scope

The repository-wide review covered the full tracked working tree: 834 non-Git files spanning 395 JSON records, 210 PHP files, 157 Markdown documents, plus CSS, JavaScript, image assets, fonts, SVGs, PDFs, DOCX sources, scripts, tests, and multiple prototype or owner-facing renditions.

The review separated four kinds of material:

- **Controlled/domain authority:** documents that explicitly govern public style, source precedence, or website canon.
- **Runtime-backed current evidence:** active PHP templates, language tokens, CSS, images, shared renderers, and current routes.
- **Supporting synthesis:** inventories, implementation guides, plans, and campaign briefs that explain or translate the canon.
- **Non-authoritative or inactive material:** scaffolds, historical renditions, backups, prompts, copied SSOT bundles, and implementation alternatives.

## 3.2 Authority conclusion

There is no single file that alone contains the whole current public brand experience. The most defensible SSOT is a **controlled stack**:

| Precedence for this report | Source | What it controls |
| --- | --- | --- |
| 1 | `extract/compendium/00_control_and_governance/source_authority_policy.json` | Domain-specific precedence, conservative conflict handling, rights/safety rules. |
| 2 | `README.md` | Repository hierarchy; identifies `docs/styleguide.md` as authoritative for public-facing tone, visual direction, page strategy, and presentation posture. |
| 3 | `docs/styleguide.md` and `docs/ssot/styleguide.json` | Public creative concept: black/chrome/fire, Demon lane, typography, layout, copy, page roles, and boundaries. |
| 4 | `proto/docs/website_ssot.md` | Current active website, route jobs, homepage section canon, image policy, claims, forms, and launch-sensitive constraints. |
| 5 | `proto/docs/language.json` | Runtime-backed exact public copy, metadata, labels, CTAs, warnings, disclaimers, and token reuse rules. |
| 6 | `proto/public/assets/css/site.css`, `proto/public/`, `proto/app/view.php`, and approved assets | What the active site actually renders and therefore what visitors currently see and operate. |
| 7 | `docs/brand_story_style_guide_inventory.md` | Owner-approved-current-direction inventory and crosswalk of brand, copy, CSS, sections, routes, and guardrails. |
| 8 | `docs/ssot/settings/*.json` | Starter structured summaries for identity, voice, stories, visual style, architecture, and channels. Useful, but explicitly `starter`. |

## 3.3 Important exclusions

The newer-looking compendium files under `extract/compendium/06_brand_content_and_accessibility/` and `08_public_website_and_audience_data/` are draft scaffolds, not extracted or approved facts. Their own README files warn against treating empty shells as approved records. They are future destinations, not current brand authority.

Likewise:

- `secondrendition/`, `thirdrendition/`, `owner/`, `owner_arena_command/`, and `center/` are management, exploration, or copied-data surfaces—not the public visual canon.
- `proto_prob/` is a technical/problem-space rendition, not the public site.
- Site-layer backups preserve provenance and editable state; recency alone does not make a backup authoritative.
- Prompts and campaign generation briefs help produce work but cannot overrule controlled public language, rights, safety, or current website canon.

## 3.4 Conflict rule

Recency by itself does not settle truth. Controlled approved evidence outranks drafts and runtime observation in the same domain; implementation demonstrates behavior but does not create policy. When authority is unresolved, the most conservative rights, safety, privacy, and approval restriction wins. Unsupported official affiliation, endorsement, ownership, or clearance claims are never inferred.

---

# 4. The Experience at Three Resolutions

## 4.1 One sentence

**A one-night, fire-and-chrome theatrical rock ritual where a towering Demon-inspired presence turns a pavilion into an arena and calls the faithful into the spectacle.**

## 4.2 One paragraph

The site opens in near-blackness, then throws chrome edges, orange fire, red haze, bone-white type, and a monumental performer silhouette toward the visitor. It speaks in short poster-sized declarations and fan calls, then proves the promise with images of armor, rigging, smoke, lights, road cases, and disciplined stage craft. Between the spectacle beats it delivers bright, scannable facts, visible warnings, directions, forms, and a plain independent-tribute disclaimer. The visitor is made to feel recognized as a fan, invited into a ritual, reassured that the event is real, and energized to attend or share it.

## 4.3 One-page verbal mood board

**Darkness:** stage void, night, backstage corridor, shadow, anticipation.  
**Metal:** chrome bevel, road-case edge, studs, spikes, buckles, truss, armor.  
**Heat:** ember, red wash, orange beam, gold reflection, fire glow, hot border.  
**Atmosphere:** smoke curling low, fog catching beams, haze, reflected floor, crowd heat.  
**Scale:** portal, riser, towering figure, poster crop, giant uppercase declaration.  
**Movement:** entrance, reveal, flare, lift, blast, spotlight sweep, crowd response.  
**Sound implied by sight:** hard light, fists up, big chorus, full volume, no dead space.  
**Human emotion:** recognition, belonging, anticipation, awe, playful menace, release.  
**Practical grounding:** date, place, free admission, directions, camping distinction, warnings.  
**Object memory:** a glowing road case opened for the fan community.

---

# 5. What a Visitor Sees

## 5.1 First visual impression

The first impression is not a conventional event page. It is a **stage entrance frozen at maximum anticipation**. A dark field gives way to a symmetrical chrome portal, hot orange light, smoke, and a lone performer silhouette. The figure is not presented casually or socially; the figure is monumental, centered, armored, and backlit.

Over that image sits enormous custom display type. The headline is deliberately compressed and poster-like. Smaller yellow eyebrow text behaves like a marquee or event stamp. Red/orange buttons glow as if lit from within. Chrome buttons feel secondary but substantial. The composition says “show” before the visitor reads “show.”

## 5.2 The scrolling landscape

As the visitor scrolls, the site behaves like a sequence of stage cues:

1. **Entrance:** near-full-screen hero, colossal headline, central spectacle image.
2. **Orientation:** bright fact pills and a framed event ticket make the offer tangible.
3. **Proof:** close armor textures and numbered cards translate atmosphere into promises.
4. **Participation:** a dark control-dossier setting frames the update form as joining the rally.
5. **Payoff:** fog, rigging, red/green beams, and stacked facts repeat the one-night invitation.
6. **Archive/community:** an illuminated road case introduces the Fan Vault and its six relic-like cards.
7. **Readiness:** practical event cards and footer details settle the visitor before departure.

## 5.3 Forms and utility surfaces

Utility does not leave the world. Inputs sit in dark framed panels with chrome borders; labels are uppercase and direct; consent receives visible emphasis; buttons retain the fire treatment. Yet the language becomes deliberately plainer. The result is theatrical framing without theatrical confusion.

## 5.4 Mobile impression

On smaller screens the arena becomes a **stack of posters and cards**, not a shrunken desktop collage. Columns collapse, headlines scale through responsive clamps, navigation wraps, and a fixed mobile CTA keeps the next action close. The visitor should still encounter the same order—impact, proof, participation, practical clarity—even when the visual field narrows.

---

# 6. What a Visitor Feels

## 6.1 Recognition

The page immediately speaks to classic theatrical-rock memory: black and white contrast, armor, chrome, fire, smoke, a larger-than-life persona, poster typography, and the familiar rhythm of a fan call. It aims for the emotional reflex of recognition without claiming official status.

## 6.2 Anticipation

The darkness is not emptiness; it is the second before an entrance. Glows, portals, countdown language, one-night framing, and repeated date/place facts make the visitor feel a show approaching.

## 6.3 Awe at close range

The brand deliberately combines arena scale with an accessible local event. That contrast makes the promise feel special: the spectacle appears too large for an ordinary setting, yet the directions and free-admission language make it reachable.

## 6.4 Playful menace

The Demon lane is predatory, shadowed, armored, and aggressive, but the emotional goal is theatrical thrill—not fear, hostility, or cruelty. “Dangerous-looking” is a visual promise; controlled cues and practical warnings form the unseen counterweight.

## 6.5 Belonging

The visitor is not treated as a transaction. “The faithful,” “join the rally,” “the ritual,” “the crowd,” “Fan Vault,” and sharing invitations position the fan as a necessary participant. The show comes alive because the audience answers.

## 6.6 Confidence

The site interrupts its own mythology at the correct moments. Yellow facts, clear addresses, admission details, parking notes, camping distinctions, safety advisories, contact routes, and plain consent language communicate preparedness. This is essential: spectacle earns attention; clarity earns attendance.

---

# 7. What a Visitor Experiences

The experience is a controlled alternation between **promise and proof**:

| Beat | Visitor experience | Brand job |
| --- | --- | --- |
| Impact | “This is huge.” | Stop the scroll and establish scale. |
| Recognition | “This world is for fans like me.” | Create cultural familiarity and belonging. |
| Orientation | “I know when, where, and what kind of event this is.” | Establish reality and reduce friction. |
| Transformation | “A normal pavilion will become something mythic.” | State the distinctive product. |
| Evidence | “There are lights, smoke, armor, cues, and production intent.” | Make the promise credible. |
| Invitation | “I can join, attend, share, or ask.” | Convert emotion into action. |
| Community | “The audience has a place in the story.” | Extend the relationship beyond one click. |
| Readiness | “I can plan responsibly.” | Close with confidence and care. |

The page therefore feels closer to a short trailer than a brochure. Each section has an entrance, a visual key, a dominant message, and an exit into the next beat.

---

# 8. What a Visitor Enjoys

Visitors are invited to enjoy:

- **The visual excess:** giant type, chrome geometry, saturated heat, deep shadow, smoke, beams, and theatrical scale.
- **The transformation fantasy:** an ordinary venue becoming an arena-sized world for one night.
- **The central persona:** a singular, monumental performer presence rather than generic band photography.
- **The language punch:** short, quotable lines that sound like poster copy and stage calls.
- **The fan wink:** a sense that the page knows the codes, rituals, and pleasures of theatrical rock fandom.
- **The collectibility:** numbered cards, stamps, badges, road cases, poster blocks, and vault language feel like artifacts rather than disposable UI.
- **The invitation to contribute:** photos, clips, questions, reactions, tips, and chats let the crowd continue the night.
- **The relief of clarity:** large practical facts and straightforward warnings allow enthusiasm without guesswork.

Enjoyment depends on rhythm. If everything screams, nothing lands. Black quiet, readable body copy, and utility panels create rests between high-impact moments.

---

# 9. What a Visitor Remembers

## 9.1 Primary memory anchors

1. **A lone figure in a chrome-and-fire portal.**
2. **The black/chrome/red-orange palette.**
3. **The idea of a stage takeover rather than a polite cover night.**
4. **The crowd as “the faithful” entering a ritual.**
5. **A glowing road case opening into fan participation.**
6. **One date/place/action block repeated with poster force.**

## 9.2 Verbal memory anchors

The most reusable existing phrase families are:

- “A stage takeover, not a polite cover night.”
- “One night. Full fire.”
- “The fire answers.”
- “Join the rally.”
- “Get the drop.”
- “Open the road case.”
- “Before you roll in…”
- “A love letter with volume.”

Exact public reuse must come from the current language token and pass rights/fact review; this list describes memory architecture rather than granting blanket approval.

## 9.3 The desired retelling

The ideal visitor retelling is simple: **“It looks like a full arena spectacle dropped into Interlochen for one night—fire colors, chrome armor, smoke, huge attitude, and a crowd that gets to be part of it.”**

---

# 10. Brand Character and Productive Tensions

The identity stays compelling by holding opposites together:

| Force A | Force B | The productive result |
| --- | --- | --- |
| Arena scale | Reachable local event | Extraordinary but attainable. |
| Demon menace | Fan welcome | Thrilling, not alienating. |
| Dangerous-looking image | Controlled production | Excitement supported by discipline. |
| Mythic language | Exact utility copy | Imagination plus trust. |
| Fan recognition | Original expression | Cultural fluency without false official status. |
| Maximal visuals | Simple hierarchy | Excess that remains legible. |
| One towering performer | Crowd participation | Iconic center plus communal energy. |
| Road-worn hardware | Premium chrome | Authentic touring grit plus polish. |
| One-night urgency | Ongoing Fan Vault | Immediate action plus continuing relationship. |

Remove either side and the identity weakens. Pure menace loses welcome. Pure friendliness loses voltage. Pure fantasy loses trust. Pure facts become an ordinary listing.

## 10.1 Brand personality words

**Primary:** theatrical, audacious, mythic, dark, metallic, incendiary, commanding, fan-devoted, disciplined, memorable.  
**Secondary:** collectible, road-worn, comic-book-scaled, ritualistic, direct, physical, photo-worthy, communal.  
**Not the brand:** polite, beige, delicate, corporate, boutique, generic, ironic, apologetic, cluttered, careless, officially affiliated.

---

# 11. Visual World

## 11.1 Color hierarchy

The implementation establishes a clear palette:

| Role | Current value | Visitor meaning | Typical use |
| --- | --- | --- | --- |
| Stage Black | `#050505` | Void, leather, night, scale | Dominant background. |
| Secondary Black | `#0d0d10` | Layered backstage depth | Panels and section variation. |
| Bone White | `#f2f2ee` | Face-paint contrast, sparks, legibility | Main headings and critical text. |
| Chrome Silver | `#b8bcc2` | Armor, hardware, premium craft | Borders, frames, secondary buttons. |
| Chrome Dark | `#656a72` | Worn metal and depth | Subdued hardware detail. |
| Blood Red | `#b20d18` | Demon energy, danger, urgency | Hot accents and primary CTA blend. |
| Fire Orange | `#f06a21` | Heat, flame, action | Glow, hover, primary CTA. |
| KISS Gold | `#d8a31a` | Grandeur, spotlight warmth | Premium or heritage accents. |
| Electric Yellow | `#f2c230` | Visibility and factual certainty | Eyebrows, badges, facts, focus. |
| Cosmic Purple | `#6d3fa9` | Glam fantasy and night atmosphere | Select secondary/vault atmosphere. |

### Palette behavior

- Black owns the largest area.
- Bone white creates the cleanest legibility.
- Chrome constructs the object world.
- Red and orange mark heat and action, not decoration everywhere.
- Yellow carries urgency **and utility**: dates, badges, safety emphasis, focus outlines.
- Purple is a supporting atmospheric note, never the default identity.
- Gradients resemble fire, spotlight, smoke, reflected metal, or heat—not soft lifestyle or SaaS gradients.

## 11.2 Shape language

Two shape families coexist:

- **Sharp ceremonial geometry:** portals, spikes, bat-wing suggestions, armor plates, pointed frames, hard beams.
- **Usable interface geometry:** rounded section shells, pill facts, pill CTAs, softened card corners.

This is an important balance. Art direction provides the blade; interface shapes make the page approachable and operable.

## 11.3 Surface and texture

Preferred surfaces are black leather, polished or scuffed chrome, riveted road-case material, wet reflective floor, haze, smoke, truss, and hard-lit armor. These surfaces make the brand physical. It should feel touchable, heavy, assembled, and ready to tour—not digitally weightless.

## 11.4 Light

Light is directional and theatrical:

- red/orange backlight for entrance and heat;
- bone-white specular highlights on chrome;
- red/gold facial or crowd glow;
- green used sparingly as a stage cue, not a dominant brand color;
- deep shadow preserved rather than flattened;
- fog/haze used to reveal beams and depth;
- glows concentrated around portals, CTAs, tickets, and active states.

---

# 12. Typography, Composition, and Interface Behavior

## 12.1 Type roles

| Role | Current character | Job |
| --- | --- | --- |
| Display/logo | Custom `JOK Nasty Logo`, with Impact/condensed fallbacks | Identity, hero headlines, giant declarations, badges. |
| Poster sans behavior | Heavy, uppercase, tightly led, condensed | Section titles, dates, card titles, calls. |
| Utility sans | System UI stack | Body copy, facts, forms, consent, directions, warnings. |

Display type is ceremonial. It should create peaks, not fill paragraphs. Body typography should remain quiet enough for the spectacle to breathe and clear enough to make planning effortless.

## 12.2 Scale and rhythm

- Headlines are oversized and uppercase.
- Line heights near `.92` create compact poster stacks.
- Eyebrows are small, yellow, uppercase, and widely tracked.
- CTA labels are brief, uppercase, and heavily weighted.
- Ledes are larger than body text but substantially calmer than display headlines.
- Facts repeat in short chips, cards, and event-ticket blocks.

## 12.3 Composition

- A single hero figure or silhouette anchors the field.
- Symmetry is common in major portals and stage rigs.
- Text/image overlays use strong dark scrims so copy remains primary.
- Major sections occupy framed shells separated by generous vertical beats.
- Numbered cards imply a dossier, set list, equipment manifest, or collectible series.
- Hero, ticket, CTA, and vault create distinct visual landmarks.

## 12.4 Motion and interaction

Interaction is restrained compared with the imagery:

- buttons lift slightly and brighten;
- relic cards lift and rotate a fraction;
- glows intensify at meaningful actions;
- smooth scrolling supports the sequence;
- reduced-motion preferences are respected.

The site implies explosive motion without requiring frenetic animation. Marketing adaptations should follow the same rule: one strong reveal or transition is better than continuous visual noise.

---

# 13. Imagery and Art Direction

## 13.1 Current image families

The approved public asset set establishes these families:

1. **Stage portal:** monumental chrome structure, performer silhouette, orange fire/smoke, black arena.
2. **Poster portal:** the same entrance energy optimized as an event-poster background.
3. **Chrome costume detail:** macro black leather, polished edges, spikes, buckles, red reflections.
4. **Spectacle rig:** visible truss, beams, red/amber light, stage depth.
5. **Fog/strobe atmosphere:** empty stage prepared for arrival, colored fog catching hard beams.
6. **Gear/control dossier:** production readiness and behind-the-spectacle credibility.
7. **Road-case vault:** a touring case opened onto orange light, making community feel like an archive of relics.
8. **Performer/press portrait:** a public-facing human anchor where biography or press needs it.
9. **Interlochen dispatch map:** place and journey translated into the same dramatic world.

## 13.2 Image composition rules

- Prefer one unmistakable subject over a busy group.
- Frame the subject with a portal, truss, hard light, or negative space.
- Preserve dark areas for typography.
- Crop boldly; armor details can become landscapes.
- Use reflections and haze to add depth.
- Make hardware credible enough to feel physical.
- Keep fire-like effects atmospheric unless an effect is verified, cleared, and accurately represented.
- Do not embed critical event facts only inside imagery.

## 13.3 The safe original lane

Use original performer photography, original armor textures, generic theatrical rock iconography, smoke, truss, hard beams, road cases, black/chrome/fire color, and original poster composition. Official logos, exact protected makeup, album art, tour art, recordings, clips, photographs, merchandise, memorabilia, or proprietary staging require explicit review and clearance.

## 13.4 Image emotional jobs

| Image job | What it should make the visitor feel |
| --- | --- |
| Hero | “Something enormous is about to enter.” |
| Armor detail | “This world is crafted, physical, and close.” |
| Rig | “The spectacle has real production intent.” |
| Fog stage | “The room is waiting for the first cue.” |
| Road case | “The fan archive contains something worth opening.” |
| Portrait | “There is a performer and a human commitment at the center.” |
| Map | “The journey itself belongs to the night.” |

---

# 14. Voice, Vocabulary, and Sentence Music

## 14.1 Voice principles

The voice is **bold but not fraudulent, menacing but not hostile, fan-literate but not exclusionary, theatrical but not vague, and practical when facts matter**.

### Eight voice modes

1. **Hero:** huge, declarative, four to nine words, immediate.
2. **Ritual:** mythic, emotional, communal, transformation-focused.
3. **Spectacle:** sensory proof translated from production capability.
4. **Poster:** date/place/offer compressed into a memorable stack.
5. **Fan community:** insider warmth, rally language, archive and sharing.
6. **Utility:** ordinary words, short sentences, exact facts.
7. **Safety/consent:** plain, direct, visible, unambiguous.
8. **Disclaimer:** calm, literal, consistent, never winkingly evasive.

## 14.2 Preferred word bank

**World nouns:** arena, stage, pavilion, portal, ritual, night, fire, chrome, smoke, fog, shadow, armor, road case, vault, beam, spotlight, crowd, faithful, rally, signal, spectacle, entrance, chorus.  
**Action verbs:** enter, step into, join, answer, open, ignite, arrive, claim, watch, share, raise, bring, light, land, load in.  
**Texture adjectives:** black, chrome, hard, fire-lit, towering, mythic, controlled, full-scale, road-worn, electric, photo-worthy, theatrical.  
**Utility verbs:** get details, RSVP, plan, contact, ask, find, follow, prepare.

## 14.3 Avoided language

- “Official KISS show,” “authorized Gene Simmons event,” or any equivalent unsupported relationship.
- Generic diminishment: “local band night,” “cover act,” “nice evening,” “music program.”
- Corporate abstraction: “immersive solution,” “premium activation,” “content ecosystem” in audience copy.
- Overclaiming: “guaranteed,” “safe for everyone,” “fully accessible,” “sold out soon,” unless specifically verified and approved.
- Internal mechanics: cue IDs, DMX addresses, owner/admin status, launch blockers, or approval workflow in fan copy.
- Empty superlatives unsupported by imagery or facts.

## 14.4 Sentence rhythm

The signature rhythm is **impact → image → fact → action**:

> One night. Full fire. Smoke curls low beneath chrome glare. July 25 at the verified venue. Get the details.

This is a structural example, not pre-approved final copy. Strong executions mix fragments for force with complete sentences for clarity. They repeat the essential fact without repeating the same adjective.

---

# 15. Story Architecture and Emotional Pacing

## 15.1 Master story

**The arena arrives in the room.** A familiar fan hunger calls something out of darkness. A towering figure crosses from shadow into fire. Chrome, fog, lights, and disciplined cues transform an ordinary place. The crowd raises the energy and completes the ritual. The moment becomes a story, a photograph, a clip, and a relic carried forward.

## 15.2 Supporting authorized story arcs

### A. The arena arrives

- **Beginning:** an ordinary local setting waits in darkness.
- **Transformation:** portal, silhouette, smoke, hard light, chrome.
- **Payoff:** the room feels arena-sized.
- **Best for:** home hero, awareness advertising, billboards, trailer covers.

### B. From shadow to fire

- **Beginning:** a figure is almost hidden.
- **Transformation:** red/orange light discovers armor and scale.
- **Payoff:** the entrance becomes the event.
- **Best for:** spectacle pages, short-form motion, poster series, game loading screens.

### C. The one-night invitation

- **Beginning:** the faithful are called.
- **Transformation:** exact date/place/offer makes the myth reachable.
- **Payoff:** attend, RSVP, or get details now.
- **Best for:** conversion, direct mail, postcards, print ads, mobile CTA.

### D. A love letter with volume

- **Beginning:** fan devotion and memory.
- **Transformation:** love becomes craft, costume, cues, and stage presence.
- **Payoff:** tribute is expressed as original theatrical commitment.
- **Best for:** about, press, editorial, longer captions, booking story.

### E. Open the road case

- **Beginning:** the show leaves artifacts behind.
- **Transformation:** fans share photos, clips, questions, tips, and reactions.
- **Payoff:** the crowd keeps the night alive.
- **Best for:** retention, social community, user-generated content, collectible merchandise.

## 15.3 Story pacing rule

Every long-form piece should alternate:

1. **myth** — why the night matters;
2. **matter** — what it looks and feels like;
3. **proof** — what makes the promise credible;
4. **fact** — what the audience needs to know;
5. **invitation** — what the audience can do.

---

# 16. Audience Relationships

## 16.1 Fans

Fans are “the faithful,” but the phrase should welcome rather than test credentials. The tone recognizes shared memory, theatrical excess, singalong energy, and the pleasure of transformation. Fans are invited to raise fists, react, photograph, share, and keep the night alive within current media rules.

## 16.2 Curious local visitors

These visitors need the spectacle translated without assumed fandom. Lead with one towering theatrical event, a free/clear route to attendance where currently verified, visible date/place details, and straightforward warnings. Avoid lore density that makes newcomers feel outside the circle.

## 16.3 Venue buyers and press

The same brand becomes more controlled and evidence-led. Preserve black/chrome/fire and the central promise, but foreground show package, travel-minded preparation, public-ready presentation, original assets, contact routing, and practical credibility. Do not expose sensitive technical detail or substitute hype for a verified capability.

## 16.4 Families and sensitive guests

The brand can remain exciting while warnings are calm and specific. Family-friendly posture does not erase loud sound, bright light, fog, or flashing-pattern advisories. Clarity is part of hospitality.

## 16.5 Community participants

Fan Vault language turns follow-up into belonging. Contributions should feel collected and valued, but permissions, ownership, consent, moderation, and rights status must remain explicit behind the public invitation.

---

# 17. Sensory and Material Vocabulary

Marketing should describe a multisensory promise without inventing unverified effects.

| Sense | Authorized style vocabulary | Intended response |
| --- | --- | --- |
| Sight | black field, chrome glare, red/gold faces, smoke, hard shadow, portal, beams | Awe and focus. |
| Sound | loud, big chorus, full volume, first chord, crowd response | Anticipation and participation. |
| Touch imagined | leather grain, cold chrome, rivets, road-case edge | Physical credibility. |
| Temperature imagined | fire-colored light, heat, ember, flare | Urgency and life. |
| Motion imagined | entrance, smoke curling, lights sweeping, fists rising | The show feels active before video begins. |
| Space | pavilion becomes arena; central figure towers; darkness recedes | Transformation and scale. |

“Fire” is often a color/energy metaphor in the brand system. Do not imply literal pyrotechnics, flames, explosions, or a specific effect unless the current public claim is verified, cleared, and safety-approved.

---

# 18. Signature Brand Devices

Use these devices repeatedly enough to create recognition:

1. **The portal:** an architectural frame around the central presence.
2. **The silhouette:** transformation is suggested before every detail is revealed.
3. **The poster stack:** date, offer, venue, and place in giant separate lines.
4. **The hot/cold pair:** fire-red primary action beside chrome secondary action.
5. **The yellow fact stamp:** bright, compact, factual, instantly scannable.
6. **The orange rule:** a hot left border for disclaimer or microcopy emphasis.
7. **The numbered proof card:** spectacle broken into collectible, credible moments.
8. **The road case:** fan memory, touring craft, archive, and revelation.
9. **The call and answer:** the headline calls; the visitor joins, opens, watches, or gets details.
10. **The disciplined warning:** practical care presented visibly inside the same visual world.

No asset needs all ten. A strong small piece often uses three: black field, central portal/silhouette, and a poster fact stack with one fire CTA.

---

# 19. Consistency Rules: Invariants and Variables

## 19.1 Brand invariants

These should remain recognizable across formats:

- Correct `Just One KISS` naming and independent-tribute posture.
- Black-dominant field with chrome and fire hierarchy.
- One clear visual center.
- Monumental display moment plus readable utility type.
- Mythic scale grounded by exact facts.
- Audience invitation or clear next action.
- Original, rights-reviewed imagery.
- Visible, placement-appropriate safety and practical clarity.
- No unsupported official relationship or guaranteed outcome.

## 19.2 Variables that can change

- Which story arc leads.
- Image crop and subject distance.
- Red/orange/gold balance.
- Degree of road-worn texture.
- Amount of fan-community language.
- Long versus short disclaimer.
- Fact density appropriate to placement.
- CTA selected for funnel stage.
- Static versus motion execution.
- Formality for fans, press, buyers, or partners.

## 19.3 Minimum viable brand signal

For very small placements:

1. black or near-black field;
2. one original chrome/fire/performer motif;
3. `Just One KISS` identity;
4. one brief promise or verified fact;
5. one action or destination;
6. required short disclaimer/rights treatment where appropriate.

---

# 20. Translation by Marketing Format

## 20.1 Website and landing pages

Use the full story arc: entrance hero, proof, exact fact blocks, conversion, fan participation, practical close. Preserve dark section rhythm, giant type, real-text facts, accessible forms, visible focus, reduced motion, and route-specific jobs.

## 20.2 Social stills

Use one image, one headline, one fact, one CTA. Strong options include portal silhouette, armor macro, fog rig, or road case. Avoid shrinking a whole webpage into a feed tile. Captions can carry disclaimer, warnings, and secondary facts.

## 20.3 Short-form vertical video

Build a three-beat reveal: black/silhouette → chrome/fire discovery → fact/CTA. Use hard cuts or lighting-cue rhythm rather than generic transitions. Ensure flashing content is reviewed, warned, and adapted for platform accessibility.

## 20.4 Long-form video and trailers

Open with atmosphere, reveal the central figure, prove stage craft, show or imply crowd participation, then land on the poster fact stack. Original or cleared audio/video only. Keep essential facts on screen long enough to read.

## 20.5 Print postcards and direct mail

Front: iconic portal or armor crop, title, one-night promise. Back: exact date/place/offer, directions/URL or QR, practical warning, disclaimer, and contact. Use matte black, spot gloss/foil-like chrome where feasible, and red/orange as controlled heat.

## 20.6 Magazine pages

Treat the page as an album-era poster without copying album art: full bleed darkness, single monumental figure, sharp frame, giant headline, compact fact/ticket block, and a clear inquiry or attendance path. Preserve sufficient small-copy contrast.

## 20.7 Billboards and outdoor

Maximum five-second comprehension. Use name, silhouette/portal, date or durable promise, location shorthand, and one short action. Remove paragraphs, card grids, and nuanced lore. Never rely on QR alone. Avoid unverified details that may change before the buy ends.

## 20.8 Additional landing pages

Assign each page one lane: Ritual/About, Spectacle, Free Show/Event Facts, Directions, FAQ/Safety, Contact, Fan Vault, Video, Technical, or Press/Booking. The lane changes emphasis, not identity.

## 20.9 Mobile apps

Use black foundation, chrome separators, yellow state/fact markers, fire primary action, large readable type, and card-based modules. Keep navigation and forms utility-first. Push notifications should use plain factual language, not false urgency.

## 20.10 Games and interactive experiences

Translate the world into portals, stage cues, road cases, light beams, collectible relics, armor surfaces, and “from shadow to fire” progression. Do not turn real safety controls or official KISS likenesses into game mechanics without appropriate approvals. Reward participation and discovery rather than aggression.

## 20.11 Merchandise

Favor durable icons and materials: original portal silhouette, `Just One KISS` mark, chrome/fire geometry, road-case stamps, numbered relic systems, one-night poster stacks, black garments, patches, badges, and tour-dossier layouts. Confirm trademark, copyright, likeness, font, image, and production rights per item.

## 20.12 Press and booking collateral

Reduce fan hyperbole slightly; increase original performer identity, production discipline, stage package, audience promise, public readiness, media availability, and contact clarity. Keep one high-impact hero image so the document still feels like the same show.

---

# 21. Marketing-Option Families

These are menu-ready families for future marketers. They are **authorized directions derived from the SSOT**, not pre-approved finished claims. A family is a strategic lens: it selects the emotion that opens the piece, the evidence that sustains it, and the action that closes it. It is not a separate logo, palette, voice, or sub-brand.

The families also reflect the active site's architecture rather than being abstract campaign themes. The runtime homepage already moves through portal-scale impact, event facts, armor-and-spectacle proof, rally signup, a final poster stack, and the road-case vault. The nine families isolate those beats so a marketer can lead with the one best suited to the audience and channel while still returning to the same recognizable world.

## 21.1 Family menu at a glance

| Option family | Primary job | Emotional lead | Visual lead | Copy lead | Natural next action | Best uses |
| --- | --- | --- | --- | --- | --- | --- |
| Arena Arrives | Make the event feel unmissably large | Awe | Chrome portal + silhouette | “The room becomes an arena.” | Discover the event | Awareness, billboard, hero |
| Shadow to Fire | Turn suspense into a reveal | Anticipation | Black reveal into red/orange | Entrance and transformation | Watch or explore | Reels, trailer, spectacle |
| One Night / Full Fire | Convert attention into a plan | Urgency | Poster fact stack + rig | Date/offer/action | Get details or RSVP | Conversion, postcard, display |
| Love Letter with Volume | Explain the heart behind the tribute | Devotion | Performer + armor craft | Fan passion and original expression | Read, watch, or inquire | About, editorial, press |
| Chrome-Blood Spectacle | Make the material world desirable | Playful menace | Armor macro + red reflection | Texture and attitude | Browse, collect, or share | Fashion, merch, carousel |
| Join the Rally | Turn spectators into participants | Belonging | Crowd response + badge | Updates, RSVP, participation | Join updates | Lead capture, social |
| Open the Road Case | Extend the relationship after discovery | Curiosity | Illuminated touring case | Vault, clips, relics, stories | Open, contribute, or return | Retention, community, merch |
| Before the First Chord | Replace logistical uncertainty with confidence | Confidence | Rig + directions + map | Arrival, access, and safety | Plan the visit | Utility campaigns, reminders |
| Built to Land and Light | Make the show legible to professional buyers | Credibility | Gear + control + stage package | Travel-minded preparation | Start a booking inquiry | Booking, buyer, technical |

### How to choose a family

Choose by the audience's unanswered question—not by whichever visual happens to be available:

- **“Why should I stop?”** Use **Arena Arrives** or **Shadow to Fire**.
- **“Why should I go now?”** Use **One Night / Full Fire**.
- **“Why does this tribute matter?”** Use **Love Letter with Volume**.
- **“What can I wear, collect, or post?”** Use **Chrome-Blood Spectacle**.
- **“Where do I belong?”** Use **Join the Rally**.
- **“What happens after I discover or attend?”** Use **Open the Road Case**.
- **“Can I arrive prepared?”** Use **Before the First Chord**.
- **“Can this production work for my venue?”** Use **Built to Land and Light**.

One family should lead a single small placement. A longer campaign may sequence families—for example, **Arena Arrives → Shadow to Fire → One Night / Full Fire → Before the First Chord → Open the Road Case**—but should not flatten all nine into one crowded execution.

## 21.2 Arena Arrives

**Strategic proposition:** an ordinary room is about to contain something that feels much larger than its walls. This is the broadest and most immediately legible expression of the master story, and therefore the strongest default for first contact.

- **Audience state:** unaware or lightly aware; the visitor may know the cultural language of theatrical rock but does not yet know this event.
- **Emotional movement:** ordinary place → impossible scale → reachable invitation. Awe must arrive first, then be grounded by one practical fact so the image does not feel like an unattached fantasy poster.
- **Visual system:** a near-black field; one centered silhouette; a monumental chrome portal, truss, or hard architectural frame; one concentrated fire-orange source; generous shadow for a short display line. Wide crops should make the architecture dominate. Small crops should preserve the silhouette/portal relationship rather than reducing the image to generic flames.
- **Copy behavior:** speak about arrival, transformation, scale, and the room changing character. Use one declarative headline, one line of sensory proof, and one fact/action block. Suitable construction patterns include “The arena arrives,” “A larger night is entering,” and “The room becomes an arena.” These are development directions, not approved runtime tokens.
- **Proof to show:** the active stage-portal image, pavilion-to-arena language, the central performer, lighting structure, and the exact verified event identity. Do not support “arena” with claims of crowd size, venue capacity, or production elements that are not approved.
- **CTA posture:** **See the event**, **Get the details**, or an approved current equivalent. Awareness pieces should invite discovery rather than demand commitment too early.
- **Best expressions:** homepage or campaign hero, six-second awareness bumper, billboard, trailer cover, magazine opener, large event poster, or the first card in a social sequence.
- **Failure mode:** a portal with no human center becomes science fiction; a figure with no scale cue becomes ordinary band photography; too many flames become generic hard-rock clip art. The family succeeds when the viewer feels scale before reading, then immediately understands what is being offered.

## 21.3 Shadow to Fire

**Strategic proposition:** the transformation itself is the attraction. Where Arena Arrives presents the completed icon, Shadow to Fire dramatizes the seconds before and during revelation.

- **Audience state:** intrigued but not yet emotionally committed; especially suited to viewers who respond to motion, suspense, costume transformation, lighting cues, and entrances.
- **Emotional movement:** withheld detail → first chrome edge → fire-colored discovery → full presence. Silence, darkness, or negative space is part of the idea; the reveal loses force if the opening frame already shows everything.
- **Visual system:** begin almost black, with a readable silhouette or a single specular edge. Introduce red/orange backlight, haze, chrome reflections, and finally bone-white type. In still sequences, use a diptych or three-frame progression. In motion, favor one deliberate lighting-cue reveal over constant cutting or decorative effects.
- **Copy behavior:** short phrases should act like cues: “From shadow,” “The signal hits,” “Into fire.” Copy can arrive in stages, but the final frame must resolve into exact identity, fact, and action. Sound-off viewing must remain complete through captions and on-screen text.
- **Proof to show:** a real or approved original performer silhouette, armor detail, fog/strobe atmosphere, or lighting-rig image. “Fire” remains a color and energy metaphor unless literal effects are separately verified and cleared.
- **CTA posture:** **Watch the reveal**, **Step into the spectacle**, **See the spectacle**, or a current approved token appropriate to the destination.
- **Best expressions:** vertical video, teaser countdown, reel, story, pre-roll, trailer open, animated display unit, spectacle landing page, or sequential poster set.
- **Accessibility and safety:** avoid rapid flashes as a shortcut for intensity. Respect reduced-motion settings, caption all meaningful audio, maintain readable hold times, and apply current flashing-pattern warnings where needed.
- **Failure mode:** horror imagery can turn playful menace into hostility, while continuous visual noise destroys suspense. This family should feel like a controlled stage cue: darkness has purpose, the reveal is singular, and the landing frame is clear.

## 21.4 One Night / Full Fire

**Strategic proposition:** the spectacle is specific, reachable, and time-bound. This is the principal conversion family because it compresses mythology into a poster-simple decision.

- **Audience state:** aware and interested; now asking when, where, what it costs, and what to do next.
- **Emotional movement:** urgency → orientation → low-friction action. Urgency comes from the verified event window and concentrated presentation, never from fabricated scarcity.
- **Visual system:** a bold poster fact stack, a stage-rig or portal background, a yellow factual stamp, and one fire-colored primary action. The hierarchy should be identity/promise first, then date, offer, venue/place, and action. On mobile, each fact becomes its own clean line or pill rather than a compressed miniature poster.
- **Copy behavior:** noun-heavy and exact. “One night. Full fire.” provides the emotional cap; current date, admission, venue, location, RSVP, and logistics language must come from controlled records or runtime tokens at release time. Avoid adjectives between the viewer and the decision.
- **Proof to show:** the current homepage event ticket and final CTA establish the useful pattern: repeated facts, prominent offer, clear location, fire/chrome action pair, and nearby warning or disclaimer.
- **CTA posture:** **Get event details**, **Get directions**, **RSVP**, or the approved campaign-specific action. Use one primary conversion and at most one practical secondary action.
- **Best expressions:** event landing page, retargeting unit, postcard, direct-mail front/back, social reminder, display ad, calendar graphic, print listing upgrade, or short-duration outdoor placement.
- **Operational rule:** every execution needs an owner, fact source, last-verified date, and expiry or removal trigger. Evergreen templates must keep volatile fields separate from art.
- **Failure mode:** false countdown pressure, unsupported “selling fast” language, old details baked into an image, or an atmospheric layout that hides the offer. The family should be the easiest of the nine to scan and act upon.

## 21.5 Love Letter with Volume

**Strategic proposition:** the production exists because fan devotion has been translated into original craft, disciplined performance, and a generous audience experience. This is the warmest family and the best answer to “why this tribute?”

- **Audience state:** fans, press, partners, and curious visitors who need human motive and meaning rather than another spectacle claim.
- **Emotional movement:** recognition → affection → labor/craft → shared payoff. Nostalgia may open the door, but present-tense commitment must carry the story.
- **Visual system:** an original performer portrait, hands adjusting costume hardware, close armor craftsmanship, rehearsal or preparation detail, and restrained red/gold warmth within the black/chrome field. The central person may be more visible here than in the mystery-led families, but the photography should remain purposeful rather than casual backstage content.
- **Copy behavior:** longer, more human sentences can sit between poster-sized declarations. Discuss fan love, transformation, craft, cues, and the desire to give the crowd a memorable night. Clearly name the work as an independent theatrical rock tribute and emphasize original expression rather than borrowed legitimacy.
- **Proof to show:** performer biography, original costume and presentation work, preparation, fan-centered intent, public-ready imagery, and approved statements about the show's development. Specific personal history or credentials require sourcing.
- **CTA posture:** **Read the story**, **Watch the performance**, **Share the night**, or **Contact for press/booking**, depending on audience.
- **Best expressions:** About page, press profile, founder/performer post, email feature, program note, magazine editorial, sponsor/partner introduction, or a documentary-style trailer middle.
- **Rights posture:** affection is not authorization. Do not use official marks, protected visual designs, music, footage, quotations, or memorabilia as emotional shorthand without clearance; do not let “love letter” imply endorsement.
- **Failure mode:** becoming sentimental, apologetic, or biography-heavy enough to lose stage voltage. Keep the human heart, but let chrome, hard light, and a concise performance promise remain visible.

## 21.6 Chrome-Blood Spectacle

**Strategic proposition:** the show's attitude can be understood through matter—black leather grain, cold chrome, points, buckles, red reflection, and controlled danger. This family turns the visual vocabulary into desire and collectibility.

- **Audience state:** visually driven fans, fashion/merchandise audiences, collectors, social scrollers, and viewers already interested in the show's persona.
- **Emotional movement:** close inspection → tactile fascination → playful menace → desire to collect, wear, save, or share.
- **Visual system:** macro armor crops that become landscapes; hard white highlights; deep black texture; restrained blood-red reflection; a small yellow number, badge, or specimen label; chrome dividers and road-worn marks. Product executions should photograph the actual item or provide an unmistakably labeled concept, not a misleading mockup.
- **Copy behavior:** clipped, physical, and object-led: edge, weight, glare, leather, rivet, plate, shadow. “Chrome-blood” describes a color/attitude relationship, not injury or literal blood. Pair evocative fragments with plain product, size, material, price, availability, or rights information when applicable.
- **Proof to show:** approved costume detail, original portal geometry, numbered proof-card language, patches, badges, poster systems, or original merchandise motifs. Craft detail is the argument; generic flame overlays are not.
- **CTA posture:** **See the details**, **Browse the collection**, **Save this relic**, or **Share the look** only when the destination and offering actually exist.
- **Best expressions:** social carousel, merchandise capsule, apparel detail, poster variant, collector card, editorial fashion crop, website proof card, or packaging system.
- **Rights and production posture:** confirm mark, image, likeness, font, product, and vendor rights item by item. Avoid exact official costume replication or proprietary iconography. Physical goods also require accurate material, care, fulfillment, and availability information.
- **Failure mode:** gore, hostility, costume-store cliché, or texture piled on texture until type becomes unreadable. The target is premium road-worn armor: dangerous-looking, controlled, crafted, and desirable.

## 21.7 Join the Rally

**Strategic proposition:** the audience is not merely traffic; it is the answering half of the show. This family converts recognition into consent-based belonging and gives participation a clear value.

- **Audience state:** interested fan or local visitor who may not be ready for a larger commitment but wants useful updates, a lightweight RSVP, or a way to join the conversation.
- **Emotional movement:** “this is for people like me” → “my presence matters” → “I know what I receive” → confident opt-in.
- **Visual system:** a crowd response, raised-hand silhouette, original signal/badge, group glow, or the active site's dark control-dossier form panel. Keep one visual invitation and ample quiet space for readable fields, consent, errors, and confirmation. Yellow can mark useful facts; fire should emphasize the submit action only.
- **Copy behavior:** use inclusive calls rather than tests of fandom. “The faithful” should feel affectionate, never like a gate. State the concrete value of joining—arrival notes, schedule reminders, parking/camping notes, access and safety updates, or media-sharing instructions—using only currently supported promises.
- **Proof to show:** the active update form's direct value exchange, visible consent, practical update list, and calm no-ticket/parking note demonstrate how mythology and service can coexist.
- **CTA posture:** **Join updates**, **Get the drop**, **RSVP**, **Ask and share show tips**, or another exact approved form action. The button label should predict what happens next.
- **Best expressions:** homepage lead capture, social signup card, email acquisition, event-page RSVP, community post, QR-supported print response, or a post-video conversion panel.
- **Privacy posture:** say what is collected, why, and what communication follows. Never pre-check consent, imply exclusivity that does not exist, promise instant replies, or convert fan contributions into reusable advertising assets without separate permission.
- **Failure mode:** empty “join us” language, manufactured army aggression, or a theatrical form that obscures basic usability. Belonging is earned through usefulness and respect as much as through attitude.

## 21.8 Open the Road Case

**Strategic proposition:** discovery and attendance leave artifacts worth returning to. The road case acts as both a physical touring object and a narrative container for clips, photographs, questions, tips, reactions, and future releases.

- **Audience state:** engaged, returning, or post-event; already interested enough to explore, contribute, collect, or keep contact with the community.
- **Emotional movement:** closed object → invitation → discovery → contribution → anticipation of the next opening.
- **Visual system:** an illuminated road case against darkness, orange light escaping at the seams, chrome corners, rivets, stencils, numbered relic cards, and occasional cosmic-purple atmosphere. The active vault's six-card grid supplies a strong modular grammar: every item gets a number, title, functional subtitle, and destination.
- **Copy behavior:** use archive and touring nouns—case, vault, relic, dispatch, clip, find, note—without falsely presenting ordinary content as rare or official memorabilia. Titles may be mysterious; subtitles and controls must tell visitors exactly what opens.
- **Proof to show:** actual cleared fan or project media, useful arrival notes, Q&A, clips, reactions, and route-specific destinations. Empty containers should be labeled as coming later rather than padded with invented artifacts.
- **CTA posture:** **Open the road case**, **Explore the vault**, **Share a clip**, **Send a reaction**, or **Return for the next drop**, subject to current functionality.
- **Best expressions:** Fan Vault landing page, retention email, post-event social series, carousel, community hub, collector merchandise system, packaging, app library, or game inventory metaphor.
- **Permission posture:** record provenance, ownership, consent scope, moderation state, credit, and permitted channels for every contribution. Submission does not equal blanket advertising or merchandise permission.
- **Failure mode:** a dead gallery, confusing mystery navigation, unsupported rarity claims, or uncontrolled user media. The family should reward curiosity with something real and make return visits feel intentional.

## 21.9 Before the First Chord

**Strategic proposition:** hospitality begins before showtime. Clear arrival, access, and safety information protects anticipation rather than interrupting it.

- **Audience state:** committed or nearly committed; now asking how to get there, where to park, what to expect, and whether the environment fits their needs.
- **Emotional movement:** uncertainty → orientation → preparedness → relaxed anticipation. This is the quietest family, but it should still feel like the same production.
- **Visual system:** the dispatch map, venue approach, pavilion/rig image, high-contrast utility cards, yellow labels, chrome rules, and one restrained fire accent. Diagrams and addresses must be functional first. Do not place route lines, warnings, or phone numbers only inside an image.
- **Copy behavior:** plain, direct, and ordered by the visitor's journey: before leaving, arrival route, parking/drop-off, entry/admission, environment advisories, access/contact path, departure. Use exact nouns and short sentences; reserve the theatrical phrase for the heading and perhaps one closing line.
- **Proof to show:** verified address and contact data, current parking/camping distinctions, event schedule or admission posture, accessible inquiry path, and loud-sound/bright-light/fog/flashing-pattern advisories where applicable.
- **CTA posture:** **Get directions**, **Plan your visit**, **Read the FAQ**, or **Ask an accessibility question**. Emergency or sensitive information should never hide behind a promotional CTA.
- **Best expressions:** directions page, FAQ/safety page, reminder email, event-day post, printable arrival card, map handout, SMS/push reminder, venue signage, or the reverse of a postcard.
- **Operational posture:** verify volatile facts near release; timestamp updates; provide a correction route; distinguish venue facts from show-team guidance; do not promise universal accessibility or safety.
- **Failure mode:** turning warnings into ominous theater, burying the address under lore, or stripping away all identity. A small yellow fact stamp, chrome frame, and black field can preserve the brand while the words remain completely ordinary.

## 21.10 Built to Land and Light

**Strategic proposition:** behind the monumental entrance is a compact, travel-minded production that prepares carefully, communicates clearly, and is designed to become legible in a real room. This is the professional-confidence family.

- **Audience state:** venue buyer, promoter, press contact, production partner, or stakeholder evaluating fit and follow-through rather than deciding whether to attend as a fan.
- **Emotional movement:** visual impact → curiosity about feasibility → evidence of preparation → qualified conversation.
- **Visual system:** gear/control dossier, labeled cases, approved stage/rig overview, performer press portrait, clean system cards, and one hero-scale image. Black/chrome/fire remains, but layouts become calmer, labels more literal, and evidence easier to compare. The page should suggest a touring manifest without exposing sensitive controls.
- **Copy behavior:** confident, specific, and measured. Lead with the audience outcome and independent tribute identity; then discuss travel-minded preparation, public-ready presentation, communication, adaptable planning, and available materials. Replace fan hyperbole with verifiable capability statements.
- **Proof to show:** approved stage-package summary, representative original images, public-safe production overview, contact routing, media kit, hospitality/advance readiness, and documented planning discipline. Internal cue IDs, DMX addresses, security details, emergency procedures, personal data, and unresolved inventory do not belong in public collateral.
- **CTA posture:** **Request the booking overview**, **Start an inquiry**, **Contact the show**, or **Request approved media**. Qualify the inquiry without making the form burdensome.
- **Best expressions:** booking landing page, buyer deck, one-sheet, press kit, venue email, technical overview, partner presentation, or trade-facing advertisement.
- **Claims posture:** “built to” communicates intent, not a guarantee that the production fits every room or can provide every effect. Scope, footprint, labor, power, schedule, access, effect permissions, and safety controls require venue-specific confirmation.
- **Failure mode:** publishing an internal technical manual, implying capabilities not yet confirmed, or becoming so corporate that the show disappears. Keep one monumental image and one audience promise beside the evidence of discipline.

## 21.11 Combining, sequencing, and governing the families

A campaign can use multiple families if each has a defined job and handoff:

| Funnel moment | Recommended lead family | Supporting family | Required landing behavior |
| --- | --- | --- | --- |
| First impression | Arena Arrives | Shadow to Fire | Identify the independent tribute and expose a discovery action |
| Active interest | Shadow to Fire | Love Letter with Volume | Reveal spectacle, then explain human intent and original craft |
| Event decision | One Night / Full Fire | Before the First Chord | Present verified facts, then remove planning friction |
| Community conversion | Join the Rally | Open the Road Case | State the value exchange, consent, and real content destination |
| Merchandise/editorial | Chrome-Blood Spectacle | Love Letter with Volume | Connect material attitude to original craft and accurate product facts |
| Professional inquiry | Built to Land and Light | Arena Arrives | Pair feasibility evidence with one unforgettable audience-facing image |

For every execution, document: the lead family, audience, funnel job, channel, one intended action, approved copy-token references, approved asset references, fact owner and expiry, disclaimer/advisory treatment, rights status, accessibility review, and final approver. If two families compete for the headline, split them into sequential pieces rather than forcing both into one message.

Across all nine families, the constants remain: `Just One KISS` naming; independent-tribute posture; black/chrome/fire hierarchy; one visual center; display impact plus utility clarity; original rights-reviewed expression; verified facts; visible safety/consent where relevant; and no unsupported affiliation, effect, availability, or outcome claim. “Menu” means choosing emphasis—not inventing nine parallel brands.

---

# 22. Copy Construction Kit

## 22.1 Headline structures

- **Contrast:** “A [spectacle noun], not a [generic alternative].”
- **One-night stack:** “[Date] / [Offer] / [Venue] / [Place].”
- **Command:** “Open the [brand object].”
- **Transformation:** “From [darkness noun] to [heat noun].”
- **Call:** “Join the [community noun].”
- **Arrival:** “The [arena/fire/night] answers.”
- **Devotion:** “A love letter with [volume/fire/chrome].”

These are syntactic patterns. Before publication, select exact current language tokens or route new copy through owner, fact, rights, and safety review.

## 22.2 Lede structure

A strong lede combines:

1. the independent theatrical tribute identity;
2. two or three sensory cues;
3. the audience transformation;
4. no unsupported promise.

Example pattern: **“Just One KISS is an independent theatrical rock tribute built for fans who want [sensory trio] and [emotional payoff].”**

## 22.3 CTA families

| Funnel job | CTA character | Existing/approved-language family |
| --- | --- | --- |
| Awareness | Enter/watch | Step into the spectacle; watch the trailer. |
| Interest | Explore | See the spectacle; open the vault. |
| Consideration | Verify | Get event details; get directions; ask a question. |
| Conversion | Commit lightly | RSVP; get the drop; join updates. |
| Booking | Contact | Contact for booking; send the signal. |
| Retention | Participate | Share clips/reactions; join the rally. |

## 22.4 Fact-writing rule

Facts should be noun-heavy, short, and repeated consistently: date, admission status, venue, city/route, parking, camping, and warnings. Pull current exact values from controlled tokens or verified records at production time. Never hard-code a dated fact into an evergreen brand template without an owner and expiry field.

## 22.5 Disclaimer rule

The current full family says the presentation is an independent theatrical rock tribute and claims no official affiliation, sponsorship, authorization, or endorsement. Use one approved canonical length for the placement; do not creatively rewrite legal meaning for novelty.

---

# 23. Visual Construction Kit

## 23.1 Hero recipe

- 60–80% black/dark field.
- One central performer, silhouette, portal, or road-case object.
- Chrome highlights along edges and structure.
- One red/orange heat source.
- One giant bone-white display statement.
- One small yellow eyebrow or fact.
- One fire action and, if needed, one chrome alternative.
- Clear space for disclaimer or exact facts.

## 23.2 Proof-card recipe

- Dark translucent panel.
- Thin chrome border.
- Small yellow or chrome number/stamp.
- Two-to-five-word uppercase title.
- One short readable proof sentence.
- Optional subtle red/orange hover glow.

## 23.3 Poster recipe

- Full-bleed black/fire image.
- Giant identity or headline at top/center.
- Central iconic subject.
- Fact stack at lower third.
- URL/contact and disclaimer in a high-contrast footer zone.

## 23.4 Utility recipe

- Near-black panel with strong bone-white copy.
- Yellow label for the category.
- Plain heading and one fact per line.
- Chrome divider.
- Fire color only on the primary action or critical warning accent.

## 23.5 Material production notes

For physical media, the concept translates naturally to black stock, metallic ink, silver foil, spot gloss, red/orange fluorescent accents, embossed/debossed road-case stamps, patches, rivet-like fasteners, and matte-versus-gloss contrast. These are creative directions, subject to budget, legibility, production safety, and vendor proofing.

---

# 24. Accessibility, Clarity, Rights, and Safety Guardrails

## 24.1 Accessibility is part of the look

The brand’s high contrast supports accessibility when used carefully. Preserve:

- semantic structure and real text for essential facts;
- keyboard navigation and clearly descriptive links;
- a visible yellow focus outline;
- skip-to-content behavior;
- alt text for meaningful imagery;
- reduced-motion support;
- sufficiently readable body/utility type;
- selectable addresses and contact data;
- plain labels, errors, consent, and warnings;
- information not conveyed by color alone.

Do not use custom display lettering for paragraphs, warnings, consent, or directions.

## 24.2 Rights posture

The brand is an independent tribute. It can evoke theatrical rock energy through original color, light, shape, materials, performance photography, and language. Review is required for official logos, exact protected face designs, official album/tour art, recordings, clips, photos, merchandise, memorabilia, named likenesses, or close imitations. No marketing item should imply official affiliation, sponsorship, authorization, endorsement, ownership, or clearance without written evidence.

## 24.3 Safety posture

Current public hazard families include loud sound, bright light, fog, flashing lights/patterns, and strobe-style looks. Keep warnings visible near conversion and practical information. Do not dramatize warnings into ambiguity, promise universal safety/accessibility, or imply literal fire/pyrotechnic effects merely because the visual palette uses “fire.” Safety HOLD/STOP/ABORT authority overrides creative intent.

## 24.4 Fact posture

Event date, location, admission, camping, parking, contact, and access information are volatile. The current website canon contains approved wording/status for the current event, but future assets must verify it at release time. Separate evergreen brand layers from campaign-specific overlays.

## 24.5 Privacy and consent

Fan-community warmth never overrides consent. Forms and campaigns must state what is collected, why, and what action occurs. Avoid promising instant replies. User-generated photos, clips, and stories need rights/permission handling before reuse in advertising, print, apps, games, or merchandise.

---

# 25. Anti-Patterns and Drift Tests

## 25.1 Visual drift

Reject or revise work that looks like:

- a generic local-band flyer;
- a clean white corporate SaaS page;
- a muted boutique/lifestyle campaign;
- random red-on-black “hard rock” clip art;
- an official-band imitation;
- an overcrowded collage with no central presence;
- illegible distressed type everywhere;
- decorative flames without credible stage atmosphere;
- glossy fantasy with no practical grounding;
- utility material so plain that it loses all brand recognition.

## 25.2 Voice drift

Reject or revise copy that is:

- apologetic, timid, or generic;
- full of unsupported superlatives;
- falsely official;
- overtechnical for fans;
- so lore-heavy that newcomers cannot understand it;
- so theatrical that date, place, warning, consent, or action becomes unclear;
- hostile, exclusionary, or needlessly aggressive;
- sarcastic about rights, safety, access, or privacy.

## 25.3 Five-question drift test

1. Could this belong to any local rock event? If yes, strengthen the portal/armor/ritual/road-case identity.
2. Could someone mistake it for an official KISS or Gene Simmons property? If yes, revise and review.
3. Can the audience find the one intended action immediately? If no, simplify.
4. Are all volatile facts sourced and release-checked? If no, hold publication.
5. Does the piece balance mythic excitement with human clarity? If no, restore the missing side.

---

# 26. Review Scorecard

Score each item 0 (absent/wrong), 1 (partial), or 2 (strong). A public candidate should normally score at least 20/24 with no zero in identity, rights, facts, safety, or accessibility.

| Criterion | Review question |
| --- | --- |
| Identity | Is Just One KISS named and framed correctly? |
| Story | Is one authorized story arc clear? |
| Visual hierarchy | Is black first, chrome second, fire third? |
| Focus | Is there one memorable subject/message? |
| Scale | Does it feel theatrical and larger than an ordinary listing? |
| Originality | Is expression original rather than copied or generic? |
| Voice | Is language bold, direct, fan-facing, and intelligible? |
| Action | Is the next step obvious? |
| Facts | Are campaign-specific claims verified and current? |
| Rights | Is independent-tribute framing accurate and clearance documented? |
| Safety/privacy | Are required warnings and consent present and plain? |
| Accessibility | Is the item perceivable, readable, navigable, and adaptable? |

**Automatic hold conditions:** unsupported affiliation; missing required clearance; stale/unverified critical fact; removed or misleading safety advisory; inaccessible critical information; unapproved use of fan media; or contradiction with the controlled source stack.

---

# 27. SSOT Operating Model and Change Control

## 27.1 Recommended layer model

Future marketing should use four linked layers:

1. **Evergreen brand canon:** identity, promise, personality, palette, type roles, visual devices, voice, rights posture.
2. **Approved option menu:** story arcs, headline/CTA families, visual recipes, audience modes, channel adaptations.
3. **Campaign fact overlay:** date, venue, admission, logistics, contacts, offers, expiry, tracking.
4. **Release record:** final copy, asset IDs, rights proof, safety review, approver, channel, dimensions, publication and expiry dates.

This prevents a postcard or app from becoming an accidental competing source of truth.

## 27.2 Recommended record fields

Every future marketing option should carry:

- stable option ID and title;
- intended audience and funnel stage;
- story-arc ID;
- approved headline/copy token references;
- visual recipe and asset references;
- CTA token/reference;
- verified fact references;
- disclaimer/advisory reference;
- rights status and evidence;
- safety status;
- channel and dimensions;
- owner/approver;
- status (`draft`, `needs owner review`, `approved internal`, `approved public`, `archived`);
- last reviewed and expiry dates;
- linked derivatives and superseded versions.

## 27.3 Update sequence

1. Identify the domain and canonical source.
2. Update the most specific authority first.
3. Update runtime language tokens or visual implementation when applicable.
4. Update paired machine-readable SSOT companions and indexes required by repository policy.
5. Check dependent webpages and campaign assets.
6. Run fact, rights, safety, privacy, accessibility, and owner review.
7. Capture preview evidence for perceptible public changes.
8. Publish an immutable release record with expiry/reversal conditions.

## 27.4 Proposed status of this report

Until explicitly owner-approved, this report should remain a **controlled synthesis for marketing review**. On approval, its stable experiential language can seed the future populated compendium documents for `brand_identity`, `brand_voice`, `visual_design_system`, `brand_story_registry`, and `message_and_claim_registry`. Exact runtime copy should continue to live in the language SSOT rather than being forked here.

---

# 28. Source Ledger

## 28.1 Primary authority and current evidence

| Source | Role in this report | Authority caveat |
| --- | --- | --- |
| `README.md` | Project identity, repository hierarchy, public posture, creative summary. | Master orientation; domain authority still applies. |
| `extract/compendium/00_control_and_governance/source_authority_policy.json` | Precedence, conservative conflict resolution, rights/safety constraints. | Status is review/pending controlled approval, but it explicitly encodes the repository’s authority policy. |
| `docs/styleguide.md` | Authoritative public visual, tonal, layout, and page direction. | Human creative authority identified by root README. |
| `docs/ssot/styleguide.json` | Machine-readable companion. | Must remain synchronized with human source. |
| `proto/docs/website_ssot.md` | Active app, section canon, current claims and image policy. | Operational draft/current active website canon. |
| `proto/docs/language.json` | Exact runtime-backed public language and metadata. | Use current tokens; do not substitute report paraphrases. |
| `proto/public/assets/css/site.css` | Implemented colors, fonts, layout, components, responsive and focus behavior. | Implementation evidence, not policy by itself. |
| `proto/public/index.php` and supporting active routes | Implemented story order and visitor-facing composition. | Current active renderer under `proto/public/`. |
| `proto/app/view.php` and `proto/app/site_data.php` | Shared header/footer, forms, navigation, assets. | Runtime implementation evidence. |
| `proto/public/assets/img/` | Approved active visual atmosphere and image families. | Rights/approval remains asset- and use-specific. |

## 28.2 Supporting material studied

- `docs/brand_story_style_guide_inventory.md` — exhaustive prior inventory of owner-approved current direction.
- `proto/docs/css_style_reference.md` — implementation crosswalk for selectors and components.
- `proto/docs/website_inventory.md` — active route and component inventory.
- `docs/ssot/settings/project_identity.json` — starter identity settings.
- `docs/ssot/settings/brand_stories.json` — starter story arcs.
- `docs/ssot/settings/brand_voice.json` — starter voice and vocabulary.
- `docs/ssot/settings/visual_style.json` — starter visual roles and accessibility baseline.
- `docs/ssot/settings/site_architecture.json` — starter route jobs.
- `docs/ssot/settings/marketing_channels.json` — funnel stages and channel inventory.
- `docs/first_run_marketing_campaign.md`, `docs/marketing_image_mockup_specs/`, `docs/marketing_image_prompt_templates/`, and `docs/marketing_image_prompts/` — translation and production planning references.
- `extract/compendium/06_brand_content_and_accessibility/` and `08_public_website_and_audience_data/` — reviewed to confirm they remain unpopulated scaffolds rather than current fact authority.
- Public templates, styles, scripts, fonts, and image assets — inspected to compare documentation with actual implementation.

## 28.3 Evidence versus interpretation

Palette values, type stacks, component behaviors, route order, current phrases, and current facts are evidence from the source stack. Descriptions such as “a compact arena opening inside a dark pavilion,” the five memory anchors, and the marketing-option family summaries are editorial syntheses grounded in that evidence. They capture the current experience but should be owner-reviewed before being elevated into approved reusable copy.

---

# 29. Final Brand Memory Statement

**Just One KISS is the moment shadow turns into fire.**

It is a black stage waiting, a chrome edge catching light, smoke beginning to move, and one towering figure framed like an entrance to another scale of night. It is theatrical menace made welcoming through fan devotion; arena fantasy made reachable through clear facts; dangerous-looking spectacle backed by controlled intent; and a tribute made public through original expression rather than a false claim of official status.

The visitor should feel that something larger than the room is arriving—and that the crowd is not merely watching. The crowd answers. The crowd raises the energy. The crowd carries away the photograph, the clip, the phrase, and the story.

Across a website, a social post, a postcard, a magazine page, a billboard, a landing page, an app, a game, or a piece of merchandise, the same memory should remain:

> **Black. Chrome. Fire. One monumental entrance. One clear invitation. A night the faithful complete together.**
