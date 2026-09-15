<?php
/** Purpose: SSOT loader for domain JSON in `docs/ssot/` with path discovery, master-index awareness, and safe read-only provenance. */
function center_ssot_root(): string { return center_config()['domain_ssot_root']; }
function center_ssot_master_index(): array
{
    $path = center_ssot_root() . '/master_index.json';
    if (!is_file($path)) { return ['error' => 'SSOT master index missing.', 'documents' => []]; }
    $decoded = json_decode((string) file_get_contents($path), true);
    return is_array($decoded) ? $decoded : ['error' => 'SSOT master index invalid JSON.', 'documents' => []];
}
function center_json_file_valid(string $path): bool
{
    if (!is_file($path)) { return false; }
    json_decode((string) file_get_contents($path), true);
    return json_last_error() === JSON_ERROR_NONE;
}

function center_ssot_document_rows(): array
{
    $index = center_ssot_master_index();
    $documents = $index['documents'] ?? [];
    $rows = [];
    foreach ($documents as $key => $doc) {
        if (!is_array($doc)) { continue; }
        $rows[] = [
            'record_id' => $doc['document_id'] ?? $key,
            'title' => $doc['title'] ?? $key,
            'category' => $doc['category'] ?? 'uncategorized',
            'human_source' => $doc['human_readable_source'] ?? $doc['source_path'] ?? '',
            'json_source' => $doc['json_path'] ?? $doc['path'] ?? '',
            'status' => $doc['status'] ?? 'indexed',
            'timeline_moment_id_or_gen' => $doc['timeline_moment_id_or_gen'] ?? 'GEN',
            'companion_note' => $doc['companion_note'] ?? 'Use human canon as authority and JSON as machine companion.',
            'open_inquiry_ids' => ['OI-015'],
        ];
    }
    return $rows;
}
