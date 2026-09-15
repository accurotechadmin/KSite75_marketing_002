<?php
$root = dirname(__DIR__);
$repoRoot = dirname($root);
return [
    'site_name' => 'Just One KISS Second Rendition',
    'short_name' => 'Second Rendition',
    'default_page' => 'dashboard',
    // Preferred deployment path: keep JSON with this app at secondrendition/data/ssot/.
    'ssot_root' => $root . '/data/ssot',
    // Fallbacks make local development and accidental "copied data/ here" deployments recover gracefully.
    'ssot_roots' => [
        $root . '/data/ssot',
        $root . '/data',
        $repoRoot . '/data/ssot',
        $repoRoot . '/data',
        $repoRoot . '/owner_arena_command/data/ssot',
        $repoRoot . '/docs/ssot',
    ],
    'runtime_data_root' => $root . '/data/runtime',
    'launch_date' => '2026-07-25',
    'launch_focus' => 'Interlochen-focused owner command center',
];
