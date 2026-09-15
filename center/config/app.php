<?php
/** Safe defaults for the deployment-simple `/center` owner command center. */
return [
    'name' => 'Just One KISS Center',
    'default_page' => 'dashboard',
    'launch_focus' => 'Interlochen, Michigan-area event on July 25, 2026',
    'production_direction' => 'Production-intended private owner command center and first-stage CMS adapter for proto/.',
    'deployment_model' => 'Vanilla PHP/HTML/CSS/JS with local JSON/PHP files; no package manager, framework, remote runtime service, or GitHub dependency.',
    'settings_manifest_path' => dirname(__DIR__, 2) . '/docs/ssot/settings_manifest.json',
    'domain_ssot_root' => dirname(__DIR__, 2) . '/docs/ssot',
    'proto_root' => dirname(__DIR__, 2) . '/proto',
    'runtime_root' => __DIR__ . '/../storage',
    'first_class_modules' => ['dashboard','priority-board','release-gates','provenance-ledger','integrity'],
    'readiness_statuses' => ['draft','internal-ready','venue-ready','public-ready'],
    'prototype_notice' => 'Scaffold only: public publishing, authentication, uploads, CRUD, direct proto writes, and audit trails are intentionally deferred.',
];
