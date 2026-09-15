<?php

declare(strict_types=1);

require_once __DIR__ . '/layer_controls.php';

function jok_layer_runtime_enabled(): bool
{
    $script = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? ''));
    if ($script === '' || str_contains($script, '/site-layers') || str_contains($script, '/site-layer-save.php') || str_contains($script, '/admin-language-save.php')) {
        return false;
    }

    return true;
}

function jok_layer_runtime_route(): string
{
    $script = str_replace('\\', '/', (string) ($_SERVER['SCRIPT_NAME'] ?? ''));
    $publicPos = strpos($script, '/public/');
    $afterPublic = $publicPos === false ? ltrim($script, '/') : substr($script, $publicPos + strlen('/public/'));
    if ($afterPublic === 'index.php' || $afterPublic === '') {
        return '/';
    }

    return '/' . trim(str_replace('/index.php', '', $afterPublic), '/') . '/';
}

function jok_layer_runtime_section_class(array $control): string
{
    $classes = [];
    $alignment = (string) ($control['text_alignment'] ?? 'current');
    if (in_array($alignment, ['left', 'right', 'center'], true)) {
        $classes[] = 'jok-layer-align-' . $alignment;
    }

    $scale = (string) ($control['headline_scale'] ?? 'current');
    if (in_array($scale, ['large', 'poster'], true)) {
        $classes[] = 'jok-layer-headline-' . $scale;
    }

    $imagePlacement = (string) ($control['image_placement'] ?? 'current');
    if (in_array($imagePlacement, ['background', 'left', 'right', 'inline'], true)) {
        $classes[] = 'jok-layer-image-' . $imagePlacement;
    }

    $animation = (string) ($control['animation_preset'] ?? 'none');
    if (in_array($animation, ['fade-up', 'chrome-glint'], true)) {
        $classes[] = 'jok-layer-animation-' . $animation;
    }

    return implode(' ', $classes);
}

function jok_layer_runtime_add_style_declaration(string $attrs, string $declaration): string
{
    if (preg_match('/\sstyle=(["\'])(.*?)\1/is', $attrs)) {
        return preg_replace('/\sstyle=(["\'])(.*?)\1/is', ' style=$1$2; ' . $declaration . '$1', $attrs, 1) ?? $attrs;
    }

    return $attrs . ' style="' . htmlspecialchars($declaration, ENT_QUOTES, 'UTF-8') . '"';
}


function jok_layer_runtime_image_declarations(array $metadata): string
{
    $clamp = static fn (float $value, float $min, float $max): float => max($min, min($max, $value));
    $focusX = $clamp((float) ($metadata['focus_x'] ?? 50), 0, 100);
    $focusY = $clamp((float) ($metadata['focus_y'] ?? 50), 0, 100);
    $zoom = $clamp((float) ($metadata['zoom'] ?? 100), 100, 250);
    $cropX = $clamp((float) ($metadata['crop_x'] ?? 0), -100, 100);
    $cropY = $clamp((float) ($metadata['crop_y'] ?? 0), -100, 100);
    $selectedAsset = basename((string) ($metadata['selected_asset'] ?? ''));
    $backgroundRemoved = ((bool) ($metadata['background_removed'] ?? false)) === true;

    if ($backgroundRemoved) {
        return '--asset-image: none; --asset-size: auto; --asset-position: center; --section-scrim: none; --section-hotspot: none; --section-veil: none; --section-base-bg: transparent; --hero-scrim: none; --hero-hotspot: none; --hero-base-bg: transparent';
    }

    $declarations = [
        '--asset-focus-x: ' . $focusX . '%',
        '--asset-focus-y: ' . $focusY . '%',
        '--asset-zoom: ' . $zoom . '%',
        '--asset-crop-x: ' . $cropX . 'px',
        '--asset-crop-y: ' . $cropY . 'px',
        '--asset-size: ' . $zoom . '% auto',
        '--asset-position: calc(' . $focusX . '% + ' . $cropX . 'px) calc(' . $focusY . '% + ' . $cropY . 'px)',
    ];

    if ($selectedAsset !== '' && is_file(jok_layer_public_root() . '/assets/img/' . $selectedAsset)) {
        $declarations[] = "--asset-image: url('" . asset_base_url() . rawurlencode($selectedAsset) . "')";
    }

    return implode('; ', $declarations);
}

function jok_layer_runtime_metadata_matches_route(array $metadata, string $route): bool
{
    $metadataRoute = (string) ($metadata['route'] ?? '');
    return $metadataRoute === '' || $metadataRoute === $route;
}

function jok_layer_runtime_section_image_metadata(array $state, string $route, string $sectionHandle, array $section): array
{
    $metadataByImage = $state['image_asset_metadata'] ?? [];
    $sectionImages = $section['image_handles'] ?? [];
    if (!is_array($metadataByImage) || !is_array($sectionImages) || $metadataByImage === [] || $sectionImages === []) {
        return [];
    }

    foreach ($sectionImages as $image) {
        $image = basename((string) $image);
        if ($image === '' || !isset($metadataByImage[$image]) || !is_array($metadataByImage[$image])) {
            continue;
        }

        $sectionMetadata = $metadataByImage[$image];
        $metadata = $sectionMetadata[$sectionHandle] ?? $sectionMetadata['global.media_inventory'] ?? null;
        if (is_array($metadata) && jok_layer_runtime_metadata_matches_route($metadata, $route)) {
            $metadata['image_handle'] = $image;
            return $metadata;
        }
    }

    return [];
}

function jok_layer_runtime_section_image_declarations(array $state, string $route, string $sectionHandle, array $section): string
{
    $metadata = jok_layer_runtime_section_image_metadata($state, $route, $sectionHandle, $section);
    if ($metadata !== []) {
        return jok_layer_runtime_image_declarations($metadata);
    }

    return '';
}

function jok_layer_runtime_apply_section_image_assets(string $html, array $routeData, array $state, string $route): string
{
    $sections = $routeData['sections'] ?? [];
    if (!is_array($sections) || $sections === []) {
        return $html;
    }

    foreach ($sections as $section) {
        if (!is_array($section)) {
            continue;
        }
        $handle = (string) ($section['handle'] ?? '');
        if ($handle === '') {
            continue;
        }
        $metadata = jok_layer_runtime_section_image_metadata($state, $route, $handle, $section);
        $oldHandle = basename((string) ($metadata['image_handle'] ?? ''));
        $newHandle = basename((string) ($metadata['selected_asset'] ?? ''));
        if ($oldHandle === '' || $newHandle === '' || $oldHandle === $newHandle || jok_layer_validate_existing_image_asset($newHandle) === null) {
            continue;
        }

        $pattern = '/(<section\b(?=[^>]*data-jok-layer-section=(["\'])' . preg_quote($handle, '/') . '\2)[\s\S]*?)(?=<section\b|<\/main>)/i';
        $html = (string) preg_replace_callback($pattern, static function (array $match) use ($oldHandle, $newHandle): string {
            $sectionHtml = (string) ($match[0] ?? '');
            $sectionHtml = str_replace(rawurlencode($oldHandle), rawurlencode($newHandle), $sectionHtml);
            return str_replace($oldHandle, $newHandle, $sectionHtml);
        }, $html, 1);
    }

    return $html;
}


function jok_layer_runtime_apply_asset_replacements(string $html, array $state, string $route): string
{
    $routeReplacements = $state['asset_replacements'][$route] ?? [];
    if (!is_array($routeReplacements) || $routeReplacements === []) {
        return $html;
    }

    foreach ($routeReplacements as $oldHandle => $replacement) {
        $newHandle = is_array($replacement) ? (string) ($replacement['new_handle'] ?? '') : '';
        $oldHandle = basename((string) $oldHandle);
        $newHandle = basename($newHandle);
        if ($oldHandle === '' || $newHandle === '' || jok_layer_validate_existing_image_asset($newHandle) === null) {
            continue;
        }

        $html = str_replace(rawurlencode($oldHandle), rawurlencode($newHandle), $html);
        $html = str_replace($oldHandle, $newHandle, $html);
    }

    return $html;
}

function jok_layer_runtime_apply_image_metadata(string $html, array $state): string
{
    $metadataByImage = $state['image_asset_metadata'] ?? [];
    if (!is_array($metadataByImage) || $metadataByImage === []) {
        return $html;
    }

    return (string) preg_replace_callback('/(<[^>]+\sstyle=(["\'])(.*?)\2[^>]*>)/is', static function (array $match) use ($metadataByImage): string {
        $tag = (string) ($match[1] ?? '');
        if (str_contains($tag, 'data-jok-layer-section=')) {
            return $tag;
        }
        $style = html_entity_decode((string) ($match[3] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        foreach ($metadataByImage as $image => $sectionMetadata) {
            $basename = basename((string) $image);
            if ($basename === '' || !str_contains($style, $basename) || !is_array($sectionMetadata)) {
                continue;
            }

            $metadata = $sectionMetadata['global.media_inventory'] ?? reset($sectionMetadata);
            if (!is_array($metadata)) {
                continue;
            }

            $declaration = jok_layer_runtime_image_declarations($metadata);
            return preg_replace('/\sstyle=(["\'])(.*?)\1/is', ' style=$1$2; ' . htmlspecialchars($declaration, ENT_QUOTES, 'UTF-8') . '$1', $tag, 1) ?? $tag;
        }

        return $tag;
    }, $html);
}


function jok_layer_runtime_overlay_edit_mode(): bool
{
    return ((string) ($_GET['site_layer_editor'] ?? '0')) === '1';
}

function jok_layer_runtime_corner_style(array $overlay): string
{
    $corner = (string) ($overlay['corner'] ?? 'top-left');
    $offsetX = max(-1200, min(1200, (float) ($overlay['offset_x'] ?? 0)));
    $offsetY = max(-1200, min(1200, (float) ($overlay['offset_y'] ?? 0)));
    $width = max(32, min(640, (float) ($overlay['width'] ?? 180)));
    $rotation = max(-1080, min(1080, (float) ($overlay['rotation'] ?? 0)));
    $style = '--jok-overlay-width: ' . $width . 'px; ';
    $style .= '--jok-overlay-x: ' . $offsetX . 'px; --jok-overlay-y: ' . $offsetY . 'px; --jok-overlay-rotation: ' . $rotation . 'deg; ';

    if (str_contains($corner, 'left')) {
        $style .= 'left: calc(var(--jok-overlay-x) - (var(--jok-overlay-width) / 2)); ';
    } else {
        $style .= 'right: calc((var(--jok-overlay-x) * -1) - (var(--jok-overlay-width) / 2)); ';
    }

    if (str_contains($corner, 'top')) {
        $style .= 'top: calc(var(--jok-overlay-y) - (var(--jok-overlay-width) / 2));';
    } else {
        $style .= 'bottom: calc((var(--jok-overlay-y) * -1) - (var(--jok-overlay-width) / 2));';
    }

    return $style;
}

function jok_layer_runtime_overlay_markup(array $overlay): string
{
    if (((bool) ($overlay['enabled'] ?? true)) !== true) {
        return '';
    }

    $asset = jok_layer_validate_existing_image_asset((string) ($overlay['selected_asset'] ?? ''));
    if ($asset === null) {
        return '';
    }

    $corner = (string) ($overlay['corner'] ?? 'top-left');
    if (!in_array($corner, jok_layer_allowed_overlay_corners(), true)) {
        return '';
    }

    $src = asset_base_url() . rawurlencode($asset);
    return '<img class="jok-section-corner-overlay jok-section-corner-overlay--' . htmlspecialchars($corner, ENT_QUOTES, 'UTF-8') . '" src="' . htmlspecialchars($src, ENT_QUOTES, 'UTF-8') . '" alt="" aria-hidden="true" loading="lazy" decoding="async" style="' . htmlspecialchars(jok_layer_runtime_corner_style($overlay), ENT_QUOTES, 'UTF-8') . '">';
}

function jok_layer_runtime_editor_plus_markup(string $route, string $section): string
{
    if (!jok_layer_runtime_overlay_edit_mode()) {
        return '';
    }

    $html = '<div class="jok-section-corner-tools" aria-label="Add corner overlay controls for this section">';
    foreach (jok_layer_allowed_overlay_corners() as $corner) {
        $href = page_url('/site-layers/media/') . '?' . http_build_query([
            'operation' => 'configure_section_overlay',
            'route' => $route,
            'section_handle' => $section,
            'corner' => $corner,
        ]);
        $html .= '<a class="jok-section-corner-plus jok-section-corner-plus--' . htmlspecialchars($corner, ENT_QUOTES, 'UTF-8') . '" href="' . htmlspecialchars($href, ENT_QUOTES, 'UTF-8') . '" aria-label="Add image overlay to ' . htmlspecialchars($corner, ENT_QUOTES, 'UTF-8') . ' corner of section ' . htmlspecialchars($section, ENT_QUOTES, 'UTF-8') . '">+</a>';
    }
    $html .= '</div>';

    return $html;
}

function jok_layer_runtime_section_inner_markup(array $state, string $route, string $section): string
{
    $html = jok_layer_runtime_editor_plus_markup($route, $section);
    $routeOverlays = $state['section_corner_overlays'][$route] ?? [];
    if (!is_array($routeOverlays) || $routeOverlays === []) {
        return $html;
    }

    foreach ($routeOverlays as $overlay) {
        if (!is_array($overlay) || (string) ($overlay['section_handle'] ?? '') !== $section) {
            continue;
        }
        $html .= jok_layer_runtime_overlay_markup($overlay);
    }

    return $html;
}

function jok_layer_runtime_inject_section_attributes(string $html, array $routeData, array $state, string $route): string
{
    $sections = $routeData['sections'] ?? [];
    if (!is_array($sections) || $sections === []) {
        return $html;
    }

    $index = 0;
    return (string) preg_replace_callback('/<section\b([^>]*)>/i', static function (array $match) use (&$index, $sections, $state, $route): string {
        $section = $sections[$index] ?? null;
        $index++;
        if (!is_array($section)) {
            return $match[0];
        }

        $handle = (string) ($section['handle'] ?? '');
        if ($handle === '') {
            return $match[0];
        }

        $attrs = (string) ($match[1] ?? '');
        $control = $state['section_controls'][$route][$handle] ?? [];
        $visibility = $state['visibility'][$route][$handle]['visible'] ?? true;
        $routeOrder = $state['route_orders'][$route]['section_order'] ?? [];
        $orderIndex = is_array($routeOrder) ? array_search($handle, $routeOrder, true) : false;
        $classAdditions = is_array($control) ? jok_layer_runtime_section_class($control) : '';

        $innerMarkup = jok_layer_runtime_section_inner_markup($state, $route, $handle);
        if (str_contains($innerMarkup, 'jok-section-corner-overlay')) {
            $classAdditions = trim($classAdditions . ' jok-layer-has-corner-overlay');
        }

        if ($classAdditions !== '') {
            if (preg_match('/\sclass=([' . "'\"" . '])([^' . "'\"" . ']*)\1/i', $attrs)) {
                $attrs = preg_replace('/\sclass=([' . "'\"" . '])([^' . "'\"" . ']*)\1/i', ' class=$1$2 ' . $classAdditions . '$1', $attrs, 1) ?? $attrs;
            } else {
                $attrs .= ' class="' . htmlspecialchars($classAdditions, ENT_QUOTES, 'UTF-8') . '"';
            }
        }

        $sectionImageDeclarations = jok_layer_runtime_section_image_declarations($state, $route, $handle, $section);
        if ($sectionImageDeclarations !== '') {
            $attrs = jok_layer_runtime_add_style_declaration($attrs, $sectionImageDeclarations);
        }

        if ($orderIndex !== false) {
            $attrs = jok_layer_runtime_add_style_declaration($attrs, '--jok-layer-order: ' . ((int) $orderIndex + 1));
        }

        if (!str_contains($attrs, 'data-jok-layer-section=')) {
            $attrs .= ' data-jok-layer-section="' . htmlspecialchars($handle, ENT_QUOTES, 'UTF-8') . '"';
        }
        if ($visibility === false && !preg_match('/\shidden\b/i', $attrs)) {
            $attrs .= ' hidden aria-hidden="true"';
        }

        return '<section' . $attrs . '>' . $innerMarkup;
    }, $html);
}

function jok_layer_runtime_apply(string $html): string
{
    if (!jok_layer_runtime_enabled()) {
        return $html;
    }

    $route = jok_layer_runtime_route();
    $snapshot = jok_layer_snapshot();
    $routeData = $snapshot['routes'][$route] ?? null;
    if (!is_array($routeData)) {
        return $html;
    }

    $state = jok_layer_state();
    $html = jok_layer_runtime_inject_section_attributes($html, $routeData, $state, $route);
    $html = jok_layer_runtime_apply_section_image_assets($html, $routeData, $state, $route);
    $html = jok_layer_runtime_apply_asset_replacements($html, $state, $route);
    return jok_layer_runtime_apply_image_metadata($html, $state);
}

function jok_layer_runtime_started(): bool
{
    return isset($GLOBALS['jok_layer_runtime_buffer_started']) && $GLOBALS['jok_layer_runtime_buffer_started'] === true;
}

function jok_layer_runtime_start(): void
{
    if (!jok_layer_runtime_enabled() || jok_layer_runtime_started()) {
        return;
    }

    $GLOBALS['jok_layer_runtime_buffer_started'] = true;
    ob_start('jok_layer_runtime_apply');
}

function jok_layer_runtime_finish(): void
{
    if (jok_layer_runtime_started() && ob_get_level() > 0) {
        $GLOBALS['jok_layer_runtime_buffer_started'] = false;
        ob_end_flush();
    }
}
