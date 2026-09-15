<?php

declare(strict_types=1);

require_once __DIR__ . '/site_data.php';

function jok_layer_definitions(): array
{
    return [
        'structure' => 'Route files, hard-coded sections, section identity handles, order notes, and legacy managed-slot awareness.',
        'copy' => 'Language-token inventory from editable and text helpers before any future public copy write path exists.',
        'media' => 'Approved image inventory, asset_style() handles, placement intent, focal-point notes, and rights-safe review.',
        'style' => 'Alignment, typography scale, and panel treatment intent that can later map to safe CSS modifiers.',
        'behavior' => 'Forms, safe animation presets, reduced-motion boundaries, and protected JavaScript/form behavior.',
        'review' => 'Rights, safety, venue, camping, free-show, and public-ready review gates before any write path is enabled.',
    ];
}

function jok_layer_control_intents(): array
{
    return [
        'structure' => [
            'section.identity' => 'Assign stable handles to hard-coded sections, including no-id sections.',
            'section.visibility' => 'Draft future show/hide controls without removing PHP sections.',
            'section.order_notes' => 'Record desired order changes before any template refactor.',
        ],
        'copy' => [
            'token.grouping' => 'Group language tokens by route, section, role, and sensitivity.',
            'copy.scale_intent' => 'Mark text that should become larger without editing CSS directly.',
            'fact.lock' => 'Flag event facts, safety copy, and tribute disclaimers before editing.',
        ],
        'media' => [
            'asset.placement' => 'Choose background, inline, left-column, or right-column intent per section.',
            'asset.focal_point' => 'Record focal-point and scrim needs for approved images.',
            'asset.rights' => 'Keep rights-safe/public-ready review attached to every image handle.',
        ],
        'style' => [
            'alignment.intent' => 'Name left/right/center section alignment targets before wiring CSS modifiers.',
            'typography.scale' => 'Name normal, large, poster, and mega text scale targets.',
            'panel.treatment' => 'Choose black, chrome, fire, vault, safety, or plain panel intent.',
        ],
        'behavior' => [
            'animation.preset' => 'Use safe presets rather than arbitrary editable JS.',
            'motion.safety' => 'Preserve reduced-motion behavior for all visual effects.',
            'form.boundary' => 'Keep forms as protected components until admin workflow is hardened.',
        ],
        'review' => [
            'rights.safe' => 'Avoid implying official affiliation, authorization, endorsement, or ownership.',
            'safety.notice' => 'Protect loud sound, fog, flashing-light, venue, camping, and free-show claims.',
            'public.ready' => 'Add a review gate before future controls write to public-facing data.',
        ],
    ];
}

function jok_layer_public_root(): string
{
    return realpath(__DIR__ . '/../public') ?: __DIR__ . '/../public';
}

function jok_layer_route_file(string $route): string
{
    $root = jok_layer_public_root();
    if ($route === '/') {
        return $root . '/index.php';
    }

    return $root . '/' . trim($route, '/') . '/index.php';
}

function jok_layer_relative_file(string $absolutePath): string
{
    $repoRoot = realpath(__DIR__ . '/../..');
    $realPath = realpath($absolutePath) ?: $absolutePath;
    if (is_string($repoRoot) && str_starts_with($realPath, $repoRoot . DIRECTORY_SEPARATOR)) {
        return str_replace(DIRECTORY_SEPARATOR, '/', substr($realPath, strlen($repoRoot) + 1));
    }

    return str_replace(DIRECTORY_SEPARATOR, '/', $absolutePath);
}

function jok_layer_handle_from_text(string $text): string
{
    $handle = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '.', $text) ?? '', '.'));
    return $handle !== '' ? $handle : 'unnamed';
}

function jok_layer_extract_calls(string $contents, string $function): array
{
    preg_match_all('/\b' . preg_quote($function, '/') . '\s*\(\s*[\'\"]([^\'\"]+)[\'\"]/', $contents, $matches);
    return array_values(array_unique($matches[1] ?? []));
}

function jok_layer_extract_section_attributes(string $attributeText): array
{
    $attributes = [];
    preg_match_all('/([a-zA-Z_:][-a-zA-Z0-9_:.]*)\s*=\s*([\'\"])(.*?)\2/s', $attributeText, $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {
        $attributes[strtolower($match[1])] = trim(preg_replace('/\s+/', ' ', $match[3]) ?? $match[3]);
    }

    return $attributes;
}

function jok_layer_infer_section_layers(array $section, array $route): array
{
    $layers = ['structure', 'style', 'review'];
    if ($section['language_tokens'] !== []) {
        $layers[] = 'copy';
    }
    if ($section['image_handles'] !== []) {
        $layers[] = 'media';
    }
    if ($section['form_calls'] !== [] || str_contains((string) ($section['classes'] ?? ''), 'form')) {
        $layers[] = 'behavior';
    }
    if ($route['legacy_slot_calls'] !== []) {
        $layers[] = 'structure';
    }

    return array_values(array_unique($layers));
}

function jok_layer_extract_sections(string $contents, array $routeTokens, array $routeImages, array $routeForms, array $routeSlots): array
{
    $sections = [];
    preg_match_all('/<section\b([^>]*)>/i', $contents, $matches, PREG_OFFSET_CAPTURE);
    $count = count($matches[0]);

    for ($i = 0; $i < $count; $i++) {
        $start = $matches[0][$i][1];
        $end = $i + 1 < $count ? $matches[0][$i + 1][1] : strlen($contents);
        $sectionHtml = substr($contents, $start, $end - $start);
        $attributes = jok_layer_extract_section_attributes($matches[1][$i][0] ?? '');
        $id = $attributes['id'] ?? '';
        $classes = $attributes['class'] ?? '';
        $ariaLabel = $attributes['aria-label'] ?? '';
        $ariaLabelledby = $attributes['aria-labelledby'] ?? '';
        $base = $id !== '' ? $id : ($ariaLabelledby !== '' ? $ariaLabelledby : ($ariaLabel !== '' ? $ariaLabel : ($classes !== '' ? $classes : 'section-' . ($i + 1))));
        $handle = 'section.' . str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) . '.' . jok_layer_handle_from_text($base);
        $tokens = array_values(array_filter($routeTokens, static fn (string $token): bool => str_contains($sectionHtml, $token)));
        $images = array_values(array_filter($routeImages, static fn (string $image): bool => str_contains($sectionHtml, $image)));
        $forms = array_values(array_filter($routeForms, static fn (string $form): bool => str_contains($sectionHtml, $form . '(')));
        $slots = array_values(array_filter($routeSlots, static fn (string $slot): bool => str_contains($sectionHtml, $slot)));

        $section = [
            'handle' => $handle,
            'section_id' => $id,
            'classes' => $classes,
            'aria_label' => $ariaLabel,
            'aria_labelledby' => $ariaLabelledby,
            'language_tokens' => $tokens,
            'image_handles' => $images,
            'form_calls' => $forms,
            'legacy_slot_calls' => $slots,
            'control_status' => 'enabled_mvp_file_writes',
        ];
        $section['layers'] = jok_layer_infer_section_layers($section, ['legacy_slot_calls' => $routeSlots]);
        $sections[] = $section;
    }

    return $sections;
}

function jok_layer_discover_routes(): array
{
    $routes = site_pages();
    $root = jok_layer_public_root();
    $files = glob($root . '/*/index.php') ?: [];
    foreach ($files as $file) {
        $slug = basename(dirname($file));
        $route = '/' . $slug . '/';
        if (!isset($routes[$route])) {
            $routes[$route] = [
                'label' => ucwords(str_replace('-', ' ', $slug)),
                'title' => ucwords(str_replace('-', ' ', $slug)),
                'nav' => false,
                'summary' => 'Discovered public route file not listed in site_pages().',
            ];
        }
    }

    return $routes;
}


function jok_layer_badges(array $items): string
{
    if ($items === []) {
        return '<span class="layer-card__handle">none found</span>';
    }

    $html = '';
    foreach ($items as $item) {
        $label = is_array($item) ? (string) ($item['token'] ?? '') : (string) $item;
        if ($label === '') {
            continue;
        }
        $html .= '<span class="layer-card__handle">' . e($label) . '</span> ';
    }

    return $html !== '' ? $html : '<span class="layer-card__handle">none found</span>';
}


function jok_layer_data_dir(): string
{
    return __DIR__ . '/../docs';
}

function jok_layer_state_path(string $name = 'site_layer_controls_state.json'): string
{
    return jok_layer_data_dir() . '/' . $name;
}

function jok_layer_load_json_file(string $path, array $fallback = []): array
{
    if (!is_file($path) || !is_readable($path)) {
        return $fallback;
    }

    $raw = file_get_contents($path);
    if (!is_string($raw) || trim($raw) === '') {
        return $fallback;
    }

    $decoded = json_decode($raw, true);
    return is_array($decoded) ? $decoded : $fallback;
}

function jok_layer_write_json_file(string $path, array $data): array
{
    $dir = dirname($path);
    if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
        return [false, 'Could not create directory: ' . $dir];
    }

    if (is_file($path)) {
        $backupDir = jok_layer_data_dir() . '/site_layer_control_backups';
        if (!is_dir($backupDir) && !mkdir($backupDir, 0775, true) && !is_dir($backupDir)) {
            return [false, 'Could not create backup directory.'];
        }
        $backup = $backupDir . '/' . basename($path, '.json') . '-' . gmdate('Ymd-His') . '.json';
        if (copy($path, $backup) === false) {
            return [false, 'Could not create backup before writing ' . basename($path) . '.'];
        }
    }

    $encoded = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if (!is_string($encoded)) {
        return [false, 'Could not encode JSON: ' . json_last_error_msg()];
    }

    if (file_put_contents($path, $encoded . PHP_EOL, LOCK_EX) === false) {
        return [false, 'Could not write ' . basename($path) . '.'];
    }

    return [true, 'Wrote ' . jok_layer_relative_file($path) . '.'];
}


function jok_layer_safe_return_to(string $returnTo): string
{
    $returnTo = trim($returnTo);
    if ($returnTo === '') {
        return page_url('/site-layers/');
    }

    $parts = parse_url($returnTo);
    if (!is_array($parts) || isset($parts['scheme']) || isset($parts['host'])) {
        return page_url('/site-layers/');
    }

    $path = (string) ($parts['path'] ?? '');
    if ($path === '' || !str_contains($path, '/site-layers')) {
        return page_url('/site-layers/');
    }

    return $path;
}

function jok_layer_state(): array
{
    return jok_layer_load_json_file(jok_layer_state_path(), [
        'status' => 'draft_enabled_mvp',
        'updated_at' => null,
        'section_controls' => [],
        'route_orders' => [],
        'visibility' => [],
        'asset_replacements' => [],
        'uploaded_images' => [],
        'image_labels' => [],
        'section_corner_overlays' => [],
        'image_asset_metadata' => [],
        'template_notes' => [],
        'custom_files' => [],
        'publish_history' => [],
    ]);
}

function jok_layer_save_state(array $state): array
{
    $state['updated_at'] = gmdate('c');
    return jok_layer_write_json_file(jok_layer_state_path(), $state);
}

function jok_layer_safe_route_from_post(array $post): ?array
{
    $route = (string) ($post['route'] ?? '');
    $snapshot = jok_layer_snapshot();
    return isset($snapshot['routes'][$route]) ? $snapshot['routes'][$route] : null;
}

function jok_layer_patch_asset_handle(string $route, string $oldHandle, string $newHandle): array
{
    $routeData = jok_layer_safe_route_from_post(['route' => $route]);
    if ($routeData === null || !$routeData['file_exists']) {
        return [false, 'Selected route file does not exist.'];
    }

    $file = __DIR__ . '/../..' . '/' . $routeData['source_file'];
    $contents = file_get_contents($file);
    if (!is_string($contents)) {
        return [false, 'Could not read route template for asset replacement.'];
    }

    $updated = $contents;
    $count = 0;
    $quotedPatterns = [
        "asset_style('" . $oldHandle . "')" => "asset_style('" . addslashes($newHandle) . "')",
        'asset_style("' . $oldHandle . '")' => 'asset_style("' . addslashes($newHandle) . '")',
        "render_page_image('" . $oldHandle . "'" => "render_page_image('" . addslashes($newHandle) . "'",
        'render_page_image("' . $oldHandle . '"' => 'render_page_image("' . addslashes($newHandle) . '"',
        "'" . $oldHandle . "'" => "'" . addslashes($newHandle) . "'",
        '"' . $oldHandle . '"' => '"' . addslashes($newHandle) . '"',
    ];
    foreach ($quotedPatterns as $pattern => $replacement) {
        $updated = str_replace($pattern, $replacement, $updated, $replaced);
        $count += $replaced;
    }
    if ($count < 1) {
        return [false, 'No matching image handle found in selected route template. Draft runtime replacement state was still saved.'];
    }

    if (file_put_contents($file, $updated, LOCK_EX) === false) {
        return [false, 'Could not write route template asset replacement.'];
    }

    return [true, 'Replaced asset handle in ' . $routeData['source_file'] . '.'];
}

function jok_layer_append_css(string $css): array
{
    $css = trim($css);
    if ($css === '') {
        return [false, 'CSS change is empty.'];
    }
    if (strlen($css) > 8000) {
        $css = substr($css, 0, 8000);
    }

    $path = __DIR__ . '/../public/assets/css/site.css';
    $block = "\n/* Site layer controls MVP custom CSS " . gmdate('c') . " */\n" . $css . "\n/* End site layer controls MVP custom CSS */\n";
    if (file_put_contents($path, $block, FILE_APPEND | LOCK_EX) === false) {
        return [false, 'Could not append CSS to proto/public/assets/css/site.css.'];
    }

    return [true, 'Appended CSS to proto/public/assets/css/site.css.'];
}

function jok_layer_append_template_note(string $route, string $note): array
{
    $note = trim($note);
    if ($note === '') {
        return [false, 'Template change note is empty.'];
    }

    $routeData = jok_layer_safe_route_from_post(['route' => $route]);
    if ($routeData === null || !$routeData['file_exists']) {
        return [false, 'Selected route template does not exist.'];
    }

    $file = __DIR__ . '/../..' . '/' . $routeData['source_file'];
    $safeNote = str_replace(['-->', '<?', '?>'], ['—>', '&lt;?', '?&gt;'], substr($note, 0, 2000));
    $block = "\n<!-- Site layer controls MVP template note " . gmdate('c') . ": " . $safeNote . " -->\n";
    if (file_put_contents($file, $block, FILE_APPEND | LOCK_EX) === false) {
        return [false, 'Could not append template note to selected route file.'];
    }

    return [true, 'Wrote template note to ' . $routeData['source_file'] . '.'];
}

function jok_layer_write_custom_file(string $filename, string $contents): array
{
    $filename = trim($filename);
    $filename = preg_replace('/[^a-zA-Z0-9._-]+/', '-', $filename) ?? '';
    if ($filename === '' || $filename === '.' || $filename === '..') {
        return [false, 'Custom filename is required.'];
    }
    if (!str_ends_with($filename, '.md') && !str_ends_with($filename, '.txt') && !str_ends_with($filename, '.json')) {
        $filename .= '.md';
    }

    $dir = jok_layer_data_dir() . '/site_layer_writes';
    if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
        return [false, 'Could not create custom write directory.'];
    }

    $path = $dir . '/' . basename($filename);
    if (file_put_contents($path, substr($contents, 0, 12000), LOCK_EX) === false) {
        return [false, 'Could not write custom file.'];
    }

    return [true, 'Wrote custom file ' . jok_layer_relative_file($path) . '.'];
}

function jok_layer_update_language_token(string $token, string $text): array
{
    $token = trim($token);
    if ($token === '') {
        return [false, 'Language token is required.'];
    }

    $path = __DIR__ . '/../docs/language.json';
    $language = jok_layer_load_json_file($path);
    if (!isset($language['entries']) || !is_array($language['entries'])) {
        return [false, 'language.json does not have an entries array.'];
    }

    $found = false;
    foreach ($language['entries'] as $index => $entry) {
        if (!is_array($entry) || (string) ($entry['token'] ?? '') !== $token) {
            continue;
        }
        $language['entries'][$index]['canonical_text'] = substr($text, 0, 12000);
        $language['entries'][$index]['last_edited_at'] = gmdate('c');
        $language['entries'][$index]['last_edited_via'] = 'site_layer_controls_mvp';
        $found = true;
        break;
    }

    if (!$found) {
        $language['entries'][] = language_default_entry($token, substr($text, 0, 12000), 'site_layer_controls_auto_register');
    }

    $language['document_control']['last_updated'] = gmdate('Y-m-d');
    $language['document_control']['status'] = 'Edited by Site Layer Controls MVP; language_map.md may need regeneration';
    return jok_layer_write_json_file($path, $language);
}


function jok_layer_allowed_overlay_corners(): array
{
    return ['top-left', 'top-right', 'bottom-left', 'bottom-right'];
}

function jok_layer_normalize_section_handle(string $section): string
{
    $section = trim($section);
    return $section !== '' ? (preg_replace('/[^a-zA-Z0-9._:-]+/', '-', $section) ?: '') : '';
}

function jok_layer_route_has_section(string $route, string $section): bool
{
    $routeData = jok_layer_safe_route_from_post(['route' => $route]);
    if ($routeData === null) {
        return false;
    }

    return in_array($section, $routeData['section_handles'] ?? [], true);
}

function jok_layer_validate_existing_image_asset(string $asset): ?string
{
    $asset = basename($asset);
    if ($asset === '') {
        return null;
    }

    $path = jok_layer_public_root() . '/assets/img/' . $asset;
    return is_file($path) ? $asset : null;
}

function jok_layer_overlay_key(string $section, string $corner): string
{
    return $section . '@' . $corner;
}

function jok_layer_new_overlay_id(string $section, string $corner): string
{
    return jok_layer_overlay_key($section, $corner) . '@' . gmdate('YmdHis') . '-' . bin2hex(random_bytes(3));
}

function jok_layer_normalize_image_label(string $label, string $fallback = ''): string
{
    $label = trim(preg_replace('/\s+/', ' ', $label) ?? '');
    if ($label === '') {
        $label = trim($fallback);
    }
    if ($label === '') {
        $label = 'Image asset ' . gmdate('Y-m-d H:i');
    }

    return substr($label, 0, 120);
}

function jok_layer_default_image_label(string $asset): string
{
    $base = pathinfo(basename($asset), PATHINFO_FILENAME);
    $base = str_replace(['-', '_'], ' ', $base);
    $base = preg_replace('/\s+/', ' ', $base) ?? '';
    $base = trim($base);

    return $base !== '' ? ucwords($base) : 'Image asset';
}

function jok_layer_image_label_from_state(array $state, string $asset): string
{
    $asset = basename($asset);
    $label = $state['image_labels'][$asset] ?? '';
    $label = is_string($label) ? trim($label) : '';

    return $label !== '' ? $label : jok_layer_default_image_label($asset);
}

function jok_layer_upload_image(array $file, bool $required = true): array
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE && !$required) {
        return [true, 'No new image uploaded.', []];
    }
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        return [false, 'No image uploaded or upload failed.'];
    }

    $original = basename((string) ($file['name'] ?? 'upload'));
    $extension = strtolower(pathinfo($original, PATHINFO_EXTENSION));
    $allowed = ['webp', 'png', 'jpg', 'jpeg', 'gif'];
    if (!in_array($extension, $allowed, true)) {
        return [false, 'Image type must be webp, png, jpg, jpeg, or gif.'];
    }

    $name = 'layer-upload-' . gmdate('Ymd-His') . '-' . bin2hex(random_bytes(3)) . '.' . $extension;
    $target = __DIR__ . '/../public/assets/img/' . $name;
    if (!move_uploaded_file((string) $file['tmp_name'], $target)) {
        return [false, 'Could not move uploaded image into proto/public/assets/img.'];
    }

    return [true, 'Uploaded image as proto/public/assets/img/' . $name . '.', ['uploaded_image' => $name]];
}

function jok_layer_apply_operation(array $post, array $files): array
{
    $operation = (string) ($post['operation'] ?? '');
    $state = jok_layer_state();
    $messages = [];

    if ($operation === 'save_edits') {
        $route = (string) ($post['route'] ?? '');
        $section = (string) ($post['section_handle'] ?? '');
        if ($route === '' || $section === '') {
            return [false, ['Route and section handle are required to save controls.']];
        }
        $state['section_controls'][$route][$section] = [
            'text_alignment' => (string) ($post['text_alignment'] ?? 'current'),
            'headline_scale' => (string) ($post['headline_scale'] ?? 'current'),
            'image_placement' => str_replace('_column', '', (string) ($post['image_placement'] ?? 'current')),
            'animation_preset' => str_replace('_', '-', (string) ($post['animation_preset'] ?? 'none')),
            'updated_at' => gmdate('c'),
        ];
        [$ok, $message] = jok_layer_save_state($state);
        return [$ok, [$message]];
    }

    if ($operation === 'publish_changes') {
        $state['last_published_at'] = gmdate('c');
        $state['publish_history'][] = ['published_at' => gmdate('c'), 'note' => substr((string) ($post['publish_note'] ?? ''), 0, 1000)];
        [$okDraft, $draftMessage] = jok_layer_save_state($state);
        [$okPub, $pubMessage] = jok_layer_write_json_file(jok_layer_state_path('site_layer_controls_published.json'), $state);
        return [$okDraft && $okPub, [$draftMessage, $pubMessage]];
    }

    if ($operation === 'reorder_sections') {
        $route = (string) ($post['route'] ?? '');
        $order = array_values(array_unique(array_filter(array_map('trim', explode("\n", (string) ($post['section_order'] ?? ''))))));
        $state['route_orders'][$route] = ['section_order' => $order, 'updated_at' => gmdate('c')];
        [$ok, $message] = jok_layer_save_state($state);
        return [$ok, [$message]];
    }

    if ($operation === 'toggle_visibility') {
        $route = (string) ($post['route'] ?? '');
        $section = (string) ($post['section_handle'] ?? '');
        $state['visibility'][$route][$section] = ['visible' => ((string) ($post['visible'] ?? '1')) === '1', 'updated_at' => gmdate('c')];
        [$ok, $message] = jok_layer_save_state($state);
        return [$ok, [$message]];
    }

    if ($operation === 'edit_language') {
        [$ok, $message] = jok_layer_update_language_token((string) ($post['language_token'] ?? ''), (string) ($post['canonical_text'] ?? ''));
        return [$ok, [$message]];
    }

    if ($operation === 'upload_image') {
        [$ok, $message, $extra] = array_pad(jok_layer_upload_image($files['image_upload'] ?? [], true), 3, []);
        if ($ok) {
            $uploadedImage = (string) ($extra['uploaded_image'] ?? '');
            $label = jok_layer_normalize_image_label((string) ($post['image_label'] ?? ''), jok_layer_default_image_label($uploadedImage));
            $state['uploaded_images'][] = array_merge($extra, ['label' => $label, 'uploaded_at' => gmdate('c')]);
            if ($uploadedImage !== '') {
                $state['image_labels'][$uploadedImage] = $label;
            }
            jok_layer_save_state($state);
        }
        return [$ok, [$message]];
    }

    if ($operation === 'configure_image_asset') {
        $image = basename((string) ($post['image_handle'] ?? ''));
        if ($image === '' || !in_array($image, image_inventory(), true)) {
            return [false, ['Approved image handle is required.']];
        }
        $section = trim((string) ($post['section_handle'] ?? 'global.media_inventory'));
        $section = $section !== '' ? preg_replace('/[^a-zA-Z0-9._:-]+/', '-', $section) : 'global.media_inventory';
        $route = (string) ($post['route'] ?? '');
        if ($route !== '' && !isset(jok_layer_snapshot()['routes'][$route])) {
            return [false, ['Selected route is not part of the site-layer route inventory.']];
        }
        $removeBackground = ((string) ($post['remove_background'] ?? '0')) === '1';
        $selectedAsset = basename((string) ($post['selected_asset'] ?? $image));
        if ($removeBackground) {
            $state['image_asset_metadata'][$image][$section] = [
                'selected_asset' => '',
                'section_handle' => $section,
                'route' => $route,
                'background_removed' => true,
                'timeline_moment_id_or_gen' => 'GEN',
                'updated_at' => gmdate('c'),
            ];
            [$ok, $message] = jok_layer_save_state($state);
            return [$ok, [$message, 'Removed background image for ' . $section . '.']];
        }
        [$uploadOk, $uploadMessage, $uploadExtra] = array_pad(jok_layer_upload_image($files['image_upload'] ?? [], false), 3, []);
        if (!$uploadOk) {
            return [false, [$uploadMessage]];
        }
        if (isset($uploadExtra['uploaded_image']) && is_string($uploadExtra['uploaded_image'])) {
            $selectedAsset = basename($uploadExtra['uploaded_image']);
            $label = jok_layer_normalize_image_label((string) ($post['image_label'] ?? ''), jok_layer_default_image_label($selectedAsset));
            $state['uploaded_images'][] = array_merge($uploadExtra, ['label' => $label, 'uploaded_at' => gmdate('c')]);
            $state['image_labels'][$selectedAsset] = $label;
        }
        $assetPath = jok_layer_public_root() . '/assets/img/' . $selectedAsset;
        if ($selectedAsset === '' || !is_file($assetPath)) {
            return [false, ['Selected image asset must exist in proto/public/assets/img.']];
        }
        $aspect = (string) ($post['aspect_ratio'] ?? 'wide');
        if (!in_array($aspect, ['wide', 'square', 'portrait', 'banner'], true)) {
            $aspect = 'wide';
        }
        $clamp = static fn (float $value, float $min, float $max): float => max($min, min($max, $value));
        $assetLabel = jok_layer_normalize_image_label((string) ($post['image_label'] ?? ''), jok_layer_image_label_from_state($state, $selectedAsset));
        $state['image_labels'][$selectedAsset] = $assetLabel;
        $state['image_asset_metadata'][$image][$section] = [
            'selected_asset' => $selectedAsset,
            'image_label' => $assetLabel,
            'section_handle' => $section,
            'route' => $route,
            'focus_x' => $clamp((float) ($post['focus_x'] ?? 50), 0, 100),
            'focus_y' => $clamp((float) ($post['focus_y'] ?? 50), 0, 100),
            'zoom' => $clamp((float) ($post['zoom'] ?? 100), 100, 250),
            'crop_x' => $clamp((float) ($post['crop_x'] ?? 0), -100, 100),
            'crop_y' => $clamp((float) ($post['crop_y'] ?? 0), -100, 100),
            'aspect_ratio' => $aspect,
            'background_removed' => false,
            'updated_at' => gmdate('c'),
        ];
        [$ok, $message] = jok_layer_save_state($state);
        return [$ok, [$message]];
    }


    if ($operation === 'configure_section_overlay') {
        $route = (string) ($post['route'] ?? '');
        $section = jok_layer_normalize_section_handle((string) ($post['section_handle'] ?? ''));
        $corner = (string) ($post['corner'] ?? '');
        if ($route === '' || $section === '' || !jok_layer_route_has_section($route, $section)) {
            return [false, ['A valid route and primary section handle are required for a corner overlay.']];
        }
        if (!in_array($corner, jok_layer_allowed_overlay_corners(), true)) {
            return [false, ['Choose top-left, top-right, bottom-left, or bottom-right.']];
        }

        $postedOverlayId = preg_replace('/[^a-zA-Z0-9._:@-]+/', '-', trim((string) ($post['overlay_id'] ?? ''))) ?: '';
        $legacyOverlayKey = jok_layer_overlay_key($section, $corner);
        $overlayKey = $postedOverlayId !== '' ? $postedOverlayId : jok_layer_new_overlay_id($section, $corner);
        $remove = ((string) ($post['remove_overlay'] ?? '0')) === '1';
        if ($remove) {
            if ($postedOverlayId !== '') {
                unset($state['section_corner_overlays'][$route][$postedOverlayId]);
            } else {
                unset($state['section_corner_overlays'][$route][$legacyOverlayKey]);
            }
            [$ok, $message] = jok_layer_save_state($state);
            return [$ok, [$message, 'Removed corner overlay for ' . $section . ' at ' . $corner . '.']];
        }

        $selectedAsset = basename((string) ($post['selected_asset'] ?? ''));
        [$uploadOk, $uploadMessage, $uploadExtra] = array_pad(jok_layer_upload_image($files['image_upload'] ?? [], false), 3, []);
        if (!$uploadOk) {
            return [false, [$uploadMessage]];
        }
        if (isset($uploadExtra['uploaded_image']) && is_string($uploadExtra['uploaded_image'])) {
            $selectedAsset = basename($uploadExtra['uploaded_image']);
            $label = jok_layer_normalize_image_label((string) ($post['image_label'] ?? ''), jok_layer_default_image_label($selectedAsset));
            $state['uploaded_images'][] = array_merge($uploadExtra, ['label' => $label, 'uploaded_at' => gmdate('c')]);
            $state['image_labels'][$selectedAsset] = $label;
        }

        $selectedAsset = jok_layer_validate_existing_image_asset($selectedAsset) ?? '';
        if ($selectedAsset === '') {
            return [false, ['Choose an image that exists in proto/public/assets/img or upload a new one.']];
        }

        $clamp = static fn (float $value, float $min, float $max): float => max($min, min($max, $value));
        $width = $clamp((float) ($post['width'] ?? 180), 32, 640);
        $assetLabel = jok_layer_normalize_image_label((string) ($post['image_label'] ?? ''), jok_layer_image_label_from_state($state, $selectedAsset));
        $state['image_labels'][$selectedAsset] = $assetLabel;
        $state['section_corner_overlays'][$route][$overlayKey] = [
            'overlay_id' => $overlayKey,
            'route' => $route,
            'section_handle' => $section,
            'corner' => $corner,
            'selected_asset' => $selectedAsset,
            'image_label' => $assetLabel,
            'offset_x' => $clamp((float) ($post['offset_x'] ?? 0), -1200, 1200),
            'offset_y' => $clamp((float) ($post['offset_y'] ?? 0), -1200, 1200),
            'width' => $width,
            'rotation' => $clamp((float) ($post['rotation'] ?? 0), -1080, 1080),
            'enabled' => ((string) ($post['enabled'] ?? '1')) === '1',
            'timeline_moment_id_or_gen' => 'GEN',
            'alt_text' => '',
            'decorative' => true,
            'updated_at' => gmdate('c'),
        ];
        [$ok, $message] = jok_layer_save_state($state);
        return [$ok, [$message, 'Saved decorative corner overlay for ' . $section . ' at ' . $corner . '.']];
    }


    if ($operation === 'update_image_label') {
        $asset = jok_layer_validate_existing_image_asset((string) ($post['selected_asset'] ?? ''));
        if ($asset === null) {
            return [false, ['Choose an image that exists in proto/public/assets/img.']];
        }
        $label = jok_layer_normalize_image_label((string) ($post['image_label'] ?? ''), jok_layer_default_image_label($asset));
        $state['image_labels'][$asset] = $label;
        foreach (($state['uploaded_images'] ?? []) as $index => $upload) {
            if (is_array($upload) && basename((string) ($upload['uploaded_image'] ?? '')) === $asset) {
                $state['uploaded_images'][$index]['label'] = $label;
            }
        }
        [$ok, $message] = jok_layer_save_state($state);
        return [$ok, [$message, 'Updated image label for ' . $asset . '.']];
    }

    if ($operation === 'replace_image_handle') {
        $route = (string) ($post['route'] ?? '');
        $old = basename((string) ($post['old_image_handle'] ?? ''));
        $new = basename((string) ($post['new_image_handle'] ?? ''));
        if ($old === '' || $new === '' || jok_layer_validate_existing_image_asset($new) === null) {
            return [false, ['Choose an existing old image handle and a replacement image that exists in proto/public/assets/img.']];
        }
        $state['asset_replacements'][$route][$old] = ['new_handle' => $new, 'updated_at' => gmdate('c')];
        [$stateOk, $stateMessage] = jok_layer_save_state($state);
        $messages[] = $stateMessage;
        if (((string) ($post['patch_template'] ?? '0')) === '1') {
            [$patchOk, $patchMessage] = jok_layer_patch_asset_handle($route, $old, $new);
            $messages[] = $patchMessage;
            return [$stateOk && $patchOk, $messages];
        }
        return [$stateOk, $messages];
    }

    if ($operation === 'change_css') {
        [$ok, $message] = jok_layer_append_css((string) ($post['css_block'] ?? ''));
        return [$ok, [$message]];
    }

    if ($operation === 'change_template') {
        [$ok, $message] = jok_layer_append_template_note((string) ($post['route'] ?? ''), (string) ($post['template_note'] ?? ''));
        return [$ok, [$message]];
    }

    if ($operation === 'write_file') {
        [$ok, $message] = jok_layer_write_custom_file((string) ($post['custom_filename'] ?? ''), (string) ($post['custom_contents'] ?? ''));
        return [$ok, [$message]];
    }

    return [false, ['Unknown operation.']];
}

function jok_layer_snapshot(): array
{
    $routes = [];
    $layerDefinitions = jok_layer_definitions();
    foreach (jok_layer_discover_routes() as $route => $page) {
        $file = jok_layer_route_file($route);
        $exists = is_file($file);
        $contents = $exists ? (string) file_get_contents($file) : '';
        $tokens = [];
        foreach (['lang_editable', 'lang_text', 'lang_editable_lines', 'lang_editable_with_strong_prefix'] as $function) {
            foreach (jok_layer_extract_calls($contents, $function) as $token) {
                $tokens[$token] = ['token' => $token, 'helper' => $function];
            }
        }
        $images = array_values(array_unique(array_merge(
            jok_layer_extract_calls($contents, 'asset_style'),
            jok_layer_extract_calls($contents, 'render_page_image'),
            jok_layer_extract_calls($contents, 'render_media_grid')
        )));
        $forms = [];
        foreach (['render_lead_form', 'render_inquiry_form'] as $function) {
            if (preg_match('/\b' . preg_quote($function, '/') . '\s*\(/', $contents)) {
                $forms[] = $function;
            }
        }
        $slots = [];
        preg_match_all('/render_page_section_slot\s*\(\s*[\'\"]([^\'\"]+)[\'\"]\s*,\s*[\'\"]([^\'\"]+)[\'\"]/', $contents, $slotMatches, PREG_SET_ORDER);
        foreach ($slotMatches as $match) {
            $slots[] = $match[1] . '.' . $match[2];
        }
        $sections = jok_layer_extract_sections($contents, array_keys($tokens), $images, $forms, $slots);
        $layers = ['structure', 'style', 'review'];
        if ($tokens !== []) {
            $layers[] = 'copy';
        }
        if ($images !== []) {
            $layers[] = 'media';
        }
        if ($forms !== [] || preg_match('/\bdata-[a-z0-9_-]+\b|<script\b/i', $contents)) {
            $layers[] = 'behavior';
        }

        $routes[$route] = [
            'route' => $route,
            'label' => (string) ($page['label'] ?? $route),
            'title' => (string) ($page['title'] ?? $route),
            'summary' => (string) ($page['summary'] ?? ''),
            'source_file' => jok_layer_relative_file($file),
            'file_exists' => $exists,
            'section_handles' => array_column($sections, 'handle'),
            'sections' => $sections,
            'language_tokens' => array_values($tokens),
            'image_handles' => $images,
            'form_renderer_calls' => $forms,
            'legacy_slot_calls' => $slots,
            'layers' => array_values(array_unique($layers)),
            'control_status' => 'enabled_mvp_file_writes',
        ];
    }

    return [
        'generated_at' => gmdate('c'),
        'status' => 'enabled_mvp_control_snapshot',
        'control_status' => 'enabled_mvp_file_writes',
        'notes' => [
            'This v2 MVP enables scoped file-writing operations for the user-requested list: save edits, publish changes, reorder sections, hide/show sections, edit language.json, upload images, replace image handles, change CSS, change templates, write files, and change assets. Route media discovery includes asset_style(), render_page_image(), and render_media_grid() literal handles.',
            'Route-scoped render_page_section_slot() calls are enabled for all public routes; proto/editor remains a legacy editor surface, while /site-layers is the current route-wide control suite.',
            'language.json archive files, including proto/docs/language_backups/*, are excluded from this layer-control snapshot.',
            'The existing plain PHP public rendering model remains unchanged.',
        ],
        'layers' => $layerDefinitions,
        'control_intents' => jok_layer_control_intents(),
        'shared_surfaces' => [
            'global.header' => ['label' => 'Global header', 'layers' => ['structure', 'copy', 'style', 'behavior', 'review'], 'source_file' => 'proto/app/view.php'],
            'global.footer' => ['label' => 'Global footer', 'layers' => ['structure', 'copy', 'style', 'review'], 'source_file' => 'proto/app/view.php'],
            'global.forms' => ['label' => 'Lead and inquiry forms', 'layers' => ['structure', 'copy', 'behavior', 'review'], 'source_file' => 'proto/app/view.php'],
            'global.language_tokens' => ['label' => 'Runtime language tokens', 'layers' => ['copy', 'review'], 'source_file' => 'proto/docs/language.json'],
            'global.assets' => ['label' => 'Approved image inventory', 'layers' => ['media', 'style', 'review'], 'source_file' => 'proto/app/site_data.php'],
            'managed.page_slots' => ['label' => 'Route-managed page insertion slots', 'layers' => ['structure', 'copy', 'media', 'style', 'review'], 'source_file' => 'proto/app/page_sections.php', 'control_status' => 'enabled_route_wide'],
        ],
        'routes' => $routes,
        'approved_images' => image_inventory(),
        'state' => jok_layer_state(),
    ];
}
