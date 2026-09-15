<?php
require_once __DIR__ . '/../partials/components.php';
require_once __DIR__ . '/../includes/settings.php';
$config = center_config();
$manifest = center_settings_manifest();
$settings = center_settings_summary_rows();
$domains = array_count_values(array_map(fn($r) => $r['domain'], $settings));
center_section_header('Next-session module', 'Settings Inventory', 'Manifest-backed visibility into settings files that will eventually drive labels, option sets, workflow states, vocabulary, CTAs, routes, style guidance, brand stories, technical disclosure, integrations, and developer workflow.');
center_kv_table(['Manifest path'=>$config['settings_manifest_path'], 'Manifest title'=>$manifest['title'] ?? 'unavailable', 'Settings files'=>count($settings), 'Domains'=>implode(', ', array_map(fn($k,$v)=>$k . ' (' . $v . ')', array_keys($domains), $domains)), 'Live editing'=>'Deferred; read-only discovery only.']);
center_card_grid($settings, ['path','domain','status','purpose','top_level_contracts','disclosure_tier','open_inquiry_ids']);
center_disabled_checklist('Deferred settings actions', ['Edit route labels', 'Change CTA option sets', 'Adjust workflow state vocabulary', 'Publish style or brand-story settings']);
