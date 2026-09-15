<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/view.php';
require_once __DIR__ . '/../app/layer_controls.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    render_header('Site Layer Controls — Use POST', 'Site Layer Controls operation endpoint.');
    echo '<main id="main" class="layer-control-shell"><section class="layer-hero"><p class="eyebrow">Site Layer Controls</p><h1>Use the forms.</h1><p>This endpoint accepts POST operations from the Site Layer Controls MVP.</p><p><a class="button button--fire" href="' . e(page_url('/site-layers/')) . '">Back to Site Layer Controls</a></p></section></main>';
    render_footer();
    exit;
}

[$ok, $messages] = jok_layer_apply_operation($_POST, $_FILES);
$returnTo = jok_layer_safe_return_to((string) ($_POST['return_to'] ?? ''));
$query = http_build_query([
    'saved' => $ok ? '1' : '0',
    'message' => implode(' ', array_map('strval', $messages)),
]);
$separator = str_contains($returnTo, '?') ? '&' : '?';
header('Location: ' . $returnTo . $separator . $query . '#mvp-operations', true, 303);
