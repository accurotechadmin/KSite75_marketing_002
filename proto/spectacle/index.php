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
render_header('Just One KISS — The Spectacle', 'Lights, projection, fog, strobe-style looks, costume transformation, and stage attitude create the visual promise. Effects are location-dependent and safety-reviewed.');
render_notice($formResult);
?>
<main id="main">
  <section class="subhero section-shell" aria-labelledby="page-title">
    <p class="eyebrow">Black first. Chrome second. Fire third.</p>
    <h1 id="page-title">The Spectacle</h1>
    <p class="hero__lede">Lights, projection, fog, strobe-style looks, costume transformation, and stage attitude create the visual promise. Effects are location-dependent and safety-reviewed.</p>
    <div class="cta-row"><a class="button button--fire" href="<?= e(page_url('/july-25-2026/')) ?>#updates">Join the July 25 update list</a><a class="button button--chrome" href="<?= e(page_url('/spectacle/')) ?>">See the spectacle</a><a class="button button--ghost" href="<?= e(page_url('/contact/')) ?>#contact">Contact the show</a></div>
  </section>
  <section class="section-shell proof-section"><h2>Event information</h2><div class="proof-grid">
    <article><h3>Admission</h3><p>The July 25, 2026 event is a free show. No ticket is required; RSVP is appreciated.</p></article>
    <article><h3>Location / parking</h3><p>Cycle Moore Legacy is at 11075 US 31 South, Interlochen, MI 49643. Parking is inside the campground around the pavilion on the grass as directed, and it will be clearly marked.</p></article>
    <article><h3>Fog / strobes</h3><p>Family-friendly event; loud sound, bright lights, fog, and sequences of flashing lights and patterns may be used.</p></article>
    <article><h3>Independent tribute</h3><p>No official affiliation, sponsorship, authorization, or endorsement is claimed.</p></article>
  </div></section>
  <section class="section-shell spectacle-section"><h2>Visual system</h2><div class="system-grid"><article><h3>Lights</h3><p>Black/chrome/fire looks through QLC+/DMX planning.</p></article><article><h3>Projection</h3><p>Original media slots for trailer and show atmosphere.</p></article><article><h3>Costume transformation</h3><p>Original public presentation and independent styling.</p></article></div><?php render_media_grid(['spectacle-lighting-rig.webp' => 'Lighting rig', 'fog-strobe-atmosphere.webp' => 'Fog and strobe atmosphere', 'costume-chrome-detail.webp' => 'Costume chrome detail']); ?></section>
</main>
<?php render_footer(); ?>
