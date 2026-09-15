<?php

declare(strict_types=1);

/**
 * One-purpose browser deployer for the September 26 public-site update.
 *
 * Upload this entire proto directory as /updated, then visit
 * /updated/deploy-september-26.php. The script only installs the files in
 * DEPLOY_FILES and retires the obsolete event-route entrypoint.
 */

const DEPLOY_CONFIRMATION = 'DEPLOY SEPTEMBER 26 UPDATE';
const TARGET_ROOT_OVERRIDE = '';

const DEPLOY_FILES = [
    'app/language.php' => '2e2818e1f709a05b2ef32dd94cb0664dea1df9d232addf830e9fbb06e2a5d849',
    'app/mailer.php' => 'acf3af4272ac8f663e51ab48d51a301b4a49d3551eca912255ff0756bbf1ad57',
    'app/site_data.php' => '2978c1566dab24f742088e7448cafa24d665e43d4a175905fca4dad7fe7f2b5c',
    'app/view.php' => 'f284f47c407611bba2e6d1273e9608cb89f04ecb26b446ddec20832b16a32863',
    'docs/language.json' => '5253a6dd21ec9270940307da8be664f5e5f4cbe9687ebf8d7facb1ae9f955933',
    'public/assets/js/site.js' => 'c0015ef7529fcb205bc424f40c5cb0c1532ba4371c28d1b5b6f1946dbf06c3bb',
    'public/contact/index.php' => '5c4f2e1567e45231ee085e13e3b366f7da654dec78b4ed173d6bfdb637b184a8',
    'public/directions/index.php' => 'f0aa835d62471f83b96096130c3af93cedfd74ae7e7e757577fe315f1ec3d3c2',
    'public/faq-disclaimer/index.php' => '6d81c8fbe7eb526d7b8a6f7a6722dc342db10bb630edc953a426dd854df98601',
    'public/index.php' => '5e0de2044f537c7879b6c56ee05d93c2a55c48d1a361c9124ce05153853ab971',
    'public/september-26-2026/index.php' => 'd9c646d7c519b372f0ba682a430ebba1421a086f498bfd902b61ac3afc632c0e',
    'public/spectacle/index.php' => '4cbead83e09ba2726b952b1aa248ffcffff2d568b09021eb81d4750f6110c38e',
    'public/technical/index.php' => '69481b16cf1d53f8bb0193204eb07755fbe9b26c4ae9b0a5c2164b9a17e731d3',
    'public/vault/index.php' => 'b7cd24b99968fb923bbf0740e1e83e5974a39a71137714b26062294fe2a6bb18',
    'public/video/index.php' => '377f7909b6af5176068dee2c7e9fc31bf5162599b372cb16ebf1260e2c465bb3',
    'public/what-is-just-one-kiss/index.php' => 'cd67ccd251a9d4e4484d66b519d0f2fe53f9bacdcc8a6548a6a29d5d5a323710',
];

const RETIRED_FILES = [
    'public/july-25-2026/index.php',
];

header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-store, max-age=0');
header('X-Content-Type-Options: nosniff');
header('X-Robots-Tag: noindex, nofollow, noarchive');

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function normalize_path(string $path): string
{
    return rtrim(str_replace('\\', '/', $path), '/');
}

function looks_like_proto_root(string $path): bool
{
    return is_file($path . '/app/view.php')
        && is_file($path . '/docs/language.json')
        && is_file($path . '/public/index.php');
}

function detect_target_root(string $sourceRoot): array
{
    if (TARGET_ROOT_OVERRIDE !== '') {
        $target = realpath(TARGET_ROOT_OVERRIDE);
        if ($target === false || !looks_like_proto_root(normalize_path($target))) {
            return [null, 'TARGET_ROOT_OVERRIDE does not identify an existing proto application root.'];
        }

        return [normalize_path($target), null];
    }

    $parent = normalize_path(dirname($sourceRoot));
    $candidates = [$parent, $parent . '/proto'];
    $matches = [];
    foreach ($candidates as $candidate) {
        $resolved = realpath($candidate);
        if ($resolved === false) {
            continue;
        }
        $resolved = normalize_path($resolved);
        if ($resolved !== $sourceRoot && looks_like_proto_root($resolved)) {
            $matches[$resolved] = true;
        }
    }

    $matches = array_keys($matches);
    if (count($matches) !== 1) {
        return [null, 'Could not identify exactly one live proto root. Set TARGET_ROOT_OVERRIDE at the top of this file to the absolute live proto path.'];
    }

    return [$matches[0], null];
}

function validate_package(string $sourceRoot): array
{
    $errors = [];
    foreach (DEPLOY_FILES as $relative => $expectedHash) {
        $source = $sourceRoot . '/' . $relative;
        if (!is_file($source) || is_link($source) || !is_readable($source)) {
            $errors[] = 'Missing or unreadable package file: ' . $relative;
            continue;
        }
        if (!hash_equals($expectedHash, hash_file('sha256', $source))) {
            $errors[] = 'Package checksum mismatch: ' . $relative;
        }
    }

    return $errors;
}

function install_file(string $source, string $destination): void
{
    $directory = dirname($destination);
    if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
        throw new RuntimeException('Could not create directory: ' . $directory);
    }
    if (is_link($directory) || is_link($destination)) {
        throw new RuntimeException('Refusing to write through a symbolic link: ' . $destination);
    }

    $temporary = $directory . '/.' . basename($destination) . '.sep26-' . bin2hex(random_bytes(6)) . '.tmp';
    if (!copy($source, $temporary)) {
        throw new RuntimeException('Could not stage: ' . $destination);
    }
    chmod($temporary, is_file($destination) ? (fileperms($destination) & 0777) : 0644);
    if (!rename($temporary, $destination)) {
        @unlink($temporary);
        throw new RuntimeException('Could not install: ' . $destination);
    }
}

$sourceRoot = normalize_path(__DIR__);
[$targetRoot, $targetError] = detect_target_root($sourceRoot);
$packageErrors = validate_package($sourceRoot);
$messages = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $confirmation = trim((string) ($_POST['confirmation'] ?? ''));
    if ($targetError !== null) {
        $messages[] = $targetError;
    } elseif ($packageErrors !== []) {
        $messages = array_merge($messages, $packageErrors);
    } elseif (!hash_equals(DEPLOY_CONFIRMATION, $confirmation)) {
        $messages[] = 'Confirmation phrase did not match. Nothing was changed.';
    } else {
        try {
            foreach (DEPLOY_FILES as $relative => $_expectedHash) {
                install_file($sourceRoot . '/' . $relative, $targetRoot . '/' . $relative);
            }
            foreach (RETIRED_FILES as $relative) {
                $obsolete = $targetRoot . '/' . $relative;
                if (is_file($obsolete) && !is_link($obsolete) && !unlink($obsolete)) {
                    throw new RuntimeException('Could not retire obsolete file: ' . $obsolete);
                }
                $obsoleteDirectory = dirname($obsolete);
                if (is_dir($obsoleteDirectory)) {
                    @rmdir($obsoleteDirectory);
                }
            }
            $success = true;
            $messages[] = 'Installed exactly ' . count(DEPLOY_FILES) . ' files and retired the obsolete event entrypoint.';
            $messages[] = 'Delete the /updated directory from the server now.';
        } catch (Throwable $error) {
            $messages[] = 'Deployment stopped: ' . $error->getMessage();
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>September 26 site update</title>
  <style>
    body{max-width:900px;margin:3rem auto;padding:0 1rem;background:#111;color:#eee;font:16px/1.5 system-ui,sans-serif}code{color:#ffd45a}li{margin:.3rem 0}.panel{padding:1rem 1.25rem;border:1px solid #555;border-radius:.6rem;margin:1rem 0}.ok{border-color:#48bd72}.error{border-color:#e05a4f}input{width:100%;box-sizing:border-box;padding:.75rem;margin:.4rem 0 1rem}button{padding:.75rem 1rem;font-weight:700;cursor:pointer}
  </style>
</head>
<body>
  <h1>September 26 public-site update</h1>
  <div class="panel <?= $success ? 'ok' : ($messages !== [] ? 'error' : '') ?>">
    <p><strong>Package:</strong> <code><?= h($sourceRoot) ?></code></p>
    <p><strong>Detected live application:</strong> <code><?= h($targetRoot ?? 'not detected') ?></code></p>
    <?php foreach ($messages as $message): ?><p><?= h($message) ?></p><?php endforeach; ?>
    <?php foreach ($packageErrors as $error): ?><p><?= h($error) ?></p><?php endforeach; ?>
  </div>

  <h2>Exact allowlist</h2>
  <p>No file outside this list will be installed:</p>
  <ul><?php foreach (array_keys(DEPLOY_FILES) as $file): ?><li><code><?= h($file) ?></code></li><?php endforeach; ?></ul>

  <?php if (!$success && $targetError === null && $packageErrors === []): ?>
  <form method="post">
    <label for="confirmation">Type <code><?= h(DEPLOY_CONFIRMATION) ?></code> to install:</label>
    <input id="confirmation" name="confirmation" autocomplete="off" required>
    <button type="submit">Install the allowlisted update</button>
  </form>
  <?php elseif ($targetError !== null): ?>
  <div class="panel error"><p><?= h($targetError) ?></p></div>
  <?php endif; ?>
</body>
</html>
