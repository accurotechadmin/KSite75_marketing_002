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
render_header('Just One KISS — Contact the Show', 'Contact the show contacts can use this route for show inquiries, location questions, press needs, technical limits, and accessibility or safety questions.');
render_notice($formResult);
?>
<main id="main">
  <section class="subhero section-shell" aria-labelledby="page-title">
    <p class="eyebrow">Compact team. Big visual promise.</p>
    <h1 id="page-title">Contact the Show</h1>
    <p class="hero__lede">Contact the show contacts can use this route for show inquiries, location questions, press needs, technical limits, and accessibility or safety questions.</p>
    <div class="cta-row"><a class="button button--fire" href="<?= e(page_url('/july-25-2026/')) ?>#updates">Join the July 25 update list</a><a class="button button--chrome" href="<?= e(page_url('/spectacle/')) ?>">See the spectacle</a><a class="button button--ghost" href="<?= e(page_url('/contact/')) ?>#contact">Contact the show</a></div>
  </section>
  <section class="section-shell proof-section"><h2>Event information</h2><div class="proof-grid">
    <article><h3>Admission</h3><p>The July 25, 2026 event is a free show. No ticket is required; RSVP is appreciated.</p></article>
    <article><h3>Location / parking</h3><p>Cycle Moore Legacy is at 11075 US 31 South, Interlochen, MI 49643. Parking is inside the campground around the pavilion on the grass as directed, and it will be clearly marked.</p></article>
    <article><h3>Fog / strobes</h3><p>Family-friendly event; loud sound, bright lights, fog, and sequences of flashing lights and patterns may be used.</p></article>
    <article><h3>Independent tribute</h3><p>No official affiliation, sponsorship, authorization, or endorsement is claimed.</p></article>
  </div></section>
  <section id="contact" class="section-shell contact-section"><div><p class="eyebrow">Contact the show</p><h2>Contact the show</h2><p>Use this form for Facebook information, media sharing, technical, accessibility, safety, or general questions.</p></div><?php render_inquiry_form($csrf); ?></section>
  <section class="section-shell image-inventory"><h2>Show contact image slots</h2><p>Approved original visuals for show contact, and show-control credibility.</p><?php render_media_grid(['press-performer-portrait.webp' => 'Press performer portrait', 'gear-control-dossier.webp' => 'Gear control dossier']); ?></section>
</main>
<?php render_footer(); ?>
