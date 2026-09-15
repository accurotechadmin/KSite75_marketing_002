# How to Use the First Mockup Marketing Image Spec Set

This folder is a production bridge between the generic marketing image prompt templates and finished Just One KISS marketing materials. Use it when you want to brief a designer, write an image-generation prompt, make a layout wireframe, or create an asset record for the first polished campaign direction.

## 1. What this spec set gives you

The mockup set has already made the first round of creative choices for you:

- Campaign concept: the wild theatrical beast has been tamed into a polished, suited, professional event-campaign presence.
- Shared facts: July 25, 2026; Cycle Moore Legacy; Interlochen / US 31; free show; no ticket required; RSVP/update-list appreciated; camping and safety notes.
- Shared style: black, chrome, fire, tailored fabric, road-case texture, controlled smoke, polished editorial typography, and no official-looking marks.
- Five campaign batches: awareness, interest, consideration, conversion, and retention/nurture.
- Practical production details: placements, dimensions, crop logic, copy, visual direction, guardrails, alt-text drafts, and filename patterns.

You do not need to go back to the generic templates unless you want to create a new campaign variable set later.

## 2. Fastest path: build one ad

Use this sequence when making a single ad or mockup.

1. Open `00_shared_mockup_data.md` and copy the relevant shared facts, style rules, and guardrails.
2. Pick the stage file that matches the job:
   - `01_awareness_mockup_spec.md` for announcement and date-save creative.
   - `02_interest_mockup_spec.md` for spectacle and value proof.
   - `03_consideration_mockup_spec.md` for practical planning details.
   - `04_conversion_mockup_spec.md` for RSVP/update-list action.
   - `05_retention_nurture_mockup_spec.md` for reminders, sharing, and warm-audience follow-up.
3. Pick one placement from the stage file's platform adaptation table.
4. Copy the final selected copy from the stage file.
5. Copy the art direction and composition notes.
6. Add the destination URL, QR code, or route that is current at production time.
7. Produce the mockup or image-generation prompt.
8. Check the guardrails before exporting.
9. Save the output using the filename pattern in the stage file.
10. Create or update an asset record using the shared asset-record defaults.

## 3. Fastest path: build all five batches

Use this sequence when producing the whole first campaign set.

1. Start with the shared campaign data.
2. Produce the master vertical poster or square social version for each batch first.
3. Review all five masters together for visual consistency.
4. Recompose each approved master into the required crop family.
5. Create a small-display version last, because those require the most copy reduction.
6. Create print or QR versions only after destinations and QR codes are final.
7. Run fact, rights, safety, and accessibility review before publication.

Recommended first production order:

| Order | Batch | First asset to produce | Why |
| ---: | --- | --- | --- |
| 1 | Awareness | 1440x1440 square social | Establishes campaign recognition and date memory. |
| 2 | Conversion | 1440x1440 square update-list card | Establishes the no-ticket RSVP action. |
| 3 | Consideration | 1440x2560 story planning card | Gives practical planning details for mobile audiences. |
| 4 | Interest | 1440x1800 proof poster | Sells spectacle and polish after the facts are clear. |
| 5 | Retention/nurture | 1440x1440 road-case module card | Gives warm audiences a shareable return path. |

## 4. Prompt assembly recipe

When using an image-generation tool, assemble the prompt from these blocks in this order.

### Block A - task and placement

State exactly what to create, including placement and dimensions.

Example:

```text
Create one polished still-image marketing mockup for Just One KISS.
Placement: Meta feed square.
Canvas: 1440x1440 px, 1:1.
Campaign stage: Awareness.
```

### Block B - shared campaign world

Use the shared visual world from `00_shared_mockup_data.md`.

Example:

```text
Use a cinematic editorial event-ad style: black tailored fabric, chrome hardware, road-case texture, polished truss metal, controlled red-gold smoke, gloss-black cards, gold accents, oversized condensed white display type, and clean utility text.
The creative premise is that the wild theatrical beast has been tamed and now wears a suit while smiling politely.
```

### Block C - selected stage copy

Use the final selected copy from the chosen stage file.

Example for awareness:

```text
Visible copy:
Eyebrow: A FREE THEATRICAL ROCK TRIBUTE EVENT
Primary headline: THE MONSTER HAS A RESERVATION.
Secondary headline: JULY 25, 2026
Fact chips: Free show / No ticket required / Interlochen / US 31
CTA: Save July 25
Supporting note: Independent theatrical rock tribute. No outside partnership claimed or implied.
```

### Block D - art direction and composition

Copy the stage art direction, then add placement-specific composition notes.

Example:

```text
Create a black tailored-suit silhouette with chrome cuff or lapel hardware, red-orange smoke glow, a gold date seal, and precise white event-poster typography. Keep headline and date in the central 70%, fact chips in the lower third, and CTA in the lower safe zone.
```

### Block E - guardrails

Always include the non-negotiable guardrails.

Example:

```text
Do not use official KISS logos, official album art, exact protected makeup, official costumes copied exactly, restricted fonts, platform logos, celebrity likeness replication, paid-ticket language, VIP language, scarcity claims, or any official sponsorship/authorization implication. Do not invent show time, parking, traffic, weather, security, accessibility, capacity, or safety assurances.
```

### Block F - output request

Ask for production usefulness, not just an attractive image.

Example:

```text
Output a polished mockup direction with clear editable text zones, readable hierarchy, crop-safe layout, and a text-free background alternate recommendation. Keep all mission-critical text legible.
```

## 5. Designer brief recipe

When briefing a human designer, give them these pieces:

1. The shared mockup data file.
2. The chosen stage spec.
3. The specific placement and dimensions.
4. The exact final selected copy.
5. The art direction paragraph.
6. The platform adaptation row.
7. The guardrails and verification section.
8. The filename pattern.
9. The required asset-record fields.

A designer should not have to choose the campaign strategy; the spec has already chosen it. Their job is to execute and refine the visual solution.

## 6. Asset record checklist

Create one record per produced output, even when outputs are crop variants of the same concept.

Minimum record fields:

- Asset name.
- Batch: Awareness, Interest, Consideration, Conversion, or Retention/Nurture.
- Campaign job.
- Platform and placement.
- Dimensions and aspect ratio.
- Filename.
- Timeline classification: `GEN`.
- Source spec file.
- Copy used.
- CTA destination.
- Image source: designer-created, generated-and-reviewed, or approved supplied image.
- Rights status.
- Safety status.
- Fact status.
- Accessibility notes, including alt text.
- Owner.
- Review date.
- Notes and next action.

## 7. Review gates before publication

Do not publish, print, or buy media until these are complete:

1. Fact review: event date, location, address, admission, camping line, safety language, and destination URL.
2. Rights review: no official logos, exact protected makeup, official photos, copied costumes, restricted fonts, or implied endorsement.
3. Safety review: loud sound, bright lights, fog, and flashing/strobe-style warning included where attendance or RSVP decisions are being prompted.
4. Accessibility review: readable contrast, large enough type, alt text, and no critical facts trapped only in decorative image detail.
5. Platform review: current dimensions, file-size rules, ad policy, text/crop behavior, and destination requirements.
6. Privacy/consent review: update-list forms, QR destinations, and email variants match the real form and consent language.

## 8. How to make the next variable set later

When you are ready to spin up a different original campaign direction, do not overwrite this folder. Create a sibling folder or new dated variable set.

Recommended naming pattern:

- `docs/marketing_image_mockup_specs_v02/`
- `docs/marketing_image_campaign_variables/YYYY-MM-DD_campaign_name/`
- `docs/marketing_image_prompt_runs/YYYY-MM-DD_campaign_name/`

For the next variable set, change the shared concept first, then refill each of the five stage templates. Keep verified facts and guardrails unless the source of truth changes.

## 9. One complete example: awareness square prompt

```text
Create one polished still-image marketing mockup for Just One KISS.
Placement: Meta feed square.
Canvas: 1440x1440 px, 1:1.
Campaign stage: Awareness.

Use a cinematic editorial event-ad style: black tailored fabric, chrome hardware, road-case texture, polished truss metal, controlled red-gold smoke, gloss-black cards, gold accents, oversized condensed white display type, and clean utility text. The creative premise is that the wild theatrical beast has been tamed and now wears a suit while smiling politely.

Visible copy:
Eyebrow: A FREE THEATRICAL ROCK TRIBUTE EVENT
Primary headline: THE MONSTER HAS A RESERVATION.
Secondary headline: JULY 25, 2026
Subhead: Just One KISS brings a polished black-chrome-fire tribute night to Cycle Moore Legacy.
Fact chips: Free show / No ticket required / Interlochen / US 31
CTA: Save July 25
Supporting note: Independent theatrical rock tribute. No outside partnership claimed or implied.

Create a black tailored-suit silhouette with chrome cuff or lapel hardware, red-orange smoke glow, a gold date seal, and precise white event-poster typography. Keep the headline and date in the central 70%, fact chips in the lower third, and CTA in the lower safe zone.

Do not use official KISS logos, official album art, exact protected makeup, official costumes copied exactly, restricted fonts, platform logos, celebrity likeness replication, paid-ticket language, VIP language, scarcity claims, or any official sponsorship/authorization implication. Do not invent show time, parking, traffic, weather, security, accessibility, capacity, or safety assurances.

Output a polished mockup direction with clear editable text zones, readable hierarchy, crop-safe layout, and a text-free background alternate recommendation. Keep all mission-critical text legible.
```
