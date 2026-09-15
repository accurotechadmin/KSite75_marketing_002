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
render_header(lang_text('pages.faq.meta.v3.title', 'Just One KISS — FAQ and Show Notes'), lang_text('pages.faq.meta.v3.description', 'Answers for the free September 26, 2026 at 7:30 PM Just One KISS show at Cycle Moore Legacy: admission, arrival, camping, parking, updates, photos, and what fans should know.'));
render_notice($formResult);
$faqs = [
 ['pages.faq.v3.q1','pages.faq.v3.a1','Is the September 26 show really free?','Yes. Show admission is free. No ticket is required. Joining the update list is appreciated because it helps fans catch reminders, arrival notes, and event-day posts.'],
 ['pages.faq.v3.q2','pages.faq.v3.a2','Where is the show?','Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643. The venue phone listed for the location is 231-276-9091.'],
 ['pages.faq.v3.q3','pages.faq.v3.a3','What time should I arrive?','Final timing will be posted as the date gets closer. Arrive with enough room to park, find your people, look around, and settle into the rally before the night gets moving.'],
 ['pages.faq.v3.q4','pages.faq.v3.a4','Where do I park?','Parking is outside the gate. Overflow and handicap parking available.'],
 ['pages.faq.v3.q5','pages.faq.v3.a5','Is camping part of the event?',null],
 ['pages.faq.v3.q6','pages.faq.v3.a6','What kind of night is this?','A fan-centered KISS tribute gathering: free admission, campground atmosphere, people showing up for the songs they love, and a shared reason to make September 26 feel bigger than an ordinary Saturday.'],
 ['pages.faq.v3.q7','pages.faq.v3.a7','Is this only for hardcore fans?','Hardcore fans will know exactly why they are there, but curious friends are welcome too. If someone loves big rock attitude, crowd energy, and a summer hangout with a memorable reason, they will understand quickly.'],
 ['pages.faq.v3.q8','pages.faq.v3.a8','What should I expect from the show?','Expect a committed tribute night and let the rest reveal itself when you arrive. The point is to be there with other fans, not to read the whole surprise in advance.'],
 ['pages.faq.v3.q9','pages.faq.v3.a9','Can I bring a chair or blanket?','Outdoor comfort items are a good idea unless event-day posts say otherwise. Watch for updates closer to September 26 so you know what fits best around the pavilion area.'],
 ['pages.faq.v3.q10','pages.faq.v3.a10','Can I take photos or video?','Bring the camera. Fan photos, clips, reactions, and arrival posts are part of the fun. Watch the update list for any event-day sharing notes.'],
 ['pages.faq.v3.q11','pages.faq.v3.a11','Will there be food or vendors?','Details may evolve as the event gets closer. The update list is the best place to catch practical notes once the day-of shape is confirmed.'],
 ['pages.faq.v3.q12','pages.faq.v3.a12','What should I bring?','Think outdoor summer show: water, layers for after dark, comfortable footwear, phone charge, camping gear if staying overnight, and enough voice left for the choruses.'],
 ['pages.faq.v3.q13','pages.faq.v3.a13','Can kids come?','The event is presented for fans and families who are comfortable with a loud theatrical rock atmosphere. Use your judgment for younger guests and anyone who prefers lower intensity.'],
 ['pages.faq.v3.q14','pages.faq.v3.a14','What happens if details change?','The site and update list will carry the current notes. Outdoor events can have moving parts, so check back before you drive.'],
 ['pages.faq.v3.q15','pages.faq.v3.a15','How do I ask something not listed here?','Use the contact page. Send the question, pick the closest topic, and the show can route it to the right person before September 26.'],
 ['pages.faq.v3.q16','pages.faq.v3.a16','Why make it this over the top?','Because KISS fans do not gather for ordinary. They gather for stories, friends, favorite songs, big attitude, and the feeling that everyone in the place came for the same reason.'],
];
?>
<main id="main">
  <?php render_page_section_slot('/faq-disclaimer/', 'before_page'); ?>
  <?php render_page_section_slot('/faq-disclaimer/', 'before_section_01'); ?>
  <section class="subhero section-shell" aria-labelledby="page-title">
    <p class="eyebrow"><?= lang_editable('pages.faq.v3.hero.eyebrow', 'Answers for the faithful') ?></p>
    <h1 id="page-title"><?= lang_editable('pages.faq.v3.hero.title', 'FAQ and Show Notes') ?></h1>
    <p class="hero__lede"><?= lang_editable('pages.faq.v3.hero.lede', 'Here is the practical stuff and the fan stuff for September 26 at Cycle Moore Legacy. The rest is better discovered in person, surrounded by people who came because KISS still means something to them.') ?></p>
    <div class="cta-row"><a class="button button--fire" href="<?= e(page_url('/')) ?>#updates"><?= lang_editable('pages.faq.v3.cta.updates', 'Join updates') ?></a><a class="button button--chrome" href="<?= e(page_url('/contact/')) ?>#contact"><?= lang_editable('pages.faq.v3.cta.contact', 'Ask a question') ?></a></div>
    <?php render_page_image('road-case-vault-bg.webp', lang_text('pages.faq_disclaimer.image.1.alt', 'Hero: fan question cards and September 26 notes arranged on a road case.')); ?>
  </section>

  <?php render_page_section_slot('/faq-disclaimer/', 'before_section_02'); ?>
  <section class="section-shell faq-section" aria-labelledby="faq-title">
    <p class="eyebrow"><?= lang_editable('pages.faq.v3.list.eyebrow', 'FAQ') ?></p>
    <h2 id="faq-title"><?= lang_editable('pages.faq.v3.list.title', 'Everything fans keep asking.') ?></h2>
    <div class="faq-grid"><?php foreach ($faqs as $faq): ?><article><h3><?= lang_editable($faq[0], $faq[2]) ?></h3><p><?= lang_editable($faq[1], $faq[3]) ?></p></article><?php endforeach; ?></div>
  </section>

  <?php render_page_section_slot('/faq-disclaimer/', 'before_section_03'); ?>
  <section class="section-shell date-card" aria-labelledby="closing-title">
    <p class="eyebrow"><?= lang_editable('pages.faq.v3.closing.eyebrow', 'The short version') ?></p>
    <h2 id="closing-title"><?= lang_editable('pages.faq.v3.closing.title', 'Free show. US 31. Campground crowd. Big fan energy.') ?></h2>
    <p class="section-lede"><?= lang_editable('pages.faq.v3.closing.body') ?></p>
    <?php render_page_image('interlochen-dispatch-map.webp', lang_text('pages.faq_disclaimer.image.2.alt', 'Closing: fans arriving near the pavilion at dusk before the show.')); ?>
  </section>
  <?php render_page_section_slot('/faq-disclaimer/', 'after_page'); ?>
</main>
<?php render_footer(false, ['summary_token' => 'pages.v2.footer.summary', 'summary' => 'Just One KISS · September 26, 2026 at 7:30 PM · Free show · Interlochen on US 31.', 'summary_prefix' => 'Just One KISS', 'details_token' => 'pages.v2.footer.details']); ?>
