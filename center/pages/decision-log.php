<?php
require_once __DIR__ . '/../partials/components.php';
$schema = require __DIR__ . '/../data/decision_schema.php';
center_section_header('Decision cockpit', 'Decision Log', 'Read-only owner decision surface for unresolved questions, options, evidence needs, reversal costs, launch follow-ups, and proto preview boundaries.');
center_placeholder_panel($module['label'] . ' operating rules', [
    'Owner problem solved: keeps choices from disappearing into notes by tying every decision to source records, follow-up cards, preview requirements, rollback requirements, release gates, and open inquiries.',
    'Required source files: priority board cards, release gates, docs/cue.txt, timeline registry, proto language/settings files, and owner-approved overlays when they eventually exist.',
    'Gate warning: decisions affecting public copy, rights, safety, venue claims, media, technical disclosure, or privacy remain draft until evidence is reviewed.',
    'Timeline/GEN rule: decisions are GEN unless resolving a specific show moment; ambiguous cue decisions stay GEN plus needs_timeline_review.',
    'Future note: changing a decision requires authenticated owner identity, audit history, backups, rollback support, and source-revision tracking.',
]);
center_kv_table(['Decision fields' => $schema['required_fields'], 'Non-mutating posture' => 'This page renders planning records only; it does not save, approve, publish, or write proto/.']);
center_card_grid($schema['decisions'], ['context','options','chosen_option','decision_status','decision_owner','needed_by','source_records','impact_area','reversal_cost','follow_up_record_id','release_gate_record_id','preview_requirement','rollback_requirement','audit_requirement']);
center_disabled_checklist('Disabled decision actions', [
    'Accept chosen option and stamp owner identity',
    'Request missing gate evidence',
    'Create follow-up launch task',
    'Attach preview screenshot or route smoke result',
    'Reverse decision with rollback note',
]);
