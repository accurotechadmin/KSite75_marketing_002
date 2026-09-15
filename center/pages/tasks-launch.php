<?php
require_once __DIR__ . '/../partials/components.php';
$tasks = require __DIR__ . '/../data/tasks_launch_seed.php';
center_section_header('Launch sequencing', 'Tasks / Launch', 'Read-only lane board for turning decisions, release-gate evidence, proto preview checks, and rollback notes into a practical launch sequence.');
center_placeholder_panel('Launch boundary', [
    $tasks['launch_rule'],
    'No lane movement writes data in this pass; lanes are seed records for owner/developer review only.',
    'Public-ready means release-gate evidence is reviewed; show-ready remains a separate checklist and is not implied by public page readiness.',
    'Any task touching proto/ must list preview checks and rollback recovery before a future publish action can be enabled.',
]);
echo '<section class="card-grid">';
foreach ($tasks['lanes'] as $task) {
    echo '<article class="panel card launch-lane"><p class="eyebrow">' . center_e($task['lane']) . ' · ' . center_e($task['record_id']) . '</p><h3>' . center_e($task['title']) . '</h3>';
    echo '<p>' . center_chip('Timeline: ' . $task['timeline_moment_id_or_gen'], 'timeline') . ' ' . center_chip('Status: ' . $task['status']) . '</p>';
    foreach (['owner_or_responsible_role','decision_record_id','release_gate_record_id','priority_board_record_id','source_files','preview_check_requirement','rollback_recovery_note','evidence_summary'] as $field) {
        echo '<p><strong>' . center_e(str_replace('_', ' ', $field)) . ':</strong> ' . center_e(center_value_text($task[$field])) . '</p>';
    }
    echo '<p><strong>Inquiry chips:</strong> ' . center_chip_row($task['open_inquiry_ids'], 'inquiry') . '</p></article>';
}
echo '</section>';
center_disabled_checklist('Disabled launch actions', [
    'Move task to Finished',
    'Promote related gate to public-ready',
    'Generate launch export package',
    'Publish approved proto update',
    'Create rollback restore point',
]);
