# 03_technical_systems_and_stage — Technical Systems and Stage

> **PARTIAL REVIEW SECTION — CONTROLLED APPROVAL PENDING**

This folder was generated from
`extract/ssot_compendium_document_inventory.md`. It contains ten review-ready equipment/geometry authorities and registries and 19 scaffold leaves across 29
planned documents (authority: 1, plan: 4, procedure: 8, registry: 14, release: 1, view: 1). The equipment evidence and coordinate, pavilion, stage, scaffold, zone, and layer candidates are provisional, unverified, inactive, and not approval, configuration, survey, clearance, structural, load, or rigging authority. Do not treat review content or an empty shell as approved.

## Planned documents

- `equipment_type_catalog.json` — `registry` — Fixture/device families; manufacturer/model; category; capabilities; supported modes; manual references.
- `equipment_instance_registry.json` — `registry` — Asset/fixture ID; type; tag/serial; status; physical role; verification; maintenance links.
- `vendor_document_registry.json` — `registry` — Manual ID; vendor/model applicability; revision; source file; extracted claims; supersession.
- `equipment_capability_and_mode_catalog.json` — `registry` — Channel modes; parameter ranges; defaults/home; standalone modes; avoided modes; safe constraints.
- `dmx_universe_registry.json` — `registry` — Universe IDs; protocol; size; interface/node; status; ownership.
- `dmx_patch_plan.json` — `plan` — Instance ID; universe; start/end; mode; footprint; overlap exceptions; power/control source; test status.
- `lighting_group_registry.json` — `registry` — Logical groups; membership references; stage role; QLC+ naming.
- `lighting_recipe_catalog.json` — `procedure` — Direct color/value recipes; movement looks; blackout/work-light/audience looks; applicability.
- `lighting_cue_list.json` — `procedure` — LX cue IDs; linked program/timeline IDs; trigger; look; fades/follows; groups; overrides; warnings.
- `lighting_control_configuration.json` — `plan` — QLC+ fixture definitions; function names; virtual console; outputs; wireless; backups; patch revision.
- `lighting_test_and_recovery_procedures.json` — `procedure` — Bench tests; fixture tests; wrong color/no response; unexpected movement; output failure; fallback state.
- `coordinate_system.json` — `authority` — Units; origin; axes; audience/stage orientation; precision; measurement method.
- `pavilion_geometry.json` — `registry` — Dimensions; roof; cradle; masking; verified status; evidence.
- `stage_geometry.json` — `registry` — Main dimensions; rear platform; center transition; octagon; audience floor; finish; verification.
- `scaffold_and_rigging_geometry.json` — `registry` — Scaffold dimensions; towers; rails; position; material; verification; load-data references.
- `stage_zone_registry.json` — `registry` — Zone IDs; bounds/anchors; purpose; access; hazard/clearance properties.
- `stage_layer_registry.json` — `registry` — Visualization/operational layers; visibility; order; domain; ownership.
- `stage_plot.json` — `view` — Generated overhead layout of verified geometry, equipment, traffic, cable paths, changes, exits, and fire lanes.
- `deck_preset_and_scene_change_plan.json` — `procedure` — Items; presets; routes; movers; timing; spikes; handoffs; clearances; reset; contingency.
- `power_distribution_plan.json` — `plan` — Circuits; loads; distribution; isolation; grounding; protection; cable routes; energize/shutdown.
- `communications_plan.json` — `plan` — Headsets/radios; channels; call signs; cue-light meanings; recipients; backups; emergency comms.
- `audio_system_and_cue_plan.json` — `procedure` — Playback assets/versions; routing; levels; microphones; monitoring; fades; backups; recovery.
- `video_projection_system_registry.json` — `registry` — Displays/projectors/screens; destinations; resolution/aspect; layers/masks; control; backups.
- `video_media_cue_list.json` — `procedure` — Media asset; linked program ID; trigger; destination; loop/hold/fade; fail state; screen coordination.
- `automation_rigging_cue_and_safety_plan.json` — `procedure` — Movement; limits; loads; operators; spotters; interlocks; E-stops; abort/recovery.
- `effects_device_registry.json` — `registry` — Fog, strobe, and other effect devices/materials; capabilities; approvals; inspection state.
- `special_effects_cue_and_safety_plan.json` — `procedure` — Effect cue; trigger; settings/quantity; duration; zone/clearance; warning; shutdown; cleanup.
- `scene_profile_registry.json` — `registry` — Profile ID/type; fixture values; layers; camera/view; intended use; verification; patch compatibility.
- `technical_configuration_release.json` — `release` — Approved patch, geometry, control config, scene versions, software/workspace version, checksums.

## Current validation and next dependency

Run `python3 extract/scripts/validate_compendium.py` to verify the prior equipment invariants plus explicit coordinate convention and transformation rules, 16 evidence-qualified pavilion measurements, 20 evidence-qualified stage measurements, machine-checkable candidate bounds, and absence of invented access, clearance, and structural-capacity facts. Ten Section `03` leaves are review-ready but not approved. Validation also checks 11 scaffold measurements and bounds, empty structural/rigging facts, eight fail-closed zones, and 13 non-operational visualization layers. The next dependency-safe leaf is `stage_plot.json`, followed by the Section `03.02` universe and patch controls.
