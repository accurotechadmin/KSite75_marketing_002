<?php

declare(strict_types=1);

function language_file_path(): string
{
    $override = getenv('JOK_LANGUAGE_FILE');
    if (is_string($override) && trim($override) !== '') {
        return $override;
    }

    return __DIR__ . '/../docs/language.json';
}

function language_entries(bool $refresh = false): array
{
    static $cache = [];

    $path = language_file_path();
    if (!$refresh && array_key_exists($path, $cache)) {
        return $cache[$path];
    }

    if (!is_file($path) || !is_readable($path)) {
        $cache[$path] = [];
        return $cache[$path];
    }

    $raw = file_get_contents($path);
    if ($raw === false || trim($raw) === '') {
        $cache[$path] = [];
        return $cache[$path];
    }

    $decoded = json_decode($raw, true);
    if (!is_array($decoded) || !isset($decoded['entries']) || !is_array($decoded['entries'])) {
        $cache[$path] = [];
        return $cache[$path];
    }

    $cache[$path] = $decoded['entries'];
    return $cache[$path];
}

function language_token_map(bool $refresh = false): array
{
    static $cache = [];

    $path = language_file_path();
    if (!$refresh && array_key_exists($path, $cache)) {
        return $cache[$path];
    }

    $map = [];
    foreach (language_entries() as $entry) {
        if (!is_array($entry)) {
            continue;
        }

        $token = isset($entry['token']) ? trim((string) $entry['token']) : '';
        if ($token === '' || !array_key_exists('canonical_text', $entry)) {
            continue;
        }

        $map[$token] = (string) $entry['canonical_text'];
    }

    $cache[$path] = $map;
    return $cache[$path];
}

function language_token_id_from_token(string $token): string
{
    $id = preg_replace('/[^a-zA-Z0-9]+/', '_', trim($token)) ?? '';
    $id = trim(strtolower($id), '_');
    return $id !== '' ? $id : 'language_token';
}

function language_text_key(string $text): string
{
    return 'text.' . substr(hash('sha256', $text), 0, 10);
}

function language_default_entry(string $token, string $text, string $source = 'runtime_language_admin'): array
{
    $route = '/';
    if (str_starts_with($token, 'pages.')) {
        $parts = explode('.', $token);
        $page = $parts[1] ?? '';
        $routeMap = [
            'directions' => '/directions/',
            'faq' => '/faq-disclaimer/',
            'ritual' => '/what-is-just-one-kiss/',
            'spectacle' => '/spectacle/',
            'vault' => '/vault/',
            'video' => '/video/',
            'technical' => '/technical/',
            'contact' => '/contact/',
            'show' => '/july-25-2026/',
        ];
        $route = $routeMap[$page] ?? '/';
    }

    return [
        'id' => language_token_id_from_token($token),
        'token' => $token,
        'classification' => 'GEN',
        'status' => 'current',
        'source_scope' => $source,
        'canonical_text' => $text,
        'text_role' => str_contains($token, '.meta.') ? (str_ends_with($token, '.title') ? 'browser_title' : 'meta_description') : 'page_copy',
        'component' => str_starts_with($token, 'pages.') ? 'supporting_public_page' : 'public_site',
        'tone' => 'fan-facing',
        'reuse_policy' => 'editable_runtime_copy',
        'context_notes' => 'Auto-registered from a live lang_*() token so admin editing does not reject active page text.',
        'occurrences' => [],
        'dependencies' => [
            'webpages' => [$route],
            'marketing_functions' => [],
            'database_queries' => [],
            'forms' => [],
        ],
        'review' => [
            'rights_safe' => true,
            'safety_related' => str_contains($text, 'fog') || str_contains($text, 'strobe') || str_contains($text, 'safety'),
            'verified_fact' => str_contains($text, 'July 25, 2026') || str_contains($text, 'Cycle Moore') || str_contains($text, 'US 31') || str_contains($text, '$10'),
            'needs_owner_review' => false,
        ],
        'canonical_text_key' => language_text_key($text),
        'same_text_tokens' => [$token],
    ];
}

function language_clear_runtime_cache(): void
{
    language_entries(true);
    language_token_map(true);
}

function lang_text(string $token, ?string $fallback = null): string
{
    $map = language_token_map();
    if (array_key_exists($token, $map) && $map[$token] !== '') {
        return $map[$token];
    }

    return $fallback ?? $token;
}

function lang_with_strong_prefix(string $text, string $prefix): string
{
    if ($prefix !== '' && str_starts_with($text, $prefix)) {
        return '<strong>' . e($prefix) . '</strong>' . e(substr($text, strlen($prefix)));
    }

    return e($text);
}

function language_admin_session_started(): bool
{
    return session_status() === PHP_SESSION_ACTIVE;
}

function language_admin_maybe_start_session(): void
{
    if (language_admin_session_started()) {
        return;
    }

    if (isset($_COOKIE[session_name()])) {
        session_start();
    }
}

function language_admin_is_logged_in(): bool
{
    language_admin_maybe_start_session();
    return isset($_SESSION['jok_admin_logged_in']) && $_SESSION['jok_admin_logged_in'] === true;
}

function language_admin_csrf_token(): string
{
    language_admin_maybe_start_session();
    return isset($_SESSION['jok_admin_csrf']) && is_string($_SESSION['jok_admin_csrf']) ? $_SESSION['jok_admin_csrf'] : '';
}

function language_entry_by_token(string $token): ?array
{
    foreach (language_entries() as $entry) {
        if (is_array($entry) && (string) ($entry['token'] ?? '') === $token) {
            return $entry;
        }
    }

    return null;
}

function lang_editable(string $token, ?string $fallback = null): string
{
    $text = lang_text($token, $fallback);
    if (!language_admin_is_logged_in()) {
        return e($text);
    }

    $entry = language_entry_by_token($token) ?? [];
    $component = (string) ($entry['component'] ?? 'unknown');
    $role = (string) ($entry['text_role'] ?? 'unknown');

    return '<span class="jok-lang-token" data-lang-token="' . e($token) . '" data-lang-component="' . e($component) . '" data-lang-role="' . e($role) . '" tabindex="0">' . e($text) . '</span>';
}

function lang_editable_lines(string $token, ?string $fallback = null): string
{
    $text = lang_text($token, $fallback);
    $html = str_replace("\n", '<br>', e($text));
    if (!language_admin_is_logged_in()) {
        return $html;
    }

    $entry = language_entry_by_token($token) ?? [];
    $component = (string) ($entry['component'] ?? 'unknown');
    $role = (string) ($entry['text_role'] ?? 'unknown');

    return '<span class="jok-lang-token" data-lang-token="' . e($token) . '" data-lang-component="' . e($component) . '" data-lang-role="' . e($role) . '" tabindex="0">' . $html . '</span>';
}

function lang_editable_with_strong_prefix(string $token, string $fallback, string $prefix): string
{
    $text = lang_text($token, $fallback);
    if (!language_admin_is_logged_in()) {
        return lang_with_strong_prefix($text, $prefix);
    }

    return '<span class="jok-lang-token jok-lang-token--rich" data-lang-token="' . e($token) . '" tabindex="0">' . lang_with_strong_prefix($text, $prefix) . '</span>';
}

function lang_inline_admin_payload(): string
{
    if (!language_admin_is_logged_in()) {
        return '{}';
    }

    $payload = [
        'csrf' => language_admin_csrf_token(),
        'endpoint' => rel_url('admin-language-save.php'),
        'adminUrl' => rel_url('../admin/'),
    ];
    $json = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    return is_string($json) ? $json : '{}';
}

function lang_json_for_js(array $tokens): string
{
    $values = [];
    foreach ($tokens as $token => $fallback) {
        if (is_int($token)) {
            $token = (string) $fallback;
            $fallback = null;
        }
        $values[$token] = lang_text((string) $token, is_string($fallback) ? $fallback : null);
    }

    $json = json_encode($values, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    return is_string($json) ? $json : '{}';
}
