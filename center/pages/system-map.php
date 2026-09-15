<?php
require_once __DIR__ . '/../partials/components.php';
$navigation = center_navigation();
$groups = [];
foreach ($navigation as $id => $item) {
    $groups[$item['phase'] ?? 'unclassified'][$id] = $item;
}
center_section_header('System map', 'Module depth and route inventory', 'All pages remain reachable, but only Dashboard, Priority Board, Release Gates, Provenance Ledger, and Integrity are first-class in this pass.');
foreach (['first-class','next-session','deferred'] as $phase) {
    echo '<section class="panel"><h2>' . center_e(center_phase_badge($phase)) . '</h2><div class="card-grid">';
    foreach ($groups[$phase] ?? [] as $id => $item) {
        echo '<article class="card"><p class="eyebrow">' . center_e($id) . '</p><h3><a href="' . center_e(center_url($id)) . '">' . center_e($item['label']) . '</a></h3><p>' . center_e($item['description']) . '</p><p><strong>Timeline rule:</strong> ' . center_e($item['timeline_rule']) . '</p><p><strong>Inquiry severity:</strong> ' . center_e($item['inquiry_severity'] ?? '') . '</p></article>';
    }
    echo '</div></section>';
}
center_placeholder_panel('Reference-only prior renditions', ['owner/', 'owner_arena_command/', 'secondrendition/', 'thirdrendition/']);
