<?php /** @var array $config */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= owner_e($currentMeta['label'] . ' | ' . $config['site_title']); ?></title>
    <link rel="stylesheet" href="assets/css/owner.css">
</head>
<body data-page="<?= owner_e($currentPage); ?>">
<a class="skip-link" href="#main-content">Skip to content</a>
<div class="app-shell">
    <aside class="sidebar" aria-label="Owner site navigation">
        <div class="brand-card">
            <p class="eyebrow"><?= owner_e($config['site_kicker']); ?></p>
            <h1><?= owner_e($config['site_title']); ?></h1>
            <p><?= owner_e($config['launch_focus']); ?></p>
        </div>
        <nav class="module-nav">
            <?php foreach ($navigation as $item): ?>
                <a class="nav-link <?= $item['id'] === $currentPage ? 'is-active' : ''; ?>" href="?page=<?= owner_e($item['id']); ?>">
                    <span><?= owner_e($item['label']); ?></span>
                    <small><?= owner_e($item['timeline_rule']); ?></small>
                </a>
            <?php endforeach; ?>
        </nav>
    </aside>
    <main id="main-content" class="content-panel">
        <section class="page-hero component-card">
            <p class="eyebrow">Owner module</p>
            <h2><?= owner_e($currentMeta['label']); ?></h2>
            <p><?= owner_e($currentMeta['description']); ?></p>
            <div class="hero-tags">
                <span><?= owner_e($currentMeta['timeline_rule']); ?></span>
                <span>Reusable vanilla PHP / JS / HTML / CSS scaffold</span>
            </div>
        </section>
