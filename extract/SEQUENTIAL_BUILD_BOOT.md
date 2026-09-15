# SSOT Compendium Sequential Build — Fresh Expert Execution Boot Prompt

Use this prompt to boot a fresh expert session whose job is to execute the
dependency-driven SSOT compendium build plan, truthfully display live completion,
and finish user-selected sections or sub-sections without promoting unverified
material to approved canon.

This prompt extends, but does not supersede, [`BOOT.md`](BOOT.md). The primary
project plan is
[`ssot_compendium_sequential_build_plan.md`](ssot_compendium_sequential_build_plan.md).
When instructions conflict, direct user/system instructions and applicable
`AGENTS.md` files take precedence, followed by repository authority and the more
conservative truth/safety/control rule.

---

## 0. First Response and Operating Posture

Begin with this concise acknowledgement before running checks:

> I will boot the live sequential SSOT build program, verify repository and
> instruction state, audit every planned leaf from its actual contents, map the
> results into completed, needs-completion, blocked/conflicted, and not-started
> work, enforce the dependency order, and present an ANSI-style execution menu.
> A bare section number or list of numbers will be treated as an instruction to
> execute and finish those scopes—not merely inspect them—while preserving
> provenance, uncertainty, privacy, rights, safety, and approval boundaries.

Never display remembered or cached completion. Generate the menu from the live
tree at boot time.

---

## 1. Non-Negotiable Command Semantics

### 1.1 Numeric input means execute

After the boot menu appears, a user input consisting only of one or more valid
major section IDs is an immediate execution instruction.

Examples:

```text
90
90 00
01,02,03
05-08
```

Interpret these as:

> Execute, accomplish, validate, and finish the selected section or sections to
> the highest truthful state currently attainable, following prerequisites and
> definitions of done.

Rules:

1. Preserve the user's listed order only when it is dependency-safe; otherwise
   explain the normalized order and execute prerequisites first.
2. A numeric range selects every valid major section in that range, but execution
   follows the canonical build order, not lexical order.
3. Multiple sections are an explicit batch request and override the default
   one-scope-at-a-time preference.
4. Do not ask whether the user meant “view” or “work.” Bare numbers always mean
   work.
5. Do not stop after analysis or a plan. Continue through source study, editing,
   validation, re-audit, commit, and required PR metadata unless genuinely
   blocked by unavailable evidence or required human authority.

### 1.2 Decimal input means execute a sub-section

A bare catalog sub-section ID is also an execution instruction:

```text
90.01
00.01 00.02
03.01,03.03
```

Interpret it as “finish this sub-section,” subject to prerequisites and truthful
approval boundaries.

### 1.3 Inspection requires an explicit command

Use letter commands for examination without execution:

- `V 03` — view Section `03` status and summary.
- `D 03` — drill into Section `03` sub-sections.
- `V 03.02` — view one sub-section.
- `F <document_id|path>` — inspect one leaf.
- `C` — inspect conflicts, blockers, and invalid findings.
- `P <scope>` — inspect provenance and source coverage.
- `N` — show the recommended next prerequisite.
- `R` — re-audit and redraw the menu.
- `H` — show help and command grammar.
- `Q` — end the menu.

If a user writes natural language, follow its plain meaning. Numeric-only behavior
applies only when the input contains section/sub-section IDs and separators or
ranges, with no inspection command or contrary language.

### 1.4 “Finish” must remain truthful

Finishing a selected scope means bringing every selected leaf to the highest
state justified by evidence:

- `APPROVED` only with required approval evidence and explicit authority.
- `REVIEW` when extraction and reconciliation are complete but approval is pending.
- `BLOCKED` only when an external decision/evidence/permission genuinely prevents
  responsible completion.
- `CONFLICT` when material candidates remain unresolved.
- `WORKING` only when meaningful executable work remains and the session has not
  exhausted safe progress.

Never fabricate approval, measurements, rights, contacts, venue facts, decisions,
or evidence merely to make a section look complete. A selected section can be
execution-complete for the session while still truthfully containing controlled
`BLOCKED` or `CONFLICT` leaves, but the report must distinguish that from canonical
completion.

---

## 2. Canonical Sequential Order

Use this order for planning, prerequisite enforcement, menu ranking, and batch
execution:

```text
90 → 00 → 01 → 02 → 03 → 04 → 05 → 06 → 08 → 07 → 10 → 09 → 11 → 99
```

### Phase gates

```text
GATE A · FOUNDATION       90, 00
GATE B · CORE PRODUCTION  01, 02, 03, 04
GATE C · PUBLIC/COMMERCIAL 05, 06, 08, 07
GATE D · MANAGED SYSTEM   10, 09
GATE E · HISTORY/OUTPUTS  11, 99
```

Dependency rules:

1. Section `90` validates all business documents.
2. Section `00` controls sources, provenance, conflicts, privacy, revision,
   approval, and propagation.
3. Section `01` supplies project/event/venue/people facts.
4. Section `02` owns program identity, order, timing, and Timeline crosswalks.
5. Section `03` owns equipment, geometry, patching, and technical configuration.
6. Section `04` owns safety/readiness and may block any release.
7. Section `05` owns asset existence and rights; `06` owns brand/content rules;
   `08` owns public routes/forms/publication; `07` owns campaign/booking use.
8. Section `10` defines technical mechanics before `09` defines managed editing.
9. Section `11` records history without mutating authority.
10. Section `99` is reproducibly generated from upstream revisions and comes last.

Do not declare an entire downstream section blocked merely because an upstream
section is incomplete. Complete all safe independent work, register exact
dependency blockers, and stop only where the missing dependency affects claims.

---

## 3. Mandatory Boot Verification

Run from the repository root before substantive claims or edits. Use `find`,
`rg`, `sed`, `nl -ba`, `git`, and Python. Do not use `ls -R` or `grep -R`.

```bash
pwd
find .. -name AGENTS.md -type f -print
git status --short --branch
git branch --show-current
git remote -v
git fetch --all --prune
git pull --ff-only
git log --oneline -10
find extract -maxdepth 3 -type f | sort
find extract/compendium -mindepth 1 -maxdepth 1 -type d | sort
find extract/compendium -type f -name '*.json' | sort | wc -l
find extract/compendium -type f -name '*.md' ! -name README.md | sort | wc -l
find extract/compendium -mindepth 2 -maxdepth 2 -type f -name README.md | sort | wc -l
python3 extract/scripts/build_compendium_scaffold.py --help
```

If no remote, upstream, credentials, or network exists, report it and continue
from the verified live tree. Never use the scaffold generator with `--clean`
during ordinary boot or extraction.

### Dirty-tree protocol

If the tree is dirty:

1. classify every change as user work, earlier-agent work, or current work;
2. inspect relevant diffs;
3. never reset, overwrite, reformat, or include unrelated changes;
4. report overlaps with a selected execution scope; and
5. work around unrelated changes where safe.

---

## 4. Required Study Order

Read in this order before the live audit:

### Stage 1 — Instructions and plan

1. Every applicable `AGENTS.md`.
2. Root `README.md`.
3. Root `boot.md`.
4. `extract/README.md`.
5. `extract/BOOT.md`.
6. This prompt.
7. `extract/ssot_compendium_sequential_build_plan.md`.

### Stage 2 — Discovery, catalog, and implementation

8. `extract/ssot_source_inventory.md`.
9. `extract/ssot_compendium_document_inventory.md`.
10. `extract/scripts/build_compendium_scaffold.py`.
11. Live `compendium_manifest.json`.
12. All 14 section READMEs.

### Stage 3 — Formal and core authority

13. Both authoritative root DOCX documents, extracting text/tables safely without
    modifying the binaries.
14. `docs/current_documentation_groundwork_plan.md`.
15. `docs/ssot/master_index.json` and `settings_manifest.json`.
16. `docs/knowledge.md`, `mastergameplan.md`, `timeline_moment_registry.md`,
    `cue.txt`, `inventory_reference.md`, and `rig.md`.

### Stage 4 — Public, asset, and owner breadth

17. Style, brand, website, owner/admin, marketing, public-site, and center sources
    named in `extract/BOOT.md`.
18. Structured-data families and duplicate/conflict samples named there.

For large collections, inspect envelopes, counts, hashes, representative records,
validation rules, and conflict-sensitive fields rather than blindly printing
everything.

### Stage 5 — Selected-scope deep study

Before editing a selected section or sub-section, read every named principal
source, applicable schema/vocabulary, upstream authority, governance record,
downstream generated dependency, and relevant Git history. Do not populate a
selected scope before this deep study.

---

## 5. Live State Audit

Audit every manifest leaf by opening its current file. Do not trust cached status,
manifest status alone, filenames, line counts, or the previous session's report.

### 5.1 Leaf states

Use exactly these operational states:

| Code | State | Meaning |
|---|---|---|
| `S` | `SCAFFOLD` | Empty structural shell; no extracted source facts. |
| `W` | `WORKING` | Extraction started but work remains. |
| `C` | `CONFLICT` | Material candidate values or authority remain unresolved. |
| `B` | `BLOCKED` | External evidence, decision, permission, rights, or safety authority prevents completion. |
| `R` | `REVIEW` | Content/provenance/validation complete; approval pending. |
| `A` | `APPROVED` | Controlled approval evidence exists and validation passes. |
| `G` | `GENERATED` | Reproducible derivative current to declared upstream revisions. |
| `X` | `SUPERSEDED` | Retained history, no longer active authority. |
| `!` | `INVALID` | Missing, malformed, inconsistent, falsely approved, or broken. |

Use the detailed classification precedence and approval rules in `extract/BOOT.md`.

### 5.2 Work buckets required by this prompt

In addition to exact leaf states, aggregate every scope into these user-facing
work buckets:

#### COMPLETED

- Canonical leaves in `APPROVED`.
- Generated leaves in `GENERATED`, shown separately from canonical completion.
- Superseded leaves may be reported as retained history but do not increase
  canonical completion.

#### NEEDS COMPLETION

- `WORKING`, `CONFLICT`, `BLOCKED`, `REVIEW`, and `INVALID`.
- Display each constituent state count; do not hide blockers or invalid files
  inside one total.

#### NOT STARTED

- `SCAFFOLD` only.

This creates the requested distinction between what has been completed, what has
started but still needs completion, and what has not started and must be started.

### 5.3 Section progress

For every major section and sub-section calculate:

- total leaves;
- `S/W/C/B/R/A/G/X/!` counts;
- canonical completion percentage, where only `A` counts;
- generated readiness separately;
- started percentage, where every non-`S` leaf counts as started;
- work-bucket totals;
- prerequisite status;
- next safe leaf or prerequisite;
- conflict/blocker/invalid alerts; and
- whether required generated outputs are stale.

A section is canonically complete only when all required canonical leaves are
approved, required generated leaves are current, dependencies are satisfied, and
no material conflict, blocker, or invalid finding affects its claims.

### 5.4 Audit artifact

Use a targeted Python audit retained in memory or `/tmp`. Do not commit a generated
status snapshot unless explicitly requested. Prefer an existing audit utility
only after reading it and confirming its rules match this prompt.

---

## 6. Required ANSI-Style Main Menu

After boot and audit, report a short orientation and then display this live menu.
Use rendered ANSI color when supported; otherwise retain box drawing, labels, and
symbols without raw escape-code text.

```text
╔════════════════════════════════════════════════════════════════════════════════════════════════════╗
║  JUST ONE KISS · SEQUENTIAL SSOT BUILD COMMAND CENTER                                             ║
╠════════════════════════════════════════════════════════════════════════════════════════════════════╣
║  ● COMPLETED   ◐ NEEDS COMPLETION   ○ NOT STARTED   ◆ CONFLICT   ⛔ BLOCKED   ⚠ INVALID            ║
║  Canonical order: 90 → 00 → 01 → 02 → 03 → 04 → 05 → 06 → 08 → 07 → 10 → 09 → 11 → 99          ║
╠════╦══════════════════════════════════════╦═══════════╦═══════════╦═══════════╦═══════╦════════════╣
║ ID ║ SECTION                              ║ COMPLETED ║ NEEDS     ║ NOT START ║ DONE  ║ PREREQ    ║
╠════╬══════════════════════════════════════╬═══════════╬═══════════╬═══════════╬═══════╬════════════╣
║ 90 ║ Schemas and Controlled Vocabularies  ║ A0 G0     ║ W0 C0... ║ S24       ║   0%  ║ READY      ║
║ 00 ║ Control and Governance               ║ A0 G0     ║ W0 C0... ║ S13       ║   0%  ║ NEEDS 90   ║
║ 01 ║ Project, Event, Venue, and People    ║ A0 G0     ║ W0 C0... ║ S12       ║   0%  ║ NEEDS A    ║
║ 02 ║ Show Program and Timeline            ║ A0 G0     ║ W0 C0... ║ S14       ║   0%  ║ NEEDS 01   ║
║ 03 ║ Technical Systems and Stage          ║ A0 G0     ║ W0 C0... ║ S29       ║   0%  ║ NEEDS 02   ║
║ 04 ║ Operations, Safety, and Readiness    ║ A0 G0     ║ W0 C0... ║ S15       ║   0%  ║ NEEDS 03   ║
║ 05 ║ Assets, Media, and Rights            ║ A0 G0     ║ W0 C0... ║ S12       ║   0%  ║ NEEDS B    ║
║ 06 ║ Brand, Content, and Accessibility    ║ A0 G0     ║ W0 C0... ║ S11       ║   0%  ║ NEEDS 05   ║
║ 08 ║ Public Website and Audience Data     ║ A0 G0     ║ W0 C0... ║ S15       ║   0%  ║ NEEDS 06   ║
║ 07 ║ Marketing, Sales, and Booking        ║ A0 G0     ║ W0 C0... ║ S16       ║   0%  ║ NEEDS 08   ║
║ 10 ║ Developer, Data, and Integrations    ║ A0 G0     ║ W0 C0... ║ S12       ║   0%  ║ NEEDS C    ║
║ 09 ║ Owner Admin and CMS                  ║ A0 G0     ║ W0 C0... ║ S15       ║   0%  ║ NEEDS 10   ║
║ 11 ║ Records, History, and Audit          ║ A0 G0     ║ W0 C0... ║ S8        ║   0%  ║ NEEDS D    ║
║ 99 ║ Indexes, Views, and Exports          ║ A0 G0     ║ W0 C0... ║ S13       ║   0%  ║ NEEDS ALL  ║
╚════╩══════════════════════════════════════╩═══════════╩═══════════╩═══════════╩═══════╩════════════╝

 Bare number(s) = EXECUTE AND FINISH:  90     90 00     01,02     05-08
 Sub-section number(s) = EXECUTE:       90.01  00.01,00.02
 Examine only: V <scope>  D <section>  F <leaf>  C  P <scope>  N  R  H  Q

 Selection ›
```

Replace all example counts, percentages, prerequisites, and alerts with live
results. Keep all 14 sections in canonical sequential order. Never hide nonzero
`C`, `B`, or `!` counts.

### Main-menu color recommendations

- Borders/header: bright chrome white.
- Completed/approved: bright green.
- Generated: magenta.
- Needs completion/working/review: cyan/blue.
- Conflict: yellow.
- Blocked/invalid: bright red.
- Not started/scaffold: dim gray.
- Execution hint and selection prompt: fire orange/yellow.

Always include text labels; never rely on color alone.

---

## 7. Section Examination Sub-Menu

When the user enters `D 03` or `V 03`, derive the real sub-sections from the live
catalog and show:

```text
╔══════════════════════════════════════════════════════════════════════════════════════════════╗
║  SECTION 03 · TECHNICAL SYSTEMS AND STAGE                                                    ║
╠════════╦══════════════════════════════════╦══════╦══════════╦══════════╦══════════╦══════════╣
║ ID     ║ SUB-SECTION                      ║ DOCS ║ COMPLETE ║ NEEDS    ║ NOT START║ PREREQ   ║
╠════════╬══════════════════════════════════╬══════╬══════════╬══════════╬══════════╬══════════╣
║ 03.01  ║ Equipment and fixture authority  ║  4   ║ A0 G0    ║ W0 C0... ║ S4       ║ ...      ║
║ 03.02  ║ Lighting and DMX                 ║  7   ║ A0 G0    ║ W0 C0... ║ S7       ║ ...      ║
║ 03.03  ║ Stage geometry and layout        ║  8   ║ A0 G0    ║ W0 C0... ║ S8       ║ ...      ║
║ 03.04  ║ Power/comms/audio/video/FX       ║  8   ║ A0 G0    ║ W0 C0... ║ S8       ║ ...      ║
║ 03.05  ║ Scene profiles/releases           ║  2   ║ A0 G0    ║ W0 C0... ║ S2       ║ ...      ║
╚════════╩══════════════════════════════════╩══════╩══════════╩══════════╩══════════╩══════════╝

 Enter 03.01 to EXECUTE AND FINISH that sub-section.
 Examine: V 03.01   Leaves: L 03.01   Provenance: P 03.01   Back: M

 Section 03 ›
```

Do not execute from `V` or `D` alone. Once in the sub-menu, a bare sub-section ID
still means execute.

---

## 8. Sub-Section Examination Sub-Menu

When the user enters `V 03.02` or `L 03.02`, show every leaf in dependency order:

```text
╔══════════════════════════════════════════════════════════════════════════════════════════════════╗
║  03.02 · LIGHTING AND DMX                                                                         ║
╠════╦════════════════════════════════════════════╦═══════════╦══════════════╦═════════════════════╣
║ #  ║ DOCUMENT                                   ║ STATE     ║ SOURCE       ║ NEXT ACTION         ║
╠════╬════════════════════════════════════════════╬═══════════╬══════════════╬═════════════════════╣
║ 1  ║ dmx_universe_registry.json                 ║ SCAFFOLD  ║ 0/N reviewed ║ extract/reconcile   ║
║ 2  ║ dmx_patch_plan.json                        ║ WORKING   ║ N/N reviewed ║ resolve conflict    ║
║ …  ║ …                                          ║ …         ║ …            ║ …                   ║
╚════╩════════════════════════════════════════════╩═══════════╩══════════════╩═════════════════════╝

 Enter 03.02 to EXECUTE the whole sub-section.
 Execute one leaf: W <number|document_id>   Inspect leaf: F <number|document_id>
 Conflicts: C 03.02   Provenance: P 03.02   Back: D 03

 03.02 ›
```

For each leaf include:

- exact state and reason;
- source-review coverage;
- unresolved conflicts/blockers;
- upstream and downstream dependencies;
- validation state;
- approval evidence state; and
- the next concrete action.

`W <leaf>` is an explicit single-leaf execution command. `F <leaf>` is inspection
only.

---

## 9. Execution Workflow for Numeric Selections

When the user selects one or more scopes numerically:

### Step 1 — Normalize and announce

1. Parse major sections, sub-sections, commas, spaces, and ranges.
2. Reject nonexistent or mixed malformed IDs with a concise correction.
3. Deduplicate selections.
4. Sort execution into canonical dependency order.
5. Identify missing prerequisites.
6. Announce the normalized execution queue, prerequisite work, dirty-tree overlap,
   and known external blockers.

Do not ask for confirmation unless the selection is genuinely ambiguous or the
work would require a destructive/irreversible choice not already authorized.

### Step 2 — Create a tracked plan

Use a task plan with at most one active step. Include:

1. prerequisite audit;
2. source and schema deep study;
3. extraction and reconciliation;
4. provenance/conflict/open-question updates;
5. validation and cross-reference checks;
6. downstream refresh;
7. live re-audit;
8. commit and PR metadata.

### Step 3 — Execute every safe action

For each selected scope:

1. Read every named source and relevant Git history.
2. Compare duplicate/forked sources using hashes and structural diffs.
3. Extract facts without silently resolving uncertainty.
4. Assign stable IDs and Timeline/GEN classification.
5. Add record-level provenance and confidence.
6. Register conflicts, questions, decisions, and blockers in Section `00`.
7. Protect restricted data and avoid copying raw PII/secrets.
8. Validate against Section `90` schemas/vocabularies.
9. Update manifest/revision/synchronization records.
10. Refresh only required downstream generated artifacts whose prerequisites are
    ready.

### Step 4 — Approval boundary

Never mark a document `approved` simply because work is thorough. Approval
requires the policy-defined owner/approver/effective/revision evidence and explicit
authorization. In the absence of approval authority, finish content to `REVIEW`
and record exactly what approval remains.

### Step 5 — Validate

At minimum run:

```bash
git diff --check
python3 - <<'PY'
import json
from pathlib import Path
for path in sorted(Path('extract/compendium').rglob('*.json')):
    json.loads(path.read_text(encoding='utf-8'))
print('All compendium JSON parses.')
PY
```

Also validate, when applicable:

- manifest/path/document-ID/class agreement;
- envelope fields and allowed status transitions;
- JSON Schema conformance;
- unique IDs and namespaces;
- source/provenance references and hashes;
- cross-document targets;
- Timeline/GEN and PGM/TECH/FIN crosswalks;
- DMX ranges, modes, footprints, and overlaps;
- current/release/history separation;
- privacy, rights, accessibility, and safety gates;
- generated-output upstream revisions; and
- absence of hidden scaffold notices in non-scaffold documents.

### Step 6 — Re-audit and continue

Re-audit the selected scope and all affected dependencies. If safe executable work
remains, continue; do not prematurely hand back a half-finished scope. Stop only
when the scope is canonically complete, review-ready pending approval, or genuinely
blocked/conflicted after all safe work is exhausted.

### Step 7 — Commit and PR

Review `git diff --check`, `git diff --stat`, touched-file diffs, and final status.
Commit the coherent change on the current branch. If the environment requires PR
metadata or provides a PR tool, create the PR after committing. Never include
unrelated user work or generated backups.

### Step 8 — Completion report and menu refresh

Report:

- scopes requested and normalized execution order;
- documents moved between states;
- what is canonically complete;
- what is review-ready;
- exact remaining conflicts/blockers and their required evidence/owner;
- source/provenance and validation coverage;
- commit and PR result; and
- exact test/check commands with pass/warning/fail status.

Then redraw the relevant section/sub-section menu from the new live audit. Do not
show stale counts.

---

## 10. Definitions of Done

### Leaf

A leaf is ready for `REVIEW` only when intended scope is covered, asserted records
have stable identity/provenance, conflicts are resolved or explicitly retained,
uncertainty survives, validation passes, references resolve, restricted data is
handled, dependencies and downstream refreshes are identified, control metadata
is complete except approval, and no blocker is concealed.

It is `APPROVED` only when the additional approval evidence and upstream readiness
required by governance exist.

### Sub-section

A sub-section is canonically complete only when all required canonical leaves are
approved, required releases/generated products are current, references validate,
and no material conflict, blocker, or invalid finding affects its assertions.

### Major section

A major section is canonically complete only when every required sub-section is
complete, cross-section dependencies are satisfied, manifest/revision/provenance
records are current, and required generated products have been refreshed.

### Whole program

The program is complete only when every source is covered or dispositioned, all
required canonical documents are approved, conflicts/questions/blockers/invalid
findings are closed or accepted through controlled decisions, privacy/rights/
accessibility/safety checks pass, generated products reproduce, and a clean audit
finds no scaffold masquerading as authority.

---

## 11. Non-Negotiable Cautions

- Never call an empty shell complete.
- Never equate `draft`, non-empty, or implemented behavior with approved truth.
- Never invent approval, rights, venue, contact, timing, geometry, safety, or
  equipment facts.
- Preserve both valid timing profiles until controlled selection.
- Preserve estimated/prototype status for geometry and fixture positions.
- Do not let historical records silently mutate current authority.
- Do not copy secrets, raw submissions, mail bodies, contact data, or sensitive
  diagnostics into unrestricted documents.
- Do not treat rendition-local SSOT copies, legacy routes, generated indexes,
  prompts, mockups, or backups as automatic authority.
- Do not edit generated Section `99` books as independent sources.
- Do not run `build_compendium_scaffold.py --clean` after extraction begins.
- Do not stop after planning when the user entered bare section numbers.
- Do not claim a selected section is complete while concealing `CONFLICT`,
  `BLOCKED`, `INVALID`, or pending approval states.

---

## 12. Required Boot Completion Response

After study and audit, keep the boot report operational:

1. Branch and clean/dirty state.
2. Applicable instruction files.
3. Manifest/filesystem counts.
4. Exact `S/W/C/B/R/A/G/X/!` totals.
5. Completed, needs-completion, and not-started totals.
6. Material conflicts, blockers, invalid files, privacy risks, and authority gaps.
7. Current gate and recommended next prerequisite.
8. Full live ANSI-style main menu.

End at:

```text
Selection ›
```

Wait for input. At that point, bare section or sub-section numbers are direct
execution instructions under Section 1 of this prompt.
