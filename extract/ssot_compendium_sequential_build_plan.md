# SSOT Compendium Sequential Build Plan and Effort Evaluation

**Document purpose:** Preserve the dependency-driven evaluation for building the
Just One KISS SSOT compendium from its current scaffold state through controlled
completion.

**Status:** Planning evaluation; not an approval record and not canonical project
fact.

**Timeline classification:** `GEN` / GENERAL / NOT TIMELINE-SPECIFIC.

**Evaluated baseline:** 2026-08-13. The live manifest contained 209 unique planned
documents in 14 sections. All 209 were empty scaffolds; none qualified as approved
SSOT.

**Companion operating prompt:**
[`SEQUENTIAL_BUILD_BOOT.md`](SEQUENTIAL_BUILD_BOOT.md).

---

## 1. Executive Recommendation

Build the sections in this dependency-driven order:

> **90 → 00 → 01 → 02 → 03 → 04 → 05 → 06 → 08 → 07 → 10 → 09 → 11 → 99**

This differs intentionally from simple numeric order:

1. Section `90` supplies schemas and controlled vocabularies used to validate
   every business document.
2. Section `00` supplies authority, provenance, conflict, privacy, revision, and
   approval control.
3. Section `01` establishes the project, event, venue, role, and people facts
   referenced by show, public, marketing, and booking records.
4. Section `02` establishes program identity, timing, and Timeline crosswalks
   that technical and operating documents must reference rather than rewrite.
5. Section `03` establishes equipment, geometry, patching, and technical
   configuration used by safety, assets, cues, maintenance, and riders.
6. Section `04` establishes safety and readiness controls that may block any
   release.
7. Sections `05`, `06`, `08`, and `07` progress from asset existence and rights,
   through approved brand/content rules, into the live public-site contract, and
   finally into campaigns, sales, and booking.
8. Section `10` defines developer and data mechanics before Section `09` claims
   an owner interface can safely edit, approve, publish, audit, or roll back data.
9. Section `11` migrates history only after current authority and historical
   boundaries exist.
10. Section `99` is generated last from identified, sufficiently ready upstream
    revisions.

This is not a rigid waterfall. Sections `90` and `00` need foundation passes and
then controlled refinement. Sections `03` and `04` should overlap because
technical discoveries create safety requirements while safety decisions constrain
technical plans. A downstream section may be studied early, but its assertions
must not outrun its upstream authority.

---

## 2. Estimate Model and Caveats

### 2.1 Time unit

One **focused expert person-day** means approximately six to seven productive
hours of source inspection, reconciliation, structured authoring, provenance,
conflict registration, validation, and review preparation.

The estimates do not include indefinite waiting for owner decisions, venue
measurements, physical inspection, rights clearance, rehearsal evidence, safety
approval, personnel confirmation, or final signatures.

### 2.2 Size unit

Each section estimate includes:

- the fixed planned document count;
- an approximate range of substantive structured records; and
- an approximate formatted JSON/Markdown footprint, excluding source binaries,
  images, runtime uploads, backups, caches, and generated artifacts outside the
  section.

The ranges are planning estimates. Actual size depends on whether cue rows,
fixture instances, asset derivatives, source references, and historical entries
are stored as compact references or repeated embedded objects.

### 2.3 Completion is not the same as population

A populated file is not necessarily complete. A section is complete only after
its required leaves are reconciled, provenance-complete, valid, dependency-ready,
free of concealed conflicts or blockers, and approved with the required control
evidence. Waiting on external evidence may increase calendar time without
increasing authoring effort.

---

## 3. Portfolio Estimate

| Order | Section | Documents | Focused effort | Estimated records | Authored footprint |
|---:|---|---:|---:|---:|---:|
| 1 | `90` — Schemas and Controlled Vocabularies | 24 | 8–13 days | 175–350 | 250–500 KB |
| 2 | `00` — Control and Governance | 13 | 10–16 days | 650–1,000 | 500 KB–1.1 MB |
| 3 | `01` — Project, Event, Venue, and People | 12 | 7–12 days | 80–180 | 150–350 KB |
| 4 | `02` — Show Program and Timeline | 14 | 12–20 days | 250–500 | 400–850 KB |
| 5 | `03` — Technical Systems and Stage | 29 | 18–30 days | 500–1,000 | 900 KB–2.0 MB |
| 6 | `04` — Operations, Safety, and Readiness | 15 | 14–24 days | 300–650 | 600 KB–1.3 MB |
| 7 | `05` — Assets, Media, and Rights | 12 | 10–18 days | 250–700 | 500 KB–1.4 MB |
| 8 | `06` — Brand, Content, and Accessibility | 11 | 7–12 days | 175–400 | 300–750 KB |
| 9 | `08` — Public Website and Audience Data | 15 | 10–17 days | 250–600 | 500 KB–1.2 MB |
| 10 | `07` — Marketing, Sales, and Booking | 16 | 10–17 days | 250–600 | 500 KB–1.2 MB |
| 11 | `10` — Developer, Data, and Integrations | 12 | 8–14 days | 175–350 | 350–800 KB |
| 12 | `09` — Owner Admin and CMS | 15 | 11–18 days | 250–550 | 500 KB–1.1 MB |
| 13 | `11` — Records, History, and Audit | 8 | 8–15 days | 300–1,200 initially | 400 KB–2.0 MB initially |
| 14 | `99` — Indexes, Views, and Exports | 13 | 7–13 days | Generated from upstream | 1–4 MB generated |
| **Total** | **Full compendium** | **209** | **140–239 days** | **3,835–8,080** | **7–20 MB** |

### 3.1 Calendar translation

- One full-time expert: approximately **7–12 months**.
- Two coordinated experts: approximately **4–7 months**.
- Three or four domain specialists: approximately **3–5 months**.
- External decisions, physical verification, rights review, and safety approval
  can extend elapsed calendar time beyond these ranges.

---

## 4. Detailed Section Sequence

## 4.1 First — Section 90: Schemas and Controlled Vocabularies

### Why first

Section `90` defines the common document envelope, reference shapes, namespaces,
status terms, relationships, and domain schemas needed to validate every later
record. Building domain content first would invite field-name drift, inconsistent
statuses, conflicting IDs, repeated migrations, and weak cross-document checks.

### Internal order

1. **90.01 Core schemas:** document, source reference, entity record, Timeline
   moment, and conflict schemas.
2. **90.03 Vocabulary registries:** namespaces, statuses, roles, relationships,
   channel/placement terms, and asset taxonomy.
3. **90.02 Domain schemas:** equipment, department cues, assets, campaigns,
   forms, releases, public route sections, inspections, and owner work.

### Estimate

- 24 documents.
- 8–13 person-days.
- 175–350 definitions.
- 250–500 KB, approximately 5,000–9,000 formatted lines.
- Reserve another 2–4 refinement days across later phases as representative
  domain records expose missing constraints.

### Ready condition

The section must reliably distinguish scaffold from content, draft from approved,
authority from generated view, public from restricted data, Timeline-specific
from `GEN`, verified from estimated, and active from superseded.

## 4.2 Second — Section 00: Control and Governance

### Why second

This section establishes which evidence is authoritative, how claims retain
provenance, how conflicts and decisions remain visible, how privacy works, how
revisions propagate, and what approval means. Later extraction cannot responsibly
claim truth without these controls.

### Internal order

1. Source authority policy.
2. Document control policy.
3. Data classification policy.
4. Source registry.
5. Compendium manifest.
6. Provenance ledger.
7. Conflict register.
8. Open questions register.
9. Decision register.
10. Change-control register.
11. Document revision log.
12. Canon synchronization matrix.
13. Review and freshness schedule.

### Estimate

- 13 documents.
- 10–16 person-days.
- 650–1,000 control and source entries.
- 500 KB–1.1 MB, approximately 10,000–20,000 formatted lines.

### Operating note

Section `00` is established second but maintained throughout every later phase.
Provenance, conflict, decision, and change records must be written during the
work, not reconstructed at the end.

## 4.3 Third — Section 01: Project, Event, Venue, and People

### Why third

It owns the durable identity and factual context referenced by show planning,
marketing, the website, booking, safety, venue operations, and owner workflows.
It prevents event facts from being independently copied across routes, language
files, campaigns, and notes.

### Internal order

1. **01.01:** project identity, scope/objectives, roles/authorities, organizations.
2. **01.02:** event registry, venue registry, travel/parking/camping/access, venue
   advance, event schedule.
3. **01.03:** responsibility matrix, personnel registry, restricted contacts.

### Estimate

- 12 documents.
- 7–12 person-days.
- 80–180 records.
- 150–350 KB, approximately 3,000–7,000 formatted lines.

### Likely blockers

Exact event times, venue capacities and restrictions, operational access facts,
named role holders, contact consent, partnership status, and approval authority.

## 4.4 Fourth — Section 02: Show Program and Timeline

### Why fourth

This is the program authority that technical and operational documents must
reference rather than rewrite. It must preserve the authoritative Cue Book's
PGM/TECH/FIN identities, both supplied timing profiles, unresolved decisions,
and the distinction between the controlled program and the working cue draft.

### Internal order

1. **02.01:** program events, timing profiles, sets, special technical events,
   finale and audience release.
2. **02.02:** Timeline registry, program crosswalk, show states, transitions,
   department cue crosswalk.
3. **02.03:** run of show, performer tracks, calling script, actual-timing log.

The calling script should be one of the final Section `02` artifacts because it
depends on department cues, transitions, show states, safety controls, and exact
triggers from Sections `03` and `04`.

### Estimate

- 14 documents.
- 12–20 person-days.
- 250–500 records.
- 400–850 KB, approximately 8,000–16,000 formatted lines.

### Likely blockers

Timing-profile selection, finale version/duration, transition timing, drop
triggers, encore behavior, applause/dialogue/hold allowances, department cue
triggers, blocking, and costume detail.

## 4.5 Fifth — Section 03: Technical Systems and Stage

### Why fifth

This is the largest canonical domain and feeds safety, department cues,
maintenance, assets, riders, readiness checks, and configuration releases.

### Internal order

1. **03.01:** vendor documents, equipment types, capabilities/modes, instances.
2. **03.03:** coordinate system, pavilion, stage, scaffold/rigging, zones, layers,
   fixture positions, and stage plot.
3. **03.02:** universe, patch, groups, control configuration, recipes, testing and
   recovery, lighting cue list.
4. **03.04:** power, communications, audio, video systems/cues, automation,
   effects devices, effects safety/cues.
5. **03.05:** scene profiles and technical configuration release.

### Estimate

- 29 documents.
- 18–30 person-days.
- 500–1,000 records.
- 900 KB–2.0 MB, approximately 18,000–40,000 formatted lines.

### Likely blockers

Physical fixture verification, tag/serial assignment, channel modes, measured
geometry, load ratings, power distribution, venue restrictions, routing, tested
recovery, and approval of a technical baseline. Estimated geometry and fixture
positions must never be promoted to measured fact.

## 4.6 Sixth — Section 04: Operations, Safety, and Readiness

### Why sixth

Safety may block any release regardless of creative or timing readiness. This
section should begin while Section `03` develops, then finalize after technical
facts and hazards are sufficiently stable.

### Internal order

1. Emergency states and hazards.
2. Safety approvals and emergency/show-stop plan.
3. Readiness gates, checklists, and operator outputs.
4. Production/rehearsal schedules and readiness assessment.
5. Wardrobe, props, and performer equipment.
6. Rehearsal, performance, incident, and near-miss record contracts.

### Estimate

- 15 documents.
- 14–24 person-days.
- 300–650 initial records.
- 600 KB–1.3 MB, approximately 12,000–26,000 formatted lines.

### Likely blockers

Named show-stop authority, venue emergency rules, effects approvals, load/power/
egress/weather plans, rehearsal evidence, tested fallback behavior, and assigned
responsibilities. This section may have the greatest calendar delay because it
depends heavily on human authority and physical verification.

## 4.7 Seventh — Section 05: Assets, Media, and Rights

### Why seventh

Asset existence must be separated from brand guidance, campaign use, and website
placement. A prompt does not prove an asset exists, and an uploaded file does not
prove that public use has been cleared.

### Internal order

1. Naming/storage policy and core asset registry.
2. Physical, digital, and relationship registries.
3. Media intake, edits/derivatives, and production requirements.
4. Rights claims, affiliation guardrails, and publication clearance.
5. Media placement registry.

### Estimate

- 12 documents.
- 10–18 person-days.
- 250–700 records.
- 500 KB–1.4 MB, approximately 10,000–28,000 formatted lines.

### Likely blockers

Creator/source attribution, licenses/releases, likeness permission, font and
trademark posture, derivative relationships, visibility, checksums/storage, and
approval of uploaded images.

## 4.8 Eighth — Section 06: Brand, Content, and Accessibility

### Why eighth

This section turns verified facts and cleared rights rules into controlled public
language and visual guidance. It must not invent facts or treat uncleared media
as approved.

### Internal order

1. Brand identity, voice, stories, and visual system.
2. Content approval/localization policy.
3. Claims, disclaimers/advisories, and practical fact blocks.
4. Content tokens.
5. Accessibility requirements and audience safety advisory.

Accessibility requirements should be drafted early enough to constrain every
record even if final validation happens later.

### Estimate

- 11 documents.
- 7–12 person-days.
- 175–400 records.
- 300–750 KB, approximately 6,000–15,000 formatted lines.

### Likely blockers

Approved event claims, independent-tribute wording, rights-approved imagery and
vocabulary, accessibility thresholds, safety language, disclosure decisions,
and reconciliation of competing language files.

## 4.9 Ninth — Section 08: Public Website and Audience Data

### Why before Section 07

The active public site already establishes real routes, forms, bindings, layer
state, publication behavior, and conversion surfaces. Marketing should point to
verified destinations and form contracts rather than define them independently.

### Internal order

1. **08.01:** public architecture, routes, navigation, sections, content bindings.
2. **08.02:** consent/privacy, form definitions, restricted submissions, mail
   recovery, aggregate metrics.
3. **08.03:** layer definitions, draft state, change log, publication release,
   launch readiness.

### Estimate

- 15 documents.
- 10–17 person-days.
- 250–600 records.
- 500 KB–1.2 MB, approximately 10,000–24,000 formatted lines.

### Likely blockers

Consent and retention policy, production authentication, mail verification,
persistence choice, publication approval, state/history reconciliation, token
alignment, redaction, and launch decisions. Raw submissions, mail bodies, and
diagnostics must not be copied into unrestricted SSOT.

## 4.10 Tenth — Section 07: Marketing, Sales, and Booking

### Why tenth

Marketing depends on verified facts, cleared assets, approved claims, and real
website destinations. Building it after Section `08` prevents campaigns from
advertising unsupported claims, nonexistent assets, or unavailable conversion
paths.

### Internal order

1. Audiences, funnel stages, and channels.
2. Campaigns, pieces, briefs, placements, and prompt templates.
3. Calendar, releases, and measurement.
4. Booking offer, pipeline, and contacts.
5. Technical rider and press-kit manifest.

### Estimate

- 16 documents.
- 10–17 person-days.
- 250–600 records.
- 500 KB–1.2 MB, approximately 10,000–24,000 formatted lines.

### Likely blockers

Public offer/CTA, campaign timing/budget, analytics approval, cleared creative,
booking terms, buyer-facing technical claims, contacts, and press assets.

## 4.11 Eleventh — Section 10: Developer, Data, and Integrations

### Why before Section 09

It defines the mechanics through which an owner/admin surface can interact with
canonical data: boundaries, adapters, transformations, deployments, migrations,
generated artifacts, validation, and secret handling. Those mechanics should
exist before an interface claims safe edit or publication behavior.

### Internal order

1. Repository components, routes/entry points, and deployment profiles.
2. Developer workflow.
3. Data adapters, transformations, and duplicate migration.
4. Generated-artifact policy and validation suite.
5. Integrations, secrets/configuration, and model/tool routing.

### Estimate

- 12 documents.
- 8–14 person-days.
- 175–350 records.
- 350–800 KB, approximately 7,000–16,000 formatted lines.

### Likely blockers

Deployment topology, authentication and secrets, database choice, backup/restore,
integration ownership, migration acceptance, automated validation, and
time-sensitive tool choices.

## 4.12 Twelfth — Section 09: Owner Admin and CMS

### Why twelfth

Owner interfaces must be built around established canonical contracts rather
than used to invent them. UI arrays and cards are not canonical data, and the
current owner surfaces remain evolutionary evidence rather than multiple domain
authorities.

### Internal order

1. Application, module, navigation, and universal-record models.
2. Roles/permissions, authentication/audit, persistence/backup/recovery.
3. Priorities, tasks, integrity rules, and findings.
4. CMS edit contracts, drafts, and public-release gates.

### Estimate

- 15 documents.
- 11–18 person-days.
- 250–550 records.
- 500 KB–1.1 MB, approximately 10,000–22,000 formatted lines.

### Likely blockers

Production authentication, permissions, persistence, retention, rollback,
publication policy, draft/review responsibility, edit boundaries, and resolution
of differences among owner renditions.

## 4.13 Thirteenth — Section 11: Records, History, and Audit

### Why near the end

Historical records describe what occurred and may propose changes, but they must
not silently mutate current authority. Migration should follow stable canonical
IDs, privacy rules, and supersession relationships.

### Internal order

1. Source snapshots and extraction runs.
2. Deprecated/superseded artifacts and historical notes.
3. Show instances and issue/action records.
4. Equipment inspection/maintenance and release history.

### Estimate

- 8 documents.
- 8–15 person-days for initial migration.
- 300–1,200 initial records.
- 400 KB–2.0 MB initially, approximately 8,000–40,000 formatted lines.

### Growth warning

Section `11` is append-heavy and may eventually exceed Section `03`. Partitioning
by year or show instance may become appropriate; stable references are preferable
to indefinitely expanding embedded payloads.

## 4.14 Fourteenth — Section 99: Indexes, Views, and Exports

### Why last

Everything in Section `99` is derived and must be reproducible from declared
upstream revisions. Early generation could make incomplete data look authoritative.

### Internal order

1. **99.01:** all-records, Timeline, equipment-patch, asset-usage,
   source-coverage, and open-work indexes.
2. **99.02:** redacted data dictionary, master compendium, technical rig book,
   show-control book, public facts/copy book, owner operations book, booking and
   press packet.

### Estimate

- 13 documents.
- 7–13 person-days.
- Primarily generated entries rather than independently authored records.
- 1–4 MB, approximately 20,000–80,000 generated lines.

Effort belongs in deterministic generators, sorting, redaction, source-revision
declarations, freshness checks, and reproducibility—not manual editing of output.

---

## 5. Phase Gates

## Gate A — Foundation Ready

**Sections:** `90`, `00`
**Cumulative effort:** 18–29 person-days.

Pass when common schemas validate representative cross-domain records; source,
provenance, conflict, privacy, revision, and approval controls work; and the audit
can distinguish every live state without promoting empty structure.

## Gate B — Core Production Truth Ready

**Sections:** `01`, `02`, `03`, `04` plus Gate A.
**Cumulative effort:** 69–125 person-days.

Pass when project/event identity is reconciled; program and Timeline identities
are stable; timing uncertainty remains explicit; technical data retains confidence;
safety can block releases; and department documents reference program authority.

## Gate C — Public and Commercial Truth Ready

**Sections:** `05`, `06`, `08`, `07` plus earlier gates.
**Cumulative effort:** 106–189 person-days.

Pass when asset existence and rights are distinct; claims and copy are controlled;
routes, forms, consent, placements, and publication are reconciled; campaigns
reference real destinations; and booking outputs use verified facts.

## Gate D — Managed System Ready

**Sections:** `10`, `09` plus earlier gates.
**Cumulative effort:** 125–221 person-days.

Pass when adapters, migrations, permissions, editing contracts, drafts, review,
publication, audit, backup, and rollback boundaries are explicit and validated.

## Gate E — Historical and Generated Completion

**Sections:** `11`, `99` plus earlier gates.
**Total effort:** 140–239 person-days.

Pass when history is migrated without becoming silent authority; source coverage
is measurable; supersession is traceable; generated products reproduce; redaction
passes; and every required leaf is approved or has a controlled disposition.

---

## 6. Risk Ranking

### Most labor-intensive

1. `03` — Technical Systems and Stage.
2. `04` — Operations, Safety, and Readiness.
3. `02` — Show Program and Timeline.
4. `05` — Assets, Media, and Rights.
5. `00` — Control and Governance.

### Most likely to incur approval delays

1. `04` — safety and readiness.
2. `01` — venue, people, and contacts.
3. `02` — timing, finale, and technical triggers.
4. `05` — rights and clearance.
5. `09` — authentication, permissions, and publishing.

### Most likely to grow after initial completion

1. `11` — records, history, and audit.
2. `05` — assets, media, and rights.
3. `07` — marketing, sales, and booking.
4. `00` — provenance, decisions, and revisions.
5. `99` — generated views.

---

## 7. Recommended First Bounded Work Package

Do not attempt all 24 Section `90` documents in one undifferentiated pass. Begin
with this minimum trustworthy control package:

1. `90_schemas_and_vocabularies/document.schema.json`
2. `90_schemas_and_vocabularies/source_reference.schema.json`
3. `90_schemas_and_vocabularies/conflict.schema.json`
4. `90_schemas_and_vocabularies/status_vocabularies.json`
5. `90_schemas_and_vocabularies/id_namespace_registry.json`
6. `00_control_and_governance/source_authority_policy.json`
7. `00_control_and_governance/document_control_policy.json`
8. `00_control_and_governance/data_classification_policy.json`

**First-sprint estimate:** 7–10 person-days, 60–120 definitions, and 100–220 KB.
The target should be `REVIEW`, not automatic approval. Validate the package
against representative project, cue, fixture, asset, route, owner-work, and
historical records before approval.

---

## 8. Full-Completion Definition

The sequential program is complete only when:

- every required canonical leaf is approved with required evidence;
- all required generated leaves are current and reproducible;
- every repository source is covered or has an exclusion/redaction disposition;
- conflicts, questions, blockers, and invalid findings are closed or explicitly
  accepted through controlled decisions;
- cross-section dependencies, references, revisions, and release links resolve;
- Timeline/GEN, safety, rights, privacy, and accessibility rules pass;
- estimated or prototype data remains distinguishable from verified fact;
- history cannot silently mutate current authority; and
- a clean live audit finds no empty scaffold masquerading as completed SSOT.
