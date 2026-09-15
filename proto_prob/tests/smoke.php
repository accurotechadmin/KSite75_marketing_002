<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/app/bootstrap.php';

$failures = [];
$fixtures = fixture_service()->all();
$types = fixture_service()->fixtureTypes();

if (count($fixtures) !== 59) {
    $failures[] = 'Expected 59 fixtures; found ' . count($fixtures) . '.';
}

$ids = [];
foreach ($fixtures as $fixture) {
    $id = $fixture['fixture_id'] ?? '';
    if ($id === '' || isset($ids[$id])) {
        $failures[] = "Missing or duplicate fixture ID: {$id}";
    }
    $ids[$id] = true;
    if (!isset($types[$fixture['fixture_type_id']])) {
        $failures[] = "{$id}: unknown fixture type.";
        continue;
    }
    $mode = $types[$fixture['fixture_type_id']]['modes'][$fixture['dmx']['mode_id']] ?? null;
    if (!$mode) {
        $failures[] = "{$id}: unknown DMX mode.";
        continue;
    }
    if ((int)$mode['channel_count'] !== (int)$fixture['dmx']['channel_count']) {
        $failures[] = "{$id}: channel count differs from fixture type.";
    }
    if ((int)$fixture['dmx']['end_address'] > 512 || (int)$fixture['dmx']['start_address'] < 1) {
        $failures[] = "{$id}: DMX range is invalid.";
    }
    if (count($fixture['dmx']['preview_values']) !== (int)$fixture['dmx']['channel_count']) {
        $failures[] = "{$id}: preview value count is invalid.";
    }
    foreach (['x','y','z'] as $axis) {
        if (!is_numeric($fixture['position'][$axis] ?? null)) {
            $failures[] = "{$id}: position {$axis} is not numeric.";
        }
    }
}

$scaffold = repository()->read('global/scaffold.json');
foreach (['width','depth','height'] as $dimension) {
    if (($scaffold['dimensions'][$dimension] ?? 0) <= 0) {
        $failures[] = "Scaffold {$dimension} is invalid.";
    }
}

$profiles = repository()->list('profiles/stage-scenes');
if (count($profiles) < 3) {
    $failures[] = 'Expected at least three initial stage profiles.';
}
foreach ($profiles as $profile) {
    foreach ($profile['fixture_values'] as $id => $values) {
        if (!isset($ids[$id])) {
            $failures[] = "Profile {$profile['profile_id']} references unknown fixture {$id}.";
        }
        foreach ($values as $value) {
            if (!is_int($value) || $value < 0 || $value > 255) {
                $failures[] = "Profile {$profile['profile_id']} has an invalid DMX value.";
                break 2;
            }
        }
    }
}

if ($failures) {
    fwrite(STDERR, "SMOKE TEST FAILED\n- " . implode("\n- ", $failures) . "\n");
    exit(1);
}

echo "SMOKE TEST PASSED\n";
echo "Fixtures: " . count($fixtures) . "\n";
echo "Fixture types: " . count($types) . "\n";
echo "Profiles: " . count($profiles) . "\n";
echo "Scaffold: {$scaffold['dimensions']['width']} × {$scaffold['dimensions']['depth']} × {$scaffold['dimensions']['height']} ft\n";
