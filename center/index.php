<?php
/**
 * Purpose: This front controller will become the centralized owner-management entry point, routing every private command-center request through shared bootstrap, settings, SSOT loading, and guarded module rendering without turning page templates into canonical data sources.
 * Components to populate: request normalization, page registry lookup, authentication gate placeholder, settings manifest loading, module controller dispatch, shared shell rendering, error pages, audit hooks, and future adapter injection for database/API/CMS backends.
 */
require __DIR__ . '/includes/bootstrap.php';

$navigation = center_navigation();
$page = center_current_page($navigation);
$module = $navigation[$page] ?? $navigation[CENTER_DEFAULT_PAGE];

center_render('partials/header.php', ['module' => $module, 'navigation' => $navigation]);
center_render('partials/sidebar.php', ['module' => $module, 'navigation' => $navigation]);
center_render('partials/topbar.php', ['module' => $module]);
center_render('pages/' . $module['template'], ['module' => $module]);
center_render('partials/footer.php', []);
