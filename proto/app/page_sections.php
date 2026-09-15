<?php

declare(strict_types=1);

if (isset($_SERVER['SCRIPT_FILENAME']) && realpath((string) $_SERVER['SCRIPT_FILENAME']) === __FILE__) {
    http_response_code(200);
    header('Content-Type: text/html; charset=UTF-8');
    header('X-Robots-Tag: noindex, nofollow');
    ?>
    <!doctype html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="robots" content="noindex,nofollow">
      <title>Just One KISS Page Section Engine</title>
      <style>
        :root { color-scheme: dark; --black:#050505; --panel:#111116; --bone:#f2f2ee; --chrome:#b8bcc2; --gold:#d8a31a; --orange:#f06a21; --red:#b20d18; --line:rgba(184,188,194,.28); }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; padding: 1rem; color: var(--bone); font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; background: radial-gradient(circle at 20% 0%, rgba(240,106,33,.28), transparent 28rem), linear-gradient(135deg, #030303, #111016 52%, #050505); }
        main { width: min(760px, 100%); padding: clamp(1.25rem, 4vw, 2rem); border: 1px solid var(--line); border-radius: 24px; background: linear-gradient(145deg, rgba(255,255,255,.08), rgba(255,255,255,.025)), rgba(10,10,14,.92); box-shadow: 0 0 44px rgba(178,13,24,.2); }
        p { color: var(--chrome); line-height: 1.6; }
        h1 { margin: 0 0 .75rem; text-transform: uppercase; letter-spacing: .04em; font-size: clamp(2rem, 6vw, 4rem); line-height: .92; }
        .eyebrow { color: var(--gold); font-weight: 950; text-transform: uppercase; letter-spacing: .14em; font-size: .78rem; }
        .actions { display: flex; flex-wrap: wrap; gap: .7rem; margin-top: 1.25rem; }
        a { display: inline-flex; align-items: center; justify-content: center; border: 1px solid var(--line); border-radius: 999px; padding: .75rem 1rem; color: var(--bone); text-decoration: none; font-weight: 900; }
        a:first-child { color: #170604; border-color: rgba(255,232,91,.78); background: linear-gradient(135deg, var(--gold), var(--orange) 58%, var(--red)); }
      </style>
    </head>
    <body>
      <main>
        <p class="eyebrow">Support file, not a public route</p>
        <h1>Page section engine</h1>
        <p><code>proto/app/page_sections.php</code> is a PHP include used by the public homepage and standalone section editor. Loading it directly will not show the website because it is not a standalone page.</p>
        <p>Use the standalone section editor to add, edit, position, style, publish, or archive managed public-page sections.</p>
        <div class="actions">
          <a href="../editor/">Open section editor</a>
          <a href="../public/index.php">Open public homepage</a>
        </div>
      </main>
    </body>
    </html>
    <?php
    exit;
}

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/language.php';
require_once __DIR__ . '/site_data.php';

function page_sections_file_path(): string
{
    $override = getenv('JOK_PAGE_SECTIONS_FILE');
    if (is_string($override) && trim($override) !== '') {
        return $override;
    }

    return __DIR__ . '/../docs/page_sections.json';
}

function page_section_default_slots(int $sectionCount = 8): array
{
    $slots = ['before_page' => 'Before page content'];
    for ($i = 1; $i <= $sectionCount; $i++) {
        $slot = 'before_section_' . str_pad((string) $i, 2, '0', STR_PAD_LEFT);
        $slots[$slot] = 'Before section ' . str_pad((string) $i, 2, '0', STR_PAD_LEFT);
    }
    $slots['after_page'] = 'After page content';

    return $slots;
}

function page_section_route_id(string $route): string
{
    return $route === '/' ? '/' : '/' . trim($route, '/') . '/';
}

function page_section_public_path(string $route): string
{
    return $route === '/' ? '../public/index.php' : '../public/' . trim($route, '/') . '/index.php';
}

function page_section_routes(): array
{
    $routes = [];
    foreach (site_pages() as $route => $page) {
        $routeId = page_section_route_id((string) $route);
        $routes[$routeId] = [
            'label' => (string) ($page['label'] ?? $routeId),
            'public_path' => page_section_public_path($routeId),
            'slots' => page_section_default_slots(),
        ];
    }

    // Backward-compatible aliases for legacy homepage section records.
    $routes['home'] = [
        'label' => 'Homepage legacy slots',
        'public_path' => '../public/index.php',
        'slots' => [
            'before_hero' => 'Before hero',
            'after_hero' => 'Between hero and event details',
            'after_event' => 'Between event details and about',
            'after_about' => 'Between about and updates',
            'after_updates' => 'Between updates and final CTA',
            'after_final' => 'Between final CTA and Fan Vault',
            'after_vault' => 'After Fan Vault',
        ],
    ];

    return $routes;
}

function page_section_schema(): array
{
    return [
        'types' => ['text', 'image', 'text_image', 'callout', 'cta'],
        'width_modes' => ['fit', 'full', 'wide', 'narrow', 'custom'],
        'height_modes' => ['fit', 'min', 'custom'],
        'alignments' => ['fit', 'left', 'center', 'right'],
        'visual_styles' => ['fit', 'plain', 'chrome_panel', 'fire_panel', 'vault_case', 'safety_strip'],
        'status_values' => ['draft', 'published', 'archived'],
        'routes' => page_section_routes(),
    ];
}

function page_sections_default_document(): array
{
    return [
        'schema_version' => '1.0.0',
        'document_control' => [
            'title' => 'Just One KISS Page Section Layout Inventory',
            'classification' => 'GEN',
            'status' => 'Current prototype admin-editable page section schema',
            'last_updated' => gmdate('Y-m-d'),
        ],
        'usage_policy' => [
            'prototype_only' => true,
            'source_file' => 'proto/docs/page_sections.json',
            'public_rendering' => 'Published records render through proto/app/page_sections.php at explicit route slots only.',
            'guardrail' => 'Use original rights-safe public-ready copy and approved image filenames only; keep safety/disclaimer facts intact.',
        ],
        'routes' => page_section_schema()['routes'],
        'sections' => [],
    ];
}

function page_sections_read(): array
{
    $path = page_sections_file_path();
    if (!is_file($path) || !is_readable($path)) {
        return page_sections_default_document();
    }

    $raw = file_get_contents($path);
    if ($raw === false || trim($raw) === '') {
        return page_sections_default_document();
    }

    $decoded = json_decode($raw, true);
    if (!is_array($decoded)) {
        return page_sections_default_document();
    }

    if (!isset($decoded['sections']) || !is_array($decoded['sections'])) {
        $decoded['sections'] = [];
    }

    if (!isset($decoded['routes']) || !is_array($decoded['routes'])) {
        $decoded['routes'] = page_section_schema()['routes'];
    }

    return $decoded;
}

function page_sections_for_slot(string $routeId, string $slotId, bool $includeDraft = false): array
{
    $doc = page_sections_read();
    $sections = [];
    foreach ($doc['sections'] as $section) {
        if (!is_array($section)) {
            continue;
        }
        if ((string) ($section['route_id'] ?? '') !== $routeId || (string) ($section['slot_id'] ?? '') !== $slotId) {
            continue;
        }
        $status = (string) ($section['status'] ?? 'draft');
        if (!$includeDraft && $status !== 'published') {
            continue;
        }
        if ($status === 'archived') {
            continue;
        }
        $sections[] = $section;
    }

    usort($sections, static fn (array $a, array $b): int => ((int) ($a['sort_order'] ?? 100)) <=> ((int) ($b['sort_order'] ?? 100)));
    return $sections;
}

function page_section_css_value(string $value): string
{
    return preg_match('/^[A-Za-z0-9. %_\-(),]+$/', $value) ? $value : '';
}

function page_section_style_attr(array $section): string
{
    $style = [];
    $widthMode = (string) ($section['layout']['width_mode'] ?? 'fit');
    $heightMode = (string) ($section['layout']['height_mode'] ?? 'fit');
    $customWidth = page_section_css_value(trim((string) ($section['layout']['custom_width'] ?? '')));
    $customHeight = page_section_css_value(trim((string) ($section['layout']['custom_height'] ?? '')));
    $maxWidth = page_section_css_value(trim((string) ($section['layout']['max_width'] ?? '')));
    $minHeight = page_section_css_value(trim((string) ($section['layout']['min_height'] ?? '')));

    if ($widthMode === 'custom' && $customWidth !== '') {
        $style[] = '--managed-width:' . $customWidth;
    }
    if ($heightMode === 'custom' && $customHeight !== '') {
        $style[] = '--managed-height:' . $customHeight;
    } elseif ($heightMode === 'min' && $minHeight !== '') {
        $style[] = '--managed-min-height:' . $minHeight;
    }
    if ($maxWidth !== '') {
        $style[] = '--managed-max-width:' . $maxWidth;
    }

    return $style === [] ? '' : ' style="' . e(implode(';', $style)) . '"';
}

function page_section_classes(array $section): string
{
    $layout = isset($section['layout']) && is_array($section['layout']) ? $section['layout'] : [];
    $type = preg_replace('/[^a-z0-9_-]/', '', (string) ($section['type'] ?? 'text')) ?: 'text';
    $width = preg_replace('/[^a-z0-9_-]/', '', (string) ($layout['width_mode'] ?? 'fit')) ?: 'fit';
    $height = preg_replace('/[^a-z0-9_-]/', '', (string) ($layout['height_mode'] ?? 'fit')) ?: 'fit';
    $align = preg_replace('/[^a-z0-9_-]/', '', (string) ($layout['alignment'] ?? 'fit')) ?: 'fit';
    $visual = preg_replace('/[^a-z0-9_-]/', '', (string) ($layout['visual_style'] ?? 'fit')) ?: 'fit';

    return implode(' ', [
        'managed-section',
        'managed-section--' . $type,
        'managed-section--width-' . $width,
        'managed-section--height-' . $height,
        'managed-section--align-' . $align,
        'managed-section--style-' . $visual,
    ]);
}

function render_page_section(array $section): void
{
    $type = (string) ($section['type'] ?? 'text');
    $content = isset($section['content']) && is_array($section['content']) ? $section['content'] : [];
    $heading = trim((string) ($content['heading'] ?? ''));
    $body = trim((string) ($content['body'] ?? ''));
    $ctaLabel = trim((string) ($content['cta_label'] ?? ''));
    $ctaUrl = trim((string) ($content['cta_url'] ?? ''));
    $image = trim((string) ($content['image_filename'] ?? ''));
    if ($image !== '' && !in_array($image, image_inventory(), true)) {
        $image = '';
    }
    $alt = trim((string) ($content['image_alt'] ?? $heading));
    $admin = language_admin_is_logged_in();
    $id = (string) ($section['section_id'] ?? 'managed-section');
    ?>
    <section class="<?= e(page_section_classes($section)) ?>" data-managed-section="<?= e($id) ?>"<?= page_section_style_attr($section) ?>>
      <?php if ($admin): ?><a class="managed-section__edit" href="<?= e(rel_url('../editor/?section=' . rawurlencode($id))) ?>">Edit section</a><?php endif; ?>
      <?php if (($type === 'image' || $type === 'text_image') && $image !== ''): ?>
        <figure class="managed-section__media"><img src="<?= e(asset_base_url() . $image) ?>" alt="<?= e($alt) ?>" loading="lazy"></figure>
      <?php endif; ?>
      <div class="managed-section__content">
        <?php if ($heading !== ''): ?><h2><?= e($heading) ?></h2><?php endif; ?>
        <?php if ($body !== ''): ?><p><?= nl2br(e($body)) ?></p><?php endif; ?>
        <?php if (($type === 'cta' || $ctaLabel !== '') && $ctaUrl !== ''): ?><a class="button button--fire" href="<?= e($ctaUrl) ?>"><?= e($ctaLabel !== '' ? $ctaLabel : 'Learn more') ?></a><?php endif; ?>
      </div>
    </section>
    <?php
}

function render_page_section_slot(string $routeId, string $slotId): void
{
    $admin = language_admin_is_logged_in();
    $sections = page_sections_for_slot($routeId, $slotId, $admin);
    if ($admin): ?>
      <div class="managed-insert-slot" data-section-slot="<?= e($routeId . ':' . $slotId) ?>">
        <a href="<?= e(rel_url('../editor/?route=' . rawurlencode($routeId) . '&slot=' . rawurlencode($slotId))) ?>" aria-label="Add section at <?= e($slotId) ?>"><span>+</span></a>
      </div>
    <?php endif;

    foreach ($sections as $section) {
        render_page_section($section);
    }
}
