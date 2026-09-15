<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/page_sections.php';

const EDITOR_USER = 'admin1';
const EDITOR_PASS = 'adminpw';

function editor_h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function editor_logged_in(): bool
{
    return isset($_SESSION['jok_admin_logged_in']) && $_SESSION['jok_admin_logged_in'] === true;
}

function editor_csrf(): string
{
    if (!isset($_SESSION['jok_admin_csrf']) || !is_string($_SESSION['jok_admin_csrf'])) {
        $_SESSION['jok_admin_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['jok_admin_csrf'];
}

function editor_verify_csrf(?string $token): bool
{
    if (!is_string($token)) {
        return false;
    }
    if (isset($_SESSION['jok_admin_csrf']) && hash_equals((string) $_SESSION['jok_admin_csrf'], $token)) {
        return true;
    }
    return isset($_SESSION['csrf_token']) && hash_equals((string) $_SESSION['csrf_token'], $token);
}

function editor_bool(string $value): bool
{
    return $value === '1';
}

function editor_sections_file(): string
{
    return page_sections_file_path();
}

function editor_backup_and_write(array $document): array
{
    $sectionFile = editor_sections_file();
    $backupDir = dirname($sectionFile) . '/page_section_backups';

    if (!is_file($sectionFile)) {
        $seed = page_sections_default_document();
        $encodedSeed = json_encode($seed, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        if (!is_string($encodedSeed) || file_put_contents($sectionFile, $encodedSeed . PHP_EOL, LOCK_EX) === false) {
            return [false, 'Could not create page section JSON file.'];
        }
    }
    if (!is_readable($sectionFile) || !is_writable($sectionFile)) {
        return [false, 'Page section JSON is not writable by this PHP process.'];
    }
    if (!is_dir($backupDir) && !mkdir($backupDir, 0775, true) && !is_dir($backupDir)) {
        return [false, 'Could not create page section backup directory.'];
    }
    $original = file_get_contents($sectionFile);
    if ($original === false) {
        return [false, 'Could not read existing page section JSON for backup.'];
    }
    $backupFile = $backupDir . '/page-sections-' . gmdate('Ymd-His') . '-' . bin2hex(random_bytes(3)) . '.json';
    if (file_put_contents($backupFile, $original, LOCK_EX) === false) {
        return [false, 'Could not write page section backup.'];
    }
    $document['document_control']['last_updated'] = gmdate('Y-m-d');
    $encoded = json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if (!is_string($encoded)) {
        return [false, 'Edited page section JSON could not be encoded.'];
    }
    if (file_put_contents($sectionFile, $encoded . PHP_EOL, LOCK_EX) === false) {
        return [false, 'Could not write page section JSON. Backup remains at ' . basename($backupFile)];
    }
    return [true, 'Saved page section data and created backup: ' . basename($backupFile)];
}

function editor_find_section(array $sections, string $sectionId): ?array
{
    foreach ($sections as $section) {
        if (is_array($section) && (string) ($section['section_id'] ?? '') === $sectionId) {
            return $section;
        }
    }
    return null;
}

function editor_section_from_post(array $post, array $existing = []): array
{
    $schema = page_section_schema();
    $routeId = (string) ($post['route_id'] ?? ($existing['route_id'] ?? 'home'));
    if (!isset($schema['routes'][$routeId])) {
        $routeId = 'home';
    }
    $slotId = (string) ($post['slot_id'] ?? ($existing['slot_id'] ?? 'after_hero'));
    if (!isset($schema['routes'][$routeId]['slots'][$slotId])) {
        $slotId = array_key_first($schema['routes'][$routeId]['slots']);
    }
    $type = (string) ($post['type'] ?? ($existing['type'] ?? 'text'));
    if (!in_array($type, $schema['types'], true)) {
        $type = 'text';
    }
    $status = (string) ($post['status'] ?? ($existing['status'] ?? 'draft'));
    if (!in_array($status, $schema['status_values'], true)) {
        $status = 'draft';
    }
    $widthMode = (string) ($post['width_mode'] ?? ($existing['layout']['width_mode'] ?? 'fit'));
    $heightMode = (string) ($post['height_mode'] ?? ($existing['layout']['height_mode'] ?? 'fit'));
    $alignment = (string) ($post['alignment'] ?? ($existing['layout']['alignment'] ?? 'fit'));
    $visualStyle = (string) ($post['visual_style'] ?? ($existing['layout']['visual_style'] ?? 'fit'));
    if (!in_array($widthMode, $schema['width_modes'], true)) $widthMode = 'fit';
    if (!in_array($heightMode, $schema['height_modes'], true)) $heightMode = 'fit';
    if (!in_array($alignment, $schema['alignments'], true)) $alignment = 'fit';
    if (!in_array($visualStyle, $schema['visual_styles'], true)) $visualStyle = 'fit';
    $image = trim((string) ($post['image_filename'] ?? ($existing['content']['image_filename'] ?? '')));
    if (!in_array($image, image_inventory(), true)) {
        $image = '';
    }
    $sectionId = trim((string) ($post['section_id'] ?? ($existing['section_id'] ?? '')));
    if ($sectionId === '') {
        $sectionId = 'SEC-' . gmdate('Ymd-His') . '-' . strtolower(bin2hex(random_bytes(2)));
    }
    $sectionId = preg_replace('/[^A-Za-z0-9_-]/', '-', $sectionId) ?: 'SEC-' . gmdate('Ymd-His');

    return [
        'section_id' => $sectionId,
        'route_id' => $routeId,
        'slot_id' => $slotId,
        'sort_order' => max(0, (int) ($post['sort_order'] ?? ($existing['sort_order'] ?? 100))),
        'type' => $type,
        'status' => $status,
        'timeline_moment_id_or_gen' => trim((string) ($post['timeline_moment_id_or_gen'] ?? ($existing['timeline_moment_id_or_gen'] ?? 'GEN'))) ?: 'GEN',
        'layout' => [
            'width_mode' => $widthMode,
            'height_mode' => $heightMode,
            'alignment' => $alignment,
            'visual_style' => $visualStyle,
            'custom_width' => trim((string) ($post['custom_width'] ?? ($existing['layout']['custom_width'] ?? ''))),
            'custom_height' => trim((string) ($post['custom_height'] ?? ($existing['layout']['custom_height'] ?? ''))),
            'max_width' => trim((string) ($post['max_width'] ?? ($existing['layout']['max_width'] ?? ''))),
            'min_height' => trim((string) ($post['min_height'] ?? ($existing['layout']['min_height'] ?? ''))),
        ],
        'content' => [
            'heading' => trim((string) ($post['heading'] ?? ($existing['content']['heading'] ?? ''))),
            'body' => trim((string) ($post['body'] ?? ($existing['content']['body'] ?? ''))),
            'image_filename' => $image,
            'image_alt' => trim((string) ($post['image_alt'] ?? ($existing['content']['image_alt'] ?? ''))),
            'cta_label' => trim((string) ($post['cta_label'] ?? ($existing['content']['cta_label'] ?? ''))),
            'cta_url' => trim((string) ($post['cta_url'] ?? ($existing['content']['cta_url'] ?? ''))),
        ],
        'review' => [
            'rights_safe' => editor_bool((string) ($post['rights_safe'] ?? (!empty($existing['review']['rights_safe']) ? '1' : '0'))),
            'safety_related' => editor_bool((string) ($post['safety_related'] ?? (!empty($existing['review']['safety_related']) ? '1' : '0'))),
            'public_ready' => editor_bool((string) ($post['public_ready'] ?? (!empty($existing['review']['public_ready']) ? '1' : '0'))),
        ],
        'updated_at' => gmdate('c'),
    ];
}

function editor_route_slots(): array
{
    $schema = page_section_schema();
    return $schema['routes']['home']['slots'];
}

function editor_slot_sections(array $sections, string $slotId): array
{
    $rows = array_values(array_filter($sections, static fn ($section): bool => is_array($section) && (string) ($section['route_id'] ?? 'home') === 'home' && (string) ($section['slot_id'] ?? '') === $slotId && (string) ($section['status'] ?? 'draft') !== 'archived'));
    usort($rows, static fn (array $a, array $b): int => ((int) ($a['sort_order'] ?? 100)) <=> ((int) ($b['sort_order'] ?? 100)));
    return $rows;
}

function editor_default_section_label(string $slotId): string
{
    return match ($slotId) {
        'before_hero' => 'Hero section follows this slot',
        'after_hero' => 'Event details follows this slot',
        'after_event' => 'About/proof section follows this slot',
        'after_about' => 'Updates form follows this slot',
        'after_updates' => 'Final CTA follows this slot',
        'after_final' => 'Fan Vault follows this slot',
        default => 'Shared event/footer follows this slot',
    };
}

$notice = null;
$noticeType = 'ok';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = (string) ($_POST['action'] ?? '');
    if ($action === 'login') {
        if (!editor_verify_csrf($_POST['csrf_token'] ?? null)) {
            $notice = 'Login session expired. Try again.';
            $noticeType = 'error';
        } elseif ((string) ($_POST['username'] ?? '') === EDITOR_USER && (string) ($_POST['password'] ?? '') === EDITOR_PASS) {
            session_regenerate_id(true);
            $_SESSION['jok_admin_logged_in'] = true;
            $_SESSION['jok_admin_csrf'] = bin2hex(random_bytes(32));
            header('Location: ./');
            exit;
        } else {
            $notice = 'Invalid editor credentials.';
            $noticeType = 'error';
        }
    }
    if ($action === 'logout' && editor_verify_csrf($_POST['csrf_token'] ?? null)) {
        $_SESSION = [];
        session_destroy();
        header('Location: ./');
        exit;
    }
    if (in_array($action, ['save_section', 'archive_section', 'quick_add', 'move_section'], true) && editor_logged_in()) {
        if (!editor_verify_csrf($_POST['csrf_token'] ?? null)) {
            $notice = 'Editor session expired. Reload and try again.';
            $noticeType = 'error';
        } else {
            $doc = page_sections_read();
            $sections = isset($doc['sections']) && is_array($doc['sections']) ? $doc['sections'] : [];
            $sectionId = trim((string) ($_POST['section_id'] ?? ''));
            if ($action === 'quick_add') {
                $new = editor_section_from_post([
                    'route_id' => 'home',
                    'slot_id' => (string) ($_POST['slot_id'] ?? 'after_hero'),
                    'sort_order' => 1000 + count($sections) * 10,
                    'type' => 'text',
                    'status' => 'draft',
                    'timeline_moment_id_or_gen' => 'GEN',
                    'heading' => 'New editable section',
                    'body' => 'Select this section and replace this draft copy.',
                    'rights_safe' => '1',
                ]);
                $sections[] = $new;
                $doc['sections'] = $sections;
                [$saved, $message] = editor_backup_and_write($doc);
                if ($saved) {
                    header('Location: ./?section=' . rawurlencode((string) $new['section_id']));
                    exit;
                }
                $notice = $message;
                $noticeType = 'error';
            } elseif ($action === 'archive_section' && $sectionId !== '') {
                foreach ($sections as $index => $section) {
                    if (is_array($section) && (string) ($section['section_id'] ?? '') === $sectionId) {
                        $sections[$index]['status'] = 'archived';
                        $sections[$index]['updated_at'] = gmdate('c');
                    }
                }
                $doc['sections'] = $sections;
                [$saved, $message] = editor_backup_and_write($doc);
                $notice = $saved ? 'Archived section. ' . $message : $message;
                $noticeType = $saved ? 'ok' : 'error';
            } elseif ($action === 'move_section' && $sectionId !== '') {
                $targetSlot = (string) ($_POST['slot_id'] ?? 'after_hero');
                $targetOrder = max(0, (int) ($_POST['sort_order'] ?? 100));
                foreach ($sections as $index => $section) {
                    if (is_array($section) && (string) ($section['section_id'] ?? '') === $sectionId) {
                        $sections[$index]['slot_id'] = $targetSlot;
                        $sections[$index]['sort_order'] = $targetOrder;
                        $sections[$index]['updated_at'] = gmdate('c');
                    }
                }
                $doc['sections'] = $sections;
                [$saved, $message] = editor_backup_and_write($doc);
                if ($saved) {
                    header('Location: ./?section=' . rawurlencode($sectionId));
                    exit;
                }
                $notice = $message;
                $noticeType = 'error';
            } else {
                $existing = $sectionId !== '' ? editor_find_section($sections, $sectionId) : null;
                $edited = editor_section_from_post($_POST, $existing ?? []);
                $replaced = false;
                foreach ($sections as $index => $section) {
                    if (is_array($section) && (string) ($section['section_id'] ?? '') === (string) $edited['section_id']) {
                        $sections[$index] = $edited;
                        $replaced = true;
                        break;
                    }
                }
                if (!$replaced) {
                    $sections[] = $edited;
                }
                $doc['sections'] = $sections;
                [$saved, $message] = editor_backup_and_write($doc);
                if ($saved) {
                    header('Location: ./?section=' . rawurlencode((string) $edited['section_id']));
                    exit;
                }
                $notice = $message;
                $noticeType = 'error';
            }
        }
    }
}

$schema = page_section_schema();
$doc = page_sections_read();
$sections = isset($doc['sections']) && is_array($doc['sections']) ? $doc['sections'] : [];
$selectedId = trim((string) ($_GET['section'] ?? ''));
$selected = $selectedId !== '' ? editor_find_section($sections, $selectedId) : null;
$activeSection = $selected ?? [
    'section_id' => '',
    'route_id' => 'home',
    'slot_id' => 'after_hero',
    'sort_order' => 100,
    'type' => 'text',
    'status' => 'draft',
    'timeline_moment_id_or_gen' => 'GEN',
    'layout' => ['width_mode' => 'fit', 'height_mode' => 'fit', 'alignment' => 'fit', 'visual_style' => 'fit', 'custom_width' => '', 'custom_height' => '', 'max_width' => '', 'min_height' => ''],
    'content' => ['heading' => '', 'body' => '', 'image_filename' => '', 'image_alt' => '', 'cta_label' => '', 'cta_url' => ''],
    'review' => ['rights_safe' => true, 'safety_related' => false, 'public_ready' => false],
];
$layout = isset($activeSection['layout']) && is_array($activeSection['layout']) ? $activeSection['layout'] : [];
$content = isset($activeSection['content']) && is_array($activeSection['content']) ? $activeSection['content'] : [];
$review = isset($activeSection['review']) && is_array($activeSection['review']) ? $activeSection['review'] : [];
$slots = editor_route_slots();
$imageOptions = image_inventory();
?><?php
function editor_render_login(?string $notice, string $noticeType): void
{
    ?><!doctype html>
    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="robots" content="noindex,nofollow">
      <title>Just One KISS Section Editor</title>
      <link rel="stylesheet" href="../public/assets/css/site.css">
      <style>.editor-login-shell{min-height:100vh;display:grid;place-items:center;padding:1rem}.editor-login-card{width:min(520px,100%)}</style>
    </head>
    <body>
      <main class="editor-login-shell">
        <section class="panel editor-login-card">
          <p class="eyebrow">Standalone visual editor</p>
          <h1>Section Editor</h1>
          <?php if ($notice !== null): ?><div class="notice notice--<?= editor_h($noticeType) ?>"><?= editor_h($notice) ?></div><?php endif; ?>
          <form method="post" class="site-form" action="./">
            <input type="hidden" name="action" value="login">
            <input type="hidden" name="csrf_token" value="<?= editor_h(editor_csrf()) ?>">
            <label>Username <input name="username" autocomplete="username" required></label>
            <label>Password <input name="password" type="password" autocomplete="current-password" required></label>
            <button class="button button--fire" type="submit">Log in</button>
          </form>
        </section>
      </main>
    </body>
    </html><?php
}

function editor_overlay_markup(array $activeSection, array $schema, array $slots, array $imageOptions, array $sections, ?string $notice, string $noticeType): string
{
    $layout = isset($activeSection['layout']) && is_array($activeSection['layout']) ? $activeSection['layout'] : [];
    $content = isset($activeSection['content']) && is_array($activeSection['content']) ? $activeSection['content'] : [];
    $review = isset($activeSection['review']) && is_array($activeSection['review']) ? $activeSection['review'] : [];
    ob_start(); ?>
    <div class="visual-editor-topbar" data-editor-chrome>
      <strong>Just One KISS <span>Visual Section Editor</span></strong>
      <nav>
        <button type="button" data-toggle-drawer aria-controls="entity-drawer" aria-expanded="false">Select</button>
        <a href="../admin/">Language admin</a>
        <a href="../public/index.php" target="_blank" rel="noopener">Open live page</a>
        <form method="post" action="../editor/"><input type="hidden" name="action" value="logout"><input type="hidden" name="csrf_token" value="<?= editor_h(editor_csrf()) ?>"><button type="submit">Log out</button></form>
      </nav>
    </div>
    <aside class="visual-editor-drawer" id="entity-drawer" data-editor-drawer aria-label="Selected entity editor">
      <div class="visual-editor-drawer__header"><div><p class="eyebrow">Selected entity</p>
      <h2 data-selected-title><?= ($activeSection['section_id'] ?? '') !== '' ? editor_h((string) ($content['heading'] ?? $activeSection['section_id'])) : 'New section' ?></h2></div><button class="drawer-toggle" type="button" data-close-drawer aria-label="Close selected entity drawer">×</button></div>
      <p class="small-note" data-selected-note>Click actual page text, images, existing managed sections, or a + insertion bubble. This drawer shows the currently selected entity data.</p>
      <?php if ($notice !== null): ?><div class="notice notice--<?= editor_h($noticeType) ?>"><?= editor_h($notice) ?></div><?php endif; ?>
      <form method="post" action="../editor/" class="visual-editor-form" data-entity-form>
        <section class="editor-card editor-card--primary"><div class="editor-card__title"><span>Content</span><small>Modern section data</small></div>
        <input type="hidden" name="action" value="save_section">
        <input type="hidden" name="csrf_token" value="<?= editor_h(editor_csrf()) ?>">
        <label>Section ID <input name="section_id" value="<?= editor_h((string) ($activeSection['section_id'] ?? '')) ?>" readonly></label>
        <div class="editor-field-row"><label>Route <select name="route_id"><option value="home">Homepage</option></select></label><label>Slot <select name="slot_id"><?php foreach ($slots as $slotId => $slotLabel): ?><option value="<?= editor_h((string) $slotId) ?>"<?= ((string) ($activeSection['slot_id'] ?? '') === (string) $slotId) ? ' selected' : '' ?>><?= editor_h((string) $slotLabel) ?></option><?php endforeach; ?></select></label></div>
        <div class="editor-field-row"><label>Type <select name="type"><?php foreach ($schema['types'] as $type): ?><option value="<?= editor_h($type) ?>"<?= ((string) ($activeSection['type'] ?? 'text') === $type) ? ' selected' : '' ?>><?= editor_h(str_replace('_', ' + ', $type)) ?></option><?php endforeach; ?></select></label><label>Status <select name="status"><?php foreach ($schema['status_values'] as $status): ?><option value="<?= editor_h($status) ?>"<?= ((string) ($activeSection['status'] ?? 'draft') === $status) ? ' selected' : '' ?>><?= editor_h($status) ?></option><?php endforeach; ?></select></label></div>
        <div class="editor-field-row"><label>Sort order <input name="sort_order" type="number" step="10" value="<?= editor_h((string) ($activeSection['sort_order'] ?? 100)) ?>"></label><label>Timeline / GEN <input name="timeline_moment_id_or_gen" value="<?= editor_h((string) ($activeSection['timeline_moment_id_or_gen'] ?? 'GEN')) ?>"></label></div>
        <label>Heading <input name="heading" value="<?= editor_h((string) ($content['heading'] ?? '')) ?>"></label>
        <label>Body <textarea name="body"><?= editor_h((string) ($content['body'] ?? '')) ?></textarea></label>
        </section>
        <section class="editor-card"><div class="editor-card__title"><span>Media + CTA</span><small>Visual assets and link</small></div>
        <div class="editor-field-row"><label>Image <select name="image_filename"><option value="">No image</option><?php foreach ($imageOptions as $image): ?><option value="<?= editor_h($image) ?>"<?= ((string) ($content['image_filename'] ?? '') === $image) ? ' selected' : '' ?>><?= editor_h($image) ?></option><?php endforeach; ?></select></label><label>Alt text <input name="image_alt" value="<?= editor_h((string) ($content['image_alt'] ?? '')) ?>"></label></div>
        <div class="editor-field-row"><label>CTA label <input name="cta_label" value="<?= editor_h((string) ($content['cta_label'] ?? '')) ?>"></label><label>CTA URL <input name="cta_url" value="<?= editor_h((string) ($content['cta_url'] ?? '')) ?>"></label></div>
        </section>
        <section class="editor-card"><div class="editor-card__title"><span>Layout</span><small>Size, position, treatment</small></div>
        <div class="editor-field-row"><label>Width <select name="width_mode"><?php foreach ($schema['width_modes'] as $mode): ?><option value="<?= editor_h($mode) ?>"<?= ((string) ($layout['width_mode'] ?? 'fit') === $mode) ? ' selected' : '' ?>><?= editor_h($mode) ?></option><?php endforeach; ?></select></label><label>Height <select name="height_mode"><?php foreach ($schema['height_modes'] as $mode): ?><option value="<?= editor_h($mode) ?>"<?= ((string) ($layout['height_mode'] ?? 'fit') === $mode) ? ' selected' : '' ?>><?= editor_h($mode) ?></option><?php endforeach; ?></select></label></div>
        <div class="editor-field-row"><label>Alignment <select name="alignment"><?php foreach ($schema['alignments'] as $mode): ?><option value="<?= editor_h($mode) ?>"<?= ((string) ($layout['alignment'] ?? 'fit') === $mode) ? ' selected' : '' ?>><?= editor_h($mode) ?></option><?php endforeach; ?></select></label><label>Style <select name="visual_style"><?php foreach ($schema['visual_styles'] as $style): ?><option value="<?= editor_h($style) ?>"<?= ((string) ($layout['visual_style'] ?? 'fit') === $style) ? ' selected' : '' ?>><?= editor_h(str_replace('_', ' ', $style)) ?></option><?php endforeach; ?></select></label></div>
        <div class="editor-field-row"><label>Custom width <input name="custom_width" value="<?= editor_h((string) ($layout['custom_width'] ?? '')) ?>"></label><label>Custom height <input name="custom_height" value="<?= editor_h((string) ($layout['custom_height'] ?? '')) ?>"></label></div>
        <div class="editor-field-row"><label>Max width <input name="max_width" value="<?= editor_h((string) ($layout['max_width'] ?? '')) ?>"></label><label>Min height <input name="min_height" value="<?= editor_h((string) ($layout['min_height'] ?? '')) ?>"></label></div>
        </section>
        <section class="editor-card"><div class="editor-card__title"><span>Review gates</span><small>Publication checks</small></div>
        <div class="editor-checks"><label><input type="hidden" name="rights_safe" value="0"><input type="checkbox" name="rights_safe" value="1"<?= !empty($review['rights_safe']) ? ' checked' : '' ?>> Rights-safe</label>
        <label><input type="hidden" name="safety_related" value="0"><input type="checkbox" name="safety_related" value="1"<?= !empty($review['safety_related']) ? ' checked' : '' ?>> Safety-related</label>
        <label><input type="hidden" name="public_ready" value="0"><input type="checkbox" name="public_ready" value="1"<?= !empty($review['public_ready']) ? ' checked' : '' ?>> Public-ready</label></div>
        </section>
        <section class="editor-card editor-card--legacy" data-legacy-text-card hidden><div class="editor-card__title"><span>Legacy text editor</span><small data-legacy-token-label>No token selected</small></div><label>Canonical text <textarea data-legacy-text-editor placeholder="Select tokenized page text to edit legacy copy here."></textarea></label><div class="editor-action-row"><button type="button" class="button button--fire" data-legacy-save>Save text</button><a data-legacy-admin-link target="_blank" rel="noopener">Open language admin</a></div><div class="jok-lang-status" data-legacy-status aria-live="polite"></div></section>
        <div class="editor-sticky-actions"><button class="button button--fire" type="submit">Save selected section</button></div>
      </form>
    </aside>
    <dialog class="visual-editor-popover" data-editor-popover>
      <form method="dialog"><button value="close" aria-label="Close">×</button></form>
      <p class="eyebrow" data-popover-kicker>Selected</p>
      <h2 data-popover-title>Page entity</h2>
      <p data-popover-body>Use the drawer to edit managed sections or inspect selected page elements.</p>
      <div class="cta-row"><button type="button" class="button button--fire" data-open-drawer>Open drawer</button><button type="button" class="button" data-clear-selection>Clear</button></div>
    </dialog>
    <form method="post" action="../editor/" hidden data-quick-add-form><input type="hidden" name="action" value="quick_add"><input type="hidden" name="csrf_token" value="<?= editor_h(editor_csrf()) ?>"><input type="hidden" name="slot_id" data-quick-slot></form>
    <script>window.JOK_SECTION_EDITOR_DATA = <?= json_encode(array_values(array_filter($sections, 'is_array')), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;</script>
    <form method="post" action="../editor/" hidden data-archive-form><input type="hidden" name="action" value="archive_section"><input type="hidden" name="csrf_token" value="<?= editor_h(editor_csrf()) ?>"><input type="hidden" name="section_id" data-archive-id></form>
    <?php return ob_get_clean();
}

function editor_assets(): string
{
    return <<<'HTML'
    <style data-visual-editor-css>
      .visual-editor-topbar { position: fixed; inset: 0 0 auto 0; z-index: 9998; min-height: 64px; display: flex; justify-content: space-between; align-items: center; gap: 1rem; padding: .6rem 1rem; color: #f2f2ee; background: rgba(5,5,5,.94); border-bottom: 1px solid rgba(184,188,194,.3); }
      .visual-editor-topbar strong { text-transform: uppercase; letter-spacing: .08em; } .visual-editor-topbar span { display:block; color:#d8a31a; font-size:.78rem; }
      .visual-editor-topbar nav { display:flex; gap:.55rem; align-items:center; flex-wrap:wrap; } .visual-editor-topbar a, .visual-editor-topbar button { border:1px solid rgba(184,188,194,.35); border-radius:999px; padding:.62rem .85rem; color:#f2f2ee; background:rgba(255,255,255,.08); font-weight:900; text-decoration:none; cursor:pointer; }
      .visual-editor-topbar nav > a:last-of-type, .visual-editor-topbar [data-toggle-drawer], .visual-editor-topbar [data-open-drawer] { color:#170604; background:linear-gradient(135deg,#d8a31a,#f06a21,#b20d18); border-color:rgba(255,232,91,.78); box-shadow:0 0 24px rgba(240,106,33,.24); }
      .visual-editor-drawer { position: fixed; top: 64px; right: 0; bottom: 0; z-index: 9997; width: min(560px, calc(100vw - 1rem)); overflow:auto; padding:1rem clamp(1rem, 2vw, 1.35rem) 5rem; color:#f2f2ee; background:linear-gradient(160deg, rgba(20,20,26,.98), rgba(4,4,7,.98)); border-left:1px solid rgba(242,194,48,.38); box-shadow:-34px 0 70px rgba(0,0,0,.48); transform:translateX(104%); pointer-events:none; transition:transform .24s ease, box-shadow .24s ease; }
      .visual-editor-drawer.is-open { transform:translateX(0); pointer-events:auto; } .visual-editor-drawer__header { position:sticky; top:-1rem; z-index:4; display:flex; justify-content:space-between; align-items:flex-start; gap:1rem; margin:-1rem -1.35rem 1rem; padding:1rem 1.35rem .9rem; background:linear-gradient(180deg, rgba(7,7,10,.98), rgba(7,7,10,.88)); border-bottom:1px solid rgba(184,188,194,.22); backdrop-filter:blur(14px); } .visual-editor-drawer__header h2 { margin:.15rem 0 0; font-size:clamp(1.25rem, 2vw, 1.8rem); }
      .drawer-toggle { flex:0 0 auto; width:2.45rem; height:2.45rem; border:1px solid rgba(242,194,48,.62); border-radius:999px; color:#f2f2ee; background:rgba(255,255,255,.08); font-size:1.45rem; cursor:pointer; }
      .visual-editor-form, .visual-editor-form label { display:grid; gap:.45rem; } .visual-editor-form { gap:.85rem; } .visual-editor-form label { color:#d7d9de; font-size:.9rem; font-weight:800; letter-spacing:.02em; } .visual-editor-form input, .visual-editor-form textarea, .visual-editor-form select { width:100%; color:#f2f2ee; background:#050507; border:1px solid rgba(184,188,194,.4); border-radius:12px; padding:.72rem; font:inherit; } .visual-editor-form textarea { min-height:10rem; resize:vertical; line-height:1.55; }
      .editor-card { display:grid; gap:.72rem; padding:1rem; border:1px solid rgba(184,188,194,.18); border-radius:20px; background:rgba(255,255,255,.045); box-shadow:0 16px 36px rgba(0,0,0,.18); } .editor-card--primary { border-color:rgba(242,194,48,.34); } .editor-card--legacy { background:linear-gradient(145deg, rgba(242,194,48,.1), rgba(255,255,255,.04)); } .editor-card__title { display:flex; justify-content:space-between; gap:1rem; align-items:baseline; color:#f2c230; font-weight:950; text-transform:uppercase; letter-spacing:.08em; } .editor-card__title small { color:#b8bcc2; text-transform:none; letter-spacing:0; font-weight:700; }
      .editor-field-row { display:grid; grid-template-columns:minmax(0,1fr) minmax(0,1fr); gap:.65rem; } .editor-checks { display:grid; grid-template-columns:repeat(3, minmax(0,1fr)); gap:.55rem; } .editor-checks label { align-content:start; padding:.65rem; border:1px solid rgba(184,188,194,.2); border-radius:14px; background:rgba(0,0,0,.18); } .editor-action-row { display:flex; align-items:center; gap:.6rem; flex-wrap:wrap; } .editor-action-row a { color:#f2c230; font-weight:900; } .editor-sticky-actions { position:sticky; bottom:-5rem; z-index:5; margin:0 -1.35rem -5rem; padding:1rem 1.35rem; background:linear-gradient(0deg, rgba(7,7,10,.99), rgba(7,7,10,.82)); border-top:1px solid rgba(184,188,194,.22); }
      .jok-editor-selected { outline: 3px solid #f2c230 !important; outline-offset: 4px !important; box-shadow: 0 0 0 8px rgba(242,194,48,.18), 0 0 42px rgba(240,106,33,.35) !important; position: relative; z-index: 6; }
      [data-section-slot] { opacity:.22; } [data-section-slot]:hover, [data-section-slot]:focus-within { opacity:1; }
      .jok-editor-element-hint { cursor: crosshair; }
      .jok-lang-toolbar { display:none !important; }
      .visual-editor-popover { z-index:10000; max-width:min(420px, calc(100vw - 2rem)); color:#f2f2ee; background:rgba(12,12,16,.96); border:1px solid rgba(242,194,48,.65); border-radius:20px; box-shadow:0 0 48px rgba(240,106,33,.28); }
      .visual-editor-popover::backdrop { background:rgba(0,0,0,.2); } .visual-editor-popover form[method="dialog"] { float:right; }
      .small-note { color:#b8bcc2; line-height:1.5; }
      @media (max-width: 860px) { .visual-editor-topbar { align-items:flex-start; flex-direction:column; } .visual-editor-drawer { top:112px; width:calc(100vw - .5rem); } .editor-field-row, .editor-checks { grid-template-columns:1fr; } }
    </style>
    <script data-visual-editor-js>
      document.addEventListener('DOMContentLoaded', () => {
        const drawer = document.querySelector('[data-editor-drawer]');
        const popover = document.querySelector('[data-editor-popover]');
        const form = document.querySelector('[data-entity-form]');
        const quickForm = document.querySelector('[data-quick-add-form]');
        const archiveForm = document.querySelector('[data-archive-form]');
        const sectionData = new Map((window.JOK_SECTION_EDITOR_DATA || []).map((section) => [section.section_id, section]));
        const legacyAdmin = window.JOK_INLINE_LANGUAGE_ADMIN || {};
        const legacyCard = document.querySelector('[data-legacy-text-card]');
        const legacyText = document.querySelector('[data-legacy-text-editor]');
        const legacyTokenLabel = document.querySelector('[data-legacy-token-label]');
        const legacyStatus = document.querySelector('[data-legacy-status]');
        const legacyAdminLink = document.querySelector('[data-legacy-admin-link]');
        let activeLegacyToken = '';
        if (legacyAdminLink) legacyAdminLink.href = legacyAdmin.adminUrl || '../admin/';
        const fields = form ? Object.fromEntries(Array.from(form.elements).filter((el) => el.name).map((el) => [el.name, el])) : {};
        const setSelectExpanded = (open) => document.querySelectorAll('[data-toggle-drawer]').forEach((button) => button.setAttribute('aria-expanded', open ? 'true' : 'false'));
        const openDrawer = () => { drawer?.classList.add('is-open'); setSelectExpanded(true); };
        const closeDrawer = () => { drawer?.classList.remove('is-open'); setSelectExpanded(false); };
        const toggleDrawer = () => { const next = !drawer?.classList.contains('is-open'); drawer?.classList.toggle('is-open'); setSelectExpanded(next); };
        document.querySelectorAll('[data-open-drawer]').forEach((button) => button.addEventListener('click', openDrawer));
        document.querySelectorAll('[data-toggle-drawer]').forEach((button) => button.addEventListener('click', (event) => { event.preventDefault(); toggleDrawer(); }));
        document.querySelector('[data-close-drawer]')?.addEventListener('click', closeDrawer);
        const clearSelection = () => document.querySelectorAll('.jok-editor-selected').forEach((node) => node.classList.remove('jok-editor-selected'));
        document.querySelector('[data-clear-selection]')?.addEventListener('click', () => { clearSelection(); closeDrawer(); popover?.close(); });
        document.addEventListener('click', (event) => {
          if (event.target.closest('[data-editor-chrome], [data-editor-drawer], dialog, .managed-insert-slot, .managed-section, [data-lang-token], main section, main article, main img')) return;
          clearSelection();
          closeDrawer();
          if (popover?.open) popover.close();
        });
        const setValue = (name, value) => { if (fields[name]) fields[name].value = value ?? ''; };
        const showLegacyEditor = (node) => {
          activeLegacyToken = node.dataset.langToken || '';
          if (!activeLegacyToken || !legacyCard) return;
          legacyCard.hidden = false;
          if (legacyTokenLabel) legacyTokenLabel.textContent = activeLegacyToken;
          if (legacyText) legacyText.value = node.textContent?.trim() || '';
          if (legacyStatus) legacyStatus.textContent = legacyAdmin.csrf && legacyAdmin.endpoint ? 'Ready to edit legacy text token in this drawer.' : 'Inline save is unavailable for this session; use Language admin.';
        };
        document.querySelector('[data-legacy-save]')?.addEventListener('click', () => {
          if (!activeLegacyToken || !legacyText || !legacyAdmin.csrf || !legacyAdmin.endpoint) return;
          const body = new URLSearchParams(); body.set('csrf_token', legacyAdmin.csrf); body.set('token', activeLegacyToken); body.set('canonical_text', legacyText.value);
          if (legacyStatus) legacyStatus.textContent = 'Saving…';
          fetch(legacyAdmin.endpoint, { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8' }, body, credentials: 'same-origin' })
            .then((response) => response.json()).then((payload) => { if (!payload.ok) throw new Error(payload.message || 'Save failed.'); document.querySelectorAll('[data-lang-token="' + CSS.escape(activeLegacyToken) + '"]').forEach((node) => { node.textContent = payload.canonical_text || legacyText.value; }); if (legacyStatus) legacyStatus.textContent = payload.message || 'Saved.'; })
            .catch((error) => { if (legacyStatus) legacyStatus.textContent = error.message || 'Save failed.'; });
        });
        const fillSection = (section) => {
          const layout = section.layout || {}; const content = section.content || {}; const review = section.review || {};
          Object.entries({ section_id: section.section_id || '', route_id: section.route_id || 'home', slot_id: section.slot_id || 'after_hero', type: section.type || 'text', status: section.status || 'draft', sort_order: section.sort_order || 100, timeline_moment_id_or_gen: section.timeline_moment_id_or_gen || 'GEN', heading: content.heading || '', body: content.body || '', image_filename: content.image_filename || '', image_alt: content.image_alt || '', cta_label: content.cta_label || '', cta_url: content.cta_url || '', width_mode: layout.width_mode || 'fit', height_mode: layout.height_mode || 'fit', alignment: layout.alignment || 'fit', visual_style: layout.visual_style || 'fit', custom_width: layout.custom_width || '', custom_height: layout.custom_height || '', max_width: layout.max_width || '', min_height: layout.min_height || '' }).forEach(([k,v]) => setValue(k,v));
          ['rights_safe','safety_related','public_ready'].forEach((name) => { if (fields[name]) fields[name].checked = !!review[name]; });
          document.querySelector('[data-selected-title]').textContent = content.heading || section.section_id || 'Managed section';
          document.querySelector('[data-selected-note]').textContent = 'Managed section selected. Edit the schema data in this right-side drawer, archive it with ×, or publish by changing status to published.';
          if (legacyCard) legacyCard.hidden = true;
          openDrawer();
        };
        const showPopover = (title, body, kicker = 'Selected') => { if (!popover) return; popover.querySelector('[data-popover-kicker]').textContent = kicker; popover.querySelector('[data-popover-title]').textContent = title; popover.querySelector('[data-popover-body]').textContent = body; popover.showModal(); };
        document.querySelectorAll('[data-section-slot]').forEach((slot) => {
          slot.addEventListener('click', (event) => { event.preventDefault(); const value = (slot.dataset.sectionSlot || 'home:after_hero').split(':')[1] || 'after_hero'; if (fields.slot_id) fields.slot_id.value = value; setValue('section_id',''); setValue('heading','New editable section'); setValue('body','Draft copy for this new section.'); showPopover('Add section here', 'Click Open drawer to customize first, or use the + bubble to create a draft immediately.', 'Insertion point'); openDrawer(); });
        });
        document.querySelectorAll('.managed-insert-slot a').forEach((link) => {
          link.addEventListener('click', (event) => { event.preventDefault(); const slot = link.closest('[data-section-slot]')?.dataset.sectionSlot?.split(':')[1] || 'after_hero'; if (quickForm) { quickForm.querySelector('[data-quick-slot]').value = slot; quickForm.submit(); } });
        });
        document.querySelectorAll('.managed-section').forEach((section) => {
          section.setAttribute('draggable','true');
          section.addEventListener('dragstart', (event) => event.dataTransfer.setData('text/plain', section.dataset.managedSection || ''));
          section.addEventListener('click', (event) => { event.preventDefault(); clearSelection(); section.classList.add('jok-editor-selected'); const id = section.dataset.managedSection || ''; const saved = sectionData.get(id); if (saved) fillSection(saved); else { setValue('section_id', id); setValue('heading', section.querySelector('h2')?.textContent?.trim() || id); setValue('body', section.querySelector('p')?.textContent?.trim() || ''); document.querySelector('[data-selected-title]').textContent = id || 'Managed section'; openDrawer(); } showPopover('Managed section', 'This is a managed section. Use the drawer to edit its saved section data.', 'Editable'); });
          const remove = document.createElement('button'); remove.type = 'button'; remove.textContent = '×'; remove.className = 'managed-section__edit'; remove.style.left = '.75rem'; remove.style.right = 'auto'; remove.addEventListener('click', (event) => { event.stopPropagation(); const id = section.dataset.managedSection || ''; if (id && archiveForm) { archiveForm.querySelector('[data-archive-id]').value = id; archiveForm.submit(); } }); section.appendChild(remove);
        });
        document.querySelectorAll('main section, main article, main img, main [data-lang-token]').forEach((node) => {
          if (node.closest('[data-editor-chrome], [data-editor-drawer], dialog') || node.classList.contains('managed-section')) return;
          node.classList.add('jok-editor-element-hint');
          node.addEventListener('click', (event) => { if (event.target.closest('a,button,input,textarea,select')) return; event.preventDefault(); event.stopPropagation(); clearSelection(); node.classList.add('jok-editor-selected'); const label = node.dataset.langToken || node.getAttribute('alt') || node.querySelector('h1,h2,h3')?.textContent?.trim() || node.textContent?.trim()?.slice(0,80) || node.tagName.toLowerCase(); document.querySelector('[data-selected-title]').textContent = label; document.querySelector('[data-selected-note]').textContent = node.dataset.langToken ? 'Legacy tokenized text selected. Edit and save its canonical text from the legacy editor card inside this drawer.' : 'Existing public-page element selected. Create a managed section near this area with a + insertion handle.'; if (node.dataset.langToken) showLegacyEditor(node); else if (legacyCard) legacyCard.hidden = true; showPopover('Existing page element', label, node.dataset.langToken ? 'Language token' : node.tagName.toLowerCase()); openDrawer(); });
        });
      });
    </script>
HTML;
}

if (!editor_logged_in()) {
    editor_render_login($notice, $noticeType);
    return;
}

$_SESSION['jok_admin_logged_in'] = true;
$oldScriptName = $_SERVER['SCRIPT_NAME'] ?? null;
$oldScriptFilename = $_SERVER['SCRIPT_FILENAME'] ?? null;
$_SERVER['SCRIPT_NAME'] = '/proto/public/index.php';
$_SERVER['SCRIPT_FILENAME'] = realpath(__DIR__ . '/../public/index.php') ?: __DIR__ . '/../public/index.php';
ob_start();
require __DIR__ . '/../public/index.php';
$page = ob_get_clean();
if ($oldScriptName !== null) { $_SERVER['SCRIPT_NAME'] = $oldScriptName; }
if ($oldScriptFilename !== null) { $_SERVER['SCRIPT_FILENAME'] = $oldScriptFilename; }
$page = str_replace('<head>', '<head><base href="../public/">', $page);
$page = str_replace('</head>', editor_assets() . "\n</head>", $page);
$page = str_replace('</body>', editor_overlay_markup($activeSection, $schema, $slots, $imageOptions, $sections, $notice, $noticeType) . "\n</body>", $page);
echo $page;
