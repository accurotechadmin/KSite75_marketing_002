<?php
function owner_config(): array
{
    static $config;
    if ($config === null) {
        $config = require __DIR__ . '/../config/site.php';
    }
    return $config;
}

function owner_navigation(): array
{
    return require __DIR__ . '/../data/navigation.php';
}

function owner_schema_fields(): array
{
    return require __DIR__ . '/../data/schema.php';
}

function owner_public_spokes(): array
{
    return require __DIR__ . '/../data/public_spokes.php';
}

function owner_page_ids(): array
{
    return array_column(owner_navigation(), 'id');
}

function owner_current_page(): string
{
    $config = owner_config();
    $requested = $_GET['page'] ?? $config['default_page'];
    return in_array($requested, owner_page_ids(), true) ? $requested : $config['default_page'];
}

function owner_page_meta(string $pageId): array
{
    foreach (owner_navigation() as $item) {
        if ($item['id'] === $pageId) {
            return $item;
        }
    }
    return owner_navigation()[0];
}

function owner_ssot_json(string $file): array
{
    $path = owner_config()['ssot_root'] . '/' . $file;
    if (!is_readable($path)) {
        return [];
    }

    $json = json_decode((string) file_get_contents($path), true);
    return is_array($json) ? $json : [];
}

function owner_e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function owner_slug_to_title(string $slug): string
{
    return ucwords(str_replace('-', ' ', $slug));
}

function owner_status_class(string $value): string
{
    return 'status-' . strtolower(str_replace([' ', '/', '_'], '-', $value));
}
