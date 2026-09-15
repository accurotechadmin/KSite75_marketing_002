<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';

function jok_pdo(): ?PDO
{
    static $pdo = null;
    static $attempted = false;

    if ($attempted) {
        return $pdo;
    }
    $attempted = true;

    $config = jok_config();
    $db = $config['database'] ?? [];
    if (($db['enabled'] ?? false) !== true) {
        return null;
    }

    try {
        $pdo = new PDO(
            (string) ($db['dsn'] ?? ''),
            (string) ($db['username'] ?? ''),
            (string) ($db['password'] ?? ''),
            $db['options'] ?? []
        );
    } catch (Throwable) {
        $pdo = null;
    }

    return $pdo;
}

function store_form_event(string $eventType, string $status, array $payload = []): void
{
    $pdo = jok_pdo();
    if (!$pdo) {
        return;
    }

    $stmt = $pdo->prepare(
        'INSERT INTO site_form_events (site, event_type, status, payload_json, referrer, user_agent, created_at)
         VALUES (:site, :event_type, :status, :payload_json, :referrer, :user_agent, NOW())'
    );
    $stmt->execute([
        ':site' => site_source(),
        ':event_type' => $eventType,
        ':status' => $status,
        ':payload_json' => json_encode($payload, JSON_THROW_ON_ERROR),
        ':referrer' => $_SERVER['HTTP_REFERER'] ?? null,
        ':user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
    ]);
}
