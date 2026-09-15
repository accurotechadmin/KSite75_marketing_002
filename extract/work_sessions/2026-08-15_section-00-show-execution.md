# 2026-08-15 Section 02 Show-Execution Operational Handoff

> Operational extraction handoff only. This log is not approved SSOT, an executable calling script, or authority to operate a show.

## Baseline and scope

- Starting commit/tree: `5a8d6bd`; clean branch `work`.
- Final tree: the coherent session commit on branch `work` (recorded by Git history; its hash is intentionally not self-embedded in this committed file).
- Remote/upstream: none configured, so fetch/fast-forward was unavailable and work continued from the verified local tree.
- Verified starting audit: 209 leaves; `R58/S151` overall, comprising Section `90` `R24`, Section `00` `R13`, Section `01` `R12`, and Section `02` `R9/S5`. This matched the prior handoff.
- Executed in dependency order: show-state vocabulary, Stage Manager calling-script control, and run-of-show control.

## Sources and method

The two controlled DOCX files were studied through WordprocessingML text extraction into `/tmp`, never modified or committed. Principal evidence recorded in each authored leaf includes path, SHA-256, locator, method, and stated use:

- `01_Authoritative_Show_Control_and_Performance_Cue_Book.docx` — `6c7fdff80c14d92413fec6fc4050184c3519aa48810faa7569b08da9a598e037`; calling conventions, Sections 2 and 7–10, Appendix B.
- `02_Authoritative_Supporting_Production_Documentation_Standard.docx` — `08a9d21e44292e36e6c9cf66cb78216d3023bfd76a5b461f250bb0aa59fb2291`; `SM-01`, `SM-02`, `SAFE-01`, `COMMS-01`, and synchronization/acceptance requirements.
- Existing Section `02` registries/crosswalks were hashed after targeted UTF-8 review and are referenced rather than copied as competing program, Timeline, transition, or finale truth.

## Files, transitions, and decisions

- `show_state_vocabulary.json`: `S → R`. Planned, protective, emergency, recovery, and terminal meanings are distinct. Only enumerated evidence- and role-traceable transitions are allowed; `ABORT`, `STOP`, and `HOLD` precede timing.
- `stage_manager_calling_script.json`: `S → R`. It indexes all 30 PGM, three TECH, and four FIN identities in controlled order, but exact calls, department cues, entrances/exits, triggers, and confirmations remain null. It is explicitly withheld and not call-ready.
- `run_of_show.json`: `S → R`. It references crew-call-to-load-out phases, PGM order, sets, transitions, FIN gates, and SM-01 without activating candidate times or generating a view.
- Manifest, freshness coverage, Section/root README prose, validator, root boot rolling baseline/queue, and dependent source hashes were synchronized.
- Rejected: treating silence as readiness, making null duration zero, deriving executable calls from suggested prose, choosing TECH triggers or a timing profile, supplying event-day times, releasing audience/teardown from sequence completion, or claiming controlled approval.

## Conflicts, blockers, and approval boundary

No new resolved authority conflict was asserted. Controlled human approval and department/venue concurrence remain absent. Active timing profile, PGM-030 version/duration, finale/release facts, TECH readiness/triggers, exact calls and cues, entrances/exits, venue emergency and restart authority, operational times, performer tracks, and actual instance evidence remain unresolved. The safest behavior is withholding and fail-closed control, not invention.

## Final audit and next work

Final audit: Section `90` `R24`, Section `00` `R13`, Section `01` `R12`, Section `02` `R12/S2`; repository `R61/S148`; `W/C/B/A/G/X/!` all zero. Review means extraction/reconciliation is ready for controlled review, never approved canon.

The first unfinished leaf is `02_show_program_and_timeline/performer_track_registry.json`. The refreshed root `boot.md` queues performer tracks, the empty actual-performance timing contract, and the first dependency-safe Section `03` equipment-type slice.

## Validation record

- `python3 extract/scripts/validate_compendium.py`
- Python parse of every `extract/compendium/**/*.json`
- state/manifest audit script
- `git diff --check`
- `git diff --stat`
- `git status --short`
- stale-handoff `rg` command from `boot.md`

Limitation: `jsonschema` is unavailable, so full Draft 2020-12 metaschema and format-assertion validation was not run. Local validator invariants and JSON parsing ran.
