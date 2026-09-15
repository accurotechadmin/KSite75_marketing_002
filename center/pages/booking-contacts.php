<?php
require_once __DIR__ . '/../partials/components.php';
$data = require __DIR__ . '/../data/booking_contacts_seed.php';
center_placeholder_panel($module['label'] . ' purpose', [
    'Owner problem solved: tracks venue buyers, press, vendors, inquiry sources, packet readiness, last touch, next touch, status, and owner role.',
    'Required source files: website system plan, owner readiness notes, public prototype copy, and future private contact overlays.',
    'Gate warning: contact data is private; buyer and press summaries must be public-safe and release-gated.',
    'Timeline/GEN rule: contacts are usually GEN; event-specific follow-ups may link to Timeline records when needed.',
    'Future note: real contact storage requires privacy controls, auth, backups, audit trails, and export permissions.',
]);
center_kv_table(['Required fields' => $data['required_fields']]);
center_card_grid($data['contacts'], ['contact_type','organization_placeholder','classification','status','owner_role','inquiry_source','buyer_packet_readiness','last_touch','next_touch','next_action','source_files','public_safe_summary','internal_notes']);
