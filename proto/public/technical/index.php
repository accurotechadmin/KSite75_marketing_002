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
render_header(lang_text('pages.technical.meta.title', 'Just One KISS — Technical Overview'), lang_text('pages.technical.meta.description', 'The technical approach is built around QLC+/DMX control, projection, fog during the show, strobe-style lighting during the show, and emergency states managed by one show operator.'));
render_notice($formResult);
?>
<main id="main">
  <?php render_page_section_slot('/technical/', 'before_page'); ?>
  <?php render_page_section_slot('/technical/', 'before_section_01'); ?>
  <section class="subhero section-shell" aria-labelledby="page-title">
    <p class="eyebrow"><?= lang_editable('pages.technical.hero.eyebrow', 'Location-facing baseline') ?></p>
    <h1 id="page-title"><?= lang_editable('pages.technical.hero.title', 'Technical Overview') ?></h1>
    <p class="hero__lede"><?= lang_editable('pages.technical.hero.lede', 'The technical approach is built around QLC+/DMX control, projection, fog during the show, strobe-style lighting during the show, and emergency states managed by one show operator.') ?></p>
    <div class="cta-row">
      <a class="button button--fire" href="<?= e(page_url('/september-26-2026/')) ?>#updates"><?= lang_editable('pages.technical.cta.updates', 'Join the September 26 update list') ?></a>
      <a class="button button--chrome" href="<?= e(page_url('/spectacle/')) ?>"><?= lang_editable('pages.technical.cta.spectacle', 'See the spectacle') ?></a>
      <a class="button button--ghost" href="<?= e(page_url('/contact/')) ?>#contact"><?= lang_editable('pages.technical.cta.contact', 'Contact the show') ?></a>
    </div>
    <?php render_page_image('gear-control-dossier.webp', lang_text('pages.technical.image.1.alt', 'Technical overview hero image.')); ?>
  </section>

  <?php render_page_section_slot('/technical/', 'before_section_02'); ?>
  <section class="section-shell proof-section" aria-labelledby="technical-info-title">
    <h2 id="technical-info-title"><?= lang_editable('pages.technical.info.title', 'Event information') ?></h2>
    <div class="proof-grid">
      <article><h3><?= lang_editable('pages.technical.info.1.title', 'Admission') ?></h3><p><?= lang_editable('pages.technical.info.1.body', 'The event on September 26, 2026 at 7:30 PM is a free show. No ticket is required; RSVP is appreciated.') ?></p></article>
      <article><h3><?= lang_editable('pages.technical.info.2.title', 'Location / parking') ?></h3><p><?= lang_editable('pages.technical.info.2.body', 'Cycle Moore Legacy is at 11075 US 31 South, Interlochen, MI 49643. Parking is outside the gate. Overflow and handicap parking available.') ?></p></article>
      <article><h3><?= lang_editable('pages.technical.info.3.title', 'Fog / strobes') ?></h3><p><?= lang_editable('pages.technical.info.3.body', 'Family-friendly event; loud sound, bright lights, fog, and sequences of flashing lights and patterns may be used.') ?></p></article>
      <article><h3><?= lang_editable('pages.technical.info.4.title', 'Independent tribute') ?></h3><p><?= lang_editable('pages.technical.info.4.body', 'No official affiliation, sponsorship, authorization, or endorsement is claimed.') ?></p></article>
    </div>
  </section>

  <?php render_page_section_slot('/technical/', 'before_section_03'); ?>
  <section class="section-shell spectacle-section" aria-labelledby="technical-baseline-title">
    <h2 id="technical-baseline-title"><?= lang_editable('pages.technical.baseline.title', 'Operating baseline') ?></h2>
    <div class="system-grid">
      <article><h3><?= lang_editable('pages.technical.baseline.1.title', 'QLC+ / DMX') ?></h3><p><?= lang_editable('pages.technical.baseline.1.body', 'Single-universe QLC+/DMX show-control baseline for the pavilion lighting setup.') ?></p></article>
      <article><h3><?= lang_editable('pages.technical.baseline.2.title', 'Location-dependent effects') ?></h3><p><?= lang_editable('pages.technical.baseline.2.body', 'Fog, bright lights, loud sound, and flashing patterns are part of the show environment; sensitive guests should plan accordingly.') ?></p></article>
      <article><h3><?= lang_editable('pages.technical.baseline.3.title', 'Emergency states') ?></h3><p><?= lang_editable('pages.technical.baseline.3.body', 'Blackout, safe work light, projection black or hold, fog off, strobes off, music stop, operator reset, and performer safe look.') ?></p></article>
    </div>
  </section>
  <?php render_page_section_slot('/technical/', 'after_page'); ?>
</main>
<?php render_footer(); ?>
