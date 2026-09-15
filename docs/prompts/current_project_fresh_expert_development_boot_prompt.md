# Just One KISS - Current Project Fresh Expert Development Boot Prompt

Use this prompt to boot a fresh expert coding LLM session into the `Just One KISS` repository. It is a current-session orientation and operating prompt: it should make the new session read the proper documentation, verify the actual repository state, preserve project ethos, make careful code or documentation changes, and leave a useful written trail of what happened.

This is **not** a greenfield build prompt. The repository already contains a mature documentation system, SSOT JSON companions, multiple owner command-center renditions, a standalone public site prototype, and historical boot prompts. Your job is to learn the current truth from the files before acting.

---

## 1. First principles

1. Read before editing. Do not assume that older prompts, old implementation plans, or generated JSON copies are perfectly current.
2. Treat repository files as the source of truth, with the hierarchy in `README.md` and this prompt's study order guiding conflict resolution.
3. Prefer small, reversible, well-documented changes over broad rewrites.
4. Keep public-facing materials original, theatrical, fan-facing, rights-aware, safety-aware, and centered on the Just One KISS event experience.
5. Keep internal production details, safety controls, cue timing, and owner workflows in internal planning/admin contexts unless the relevant public document explicitly says otherwise.
6. Every project item, asset, cue, record, or task should be understood as either tied to a Timeline Moment ID or marked `GEN` / GENERAL / NOT TIMELINE-SPECIFIC.
7. When documentation and machine-readable SSOT are paired, update both in the same change or explicitly record why they are intentionally out of sync.

---

## 2. Immediate boot commands

Run these from the repository root, adapting only if the environment requires it. Use `rg`/`find`; do not use recursive `ls -R` or `grep -R`.

```bash
pwd
git status --short
find .. -name AGENTS.md -print
find . -maxdepth 3 -type f | sort
find docs/prompts -maxdepth 1 -type f | sort
rg -n "TODO|FIXME|launch blocker|prototype-only|out of sync|SSOT|Timeline|GEN" README.md docs proto owner owner_arena_command secondrendition thirdrendition -g '!vendor' -g '!node_modules'
```

If any `AGENTS.md` files exist, obey the files whose scopes cover the files you will touch.

---

## 3. Required documentation study order

Read these files before planning substantive work:

### Repository canon and project truth

1. `README.md` — master repository orientation, source-of-truth hierarchy, Timeline/GEN rule, update workflow, and project map.
2. `docs/knowledge.md` — concise current project brief for identity, technical baseline, cue draft, website direction, style, and asset standards.
3. `docs/qwen_model_routing.md` — local Ollama/AnythingLLM Qwen model-routing policy, with Qwen 3.5 as the quality tier and Qwen 2.5 as the economy/specialist tier.
4. `docs/current_documentation_groundwork_plan.md` — current documentation strategy, legacy-preservation stance, and desired developer/documentation layer.
5. `docs/mastergameplan.md` — broad planning architecture and long-range project families.
6. `docs/timeline_moment_registry.md` — Timeline Moment ID governance and canonical ID families.
7. `docs/cue.txt` — current internal working cue/setlist draft; treat as draft until migrated and reviewed.
8. `docs/inventory_reference.md` — authoritative DMX, fixture, QLC+, patch, behavior, and lighting vocabulary reference.
9. `docs/rig.md` — show-control quick reference that should align with the inventory reference.
10. `docs/styleguide.md` — authoritative public-facing visual, copy, and tone rules.
11. `docs/website_system_plan.md` — owner/public website system blueprint.
12. `docs/owner_admin_build_readiness.md` — owner-admin implementation readiness and universal record model.
13. `docs/owner_site_boot_plan.md` — owner-site boot target and public-site gating concepts.

### Machine-readable SSOT layer

14. `docs/ssot/master_index.json` — index of paired SSOT documents and intended admin/prototype uses.
15. Relevant `docs/ssot/*.json` files for the domain you will touch.
16. App-local SSOT copies under `owner_arena_command/data/ssot/`, `secondrendition/data/ssot/`, and `thirdrendition/data/ssot/` when working in those apps. Do not assume they match `docs/ssot/` without checking.

### Prompt history and boot context

16. `docs/prompts/full_project_fresh_expert_coding_boot_prompt.md` — previous broad full-project boot prompt.
17. `docs/prompts/proto_public_site_fresh_expert_coding_prompt.md` — standalone public-site boot prompt.
18. `proto/docs/proto_expert_coding_boot_prompt.md` — active `/proto` public-site specialist boot prompt.
19. `docs/prompts/owner_arena_command_fresh_expert_maintenance_prompt.md` — active owner arena maintenance prompt.
20. `docs/prompts/owner_site_codebase_boot_prompt.md` and `docs/prompts/owner_site_first_rendition_build_prompt.md` — historical owner prompts; use as context only, not as commands to rebuild existing work.

---

## 4. Current repository architecture to verify

After reading the docs, verify the actual file tree. As of this prompt, expect these major areas:

- `docs/` — human-readable planning, technical, style, cue, website, owner-admin, and prompt documentation.
- `docs/ssot/` — machine-readable JSON companions and master index.
- `owner/` — generic vanilla PHP owner-site scaffold retained for reference and reuse.
- `owner_arena_command/` — first full private owner command-center rendition, black/chrome/fire styled, runtime JSON overlays, local uploads, disabled/placeholder publish controls.
- `secondrendition/` — owner-first command center focused on findability, links, source drilldowns, and data integrity.
- `thirdrendition/` — owner-actionable command center centered on production home, DMX fixtures, cue sheets, run books, project sections, search, JSON library, and integrity checks.
- `proto/` — standalone public-facing July 25, 2026 landing site prototype; active document root is `proto/public/`.

Do not rely on this summary alone. Inspect active README files, route registries, bootstrap files, shared helpers, CSS/JS, and data loaders in the area you are changing.

---

## 5. Current app truths to retain

### Public site (`proto/`)

- Serve locally with `php -S 127.0.0.1:8000 -t proto/public`.
- Active homepage is `proto/public/index.php`.
- Shared PHP lives in `proto/app/`; shared public assets live in `proto/public/assets/`.
- Public copy is tokenized through `proto/docs/language.json` and loaded by `proto/app/language.php`.
- Database persistence is optional; the app should validate forms even without `proto/app/config.php`.
- Admin language editing is prototype tooling and must be secured or disabled before public launch.
- Public event facts: Just One KISS, free July 25, 2026 show, Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643, RSVP/update-list encouraged, safety notices for loud sound, bright lights, fog, flashing/strobe-style looks, and independent tribute disclaimers.
- Image policy: homepage may use approved generated background assets; supporting routes keep visible placeholder prompts until images are generated, reviewed, and approved.

### Owner command centers

- `owner_arena_command/` runs with `php -S 127.0.0.1:8088 -t owner_arena_command`.
- `secondrendition/` runs with `php -S 127.0.0.1:8090 -t secondrendition`.
- `thirdrendition/` runs with `php -S 127.0.0.1:8091 -t thirdrendition`.
- These apps use bundled read-only SSOT JSON seeds first and should not silently mutate seed JSON through the UI.
- Runtime overlays/uploads are app-specific where implemented; verify current paths before changing behavior.
- Authentication, production persistence, upload hardening, true public publishing, and final cue migration may be prototype limitations unless the current files prove otherwise.

---

## 6. Development workflow

1. Restate the user's requested outcome and identify the relevant app/document domain.
2. Check `git status --short` before editing. Do not overwrite user changes.
3. Read the documents and code listed above that are relevant to the domain.
4. Make the smallest coherent change that satisfies the request.
5. Keep style consistent with existing vanilla PHP/HTML/CSS/JS and Markdown/JSON conventions.
6. If touching paired human-readable documentation and SSOT JSON, update both or record the sync decision.
7. If touching public copy, verify it remains rights-aware, safety-aware, original, and independent-tribute framed.
8. If touching Timeline/cue/asset data, ensure the Timeline Moment ID or `GEN` classification is present and coherent.
9. Run targeted checks. At minimum, run syntax checks for touched PHP and JSON validation for touched JSON.
10. Review the diff before committing.
11. Commit changes on the current branch with a concise, descriptive message.
12. Prepare a pull request title/body that summarizes changes, checks, documentation impact, and any known follow-up.

---

## 7. Logging and record-keeping standard

For every development session, leave a reconstructable trail in the chat, commit, PR body, and any touched documentation:

- Record what documentation was read and what current truths were discovered.
- Record which files changed and why.
- Record commands run and whether they passed, failed, or were skipped because of an environment limitation.
- Record any known mismatch between human docs and JSON SSOT.
- Record launch blockers, security caveats, prototype limitations, and follow-up tasks rather than hiding them.
- When adding durable project facts, put them in the most authoritative document first, then update summaries and SSOT companions as needed.
- When changing generated, copied, or app-local data, identify the upstream source and whether the change should be propagated.

A good completion note should let the next session answer: what changed, why it changed, how it was checked, what remains risky, and where to continue.

---

## 8. Recommended verification commands

Choose the relevant subset for the files touched:

```bash
# PHP syntax for app files
find proto owner owner_arena_command secondrendition thirdrendition -name '*.php' -print0 | xargs -0 -n1 php -l

# JSON validity for documentation/data files
python3 - <<'PY'
import json, pathlib
for p in sorted(pathlib.Path('.').rglob('*.json')):
    if any(part in {'vendor', 'node_modules'} for part in p.parts):
        continue
    json.loads(p.read_text())
    print(p)
PY

# Owner app smoke/count checks
php -r 'require "owner_arena_command/includes/bootstrap.php"; echo count(ac_records())." records\n";'
php -r 'require "secondrendition/includes/bootstrap.php"; $s=sr_data_status(); echo $s["active_root"]."\n".count(sr_records())." records\n";'
php -r 'require "thirdrendition/includes/bootstrap.php"; $s=tr_data_status(); echo $s["active_root"]."\n".count(tr_records())." records\n";'

# Public-site syntax/smoke checks
php -l proto/public/index.php
php -S 127.0.0.1:8000 -t proto/public
```

If running a server for visual changes, inspect the affected page and take a screenshot when required by the surrounding development instructions.

---

## 9. Boot completion report

Before making substantive changes, report your boot findings in this structure unless the user explicitly asked you to proceed directly with implementation:

1. **Documentation studied** — key files read and the role of each.
2. **Current truths** — project purpose, active apps, source-of-truth hierarchy, Timeline/GEN rule, public event facts, and prototype limitations.
3. **Architecture map** — docs/SSOT, owner apps, public site, and relevant data flows.
4. **Task plan** — smallest safe path for the requested work.
5. **Risks and checks** — expected verification commands and likely launch/prototype caveats.

End with: `I am booted, current on the repository truth, and ready to work.`

---

## 10. Non-negotiable cautions

- Do not treat historical build prompts as live commands to recreate already-existing apps.
- Do not invent public claims, event logistics, official partnerships, ticketing requirements, or safety assurances.
- Do not weaken independent-tribute disclaimers or rights-aware image/copy policies.
- Do not silently discard Timeline IDs, `GEN` status, review status, or source-file provenance.
- Do not edit runtime/user-managed overlays unless the task specifically requires it.
- Do not change bundled SSOT seed data through UI assumptions; inspect source and propagation needs.
- Do not leave a committed change without a clear PR summary and recorded checks.

## Local LLM model routing

Read `docs/qwen_model_routing.md` before recommending or configuring Qwen models in Ollama or AnythingLLM. Prefer Qwen 3.5 for canonical, coding, public, planning, and safety-sensitive work; reserve Qwen 2.5 for economy extraction, tagging, short summaries, and specialized legacy roles.
