<?php

declare(strict_types=1);

require_once __DIR__ . '/../../app/view.php';

const JOK_PRESERVE_LIST = __DIR__ . '/../../docs/preserve_backup_files.json';
const JOK_BACKUP_ROOT = __DIR__ . '/../../storage/site-preserve-backups';

function jok_repo_root(): string
{
    return dirname(__DIR__, 3);
}

function jok_preserve_normalize_path(string $path): string
{
    $path = trim(str_replace('\\', '/', $path));
    $path = preg_replace('#/+#', '/', $path) ?? '';
    return trim($path, '/');
}

function jok_preserve_is_allowed_path(string $path): bool
{
    if ($path === '' || str_contains($path, '../') || str_starts_with($path, '.git')) {
        return false;
    }

    $allowedPrefixes = [
        'proto/docs/',
        'proto/public/assets/',
        'proto/app/',
        'proto/storage',
    ];

    foreach ($allowedPrefixes as $prefix) {
        if ($path === rtrim($prefix, '/') || str_starts_with($path, $prefix)) {
            return true;
        }
    }

    return false;
}

function jok_preserve_load_list(): array
{
    if (!is_file(JOK_PRESERVE_LIST)) {
        return ['schema_version' => 1, 'items' => []];
    }

    $raw = file_get_contents(JOK_PRESERVE_LIST);
    $decoded = is_string($raw) && trim($raw) !== '' ? json_decode($raw, true) : null;
    if (!is_array($decoded) || !isset($decoded['items']) || !is_array($decoded['items'])) {
        return ['schema_version' => 1, 'items' => []];
    }

    $items = [];
    foreach ($decoded['items'] as $item) {
        if (!is_array($item)) {
            continue;
        }
        $path = jok_preserve_normalize_path((string) ($item['path'] ?? ''));
        if (!jok_preserve_is_allowed_path($path)) {
            continue;
        }
        $items[] = [
            'path' => $path,
            'label' => trim((string) ($item['label'] ?? '')),
            'enabled' => ((bool) ($item['enabled'] ?? true)) === true,
        ];
    }

    $decoded['items'] = $items;
    return $decoded;
}

function jok_preserve_save_list(array $items): array
{
    $data = [
        'schema_version' => 1,
        'description' => 'User-preserved Just One KISS website files and directories for one-click backup before website updates.',
        'items' => array_values($items),
    ];

    $encoded = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
    return file_put_contents(JOK_PRESERVE_LIST, $encoded . PHP_EOL, LOCK_EX) !== false
        ? [true, 'Preserve list saved.']
        : [false, 'Could not save preserve list.'];
}

function jok_preserve_copy_path(string $source, string $destination): bool
{
    if (is_file($source)) {
        $dir = dirname($destination);
        if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
            return false;
        }
        return copy($source, $destination);
    }

    if (!is_dir($source)) {
        return false;
    }

    if (!is_dir($destination) && !mkdir($destination, 0775, true) && !is_dir($destination)) {
        return false;
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $fileInfo) {
        $relative = substr($fileInfo->getPathname(), strlen($source) + 1);
        $target = $destination . '/' . str_replace('\\', '/', $relative);
        if ($fileInfo->isDir()) {
            if (!is_dir($target) && !mkdir($target, 0775, true) && !is_dir($target)) {
                return false;
            }
        } elseif ($fileInfo->isFile()) {
            $dir = dirname($target);
            if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
                return false;
            }
            if (!copy($fileInfo->getPathname(), $target)) {
                return false;
            }
        }
    }

    return true;
}

function jok_preserve_add_to_zip(ZipArchive $zip, string $source, string $zipBase): void
{
    if (is_file($source)) {
        $zip->addFile($source, $zipBase);
        return;
    }

    if (!is_dir($source)) {
        return;
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $fileInfo) {
        $relative = substr($fileInfo->getPathname(), strlen($source) + 1);
        $zipPath = $zipBase . '/' . str_replace('\\', '/', $relative);
        if ($fileInfo->isDir()) {
            $zip->addEmptyDir($zipPath);
        } elseif ($fileInfo->isFile()) {
            $zip->addFile($fileInfo->getPathname(), $zipPath);
        }
    }
}

function jok_preserve_safe_download_path(string $relative): ?string
{
    $relative = jok_preserve_normalize_path($relative);
    if ($relative === '' || str_contains($relative, '../')) {
        return null;
    }

    $base = realpath(JOK_BACKUP_ROOT);
    $target = realpath(JOK_BACKUP_ROOT . '/' . $relative);
    if ($base === false || $target === false || !str_starts_with($target, $base) || !is_file($target)) {
        return null;
    }

    return $target;
}

function jok_preserve_download(string $relative): void
{
    $path = jok_preserve_safe_download_path($relative);
    if ($path === null) {
        http_response_code(404);
        echo 'Backup file not found.';
        exit;
    }

    header('Content-Type: application/octet-stream');
    header('Content-Length: ' . filesize($path));
    header('Content-Disposition: attachment; filename="' . basename($path) . '"');
    readfile($path);
    exit;
}

function jok_preserve_item_slug(string $path): string
{
    $slug = preg_replace('/[^a-zA-Z0-9._-]+/', '-', $path) ?? 'backup-item';
    return trim($slug, '-') ?: 'backup-item';
}

function jok_preserve_restore_allowed(string $path, array $items): bool
{
    if (!jok_preserve_is_allowed_path($path)) {
        return false;
    }

    foreach ($items as $item) {
        $listedPath = $item['path'];
        if ($path === $listedPath || str_starts_with($path, rtrim($listedPath, '/') . '/')) {
            return true;
        }
    }

    return false;
}

function jok_preserve_infer_upload_destination(string $clientName, array $items): ?string
{
    $name = basename(jok_preserve_normalize_path($clientName));
    if ($name === '') {
        return null;
    }

    $exactFileMatches = [];
    foreach ($items as $item) {
        $path = $item['path'];
        $absolute = jok_repo_root() . '/' . $path;
        if ((is_file($absolute) || pathinfo($path, PATHINFO_EXTENSION) !== '') && basename($path) === $name) {
            $exactFileMatches[] = $path;
        }
    }
    if (count($exactFileMatches) === 1) {
        return $exactFileMatches[0];
    }
    if (count($exactFileMatches) > 1) {
        return null;
    }

    $directoryMatches = [];
    foreach ($items as $item) {
        $path = $item['path'];
        $absolute = jok_repo_root() . '/' . $path;
        if (is_dir($absolute)) {
            $candidate = rtrim($path, '/') . '/' . $name;
            if (jok_preserve_restore_allowed($candidate, $items)) {
                $directoryMatches[] = $candidate;
            }
        }
    }

    return count($directoryMatches) === 1 ? $directoryMatches[0] : null;
}

function jok_preserve_backup_existing_before_restore(string $destinationPath, string $restoreId): void
{
    $absolute = jok_repo_root() . '/' . $destinationPath;
    if (!file_exists($absolute)) {
        return;
    }

    $preimage = JOK_BACKUP_ROOT . '/' . $restoreId . '/pre-restore/' . $destinationPath;
    jok_preserve_copy_path($absolute, $preimage);
}

function jok_preserve_restore_file(string $sourceFile, string $destinationPath, string $restoreId): array
{
    $destinationPath = jok_preserve_normalize_path($destinationPath);
    $destination = jok_repo_root() . '/' . $destinationPath;
    $dir = dirname($destination);
    if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
        return [false, 'Could not create directory for ' . $destinationPath . '.'];
    }

    jok_preserve_backup_existing_before_restore($destinationPath, $restoreId);
    if (!copy($sourceFile, $destination)) {
        return [false, 'Could not restore ' . $destinationPath . '.'];
    }

    return [true, 'Restored ' . $destinationPath . '.'];
}

function jok_preserve_restore_zip(array $upload, array $items, string $restoreId): array
{
    $messages = [];
    if (!class_exists('ZipArchive')) {
        return ['ok' => false, 'messages' => ['ZipArchive is not available, so .zip restore is not available.'], 'links' => []];
    }

    $zip = new ZipArchive();
    if ($zip->open((string) $upload['tmp_name']) !== true) {
        return ['ok' => false, 'messages' => ['Could not open uploaded .zip file.'], 'links' => []];
    }

    $restored = 0;
    $staging = JOK_BACKUP_ROOT . '/' . $restoreId . '/staging';
    if (!is_dir($staging) && !mkdir($staging, 0775, true) && !is_dir($staging)) {
        $zip->close();
        return ['ok' => false, 'messages' => ['Could not create restore staging directory.'], 'links' => []];
    }

    for ($index = 0; $index < $zip->numFiles; $index++) {
        $entry = $zip->getNameIndex($index);
        if (!is_string($entry)) {
            continue;
        }
        $entryPath = jok_preserve_normalize_path($entry);
        if ($entryPath === '' || str_ends_with($entry, '/')) {
            continue;
        }

        if (!jok_preserve_restore_allowed($entryPath, $items)) {
            $messages[] = $entryPath . ' was skipped because it is not on the preserve list.';
            continue;
        }

        $contents = $zip->getFromIndex($index);
        if ($contents === false) {
            $messages[] = $entryPath . ' could not be read from the .zip file.';
            continue;
        }

        $stagedFile = $staging . '/' . $entryPath;
        $stagedDir = dirname($stagedFile);
        if (!is_dir($stagedDir) && !mkdir($stagedDir, 0775, true) && !is_dir($stagedDir)) {
            $messages[] = $entryPath . ' could not be staged.';
            continue;
        }
        file_put_contents($stagedFile, $contents, LOCK_EX);
        [$ok, $message] = jok_preserve_restore_file($stagedFile, $entryPath, $restoreId);
        $messages[] = $message;
        if ($ok) {
            $restored++;
        }
    }

    $zip->close();
    return ['ok' => $restored > 0, 'messages' => $messages === [] ? ['No restorable files were found in the .zip.'] : $messages, 'links' => []];
}

function jok_preserve_uploaded_files(array $files): array
{
    $uploads = [];
    $names = $files['name'] ?? [];
    if (!is_array($names)) {
        $names = [$files['name'] ?? ''];
    }

    foreach ($names as $index => $name) {
        $error = is_array($files['error'] ?? null) ? ($files['error'][$index] ?? UPLOAD_ERR_NO_FILE) : ($files['error'] ?? UPLOAD_ERR_NO_FILE);
        if ($error === UPLOAD_ERR_NO_FILE) {
            continue;
        }
        $uploads[] = [
            'name' => (string) $name,
            'tmp_name' => (string) (is_array($files['tmp_name'] ?? null) ? ($files['tmp_name'][$index] ?? '') : ($files['tmp_name'] ?? '')),
            'error' => (int) $error,
        ];
    }

    return $uploads;
}

function jok_preserve_restore_uploads(array $files, array $items): array
{
    $restoreId = 'restore-' . gmdate('Ymd-His');
    $messages = [];
    $restored = 0;
    foreach (jok_preserve_uploaded_files($files) as $upload) {
        if ($upload['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($upload['tmp_name'])) {
            $messages[] = $upload['name'] . ' was skipped because the upload was not valid.';
            continue;
        }

        $clientName = jok_preserve_normalize_path($upload['name']);
        if (strtolower(pathinfo($clientName, PATHINFO_EXTENSION)) === 'zip') {
            $zipResult = jok_preserve_restore_zip($upload, $items, $restoreId);
            $messages = array_merge($messages, $zipResult['messages']);
            if ($zipResult['ok']) {
                $restored++;
            }
            continue;
        }

        $destination = jok_preserve_infer_upload_destination($clientName, $items);
        if ($destination === null) {
            $messages[] = $clientName . ' was skipped because its destination could not be inferred from a unique preserve-list filename or directory.';
            continue;
        }
        if (!jok_preserve_restore_allowed($destination, $items)) {
            $messages[] = $clientName . ' was skipped because the inferred destination is not on the preserve list.';
            continue;
        }
        [$ok, $message] = jok_preserve_restore_file($upload['tmp_name'], $destination, $restoreId);
        $messages[] = $message;
        if ($ok) {
            $restored++;
        }
    }

    if ($messages === []) {
        $messages[] = 'Choose at least one .zip or backed-up file to restore.';
    }

    return ['ok' => $restored > 0, 'messages' => $messages, 'links' => []];
}

function jok_preserve_create_archive(array $selectedPaths, bool $createZip): array
{
    $messages = [];
    $links = [];
    $timestamp = gmdate('Ymd-His');
    $backupDir = JOK_BACKUP_ROOT . '/' . $timestamp;

    if (!is_dir($backupDir) && !mkdir($backupDir, 0775, true) && !is_dir($backupDir)) {
        return ['ok' => false, 'messages' => ['Could not create backup directory.'], 'links' => []];
    }

    $zip = null;
    $zipRelative = $timestamp . '/selected-preserve-files-' . $timestamp . '.zip';
    $zipPath = JOK_BACKUP_ROOT . '/' . $zipRelative;
    if ($createZip) {
        if (!class_exists('ZipArchive')) {
            $messages[] = 'ZipArchive is not available, so the combined .zip archive could not be created.';
        } else {
            $zip = new ZipArchive();
            if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
                $messages[] = 'Could not create the combined .zip archive.';
                $zip = null;
            }
        }
    }

    foreach ($selectedPaths as $path) {
        $source = jok_repo_root() . '/' . $path;
        if (!file_exists($source)) {
            $messages[] = $path . ' was skipped because it does not exist.';
            continue;
        }

        $target = $backupDir . '/files/' . $path;
        if (!jok_preserve_copy_path($source, $target)) {
            $messages[] = $path . ' could not be copied.';
            continue;
        }

        if ($zip instanceof ZipArchive) {
            jok_preserve_add_to_zip($zip, $source, $path);
        }

        if (is_file($target)) {
            $links[] = ['label' => $path, 'download' => $timestamp . '/files/' . $path];
        } elseif (is_dir($target) && class_exists('ZipArchive')) {
            $itemZipRelative = $timestamp . '/' . jok_preserve_item_slug($path) . '.zip';
            $itemZipPath = JOK_BACKUP_ROOT . '/' . $itemZipRelative;
            $itemZip = new ZipArchive();
            if ($itemZip->open($itemZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                jok_preserve_add_to_zip($itemZip, $target, basename($path));
                $itemZip->close();
                $links[] = ['label' => $path . ' directory zip', 'download' => $itemZipRelative];
            } else {
                $messages[] = $path . ' was copied, but its individual directory zip could not be created.';
            }
        } else {
            $messages[] = $path . ' was copied, but no individual download link is available for directories without ZipArchive.';
        }
    }

    if ($zip instanceof ZipArchive) {
        $zip->close();
        if (is_file($zipPath)) {
            array_unshift($links, ['label' => 'Combined selected-files zip archive', 'download' => $zipRelative]);
        }
    }

    if ($links === []) {
        $messages[] = 'No selected files were backed up.';
    }

    return ['ok' => $links !== [], 'messages' => $messages, 'links' => $links];
}

if (isset($_GET['download'])) {
    jok_preserve_download((string) $_GET['download']);
}

$list = jok_preserve_load_list();
$items = $list['items'];
$result = null;
$csrf = csrf_token();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? null)) {
        $result = ['ok' => false, 'messages' => ['The form session expired. Reload the page and try again.'], 'links' => []];
    } else {
        $action = post_string('action', 40);
        if ($action === 'backup') {
            $selected = $_POST['paths'] ?? [];
            $selected = is_array($selected) ? array_map('strval', $selected) : [];
            $known = array_column($items, 'path');
            $selectedPaths = array_values(array_intersect($known, array_map('jok_preserve_normalize_path', $selected)));
            $result = jok_preserve_create_archive($selectedPaths, post_string('zip_mode', 20) === 'yes');
        } elseif ($action === 'restore') {
            $result = jok_preserve_restore_uploads($_FILES['restore_files'] ?? [], $items);
        } elseif ($action === 'add_item') {
            $path = jok_preserve_normalize_path(post_string('new_path', 500));
            $label = post_string('new_label', 200);
            if (!jok_preserve_is_allowed_path($path)) {
                $result = ['ok' => false, 'messages' => ['Choose a path under proto/docs, proto/public/assets, proto/app, or proto/storage.'], 'links' => []];
            } elseif (in_array($path, array_column($items, 'path'), true)) {
                $result = ['ok' => false, 'messages' => ['That path is already on the preserve list.'], 'links' => []];
            } else {
                $items[] = ['path' => $path, 'label' => $label, 'enabled' => true];
                [$ok, $message] = jok_preserve_save_list($items);
                $result = ['ok' => $ok, 'messages' => [$message], 'links' => []];
            }
        } elseif ($action === 'update_list') {
            $updated = [];
            foreach ($items as $item) {
                $path = $item['path'];
                $fieldKey = sha1($path);
                if (isset($_POST['delete'][$fieldKey])) {
                    continue;
                }
                $newPath = jok_preserve_normalize_path((string) ($_POST['item_path'][$fieldKey] ?? $path));
                if (!jok_preserve_is_allowed_path($newPath)) {
                    $newPath = $path;
                }
                $updated[] = [
                    'path' => $newPath,
                    'label' => post_string('item_label_' . $fieldKey, 200),
                    'enabled' => isset($_POST['item_enabled'][$fieldKey]),
                ];
            }
            $deduped = [];
            foreach ($updated as $item) {
                $deduped[$item['path']] = $item;
            }
            $items = array_values($deduped);
            [$ok, $message] = jok_preserve_save_list($items);
            $result = ['ok' => $ok, 'messages' => [$message], 'links' => []];
        }
        $list = jok_preserve_load_list();
        $items = $list['items'];
    }
}

render_header('Just One KISS — Preserve Backup', 'Back up protected website words, styles, assets, and CMS state files before site updates.');
render_notice($result === null ? null : ['ok' => $result['ok'], 'message' => implode(' ', $result['messages'])]);
?>
<main id="main" class="container">
  <section class="section-shell" aria-labelledby="preserve-title">
    <p class="eyebrow">Owner utility</p>
    <h1 id="preserve-title">Preserve website files</h1>
    <form method="post" class="site-form" style="max-width:none">
      <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
      <input type="hidden" name="action" value="backup">
      <button class="button button--fire" type="submit">Archive selected files now</button>
      <fieldset class="preserve-zip-mode">
        <legend>Zip archive download</legend>
        <label><input type="radio" name="zip_mode" value="no" checked> No .zip archive download</label>
        <label><input type="radio" name="zip_mode" value="yes"> Yes, provide a .zip archive download link</label>
      </fieldset>
      <div class="preserve-grid" style="columns:3 18rem; column-gap:2rem; margin-top:1rem">
        <?php foreach ($items as $item): ?>
          <label style="break-inside:avoid; display:block; margin:0 0 .65rem">
            <input type="checkbox" name="paths[]" value="<?= e($item['path']) ?>"<?= $item['enabled'] ? ' checked' : '' ?>>
            <?= e($item['path']) ?><?= $item['label'] !== '' ? ' — ' . e($item['label']) : '' ?>
          </label>
        <?php endforeach; ?>
      </div>
    </form>

    <form method="post" class="site-form" enctype="multipart/form-data" style="max-width:none; margin-top:1.5rem">
      <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
      <input type="hidden" name="action" value="restore">
      <label>Restore .zip or backed-up files <input type="file" name="restore_files[]" multiple accept=".zip,.json,.md,.php,.css,.js,.webp,.txt"></label>
      <p class="form-help">Uploaded .zip files must contain preserve-list paths such as <code>proto/docs/language.json</code>. Individual files are restored only when their filename maps to one unique preserve-list destination.</p>
      <button class="button button--chrome" type="submit">Restore uploaded files</button>
    </form>

    <?php if ($result !== null && $result['links'] !== []): ?>
      <div class="proof-section" style="margin-top:1.5rem">
        <h2>Download links</h2>
        <ul>
          <?php foreach ($result['links'] as $link): ?>
            <li><a href="?download=<?= e(rawurlencode($link['download'])) ?>"><?= e($link['label']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <details style="margin-top:1.5rem">
      <summary>Edit preserve list</summary>
      <form method="post" class="site-form" style="max-width:none; margin-top:1rem">
        <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
        <input type="hidden" name="action" value="update_list">
        <?php foreach ($items as $item): $key = sha1($item['path']); ?>
          <fieldset style="margin-bottom:1rem">
            <legend><?= e($item['path']) ?></legend>
            <label>Path <input name="item_path[<?= e($key) ?>]" value="<?= e($item['path']) ?>"></label>
            <label>Label <input name="item_label_<?= e($key) ?>" value="<?= e($item['label']) ?>"></label>
            <label><input type="checkbox" name="item_enabled[<?= e($key) ?>]"<?= $item['enabled'] ? ' checked' : '' ?>> Checked by default</label>
            <label><input type="checkbox" name="delete[<?= e($key) ?>]"> Delete from list</label>
          </fieldset>
        <?php endforeach; ?>
        <button class="button button--chrome" type="submit">Save preserve list edits</button>
      </form>
      <form method="post" class="site-form" style="max-width:none; margin-top:1rem">
        <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
        <input type="hidden" name="action" value="add_item">
        <label>New path <input name="new_path" placeholder="proto/docs/example.json"></label>
        <label>New label <input name="new_label" placeholder="Why this file matters"></label>
        <button class="button button--chrome" type="submit">Add preserve-list item</button>
      </form>
    </details>
  </section>
</main>
<?php render_footer(); ?>
