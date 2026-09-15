<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/view.php';
require_once __DIR__ . '/../app/page_sections.php';

$formResult = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formType = post_string('form_type', 40);
    if ($formType === 'lead') {
        require_once __DIR__ . '/../app/forms/lead_submit.php';
        $formResult = handle_lead_submit();
    } elseif ($formType === 'inquiry') {
        require_once __DIR__ . '/../app/forms/inquiry_submit.php';
        $formResult = handle_inquiry_submit();
    } else {
        $formResult = ['ok' => false, 'message' => lang_text('landing.form.invalid_route_message', 'Choose a valid form route.')];
    }
}

$csrf = csrf_token();
render_header(lang_text('landing.meta.title.home', 'Just One KISS — You Wanted the Best? You Got the Best!'), lang_text('landing.meta.description.home', 'A free show on September 26, 2026 at 7:30 PM at Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI. No ticket required; RSVP is appreciated.'));
render_notice($formResult);
?>
<main id="main">
  <?php render_page_section_slot('/', 'before_page'); ?>
  <?php render_page_section_slot('home', 'before_hero'); ?>
  <?php render_page_section_slot('/', 'before_section_01'); ?>
  <section id="top" class="hero section-shell hero--portal" aria-labelledby="hero-title"<?= asset_style('trailer-poster-stage-portal.webp') ?>>
    <div class="hero__copy">
      <p class="eyebrow"><?= lang_editable('landing.hero.eyebrow', 'Free show · September 26, 2026 · 7:30 PM · Cycle Moore Legacy · Interlochen / US 31') ?></p>
      <h1 id="hero-title"><?= lang_editable('landing.hero.title', 'You wanted the best? You got the best!') ?></h1>
      <section class="hero-brand-echo" aria-label="<?= e(lang_text('landing.global.brand.aria', 'Just One KISS home')) ?>">
        <span><?= lang_editable('landing.global.brand.line1', 'Just One') ?></span>
        <strong><?= lang_editable('landing.global.brand.line2', 'KISS') ?></strong>
      </section>
      <p class="hero__lede"><?= lang_editable('landing.hero.lede', 'A free, family-friendly theatrical rock tribute day at Cycle Moore Legacy with campground energy, a pavilion stage, full lighting, loud music, bright lights, fog, and flashing patterns.') ?></p>
      <div class="hero-countdown" data-countdown data-target-date="2026-09-26T19:30:00-04:00" aria-live="polite"><?= lang_editable('landing.hero.countdown.loading', 'Countdown loading…') ?></div>
      <div class="hero-facts" aria-label="<?= e(lang_text('landing.event.ticket.aria', 'Event facts')) ?>">
        <span><?= lang_editable('landing.hero.fact.1', 'Free show') ?></span>
        <span><?= lang_editable('landing.hero.fact.2', 'No ticket required') ?></span>
        <span><?= lang_editable('landing.hero.fact.3', 'RSVP appreciated') ?></span>
        <span><?= lang_editable('landing.hero.fact.4') ?></span>
      </div>
      <div class="cta-row" aria-label="Hero actions">
        <a class="button button--fire" href="#updates" data-track="hero-updates"><?= lang_editable('landing.hero.cta.drop', 'Get the September 26 drop') ?></a>
        <a class="button button--chrome" href="<?= e(page_url('/directions/')) ?>" data-track="hero-directions"><?= lang_editable('landing.hero.cta.directions', 'Get directions') ?></a>
      </div>
      <p class="microcopy"><?= lang_editable('landing.hero.disclaimer', 'Independent theatrical rock tribute. No official affiliation, sponsorship, authorization, or endorsement is claimed.') ?></p>
    </div>
    <aside class="hero__poster" aria-label="<?= e(lang_text('landing.hero.poster.aria', 'Show promise')) ?>">
      <p class="eyebrow"><?= lang_editable('landing.hero.poster.eyebrow', 'Built for the faithful') ?></p>
      <strong><?= lang_editable('landing.hero.poster.headline', 'The fire answers.') ?></strong>
      <span><?= lang_editable('landing.hero.poster.body', 'One performer. One show-control operator. Tight cues, hard light, smoke in the air, and no dead space.') ?></span>
    </aside>
  </section>

  <?php render_page_section_slot('home', 'after_hero'); ?>

  <?php render_page_section_slot('/', 'before_section_02'); ?>
  <section id="event" class="date-card section-shell section-with-bg section-with-bg--lights" aria-labelledby="event-title"<?= asset_style('spectacle-lighting-rig.webp') ?>>
    <div class="event-poster">
      <div>
        <p class="eyebrow"><?= lang_editable('landing.event.eyebrow', 'Ask and share show tips') ?></p>
        <h2 id="event-title"><?= lang_editable('landing.event.title', 'September 26, 2026 at 7:30 PM at Cycle Moore Legacy.') ?></h2>
        <p><?= lang_editable('landing.event.body') ?></p>
        <p><strong><?= lang_editable('landing.event.venue.name', 'Cycle Moore Legacy') ?></strong><br><?= lang_editable('landing.event.venue.address_phone', '11075 US 31 South, Interlochen, MI 49643 · Phone: 231-276-9091') ?></p>
      </div>
      <div class="event-ticket" aria-label="<?= e(lang_text('landing.event.ticket.aria', 'Event summary')) ?>">
        <strong><?= lang_editable('landing.event.ticket.1', 'September 26, 2026 · 7:30 PM') ?></strong>
        <span><?= lang_editable('landing.event.ticket.2', 'Free show') ?></span>
        <span><?= lang_editable('landing.event.ticket.3') ?></span>
        <span><?= lang_editable('landing.event.ticket.4', 'Cycle Moore Legacy') ?></span>
        <span><?= lang_editable('landing.event.ticket.5', 'US 31 / Interlochen') ?></span>
      </div>
    </div>
    <div class="coming-next event-list" aria-label="<?= e(lang_text('landing.event.details.aria', 'Practical details')) ?>">
      <span><?= lang_editable('landing.event.practical.1', 'Free show admission') ?></span>
      <span><?= lang_editable('landing.event.practical.2') ?></span>
      <span><?= lang_editable('landing.event.practical.3', 'Pavilion stage and full lighting setup') ?></span>
      <span><?= lang_editable('landing.event.practical.4', 'Parking outside the gate; overflow and handicap parking available') ?></span>
    </div>
    <div class="safety-strip"><?= lang_editable_with_strong_prefix('landing.event.safety.warning', 'Family-friendly warning: this is a family-friendly event, but loud sound, bright lights, fog, and sequences of flashing lights and patterns may be used. Sensitive guests should plan accordingly.', 'Family-friendly warning:') ?></div>
  </section>

  <?php render_page_section_slot('home', 'after_event'); ?>

  <?php render_page_section_slot('/', 'before_section_03'); ?>
  <section class="section-shell proof-section section-with-bg section-with-bg--armor" aria-labelledby="about-title"<?= asset_style('costume-chrome-detail.webp') ?>>
    <p class="eyebrow"><?= lang_editable('landing.about.eyebrow', 'About the show') ?></p>
    <h2 id="about-title"><?= lang_editable('landing.about.title', 'A stage takeover, not a polite cover night.') ?></h2>
    <p class="section-lede"><?= lang_editable('landing.about.lede', 'Just One KISS is an independent theatrical rock tribute built for fans who want transformation, smoke, chrome, fire-colored light, giant attitude, and that “you had to be there” feeling.') ?></p>
    <div class="proof-grid proof-grid--feature">
      <article><span class="proof-badge"><?= lang_editable('landing.about.proof.1.badge', '01') ?></span><h3><?= lang_editable('landing.about.proof.1.title', 'Demon-scale entrance') ?></h3><p><?= lang_editable('landing.about.proof.1.body', 'Black leather thunder, chrome glare, smoke curling low, and the kind of arrival that makes the pavilion feel like an arena.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('landing.about.proof.2.badge', '02') ?></span><h3><?= lang_editable('landing.about.proof.2.title', 'Fire-lit singalong') ?></h3><p><?= lang_editable('landing.about.proof.2.body', 'Big chorus energy, fists up, faces lit red and gold, and every fan pulled into the ritual before the night lets go.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('landing.about.proof.3.badge', '03') ?></span><h3><?= lang_editable('landing.about.proof.3.title', 'One controlled blast') ?></h3><p><?= lang_editable('landing.about.proof.3.body', 'No casual bar-band drift: cues, drops, visuals, and full theatrical intent.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('landing.about.proof.4.badge', '04') ?></span><h3><?= lang_editable('landing.about.proof.4.title', 'Chrome-blood spectacle') ?></h3><p><?= lang_editable('landing.about.proof.4.body', 'Armor shine, fog bursts, hard shadows, and a stage picture built to look dangerous even when every cue is under control.') ?></p></article>
    </div>
  </section>

  <?php render_page_section_slot('home', 'after_about'); ?>


  <?php render_page_section_slot('/', 'before_section_04'); ?>
  <section id="updates" class="section-shell form-section section-with-bg section-with-bg--control" aria-labelledby="updates-title"<?= asset_style('gear-control-dossier.webp') ?>><div><p class="eyebrow"><?= lang_editable('landing.updates.eyebrow', 'Join the rally') ?></p><h2 id="updates-title"><?= lang_editable('landing.updates.title', 'Get the September 26 drop.') ?></h2><p><?= lang_editable('landing.updates.body', 'No hunting. Get Cycle Moore Legacy arrival notes, all-day schedule reminders, camping and parking notes, safety/access updates, Facebook event link updates, and photo/video sharing instructions.') ?></p><div class="safety-callout"><?= lang_editable_with_strong_prefix('landing.updates.safety_callout', 'No ticket required: RSVP is appreciated. Parking is outside the gate. Overflow and handicap parking available.', 'No ticket required:') ?></div></div><?php render_lead_form($csrf); ?></section>

  <?php render_page_section_slot('home', 'after_updates'); ?>

  <?php render_page_section_slot('/', 'before_section_05'); ?>
  <section class="section-shell final-cta section-with-bg section-with-bg--fog" aria-labelledby="final-title"<?= asset_style('fog-strobe-atmosphere.webp') ?>><p class="eyebrow"><?= lang_editable('landing.final.eyebrow', 'One night. Full fire.') ?></p><h2 id="final-title"><span><?= lang_editable('landing.final.title.line.1', 'September 26, 2026 at 7:30 PM') ?></span><span><?= lang_editable('landing.final.title.line.2', 'Free show') ?></span><span><?= lang_editable('landing.final.title.line.3', 'Cycle Moore Legacy') ?></span><span><?= lang_editable('landing.final.title.line.4', 'Interlochen on US 31') ?></span></h2><div class="cta-row"><a class="button button--fire" href="#updates"><?= lang_editable('landing.final.cta.drop', 'Get the September 26 drop') ?></a><a class="button button--chrome" href="<?= e(page_url('/contact/')) ?>#contact"><?= lang_editable('landing.final.cta.contact', 'Chat the show') ?></a></div></section>

  <?php render_page_section_slot('home', 'after_final'); ?>

  <?php render_page_section_slot('/', 'before_section_06'); ?>
  <section class="section-shell vault-section section-with-bg section-with-bg--vault" aria-labelledby="vault-title"<?= asset_style('road-case-vault-bg.webp') ?>>
    <div class="section-intro"><p class="eyebrow"><?= lang_editable('landing.vault.eyebrow', 'Fan vault') ?></p><h2 id="vault-title"><?= lang_editable('landing.vault.title', 'Open the road case.') ?></h2><p><?= lang_editable('landing.vault.body', 'The Fan Vault is where the crowd keeps the night alive: targeted fan posts, photos, clips, arrival tips, Q&A, chats, routing, and useful notes from people headed toward the same fire.') ?></p></div>
    <div class="relic-grid">
      <a class="relic-card" href="<?= e(page_url('/september-26-2026/')) ?>"><span class="relic-card__stamp"><?= lang_editable('landing.vault.card.1.stamp', '01') ?></span><strong><?= lang_editable_lines('landing.vault.card.1.title', "Free\nShow") ?></strong><span><?= lang_editable('landing.vault.card.1.subtitle', 'Ask and share show tips') ?></span></a>
      <a class="relic-card" href="<?= e(page_url('/video/')) ?>"><span class="relic-card__stamp"><?= lang_editable('landing.vault.card.2.stamp', '02') ?></span><strong><?= lang_editable('landing.vault.card.2.title', 'Video Posts') ?></strong><span><?= lang_editable('landing.vault.card.2.subtitle', 'Post clips and reactions') ?></span></a>
      <a class="relic-card" href="<?= e(page_url('/vault/')) ?>"><span class="relic-card__stamp"><?= lang_editable('landing.vault.card.3.stamp', '03') ?></span><strong><?= lang_editable('landing.vault.card.3.title', 'Fan Media') ?></strong><span><?= lang_editable('landing.vault.card.3.subtitle', 'Fan photos and finds') ?></span></a>
      <a class="relic-card" href="<?= e(page_url('/directions/')) ?>"><span class="relic-card__stamp"><?= lang_editable('landing.vault.card.4.stamp', '04') ?></span><strong><?= lang_editable('landing.vault.card.4.title', 'Tips') ?></strong><span><?= lang_editable('landing.vault.card.4.subtitle', 'Arrival tips for fans') ?></span></a>
      <a class="relic-card" href="<?= e(page_url('/faq-disclaimer/')) ?>"><span class="relic-card__stamp"><?= lang_editable('landing.vault.card.5.stamp', '05') ?></span><strong><?= lang_editable('landing.vault.card.5.title', 'Q&A') ?></strong><span><?= lang_editable('landing.vault.card.5.subtitle', 'Crowd questions answered') ?></span></a>
      <a class="relic-card" href="<?= e(page_url('/contact/')) ?>"><span class="relic-card__stamp"><?= lang_editable('landing.vault.card.6.stamp', '06') ?></span><strong><?= lang_editable('landing.vault.card.6.title', 'Chat') ?></strong><span><?= lang_editable('landing.vault.card.6.subtitle', 'Chats and routing') ?></span></a>
    </div>
  </section>
  <?php render_page_section_slot('home', 'after_vault'); ?>
  <?php render_page_section_slot('/', 'after_page'); ?>
</main>
<?php render_footer(); ?>
