<?php
require_once __DIR__ . '/../partials/components.php';
$matrix = require __DIR__ . '/../data/release_gate_matrix.php';
center_section_header('First-class module', 'Release Gates', 'Generic evidence-first gate matrix for draft, internal-ready, venue-ready, and public-ready review; show-ready remains a separate checklist result.');
center_kv_table(['Readiness statuses'=>$matrix['readiness_statuses'], 'Show-ready rule'=>$matrix['show_ready_rule'], 'Blocker rule'=>$matrix['blocker_rule']]);
echo '<section class="card-grid">';
foreach ($matrix['rows'] as $row) {
    $ev = $row['evidence'];
    echo '<article class="panel card"><p class="eyebrow">' . center_e($row['record_id']) . ' · ' . center_e($row['family']) . '</p><h3>' . center_e($row['readiness_status']) . '</h3>';
    foreach (['timeline_moment_id_or_gen','disclosure_tier','owner_action','open_inquiry_ids','inquiry_severity'] as $field) {
        $value = is_array($row[$field] ?? null) ? implode(', ', $row[$field]) : ($row[$field] ?? '');
        echo '<p><strong>' . center_e(str_replace('_',' ',$field)) . ':</strong> ' . center_e((string)$value) . '</p>';
    }
    foreach (['evidence_summary','evidence_status','review_state','reviewer_role','last_reviewed','blocking_reason','next_action'] as $field) {
        echo '<p><strong>' . center_e(str_replace('_',' ',$field)) . ':</strong> ' . center_e((string)($ev[$field] ?? '')) . '</p>';
    }
    echo '</article>';
}
echo '</section>';
