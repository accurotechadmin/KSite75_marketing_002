<?php

declare(strict_types=1);

require_once __DIR__ . '/view.php';
require_once __DIR__ . '/layer_controls.php';

function jok_layer_current_return_path(): string
{
    $uri = (string) ($_SERVER['REQUEST_URI'] ?? '');
    if ($uri === '') {
        return page_url('/site-layers/');
    }

    $parts = parse_url($uri);
    $path = is_array($parts) ? (string) ($parts['path'] ?? '') : '';
    if ($path === '' || !str_contains($path, '/site-layers')) {
        return page_url('/site-layers/');
    }

    return $path;
}

function jok_layer_route_options(array $routes, ?string $selected = null): string
{
    $html = '';
    foreach ($routes as $route) {
        $isSelected = $selected !== null && (string) $route['route'] === $selected ? ' selected' : '';
        $html .= '<option value="' . e($route['route']) . '"' . $isSelected . '>' . e($route['route'] . ' — ' . $route['label']) . '</option>';
    }

    return $html;
}


function jok_layer_select_options(array $items, ?string $selected = null): string
{
    $html = '';
    foreach ($items as $value => $label) {
        if (is_int($value)) {
            $value = (string) $label;
        }
        $isSelected = $selected !== null && (string) $value === $selected ? ' selected' : '';
        $html .= '<option value="' . e((string) $value) . '"' . $isSelected . '>' . e((string) $label) . '</option>';
    }

    return $html;
}

function jok_layer_section_handle_options(array $routes, ?string $selected = null): string
{
    $html = '';
    foreach ($routes as $route) {
        $handles = $route['section_handles'] ?? [];
        if ($handles === []) {
            continue;
        }
        $html .= '<optgroup data-route="' . e($route['route']) . '" label="' . e($route['route'] . ' — ' . $route['label']) . '">';
        foreach ($handles as $handle) {
            $isSelected = $selected !== null && (string) $handle === $selected ? ' selected' : '';
            $html .= '<option data-route="' . e($route['route']) . '" value="' . e($handle) . '"' . $isSelected . '>' . e($handle) . '</option>';
        }
        $html .= '</optgroup>';
    }

    return $html;
}

function jok_layer_corner_options(?string $selected = null): string
{
    $labels = [
        'top-left' => 'Top left',
        'top-right' => 'Top right',
        'bottom-left' => 'Bottom left',
        'bottom-right' => 'Bottom right',
    ];

    return jok_layer_select_options($labels, $selected);
}

function jok_layer_overlay_records(array $snapshot): array
{
    $records = [];
    foreach (($snapshot['state']['section_corner_overlays'] ?? []) as $route => $routeOverlays) {
        if (!is_array($routeOverlays)) {
            continue;
        }
        foreach ($routeOverlays as $key => $overlay) {
            if (!is_array($overlay)) {
                continue;
            }
            $records[] = ['route' => (string) $route, 'key' => (string) $key] + $overlay;
        }
    }

    return $records;
}

function jok_layer_find_overlay_record(array $snapshot, string $overlayId): ?array
{
    if ($overlayId === '') {
        return null;
    }

    foreach (jok_layer_overlay_records($snapshot) as $overlay) {
        if ((string) ($overlay['overlay_id'] ?? $overlay['key'] ?? '') === $overlayId || (string) ($overlay['key'] ?? '') === $overlayId) {
            return $overlay;
        }
    }

    return null;
}

function jok_layer_overlay_select_options(array $snapshot, ?string $selected = null): string
{
    $html = '<option value="">Create a new overlay</option>';
    foreach (jok_layer_overlay_records($snapshot) as $overlay) {
        $id = (string) ($overlay['overlay_id'] ?? $overlay['key'] ?? '');
        if ($id === '') {
            continue;
        }
        $isSelected = $selected !== null && $id === $selected ? ' selected' : '';
        $asset = (string) ($overlay['selected_asset'] ?? '');
        $imageLabel = (string) ($overlay['image_label'] ?? jok_layer_image_label($snapshot, $asset));
        $label = ($overlay['route'] ?? '') . ' · ' . ($overlay['section_handle'] ?? '') . ' · ' . ($overlay['corner'] ?? '') . ' · ' . $imageLabel . ' — ' . $asset;
        $html .= '<option value="' . e($id) . '"'
            . $isSelected
            . ' data-populate-route="' . e((string) ($overlay['route'] ?? '')) . '"'
            . ' data-populate-section-handle="' . e((string) ($overlay['section_handle'] ?? '')) . '"'
            . ' data-populate-corner="' . e((string) ($overlay['corner'] ?? 'top-left')) . '"'
            . ' data-populate-selected-asset="' . e((string) ($overlay['selected_asset'] ?? '')) . '"'
            . ' data-populate-image-label="' . e($imageLabel) . '"'
            . ' data-populate-offset-x="' . e((string) ($overlay['offset_x'] ?? 0)) . '"'
            . ' data-populate-offset-y="' . e((string) ($overlay['offset_y'] ?? 0)) . '"'
            . ' data-populate-width="' . e((string) ($overlay['width'] ?? 180)) . '"'
            . ' data-populate-rotation="' . e((string) ($overlay['rotation'] ?? 0)) . '"'
            . ' data-populate-enabled="' . (((bool) ($overlay['enabled'] ?? true)) ? '1' : '0') . '">'
            . e($label) . '</option>';
    }

    return $html;
}

function jok_layer_section_overlay_table(array $snapshot): string
{
    $records = jok_layer_overlay_records($snapshot);
    if ($records === []) {
        return '<p class="form-help">No corner overlays are saved yet. Use the add/move form or open a page in overlay placement mode.</p>';
    }

    $rows = '';
    foreach ($records as $overlay) {
        $rows .= '<tr>';
        $rows .= '<td><code>' . e((string) ($overlay['route'] ?? '')) . '</code></td>';
        $rows .= '<td><code>' . e((string) ($overlay['section_handle'] ?? '')) . '</code></td>';
        $rows .= '<td>' . e((string) ($overlay['corner'] ?? '')) . '</td>';
        $rows .= '<td>' . e((string) ($overlay['selected_asset'] ?? '')) . '</td>';
        $rows .= '<td>' . e((string) ($overlay['offset_x'] ?? 0)) . ', ' . e((string) ($overlay['offset_y'] ?? 0)) . '</td>';
        $rows .= '<td>' . e((string) ($overlay['width'] ?? 180)) . 'px</td>';
        $rows .= '<td>' . e((string) ($overlay['rotation'] ?? 0)) . '°</td>';
        $rows .= '<td>' . (((bool) ($overlay['enabled'] ?? true)) ? 'Enabled' : 'Disabled') . '</td>';
        $href = page_url('/site-layers/media/') . '?' . http_build_query(['operation' => 'configure_section_overlay', 'overlay_id' => (string) ($overlay['overlay_id'] ?? $overlay['key'] ?? '')]);
        $rows .= '<td><a class="button button--ghost" href="' . e($href) . '#mvp-operations">Edit</a></td>';
        $rows .= '</tr>';
    }

    return '<div class="layer-table-wrap"><table class="layer-table"><thead><tr><th>Route</th><th>Section</th><th>Corner</th><th>Image</th><th>X/Y</th><th>Width</th><th>Rotation</th><th>Status</th><th>Action</th></tr></thead><tbody>' . $rows . '</tbody></table></div>';
}

function jok_layer_section_order_table(array $routes): string
{
    $rows = '';
    foreach ($routes as $route) {
        foreach (($route['section_handles'] ?? []) as $handle) {
            $rows .= '<tr draggable="true" data-section-order-row data-route="' . e($route['route']) . '" data-handle="' . e($handle) . '">';
            $rows .= '<td class="section-order-table__drag" aria-label="Drag handle">↕</td>';
            $rows .= '<td><code>' . e($handle) . '</code><span>' . e($route['route'] . ' — ' . $route['label']) . '</span></td>';
            $rows .= '<td class="section-order-table__actions"><button type="button" class="button button--ghost" data-section-move="up">↑</button><button type="button" class="button button--ghost" data-section-move="down">↓</button></td>';
            $rows .= '</tr>';
        }
    }

    return '<div class="section-order-editor" data-section-order-editor>'
        . '<p class="form-help">Drag rows or use arrows to set the order. The saved handle list updates automatically below.</p>'
        . '<div class="section-order-table-wrap"><table class="section-order-table"><thead><tr><th>Move</th><th>Section</th><th>Actions</th></tr></thead><tbody>' . $rows . '</tbody></table></div>'
        . '<label>Saved section order<textarea name="section_order" data-section-order-output readonly required></textarea></label>'
        . '</div>';
}

function jok_layer_language_token_options(array $routes): string
{
    $tokens = [];
    foreach ($routes as $route) {
        foreach (($route['language_tokens'] ?? []) as $token) {
            $value = (string) ($token['token'] ?? '');
            if ($value !== '') {
                $tokens[$value] = $value;
            }
        }
    }
    ksort($tokens);

    $entries = [];
    foreach (language_entries() as $entry) {
        if (!is_array($entry)) {
            continue;
        }
        $token = (string) ($entry['token'] ?? '');
        if ($token !== '') {
            $entries[$token] = (string) ($entry['canonical_text'] ?? '');
        }
    }

    $html = '';
    foreach ($tokens as $value => $label) {
        $html .= '<option value="' . e($value) . '" data-populate-canonical-text="' . e($entries[$value] ?? '') . '">' . e($label) . '</option>';
    }

    return $html;
}

function jok_layer_image_metadata_style(array $metadata): string
{
    $focusX = max(0, min(100, (float) ($metadata['focus_x'] ?? 50)));
    $focusY = max(0, min(100, (float) ($metadata['focus_y'] ?? 50)));
    $zoom = max(100, min(250, (float) ($metadata['zoom'] ?? 100)));
    $cropX = max(-100, min(100, (float) ($metadata['crop_x'] ?? 0)));
    $cropY = max(-100, min(100, (float) ($metadata['crop_y'] ?? 0)));
    $ratio = preg_replace('/[^a-z0-9_-]/', '', (string) ($metadata['aspect_ratio'] ?? 'wide')) ?: 'wide';

    return '--asset-focus-x:' . $focusX . '%;--asset-focus-y:' . $focusY . '%;--asset-zoom:' . $zoom . '%;--asset-crop-x:' . $cropX . 'px;--asset-crop-y:' . $cropY . 'px;--asset-ratio:' . $ratio . ';';
}

function jok_layer_image_metadata(array $snapshot, string $image, ?string $section = null, ?string $route = null): array
{
    $state = $snapshot['state'] ?? [];
    $defaults = ['selected_asset' => $image, 'section_handle' => $section ?? 'global.media_inventory', 'focus_x' => 50, 'focus_y' => 50, 'zoom' => 100, 'crop_x' => 0, 'crop_y' => 0, 'aspect_ratio' => 'wide'];
    $metadata = $state['image_asset_metadata'][$image][$section ?? 'global.media_inventory'] ?? [];
    if (is_array($metadata) && $route !== null && isset($metadata['route']) && (string) $metadata['route'] !== '' && (string) $metadata['route'] !== $route) {
        $metadata = [];
    }
    if ($metadata === []) {
        $metadata = $state['image_asset_metadata'][$image]['global.media_inventory'] ?? [];
    }
    $metadata = is_array($metadata) ? array_merge($defaults, $metadata) : $defaults;
    $metadata['selected_asset'] = basename((string) ($metadata['selected_asset'] ?? $image)) ?: $image;

    return $metadata;
}

function jok_layer_image_label(array $snapshot, string $asset): string
{
    $asset = basename($asset);
    $state = $snapshot['state'] ?? [];
    $label = $state['image_labels'][$asset] ?? '';
    if (is_string($label) && trim($label) !== '') {
        return trim($label);
    }

    foreach (($state['uploaded_images'] ?? []) as $upload) {
        if (!is_array($upload) || basename((string) ($upload['uploaded_image'] ?? '')) !== $asset) {
            continue;
        }
        $uploadLabel = $upload['label'] ?? '';
        if (is_string($uploadLabel) && trim($uploadLabel) !== '') {
            return trim($uploadLabel);
        }
    }

    $base = pathinfo($asset, PATHINFO_FILENAME);
    $base = str_replace(['-', '_'], ' ', $base);
    $base = trim(preg_replace('/\s+/', ' ', $base) ?? '');

    return $base !== '' ? ucwords($base) : $asset;
}

function jok_layer_image_option_label(array $snapshot, string $asset): string
{
    $label = jok_layer_image_label($snapshot, $asset);
    return $label !== $asset ? $label . ' — ' . $asset : $asset;
}

function jok_layer_available_image_assets(array $snapshot): array
{
    $images = [];
    foreach (($snapshot['approved_images'] ?? image_inventory()) as $image) {
        $basename = basename((string) $image);
        if ($basename !== '') {
            $images[$basename] = $basename;
        }
    }

    $assetDir = jok_layer_public_root() . '/assets/img';
    foreach (glob($assetDir . '/*.{webp,png,jpg,jpeg,gif}', GLOB_BRACE) ?: [] as $path) {
        $basename = basename($path);
        if ($basename !== '') {
            $images[$basename] = $basename;
        }
    }

    foreach (($snapshot['state']['uploaded_images'] ?? []) as $upload) {
        if (!is_array($upload)) {
            continue;
        }
        $basename = basename((string) ($upload['uploaded_image'] ?? ''));
        if ($basename !== '') {
            $images[$basename] = $basename;
        }
    }

    ksort($images);
    return array_values($images);
}

function jok_layer_image_asset_options(array $snapshot, ?string $selected = null): string
{
    $html = '';
    foreach (jok_layer_available_image_assets($snapshot) as $asset) {
        $isSelected = $selected !== null && $asset === $selected ? ' selected' : '';
        $html .= '<option value="' . e($asset) . '"' . $isSelected . ' data-populate-image-label="' . e(jok_layer_image_label($snapshot, $asset)) . '">' . e(jok_layer_image_option_label($snapshot, $asset)) . '</option>';
    }

    return $html;
}


function jok_layer_route_image_records(array $route): array
{
    $records = [];
    foreach (($route['sections'] ?? []) as $section) {
        if (!is_array($section)) {
            continue;
        }
        foreach (($section['image_handles'] ?? []) as $asset) {
            $asset = basename((string) $asset);
            if ($asset === '') {
                continue;
            }
            $key = (string) ($section['handle'] ?? 'section') . '|' . $asset;
            $records[$key] = [
                'route' => (string) ($route['route'] ?? ''),
                'section_handle' => (string) ($section['handle'] ?? ''),
                'asset' => $asset,
            ];
        }
    }

    if ($records === []) {
        foreach (($route['image_handles'] ?? []) as $asset) {
            $asset = basename((string) $asset);
            if ($asset !== '') {
                $records['route|' . $asset] = ['route' => (string) ($route['route'] ?? ''), 'section_handle' => 'route.media_inventory', 'asset' => $asset];
            }
        }
    }

    return array_values($records);
}

function jok_layer_route_media_anchor(string $route): string
{
    return preg_replace('/[^a-z0-9]+/', '-', strtolower(trim($route, '/') ?: 'home')) ?: 'home';
}

function jok_layer_render_page_image_card(array $snapshot, string $action, string $image, string $section, string $route): void
{
    $metadata = jok_layer_image_metadata($snapshot, $image, $section, $route);
    ?>
    <form class="image-asset-card" method="post" action="<?= $action ?>" enctype="multipart/form-data" data-image-crop-editor>
      <input type="hidden" name="operation" value="configure_image_asset">
      <input type="hidden" name="return_to" value="<?= e(jok_layer_current_return_path()) ?>">
      <input type="hidden" name="image_handle" value="<?= e($image) ?>">
      <input type="hidden" name="selected_asset" value="<?= e((string) ($metadata['selected_asset'] ?? $image)) ?>">
      <input type="hidden" name="section_handle" value="<?= e($section) ?>">
      <input type="hidden" name="route" value="<?= e($route) ?>">
      <span class="layer-card__handle"><?= e($section) ?></span>
      <button class="image-slot image-crop-editor__preview image-crop-editor__picker" type="button" data-image-crop-preview data-image-picker-open data-asset-base="<?= e(asset_base_url()) ?>"<?= jok_layer_asset_metadata_style_attr((string) ($metadata['selected_asset'] ?? $image), $metadata) ?>>
        <strong><?= e(jok_layer_image_label($snapshot, (string) ($metadata['selected_asset'] ?? $image))) ?></strong>
        <small><?= e((string) ($metadata['selected_asset'] ?? $image)) ?></small>
        <span>Click image to choose or upload a replacement for this page section.</span>
      </button>
      <?= jok_layer_image_picker_dialog($snapshot, (string) ($metadata['selected_asset'] ?? $image)) ?>
      <div class="image-asset-card__controls">
        <label>Name label<input name="image_label" maxlength="120" value="<?= e(jok_layer_image_label($snapshot, (string) ($metadata['selected_asset'] ?? $image))) ?>"></label>
        <label>Focus X<input type="range" name="focus_x" min="0" max="100" value="<?= e((string) $metadata['focus_x']) ?>"></label>
        <label>Focus Y<input type="range" name="focus_y" min="0" max="100" value="<?= e((string) $metadata['focus_y']) ?>"></label>
        <label>Zoom<input type="range" name="zoom" min="100" max="250" value="<?= e((string) $metadata['zoom']) ?>"></label>
        <label>Crop X<input type="range" name="crop_x" min="-100" max="100" value="<?= e((string) $metadata['crop_x']) ?>"></label>
        <label>Crop Y<input type="range" name="crop_y" min="-100" max="100" value="<?= e((string) $metadata['crop_y']) ?>"></label>
        <label>Aspect<select name="aspect_ratio"><option value="wide"<?= ($metadata['aspect_ratio'] ?? 'wide') === 'wide' ? ' selected' : '' ?>>Wide</option><option value="square"<?= ($metadata['aspect_ratio'] ?? '') === 'square' ? ' selected' : '' ?>>Square</option><option value="portrait"<?= ($metadata['aspect_ratio'] ?? '') === 'portrait' ? ' selected' : '' ?>>Portrait</option><option value="banner"<?= ($metadata['aspect_ratio'] ?? '') === 'banner' ? ' selected' : '' ?>>Banner</option></select></label>
      </div>
      <button class="button button--fire" type="submit">Save page image metadata</button>
    </form>
    <?php
}

function jok_layer_render_route_image_inventory(array $snapshot, string $action): void
{
    foreach (($snapshot['routes'] ?? []) as $route) {
        if (!is_array($route) || ($route['image_handles'] ?? []) === []) {
            continue;
        }
        $records = jok_layer_route_image_records($route);
        if ($records === []) {
            continue;
        }
        $anchor = jok_layer_route_media_anchor((string) ($route['route'] ?? ''));
        ?>
        <section class="layer-panel layer-panel--route-media" aria-labelledby="media-route-<?= e($anchor) ?>">
          <p class="eyebrow">Approved image inventory · <?= e((string) $route['route']) ?></p>
          <h3 id="media-route-<?= e($anchor) ?>"><?= e((string) $route['title']) ?></h3>
          <p>Images are grouped by page and section handle so each route can be edited without searching the global asset pool.</p>
          <div class="layer-grid layer-grid--media">
            <?php foreach ($records as $record): ?>
              <?php jok_layer_render_page_image_card($snapshot, $action, (string) $record['asset'], (string) $record['section_handle'], (string) $record['route']); ?>
            <?php endforeach; ?>
          </div>
        </section>
        <?php
    }
}

function jok_layer_asset_metadata_style_attr(string $image, array $metadata = []): string
{
    $basename = basename($image);
    $style = "--asset-image:url('" . asset_base_url() . rawurlencode($basename) . "');" . jok_layer_image_metadata_style($metadata);

    return ' style="' . e($style) . '"';
}


function jok_layer_image_handle_options_with_metadata(array $snapshot): string
{
    $html = '';
    foreach (($snapshot['approved_images'] ?? image_inventory()) as $image) {
        $image = (string) $image;
        $metadata = jok_layer_image_metadata($snapshot, $image);
        $html .= '<option value="' . e($image) . '"'
            . ' data-populate-selected-asset="' . e((string) ($metadata['selected_asset'] ?? $image)) . '"'
            . ' data-populate-section-handle="' . e((string) ($metadata['section_handle'] ?? 'global.media_inventory')) . '"'
            . ' data-populate-focus-x="' . e((string) ($metadata['focus_x'] ?? 50)) . '"'
            . ' data-populate-focus-y="' . e((string) ($metadata['focus_y'] ?? 50)) . '"'
            . ' data-populate-zoom="' . e((string) ($metadata['zoom'] ?? 100)) . '"'
            . ' data-populate-crop-x="' . e((string) ($metadata['crop_x'] ?? 0)) . '"'
            . ' data-populate-crop-y="' . e((string) ($metadata['crop_y'] ?? 0)) . '"'
            . ' data-populate-aspect-ratio="' . e((string) ($metadata['aspect_ratio'] ?? 'wide')) . '"'
            . ' data-populate-image-label="' . e(jok_layer_image_label($snapshot, (string) ($metadata['selected_asset'] ?? $image))) . '">' . e(jok_layer_image_option_label($snapshot, $image)) . '</option>';
    }

    return $html;
}

function jok_layer_image_picker_dialog(array $snapshot, ?string $selected = null): string
{
    $options = jok_layer_image_asset_options($snapshot, $selected);

    return '<dialog class="image-picker-dialog" data-image-picker-dialog>'
        . '<div class="image-picker-dialog__inner">'
        . '<h4>Choose image asset</h4>'
        . '<p class="form-help">Pick an existing uploaded/approved image, or upload a new image. The selection is saved when you save crop metadata.</p>'
        . '<label>Available image<select name="selected_asset" data-populate-targets="image_label">' . $options . '</select></label>'
        . '<label>Name label<input name="image_label" maxlength="120" placeholder="Operator-friendly name for this image"></label>'
        . '<label>Upload new image<input type="file" name="image_upload" accept=".webp,.png,.jpg,.jpeg,.gif"></label>'
        . '<button class="button button--ghost" type="button" data-image-picker-close>Use this image</button>'
        . '</div>'
        . '</dialog>';
}

function jok_layer_image_handle_options(array $images): string
{
    $options = [];
    foreach ($images as $image) {
        $options[(string) $image] = (string) $image;
    }

    return jok_layer_select_options($options);
}

function jok_layer_render_dropdown_population_script(): void
{
    static $rendered = false;
    if ($rendered) {
        return;
    }
    $rendered = true;
    ?>
      <script>
        (() => {
          if (window.__jokDropdownPopulationReady) return;
          window.__jokDropdownPopulationReady = true;
          const applyPopulation = (select) => {
            const option = select.selectedOptions && select.selectedOptions.length > 0 ? select.selectedOptions[0] : null;
            if (!option) return;
            Object.entries(option.dataset).forEach(([key, value]) => {
              if (!key.startsWith('populate')) return;
              const rawName = key.slice('populate'.length);
              const targetName = rawName.replace(/[A-Z]/g, (letter, index) => (index === 0 ? '' : '_') + letter.toLowerCase());
              const form = select.closest('form') || document;
              const targets = Array.from(form.querySelectorAll(`[name="${CSS.escape(targetName)}"], [data-populate-target="${CSS.escape(targetName)}"]`));
              targets.forEach((target) => {
                if (target.type === 'checkbox') {
                  target.checked = value === '1' || value === 'true';
                } else if (target.type !== 'file') {
                  target.value = value || '';
                }
                target.dispatchEvent(new Event('input', { bubbles: true }));
                target.dispatchEvent(new Event('change', { bubbles: true }));
              });
            });
          };
          document.addEventListener('change', (event) => {
            const select = event.target.closest('select[data-populate-targets]');
            if (select) applyPopulation(select);
          });
          document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('select[data-populate-targets][data-populate-on-load="true"]').forEach(applyPopulation);
          });
        })();
      </script>
    <?php
}

function jok_layer_render_image_crop_script(): void
{
    static $rendered = false;
    if ($rendered) {
        return;
    }
    $rendered = true;
    ?>
      <script>
        (() => {
          if (window.__jokImageCropControlsReady) return;
          window.__jokImageCropControlsReady = true;
          const sync = (editor) => {
            const preview = editor.querySelector('[data-image-crop-preview]');
            if (!preview) return;
            const form = editor.closest('form') || editor;
            const get = (name, fallback) => {
              const controls = Array.from(form.querySelectorAll(`[name="${name}"]`)).filter((control) => control.type !== 'file');
              const control = controls.length > 0 ? controls[controls.length - 1] : null;
              return control?.value || fallback;
            };
            const asset = get('selected_asset', get('image_handle', ''));
            if (asset) {
              preview.style.setProperty('--asset-image', `url('${preview.dataset.assetBase || ''}${encodeURIComponent(asset)}')`);
              const label = preview.querySelector('strong');
              if (label) label.textContent = get('image_label', '') || asset;
            }
            preview.style.setProperty('--asset-focus-x', `${get('focus_x', '50')}%`);
            preview.style.setProperty('--asset-focus-y', `${get('focus_y', '50')}%`);
            preview.style.setProperty('--asset-zoom', `${get('zoom', '100')}%`);
            preview.style.setProperty('--asset-crop-x', `${get('crop_x', '0')}px`);
            preview.style.setProperty('--asset-crop-y', `${get('crop_y', '0')}px`);
            preview.dataset.aspectRatio = get('aspect_ratio', 'wide');
          };
          const closeDialog = (dialog) => {
            if (!dialog) return;
            if (typeof dialog.close === 'function') dialog.close();
            else dialog.hidden = true;
          };
          const editorFromControl = (target) => {
            const directEditor = target.closest('[data-image-crop-editor]');
            if (directEditor) return directEditor;
            const form = target.closest('form');
            return form ? form.querySelector('[data-image-crop-editor]') : null;
          };
          document.addEventListener('input', (event) => {
            const editor = editorFromControl(event.target);
            if (editor) sync(editor);
          });
          document.addEventListener('change', (event) => {
            const editor = editorFromControl(event.target);
            if (editor) sync(editor);
          });
          document.addEventListener('click', (event) => {
            const trigger = event.target.closest('[data-image-picker-open]');
            if (trigger) {
              const editor = editorFromControl(trigger);
              const dialog = editor?.querySelector('[data-image-picker-dialog]');
              if (dialog) {
                if (typeof dialog.showModal === 'function') dialog.showModal();
                else dialog.hidden = false;
              }
            }
            const close = event.target.closest('[data-image-picker-close]');
            if (close) closeDialog(close.closest('[data-image-picker-dialog]'));
          });
          document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[data-image-crop-editor]').forEach(sync);
          });
        })();
      </script>
    <?php
}

function jok_layer_render_overlay_control_script(): void
{
    static $rendered = false;
    if ($rendered) {
        return;
    }
    $rendered = true;
    ?>
    <script>
      (() => {
        const sync = (editor) => {
          const preview = editor.querySelector('[data-overlay-preview-image]');
          if (!preview) return;
          const form = editor.closest('form') || editor;
          const get = (name, fallback = '') => form.querySelector(`[name="${name}"]`)?.value || fallback;
          const asset = get('selected_asset');
          const base = preview.dataset.assetBase || '';
          const corner = get('corner', 'top-left');
          const offsetX = Number(get('offset_x', '0'));
          const offsetY = Number(get('offset_y', '0'));
          const width = Math.max(32, Math.min(640, Number(get('width', '180'))));
          const rotation = Math.max(-1080, Math.min(1080, Number(get('rotation', '0'))));
          preview.hidden = asset === '';
          preview.src = asset === '' ? '' : base + encodeURIComponent(asset);
          preview.style.width = `${width}px`;
          preview.style.setProperty('--jok-overlay-rotation', `${rotation}deg`);
          preview.dataset.corner = corner;
          preview.style.left = corner.includes('left') ? `${offsetX}px` : 'auto';
          preview.style.right = corner.includes('right') ? `${-offsetX}px` : 'auto';
          preview.style.top = corner.includes('top') ? `${offsetY}px` : 'auto';
          preview.style.bottom = corner.includes('bottom') ? `${-offsetY}px` : 'auto';
        };
        document.addEventListener('input', (event) => {
          const editor = event.target.closest('form')?.querySelector('[data-section-overlay-editor]');
          if (editor) sync(editor);
        });
        document.addEventListener('change', (event) => {
          const editor = event.target.closest('form')?.querySelector('[data-section-overlay-editor]');
          if (editor) sync(editor);
        });
        document.addEventListener('click', (event) => {
          const button = event.target.closest('[data-overlay-nudge]');
          if (!button) return;
          const editor = button.closest('[data-section-overlay-editor]');
          const form = editor?.closest('form');
          const axis = button.dataset.overlayNudge;
          const inputName = axis === 'rotation' ? 'rotation' : `offset_${axis}`;
          const input = form?.querySelector(`[name="${inputName}"]`);
          if (!input || !editor) return;
          input.value = String(Number(input.value || 0) + Number(button.dataset.step || 0));
          sync(editor);
        });
        document.querySelectorAll('[data-section-overlay-editor]').forEach(sync);
      })();
    </script>
    <?php
}

function jok_layer_render_section_order_script(): void
{
    static $rendered = false;
    if ($rendered) {
        return;
    }
    $rendered = true;
    ?>
      <script>
        (() => {
          if (window.__jokSectionOrderEditorReady) return;
          window.__jokSectionOrderEditorReady = true;
          const visibleRows = (editor) => Array.from(editor.querySelectorAll('[data-section-order-row]')).filter((row) => !row.hidden);
          const sync = (editor) => {
            const output = editor.querySelector('[data-section-order-output]');
            if (!output) return;
            output.value = visibleRows(editor).map((row) => row.dataset.handle || '').filter(Boolean).join('\n');
          };
          const filterSectionSelect = (form) => {
            const routeSelect = form ? form.querySelector('select[name="route"]') : null;
            const route = routeSelect ? routeSelect.value : '';
            const sectionSelect = form ? form.querySelector('select[name="section_handle"]') : null;
            if (!sectionSelect) return;
            sectionSelect.querySelectorAll('optgroup').forEach((group) => {
              group.hidden = Boolean(route) && group.dataset.route !== route;
            });
            sectionSelect.querySelectorAll('option').forEach((option) => {
              option.hidden = Boolean(route) && option.dataset.route !== route;
            });
            const firstVisible = Array.from(sectionSelect.options).find((option) => !option.hidden);
            const selectedOption = sectionSelect.selectedOptions.length > 0 ? sectionSelect.selectedOptions[0] : null;
            if (firstVisible && selectedOption && selectedOption.hidden) {
              sectionSelect.value = firstVisible.value;
            }
          };
          const filter = (editor) => {
            const form = editor.closest('form');
            const routeSelect = form ? form.querySelector('select[name="route"]') : null;
            const route = routeSelect ? routeSelect.value : '';
            editor.querySelectorAll('[data-section-order-row]').forEach((row) => {
              row.hidden = Boolean(route) && row.dataset.route !== route;
            });
            sync(editor);
          };
          const move = (row, direction) => {
            const rows = visibleRows(row.closest('[data-section-order-editor]'));
            const index = rows.indexOf(row);
            const sibling = direction === 'up' ? rows[index - 1] : rows[index + 1];
            if (!sibling) return;
            if (direction === 'up') {
              row.parentNode.insertBefore(row, sibling);
            } else {
              row.parentNode.insertBefore(sibling, row);
            }
            sync(row.closest('[data-section-order-editor]'));
            row.focus();
          };
          document.addEventListener('click', (event) => {
            const button = event.target.closest('[data-section-move]');
            if (!button) return;
            const row = button.closest('[data-section-order-row]');
            if (row) move(row, button.dataset.sectionMove);
          });
          document.addEventListener('dragstart', (event) => {
            const row = event.target.closest('[data-section-order-row]');
            if (!row) return;
            row.classList.add('is-dragging');
            event.dataTransfer.effectAllowed = 'move';
          });
          document.addEventListener('dragend', (event) => {
            const row = event.target.closest('[data-section-order-row]');
            if (!row) return;
            row.classList.remove('is-dragging');
            sync(row.closest('[data-section-order-editor]'));
          });
          document.addEventListener('dragover', (event) => {
            const overRow = event.target.closest('[data-section-order-row]');
            const dragging = document.querySelector('[data-section-order-row].is-dragging');
            if (!overRow || !dragging || overRow === dragging || overRow.hidden || dragging.dataset.route !== overRow.dataset.route) return;
            event.preventDefault();
            const rect = overRow.getBoundingClientRect();
            const before = event.clientY < rect.top + rect.height / 2;
            overRow.parentNode.insertBefore(dragging, before ? overRow : overRow.nextSibling);
          });
          document.addEventListener('change', (event) => {
            if (!event.target.matches('form select[name="route"]')) return;
            const form = event.target.closest('form');
            filterSectionSelect(form);
            const editor = form ? form.querySelector('[data-section-order-editor]') : null;
            if (editor) filter(editor);
          });
          document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('form').forEach(filterSectionSelect);
            document.querySelectorAll('[data-section-order-editor]').forEach(filter);
          });
        })();
      </script>
    <?php
}

function jok_layer_render_operation_form(string $operation, array $snapshot, string $activeLayer = 'overview'): void
{
    $prefillRoute = (string) ($_GET['route'] ?? '');
    $prefillSection = (string) ($_GET['section_handle'] ?? '');
    $prefillCorner = (string) ($_GET['corner'] ?? 'top-left');
    $prefillOverlayId = (string) ($_GET['overlay_id'] ?? '');
    $prefillOverlay = jok_layer_find_overlay_record($snapshot, $prefillOverlayId);
    if ($prefillOverlay !== null) {
        $prefillRoute = (string) ($prefillOverlay['route'] ?? $prefillRoute);
        $prefillSection = (string) ($prefillOverlay['section_handle'] ?? $prefillSection);
        $prefillCorner = (string) ($prefillOverlay['corner'] ?? $prefillCorner);
    }
    $routeOptions = jok_layer_route_options($snapshot['routes'], $prefillRoute !== '' ? $prefillRoute : null);
    $sectionOptions = jok_layer_section_handle_options($snapshot['routes'], $prefillSection !== '' ? $prefillSection : null);
    $sectionOrderTable = jok_layer_section_order_table($snapshot['routes']);
    $languageTokenOptions = jok_layer_language_token_options($snapshot['routes']);
    $imageOptions = jok_layer_image_asset_options($snapshot);
    $action = e(rel_url('site-layer-save.php'));
    $cards = [
        'save_edits' => ['title' => 'Save section edits', 'label' => 'Most used', 'desc' => 'Record visual treatment for one section without editing the template directly.'],
        'publish_changes' => ['title' => 'Publish saved state', 'label' => 'Most used', 'desc' => 'Copy the current draft controls JSON into the published MVP snapshot.'],
        'reorder_sections' => ['title' => 'Reorder route sections', 'label' => 'Structure', 'desc' => 'Save the desired order as handles so a template refactor has an operator-readable plan.'],
        'toggle_visibility' => ['title' => 'Hide or show section', 'label' => 'Structure', 'desc' => 'Save section visibility intent for later template enforcement.'],
        'edit_language' => ['title' => 'Edit language token', 'label' => 'Copy', 'desc' => 'Update a registered canonical text token in language.json.'],
        'upload_image' => ['title' => 'Upload image asset', 'label' => 'Media', 'desc' => 'Add an approved-format file into public assets/img for later selection, with an operator-readable label.'],
        'update_image_label' => ['title' => 'Edit image name label', 'label' => 'Media', 'desc' => 'Rename an existing image label so dropdowns are easier to scan without changing the filename.'],
        'replace_image_handle' => ['title' => 'Replace image handle', 'label' => 'Media', 'desc' => 'Record or optionally patch a discovered route image handle in a route template.'],
        'configure_image_asset' => ['title' => 'Crop / position image asset', 'label' => 'Media', 'desc' => 'Save focal point, zoom, crop offset, and aspect-ratio metadata for one approved image area.'],
        'configure_section_overlay' => ['title' => 'Add / move corner image', 'label' => 'Media', 'desc' => 'Attach a decorative image to a primary section corner, then adjust X/Y offsets while it remains pinned by image center.'],
        'change_css' => ['title' => 'Append CSS block', 'label' => 'Style', 'desc' => 'Append a reviewed CSS block to the public stylesheet.'],
        'change_template' => ['title' => 'Append template note', 'label' => 'Behavior', 'desc' => 'Attach an implementation note to a selected PHP route file without breaking rendering.'],
        'write_file' => ['title' => 'Write operator file', 'label' => 'Review', 'desc' => 'Create a markdown, text, or JSON note in the site-layer writes folder.'],
    ];
    $meta = $cards[$operation] ?? ['title' => $operation, 'label' => $activeLayer, 'desc' => ''];
    $multipart = in_array($operation, ['upload_image', 'configure_image_asset', 'configure_section_overlay'], true) ? ' enctype="multipart/form-data"' : '';
    ?>
      <form class="section-handle-card layer-operation-card" method="post"<?= $multipart ?> action="<?= $action ?>">
        <input type="hidden" name="operation" value="<?= e($operation) ?>">
        <input type="hidden" name="return_to" value="<?= e(jok_layer_current_return_path()) ?>">
        <span class="layer-card__handle"><?= e($meta['label']) ?></span>
        <h3><?= e($meta['title']) ?></h3>
        <p><?= e($meta['desc']) ?></p>
        <?php if ($operation === 'save_edits'): ?>
          <label>Route<select name="route"><?= $routeOptions ?></select></label>
          <label>Section handle<select name="section_handle" required><?= $sectionOptions ?></select></label>
          <div class="control-grid">
            <label>Text alignment<select name="text_alignment"><option value="current">Current CSS</option><option value="left">Left</option><option value="right">Right</option><option value="center">Center</option></select></label>
            <label>Headline scale<select name="headline_scale"><option value="current">Current CSS</option><option value="large">Large</option><option value="poster">Poster</option></select></label>
            <label>Image placement<select name="image_placement"><option value="current">Current template</option><option value="background">Background</option><option value="left_column">Left column</option><option value="right_column">Right column</option><option value="inline">Inline</option></select></label>
            <label>Animation preset<select name="animation_preset"><option value="none">None/current</option><option value="fade_up">Fade up</option><option value="chrome_glint">Chrome glint</option><option value="ember_drift">Ember drift</option></select></label>
          </div>
        <?php elseif ($operation === 'publish_changes'): ?>
          <label>Publish note<textarea name="publish_note">Publish current Site Layer Controls MVP state.</textarea></label>
        <?php elseif ($operation === 'reorder_sections'): ?>
          <label>Route<select name="route"><?= $routeOptions ?></select></label><?= $sectionOrderTable ?>
        <?php elseif ($operation === 'toggle_visibility'): ?>
          <label>Route<select name="route"><?= $routeOptions ?></select></label><label>Section handle<select name="section_handle" required><?= $sectionOptions ?></select></label><label>Visibility<select name="visible"><option value="1">Show</option><option value="0">Hide</option></select></label>
        <?php elseif ($operation === 'edit_language'): ?>
          <label>Language token<select name="language_token" required data-populate-targets="canonical_text" data-populate-on-load="true"><?= $languageTokenOptions ?></select></label><label>Canonical text<textarea name="canonical_text" required></textarea></label>
        <?php elseif ($operation === 'upload_image'): ?>
          <label>Name label<input name="image_label" maxlength="120" placeholder="Optional; blank uses a system label"></label>
          <label>Image file<input type="file" name="image_upload" accept=".webp,.png,.jpg,.jpeg,.gif" required></label>
        <?php elseif ($operation === 'update_image_label'): ?>
          <label>Image asset<select name="selected_asset" required data-populate-targets="image_label" data-populate-on-load="true"><?= jok_layer_image_asset_options($snapshot) ?></select></label><label>Name label<input name="image_label" maxlength="120" placeholder="Operator-friendly name" required></label>
        <?php elseif ($operation === 'replace_image_handle'): ?>
          <label>Route<select name="route"><?= $routeOptions ?></select></label><label>Old image handle<select name="old_image_handle" required><?= $imageOptions ?></select></label><label>New image handle<select name="new_image_handle" required><?= $imageOptions ?></select></label><label><input type="checkbox" name="patch_template" value="1"> Patch selected route template now</label>
        <?php elseif ($operation === 'configure_image_asset'): ?>
          <label>Asset area<select name="image_handle" required data-populate-targets="focus_x focus_y zoom crop_x crop_y aspect_ratio selected_asset section_handle image_label" data-populate-on-load="true"><?= jok_layer_image_handle_options_with_metadata($snapshot) ?></select></label><label>Section handle<input name="section_handle" value="global.media_inventory"></label><input type="hidden" name="selected_asset" value="<?= e((string) (($snapshot['approved_images'][0] ?? '') ?: '')) ?>">
          <div class="image-crop-editor" data-image-crop-editor>
            <button class="image-slot image-crop-editor__preview image-crop-editor__picker" type="button" data-image-crop-preview data-image-picker-open data-asset-base="<?= e(asset_base_url()) ?>"<?= jok_layer_asset_metadata_style_attr($snapshot['approved_images'][0] ?? '') ?>><strong>Preview</strong><span>Click image to choose or upload a replacement, then save.</span></button>
            <?= jok_layer_image_picker_dialog($snapshot) ?>
            <div class="control-grid"><label>Name label<input name="image_label" maxlength="120" placeholder="Operator-friendly name"></label><label>Focus X<input type="range" name="focus_x" min="0" max="100" value="50"></label><label>Focus Y<input type="range" name="focus_y" min="0" max="100" value="50"></label><label>Zoom<input type="range" name="zoom" min="100" max="250" value="100"></label><label>Crop X<input type="range" name="crop_x" min="-100" max="100" value="0"></label><label>Crop Y<input type="range" name="crop_y" min="-100" max="100" value="0"></label><label>Aspect ratio<select name="aspect_ratio"><option value="wide">Wide</option><option value="square">Square</option><option value="portrait">Portrait</option><option value="banner">Banner</option></select></label></div>
            <button class="button button--ghost" type="submit" name="remove_background" value="1">Remove section background</button>
            <p class="form-help">Removing a section background keeps the section visible and functional, but renders its background transparent until a new image is saved.</p>
          </div>
        <?php elseif ($operation === 'configure_section_overlay'): ?>
          <?php
            $availableOverlayAssets = jok_layer_available_image_assets($snapshot);
            $overlayAsset = (string) ($prefillOverlay['selected_asset'] ?? ($availableOverlayAssets[0] ?? ''));
            $overlayOffsetX = (string) ($prefillOverlay['offset_x'] ?? 0);
            $overlayOffsetY = (string) ($prefillOverlay['offset_y'] ?? 0);
            $overlayWidth = (string) ($prefillOverlay['width'] ?? 180);
            $overlayRotation = (string) ($prefillOverlay['rotation'] ?? 0);
            $overlayEnabled = ((bool) ($prefillOverlay['enabled'] ?? true)) ? '1' : '0';
          ?>
          <label>Saved overlay<select name="overlay_id" data-populate-targets="route section_handle corner selected_asset image_label offset_x offset_y width rotation enabled" data-populate-on-load="true"><?= jok_layer_overlay_select_options($snapshot, $prefillOverlayId !== '' ? $prefillOverlayId : null) ?></select></label>
          <label>Route<select name="route"><?= $routeOptions ?></select></label><label>Section handle<select name="section_handle" required><?= $sectionOptions ?></select></label><label>Corner<select name="corner" required><?= jok_layer_corner_options($prefillCorner) ?></select></label><label>Image asset<select name="selected_asset" required data-populate-targets="image_label"><?= jok_layer_image_asset_options($snapshot, $overlayAsset) ?></select></label><label>Name label<input name="image_label" maxlength="120" value="<?= e((string) ($prefillOverlay['image_label'] ?? jok_layer_image_label($snapshot, $overlayAsset))) ?>" placeholder="Operator-friendly name"></label><label>Or upload image<input type="file" name="image_upload" accept=".webp,.png,.jpg,.jpeg,.gif"></label>
          <div class="section-overlay-editor" data-section-overlay-editor>
            <div class="section-overlay-preview" aria-label="Decorative corner overlay position preview"><img data-overlay-preview-image data-asset-base="<?= e(asset_base_url()) ?>" alt="" hidden></div>
            <div class="control-grid"><label>Offset X<input type="number" name="offset_x" min="-1200" max="1200" step="1" value="<?= e($overlayOffsetX) ?>"></label><label>Offset Y<input type="number" name="offset_y" min="-1200" max="1200" step="1" value="<?= e($overlayOffsetY) ?>"></label><label>Image width<input type="number" name="width" min="32" max="640" step="1" value="<?= e($overlayWidth) ?>"></label><label>Rotation degrees<input type="number" name="rotation" min="-1080" max="1080" step="1" value="<?= e($overlayRotation) ?>"></label><label>Status<select name="enabled"><option value="1"<?= $overlayEnabled === '1' ? ' selected' : '' ?>>Enabled</option><option value="0"<?= $overlayEnabled === '0' ? ' selected' : '' ?>>Disabled</option></select></label></div>
            <div class="overlay-nudge-grid" aria-label="Move overlay with arrow buttons"><button class="button button--ghost" type="button" data-overlay-nudge="y" data-step="-10">↑ 10px</button><button class="button button--ghost" type="button" data-overlay-nudge="x" data-step="-10">← 10px</button><button class="button button--ghost" type="button" data-overlay-nudge="x" data-step="10">→ 10px</button><button class="button button--ghost" type="button" data-overlay-nudge="y" data-step="10">↓ 10px</button><button class="button button--ghost" type="button" data-overlay-nudge="rotation" data-step="-15">↶ 15°</button><button class="button button--ghost" type="button" data-overlay-nudge="rotation" data-step="15">↷ 15°</button></div>
            <label class="consent"><input type="checkbox" name="remove_overlay" value="1"> Remove the selected saved overlay instead of saving it</label>
            <p class="form-help">Choose “Create a new overlay” to add another image without replacing existing corner images. Selecting a saved overlay loads its route, section, image, and position for editing.</p>
          </div>
        <?php elseif ($operation === 'change_css'): ?>
          <label>CSS block<textarea name="css_block" placeholder=".your-selector { color: var(--yellow); }" required></textarea></label>
        <?php elseif ($operation === 'change_template'): ?>
          <label>Route<select name="route"><?= $routeOptions ?></select></label><label>Template note to append<textarea name="template_note" required></textarea></label>
        <?php elseif ($operation === 'write_file'): ?>
          <label>Filename<input name="custom_filename" placeholder="owner-note.md" required></label><label>Contents<textarea name="custom_contents" required></textarea></label>
        <?php endif; ?>
        <button class="button button--fire" type="submit"><?= e($meta['title']) ?></button>
      </form>
      <?php jok_layer_render_dropdown_population_script(); ?>
      <?php jok_layer_render_section_order_script(); ?>
      <?php if ($operation === 'configure_image_asset') { jok_layer_render_image_crop_script(); } ?>
      <?php if ($operation === 'configure_section_overlay') { jok_layer_render_overlay_control_script(); } ?>
    <?php
}

function jok_layer_operations_for_layer(string $layer): array
{
    return [
        'overview' => ['save_edits', 'publish_changes', 'reorder_sections', 'toggle_visibility', 'edit_language', 'upload_image', 'update_image_label', 'configure_image_asset', 'configure_section_overlay', 'replace_image_handle', 'change_css', 'change_template', 'write_file'],
        'structure' => ['save_edits', 'reorder_sections', 'toggle_visibility', 'change_template', 'write_file'],
        'copy' => ['edit_language', 'save_edits', 'write_file', 'publish_changes'],
        'media' => ['upload_image', 'update_image_label', 'configure_image_asset', 'configure_section_overlay', 'replace_image_handle', 'save_edits', 'write_file'],
        'style' => ['save_edits', 'change_css', 'write_file', 'publish_changes'],
        'behavior' => ['save_edits', 'change_template', 'write_file', 'publish_changes'],
        'review' => ['write_file', 'publish_changes', 'save_edits', 'change_template'],
    ][$layer] ?? [];
}

function jok_render_layer_detail_page(string $activeLayer): void
{
    $snapshot = jok_layer_snapshot();
    $action = e(rel_url('site-layer-save.php'));
    $layers = $snapshot['layers'];
    if (!isset($layers[$activeLayer])) {
        http_response_code(404);
        render_header('Layer not found — Just One KISS', 'Unknown site layer control page.');
        echo '<main id="main" class="layer-control-shell"><section class="layer-hero"><p class="eyebrow">Site Layer Controls</p><h1>Layer not found.</h1><p class="section-lede">That layer handle is not part of the read-only v1 snapshot.</p><p><a class="button button--fire" href="' . e(page_url('/site-layers/')) . '">Back to layer overview</a></p></section></main>';
        render_footer();
        return;
    }

    $title = ucwords($activeLayer) . ' layer — Site Layer Controls';
    render_header($title, 'Enabled v2 MVP public-site layer controls for ' . $activeLayer . '.');
    ?>
<main id="main" class="layer-control-shell">
  <section class="layer-hero" aria-labelledby="layer-detail-title">
    <p class="eyebrow">Site Layer Controls · Enabled v2 MVP</p>
    <h1 id="layer-detail-title"><?= e(ucwords($activeLayer)) ?> layer</h1>
    <p class="section-lede"><?= e($layers[$activeLayer]) ?></p>
    <p>The most common <?= e($activeLayer) ?> controls are wired directly below this hero so an operator can act above the fold, then inspect page-specific inventory, and finally review raw data at the bottom.</p>
    <p><a class="button button--chrome" href="<?= e(page_url('/site-layers/')) ?>">Back to all layer handles</a></p>
  </section>

  <?php if (isset($_GET['message'])): ?>
    <section class="layer-panel <?= ($_GET['saved'] ?? '') === '1' ? 'notice--ok' : 'notice--error' ?>" aria-label="Operation result">
      <p class="eyebrow">Operation result</p>
      <h2><?= ($_GET['saved'] ?? '') === '1' ? 'Saved' : 'Needs attention' ?></h2>
      <p><?= e((string) $_GET['message']) ?></p>
    </section>
  <?php endif; ?>

  <section class="layer-panel layer-panel--primary" id="mvp-operations" aria-labelledby="primary-controls-title">
    <p class="eyebrow">Main operator panel</p>
    <h2 id="primary-controls-title">Most-used <?= e($activeLayer) ?> controls</h2>
    <p>These controls are wired to <code>site-layer-save.php</code>. They appear first so common changes are available before the inventory tables.</p>
    <div class="section-handle-list layer-operation-list">
      <?php foreach (jok_layer_operations_for_layer($activeLayer) as $operation): ?>
        <?php jok_layer_render_operation_form($operation, $snapshot, $activeLayer); ?>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="layer-panel" aria-labelledby="intent-map-title">
    <p class="eyebrow">Operator labels</p>
    <h2 id="intent-map-title">What this layer controls</h2>
    <div class="layer-grid">
      <?php foreach (($snapshot['control_intents'][$activeLayer] ?? []) as $handle => $description): ?>
        <article class="layer-card">
          <span class="layer-card__handle"><?= e($handle) ?></span>
          <h3><?= e(str_replace('.', ' ', $handle)) ?></h3>
          <p><?= e($description) ?></p>
          <p><strong>Status:</strong> wired to enabled MVP file-write controls where applicable.</p>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <?php if ($activeLayer === 'structure'): ?>
    <section class="layer-panel" aria-labelledby="legacy-awareness-title">
      <p class="eyebrow">Legacy awareness</p>
      <h2 id="legacy-awareness-title">Managed slots are inventory only.</h2>
      <p>Legacy <code>render_page_section_slot()</code> calls are listed so structure work can see them, but this v1 does not extend the old managed-section system or copy <code>proto/app/page_sections.php</code> / <code>proto/editor/index.php</code> as implementation patterns.</p>
    </section>
  <?php endif; ?>

  <section class="layer-panel" aria-labelledby="touching-routes-title">
    <p class="eyebrow">Route inventory</p>
    <h2 id="touching-routes-title">Routes touching this layer</h2>
    <div class="section-handle-list">
      <?php foreach ($snapshot['routes'] as $route): ?>
        <?php if (!in_array($activeLayer, $route['layers'], true)) { continue; } ?>
        <article class="section-handle-card">
          <div class="route-meta">
            <div>
              <span class="layer-card__handle"><?= e($route['route']) ?></span>
              <h3><?= e($route['title']) ?></h3>
              <p><?= e($route['summary']) ?></p>
            </div>
            <div class="route-meta__actions">
              <a class="button button--ghost" href="<?= e(page_url($route['route'])) ?>">View page</a>
              <a class="button button--chrome" href="<?= e(page_url($route['route']) . '?site_layer_editor=1') ?>">Open + corners</a>
            </div>
          </div>
          <p><strong>Sections:</strong> <?= count($route['sections']) ?> · <strong>Tokens:</strong> <?= count($route['language_tokens']) ?> · <strong>Images:</strong> <?= count($route['image_handles']) ?></p>
          <?php if ($activeLayer === 'copy'): ?>
            <p><strong>Token list:</strong> <?= jok_layer_badges($route['language_tokens']) ?></p>
          <?php endif; ?>
          <?php if ($activeLayer === 'media'): ?>
            <p><strong>Asset list:</strong> <?= jok_layer_badges($route['image_handles']) ?></p>
          <?php endif; ?>
          <?php if ($activeLayer === 'structure' && $route['legacy_slot_calls'] !== []): ?>
            <p><strong>Legacy slot calls:</strong> <?= jok_layer_badges($route['legacy_slot_calls']) ?> <em>inventory only</em></p>
          <?php endif; ?>
          <details>
            <summary>Section handles for this route</summary>
            <ul>
              <?php foreach ($route['sections'] as $section): ?>
                <li><code><?= e($section['handle']) ?></code> — <?= e(implode(', ', $section['layers'])) ?></li>
              <?php endforeach; ?>
            </ul>
          </details>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <?php if ($activeLayer === 'media'): ?>
    <section class="layer-panel" aria-labelledby="image-labels-title">
      <p class="eyebrow">Media labels</p>
      <h2 id="image-labels-title">Available image name labels</h2>
      <p>Use these edit buttons to rename uploaded or approved assets for dropdown clarity. The saved filename does not change.</p>
      <div class="layer-grid layer-grid--media">
        <?php foreach (jok_layer_available_image_assets($snapshot) as $asset): ?>
          <form class="image-slot image-label-card" method="post" action="<?= $action ?>"<?= asset_style($asset) ?>>
            <input type="hidden" name="operation" value="update_image_label">
            <input type="hidden" name="return_to" value="<?= e(jok_layer_current_return_path()) ?>">
            <input type="hidden" name="selected_asset" value="<?= e($asset) ?>">
            <strong><?= e(jok_layer_image_label($snapshot, $asset)) ?></strong>
            <small><?= e($asset) ?></small>
            <label>Name label<input name="image_label" maxlength="120" value="<?= e(jok_layer_image_label($snapshot, $asset)) ?>"></label>
            <button class="button button--ghost" type="submit">Edit name</button>
          </form>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="layer-panel" aria-labelledby="media-inventory-title">
      <p class="eyebrow">Media layer</p>
      <h2 id="media-inventory-title">Approved image inventory by page</h2>
      <p>Each page section below saves metadata against the section handle that /site-layers injects at runtime.</p>
    </section>
    <?php jok_layer_render_route_image_inventory($snapshot, $action); ?>
  <?php endif; ?>
  <?php if ($activeLayer === 'media' || $activeLayer === 'overview'): ?>
    <section class="layer-panel" aria-labelledby="corner-overlays-title">
      <p class="eyebrow">Corner overlays</p>
      <h2 id="corner-overlays-title">Saved section-corner images</h2>
      <?= jok_layer_section_overlay_table($snapshot) ?>
    </section>
  <?php endif; ?>

  <section class="layer-panel layer-panel--raw" aria-labelledby="raw-layer-data-title">
    <p class="eyebrow">Raw inventory and data</p>
    <h2 id="raw-layer-data-title">Raw <?= e($activeLayer) ?> layer snapshot</h2>
    <p>This bottom panel is intentionally last: it is for audit/debug review after the operator controls and curated route inventory.</p>
    <details open>
      <summary>Open raw JSON for this layer</summary>
      <pre class="raw-data-block"><code><?= e(json_encode([
          'generated_at' => $snapshot['generated_at'],
          'layer' => $activeLayer,
          'definition' => $layers[$activeLayer],
          'operations' => jok_layer_operations_for_layer($activeLayer),
          'control_intents' => $snapshot['control_intents'][$activeLayer] ?? [],
          'routes' => array_values(array_filter($snapshot['routes'], static fn (array $route): bool => in_array($activeLayer, $route['layers'], true))),
          'approved_images' => $activeLayer === 'media' ? $snapshot['approved_images'] : [],
      ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) ?></code></pre>
    </details>
  </section>
</main>
<?php
    jok_layer_render_image_crop_script();
    render_footer();
}
