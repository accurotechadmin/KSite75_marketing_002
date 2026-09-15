<?php
require_once __DIR__ . '/../partials/components.php';
require_once __DIR__ . '/../includes/ssot.php';
$config = center_config();
$index = center_ssot_master_index();
$rows = center_ssot_document_rows();
$categories = array_count_values(array_map(fn($r) => $r['category'], $rows));
center_section_header('Next-session module', 'SSOT Library', 'Read-only source-family map for master_index.json, settings_manifest.json, settings JSON, and domain SSOT JSON files.');
center_kv_table(['SSOT root'=>$config['domain_ssot_root'], 'Master index title'=>$index['title'] ?? 'unavailable', 'Indexed documents'=>count($rows), 'Source families'=>implode(', ', array_map(fn($k,$v)=>$k . ' (' . $v . ')', array_keys($categories), $categories)), 'Safe-edit rule'=>'Human canon first, machine companion second; no runtime writes from /center.']);
center_card_grid(array_slice($rows, 0, 18), ['category','human_source','json_source','status','companion_note','timeline_moment_id_or_gen','open_inquiry_ids']);
center_placeholder_panel('Immediate CMS-adapter value', ['Show which SSOT/settings/source files an intended proto edit touches.', 'Flag source conflicts for Integrity and Decision Log instead of silently choosing truth.', 'Keep prior renditions as archived references, not data authority.']);
