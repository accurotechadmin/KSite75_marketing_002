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
render_header(lang_text('pages.video.meta.title', 'Just One KISS — Trailer and Clips'), lang_text('pages.video.meta.description', 'Photos and videos are allowed and encouraged; this page will carry approved original clips and fan-sharing instructions. Official recordings, album art, logos, and protected media are not used here.'));
render_notice($formResult);
?>
<main id="main">
  <?php render_page_section_slot('/video/', 'before_page'); ?>
  <?php render_page_section_slot('/video/', 'before_section_01'); ?>
  <section class="subhero section-shell" aria-labelledby="page-title">
    <p class="eyebrow"><?= lang_editable('pages.video.hero.eyebrow', 'Original media only') ?></p>
    <h1 id="page-title"><?= lang_editable('pages.video.hero.title', 'Trailer and Clips') ?></h1>
    <p class="hero__lede"><?= lang_editable('pages.video.hero.lede', 'Photos and videos are allowed and encouraged; this page will carry approved original clips and fan-sharing instructions. Official recordings, album art, logos, and protected media are not used here.') ?></p>
    <div class="cta-row">
      <a class="button button--fire" href="<?= e(page_url('/september-26-2026/')) ?>#updates"><?= lang_editable('pages.video.cta.updates', 'Join the September 26 update list') ?></a>
      <a class="button button--chrome" href="<?= e(page_url('/spectacle/')) ?>"><?= lang_editable('pages.video.cta.spectacle', 'See the spectacle') ?></a>
      <a class="button button--ghost" href="<?= e(page_url('/contact/')) ?>#contact"><?= lang_editable('pages.video.cta.contact', 'Contact the show') ?></a>
    </div>
    <?php render_page_image('trailer-poster-stage-portal.webp', lang_text('pages.video.image.1.alt', 'Trailer/clips hero image.')); ?>
  </section>

  <?php render_page_section_slot('/video/', 'before_section_02'); ?>
  <section class="section-shell proof-section" aria-labelledby="video-info-title">
    <h2 id="video-info-title"><?= lang_editable('pages.video.info.title', 'Event information') ?></h2>
    <div class="proof-grid">
      <article><h3><?= lang_editable('pages.video.info.1.title', 'Admission') ?></h3><p><?= lang_editable('pages.video.info.1.body', 'The event on September 26, 2026 at 7:30 PM is a free show. No ticket is required; RSVP is appreciated.') ?></p></article>
      <article><h3><?= lang_editable('pages.video.info.2.title', 'Location / parking') ?></h3><p><?= lang_editable('pages.video.info.2.body', 'Cycle Moore Legacy is at 11075 US 31 South, Interlochen, MI 49643. Parking is outside the gate. Overflow and handicap parking available.') ?></p></article>
      <article><h3><?= lang_editable('pages.video.info.3.title', 'Fog / strobes') ?></h3><p><?= lang_editable('pages.video.info.3.body', 'Family-friendly event; loud sound, bright lights, fog, and sequences of flashing lights and patterns may be used.') ?></p></article>
      <article><h3><?= lang_editable('pages.video.info.4.title', 'Independent tribute') ?></h3><p><?= lang_editable('pages.video.info.4.body', 'No official affiliation, sponsorship, authorization, or endorsement is claimed.') ?></p></article>
    </div>
  </section>

  <?php render_page_section_slot('/video/', 'before_section_03'); ?>
  <section class="section-shell image-inventory" aria-labelledby="video-media-title">
    <h2 id="video-media-title"><?= lang_editable('pages.video.media.title', 'Approved media plan') ?></h2>
    <p><?= lang_editable('pages.video.media.body', 'Trailer art and original clip proof without borrowed official assets.') ?></p>
    <?php render_media_grid([
        'trailer-poster-stage-portal.webp' => lang_text('pages.video.media.poster.label', 'Trailer poster stage portal'),
    ]); ?>
  </section>
  <?php render_page_section_slot('/video/', 'after_page'); ?>
</main>
<?php render_footer(); ?>
