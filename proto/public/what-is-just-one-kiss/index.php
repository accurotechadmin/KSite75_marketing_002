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
render_header(lang_text('pages.ritual.meta.v3.title', 'Just One KISS — What Is Just One KISS?'), lang_text('pages.ritual.meta.v3.description', 'A fan-built KISS tribute gathering for September 26, 2026 at 7:30 PM at Cycle Moore Legacy: free admission, campground energy, favorite songs, shared stories, and big rock attitude.'));
render_notice($formResult);
?>
<main id="main">
  <?php render_page_section_slot('/what-is-just-one-kiss/', 'before_page'); ?>
  <?php render_page_section_slot('/what-is-just-one-kiss/', 'before_section_01'); ?>
  <section class="subhero section-shell" aria-labelledby="page-title">
    <p class="eyebrow"><?= lang_editable('pages.ritual.v3.hero.eyebrow', 'Built for the faithful') ?></p>
    <h1 id="page-title"><?= lang_editable('pages.ritual.v3.hero.title', 'What Is Just One KISS?') ?></h1>
    <p class="hero__lede"><?= lang_editable('pages.ritual.v3.hero.lede', 'Just One KISS is a free tribute gathering for people who love KISS enough to show up, sing along, bring friends, tell stories, and make a summer night at Cycle Moore Legacy feel bigger than an ordinary stop on the calendar.') ?></p>
    <div class="cta-row"><a class="button button--fire" href="<?= e(page_url('/september-26-2026/')) ?>#updates"><?= lang_editable('pages.ritual.v3.cta.free_show', 'Get September 26 updates') ?></a><a class="button button--chrome" href="<?= e(page_url('/spectacle/')) ?>"><?= lang_editable('pages.ritual.v3.cta.spectacle', 'Keep the mystery') ?></a></div>
    <?php render_page_image('press-performer-portrait.webp', lang_text('pages.what_is_just_one_kiss.image.1.alt', 'Hero: KISS fans arriving together at Cycle Moore Legacy.')); ?>
  </section>

  <?php render_page_section_slot('/what-is-just-one-kiss/', 'before_section_02'); ?>
  <section class="section-shell proof-section" aria-labelledby="identity-title">
    <p class="eyebrow"><?= lang_editable('pages.ritual.v3.identity.eyebrow', 'The idea') ?></p>
    <h2 id="identity-title"><?= lang_editable('pages.ritual.v3.identity.title', 'A love letter with a crowd around it.') ?></h2>
    <p class="section-lede"><?= lang_editable('pages.ritual.v3.identity.lede', 'This page does not need to spoil the show. The point is simpler: people still care, the songs still travel, the stories still matter, and September 26 gives everyone a place to gather around that feeling.') ?></p>
    <div class="proof-grid proof-grid--feature">
      <article><span class="proof-badge"><?= lang_editable('pages.ritual.v3.card.1.badge', '01') ?></span><h3><?= lang_editable('pages.ritual.v3.card.1.title', 'The fans') ?></h3><p><?= lang_editable('pages.ritual.v3.card.1.body', 'The heart of the night is the crowd: longtime fans, curious friends, road-trip crews, campers, locals, and anyone who understands why KISS still pulls people together.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.ritual.v3.card.2.badge', '02') ?></span><h3><?= lang_editable('pages.ritual.v3.card.2.title', 'The songs') ?></h3><p><?= lang_editable('pages.ritual.v3.card.2.body', 'You know the feeling before anyone explains it: choruses people remember, favorite moments people argue about, and the kind of music that turns strangers into a temporary club.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.ritual.v3.card.3.badge', '03') ?></span><h3><?= lang_editable('pages.ritual.v3.card.3.title', 'The place') ?></h3><p><?= lang_editable('pages.ritual.v3.card.3.body', 'Cycle Moore Legacy brings campground air, US 31 arrival, parking, camping options, and a relaxed gathering point for people who want the whole night to feel like an event.') ?></p></article>
      <article><span class="proof-badge"><?= lang_editable('pages.ritual.v3.card.4.badge', '04') ?></span><h3><?= lang_editable('pages.ritual.v3.card.4.title', 'The memory') ?></h3><p><?= lang_editable('pages.ritual.v3.card.4.body', 'The win is not complicated: give fans a reason to drive in, meet up, take pictures, sing loud, and talk about September 26 after they head home.') ?></p></article>
    </div>
  </section>

  <?php render_page_section_slot('/what-is-just-one-kiss/', 'before_section_03'); ?>
  <section class="section-shell date-card" aria-labelledby="tone-title">
    <p class="eyebrow"><?= lang_editable('pages.ritual.v3.tone.eyebrow', 'Over the top, but human') ?></p>
    <h2 id="tone-title"><?= lang_editable('pages.ritual.v3.tone.title', 'The vibe is big because the fans made it big first.') ?></h2>
    <p class="section-lede"><?= lang_editable('pages.ritual.v3.tone.body', 'Just One KISS is not trying to explain every surprise ahead of time. It is inviting the right people to the right place: people who love the attitude, the songs, the look, the stories, and the feeling of being in a crowd that gets it.') ?></p>
    <?php render_page_image('costume-chrome-detail.webp', lang_text('pages.what_is_just_one_kiss.image.2.alt', 'Mood: fan shirts, cameras, road-trip keepsakes, and campground details.')); ?>
  </section>

  <?php render_page_section_slot('/what-is-just-one-kiss/', 'before_section_04'); ?>
  <section class="section-shell spectacle-section" aria-labelledby="not-title">
    <p class="eyebrow"><?= lang_editable('pages.ritual.v3.not.eyebrow', 'What it is not') ?></p>
    <h2 id="not-title"><?= lang_editable('pages.ritual.v3.not.title', 'Not a lecture. Not a reveal sheet. Not homework.') ?></h2>
    <p class="section-lede"><?= lang_editable('pages.ritual.v3.not.body', 'It is a free show day for fans. The homepage gives the essentials, the FAQ gives the practical notes, and the rest is for everyone who decides to be there when September 26 arrives.') ?></p>
  </section>
  <?php render_page_section_slot('/what-is-just-one-kiss/', 'after_page'); ?>
</main>
<?php render_footer(false, ['summary_token' => 'pages.v2.footer.summary', 'summary' => 'Just One KISS · September 26, 2026 at 7:30 PM · Free show · Interlochen on US 31.', 'summary_prefix' => 'Just One KISS', 'details_token' => 'pages.v2.footer.details']); ?>
