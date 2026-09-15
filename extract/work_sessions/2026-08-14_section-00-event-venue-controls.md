# Operational Handoff — Section 01.02 Event and Venue Controls

> **Operational handoff only. This document is not approved SSOT and grants no approval.**

## Session and tree

- Date: 2026-08-14 UTC.
- Starting commit/tree: `45741f2`, clean branch `work`.
- Remote/upstream: none configured; fetch/fast-forward and remote PR publication were unavailable.
- Starting audit: `R41/S168` (`90 R24`, `00 R13`, `01 R4/S8`); this matched the incoming rolling handoff.
- Final pre-commit audit: `R46/S163` (`90 R24`, `00 R13`, `01 R9/S3`); all other states zero.
- First unfinished leaf: `01_project_event_and_people/personnel_registry.json`.

## Completed transitions

Five Section `01.02` leaves moved `S -> R`: `event_registry.json`,
`event_schedule_plan.json`, `venue_registry.json`,
`venue_advance_and_house_interface.json`, and
`travel_parking_camping_and_access.json`. The manifest, freshness coverage,
Section README, extract handoff, root rolling handoff, and validator now agree.
No leaf moved to approved or generated.

## Evidence and provenance

Principal evidence was extracted or parsed with path, SHA-256, locator, method,
and stated use in each leaf: the authoritative supporting-production DOCX
(`SM-02`, `SCHED-01`, `VEN-01`, control rules), source-authority policy, project
identity, role authority, public `proto` language/site candidates, brand fact
inventory, and shared marketing fact prohibitions. Both root DOCX files were
extracted to `/tmp` for study only; those temporary renditions were not committed.

## Decisions, conflicts, and rejected alternatives

- Created stable candidate IDs but withheld event date, time, time zone, venue,
  offer, public facts, directions, prices, capacities, and accessibility claims.
- Expressed schedule ordering through dependencies with unresolved times; safety
  HOLD/STOP/ABORT continues to override timing.
- Kept all venue advance values unknown and required method, unit, date,
  uncertainty, source, verification, owner roles, and approval before promotion.
- Used restricted-contact indirection only. Raw PII, phone/email values, mail
  bodies, credentials, and secrets were not imported.
- Rejected selecting the repeated public candidates because repetition is not
  controlled event, venue, relationship, or publication evidence.

## Blockers and limitations

Controlled human approval is absent. Exact event/venue relationship, calendar,
time-zone, access-window, curfew, capacity, restriction, permit, geometry,
power, rigging, staffing, parking, camping, accessibility, contingency, and
contact evidence remains required. `jsonschema` is unavailable, so the validator
could not run full Draft 2020-12 metaschema and format assertions.

## Checks

- `python3 extract/scripts/validate_compendium.py`
- Python parse of every `extract/compendium/**/*.json`
- `git diff --check`
- `git diff --stat`
- `git status --short`
- stale-handoff `rg` inspection from root `boot.md`

## Next session

Execute Section `01.03` in dependency order: responsibility matrix, personnel
registry, then restricted-contact directory. Preserve named-person,
qualification, assignment, consent, contact, privacy, and approval boundaries.
