# Super SSOT — Status, Notes, and Tracking Application Canon

## 1. Document control

| Field | Value |
|---|---|
| Title | Super SSOT for the Just One KISS status, notes, and tracking application |
| Classification | `GEN` / general project-system canon |
| Status | Draft canon for implementation planning |
| Created | 2026-07-19 |
| Primary canon compared | `docs/notes/language.json` |
| Compiled note source | `docs/notes/compiled_notes_status_report.md` |
| Source note bundle | `docs/notes/KISS01.txt`, `KISS02.txt`, `kiss03.txt`, `kiss04.txt`, `kiss05.txt`, `kiss06.txt`, `kiss07.txt`, `kiss08.txt`, `kiss09.txt`, `kiss10.txt`, `kiss11.txt`, `kiss12.txt` |

## 2. Purpose

This document is the implementation-ready single source of truth for a future status, notes, and to-do tracking application. It combines:

1. the immutable public-language canon in `docs/notes/language.json`;
2. the note compilation and status judgment in `docs/notes/compiled_notes_status_report.md`;
3. the remaining unresolved note ideas that need explicit owner decision, production assignment, or archival handling; and
4. a normalized status model that can be used by a web app, admin interface, JSON store, database table, or future API.

The application must not replace `language.json`. The application must use `language.json` as its public-copy authority and treat this document as the tracking layer around canon, notes, tasks, decisions, assets, and follow-up work.

## 3. Source-of-truth hierarchy for the tracking app

1. **Immutable public-copy canon:** `docs/notes/language.json` is authoritative for current runtime-backed public website language tokens, their canonical text, reuse policy, occurrence data, dependency hints, and review metadata.
2. **Compiled note interpretation:** `docs/notes/compiled_notes_status_report.md` is authoritative for the first pass that classified raw notes into obviously current, obviously stale, and unknown-status items.
3. **This super SSOT:** this document is authoritative for the app's status vocabulary, item schema, note-to-canon comparison rules, initial seed records, and implementation workflow.
4. **Raw notes:** the `.txt` files remain archival input. They should not be treated as live instructions unless a seed item in this document or a future owner decision promotes them.
5. **Other project docs:** repository planning, marketing, style, inventory, cue, and prompt documents provide domain context, but app-visible public copy must still route through `language.json` whenever it appears on the public site.

## 4. Key comparison findings: compiled notes vs. `language.json`

### 4.1 Strong alignment

The compiled status report's current items are strongly aligned with `language.json` on these points:

- The core public event facts are canonical: Just One KISS, July 25, 2026, Cycle Moore Legacy Campground, Interlochen / US 31, free show, no ticket required, RSVP/update-list appreciated, and camping handled separately.
- The hero/campaign phrase `You wanted the best? You got the best!` is live public language.
- `Get the July 25 drop` is live conversion language for hero, updates, form submit, and final CTA use.
- `Free show`, `No ticket required`, and `RSVP appreciated` are live public fact/CTA phrases.
- `Open the road case` is live Fan Vault language.
- Practical arrival language around camping, parking, fog/strobes, BYOB, water/refreshments, weather, and safety aligns with the public-language inventory.
- The rights-aware independent-tribute posture is consistent with the language inventory's review metadata and the repository's public-presentation rules.

### 4.2 Partial alignment or phrase variants

These note/report items are directionally supported but should not be blindly copied into public runtime copy without an owner decision or a `language.json` token update:

- `Tell your crew` is campaign-appropriate in the compiled report, but it does not appear as an exact canonical text hit in `language.json` at creation time.
- `Before You Roll In...` appears in `language.json` as `Before you roll in...`; preserve capitalization from the destination context instead of forcing the raw-note casing everywhere.
- `Open the Road Case` appears in `language.json` as `Open the road case.`; use the canonical sentence casing and punctuation unless creating a deliberately separate campaign headline token.
- `Camping $10/night/person` is canonical, but the raw note also mentions limited electrical at `$35/2 people/night`; that electrical detail is not broadly repeated as current public language and should require owner/venue confirmation before promotion.
- `Donations accepted and appreciated!` appears in the current language inventory as part of the free-show ticket fact, but notes and campaign language still must avoid paid-admission or ticket-purchase framing.

### 4.3 Unknown or decision-required items

These compiled unknown-status items become explicit backlog candidates, not automatic current canon:

- Logo placement and layout tweaks for a `just one KISS` logo under `THE BEST!`.
- Audio/video edit plan using AI announcer, AI Gene-style voice, and War Machine timing references.
- Unscoped `volume fix` note.
- 10-second black burning sun / supernova logo-reveal prompt.
- Stage interaction ideas: click/flame towers, spark waterfall, entry page, and Just One KISS stage.
- Additional stage banter/catchphrases beyond approved headline language.
- Site typography changes involving KISS-style or `die nasty` font direction.
- Countdown timer enhancement to include seconds.
- Italic treatment for `you had to be there` in the about-show copy.
- Theme-line candidate: `all for the love of KISS`.
- Earl visual reference: happy face and love fingers.

### 4.4 Stale or archival items

The interactive KISS Dot Sign boot primer in `kiss06.txt` should be tracked as `archived_stale` unless a future owner explicitly reopens that separate application concept. The marketing-expert boot report wrapper in `kiss11.txt` should be tracked as historical session output, while the factual and campaign-language content it contains may seed current or backlog items.

## 5. Canonical status vocabulary

The tracking app must use a small controlled status set:

| Status | Meaning | Allowed next statuses |
|---|---|---|
| `not_started` | Accepted into the backlog but no implementation work has begun. | `in_progress`, `paused`, `cancelled`, `archived_stale` |
| `in_progress` | Work has started and has an active owner or active implementation path. | `paused`, `blocked`, `finished`, `cancelled` |
| `paused` | Intentionally stopped for timing, strategy, missing materials, or owner review. | `not_started`, `in_progress`, `cancelled`, `archived_stale` |
| `blocked` | Cannot advance until a named dependency is resolved. | `in_progress`, `paused`, `cancelled`, `archived_stale` |
| `finished` | Implemented, reviewed, and linked to the relevant canon/source. | `in_progress` only if reopened with a reason |
| `cancelled` | Intentionally rejected or no longer wanted. | `not_started` only if resurrected with owner approval |
| `archived_stale` | Preserved for historical context but not part of current implementation. | `not_started` only if explicitly revived |
| `canon_current` | Already represented in current SSOT/runtime-backed language or current repository docs. | `in_progress` only if being revised |
| `needs_owner_decision` | The idea exists but cannot be categorized as accepted, rejected, or ready. | `not_started`, `paused`, `cancelled`, `archived_stale`, `canon_current` |

## 6. Required record schema

Each tracked item should use this schema.

```json
{
  "id": "TRACK-0001",
  "title": "Human-readable item title",
  "item_type": "note | task | public_copy | asset | decision | bug | enhancement | archival_reference",
  "classification": "GEN | PRE-001 | OPEN-001 | SET-001 | SONG-001 | TRN-001 | CST-001 | VID-001 | LGT-001 | FOG-001 | STR-001 | SPK-001 | FIN-001 | ENC-001 | POST-001",
  "status": "not_started | in_progress | paused | blocked | finished | cancelled | archived_stale | canon_current | needs_owner_decision",
  "priority": "critical | high | medium | low | someday",
  "source_files": ["docs/notes/kiss09.txt"],
  "language_tokens": ["landing.hero.title"],
  "canonical_text": "Optional exact public text if and only if it matches language.json or is proposed as a new token.",
  "summary": "What the item means in plain language.",
  "canon_comparison": "matches_language_json | partial_match | absent_from_language_json | conflicts_with_language_json | non_public_internal | stale_external_app",
  "rights_review": "safe | needs_review | not_applicable",
  "safety_review": "safe | needs_review | not_applicable",
  "fact_review": "verified | needs_verification | not_applicable",
  "dependencies": ["Owner approval", "Venue/camping confirmation"],
  "next_action": "The next concrete action needed.",
  "owner": "performer | crew_operator | both | unassigned",
  "created_from_compilation_date": "2026-07-19",
  "last_updated": "2026-07-19",
  "notes": "Optional implementation notes."
}
```

## 7. App modules to build

### 7.1 Dashboard

- Counts by status, item type, priority, owner, and canon comparison.
- Quick filters for `needs_owner_decision`, `blocked`, and `not_started`.
- A dedicated `canon_current` view so already-settled public facts do not clutter the active to-do list.

### 7.2 Notes inbox

- Shows raw imported note fragments with their source file and line/range when available.
- Allows promotion into a tracked item, merge into an existing item, or archive as stale/duplicate.
- Must preserve original note text without silently rewriting it.

### 7.3 Canon comparison panel

- Compares proposed public copy to `language.json` canonical text.
- Flags exact matches, partial matches, absent phrases, and conflicts.
- Shows linked token IDs, occurrence files, review metadata, and reuse policy for relevant language entries.

### 7.4 Task board

- Kanban lanes: not started, in progress, paused, blocked, finished, cancelled, archived/stale.
- Every card must show title, item type, priority, source files, canon comparison, next action, and owner.
- Public-copy cards must show linked `language.json` tokens or state that a new token is proposed.

### 7.5 Review queue

- Separate review chips for rights, safety, and fact status.
- Items involving public copy, AI voice likeness, official KISS/Gene references, fonts, ticket/admission claims, camping prices, pyrotechnic-looking language, fog/strobe warnings, or venue operations require explicit review metadata.

### 7.6 Export layer

- Export Markdown reports for humans.
- Export JSON records for the app.
- Export `language.json` update proposals separately; do not mutate immutable public canon automatically.

## 8. Initial seed records

These are the first normalized records the app should import from the compiled report and `language.json` comparison.

| ID | Title | Type | Status | Priority | Canon comparison | Next action |
|---|---|---|---|---|---|---|
| `TRACK-0001` | Core July 25 free-show facts | public_copy | `canon_current` | critical | `matches_language_json` | Preserve and link all matching language tokens. |
| `TRACK-0002` | Hero headline: You wanted the best | public_copy | `canon_current` | high | `matches_language_json` | Preserve approved casing per page/campaign context. |
| `TRACK-0003` | Get the July 25 drop CTA | public_copy | `canon_current` | high | `matches_language_json` | Reuse existing token rather than duplicating prose. |
| `TRACK-0004` | Free show / no ticket / RSVP language | public_copy | `canon_current` | critical | `matches_language_json` | Keep paid-ticket language out of related items. |
| `TRACK-0005` | Open the road case / Fan Vault language | public_copy | `canon_current` | medium | `partial_match` | Use canonical sentence casing unless a new campaign token is approved. |
| `TRACK-0006` | Tell your crew sharing language | public_copy | `needs_owner_decision` | medium | `absent_from_language_json` | Decide whether to add a language token or keep as campaign-only copy. |
| `TRACK-0007` | Before you roll in arrival card | public_copy | `canon_current` | high | `partial_match` | Reuse existing arrival/safety tokens; align capitalization with destination. |
| `TRACK-0008` | Limited electrical camping price | decision | `needs_owner_decision` | medium | `absent_from_language_json` | Verify with venue before public use. |
| `TRACK-0009` | Black burning sun logo reveal video | asset | `not_started` | medium | `absent_from_language_json` | Decide whether this is a needed video asset and assign asset record. |
| `TRACK-0010` | AI announcer / AI Gene-style voice edit | asset | `needs_owner_decision` | high | `non_public_internal` | Review rights/likeness risk and choose a safe original-voice direction. |
| `TRACK-0011` | Unscoped volume fix | bug | `blocked` | medium | `non_public_internal` | Identify the affected file, clip, page, or mix. |
| `TRACK-0012` | Flame towers / spark waterfall interaction | enhancement | `needs_owner_decision` | medium | `non_public_internal` | Decide whether this belongs to website animation, stage plan, or asset inventory. |
| `TRACK-0013` | Additional banter/catchphrases | public_copy | `needs_owner_decision` | low | `absent_from_language_json` | Review tone, rights, and public suitability before use. |
| `TRACK-0014` | KISS-style typography changes | enhancement | `needs_owner_decision` | medium | `non_public_internal` | Review font rights, readability, accessibility, and brand consistency. |
| `TRACK-0015` | Countdown seconds | enhancement | `not_started` | low | `non_public_internal` | Inspect current countdown implementation and decide if seconds improve UX. |
| `TRACK-0016` | Italicize `you had to be there` | enhancement | `not_started` | low | `partial_match` | Confirm exact token/page and implement as markup, not text drift. |
| `TRACK-0017` | `All for the love of KISS` theme line | public_copy | `needs_owner_decision` | low | `absent_from_language_json` | Decide whether to create a new approved phrase token. |
| `TRACK-0018` | Earl happy-face/love-fingers visual | asset | `needs_owner_decision` | low | `absent_from_language_json` | Identify image source, ownership, and intended placement. |
| `TRACK-0019` | Interactive KISS Dot Sign boot primer | archival_reference | `archived_stale` | low | `stale_external_app` | Preserve as historical context unless explicitly revived. |
| `TRACK-0020` | Marketing boot report wrapper | archival_reference | `archived_stale` | low | `non_public_internal` | Keep factual extracted items, archive the session-status wrapper. |

## 9. Public-copy rules for tracked items

1. A public-copy item is `canon_current` only when its exact phrase or approved variant is present in `language.json` or another clearly authoritative public-copy SSOT.
2. If a note phrase is useful but absent from `language.json`, mark it `needs_owner_decision` or `not_started`; do not call it canon.
3. If a note phrase partly matches canonical text, the app must show the canonical text side by side with the note phrase.
4. Proposed copy changes must be stored as proposals until an approved workflow updates `language.json` and any generated language map.
5. Public copy must avoid official-affiliation implications, copied protected branding, ticket-purchase language for the free show, and unverified logistics.

## 10. Implementation rules

- Store raw imported notes separately from normalized tracked items.
- Never delete original note provenance.
- Treat `language.json` as read-only unless the user explicitly requests a canon update workflow.
- Use deterministic IDs for imported note fragments and tracked items.
- Keep status history rather than overwriting important transitions.
- Each transition should record date, previous status, new status, actor, and reason.
- Every item should carry a `classification` value; use `GEN` when not tied to a Timeline Moment ID.
- Every app-generated report should identify whether it is a snapshot, proposal, or canon document.

## 11. Minimum viable build sequence

1. Create JSON seed data from the records in Section 8.
2. Build a read-only dashboard over the seed data.
3. Add filters by status, type, priority, owner, and canon comparison.
4. Add detail pages showing source notes and linked language tokens.
5. Add controlled status transitions with history.
6. Add public-copy proposal records without direct `language.json` mutation.
7. Add import tooling for future `.txt` notes.
8. Add export tooling for Markdown status reports and JSON snapshots.

## 12. Definition of done for the app

The tracking app is usable when it can answer these questions without rereading the raw notes:

- What is already canon/current?
- What is not started?
- What is in progress?
- What is paused or blocked, and why?
- What is finished?
- Which note ideas need owner decisions?
- Which public-copy ideas are absent from `language.json`?
- Which items carry rights, safety, fact, venue, or technical dependencies?
- Which raw note file produced each tracked item?
- What is the next concrete action for each unresolved item?
