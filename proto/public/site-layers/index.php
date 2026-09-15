<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/view.php';
require_once __DIR__ . '/../../app/layer_controls.php';
require_once __DIR__ . '/../../app/layer_control_views.php';

$snapshot = jok_layer_snapshot();
$action = e(rel_url('site-layer-save.php'));
render_header('Site Layer Controls — Just One KISS', 'Enabled v2 MVP public-site layer controls.');
?>
<main id="main" class="layer-control-shell">
  <section class="layer-hero" aria-labelledby="layer-title">
    <p class="eyebrow">Enabled v2 MVP</p>
    <h1 id="layer-title">Site Layer Controls</h1>
    <p class="section-lede">Basic functional controls for the piecemeal <code>proto/public</code> website. This v2 stays scoped to the requested operations: save edits, publish changes, reorder sections, hide/show sections, edit language.json, upload images, replace image handles, change CSS, change templates, write files, and change assets.</p>
    <p>Not in this scope: authentication, roles, database persistence, approval workflows, visual page-builder drag/drop, or a framework/build step.</p>
  </section>

  <?php if (isset($_GET['message'])): ?>
    <section class="layer-panel <?= ($_GET['saved'] ?? '') === '1' ? 'notice--ok' : 'notice--error' ?>" aria-label="Operation result">
      <p class="eyebrow">Operation result</p>
      <h2><?= ($_GET['saved'] ?? '') === '1' ? 'Saved' : 'Needs attention' ?></h2>
      <p><?= e((string) $_GET['message']) ?></p>
    </section>
  <?php endif; ?>

  <section class="layer-panel" id="mvp-operations" aria-labelledby="mvp-operations-title">
    <p class="eyebrow">Main operator panel</p>
    <h2 id="mvp-operations-title">Most-used controls wired above the fold</h2>
    <p>These forms write files at a basic MVP level. Use them on a working branch and review diffs before pushing.</p>
    <div class="layer-grid">
      <article class="layer-card"><span class="layer-card__handle">in scope</span><h3>Save / publish / write</h3><p>Save section-control drafts, publish the current MVP state to a published JSON snapshot, or write a custom planning/output file.</p></article>
      <article class="layer-card"><span class="layer-card__handle">in scope</span><h3>Structure / templates</h3><p>Store section order, hide/show state, and append route template notes. Template notes are intentionally conservative so the PHP page remains valid.</p></article>
      <article class="layer-card"><span class="layer-card__handle">in scope</span><h3>Copy / assets / style</h3><p>Edit registered language tokens, upload image files, replace asset handles in a selected template, and append CSS to the active stylesheet.</p></article>
      <article class="layer-card"><span class="layer-card__handle">not in list</span><h3>Out of scope</h3><p>No authentication, roles, database publishing, approval workflow, visual drag/drop builder, dependency manager, or framework/build step is added.</p></article>
    </div>

    <div class="section-handle-list layer-operation-list">
      <?php foreach (jok_layer_operations_for_layer('overview') as $operation): ?>
        <?php jok_layer_render_operation_form($operation, $snapshot, 'overview'); ?>
      <?php endforeach; ?>
    </div>
  </section>


  <section class="layer-panel" aria-labelledby="layers-title">
    <p class="eyebrow">Layer handles</p>
    <h2 id="layers-title">Six editing layers</h2>
    <div class="layer-grid">
      <?php foreach ($snapshot['layers'] as $layer => $description): ?>
        <article class="layer-card">
          <span class="layer-card__handle"><?= e($layer) ?></span>
          <h3><?= e(ucwords($layer)) ?></h3>
          <p><?= e($description) ?></p>
          <a class="button button--chrome" href="<?= e(page_url('/site-layers/' . $layer . '/')) ?>">Open <?= e($layer) ?> layer</a>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="layer-panel" aria-labelledby="shared-title">
    <p class="eyebrow">Global surfaces</p>
    <h2 id="shared-title">Shared surfaces table</h2>
    <div class="layer-table-wrap">
      <table class="layer-table">
        <thead><tr><th>Handle</th><th>Label</th><th>Layers</th><th>Source</th><th>Status</th></tr></thead>
        <tbody>
          <?php foreach ($snapshot['shared_surfaces'] as $handle => $surface): ?>
            <tr>
              <td><code><?= e($handle) ?></code></td>
              <td><?= e($surface['label']) ?></td>
              <td><?= e(implode(', ', $surface['layers'])) ?></td>
              <td><code><?= e($surface['source_file']) ?></code></td>
              <td><?= e($surface['control_status'] ?? 'read_only_disabled_v1') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <section class="layer-panel" aria-labelledby="routes-title">
    <p class="eyebrow">Layer handles</p>
    <h2 id="routes-title">All page and section handles</h2>
    <div class="section-handle-list">
      <?php foreach ($snapshot['routes'] as $route): ?>
        <article class="route-control-card">
          <div class="route-meta">
            <div>
              <span class="layer-card__handle"><?= e($route['route']) ?></span>
              <h3><?= e($route['title']) ?> / <?= e($route['label']) ?></h3>
              <p><?= e($route['summary']) ?></p>
            </div>
            <a class="button button--ghost" href="<?= e(page_url($route['route'])) ?>">View page</a>
          </div>
          <p><strong>File:</strong> <code><?= e($route['source_file']) ?></code> · <strong>Exists:</strong> <?= $route['file_exists'] ? 'yes' : 'no' ?></p>
          <p><strong>Section count:</strong> <?= count($route['sections']) ?> · <strong>Language token count:</strong> <?= count($route['language_tokens']) ?> · <strong>Image count:</strong> <?= count($route['image_handles']) ?></p>
          <?php if ($route['image_handles'] !== []): ?><p><strong>Image handles:</strong> <?= jok_layer_badges($route['image_handles']) ?></p><?php endif; ?>
          <?php if ($route['legacy_slot_calls'] !== []): ?><p><strong>Legacy slot calls:</strong> <?= jok_layer_badges($route['legacy_slot_calls']) ?> <em>inventory only</em></p><?php endif; ?>
          <details>
            <summary>Expandable section handle cards</summary>
            <div class="section-handle-list">
              <?php foreach ($route['sections'] as $section): ?>
                <article class="section-handle-card">
                  <span class="layer-card__handle"><?= e($section['handle']) ?></span>
                  <p><strong>ID:</strong> <?= e($section['section_id'] !== '' ? $section['section_id'] : 'no id') ?> · <strong>Classes:</strong> <?= e($section['classes'] !== '' ? $section['classes'] : 'none') ?></p>
                  <p><strong>ARIA:</strong> <?= e($section['aria_label'] !== '' ? $section['aria_label'] : ($section['aria_labelledby'] !== '' ? 'labelledby ' . $section['aria_labelledby'] : 'none')) ?></p>
                  <p><strong>Inferred layers:</strong> <?= e(implode(', ', $section['layers'])) ?> · <strong>Status:</strong> <?= e($section['control_status']) ?></p>
                  <div class="control-grid" aria-label="Disabled draft controls for <?= e($section['handle']) ?>">
                    <label>Text alignment<select><option>Current CSS</option><option>Left</option><option>Right</option><option>Center</option></select></label>
                    <label>Headline scale<select><option>Current CSS</option><option>Large</option><option>Poster</option></select></label>
                    <label>Image placement<select><option>Current template</option><option>Background</option><option>Left column</option><option>Right column</option><option>Inline</option></select></label>
                    <label>Animation preset<select><option>None/current</option><option>Fade up</option><option>Chrome glint</option><option>Ember drift</option></select></label>
                  </div>
                </article>
              <?php endforeach; ?>
            </div>
          </details>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="layer-panel" aria-labelledby="images-title">
    <p class="eyebrow">Media layer</p>
    <h2 id="images-title">Available image inventory</h2>
    <div class="layer-grid layer-grid--media">
      <?php foreach (jok_layer_available_image_assets($snapshot) as $image): ?>
          <form class="image-slot image-label-card" method="post" action="<?= $action ?>"<?= asset_style($image) ?>>
            <input type="hidden" name="operation" value="update_image_label">
            <input type="hidden" name="return_to" value="<?= e(jok_layer_current_return_path()) ?>">
            <input type="hidden" name="selected_asset" value="<?= e($image) ?>">
            <strong><?= e(jok_layer_image_label($snapshot, $image)) ?></strong>
            <small><?= e($image) ?></small>
            <label>Name label<input name="image_label" maxlength="120" value="<?= e(jok_layer_image_label($snapshot, $image)) ?>"></label>
            <button class="button button--ghost" type="submit">Edit name</button>
            <span>Available image asset; labels make dropdown choices easier to identify while filenames stay unchanged.</span>
          </form>
      <?php endforeach; ?>
    </div>
  </section>
  <section class="layer-panel layer-panel--raw" aria-labelledby="raw-overview-data-title">
    <p class="eyebrow">Raw inventory and data</p>
    <h2 id="raw-overview-data-title">Raw all-layer snapshot</h2>
    <p>This full generated snapshot stays at the bottom for audit/debug review after the operator controls, layer cards, shared surfaces, routes, and image inventory.</p>
    <details>
      <summary>Open raw JSON for all site layers</summary>
      <pre class="raw-data-block"><code><?= e(json_encode($snapshot, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) ?></code></pre>
    </details>
  </section>
</main>
<?php render_footer(); ?>
