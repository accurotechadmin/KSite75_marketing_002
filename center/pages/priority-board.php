<?php
require_once __DIR__ . '/../partials/components.php';
$board = require __DIR__ . '/../data/priority_board_seed.php';
center_section_header('First-class module', 'Priority Board', 'Read-only sequence board for proto editing intent, SSOT visibility, release readiness, provenance alignment, and integrity cleanup.');
center_kv_table(['Columns'=>$board['columns'], 'Movement semantics'=>array_values($board['movement_semantics'])]);
center_card_grid($board['cards'], ['module','status','priority','owner_or_responsible_role','timeline_moment_id_or_gen','disclosure_tier','next_action','open_inquiry_ids','inquiry_severity','summary']);
