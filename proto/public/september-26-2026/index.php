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
render_header(lang_text('pages.free_show.meta.title', 'Just One KISS — September 26, 2026 at 7:30 PM Free Show'), lang_text('pages.free_show.meta.description', 'Free show on September 26, 2026 at 7:30 PM at Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643. No ticket is required; RSVP is appreciated. Camping is separate.'));
render_notice($formResult);
?>
<main id="main">
  <?php render_page_section_slot('/september-26-2026/', 'before_page'); ?>
  <?php render_page_section_slot('/september-26-2026/', 'before_section_01'); ?>
  <section class="subhero section-shell" aria-labelledby="page-title">
    <p class="eyebrow"><?= lang_editable('pages.free_show.hero.eyebrow', 'Free show · September 26, 2026 at 7:30 PM · Cycle Moore Legacy') ?></p>
    <h1 id="page-title"><?= lang_editable('pages.free_show.hero.title', 'September 26, 2026 at 7:30 PM Free Show') ?></h1>
    <p class="hero__lede"><?= lang_editable('pages.free_show.hero.lede', 'What the landing page says is the truth: admission is free, the address is real, the show is built to hit hard, and the details that can change will be posted here before the fire starts.') ?></p>
    <div class="hero-facts" aria-label="<?= e(lang_text('pages.free_show.facts.aria', 'Free show facts')) ?>">
      <span><?= lang_editable('pages.free_show.fact.1', 'Free admission') ?></span><span><?= lang_editable('pages.free_show.fact.2', 'No ticket required') ?></span><span><?= lang_editable('pages.free_show.fact.3', 'RSVP appreciated') ?></span><span><?= lang_editable('pages.free_show.fact.4', 'Camping separate') ?></span>
    </div>
    <div class="cta-row"><a class="button button--fire" href="#updates"><?= lang_editable('pages.free_show.cta.updates', 'Join the September 26 update list') ?></a><a class="button button--chrome" href="<?= e(page_url('/directions/')) ?>"><?= lang_editable('pages.free_show.cta.directions', 'Get directions') ?></a><a class="button button--ghost" href="<?= e(page_url('/faq-disclaimer/')) ?>"><?= lang_editable('pages.free_show.cta.faq', 'Read FAQ') ?></a></div>
    <?php render_page_image('hero-stage-portal.webp', lang_text('pages.september_26_2026.image.1.alt', 'Free show hero image.')); ?>
  </section>

  <?php render_page_section_slot('/september-26-2026/', 'before_section_02'); ?>
  <section class="section-shell proof-section" aria-labelledby="known-title">
    <p class="eyebrow"><?= lang_editable('pages.free_show.known.eyebrow', 'Known now') ?></p><h2 id="known-title"><?= lang_editable('pages.free_show.known.title', 'The signal is clear.') ?></h2>
    <div class="proof-grid">
      <article><span class="proof-badge"><?= lang_editable('pages.free_show.card.1.badge', '01') ?></span><h3><?= lang_editable('pages.free_show.card.1.title', 'Free show') ?></h3><p><?= lang_editable('pages.free_show.card.1.body', 'The Just One KISS show on September 26, 2026 at 7:30 PM is free. No ticket is required; RSVP is appreciated so updates can find you before show day.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.free_show.card.2.badge', '02') ?></span><h3><?= lang_editable('pages.free_show.card.2.title', 'Cycle Moore Legacy') ?></h3><p><?= lang_editable('pages.free_show.card.2.body', 'The destination is Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643 — a campground-and-pavilion setting on US 31.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.free_show.card.3.badge', '03') ?></span><h3><?= lang_editable('pages.free_show.card.3.title', 'Camping note') ?></h3><p><?= lang_editable('pages.free_show.card.3.body') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.free_show.card.4.badge', '04') ?></span><h3><?= lang_editable('pages.free_show.card.4.title', 'Parking') ?></h3><p><?= lang_editable('pages.free_show.card.4.body', 'Parking is outside the gate. Overflow and handicap parking available.') ?></p></article>
    </div>
  </section>

  <?php render_page_section_slot('/september-26-2026/', 'before_section_03'); ?>
  <section class="section-shell date-card" aria-labelledby="expect-title">
    <p class="eyebrow"><?= lang_editable('pages.free_show.expect.eyebrow', 'What to expect') ?></p><h2 id="expect-title"><?= lang_editable('pages.free_show.expect.title', 'A family-friendly blast with teeth.') ?></h2>
    <p class="section-lede"><?= lang_editable('pages.free_show.expect.lede', 'Expect loud rock energy, bright stage looks, fog, flashing patterns, video atmosphere, and a one-performer theatrical tribute built for fans who want the night to feel bigger than the pavilion.') ?></p>
    <div class="safety-strip"><?= lang_editable_with_strong_prefix('pages.free_show.expect.safety', 'Family-friendly warning: loud sound, bright lights, fog, and sequences of flashing lights and patterns may be used. Sensitive guests should plan accordingly.', 'Family-friendly warning:') ?></div>
    <?php render_page_image('fog-strobe-atmosphere.webp', lang_text('pages.september_26_2026.image.2.alt', 'Family-friendly blast atmosphere image.')); ?>
  </section>

  <?php render_page_section_slot('/september-26-2026/', 'before_section_04'); ?>
  <section id="updates" class="section-shell form-section" aria-labelledby="updates-title"><div><p class="eyebrow"><?= lang_editable('pages.free_show.updates.eyebrow', 'Do not miss the drop') ?></p><h2 id="updates-title"><?= lang_editable('pages.free_show.updates.title', 'Join the September 26 update list.') ?></h2><p><?= lang_editable('pages.free_show.updates.body', 'Get arrival notes, schedule reminders, camping and parking updates, safety/access notes, Facebook event link updates, and photo/video sharing instructions as they are confirmed.') ?></p><div class="safety-callout"><?= lang_editable_with_strong_prefix('pages.free_show.updates.callout', 'No ticket required: RSVP is appreciated, and email is the cleanest way to keep the details from getting lost in the smoke.', 'No ticket required:') ?></div></div><?php render_lead_form($csrf); ?><?php render_page_image('gear-control-dossier.webp', lang_text('pages.september_26_2026.image.3.alt', 'Update-list form background.')); ?></section>
  <?php render_page_section_slot('/september-26-2026/', 'after_page'); ?>
</main>
<?php render_footer(); ?>
