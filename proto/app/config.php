<?php
declare(strict_types=1);

return [
    'app' => [
        'name' => 'Just One KISS — Just One KISS',
        'environment' => 'local',
        'base_url' => 'http://127.0.0.1:4173',
        'notification_email' => 'hi@justonekiss.org',
        'mail_from' => 'hi@justonekiss.org',
    ],
    'mail' => [
        'smtp_host' => 'justonekiss.org',
        'smtp_port' => 465,
        'smtp_secure' => 'ssl',
        'smtp_username' => 'hi@justonekiss.org',
        'password' => getenv('m9(t,DTHUujMmcym') ?: '',
        'from_email' => 'hi@justonekiss.org',
        'from_name' => 'Just One KISS',
        'phpmailer_src' => __DIR__ . '/../vendor/PHPMailer/PHPMailer/src',
        'phpmailer_autoload' => __DIR__ . '/../vendor/autoload.php',
    ],
    'database' => [
        'enabled' => false,
        'dsn' => 'mysql:host=127.0.0.1;dbname=just_one_kiss;charset=utf8mb4',
        'username' => 'just_one_kiss',
        'password' => 'change-me',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ],
    ],
];
