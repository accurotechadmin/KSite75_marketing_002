<?php
function sr_config(): array { static $c; return $c ??= require __DIR__ . '/../config/site.php'; }
function sr_nav(): array { return require __DIR__ . '/../data_navigation.php'; }
function sr_e($value): string { return htmlspecialchars(is_scalar($value) ? (string) $value : json_encode($value), ENT_QUOTES, 'UTF-8'); }
function sr_schema(): array { return ['record_id','title','section','category','timeline_moment_id_or_gen','status','priority','owner_or_responsible_role','public_private_flag','rights_status','safety_status','description','notes','linked_files','linked_records','last_updated']; }
function sr_page_ids(): array { return array_column(sr_nav(), 'id'); }
function sr_current_page(): string { $p = (string)($_GET['page'] ?? sr_config()['default_page']); return in_array($p, sr_page_ids(), true) ? $p : sr_config()['default_page']; }
function sr_meta(string $id): array { foreach (sr_nav() as $n) if ($n['id'] === $id) return $n; return sr_nav()[0]; }
function sr_arr($v): array { if (is_array($v)) return array_values(array_filter($v, fn($x) => $x !== '' && $x !== null)); if ($v === null || $v === '') return []; return [$v]; }
function sr_text($v): string { if (is_array($v)) return implode("\n", array_map('sr_text', $v)); return (string)$v; }
function sr_slug(string $v): string { return preg_replace('/[^a-z0-9]+/', '-', strtolower($v)); }
function sr_family(string $id): string { if ($id === 'GEN' || str_starts_with($id, 'GEN')) return 'GEN'; if (preg_match('/^([A-Z]+)/', $id, $m)) return $m[1]; return 'REVIEW'; }
function sr_status_class(string $v): string { return 'is-' . sr_slug($v); }
function sr_public_gate(array $r): string { $pub=strtolower($r['public_private_flag']??''); $rights=strtolower($r['rights_status']??''); $safety=strtolower($r['safety_status']??''); return (str_contains($pub,'approved') && preg_match('/owned|licensed|approved/',$rights) && preg_match('/clear|venue-approved/',$safety)) ? 'Can consider public use' : 'Keep internal / review first'; }
function sr_ssot_roots(): array { $config = sr_config(); $roots = $config['ssot_roots'] ?? [$config['ssot_root'] ?? '']; return array_values(array_unique(array_filter(array_map(fn($p) => rtrim((string)$p, '/'), $roots)))); }
function sr_ssot_root(): string { foreach (sr_ssot_roots() as $root) { if (is_dir($root) && glob($root . '/*.json')) return $root; } return sr_ssot_roots()[0] ?? ''; }
function sr_data_status(): array { $root = sr_ssot_root(); $files = $root ? (glob($root . '/*.json') ?: []) : []; sort($files); return ['active_root' => $root, 'json_count' => count($files), 'candidate_roots' => sr_ssot_roots(), 'files' => array_map('basename', $files)]; }
function sr_json_files(): array { $root = sr_ssot_root(); $files = $root ? (glob($root . '/*.json') ?: []) : []; sort($files); return $files; }
function sr_read_json(string $file): array { $path = sr_ssot_root() . '/' . basename($file); if (!is_readable($path)) return []; $data = json_decode((string)file_get_contents($path), true); return is_array($data) ? $data : []; }
function sr_doc_title(array $doc, string $file): string { return $doc['source_document']['title'] ?? $doc['title'] ?? ucwords(str_replace('_', ' ', pathinfo($file, PATHINFO_FILENAME))); }
function sr_doc_summary(array $doc): string { $summary = $doc['content_summary'] ?? $doc['purpose'] ?? ''; return is_array($summary) ? sr_text($summary) : (string)$summary; }
function sr_normalize_record(array $raw, string $file, array $doc, int $i): array {
    $src = $doc['source_document']['path'] ?? ('owner_arena_command/data/ssot/' . $file);
    $desc = $raw['description'] ?? sr_doc_summary($doc);
    $id = (string)($raw['record_id'] ?? (($doc['ssot_document_id'] ?? pathinfo($file, PATHINFO_FILENAME)) . '.' . ($i + 1)));
    $timeline = (string)($raw['timeline_moment_id_or_gen'] ?? (($doc['timeline_classification'] ?? 'GEN') === 'GEN' ? 'GEN' : 'GEN-PENDING-REVIEW'));
    return [
        'record_id' => $id,
        'title' => (string)($raw['title'] ?? sr_doc_title($doc, $file)),
        'section' => (string)($raw['section'] ?? pathinfo($file, PATHINFO_FILENAME)),
        'category' => (string)($raw['category'] ?? ($doc['source_document']['category'] ?? 'source document')),
        'timeline_moment_id_or_gen' => $timeline,
        'status' => (string)($raw['status'] ?? ($doc['maintenance']['status'] ?? 'needs review')),
        'priority' => (string)($raw['priority'] ?? 'medium'),
        'owner_or_responsible_role' => (string)($raw['owner_or_responsible_role'] ?? 'owner'),
        'public_private_flag' => (string)($raw['public_private_flag'] ?? 'internal-only'),
        'rights_status' => (string)($raw['rights_status'] ?? 'needs review'),
        'safety_status' => (string)($raw['safety_status'] ?? 'needs review'),
        'description' => (string)$desc,
        'notes' => sr_text($raw['notes'] ?? ''),
        'linked_files' => array_values(array_unique(array_merge([$src, 'owner_arena_command/data/ssot/' . $file], sr_arr($raw['linked_files'] ?? [])))),
        'linked_records' => sr_arr($raw['linked_records'] ?? ($doc['relationships']['depends_on'] ?? [])),
        'last_updated' => (string)($raw['last_updated'] ?? ($doc['maintenance']['last_reviewed'] ?? ($doc['generated_date'] ?? 'needs freshness review'))),
        'source_file' => $file,
        'source_title' => sr_doc_title($doc, $file),
        'source_type' => isset($raw['record_id']) ? 'canonical JSON record' : 'document summary fallback',
        'family' => sr_family($timeline),
        'raw_record' => $raw ?: ['fallback_from_document' => true],
    ];
}
function sr_records(): array { static $records; if ($records !== null) return $records; $records = []; foreach (sr_json_files() as $path) { $file = basename($path); if ($file === 'master_index.json') continue; $doc = sr_read_json($file); $cr = $doc['canonical_records'] ?? []; if (is_array($cr) && array_is_list($cr) && $cr) { foreach ($cr as $i => $r) if (is_array($r)) $records[] = sr_normalize_record($r, $file, $doc, $i); } else { $records[] = sr_normalize_record([], $file, $doc, 0); } } usort($records, fn($a,$b) => strcmp($a['record_id'], $b['record_id'])); return $records; }
function sr_find_record(string $id): ?array { foreach (sr_records() as $r) if ($r['record_id'] === $id) return $r; return null; }
function sr_records_by_source(string $file): array { return array_values(array_filter(sr_records(), fn($r) => $r['source_file'] === $file)); }
function sr_filter_records(): array { $rows = sr_records(); foreach (['family','source_file','section','status','rights_status','safety_status'] as $k) { if (isset($_GET[$k]) && $_GET[$k] !== '') $rows = array_values(array_filter($rows, fn($r) => $r[$k] === $_GET[$k])); } if (isset($_GET['q']) && trim((string)$_GET['q']) !== '') { $q = strtolower(trim((string)$_GET['q'])); $rows = array_values(array_filter($rows, fn($r) => str_contains(strtolower(implode(' ', [$r['record_id'],$r['title'],$r['section'],$r['category'],$r['timeline_moment_id_or_gen'],$r['description'],$r['notes']])), $q))); } return $rows; }
function sr_option_values(string $field): array { $vals = array_values(array_unique(array_map(fn($r) => $r[$field] ?? '', sr_records()))); sort($vals); return array_values(array_filter($vals, fn($v) => $v !== '')); }
function sr_source_summaries(): array { $out=[]; foreach (sr_json_files() as $path) { $file=basename($path); $doc=sr_read_json($file); $out[]=['file'=>$file,'title'=>sr_doc_title($doc,$file),'records'=>count($doc['canonical_records'] ?? []),'loaded_records'=>count(sr_records_by_source($file)),'keys'=>array_keys($doc),'summary'=>sr_doc_summary($doc),'valid'=>json_last_error()===JSON_ERROR_NONE]; } return $out; }
function sr_integrity_report(): array { $required=sr_schema(); $ids=[]; $dupes=[]; $missing=[]; $timeline=[]; $broken=[]; foreach (sr_records() as $r) { if (isset($ids[$r['record_id']])) $dupes[]=$r['record_id']; $ids[$r['record_id']]=true; foreach ($required as $f) if (!array_key_exists($f,$r)) $missing[]=$r['record_id'].' missing schema key '.$f; $t=$r['timeline_moment_id_or_gen']; if ($t === '' || (!preg_match('/^(GEN|GEN-[A-Z-]+|[A-Z]+-\d{3})$/', $t))) $timeline[]=$r['record_id'].' has timeline value '.$t; foreach ($r['linked_records'] as $lr) if (!isset($ids[$lr]) && !sr_find_record((string)$lr)) $broken[]=$r['record_id'].' links to unresolved record '.$lr; } return ['duplicates'=>$dupes,'missing_fields'=>$missing,'timeline_warnings'=>$timeline,'unresolved_links'=>array_values(array_unique($broken))]; }
function sr_url(array $params): string { return '?' . http_build_query($params); }
function sr_record_url(string $id): string { return sr_url(['page'=>'record','id'=>$id]); }
function sr_source_url(string $file): string { return sr_url(['page'=>'source','file'=>$file]); }
