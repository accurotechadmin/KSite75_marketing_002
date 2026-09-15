<?php
/** Purpose: Settings loader bridge from `docs/ssot/settings_manifest.json` into owner UI without hard-coding settings-backed facts in templates. */
function center_settings_manifest(): array
{
    $path = center_config()['settings_manifest_path'];
    if (!is_file($path)) { return ['settings_file_inventory' => [], 'error' => 'Settings manifest not found.']; }
    $decoded = json_decode((string) file_get_contents($path), true);
    return is_array($decoded) ? $decoded : ['settings_file_inventory' => [], 'error' => 'Settings manifest is not valid JSON.'];
}
function center_settings_inventory(): array
{
    $manifest = center_settings_manifest();
    $items = $manifest['settings_file_inventory'] ?? $manifest['settings_files'] ?? [];
    return is_array($items) ? $items : [];
}

function center_settings_summary_rows(): array
{
    $rows = [];
    foreach (center_settings_inventory() as $entry) {
        if (!is_array($entry)) { continue; }
        $path = (string) ($entry['path'] ?? '');
        $decoded = [];
        if ($path !== '' && is_file(dirname(__DIR__, 2) . '/' . $path)) {
            $decoded = json_decode((string) file_get_contents(dirname(__DIR__, 2) . '/' . $path), true) ?: [];
        }
        $rows[] = [
            'record_id' => $entry['file_id'] ?? $entry['id'] ?? $path,
            'title' => $entry['file_id'] ?? $entry['title'] ?? $path,
            'path' => $path,
            'domain' => $entry['domain'] ?? 'settings',
            'status' => $entry['status'] ?? 'starter-created',
            'purpose' => $entry['purpose'] ?? '',
            'top_level_contracts' => implode(', ', array_slice(array_keys($decoded), 0, 8)),
            'timeline_moment_id_or_gen' => 'GEN',
            'disclosure_tier' => 'owner-private',
            'open_inquiry_ids' => ['OI-014'],
        ];
    }
    return $rows;
}
