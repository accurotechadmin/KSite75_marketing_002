<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

function jok_storage_dir(string $name): string
{
    $safeName = preg_replace('/[^a-z0-9_-]+/', '-', strtolower($name));
    $safeName = trim((string) $safeName, '-');
    if ($safeName === '') {
        $safeName = 'records';
    }

    return dirname(__DIR__) . '/storage/' . $safeName;
}

function jok_store_json_record(string $collection, array $record): array
{
    $dir = jok_storage_dir($collection);
    if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
        return [false, '', 'Could not create storage directory.'];
    }

    $file = $dir . '/' . gmdate('Y-m') . '.json';
    $handle = fopen($file, 'c+');
    if ($handle === false) {
        return [false, $file, 'Could not open storage file.'];
    }

    if (!flock($handle, LOCK_EX)) {
        fclose($handle);
        return [false, $file, 'Could not lock storage file.'];
    }

    $raw = stream_get_contents($handle);
    $records = [];
    if ($raw !== false && trim($raw) !== '') {
        try {
            $decoded = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            flock($handle, LOCK_UN);
            fclose($handle);
            return [false, $file, 'Existing storage file is not valid JSON.'];
        }
        if (!is_array($decoded)) {
            flock($handle, LOCK_UN);
            fclose($handle);
            return [false, $file, 'Existing storage file is not a JSON array.'];
        }
        $records = $decoded;
    }

    $records[] = $record;

    try {
        $encoded = json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
    } catch (JsonException) {
        flock($handle, LOCK_UN);
        fclose($handle);
        return [false, $file, 'Could not encode storage record.'];
    }

    rewind($handle);
    if (!ftruncate($handle, 0) || fwrite($handle, $encoded . PHP_EOL) === false) {
        flock($handle, LOCK_UN);
        fclose($handle);
        return [false, $file, 'Could not write storage file.'];
    }

    fflush($handle);
    flock($handle, LOCK_UN);
    fclose($handle);

    return [true, $file, ''];
}
