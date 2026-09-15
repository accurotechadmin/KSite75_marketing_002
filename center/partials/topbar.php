<?php
/**
 * Purpose: This topbar partial will hold the current module title, launch focus, search, review filters, and owner-action shortcuts so every page keeps the same command context.
 * Components to populate: module title, launch-date focus, global search box, Timeline/GEN filter, rights/safety/content filters, quick-create placeholder, export controls, and notification/red-flag strip.
 */
?>
<header class="center-topbar">
  <p class="eyebrow">Centralized Owner Management · Scaffold</p>
  <h1><?= center_e($module['label']) ?></h1>
  <p><?= center_e($module['description']) ?></p>
</header>
<main id="center-main" class="center-main">
