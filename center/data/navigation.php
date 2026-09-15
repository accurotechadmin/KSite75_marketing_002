<?php
/**
 * Owner module registry for `/center`.
 *
 * The registry stays app-local PHP for deployment simplicity, but each row carries
 * settings-route metadata so the future settings-backed router can replace these
 * labels/routes without changing templates.
 */
return [
    'dashboard' => [
        'label' => 'Dashboard', 'template' => 'dashboard.php', 'route' => 'dashboard', 'phase' => 'first-class',
        'settings_key' => 'center.routes.dashboard', 'description' => 'Private owner command-center overview and first-stage CMS-adapter posture for proto/.',
        'timeline_rule' => 'GEN dashboard; linked records keep their own Timeline Moment ID or GEN.', 'open_inquiry_ids' => ['OI-001','OI-003','OI-004','OI-014'], 'inquiry_severity' => 'safe placeholder allowed',
    ],
    'priority-board' => [
        'label' => 'Priority Board', 'template' => 'priority-board.php', 'route' => 'priority-board', 'phase' => 'first-class',
        'settings_key' => 'center.routes.priority_board', 'description' => 'Read-only implementation sequence for proto editing, SSOT visibility, gates, provenance, and integrity.',
        'timeline_rule' => 'Cards use timeline_moment_id_or_gen; ambiguous cards use GEN with needs_timeline_review.', 'open_inquiry_ids' => ['OI-003','OI-008','OI-009','OI-022'], 'inquiry_severity' => 'safe placeholder allowed',
    ],
    'release-gates' => [
        'label' => 'Release Gates', 'template' => 'release-gates.php', 'route' => 'release-gates', 'phase' => 'first-class',
        'settings_key' => 'center.routes.release_gates', 'description' => 'Generic evidence matrix for draft, internal-ready, venue-ready, and public-ready gate review.',
        'timeline_rule' => 'Gate rows inherit source Timeline Moment ID or GEN.', 'open_inquiry_ids' => ['OI-005','OI-011','OI-013'], 'inquiry_severity' => 'blocking',
    ],
    'provenance-ledger' => [
        'label' => 'Provenance Ledger', 'template' => 'provenance-ledger.php', 'route' => 'provenance-ledger', 'phase' => 'first-class',
        'settings_key' => 'center.routes.provenance_ledger', 'description' => 'Source canon, machine companions, settings contracts, app seeds, overlays, outputs, and archived references.',
        'timeline_rule' => 'GEN source governance.', 'open_inquiry_ids' => ['OI-007','OI-015','OI-016'], 'inquiry_severity' => 'safe placeholder allowed',
    ],
    'integrity' => [
        'label' => 'Integrity Checks', 'template' => 'integrity.php', 'route' => 'integrity', 'phase' => 'first-class',
        'settings_key' => 'center.routes.integrity', 'description' => 'Read-only integrity surface plus dependency-free validation script entry point.',
        'timeline_rule' => 'Findings cite source Timeline Moment ID or GEN.', 'open_inquiry_ids' => ['OI-008','OI-009','OI-020','OI-022'], 'inquiry_severity' => 'blocking',
    ],
    'settings-inventory' => [
        'label' => 'Settings Inventory', 'template' => 'settings-inventory.php', 'route' => 'settings-inventory', 'phase' => 'next-session',
        'settings_key' => 'center.routes.settings_inventory', 'description' => 'Manifest-backed inventory of settings files, vocabulary, CTAs, routes, and starter controls.',
        'timeline_rule' => 'GEN settings records; linked content keeps its source ID.', 'open_inquiry_ids' => ['OI-014'], 'inquiry_severity' => 'future-pass only',
    ],
    'ssot-library' => [
        'label' => 'SSOT Library', 'template' => 'ssot-library.php', 'route' => 'ssot-library', 'phase' => 'next-session',
        'settings_key' => 'center.routes.ssot_library', 'description' => 'Source drilldowns for master_index.json, settings_manifest.json, settings JSON, and domain SSOT JSON.',
        'timeline_rule' => 'Source records keep declared IDs or GEN.', 'open_inquiry_ids' => ['OI-014','OI-015'], 'inquiry_severity' => 'future-pass only',
    ],
    'decision-log' => ['label'=>'Decision Log','template'=>'decision-log.php','route'=>'decision-log','phase'=>'next-session','settings_key'=>'center.routes.decision_log','description'=>'Contradictions, owner answers, reversal costs, and follow-up records.','timeline_rule'=>'GEN unless resolving a specific Timeline Moment.','open_inquiry_ids'=>['OI-007','OI-022'],'inquiry_severity'=>'safe placeholder allowed'],
    'tasks-launch' => ['label'=>'Tasks / Launch','template'=>'tasks-launch.php','route'=>'tasks-launch','phase'=>'next-session','settings_key'=>'center.routes.tasks_launch','description'=>'Launch blockers, next owner/developer actions, and readiness follow-ups.','timeline_rule'=>'GEN unless tied to a specific show moment.','open_inquiry_ids'=>['OI-003','OI-022'],'inquiry_severity'=>'safe placeholder allowed'],
    'website-cms-drafts' => ['label'=>'Website CMS Drafts','template'=>'website-cms-drafts.php','route'=>'website-cms-drafts','phase'=>'next-session','settings_key'=>'center.routes.website_cms_drafts','description'=>'Read-only proto edit-specification drafts; no live writes or publishing.','timeline_rule'=>'Pages usually GEN; embedded records keep IDs.','open_inquiry_ids'=>['OI-002','OI-004','OI-014'],'inquiry_severity'=>'future-pass only'],
    'system-map' => ['label'=>'System Map','template'=>'system-map.php','route'=>'system-map','phase'=>'next-session','settings_key'=>'center.routes.system_map','description'=>'All modules, deferred pages, reference renditions, and data-flow boundaries.','timeline_rule'=>'GEN system documentation.','open_inquiry_ids'=>['OI-003','OI-016'],'inquiry_severity'=>'safe placeholder allowed'],
    'records' => ['label'=>'Records','template'=>'records.php','route'=>'records','phase'=>'deferred','settings_key'=>'center.routes.records','description'=>'Universal record index scaffold, not full CRUD.','timeline_rule'=>'Every row requires timeline_moment_id_or_gen with a Timeline ID or GEN.','open_inquiry_ids'=>['OI-008','OI-009'],'inquiry_severity'=>'future-pass only'],
    'record-detail' => ['label'=>'Record Detail','template'=>'record-detail.php','route'=>'record-detail','phase'=>'deferred','settings_key'=>'center.routes.record_detail','description'=>'Future detail surface for provenance, gates, and raw fragments.','timeline_rule'=>'Shows exact source timeline_moment_id_or_gen.','open_inquiry_ids'=>['OI-008'],'inquiry_severity'=>'future-pass only'],
    'timeline-registry' => ['label'=>'Timeline Registry','template'=>'timeline-registry.php','route'=>'timeline-registry','phase'=>'deferred','settings_key'=>'center.routes.timeline_registry','description'=>'Timeline families and GEN governance; cue migration deferred.','timeline_rule'=>'Timeline-specific IDs or GEN only.','open_inquiry_ids'=>['OI-008','OI-010'],'inquiry_severity'=>'future-pass only'],
    'cue-staging' => ['label'=>'Cue Staging','template'=>'cue-staging.php','route'=>'cue-staging','phase'=>'deferred','settings_key'=>'center.routes.cue_staging','description'=>'Cue draft provenance only until a dedicated Cue Bible pass.','timeline_rule'=>'No show-ready promotion in this pass.','open_inquiry_ids'=>['OI-010'],'inquiry_severity'=>'future-pass only'],
    'asset-inventory' => ['label'=>'Asset Inventory','template'=>'asset-inventory.php','route'=>'asset-inventory','phase'=>'deferred','settings_key'=>'center.routes.asset_inventory','description'=>'Physical/digital asset contract; uploads deferred.','timeline_rule'=>'Required per asset.','open_inquiry_ids'=>['OI-002'],'inquiry_severity'=>'future-pass only'],
    'rights-safety-queue' => ['label'=>'Rights & Safety','template'=>'rights-safety-queue.php','route'=>'rights-safety-queue','phase'=>'deferred','settings_key'=>'center.routes.rights_safety','description'=>'Rights, safety, venue dependency, and disclosure queue scaffold.','timeline_rule'=>'Source records retain IDs.','open_inquiry_ids'=>['OI-011','OI-013'],'inquiry_severity'=>'blocking'],
    'operator-outputs' => ['label'=>'Operator Outputs','template'=>'operator-outputs.php','route'=>'operator-outputs','phase'=>'deferred','settings_key'=>'center.routes.operator_outputs','description'=>'Run-sheet/export direction only; no generation from unapproved data.','timeline_rule'=>'Output rows inherit source IDs.','open_inquiry_ids'=>['OI-010','OI-011'],'inquiry_severity'=>'future-pass only'],
    'booking-contacts' => ['label'=>'Booking / Contacts','template'=>'booking-contacts.php','route'=>'booking-contacts','phase'=>'deferred','settings_key'=>'center.routes.booking_contacts','description'=>'Placeholder contact roles only; real private contacts deferred.','timeline_rule'=>'Usually GEN.','open_inquiry_ids'=>['OI-012'],'inquiry_severity'=>'future-pass only'],
    'rehearsal-prep' => ['label'=>'Rehearsal / Prep','template'=>'rehearsal-prep.php','route'=>'rehearsal-prep','phase'=>'deferred','settings_key'=>'center.routes.rehearsal_prep','description'=>'Private prep checklist direction; cue details deferred.','timeline_rule'=>'GEN unless fixing a specific show moment.','open_inquiry_ids'=>['OI-010'],'inquiry_severity'=>'future-pass only'],
    'media-intake' => ['label'=>'Media Intake','template'=>'media-intake.php','route'=>'media-intake','phase'=>'deferred','settings_key'=>'center.routes.media_intake','description'=>'Media evidence planning only; uploads deferred.','timeline_rule'=>'Required per media item.','open_inquiry_ids'=>['OI-002','OI-011'],'inquiry_severity'=>'future-pass only'],
    'marketing-planner' => ['label'=>'Marketing Planner','template'=>'marketing-planner.php','route'=>'marketing-planner','phase'=>'deferred','settings_key'=>'center.routes.marketing_planner','description'=>'Marketing planning shell gated by rights and public-copy review.','timeline_rule'=>'GEN unless tied to a precise show moment.','open_inquiry_ids'=>['OI-006','OI-013'],'inquiry_severity'=>'future-pass only'],
];
