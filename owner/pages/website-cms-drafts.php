<?php
include_once __DIR__ . '/../partials/components.php';
$sampleRecords = [
    [
        'record_id' => 'WEBSITE_CMS_DRAFTS-001',
        'title' => 'Website page draft seed record',
        'section' => $currentMeta['label'],
        'category' => 'page',
        'timeline_moment_id_or_gen' => 'GEN',
        'status' => 'draft',
        'priority' => 'high',
        'owner_or_responsible_role' => 'owner',
        'public_private_flag' => 'public candidate',
        'rights_status' => 'needs review',
        'safety_status' => 'needs review',
        'description' => 'Generic CMS scaffold card. Public output remains blocked until source records are approved.',
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
            <h3>Website CMS Drafts</h3>
        </div>
        <p>Draft public-facing pages from approved owner-site data only. This scaffold keeps public pages as remixable cards until publication gates are satisfied.</p>
    </section>
    <section class="component-card">
        <div class="section-heading"><p class="eyebrow">Public spokes</p><h3>Draft page inventory</h3></div>
        <div class="spoke-grid">
            <?php foreach ($publicSpokes as $spoke): ?>
                <article class="spoke-card">
                    <h4><?= owner_e($spoke['title']); ?></h4>
                    <p><?= owner_e($spoke['purpose']); ?></p>
                    <span><?= owner_e($spoke['classification']); ?></span>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php owner_render_workspace(['Choose approved source records', 'Draft page section', 'Block publish until rights/safety clear']); ?>
    <?php owner_render_record_cards($sampleRecords); ?>
    <?php owner_render_schema_table($schemaFields); ?>
</div>
