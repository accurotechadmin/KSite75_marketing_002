<?php
function owner_render_schema_table(array $fields): void
{
    ?>
    <section class="component-card">
        <div class="section-heading">
            <p class="eyebrow">Shared contract</p>
            <h3>Universal editable record fields</h3>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Field</th><th>Template input intent</th></tr></thead>
                <tbody>
                <?php foreach ($fields as $field): ?>
                    <tr>
                        <td><code><?= owner_e($field); ?></code></td>
                        <td><input type="text" placeholder="<?= owner_e(owner_slug_to_title($field)); ?>"></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php
}

function owner_render_record_cards(array $records): void
{
    ?>
    <div class="record-grid">
        <?php foreach ($records as $record): ?>
            <article class="record-card component-card">
                <div class="record-card__topline">
                    <span class="record-id"><?= owner_e($record['record_id']); ?></span>
                    <span class="status-pill <?= owner_e(owner_status_class($record['status'])); ?>"><?= owner_e($record['status']); ?></span>
                </div>
                <h3><?= owner_e($record['title']); ?></h3>
                <p><?= owner_e($record['description']); ?></p>
                <dl class="mini-meta">
                    <div><dt>Timeline</dt><dd><?= owner_e($record['timeline_moment_id_or_gen']); ?></dd></div>
                    <div><dt>Rights</dt><dd><?= owner_e($record['rights_status']); ?></dd></div>
                    <div><dt>Safety</dt><dd><?= owner_e($record['safety_status']); ?></dd></div>
                    <div><dt>Owner</dt><dd><?= owner_e($record['owner_or_responsible_role']); ?></dd></div>
                </dl>
            </article>
        <?php endforeach; ?>
    </div>
    <?php
}

function owner_render_workspace(array $steps): void
{
    ?>
    <section class="component-card">
        <div class="section-heading">
            <p class="eyebrow">Workflow shell</p>
            <h3>Reusable module workspace</h3>
        </div>
        <ol class="workflow-list">
            <?php foreach ($steps as $step): ?>
                <li><?= owner_e($step); ?></li>
            <?php endforeach; ?>
        </ol>
    </section>
    <?php
}
