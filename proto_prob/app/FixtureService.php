<?php
declare(strict_types=1);

final class FixtureService
{
    public function __construct(private readonly JsonRepository $repository)
    {
    }

    public function get(string $id): array
    {
        $id = $this->validateId($id);
        return $this->repository->read("fixtures/{$id}.json");
    }

    /** @return list<array<string,mixed>> */
    public function all(): array
    {
        $fixtures = $this->repository->list('fixtures');
        usort($fixtures, fn(array $a, array $b): int => strnatcasecmp((string)$a['fixture_id'], (string)$b['fixture_id']));
        return $fixtures;
    }

    public function create(array $record, string $user = 'local-admin'): array
    {
        $id = $this->validateId((string)($record['fixture_id'] ?? ''));
        if ($this->repository->exists("fixtures/{$id}.json")) {
            throw new RuntimeException("Fixture {$id} already exists.");
        }
        $types = $this->fixtureTypes();
        $typeId = (string)($record['fixture_type_id'] ?? '');
        if (!isset($types[$typeId])) {
            throw new InvalidArgumentException('Unknown fixture type.');
        }
        $type = $types[$typeId];
        $modeId = (string)($record['dmx']['mode_id'] ?? array_key_first($type['modes']));
        if (!isset($type['modes'][$modeId])) {
            throw new InvalidArgumentException('Unknown fixture DMX mode.');
        }
        $count = (int)$type['modes'][$modeId]['channel_count'];
        $start = max(1, min(512, (int)($record['dmx']['start_address'] ?? 1)));
        if ($start + $count - 1 > 512) {
            throw new InvalidArgumentException('DMX range exceeds channel 512.');
        }
        $defaults = array_map(static fn(array $channel): int => (int)($channel['default'] ?? 0), $type['modes'][$modeId]['channels']);
        $now = iso_now();
        $fixture = array_replace_recursive([
            'schema_version' => '1.0.0',
            'fixture_id' => $id,
            'fixture_type_id' => $typeId,
            'display_name' => $id,
            'local_name' => $id,
            'asset_tag' => $id,
            'serial_number' => null,
            'category' => $type['category'] ?? 'Fixture',
            'status' => 'active',
            'canonical' => false,
            'stage_layer' => 'lighting',
            'zone_id' => 'P-CS',
            'position' => ['x' => 0.0, 'y' => 8.0, 'z' => 2.0],
            'rotation' => ['x' => 0.0, 'y' => 0.0, 'z' => 0.0],
            'scale' => 1.0,
            'mounting' => ['point_id' => null, 'description' => 'New fixture', 'safety_cable' => true],
            'focus_target_id' => 'P-CS',
            'position_confidence' => 'estimated',
            'position_verified_at' => null,
            'dmx' => [
                'enabled' => true, 'universe' => 1, 'start_address' => $start, 'mode_id' => $modeId,
                'channel_count' => $count, 'end_address' => $start + $count - 1,
                'preview_values' => $defaults, 'default_values' => $defaults, 'home_values' => $defaults,
                'pan_invert' => false, 'tilt_invert' => false, 'wireless_receiver_id' => null,
            ],
            'connections' => ['dmx_in_from' => null, 'dmx_out_to' => null, 'power_from' => null],
            'power' => [
                'voltage' => $type['power']['voltage'] ?? 120, 'watts' => $type['power']['watts'] ?? 0,
                'current' => null, 'circuit_id' => null, 'source_device_id' => null, 'output_number' => null,
                'paired_output' => null, 'dimmable' => false, 'clean_power_required' => true, 'connector' => 'Edison',
            ],
            'simulation' => ['model_asset' => null, 'material_profile' => 'default', 'fixed_color' => null, 'shadow_enabled' => false, 'pick_proxy' => true, 'visible' => true],
            'photos' => [], 'manuals' => [], 'documents' => [], 'source_evidence' => [], 'open_questions' => [],
            'maintenance' => ['last_tested' => null, 'test_status' => 'not-tested', 'next_due' => null, 'open_faults' => [], 'service_record_ids' => [], 'out_of_service_reason' => null, 'notes' => ''],
            'revision' => 1, 'created_at' => $now, 'created_by' => $user, 'updated_at' => $now, 'updated_by' => $user, 'change_reason' => 'Created in Stage Command Center',
        ], $record);
        $this->repository->write("fixtures/{$id}.json", $fixture);
        $this->snapshot($fixture);
        $this->rebuildIndex();
        return $fixture;
    }

    public function update(string $id, array $patch, ?int $expectedRevision, string $reason = 'Updated in Stage Command Center', string $user = 'local-admin'): array
    {
        $id = $this->validateId($id);
        $current = $this->get($id);
        if ($expectedRevision !== null && (int)$current['revision'] !== $expectedRevision) {
            throw new RuntimeException("Revision conflict. Current revision is {$current['revision']}.");
        }
        unset($patch['fixture_id'], $patch['revision'], $patch['created_at'], $patch['created_by']);
        $updated = $this->deepMerge($current, $patch);
        $updated['fixture_id'] = $id;
        $updated['revision'] = (int)$current['revision'] + 1;
        $updated['updated_at'] = iso_now();
        $updated['updated_by'] = $user;
        $updated['change_reason'] = $reason;
        $this->normalizeDmx($updated);
        $this->validateFixture($updated);
        $this->snapshot($current);
        $this->repository->write("fixtures/{$id}.json", $updated);
        $this->rebuildIndex();
        return $updated;
    }

    public function archive(string $id, ?int $expectedRevision, string $reason = 'Archived'): array
    {
        return $this->update($id, ['status' => 'archived', 'simulation' => ['visible' => false]], $expectedRevision, $reason);
    }

    /** @return array<string,array<string,mixed>> */
    public function fixtureTypes(): array
    {
        return $this->repository->read('global/fixture-types.json');
    }

    /** @return list<array<string,mixed>> */
    public function history(string $id): array
    {
        $id = $this->validateId($id);
        $records = $this->repository->list("history/fixtures/{$id}");
        usort($records, fn(array $a, array $b): int => ((int)$b['revision']) <=> ((int)$a['revision']));
        return $records;
    }

    public function rebuildIndex(): array
    {
        $fixtures = [];
        foreach ($this->all() as $record) {
            $fixtures[] = [
                'fixture_id' => $record['fixture_id'],
                'fixture_type_id' => $record['fixture_type_id'],
                'display_name' => $record['display_name'],
                'category' => $record['category'],
                'status' => $record['status'],
                'canonical' => $record['canonical'],
                'stage_layer' => $record['stage_layer'],
                'zone_id' => $record['zone_id'],
                'position' => $record['position'],
                'rotation' => $record['rotation'],
                'dmx' => $record['dmx'],
                'power' => $record['power'],
                'maintenance' => $record['maintenance'],
                'revision' => $record['revision'],
                'updated_at' => $record['updated_at'],
            ];
        }
        $index = ['schema_version' => '1.0.0', 'generated_at' => iso_now(), 'count' => count($fixtures), 'fixtures' => $fixtures];
        $this->repository->write('indexes/fixtures.json', $index);
        return $index;
    }

    private function validateFixture(array $fixture): void
    {
        $this->validateId((string)($fixture['fixture_id'] ?? ''));
        if (trim((string)($fixture['display_name'] ?? '')) === '') {
            throw new InvalidArgumentException('Display name is required.');
        }
        foreach (['x', 'y', 'z'] as $axis) {
            if (!isset($fixture['position'][$axis]) || !is_numeric($fixture['position'][$axis])) {
                throw new InvalidArgumentException("Position {$axis} must be numeric.");
            }
        }
        $universe = (int)($fixture['dmx']['universe'] ?? 1);
        $start = (int)($fixture['dmx']['start_address'] ?? 1);
        $count = (int)($fixture['dmx']['channel_count'] ?? 1);
        if ($universe < 1 || $start < 1 || $start > 512 || $count < 1 || $start + $count - 1 > 512) {
            throw new InvalidArgumentException('Invalid DMX universe/address range.');
        }
    }

    private function normalizeDmx(array &$fixture): void
    {
        $types = $this->fixtureTypes();
        $typeId = (string)$fixture['fixture_type_id'];
        if (!isset($types[$typeId])) {
            throw new InvalidArgumentException('Unknown fixture type.');
        }
        $modeId = (string)($fixture['dmx']['mode_id'] ?? array_key_first($types[$typeId]['modes']));
        if (!isset($types[$typeId]['modes'][$modeId])) {
            throw new InvalidArgumentException('Unknown DMX mode.');
        }
        $count = (int)$types[$typeId]['modes'][$modeId]['channel_count'];
        $fixture['dmx']['mode_id'] = $modeId;
        $fixture['dmx']['channel_count'] = $count;
        $fixture['dmx']['start_address'] = (int)$fixture['dmx']['start_address'];
        $fixture['dmx']['end_address'] = $fixture['dmx']['start_address'] + $count - 1;
        foreach (['preview_values', 'default_values', 'home_values'] as $field) {
            $values = $fixture['dmx'][$field] ?? [];
            if (!is_array($values)) {
                $values = [];
            }
            $values = array_values(array_map(static fn($v): int => max(0, min(255, (int)$v)), $values));
            $defaults = array_map(static fn(array $ch): int => (int)($ch['default'] ?? 0), $types[$typeId]['modes'][$modeId]['channels']);
            $fixture['dmx'][$field] = array_slice(array_pad($values, $count, 0), 0, $count);
            if ($values === []) {
                $fixture['dmx'][$field] = $defaults;
            }
        }
    }

    private function snapshot(array $record): void
    {
        $id = $this->validateId((string)$record['fixture_id']);
        $revision = str_pad((string)((int)$record['revision']), 5, '0', STR_PAD_LEFT);
        $this->repository->write("history/fixtures/{$id}/revision-{$revision}.json", $record);
    }

    private function validateId(string $id): string
    {
        $id = strtoupper(trim($id));
        if (!preg_match('/^[A-Z0-9][A-Z0-9-]{1,31}$/', $id)) {
            throw new InvalidArgumentException('Fixture ID must contain 2–32 uppercase letters, numbers, or hyphens.');
        }
        return $id;
    }

    private function deepMerge(array $base, array $patch): array
    {
        foreach ($patch as $key => $value) {
            if (is_array($value) && isset($base[$key]) && is_array($base[$key]) && !array_is_list($value)) {
                $base[$key] = $this->deepMerge($base[$key], $value);
            } else {
                $base[$key] = $value;
            }
        }
        return $base;
    }
}
