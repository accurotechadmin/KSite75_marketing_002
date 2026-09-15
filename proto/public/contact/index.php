<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/view.php';
require_once __DIR__ . '/../../app/page_sections.php';

$formResult = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formType = post_string('form_type', 40);
    if ($formType === 'lead') {
        require_once __DIR__ . '/../../app/forms/lead_submit.php';
        $formResult = handle_lead_submit();
    } elseif ($formType === 'inquiry') {
        require_once __DIR__ . '/../../app/forms/inquiry_submit.php';
        $formResult = handle_inquiry_submit();
    } else {
        $formResult = ['ok' => false, 'message' => lang_text('landing.form.invalid_route_message', 'Choose a valid form route.')];
    }
}
$csrf = csrf_token();
render_header(lang_text('pages.contact.meta.title', 'Just One KISS — Contact'), lang_text('pages.contact.meta.description', 'Contact Just One KISS for free-show updates, Facebook/media sharing, accessibility and safety questions, venue/location questions, and general show routing.'));
render_notice($formResult);
$email = lang_text('pages.contact.email.value', 'justonekiss@example.com');
$phone = lang_text('pages.contact.phone.value', '231-276-9091');
$facebook = lang_text('pages.contact.facebook.url', '#contact');
?>
<main id="main">
  <?php render_page_section_slot('/contact/', 'before_page'); ?>
  <?php render_page_section_slot('/contact/', 'before_section_01'); ?>
  <section class="subhero section-shell" aria-labelledby="page-title"><p class="eyebrow"><?= lang_editable('pages.contact.hero.eyebrow', 'Route the question') ?></p><h1 id="page-title"><?= lang_editable('pages.contact.hero.title', 'Contact') ?></h1><p class="hero__lede"><?= lang_editable('pages.contact.hero.lede', 'Use the form for show questions, accessibility and safety notes, technical/location routing, press, Facebook sharing, or anything that needs a real human answer before the September 26 fire.') ?></p><div class="cta-row"><a class="button button--fire" href="#contact"><?= lang_editable('pages.contact.cta.form', 'Use the contact form') ?></a><a class="button button--chrome" href="mailto:<?= e($email) ?>"><?= lang_editable('pages.contact.cta.email', 'Email the show') ?></a></div><?php render_page_image('gear-control-dossier.webp', lang_text('pages.contact.image.1.alt', 'Contact hero image.')); ?></section>
  <?php render_page_section_slot('/contact/', 'before_section_02'); ?>
  <section class="section-shell proof-section" aria-labelledby="direct-title"><p class="eyebrow"><?= lang_editable('pages.contact.direct.eyebrow', 'Direct lines') ?></p><h2 id="direct-title"><?= lang_editable('pages.contact.direct.title', 'Send the signal.') ?></h2><div class="proof-grid"><article><span class="proof-badge"><?= lang_editable('pages.contact.card.1.badge', '01') ?></span><h3><?= lang_editable('pages.contact.card.1.title', 'Email') ?></h3><p><a href="mailto:<?= e($email) ?>"><?= e($email) ?></a></p><p><?= lang_editable('pages.contact.card.1.body', 'Use the contact form below for routed show questions until the final public inbox is approved.') ?></p></article><article><span class="proof-badge"><?= lang_editable('pages.contact.card.2.badge', '02') ?></span><h3><?= lang_editable('pages.contact.card.2.title', 'Phone') ?></h3><p><a href="tel:+12312769091"><?= e($phone) ?></a></p><p><?= lang_editable('pages.contact.card.2.body', 'Current public phone number associated with Cycle Moore Legacy / event location details.') ?></p></article><article><span class="proof-badge"><?= lang_editable('pages.contact.card.3.badge', '03') ?></span><h3><?= lang_editable('pages.contact.card.3.title', 'Facebook') ?></h3><p><a href="<?= e($facebook) ?>"><?= lang_editable('pages.contact.facebook.label', 'Facebook / social updates') ?></a></p><p><?= lang_editable('pages.contact.card.3.body', 'Use the contact form for Facebook-event, social-sharing, or fan-media routing until the final event link is approved.') ?></p></article><article><span class="proof-badge"><?= lang_editable('pages.contact.card.4.badge', '04') ?></span><h3><?= lang_editable('pages.contact.card.4.title', 'Best route') ?></h3><p><?= lang_editable('pages.contact.card.4.body', 'Use the form below for anything that needs routing: press, access, safety, technical, location, fan media, or general show questions.') ?></p></article></div></section>
  <?php render_page_section_slot('/contact/', 'before_section_03'); ?>
  <section id="updates" class="section-shell form-section" aria-labelledby="updates-title"><div><p class="eyebrow"><?= lang_editable('pages.contact.updates.eyebrow', 'Fan updates') ?></p><h2 id="updates-title"><?= lang_editable('pages.contact.updates.title', 'Join the September 26 update list.') ?></h2><p><?= lang_editable('pages.contact.updates.body', 'For attendee updates, use the update list: arrival notes, schedule reminders, safety/access updates, Facebook link updates, and photo/video sharing instructions.') ?></p></div><?php render_lead_form($csrf); ?><?php render_page_image('gear-control-dossier.webp', lang_text('pages.contact.image.2.alt', 'Contact update-list image.')); ?></section>
  <?php render_page_section_slot('/contact/', 'before_section_04'); ?>
  <section id="contact" class="section-shell contact-section" aria-labelledby="contact-title"><div><p class="eyebrow"><?= lang_editable('pages.contact.form.eyebrow', 'Contact the show') ?></p><h2 id="contact-title"><?= lang_editable('pages.contact.form.title', 'Ask before the amps wake up.') ?></h2><p><?= lang_editable('pages.contact.form.body', 'Use this form for Facebook information, media sharing, technical, accessibility, safety, location, press, or general questions. Database storage and notifications still require deployment approval before public launch.') ?></p><div class="safety-callout"><?= lang_editable_with_strong_prefix('pages.contact.form.callout', 'Privacy note: submit only what is needed to route the inquiry. Final privacy and notification workflow approval remains a launch blocker.', 'Privacy note:') ?></div></div><?php render_inquiry_form($csrf); ?><?php render_page_image('press-performer-portrait.webp', lang_text('pages.contact.image.3.alt', 'Contact form portrait image.')); ?></section>
  <?php render_page_section_slot('/contact/', 'after_page'); ?>
</main>
<?php render_footer(); ?>
