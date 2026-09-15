# Operational Handoff — Section 02 Crosswalks and Transitions

> Operational extraction record only. This file is not approved SSOT and does not authorize performance, publication, or audience release.

## Baseline and result

- Date: 2026-08-15 UTC.
- Starting commit/tree: `bbfdc36`, clean local `work` branch; no remote or upstream configured.
- Starting audit matched the prior handoff: `R55/S154`; final audit: `R58/S151`; all other states zero.
- Transitions: `program_timeline_crosswalk.json`, `department_cue_crosswalk.json`, and `transition_registry.json` moved `S -> R`.
- First unfinished leaf: `02_show_program_and_timeline/show_state_vocabulary.json`.

## Sources, hashes, locators, and extraction

The two authoritative DOCX files were extracted from WordprocessingML to `/tmp` for study and were not modified. Each authored leaf records repository-relative paths, SHA-256 hashes, locators, extraction methods, and stated uses. Principal evidence was the Cue Book program/set and Sections 6–8 event/transition material; Supporting Standard Sections 2–5 controlled-document families, common cue fields, department ownership, concurrence, and safety requirements; and the review-ready PGM, TECH, FIN, set, and Timeline registries.

## Decisions and rejected alternatives

All 37 controlled PGM/TECH/FIN identities receive an explicit provisional Timeline relationship while remaining identity-distinct; matching FIN text and suffixes are not equivalence evidence. All 37 relationships also receive traceable department allocations, but cue IDs, triggers, completion signals, and concurrence remain null or pending. TECH and FIN execution fails closed.

Five between-set boundaries and three special TECH relationships are represented. Unknown durations are null and explicitly not zero. Trigger, costume, scenic, spoken, hold, and reset facts remain null; conflicting TECH trigger candidates remain upstream and unselected. Rejected alternatives included fabricating department cue numbers, inferring a zero-duration transition, collapsing domains, selecting trigger candidates, or promoting review work to approved/call-ready state.

## Conflicts, blockers, and limitations

Controlled human approval remains the promotion blocker. Active timing profile, PGM-030 version/duration, finale/bows/blackout/walk-out/release conditions, TECH triggers/readiness, source-marker meaning, interstitial format, public titles, exact department cues, and operational transition facts remain unresolved. No Git remote/upstream exists. `jsonschema` is unavailable, so full Draft 2020-12 metaschema and format assertions were not run.

## Validation and next session

Checks run: `python3 extract/scripts/validate_compendium.py`; a Python parse of every compendium JSON file; a Python state audit; `git diff --check`; `git diff --stat`; `git status --short`; and the stale-handoff `rg` command from `boot.md`. The validator now checks complete ordered crosswalk coverage, identity separation, publication/approval withholding, resolvable Timeline/crosswalk references, pending null department allocations, fail-closed TECH/FIN relationships, five set plus three TECH transitions, and unknown duration/trigger preservation.

Next, author `show_state_vocabulary.json`, then the Stage Manager calling script and run of show according to the refreshed root queue. Do not invent state authority, exact calls, cue IDs, operational times, or approvals.
