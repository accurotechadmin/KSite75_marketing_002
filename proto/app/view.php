<?php

declare(strict_types=1);

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/csrf.php';
require_once __DIR__ . '/language.php';
require_once __DIR__ . '/site_data.php';
require_once __DIR__ . '/layer_runtime.php';

function page_depth(): int
{
    $scriptName = (string) ($_SERVER['SCRIPT_NAME'] ?? '');
    $scriptDir = trim(str_replace('\\', '/', dirname($scriptName)), '/');

    if ($scriptDir === '' || $scriptDir === '.') {
        return 0;
    }

    $segments = array_values(array_filter(explode('/', $scriptDir), static fn (string $segment): bool => $segment !== ''));
    $publicIndex = array_search('public', $segments, true);
    if ($publicIndex !== false) {
        $segments = array_slice($segments, $publicIndex + 1);
    }

    return count($segments);
}

function depth_prefix(): string
{
    return str_repeat('../', page_depth());
}

function rel_url(string $path = ''): string
{
    $path = ltrim($path, '/');
    $prefix = depth_prefix();

    if ($path === '') {
        return $prefix === '' ? './' : $prefix;
    }

    return ($prefix === '' ? './' : $prefix) . $path;
}

function page_url(string $route): string
{
    if ($route === '/') {
        return rel_url('index.php');
    }
    return rel_url(trim($route, '/') . '/');
}

function public_asset_file(string $relativePath): string
{
    $relativePath = ltrim($relativePath, '/');
    $scriptDir = dirname((string) ($_SERVER['SCRIPT_FILENAME'] ?? ''));
    $scriptAsset = $scriptDir . '/' . $relativePath;
    if ($scriptDir !== '' && is_file($scriptAsset)) {
        return $scriptAsset;
    }

    return __DIR__ . '/../public/' . $relativePath;
}

function asset_base_url(): string
{
    return rel_url('assets/img/');
}

function asset_style(string $filename): string
{
    $basename = basename($filename);

    return ' style="--asset-image: url(\'' . e(asset_base_url() . rawurlencode($basename)) . '\');"';
}

function render_inline_asset(string $relativePath, string $tag): void
{
    $asset = __DIR__ . '/../public/' . ltrim($relativePath, '/');
    if (!is_file($asset) || !is_readable($asset)) {
        return;
    }

    $contents = file_get_contents($asset);
    if ($contents === false || $contents === '') {
        return;
    }

    if ($tag === 'style') {
        $contents = str_replace(
            ["url('../font/", 'url(../font/'],
            ["url('" . rel_url('assets/font/') . "", 'url(' . rel_url('assets/font/')],
            $contents
        );
        echo "<style data-inline-fallback=\"site-css\">\n" . $contents . "\n</style>\n";
        return;
    }

    if ($tag === 'script') {
        echo "<script data-inline-fallback=\"site-js\">\n" . $contents . "\n</script>\n";
    }
}

function render_media_grid(array $items): void
{
    if ($items === []) {
        return;
    }

    echo '<div class="media-grid">';
    foreach ($items as $filename => $label) {
        if (is_int($filename)) {
            $filename = (string) $label;
            $label = pathinfo($filename, PATHINFO_FILENAME);
        }
        $basename = basename((string) $filename);
        echo '<figure class="image-slot">';
        echo '<img src="' . e(asset_base_url() . rawurlencode($basename)) . '" alt="' . e((string) $label) . '" loading="lazy">';
        echo '<figcaption><strong>' . e((string) $label) . '</strong><span>' . e($basename) . '</span></figcaption>';
        echo '</figure>';
    }
    echo '</div>';
}

function active_page_image_handle(string $filename): string
{
    $basename = basename($filename);
    $route = function_exists('jok_layer_runtime_route') ? jok_layer_runtime_route() : '/';
    $state = function_exists('jok_layer_state') ? jok_layer_state() : [];
    $replacement = $state['asset_replacements'][$route][$basename]['new_handle'] ?? '';
    $replacement = is_string($replacement) ? basename($replacement) : '';

    if ($replacement !== '' && is_file(__DIR__ . '/../public/assets/img/' . $replacement)) {
        return $replacement;
    }

    $metadataBySection = $state['image_asset_metadata'][$basename] ?? [];
    if (is_array($metadataBySection)) {
        foreach ($metadataBySection as $metadata) {
            if (!is_array($metadata)) {
                continue;
            }

            $metadataRoute = (string) ($metadata['route'] ?? '');
            if ($metadataRoute !== '' && $metadataRoute !== $route) {
                continue;
            }

            $selectedAsset = basename((string) ($metadata['selected_asset'] ?? ''));
            if ($selectedAsset !== '' && is_file(__DIR__ . '/../public/assets/img/' . $selectedAsset)) {
                return $selectedAsset;
            }
        }
    }

    return $basename;
}

function render_page_image(string $filename, string $alt): void
{
    $basename = active_page_image_handle($filename);
    ?><figure class="page-image">
      <img src="<?= e(asset_base_url() . rawurlencode($basename)) ?>" alt="<?= e($alt) ?>" loading="lazy">
    </figure><?php
}

function render_header(string $title, string $description): void
{
    language_admin_maybe_start_session();
    jok_layer_runtime_start();
    $pages = site_pages();
    ?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= e($description) ?>">
  <title><?= e($title) ?></title>
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' fill='%23050505'/%3E%3Ctext x='16' y='22' text-anchor='middle' font-size='18' fill='%23f06a21' font-family='Arial,sans-serif' font-weight='700'%3EJ%3C/text%3E%3C/svg%3E">
  <link rel="stylesheet" href="<?= e(rel_url('assets/css/site.css')) ?>">
  <?php render_inline_asset('assets/css/site.css', 'style'); ?>
</head>
<body>
<a class="skip-link" href="#main"><?= lang_editable('landing.global.skip_link', 'Skip to content') ?></a>
<header class="site-header">
  <a class="brand-mark" href="<?= e(page_url('/')) ?>" aria-label="<?= e(lang_text('landing.global.brand.aria', 'Just One KISS home')) ?>"><span><?= lang_editable('landing.global.brand.line1', 'Just One') ?></span><strong><?= lang_editable('landing.global.brand.line2', 'KISS') ?></strong></a>
  <button class="nav-toggle" type="button" aria-controls="primary-nav" aria-expanded="false" aria-label="<?= e(lang_text('landing.global.nav.menu', 'Open navigation')) ?>"><span class="nav-toggle__bars" aria-hidden="true"></span></button>
  <nav id="primary-nav" class="top-nav" aria-label="<?= e(lang_text('landing.global.nav.aria', 'Primary navigation')) ?>">
    <?php foreach ($pages as $route => $page): ?>
      <?php if (($page['nav'] ?? false) === true): ?><a href="<?= e(page_url($route)) ?>"><?= e($page['label']) ?></a><?php endif; ?>
    <?php endforeach; ?>
    <a class="nav-cta button button--fire" href="<?= e(page_url('/')) ?>#updates"><?= lang_editable('landing.global.nav.cta', 'Join Updates') ?></a>
  </nav>
</header>
<?php
}

function render_notice(?array $formResult): void
{
    if (!$formResult) {
        return;
    }
    $noticeStatus = $formResult['ok'] ? 'ok' : 'error';
    ?><div class="notice notice--<?= e($noticeStatus) ?>" data-form-notice="<?= e($noticeStatus) ?>" aria-live="polite"><div class="container"><?= e($formResult['message']) ?></div></div><?php
}

function render_event_information(): void
{
    $cards = [
        ['1', 'Admission', 'Free show. No ticket is required; RSVP/update-list signup is appreciated so confirmed details can reach you.'],
        ['2', 'Location / parking', 'Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643. Parking is outside the gate. Overflow and handicap parking available.'],
        ['3', 'Camping', null],
        ['4', 'Fog / strobes', 'Loud sound, bright lights, fog, and flashing patterns or strobe-style looks may be used. Sensitive guests should plan accordingly.'],
        ['5', 'Independent tribute', 'Independent theatrical tribute presentation. No official affiliation, sponsorship, authorization, endorsement, ownership, or approval is claimed.'],
    ];
    ?>
<section class="event-footer section-shell" aria-labelledby="event-info-title">
  <p class="eyebrow"><?= lang_editable('landing.event_footer.eyebrow', 'Event information') ?></p>
  <h2 id="event-info-title"><?= lang_editable('landing.event_footer.title', 'Before you roll in.') ?></h2>
  <div class="event-footer__grid">
    <?php foreach ($cards as $index => $card): ?>
      <article class="event-footer__card">
        <span><?= lang_editable('landing.event_footer.card.' . $card[0] . '.badge', str_pad($card[0], 2, '0', STR_PAD_LEFT)) ?></span>
        <h3><?= lang_editable('landing.event_footer.card.' . $card[0] . '.title', $card[1]) ?></h3>
        <p><?= lang_editable('landing.event_footer.card.' . $card[0] . '.body', $card[2]) ?></p>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php
}

function render_footer(bool $includeEventInformation = true, ?array $footerCopy = null): void
{
    if ($includeEventInformation) {
        render_event_information();
    }
    $summaryToken = $footerCopy['summary_token'] ?? 'landing.footer.summary';
    $summaryFallback = $footerCopy['summary'] ?? 'Just One KISS · September 26, 2026 at 7:30 PM · Free show · Interlochen on US 31. Independent theatrical tribute presentation; no official affiliation, sponsorship, authorization, or endorsement is claimed.';
    $summaryPrefix = $footerCopy['summary_prefix'] ?? 'Just One KISS';
    $detailsToken = $footerCopy['details_token'] ?? 'landing.footer.event_safety';
    $detailsFallback = $footerCopy['details'] ?? 'You wanted the best? You got the best. Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643. Parking is outside the gate, just off US-31. Overflow and handicap parking available. Fog, loud sound, bright lights, and flashing patterns may be used.';
    ?>
<footer class="site-footer">
  <div class="container footer-grid">
    <p><?= lang_editable_with_strong_prefix($summaryToken, $summaryFallback, $summaryPrefix) ?></p>
    <p><?= lang_editable($detailsToken, $detailsFallback) ?></p>
  </div>
</footer>
<div class="mobile-cta"><a class="button button--fire" href="<?= e(page_url('/september-26-2026/')) ?>#updates"><?= lang_editable('landing.mobile.cta', 'Join the September 26 update list') ?></a></div>

<?php if (language_admin_is_logged_in()): ?>
<style data-inline-admin-language>
  .jok-lang-token { outline:1px dashed rgba(242,194,48,.7); outline-offset:.14rem; cursor:text; border-radius:.18rem; }
  .jok-lang-token:hover, .jok-lang-token:focus { background:rgba(242,194,48,.14); box-shadow:0 0 0 .22rem rgba(242,194,48,.14); }
  .jok-lang-toolbar { position:fixed; right:1rem; bottom:1rem; z-index:9999; width:min(420px, calc(100vw - 2rem)); color:#f4efe6; background:rgba(5,5,5,.94); border:1px solid rgba(242,194,48,.45); border-radius:18px; box-shadow:0 24px 70px rgba(0,0,0,.55); padding:1rem; font:14px/1.35 system-ui, sans-serif; }
  .jok-lang-toolbar label { display:grid; gap:.35rem; color:#b8bcc2; font-weight:800; }
  .jok-lang-toolbar textarea { width:100%; min-height:110px; color:#f4efe6; background:#09090c; border:1px solid rgba(220,225,235,.25); border-radius:12px; padding:.7rem; font:inherit; }
  .jok-lang-toolbar__actions { display:flex; gap:.5rem; flex-wrap:wrap; margin-top:.75rem; }
  .jok-lang-toolbar button, .jok-lang-toolbar a { border:1px solid rgba(220,225,235,.25); border-radius:999px; padding:.55rem .75rem; color:#f4efe6; background:rgba(255,255,255,.08); font-weight:850; text-decoration:none; cursor:pointer; }
  .jok-lang-toolbar button[data-lang-save] { color:#170604; background:linear-gradient(135deg,#f2c230,#f06a21 55%,#b20d18); border-color:rgba(255,232,91,.72); }
  .jok-lang-status { margin-top:.6rem; color:#f2c230; }
</style>
<script>window.JOK_INLINE_LANGUAGE_ADMIN = <?= lang_inline_admin_payload() ?>;</script>
<?php endif; ?>
<script>window.JOK_LANGUAGE = <?= lang_json_for_js(['landing.countdown.live_message' => 'The September 26 signal is live — check event updates.', 'landing.countdown.active_template' => '{days} days · {hours} hrs · {minutes} min · {seconds} sec to go!', 'landing.form.enhanced_submit_status' => 'Checking the signal…']) ?>;</script>
<script src="<?= e(rel_url('assets/js/site.js')) ?>"></script>
<?php render_inline_asset('assets/js/site.js', 'script'); ?>
</body>
</html><?php
    jok_layer_runtime_finish();
}

function render_lead_form(string $csrf): void
{
    ?><form method="post" class="site-form site-form--rally" data-enhance-form novalidate>
      <input type="hidden" name="form_type" value="lead">
      <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
      <label class="hp"><?= lang_editable('landing.form.lead.honeypot.label', 'Website') ?> <input name="website" tabindex="-1" autocomplete="off"></label>
      <label><?= lang_editable('landing.form.lead.email.label', 'Email') ?> <input name="email" type="email" autocomplete="email" placeholder="<?= e(lang_text('landing.form.lead.email.placeholder', 'you@example.com')) ?>" required></label>
      <label><?= lang_editable('landing.form.lead.city_zip.label', 'City / ZIP') ?> <input name="city_zip" autocomplete="postal-code" placeholder="<?= e(lang_text('landing.form.lead.city_zip.placeholder', 'Interlochen, MI')) ?>" required></label>
      <details class="optional-topics">
        <summary><?= lang_editable('landing.form.lead.details.summary', 'Open the update drawer') ?></summary>
        <fieldset data-check-group><legend class="sr-only"><?= lang_editable('landing.form.lead.legend', 'Update topics') ?></legend>
          <label class="check-all"><input type="checkbox" data-check-all checked> <?= lang_editable('landing.form.lead.select_all', 'Select all update topics') ?></label>
          <label><input type="checkbox" name="interest_tags[]" value="event_updates" checked> <?= lang_editable('landing.form.lead.topic.event_updates', 'Event updates') ?></label>
          <label><input type="checkbox" name="interest_tags[]" value="directions_info" checked> <?= lang_editable('landing.form.lead.topic.directions', 'Directions, camping, parking, and access') ?></label>
          <label><input type="checkbox" name="interest_tags[]" value="media_drops" checked> <?= lang_editable('landing.form.lead.topic.media', 'Photos, video, fan posts, and stage drops') ?></label>
          <label><input type="checkbox" name="interest_tags[]" value="collector_relic_updates" checked> <?= lang_editable('landing.form.lead.topic.vault', 'Fan vault chats and gallery drops') ?></label>
        </fieldset>
      </details>
      <p class="form-help"><?= lang_editable('landing.form.lead.help', 'No spam. Safety and access notes are folded into the main event, arrival, media, and Fan Vault drops.') ?></p>
      <label class="consent consent--required"><input type="checkbox" name="consent" required> <?= lang_editable('landing.form.lead.consent', 'Required: I agree to receive Just One KISS show updates.') ?></label>
      <button class="button button--fire" type="submit" data-track="lead-submit"><?= lang_editable('landing.form.lead.submit', 'Get the September 26 drop') ?></button>
      <p class="form-status" data-form-status aria-live="polite"></p>
    </form><?php
}

function render_inquiry_form(string $csrf): void
{
    ?><form method="post" class="site-form" data-enhance-form novalidate>
      <input type="hidden" name="form_type" value="inquiry">
      <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
      <label class="hp"><?= lang_editable('landing.form.lead.honeypot.label', 'Website') ?> <input name="website" tabindex="-1" autocomplete="off"></label>
      <label><?= lang_editable('landing.form.inquiry.email.label', 'Email') ?> <input name="inquiry_email" type="email" autocomplete="email" required></label>
      <label><?= lang_editable('landing.form.inquiry.name.label', 'Name') ?> <span><?= lang_editable('landing.form.inquiry.optional', 'optional') ?></span> <input name="inquiry_name" autocomplete="name"></label>
      <label><?= lang_editable('landing.form.inquiry.organization.label', 'Organization / location') ?> <input name="organization" autocomplete="organization" required></label>
      <label><?= lang_editable('landing.form.inquiry.facebook.label', 'Facebook profile or page') ?> <span><?= lang_editable('landing.form.inquiry.facebook.optional', 'optional') ?></span> <input name="facebook_contact" autocomplete="url" placeholder="<?= e(lang_text('landing.form.inquiry.facebook.placeholder', 'Your Facebook link or name')) ?>"></label>
      <label><?= lang_editable('landing.form.inquiry.event_date.label', 'Event date') ?> <input name="event_date" type="date"></label>
      <label><?= lang_editable('landing.form.inquiry.city_state.label', 'City / state') ?> <input name="city_state" autocomplete="address-level2"></label>
      <label><?= lang_editable('landing.form.inquiry.category.label', 'Inquiry type') ?> <select name="inquiry_category" required><option value="general"><?= lang_editable('landing.form.inquiry.category.general', 'General question') ?></option><option value="press"><?= lang_editable('landing.form.inquiry.category.press', 'Facebook / media / sharing') ?></option><option value="venue_availability"><?= lang_editable('landing.form.inquiry.category.venue_availability', 'Venue availability') ?></option><option value="technical"><?= lang_editable('landing.form.inquiry.category.technical', 'Technical question') ?></option><option value="accessibility"><?= lang_editable('landing.form.inquiry.category.accessibility', 'Accessibility / safety') ?></option></select></label>
      <label><?= lang_editable('landing.form.inquiry.message.label', 'Message') ?> <textarea name="message" required data-example="<?= e(lang_text('landing.form.inquiry.message.example', 'Tell us what you need to know about the show.')) ?>"></textarea></label>
      <label class="consent consent--required"><input type="checkbox" name="consent" required> <?= lang_editable('landing.form.inquiry.consent', 'Required: I agree to be contacted about this inquiry.') ?></label>
      <button class="button button--chrome" type="submit" data-track="inquiry-submit"><?= lang_editable('landing.form.inquiry.submit', 'Contact the show') ?></button>
      <p class="form-status" data-form-status aria-live="polite"></p>
    </form><?php
}
