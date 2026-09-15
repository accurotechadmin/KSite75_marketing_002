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
render_header(lang_text('pages.vault.meta.title', 'Just One KISS — Fan Vault'), lang_text('pages.vault.meta.description', 'This vault is for approved images, original media, fan photos/videos, costume details, road-case textures, and event updates. No official memorabilia or archive status is implied; shareable fan media is encouraged.'));
render_notice($formResult);
?>
<main id="main">
  <?php render_page_section_slot('/vault/', 'before_page'); ?>
  <?php render_page_section_slot('/vault/', 'before_section_01'); ?>
  <section class="subhero section-shell" aria-labelledby="page-title">
    <p class="eyebrow"><?= lang_editable('pages.vault.hero.eyebrow', 'Road-case relic energy') ?></p>
    <h1 id="page-title"><?= lang_editable('pages.vault.hero.title', 'Fan Vault') ?></h1>
    <p class="hero__lede"><?= lang_editable('pages.vault.hero.lede', 'This vault is for approved images, original media, fan photos/videos, costume details, road-case textures, and event updates. No official memorabilia or archive status is implied; shareable fan media is encouraged.') ?></p>
    <div class="cta-row">
      <a class="button button--fire" href="<?= e(page_url('/september-26-2026/')) ?>#updates"><?= lang_editable('pages.vault.cta.updates', 'Join the September 26 update list') ?></a>
      <a class="button button--chrome" href="<?= e(page_url('/spectacle/')) ?>"><?= lang_editable('pages.vault.cta.spectacle', 'See the spectacle') ?></a>
      <a class="button button--ghost" href="<?= e(page_url('/contact/')) ?>#contact"><?= lang_editable('pages.vault.cta.contact', 'Contact the show') ?></a>
    </div>
    <?php render_page_image('road-case-vault-bg.webp', lang_text('pages.vault.image.1.alt', 'Fan Vault hero image.')); ?>
  </section>

  <?php render_page_section_slot('/vault/', 'before_section_02'); ?>
  <section class="section-shell proof-section" aria-labelledby="vault-info-title">
    <h2 id="vault-info-title"><?= lang_editable('pages.vault.info.title', 'Event information') ?></h2>
    <div class="proof-grid">
      <article><h3><?= lang_editable('pages.vault.info.1.title', 'Admission') ?></h3><p><?= lang_editable('pages.vault.info.1.body', 'The event on September 26, 2026 at 7:30 PM is a free show. No ticket is required; RSVP is appreciated.') ?></p></article>
      <article><h3><?= lang_editable('pages.vault.info.2.title', 'Location / parking') ?></h3><p><?= lang_editable('pages.vault.info.2.body', 'Cycle Moore Legacy is at 11075 US 31 South, Interlochen, MI 49643. Parking is outside the gate. Overflow and handicap parking available.') ?></p></article>
      <article><h3><?= lang_editable('pages.vault.info.3.title', 'Fog / strobes') ?></h3><p><?= lang_editable('pages.vault.info.3.body', 'Family-friendly event; loud sound, bright lights, fog, and sequences of flashing lights and patterns may be used.') ?></p></article>
      <article><h3><?= lang_editable('pages.vault.info.4.title', 'Independent tribute') ?></h3><p><?= lang_editable('pages.vault.info.4.body', 'No official affiliation, sponsorship, authorization, or endorsement is claimed.') ?></p></article>
    </div>
  </section>

  <?php render_page_section_slot('/vault/', 'before_section_03'); ?>
  <section class="section-shell image-inventory" aria-labelledby="media-plan-title">
    <h2 id="media-plan-title"><?= lang_editable('pages.vault.media.title', 'Approved media plan') ?></h2>
    <p><?= lang_editable('pages.vault.media.body', 'Road-case textures, armor details, and original gallery proof for the show world.') ?></p>
    <?php render_media_grid([
        'road-case-vault-bg.webp' => lang_text('pages.vault.media.road_case.label', 'Road-case vault texture'),
        'costume-chrome-detail.webp' => lang_text('pages.vault.media.costume.label', 'Costume chrome detail'),
        'press-performer-portrait.webp' => lang_text('pages.vault.media.portrait.label', 'Press performer portrait'),
    ]); ?>
  </section>
  <?php render_page_section_slot('/vault/', 'after_page'); ?>
</main>
<?php render_footer(); ?>
