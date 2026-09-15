<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../csrf.php';
require_once __DIR__ . '/../mailer.php';

function handle_inquiry_submit(): array
{
    $allowedCategories = ['general', 'press', 'venue_availability', 'technical', 'accessibility'];
    $errors = [];

    if (!verify_csrf($_POST['csrf_token'] ?? null)) {
        $errors[] = 'The form session expired. Reload the page and try again.';
    }
    if (post_string('website', 200) !== '') {
        $errors[] = 'Submission rejected.';
    }

    $email = post_string('inquiry_email', 254);
    $name = post_string('inquiry_name', 120);
    $organization = post_string('organization', 160);
    $eventDate = post_string('event_date', 40);
    $cityState = post_string('city_state', 140);
    $capacity = post_string('capacity', 40);
    $budget = post_string('budget', 80);
    $category = post_string('inquiry_category', 40);
    $technicalConstraints = post_string('technical_constraints', 1200);
    $facebookContact = post_string('facebook_contact', 300);
    $message = post_string('message', 2500);
    $consent = isset($_POST['consent']);

    if (!is_valid_email($email)) {
        $errors[] = 'Enter a valid contact/press email address.';
    }
    if ($organization === '') {
        $errors[] = 'Add a location, name, organization, or press outlet.';
    }
    if (!in_array($category, $allowedCategories, true)) {
        $errors[] = 'Choose a valid inquiry type.';
    }
    if (strlen($message) < 10) {
        $errors[] = 'Add a short message so the show team can route the inquiry.';
    }
    if (!$consent) {
        $errors[] = 'Confirm consent to be contacted about this inquiry.';
    }

    if ($errors !== []) {
        store_form_event('inquiry_submit', 'validation_failed', ['errors' => $errors]);
        return ['ok' => false, 'message' => implode(' ', $errors)];
    }

    $storedCategory = $category === 'technical' ? 'general' : $category;
    $pdo = jok_pdo();
    if ($pdo) {
        $stmt = $pdo->prepare(
            'INSERT INTO site_inquiries
             (site, category, email, name, organization, event_date, city_state, capacity, budget, facebook_contact, technical_constraints, message, consent_given, referrer, created_at)
             VALUES
             (:site, :category, :email, :name, :organization, :event_date, :city_state, :capacity, :budget, :facebook_contact, :technical_constraints, :message, :consent_given, :referrer, NOW())'
        );
        $stmt->execute([
            ':site' => site_source(),
            ':category' => $storedCategory,
            ':email' => $email,
            ':name' => $name !== '' ? $name : null,
            ':organization' => $organization,
            ':event_date' => $eventDate !== '' ? $eventDate : null,
            ':city_state' => $cityState !== '' ? $cityState : null,
            ':capacity' => $capacity !== '' ? $capacity : null,
            ':budget' => $budget !== '' ? $budget : null,
            ':facebook_contact' => $facebookContact !== '' ? $facebookContact : null,
            ':technical_constraints' => $technicalConstraints !== '' ? $technicalConstraints : null,
            ':message' => $message,
            ':consent_given' => 1,
            ':referrer' => $_SERVER['HTTP_REFERER'] ?? null,
        ]);
        store_form_event('inquiry_submit', 'stored', ['email' => $email, 'category' => $category, 'organization' => $organization]);
        queue_notification('New Just One KISS inquiry', compact('email', 'name', 'organization', 'eventDate', 'cityState', 'capacity', 'budget', 'facebookContact', 'category', 'technicalConstraints', 'message'));
        return ['ok' => true, 'message' => 'Inquiry received. The Just One KISS team can follow up using the contact details provided.'];
    }

    store_form_event('inquiry_submit', 'local_fallback', ['email' => $email, 'category' => $category, 'organization' => $organization]);
    return ['ok' => true, 'message' => local_fallback_note('show contact inquiry')];
}
