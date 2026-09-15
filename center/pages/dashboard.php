<?php
require_once __DIR__ . '/../partials/components.php';
$config = center_config();
$navigation = center_navigation();
$board = require __DIR__ . '/../data/priority_board_seed.php';
$gates = require __DIR__ . '/../data/release_gate_matrix.php';
$checks = require __DIR__ . '/../data/integrity_checks_seed.php';
$first = array_filter($navigation, fn($m) => ($m['phase'] ?? '') === 'first-class');
$next = array_filter($navigation, fn($m) => ($m['phase'] ?? '') === 'next-session');
$blockedGates = array_filter($gates['rows'], fn($r) => !empty($r['evidence']['blocking_reason']));
center_section_header('Owner command center', 'Private CMS-adapter scaffold for proto/', 'Read-only production-intended cockpit for planning proto public-site edits without live publishing, auth, uploads, CRUD, package managers, database migrations, or direct writes.');
center_kv_table([
    'Launch focus' => $config['launch_focus'],
    'Deployment model' => $config['deployment_model'],
    'First-class modules' => count($first),
    'Next-session modules' => count($next),
    'Priority cards' => count($board['cards']),
    'Release gates with blockers' => count($blockedGates),
    'Integrity coverage seeds' => count($checks),
    'Owner-side roles' => 'Developer / D and Owner / Performer only.',
]);
center_placeholder_panel('Current blocker rollup', array_map(fn($r) => $r['record_id'] . ' · ' . $r['family'] . ': ' . $r['evidence']['blocking_reason'], $blockedGates));
center_disabled_checklist('Disabled future action checklist', [
    'Save owner edits into authenticated overlays',
    'Publish selected proto language tokens',
    'Upload approved media assets',
    'Promote release-gate rows to public-ready',
    'Generate operator outputs from show-control records',
]);
echo '<section class="card-grid">';
foreach ($first as $id => $item) {
    echo '<article class="panel card"><p class="eyebrow">First-class module</p><h3><a href="' . center_e(center_url($id)) . '">' . center_e($item['label']) . '</a></h3><p>' . center_e($item['description']) . '</p><p><strong>Next action:</strong> inspect read-only evidence, status, and source maps before mutation exists.</p><p><strong>Open inquiries:</strong> ' . center_e(implode(', ', $item['open_inquiry_ids'] ?? [])) . '</p></article>';
}
echo '</section>';
center_placeholder_panel('Next owner/developer actions', [
    'Owner / Performer: review public-copy and disclosure boundaries before any public-ready claim.',
    'Developer: use Priority Board, Release Gates, Provenance Ledger, and Integrity as the immediate scaffold spine.',
    'Developer: prepare documentation mockups for proto edit controls before adding disabled rendered controls.',
]);
