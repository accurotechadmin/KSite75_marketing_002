# September 26 Marketing Campaign Workspace

**Workspace ID:** `JOK-SEP26`
**Status:** internal campaign foundation; public release is held pending the open decisions in the canon
**Created:** 2026-09-14
**Timeline classification:** `GEN` for campaign operations; event-specific public pieces use `EVT-SEP26`

This folder is the self-contained working home for planning, producing, reviewing, publishing, measuring, and retiring the next Just One KISS campaign. Fresh sessions should begin with [`MARKETING_EXPERT_BOOT_PROMPT.md`](MARKETING_EXPERT_BOOT_PROMPT.md); the human campaign Single Source of Truth (SSOT) is [`MARKETING_CAMPAIGN_CANON.md`](MARKETING_CAMPAIGN_CANON.md).

## Authority

1. A later explicit owner instruction.
2. `MARKETING_CAMPAIGN_CANON.md` and its synchronized `campaign_facts.json` values.
3. Approved, immutable records in `releases/` for the exact version that shipped.
4. The evergreen portable brand authority in `../marketing/canon/BRAND_CANON.md` and `.json`.
5. Supporting strategy and production guidance referenced in `SOURCE_MAP.md`.
6. Existing website copy, old July 25 material, screenshots, and historical inventories as evidence only.

A blank or `unverified` field is not permission to infer. The old July 25 venue, admission, camping, parking, contact, URL, and safety details do **not** automatically carry into September 26.

## Folder contract

| Path | Purpose |
| --- | --- |
| `MARKETING_CAMPAIGN_CANON.md` | Human-readable campaign truth, strategy, creative, governance, launch, and measurement canon |
| `campaign_facts.json` | Machine-readable fact/status mirror; update with the canon |
| `PRODUCTION_AND_LAUNCH_CHECKLIST.md` | Full requested deliverable and release checklist |
| `SOURCE_MAP.md` | Curated source inventory, precedence, inherited truths, rejected inheritance, and research links |
| `EXPERT_INDEX.md` | Fast question-to-source and deliverable-to-record navigation |
| `MARKETING_EXPERT_BOOT_PROMPT.md` | Reusable fresh-session onboarding and production prompt |
| `THEME_SYSTEM.md` | Current-theme, new-theme, and controlled-hybrid design protocol |
| `SESSION_INTAKE.md` | Minimal post-boot request and fact-lock questions |
| `workspace_manifest.json` | Machine-readable workspace entrypoints, controls, templates, and directories |
| `briefs/` | Approved campaign, audience, channel, and piece briefs |
| `copy/` | Copy matrices, caption banks, ad copy, subject lines, disclaimers, and translations |
| `creative/` | Storyboards, shot lists, design notes, contact sheets, and concept reviews |
| `masters/` | Editable canonical source files; never call a file `final` |
| `exports/` | Still and document derivatives organized by release ID |
| `video/` | Video masters and platform cuts |
| `audio/` | Licensed/platform-safe masters, licenses, cue sheets, and mixes |
| `captions/` | SRT/VTT, transcripts, alt text, audio descriptions, and poster-frame notes |
| `rights/` | Licenses, releases, provenance, usage scope, expiration, and reviewer decisions |
| `tracking/` | UTM map, event taxonomy, tag test evidence, audience/privacy decisions |
| `decisions/` | Theme, fact, scope, media, and release decisions with rationale |
| `research/` | Dated platform, audience, competitor, and market evidence |
| `reviews/` | Fact, copy, rights, accessibility, policy, destination, and QA evidence |
| `releases/` | Immutable release manifests, checksums, approvals, schedules, rollback/expiry instructions |
| `reports/` | Performance exports, QA evidence, screenshots, postmortems, and learning records |

Empty production directories are retained with `.gitkeep` files so the complete workflow exists before assets are created.

## Session boot sequence

1. Use `MARKETING_EXPERT_BOOT_PROMPT.md` for a fresh session and follow `EXPERT_INDEX.md`.
2. Read the canon sections **Status banner**, **Fact registry**, **Open decisions**, and **Release gates**.
3. Confirm that the fact file and canon agree.
4. Choose one audience, one funnel job, one lead creative family, one proof, and one action.
5. Create a brief from `../marketing/templates/CAMPAIGN_BRIEF_TEMPLATE.md` or `CAMPAIGN_PIECE_TEMPLATE.md` in `briefs/`.
6. Assign rights IDs before production and tracking IDs before publication.
7. Produce a canonical master, then intentional placement adaptations.
8. Complete the production checklist and create an immutable release record.
9. Publish, verify, monitor, expire, and record learning.

## Current readiness

**Ready now:** campaign strategy, brand expression, audience hypotheses, creative system, production matrix, naming, review gates, tracking vocabulary, reporting framework, and folder structure.
**Not ready to publish:** year, timezone, venue/city, offer/admission, CTA/destination, registration mechanism, public contact, attraction billing, sponsor status, rights clearances, budget, and tracking/privacy implementation are not fully confirmed.
