# SSOT Compendium Ongoing Build — Fresh Expert Execution Boot Prompt

Use this prompt after the compendium's initial instantiation and first development
session. It boots a fresh expert coding LLM into **continuation work**, not
greenfield discovery and not a menu-only status review. Its immediate assignment
is to reconcile the first session's handoff, finish the remaining Section `90`
foundation in bounded slices, preserve an auditable account of every choice, and
leave the next session a truthful, executable handoff.

This prompt extends [`BOOT.md`](BOOT.md), the original
[`SEQUENTIAL_BUILD_BOOT.md`](SEQUENTIAL_BUILD_BOOT.md), and
[`ssot_compendium_sequential_build_plan.md`](ssot_compendium_sequential_build_plan.md).
Direct user/system instructions and applicable `AGENTS.md` files take precedence.
When repository sources disagree, use the documented authority hierarchy and the
more conservative privacy, rights, safety, provenance, and approval rule.

---

## 0. First Response and Mission

Begin with this acknowledgement, then start work immediately:

> I will resume the live SSOT compendium from the repository rather than recreate
> it. I will verify the first session's actual work and Git state, repair stale
> handoff metadata, execute the next dependency-safe Section 90 slices through
> validation and review-ready state, record sources, decisions, conflicts, and
> remaining work as I go, and commit a coherent continuation with PR metadata. I
> will not claim approval or canonical completion without the required evidence.

Do **not** stop at an ANSI menu and do not wait for a numeric selection. The work
queue in Section 6 is already authorized by this prompt. Ask the user only when a
destructive choice, unavailable secret, or decision reserved to a human owner is
truly required. Otherwise make the safest reversible engineering choice, record
it, and continue.

The objective is not to maximize the number of files touched. The objective is to
finish several coherent dependency slices, with each touched leaf complete to the
highest truthful state attainable (`review` when controlled approval is the only
remaining step).

---

## 1. Evaluated Handoff Baseline — Verify, Never Assume

The baseline below was evaluated on **2026-08-13** after initial instantiation and
the first development session. It is orientation, not cached truth:

- The catalog and filesystem contain 14 sections and 209 planned leaves.
- Eleven Section `90` leaves appear substantively populated and marked `review`:
  `document.schema`, `entity_record.schema`, `source_reference.schema`,
  `conflict.schema`, `release.schema`, `status_vocabularies`,
  `id_namespace_registry`, `relationship_type_registry`, `role_vocabulary`,
  `asset_taxonomy`, and `channel_and_placement_vocabulary`.
- The other 198 leaves still appear to contain their explicit scaffold markers.
- Section `90` therefore appears to contain `R11/S13`; all other sections appear
  scaffold-only. There is no approved or generated canonical completion.
- The manifest and Section `90` README still describe scaffold-era state and may
  not reflect those eleven files. This is a handoff-integrity defect, not evidence
  that the populated files should be discarded.
- The historical plan's statement that all 209 leaves are scaffolds describes its
  evaluated starting baseline and is now stale as a live-status claim.
- At evaluation time the current branch was `work`, the tree was clean, the only
  visible commit was `9e69ba3` (`Initial commit`), and no Git remote was configured.

Recompute all of this from the live tree. If it differs, trust verified files and
Git history, explain the delta in the session log, and adapt the queue without
overwriting newer work.

### Required state classification

Classify by content, not the top-level `status` string alone:

| Code | Operational state | Minimum interpretation |
|---|---|---|
| `S` | `SCAFFOLD` | Explicit scaffold notice/empty scaffold payload; no extraction. |
| `W` | `WORKING` | Substantive work exists but intended extraction/validation remains. |
| `C` | `CONFLICT` | Material candidate values or authority remain unresolved. |
| `B` | `BLOCKED` | External evidence, permission, decision, or authority prevents progress. |
| `R` | `REVIEW` | Intended content, provenance, and validation are complete; approval pending. |
| `A` | `APPROVED` | Required controlled approval evidence exists and validates. |
| `G` | `GENERATED` | Reproducible derivative is current to declared upstream revisions. |
| `X` | `SUPERSEDED` | Retained history that is no longer active authority. |
| `!` | `INVALID` | Missing, malformed, inconsistent, falsely approved, or broken. |

Never demote sound first-session work merely because the manifest is stale. Never
promote it merely because it is lengthy or says `review`.

---

## 2. Boot Verification

Run from the repository root before editing:

```bash
pwd
find .. -name AGENTS.md -type f -print
git status --short --branch
git branch --show-current
git remote -v
git log --oneline --decorate -10
find extract -maxdepth 3 -type f | sort
find extract/compendium -type f -name '*.json' | sort | wc -l
find extract/compendium -type f -name '*.md' ! -name README.md | sort | wc -l
find extract/compendium -mindepth 2 -maxdepth 2 -type f -name README.md | sort | wc -l
python3 extract/scripts/build_compendium_scaffold.py --help
```

If a remote and upstream exist, fetch and fast-forward only. If neither exists,
record that fact and continue locally. Never run the scaffold generator with
`--clean`; extraction has begun and regeneration can destroy completed work.

### Dirty-tree protocol

1. Inventory and inspect every existing change.
2. Classify it as user work, prior-session work, or current-session work.
3. Never reset, overwrite, reformat, stage, or commit unrelated changes.
4. If existing changes overlap Section `90`, preserve them and reconcile by
   content and provenance; do not choose by timestamp alone.
5. Record any unavoidable overlap in the work-session log and final handoff.

---

## 3. Efficient Continuation Study

Do not blindly repeat the original session's entire repository-wide reading pass.
Fresh expertise still requires enough study to verify authority and safely author
the selected schemas.

### Read fully before editing

1. All applicable `AGENTS.md` files.
2. Root `README.md` and `boot.md`.
3. `extract/README.md`, `extract/BOOT.md`, this prompt, and the original
   `extract/SEQUENTIAL_BUILD_BOOT.md`.
4. `extract/ssot_compendium_sequential_build_plan.md`, especially Section `90`.
5. `extract/ssot_compendium_document_inventory.md`, especially `90.01`–`90.03`.
6. `extract/scripts/build_compendium_scaffold.py`—for provenance only, never to
   regenerate ongoing work.
7. The live manifest, Section `90` README, and all 24 Section `90` leaves.
8. The two authoritative root DOCX files, extracting text/tables to `/tmp` for
   study without modifying the binaries.
9. `docs/current_documentation_groundwork_plan.md`,
   `docs/ssot/master_index.json`, and `docs/ssot/settings_manifest.json`.

### Targeted study for each slice

Read the source families named by each selected leaf and inspect representative
records from every shape the schema must accept. Use hashes and structural diffs
to avoid repeatedly reading identical rendition-local copies. At minimum cover:

- Timeline/program/cue sources: `docs/knowledge.md`, `docs/mastergameplan.md`,
  `docs/timeline_moment_registry.md`, `docs/cue.txt`, and relevant SSOT JSON.
- Equipment/scene sources: `docs/inventory_reference.md`, `docs/rig.md`, equipment
  manuals, `proto_prob` schemas/global data, all fixture envelope variants, and
  scene-profile variants.
- Asset/content/campaign/public/form sources: style and brand guides, asset
  inventories, website/marketing plans, current and published page-layer data,
  public routes, form handlers, and SQL contracts—without copying submissions,
  secrets, or PII.
- Owner/inspection sources: owner readiness/boot plans, center contracts, safety
  requirements, inspection/maintenance shapes, and approval boundaries.

For large families inspect manifests, schemas, counts, hashes, representative
records, edge cases, and conflict-sensitive fields. Record exactly what was
covered; “repository reviewed” is not adequate provenance.

---

## 4. Reconcile the First Session Before Extending It

Perform this short repair pass first:

1. Open and structurally audit each of the eleven apparent `review` leaves.
2. Confirm scaffold markers were removed, source hashes resolve, schema payloads
   are substantive, internal `$ref` targets are intentional, and approval remains
   pending rather than implied.
3. Validate each embedded JSON Schema with a Draft 2020-12 validator when
   available. Distinguish schema checking from representative-instance checking.
4. Record defects as working findings and repair them when supported by sources.
5. Synchronize the live manifest's leaf status/revision/scaffold state with the
   audited files. Do not make the manifest claim approval.
6. Replace stale scaffold-only language in the Section `90` README with a concise
   live progress statement and a per-leaf status inventory.
7. Correct `extract/README.md` if it still says the entire tree is scaffolding
   only. Preserve the warning that nothing is approved canon merely because it is
   populated.

This repair pass is part of the session, but it is not one of the three delivery
slices below.

---

## 5. Authoring and Validation Contract

Every schema/vocabulary leaf advanced from scaffold must:

1. Remove all scaffold notices and empty-scaffold claims.
2. Use the common controlled envelope established by `document.schema.json`.
3. Retain `status: review` unless explicit, policy-conforming approval evidence
   and user authorization are present.
4. Assign a meaningful revision and truthful dates; do not rewrite historical
   creation dates without evidence.
5. Name owner and approver **roles** supported by authority; do not invent people.
6. Include path, SHA-256, locator/scope, extraction method, and use for each
   principal source reference.
7. Put the actual Draft 2020-12 schema in `data.schema`, plus explicit source
   mapping, assumptions, and validation notes.
8. Use stable `$id` values and locally resolvable `$ref` conventions. Do not use
   the placeholder example domain as if it were an approved production domain if
   repository authority supplies no such domain; record the convention chosen.
9. Preserve `GEN` versus Timeline-specific identity and PGM/TECH/FIN distinctions.
10. Model uncertainty, estimated values, verification state, conflicts,
    supersession, privacy classification, and approval evidence instead of
    flattening them into optimistic booleans.
11. Use `additionalProperties` deliberately. Avoid both unconstrained “anything”
    objects and brittle closure unsupported by representative records.
12. Include representative valid and invalid fixtures under `/tmp` or in a
    reusable repository validation fixture location only when their maintenance
    value justifies committing them.
13. Update the manifest, README progress, and session log in the same slice.

Do not encode current draft business facts as universal schema constants. A
schema validates record shape and controlled vocabulary references; it does not
silently settle event timing, venue, equipment, rights, safety, or owner choices.

---

## 6. Pre-Authorized Execution Queue: Finish the Next Three Slices

Execute these in order. Use a tracked task plan with at most one active step. Do
not stop after analysis, and do not skip ahead merely because a later schema is
easier.

### Slice 1 — Close core temporal identity (`90.01` remainder)

Finish `timeline_moment.schema.json` to review-ready state. Reconcile it against
the already-populated common envelope/entity/source/conflict schemas and the
authoritative Timeline/GEN and PGM/TECH/FIN rules. Validate representative
Timeline-family values and `GEN`, links, lifecycle/classification status,
confidence, provenance, and forbidden malformed IDs.

**Done when:** the leaf validates structurally and against representative cases;
its source/provenance coverage is explicit; the manifest and progress inventory
are synchronized; no scaffold marker remains; and any unresolved authority issue
is registered rather than guessed.

### Slice 2 — Production-domain schemas (`90.02A`)

Finish these dependency-related leaves:

1. `program_event.schema.json`
2. `department_cue.schema.json`
3. `equipment_type.schema.json`
4. `equipment_instance.schema.json`
5. `scene_profile.schema.json`

Re-use shared definitions through resolvable references where that improves
consistency. Validate against representative program events, department cues,
fixture types, fixture instances, DMX modes/footprints, geometry verification,
maintenance state, and scene profiles. Explicitly test DMX address bounds and
footprint shape without claiming that schema validation alone detects every
cross-record universe overlap.

**Done when:** all five leaves meet Section 5, representative positive/negative
cases pass, cross-schema references resolve, source families are covered, and
the manifest/log/README are current.

### Slice 3 — Public, operational, and managed-work schemas (`90.02B`)

Finish the remaining domain leaves:

1. `asset.schema.json`
2. `content_token.schema.json`
3. `campaign.schema.json`
4. `public_route_section.schema.json`
5. `form_submission.schema.json`
6. `owner_work_item.schema.json`
7. `inspection_report.schema.json`

Pay special attention to rights state, claims and approvals, accessibility,
publication gates, consent/privacy, secure indirection for restricted submissions,
owner permissions/evidence/dependencies, inspection findings, corrective action,
and safety sign-off. Schemas must never encourage raw secrets, mail bodies, or PII
to be copied into unrestricted compendium records.

**Done when:** all seven leaves meet Section 5 and the same representative-case,
reference, provenance, synchronization, and logging checks as Slice 2.

### Queue completion rule

Continue through all three slices while safe executable work remains. A conflict
in one field or leaf does not halt independent work in the rest of the slice. If
one leaf cannot reach review, leave it truthfully `working`, `conflict`, or
`blocked`, register the exact issue and required owner/evidence, and continue.
After Slice 3, Section `90` should be expected—not presumed—to audit as 24 review
leaves pending controlled approval.

Do not begin bulk Section `00` extraction in this session unless all three slices,
their validations, synchronization, logging, commit, and PR metadata are complete
and the user explicitly extends the scope. The next recommended session begins
the Section `00` control/governance foundation.

---

## 7. Durable Notes, Decisions, and Handoff Discipline

Create or append a human-readable session file under
`extract/work_sessions/YYYY-MM-DD_<short-topic>.md`. This is an **operational
handoff log**, not approved SSOT and not a substitute for Section `00` or `11`.
Give it that disclaimer.

Record throughout the work—not reconstructed from memory at the end:

- UTC start/end, branch, starting commit, ending commit, and dirty-tree context;
- requested scope and actual slice order;
- starting and ending live state counts;
- every leaf touched and its state transition;
- sources inspected, with paths, hashes or revisions, and relevant locators;
- schema design decisions and rejected alternatives with rationale;
- assumptions, conflicts, blockers, validation limitations, and human decisions
  still required;
- exact validation commands and results;
- manifest/README/revision synchronization performed;
- downstream consequences and the next safe leaves; and
- commit and PR result.

Use stable IDs in prose for provisional findings (for example
`SESSION-FINDING-20260813-001`). Once Section `00` registers exist, migrate or
cross-reference material conflicts, open questions, decisions, and provenance
there; do not let the operational log become shadow authority. Never record raw
PII, secrets, form payloads, or safety-sensitive details beyond what is necessary
to identify a controlled source.

Before ending, include a compact **Next Session Boot Handoff** block that states:

1. exact current commit and tree state;
2. live `S/W/C/B/R/A/G/X/!` totals by affected section;
3. last completed slice and first unfinished leaf;
4. unresolved findings with owner/evidence needed;
5. commands that reproduce validation; and
6. recommended next slice (normally Section `00` foundation).

---

## 8. Required Checks

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

Also implement or run targeted checks for:

- all 209 manifest document IDs and paths are unique and exist;
- manifest path/class/status/revision/scaffold-state agree with live leaves;
- every non-schema `schema_ref` resolves;
- every populated Section `90` embedded schema passes Draft 2020-12 schema
  checking with format assertions where supported;
- local `$ref` targets resolve from the intended base URI/path;
- representative valid instances pass and intentionally invalid instances fail;
- IDs/namespaces, Timeline/GEN, PGM/TECH/FIN, visibility, status, provenance,
  confidence, and approval constraints behave as designed;
- no populated leaf retains scaffold notices or empty scaffold payloads; and
- no restricted data or secrets were introduced.

If a dependency such as `jsonschema` is unavailable and cannot be installed,
record the environment limitation, run all possible structural checks, and do not
misreport full schema validation as passing.

---

## 9. Git, Commit, and PR Completion

After each slice, inspect the focused diff and retain a checkpoint in the task
plan/log. At the end:

1. Re-audit all 24 Section `90` leaves from their contents.
2. Review `git diff --check`, `git diff --stat`, every touched-file diff, and
   final status.
3. Stage only the coherent continuation work; exclude unrelated changes,
   temporary files, extracted DOCX text, caches, and sensitive fixtures.
4. Commit on the current branch with a message describing the completed
   foundation slices.
5. If a PR tool exists, invoke it after the commit with a title and body covering
   scope, state transitions, validation, remaining approval boundary, and next
   session. Never create PR metadata without a commit or commit without required
   PR metadata.
6. Record the commit and PR result in the session log. If the log must be updated
   with the final commit hash after committing, amend coherently and ensure the
   reported hash is the actual final commit.

---

## 10. Required Completion Response

Return an execution report, not a proposed plan. Include:

- verified starting baseline and any differences from Section 1;
- slices completed and leaf state transitions;
- exact ending live counts, separating review-ready from approved/generated;
- source/provenance and representative-test coverage;
- design decisions and where they were logged;
- exact remaining conflicts, blockers, invalid findings, and approval needs;
- manifest/README/log synchronization;
- commit hash and PR result;
- exact test commands, each marked pass, warning, or failure; and
- the next session's first recommended slice.

Never say “Section 90 complete” without qualifying whether that means authoring
complete and review-ready versus canonically approved. The expected responsible
outcome is **Section 90 authoring complete, validation passing, 24 leaves in
review, controlled approval still pending**—but report only what the final live
audit proves.
