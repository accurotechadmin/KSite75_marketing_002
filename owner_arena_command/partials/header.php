<?php require_once __DIR__.'/components.php'; require_once __DIR__.'/forms.php'; ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?= ac_e($currentMeta['label'].' · '.$config['site_name']); ?></title><link rel="stylesheet" href="assets/css/arena-command.css"></head>
<body><a class="skip-link" href="#main">Skip to main content</a><div class="app-shell">
<?php include __DIR__.'/sidebar.php'; ?><div class="workspace"><?php include __DIR__.'/topbar.php'; ?><main id="main" tabindex="-1"><?php ac_alert_strip($records); ?>
