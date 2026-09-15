<?php
function ac_ssot_path(string $file): string { return rtrim(ac_config()['ssot_root'],'/').'/'.$file; }
function ac_ssot_json(string $file): array { $p=ac_ssot_path($file); if(!is_readable($p)) return []; $j=json_decode((string)file_get_contents($p), true); return is_array($j)?$j:[]; }
function ac_ssot_files(): array { $files=glob(rtrim(ac_config()['ssot_root'],'/').'/*.json') ?: []; sort($files); return array_map('basename',$files); }
function ac_master_documents(): array { $m=ac_ssot_json('master_index.json'); return $m['documents'] ?? []; }
function ac_doc_title(array $d,string $file): string { return $d['source_document']['title'] ?? $d['title'] ?? $d['ssot_document_id'] ?? $file; }
function ac_doc_summary(array $d): string { return ac_text($d['content_summary'] ?? $d['purpose'] ?? $d['admin_use']['primary_admin_value'] ?? 'Source document available for owner command center review.'); }
