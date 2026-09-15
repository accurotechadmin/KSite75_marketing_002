<?php
/**
 * Purpose: This bootstrap file will initialize the centralized owner app by loading configuration, navigation, helper functions, settings, SSOT sources, and prototype guardrails before any page renders.
 * Components to populate: constants, config loading, helper includes, manifest discovery, domain SSOT discovery, runtime overlay loading, session/auth placeholder, error handling, and shared module context construction.
 */
const CENTER_DEFAULT_PAGE = 'dashboard';

require __DIR__ . '/functions.php';
require __DIR__ . '/settings.php';
require __DIR__ . '/ssot.php';
require __DIR__ . '/records.php';

function center_config(): array
{
    static $config = null;
    if ($config === null) {
        $config = require __DIR__ . '/../config/app.php';
    }
    return $config;
}

function center_navigation(): array
{
    static $navigation = null;
    if ($navigation === null) {
        $navigation = require __DIR__ . '/../data/navigation.php';
    }
    return $navigation;
}
