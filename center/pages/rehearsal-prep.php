<?php
require_once __DIR__ . '/../partials/components.php';
$data = require __DIR__ . '/../data/rehearsal_prep_seed.php';
center_placeholder_panel($module['label'] . ' purpose', [
    'Owner problem solved: keeps practice notes, readiness drills, cue fixes, packing prep, rehearsal next actions, and source records visible before show-ready exports.',
    'Required source files: cue draft, timeline registry, inventory reference, rig documentation, and future owner overlays.',
    'Gate warning: internal rehearsal/show-control detail stays private; public booking or press language only uses approved summaries.',
    'Timeline/GEN rule: every rehearsal item is GEN unless it fixes a specific Timeline Moment.',
    'Future note: persistent rehearsal status requires owner auth, audit history, backups, and rollback.',
]);
center_kv_table(['Required fields' => $data['required_fields']]);
center_card_grid($data['items'], ['prep_type','classification','status','priority','owner_role','next_action','source_records','public_private_boundary','safety_gate','last_updated']);
