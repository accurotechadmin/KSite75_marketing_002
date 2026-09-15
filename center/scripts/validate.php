<?php
declare(strict_types=1);

$root = dirname(__DIR__, 2);
$errors = [];
$warnings = [];

function add_issue(array &$bucket, string $message): void { $bucket[] = $message; }
function files(string $dir, string $pattern): array { return glob($dir . '/' . $pattern) ?: []; }

foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root . '/center', FilesystemIterator::SKIP_DOTS)) as $file) {
    if (!$file->isFile() || $file->getExtension() !== 'php') { continue; }
    $cmd = 'php -l ' . escapeshellarg($file->getPathname()) . ' 2>&1';
    exec($cmd, $out, $code);
    if ($code !== 0) { add_issue($errors, 'PHP syntax failed: ' . $file->getPathname() . ' :: ' . implode(' ', $out)); }
}

$nav = require $root . '/center/data/navigation.php';
foreach ($nav as $id => $module) {
    $template = $root . '/center/pages/' . ($module['template'] ?? '');
    if (!is_file($template)) { add_issue($errors, "Missing navigation template for {$id}: {$template}"); }
    if (empty($module['open_inquiry_ids']) || !is_array($module['open_inquiry_ids'])) { add_issue($warnings, "Navigation module {$id} has no open_inquiry_ids."); }
    if (($module['timeline_rule'] ?? '') !== '' && str_contains((string) $module['timeline_rule'], 'GEN-PENDING-REVIEW')) { add_issue($errors, "Navigation module {$id} uses deprecated pending-review marker."); }
}

$config = require $root . '/center/config/app.php';
foreach (['settings_manifest_path','domain_ssot_root'] as $key) {
    $path = $config[$key] ?? '';
    if ($path === '' || (!is_file($path) && !is_dir($path))) { add_issue($errors, "Configured {$key} does not resolve: {$path}"); }
}
if (!is_file($root . '/docs/ssot/master_index.json')) { add_issue($errors, 'Missing docs/ssot/master_index.json'); }

foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root . '/docs/ssot', FilesystemIterator::SKIP_DOTS)) as $file) {
    if (!$file->isFile() || $file->getExtension() !== 'json') { continue; }
    json_decode((string) file_get_contents($file->getPathname()), true);
    if (json_last_error() !== JSON_ERROR_NONE) { add_issue($errors, 'JSON syntax failed: ' . $file->getPathname() . ' :: ' . json_last_error_msg()); }
}

$schema = require $root . '/center/data/schema.php';
$pattern = $schema['timeline_pattern'];
$datasets = [
    'priority_board_seed' => require $root . '/center/data/priority_board_seed.php',
    'release_gate_matrix' => require $root . '/center/data/release_gate_matrix.php',
    'source_provenance_schema' => require $root . '/center/data/source_provenance_schema.php',
    'proto_editing_contracts' => require $root . '/center/data/proto_editing_contracts.php',
    'integrity_checks_seed' => require $root . '/center/data/integrity_checks_seed.php',
    'tasks_launch_seed' => require $root . '/center/data/tasks_launch_seed.php',
];
$rows = [];
foreach ($datasets as $name => $data) {
    foreach (['cards','rows','sources','records','lanes'] as $key) {
        foreach (($data[$key] ?? []) as $row) { if (is_array($row)) { $row['_dataset'] = $name; $rows[] = $row; } }
    }
    if (array_is_list($data)) { foreach ($data as $row) { if (is_array($row)) { $row['_dataset'] = $name; $rows[] = $row; } } }
}
$evidenceFields = $schema['release_gate_evidence_shape'];
foreach ($rows as $row) {
    $id = (string) ($row['record_id'] ?? $row['source_id'] ?? $row['finding_id'] ?? 'unknown');
    $timeline = (string) ($row['timeline_moment_id_or_gen'] ?? '');
    if ($timeline === '') { add_issue($errors, "{$row['_dataset']} {$id} missing timeline_moment_id_or_gen."); }
    elseif (!preg_match($pattern, $timeline)) { add_issue($errors, "{$row['_dataset']} {$id} has invalid timeline_moment_id_or_gen {$timeline}."); }
    if (empty($row['open_inquiry_ids']) || !is_array($row['open_inquiry_ids'])) { add_issue($warnings, "{$row['_dataset']} {$id} has no open_inquiry_ids."); }
    foreach ($row as $value) { if (is_string($value) && str_contains($value, 'GEN-PENDING-REVIEW')) { add_issue($errors, "{$row['_dataset']} {$id} uses deprecated pending-review marker."); } }
    if (($row['status'] ?? '') === 'needs_timeline_review') {
        $bad = ['approved','exported','public-ready','venue-ready','internal-ready','show-ready'];
        foreach ($bad as $state) { if (in_array($state, $row, true)) { add_issue($errors, "{$row['_dataset']} {$id} is needs_timeline_review and promoted to {$state}."); } }
    }
    if (($row['_dataset'] ?? '') === 'release_gate_matrix') {
        foreach ($evidenceFields as $field) { if (!array_key_exists($field, $row['evidence'] ?? [])) { add_issue($errors, "Release gate {$id} missing evidence field {$field}."); } }
    }
}

if ($warnings) { echo "WARNINGS:\n- " . implode("\n- ", $warnings) . "\n"; }
if ($errors) { fwrite(STDERR, "ERRORS:\n- " . implode("\n- ", $errors) . "\n"); exit(1); }
echo "center validation ok\n";
