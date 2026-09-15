<?php
declare(strict_types=1);

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/form_storage.php';

function jok_mail_recipient(): string
{
    $config = jok_config();
    $email = (string) ($config['app']['notification_email'] ?? 'emaildustin@usa.com');
    return is_valid_email($email) ? $email : 'emaildustin@usa.com';
}

function jok_mail_from(): string
{
    $config = jok_config();
    $email = (string) ($config['app']['mail_from'] ?? 'no-reply@justonekiss.local');
    return is_valid_email($email) ? $email : 'no-reply@justonekiss.local';
}

function jok_record_mail_attempt(string $to, string $subject, bool $accepted, ?string $replyTo = null): void
{
    if ($accepted) {
        return;
    }

    $message = 'PHP mail() returned false. Configure a working server mail transport or SMTP relay.';
    error_log('[Just One KISS mail failure] ' . $message . ' to=' . $to . ' subject=' . $subject);

    jok_store_json_record('mail-failures', [
        'id' => bin2hex(random_bytes(12)),
        'to' => $to,
        'subject' => $subject,
        'reply_to' => $replyTo,
        'accepted_by_transport' => false,
        'message' => $message,
        'created_at' => gmdate('c'),
    ]);
}

function jok_send_email(string $to, string $subject, string $body, ?string $replyTo = null): bool
{
    if (!is_valid_email($to)) {
        jok_record_mail_attempt($to, $subject, false, $replyTo);
        return false;
    }

    $from = jok_mail_from();
    $headers = [
        'From: Just One KISS <' . $from . '>',
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'X-Mailer: PHP/' . PHP_VERSION,
    ];

    if ($replyTo !== null && is_valid_email($replyTo)) {
        $headers[] = 'Reply-To: ' . $replyTo;
    }

    $accepted = @mail($to, $subject, $body, implode("\r\n", $headers));
    jok_record_mail_attempt($to, $subject, $accepted, $replyTo);

    return $accepted;
}

function queue_notification(string $subject, array $payload): bool
{
    $lines = [
        'A new Just One KISS update-list signup was stored on the server.',
        '',
    ];

    foreach ($payload as $key => $value) {
        if (is_array($value)) {
            $value = implode(', ', array_map('strval', $value));
        }
        $lines[] = ucwords(str_replace('_', ' ', (string) $key)) . ': ' . (string) $value;
    }

    return jok_send_email(jok_mail_recipient(), $subject, implode("\n", $lines), (string) ($payload['email'] ?? ''));
}

function send_lead_confirmation_email(string $email, array $tags): bool
{
    $body = "You are signed up for the Just One KISS September 26 update list.\n\n"
        . "We will use this list for confirmed event updates, arrival notes, camping and parking reminders, safety/access notes, Facebook/event-link updates, and approved photo/video sharing instructions.\n\n"
        . "Selected update topics: " . implode(', ', $tags) . "\n\n"
        . "Just One KISS is an independent theatrical tribute presentation. No official affiliation, sponsorship, authorization, endorsement, ownership, or approval is claimed.";

    return jok_send_email($email, 'You are on the Just One KISS update list', $body, jok_mail_recipient());
}
