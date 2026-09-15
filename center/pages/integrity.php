<?php
require_once __DIR__ . '/../partials/components.php';
$checks = require __DIR__ . '/../data/integrity_checks_seed.php';
center_section_header('First-class module', 'Integrity Checks', 'Read-only owner view of checks that protect PHP/JSON validity, navigation templates, SSOT paths, Timeline/GEN discipline, release evidence, and inquiry traceability.');
center_placeholder_panel('Validation command', ['Run: php center/scripts/validate.php', 'The script is dependency-free and safe for uploaded PHP files; it does not mutate data.']);
center_card_grid($checks, ['severity','check','status','timeline_moment_id_or_gen','open_inquiry_ids']);
