# Just One KISS — Reusable Safe Website-Editing Pipeline Build Boot

Use this prompt to start a fresh expert coding session whose job is to build,
slice by slice, the infrastructure needed for a **fully connected, approved,
tested website-editing pipeline**. This is continuation work in the existing
repository. It is not permission to redesign the public site, revive an old
rendition, publish unapproved content, or implement a CMS by pretending that
authentication, persistence, approval, preview, audit, backup, or rollback
already exists.

The eventual user experience should be simple: a future owner should be able to
say, “make this specific website edit,” and a fresh session should be able to
identify the authoritative record, calculate every affected file and record,
make only the requested change, validate and preview it, preserve history and
approval evidence, and leave the repository in a truthful current state for the
next session.

This prompt builds that capability. It is **not** the eventual everyday
website-edit prompt. Reuse it until every readiness milestone in Section 7 is
proved complete; only then author and validate the smaller everyday edit prompt.

---

## 1. Start working immediately

Begin with this acknowledgement and then run the boot checks:

> I will verify the live repository and its instructions, audit the active public
> site and all authority, data, release, validation, and handoff paths that govern
> it, then execute the next dependency-safe pipeline milestones. I will preserve
> unrelated code and user work, keep prototypes and review records distinct from
> approved canon, test every changed surface, record evidence and limitations,
> refresh this rolling handoff, commit coherent work, and create PR metadata.

Do not stop after orientation. Do not ask the user to choose a milestone when the
rolling queue in Section 8 contains safe work. Ask only when a destructive action
or a decision reserved to a human owner is genuinely unavoidable. Otherwise use
the safest reversible option, record assumptions and blockers, and continue.

Do not implement a requested visual feature merely because it is exciting. Build
or use the change pipeline first. The long-term representative feature is an
animated interactive character system whose characters can move through the
site, hide behind page elements, emerge from behind them, traverse top edges,
and interact with side and bottom edges. That feature will require explicit
geometry, stacking, collision, reduced-motion, input, performance, responsive,
accessibility, asset-rights, safety/comfort, test, fallback, and rollback
contracts. It is a north-star acceptance case—not authorization to add characters
or revive the removed fire/ember/smoke runtime effects during early milestones.

---

## 2. Verify the live repository before trusting prose

Run from the repository root. Do not use `ls -R` or `grep -R`.

```bash
pwd
find .. -name AGENTS.md -type f -print
git status --short --branch
git branch --show-current
git remote -v
git log --oneline --decorate -12
find . -maxdepth 2 -type f \( -name '*BOOT*.md' -o -name 'boot.md' \) | sort
find docs/prompts -maxdepth 1 -type f | sort
find docs/ssot -maxdepth 2 -type f | sort
find proto -maxdepth 4 -type f | sort
find center -maxdepth 4 -type f | sort
find extract -maxdepth 3 -type f | sort
python3 extract/scripts/validate_compendium.py
php center/scripts/validate.php
find proto -name '*.php' -type f -print0 | xargs -0 -n1 php -l
```

If a remote and upstream exist, fetch and fast-forward only. If either is absent,
record that limitation and continue from the audited local tree. If the tree is
dirty, inspect and classify every change before editing. Never overwrite, stage,
reformat, or commit unrelated work.

Before changing the public site, prove from live files that `proto/public/` is
still the active document root. Treat top-level `proto` route copies, historical
site trees, owner renditions, app-local seeds, backups, generated maps, runtime
records, and prompt history as evidence or implementation context—not automatic
authority.

Audit live facts rather than trusting status prose. If this prompt, `boot.md`, a
work-session log, the compendium manifest, or the implementation disagrees, trust
the applicable controlled source and live code, describe the disagreement, and
repair the rolling handoff without erasing the historical record.

---

## 3. Required study order

Read every applicable `AGENTS.md` first. Then study the following in order. Use
targeted `rg`, hashes, Git history, and representative records to deepen the
study; do not blindly read every backup or identical rendition-local copy.

### 3.1 Repository and active-session orientation

1. `README.md`.
2. This file in full.
3. `boot.md`, especially its live compendium baseline, authoring contract,
   validation rules, and rolling next queue.
4. `docs/prompts/ACTIVE_universal_fresh_expert_coding_boot_prompt.md`.
5. The latest relevant files under `extract/work_sessions/` and any newer
   pipeline work-session logs created by this prompt.
6. `extract/README.md`, `extract/SEQUENTIAL_BUILD_BOOT.md`, and
   `extract/ssot_compendium_sequential_build_plan.md`.

The repository-wide compendium remains a parallel controlled-document program.
Do not silently skip its dependency order or mark its leaves approved. Pipeline
work may reference or advance a compendium leaf only when its dependencies and
done conditions are met; synchronize the manifest, validator, handoff, and source
hashes whenever it does.

### 3.2 Current public website implementation

Read these in full before editing `proto/`:

```text
proto/README.md
proto/docs/website_ssot.md
proto/docs/developer_editor_guide.md
proto/docs/routes_and_supporting_pages.md
proto/docs/website_inventory.md
proto/docs/launch_checklist.md
proto/docs/language.json
proto/docs/language_map.md
proto/docs/page_sections.json
proto/app/language.php
proto/app/site_data.php
proto/app/page_sections.php
proto/app/view.php
proto/app/helpers.php
proto/app/layer_controls.php
proto/app/layer_runtime.php
proto/app/forms/*.php
proto/public/index.php
proto/public/*/index.php
proto/public/assets/css/site.css
proto/public/assets/js/site.js
proto/database/schema.sql
proto/database/seed.sql
```

Inspect `proto/app/config.php` only with care: never print, copy, document, or
commit secrets or private production values. Treat submission records, mail
failure logs, and runtime state as restricted operational data, not test fixtures
or public facts.

### 3.3 Authority, SSOT, settings, and current-documentation direction

```text
docs/knowledge.md
docs/mastergameplan.md
docs/timeline_moment_registry.md
docs/styleguide.md
docs/website_system_plan.md
docs/current_documentation_groundwork_plan.md
docs/ssot/master_index.json
docs/ssot/settings_manifest.json
docs/ssot/settings/*.json
extract/ssot_source_inventory.md
extract/compendium/00_control_and_governance/*.json
extract/compendium/05_assets_media_and_rights/*
extract/compendium/06_brand_content_and_accessibility/*
extract/compendium/08_public_website_and_audience_data/*
extract/compendium/09_owner_admin_and_cms/*
extract/compendium/10_developer_data_and_integrations/*
extract/compendium/11_records_history_and_audit/*
extract/compendium/99_indexes_views_and_exports/*
```

Empty compendium leaves are planned contracts, not present authority. Review
leaves are reconciled candidates, not approved canon. Never promote a scaffold,
draft, prototype observation, generated map, or historical statement merely to
make the pipeline appear complete.

### 3.4 Owner workflow, release gates, and future adapter

```text
center/README.md
center/docs/answers.md
center/docs/canon_sync_policy.md
center/docs/public_release_gate_policy.md
center/docs/future_persistence_and_auth_plan.md
center/docs/proto_cms_adapter_plan.md
center/docs/horizontal_scaffolding_refinement_report.md
center/data/proto_editing_contracts.php
center/data/release_gate_matrix.php
center/data/source_provenance_schema.php
center/data/integrity_checks_seed.php
center/scripts/validate.php
```

`/center` is currently read-mostly and must not be described as a working CMS.
Direct public writes remain prohibited until authentication, permissions,
persistence, audit, backup, rollback, preview, conflict handling, approval, and
release controls genuinely exist and validate.

---

## 4. Repository truths and safety boundaries

Carry these rules into every milestone:

1. `proto/` is the active public website only while the live tree and current
   canon continue to say so; `proto/public/` is its active document root.
2. Runtime implementation truth answers what renders now. It does not by itself
   approve the fact or claim being rendered.
3. Human-readable authorities, paired JSON, settings, compendium records,
   implementation bindings, generated maps, and release/history records are
   separate layers. Record their relationships; do not collapse them.
4. Website code should load durable facts, labels, options, and copy from governed
   data rather than create new hard-coded canon in templates.
5. Every managed record is Timeline-specific or `GEN`. Preserve stable IDs across
   migrations and edits.
6. Draft, review, approved-internal, approved-public, deployed, generated,
   superseded, and historical states are not interchangeable.
7. No public material may imply official KISS, Gene Simmons, Pophouse, or related
   rightsholder endorsement, authorization, sponsorship, ownership, partnership,
   or clearance without controlled written evidence.
8. Rights, brand affiliation, safety, privacy, venue, accessibility, copy, media,
   and technical-disclosure gates fail closed when required evidence is absent.
9. Do not expose internal cues, emergency mechanics, sensitive diagnostics,
   credentials, raw PII, submissions, mail bodies, restricted contacts, or
   owner-only operational detail in public outputs or committed fixtures.
10. The current public site deliberately removed prior fire/ember/smoke/heat
    browser effects. A future character-motion system is a new governed feature,
    not a reason to restore those effects or their architecture implicitly.
11. Prefer progressive enhancement. Core content, navigation, forms, and safety
    information must remain usable when JavaScript, animation, media, storage,
    email, or optional database services fail.
12. Respect `prefers-reduced-motion`, keyboard and screen-reader access, viewport
    changes, zoom, focus, pointer/touch differences, performance budgets, and
    deterministic teardown for any future interactive layer.
13. Make the smallest coherent change. Do not rename, reorganize, reformat, or
    “clean up” adjacent systems without a demonstrated dependency.
14. Never delete historical evidence to make currentness easier. Mark it and link
    it correctly.
15. Never claim approval, deployment, browser coverage, accessibility compliance,
    rollback success, or regression safety without the corresponding evidence.

---

## 5. Target pipeline contract

The milestone program is complete only when a future edit request can travel
through this explicit lifecycle:

```text
user request
  -> request classification and bounded scope
  -> authoritative record(s) and approval requirements
  -> machine-readable impact graph
  -> paired SSOT/settings/content-token updates
  -> route/section/component/asset/form/style bindings
  -> isolated implementation change
  -> static, structural, security, accessibility, and behavioral checks
  -> local preview and affected-route screenshots
  -> review and release-gate evidence
  -> approved release or truthful blocked/review state
  -> deployment/rollback record when deployment is in scope
  -> revision history, manifest/currentness refresh, session handoff, commit, PR
```

Every link must be inspectable by a person and, where practical, validated by a
machine. The pipeline must support copy, verified facts, assets, layout/style,
routes/sections, forms, and progressively enhanced interactive components. It
must calculate affected surfaces without granting permission to modify unrelated
ones.

### Required edit specification

Every pipeline-driven edit must eventually carry at least:

- stable change/request ID and `timeline_moment_id_or_gen`;
- user intent, explicit in-scope behavior, and explicit non-goals;
- authoritative source and record IDs;
- affected SSOT/settings/token/asset IDs;
- affected routes, sections, templates/components, CSS contracts, JS modules,
  forms/storage contracts, and generated artifacts;
- provenance and current source hashes/revisions;
- required approval/release gates and evidence state;
- privacy, rights, safety, accessibility, and disclosure classification;
- acceptance criteria and positive/negative test cases;
- preview matrix and expected screenshots;
- rollback plan and immutable history linkage;
- final status: blocked, review-ready, approved, released, or deployed, without
  promoting one state into another.

### Non-destruction proof

“Did not modify anything else” means more than a small diff. A completed edit must
show:

1. the requested behavior changed on every intended surface;
2. unaffected routes and shared components still pass their baseline checks;
3. no unrelated authority, token, asset, layout, form, or generated record changed;
4. no stale duplicate of the old value remains where synchronization is required;
5. shared dependencies changed only when the impact graph required them;
6. the diff, screenshots, tests, release evidence, and rollback information agree.

---

## 6. Engineering and validation rules

### 6.1 Build order

For each milestone:

1. Audit and write the current-state evidence before designing a replacement.
2. Define a narrow contract and fixtures before adding broad automation.
3. Add validators before or with the behavior they protect.
4. Use read-only reports and dry runs before mutation.
5. Keep generation deterministic and identify every input, version, method, and
   freshness rule.
6. Add mutation only after preview, audit, backup, rollback, permission, and
   conflict behavior are real and tested.
7. Prove one representative vertical edit before generalizing.

### 6.2 Validation layers to establish

The final repository-level validation entry point must orchestrate, not replace:

- compendium manifest, provenance, schema, and invariant checks;
- all repository JSON parsing and applicable schema validation;
- PHP syntax for active surfaces;
- `/center` integrity checks;
- active public-route discovery and HTTP smoke tests;
- language-token existence, duplicate, unused, and binding checks;
- route/section/component/asset/form dependency integrity;
- asset existence, format, placement, alt-text, and rights-state checks;
- public/private disclosure and secret/PII exclusions;
- internal-link, CTA, form target, and relevant external-link checks;
- accessibility checks appropriate to static markup and browser behavior;
- responsive browser checks at defined desktop/mobile viewports;
- reduced-motion and no-JavaScript fallbacks for interactive work;
- console/runtime error checks and deterministic teardown/reinitialization;
- generated-artifact and copied-SSOT freshness;
- release-gate, revision-history, and rolling-handoff agreement;
- `git diff --check` and a changed-file/impact-graph agreement check.

Never weaken a check merely to turn the suite green. Fix the defect, narrow a
false assumption with evidence, or record an explicit environment limitation.

### 6.3 Interactive-component readiness

Before the north-star character system may be implemented, the pipeline must be
able to review and test a feature contract that covers:

- a separate progressive-enhancement layer that cannot block core interaction;
- stable opt-in anchor/edge metadata instead of fragile element-name guessing;
- coordinate conversion across document, viewport, scroll, transforms, zoom, and
  responsive reflow;
- top, side, and bottom edge paths plus occlusion/hiding and stacking semantics;
- collision and hit-region rules that do not steal clicks, focus, selection, or
  form interaction;
- pointer, touch, keyboard, reduced-motion, paused/background-tab, resize, and
  orientation behavior;
- deterministic seeded tests rather than timing-only assertions;
- frame-time, memory, CPU/battery, asset-size, and concurrent-character budgets;
- cleanup through lifecycle hooks without orphaned listeners or animation loops;
- no-JavaScript, missing-asset, unsupported-browser, and low-performance fallback;
- character-asset provenance, rights, alt/decorative semantics, and disclosure;
- route-by-route visual baselines and explicit rollback/feature-disable controls.

Do not implement this feature until the relevant pipeline milestones can enforce
those requirements and the user authorizes the feature slice.

---

## 7. Readiness milestones

Track every milestone as `not_started`, `in_progress`, `review_ready`, `blocked`,
`approved`, or `proved`. Only `proved` counts toward the final pipeline. Human or
controlled approval must not be synthesized by an LLM.

### M0 — Verified baseline and authority map

Inventory the active public document root, routes, entrypoints, loaders, copy
stores, assets, forms, storage, CSS/JS, generated files, current/historical apps,
authorities, paired SSOT/settings, release gates, tests, deployment assumptions,
and known blockers. Resolve or explicitly register contradictions.

### M1 — Machine-readable website impact graph

Create stable records connecting authoritative facts/content/assets to paired
JSON/settings, tokens, routes, sections, implementation files, forms, styles,
scripts, generated views, gates, validators, history, and owners. Validate unique
IDs, paths, references, direction, and cycles. Distinguish authority from derived
and implementation truth.

### M2 — Unified read-only validation entry point

Provide one documented repository command that runs existing validators and
new website checks without mutating state. Produce actionable failures and honest
warnings for unavailable optional tools. Add representative positive and negative
fixtures without private/runtime data.

### M3 — Deterministic preview and regression harness

Boot the active site locally in a reproducible way; discover and smoke all public
routes; capture defined desktop/mobile screenshots; check console/runtime errors,
core navigation/forms, reduced-motion/no-JS modes, and affected-versus-unaffected
baselines. Keep environment-sensitive browser checks explicit.

### M4 — Change specification, dry-run, and non-destruction report

Given a proposed edit, generate or author a stable edit specification and dry-run
impact report before mutation. Validate that the eventual changed-file set is a
subset of the approved impact set, with documented exceptions for required
manifests, histories, tests, and generated views.

### M5 — Approval and public-release evidence workflow

Connect rights, affiliation, copy, media, privacy, accessibility, venue, safety,
and technical-disclosure gates to affected records and outputs. Distinguish
review-ready, approved-internal, approved-public, released, deployed, and blocked.
Record real reviewer/evidence references without storing sensitive evidence in
public files or inventing approval.

### M6 — Revision, audit, backup, rollback, and freshness workflow

Give each edit immutable history, before/after references, affected revisions,
backup/rollback instructions, generation freshness, and post-change verification.
Prove rollback in a safe fixture or isolated test flow before claiming it works.

### M7 — Representative vertical edit drills

Prove the pipeline with separate bounded drills for:

1. public copy with no factual change;
2. a verified practical fact with multi-route propagation;
3. a public asset replacement with rights and alt-text handling;
4. a route/section or layout/style change;
5. a form-field change with privacy, validation, storage, and negative tests;
6. a progressive-enhancement interaction with reduced-motion and fallback.

Use fixtures or owner-authorized real edits. Do not change live public facts just
to manufacture a drill.

### M8 — Everyday website-edit boot and readiness certification

Only after M0–M7 are proved, author the concise future boot prompt that accepts a
specific website-edit request and runs the pipeline. Validate it in a fresh-session
simulation. Create a readiness report listing supported edit classes, remaining
manual approvals, environment prerequisites, known exclusions, recovery process,
and the exact evidence supporting “fully connected, approved, tested.”

### Final definition of done

The program is complete only when:

- M0–M8 are proved against the live tree;
- no scaffold or review record is misrepresented as approved;
- a fresh session can locate authority and calculate impact without relying on
  unstated memory;
- dry-run precedes mutation and unrelated changes fail validation;
- the unified checks cover data, code, routes, browser behavior, accessibility,
  privacy, rights, release state, history, and handoff freshness;
- representative edits and rollback have been demonstrated;
- the everyday boot prompt has passed a fresh-session exercise;
- the owner can still reserve approval decisions and can see all unresolved
  blockers rather than having them hidden by automation.

---

## 8. Rolling verified baseline and next milestone queue

This section is rolling content and must be verified, then rewritten at the end
of every session that uses this prompt.

### Baseline to verify

As of the local tree based on starting commit `87b9079` on 2026-08-18 (session
changes pending commit):

- `proto/` remains the active public application and `proto/public/` its document
  root. The deterministic inventory records 54 files and 19 route entrypoints,
  separating 11 public routes from eight owner tools and excluding restricted
  mutable runtime records.
- M0, M1, and M2 remain `review_ready`, not approved or proved. M3 remains
  `in_progress`: HTTP smoke, the pinned browser adapter, behavior assertions,
  exact evidence selection, and hermetic fixtures are review-ready, but a real
  browser has not been exercised.
- The unified command checks all 19 HTTP routes and the 33-capture matrix. The
  adapter owns the PHP server, browser, and contexts; implements JavaScript and
  reduced-motion modes; inspects forms without submission; and fails on browser,
  navigation, evidence, or storage non-mutation defects.
- Pinned Playwright 1.54.0 and managed Chromium are unavailable locally, so no
  screenshots, console results, responsive, motion, no-JavaScript, or accessibility
  results are claimed. Database, mail, network, deployment, approval, backup, and
  rollback checks also remain absent.
- `/center` remains read-mostly. The compendium remains 209 planned leaves
  (`R73/S136`); none are approved or generated canon, and pipeline-dependent
  Sections 05, 06, 08, 09, 10, 11, and 99 remain scaffold-only.
- Per-fact/token and asset-rights links, edit specifications, releases, immutable
  history, and rollback remain graph gaps. The character system remains
  unauthorized and unimplemented.
- No remote or upstream is configured. The latest handoff is
  `docs/work_sessions/2026-08-18_website-editing-pipeline-m3-browser-adapter.md`.

### Pre-authorized next three slices

Execute these in order with at most one active slice. Do not change public copy,
visuals, facts, forms, or runtime behavior merely to exercise the harness.

#### Slice 1 — M3 real-browser execution and evidence review

Install exactly `requirements-browser.txt` and managed Chromium in an isolated
capable environment, execute all 33 entries, and validate their metadata. Do not
commit environment-specific images as approved baselines or alter runtime to pass.

**Done when:** every capture executes; browser/server teardown and storage
non-mutation pass; metadata validation passes; and a human reviews responsive,
reduced-motion, and no-JavaScript output without claiming accessibility or approval.

#### Slice 2 — M3 accessibility adapter contract

Add a dependency-pinned, read-only accessibility adapter over the public matrix.
Record rules/tool versions and separate automated findings from human review. Do
not submit forms, include owner routes, or claim compliance.

**Done when:** deterministic fixtures prove violations fail, limitations remain
explicit, findings link to route/mode evidence, and the orchestrator distinguishes
unavailable tooling from a failed scan.

#### Slice 3 — M4 change-specification schema and dry-run fixture

Create a machine-readable change-specification schema and synthetic copy-only
fixture connected to the impact graph and preview selection. Add read-only
changed-file allowance reporting; do not mutate public copy or imply approval.

**Done when:** IDs, timeline classification, authority references, scope/non-goals,
gates, acceptance/negative tests, preview set, rollback plan, and allowed files
validate, and undeclared or unrelated changed files fail negative fixtures.

### Mandatory rolling refresh contract

Before every commit made under this prompt:

1. Re-audit the live public site, pipeline artifacts, milestone states,
   compendium manifest, and Git tree.
2. Replace this baseline’s commit/date, application/root, state totals, completed
   milestone/slice, first unfinished milestone, latest handoff path, remote state,
   validation capabilities/limitations, and material blockers.
3. Remove completed slices from this queue.
4. Derive the next two or three dependency-safe slices from M0–M8, the live impact
   graph, registered gaps/conflicts, compendium dependency order, and test needs.
5. Name exact files, sources, purpose, non-goals, and machine-checkable done
   conditions for every queued slice.
6. If a human decision blocks one path, queue other safe foundation work. If no
   safe work remains, queue a bounded blocker-resolution slice naming the exact
   decision or evidence required.
7. Update the relevant current docs, manifests/indexes, validators, session log,
   and source hashes together. Do not churn unrelated historical prompts.
8. Run a stale-handoff search and inspect every current-looking match. Historical
   work-session statements may remain historical; current boot/readme/manifest
   statements must agree.

A mismatch between the live audit and this section is a validation failure.

---

## 9. Work-session log and evidence requirements

For every execution, create:

```text
docs/work_sessions/YYYY-MM-DD_website-editing-pipeline-<topic>.md
```

If `docs/work_sessions/` does not exist, create it with a README explaining that
these are operational handoffs, not approved canon. Do not mix pipeline logs into
`extract/work_sessions/` unless the session’s primary purpose is advancing a
compendium slice.

Record during the work—not reconstructed only at the end:

- date, branch, starting commit, remote/upstream, and starting tree state;
- verified active app/document root and authority hierarchy;
- milestone starting/final states;
- exact files and IDs created, changed, generated, or intentionally untouched;
- sources, hashes/revisions, locators, extraction or inspection method, and use;
- decisions, assumptions, rejected alternatives, conflicts, blockers, and owner
  decisions still required;
- privacy, rights, safety, accessibility, release, and disclosure boundaries;
- exact commands and results, including environment limitations;
- screenshots/preview evidence when a perceptible runnable-site change occurs;
- final changed-file/impact-graph reconciliation;
- final status without invented approval;
- next unfinished milestone and the refreshed queue.

Never commit secrets, raw submissions, real mail bodies, credentials, private
contacts, sensitive diagnostics, or production configuration into the log.

---

## 10. Minimum checks, Git, and PR

Run all applicable checks; the unified orchestrator replaces this list only after
M2 is proved and continues to expose the component results.

```bash
python3 extract/scripts/validate_compendium.py
php center/scripts/validate.php
find proto -name '*.php' -type f -print0 | xargs -0 -n1 php -l
python3 - <<'PY'
import json
from pathlib import Path
for root in ('docs/ssot', 'proto/docs', 'extract/compendium'):
    for path in sorted(Path(root).rglob('*.json')):
        json.loads(path.read_text(encoding='utf-8'))
print('Governed JSON parses.')
PY
git diff --check
git diff --stat
git status --short
rg -n "Rolling verified baseline|Baseline to verify|Pre-authorized next|Slice [123]|first unfinished|M[0-8]|fully connected|active public|document root" website_editing_pipeline_boot.md boot.md README.md proto/README.md proto/docs/website_ssot.md center/docs extract/README.md docs/work_sessions extract/work_sessions
```

When public runtime behavior changes, also boot the active document root locally,
smoke every affected route plus representative unaffected routes, inspect console
and form behavior, and take desktop/mobile screenshots. Use reduced-motion and
no-JavaScript checks when interaction or animation changes. Do not describe a
manual `curl` response as a visual or accessibility test.

Before completion:

1. Review every touched-file diff.
2. Confirm all touched files are inside the documented impact set, apart from
   required handoff, manifest, validation, and history updates.
3. Stage only coherent session work.
4. Commit on the current branch.
5. Invoke the environment’s `make_pr` tool after the commit with a concise title
   and a body covering milestone transitions, artifacts, tests, approval boundary,
   limitations, and next queue. Never call it without changes and a commit; never
   leave a new commit without the required PR attempt/tool result.

Return a progress report with the commit and PR result, exact milestone states,
what the new capability can and cannot safely do, remaining human/evidence/tool
blockers, and every test command prefixed with `✅`, `⚠️`, or `❌`. Never call the
pipeline, a content record, or a public release approved until controlled evidence
exists and validates.
