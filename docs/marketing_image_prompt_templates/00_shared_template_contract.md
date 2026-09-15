# Shared Contract for Adaptable Marketing Image Prompts

Use this contract with every stage-specific template in this folder.

## 1. Campaign inputs

- Campaign stage: `[awareness, interest, consideration, conversion, retention, nurture, custom]`
- Project type: `[event, product, service, organization, destination, release, fundraiser, membership, educational program, custom]`
- Project or brand name: `[project name, brand name, campaign name, write your own]`
- Featured subject: `[person, product, venue, experience, abstract concept, object, environment, custom]`
- Audience: `[new audience, warm audience, returning audience, customers, attendees, buyers, partners, community members, custom]`
- Audience action: `[remember, learn more, compare, plan, register, inquire, purchase, subscribe, visit, share, return, custom]`
- Primary objective: `[reach, recognition, engagement, traffic, lead generation, registration, sales, attendance, retention, education, custom]`
- Classification: `[campaign-level, general/not timeline-specific, timeline-specific: insert ID, asset-level, custom]`
- Geographic scope: `[local, regional, national, international, online-only, location-independent, custom]`
- Language and locale: `[English-US, English-CA, French-CA, Spanish, bilingual, custom]`

## 2. Verified facts and offers

Fill only with confirmed information. Use `[omit]` when a field does not apply.

- Date or date range: `[verified date, verified date range, ongoing, omit]`
- Time and time zone: `[verified time and time zone, multiple times, omit]`
- Location: `[verified venue, verified city/region, online, hybrid, omit]`
- Address or destination detail: `[verified address, verified route/URL, omit]`
- Price or admission: `[verified price, free, donation-based, quote required, omit]`
- Availability: `[verified availability, registration open, limited only if verified, ongoing, omit]`
- Eligibility or audience limits: `[verified requirements, age guidance, capacity rule, geographic limit, omit]`
- Offer or benefit: `[verified offer, verified benefit, verified feature, write your own]`
- Supporting facts: `[fact 1, fact 2, fact 3, omit unused facts]`
- CTA destination: `[verified URL, registration page, product page, directions page, contact route, app route, QR destination, custom]`

Do not invent dates, prices, availability, capacity, addresses, affiliations, guarantees, statistics, testimonials, awards, credentials, safety assurances, accessibility claims, shipping times, performance claims, or legal terms.

## 3. Selectable visible-copy structure

Choose one option or write an original value for each relevant field.

- Eyebrow: `[verified category, verified date, campaign label, short context line, omit, write your own]`
- Primary headline: `[headline option 1, headline option 2, headline option 3, write your own]`
- Secondary headline: `[supporting line option 1, supporting line option 2, omit, write your own]`
- Subhead: `[one-sentence audience promise, concise verified description, omit, write your own]`
- Fact chips: `[fact chip 1, fact chip 2, fact chip 3, omit unused chips]`
- CTA: `[learn more, get details, register, join updates, shop now, request a quote, get directions, contact us, write your own]`
- Supporting note: `[privacy note, eligibility note, safety note, legal note, availability note, omit if not applicable, write your own]`
- Disclaimer: `[verified relationship disclosure, material-terms disclosure, rights notice, omit if counsel/review confirms unnecessary, write your own reviewed text]`

Visible copy should be rendered as accurate, readable typography in the final production file. Image-generation output may be used as a compositional reference, but final text should be typeset and proofread whenever accuracy matters.

## 4. Selectable visual system

- Visual style: `[cinematic, documentary, editorial, minimalist, maximalist, luxury, playful, technical, retro, futuristic, collage, illustrated, photographic, custom]`
- Mood: `[energetic, urgent, trustworthy, inviting, mysterious, celebratory, calm, premium, practical, community-focused, custom]`
- Color system: `[dark high-contrast, light editorial, monochrome, warm natural, cool technical, brand palette: insert values, custom]`
- Material language: `[paper, glass, chrome, fabric, wood, concrete, neon, organic texture, clean digital surfaces, custom]`
- Lighting: `[soft daylight, dramatic rim light, studio light, neon glow, golden hour, flat graphic light, custom]`
- Image treatment: `[full-bleed photography, isolated subject, environmental scene, geometric composition, typographic poster, card grid, split layout, custom]`
- Type treatment: `[oversized display, editorial serif, modern sans serif, condensed headline, handwritten accent, brand type system, custom]`
- Brand assets: `[approved logo, approved mark, approved product imagery, approved supplied photography, no logo, custom]`
- Avoid: `[unapproved logos, protected characters, exact trade dress, unlicensed photos, misleading interface elements, illegible microtext, custom additions]`

## 5. Master export families

Retain the selected placement's size and crop logic unless the publishing platform currently requires another specification. Reconfirm specifications before paid spend or final export.

| Export family | Planning size | Aspect ratio | Typical use |
| --- | ---: | ---: | --- |
| Master vertical poster | 2160x2700 | 4:5 | Mobile-first master and print-derived crops. |
| Square social | 1440x1440 | 1:1 | Meta, Instagram, carousel, X/Bluesky square, thumbnails. |
| Vertical feed | 1440x1800 | 4:5 | Facebook/Instagram mobile feeds and organic posts. |
| Story/reel still | 1080x1920 or 1440x2560 | 9:16 | Stories, Reels, vertical discovery, short-form placements. |
| Wide landscape | 1200x628 or 1440x754 | 1.91:1 | LinkedIn, X cards, Google responsive/display/discovery, link previews. |
| Google square | 1200x1200 | 1:1 | Responsive display and multi-asset campaigns. |
| Google portrait | 960x1200 | 4:5 | Mobile feed placements. |
| Small display banner | 300x250 | 6:5 | Simplified retargeting/display with minimal copy. |
| Event/header crop | 1920x1005 or 1500x500 | platform-dependent | Event covers and header-style crops. |
| Print handout/flyer | 8.5x11 in and 4x6 in | print | Local print, handouts, counter cards, or mailers after print review. |

## 6. Crop and safe-zone behavior

- Square and 4:5: keep the primary headline, subject, and highest-priority fact inside the central 70%.
- 9:16: keep headline, subject face/product focal point, CTA, and critical facts away from top and bottom interface overlays.
- 1.91:1: simplify the image, use a strong left or right text block, and move secondary facts into a horizontal strip.
- 300x250: use one short headline, one core fact, one brand identifier, and one short CTA. Remove paragraphs, multi-card systems, and fine disclaimers; ensure required material terms remain available in compliant form.
- Header crops: maintain negative space for platform overlays and avoid placing essential text against edges.
- Print: include adequate bleed, safe margins, high-resolution imagery, reviewed QR codes, and readable legal/safety text.
- Multi-crop families: do not merely center-crop. Recompose type, subject, fact chips, and CTA for each aspect ratio.

## 7. Prompt organization

Every stage template uses this order:

1. Campaign role
2. Fill-in campaign variables
3. Selectable copy
4. Art direction
5. Composition notes
6. Platform adaptations
7. Guardrails and verification
8. Output request

## 8. Rights, safety, legal, privacy, and factual guardrails

Preserve the following checks whenever relevant:

- Use only `[owned, licensed, public-domain, commissioned, generated-and-reviewed, otherwise approved]` visual assets.
- Do not reproduce unapproved logos, protected characters, celebrity likenesses, signature costumes/makeup, album/package art, trade dress, copyrighted artwork, or official-looking affiliation cues.
- Disclose material relationships, sponsorships, tribute status, simulations, AI-generated elements, or other legally relevant context when required.
- Include applicable warnings for `[loud sound, flashing/strobe effects, fog/smoke, allergens, physical activity, age limits, alcohol, transportation, weather exposure, medical risk, financial risk, custom]` using reviewed language.
- Do not imply guaranteed outcomes, guaranteed access, guaranteed availability, medical/legal/financial certainty, official endorsement, or safety that has not been verified.
- Ensure CTA destinations contain required privacy, consent, refund, shipping, eligibility, accessibility, and material-terms information.
- Check contrast, minimum type size, alt-text plan, caption needs, and information hierarchy for accessibility.
- Reverify platform advertising policies and current dimensions before publication.

## 9. Output request template

Create `[number of concepts, 1, 2, 3, custom]` original still-image composition(s) for `[platform/placement]` at `[dimensions/aspect ratio]`.

Use the selected campaign inputs, copy, style, and factual fields above. Preserve crop-safe hierarchy for the requested placement. Provide:

- `[image-only composition, image with editable text zones, finished typeset layout, custom]`
- `[single master, full crop family, platform-specific variants, carousel sequence, custom]`
- `[background-only version, text-free version, layered-production guidance, omit, custom]`
- `[alt-text draft, caption draft, filename pattern, export checklist, custom]`

Do not add unprovided facts or replace bracketed choices with project-specific assumptions.
