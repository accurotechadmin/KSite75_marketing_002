<?php

declare(strict_types=1);

require_once __DIR__ . '/language.php';

function site_pages(): array
{
    return [
        '/' => ['label' => 'Home', 'title' => 'Just One KISS — Free Show Updates', 'nav' => false, 'summary' => 'Main landing page for the July 25, 2026 free show in Interlochen on US 31.'],
        '/july-25-2026/' => ['label' => lang_text('landing.nav.free_show', 'Free Show'), 'title' => 'July 25, 2026 Free Show', 'nav' => true, 'summary' => 'Date, free admission, event updates, and safety notes.'],
        '/what-is-just-one-kiss/' => ['label' => lang_text('landing.nav.ritual', 'The Ritual'), 'title' => 'What Is Just One KISS?', 'nav' => true, 'summary' => 'About the independent theatrical tribute show.'],
        '/spectacle/' => ['label' => lang_text('landing.nav.spectacle', 'Spectacle'), 'title' => 'The Spectacle', 'nav' => true, 'summary' => 'Lights, projection, fog, strobes, costume energy, and stage attitude.'],
        '/vault/' => ['label' => 'Vault', 'title' => 'Fan Vault', 'nav' => false, 'summary' => 'Road-case relic energy for approved future photos and media.'],
        '/video/' => ['label' => 'Video', 'title' => 'Trailer and Clips', 'nav' => false, 'summary' => 'Approved original trailer and clip slots.'],
        '/directions/' => ['label' => lang_text('landing.nav.directions', 'Directions'), 'title' => 'Directions', 'nav' => true, 'summary' => 'Cycle Moore Legacy address, arrival, camping, parking, and map details.'],
        '/contact-press/' => ['label' => 'Contact the Show', 'title' => 'Contact Redirect', 'nav' => false, 'summary' => 'Retired legacy contact route that redirects to /contact/.'],
        '/technical/' => ['label' => 'Technical', 'title' => 'Technical Overview', 'nav' => false, 'summary' => 'Technical overview for the Interlochen show setup.'],
        '/faq-disclaimer/' => ['label' => lang_text('landing.nav.faq', 'FAQ'), 'title' => 'FAQ and Safety', 'nav' => true, 'summary' => 'Free show status, safety warning, accessibility path, and independent tribute disclaimer.'],
        '/contact/' => ['label' => lang_text('landing.nav.contact', 'Contact'), 'title' => 'Contact the Show', 'nav' => true, 'summary' => 'Contact routing for fans, Facebook/media sharing, accessibility questions, and general.'],
        '/preserve-backup/' => ['label' => 'Preserve Backup', 'title' => 'Preserve Website Files', 'nav' => false, 'summary' => 'Owner utility for backing up protected website copy, style, asset, and CMS state files.'],
    ];
}

function image_inventory(): array
{
    return [
        'costume-chrome-detail.webp',
        'fog-strobe-atmosphere.webp',
        'gear-control-dossier.webp',
        'hero-stage-portal.webp',
        'interlochen-dispatch-map.webp',
        'press-performer-portrait.webp',
        'road-case-vault-bg.webp',
        'spectacle-lighting-rig.webp',
        'trailer-poster-stage-portal.webp',
    ];
}
