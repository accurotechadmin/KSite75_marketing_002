# Just One KISS SSOT Compendium — Reusable Fresh-Session Boot

Use this prompt to start a fresh expert coding session. The active project is the
repository-wide SSOT compendium under `extract/`; this is continuation work, not
a public-site rebuild and not a menu-only audit. Verify the live tree, complete
the next bounded slices listed below, validate and document the result, commit on
the current branch, and create PR metadata with the environment's PR tool.

The repository is not greenfield. Historical prompts, app renditions, runtime
state, generated views, and copied SSOT bundles are evidence—not automatic
authority. Never promote a draft or review document to approved canon without
the required controlled approval evidence and explicit human authorization.

---

## 1. Start working immediately

Begin with this short acknowledgement and then run the boot checks:

> I will resume the live SSOT compendium, verify repository instructions and the
> current handoff, execute the next dependency-safe control/governance slices,
> preserve provenance, conflicts, privacy, safety, and approval boundaries,
> validate the result, update the durable handoff, commit it, and create PR
> metadata. I will trust audited files over cached status prose.

Do not stop after orientation and do not wait for a section selection. The queue
in Section 6 is pre-authorized. Ask only when a destructive action or a decision
reserved to a human owner is genuinely unavoidable; otherwise choose the safest
reversible option, record it, and continue.

---

## 2. Verify the live repository

Run from the repository root. Do not use `ls -R` or `grep -R`.

```bash
pwd
find .. -name AGENTS.md -type f -print
git status --short --branch
git branch --show-current
git remote -v
git log --oneline --decorate -10
find extract -maxdepth 3 -type f | sort
python3 extract/scripts/build_compendium_scaffold.py --help
python3 extract/scripts/validate_compendium.py
```

If a remote and upstream exist, fetch and fast-forward only. If either is absent,
record that limitation and continue from the verified local tree. If the tree is
dirty, inspect and classify every change before editing; never overwrite, stage,
or commit unrelated work. Never run the scaffold generator with `--clean` now
that extraction has begun.

Audit live content rather than trusting `status` alone. Use these states:

- `S` scaffold: explicit empty shell with no extracted claims.
- `W` working: substantive but incomplete.
- `C` conflict: material candidates disagree or authority is unresolved.
- `B` blocked: evidence, permission, or a human decision prevents progress.
- `R` review: intended content, provenance, and validation are complete; approval
  is still pending.
- `A` approved: controlled approval evidence exists and validates.
- `G` generated: reproducible derivative current to identified upstream inputs.
- `X` superseded; `!` invalid.

---

## 3. Current handoff to verify, not assume

As of completion of the second Section `03.03` geometry sequence from commit `e4822b2` on 2026-08-18:

- The compendium catalog contains 14 sections and 209 planned leaves.
- Sections `90`, `00`, `01`, and `02` have 24, 13, 12, and 14 review leaves; Section `03` has 10 review leaves and 19 scaffolds. No leaf is approved or generated canon.
- Completed slices include all four Section `03.01` equipment-evidence leaves plus the Section `03.03` coordinate, pavilion, stage, scaffold/rigging, zone, and layer registries.
- The first unfinished leaf is `03_technical_systems_and_stage/stage_plot.json`, the final dependency-safe Section `03.03` view.
- Validation additionally covers 11 evidence-qualified scaffold measurements and machine-checkable candidate bounds with structural/rigging facts withheld; eight stable zone candidates with all operational permissions withheld; and 13 ordered visualization layers whose visibility is not activation, clearance, or approval.
- The current operational handoff is `extract/work_sessions/2026-08-18_section-00-scaffold-zones-layers.md`.
- Full Draft 2020-12 metaschema and format assertions remain limited because `jsonschema` is unavailable; PDF text/page extraction utilities also remain unavailable, so vendor claims remain unextracted rather than lacking locators.
- No Git remote or upstream is configured. Controlled human approval remains the material promotion blocker; physical equipment/tag/serial verification, vendor applicability, active patch/configuration, surveyed geometry, zone bounds/permissions, roof/rigging/load/clearance/access/power evidence, and all prior performer, timing, finale, TECH, venue, call/cue, safety, and release facts remain unresolved and must not be invented.

Expected live state is Section `90` `R24`, Section `00` `R13`, Section `01` `R12`, Section `02` `R14`, Section `03` `R10/S19`, and the whole repository `R73/S136`, with all other state counts zero. Recompute this. If the live result differs, trust the files and Git history, explain the delta in the new work-session log, and resume from the first genuinely unfinished slice.

### Mandatory self-refresh contract

This file is intentionally both the stable operating prompt and the rolling
handoff. The numbered boot/study/authoring/validation rules remain reusable; the
dated facts in this section and the executable queue in Section 6 are rolling
content. Every execution session **must rewrite both rolling areas before it
commits**, even when a slice finishes only partially.

The refresh is not an optional documentation follow-up. It is a completion gate:

1. Re-audit the manifest and live leaves after all work and validation.
2. Replace this section's commit/date, state totals, last completed slice, first
   unfinished leaf, handoff-log path, validation limitations, remote/upstream
   condition, and material blockers with the final verified values.
3. Remove completed work from Section 6. Never leave completed slices phrased as
   the next assignment.
4. Derive the next two or three coherent dependency-safe slices from the live
   unfinished leaves, the dependency order in
   `extract/ssot_compendium_sequential_build_plan.md`, registered conflicts and
   blockers, and the downstream validation needs. Write exact files, purpose,
   source families, and done conditions for each new slice.
5. If fewer than two safe slices remain in the current section, queue what
   remains and then the first safe slice of the next dependency section. If no
   safe slice can proceed, replace the queue with a bounded blocker-resolution
   slice naming the evidence or human decision required; do not replay old work.
6. Keep Sections 1, 2, 4, 5, and 7 general unless the architecture or operating
   rules actually changed. Update stale paths or rules wherever found.
7. Run a final stale-handoff check against this file. A mismatch between the live
   audit and either rolling area means the session is not ready to commit.

A fresh session must still verify these claims rather than trust them blindly.
If it discovers that a previous session failed this contract, it repairs the
rolling handoff first and then resumes the first genuinely unfinished slice.

---

## 4. Study only what is needed to execute safely

Read these files in full before editing:

1. Every applicable `AGENTS.md`.
2. `README.md` and this `boot.md`.
3. `extract/README.md`, `extract/BOOT.md`, and
   `extract/SEQUENTIAL_BUILD_BOOT.md` (architecture and completion rules).
4. `extract/ONGOING_BUILD_BOOT.md` (historical Section `90` execution prompt;
   use as provenance, not as the current queue).
5. `extract/ssot_compendium_sequential_build_plan.md`, especially Section `00`.
6. `extract/ssot_compendium_document_inventory.md`, especially `00.01`–`00.03`.
7. `extract/work_sessions/2026-08-13_section-90-foundation.md` and any newer
   work-session logs.
8. `extract/compendium/00_control_and_governance/README.md`, all 13 Section `00`
   leaves, the live manifest, and all 24 Section `90` leaves they depend on.
9. `extract/scripts/validate_compendium.py` and the scaffold generator (the
   latter for format/provenance only, never for regeneration).
10. The two authoritative root DOCX files. Extract their text/tables to `/tmp`
    for study; do not modify or commit extracted copies.
11. `docs/current_documentation_groundwork_plan.md`, `docs/ssot/master_index.json`,
    `docs/ssot/settings_manifest.json`, `README.md`, and the center canon-sync,
    release-gate, persistence/auth, and scaffold-policy documents relevant to
    governance.

Use `extract/ssot_source_inventory.md` and targeted `rg`, hashes, Git history,
and representative source records to deepen study for each slice. Do not blindly
reread identical rendition-local bundles. Do not import secrets, raw PII, mail
bodies, submissions, credentials, or sensitive diagnostics.

Carry these repository truths:

1. The two authoritative DOCX documents govern controlled program/supporting
   documentation within their declared domains.
2. Supporting documents reference PGM/TECH/FIN identities; they do not create a
   competing show order or timing truth.
3. Every managed item is Timeline-specific or `GEN`.
4. Safety HOLD/ABORT/STOP authority overrides planned timing.
5. Drafts, runtime observations, backups, historical prompts, prototypes, and
   generated views do not silently become approved policy or fact.
6. Public material remains independent-tribute, rights-aware, safety-aware, and
   free of unsupported affiliation or endorsement claims.
7. Estimated and unverified equipment/geometry data stays identified as such.
8. Current state, approved release, and immutable history are separate classes.
9. Section `00` must control later extraction without claiming human approval it
   does not have.

---

## 5. Authoring contract

For every Section `00` leaf advanced from scaffold:

1. Remove scaffold notices and empty-scaffold claims.
2. Conform to the Section `90` controlled document envelope and use resolvable
   schema references.
3. Keep `status: review` when authoring/reconciliation is complete but controlled
   approval is absent; never invent approvers, signatures, effective dates, or
   authority.
4. Use supported owner/approver **roles**, stable IDs, truthful revision dates,
   visibility, Timeline/`GEN` scope, dependencies, and supersession fields.
5. Record principal sources with path, SHA-256, locator/scope, extraction method,
   and stated use.
6. Separate normative policy, source assertions, operational records, generated
   indexes, and unresolved questions.
7. Preserve conflicts instead of selecting convenient values. Preserve the more
   conservative privacy, rights, safety, and approval rule when authorities do
   not resolve a disagreement.
8. Use restricted references—not copied values—for secrets and PII. Define
   redaction, retention, access, and deletion/escalation behavior without
   pretending the prototype apps implement controls they do not have.
9. Avoid freezing draft business facts into universal governance rules.
10. Add validation checks and representative positive/negative fixtures when
    they provide durable value. Update the manifest, Section `00` README, root
    and extract handoff prose, validator, and session log whenever affected.

The `compendium_manifest` is both a live catalog and a Section `00` leaf. Do not
call it review-ready merely because its generated document list is synchronized;
its own envelope, sources, generation method, dependencies, freshness, and
validation contract must also be complete.

---

## 6. Pre-authorized next three slices

Execute in order. Keep a task plan with at most one active slice.

### Slice 1 — Stage plot (`03.03`)

Author `extract/compendium/03_technical_systems_and_stage/stage_plot.json` as a reproducible, explicitly unapproved view contract over coordinate, pavilion, stage, scaffold, zone, layer, and equipment-position candidates plus controlled stage-plot requirements.

**Done when:** every rendered element cites an upstream record/revision; estimated and unverified geometry remains visibly qualified; traffic, cable, change, exit, fire-lane, and clearance overlays remain absent or blocked until evidence exists; generation inputs/method/freshness are machine-checkable; no plot is called operational or approved.

### Slice 2 — DMX universe registry (`03.02`)

Author `extract/compendium/03_technical_systems_and_stage/dmx_universe_registry.json` from prototype/control-workspace universe candidates, equipment evidence, and lighting-control requirements.

**Done when:** candidate universe IDs, protocol/size/interface context, ownership, evidence, and verification are explicit; no active output, node/interface assignment, or tested control path is inferred; address limits are machine-checkable.

### Slice 3 — DMX patch plan (`03.02`)

Author `extract/compendium/03_technical_systems_and_stage/dmx_patch_plan.json` from candidate instances, modes, universe records, workspace/prototype patch evidence, and controlled lighting requirements.

**Done when:** every candidate patch resolves instance/type/mode/universe references and valid address bounds; overlaps and evidence conflicts remain explicit; active patch, working mode, tested output, power source, and configuration release remain withheld pending physical reconciliation and approval.

---

## 7. Validation, durable handoff, Git, and PR

Create `extract/work_sessions/YYYY-MM-DD_section-00-<topic>.md`. Mark it as an
operational handoff, not approved SSOT. Record the starting/final commit and tree,
state counts, files and transitions, sources/hashes/locators, decisions and
rejected alternatives, conflicts/blockers, exact checks, limitations, and next
unfinished leaf. Do not reconstruct key choices only at the end.

At minimum run:

```bash
python3 extract/scripts/validate_compendium.py
python3 - <<'PY'
import json
from pathlib import Path
for path in sorted(Path('extract/compendium').rglob('*.json')):
    json.loads(path.read_text(encoding='utf-8'))
print('All compendium JSON parses.')
PY
git diff --check
git diff --stat
git status --short
rg -n "Current handoff|As of commit|Expected state|Pre-authorized next|Slice [123]|first unfinished|Next Session" boot.md extract/README.md extract/compendium/*/README.md extract/work_sessions
```

Extend the reusable validator to check the Section `00` shapes and invariants
introduced here: IDs/paths/hashes, local references, register cross-links,
policy-required fields, manifest agreement, state classification, privacy
exclusions, and absence of scaffold markers in populated leaves. Use Draft
2020-12 metaschema and format assertions when `jsonschema` is available; if it is
not, report that limitation rather than claiming full validation.

Before completion:

1. Audit the touched leaves from content and report exact `S/W/C/B/R/A/G/X/!`
   totals, separating review-ready from approved/generated.
2. Apply the mandatory self-refresh contract: update `extract/README.md`, the
   affected section README, this boot prompt's rolling verified baseline and
   entire next-work queue, the manifest, and the session log to the same live
   truth. Re-run the stale-handoff search above and inspect every match.
3. Review every touched-file diff and stage only coherent session work.
4. Commit on the current branch.
5. Invoke the environment's `make_pr` tool after the commit with a concise title
   and a body covering slices, state transitions, validation, approval boundary,
   and next queue. Never call it without a commit and never leave a commit without
   the required PR call.

Do not commit if Section 3 describes the starting state as current, Section 6
still assigns completed files, or the session log and manifest disagree with the
live audit. These are validation failures, not harmless stale prose.

Return an execution report with the commit and PR result, exact state counts,
remaining approval/conflict/blocker needs, and every test command prefixed with
`✅`, `⚠️`, or `❌`. Never call authored/review-ready work approved canon.
