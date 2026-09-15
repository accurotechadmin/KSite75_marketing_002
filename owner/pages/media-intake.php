<?php
include_once __DIR__ . '/../partials/components.php';
$sampleRecords = [
    [
        'record_id' => strtoupper(str_replace('-', '_', $currentPage)) . '-001',
        'title' => 'Media Intake seed record',
        'section' => $currentMeta['label'],
        'category' => 'template',
        'timeline_moment_id_or_gen' => 'GEN',
        'status' => 'draft',
        'priority' => 'high',
        'owner_or_responsible_role' => 'owner',
        'public_private_flag' => 'internal-only',
        'rights_status' => 'needs review',
        'safety_status' => 'needs review',
        'description' => 'Generic scaffold card for this module. Replace with SSOT-backed records as the data layer matures.',
        'linked_files' => [],
        'linked_records' => [],
        'last_updated' => date('Y-m-d'),
    ],
];
?>
<div class="module-layout">
    <section class="component-card">
        <div class="section-heading">
            <p class="eyebrow">Template page</p>
            <h3>Media Intake</h3>
        </div>
        <p>This module is intentionally generic: the HTML structure, PHP data arrays, CSS tokens, and JavaScript hooks can be remixed or restyled without rebuilding module logic.</p>
    </section>
    <?php owner_render_workspace(['Upload media candidate', 'Convert to asset/media record', 'Mark public eligibility']); ?>
    <?php owner_render_record_cards($sampleRecords); ?>
    <?php owner_render_schema_table($schemaFields); ?>
</div>
