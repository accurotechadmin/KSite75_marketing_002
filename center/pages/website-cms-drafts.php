<?php
require_once __DIR__ . '/../partials/components.php';
$contracts = require __DIR__ . '/../data/proto_editing_contracts.php';
center_section_header('Next-session module', 'Website CMS Drafts', 'Read-only proto edit-specification contracts. These inspection cards are not live forms, saves, uploads, approvals, or publishing controls.');
center_placeholder_panel('Adapter boundary', [$contracts['adapter_boundary'], 'Each future control must map route, token/path, style contract, media reference, disclosure tier, release gate, rollback/audit, and preview/check requirements before becoming interactive.']);
center_card_grid($contracts['records'], ['proto_route','source_file','language_token_or_json_path','css_variable','compound_effect_control','cta','media_asset_reference','disclosure_tier','release_gate_record_id','raw_json_review_location','rollback_audit_requirement','preview_check_requirement','source_files','open_inquiry_ids']);
center_disabled_control_mockups('Read-only control inspection mockups', $contracts['disabled_controls']);
center_disabled_checklist('Disabled CMS action checklist', ['Preview route after manual JSON edit', 'Compare language token diff against backup', 'Attach release-gate evidence', 'Record rollback note', 'Publish approved proto update']);
