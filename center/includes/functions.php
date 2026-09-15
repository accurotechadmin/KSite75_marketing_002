<?php
/**
 * Purpose: This helper library provides the safe utility functions that every `/center` page will share, keeping escaping, routing, rendering, badges, formatting, and placeholder notices consistent across the owner command center.
 * Components to populate: HTML escaping, route builders, active-nav checks, partial rendering, status pill helpers, source-link helpers, date/freshness formatting, empty-state helpers, filter helpers, and accessibility label helpers.
 */
function center_e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function center_url(string $page, array $params = []): string
{
    return '?' . http_build_query(array_merge(['page' => $page], $params));
}

function center_current_page(array $navigation): string
{
    $page = $_GET['page'] ?? CENTER_DEFAULT_PAGE;
    return isset($navigation[$page]) ? $page : CENTER_DEFAULT_PAGE;
}

function center_render(string $relativePath, array $vars): void
{
    extract($vars, EXTR_SKIP);
    require __DIR__ . '/../' . $relativePath;
}
