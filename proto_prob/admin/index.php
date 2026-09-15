<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/language.php';
require_once __DIR__ . '/../app/page_sections.php';

const ADMIN_USER = 'admin1';
const ADMIN_PASS = 'adminpw';
const MAX_TEXT_LENGTH = 12000;

$languageFile = language_file_path();
$languageMapFile = realpath(__DIR__ . '/../docs/language_map.md') ?: __DIR__ . '/../docs/language_map.md';
$backupDir = dirname($languageFile) . '/language_backups';
$sectionFile = page_sections_file_path();
$sectionBackupDir = dirname($sectionFile) . '/page_section_backups';

function admin_h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function admin_is_logged_in(): bool
{
    return isset($_SESSION['jok_admin_logged_in']) && $_SESSION['jok_admin_logged_in'] === true;
}

function admin_csrf(): string
{
    if (!isset($_SESSION['jok_admin_csrf']) || !is_string($_SESSION['jok_admin_csrf'])) {
        $_SESSION['jok_admin_csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['jok_admin_csrf'];
}

function admin_verify_csrf(?string $token): bool
{
    return is_string($token) && isset($_SESSION['jok_admin_csrf']) && hash_equals((string) $_SESSION['jok_admin_csrf'], $token);
}

function admin_read_language(string $languageFile): array
{
    if (!is_file($languageFile) || !is_readable($languageFile)) {
        return [null, 'Language JSON file could not be read.'];
    }

    $raw = file_get_contents($languageFile);
    if ($raw === false || trim($raw) === '') {
        return [null, 'Language JSON file is empty or unavailable.'];
    }

    $decoded = json_decode($raw, true);
    if (!is_array($decoded)) {
        return [null, 'Language JSON could not be decoded: ' . json_last_error_msg()];
    }

    if (!isset($decoded['entries']) || !is_array($decoded['entries'])) {
        return [null, 'Language JSON does not contain an entries array.'];
    }

    return [$decoded, null];
}

function admin_text_len(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value) : strlen($value);
}

function admin_text_slice(string $value, int $start, int $length): string
{
    return function_exists('mb_substr') ? mb_substr($value, $start, $length) : substr($value, $start, $length);
}

function admin_entry_label(array $entry): string
{
    $token = isset($entry['token']) ? (string) $entry['token'] : 'untokenized-entry';
    $text = isset($entry['canonical_text']) ? trim((string) $entry['canonical_text']) : '';
    if ($text === '') {
        return $token;
    }

    $short = admin_text_len($text) > 70 ? admin_text_slice($text, 0, 70) . '…' : $text;
    return $token . ' — ' . $short;
}

function admin_tokens_by_text_key(array $entries): array
{
    $groups = [];
    foreach ($entries as $entry) {
        if (!is_array($entry)) {
            continue;
        }
        $key = (string) ($entry['canonical_text_key'] ?? 'unkeyed');
        $groups[$key][] = (string) ($entry['token'] ?? $entry['id'] ?? 'untokenized-entry');
    }

    ksort($groups);
    return $groups;
}

function admin_count_flags(array $entries, string $reviewKey): int
{
    $count = 0;
    foreach ($entries as $entry) {
        if (is_array($entry) && !empty($entry['review'][$reviewKey])) {
            $count++;
        }
    }

    return $count;
}

function admin_selected(string $actual, string $expected): string
{
    return $actual === $expected ? ' selected' : '';
}

function admin_checked(bool $actual): string
{
    return $actual ? ' checked' : '';
}

function admin_normalize_bool(?string $value): bool
{
    return $value === '1';
}

function admin_entry_source_page(array $entry): string
{
    $occurrences = isset($entry['occurrences']) && is_array($entry['occurrences']) ? $entry['occurrences'] : [];
    foreach ($occurrences as $occurrence) {
        if (!is_array($occurrence)) {
            continue;
        }
        $file = (string) ($occurrence['file'] ?? '');
        if ($file !== '') {
            return $file;
        }
    }

    return (string) ($entry['source_scope'] ?? 'unknown');
}


function admin_entry_public_href(array $entry): string
{
    $sourcePage = admin_entry_source_page($entry);
    $normalized = str_replace('\\', '/', $sourcePage);
    $marker = 'proto/public/';
    $pos = strpos($normalized, $marker);
    if ($pos === false) {
        return '../public/index.php';
    }

    $relative = substr($normalized, $pos + strlen($marker));
    if ($relative === 'index.php') {
        return '../public/index.php';
    }

    if (str_ends_with($relative, '/index.php')) {
        return '../public/' . substr($relative, 0, -strlen('index.php'));
    }

    return '../public/' . ltrim($relative, '/');
}


function admin_read_page_sections(): array
{
    return page_sections_read();
}

function admin_section_backup_and_write(string $sectionFile, string $backupDir, array $document): array
{
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
        return [false, 'Could not write timestamped page section backup.'];
    }
    $encoded = json_encode($document, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if (!is_string($encoded)) {
        return [false, 'Edited page section JSON could not be encoded: ' . json_last_error_msg()];
    }
    if (file_put_contents($sectionFile, $encoded . PHP_EOL, LOCK_EX) === false) {
        return [false, 'Could not write edited page section JSON. Backup remains at ' . basename($backupFile)];
    }
    return [true, 'Saved page_sections.json and created backup: ' . basename($backupFile)];
}

function admin_section_from_post(array $post, array $existing = []): array
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
            'image_filename' => in_array(trim((string) ($post['image_filename'] ?? ($existing['content']['image_filename'] ?? ''))), image_inventory(), true) ? trim((string) ($post['image_filename'] ?? ($existing['content']['image_filename'] ?? ''))) : '',
            'image_alt' => trim((string) ($post['image_alt'] ?? ($existing['content']['image_alt'] ?? ''))),
            'cta_label' => trim((string) ($post['cta_label'] ?? ($existing['content']['cta_label'] ?? ''))),
            'cta_url' => trim((string) ($post['cta_url'] ?? ($existing['content']['cta_url'] ?? ''))),
        ],
        'review' => [
            'rights_safe' => admin_normalize_bool((string) ($post['rights_safe'] ?? (!empty($existing['review']['rights_safe']) ? '1' : '0'))),
            'safety_related' => admin_normalize_bool((string) ($post['safety_related'] ?? (!empty($existing['review']['safety_related']) ? '1' : '0'))),
            'public_ready' => admin_normalize_bool((string) ($post['public_ready'] ?? (!empty($existing['review']['public_ready']) ? '1' : '0'))),
        ],
        'updated_at' => gmdate('c'),
    ];
}

function admin_find_section(array $sections, string $sectionId): ?array
{
    foreach ($sections as $section) {
        if (is_array($section) && (string) ($section['section_id'] ?? '') === $sectionId) {
            return $section;
        }
    }
    return null;
}

function admin_apply_entry_edits(array $language, array $post): array
{
    $edits = isset($post['entries']) && is_array($post['entries']) ? $post['entries'] : [];
    $changed = 0;
    $now = gmdate('Y-m-d');

    foreach ($language['entries'] as $index => $entry) {
        if (!is_array($entry) || !isset($edits[(string) $index]) || !is_array($edits[(string) $index])) {
            continue;
        }

        $edit = $edits[(string) $index];
        $newText = trim((string) ($edit['canonical_text'] ?? ''));
        if (admin_text_len($newText) > MAX_TEXT_LENGTH) {
            $newText = admin_text_slice($newText, 0, MAX_TEXT_LENGTH);
        }

        $fields = [
            'canonical_text' => $newText,
            'status' => trim((string) ($edit['status'] ?? ($entry['status'] ?? ''))),
            'tone' => trim((string) ($edit['tone'] ?? ($entry['tone'] ?? ''))),
            'text_role' => trim((string) ($edit['text_role'] ?? ($entry['text_role'] ?? ''))),
            'component' => trim((string) ($edit['component'] ?? ($entry['component'] ?? ''))),
            'reuse_policy' => trim((string) ($edit['reuse_policy'] ?? ($entry['reuse_policy'] ?? ''))),
            'context_notes' => trim((string) ($edit['context_notes'] ?? ($entry['context_notes'] ?? ''))),
        ];

        foreach ($fields as $field => $value) {
            if (($entry[$field] ?? '') !== $value) {
                $language['entries'][$index][$field] = $value;
                $language['entries'][$index]['last_edited_at'] = gmdate('c');
                $language['entries'][$index]['last_edited_via'] = 'admin_page';
                $changed++;
            }
        }

        $review = isset($entry['review']) && is_array($entry['review']) ? $entry['review'] : [];
        foreach (['rights_safe', 'safety_related', 'verified_fact', 'needs_owner_review'] as $flag) {
            $newFlag = admin_normalize_bool((string) ($edit['review'][$flag] ?? '0'));
            if (($review[$flag] ?? false) !== $newFlag) {
                $language['entries'][$index]['review'][$flag] = $newFlag;
                $changed++;
            }
        }
    }

    if ($changed > 0) {
        $language['document_control']['last_updated'] = $now;
        $language['document_control']['status'] = 'Edited in admin text editor; language_map.md may need regeneration';
        $language['usage_policy']['update_rule'] = 'When canonical_text changes, regenerate proto/docs/language_map.md from this JSON so the human map remains exactly aligned.';
    }

    return [$language, $changed];
}

function admin_backup_and_write(string $languageFile, string $backupDir, array $language): array
{
    if (!is_file($languageFile) || !is_readable($languageFile) || !is_writable($languageFile)) {
        return [false, 'Language JSON is not writable by this PHP process.'];
    }

    if (!is_dir($backupDir) && !mkdir($backupDir, 0775, true) && !is_dir($backupDir)) {
        return [false, 'Could not create language backup directory.'];
    }

    $original = file_get_contents($languageFile);
    if ($original === false) {
        return [false, 'Could not read existing language JSON for backup.'];
    }

    $backupFile = $backupDir . '/language-' . gmdate('Ymd-His') . '-' . bin2hex(random_bytes(3)) . '.json';
    if (file_put_contents($backupFile, $original, LOCK_EX) === false) {
        return [false, 'Could not write timestamped language backup.'];
    }

    $encoded = json_encode($language, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    if (!is_string($encoded)) {
        return [false, 'Edited language JSON could not be encoded: ' . json_last_error_msg()];
    }

    if (file_put_contents($languageFile, $encoded . PHP_EOL, LOCK_EX) === false) {
        return [false, 'Could not write edited language JSON. Backup remains at ' . $backupFile];
    }

    return [true, 'Saved language.json and created backup: ' . basename($backupFile)];
}

$notice = null;
$noticeType = 'ok';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? (string) $_POST['action'] : '';

    if ($action === 'login') {
        if (!admin_verify_csrf($_POST['csrf_token'] ?? null)) {
            $notice = 'Login session expired. Try again.';
            $noticeType = 'error';
        } elseif ((string) ($_POST['username'] ?? '') === ADMIN_USER && (string) ($_POST['password'] ?? '') === ADMIN_PASS) {
            session_regenerate_id(true);
            $_SESSION['jok_admin_logged_in'] = true;
            $_SESSION['jok_admin_csrf'] = bin2hex(random_bytes(32));
            header('Location: ./');
            exit;
        } else {
            $notice = 'Invalid admin credentials.';
            $noticeType = 'error';
        }
    }

    if ($action === 'logout') {
        if (admin_verify_csrf($_POST['csrf_token'] ?? null)) {
            $_SESSION = [];
            session_destroy();
            header('Location: ./');
            exit;
        }
        $notice = 'Logout session expired. Try again.';
        $noticeType = 'error';
    }

    if ($action === 'save_language' && admin_is_logged_in()) {
        if (!admin_verify_csrf($_POST['csrf_token'] ?? null)) {
            $notice = 'Save session expired. Reload and try again.';
            $noticeType = 'error';
        } else {
            [$languageForSave, $readError] = admin_read_language($languageFile);
            if ($readError !== null || !is_array($languageForSave)) {
                $notice = $readError ?? 'Language file could not be loaded.';
                $noticeType = 'error';
            } else {
                [$editedLanguage, $changed] = admin_apply_entry_edits($languageForSave, $_POST);
                if ($changed === 0) {
                    $notice = 'No language changes detected.';
                    $noticeType = 'warn';
                } else {
                    [$saved, $message] = admin_backup_and_write($languageFile, $backupDir, $editedLanguage);
                    $notice = $message;
                    $noticeType = $saved ? 'ok' : 'error';
                }
            }
        }
    }


    if (($action === 'save_section' || $action === 'delete_section') && admin_is_logged_in()) {
        if (!admin_verify_csrf($_POST['csrf_token'] ?? null)) {
            $notice = 'Section edit session expired. Reload and try again.';
            $noticeType = 'error';
        } else {
            $doc = admin_read_page_sections();
            $sections = isset($doc['sections']) && is_array($doc['sections']) ? $doc['sections'] : [];
            $sectionId = trim((string) ($_POST['section_id'] ?? ''));
            if ($action === 'delete_section' && $sectionId !== '') {
                $kept = [];
                foreach ($sections as $section) {
                    if (is_array($section) && (string) ($section['section_id'] ?? '') === $sectionId) {
                        $section['status'] = 'archived';
                        $section['updated_at'] = gmdate('c');
                    }
                    $kept[] = $section;
                }
                $doc['sections'] = $kept;
                $doc['document_control']['last_updated'] = gmdate('Y-m-d');
                [$saved, $message] = admin_section_backup_and_write($sectionFile, $sectionBackupDir, $doc);
                $notice = $saved ? 'Archived section. ' . $message : $message;
                $noticeType = $saved ? 'ok' : 'error';
            } else {
                $existing = $sectionId !== '' ? admin_find_section($sections, $sectionId) : null;
                $edited = admin_section_from_post($_POST, $existing ?? []);
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
                $doc['document_control']['last_updated'] = gmdate('Y-m-d');
                [$saved, $message] = admin_section_backup_and_write($sectionFile, $sectionBackupDir, $doc);
                $notice = $message;
                $noticeType = $saved ? 'ok' : 'error';
                if ($saved) {
                    header('Location: ./?tool=sections&section=' . rawurlencode((string) $edited['section_id']) . '#section-editor');
                    exit;
                }
            }
        }
    }
}

[$language, $languageError] = admin_read_language($languageFile);
$entries = is_array($language['entries'] ?? null) ? $language['entries'] : [];
$mapMarkdown = is_file($languageMapFile) && is_readable($languageMapFile) ? (string) file_get_contents($languageMapFile) : '';
$groups = admin_tokens_by_text_key($entries);
$repeatedGroups = array_filter($groups, static fn (array $tokens): bool => count($tokens) > 1);
$components = array_values(array_unique(array_map(static fn ($entry): string => is_array($entry) ? (string) ($entry['component'] ?? 'unknown') : 'unknown', $entries)));
$roles = array_values(array_unique(array_map(static fn ($entry): string => is_array($entry) ? (string) ($entry['text_role'] ?? 'unknown') : 'unknown', $entries)));
sort($components);
sort($roles);
$sectionDocument = admin_read_page_sections();
$sectionSchema = page_section_schema();
$managedSections = isset($sectionDocument['sections']) && is_array($sectionDocument['sections']) ? $sectionDocument['sections'] : [];
$selectedSectionId = trim((string) ($_GET['section'] ?? ''));
$selectedSection = $selectedSectionId !== '' ? admin_find_section($managedSections, $selectedSectionId) : null;
$prefillRoute = trim((string) ($_GET['route'] ?? ($selectedSection['route_id'] ?? 'home')));
$prefillSlot = trim((string) ($_GET['slot'] ?? ($selectedSection['slot_id'] ?? 'after_hero')));
if (!isset($sectionSchema['routes'][$prefillRoute])) { $prefillRoute = 'home'; }
if (!isset($sectionSchema['routes'][$prefillRoute]['slots'][$prefillSlot])) { $prefillSlot = 'after_hero'; }
$imageOptions = image_inventory();
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex,nofollow">
  <title>Just One KISS Admin Editor</title>
  <style>
    :root { --black:#050505; --panel:#101014; --panel2:#17171e; --line:rgba(220,225,235,.18); --chrome:#b8bcc2; --bone:#f4efe6; --muted:#a9a4a1; --fire:#f06a21; --red:#b20d18; --yellow:#f2c230; --ok:#60d394; --warn:#ffd166; --bad:#ff5c7a; --radius:24px; --shadow:0 28px 80px rgba(0,0,0,.46); --font:Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; --display:Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif; }
    * { box-sizing:border-box; }
    html { scroll-behavior:smooth; }
    body { margin:0; min-height:100vh; color:var(--bone); font-family:var(--font); background:radial-gradient(circle at 15% -10%, rgba(240,106,33,.34), transparent 28rem), radial-gradient(circle at 88% 4%, rgba(184,188,194,.18), transparent 24rem), linear-gradient(135deg, #030303, #111016 48%, #050505); }
    a { color:var(--yellow); }
    .skip-link { position:absolute; left:-999px; top:.5rem; background:var(--yellow); color:#111; padding:.7rem 1rem; z-index:20; }
    .skip-link:focus { left:.5rem; }
    .admin-shell { width:min(1480px, calc(100% - 2rem)); margin:0 auto; }
    .topbar { position:sticky; top:0; z-index:10; backdrop-filter:blur(18px); background:rgba(5,5,5,.86); border-bottom:1px solid var(--line); }
    .topbar__inner { width:min(1480px, calc(100% - 2rem)); margin:0 auto; display:flex; gap:1rem; align-items:center; justify-content:space-between; padding:.9rem 0; }
    .brand { color:var(--bone); text-decoration:none; text-transform:uppercase; letter-spacing:.12em; line-height:.85; }
    .brand span { display:block; color:var(--chrome); font-size:.72rem; }
    .brand strong { display:block; color:var(--fire); font:900 1.45rem/.85 var(--display); letter-spacing:.07em; }
    .nav { display:flex; flex-wrap:wrap; gap:.55rem; align-items:center; }
    .pill, button, .button { appearance:none; border:1px solid var(--line); color:var(--bone); background:rgba(255,255,255,.06); border-radius:999px; padding:.65rem .9rem; text-decoration:none; font-weight:850; cursor:pointer; }
    button:hover, .button:hover, .pill:hover { border-color:rgba(242,194,48,.65); box-shadow:0 0 22px rgba(240,106,33,.18); }
    .button--fire, .savebar button { color:#170604; background:linear-gradient(135deg, var(--yellow), var(--fire) 55%, var(--red)); border-color:rgba(255,232,91,.72); }
    .button--ghost { background:transparent; }
    .hero { padding:clamp(2rem, 5vw, 5rem) 0 2rem; display:grid; grid-template-columns:minmax(0,1.1fr) minmax(300px,.9fr); gap:1.25rem; align-items:end; }
    h1, h2, h3 { font-family:var(--display); text-transform:uppercase; letter-spacing:.035em; margin:.15rem 0 .65rem; }
    h1 { font-size:clamp(3rem, 7vw, 6.6rem); line-height:.85; max-width:10ch; text-shadow:0 0 32px rgba(240,106,33,.32); }
    h2 { font-size:clamp(2rem, 3.4vw, 3.7rem); }
    h3 { font-size:1.45rem; }
    .eyebrow { color:var(--yellow); font-weight:950; text-transform:uppercase; letter-spacing:.12em; font-size:.78rem; }
    .lede { color:var(--chrome); font-size:1.12rem; max-width:72ch; }
    .panel { background:linear-gradient(145deg, rgba(255,255,255,.08), rgba(255,255,255,.025)), rgba(10,10,14,.88); border:1px solid var(--line); border-radius:var(--radius); box-shadow:var(--shadow); padding:clamp(1rem, 2.4vw, 1.6rem); }
    .notice { margin:1rem 0; padding:1rem; border-radius:18px; border:1px solid var(--line); background:rgba(255,255,255,.08); }
    .notice--ok { border-color:rgba(96,211,148,.6); color:#d9ffe9; }
    .notice--warn { border-color:rgba(255,209,102,.7); color:#fff2c4; }
    .notice--error { border-color:rgba(255,92,122,.72); color:#ffd8df; }
    .login-wrap { min-height:100vh; display:grid; place-items:center; padding:1rem; }
    .login-card { width:min(520px, 100%); }
    label { display:grid; gap:.35rem; font-weight:850; color:var(--chrome); }
    input, textarea, select { width:100%; color:var(--bone); background:#07070a; border:1px solid var(--line); border-radius:14px; padding:.72rem .8rem; font:inherit; }
    textarea { min-height:6.7rem; resize:vertical; line-height:1.4; }
    input:focus, textarea:focus, select:focus { outline:2px solid rgba(242,194,48,.72); outline-offset:2px; }
    .form-stack { display:grid; gap:1rem; }
    .dashboard { display:grid; grid-template-columns:repeat(4, minmax(0,1fr)); gap:1rem; margin:1rem 0 1.5rem; }
    .stat strong { display:block; color:var(--yellow); font:950 2.2rem/1 var(--display); }
    .stat span { color:var(--muted); text-transform:uppercase; letter-spacing:.08em; font-size:.75rem; font-weight:900; }
    .toolbar { display:grid; grid-template-columns:minmax(220px,1fr) repeat(3, minmax(150px, .35fr)); gap:.75rem; align-items:end; margin:1rem 0; }
    .editor-layout { display:grid; grid-template-columns:360px minmax(0,1fr); gap:1rem; align-items:start; }
    .entry-list { position:sticky; top:86px; max-height:calc(100vh - 108px); overflow:auto; }
    .entity-table { width:100%; border-collapse:collapse; margin-top:1rem; font-size:.9rem; }
    .entity-table th, .entity-table td { border-bottom:1px solid var(--line); padding:.55rem; text-align:left; vertical-align:top; }
    .entity-table th { color:var(--yellow); text-transform:uppercase; letter-spacing:.08em; font-size:.72rem; }
    .entity-table td { color:var(--chrome); overflow-wrap:anywhere; }
    .entry-list a { display:block; color:var(--bone); text-decoration:none; padding:.7rem .8rem; border:1px solid transparent; border-radius:14px; }
    .entry-list a:hover, .entry-list a:focus { border-color:rgba(242,194,48,.48); background:rgba(242,194,48,.08); }
    .entry-card { margin-bottom:1rem; scroll-margin-top:96px; }
    .entry-head { display:flex; justify-content:space-between; gap:1rem; align-items:start; border-bottom:1px solid var(--line); padding-bottom:1rem; margin-bottom:1rem; }
    .token { color:var(--yellow); font-weight:950; overflow-wrap:anywhere; }
    .idline { color:var(--muted); font-size:.88rem; overflow-wrap:anywhere; }
    .chips { display:flex; flex-wrap:wrap; gap:.45rem; margin:.65rem 0; }
    .chip { border:1px solid var(--line); color:var(--chrome); background:rgba(255,255,255,.05); border-radius:999px; padding:.24rem .52rem; font-size:.74rem; font-weight:850; }
    .chip--hot { color:#170604; background:var(--yellow); border-color:transparent; }
    .chip--bad { color:#fff; background:rgba(178,13,24,.7); border-color:rgba(255,255,255,.18); }
    .quick-grid { display:grid; grid-template-columns:repeat(3, minmax(0,1fr)); gap:.75rem; }
    .flag-grid { display:grid; grid-template-columns:repeat(4, minmax(0,1fr)); gap:.55rem; margin:.9rem 0; }
    .flag { display:flex; align-items:center; gap:.45rem; color:var(--bone); background:rgba(255,255,255,.04); border:1px solid var(--line); border-radius:12px; padding:.55rem; font-size:.85rem; }
    .flag input { width:auto; }
    details.meta { margin-top:.9rem; border:1px solid var(--line); border-radius:16px; background:rgba(0,0,0,.24); overflow:hidden; }
    details.meta summary { cursor:pointer; padding:.8rem 1rem; color:var(--yellow); font-weight:950; }
    pre { white-space:pre-wrap; overflow:auto; margin:0; padding:1rem; color:#e9edf5; background:#050507; border-top:1px solid var(--line); font-size:.82rem; line-height:1.45; }
    .occurrences { display:grid; gap:.45rem; margin:.75rem 0; }
    .occurrence { padding:.58rem .7rem; border:1px solid var(--line); border-radius:12px; color:var(--chrome); background:rgba(255,255,255,.035); font-size:.86rem; }
    .savebar { position:sticky; bottom:0; z-index:8; display:flex; align-items:center; justify-content:space-between; gap:1rem; margin:1rem 0 0; padding:1rem; background:rgba(5,5,5,.92); border:1px solid var(--line); border-radius:18px 18px 0 0; backdrop-filter:blur(18px); }
    .doc-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin:1.5rem 0; }
    .markdown-box { max-height:560px; overflow:auto; }
    .small { color:var(--muted); font-size:.9rem; }
    .route-links { display:flex; flex-wrap:wrap; gap:.55rem; }
    .hidden-by-filter { display:none; }
    @media (max-width:1100px) { .hero, .editor-layout, .doc-grid { grid-template-columns:1fr; } .entry-list { position:static; max-height:360px; } .dashboard, .quick-grid { grid-template-columns:repeat(2, minmax(0,1fr)); } .toolbar { grid-template-columns:1fr 1fr; } }
    @media (max-width:680px) { .dashboard, .quick-grid, .flag-grid, .toolbar { grid-template-columns:1fr; } .entry-head { display:block; } .topbar__inner { align-items:flex-start; flex-direction:column; } }

    .mode-tabs { display:flex; flex-wrap:wrap; gap:.6rem; margin:1rem 0; }
    .section-builder { display:grid; grid-template-columns:minmax(340px, .45fr) minmax(0, 1fr); gap:1rem; align-items:start; margin:1rem 0 2rem; }
    .section-preview { position:sticky; top:86px; min-height:70vh; overflow:hidden; }
    .section-preview iframe { width:100%; height:72vh; border:1px solid rgba(242,194,48,.45); border-radius:20px; background:#050505; box-shadow:0 0 44px rgba(240,106,33,.18); }
    .section-form-grid { display:grid; grid-template-columns:repeat(2, minmax(0, 1fr)); gap:.75rem; }
    .section-form-grid .full { grid-column:1 / -1; }
    .section-cards { display:grid; gap:.7rem; margin-top:1rem; }
    .section-card-mini { border:1px solid var(--line); border-radius:16px; padding:.8rem; background:rgba(255,255,255,.045); }
    .section-card-mini.is-selected { border-color:rgba(242,194,48,.8); box-shadow:0 0 28px rgba(242,194,48,.16); }
    .section-actions { display:flex; flex-wrap:wrap; gap:.55rem; align-items:center; margin-top:.8rem; }
    .danger { border-color:rgba(255,92,122,.7); color:#ffd8df; }
    .small-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:.55rem; }
    @media (max-width: 980px) { .section-builder { grid-template-columns:1fr; } .section-preview { position:relative; top:auto; } .section-form-grid, .small-grid { grid-template-columns:1fr; } }

  </style>
</head>
<body>
<a class="skip-link" href="#main">Skip to language editor</a>
<?php if (!admin_is_logged_in()): ?>
  <main class="login-wrap">
    <section class="panel login-card" aria-labelledby="login-title">
      <p class="eyebrow">Admin access</p>
      <h1 id="login-title">Language Control</h1>
      <p class="lede">Log in to inspect and edit the structured landing-page language inventory.</p>
      <?php if ($notice !== null): ?><div class="notice notice--<?= admin_h($noticeType) ?>"><?= admin_h($notice) ?></div><?php endif; ?>
      <form method="post" class="form-stack">
        <input type="hidden" name="action" value="login">
        <input type="hidden" name="csrf_token" value="<?= admin_h(admin_csrf()) ?>">
        <label>Username <input name="username" autocomplete="username" required autofocus></label>
        <label>Password <input name="password" type="password" autocomplete="current-password" required></label>
        <button class="button--fire" type="submit">Log in</button>
      </form>
    </section>
  </main>
<?php else: ?>
<header class="topbar">
  <div class="topbar__inner">
    <a class="brand" href="./"><span>Just One KISS</span><strong>Language Admin</strong></a>
    <nav class="nav" aria-label="Admin shortcuts">
      <a class="pill" href="#overview">Overview</a>
      <a class="pill" href="../editor/">Section editor</a>
      <a class="pill" href="#editor">Language tokens</a>
      <a class="pill" href="#documents">Documents</a>
      <a class="pill button--fire" href="../public/index.php" target="_blank" rel="noopener">Open live page</a>
      <form method="post">
        <input type="hidden" name="action" value="logout">
        <input type="hidden" name="csrf_token" value="<?= admin_h(admin_csrf()) ?>">
        <button class="button--ghost" type="submit">Log out</button>
      </form>
    </nav>
  </div>
</header>
<main id="main" class="admin-shell">
  <section class="hero" id="overview">
    <div>
      <p class="eyebrow">Structured text inventory</p>
      <h1>Every word. One console.</h1>
      <p class="lede">Review canonical text, find risk flags, inspect occurrences, edit metadata, and open the full structured JSON behind every landing-page language token. Runtime pages now read from this file. Use this console for full inventory edits, or open the public homepage while logged in to edit visible tokenized text inline.</p>
      <div class="route-links" aria-label="Two-way workflow links">
        <a class="button button--fire" href="../public/index.php" target="_blank" rel="noopener">View public homepage</a>
        <a class="button" href="../docs/language.json" target="_blank" rel="noopener">Open raw JSON</a>
        <a class="button" href="../docs/language_map.md" target="_blank" rel="noopener">Open human map</a>
      </div>
    </div>
    <aside class="panel">
      <p class="eyebrow">Document control</p>
      <?php if ($languageError !== null): ?>
        <div class="notice notice--error"><?= admin_h($languageError) ?></div>
      <?php else: ?>
        <h2><?= admin_h((string) ($language['document_control']['title'] ?? 'Language Inventory')) ?></h2>
        <p class="small"><strong>Status:</strong> <?= admin_h((string) ($language['document_control']['status'] ?? 'unknown')) ?></p>
        <p class="small"><strong>Classification:</strong> <?= admin_h((string) ($language['document_control']['classification'] ?? 'GEN')) ?> · <strong>Maturity:</strong> <?= admin_h((string) ($language['document_control']['maturity_level'] ?? 'unknown')) ?></p>
        <p class="small"><strong>Last updated:</strong> <?= admin_h((string) ($language['document_control']['last_updated'] ?? 'unknown')) ?></p>
      <?php endif; ?>
    </aside>
  </section>

  <?php if ($notice !== null): ?><div class="notice notice--<?= admin_h($noticeType) ?>"><?= admin_h($notice) ?></div><?php endif; ?>

  <?php
    $formSection = $selectedSection ?? [
        'section_id' => '',
        'route_id' => $prefillRoute,
        'slot_id' => $prefillSlot,
        'sort_order' => 100,
        'type' => 'text',
        'status' => 'draft',
        'timeline_moment_id_or_gen' => 'GEN',
        'layout' => ['width_mode' => 'fit', 'height_mode' => 'fit', 'alignment' => 'fit', 'visual_style' => 'fit', 'custom_width' => '', 'custom_height' => '', 'max_width' => '', 'min_height' => ''],
        'content' => ['heading' => '', 'body' => '', 'image_filename' => '', 'image_alt' => '', 'cta_label' => '', 'cta_url' => ''],
        'review' => ['rights_safe' => true, 'safety_related' => false, 'public_ready' => false],
    ];
    $layout = isset($formSection['layout']) && is_array($formSection['layout']) ? $formSection['layout'] : [];
    $content = isset($formSection['content']) && is_array($formSection['content']) ? $formSection['content'] : [];
    $sectionReview = isset($formSection['review']) && is_array($formSection['review']) ? $formSection['review'] : [];
  ?>
  <section class="panel" id="section-editor" aria-labelledby="section-editor-title">
    <p class="eyebrow">Schema-driven page builder</p>
    <h2 id="section-editor-title">Add, edit, position, style, publish, or archive page sections.</h2>
    <p class="lede">The preview is the real public homepage in an iframe. Logged-in admin sessions see plus insertion rails between approved slots and edit links on managed sections. Published sections render publicly; drafts stay visible only to admins.</p>
    <div class="mode-tabs" aria-label="Admin editor modes">
      <a class="button button--fire" href="#section-editor">Section builder</a>
      <a class="button" href="#editor">Language tokens</a>
      <a class="button" href="../public/index.php" target="_blank" rel="noopener">Open public page</a>
    </div>
    <div class="section-builder">
      <form method="post" class="form-stack" aria-label="Managed page section editor">
        <input type="hidden" name="action" value="save_section">
        <input type="hidden" name="csrf_token" value="<?= admin_h(admin_csrf()) ?>">
        <input type="hidden" name="section_id" value="<?= admin_h((string) ($formSection['section_id'] ?? '')) ?>">
        <div class="section-form-grid">
          <label>Route
            <select name="route_id">
              <?php foreach ($sectionSchema['routes'] as $routeId => $route): ?><option value="<?= admin_h((string) $routeId) ?>"<?= admin_selected((string) ($formSection['route_id'] ?? 'home'), (string) $routeId) ?>><?= admin_h((string) ($route['label'] ?? $routeId)) ?></option><?php endforeach; ?>
            </select>
          </label>
          <label>Position slot
            <select name="slot_id">
              <?php foreach ($sectionSchema['routes'][$prefillRoute]['slots'] as $slotId => $label): ?><option value="<?= admin_h((string) $slotId) ?>"<?= admin_selected((string) ($formSection['slot_id'] ?? $prefillSlot), (string) $slotId) ?>><?= admin_h((string) $label) ?></option><?php endforeach; ?>
            </select>
          </label>
          <label>Section type
            <select name="type"><?php foreach ($sectionSchema['types'] as $type): ?><option value="<?= admin_h($type) ?>"<?= admin_selected((string) ($formSection['type'] ?? 'text'), $type) ?>><?= admin_h(str_replace('_', ' + ', $type)) ?></option><?php endforeach; ?></select>
          </label>
          <label>Status
            <select name="status"><?php foreach ($sectionSchema['status_values'] as $status): ?><option value="<?= admin_h($status) ?>"<?= admin_selected((string) ($formSection['status'] ?? 'draft'), $status) ?>><?= admin_h($status) ?></option><?php endforeach; ?></select>
          </label>
          <label>Sort order <input name="sort_order" type="number" min="0" step="10" value="<?= admin_h((string) ($formSection['sort_order'] ?? 100)) ?>"></label>
          <label>Timeline / GEN <input name="timeline_moment_id_or_gen" value="<?= admin_h((string) ($formSection['timeline_moment_id_or_gen'] ?? 'GEN')) ?>"></label>
          <label class="full">Heading <input name="heading" value="<?= admin_h((string) ($content['heading'] ?? '')) ?>" placeholder="Optional section headline"></label>
          <label class="full">Body text <textarea name="body" data-autogrow placeholder="Original, public-ready text for this section."><?= admin_h((string) ($content['body'] ?? '')) ?></textarea></label>
          <label>Image filename
            <select name="image_filename"><option value="">No image</option><?php foreach ($imageOptions as $image): ?><option value="<?= admin_h($image) ?>"<?= admin_selected((string) ($content['image_filename'] ?? ''), $image) ?>><?= admin_h($image) ?></option><?php endforeach; ?></select>
          </label>
          <label>Image alt text <input name="image_alt" value="<?= admin_h((string) ($content['image_alt'] ?? '')) ?>"></label>
          <label>CTA label <input name="cta_label" value="<?= admin_h((string) ($content['cta_label'] ?? '')) ?>"></label>
          <label>CTA URL <input name="cta_url" value="<?= admin_h((string) ($content['cta_url'] ?? '')) ?>" placeholder="#updates or ./contact/"></label>
          <label>Width mode <select name="width_mode"><?php foreach ($sectionSchema['width_modes'] as $mode): ?><option value="<?= admin_h($mode) ?>"<?= admin_selected((string) ($layout['width_mode'] ?? 'fit'), $mode) ?>><?= admin_h($mode) ?></option><?php endforeach; ?></select></label>
          <label>Height mode <select name="height_mode"><?php foreach ($sectionSchema['height_modes'] as $mode): ?><option value="<?= admin_h($mode) ?>"<?= admin_selected((string) ($layout['height_mode'] ?? 'fit'), $mode) ?>><?= admin_h($mode) ?></option><?php endforeach; ?></select></label>
          <label>Alignment <select name="alignment"><?php foreach ($sectionSchema['alignments'] as $mode): ?><option value="<?= admin_h($mode) ?>"<?= admin_selected((string) ($layout['alignment'] ?? 'fit'), $mode) ?>><?= admin_h($mode) ?></option><?php endforeach; ?></select></label>
          <label>Visual style <select name="visual_style"><?php foreach ($sectionSchema['visual_styles'] as $style): ?><option value="<?= admin_h($style) ?>"<?= admin_selected((string) ($layout['visual_style'] ?? 'fit'), $style) ?>><?= admin_h(str_replace('_', ' ', $style)) ?></option><?php endforeach; ?></select></label>
          <label>Custom width <input name="custom_width" value="<?= admin_h((string) ($layout['custom_width'] ?? '')) ?>" placeholder="48rem, 70%, 620px"></label>
          <label>Custom height <input name="custom_height" value="<?= admin_h((string) ($layout['custom_height'] ?? '')) ?>" placeholder="auto, 28rem, 420px"></label>
          <label>Max width <input name="max_width" value="<?= admin_h((string) ($layout['max_width'] ?? '')) ?>" placeholder="80rem"></label>
          <label>Min height <input name="min_height" value="<?= admin_h((string) ($layout['min_height'] ?? '')) ?>" placeholder="16rem"></label>
          <div class="full small-grid">
            <label class="flag"><input type="hidden" name="rights_safe" value="0"><input type="checkbox" name="rights_safe" value="1"<?= admin_checked(!empty($sectionReview['rights_safe'])) ?>> Rights-safe</label>
            <label class="flag"><input type="hidden" name="safety_related" value="0"><input type="checkbox" name="safety_related" value="1"<?= admin_checked(!empty($sectionReview['safety_related'])) ?>> Safety-related</label>
            <label class="flag"><input type="hidden" name="public_ready" value="0"><input type="checkbox" name="public_ready" value="1"<?= admin_checked(!empty($sectionReview['public_ready'])) ?>> Public-ready</label>
          </div>
        </div>
        <div class="section-actions"><button class="button--fire" type="submit">Save section</button><a class="button" href="./?tool=sections#section-editor">Start new section</a></div>
      </form>
      <aside class="section-preview" aria-label="Live public page preview">
        <iframe title="Public homepage preview with admin insertion rails" src="../public/index.php"></iframe>
      </aside>
    </div>
    <div class="section-cards" aria-label="Managed sections">
      <?php foreach ($managedSections as $section): if (!is_array($section)) { continue; } $sid = (string) ($section['section_id'] ?? ''); $isSelected = $sid !== '' && $sid === (string) ($formSection['section_id'] ?? ''); ?>
        <article class="section-card-mini<?= $isSelected ? ' is-selected' : '' ?>">
          <strong><?= admin_h((string) ($section['content']['heading'] ?? $sid ?: 'Untitled section')) ?></strong>
          <p class="small"><?= admin_h((string) ($section['route_id'] ?? 'home')) ?> · <?= admin_h((string) ($section['slot_id'] ?? 'slot')) ?> · <?= admin_h((string) ($section['type'] ?? 'text')) ?> · <?= admin_h((string) ($section['status'] ?? 'draft')) ?> · <?= admin_h((string) ($section['timeline_moment_id_or_gen'] ?? 'GEN')) ?></p>
          <div class="section-actions"><a class="button" href="./?tool=sections&section=<?= rawurlencode($sid) ?>#section-editor">Edit</a><form method="post"><input type="hidden" name="action" value="delete_section"><input type="hidden" name="csrf_token" value="<?= admin_h(admin_csrf()) ?>"><input type="hidden" name="section_id" value="<?= admin_h($sid) ?>"><button class="danger" type="submit">Archive</button></form></div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="dashboard" aria-label="Language inventory statistics">
    <article class="panel stat"><strong><?= count($entries) ?></strong><span>Total entries</span></article>
    <article class="panel stat"><strong><?= count($groups) ?></strong><span>Text groups</span></article>
    <article class="panel stat"><strong><?= count($repeatedGroups) ?></strong><span>Repeated groups</span></article>
    <article class="panel stat"><strong><?= admin_count_flags($entries, 'needs_owner_review') ?></strong><span>Needs review</span></article>
  </section>

  <section class="panel" aria-labelledby="filters-title">
    <p class="eyebrow">At-a-glance filters</p>
    <h2 id="filters-title">Find the exact line fast.</h2>
    <div class="toolbar">
      <label>Search token, text, file, notes
        <input id="searchBox" type="search" placeholder="Try: safety, hero, Cycle Moore, landing.form…">
      </label>
      <label>Component
        <select id="componentFilter"><option value="">All components</option><?php foreach ($components as $component): ?><option value="<?= admin_h($component) ?>"><?= admin_h($component) ?></option><?php endforeach; ?></select>
      </label>
      <label>Role
        <select id="roleFilter"><option value="">All roles</option><?php foreach ($roles as $role): ?><option value="<?= admin_h($role) ?>"><?= admin_h($role) ?></option><?php endforeach; ?></select>
      </label>
      <label>Review flag
        <select id="flagFilter"><option value="">All entries</option><option value="rights_safe">Rights-safe</option><option value="safety_related">Safety-related</option><option value="verified_fact">Verified fact</option><option value="needs_owner_review">Needs owner review</option></select>
      </label>
      <label>Sort by
        <select id="sortMode"><option value="alpha">Alphabetical token</option><option value="page">Page / occurrence</option><option value="recent">Most recent edit</option><option value="component">Component</option><option value="role">Role</option><option value="status">Status</option></select>
      </label>
    </div>
  </section>

  <section class="panel" aria-labelledby="entity-list-title">
    <p class="eyebrow">Browsable entity list</p>
    <h2 id="entity-list-title">Words and text entities</h2>
    <p class="small">This list mirrors the editor cards and can be filtered/sorted with the controls above. It is built for the current landing inventory and future multi-page expansion through occurrence/page metadata.</p>
    <table class="entity-table" id="entityTable">
      <thead><tr><th>Token</th><th>Text</th><th>Page/source</th><th>Component</th><th>Role</th><th>Last edit</th></tr></thead>
      <tbody>
      <?php foreach ($entries as $index => $entry): if (!is_array($entry)) { continue; }
          $sourcePage = admin_entry_source_page($entry);
          $updated = (string) ($entry['last_edited_at'] ?? '');
      ?>
        <tr data-table-row data-index="<?= (int) $index ?>">
          <td><a href="#entry-<?= (int) $index ?>"><?= admin_h((string) ($entry['token'] ?? 'untokenized-entry')) ?></a></td>
          <td><?= admin_h(admin_text_slice((string) ($entry['canonical_text'] ?? ''), 0, 140)) ?></td>
          <td><?= admin_h($sourcePage) ?></td>
          <td><?= admin_h((string) ($entry['component'] ?? '')) ?></td>
          <td><?= admin_h((string) ($entry['text_role'] ?? '')) ?></td>
          <td><?= admin_h($updated !== '' ? $updated : 'never') ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </section>

  <section id="editor" aria-labelledby="editor-title">
    <div class="editor-layout">
      <aside class="panel entry-list" aria-label="Language token index">
        <p class="eyebrow">Token index</p>
        <h2 id="editor-title">Editor</h2>
        <p class="small"><span id="visibleCount"><?= count($entries) ?></span> visible entries. Select a token to jump to its card.</p>
        <div id="entryIndex">
          <?php foreach ($entries as $index => $entry): if (!is_array($entry)) { continue; } ?>
            <a href="#entry-<?= (int) $index ?>" data-index-link="<?= (int) $index ?>" data-token="<?= admin_h((string) ($entry['token'] ?? '')) ?>" data-page="<?= admin_h(admin_entry_source_page($entry)) ?>" data-updated="<?= admin_h((string) ($entry['last_edited_at'] ?? '')) ?>" data-component="<?= admin_h((string) ($entry['component'] ?? '')) ?>" data-role="<?= admin_h((string) ($entry['text_role'] ?? '')) ?>" data-status="<?= admin_h((string) ($entry['status'] ?? '')) ?>"><?= admin_h(admin_entry_label($entry)) ?></a>
          <?php endforeach; ?>
        </div>
      </aside>

        <section aria-label="Editable language entries">
        <?php foreach ($entries as $index => $entry): if (!is_array($entry)) { continue; }
            $review = isset($entry['review']) && is_array($entry['review']) ? $entry['review'] : [];
            $occurrences = isset($entry['occurrences']) && is_array($entry['occurrences']) ? $entry['occurrences'] : [];
            $haystack = strtolower(json_encode($entry, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '');
            $component = (string) ($entry['component'] ?? '');
            $role = (string) ($entry['text_role'] ?? '');
            $flags = implode(' ', array_keys(array_filter($review, static fn ($value): bool => $value === true)));
        ?>
        <form method="post" class="panel entry-card" id="entry-<?= (int) $index ?>" data-entry-card data-index="<?= (int) $index ?>" data-token="<?= admin_h((string) ($entry['token'] ?? '')) ?>" data-page="<?= admin_h(admin_entry_source_page($entry)) ?>" data-updated="<?= admin_h((string) ($entry['last_edited_at'] ?? '')) ?>" data-status="<?= admin_h((string) ($entry['status'] ?? '')) ?>" data-search="<?= admin_h($haystack) ?>" data-component="<?= admin_h($component) ?>" data-role="<?= admin_h($role) ?>" data-flags="<?= admin_h($flags) ?>">
          <input type="hidden" name="action" value="save_language">
          <input type="hidden" name="csrf_token" value="<?= admin_h(admin_csrf()) ?>">
          <div class="entry-head">
            <div>
              <div class="token"><?= admin_h((string) ($entry['token'] ?? 'untokenized-entry')) ?></div>
              <div class="idline">ID: <?= admin_h((string) ($entry['id'] ?? '')) ?> · Text key: <?= admin_h((string) ($entry['canonical_text_key'] ?? '')) ?></div>
              <div class="chips">
                <span class="chip chip--hot"><?= admin_h($component !== '' ? $component : 'unknown component') ?></span>
                <span class="chip"><?= admin_h($role !== '' ? $role : 'unknown role') ?></span>
                <span class="chip"><?= admin_h((string) ($entry['status'] ?? 'unknown')) ?></span>
                <?php if (!empty($review['safety_related'])): ?><span class="chip chip--bad">Safety</span><?php endif; ?>
                <?php if (!empty($review['verified_fact'])): ?><span class="chip chip--hot">Verified fact</span><?php endif; ?>
                <?php if (!empty($review['needs_owner_review'])): ?><span class="chip chip--bad">Needs owner review</span><?php endif; ?>
              </div>
            </div>
            <a class="button" href="<?= admin_h(admin_entry_public_href($entry)) ?>" target="_blank" rel="noopener">Open page</a>
          </div>

          <label>Canonical text
            <textarea name="entries[<?= (int) $index ?>][canonical_text]" data-autogrow><?= admin_h((string) ($entry['canonical_text'] ?? '')) ?></textarea>
          </label>

          <div class="quick-grid">
            <label>Status <input name="entries[<?= (int) $index ?>][status]" value="<?= admin_h((string) ($entry['status'] ?? '')) ?>"></label>
            <label>Tone <input name="entries[<?= (int) $index ?>][tone]" value="<?= admin_h((string) ($entry['tone'] ?? '')) ?>"></label>
            <label>Role <input name="entries[<?= (int) $index ?>][text_role]" value="<?= admin_h($role) ?>"></label>
            <label>Component <input name="entries[<?= (int) $index ?>][component]" value="<?= admin_h($component) ?>"></label>
            <label>Reuse policy <input name="entries[<?= (int) $index ?>][reuse_policy]" value="<?= admin_h((string) ($entry['reuse_policy'] ?? '')) ?>"></label>
            <label>Context notes <input name="entries[<?= (int) $index ?>][context_notes]" value="<?= admin_h((string) ($entry['context_notes'] ?? '')) ?>"></label>
          </div>

          <div class="flag-grid" aria-label="Review flags for <?= admin_h((string) ($entry['token'] ?? 'entry')) ?>">
            <label class="flag"><input type="hidden" name="entries[<?= (int) $index ?>][review][rights_safe]" value="0"><input type="checkbox" name="entries[<?= (int) $index ?>][review][rights_safe]" value="1"<?= admin_checked(!empty($review['rights_safe'])) ?>> Rights-safe</label>
            <label class="flag"><input type="hidden" name="entries[<?= (int) $index ?>][review][safety_related]" value="0"><input type="checkbox" name="entries[<?= (int) $index ?>][review][safety_related]" value="1"<?= admin_checked(!empty($review['safety_related'])) ?>> Safety-related</label>
            <label class="flag"><input type="hidden" name="entries[<?= (int) $index ?>][review][verified_fact]" value="0"><input type="checkbox" name="entries[<?= (int) $index ?>][review][verified_fact]" value="1"<?= admin_checked(!empty($review['verified_fact'])) ?>> Verified fact</label>
            <label class="flag"><input type="hidden" name="entries[<?= (int) $index ?>][review][needs_owner_review]" value="0"><input type="checkbox" name="entries[<?= (int) $index ?>][review][needs_owner_review]" value="1"<?= admin_checked(!empty($review['needs_owner_review'])) ?>> Needs owner review</label>
          </div>

          <?php if ($occurrences !== []): ?>
          <div class="occurrences" aria-label="Occurrences">
            <?php foreach ($occurrences as $occurrence): if (!is_array($occurrence)) { continue; } ?>
              <div class="occurrence"><strong><?= admin_h((string) ($occurrence['file'] ?? 'unknown file')) ?>:<?= admin_h((string) ($occurrence['line_start'] ?? '?')) ?></strong> — <?= admin_h((string) ($occurrence['selector_or_context'] ?? '')) ?> <span class="small">(<?= admin_h((string) ($occurrence['rendered_context'] ?? '')) ?>)</span></div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

          <details class="meta">
            <summary>Expand all structured data and metadata</summary>
            <pre><?= admin_h(json_encode($entry, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '{}') ?></pre>
          </details>
          <div class="savebar savebar--entry">
            <div><strong>Save this token only.</strong><br><span class="small">Writes only this entry to language.json and creates a timestamped backup before overwrite.</span></div>
            <button type="submit">Save this entry</button>
          </div>
        </form>
        <?php endforeach; ?>
      </section>
    </div>
  </section>

  <section id="documents" class="doc-grid" aria-label="Language documents">
    <article class="panel">
      <p class="eyebrow">Structured source</p>
      <h2>language.json</h2>
      <p class="small">This is the editable structured inventory. Use each token card above for safer edits; use raw JSON only for inspection.</p>
      <details class="meta" open>
        <summary>Document-level JSON</summary>
        <pre><?= admin_h(json_encode([
            'schema_version' => $language['schema_version'] ?? null,
            'document_control' => $language['document_control'] ?? null,
            'usage_policy' => $language['usage_policy'] ?? null,
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '{}') ?></pre>
      </details>
    </article>
    <article class="panel markdown-box">
      <p class="eyebrow">Human map</p>
      <h2>language_map.md</h2>
      <p class="small">Read-only contextual map. It should be regenerated from JSON after canonical-text edits.</p>
      <pre><?= admin_h($mapMarkdown !== '' ? $mapMarkdown : 'language_map.md could not be read.') ?></pre>
    </article>
  </section>
</main>
<script>
(function () {
  const searchBox = document.getElementById('searchBox');
  const componentFilter = document.getElementById('componentFilter');
  const roleFilter = document.getElementById('roleFilter');
  const flagFilter = document.getElementById('flagFilter');
  const sortMode = document.getElementById('sortMode');
  const cards = Array.from(document.querySelectorAll('[data-entry-card]'));
  const links = Array.from(document.querySelectorAll('[data-index-link]'));
  const visibleCount = document.getElementById('visibleCount');
  const rows = Array.from(document.querySelectorAll('[data-table-row]'));

  function autogrow(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = Math.min(Math.max(textarea.scrollHeight, 120), 520) + 'px';
  }

  document.querySelectorAll('[data-autogrow]').forEach((textarea) => {
    autogrow(textarea);
    textarea.addEventListener('input', () => autogrow(textarea));
  });

  function applyFilters() {
    const q = (searchBox && searchBox.value ? searchBox.value : '').trim().toLowerCase();
    const component = componentFilter ? componentFilter.value : '';
    const role = roleFilter ? roleFilter.value : '';
    const flag = flagFilter ? flagFilter.value : '';
    let count = 0;

    cards.forEach((card) => {
      const matchesSearch = q === '' || (card.dataset.search || '').includes(q);
      const matchesComponent = component === '' || card.dataset.component === component;
      const matchesRole = role === '' || card.dataset.role === role;
      const matchesFlag = flag === '' || (card.dataset.flags || '').split(' ').includes(flag);
      const visible = matchesSearch && matchesComponent && matchesRole && matchesFlag;
      card.classList.toggle('hidden-by-filter', !visible);
      const link = links.find((candidate) => candidate.dataset.indexLink === card.dataset.index);
      if (link) {
        link.classList.toggle('hidden-by-filter', !visible);
      }
      const row = rows.find((candidate) => candidate.dataset.index === card.dataset.index);
      if (row) {
        row.classList.toggle('hidden-by-filter', !visible);
      }
      if (visible) {
        count++;
      }
    });

    if (visibleCount) {
      visibleCount.textContent = String(count);
    }
  }

  function sortValue(node, mode) {
    if (mode === 'recent') return node.dataset.updated || '';
    if (mode === 'page') return node.dataset.page || '';
    if (mode === 'component') return node.dataset.component || '';
    if (mode === 'role') return node.dataset.role || '';
    if (mode === 'status') return node.dataset.status || '';
    return node.dataset.token || '';
  }

  function applySort() {
    const mode = sortMode ? sortMode.value : 'alpha';
    const sorted = cards.slice().sort((a, b) => {
      const av = sortValue(a, mode).toLowerCase();
      const bv = sortValue(b, mode).toLowerCase();
      if (mode === 'recent') return bv.localeCompare(av);
      return av.localeCompare(bv);
    });
    const cardParent = sorted[0] ? sorted[0].parentElement : null;
    const linkParent = links[0] ? links[0].parentElement : null;
    const rowParent = rows[0] ? rows[0].parentElement : null;
    sorted.forEach((card) => {
      if (cardParent) cardParent.appendChild(card);
      const link = links.find((candidate) => candidate.dataset.indexLink === card.dataset.index);
      if (link && linkParent) linkParent.appendChild(link);
      const row = rows.find((candidate) => candidate.dataset.index === card.dataset.index);
      if (row && rowParent) rowParent.appendChild(row);
    });
  }

  [searchBox, componentFilter, roleFilter, flagFilter, sortMode].forEach((control) => {
    if (control) {
      control.addEventListener('input', applyFilters);
      control.addEventListener('change', () => { applySort(); applyFilters(); });
    }
  });
  applySort();
  applyFilters();
})();
</script>
<?php endif; ?>
</body>
</html>
