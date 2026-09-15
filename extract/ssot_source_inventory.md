# SSOT-Focused Repository Source Inventory

## 1. Purpose and boundary

This is the discovery inventory for a future, new SSOT compendium. It answers
three questions without prematurely selecting facts:

1. Which repository areas contain structured or repeated data that merits SSOT
   documentation?
2. Where is the best available source material for each prospective domain?
3. Which files are originals, derivatives, deployment copies, runtime records,
   historical snapshots, implementation defaults, or supporting evidence?

The audit found **566 files**, all tracked by Git, with no additional untracked
or ignored files in the working tree. The count agrees with the earlier
inventory: root 9, `docs/` 112, `center/` 71, `owner/` 22,
`owner_arena_command/` 51, `secondrendition/` 34, `thirdrendition/` 39,
`proto/` 120, `proto_prob/` 105, `notes/` 2, and `scripts/` 1.

This document inventories SSOT **source value**, not just file type. PHP arrays,
SQL, application copy, images, manuals, and decisions may contain facts even
when they are not named as datasets.

## 2. Discovery status and vocabulary

This file does **not** declare any newly extracted fact canonical. The labels
below describe where to start the later comparison.

| Label | Meaning in this inventory |
|---|---|
| Primary candidate | Best apparent starting source, subject to content-level verification. |
| Corroborating source | Useful for confirmation, gaps, provenance, or conflict detection. |
| Derived copy | A representation or deployment copy that should normally trace to an upstream source. |
| Runtime/history | Operational state or a dated event; preserve as history rather than silently promoting it to policy. |
| Schema/contract | Defines shape, validation, or vocabulary, but does not necessarily prove real-world facts. |
| Exclude/redact | Sensitive, transient, diagnostic, binary, or generated material that needs special handling. |

## 3. Existing authority signals to preserve during extraction

The repository already states an authority hierarchy. The root `README.md`
governs organization; `docs/mastergameplan.md` broad planning;
`docs/timeline_moment_registry.md` Timeline IDs; `docs/cue.txt` the working cue
draft; `docs/inventory_reference.md` DMX inventory; `docs/rig.md` the operational
digest; `docs/styleguide.md` public creative direction; and `docs/prompt.md` and
`docs/knowledge.md` onboarding summaries. Existing authority is evidence, not a
substitute for checking conflicts and freshness.

The existing `docs/ssot/*.json` set is explicitly described as machine-readable
prototype data contracts paired to human-readable documents. Therefore, those
JSON files are high-value extraction aids but must not automatically outrank
their declared source documents. The three rendition-local SSOT sets are
deployment copies and should be compared by checksum before any one is used.

## 4. Prospective SSOT domain register

| Prospective domain | Best sources to study first | Important corroboration | Main reconciliation question |
|---|---|---|---|
| Repository identity and canon | `README.md`; `docs/knowledge.md`; `docs/mastergameplan.md` | `docs/ssot/readme.json`, `knowledge.json`, `mastergameplan.json`; boot prompts | Which statements are current facts versus strategy or session instructions? |
| Event, venue, date, offer, contacts | `proto/docs/language.json`; `proto/app/site_data.php`; active `proto/public/**/*.php` | `language_APPROVED.json`, `language_NEWTIME.json`, `docs/notes/language.json`; public-site docs | Which language version is approved, and which embedded page facts have drifted? |
| Timeline and show flow | `docs/timeline_moment_registry.md`; `docs/cue.txt` | paired JSON; authoritative cue-book DOCX; cue-related UI seeds | Which draft cue seeds have been assigned canonical Timeline IDs? |
| Lighting inventory and DMX patch | `docs/inventory_reference.md`; `proto_prob/data/fixtures/*.json`; `proto_prob/data/global/fixture-types.json` | `docs/rig.md`; vendor PDFs and paired manual JSON; fixture schema/index | Are granular fixture records verified, and where do they conflict with the narrative patch? |
| Stage, pavilion, zones, and geometry | `proto_prob/data/global/{project,pavilion,stage,scaffold,zones,layers,groups}.json` | fixture positions; stage-scene profiles; `docs/rig.md` | Which dimensions/positions are measured, estimated, or prototype-only? |
| Scenes, looks, and safe states | `proto_prob/data/profiles/stage-scenes/*.json`; `docs/inventory_reference.md`; `docs/rig.md` | cue and timeline sources; `profile.schema.json` | Which profiles are executable/verified versus illustrative? |
| Technical operations and safety | `docs/inventory_reference.md`; `docs/rig.md`; authoritative DOCX files | vendor manuals; `docs/mastergameplan.md`; owner safety/release-gate data | Separate equipment facts, procedures, creative intent, and unapproved safety assumptions. |
| Brand identity, voice, and visual system | `docs/styleguide.md`; `docs/brand_story_style_guide_inventory.md`; `docs/ssot/settings/{project_identity,brand_voice,visual_style,brand_stories}.json` | public CSS/copy/images; marketing documents; paired SSOT JSON | Which language is policy, proposal, implementation, or platform adaptation? |
| Marketing campaign and channels | `docs/first_run_marketing_campaign.md`; `docs/marketing_still_image_inventory.md`; funnel specs/templates/prompts | `docs/ssot/first_run_marketing_campaign.json`; generator script; settings | Which campaign assets actually exist, and which files are only production instructions? |
| Public information architecture and copy | `proto/docs/{website_ssot,website_inventory,routes_and_supporting_pages,language.json,page_sections.json}` | `proto/app/*.php`; active public routes; published layer state | Resolve declared copy/route structure against the active rendering implementation. |
| Public media and asset registry | `proto/public/assets/img/README.md`; `proto/app/site_data.php`; image inventory docs | image files; layer-state metadata; upload history | Which assets are approved, owned/cleared, active, uploaded, replaced, or orphaned? |
| Forms, leads, inquiries, and mail | `proto/app/forms/*.php`; `proto/database/*.sql`; `proto/app/form_storage.php` | `proto/storage/**/*.json`; config; contact pages | Define schema without exposing personal data; distinguish planned DB fields from observed runtime records. |
| Site-layer editing and publication state | `proto/docs/site_layer_controls_published.json`; `site_layer_controls_state.json` | snapshot, 22 backups, layer PHP modules, save endpoint | What is current published state, current draft, and immutable history? |
| Owner/admin universal record model | `docs/ssot/master_index.json`; `docs/owner_admin_build_readiness.md`; `docs/owner_site_boot_plan.md` | `owner*/data/*.php`; schemas and record loaders; center decisions | Which rendition’s additions are intentional evolution versus UI-local convenience? |
| Owner modules, workflows, priorities, gates | `center/data/*.php`; `center/docs/*.md`; `center/pages/*.php` | earlier owner renditions; root owner blueprints; prompts/logs | Which seeds are approved operating data, and which are demonstration content? |
| Website-to-owner CMS contract | `center/data/proto_editing_contracts.php`; `center/docs/proto_cms_adapter_plan.md`; `center/docs/public_release_gate_policy.md` | `proto` layer controls; owner CMS draft modules | Define authoritative edit boundaries, gates, provenance, rollback, and publishing ownership. |
| Application architecture and deployment | each app `README.md`, config, bootstrap, router, storage README | boot prompts, center decision reports, SQL | Separate current runnable behavior from future architecture and legacy routes. |
| AI/model routing and developer workflow | `docs/qwen_model_routing.md`; `docs/ssot/settings/developer_workflow.json`; active boot prompt | paired JSON; other prompts | Treat tool/model recommendations as time-sensitive policy, not stable show facts. |
| Provenance, decisions, and audit trail | `center/data/{source_provenance_schema,decision_schema}.php`; center reports | Git history; runtime update metadata; layer publish history | Establish IDs and evidence links without turning narrative reports into current policy. |

## 5. Source-area inventory and SSOT value

### 5.1 Repository root — 9 files

Files: `.gitignore`, `01_Authoritative_Show_Control_and_Performance_Cue_Book.docx`,
`02_Authoritative_Supporting_Production_Documentation_Standard.docx`, `README.md`,
`boot.md`, `boot_edit_admin.md`, `boot_edit_public.md`,
`language_APPROVED.json`, `language_NEWTIME.json`.

**SSOT value:** project identity and declared governance, authoritative production
standards, session workflows, and competing/temporal public-language exports.
The DOCX files require text/table extraction and comparison to Markdown. The two
language files must be compared to `proto/docs/language.json` rather than merged
by filename semantics alone.

### 5.2 Core `docs/` sources — 112 files

#### Canonical and planning candidates — `docs/` (24)

Files: `612870_Manual_170822.pdf`,
`FreedomPAR_StripMini_RGBA_UM_Rev4_ML_WO.pdf`,
`ZQ01082-36PCS-Par-Light-RGB-with-Wireless-Remote-Control.pdf`,
`brand_story_style_guide_inventory.md`, `cue.txt`,
`current_documentation_groundwork_plan.md`, `first_run_marketing_campaign.md`,
`inventory_reference.md`, `just_one_kiss_bolt_on_markup.svg`,
`just_one_kiss_bolt_on_markup_upgraded.svg`, `knowledge.md`,
`marketing_still_image_inventory.md`, `mastergameplan.md`,
`owner_admin_build_readiness.md`, `owner_project_manager_surface_blueprint.md`,
`owner_site_boot_plan.md`, `prompt.md`, `qwen_model_routing.md`, `rig.md`,
`styleguide.md`, `timeline_moment_registry.md`, `website_bolt_on_locations.md`,
`website_bolt_on_screenshot_annotated.svg`, `website_system_plan.md`.

**Best data:** show plan, cue flow, Timeline IDs, technical patch, equipment
behavior, operating doctrine, branding, marketing, owner-system requirements,
and website architecture. PDFs are vendor evidence; SVGs are annotated visual
evidence. Plans and prompts must be classified by status so proposed future work
does not become a current-state fact.

#### Marketing funnel specifications — `docs/marketing_image_mockup_specs/` (9)

Files: `00_shared_mockup_data.md`, `01_awareness_mockup_spec.md`,
`02_interest_mockup_spec.md`, `03_consideration_mockup_spec.md`,
`04_conversion_mockup_spec.md`, `05_retention_nurture_mockup_spec.md`,
`facebook_ad_campaign_production_briefs.md`, `HOW_TO_USE.md`, `README.md`.

**Best data:** shared campaign facts, funnel-stage deliverables, image dimensions,
composition requirements, and Facebook production briefs. Extract reusable
facts separately from creative instructions.

#### Marketing prompt contracts — `docs/marketing_image_prompt_templates/` (7)

Files: `00_shared_template_contract.md`, `01_awareness_prompt_template.md`,
`02_interest_prompt_template.md`, `03_consideration_prompt_template.md`,
`04_conversion_prompt_template.md`, `05_retention_nurture_prompt_template.md`,
`README.md`.

**Best data:** prompt schema, required variables, and funnel-stage creative
contracts. These are workflow SSOT candidates, not proof that an asset exists.

#### Platform prompts — `docs/marketing_image_prompts/` (10)

Files: `bluesky_still_image_prompts.md`, `facebook_meta_still_image_prompts.md`,
`google_ads_still_image_prompts.md`, `instagram_still_image_prompts.md`,
`linkedin_still_image_prompts.md`, `pinterest_still_image_prompts.md`,
`snapchat_still_image_prompts.md`, `tiktok_still_image_prompts.md`,
`x_twitter_still_image_prompts.md`, `youtube_ads_still_image_prompts.md`.

**Best data:** channel-specific variations, placements, copy constraints, and
creative adaptations. Cross-check against marketing-channel settings.

#### Marketing output placeholder — `docs/marketing_images/facebook_meta/` (1)

File: `README.md`.

**SSOT value:** expected output organization and naming; not evidence of a
completed image set.

#### Historical/raw notes — `docs/notes/` (15)

Files: `KISS01.txt`, `KISS02.txt`, `kiss03.txt`, `kiss04.txt`, `kiss05.txt`,
`kiss06.txt`, `kiss07.txt`, `kiss08.txt`, `kiss09.txt`, `kiss10.txt`,
`kiss11.txt`, `kiss12.txt`, `compiled_notes_status_report.md`, `language.json`,
`super_ssot_status_notes_tracking_app.md`.

**SSOT value:** provenance, omitted requirements, conflict discovery, and
historical language. Treat raw notes as claims awaiting confirmation, not as
authority merely because they are older.

#### Session/development prompts — `docs/prompts/` (13)

Files: `ACTIVE_universal_fresh_expert_coding_boot_prompt.md`,
`center_first_full_scaffolding_fresh_expert_coding_prompt.md`,
`center_horizontal_scaffolding_refinement_fresh_expert_coding_prompt.md`,
`center_next_development_completion_fresh_expert_coding_prompt.md`,
`center_owner_answered_scaffolding_fresh_expert_coding_prompt.md`,
`centralized_owner_management_website_super_prompt.md`,
`current_project_fresh_expert_development_boot_prompt.md`,
`full_project_fresh_expert_coding_boot_prompt.md`,
`marketing_campaign_expert_boot_prompt.md`,
`owner_arena_command_fresh_expert_maintenance_prompt.md`,
`owner_site_codebase_boot_prompt.md`, `owner_site_first_rendition_build_prompt.md`,
`proto_public_site_fresh_expert_coding_prompt.md`.

**SSOT value:** design intent, constraints, acceptance criteria, and development
history. Prompts are corroborating sources; implemented behavior must be checked
in code and decisions.

#### Existing machine-readable SSOT — `docs/ssot/` (21)

Files: `ads_specs.md`, `brand_story_style_guide_inventory.json`,
`colorstrip_manual.json`, `cue.json`, `first_run_marketing_campaign.json`,
`freedompar_manual.json`, `honeycomb_manual.json`, `inventory_reference.json`,
`knowledge.json`, `master_index.json`, `mastergameplan.json`,
`owner_admin_build_readiness.json`, `owner_site_boot_plan.json`, `prompt.json`,
`qwen_model_routing.json`, `readme.json`, `rig.json`, `settings_manifest.json`,
`styleguide.json`, `timeline_moment_registry.json`, `website_system_plan.json`.

**Best data:** record identifiers, normalized fields, relationships, maintenance
metadata, summaries, and extraction-ready canonical-record arrays. Compare each
file with its `source_document`; do not assume completeness. `master_index.json`
and `settings_manifest.json` are the best existing maps of intended SSOT scope.

#### Settings contracts — `docs/ssot/settings/` (12)

Files: `asset_taxonomy.json`, `brand_stories.json`, `brand_voice.json`,
`content_model.json`, `developer_workflow.json`, `integrations.json`,
`marketing_channels.json`, `project_identity.json`, `show_timeline.json`,
`site_architecture.json`, `technical_show_control.json`, `visual_style.json`.

**Best data:** deliberately separated settings vocabularies and policy values.
These are strong schema/domain candidates, but every setting still needs source
provenance and current-status verification.

### 5.3 Current owner/CMS candidate — `center/` (71 files)

Root/assets/config files: `README.md`, `index.php`, `assets/css/center.css`,
`assets/js/center.js`, `config/app.php`.

Data files: `data/booking_contacts_seed.php`, `decision_schema.php`,
`integrity_checks_seed.php`, `navigation.php`, `priority_board_seed.php`,
`proto_editing_contracts.php`, `rehearsal_prep_seed.php`,
`release_gate_matrix.php`, `schema.php`, `source_provenance_schema.php`,
`tasks_launch_seed.php`.

Architecture files: `docs/answers.md`, `canon_sync_policy.md`,
`center_first_full_scaffolding_decision_report.md`,
`center_horizontal_scaffolding_open_inquiries.md`,
`center_scaffolding_inception_expansion_report.md`,
`future_persistence_and_auth_plan.md`, `horizontal_scaffolding_refinement_report.md`,
`module_scaffolding_checklist.md`, `prior_rendition_migration_checklist.md`,
`priority_board_model.md`, `proto_cms_adapter_plan.md`,
`proto_owner_control_mockups.md`, `public_release_gate_policy.md`,
`scaffold_inventory.md`, `docs/reports/README.md`.

Service/view files: `includes/bootstrap.php`, `functions.php`, `records.php`,
`settings.php`, `ssot.php`; `partials/components.php`, `footer.php`, `forms.php`,
`header.php`, `sidebar.php`, `tables.php`, `topbar.php`; `scripts/validate.php`.

Module files: `pages/asset-inventory.php`, `booking-contacts.php`,
`cue-staging.php`, `dashboard.php`, `decision-log.php`, `integrity.php`,
`marketing-planner.php`, `media-intake.php`, `operator-outputs.php`,
`priority-board.php`, `provenance-ledger.php`, `record-detail.php`, `records.php`,
`rehearsal-prep.php`, `release-gates.php`, `rights-safety-queue.php`,
`settings-inventory.php`, `ssot-library.php`, `system-map.php`,
`tasks-launch.php`, `timeline-registry.php`, `website-cms-drafts.php`.

Storage contracts: `storage/README.md`, `storage/cache/README.md`,
`storage/exports/README.md`, `storage/overlays/README.md`,
`storage/uploads/README.md`.

**Best data:** the newest owner workflow vocabulary, seed records, schemas,
release gates, provenance, decisions, priorities, rehearsal/launch operations,
and the proposed public-site editing contract. Because the app declares itself
scaffolding-first, seed/demo status must be determined record by record.

### 5.4 Generic and earlier owner renditions — 146 files total

#### `owner/` (22)

Files: `README.md`, `index.php`, `assets/css/owner.css`, `assets/js/owner.js`,
`config/site.php`, `data/navigation.php`, `data/public_spokes.php`,
`data/schema.php`, `includes/bootstrap.php`, `includes/functions.php`,
`pages/asset-inventory.php`, `cue-draft-import.php`, `dashboard.php`,
`media-intake.php`, `operator-outputs.php`, `rights-safety-queue.php`,
`tasks-launch.php`, `timeline-registry.php`, `website-cms-drafts.php`,
`partials/components.php`, `footer.php`, `header.php`.

**SSOT value:** baseline generic schema, public-spoke model, and module taxonomy.

#### `owner_arena_command/` (51)

Files outside its SSOT copies: `.gitignore`, `README.md`, `index.php`,
`assets/css/arena-command.css`, `assets/js/arena-command.js`, `config/site.php`,
`data/dashboard_cards.php`, `module_blueprints.php`, `navigation.php`,
`schema.php`, `status_options.php`, `includes/bootstrap.php`, `functions.php`,
`records.php`, `ssot.php`, `pages/asset-inventory.php`, `cue-draft-import.php`,
`dashboard.php`, `media-intake.php`, `operator-outputs.php`, `record-detail.php`,
`records.php`, `rights-safety-queue.php`, `ssot-library.php`, `system-map.php`,
`tasks-launch.php`, `timeline-registry.php`, `website-cms-drafts.php`,
`partials/components.php`, `footer.php`, `forms.php`, `header.php`, `sidebar.php`,
`tables.php`, `topbar.php`.

Bundled SSOT files: `data/ssot/colorstrip_manual.json`, `cue.json`,
`freedompar_manual.json`, `honeycomb_manual.json`, `inventory_reference.json`,
`knowledge.json`, `master_index.json`, `mastergameplan.json`,
`owner_admin_build_readiness.json`, `owner_site_boot_plan.json`, `prompt.json`,
`readme.json`, `rig.json`, `styleguide.json`, `timeline_moment_registry.json`,
`website_system_plan.json`.

**SSOT value:** first full universal-record normalization, status vocabularies,
module definitions, and runtime-overlay intent. Its bundled JSON is a deployment
copy, not a preferred upstream source.

#### `secondrendition/` (34)

Files outside SSOT copies: `README.md`, `data_navigation.php`, `index.php`,
`assets/css/secondrendition.css`, `assets/js/secondrendition.js`,
`config/site.php`, `data/README.md`, `includes/bootstrap.php`, `functions.php`,
`pages/dashboard.php`, `explore.php`, `integrity.php`, `record.php`, `source.php`,
`sources.php`, `partials/components.php`, `footer.php`, `header.php`.

Bundled SSOT filenames under `data/ssot/`: `colorstrip_manual.json`, `cue.json`,
`freedompar_manual.json`, `honeycomb_manual.json`, `inventory_reference.json`,
`knowledge.json`, `master_index.json`, `mastergameplan.json`,
`owner_admin_build_readiness.json`, `owner_site_boot_plan.json`, `prompt.json`,
`readme.json`, `rig.json`, `styleguide.json`, `timeline_moment_registry.json`,
`website_system_plan.json`.

**SSOT value:** integrity rules, source-library behavior, record linking, and
findability. Bundled SSOT is derivative.

#### `thirdrendition/` (39)

Files outside SSOT copies: `README.md`, `data_navigation.php`, `index.php`,
`assets/css/thirdrendition.css`, `assets/js/thirdrendition.js`, `config/site.php`,
`data/README.md`, `includes/bootstrap.php`, `functions.php`, `pages/cues.php`,
`dashboard.php`, `explore.php`, `integrity.php`, `inventory.php`, `record.php`,
`runbooks.php`, `section.php`, `sections.php`, `source.php`, `sources.php`,
`partials/components.php`, `footer.php`, `header.php`.

Bundled SSOT filenames under `data/ssot/`: `colorstrip_manual.json`, `cue.json`,
`freedompar_manual.json`, `honeycomb_manual.json`, `inventory_reference.json`,
`knowledge.json`, `master_index.json`, `mastergameplan.json`,
`owner_admin_build_readiness.json`, `owner_site_boot_plan.json`, `prompt.json`,
`readme.json`, `rig.json`, `styleguide.json`, `timeline_moment_registry.json`,
`website_system_plan.json`.

**SSOT value:** useful production-domain classification rules for cues,
inventory, run books, and per-source project sections. Bundled SSOT is derivative.

### 5.5 Active public website and public datasets — `proto/` (120 files)

#### Root, routes, database, and runtime application

Files: `README.md`, `gitignore.txt`, `index.php`; route files
`admin/index.php`, `contact/index.php`, `contact-press/index.php`,
`directions/index.php`, `editor/index.php`, `faq-disclaimer/index.php`,
`july-25-2026/index.php`, `spectacle/index.php`, `technical/index.php`,
`vault/index.php`, `video/index.php`, `what-is-just-one-kiss/index.php`;
`database/schema.sql`, `database/seed.sql`.

Application files: `app/config.example.php`, `config.php`, `csrf.php`, `db.php`,
`form_storage.php`, `helpers.php`, `language.php`, `layer_control_views.php`,
`layer_controls.php`, `layer_runtime.php`, `mailer.php`, `page_sections.php`,
`site_data.php`, `view.php`, `app/forms/inquiry_submit.php`,
`app/forms/lead_submit.php`.

**Best data:** actual rendering rules, route relationships, form field contracts,
storage behavior, language-token use, and optional database structure. Config
values require secret review and should not be copied wholesale.

#### Public-site documentation/data — `proto/docs/` (20)

Files: `asset_placeholders.md`, `css_style_reference.md`,
`developer_editor_guide.md`, `image_generation_inventory.md`,
`image_generation_prompt_list.txt`, `image_generation_requests.txt`,
`image_placeholder_eradication_report.md`, `language.json`, `language_map.md`,
`launch_checklist.md`, `mobile_responsive_success_guide.md`,
`page_sections.json`, `preserve_backup_files.json`,
`proto_expert_coding_boot_prompt.md`, `routes_and_supporting_pages.md`,
`site_layer_controls_published.json`, `site_layer_controls_snapshot.json`,
`site_layer_controls_state.json`, `website_inventory.md`, `website_ssot.md`.

**Best data:** active public copy, route/section registry, media requirements,
editor behavior, launch state, and draft/published layer state. Determine whether
`language.json` or a root approved language export is newest and approved.

#### Site-layer history — `proto/docs/site_layer_control_backups/` (22)

Files: `site_layer_controls_state-20260721-203128.json`,
`site_layer_controls_state-20260721-203320.json`,
`site_layer_controls_state-20260721-203441.json`,
`site_layer_controls_state-20260721-203514.json`,
`site_layer_controls_state-20260721-203559.json`,
`site_layer_controls_state-20260721-203738.json`,
`site_layer_controls_state-20260721-203811.json`,
`site_layer_controls_state-20260721-203847.json`,
`site_layer_controls_state-20260721-205527.json`,
`site_layer_controls_state-20260721-205549.json`,
`site_layer_controls_state-20260721-205650.json`,
`site_layer_controls_state-20260721-210057.json`,
`site_layer_controls_state-20260721-210206.json`,
`site_layer_controls_state-20260721-210316.json`,
`site_layer_controls_state-20260721-210432.json`,
`site_layer_controls_state-20260721-211021.json`,
`site_layer_controls_state-20260721-211113.json`,
`site_layer_controls_state-20260721-211143.json`,
`site_layer_controls_state-20260721-211248.json`,
`site_layer_controls_state-20260721-211306.json`,
`site_layer_controls_state-20260721-211403.json`,
`site_layer_controls_state-20260721-211457.json`.

**SSOT value:** ordered audit history for section controls, route order,
visibility, asset replacements/uploads, labels, custom files, and publishing.
Preserve sequence; do not flatten all snapshots into current state.

#### Active public root and routes

Files: `public/index.php`, `admin-language-save.php`, `site-layer-save.php`;
`public/contact/index.php`, `contact-press/index.php`, `directions/index.php`,
`faq-disclaimer/index.php`, `july-25-2026/index.php`,
`preserve-backup/index.php`, `spectacle/index.php`, `technical/index.php`,
`vault/index.php`, `video/index.php`, `what-is-just-one-kiss/index.php`;
`public/site-layers/index.php`, `site-layers/behavior/index.php`,
`copy/index.php`, `media/index.php`, `review/index.php`, `structure/index.php`,
`style/index.php`.

**Best data:** deployed page coverage and any copy/facts embedded outside the
language map. Root-level duplicates are legacy per `proto/README.md`; compare but
prefer active `public/` behavior when documenting current deployment.

#### Public assets

Files: `public/assets/css/site.css`, `public/assets/js/site.js`,
`public/assets/font/nasty.otf`, `script.otf`; images
`public/assets/img/README.md`, `costume-chrome-detail.webp`,
`fog-strobe-atmosphere.webp`, `gear-control-dossier.webp`,
`hero-stage-portal.webp`, `interlochen-dispatch-map.webp`,
`layer-upload-20260721-203128-2acddb.png`,
`layer-upload-20260721-205527-61dd69.png`,
`layer-upload-20260721-210057-1203f2.png`,
`layer-upload-20260721-210432-ed187b.png`,
`layer-upload-20260721-211403-b05fc5.png`, `press-performer-portrait.webp`,
`road-case-vault-bg.webp`, `spectacle-lighting-rig.webp`,
`trailer-poster-stage-portal.webp`.

**SSOT value:** implemented design tokens/behavior and actual asset existence.
Binary metadata, dimensions, hashes, provenance, approval, rights, alt text, and
usage should be extracted; visual inference must remain labeled.

#### Runtime storage

Files: `storage/README.md`, `storage/leads/.gitignore`, `2026-07.json`,
`storage/mail-failures/.gitignore`, `2026-07.json`.

**SSOT value:** observed lead/mail schemas and operational history. These files
may contain personal or delivery data. Future extraction must inventory fields
and counts with redaction; it must not publish personal values in the compendium.

### 5.6 Structured stage/fixture prototype — `proto_prob/` (105 files)

#### Application, routes, schema, and test files (21)

Files: `index.php`, `metadata_diagnostics.json`, `admin/index.php`;
`app/FixtureService.php`, `JsonRepository.php`, `bootstrap.php`,
`config.example.php`, `config.php`, `csrf.php`, `db.php`, `form_storage.php`,
`helpers.php`, `language.php`, `layer_control_views.php`, `layer_controls.php`,
`layer_runtime.php`, `mailer.php`, `page_sections.php`, `site_data.php`, `view.php`;
`app/forms/inquiry_submit.php`, `lead_submit.php`; routes `contact/index.php`,
`spectacle/index.php`, `technical/index.php`, `vault/index.php`, `video/index.php`,
`what-is-just-one-kiss/index.php`; `database/schema.sql`, `seed.sql`;
`schemas/fixture.schema.json`, `profile.schema.json`; `tests/smoke.php`.

**Best data:** fixture/profile schema, JSON repository semantics, validation,
revision behavior, and prototype diagnostics. `metadata_diagnostics.json` is
environment-specific and should be excluded or redacted except for useful
diagnostic-schema concepts.

#### Fixture records — `proto_prob/data/fixtures/` (59)

Files: `AF-B.json`, `AF-G.json`, `AF-P.json`, `AF-R.json`, `AY-SL-B.json`,
`AY-SL-G.json`, `AY-SL-R.json`, `AY-SL-Y.json`, `AY-SR-B.json`, `AY-SR-G.json`,
`AY-SR-R.json`, `AY-SR-Y.json`, `BL01.json`, `DB01.json`, `DP-F.json`,
`DP-SL.json`, `DP-SR.json`, `FX-SL.json`, `FX-SR.json`, `H01.json`, `H02.json`,
`H03.json`, `H04.json`, `H05.json`, `H06.json`, `H07.json`, `H08.json`,
`H09.json`, `H10.json`, `H11.json`, `H12.json`, `H13.json`, `H14.json`,
`KS-I-I.json`, `KS-I-O.json`, `KS-K-I.json`, `KS-K-O.json`, `KS-S1-I.json`,
`KS-S1-O.json`, `KS-S2-I.json`, `KS-S2-O.json`, `PTR01.json`, `PTR02.json`,
`PTR03.json`, `PTR04.json`, `PTR05.json`, `PTR06.json`, `PTR07.json`,
`PTR08.json`, `SP01.json`, `SP02.json`, `U01.json`, `U02.json`, `U03.json`,
`U04.json`, `U05.json`, `U06.json`, `U07.json`, `U08.json`.

**Best data:** the repository’s most granular equipment records: identity,
fixture type, asset tag, category/status, stage layer and zone, geometry,
mounting/focus, DMX mode/address/values, connections, power, simulation,
evidence, maintenance, and revision metadata. Validate all records against the
schema, fixture-type catalog, fixture index, and narrative inventory before use.

#### Global stage datasets — `proto_prob/data/global/` (9)

Files: `dmx-universes.json`, `fixture-types.json`, `groups.json`, `layers.json`,
`pavilion.json`, `project.json`, `scaffold.json`, `stage.json`, `zones.json`.

**Best data:** the strongest structured candidates for DMX universes/modes,
fixture taxonomy, physical geometry, coordinate system, zones, logical groups,
and visualization layers. Verification/confidence fields are critical because
this is a prototype area.

#### Index and profiles — 4 files

Files: `data/indexes/fixtures.json`;
`data/profiles/stage-scenes/blackout.json`, `red-upper-green-floor.json`,
`work-light.json`.

**SSOT value:** generated fixture lookup plus three scene/safe-state records.
The index is derived; individual fixtures are upstream. Profiles need operational
approval before being described as show-ready.

### 5.7 Notes and utility — 3 files

Files: `notes/logs/owner_project_manager_priority_surface_boot_log.md`,
`notes/prompts/owner_project_manager_priority_surface_boot_prompt.md`,
`scripts/generate_facebook_awareness.php`.

**SSOT value:** development provenance, acceptance intent, and executable
marketing-generation defaults. These corroborate decisions and campaign specs;
they are not primary business/show facts.

## 6. Duplicate and derivation map

The largest duplication family is the 16-file SSOT bundle copied into each of
`owner_arena_command/data/ssot/`, `secondrendition/data/ssot/`, and
`thirdrendition/data/ssot/`. Their apparent upstream peers are in `docs/ssot/`.
The next phase should hash and structurally diff all four locations. A local copy
that differs is a deployment fork requiring provenance, not an automatic winner.

Other important comparison families are:

- `language_APPROVED.json`, `language_NEWTIME.json`, `docs/notes/language.json`,
  and `proto/docs/language.json`.
- `docs/cue.txt`, `docs/ssot/cue.json`, the cue-book DOCX, Timeline registry,
  and cue modules/seeds.
- `docs/inventory_reference.md`/JSON, `docs/rig.md`/JSON, vendor manual
  PDFs/JSON, and `proto_prob` fixture/global data.
- Legacy `proto/*/index.php` routes versus active `proto/public/*/index.php`.
- `site_layer_controls_state.json`, `site_layer_controls_published.json`, the
  snapshot description, and 22 timestamped backups.
- Generic `owner` schema/navigation, arena-command schema/status/module data,
  second/third rendition classifiers, and current `center` contracts.
- Source images, layer-uploaded PNGs, layer-state asset metadata, and asset
  inventories.

## 7. Data-quality, privacy, and authority risks

1. **Draft versus canonical:** cue material, scaffolding seeds, prompts, plans,
   and scene profiles may describe proposals rather than approved reality.
2. **Human/JSON drift:** paired JSON can omit nuance or lag its Markdown/PDF
   source. Both representations need field-level comparison.
3. **Deployment-copy drift:** bundled SSOT sets may not match `docs/ssot/`.
4. **Temporal state:** language variants, layer backups, current draft, and
   published state must retain dates/status rather than be flattened.
5. **Estimated geometry:** stage and fixture position data may be simulated or
   estimated; confidence and verification metadata must survive extraction.
6. **Sensitive runtime records:** leads, mail failures, booking contacts, config,
   uploads, and diagnostics may contain personal, delivery, path, or environment
   data. Extract schemas and governed references, not exposed secrets/PII.
7. **Rights and claims:** brand, performer, vendor manual, font, image, and public
   affiliation data require provenance and rights/review status.
8. **Generated indexes:** fixture indexes, summaries, caches, and normalized
   records should point to upstream records and be reproducible.
9. **Implementation versus policy:** CSS/PHP proves implemented behavior, but it
   does not by itself prove that behavior is approved policy.
10. **Time-sensitive workflow guidance:** model-routing and integration choices
    require freshness fields and review dates.

## 8. Recommended order for the later in-depth study

1. Establish document-control fields, source IDs, provenance links, statuses,
   confidence, effective dates, and conflict-record format.
2. Diff duplicate SSOT bundles and all language variants before reading them as
   independent sources.
3. Reconcile project/event identity and public facts.
4. Reconcile Timeline registry, cue sources, and authoritative DOCX standards.
5. Reconcile technical inventory, vendor evidence, granular fixture data, stage
   geometry, and scene profiles.
6. Reconcile brand, marketing, website copy/routes/sections, and media assets.
7. Reconcile owner schemas, workflows, release gates, provenance, and CMS
   contracts across renditions, using `center/` as the newest candidate rather
   than assuming it is complete.
8. Inventory runtime/history schemas with privacy-preserving handling.
9. Only then select the new compendium files, schemas, canonical values, and
   migration rules.

## 9. Exit criteria for this discovery phase

This phase is complete when the repository count remains reproducible, every
tracked area is represented above, every major duplicate family is identified,
likely primary and corroborating sources are named, and no extracted value has
been mislabeled as newly canonical. Content-level selection and authoring of the
new SSOT documents are intentionally deferred to the requested next phase.
