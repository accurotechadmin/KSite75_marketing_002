<?php
/**
 * Purpose: This sidebar partial will become the persistent owner navigation rail, giving the owner fast access to every command module while exposing each module's purpose and Timeline/GEN posture.
 * Components to populate: grouped navigation, active route state, quick filters, launch-priority badges, keyboard shortcuts, source/settings shortcuts, mobile drawer behavior, permission-aware nav, and module health indicators.
 */
?>
<aside class="center-sidebar" aria-label="Owner modules">
  <strong>Just One KISS Center</strong>
  <nav>
    <?php foreach ($navigation as $id => $item): ?>
      <a href="<?= center_e(center_url($id)) ?>"<?= $item === $module ? ' aria-current="page"' : '' ?>><?= center_e($item['label']) ?></a>
    <?php endforeach; ?>
  </nav>
</aside>
