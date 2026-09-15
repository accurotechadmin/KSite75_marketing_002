# September 26 Expert Marketing Index

**Purpose:** fast navigation for a fresh marketing, design, production, media, or measurement session. This index points to the smallest authoritative source that should answer each question.

## Mandatory first read

1. [`README.md`](README.md) — workspace authority, directory contract, and session workflow.
2. [`campaign_facts.json`](campaign_facts.json) — machine-readable fact states and release locks.
3. [`MARKETING_CAMPAIGN_CANON.md`](MARKETING_CAMPAIGN_CANON.md) — complete human campaign SSOT.
4. [`SOURCE_MAP.md`](SOURCE_MAP.md) — provenance, inheritance decisions, and external verification policy.
5. [`PRODUCTION_AND_LAUNCH_CHECKLIST.md`](PRODUCTION_AND_LAUNCH_CHECKLIST.md) — production through reporting gates.
6. [`THEME_SYSTEM.md`](THEME_SYSTEM.md) — choose faithful current-theme work or a governed new theme.

Then read only the task-relevant supporting documents listed below. Before any public export, reread the fact registry and release gates.

## Question-to-source map

| Question | Primary source | Supporting source | Rule |
| --- | --- | --- | --- |
| What is confirmed for September 26? | `campaign_facts.json` | Canon §§0, 3 | Null/unknown is never permission to infer. |
| Which old facts may carry forward? | `SOURCE_MAP.md` §Fact migration | Canon §3.3 | Do not inherit July 25 logistics or offer. |
| What is the brand truth? | Canon §4 | `../marketing/canon/BRAND_CANON.md` | Independence is non-negotiable. |
| How should it look and sound? | Canon §§5–6 | `THEME_SYSTEM.md` | First declare current-theme or new-theme mode. |
| Who are we addressing? | Canon §7 | `../marketing/strategy/AUDIENCES_AND_JOURNEYS.md` | Treat segments as hypotheses, not sensitive traits. |
| What should this piece accomplish? | Canon §§8–9 | Campaign brief template | One audience change and one primary action. |
| What source assets are usable? | Canon §11 | Rights register | Presence is not clearance. |
| Which formats must be made? | Canon §12 | Production checklist | Scope formats in the approved media plan. |
| What does each platform need? | Canon §13 | Source Map official links | Verify current specs in official tools immediately before export/spend. |
| How are links and events named? | Canon §14 | Tracking template | No PII in URLs or analytics. |
| When does content run and stop? | Canon §15 | Release manifest | Every dated release needs expiry and kill conditions. |
| What approvals are mandatory? | Canon §§17–19 | Checklist final lock | A specialist review is not “looks good.” |
| How is performance reported? | Canon §20 | Report CSV template | Preserve definitions, windows, and uncertainty. |
| How do I brief a deliverable? | `briefs/CAMPAIGN_BRIEF_TEMPLATE.md` | `copy/COPY_DECK_TEMPLATE.md` | Record assumptions and fact IDs. |
| How do I record a shipped item? | `releases/RELEASE_MANIFEST_TEMPLATE.json` | Checklist final lock | Exact files, hashes, copy, IDs, approvals. |

## Supporting repository study map

### Portable marketing system

- `../marketing/README.md` and `LAB_CHARTER.md`: operating model, authority, status language.
- `../marketing/canon/BRAND_CANON.md`, `CAMPAIGN_CANON.md`, and `NINE_FAMILY_PLAYBOOK.md`: evergreen brand and expressive options.
- `../marketing/expression/`: truth-to-release trace and funnel matrix.
- `../marketing/strategy/`: audiences, architecture, channels, and volatile media-spec appendix.
- `../marketing/production/`: copy/asset construction, naming, masters, scorecard.
- `../marketing/operations/`: measurement, experiments, production, release, retirement.
- `../marketing/templates/` and `registers/`: optional deeper working records.

### Active visual and destination evidence

- `../proto/docs/currsite_visual_engineering_report.md`: visual baseline and route/capture map.
- `../currsite/`: actual desktop screenshot evidence; visually inspect representative images when matching or intentionally departing from the current theme.
- `../proto/docs/public_site_expert_engineering_handoff.md`: active runtime, rendering layers, forms, risks, and QA.
- `../proto/docs/website_ssot.md`: old active-site canon; dated facts are migration evidence only.
- `../proto/public/assets/css/site.css`: implemented tokens/components.
- `../proto/public/assets/img/`: candidate visual material; rights approval is separate.

### Historical concept and production references

- `../docs/first_run_marketing_campaign.md`: reusable five-stage logic, expired July 25 overlay.
- `../docs/marketing_still_image_inventory.md`: broad still-output menu.
- `../docs/marketing_image_mockup_specs/`, `marketing_image_prompt_templates/`, and `marketing_image_prompts/`: concept/prompt references requiring September 26 fact substitution and review.
- `../SITE_ARCHITECTURE_REPORT_20260914_150852.txt`: archaeology only.

## Deliverable-to-record map

| Work product | Save under | Minimum companion record |
| --- | --- | --- |
| Campaign or piece brief | `briefs/` | Fact IDs, audience, stage, theme mode, CTA, reviews |
| Copy | `copy/` | Copy deck with exact fact and control references |
| Concept/storyboard | `creative/` | Brief ID, theme decision, asset/rights candidates |
| Editable design | `masters/` | Source links, fonts, safe zones, derivative map |
| Still derivative | `exports/<release-id>/` | Release manifest, alt text, checksum |
| Video derivative | `video/<release-id>/` | Captions, transcript, audio rights, flashing review |
| Audio | `audio/<release-id>/` | License, mix/loudness notes, transcript |
| Rights evidence | `rights/` | Rights-register row and source evidence |
| Tracking config/evidence | `tracking/` | Event/UTM map and QA evidence |
| Decision | `decisions/` | Decision record with rationale and affected outputs |
| Review evidence | `reviews/<release-id>/` | Named discipline, decision, date, evidence |
| Live release | `releases/<release-id>/` | Immutable manifest and platform IDs |
| Results | `reports/` | Defined metrics, source/window, postmortem |

## Publication stop signs

Stop rather than improvise if a requested output needs an unknown event year, timezone, venue, offer, URL, performer billing, sponsor relationship, testimonial, literal effect, access promise, or uncleared asset. Draft with conspicuous placeholders only when the user wants a concept, and never allow placeholders into a public export.
