<?php
/**
 * Purpose: This header partial starts the accessible owner-command shell, declares global metadata, loads static assets, and shows prototype/privacy posture before any module content appears.
 * Components to populate: document metadata, skip link, CSS includes, body classes, app landmark wrappers, prototype warning banner, auth/user badge placeholder, and future per-module head extensions.
 */
$config = center_config();
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= center_e($module['label']) ?> · <?= center_e($config['name']) ?></title>
  <link rel="stylesheet" href="assets/css/center.css">
</head>
<body>
<a class="skip-link" href="#center-main">Skip to owner content</a>
<div class="center-shell">
