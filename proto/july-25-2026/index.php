<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/view.php';

$formResult = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formType = post_string('form_type', 40);
    if ($formType === 'lead') { require_once __DIR__ . '/../../app/forms/lead_submit.php'; $formResult = handle_lead_submit(); }
    elseif ($formType === 'inquiry') { require_once __DIR__ . '/../../app/forms/inquiry_submit.php'; $formResult = handle_inquiry_submit(); }
    else { $formResult = ['ok' => false, 'message' => 'Choose a valid form route.']; }
}
$csrf = csrf_token();
render_header('Just One KISS — July 25, 2026 Free Show', 'Admission is free at Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643. No ticket is required; RSVP is appreciated. The event runs all day, camping is welcome the night before, and parking will be clearly marked inside the campground.');
render_notice($formResult);
?>
<main id="main">
  <section class="subhero section-shell" aria-labelledby="page-title">
    <p class="eyebrow">Free show · July 25, 2026 · In Interlochen on US 31</p>
    <h1 id="page-title">July 25, 2026 Free Show</h1>
    <p class="hero__lede">Admission is free at Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643. No ticket is required; RSVP is appreciated. The event runs all day, camping is welcome the night before, and parking will be clearly marked inside the campground.</p>
    <div class="cta-row"><a class="button button--fire" href="<?= e(page_url('/july-25-2026/')) ?>#updates">Join the July 25 update list</a><a class="button button--chrome" href="<?= e(page_url('/spectacle/')) ?>">See the spectacle</a><a class="button button--ghost" href="<?= e(page_url('/contact/')) ?>#contact">Contact the show</a></div>
  </section>
  <section class="section-shell proof-section"><h2>Event information</h2><div class="proof-grid">
    <article><h3>Admission</h3><p>The July 25, 2026 event is a free show. No ticket is required; RSVP is appreciated.</p></article>
    <article><h3>Location / parking</h3><p>Cycle Moore Legacy is at 11075 US 31 South, Interlochen, MI 49643. Parking is inside the campground around the pavilion on the grass as directed, and it will be clearly marked.</p></article>
    <article><h3>Fog / strobes</h3><p>Family-friendly event; loud sound, bright lights, fog, and sequences of flashing lights and patterns may be used.</p></article>
    <article><h3>Independent tribute</h3><p>No official affiliation, sponsorship, authorization, or endorsement is claimed.</p></article>
  </div></section>
  <section id="updates" class="section-shell form-section"><div><p class="eyebrow">Free show updates</p><h2>Join the July 25 update list</h2><p>Receive Cycle Moore Legacy arrival notes, all-day schedule reminders, camping and parking notes, safety/access updates, Facebook event link updates, and photo/video sharing instructions.</p><div class="safety-callout"><strong>No ticket required:</strong> RSVP is appreciated. Email is how updates go out. Loud sound, bright lights, fog, and flashing patterns may be used.</div></div><?php render_lead_form($csrf); ?></section>
</main>
<?php render_footer(); ?>
