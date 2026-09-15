<?php
require_once __DIR__ . '/../partials/components.php';
$ledger = require __DIR__ . '/../data/source_provenance_schema.php';
center_section_header('First-class module', 'Provenance Ledger', 'Owner-approved provenance vocabulary for source canon, machine companions, settings contracts, app seeds, owner overlays, generated outputs, and archived references.');
center_kv_table(['Approved provenance levels'=>$ledger['provenance_levels'], 'Safe-edit posture'=>'/center reads canon and app seeds; runtime overlays, publishing, and generated outputs are deferred until audit/backups/rollback exist.']);
center_card_grid($ledger['sources'], ['path','provenance_level','authority','paired_source','sync_note','safe_edit_rule','timeline_moment_id_or_gen','open_inquiry_ids']);
