<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

define('PROJECT_ROOT', dirname(__DIR__));
define('DATA_ROOT', PROJECT_ROOT . '/data');
define('PUBLIC_ROOT', PROJECT_ROOT . '/public');
define('UPLOAD_ROOT', PUBLIC_ROOT . '/uploads');

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/JsonRepository.php';
require_once __DIR__ . '/FixtureService.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(24));
}

function repository(): JsonRepository
{
    static $repository;
    if (!$repository) {
        $repository = new JsonRepository(DATA_ROOT);
    }
    return $repository;
}

function fixture_service(): FixtureService
{
    static $service;
    if (!$service) {
        $service = new FixtureService(repository());
    }
    return $service;
}
