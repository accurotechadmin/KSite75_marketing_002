# Just One KISS Documentation Repository

**Just One KISS** is a documentation and planning repository for a Gene Simmons tribute theatrical stage event inspired by Gene Simmons/KISS spectacle. The repository brings together show-planning, technical-production, marketing, website, style, asset, and operating knowledge so the project can be developed as a repeatable, bookable, streamlined theatrical production rather than a loose collection of notes.

This README is the master orientation document for the repository. It explains what each document is for, how the documents relate to one another, what rules govern future additions, and how collaborators should use the set without creating conflicts, duplicated facts, or unfinished fragments.

---

## Project at a Glance

| Category | Current direction |
|---|---|
| Project name | Just One KISS |
| Show type | Gene Simmons tribute theatrical stage event |
| Inspiration lane | Gene Simmons/KISS-style theatricality, spectacle, fire, chrome, black, mythic scale |
| Execution model | Show-ready live-production plan |
| Current public focus | Interlochen, Michigan-area event on July 25, 2026 |
| Technical baseline | QLC+ / Q Light Controller Plus, single DMX universe, projection, fog, strobes, staged lighting looks |
| Documentation rule | Every item is either tied to a Timeline Moment ID or marked GENERAL / NOT TIMELINE-SPECIFIC |
| Public-presentation posture | Public-ready, original, theatrical, and audience-facing |

---

## Repository Map

| File | Primary role | Use when you need |
|---|---|---|
| `README.md` | Master repository guide | A full orientation to the document system, workflows, and source-of-truth rules. |
| `docs/knowledge.md` | Concise project knowledge brief | Fast onboarding context for a new collaborator or LLM session. |
| `docs/current_documentation_groundwork_plan.md` | Fresh documentation groundwork plan | Recommended current-document set, legacy preservation method, and streamlined developer-facing documentation strategy. |
| `docs/prompt.md` | LLM session operating prompt | Instructions for future project-development sessions. |
| `docs/qwen_model_routing.md` | Qwen / Ollama / AnythingLLM model-routing guide | Choosing Qwen 3.5 for current-generation quality work and Qwen 2.5 for economy or specialized local roles. |
| `docs/mastergameplan.md` | Full strategic planning architecture | The broadest plan for production, marketing, sales, launch, operations, and documentation. |
| `docs/timeline_moment_registry.md` | Central Timeline Moment ID registry | Assigning, reserving, and governing show-moment IDs across cues, assets, marketing, website content, and reviews. |
| `docs/cue.txt` | Working cue and setlist draft | Current tentative set blocks, song sequence, durations, transition notes, cue seeds, and Cue Bible migration needs. |
| `docs/website_system_plan.md` | Owner and public website system blueprint | Planning the private command center, editable inventory panels, public landing pages, forms, and conversion-oriented content system. |
| `docs/owner_admin_build_readiness.md` | Owner admin build readiness brief | Implementation starting point for the private command center, universal admin schema, first data modules, dashboards, and cue-draft handling. |
| `docs/styleguide.md` | Creative and public-facing style guide | Visual, tonal, layout, copy, page-system, and public-ready creative guidance. |
| `docs/inventory_reference.md` | Authoritative lighting/DMX inventory manual | Detailed fixture identities, addresses, channel maps, QLC+ conventions, recipes, and troubleshooting. |
| `docs/rig.md` | Show-control quick reference for the rig | Short-form patch, programming doctrine, fast tests, and practical operating reminders. |
| `docs/ssot/master_index.json` | Machine-readable SSOT master index | Categorizes every paired SSOT JSON document and its human-readable source for prototype and production owner-site data loading. |
| `docs/ssot/*.json` | Machine-readable SSOT document set | Generic structured JSON companions for repository documents, including Markdown, text, and vendor PDF references. |

---

## Source-of-Truth Hierarchy

The document set is designed to avoid contradictory facts by assigning each document a domain.

1. **This `README.md`** defines the repository structure, collaboration rules, and cross-document conventions.
2. **`docs/mastergameplan.md`** defines the broad project architecture and planning families.
3. **`docs/timeline_moment_registry.md`** is authoritative for Timeline Moment ID families, starter reservations, and timeline-versus-GENERAL classification rules.
4. **`docs/cue.txt`** is the current working source for the tentative set blocks, song sequence, song durations, and raw cue seeds; those entries become canonical show moments only after migration into `docs/timeline_moment_registry.md`.
5. **`docs/inventory_reference.md`** is authoritative for DMX fixture identity, patch addresses, fixture behavior, QLC+ programming practices, and lighting-specific terminology.
6. **`docs/rig.md`** is an show-control digest of the inventory reference; if it conflicts with `docs/inventory_reference.md`, update the quick reference to match the inventory reference.
7. **`docs/styleguide.md`** is authoritative for public-facing tone, visual direction, page strategy, and public presentation posture.
8. **`docs/qwen_model_routing.md`** is authoritative for local Qwen model selection across Ollama and AnythingLLM; it defines Qwen 3.5 as the default quality tier and Qwen 2.5 as the economy/specialist tier.
9. **`docs/prompt.md`** and **`docs/knowledge.md`** are onboarding/session aids; they should summarize the current truth, not introduce new facts that conflict with the planning or technical manuals.

When a new fact appears, put it first in the most specific authoritative document, then update summaries that depend on it.

---

## The Master Organizing Rule: Timeline or GENERAL

Every item in this project must be classified as one of the following:

### Timeline-specific

Use this when an item belongs to a precise moment in the show. It must reference a **Timeline Moment ID**.

Examples:

- A lighting look during a song chorus.
- A fog hit during the opening.
- A costume-change hold.
- A projection clip tied to a transition.
- A strobe cue in the finale.

### GENERAL / NOT TIMELINE-SPECIFIC

Use this when an item belongs to the project ecosystem but not to one exact show moment.

Examples:

- A performer biography photo.
- A venue-buyer PDF.
- A website hero image.
- A spare cable in inventory.
- A public event note.
- A general marketing tagline.

### Standard Timeline ID Families

| Prefix | Domain |
|---|---|
| `PRE-001` | Pre-show |
| `OPEN-001` | Opening |
| `SET-001` | Set-level moment |
| `SONG-001` | Song moment |
| `TRN-001` | Transition |
| `CST-001` | Costume change |
| `VID-001` | Projection/video |
| `LGT-001` | Lighting |
| `FOG-001` | Fog |
| `STR-001` | Strobe |
| `SPK-001` | Spoken/performance moment |
| `FIN-001` | Finale |
| `ENC-001` | Encore |
| `POST-001` | Post-show |
| `GEN` | General / not timeline-specific |

---

## Production Model

The show materials should center on the Gene Simmons tribute performer, the audience experience, and the theatrical presentation. Internal production mechanics stay in technical planning and should not become part of marketing copy, website copy, booking copy, or public performance descriptions.

Technical planning still needs clear cue timing, fallback states, reset procedures, and safe show-control behavior, but those details should support the attraction rather than define it.

---

## Technical Production Summary

The lighting and show-control baseline is documented in detail in `docs/inventory_reference.md` and summarized for show-control users in `docs/rig.md`.

Current rig families include:

- Chauvet DJ COLORstrip Mini represented by the `Bright` channels.
- A four-channel / eight-outlet AC DMX plug controller.
- Fourteen Honeycomb / U'King ZQ01082 / B262-style RGB PAR fixtures.
- Eight dimmable KISS sign elements named `K k I i S s Z z`.
- Eight Chauvet DJ Freedom Par RGBA portable uplights.
- Eight XPCLEOYZ YZ-7LYTYK 14-channel moving-head Rotator fixtures.

Normal show operation is **DMX-controlled**. Avoid standalone, sound-active, master/slave, IR remote, fixture-run, and accidental macro behavior unless a cue intentionally calls for it.

The current working cue/setlist draft in `docs/cue.txt` includes six tentative set blocks, twenty-eight song rows or song-like entries, transition/costume-change notes, a platform-drop seed, a screen-drop seed, finale/encore candidates, and an approximate known-duration total of 1:57:59 using the 2:50 `Let Me Go, Rock 'n' Roll` timing, or 1:59:03 using the 3:54 alternate before the final missing duration and unlisted transition time are added. Treat that file as internal planning until entries are migrated into the Timeline Moment Registry and content/safety reviews are complete.

Critical emergency states include:

- Visual blackout.
- Static safe work light.
- Projection black screen.
- Projection hold screen.
- Fog off.
- Strobes off.
- Music stop.
- System reset.
- Performer safe look.
- Costume-change hold look.

---

## Website and Marketing System

The intended public web presence is a hub-and-spoke landing-page system.

Recommended pages include:

- Main event landing page.
- Ticket / RSVP / inquiry page.
- Gene/Demon-inspired theatrical tribute page.
- Interlochen-area venue or travel page.
- Video / trailer page.
- Photo / costume / spectacle page.
- Technical spectacle page for lights, projection, fog, and strobes.
- About the performer page.
- Press / booking page.
- Fan capture page.
- FAQ / disclaimer page.

All pages should be usable for organic social links, paid ad traffic, YouTube descriptions, venue-buyer review, retargeting, and fan conversion.

---

## Creative Direction Summary

The creative system is intentionally loud and theatrical:

1. **Black first** — stage void, leather, darkness, scale.
2. **Chrome second** — hardware, studs, armor, frames, bevels.
3. **Fire third** — red, orange, gold, yellow, heat, urgency.
4. **Mythic scale always** — arena energy, comic-book drama, monster-stage spectacle.
5. **Ordinary never** — avoid generic local-band, arts-center, or polite brochure language.

The default visual blend is Alive!-style live energy, Destroyer-scale fantasy apocalypse, and Demon-focused menace. Secondary style lanes may support specific pages, but every public expression should feel like a theatrical event rather than a generic listing.

---

## Public Presentation Standard

Public materials should keep the attraction centered on the Gene Simmons tribute performer, the event experience, the audience promise, and verified show details. Internal review standards belong in production planning, not in fan-facing copy.

---

## Asset Encyclopedia Standard

Every asset should be catalogued consistently. Use the following fields for photos, videos, props, costumes, documents, graphics, venue media, ads, cue media, and technical references:

| Field | Purpose |
|---|---|
| Asset name | Human-readable title. |
| Asset type | Photo, video, prop, costume, document, graphic, fixture, etc. |
| Physical/digital status | Whether it exists physically, digitally, or both. |
| Category | Costume, lighting, marketing, website, technical, venue, etc. |
| Description | What the asset is. |
| Visual traits | Useful visual notes for design and marketing. |
| Timeline Moment ID or GENERAL | Required classification. |
| Potential website use | Where it might appear online. |
| Potential marketing use | Ads, social, email, trailer, press, retargeting, etc. |
| Content status | Owned, cleared, needs review, reference only, unknown. |
| Owner/source | Who owns or supplied it. |
| Needed edits | Retouching, resizing, cropping, color, masking, captions. |
| Needed retakes | Any missing angles or quality issues. |
| Priority | High, medium, low. |
| Notes | Operational or creative comments. |

---

## How to Update This Document Set

Use this workflow whenever adding or refining documentation:

1. **Identify the domain.** Technical lighting details belong in `docs/inventory_reference.md`; public style belongs in `docs/styleguide.md`; session guidance belongs in `docs/prompt.md`; strategic planning belongs in `docs/mastergameplan.md`.
2. **Classify each item.** Assign a Timeline Moment ID or mark it GENERAL.
3. **Avoid duplicate authority.** Summaries may repeat essential facts, but only one document should be treated as the detailed source for a given topic.
4. **Resolve contradictions immediately.** If two files disagree, update the non-authoritative file and note the canonical source.
5. **Finish sections before committing.** Do not leave blank future-fill blocks, partial lists, or vague future intentions unless they are explicitly framed as planned future deliverables.
6. **Preserve safety posture.** Technical, venue, content, and public-facing claims should be conservative and reviewable.
7. **Keep language role-specific.** Show-control documents should be direct and procedural; marketing documents should be fan-facing and theatrical; strategy documents should be comprehensive and structured.

---

## Current Document Health

The set has been normalized so each file has a clearer role:

- `docs/knowledge.md` is now a concise onboarding brief instead of a rough seed summary.
- `docs/prompt.md` has an explicit document title and remains focused on LLM operating behavior.
- `docs/rig.md` has an explicit title and remains a quick show-control reference rather than a full manual.
- `docs/inventory_reference.md` remains the detailed lighting authority.
- `docs/styleguide.md` remains the public creative authority.
- `docs/mastergameplan.md` remains the strategic planning backbone.
- `README.md` now acts as the master repository README and cross-document map.

---

## Immediate Next Recommended Documents

The current repository is strong as a planning foundation. The next highest-value additions are:

1. **Timeline Moment Registry** — the canonical show-moment index.
2. **Cue Bible** — migrate `docs/cue.txt` into approved lighting, projection, fog, strobe, playback, show-control actions, fallback states, and rehearsal timing by Timeline Moment ID.
3. **Asset Encyclopedia** — complete media, prop, costume, and technical asset catalogue.
4. **Website Content Map** — page-by-page copy, assets, CTAs, disclaimers, and conversion goals.
5. **Booking / Press Kit** — venue-buyer-facing materials, show description, technical summary, photos, and contact process.
6. **Public Presentation Review Packet** — public-language rules, prohibited claims, disclaimer language, and visual boundary guide.
7. **Run-of-Show Technical Manual** — cue procedures, emergency states, reset plans, and rehearsal checklist.
8. **Fresh Current Documentation Set** — create the streamlined base described in `docs/current_documentation_groundwork_plan.md`, then treat older material as legacy reference.

---

## Collaboration Checklist

Before considering a future documentation update complete, verify:

- [ ] The correct source-of-truth document was updated.
- [ ] Summaries in related files still match the authoritative file.
- [ ] Every new item is Timeline-specific or GENERAL.
- [ ] No unfinished headings, unresolved action markers, blank future-fill blocks, or contradictions remain.
- [ ] Public language stays fan-facing, event-focused, and free of internal review language.
- [ ] Technical changes preserve DMX-only normal operation and emergency-state planning.
- [ ] Show-control instructions remain executable by the approved production plan.
- [ ] Marketing language remains theatrical, direct, fan-facing, and non-generic.

---

## Machine-Readable SSOT Companion

The repository now includes a machine-readable SSOT layer in `docs/ssot/`. The master index is `docs/ssot/master_index.json`, and each human-readable source document has a paired JSON companion such as `docs/ssot/readme.json`.

These JSON files are seed data contracts for owner-facing website prototypes, public-site prototypes, generated checklists, booking/EPK materials, marketing materials, and future production data files. Prototype layouts may change freely, but the facts should be loaded from the SSOT layer so data is not retyped, forked, or lost. When any human-readable source document changes, update its paired JSON companion and `docs/ssot/master_index.json` in the same change.
