<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/view.php';

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
        $formResult = ['ok' => false, 'message' => 'Choose a valid form route.'];
    }
}

$csrf = csrf_token();
render_header('Just One KISS — You Wanted the Best? You Got the Best!', 'Free all-day July 25, 2026 show at Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI. No ticket required; RSVP is appreciated.');
render_notice($formResult);
?>
<main id="main">
  <section id="top" class="hero section-shell" aria-labelledby="hero-title"<?= asset_style('trailer-poster-stage-portal.webp') ?>>
    <div class="hero__copy">
      <p class="eyebrow">Free show · July 25, 2026 · Cycle Moore Legacy · Interlochen / US 31</p>
      <h1 id="hero-title">You wanted the best? You got the best!</h1>
      <p class="hero__lede">A free, family-friendly theatrical rock tribute day at Cycle Moore Legacy with campground energy, a pavilion stage, full lighting, loud music, bright lights, fog, and flashing patterns.</p>
      <div class="hero-countdown" data-countdown data-target-date="2026-07-25T10:00:00-04:00" aria-live="polite">Countdown loading…</div>
      <div class="hero-facts" aria-label="Event facts">
        <span>Free show</span>
        <span>No ticket required</span>
        <span>RSVP appreciated</span>
        <span>Camping welcome</span>
      </div>
      <div class="cta-row" aria-label="Hero actions">
        <a class="button button--fire" href="#updates" data-track="hero-updates">Get the July 25 drop</a>
        <a class="button button--chrome" href="<?= e(page_url('/directions/')) ?>" data-track="hero-directions">Get directions</a>
      </div>
      <p class="microcopy">Independent theatrical rock tribute. No official affiliation, sponsorship, authorization, or endorsement is claimed.</p>
    </div>
    <aside class="hero__poster" aria-label="Show promise">
      <p class="eyebrow">Built for the faithful</p>
      <strong>The fire answers.</strong>
      <span>One performer. One show-control operator. Tight cues, hard light, smoke in the air, and no dead space.</span>
    </aside>
  </section>

  <section id="event" class="date-card section-shell section-with-bg" aria-labelledby="event-title"<?= asset_style('spectacle-lighting-rig.webp') ?>>
    <div class="event-poster">
      <div>
        <p class="eyebrow">Event details</p>
        <h2 id="event-title">July 25 at Cycle Moore Legacy.</h2>
        <p>July 25, 2026 in Interlochen on US 31. Get the July 25 drop for all-day schedule reminders, camping notes, parking, access notes, safety details, and the Facebook event link as the day draws near.</p>
        <p><strong>Cycle Moore Legacy</strong><br>11075 US 31 South, Interlochen, MI 49643 · Phone: 231-276-9091</p>
      </div>
      <div class="event-ticket" aria-label="Event summary">
        <strong>July 25</strong>
        <span>Free show</span>
        <span>Cycle Moore Legacy</span>
        <span>US 31 / Interlochen</span>
      </div>
    </div>
    <div class="coming-next event-list" aria-label="Practical details">
      <span>All-day campground event</span>
      <span>Arrive the night before and camp</span>
      <span>Pavilion stage and full lighting setup</span>
      <span>Parking marked on grass inside the campground</span>
    </div>
    <div class="safety-strip"><strong>Family-friendly warning:</strong> this is a family-friendly event, but loud sound, bright lights, fog, and sequences of flashing lights and patterns may be used. Sensitive guests should plan accordingly.</div>
  </section>

  <section class="section-shell proof-section section-with-bg" aria-labelledby="about-title"<?= asset_style('costume-chrome-detail.webp') ?>>
    <p class="eyebrow">About the show</p>
    <h2 id="about-title">A stage takeover, not a polite cover night.</h2>
    <p class="section-lede">Just One KISS is an independent theatrical rock tribute built for fans who want transformation, smoke, chrome, fire-colored light, giant attitude, and that “you had to be there” feeling.</p>
    <div class="proof-grid proof-grid--feature">
      <article><span class="proof-badge">01</span><h3>One performer</h3><p>Armor, posture, crowd force, and black-chrome menace aimed straight at the pavilion.</p></article>
      <article><span class="proof-badge">02</span><h3>One operator</h3><p>QLC+/DMX lighting, projection, fog, strobes, run sheets, and emergency looks kept tight.</p></article>
      <article><span class="proof-badge">03</span><h3>One controlled blast</h3><p>No casual bar-band drift: cues, drops, visuals, and full theatrical intent.</p></article>
      <article><span class="proof-badge">04</span><h3>Independent fire</h3><p>Original tribute presentation and clear public language without official-affiliation claims.</p></article>
    </div>
  </section>


  <section id="updates" class="section-shell form-section section-with-bg" aria-labelledby="updates-title"<?= asset_style('gear-control-dossier.webp') ?>><div><p class="eyebrow">Join the rally</p><h2 id="updates-title">Get the July 25 drop.</h2><p>No hunting. Get Cycle Moore Legacy arrival notes, all-day schedule reminders, camping and parking notes, safety/access updates, Facebook event link updates, and photo/video sharing instructions.</p><div class="safety-callout"><strong>No ticket required:</strong> RSVP is appreciated. Parking is inside the campground, around the pavilion, on the grass as directed, and it will be clearly marked.</div></div><?php render_lead_form($csrf); ?></section>

  <section class="section-shell final-cta section-with-bg" aria-labelledby="final-title"<?= asset_style('fog-strobe-atmosphere.webp') ?>><p class="eyebrow">One night. Full fire.</p><h2 id="final-title"><span>July 25, 2026</span><span>Free show</span><span>Cycle Moore Legacy</span><span>Interlochen on US 31</span></h2><div class="cta-row"><a class="button button--fire" href="#updates">Get the July 25 drop</a><a class="button button--chrome" href="<?= e(page_url('/contact/')) ?>#contact">Contact the show</a></div></section>

  <section class="section-shell vault-section section-with-bg" aria-labelledby="vault-title"<?= asset_style('facebook-share-flame-bg.webp') ?>>
    <div class="section-intro"><p class="eyebrow">Fan vault</p><h2 id="vault-title">Open the road case.</h2><p>Get event drops, arrival notes, clips, photos, and safety updates before July 25. Bring the camera; the night is being armed.</p></div>
    <div class="relic-grid">
      <a class="relic-card" href="<?= e(page_url('/july-25-2026/')) ?>"><span class="relic-card__stamp">01</span><strong>Free<br>Show</strong><span>Event details</span></a>
      <a class="relic-card" href="<?= e(page_url('/video/')) ?>"><span class="relic-card__stamp">02</span><strong>Video</strong><span>Fan clips</span></a>
      <a class="relic-card" href="<?= e(page_url('/vault/')) ?>"><span class="relic-card__stamp">03</span><strong>Vault</strong><span>Photo drops</span></a>
      <a class="relic-card" href="<?= e(page_url('/spectacle/')) ?>"><span class="relic-card__stamp">04</span><strong>Stage FX</strong><span>Lights / fog</span></a>
      <a class="relic-card" href="<?= e(page_url('/directions/')) ?>"><span class="relic-card__stamp">05</span><strong>Arrival</strong><span>Cycle Moore</span></a>
      <a class="relic-card" href="<?= e(page_url('/faq-disclaimer/')) ?>"><span class="relic-card__stamp">06</span><strong>FAQ</strong><span>Safety notes</span></a>
      <a class="relic-card" href="<?= e(page_url('/contact/')) ?>"><span class="relic-card__stamp">07</span><strong>Contact</strong><span>Reach the show</span></a>
    </div>
  </section>
</main>
<?php render_footer(); ?>
