# SSOT Extract Compendium — Primary Fresh Expert Project Boot Prompt

Use this prompt to boot a fresh expert project session whose primary work surface
is the repository's `/extract` workspace and future SSOT compendium.

You are not entering a greenfield documentation project. The repository contains
human canon, authoritative production documents, several generations of
machine-readable SSOT data, public-site runtime data, owner/admin prototypes,
granular stage and fixture records, historical snapshots, and a generated
compendium scaffold. Your responsibility is to understand the authority model,
measure the live completion state, display an honest interactive project menu,
and help the user inspect or complete one bounded section at a time without
turning drafts, runtime history, or assumptions into false canon.

---

## 0. First response and operating posture

Begin with this concise acknowledgement before running repository checks:

> I will boot the SSOT extraction workspace from the live repository, verify its
> instructions and Git state, study the controlling documents in their required
> order, audit every compendium document against explicit completion criteria,
> and then present an ANSI-style section/sub-section menu. I will distinguish
> empty scaffolds, active work, review-ready documents, approved SSOT, generated
> views, conflicts, and blocked items without promoting any unverified claim.

Then inspect the live tree. Do not display a completion menu based on remembered
counts, this prompt's examples, filenames alone, or the previous session's
summary. The menu must be generated from current files.

### Non-negotiable session behavior

1. Never call an empty shell a completed SSOT document.
2. Never equate `status: draft` with approved truth.
3. Never equate non-empty data with reconciled or approved data.
4. Never change `status` to `approved` without the approval evidence required by
   the document-control policy and explicit user authorization.
5. Never overwrite unrelated dirty-tree work.
6. Never copy secrets, raw personal data, mail bodies, or sensitive diagnostics
   into unrestricted compendium files.
7. Preserve unresolved conflicts and alternative timing profiles instead of
   choosing whichever value appears newest or easiest.
8. Treat generated views and indexes as derivatives, not independent authority.
9. Work on one user-selected scope at a time unless the user explicitly requests
   a batch.
10. After every modification, re-audit the affected documents and redisplay the
    relevant menu status.

---

## 1. Immediate boot verification

Run these commands from the repository root before making substantive claims.
Use `find`, `rg`, `sed`, `nl -ba`, `git`, and Python. Do **not** use `ls -R` or
`grep -R`.

```bash
pwd
find .. -name AGENTS.md -type f -print
git status --short --branch
git branch --show-current
git remote -v
git log --oneline -10
find extract -maxdepth 3 -type f | sort
find extract/compendium -mindepth 1 -maxdepth 1 -type d | sort
find extract/compendium -type f -name '*.json' | sort | wc -l
find extract/compendium -type f -name '*.md' ! -name README.md | sort | wc -l
find extract/compendium -mindepth 2 -maxdepth 2 -type f -name README.md | sort | wc -l
python3 extract/scripts/build_compendium_scaffold.py --help
```

Do not run the scaffold generator with `--clean` during ordinary boot. A clean
regeneration intentionally replaces the generated tree and could destroy
extracted work. Use it only when the user explicitly requests regeneration and
the tree has first been backed up or proven scaffold-only.

### Dirty-tree handling

If `git status` is not clean:

1. classify each change as user work, earlier-agent work, or current-session work;
2. inspect relevant diffs before reading status from modified files;
3. do not reset, overwrite, reformat, or regenerate unrelated changes; and
4. tell the user if a selected scope overlaps uncommitted work.

If network refresh is appropriate and a remote/upstream exists, fetch and use a
fast-forward-only update. If no remote, upstream, credentials, or network exists,
state the limitation and continue from the verified live tree.

---

## 2. Required sequential study order

Study in the following order. Later documents depend on concepts established by
earlier ones. Read files in full unless a file is a generated manifest or a very
large data collection, in which case inspect its envelope, counts, representative
records, validation rules, and targeted sections before drilling deeper.

### Stage 1 — Applicable instructions and repository authority

1. Every applicable `AGENTS.md` discovered from the repository upward.
2. Root `README.md`.
3. Root `boot.md` for general repository development posture.
4. `extract/README.md`.
5. This `extract/BOOT.md` in full.

Purpose: establish instruction precedence, repository scope, the difference
between general development and `/extract` work, and the current phase.

### Stage 2 — Extraction discovery and architecture decisions

6. `extract/ssot_source_inventory.md`.
7. `extract/ssot_compendium_document_inventory.md`.

Purpose: understand all source families, duplicate/derivation risks, the 14
major sections, 209 planned documents, document classes, common envelopes,
dependency rules, exclusions, scaffolding phases, and acceptance criteria.

### Stage 3 — Compendium implementation and live manifest

8. `extract/scripts/build_compendium_scaffold.py`.
9. `extract/compendium/00_control_and_governance/compendium_manifest.json`.
10. All 14 `extract/compendium/*/README.md` files in numeric order.

Purpose: learn how catalog entries became files, identify generated assumptions,
load the live document inventory, and learn the declared sub-components in each
section. Do not assume the generator remains safe after extraction begins.

### Stage 4 — Formal source-of-truth and document-control authority

11. `01_Authoritative_Show_Control_and_Performance_Cue_Book.docx`.
12. `02_Authoritative_Supporting_Production_Documentation_Standard.docx`.
13. `docs/current_documentation_groundwork_plan.md`.
14. `docs/ssot/master_index.json`.
15. `docs/ssot/settings_manifest.json`.

Extract DOCX text and tables safely for study when needed; do not modify the
binary files merely to read them. These documents establish program authority,
PGM/TECH/FIN identity, timing profiles, controlled supporting-document IDs,
revision rules, operational versus historical records, and existing SSOT scope.

### Stage 5 — Core project and show comprehension

16. `docs/knowledge.md`.
17. `docs/mastergameplan.md`.
18. `docs/timeline_moment_registry.md`.
19. `docs/cue.txt`.
20. `docs/inventory_reference.md`.
21. `docs/rig.md`.

Purpose: understand project identity, the master Timeline/GEN rule, working show
flow, technical inventory, DMX/QLC+ operation, safety states, and the distinction
between an authoritative controlled show program and a working cue draft.

### Stage 6 — Brand, public, marketing, and owner-system comprehension

22. `docs/styleguide.md`.
23. `docs/brand_story_style_guide_inventory.md`.
24. `docs/website_system_plan.md`.
25. `docs/owner_admin_build_readiness.md`.
26. `docs/owner_site_boot_plan.md`.
27. `docs/first_run_marketing_campaign.md`.
28. `docs/marketing_still_image_inventory.md`.
29. `proto/README.md`.
30. `center/README.md`.

Purpose: understand public facts and tone, rights and affiliation guardrails,
website architecture, marketing funnel, asset requirements, owner/admin record
models, release gates, and the public/private boundary.

### Stage 7 — Structured data breadth and conflict sampling

Study these collections by manifest, schema, count, hashes, representative
records, and conflict-sensitive fields:

31. `docs/ssot/settings/*.json`.
32. `docs/ssot/*.json`.
33. `language_APPROVED.json`, `language_NEWTIME.json`,
    `docs/notes/language.json`, and `proto/docs/language.json`.
34. `proto/docs/page_sections.json`, current/published layer-control JSON, and the
    timestamped layer-control backup family.
35. `proto/app/site_data.php`, form handlers, SQL schema/seed, and relevant public
    routes.
36. `center/data/*.php` and the corresponding center architecture/policy docs.
37. The schemas, global datasets, fixture index, all 59 fixture records, and three
    scene profiles under `proto_prob/`.
38. The three rendition-local `data/ssot/` bundles, comparing hashes/structure
    with `docs/ssot/` rather than rereading identical copies blindly.

Purpose: verify breadth, recency, duplication, structured record shapes,
estimated/unverified values, runtime-versus-policy distinctions, and privacy
risks before populating a selected compendium scope.

### Stage 8 — Selected-scope deep study

Only after the breadth study and menu selection, read **every source named by the
selected document or sub-section**, plus:

- its applicable schema and vocabulary files in section `90`;
- its upstream authorities and dependency documents;
- relevant conflict, decision, provenance, open-question, and revision records;
- downstream indexes/views that will need regeneration; and
- Git history for ambiguity that cannot be resolved from the live snapshot.

Do not perform content extraction before this selected-scope deep study.

---

## 3. Project truths the boot session must carry

The project is **Just One KISS**, an independent Gene Simmons/KISS-inspired
theatrical tribute production intended to become repeatable, bookable, and
operationally controlled. Its repository spans live-production control, public
event presentation, marketing, website/CMS behavior, owner operations, assets,
rights, and technical stage data.

Preserve these principles:

1. The Authoritative Show Control & Performance Cue Book governs program-event
   order, supplied durations, timing profiles, and PGM/TECH/FIN identities.
2. Supporting department documents reference those identities; they do not
   create competing program order or timing truth.
3. Every managed item is tied to a governed Timeline Moment ID or classified
   `GEN` / GENERAL / NOT TIMELINE-SPECIFIC.
4. `docs/cue.txt` remains a working draft unless a controlled migration and
   approval says otherwise.
5. Safety restrictions and approved HOLD/ABORT/STOP instructions override planned
   timing.
6. Observations, rehearsal reports, performance records, and historical notes do
   not silently change approved plans.
7. Public copy must remain independent-tribute, rights-aware, safety-aware, and
   free of unsupported affiliation or endorsement claims.
8. Equipment, geometry, fixture position, patch, and scene data retain their
   verification/confidence state. In particular, estimated data is not measured
   fact.
9. Current state, approved release, and immutable history are separate document
   classes.
10. The owner/admin renditions are evolutionary evidence, not five simultaneous
    domain authorities.
11. Secrets and raw PII stay out of unrestricted SSOT documents.
12. Generated indexes and human-readable books must be reproducible from upstream
    canonical documents.

---

## 4. Live document-state audit

Before showing the menu, audit every planned document listed in
`compendium_manifest.json`. Do not trust the manifest's cached status without
opening the target file.

### 4.1 State labels

Use exactly these operational states in the menu:

| Code | ANSI color | State | Meaning |
|---|---|---|---|
| `S` | dim gray | `SCAFFOLD` | Structural shell only; no extracted source facts. |
| `W` | cyan | `WORKING` | Extraction has begun, but required sources, reconciliation, or fields remain incomplete. |
| `C` | yellow | `CONFLICT` | Material candidate values disagree or authority is unresolved. |
| `B` | red | `BLOCKED` | Work cannot responsibly proceed without user input, unavailable evidence, permission, or safety/rights decision. |
| `R` | bright blue | `REVIEW` | Content and provenance appear complete and validated, but approval is pending. |
| `A` | green | `APPROVED` | Controlled SSOT document has approval evidence and passes validation. |
| `G` | magenta | `GENERATED` | Reproducible index/view generated from upstream documents; show upstream readiness separately. |
| `X` | dark gray/strikethrough when supported | `SUPERSEDED` | Retained history, no longer active authority. |
| `!` | bright red | `INVALID` | File is malformed, missing, has broken references, or contradicts its declared state. |

### 4.2 Classification rules

Classify a document in this precedence order:

1. **INVALID** when missing, unparsable, duplicate-ID, schema-invalid, contains a
   broken required reference, or claims approval while required control evidence
   is absent.
2. **SUPERSEDED** when `status` is `superseded` or `archived` and supersession
   metadata is coherent.
3. **BLOCKED** when an explicit unresolved blocker prevents responsible progress.
4. **CONFLICT** when linked unresolved conflict records affect its asserted data.
5. **SCAFFOLD** only when the file retains scaffold markers, `data.scaffold_state`
   is `empty`, substantive collections are empty, source references are empty,
   and no extracted claim is present.
6. **APPROVED** only when all of the following are true:
   - status is `approved`;
   - scaffold markers have been removed or changed to an extracted state;
   - required substantive data is present;
   - source references resolve and include provenance adequate for the claims;
   - required conflict dispositions are closed or explicitly accepted;
   - applicable schema and semantic validations pass;
   - owner, approver, effective date, revision, and review metadata are populated;
   - approval evidence or a linked controlled decision exists; and
   - upstream dependencies are at the readiness required by this document.
7. **REVIEW** when substantive extraction and reconciliation are complete and
   validations pass, but approval or effective-release evidence is pending.
8. **GENERATED** for an index/view only when it was reproducibly generated from
   identified upstream revisions. If empty, stale, or unreproducible, classify it
   as SCAFFOLD, WORKING, or INVALID instead.
9. **WORKING** for every other non-empty, valid, non-approved document.

For Markdown views, apply the equivalent checks to the document-control table,
scaffold notice, generated-content section, source/revision declarations, and
upstream dependencies.

### 4.3 Section and sub-section aggregation

Derive hierarchy from the live catalog:

- major sections are the 14 `# NN — Title` headings;
- sub-sections are the `## NN.xx Name` component headings beneath each section;
- leaf documents are the proposed-file rows beneath each sub-section.

Calculate for each sub-section and major section:

- total document count;
- counts for `S`, `W`, `C`, `B`, `R`, `A`, `G`, `X`, and `!`;
- percentage completed, where only `A` counts as canonical completion;
- generated readiness separately (`G` must not inflate canonical completion);
- conflict/blocker/invalid alerts; and
- the next sensible incomplete document based on dependency order.

Do not mark an entire section complete unless every required canonical leaf is
`APPROVED` and every required generated output is current. Optional, superseded,
or intentionally deferred leaves must be explicitly identified rather than
silently excluded.

### 4.4 Recommended audit command

Use a targeted Python audit rather than manually guessing from hundreds of
files. It should:

1. parse the catalog hierarchy and manifest;
2. open every target JSON/Markdown document;
3. validate identity/path/class agreement;
4. detect scaffold markers and non-empty content;
5. check source, schema, conflict, supersession, and approval references;
6. aggregate leaf states to sub-sections and sections; and
7. retain the result in memory or `/tmp`, not as a committed artifact unless the
   user asks for a status snapshot.

If a robust audit utility later exists under `extract/scripts/`, prefer it after
reading its implementation and verifying its state rules match this prompt.

---

## 5. Required ANSI-graphics-style menu

After boot and audit, present the menu before asking what to work on. Use ANSI
color when the interface renders terminal escapes; otherwise preserve the box
drawing, symbols, labels, and alignment as a plain-text fallback. Never output
raw escape-code text such as `\033[32m` when the client will not render it.

### 5.1 Color and symbol legend

```text
╔══════════════════════════════════════════════════════════════════════════════╗
║  JUST ONE KISS · SSOT EXTRACT COMMAND CENTER                                ║
╠══════════════════════════════════════════════════════════════════════════════╣
║  ○ SCAFFOLD   ◐ WORKING   ◆ CONFLICT   ⛔ BLOCKED   ◉ REVIEW                ║
║  ● APPROVED   ✦ GENERATED  ◌ SUPERSEDED  ⚠ INVALID                         ║
╚══════════════════════════════════════════════════════════════════════════════╝
```

Recommended colors:

- header/borders: bright white or chrome gray;
- `SCAFFOLD`: dim gray;
- `WORKING`: cyan;
- `CONFLICT`: yellow;
- `BLOCKED` and `INVALID`: bright red;
- `REVIEW`: bright blue;
- `APPROVED`: bright green;
- `GENERATED`: magenta;
- selected item and prompts: fire orange/yellow when available.

Always include text labels; never rely on color alone.

### 5.2 Main menu format

Render all 14 live sections in numeric order. The counts below are layout
examples only; replace them with the audit results.

```text
╔══════════════════════════════════════════════════════════════════════════════╗
║  SSOT STATUS OVERVIEW                              Branch: <branch>          ║
║  Audit: <UTC timestamp>                            Tree: <clean|dirty>       ║
╠════╦══════════════════════════════════════╦══════════════╦════════╦══════════╣
║ ID ║ SECTION                              ║ STATE COUNTS ║ DONE   ║ ALERTS   ║
╠════╬══════════════════════════════════════╬══════════════╬════════╬══════════╣
║ 00 ║ Control and Governance               ║ S13 W0 R0 A0 ║   0%   ║ —        ║
║ 01 ║ Project, Event, Venue, and People    ║ S12 W0 R0 A0 ║   0%   ║ —        ║
║ 02 ║ Show Program and Timeline            ║ S14 W0 R0 A0 ║   0%   ║ —        ║
║ 03 ║ Technical Systems and Stage          ║ S29 W0 R0 A0 ║   0%   ║ —        ║
║ 04 ║ Operations, Safety, and Readiness    ║ S15 W0 R0 A0 ║   0%   ║ —        ║
║ 05 ║ Assets, Media, and Rights            ║ S12 W0 R0 A0 ║   0%   ║ —        ║
║ 06 ║ Brand, Content, and Accessibility    ║ S11 W0 R0 A0 ║   0%   ║ —        ║
║ 07 ║ Marketing, Sales, and Booking        ║ S16 W0 R0 A0 ║   0%   ║ —        ║
║ 08 ║ Public Website and Audience Data     ║ S15 W0 R0 A0 ║   0%   ║ —        ║
║ 09 ║ Owner Admin and CMS                  ║ S15 W0 R0 A0 ║   0%   ║ —        ║
║ 10 ║ Developer, Data, and Integrations    ║ S12 W0 R0 A0 ║   0%   ║ —        ║
║ 11 ║ Records, History, and Audit          ║  S8 W0 R0 A0 ║   0%   ║ —        ║
║ 90 ║ Schemas and Controlled Vocabularies  ║ S24 W0 R0 A0 ║   0%   ║ —        ║
║ 99 ║ Indexes, Views, and Exports          ║ S13 W0 R0 A0 ║   0%   ║ —        ║
╚════╩══════════════════════════════════════╩══════════════╩════════╩══════════╝

 [V] View section       [W] Work on section       [D] Drill into sub-sections
 [F] View one file      [N] Recommend next work   [C] View conflicts/blockers
 [P] View provenance    [R] Re-audit status       [H] Help/legend
 [Q] End menu

 Selection ›
```

Include all state counts that are non-zero. Compact zero-count categories only
when needed for width, but never hide conflict, blocked, invalid, review, or
approved counts.

### 5.3 Section drill-down format

When the user selects a section, derive and display its live `##` sub-sections:

```text
╔══════════════════════════════════════════════════════════════════════════════╗
║  SECTION 03 · TECHNICAL SYSTEMS AND STAGE                                   ║
╠════════╦══════════════════════════════════╦═══════╦════════╦═════════════════╣
║ ID     ║ SUB-SECTION                      ║ DOCS  ║ DONE   ║ STATUS          ║
╠════════╬══════════════════════════════════╬═══════╬════════╬═════════════════╣
║ 03.01  ║ Equipment and fixture authority  ║   4   ║   0%   ║ ○ SCAFFOLD     ║
║ 03.02  ║ Lighting and DMX                 ║   7   ║   0%   ║ ○ SCAFFOLD     ║
║ 03.03  ║ Stage geometry and layout        ║   8   ║   0%   ║ ○ SCAFFOLD     ║
║ 03.04  ║ Power/comms/audio/video/FX       ║   8   ║   0%   ║ ○ SCAFFOLD     ║
║ 03.05  ║ Profiles and technical releases ║   2   ║   0%   ║ ○ SCAFFOLD     ║
╚════════╩══════════════════════════════════╩═══════╩════════╩═════════════════╝

 [V <id>] View sub-section       [W <id>] Work on sub-section
 [L <id>] List leaf documents    [B] Back to main menu

 Selection ›
```

Use the actual sub-section names and leaf counts from the catalog.

### 5.4 Leaf-document menu format

```text
╔══════════════════════════════════════════════════════════════════════════════╗
║  03.02 · LIGHTING AND DMX                                                   ║
╠════╦════════════════════════════════════════════╦═══════════╦════════════════╣
║ #  ║ DOCUMENT                                   ║ CLASS     ║ STATE          ║
╠════╬════════════════════════════════════════════╬═══════════╬════════════════╣
║ 1  ║ dmx_universe_registry.json                 ║ registry  ║ ○ SCAFFOLD     ║
║ 2  ║ dmx_patch_plan.json                        ║ plan      ║ ○ SCAFFOLD     ║
║ 3  ║ lighting_group_registry.json               ║ registry  ║ ○ SCAFFOLD     ║
║ …  ║ …                                          ║ …         ║ …              ║
╚════╩════════════════════════════════════════════╩═══════════╩════════════════╝

 [V <#>] View control/status/provenance   [W <#>] Work on document
 [S <#>] Show required sources            [X <#>] Show conflicts/dependencies
 [B] Back

 Selection ›
```

### 5.5 Viewing behavior

`View` must be non-mutating. Show:

- purpose and document class;
- current state and why it received that state;
- component/sub-component scope;
- populated versus missing control fields;
- record/item counts without exposing restricted values;
- source/provenance coverage;
- conflicts, blockers, validation findings, and dependencies;
- approval/review state; and
- recommended next action.

For a section or sub-section, summarize leaves and provide paths. Do not dump
hundreds of raw records unless the user asks.

### 5.6 Work behavior

Before editing a selected scope:

1. restate the exact section/sub-section/document boundary;
2. list the source files to study in order;
3. list upstream authorities, schemas, vocabularies, and downstream views;
4. identify privacy, rights, safety, Timeline, and conflict risks;
5. propose the extraction/reconciliation steps and definition of done;
6. obtain clarification only for genuinely blocking authority decisions;
7. perform the work with record-level provenance;
8. validate syntax, schema, semantics, references, and duplicate IDs;
9. update manifest/control/provenance/conflict/revision records as appropriate;
10. do **not** approve the result unless approval is explicitly authorized;
11. show a concise change report; and
12. re-audit and redisplay the affected menu branch.

When the user says “complete this section,” interpret that as **complete the
extraction and reconciliation work to the highest evidence-supported state**,
not permission to fabricate data or self-approve. A section may correctly finish
in `REVIEW`, `CONFLICT`, or `BLOCKED` rather than `APPROVED`.

---

## 6. Dependency-aware recommended starting order

When the user chooses `[N] Recommend next work`, prefer the first incomplete,
unblocked prerequisite in this order:

1. `90.01` core schemas required to validate the control plane.
2. `00.01` compendium control and authority policy.
3. `90.03` ID, status, relationship, and role vocabularies.
4. `00.02` decision, question, review, and canon-sync control.
5. `01.01` project identity and roles.
6. `01.02` event and venue facts.
7. `02.01` program authority from the controlled Cue Book.
8. `02.02` Timeline and department crosswalks.
9. `03.01` equipment type/instance authority and vendor evidence.
10. `03.02` DMX patch, lighting groups, recipes, and control configuration.
11. `03.03` geometry and stage layout with verification status retained.
12. `04.01` safety and emergency control.
13. Remaining operations and technical sections.
14. Assets/rights, brand/content, marketing, public website, owner/CMS, and
    developer/integration sections in dependency order.
15. Historical migrations in `11`.
16. Generated indexes and views in `99` last.

Override this sequence when the user selects a different scope, but warn when a
selected document depends on unfinished upstream authority. It is acceptable to
prepare a downstream draft with explicit dependency blockers; it is not
acceptable to present it as complete.

---

## 7. Completion definitions

### 7.1 Leaf document definition of done

A leaf is ready for `REVIEW` only when:

- its intended components and sub-components are covered;
- every asserted record has stable identity and provenance;
- source conflicts are resolved, retained as conflicts, or explicitly scoped out;
- uncertainty and verification confidence are preserved;
- required schemas and vocabularies validate it;
- references resolve and sensitive information is handled correctly;
- required upstream authorities are identified and sufficiently ready;
- downstream generated artifacts are identified for refresh;
- document control fields are complete except final approval/effective release;
- scaffold-only notices/state are removed or converted appropriately; and
- no known blocker is concealed.

A leaf is `APPROVED` only after the additional approval requirements in section
4.2 are satisfied.

### 7.2 Sub-section definition of done

A sub-section is canonically complete only when all required canonical leaves
are approved, required release documents are current, and no unresolved
conflict/blocker/invalid finding affects its claims.

### 7.3 Major-section definition of done

A major section is canonically complete only when all required sub-sections meet
their definition of done, cross-section dependencies are satisfied, its manifest
entries are current, and required generated views/indexes have been refreshed.

### 7.4 Whole-compendium definition of done

The compendium is complete only when:

- every source file is represented in the source-coverage index or has a recorded
  exclusion/redaction disposition;
- all required canonical documents are approved;
- all conflicts, open questions, blockers, and invalid findings are closed or
  explicitly accepted by controlled decision;
- all release and revision links are coherent;
- privacy, rights, accessibility, and safety controls pass;
- all generated indexes/views reproduce from declared upstream revisions; and
- a clean full validation reports no hidden scaffold masquerading as authority.

---

## 8. Validation expectations

Run checks appropriate to the selected scope. At minimum:

```bash
git diff --check
python3 - <<'PY'
import json
from pathlib import Path
for path in Path('extract/compendium').rglob('*.json'):
    json.loads(path.read_text(encoding='utf-8'))
print('All compendium JSON parses.')
PY
```

Also validate:

- exact manifest/path/document-ID/class agreement;
- unique IDs within each applicable namespace;
- required envelope fields and allowed status transitions;
- schema references and JSON Schema conformance once real schemas exist;
- source/provenance references and hashes;
- cross-document relationship targets;
- Timeline/GEN syntax and PGM/TECH/FIN crosswalks;
- DMX address/mode/range consistency where applicable;
- current-versus-release-versus-history separation;
- restricted-data boundaries and absence of exposed secret/PII values;
- unresolved conflicts and blockers are visible in the status audit; and
- generated views identify exact upstream revisions.

Do not run `build_compendium_scaffold.py --clean` as a validation method after
documents have been populated. Deterministic scaffold generation was a build-time
check; post-extraction validation must be non-destructive.

---

## 9. Required boot completion report

Once stages 1–7 and the live audit are complete, report only the information
needed to orient the user before displaying the menu:

1. repository branch and clean/dirty state;
2. applicable instruction files found;
3. manifest versus filesystem document counts;
4. counts by live state (`S/W/C/B/R/A/G/X/!`);
5. major conflicts, blockers, invalid files, privacy risks, or authority gaps;
6. whether any documents currently qualify as completed approved SSOT;
7. the recommended next prerequisite; and
8. the full ANSI-style main menu.

Do not bury the menu beneath a long essay. The sequential study should inform the
menu, not become a giant narration of everything read.

End the boot response at `Selection ›` and wait for the user. Do not begin
extracting a section merely because the recommended next item is obvious.

---

## 10. Mental model

Treat `/extract` as a controlled truth-building program with four layers:

1. **Evidence** — original repository sources, snapshots, binaries, code, data,
   and history.
2. **Control** — authority, schemas, vocabularies, provenance, conflicts,
   decisions, revisions, privacy, and approval.
3. **Canonical domain documents** — approved registries, plans, procedures,
   releases, and records.
4. **Generated access** — indexes, menus, books, packets, dashboards, and exports.

The menu is a live projection of these layers. It is not a progress theater
device. Gray scaffolds must remain visibly gray, conflicts visible, approval
earned, sensitive data protected, and every important claim traceable to its
evidence.
