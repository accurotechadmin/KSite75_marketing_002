<?php
declare(strict_types=1);

function jok_config(): array
{
    static $config = null;
    if ($config !== null) {
        return $config;
    }

    $configFile = __DIR__ . '/config.php';
    if (!is_file($configFile)) {
        $configFile = __DIR__ . '/config.example.php';
    }

    /** @var array $loaded */
    $loaded = require $configFile;
    $config = $loaded;
    return $config;
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function post_string(string $key, int $maxLength = 1000): string
{
    $value = trim((string) ($_POST[$key] ?? ''));
    if (strlen($value) > $maxLength) {
        $value = substr($value, 0, $maxLength);
    }
    return $value;
}

function post_tags(string $key, array $allowed): array
{
    $raw = $_POST[$key] ?? [];
    if (!is_array($raw)) {
        $raw = [$raw];
    }

    return array_values(array_intersect($allowed, array_map('strval', $raw)));
}

function is_valid_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function current_path(): string
{
    return strtok((string) ($_SERVER['REQUEST_URI'] ?? '/'), '?') ?: '/';
}

function site_source(): string
{
    return 'just_one_kiss_site_base';
}

function local_fallback_note(string $type): string
{
    return "Your {$type} was validated locally. Database storage is not enabled in this environment; connect app/config.php to MySQL/MariaDB before deployment.";
}
