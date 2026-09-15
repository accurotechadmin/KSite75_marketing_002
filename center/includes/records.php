<?php
/** Purpose: Record service scaffolding for normalized owner records, schema validation, Timeline/GEN checks, review-gate fields, linked-record resolution, and future overlay merge rules. */
function center_record_schema(): array { return require __DIR__ . '/../data/schema.php'; }
function center_timeline_is_valid(string $value): bool { return (bool) preg_match(center_record_schema()['timeline_pattern'], $value); }
function center_integrity_seed_findings(): array
{
    $schema = center_record_schema();
    $findings = [];
    foreach ($schema['integrity_checks_to_scaffold'] as $i => $check) {
        $findings[] = ['finding_id' => 'IF-GEN-' . str_pad((string)($i + 1), 3, '0', STR_PAD_LEFT), 'severity' => 'info', 'source_file' => 'center/data/schema.php', 'record_id' => 'GEN', 'message' => 'Scaffold check planned: ' . $check . '.', 'recommended_action' => 'Implement as a read-only report first; add write-side enforcement only after auth/audit/backups.'];
    }
    return $findings;
}
