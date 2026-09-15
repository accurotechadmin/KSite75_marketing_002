<?php
/**
 * Purpose: This component library holds reusable PHP renderers for cards, tables, pills, empty states, source links, warning strips, detail panels, and form scaffolds so modules stay consistent and data-first.
 * Components to populate: readiness cards, metric cards, record tables, status pills, rights/safety badges, Timeline/GEN chips, source citation links, disclosure panels, review queues, form groups, and disabled/prototype action buttons.
 */
function center_placeholder_panel(string $title, array $items): void
{
    echo '<section class="panel"><h2>' . center_e($title) . '</h2><ul class="check-list">';
    foreach ($items as $item) {
        echo '<li>' . center_e($item) . '</li>';
    }
    echo '</ul></section>';
}

function center_kv_table(array $rows): void
{
    echo '<div class="panel"><table class="center-table"><tbody>';
    foreach ($rows as $label => $value) {
        $display = is_array($value) ? implode(', ', $value) : (string) $value;
        echo '<tr><th>' . center_e((string) $label) . '</th><td>' . center_e($display) . '</td></tr>';
    }
    echo '</tbody></table></div>';
}

function center_value_text(mixed $value): string
{
    if (is_array($value)) {
        if (array_is_list($value)) { return implode(', ', array_map('strval', $value)); }
        return implode('; ', array_map(fn($k, $v) => $k . ': ' . (is_array($v) ? center_value_text($v) : (string) $v), array_keys($value), $value));
    }
    return (string) $value;
}

function center_chip(string $value, string $class = ''): string
{
    return '<span class="pill ' . center_e($class) . '">' . center_e($value) . '</span>';
}

function center_chip_row(array $values, string $class = ''): string
{
    if (!$values) { return center_chip('none', 'muted'); }
    return implode(' ', array_map(fn($v) => center_chip((string) $v, $class), $values));
}

function center_card_grid(array $cards, array $fields): void
{
    echo '<section class="card-grid">';
    foreach ($cards as $card) {
        echo '<article class="panel card">';
        echo '<p class="eyebrow">' . center_e($card['record_id'] ?? $card['source_id'] ?? $card['finding_id'] ?? 'GEN') . '</p>';
        echo '<h3>' . center_e($card['title'] ?? $card['question'] ?? $card['check'] ?? 'Untitled placeholder') . '</h3>';
        if (isset($card['timeline_moment_id_or_gen'])) { echo '<p>' . center_chip('Timeline: ' . (string) $card['timeline_moment_id_or_gen'], 'timeline') . '</p>'; }
        if (isset($card['disclosure_tier'])) { echo '<p>' . center_chip('Disclosure: ' . (string) $card['disclosure_tier'], 'disclosure') . '</p>'; }
        foreach ($fields as $field) {
            if (isset($card[$field])) {
                echo '<p><strong>' . center_e(str_replace('_', ' ', $field)) . ':</strong> ' . center_e(center_value_text($card[$field])) . '</p>';
            }
        }
        if (isset($card['open_inquiry_ids']) && is_array($card['open_inquiry_ids'])) { echo '<p><strong>Inquiry chips:</strong> ' . center_chip_row($card['open_inquiry_ids'], 'inquiry') . '</p>'; }
        echo '</article>';
    }
    echo '</section>';
}

function center_disabled_control_mockups(string $title, array $controls): void
{
    echo '<section class="panel"><p class="eyebrow">Disabled rendered controls</p><h2>' . center_e($title) . '</h2><div class="control-grid">';
    foreach ($controls as $control) {
        echo '<article class="disabled-control" aria-disabled="true">';
        echo '<div><p class="eyebrow">' . center_e((string) ($control['record_id'] ?? 'CONTROL')) . '</p><h3>' . center_e((string) ($control['title'] ?? 'Disabled control')) . '</h3></div>';
        echo '<label>' . center_e((string) ($control['label'] ?? 'Draft value')) . '<input type="text" value="' . center_e((string) ($control['value'] ?? 'Read-only preview value')) . '" disabled></label>';
        echo '<label>' . center_e((string) ($control['select_label'] ?? 'Disclosure / gate preset')) . '<select disabled>';
        foreach (($control['options'] ?? ['read-only']) as $option) { echo '<option>' . center_e((string) $option) . '</option>'; }
        echo '</select></label>';
        echo '<div class="control-actions"><button type="button" disabled>Preview only</button><button type="button" disabled>Attach evidence</button><button type="button" disabled>Rollback plan</button><button type="button" disabled>Publish blocked</button></div>';
        echo '<ul class="control-meta">';
        foreach (['preview','rollback','audit','release_gate','source_files','disclosure_boundary'] as $field) {
            if (isset($control[$field])) { echo '<li><strong>' . center_e(str_replace('_', ' ', $field)) . ':</strong> ' . center_e(center_value_text($control[$field])) . '</li>'; }
        }
        echo '</ul></article>';
    }
    echo '</div></section>';
}

function center_status_pill(string $value): void { echo center_chip($value); }

function center_section_header(string $eyebrow, string $title, string $summary): void
{
    echo '<section class="hero-panel"><p class="eyebrow">' . center_e($eyebrow) . '</p><h1>' . center_e($title) . '</h1><p>' . center_e($summary) . '</p></section>';
}

function center_phase_badge(string $phase): string { return str_replace('-', ' ', $phase); }

function center_disabled_checklist(string $title, array $items): void
{
    echo '<section class="panel"><h2>' . center_e($title) . '</h2><div class="disabled-actions">';
    foreach ($items as $item) { echo '<label><input type="checkbox" disabled> ' . center_e($item) . '</label>'; }
    echo '</div></section>';
}
