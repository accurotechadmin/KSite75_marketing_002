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
render_header(lang_text('pages.spectacle.meta.v3.title', 'Just One KISS — The Spectacle'), lang_text('pages.spectacle.meta.v3.description', 'A free fan gathering on September 26, 2026 at 7:30 PM at Cycle Moore Legacy for people who love KISS attitude, shared songs, campground energy, and a night worth showing up for.'));
render_notice($formResult);
?>
<main id="main">
  <?php render_page_section_slot('/spectacle/', 'before_page'); ?>
  <?php render_page_section_slot('/spectacle/', 'before_section_01'); ?>
  <section class="subhero section-shell" aria-labelledby="page-title">
    <p class="eyebrow"><?= lang_editable('pages.spectacle.v3.hero.eyebrow', 'For the fans who show up loud') ?></p>
    <h1 id="page-title"><?= lang_editable('pages.spectacle.v3.hero.title', 'The Spectacle') ?></h1>
    <p class="hero__lede"><?= lang_editable('pages.spectacle.v3.hero.lede', 'Some things are better left for show day. This page is not here to explain the surprise. It is here to say that September 26 is for the people who still love the size, attitude, and shared mythology of KISS.') ?></p>
    <div class="cta-row"><a class="button button--fire" href="<?= e(page_url('/september-26-2026/')) ?>"><?= lang_editable('pages.spectacle.v3.cta.event', 'See the free show') ?></a><a class="button button--chrome" href="<?= e(page_url('/directions/')) ?>"><?= lang_editable('pages.spectacle.v3.cta.directions', 'Plan the arrival') ?></a></div>
    <?php render_page_image('spectacle-lighting-rig.webp', lang_text('pages.spectacle.image.1.alt', 'Hero: KISS fans gathering near the pavilion before the show.')); ?>
  </section>

  <?php render_page_section_slot('/spectacle/', 'before_section_02'); ?>
  <section class="section-shell spectacle-section" aria-labelledby="why-title">
    <p class="eyebrow"><?= lang_editable('pages.spectacle.v3.why.eyebrow', 'Why it matters') ?></p>
    <h2 id="why-title"><?= lang_editable('pages.spectacle.v3.why.title', 'KISS fans understand over the top.') ?></h2>
    <p class="section-lede"><?= lang_editable('pages.spectacle.v3.why.lede', 'The people coming to this show already know the feeling: favorite shirts, old stories, loud choruses, friends who get it, and the kind of night that feels like more than a date on the calendar.') ?></p>
    <div class="system-grid">
      <article><h3><?= lang_editable('pages.spectacle.v3.system.1.title', 'The shared memory') ?></h3><p><?= lang_editable('pages.spectacle.v3.system.1.body', 'Everyone has a first song, first poster, first record, first concert story, or first moment when KISS felt larger than ordinary life. This night gives those stories somewhere to gather.') ?></p></article>
      <article><h3><?= lang_editable('pages.spectacle.v3.system.2.title', 'The crowd voice') ?></h3><p><?= lang_editable('pages.spectacle.v3.system.2.body', 'The night comes alive when people arrive ready to sing, laugh, point, cheer, take pictures, and carry the feeling from the gate to the pavilion.') ?></p></article>
      <article><h3><?= lang_editable('pages.spectacle.v3.system.3.title', 'The summer ritual') ?></h3><p><?= lang_editable('pages.spectacle.v3.system.3.body', 'Drive in, park, find the familiar faces, meet a few new ones, and let a free show turn into the reason everyone remembers that weekend.') ?></p></article>
    </div>
  </section>

  <?php render_page_section_slot('/spectacle/', 'before_section_03'); ?>
  <section class="section-shell proof-section" aria-labelledby="fan-title">
    <p class="eyebrow"><?= lang_editable('pages.spectacle.v3.fan.eyebrow', 'For the faithful') ?></p>
    <h2 id="fan-title"><?= lang_editable('pages.spectacle.v3.fan.title', 'The real spectacle is the crowd that still cares.') ?></h2>
    <div class="proof-grid">
      <article><span class="proof-badge"><?= lang_editable('pages.spectacle.v3.fan.card.1.badge', '01') ?></span><h3><?= lang_editable('pages.spectacle.v3.fan.card.1.title', 'Road-trip energy') ?></h3><p><?= lang_editable('pages.spectacle.v3.fan.card.1.body', 'It starts with people choosing to make the drive, meet up, and treat a free local show like a destination.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.spectacle.v3.fan.card.2.badge', '02') ?></span><h3><?= lang_editable('pages.spectacle.v3.fan.card.2.title', 'Favorite-song loyalty') ?></h3><p><?= lang_editable('pages.spectacle.v3.fan.card.2.body', 'The strongest moments come from fans who already know why the songs matter and are ready to carry that feeling together.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.spectacle.v3.fan.card.3.badge', '03') ?></span><h3><?= lang_editable('pages.spectacle.v3.fan.card.3.title', 'Pictures with friends') ?></h3><p><?= lang_editable('pages.spectacle.v3.fan.card.3.body', 'Bring the camera for the people, the road-trip moments, the campground hang, and the proof that you were there.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.spectacle.v3.fan.card.4.badge', '04') ?></span><h3><?= lang_editable('pages.spectacle.v3.fan.card.4.title', 'A night to retell') ?></h3><p><?= lang_editable('pages.spectacle.v3.fan.card.4.body', 'The goal is simple: give fans a night that feels generous, communal, and big enough to become a story afterward.') ?></p></article>
    </div>
    <?php render_page_image('costume-chrome-detail.webp', lang_text('pages.spectacle.image.2.alt', 'Fan moment: friends in favorite rock shirts gathering before the show.')); ?>
  </section>

  <?php render_page_section_slot('/spectacle/', 'before_section_04'); ?>
  <section class="section-shell date-card" aria-labelledby="mystery-title">
    <p class="eyebrow"><?= lang_editable('pages.spectacle.v3.mystery.eyebrow', 'What will happen?') ?></p>
    <h2 id="mystery-title"><?= lang_editable('pages.spectacle.v3.mystery.title', 'Show up and find out.') ?></h2>
    <p class="section-lede"><?= lang_editable('pages.spectacle.v3.mystery.body', 'The homepage says enough: free show, September 26, Cycle Moore Legacy, Interlochen on US 31, big fan energy. The rest belongs to the people who are there when it happens.') ?></p>
    <?php render_page_image('fog-strobe-atmosphere.webp', lang_text('pages.spectacle.image.3.alt', 'Mystery: fans walking toward the gathering with the pavilion ahead.')); ?>
  </section>
  <?php render_page_section_slot('/spectacle/', 'after_page'); ?>
</main>
<?php render_footer(false, ['summary_token' => 'pages.v2.footer.summary', 'summary' => 'Just One KISS · September 26, 2026 at 7:30 PM · Free show · Interlochen on US 31.', 'summary_prefix' => 'Just One KISS', 'details_token' => 'pages.v2.footer.details']); ?>
