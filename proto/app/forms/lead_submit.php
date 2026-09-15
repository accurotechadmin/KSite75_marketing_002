<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../csrf.php';
require_once __DIR__ . '/../mailer.php';
require_once __DIR__ . '/../form_storage.php';

function handle_lead_submit(): array
{
    $allowedTags = ['event_updates', 'directions_info', 'media_drops', 'contact_info', 'collector_relic_updates', 'press', 'accessibility'];
    $errors = [];

    if (!verify_csrf($_POST['csrf_token'] ?? null)) {
        $errors[] = 'The form session expired. Reload the page and try again.';
    }

    if (post_string('website', 200) !== '') {
        $errors[] = 'Submission rejected.';
    }

    $email = post_string('email', 254);
    $name = post_string('name', 120);
    $cityZip = post_string('city_zip', 120);
    $tags = post_tags('interest_tags', $allowedTags);
    $consent = isset($_POST['consent']);

    if (!is_valid_email($email)) {
        $errors[] = 'Enter a valid email address.';
    }
    if (!$consent) {
        $errors[] = 'Confirm consent to receive Just One KISS updates.';
    }
    if ($tags === []) {
        $errors[] = 'Choose at least one signal type.';
    }

    if ($errors !== []) {
        store_form_event('lead_submit', 'validation_failed', ['errors' => $errors]);
        return ['ok' => false, 'message' => implode(' ', $errors)];
    }

    $record = [
        'id' => bin2hex(random_bytes(12)),
        'site' => site_source(),
        'email' => $email,
        'name' => $name !== '' ? $name : null,
        'city_zip' => $cityZip !== '' ? $cityZip : null,
        'interest_tags' => $tags,
        'consent_given' => true,
        'consent_source' => 'Just One KISS free show update form',
        'referrer' => $_SERVER['HTTP_REFERER'] ?? null,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
        'created_at' => gmdate('c'),
    ];

    [$jsonStored, $jsonFile, $jsonError] = jok_store_json_record('leads', $record);
    if (!$jsonStored) {
        store_form_event('lead_submit', 'json_storage_failed', ['email' => $email, 'tags' => $tags, 'error' => $jsonError]);
        return ['ok' => false, 'message' => 'We could not store your update-list request on the server. Please try again.'];
    }

    $pdo = jok_pdo();
    if ($pdo) {
        $stmt = $pdo->prepare(
            'INSERT INTO site_leads (site, email, name, city_zip, interest_tags_json, consent_given, consent_source, referrer, created_at)
             VALUES (:site, :email, :name, :city_zip, :interest_tags_json, :consent_given, :consent_source, :referrer, NOW())'
        );
        $stmt->execute([
            ':site' => site_source(),
            ':email' => $email,
            ':name' => $name !== '' ? $name : null,
            ':city_zip' => $cityZip !== '' ? $cityZip : null,
            ':interest_tags_json' => json_encode($tags, JSON_THROW_ON_ERROR),
            ':consent_given' => 1,
            ':consent_source' => 'Just One KISS free show update form',
            ':referrer' => $_SERVER['HTTP_REFERER'] ?? null,
        ]);
    }

    $noticeSent = queue_notification('New Just One KISS update-list signup', [
        'email' => $email,
        'name' => $name,
        'city_zip' => $cityZip,
        'tags' => $tags,
        'json_file' => $jsonFile,
        'created_at' => $record['created_at'],
    ]);
    $confirmationSent = send_lead_confirmation_email($email, $tags);

    store_form_event('lead_submit', 'stored_json', [
        'email' => $email,
        'tags' => $tags,
        'json_file' => $jsonFile,
        'notice_sent' => $noticeSent,
        'confirmation_sent' => $confirmationSent,
    ]);

    if (!$noticeSent || !$confirmationSent) {
        return ['ok' => false, 'message' => 'Your signup was stored, but this server could not send one or more confirmation emails. Please contact the show so we can fix mail delivery.'];
    }

    return ['ok' => true, 'message' => 'Signal received, stored on the server, and a confirmation email has been sent.'];
}
