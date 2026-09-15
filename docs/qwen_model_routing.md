# Qwen / Ollama / AnythingLLM Model Routing Guide

**Purpose:** This document is the project-wide guide for choosing Qwen models in local LLM workflows connected to Ollama and AnythingLLM. It explains when the repository should prefer the newest Qwen 3.5 family, when it should intentionally fall back to Qwen 2.5, and how model choice ties into the rest of the Just One KISS documentation, owner-command-center, website, marketing, show-control, and SSOT ecosystem.

**Current operating assumption:** The project owner has already downloaded the Qwen versions named in this documentation into Ollama, and AnythingLLM can use them as local models. If a model tag is not visible in AnythingLLM, first verify it exists in Ollama with `ollama list`, then refresh or reconnect the AnythingLLM provider configuration.

---

## 1. Executive model policy

Use **Qwen 3.5** as the default current-generation Qwen choice whenever the task requires high reasoning quality, long-context synthesis, careful editing, agentic coding, vision-capable review, or cross-document planning.

Reserve **Qwen 2.5** for lower-cost, lower-risk, or specialized lanes where the work is mostly extraction, formatting, classification, short summarization, draft cleanup, or repetitive batch processing.

In plain language:

| Need | Preferred family | Why |
|---|---|---|
| Best local Qwen quality | Qwen 3.5 | Newer generation, stronger general reasoning, better for nuanced project decisions. |
| Deep repository/document review | Qwen 3.5 | Better fit for cross-document consistency and long dependency chains. |
| Coding or owner-site maintenance | Qwen 3.5, preferably coding-tuned if available | Better fit for code structure, refactors, data-flow reasoning, and test interpretation. |
| Vision or visual-asset review | Qwen 3.5 vision-capable tags | Use when analyzing screenshots, mockups, ads, costume references, or web-page captures. |
| Cheap summarization or tagging | Qwen 2.5 | Good for inexpensive routine passes after rules are already defined. |
| Stable narrow extraction | Qwen 2.5 | Good when the schema is simple and the answer is constrained. |
| Legacy prompt compatibility | Qwen 2.5 | Use only when a workflow was explicitly built around 2.5 behavior and quality is acceptable. |

---

## 2. Recommended local model roster

Because local Ollama tags can vary by machine, this repository uses role names rather than hard-coding one exact tag everywhere. Map each role to the closest downloaded model in Ollama/AnythingLLM.

| Project role | Normal association | Suggested Ollama family/tag pattern | Use for |
|---|---|---|---|
| `premium_reasoning` | Qwen 3.5 largest practical local model | `qwen3.5:35b`, `qwen3.5:27b`, or the largest locally stable 3.5 tag | Master planning, policy decisions, source-of-truth reconciliation, complex debugging, final review. |
| `balanced_daily_driver` | Qwen 3.5 mid-size model | `qwen3.5:9b`, `qwen3.5:4b`, or local equivalent | General AnythingLLM chat, documentation edits, concise code changes, owner-site triage. |
| `fast_router` | Small Qwen 3.5 or Qwen 2.5 | `qwen3.5:2b`, `qwen3.5:0.8b`, or a Qwen 2.5 small tag | Intent routing, first-pass classification, title generation, quick summaries. |
| `coding_maintainer` | Qwen 3.5 coding-oriented model when available | Qwen 3.5 coder-tuned tag, or strongest stable `qwen3.5` tag | PHP/JS/CSS maintenance, JSON normalization, static-site edits, schema-aware refactors. |
| `vision_reviewer` | Qwen 3.5 vision-capable model | `qwen3.5` vision-capable tag in AnythingLLM/Ollama | Screenshots, mockups, image prompts, ad creative QA, visual consistency notes. |
| `economy_extractor` | Qwen 2.5 | `qwen2.5` or `qwen2.5-coder` small/mid tag | Low-cost extraction, Markdown cleanup, table normalization, non-final summaries. |
| `specialist_legacy` | Qwen 2.5 specialized tag | Any already-proven 2.5 tag | Workflows that were tuned around 2.5 output style, or specialized cheap local roles. |

Do not treat Qwen 2.5 as obsolete. Treat it as the economy and specialty tier. Do not treat Qwen 3.5 as mandatory for every token. Treat it as the default when quality, planning, or source-of-truth risk matters.

---

## 3. How this ties into the repository

The repository is not a single app; it is a connected documentation and implementation system. Model routing should follow the same source-of-truth hierarchy described in `README.md`.

### 3.1 Master repository and project truth

Use Qwen 3.5 for changes to:

- `README.md`
- `docs/knowledge.md`
- `docs/prompt.md`
- `docs/mastergameplan.md`
- `docs/current_documentation_groundwork_plan.md`
- `docs/timeline_moment_registry.md`
- `docs/qwen_model_routing.md`

These files govern how other files should be interpreted. A cheap model can summarize them, but a current-generation model should make or approve substantive updates.

### 3.2 Show-control, cue, rig, and safety-sensitive production work

Use Qwen 3.5 for any task that touches:

- Timeline Moment IDs;
- cue migration;
- QLC+ / DMX patch logic;
- fog, strobe, projection, blackout, emergency, reset, or venue-safety language;
- `docs/inventory_reference.md`;
- `docs/rig.md`;
- `docs/cue.txt`.

Qwen 2.5 can help extract rows, normalize repeated channel tables, or produce non-final summaries, but do not let a 2.5 pass be the last review before safety-sensitive instructions are accepted.

### 3.3 Owner command centers and admin renditions

Use Qwen 3.5, preferably a coding-tuned 3.5 configuration, for:

- `owner_arena_command/`;
- `secondrendition/`;
- `thirdrendition/`;
- schema and record-normalization work;
- PHP persistence behavior;
- route/page changes;
- Data Integrity rules;
- source JSON loading and fallback logic.

Qwen 2.5 is appropriate for cheaper support tasks such as generating labels, rewriting helper copy, summarizing source fragments, or proposing initial table columns. A 3.5 model should still review changes that affect data integrity, persistence, routing, or owner-facing decisions.

### 3.4 Public website prototype

Use Qwen 3.5 for public copy, route strategy, accessibility, form behavior, disclaimers, and any change to `proto/public/` runtime behavior. Use Qwen 3.5 vision when screenshots or image assets are part of the evaluation.

Qwen 2.5 is acceptable for first-pass alt-text drafts, repeated language-map cleanup, metadata extraction, or low-risk copy variants that will be reviewed before publication.

### 3.5 Marketing, image prompts, and campaign documents

Use Qwen 3.5 for campaign positioning, audience strategy, final prompt systems, public disclaimers, and channel-specific creative direction.

Use Qwen 2.5 for inexpensive variations once the creative contract is locked, such as resizing prompt lists, producing headlines from approved language, or classifying assets by funnel stage.

---

## 4. AnythingLLM workspace recommendations

A robust AnythingLLM setup should make model choice visible instead of hiding it inside one generic chat.

Recommended workspaces or agents:

| Workspace / agent | Primary model | Attached knowledge | Normal use |
|---|---|---|---|
| `Just One KISS - Master Planner` | `premium_reasoning` / Qwen 3.5 | Whole repository docs, especially README, knowledge, prompt, mastergameplan, timeline registry | Strategic updates, planning, cross-document consistency. |
| `Just One KISS - Owner Command Dev` | `coding_maintainer` / Qwen 3.5 | Owner renditions, SSOT JSON, owner/admin docs | PHP/JS/CSS admin work, data loading, integrity checks. |
| `Just One KISS - Public Site` | `balanced_daily_driver` or `premium_reasoning` / Qwen 3.5 | `proto/`, styleguide, public copy docs | Public-route copy, forms, launch readiness, screenshots. |
| `Just One KISS - Marketing Studio` | Qwen 3.5, vision-capable when reviewing images | Marketing prompt templates, styleguide, brand story docs | Campaign strategy, image prompts, ad mockup review. |
| `Just One KISS - Economy Batch Desk` | Qwen 2.5 | Narrow file sets only | Cheap extraction, tagging, table cleanup, draft summaries. |

Keep the economy workspace intentionally constrained. It should not be the only workspace with write authority over canonical docs.

---

## 5. Task routing checklist

Before starting a local AnythingLLM/Ollama task, choose the model family with this checklist:

1. **Will the output become canonical documentation?** Use Qwen 3.5.
2. **Does it touch safety, DMX, fog, strobes, emergency states, public claims, forms, or persistence?** Use Qwen 3.5.
3. **Does it require reading multiple long docs and resolving conflicts?** Use Qwen 3.5.
4. **Is it mostly mechanical extraction from one known source into one known schema?** Qwen 2.5 is acceptable.
5. **Is the task repeated many times with low consequence and later review?** Qwen 2.5 is preferred for cost control.
6. **Does the task involve screenshots, image references, or visual QA?** Use a Qwen 3.5 vision-capable model.
7. **Is this a coding change rather than a prose-only change?** Prefer Qwen 3.5 coding-maintainer configuration.

---

## 6. Prompt language to reuse

Use this routing language in future boot prompts and AnythingLLM workspace instructions:

> Prefer Qwen 3.5 for current-generation reasoning, cross-document synthesis, code changes, public-facing copy, safety-sensitive production guidance, and any final pass on canonical documentation. Use Qwen 2.5 deliberately as an economy/specialist tier for extraction, tagging, short summaries, table normalization, inexpensive variants, and legacy workflows that were tuned for 2.5. When a Qwen 2.5 pass produces source-of-truth changes, route the result through Qwen 3.5 review before treating it as final.

---

## 7. Update backlog created by this repository review

The following updates keep the model-routing policy consistent across the documentation system:

1. Add this guide to the master repository map in `README.md`.
2. Add this guide to the source-of-truth hierarchy as the authority for local LLM model selection.
3. Update `docs/knowledge.md` so fast onboarding tells collaborators that Qwen 3.5 is the default quality tier and Qwen 2.5 is the economy/specialist tier.
4. Update `docs/prompt.md` so future LLM sessions understand how to route local AnythingLLM/Ollama work.
5. Update fresh-expert boot prompts so new coding, owner-site, public-site, and marketing sessions read this guide before selecting or documenting local model behavior.
6. When SSOT JSON regeneration tooling is available, create or refresh a machine-readable `docs/ssot/qwen_model_routing.json` companion and add it to `docs/ssot/master_index.json`.
7. When AnythingLLM workspace exports are added to the repository, include the role names from this guide rather than scattering hard-coded model tags through unrelated docs.
8. During future document sweeps, replace any casual instruction that says “use Qwen” or “use the local model” with a role-aware reference to this guide.

---

## 8. Maintenance notes

- Check Ollama tags periodically because local model names and available quantizations can change.
- Keep exact machine-specific tags in deployment notes or AnythingLLM workspace configuration, not in public-facing strategy docs unless the tag is intentionally required.
- If a newer Qwen family supersedes 3.5, update this document first, then update the summaries in `README.md`, `docs/knowledge.md`, `docs/prompt.md`, and the boot prompts.
- If a Qwen 2.5 specialized workflow consistently outperforms a 3.5 workflow for a narrow role, document that exception here with the task, model tag, prompt, and validation method.
