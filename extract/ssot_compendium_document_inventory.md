# Proposed SSOT Compendium Document Inventory

## 1. Decision and intended use

This document is the proposed catalog for the new repository-wide SSOT
compendium. It is deliberately organized as a future folder/file inventory so a
later pass can generate scaffolding without having to rediscover domain
boundaries.

The catalog is a synthesis of the complete 566-file repository study, including:

- the two authoritative production DOCX documents;
- the root and `docs/` planning/canon sources;
- the existing `docs/ssot/` contracts and 12 settings files;
- all four copies of the 16-document bundled SSOT set;
- all public-site language, route, section, layer-state, form, database, media,
  and runtime datasets;
- all five owner/admin implementations and their PHP data contracts;
- all 59 granular fixture records, nine global stage datasets, three scene
  profiles, two JSON schemas, and the fixture index in `proto_prob/`;
- marketing specifications, templates, prompts, and generation tooling; and
- historical notes, prompts, reports, backups, and operational logs.

This is **not** the extracted compendium and does not make any repository claim
newly canonical. It defines the documents that should be made, their authority
boundaries, and their expected source lineage.

## 2. Findings that control the architecture

The study produced several decisions that the future structure must respect.

1. **Program order has a separate authority.** The Authoritative Show Control &
   Performance Cue Book states that it alone governs program-event order,
   supplied durations, planned timing profiles, and PGM/TECH/FIN identities.
   Department documents must reference those IDs instead of duplicating the
   sequence as independently editable truth.
2. **Production control is already formally decomposed.** The Authoritative
   Supporting Production Documentation Standard defines a controlled hierarchy:
   core authority, operational department documents, and historical records. Its
   controlled IDs (such as `CTRL-01`, `SM-01`, `LX-02`, and `SAFE-01`) should be
   retained as aliases/crosswalks in the new compendium.
3. **The existing JSON layer is incomplete as a full compendium.** Many
   `docs/ssot/*.json` files contain summaries or zero to three canonical records.
   They are useful extraction contracts, but they do not exhaust their source
   documents.
4. **Deployment bundles have diverged from the upstream set.** Every one of the
   16 JSON filenames bundled into the three owner renditions has two byte-level
   variants: one in `docs/ssot/` and one identical variant shared by all three
   rendition bundles. The new compendium needs explicit provenance and must not
   select a copy based only on location.
5. **Public language is versioned data.** Three older language datasets contain
   422 entries and 127 text groups, while the active `proto/docs/language.json`
   contains 526 entries and 438 groups and reports a later update date. Approval,
   route use, and change history must remain separate from raw recency.
6. **The granular rig prototype is valuable but unverified.** It contains 59
   active fixture records, but all 59 positions are marked `estimated`. It also
   contains structured stage, pavilion, scaffold, zone, group, layer, DMX, and
   fixture-type data. These records require reconciliation with the authoritative
   narrative inventory and vendor evidence before promotion.
7. **Current public layer state is not equivalent to history.** Current draft
   and published layer files contain empty control collections, while 22 dated
   backups contain the editing history and asset metadata. Current state,
   publication releases, and immutable audit events need different documents.
8. **Owner applications represent evolution, not five authorities.** `owner/`
   establishes a generic model; `owner_arena_command/` adds normalization and
   status options; `secondrendition/` adds source/link integrity;
   `thirdrendition/` adds production classifications; and `center/` adds current
   priorities, gates, provenance, decisions, and CMS contracts. The compendium
   should synthesize these into one model while preserving rendition provenance.
9. **Runtime records require privacy boundaries.** Lead, mail-failure, booking,
   diagnostic, config, and contact data cannot be copied into a broadly readable
   compendium. Schemas, retention policy, redacted metrics, and restricted record
   references belong in separate controlled documents.
10. **Facts, rules, plans, and records are different things.** The structure must
    prevent prompts, implementation defaults, aspirational plans, generated
    indexes, and historical observations from silently becoming approved facts.

## 3. Compendium-wide document classes

Every proposed file below receives one primary class.

| Class | Purpose | Mutation rule |
|---|---|---|
| `authority` | A controlled policy or identity source. | Changes require named approval and revision entry. |
| `registry` | Canonical entities keyed by stable IDs. | Add/update through validation; never reuse retired IDs. |
| `plan` | Approved intended future or event-specific configuration. | Must retain status and effective scope. |
| `procedure` | Approved operating method, checklist, or recovery instruction. | Safety-impacting changes require approval. |
| `release` | Immutable approved snapshot used for an event, performance, site publish, or campaign. | Append-only; supersede rather than overwrite. |
| `record` | What actually occurred: report, inspection, submission, incident, or decision. | Append-only except controlled correction. |
| `schema` | Validation contract and enumerated vocabulary. | Versioned; breaking change increments major version. |
| `index` | Generated discovery/cross-reference document. | Rebuild from upstream; never edit as primary truth. |
| `view` | Human-readable or application-specific projection. | Generated from canonical data wherever practical. |

## 4. Common envelope required in every canonical document

Each JSON or YAML SSOT document should carry a common document-control envelope:

- `schema_version`
- `document_id`
- `document_class`
- `title`
- `description`
- `status` (`draft`, `in_review`, `approved`, `superseded`, or `archived`)
- `revision`
- `effective_date`
- `owner_role`
- `approver_role`
- `visibility` (`public`, `internal`, `restricted`, or `secret_reference_only`)
- `timeline_scope` (`GEN`, specific Timeline IDs, or an explicit mixed scope)
- `source_refs` with path, source type, revision/hash, and extraction date
- `conflict_refs`
- `supersedes` and `superseded_by`
- `created_at`, `updated_at`, and `review_due_at`
- `data` containing the document-specific payload

Entity records should additionally carry stable `record_id`, lifecycle status,
provenance, confidence/verification status, rights and safety states when
applicable, linked records/files, and record-level timestamps.

## 5. Proposed top-level structure

```text
extract/compendium/
├── 00_control_and_governance/
├── 01_project_event_and_people/
├── 02_show_program_and_timeline/
├── 03_technical_systems_and_stage/
├── 04_operations_safety_and_readiness/
├── 05_assets_media_and_rights/
├── 06_brand_content_and_accessibility/
├── 07_marketing_sales_and_booking/
├── 08_public_website_and_audience_data/
├── 09_owner_admin_and_cms/
├── 10_developer_data_and_integrations/
├── 11_records_history_and_audit/
├── 90_schemas_and_vocabularies/
└── 99_indexes_views_and_exports/
```

The numbered sections communicate dependency order. Sections `90` and `99` are
cross-cutting support layers rather than business domains.

---

# 00 — Control and Governance

This section defines what is authoritative, how changes propagate, and how all
other compendium documents are discovered and controlled.

## 00.01 Compendium control

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `00_control_and_governance/compendium_manifest.json` | index | Every document ID, path, class, status, revision, owner, visibility, dependencies, schema, and generated view | `docs/ssot/master_index.json`; settings manifest; complete repository inventory |
| `00_control_and_governance/source_authority_policy.json` | authority | Domain authority hierarchy; conflict precedence; safety precedence; implementation-versus-policy rule | Root `README.md`; both authoritative DOCX documents; canon-sync policy |
| `00_control_and_governance/document_control_policy.json` | authority | Required envelope; statuses; revision semantics; filenames; approval; distribution; supersession; archival | Supporting Documentation Standard; current documentation groundwork plan |
| `00_control_and_governance/source_registry.json` | registry | Stable source IDs; paths; formats; hashes; authored/revised dates; authority claims; sensitivity; extraction status | All 566 files; Git metadata; existing `source_document` fields |
| `00_control_and_governance/provenance_ledger.json` | record | Claim/record-to-source edges; extraction method; transformations; verifier; confidence | `center/data/source_provenance_schema.php`; owner record links; JSON maintenance blocks |
| `00_control_and_governance/conflict_register.json` | record | Conflicting claims; candidate values; scope; authority analysis; disposition; approval | Language variants; SSOT forks; cue timing profiles; rig conflicts |
| `00_control_and_governance/change_control_register.json` | record | Change request; impacted documents/records; risk; approvals; propagation checklist; closure | `CTRL-01` standard; center decisions and release gates |
| `00_control_and_governance/document_revision_log.json` | record | Document revisions; reasons; approvers; distribution; superseded artifacts | DOCX Appendix C; JSON maintenance; Git history |
| `00_control_and_governance/data_classification_policy.json` | authority | Public/internal/restricted/secret-reference-only; PII; security; retention; redaction | Center disclosure tiers; form/runtime storage; diagnostics/security notes |

## 00.02 Decision and review control

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `00_control_and_governance/decision_register.json` | record | Decision ID; question; alternatives; evidence; decision; owner; effective scope; reopen conditions | `center/data/decision_schema.php`; center answers/reports; open questions in docs |
| `00_control_and_governance/open_questions_register.json` | registry | Unresolved facts; severity; blocker status; responsible role; due date; linked conflicts | DOCX TBDs; center inquiries; document open-question sections; fixture records |
| `00_control_and_governance/review_and_freshness_schedule.json` | plan | Review frequency by domain; review owner; staleness triggers; last/next review | Existing maintenance metadata; settings; model-routing freshness needs |
| `00_control_and_governance/canon_sync_matrix.json` | registry | Source-to-SSOT-to-view propagation routes; manual/automated sync; validation command | `center/docs/canon_sync_policy.md`; paired Markdown/JSON; rendition bundles |

---

# 01 — Project, Event, Venue, and People

This section owns durable identity and the factual context in which a specific
show or campaign occurs. It prevents event facts from being duplicated in copy,
routes, and campaigns.

## 01.01 Project identity

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `01_project_event_and_people/project_identity.json` | authority | Canonical name; project type; description; independent-tribute posture; operating model; durable summaries | Root README; knowledge; master game plan; project settings; `proto_prob` project data |
| `01_project_event_and_people/project_scope_and_objectives.json` | plan | Audience promise; production objectives; booking/repeatability objectives; exclusions; success measures | Master game plan; website system plan; marketing campaign; project blueprints |
| `01_project_event_and_people/roles_and_authorities.json` | registry | Role IDs; responsibilities; approval authority; performer/operator model; safety and show-stop authority | DOCX department codes/control register; owner roles; project plans |
| `01_project_event_and_people/organizations_and_partners.json` | registry | Venue, production, vendor, platform, and partner entities; relationship type; approval/affiliation status | Public site; venue advance plans; vendor manuals; rights guardrails |

## 01.02 Events and venues

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `01_project_event_and_people/event_registry.json` | registry | Event ID; name; date/time/time zone; offer; audience posture; venue; status; public fact block | Active language JSON; active public pages; site data; campaign facts |
| `01_project_event_and_people/event_schedule_plan.json` | plan | Crew call; load-in; checks; doors; show; breaks; load-out; milestones; dependencies | DOCX `SM-02`/`SCHED-01`; public event information; launch/rehearsal seeds |
| `01_project_event_and_people/venue_registry.json` | registry | Venue identity; address; contact references; access; capacities; restrictions; verification | Public pages/site data; venue/website plans; future `VEN-01` data |
| `01_project_event_and_people/venue_advance_and_house_interface.json` | plan | Stage/access dimensions; load-in; rigging; power; rooms; house equipment; staffing; curfew; permits; restrictions | Supporting standard `VEN-01`; stage/pavilion data; public directions |
| `01_project_event_and_people/travel_parking_camping_and_access.json` | plan | Directions; parking; camping; arrival; accessible approach; audience logistics | Active public copy/routes; marketing fact blocks; venue information |

## 01.03 People and contact references

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `01_project_event_and_people/personnel_registry.json` | registry | Person ID; public display name; internal role IDs; active dates; qualifications; visibility | DOCX roles; owner/contact seeds; public performer/press copy |
| `01_project_event_and_people/responsibility_matrix.json` | authority | RACI by document, system, cue family, gate, and emergency action | Supporting standard `CONTACT-01`; center role/schema/gate data |
| `01_project_event_and_people/restricted_contact_directory.json` | registry | Contact methods; call signs; emergency contacts; alternates; consent; access control | Contact/booking seeds; public contact configuration; `CONTACT-01` requirements |

---

# 02 — Show Program and Timeline

This section implements the Doc 1 rule: program identity, order, and supplied
timing live once. Department documents reference these IDs.

## 02.01 Program authority

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `02_show_program_and_timeline/program_event_registry.json` | authority | Immutable PGM IDs; event type; controlled title; set association; order; supplied duration; status; source cross-reference | Authoritative Cue Book; `docs/cue.txt`; cue JSON |
| `02_show_program_and_timeline/program_timing_profiles.json` | authority | Profile S/L and future profiles; per-event duration overrides; calculated elapsed times; excluded time categories; selected active profile | Cue Book timing profiles; cue draft duration notes |
| `02_show_program_and_timeline/set_registry.json` | registry | Set IDs/names; ordered PGM membership references; known planned duration; transition boundaries | Cue Book; cue draft; master game plan |
| `02_show_program_and_timeline/finale_and_audience_release_registry.json` | authority | FIN IDs; finale sequence; bows; encore/false ending; audience release; unresolved duration/version decisions | Cue Book finale registers; timeline/cue sources |
| `02_show_program_and_timeline/special_technical_event_registry.json` | registry | TECH IDs; platform/screen drops; special movements; dependencies; linked department cues | Cue Book technical register; raw cue seeds; automation/video plans |

## 02.02 Timeline model and crosswalks

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `02_show_program_and_timeline/timeline_moment_registry.json` | registry | PRE/OPEN/SET/SONG/TRN/CST/VID/LGT/FOG/STR/SPK/FIN/ENC/POST IDs; GEN distinction; lifecycle | Timeline registry Markdown/JSON; show-timeline settings |
| `02_show_program_and_timeline/program_timeline_crosswalk.json` | registry | PGM/TECH/FIN IDs to Timeline Moment IDs; relation type; synchronization status | Cue Book; Timeline registry; cue draft |
| `02_show_program_and_timeline/department_cue_crosswalk.json` | registry | PGM/TECH/FIN and Timeline IDs to SM/AUD/LX/VID/AUTO/FX/etc. cue IDs | Supporting standard; future department cue documents |
| `02_show_program_and_timeline/transition_registry.json` | registry | Between-song, costume, scenic, spoken, hold, and reset transitions; duration status; dependencies | Cue draft; master game plan transition documents; Cue Book |
| `02_show_program_and_timeline/show_state_vocabulary.json` | authority | Standby/warning/GO/confirm/hold/abort/stop/reset states and allowed transitions | Cue Book calling conventions; rig emergency states; supporting standard |

## 02.03 Show execution documents

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `02_show_program_and_timeline/stage_manager_calling_script.json` | procedure | Ordered calls by referenced program ID; standbys; GO calls; confirmations; holds; aborts; entrances/exits | Supporting standard `SM-01`; Cue Book; department cue lists |
| `02_show_program_and_timeline/run_of_show.json` | view | Crew-call-to-load-out overview derived from event schedule and program registry | `SM-02`; event schedule; program events |
| `02_show_program_and_timeline/performer_track_registry.json` | procedure | Performer entrances/exits; blocking; route; costume; prop; mic/instrument; clear zones; bows | Supporting standard `PERF-01`; blocking/costume plans |
| `02_show_program_and_timeline/actual_performance_timing_log.json` | record | Performance instance; actual starts/stops; holds; applause/dialogue; variance; reason | Cue Book Appendix B; performance reports |

---

# 03 — Technical Systems and Stage

This section owns equipment facts, physical geometry, patching, control
configuration, department cues, and technical recovery behavior.

## 03.01 Equipment and fixture authority

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `03_technical_systems_and_stage/equipment_type_catalog.json` | registry | Fixture/device families; manufacturer/model; category; capabilities; supported modes; manual references | Inventory reference; vendor PDFs/JSON; `fixture-types.json` |
| `03_technical_systems_and_stage/equipment_instance_registry.json` | registry | Asset/fixture ID; type; tag/serial; status; physical role; verification; maintenance links | 59 fixture records; inventory reference; physical asset plans |
| `03_technical_systems_and_stage/vendor_document_registry.json` | registry | Manual ID; vendor/model applicability; revision; source file; extracted claims; supersession | Three PDFs; paired manual JSON; inventory source notes |
| `03_technical_systems_and_stage/equipment_capability_and_mode_catalog.json` | registry | Channel modes; parameter ranges; defaults/home; standalone modes; avoided modes; safe constraints | Vendor evidence; inventory dossiers; fixture types/schemas |

## 03.02 Lighting and DMX

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `03_technical_systems_and_stage/dmx_universe_registry.json` | registry | Universe IDs; protocol; size; interface/node; status; ownership | `dmx-universes.json`; inventory/rig; `LX-02` requirements |
| `03_technical_systems_and_stage/dmx_patch_plan.json` | plan | Instance ID; universe; start/end; mode; footprint; overlap exceptions; power/control source; test status | Inventory reference; all fixture JSON; fixture index; `LX-02` |
| `03_technical_systems_and_stage/lighting_group_registry.json` | registry | Logical groups; membership references; stage role; QLC+ naming | Inventory grouping guidance; `groups.json`; rig |
| `03_technical_systems_and_stage/lighting_recipe_catalog.json` | procedure | Direct color/value recipes; movement looks; blackout/work-light/audience looks; applicability | Inventory cookbook; rig; stage-scene profiles |
| `03_technical_systems_and_stage/lighting_cue_list.json` | procedure | LX cue IDs; linked program/timeline IDs; trigger; look; fades/follows; groups; overrides; warnings | Supporting standard `LX-01`; cue/timeline; recipes |
| `03_technical_systems_and_stage/lighting_control_configuration.json` | plan | QLC+ fixture definitions; function names; virtual console; outputs; wireless; backups; patch revision | Inventory QLC+ handbook; rig; `LX-02` |
| `03_technical_systems_and_stage/lighting_test_and_recovery_procedures.json` | procedure | Bench tests; fixture tests; wrong color/no response; unexpected movement; output failure; fallback state | Inventory troubleshooting/procedures; vendor manuals; rig |

## 03.03 Stage geometry and physical layout

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `03_technical_systems_and_stage/coordinate_system.json` | authority | Units; origin; axes; audience/stage orientation; precision; measurement method | `proto_prob/data/global/project.json`; geometry records |
| `03_technical_systems_and_stage/pavilion_geometry.json` | registry | Dimensions; roof; cradle; masking; verified status; evidence | `pavilion.json`; venue documents |
| `03_technical_systems_and_stage/stage_geometry.json` | registry | Main dimensions; rear platform; center transition; octagon; audience floor; finish; verification | `stage.json`; stage plot requirements |
| `03_technical_systems_and_stage/scaffold_and_rigging_geometry.json` | registry | Scaffold dimensions; towers; rails; position; material; verification; load-data references | `scaffold.json`; automation/rigging requirements |
| `03_technical_systems_and_stage/stage_zone_registry.json` | registry | Zone IDs; bounds/anchors; purpose; access; hazard/clearance properties | `zones.json`; fixture zones; safety plans |
| `03_technical_systems_and_stage/stage_layer_registry.json` | registry | Visualization/operational layers; visibility; order; domain; ownership | `layers.json`; fixture stage layers |
| `03_technical_systems_and_stage/stage_plot.json` | view | Generated overhead layout of verified geometry, equipment, traffic, cable paths, changes, exits, and fire lanes | Geometry registries; fixture positions; `STG-01` requirements |
| `03_technical_systems_and_stage/deck_preset_and_scene_change_plan.json` | procedure | Items; presets; routes; movers; timing; spikes; handoffs; clearances; reset; contingency | Supporting standard `DECK-01`; props/stage plans |

## 03.04 Power, communications, audio, video, automation, and effects

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `03_technical_systems_and_stage/power_distribution_plan.json` | plan | Circuits; loads; distribution; isolation; grounding; protection; cable routes; energize/shutdown | Fixture power fields; inventory; supporting standard `PWR-01` |
| `03_technical_systems_and_stage/communications_plan.json` | plan | Headsets/radios; channels; call signs; cue-light meanings; recipients; backups; emergency comms | Supporting standard `COMMS-01`; role/contact data |
| `03_technical_systems_and_stage/audio_system_and_cue_plan.json` | procedure | Playback assets/versions; routing; levels; microphones; monitoring; fades; backups; recovery | Supporting standard `AUD-01`; cue/program records |
| `03_technical_systems_and_stage/video_projection_system_registry.json` | registry | Displays/projectors/screens; destinations; resolution/aspect; layers/masks; control; backups | Website/production plans; video cue requirements; asset inventory |
| `03_technical_systems_and_stage/video_media_cue_list.json` | procedure | Media asset; linked program ID; trigger; destination; loop/hold/fade; fail state; screen coordination | Supporting standard `VID-01`; cue/timeline; digital assets |
| `03_technical_systems_and_stage/automation_rigging_cue_and_safety_plan.json` | procedure | Movement; limits; loads; operators; spotters; interlocks; E-stops; abort/recovery | `AUTO-01`; TECH registry; stage/scaffold geometry |
| `03_technical_systems_and_stage/effects_device_registry.json` | registry | Fog, strobe, and other effect devices/materials; capabilities; approvals; inspection state | Fixture records; inventory; master game plan |
| `03_technical_systems_and_stage/special_effects_cue_and_safety_plan.json` | procedure | Effect cue; trigger; settings/quantity; duration; zone/clearance; warning; shutdown; cleanup | Supporting standard `FX-01`; cue/timeline; safety data |

## 03.05 Scene profiles and technical releases

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `03_technical_systems_and_stage/scene_profile_registry.json` | registry | Profile ID/type; fixture values; layers; camera/view; intended use; verification; patch compatibility | Three stage-scene JSON files; lighting recipes |
| `03_technical_systems_and_stage/technical_configuration_release.json` | release | Approved patch, geometry, control config, scene versions, software/workspace version, checksums | All technical registries; release gates |

---

# 04 — Operations, Safety, and Readiness

This section controls how the approved plan is prepared, checked, operated,
stopped, recovered, reported, and closed.

## 04.01 Safety and emergency control

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `04_operations_safety_and_readiness/hazard_registry.json` | registry | Hazard ID; source/system; affected people/zones; likelihood/severity; controls; owner; review | Effects/lighting/public warnings; safety queue; venue restrictions |
| `04_operations_safety_and_readiness/safety_control_and_approval_register.json` | registry | Control measure; authority; evidence; permits; inspection; approval/expiry | `SAFE-01`, `FX-01`, release gates, rights/safety statuses |
| `04_operations_safety_and_readiness/emergency_contingency_and_show_stop_plan.json` | authority | Stop authority; evacuation; fire/medical/weather; power/system failure; missing performer; misfire; restart/cancel criteria | Supporting standard `SAFE-01`; Cue Book; rig emergency states |
| `04_operations_safety_and_readiness/emergency_state_registry.json` | registry | Visual blackout; work light; projection black/hold; fog/strobe off; music stop; reset; performer-safe look | Root README; rig/inventory; scene profiles |
| `04_operations_safety_and_readiness/incident_and_near_miss_register.json` | record | Incident facts; response; notifications; evidence; corrective actions; closure | Supporting standard; maintenance requirements; future reports |

## 04.02 Readiness, schedules, and checklists

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `04_operations_safety_and_readiness/production_schedule.json` | plan | Load-in; rehearsal; performance; breaks; load-out; responsible owners; dependencies; status | `SCHED-01`; center rehearsal/launch seeds; event schedule |
| `04_operations_safety_and_readiness/department_checklist_catalog.json` | procedure | Preset/pre-show/post-show/shutdown items by department; evidence and sign-off requirements | `CHECK-01`; Cue Book checklists; rig procedures |
| `04_operations_safety_and_readiness/readiness_gate_catalog.json` | authority | Gate families; evidence shape; pass/block rules; status vocabulary; show-ready computation | `center/data/release_gate_matrix.php`; owner readiness docs |
| `04_operations_safety_and_readiness/readiness_assessment.json` | record | Gate instance; scope/release; evidence; finding; blocker; approver; expiry | Center release gates/integrity seeds; future inspections |
| `04_operations_safety_and_readiness/rehearsal_plan.json` | plan | Rehearsal type; scope; objectives; source revision; participants; prerequisites; safety limits | Center rehearsal prep; master game plan; Cue Book |
| `04_operations_safety_and_readiness/rehearsal_report.json` | record | Timing/cue issues; injuries; decisions; assigned actions; due dates; distribution | Supporting standard `REP-01`; center rehearsal workflow |
| `04_operations_safety_and_readiness/performance_report.json` | record | Performance facts; cue/equipment/costume/prop issues; incidents; changes; follow-up | Supporting standard `REP-02`; actual timing log |

## 04.03 Department readiness

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `04_operations_safety_and_readiness/wardrobe_plot_and_quick_change_plan.json` | procedure | Costume pieces by performer/set; presets; locations; dressers; change sequence/time; repair/laundry/reset/backup | Supporting standard `WARD-01`; master game plan |
| `04_operations_safety_and_readiness/prop_and_performer_equipment_plan.json` | procedure | Preset; inspection; user; handoff; onstage/removal/return; consumables; reset; damage procedure | Supporting standard `PROP-01`; asset inventories |
| `04_operations_safety_and_readiness/operator_output_catalog.json` | view | Printable/electronic run sheets, cue sheets, checklists, emergency sheets, labels | Owner operator-output modules; controlled source documents |

---

# 05 — Assets, Media, and Rights

This section separates asset existence and technical metadata from intended use,
rights status, transformations, and publication approval.

## 05.01 Asset authority

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `05_assets_media_and_rights/asset_registry.json` | registry | Asset ID; type; physical/digital; category; description; traits; location reference; status; priority | Root asset encyclopedia standard; inventories; owner asset modules |
| `05_assets_media_and_rights/physical_asset_registry.json` | registry | Equipment, costume, prop, scenic, signage, cable, case, and consumable records; condition/location/custody | Master game plan inventories; granular fixtures; production plans |
| `05_assets_media_and_rights/digital_asset_registry.json` | registry | Photo/video/audio/graphic/document/font/project/workspace records; format/dimensions/duration/hash/storage | Public assets; image inventories; video/audio plans; manuals |
| `05_assets_media_and_rights/asset_relationship_registry.json` | registry | Source/derivative; replacement; campaign use; page placement; cue use; equipment evidence; duplicate | Layer metadata; site data; linked records/files |
| `05_assets_media_and_rights/asset_naming_and_storage_policy.json` | authority | Naming; folders; checksums; versions; masters/exports; backup; retention | Master game plan; marketing specs; storage READMEs |

## 05.02 Media production and intake

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `05_assets_media_and_rights/media_intake_register.json` | record | Intake source; uploader; acquisition date; files; consent/rights claim; review; quarantine; destination | Owner/center media-intake modules; layer uploads |
| `05_assets_media_and_rights/media_edit_and_derivative_register.json` | record | Source asset; crop/retouch/resize/color/mask; tool; output; reviewer; replacement lineage | Marketing/image docs; layer replacements; uploaded PNGs |
| `05_assets_media_and_rights/media_placement_registry.json` | registry | Asset-to-route/section/campaign/platform/cue placement; alt text; focal point; active dates | `site_data.php`; layer state; page sections; campaign plans |
| `05_assets_media_and_rights/media_production_requirements.json` | plan | Missing shots; retakes; generation requests; dimensions; safe zones; formats; acceptance criteria | Image inventories, requests, mockup specs, prompt contracts |

## 05.03 Rights and clearance

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `05_assets_media_and_rights/rights_claim_and_clearance_registry.json` | registry | Asset/content claim; owner/source; license/consent; permitted uses; territory/term; evidence; status | Style/rights guardrails; owner safety queue; asset metadata |
| `05_assets_media_and_rights/tribute_affiliation_guardrails.json` | authority | Independent-tribute statements; prohibited implications; reference-only material; review-required categories | Root/public standards; style guides; active disclaimers |
| `05_assets_media_and_rights/publication_clearance_register.json` | record | Asset/copy/package; rights, content, safety, accessibility approvals; approvers; expiry | Release gates; marketing/public-site review workflows |

---

# 06 — Brand, Content, and Accessibility

This section centralizes public identity and reusable content while keeping event
facts referenced from Section 01 rather than repeated as editable prose facts.

## 06.01 Brand system

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `06_brand_content_and_accessibility/brand_identity.json` | authority | Naming/display rules; positioning; promise; personality; independent-tribute framing | Style guide; brand-story inventory; project identity settings |
| `06_brand_content_and_accessibility/brand_voice.json` | authority | Voice pillars; tone modes; sentence rhythm; vocabulary; controlled/avoided phrases; CTA style | Brand-story inventory; style guide; brand-voice settings; active copy |
| `06_brand_content_and_accessibility/visual_design_system.json` | authority | Color tokens/roles; typography; spacing/layout; chrome/fire/black motifs; components; responsive/accessibility rules | Style guides/settings; public CSS; fonts; website docs |
| `06_brand_content_and_accessibility/brand_story_registry.json` | registry | Story arc ID; audience; purpose; proof points; emotional arc; safe copy seeds; required fact refs | Brand-story settings/inventory; website and campaign narratives |
| `06_brand_content_and_accessibility/message_and_claim_registry.json` | registry | Reusable headline/claim/CTA/disclaimer; approval; evidence/fact refs; channels; expiry | Active language JSON; language variants; marketing and public copy |

## 06.02 Content model and copy

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `06_brand_content_and_accessibility/content_token_registry.json` | registry | Stable token ID; approved text; route/section context; audience; status; source; change history | 526-entry active language JSON; prior language variants; language map |
| `06_brand_content_and_accessibility/practical_fact_block_registry.json` | view | Generated public fact blocks referencing event/venue/logistics/safety records | Language groups; campaign shared data; event registry |
| `06_brand_content_and_accessibility/disclaimer_and_advisory_registry.json` | registry | Affiliation, safety, privacy, consent, accessibility, availability advisories; placement rules | Public language/pages; style guardrails; forms |
| `06_brand_content_and_accessibility/content_approval_and_localization_policy.json` | authority | Copy ownership; factual review; tone review; safety/rights review; locale/version/fallback rules | Language usage policy; owner roles; release gates |

## 06.03 Accessibility and audience utility

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `06_brand_content_and_accessibility/accessibility_requirements.json` | authority | Semantic structure; keyboard/focus; contrast; motion; images/alt text; forms/errors; responsive baseline | Style/brand inventories; CSS guide; mobile success guide; active code |
| `06_brand_content_and_accessibility/audience_safety_advisory.json` | view | Public presentation of sound, bright light, fog, flashing patterns, access, and planning information | Public language/pages; hazards; event logistics |

---

# 07 — Marketing, Sales, and Booking

This section owns campaign strategy, channel/placement requirements, asset jobs,
booking workflows, and performance measurement without duplicating public facts.

## 07.01 Audience and funnel strategy

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `07_marketing_sales_and_booking/audience_segment_registry.json` | registry | Segment; need/state; geography; accessibility considerations; proof; channel fit; exclusions | Master game plan customer profiles; campaign and website plans |
| `07_marketing_sales_and_booking/funnel_stage_registry.json` | registry | Awareness, interest, consideration, conversion, retention/nurture; objectives; CTAs; evidence | First-run campaign; mockup specs/templates; marketing settings |
| `07_marketing_sales_and_booking/channel_registry.json` | registry | Platform/channel; placements; formats; CTA defaults; tracking; ownership; review needs | Marketing inventory/prompts; marketing-channel settings |
| `07_marketing_sales_and_booking/campaign_registry.json` | registry | Campaign ID; objective; event; audience; funnel; dates; budget status; assets; channels; approvals | First-run campaign Markdown/JSON; generator script |
| `07_marketing_sales_and_booking/campaign_piece_registry.json` | registry | Five-piece and future creative jobs; message; layout; asset requirements; variants; release status | Funnel campaign; production briefs; mockup specifications |

## 07.02 Creative production and distribution

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `07_marketing_sales_and_booking/placement_specification_registry.json` | registry | Dimensions/aspect; safe zones; file limits; copy limits; platform use; freshness date | Marketing inventories, prompt files, shared mockup data |
| `07_marketing_sales_and_booking/creative_brief_registry.json` | registry | Brief ID; piece/placement; composition; copy token refs; required assets; exclusions; acceptance | Mockup specs; Facebook briefs; prompt templates |
| `07_marketing_sales_and_booking/prompt_template_registry.json` | registry | Generation prompt contract; variables; negative constraints; stage/channel adaptations; version | Prompt templates and platform prompt files |
| `07_marketing_sales_and_booking/campaign_release_registry.json` | release | Approved creative package; exact assets/copy/specs; channels; active window; approvers | Campaign records; publication clearance; exports |
| `07_marketing_sales_and_booking/marketing_calendar.json` | plan | Campaign/piece schedule; dependencies; channel distribution; milestones; owner; status | Campaign rollout; launch tasks; event date |
| `07_marketing_sales_and_booking/measurement_and_tracking_plan.json` | plan | Goals; events; UTM/naming; platform metrics; privacy constraints; reporting cadence | Website/marketing plans; integration settings |

## 07.03 Booking and sales

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `07_marketing_sales_and_booking/booking_product_and_offer.json` | authority | Bookable show description; production options; verified capabilities; exclusions; inquiry CTA | Master game plan; public/press copy; technical plans |
| `07_marketing_sales_and_booking/booking_contact_registry.json` | registry | Organization/person references; contact stage; owner; last/next action; privacy/access | Center booking-contact seed; contact forms; future tracker |
| `07_marketing_sales_and_booking/booking_pipeline.json` | record | Opportunity; venue; stage; requirements; probability; actions; decision; archive | Master game plan booking tracker; center workflow |
| `07_marketing_sales_and_booking/press_kit_manifest.json` | index | Approved biography, photos, fact sheet, technical summary, contact, disclaimers, download assets | Press route; asset registry; future EPK |
| `07_marketing_sales_and_booking/technical_rider.json` | view | Generated buyer-facing requirements from approved venue/technical/safety records | Master game plan; venue advance; technical release |

---

# 08 — Public Website and Audience Data

This section describes the public product as routes, sections, content bindings,
media placements, forms, releases, and privacy-governed runtime observations.

## 08.01 Information architecture

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `08_public_website_and_audience_data/public_route_registry.json` | registry | Route ID/path; purpose; audience; conversion goal; status; legacy/active; dependencies | Proto README; website inventory/SSOT; active and legacy route files |
| `08_public_website_and_audience_data/page_section_registry.json` | registry | Section ID; route; type; order; visibility; required facts/copy/assets; component | `page_sections.json`; view helpers; active pages; layer controls |
| `08_public_website_and_audience_data/navigation_registry.json` | registry | Menu/footer link IDs; labels via content refs; destination; order; visibility | Active public view/site data; route docs |
| `08_public_website_and_audience_data/page_content_binding_registry.json` | registry | Route/section/field to content token, fact, asset, CTA, advisory, and form refs | Active PHP; language map; site data; page sections |
| `08_public_website_and_audience_data/public_site_architecture.json` | authority | Document root; shared renderer; asset behavior; static-effect posture; fallback behavior; legacy boundary | Proto README; app/view; website docs; active assets |

## 08.02 Forms, consent, and audience records

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `08_public_website_and_audience_data/form_definition_registry.json` | schema | Lead/inquiry forms; fields; validation; CSRF; messages; destinations; consent refs | Form handlers; view; SQL; language tokens |
| `08_public_website_and_audience_data/consent_and_privacy_policy.json` | authority | Purpose; notice; lawful/approved use; retention; access; deletion; mail behavior; sensitive fields | Forms/copy; storage docs; data-classification policy |
| `08_public_website_and_audience_data/restricted_audience_submission_register.json` | record | Restricted lead/inquiry records or external secure references; consent; status; provenance | Runtime leads; future DB; booking contacts |
| `08_public_website_and_audience_data/audience_submission_metrics.json` | view | Redacted counts, delivery/failure status, time buckets, conversion summaries | Lead and mail-failure runtime records; analytics plan |
| `08_public_website_and_audience_data/mail_delivery_and_recovery_log.json` | record | Restricted delivery attempt/failure metadata; recovery status; no public message bodies | Mail failures; mailer/form storage behavior |

## 08.03 Layer editing and publication

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `08_public_website_and_audience_data/site_layer_definition_registry.json` | schema | Structure/copy/media/style/behavior/review layers; allowed controls; validation; ownership | Layer-control PHP; snapshot doc; editor guide |
| `08_public_website_and_audience_data/site_layer_draft_state.json` | plan | Current editable controls, order, visibility, replacements, labels, overlays, notes | Current state file; editor save endpoint |
| `08_public_website_and_audience_data/site_publication_release.json` | release | Immutable published routes/sections/copy/assets/layers; checksums; gates; publication time | Published layer file; language release; active files |
| `08_public_website_and_audience_data/site_layer_change_log.json` | record | Ordered changes from 22 backups; actor/reference; field deltas; assets; publish events | Timestamped backups; state/published history |
| `08_public_website_and_audience_data/public_site_launch_readiness.json` | record | Route/content/media/form/accessibility/rights/safety/deployment checks and blockers | Launch checklist; release gates; responsive guide |

---

# 09 — Owner Admin and CMS

This section synthesizes the owner application generations into one controlled
product and workflow model. UI-specific navigation remains a view over canonical
module and workflow definitions.

## 09.01 Owner application model

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `09_owner_admin_and_cms/owner_application_registry.json` | registry | App/rendition ID; purpose; status; document root; data sources; persistence; limitations; supersession | All owner/center READMEs/configs |
| `09_owner_admin_and_cms/owner_module_registry.json` | registry | Module ID; canonical purpose; data dependencies; actions; readiness; source rendition lineage | All navigation/page files; module blueprints; center system map |
| `09_owner_admin_and_cms/owner_navigation_view.json` | view | Role-appropriate grouping/order/labels for modules | Navigation datasets across renditions |
| `09_owner_admin_and_cms/universal_owner_record_model.json` | schema | Required fields; statuses; roles; visibility; rights/safety; readiness; links; provenance; timeline rules | Existing master index; owner schemas; center schema |
| `09_owner_admin_and_cms/owner_role_and_permission_model.json` | authority | Developer/Owner/other roles; view/edit/approve/publish rights; authentication prerequisites | Center/owner docs; future auth plan; role registries |

## 09.02 Work management and integrity

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `09_owner_admin_and_cms/priority_board_model.json` | schema | Columns; movement semantics; card fields; blocker/dependency rules; filters | Center priority board seed/model; owner boot plan |
| `09_owner_admin_and_cms/priority_item_registry.json` | registry | Work item; lane/status; priority; owner; due date; evidence; dependencies; linked decisions/gates | Center seed cards; task/launch data; owner modules |
| `09_owner_admin_and_cms/task_and_launch_registry.json` | registry | Task/lane; launch scope; acceptance; owner; dependency; evidence; status | Center task seed; launch checklist; project plan |
| `09_owner_admin_and_cms/integrity_rule_catalog.json` | schema | Duplicate IDs; required fields; timeline syntax; links; sources; status combinations; release checks | Second/third integrity code; center integrity seeds/schema |
| `09_owner_admin_and_cms/integrity_finding_register.json` | record | Rule; affected record; severity; evidence; owner; remediation; closure | Generated integrity pages/validation; future compendium validation |

## 09.03 CMS contracts and controlled editing

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `09_owner_admin_and_cms/cms_editing_contract_registry.json` | authority | Editable public field; canonical owner; source target; validation; preview; gate; rollback; prohibited direct writes | Center proto editing contracts; CMS adapter plan; layer controls |
| `09_owner_admin_and_cms/cms_draft_registry.json` | plan | Proposed content/media/structure edits; source refs; preview; status; reviewers; release target | Website CMS draft modules; layer draft state |
| `09_owner_admin_and_cms/public_release_gate_policy.json` | authority | Public/private, factual, content, rights, safety, accessibility, integrity, backup, approval gates | Center release policy/matrix; owner limitations |
| `09_owner_admin_and_cms/persistence_backup_and_recovery_plan.json` | plan | Canonical storage; overlays; uploads; exports; cache; DB/API migration; backups; retention; restore tests | Center storage READMEs/future plan; arena runtime strategy; proto storage |
| `09_owner_admin_and_cms/authentication_and_audit_plan.json` | plan | Identity; sessions; authorization; audit events; privileged operations; deployment prerequisites | Center future auth plan; owner prototype limitations |

---

# 10 — Developer, Data, and Integrations

This section owns implementation contracts and reproducible data movement. It
does not own event or show facts.

## 10.01 Repository and application architecture

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `10_developer_data_and_integrations/repository_component_registry.json` | registry | Component ID; directory; purpose; status; dependencies; active/legacy/experimental designation | Repository inventory; all READMEs; center migration reports |
| `10_developer_data_and_integrations/application_route_and_entrypoint_registry.json` | registry | App; entry point; route; document root; request method; access class; legacy status | Routers and page files across apps |
| `10_developer_data_and_integrations/deployment_profile_registry.json` | registry | App profile; runtime; document root; writable paths; config; database; limitations; health check | READMEs/config/storage docs; diagnostics (redacted) |
| `10_developer_data_and_integrations/developer_workflow.json` | procedure | Build conventions; safe-edit rules; validation; formatting; freshness checks; source sync | Developer settings; boot prompts; editor guides |

## 10.02 Data contracts and migrations

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `10_developer_data_and_integrations/data_source_adapter_registry.json` | registry | Adapter ID; source/target; format; read/write policy; normalization; errors; privacy | SSOT loaders; JSON repository; DB/form/language/layer services |
| `10_developer_data_and_integrations/legacy_and_duplicate_migration_plan.json` | plan | Duplicate family; selected authority; diff method; mapping; archive; redirect; validation | Four SSOT locations; language variants; legacy proto routes; owner renditions |
| `10_developer_data_and_integrations/data_transformation_registry.json` | registry | Transformation ID; input schema; output schema; field map; loss notes; code/tool; tests | Existing paired JSON generation; normalization helpers; future extractors |
| `10_developer_data_and_integrations/generated_artifact_policy.json` | authority | Index/view/export/cache classification; reproducibility; checksums; no direct edit; retention | Fixture index; JSON summaries; exports/cache/storage plans |
| `10_developer_data_and_integrations/validation_suite_registry.json` | registry | Validation ID; command/tool; scope; expected result; severity; release-gate relation | Fixture/profile schemas; smoke/center validation; integrity checks |

## 10.03 Integrations and local AI workflow

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `10_developer_data_and_integrations/integration_registry.json` | registry | CMS, forms, database, mail, analytics, ads, media storage, QLC+, and local AI integrations; status; owner; secrets boundary | Integration settings; website/admin plans; app code |
| `10_developer_data_and_integrations/model_and_tool_routing_policy.json` | authority | Task classes; approved model/tool tier; local/remote; privacy; freshness; fallback; review date | Qwen routing guide/JSON; developer settings; prompts |
| `10_developer_data_and_integrations/secret_and_configuration_reference.json` | registry | Secret/config ID; purpose; environment; owner; rotation; storage reference—never secret value | Config files; deployment profiles; security notes |

---

# 11 — Records, History, and Audit

This section preserves what occurred without allowing observations to silently
change approved plans.

## 11.01 Operational history

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `11_records_history_and_audit/equipment_inspection_and_maintenance_log.json` | record | Inspection; test; service; fault; damage; out-of-service; next due; evidence; closure | Fixture maintenance fields; inventory template; supporting `MAINT-01` |
| `11_records_history_and_audit/show_instance_registry.json` | registry | Rehearsal/performance instance; event; program/timing/technical release revisions; status | Cue Book; reports; release records |
| `11_records_history_and_audit/show_issue_and_action_log.json` | record | Cue/equipment/costume/prop/safety issue; affected instance; action; owner; due; closure | Rehearsal/performance reports; center priorities |
| `11_records_history_and_audit/release_history.json` | index | All program, technical, website, campaign, and compendium releases; checksums; supersession | Release documents; publish history; revisions |

## 11.02 Repository and extraction history

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `11_records_history_and_audit/source_snapshot_registry.json` | record | Source path/hash/date; extraction batch; tool/version; sensitivity; archive reference | Source registry; Git; duplicate study |
| `11_records_history_and_audit/extraction_run_log.json` | record | Run ID; inputs; parsers; warnings; outputs; validation; reviewer | Future extraction tooling; DOCX/PDF/JSON/PHP extraction |
| `11_records_history_and_audit/historical_note_register.json` | record | Note ID; original source; claims/topics; linked decisions/conflicts; disposition | Numbered KISS notes; compiled status report; boot logs |
| `11_records_history_and_audit/deprecated_and_superseded_artifact_register.json` | registry | Old path/document; replacement; reason; last applicable scope; archive rule | Legacy routes; owner renditions; old SSOT bundles/language files |

---

# 90 — Schemas and Controlled Vocabularies

Schemas should be modular. Business documents reference them by version rather
than embedding slightly different field definitions.

## 90.01 Core schemas

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `90_schemas_and_vocabularies/document.schema.json` | schema | Common document envelope and revision controls | Supporting standard; existing SSOT envelopes |
| `90_schemas_and_vocabularies/entity_record.schema.json` | schema | Stable ID, lifecycle, provenance, links, confidence, timestamps | Master index universal fields; center/owner schemas |
| `90_schemas_and_vocabularies/source_reference.schema.json` | schema | Path/source ID, hash, revision, location, extraction method, quoted/derived ranges | Provenance schema; source-document blocks |
| `90_schemas_and_vocabularies/conflict.schema.json` | schema | Claim scope, candidates, authorities, resolution, approval | Conflict register design |
| `90_schemas_and_vocabularies/release.schema.json` | schema | Release scope, included revisions/hashes, gates, approval, supersession | DOC control; site publish state; release matrices |

## 90.02 Domain schemas

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `90_schemas_and_vocabularies/program_event.schema.json` | schema | PGM/TECH/FIN identity, order, timing, status, source refs | Cue Book |
| `90_schemas_and_vocabularies/timeline_moment.schema.json` | schema | Timeline families, GEN, links, classification/status | Timeline registry/settings |
| `90_schemas_and_vocabularies/department_cue.schema.json` | schema | Cue ID, program ref, trigger, action, timing, confirmation, safety | Supporting standard department templates |
| `90_schemas_and_vocabularies/equipment_type.schema.json` | schema | Type, modes, channels, capabilities, manuals, safe constraints | Fixture types; vendor/manual data |
| `90_schemas_and_vocabularies/equipment_instance.schema.json` | schema | Identity, geometry, DMX, power, links, maintenance, revision | Existing fixture schema and 59 records |
| `90_schemas_and_vocabularies/scene_profile.schema.json` | schema | Profile values/layers/view/patch compatibility/verification | Existing profile schema/scenes |
| `90_schemas_and_vocabularies/asset.schema.json` | schema | Physical/digital asset metadata, status, uses, rights, edits | Asset encyclopedia and taxonomies |
| `90_schemas_and_vocabularies/content_token.schema.json` | schema | Token, text/version, placement, approval, fact/claim refs | Language datasets |
| `90_schemas_and_vocabularies/campaign.schema.json` | schema | Campaign/piece/funnel/channel/placement/release relationships | Marketing JSON/specifications |
| `90_schemas_and_vocabularies/public_route_section.schema.json` | schema | Routes, sections, bindings, visibility, order | Page sections/routes/layers |
| `90_schemas_and_vocabularies/form_submission.schema.json` | schema | Form fields, consent, privacy, status, secure storage reference | Forms/SQL/runtime data |
| `90_schemas_and_vocabularies/owner_work_item.schema.json` | schema | Priority/task/gate/decision/evidence/dependency fields | Center data models |
| `90_schemas_and_vocabularies/inspection_report.schema.json` | schema | Scope, checklist, finding, evidence, sign-off, corrective action | Supporting standard; maintenance/readiness |

## 90.03 Vocabulary registries

| Proposed file | Class | Component and sub-components | Principal source families |
|---|---|---|---|
| `90_schemas_and_vocabularies/status_vocabularies.json` | authority | Document, content, readiness, rights, safety, public/private, maintenance, decision, release statuses | All owner schemas/status options; DOCX vocabularies |
| `90_schemas_and_vocabularies/id_namespace_registry.json` | authority | Document IDs, PGM/TECH/FIN, Timeline, fixture, asset, cue, event, person, source, decision namespaces | Cue Book; Timeline registry; fixture data; controlled register |
| `90_schemas_and_vocabularies/relationship_type_registry.json` | authority | Reference, contains, derived-from, supersedes, blocks, depends-on, used-by, evidence-for, synchronized-with | Center schema edges; JSON relationships |
| `90_schemas_and_vocabularies/role_vocabulary.json` | authority | Project, department, owner/admin, safety, approval, audience roles | DOCX codes; owner roles; RACI |
| `90_schemas_and_vocabularies/asset_taxonomy.json` | authority | Asset types/categories/subcategories, physical/digital, lifecycle, use | Existing asset taxonomy; inventories |
| `90_schemas_and_vocabularies/channel_and_placement_vocabulary.json` | authority | Marketing channels, placements, funnel stages, CTA types | Marketing settings/inventories |

---

# 99 — Indexes, Views, and Exports

These files make the compendium usable without becoming competing truth.

## 99.01 Generated indexes

| Proposed file | Class | Component and sub-components | Generated from |
|---|---|---|---|
| `99_indexes_views_and_exports/all_records_index.json` | index | Record ID, type, title, status, source document, search terms | Every canonical registry/record |
| `99_indexes_views_and_exports/timeline_index.json` | index | Timeline/program/department cue relationships and unresolved mappings | Section 02 registries |
| `99_indexes_views_and_exports/equipment_patch_index.json` | index | Fixture/type/address/zone/group/test summary and collision findings | Section 03 registries |
| `99_indexes_views_and_exports/asset_usage_index.json` | index | Asset locations, derivatives, placements, campaigns, cues, rights status | Section 05 and placement data |
| `99_indexes_views_and_exports/source_coverage_index.json` | index | Source file to extracted documents/records; ignored/redacted reason; extraction completeness | Source/provenance registries |
| `99_indexes_views_and_exports/open_work_index.json` | index | Questions, conflicts, blockers, integrity findings, decisions, corrective actions | Sections 00, 04, 09, and 11 |

## 99.02 Human-readable views and controlled exports

| Proposed file | Class | Component and sub-components | Generated from |
|---|---|---|---|
| `99_indexes_views_and_exports/master_compendium.md` | view | Human-readable table of contents and executive orientation | Manifest and approved authority files |
| `99_indexes_views_and_exports/show_control_book.md` | view | Approved program, timing, calling, department cue crosswalk, checklists | Sections 02–04 release data |
| `99_indexes_views_and_exports/technical_rig_book.md` | view | Equipment, patch, groups, geometry, recipes, procedures, safety | Section 03 approved release |
| `99_indexes_views_and_exports/public_facts_and_copy_book.md` | view | Event facts, approved tokens, advisories, claims, placements | Sections 01, 06, and 08 |
| `99_indexes_views_and_exports/owner_operations_book.md` | view | Modules, priorities, gates, decisions, workflows, CMS contracts | Section 09 |
| `99_indexes_views_and_exports/booking_and_press_packet.md` | view | Approved booking offer, fact sheet, press assets, rider, contacts | Sections 01, 05, and 07 |
| `99_indexes_views_and_exports/redacted_repository_data_dictionary.md` | view | Documents, entities, fields, vocabularies, relationships, sensitivity | Manifest and Section 90 schemas |

---

## 6. Dependency and ownership rules

The future scaffold should enforce these directional dependencies:

1. Schemas and vocabularies in `90` validate all business documents.
2. Governance in `00` controls sources, revisions, conflicts, approvals, and
   propagation.
3. Project/event/people facts in `01` are referenced by show, marketing, website,
   and booking documents.
4. Program identity and timing in `02` are referenced—never independently
   rewritten—by technical cues and operations.
5. Equipment and geometry in `03` are referenced by safety, assets, cues, rider,
   maintenance, and releases.
6. Operations and safety in `04` may block any release regardless of creative or
   timing readiness.
7. Asset existence in `05` is separate from brand guidance in `06`, campaign use
   in `07`, and website placement in `08`.
8. Owner workflows in `09` edit or approve canonical documents through explicit
   contracts; UI arrays and cards are not themselves canonical domain data.
9. Developer documents in `10` define mechanics, not project facts.
10. Historical records in `11` may propose changes but cannot mutate authorities
    without a controlled decision/change record.
11. Everything in `99` is generated and disposable; it must be reproducible from
    upstream documents.

## 7. What should not become standalone canonical SSOT documents

The following should be retained as sources, evidence, code, or generated output
rather than promoted verbatim:

- rendition-local copies of the existing 16-file SSOT bundle;
- legacy public route copies when active `proto/public/` behavior is authoritative;
- the generated fixture index as an equipment authority;
- empty current layer-state collections without their historical context;
- raw lead values, mail bodies, personal contact data, secrets, and environment
  diagnostics in unrestricted compendium files;
- CSS/JS/PHP implementation details that do not express approved policy;
- prompt prose as proof that a requested feature or asset was implemented;
- marketing prompt variants as evidence that final creative assets exist;
- plans, mockups, placeholder READMEs, and open questions as completed work;
- raw note claims without provenance, verification, and disposition; and
- generated Markdown books as independently editable sources.

## 8. Recommended scaffolding phases

### Phase A — Control plane

Create `00`, `90`, and the empty manifest/source/conflict/provenance structures.
Assign stable document and source IDs before copying any facts.

### Phase B — Core show truth

Create `01`, `02`, the essential equipment/DMX/geometry documents in `03`, and
the core safety authority in `04`. Extract the two authoritative DOCX documents
first and preserve unresolved values and both timing profiles.

### Phase C — Public and asset truth

Create `05` through `08`. Reconcile the four language datasets, active PHP
bindings, public assets, route copies, and layer history. Apply privacy and rights
controls before runtime/media extraction.

### Phase D — Owner and developer control

Create `09` and `10`, synthesizing rather than copying the owner renditions.
Formalize adapters, edit boundaries, releases, validation, and migrations.

### Phase E — Historical migration and generated views

Create `11` and `99`, migrate reports/logs/backups as immutable records, then
generate indexes and human-readable books from approved canonical documents.

## 9. Acceptance criteria for the later scaffold

The scaffolding pass will be complete when:

- every proposed path exists with a document-control envelope and schema link;
- every file has a unique document ID, class, owner, visibility, and status;
- the manifest contains all documents and dependency edges;
- sensitive documents are segregated and contain no copied secret/PII values;
- generated indexes/views are clearly marked and reproducible;
- controlled DOCX IDs and Timeline/program namespaces have explicit crosswalks;
- no deployment bundle or runtime snapshot has been silently selected as
  canonical;
- conflict and open-question placeholders exist before extraction begins; and
- validation can distinguish an empty scaffold from an approved factual record.

## 10. Inventory result

The proposed compendium contains **14 major sections** and **209 purpose-specific
authority, registry, plan, procedure, release, record, schema, index, and view
documents**. The exact file count may be adjusted during scaffolding if schemas
demonstrate that two adjacent registries should share a payload, but the
authority boundaries and component coverage in this catalog should remain
intact. This structure is the recommended basis for the next folder/file
scaffolding instruction.
