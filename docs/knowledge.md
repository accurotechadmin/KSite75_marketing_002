# Just One KISS Project Knowledge Brief

**Purpose:** Fast onboarding context for a new collaborator or LLM session. This brief is intentionally concise; use `README.md` for the master repository overview, `docs/mastergameplan.md` for the full planning architecture, `docs/inventory_reference.md` for authoritative DMX details, `docs/rig.md` for show-control rig quick reference, `docs/styleguide.md` for public-facing creative direction, `docs/cue.txt` for the current working cue/setlist draft, and `docs/prompt.md` for session instructions.

## 1. Core Project Identity

**Project title:** Just One KISS

**Project type:** A Gene Simmons tribute theatrical stage event inspired by Gene Simmons/KISS spectacle, persona, and classic-rock mythology. It is not a generic cover-band concept; it should feel like a repeatable, bookable theatrical event.

**Primary audience:** KISS fans, Gene Simmons fans, classic-rock fans, local and regional eventgoers, venue buyers, and travelers.

**Current promotional focus:** Fans near, or willing to travel to, Interlochen, Michigan for the July 25, 2026 event.

**Emotional tone:** Simple, bombastic, over-the-top, theatrical, high-impact, fan-facing, black-dominant, chrome-edged, fire-lit, mythic, and never ordinary.

## 2. Production Model

The live show documentation should support a streamlined, show-ready production without making staffing headcount part of the show identity. Public and marketing language should center on the Gene Simmons tribute performer, the audience experience, and the theatrical presentation.

Technical planning may track cue timing, reset behavior, emergency states, and show-control needs, but those mechanics should not define the attraction in public-facing materials.

## 3. Master Documentation Rule

Every project item must be classified as one of two types:

1. **Timeline-specific:** tied to a precise show moment and assigned a Timeline Moment ID.
2. **GENERAL / NOT TIMELINE-SPECIFIC:** part of the broader project ecosystem, not tied to one exact show moment.

This applies to songs, costumes, cues, props, photos, videos, website media, ads, social posts, venue materials, rehearsal notes, physical inventory, digital inventory, and post-show reviews.

## 4. Timeline Moment ID System

The central planning artifact is the **Just One KISS - Timeline Moment Registry**. Standard ID families are:

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

## 5. Technical Production Baseline

The show-control baseline includes QLC+ / Q Light Controller Plus, one DMX universe, projection video, four fog machines, eight strobes, and a lighting rig documented in `docs/inventory_reference.md`. The lighting inventory includes a Chauvet COLORstrip Mini, Honeycomb RGB PAR-style fixtures, KISS sign dimmer channels, Chauvet Freedom Par RGBA uplights, XPCLEOYZ Rotator moving heads, and AC plug-control channels.

Emergency looks and states should include visual blackout, safe work light, projection black screen, projection hold screen, fog off, strobes off, music stop, system reset, performer safe look, and costume-change hold look.


## 5.1 Current Working Cue / Setlist Draft

`docs/cue.txt` is the newest show-flow source and now contains the normalized working cue and setlist draft. It currently proposes six internal set blocks (`SET-001` through `SET-006`), twenty-eight song rows or song-like entries (`SONG-001` through `SONG-028`), transition/costume-change seeds, a platform-drop seed, a screen-drop seed, finale/encore candidates, and a known listed-duration total of approximately 1:57:59 using the 2:50 `Let Me Go, Rock 'n' Roll` timing, or 1:59:03 using the 3:54 alternate before the missing final duration and unlisted transition time.

Treat `docs/cue.txt` as internal planning, not a final setlist. Each item must be migrated into `docs/timeline_moment_registry.md`, assigned performer/show-control actions, reviewed for content/safety, and validated against the approved live-production model before it becomes show-ready.

## 6. Website and Marketing Direction

The digital system should include a robust main landing page plus focused supporting pages for tickets, event inquiry, Gene/Demon-inspired theatrical positioning, Interlochen-area context, trailer/video, photo/costume/spectacle content, technical spectacle, performer biography, press/booking, fan capture, FAQ, and public disclaimers.

Campaign assets must support Facebook, Instagram, YouTube, Google Ads, image campaigns, video campaigns, teaser campaigns, and venue-buyer outreach.

## 7. Creative Direction

The public style system follows this hierarchy:

1. **Black first:** stage void, leather, shadow, theatrical weight.
2. **Chrome second:** studs, armor, hardware, bevels, frames.
3. **Fire third:** red, orange, gold, yellow, heat, pyrotechnic energy.
4. **Mythic scale always:** arena attitude, comic-book drama, monster-stage presence.

Default blend: Alive!-style live energy, Destroyer-scale fantasy apocalypse, and Demon-focused menace. Dressed to Kill informs origin/backstory material; Love Gun informs fan-service and poster maximalism.

## 8. Public Presentation Posture

Public materials should be original, theatrical, fan-facing, and centered on the Gene Simmons tribute performer, the event facts, and the audience promise. Internal review standards should stay inside production planning rather than appearing in audience-facing copy.

## 9. Asset Encyclopedia Standard

Every uploaded or created asset should be catalogued with: asset name, asset type, physical/digital status, category, description, visual traits, Timeline Moment ID or GENERAL status, website use, marketing use, content status, owner/source, needed edits, needed retakes, priority, and notes.

## 10. Mature Document Ecosystem

The repository should grow toward these planning families: master show realization, presentation/content/public identity, technical production/show control, asset/inventory/packing/maintenance, performance/rehearsal/streamlined execution, venue/safety/compliance, website/SEO/digital presence, marketing/media/content engine, sales/booking/buyer conversion, finance/administration/project management, and launch/feedback/continuous improvement.

---

## Machine-Readable SSOT Companion

This human-readable document has a paired SSOT JSON companion at `docs/ssot/knowledge.json`. That JSON file is the stable machine-readable seed for website prototypes, owner-admin views, generated checklists, booking materials, marketing materials, and future production data files.

Use the SSOT companion when building software or structured outputs so facts can be reused across multiple website styles without being retyped, forked, or lost. When this document changes, update `docs/ssot/knowledge.json` and `docs/ssot/master_index.json` in the same change.

## 11. Local LLM / Qwen Model Routing

Local AnythingLLM and Ollama workflows should follow `docs/qwen_model_routing.md`. Treat Qwen 3.5 as the default current-generation Qwen tier for cross-document reasoning, source-of-truth updates, coding, public copy, safety-sensitive show-control language, and final review. Treat Qwen 2.5 as the economy or specialist tier for lower-cost extraction, tagging, table normalization, short summaries, inexpensive variants, and legacy workflows that were tuned around 2.5 behavior.

When a Qwen 2.5 workflow produces text that would become canonical documentation, public-facing copy, owner-site behavior, or show-control guidance, route it through a Qwen 3.5 review before accepting it as final.
