# Just One KISS - Timeline Moment Registry

**Purpose:** This is the central registry for assigning, reserving, and describing Timeline Moment IDs across the Just One KISS show, website, marketing, documentation, and inventory ecosystem.

Every project item must be classified as either:

1. **Timeline-specific** — tied to a specific show moment and assigned a Timeline Moment ID.
2. **GENERAL / NOT TIMELINE-SPECIFIC** — part of the broader project but not tied to one exact show moment; use `GEN`. Ambiguous records also use `GEN` with `status: needs_timeline_review` until the timeline assignment is resolved.

This registry is intentionally conservative. Do not invent final creative decisions here unless they have been approved. Placeholder examples must be marked **ARBITRARY EXAMPLE ONLY - NOT A FINAL DECISION**.

---

## Classification Rule

Before adding any asset, cue, document row, website item, marketing clip, show-control action, or rehearsal note, ask:

> Is this tied to a specific show moment?

| Answer | Required classification |
|---|---|
| Yes | Assign or request a Timeline Moment ID. |
| No | Mark it `GEN` / GENERAL / NOT TIMELINE-SPECIFIC. |
| Unsure | Mark `GEN` and set `status: needs_timeline_review` until the show timeline is clarified. |

---

## ID Families

| Prefix | Domain | Use for |
|---|---|---|
| `PRE-###` | Pre-show | Doors, walk-in atmosphere, house announcements, pre-show projection, fan capture. |
| `OPEN-###` | Opening | First reveal, first blackout, overture, opening entrance, first major look. |
| `SET-###` | Set-level moment | Major act blocks, themed sections, sequence containers. |
| `SONG-###` | Song moment | Full songs or song-specific performance beats. |
| `TRN-###` | Transition | Bridges between songs, resets, scene shifts, instrumental moves. |
| `CST-###` | Costume change | Any performer costume-change beat or hold. |
| `VID-###` | Projection/video | Projection clips, video loops, black screens, hold screens, trailer moments. |
| `LGT-###` | Lighting | Lighting looks, chases, specials, blackout, safe light. |
| `FOG-###` | Fog | Fog hits, fog builds, fog stops, machine-specific notes. |
| `STR-###` | Strobe | Strobe hits, strobe chases, emergency strobe-off states. |
| `SPK-###` | Spoken/performance | Spoken address, audience interaction, persona beats, crowd prompts. |
| `FIN-###` | Finale | Final song, final visual hit, final blackout, bow setup. |
| `ENC-###` | Encore | Encore tease, encore song, encore exit, final fan moment. |
| `POST-###` | Post-show | Meet-and-greet, load-out, review capture, feedback collection. |
| `GEN` | General | Not tied to one show moment. |

---

## Registry Columns

Use these columns when maintaining the master registry as a table, spreadsheet, database, or Markdown list.

| Column | Required | Notes |
|---|---:|---|
| Timeline Moment ID | Yes | Use one of the approved prefix families or `GEN`. |
| Moment name | Yes | Short human-readable label. |
| Moment type | Yes | Pre-show, song, transition, lighting, fog, etc. |
| Parent moment ID | Conditional | Use when a cue belongs inside a song, set, transition, or finale. |
| Timeline order | Conditional | Use numeric ordering once the show structure is known. |
| Status | Yes | Proposed, reserved, approved, rehearsing, show-ready, retired. |
| Performer action | Yes | What the the Gene Simmons tribute performer does. Use `None` if not applicable. |
| Show-control action | Yes | What the show-control system does. Use `None` if not applicable. |
| Lighting / QLC+ note | Conditional | QLC+ function, scene, chaser, virtual console button, or safety state. |
| Projection / video note | Conditional | File, playlist, loop, blackout, hold, or screen state. |
| Fog note | Conditional | Fog machine group, duration, lockout, or emergency stop note. |
| Strobe note | Conditional | Strobe pattern, duration, photosensitivity warning, or off state. |
| Costume / prop note | Conditional | Costume, prop, handoff, preset, quick-change, or storage note. |
| Asset links | Conditional | Related physical/digital inventory IDs or filenames. |
| Content / safety review | Yes | Clear, needs review, reference only, unsafe, not approved. |
| Website / marketing use | Conditional | Trailer, hero image, ad clip, social post, press packet, etc. |
| Notes | Optional | Keep concise; move long details to downstream documents. |

---

## Starter Registry

These are starter reservations, not final show decisions.

| Timeline Moment ID | Moment name | Moment type | Parent moment ID | Timeline order | Status | Performer action | Show-control action | Content / safety review | Notes |
|---|---|---|---|---:|---|---|---|---|---|
| `GEN` | Project-wide website hub | General | — | — | Proposed | None | Maintain website/media readiness as assigned. | Needs public-presentation review | Main landing page and hub materials are not tied to one exact show moment unless a specific clip or cue is used. |
| `GEN` | Public disclaimer language | General | — | — | Proposed | None | None | Needs content review | Use for website, ads, EPK, and booking packets. |
| `PRE-001` | Pre-show atmosphere | Pre-show | — | 10 | Reserved | Offstage / pre-entrance readiness. | Run house-safe lighting, walk-in audio/video if approved, and safety checks. | Needs venue/safety review | ARBITRARY EXAMPLE ONLY - NOT A FINAL DECISION. |
| `OPEN-001` | Opening reveal | Opening | — | 20 | Reserved | Enter or reveal according to approved blocking. | Trigger opening lighting/projection/fog sequence only when safe. | Needs safety and content review | ARBITRARY EXAMPLE ONLY - NOT A FINAL DECISION. |
| `CST-001` | First costume-change hold | Costume change | — | 50 | Reserved | Complete quick-change or reset. | Hold costume-change look; keep fog/strobes off unless explicitly approved. | Needs safety review | Supports the streamlined production model. |
| `LGT-001` | Visual blackout safety state | Lighting | — | — | Reserved | Move to safe position if needed. | Trigger blackout only when blackout is planned or emergency-safe. | Needs venue/safety review | Emergency state reference; not necessarily a performance cue. |
| `VID-001` | Projection black screen state | Projection/video | — | — | Reserved | None | Trigger black screen state for reset or emergency. | Needs safety review | Emergency and reset reference. |
| `FOG-001` | Fog off emergency state | Fog | — | — | Reserved | None | Kill fog output and confirm machines are idle. | Needs safety review | Emergency state reference. |
| `STR-001` | Strobes off emergency state | Strobe | — | — | Reserved | None | Kill all strobe output and confirm no active chaser/macro. | Needs safety review | Emergency state reference. |
| `POST-001` | Post-show feedback capture | Post-show | — | 900 | Reserved | Greet audience only if scheduled and safe. | Support reset, feedback collection, and load-out sequence. | Needs privacy/release review | Can feed post-show review and improvement tracker. |

---


## Current Working Cue Draft Migration

`docs/cue.txt` is the current working cue and setlist draft. It is not the final approved setlist, but it is now the newest concrete show-flow source and must be considered when building the registry, Cue Bible, show-control run sheets, rehearsal logs, and website/media planning records.

The current draft proposes:

| Draft element | Registry treatment | Notes |
|---|---|---|
| Six set blocks | Reserve or create `SET-001` through `SET-006`. | Internal labels currently appear as ALIVE, DESTROYER, LOVE GUN, DYNASTY, MONSTER, and END OF THE ROAD; public use needs content review. |
| Twenty-eight song rows or song-like entries | Reserve or create `SONG-001` through `SONG-028`, with `OPEN-001`, `FIN-001`, and `ENC-###` cross-references where appropriate. | Song titles and durations are working-draft data until arrangement, clearance, and timing are confirmed. |
| Platform drop | Create a dedicated `TRN-###`, `LGT-###`, `VID-###`, or safety/blocking row once the mechanism and show-control trigger are known. | Currently associated with `SONG-002` / Deuce in `docs/cue.txt`. |
| Costume change after Psycho Circus | Use `CST-001` unless a more specific approved ID is created. | Must include performer preset, show-control hold look, fallback state, and emergency hold plan. |
| Scotty D's + KISS costume change | Reserve `TRN-001` / `CST-002` pending clarification. | Needs content meaning, content review, and show-control-load review. |
| Screen drop | Reserve a `VID-###` and/or `TRN-###` row. | Currently associated with `SONG-013` / Hot + Cold in `docs/cue.txt`. |
| S.D. + KISS 2 | Reserve `TRN-002` / `CST-003` pending clarification. | Needs content meaning, content review, and show-control-load review. |
| Finale and encore candidates | Use `FIN-001`, `ENC-001`, and `ENC-002` only after the closing structure is approved. | Current candidates are listed in the END OF THE ROAD block. |

### Draft Set Block Reservations

These rows mirror the current structure in `docs/cue.txt`; they are reservations, not final creative contents.

| Timeline Moment ID | Working set block | Status | Source | Content / safety review | Notes |
|---|---|---|---|---|---|
| `SET-001` | ALIVE | Proposed | `docs/cue.txt` | Needs content review | Opening / live-energy block. |
| `SET-002` | DESTROYER | Proposed | `docs/cue.txt` | Needs content review | Mythic heavy spectacle block. |
| `SET-003` | LOVE GUN | Proposed | `docs/cue.txt` | Needs content review | Fan-service / mid-show spectacle block. |
| `SET-004` | DYNASTY | Proposed | `docs/cue.txt` | Needs content review | Groove / character-depth block. |
| `SET-005` | MONSTER | Proposed | `docs/cue.txt` | Needs content review | Darker heavy block. |
| `SET-006` | END OF THE ROAD | Proposed | `docs/cue.txt` | Needs content review | Finale / closing block. |

### Draft Song Reservations

The detailed song list remains in `docs/cue.txt` until the registry is expanded into a full table. When migrated, each song row must include parent set ID, duration, performer action, show-control action, cue notes, content/safety status, and rehearsal status.

## Production Feasibility Check

Each timeline-specific row must be operable by the approved show-control plan.

| Check | Pass condition |
|---|---|
| Performer load | The performer can execute the action while maintaining vocals, instrument/performance work, movement, persona, costume changes, and safety. |
| Show-control load | The show-control can trigger lighting, projection, fog, strobes, playback if applicable, and emergency states without simultaneous impossible actions. |
| Recovery path | The row has a clear fallback or emergency state when timing, gear, venue conditions, or costume changes fail. |
| Cue clarity | The row can be written into an show-control run sheet with a simple cue label, trigger condition, and confirmation state. |

---

## Downstream Documents That Must Reference This Registry

- Master Show Architecture
- Set Architecture Template
- Final Setlist
- Master Transition Map
- Costume-Change Transition Sheets
- Integrated Show Control Plan
- Lighting Master Plan
- Projection Video Cue Plan
- Fog Cue Plan
- Strobe Cue Plan
- QLC+ Cue Stack Template
- Show-Control Run Sheet
- Emergency Control Sheet
- Performer Blocking Map
- Performer Show Script
- Rehearsal Log
- Physical Asset Inventory
- Digital Asset Inventory
- Marketing Asset Matrix
- Website Page Inventory
- Media Shot Lists
- Post-Show Review Template
- Improvement Tracker

---

## Machine-Readable SSOT Companion

This human-readable document has a paired SSOT JSON companion at `docs/ssot/timeline_moment_registry.json`. That JSON file is the stable machine-readable seed for website prototypes, owner-admin views, generated checklists, booking materials, marketing materials, and future production data files.

Use the SSOT companion when building software or structured outputs so facts can be reused across multiple website styles without being retyped, forked, or lost. When this document changes, update `docs/ssot/timeline_moment_registry.json` and `docs/ssot/master_index.json` in the same change.
