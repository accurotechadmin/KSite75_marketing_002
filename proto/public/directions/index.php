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
render_header(lang_text('pages.directions.meta.v3.title', 'Just One KISS — Directions to Cycle Moore Legacy'), lang_text('pages.directions.meta.v3.description', 'Get to Cycle Moore Legacy at 11075 US 31 South, Interlochen, MI 49643 for the free September 26, 2026 at 7:30 PM Just One KISS show.'));
render_notice($formResult);
$mapsUrl = lang_text('pages.directions.maps.url', 'https://www.google.com/maps/place/Cycle+Moore+Legacy/@44.6584619,-85.801296,17z/data=!3m1!4b1!4m6!3m5!1s0x881e38525e1b347d:0x6e182699c27f377b!8m2!3d44.6584619!4d-85.7987211!16s%2Fg%2F11cn3p0gst?entry=ttu');
$embedUrl = lang_text('pages.directions.maps.embed_url', 'https://www.google.com/maps?q=Cycle%20Moore%20Legacy%2C%2011075%20US%2031%20South%2C%20Interlochen%2C%20MI%2049643&output=embed');
?>
<main id="main">
  <?php render_page_section_slot('/directions/', 'before_page'); ?>
  <?php render_page_section_slot('/directions/', 'before_section_01'); ?>
  <section class="subhero section-shell" aria-labelledby="page-title">
    <p class="eyebrow"><?= lang_editable('pages.directions.v3.hero.eyebrow', 'Interlochen / US 31 / show day') ?></p>
    <h1 id="page-title"><?= lang_editable('pages.directions.v3.hero.title', 'Directions') ?></h1>
    <p class="hero__lede"><?= lang_editable('pages.directions.v3.hero.lede', 'Point the car toward Cycle Moore Legacy, roll into Interlochen on US 31, and look for the campground crowd around the pavilion. The show is free; the trip is part of the story.') ?></p>
    <div class="cta-row"><a class="button button--fire" href="<?= e($mapsUrl) ?>" target="_blank" rel="noopener"><?= lang_editable('pages.directions.v3.cta.maps', 'Open in Google Maps') ?></a><a class="button button--chrome" href="#map"><?= lang_editable('pages.directions.v3.cta.map', 'Use the map') ?></a></div>
    <?php render_page_image('interlochen-dispatch-map.webp', lang_text('pages.directions.image.1.alt', 'Hero: fans driving toward a campground gathering in northern Michigan.')); ?>
  </section>

  <?php render_page_section_slot('/directions/', 'before_section_02'); ?>
  <section id="map" class="section-shell map-section" aria-labelledby="map-title">
    <div><p class="eyebrow"><?= lang_editable('pages.directions.v3.map.eyebrow', 'The destination') ?></p><h2 id="map-title"><?= lang_editable('pages.directions.v3.map.title', 'Cycle Moore Legacy') ?></h2><p class="section-lede"><strong><?= lang_editable('pages.directions.address.name', 'Cycle Moore Legacy') ?></strong><br><?= lang_editable('pages.directions.address.line', '11075 US 31 South, Interlochen, MI 49643') ?><br><?= lang_editable('pages.directions.address.phone', 'Phone: 231-276-9091') ?></p><p><?= lang_editable('pages.directions.v3.map.body', 'Use the map for the last-mile view, then follow posted event guidance once you are on the grounds. The gathering centers around the pavilion area inside the campground.') ?></p></div>
    <div class="map-frame"><iframe title="<?= e(lang_text('pages.directions.map.iframe_title', 'Google Map to Cycle Moore Legacy')) ?>" src="<?= e($embedUrl) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
  </section>

  <?php render_page_section_slot('/directions/', 'before_section_03'); ?>
  <section class="section-shell proof-section" aria-labelledby="arrival-title">
    <p class="eyebrow"><?= lang_editable('pages.directions.v3.arrival.eyebrow', 'Arrival notes') ?></p>
    <h2 id="arrival-title"><?= lang_editable('pages.directions.v3.arrival.title', 'Get there, park, camp if you want, and find your people.') ?></h2>
    <div class="proof-grid">
      <article><span class="proof-badge"><?= lang_editable('pages.directions.v3.card.1.badge', '01') ?></span><h3><?= lang_editable('pages.directions.v3.card.1.title', 'The road') ?></h3><p><?= lang_editable('pages.directions.v3.card.1.body', 'Cycle Moore Legacy sits on US 31 in Interlochen. Build in enough time to arrive relaxed, look around, and settle into the crowd before the night gets moving.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.directions.v3.card.2.badge', '02') ?></span><h3><?= lang_editable('pages.directions.v3.card.2.title', 'The parking') ?></h3><p><?= lang_editable('pages.directions.v3.card.2.body', 'Parking is outside the gate. Overflow and handicap parking available so fans can focus on finding friends and getting settled.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.directions.v3.card.3.badge', '03') ?></span><h3><?= lang_editable('pages.directions.v3.card.3.title', 'The camping') ?></h3><p><?= lang_editable('pages.directions.v3.card.3.body') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.directions.v3.card.4.badge', '04') ?></span><h3><?= lang_editable('pages.directions.v3.card.4.title', 'The updates') ?></h3><p><?= lang_editable('pages.directions.v3.card.4.body', 'Join the update list for timing reminders, arrival notes, parking details, camping notes, and the latest event-day posts as September 26 gets closer.') ?></p></article>
    </div>
  </section>

  <?php render_page_section_slot('/directions/', 'before_section_04'); ?>
  <section class="section-shell date-card" aria-labelledby="pack-title">
    <p class="eyebrow"><?= lang_editable('pages.directions.v3.pack.eyebrow', 'Before you roll out') ?></p>
    <h2 id="pack-title"><?= lang_editable('pages.directions.v3.pack.title', 'Make it easy on yourself.') ?></h2>
    <p class="section-lede"><?= lang_editable('pages.directions.v3.pack.body', 'Bring what makes an outdoor summer show comfortable: water, layers for after dark, comfortable footwear, phone charge, camping gear if you are staying, and a camera if you want to catch the crowd memories.') ?></p>
    <?php render_page_image('road-case-vault-bg.webp', lang_text('pages.directions.image.2.alt', 'Packing: road-trip items for an outdoor summer fan gathering.')); ?>
  </section>
  <?php render_page_section_slot('/directions/', 'after_page'); ?>
</main>
<?php render_footer(false, ['summary_token' => 'pages.v2.footer.summary', 'summary' => 'Just One KISS · September 26, 2026 at 7:30 PM · Free show · Interlochen on US 31.', 'summary_prefix' => 'Just One KISS', 'details_token' => 'pages.v2.footer.details']); ?>
