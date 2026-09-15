<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/helpers.php';
require_once __DIR__ . '/../app/language.php';

session_start();
header('Content-Type: application/json; charset=utf-8');

function inline_json_response(bool $ok, string $message, array $extra = []): never
{
    echo json_encode(array_merge(['ok' => $ok, 'message' => $message], $extra), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

function inline_language_backup_and_write(string $languageFile, string $backupDir, array $language): array
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
        return [false, 'Could not write edited language JSON. Backup remains at ' . basename($backupFile)];
    }

    return [true, 'Saved language.json and created backup: ' . basename($backupFile)];
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    inline_json_response(false, 'Use POST to save language text.');
}

if (!isset($_SESSION['jok_admin_logged_in']) || $_SESSION['jok_admin_logged_in'] !== true) {
    inline_json_response(false, 'Admin login required.');
}

$csrf = (string) ($_POST['csrf_token'] ?? '');
if ($csrf === '' || !isset($_SESSION['jok_admin_csrf']) || !hash_equals((string) $_SESSION['jok_admin_csrf'], $csrf)) {
    inline_json_response(false, 'Inline edit session expired. Reload and try again.');
}

$token = trim((string) ($_POST['token'] ?? ''));
$text = trim((string) ($_POST['canonical_text'] ?? ''));
if ($token === '') {
    inline_json_response(false, 'Missing language token.');
}

if (strlen($text) > 12000) {
    $text = substr($text, 0, 12000);
}

$languageFile = language_file_path();
$backupDir = dirname($languageFile) . '/language_backups';

if (!is_file($languageFile) || !is_readable($languageFile)) {
    inline_json_response(false, 'Language JSON file could not be read.');
}

$raw = file_get_contents($languageFile);
$language = is_string($raw) && trim($raw) !== '' ? json_decode($raw, true) : null;
if (!is_array($language) || !isset($language['entries']) || !is_array($language['entries'])) {
    inline_json_response(false, 'Language JSON could not be decoded or has no entries array.');
}

$found = false;
$changed = false;
$now = gmdate('c');
foreach ($language['entries'] as $index => $entry) {
    if (!is_array($entry) || (string) ($entry['token'] ?? '') !== $token) {
        continue;
    }

    $found = true;
    if ((string) ($entry['canonical_text'] ?? '') !== $text) {
        $language['entries'][$index]['canonical_text'] = $text;
        $language['entries'][$index]['last_edited_at'] = $now;
        $language['entries'][$index]['last_edited_via'] = 'public_inline_admin';
        $changed = true;
    }
    break;
}

if (!$found) {
    $language['entries'][] = language_default_entry($token, $text, 'public_inline_admin_auto_register');
    $found = true;
    $changed = true;
}

if (!$changed) {
    inline_json_response(true, 'No language changes detected.', ['token' => $token, 'canonical_text' => $text]);
}

$language['document_control']['last_updated'] = gmdate('Y-m-d');
$language['document_control']['status'] = 'Edited by admin language tools; language_map.md may need regeneration';
$language['usage_policy']['update_rule'] = 'When canonical_text changes, regenerate proto/docs/language_map.md from this JSON so the human map remains exactly aligned.';

[$saved, $message] = inline_language_backup_and_write($languageFile, $backupDir, $language);
inline_json_response($saved, $message, ['token' => $token, 'canonical_text' => $text]);
