<?php
declare(strict_types=1);

/**
 * Stand-alone website brand/asset collector.
 *
 * Put this file at the highest directory the scan may inspect, then either:
 *   php site_brand_collector.php [output-directory-name]
 * or open it in a browser and press "Run collection".
 *
 * The collector deliberately never follows symlinks and verifies every visited
 * path is below this file's directory. It therefore cannot scan above its root.
 */

const COLLECTOR_VERSION = '1.0.0';
const DEFAULT_OUTPUT = 'brand-asset-collection';
const MAX_TEXT_BYTES = 8_000_000;

final class SiteBrandCollector
{
    private string $root;
    private string $output;
    private string $outputName;
    private array $warnings = [];
    private array $errors = [];
    private array $images = [];
    private array $visualFiles = [];
    private array $references = [];
    private array $language = [];
    private array $inlineStyles = [];
    private array $tokens = ['colors' => [], 'fonts' => [], 'custom_properties' => [], 'classes' => [], 'ids' => []];
    private array $architecture = ['extensions' => [], 'directories' => [], 'files_scanned' => 0, 'bytes_scanned' => 0];
    private array $seenLanguage = [];

    private array $imageExtensions = [
        'avif', 'bmp', 'gif', 'heic', 'heif', 'ico', 'jfif', 'jpeg', 'jpg',
        'png', 'svg', 'tif', 'tiff', 'webp',
    ];
    private array $fontExtensions = ['eot', 'otf', 'ttf', 'woff', 'woff2'];
    private array $styleExtensions = ['css', 'less', 'sass', 'scss', 'styl'];
    private array $designExtensions = ['ai', 'eps', 'pdf', 'psd', 'sketch', 'xd'];
    private array $videoExtensions = ['m4v', 'mov', 'mp4', 'ogv', 'webm'];
    private array $textExtensions = [
        'asp', 'aspx', 'astro', 'cjs', 'css', 'csv', 'ejs', 'haml', 'handlebars',
        'hbs', 'htm', 'html', 'inc', 'ini', 'jade', 'js', 'json', 'jsx', 'less',
        'liquid', 'md', 'mjs', 'mustache', 'php', 'phtml', 'py', 'rb', 'rst',
        'sass', 'scss', 'shtml', 'sql', 'styl', 'svelte', 'toml', 'ts', 'tsx',
        'twig', 'txt', 'vue', 'xml', 'yaml', 'yml',
    ];
    private array $ignoredDirectories = [
        '.git', '.hg', '.svn', '.idea', '.vscode', 'node_modules', 'vendor',
        'bower_components', 'coverage', '.cache', '.next', '.nuxt',
    ];

    public function __construct(string $root, string $outputName)
    {
        $resolved = realpath($root);
        if ($resolved === false) {
            throw new RuntimeException('The scan root does not exist.');
        }
        $this->root = rtrim($resolved, DIRECTORY_SEPARATOR);
        $safeName = trim(str_replace('\\', '/', $outputName), '/');
        if ($safeName === '' || str_contains($safeName, '..') || str_contains($safeName, '/')) {
            throw new InvalidArgumentException('Output must be one simple folder name, not a path.');
        }
        $this->outputName = $safeName;
        $this->output = $this->root . DIRECTORY_SEPARATOR . $safeName;
    }

    public function run(): array
    {
        $started = gmdate('c');
        $this->prepareOutput();

        $iterator = new RecursiveIteratorIterator(
            new RecursiveCallbackFilterIterator(
                new RecursiveDirectoryIterator($this->root, FilesystemIterator::SKIP_DOTS),
                function (SplFileInfo $item): bool {
                    $path = $item->getPathname();
                    if ($item->isLink()) {
                        $this->warnings[] = 'Skipped symlink: ' . $this->relative($path);
                        return false;
                    }
                    if ($item->isDir()) {
                        $name = $item->getFilename();
                        return $path !== $this->output && !in_array($name, $this->ignoredDirectories, true);
                    }
                    return $item->isFile();
                }
            ),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($iterator as $file) {
            $this->inspect($file->getPathname(), $file->getSize());
        }

        $this->resolveReferences();
        $this->sortResults();
        $summary = [
            'collector_version' => COLLECTOR_VERSION,
            'scan_root' => '.',
            'output_folder' => $this->outputName,
            'started_at_utc' => $started,
            'finished_at_utc' => gmdate('c'),
            'counts' => [
                'files_scanned' => $this->architecture['files_scanned'],
                'images_collected' => count($this->images),
                'visual_files_collected' => count($this->visualFiles),
                'language_entries' => count($this->language),
                'asset_references' => count($this->references),
                'inline_style_blocks' => count($this->inlineStyles),
                'warnings' => count($this->warnings),
                'errors' => count($this->errors),
            ],
        ];

        $this->writeJson('manifest.json', $summary + [
            'images' => $this->images,
            'visual_files' => $this->visualFiles,
            'asset_references' => $this->references,
            'warnings' => $this->warnings,
            'errors' => $this->errors,
        ]);
        $this->writeJson('language.json', [
            'generated_at_utc' => gmdate('c'),
            'entry_count' => count($this->language),
            'entries' => $this->language,
        ]);
        $this->writeJson('visual-elements.json', [
            'generated_at_utc' => gmdate('c'),
            'tokens' => $this->tokens,
            'inline_styles' => $this->inlineStyles,
            'source_files' => $this->visualFiles,
        ]);
        $this->writeJson('site-architecture.json', $this->architecture + [
            'generated_at_utc' => gmdate('c'),
            'ignored_directories' => $this->ignoredDirectories,
        ]);
        $this->writeReadme($summary);
        return $summary;
    }

    private function prepareOutput(): void
    {
        if (is_dir($this->output)) {
            $this->removeTree($this->output);
        }
        foreach (['', '/images', '/styling/source', '/styling/fonts', '/styling/design-files', '/styling/video'] as $suffix) {
            $directory = $this->output . $suffix;
            if (!mkdir($directory, 0775, true) && !is_dir($directory)) {
                throw new RuntimeException('Cannot create output directory: ' . $directory);
            }
        }
        // Reduce accidental exposure when the collection lives under an Apache web root.
        file_put_contents($this->output . '/.htaccess', "Options -Indexes\n<FilesMatch \"\\.(json|md)$\">\n  Require all denied\n</FilesMatch>\n");
        file_put_contents($this->output . '/index.html', '<!doctype html><meta name="robots" content="noindex"><title>Brand collection</title>');
    }

    private function inspect(string $path, int $size): void
    {
        if (!$this->insideRoot($path) || $path === __FILE__) {
            return;
        }
        $relative = $this->relative($path);
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $directory = dirname($relative) === '.' ? '.' : dirname($relative);
        $this->architecture['files_scanned']++;
        $this->architecture['bytes_scanned'] += $size;
        $this->architecture['extensions'][$extension !== '' ? $extension : '(none)'] =
            ($this->architecture['extensions'][$extension !== '' ? $extension : '(none)'] ?? 0) + 1;
        $this->architecture['directories'][$directory] = ($this->architecture['directories'][$directory] ?? 0) + 1;

        if (in_array($extension, $this->imageExtensions, true)) {
            $copied = $this->copyCollected($path, 'images/' . $relative);
            $dimensions = @getimagesize($path);
            $this->images[] = [
                'source' => $relative,
                'collected_as' => $copied,
                'mime_type' => $dimensions['mime'] ?? $this->mime($path),
                'bytes' => $size,
                'width' => $dimensions[0] ?? null,
                'height' => $dimensions[1] ?? null,
                'sha256' => hash_file('sha256', $path),
            ];
        }
        if (in_array($extension, $this->styleExtensions, true)) {
            $this->recordVisual($path, $relative, 'stylesheet', 'styling/source/' . $relative, $size);
        } elseif (in_array($extension, $this->fontExtensions, true)) {
            $this->recordVisual($path, $relative, 'font', 'styling/fonts/' . $relative, $size);
        } elseif (in_array($extension, $this->designExtensions, true)) {
            $this->recordVisual($path, $relative, 'design-source', 'styling/design-files/' . $relative, $size);
        } elseif (in_array($extension, $this->videoExtensions, true)) {
            $this->recordVisual($path, $relative, 'video', 'styling/video/' . $relative, $size);
        }

        if ($size > MAX_TEXT_BYTES || !in_array($extension, $this->textExtensions, true)) {
            return;
        }
        $content = @file_get_contents($path);
        if ($content === false || str_contains(substr($content, 0, 4096), "\0")) {
            return;
        }
        $this->extractReferences($content, $relative);
        $this->extractStyles($content, $relative, $extension);
        $this->extractLanguage($content, $relative, $extension);
    }

    private function recordVisual(string $path, string $relative, string $type, string $destination, int $size): void
    {
        $this->visualFiles[] = [
            'type' => $type,
            'source' => $relative,
            'collected_as' => $this->copyCollected($path, $destination),
            'bytes' => $size,
            'sha256' => hash_file('sha256', $path),
        ];
    }

    private function extractReferences(string $content, string $source): void
    {
        $patterns = [
            'html-attribute' => '~(?:src|srcset|poster|content|href)\\s*=\\s*["\\\']([^"\\\']+)["\\\']~i',
            'css-url' => '~url\\(\\s*["\\\']?([^"\\\')]+)~i',
            'js-or-template' => '~["\\\']([^"\\\']+\\.(?:avif|bmp|gif|heic|ico|jpe?g|png|svg|tiff?|webp|eot|otf|ttf|woff2?)(?:[?#][^"\\\']*)?)["\\\']~i',
        ];
        foreach ($patterns as $kind => $pattern) {
            if (!preg_match_all($pattern, $content, $matches, PREG_OFFSET_CAPTURE)) {
                continue;
            }
            foreach ($matches[1] as [$value, $offset]) {
                $value = html_entity_decode(trim($value), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                if ($value === '' || str_starts_with($value, 'data:')) {
                    continue;
                }
                if ($kind === 'html-attribute' && !preg_match('~\\.(?:avif|bmp|gif|heic|ico|jpe?g|png|svg|tiff?|webp|eot|otf|ttf|woff2?)(?:[?#]|$)~i', $value)) {
                    continue;
                }
                $this->references[] = [
                    'reference' => $value,
                    'kind' => $kind,
                    'source' => $source,
                    'line' => $this->lineAt($content, $offset),
                    'status' => preg_match('~^(?:https?:)?//~i', $value) ? 'remote-not-downloaded' : 'unresolved',
                ];
            }
        }
    }

    private function resolveReferences(): void
    {
        foreach ($this->references as &$reference) {
            if ($reference['status'] !== 'unresolved') {
                continue;
            }
            $clean = rawurldecode((string) preg_replace('~[?#].*$~', '', $reference['reference']));
            if (str_starts_with($clean, '/')) {
                $candidate = $this->root . DIRECTORY_SEPARATOR . ltrim($clean, '/');
            } else {
                $candidate = $this->root . DIRECTORY_SEPARATOR . dirname($reference['source']) . DIRECTORY_SEPARATOR . $clean;
            }
            $resolved = realpath($candidate);
            if ($resolved !== false && is_file($resolved) && $this->insideRoot($resolved)) {
                $reference['status'] = 'found';
                $reference['resolved_source'] = $this->relative($resolved);
            } else {
                $reference['status'] = 'missing-or-dynamic';
            }
        }
        unset($reference);
    }

    private function extractStyles(string $content, string $source, string $extension): void
    {
        $styleText = in_array($extension, $this->styleExtensions, true) ? $content : '';
        if (preg_match_all('~<style\\b[^>]*>(.*?)</style>~is', $content, $matches, PREG_OFFSET_CAPTURE)) {
            foreach ($matches[1] as [$block, $offset]) {
                $this->inlineStyles[] = ['source' => $source, 'line' => $this->lineAt($content, $offset), 'css' => trim($block)];
                $styleText .= "\n" . $block;
            }
        }
        if (preg_match_all('~\\bstyle\\s*=\\s*(["\\\'])(.*?)\\1~is', $content, $matches, PREG_OFFSET_CAPTURE)) {
            foreach ($matches[2] as [$block, $offset]) {
                $this->inlineStyles[] = ['source' => $source, 'line' => $this->lineAt($content, $offset), 'css' => trim($block)];
                $styleText .= "\n" . $block;
            }
        }
        $tokenPatterns = [
            'colors' => '~(?<![\\w-])(?:#[0-9a-f]{3,8}\\b|(?:rgb|hsl)a?\\([^)]*\\))~i',
            'fonts' => '~font-family\\s*:\\s*([^;}]+)~i',
            'custom_properties' => '~(--[a-z0-9_-]+)\\s*:\\s*([^;}]+)~i',
            'classes' => '~\\.(-?[_a-z][-_a-z0-9]*)~i',
            'ids' => '~#(-?[_a-z][-_a-z0-9]*)~i',
        ];
        foreach ($tokenPatterns as $category => $pattern) {
            if (!preg_match_all($pattern, $styleText, $matches)) {
                continue;
            }
            foreach ($matches[0] as $index => $whole) {
                $value = $category === 'custom_properties'
                    ? trim($matches[1][$index]) . ': ' . trim($matches[2][$index])
                    : trim($matches[1][$index] ?? $whole);
                $this->tokens[$category][$value] = ($this->tokens[$category][$value] ?? 0) + 1;
            }
        }
    }

    private function extractLanguage(string $content, string $source, string $extension): void
    {
        if ($extension === 'json') {
            $decoded = json_decode($content, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->walkJson($decoded, $source);
            }
        }

        // Rendered text between tags, including templates after PHP/code removal.
        if (in_array($extension, ['htm', 'html', 'php', 'phtml', 'shtml', 'twig', 'vue', 'astro'], true)) {
            $markup = preg_replace(['~<script\\b[^>]*>.*?</script>~is', '~<style\\b[^>]*>.*?</style>~is', '~<\\?(?:php|=).*?\\?>~is'], ' ', $content);
            if (preg_match_all('~>([^<>]+)<~s', (string) $markup, $matches, PREG_OFFSET_CAPTURE)) {
                foreach ($matches[1] as [$text, $offset]) {
                    $this->addLanguage($text, $source, $this->lineAt($content, $offset), 'markup-text');
                }
            }
            if (preg_match_all('~\\b(?:alt|title|aria-label|placeholder|content)\\s*=\\s*(["\\\'])(.*?)\\1~is', $content, $matches, PREG_OFFSET_CAPTURE)) {
                foreach ($matches[2] as [$text, $offset]) {
                    $this->addLanguage($text, $source, $this->lineAt($content, $offset), 'attribute');
                }
            }
        }

        // Quoted strings catch CMS arrays, JavaScript UI copy, translations, and PHP fallbacks.
        if (in_array($extension, ['php', 'phtml', 'inc', 'js', 'jsx', 'ts', 'tsx', 'vue', 'svelte'], true)
            && preg_match_all('~(["\\\'])(?:(?!\\1|\\\\).|\\\\.){2,}\\1~s', $content, $matches, PREG_OFFSET_CAPTURE)) {
            foreach ($matches[0] as [$quoted, $offset]) {
                $text = substr($quoted, 1, -1);
                $text = stripcslashes($text);
                $this->addLanguage($text, $source, $this->lineAt($content, $offset), 'code-string');
            }
        }
    }

    private function walkJson($value, string $source, string $path = '$'): void
    {
        if (is_string($value)) {
            $this->addLanguage($value, $source, null, 'json-value', $path);
            return;
        }
        if (!is_array($value)) {
            return;
        }
        foreach ($value as $key => $child) {
            $this->walkJson($child, $source, $path . '.' . (string) $key);
        }
    }

    private function addLanguage(string $raw, string $source, ?int $line, string $kind, ?string $key = null): void
    {
        $text = html_entity_decode(strip_tags($raw), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = trim((string) preg_replace('/\\s+/u', ' ', $text));
        if (!$this->looksLikeLanguage($text)) {
            return;
        }
        $signature = hash('sha256', mb_strtolower($text, 'UTF-8') . "\0" . $source . "\0" . ($key ?? ''));
        if (isset($this->seenLanguage[$signature])) {
            return;
        }
        $this->seenLanguage[$signature] = true;
        $entry = ['text' => $text, 'source' => $source, 'kind' => $kind];
        if ($line !== null) {
            $entry['line'] = $line;
        }
        if ($key !== null) {
            $entry['key'] = $key;
        }
        $this->language[] = $entry;
    }

    private function looksLikeLanguage(string $text): bool
    {
        if (mb_strlen($text, 'UTF-8') < 2 || mb_strlen($text, 'UTF-8') > 2000 || !preg_match('/\\p{L}/u', $text)) {
            return false;
        }
        if (preg_match('~^(?:https?:|[/#.][^ ]*$|[a-z0-9_.-]+\\.(?:php|js|css|json|png|jpe?g|svg|webp|woff2?))~i', $text)) {
            return false;
        }
        if (preg_match('~^[A-Za-z_$][A-Za-z0-9_$.-]*$~', $text) && !str_contains($text, ' ') && !preg_match('/[A-Z].*[A-Z]/', $text)) {
            return false;
        }
        if (str_contains($text, '=>') || preg_match('~^(?:function|const|let|var|return|SELECT|INSERT|UPDATE)\\b~i', $text)) {
            return false;
        }
        return true;
    }

    private function copyCollected(string $source, string $relativeDestination): string
    {
        $relativeDestination = str_replace('\\', '/', $relativeDestination);
        $destination = $this->output . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativeDestination);
        $directory = dirname($destination);
        if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
            $this->errors[] = 'Could not create: ' . $relativeDestination;
            return '';
        }
        if (!copy($source, $destination)) {
            $this->errors[] = 'Could not copy: ' . $this->relative($source);
            return '';
        }
        return $relativeDestination;
    }

    private function sortResults(): void
    {
        foreach (['extensions', 'directories'] as $key) {
            ksort($this->architecture[$key], SORT_NATURAL | SORT_FLAG_CASE);
        }
        foreach ($this->tokens as &$values) {
            arsort($values);
        }
        unset($values);
        usort($this->language, fn(array $a, array $b): int => [$a['source'], $a['line'] ?? 0, $a['text']] <=> [$b['source'], $b['line'] ?? 0, $b['text']]);
        usort($this->images, fn(array $a, array $b): int => $a['source'] <=> $b['source']);
        usort($this->visualFiles, fn(array $a, array $b): int => $a['source'] <=> $b['source']);
    }

    private function writeJson(string $name, array $data): void
    {
        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
        if ($json === false || file_put_contents($this->output . '/' . $name, $json . "\n") === false) {
            throw new RuntimeException('Could not write ' . $name);
        }
    }

    private function writeReadme(array $summary): void
    {
        $counts = $summary['counts'];
        $text = "# Website brand collection\n\nGenerated by site_brand_collector.php " . COLLECTOR_VERSION . ".\n\n"
            . "- `images/`: every local raster/vector image found, preserving source paths.\n"
            . "- `styling/`: stylesheets, fonts, editable design-source files, and video.\n"
            . "- `language.json`: extracted public-facing text with source provenance.\n"
            . "- `visual-elements.json`: colors, fonts, CSS variables/selectors, and inline CSS.\n"
            . "- `manifest.json`: hashes, dimensions, references, missing/dynamic assets, and warnings.\n"
            . "- `site-architecture.json`: directory and extension inventory used to understand scan coverage.\n\n"
            . "## Totals\n\n"
            . "Images: {$counts['images_collected']}; visual files: {$counts['visual_files_collected']}; "
            . "language entries: {$counts['language_entries']}; scanned files: {$counts['files_scanned']}.\n\n"
            . "Review language entries before publication: heuristic extraction intentionally favors broad coverage and may include administrative or technical interface copy. Remote assets are inventoried but are not downloaded.\n";
        file_put_contents($this->output . '/README.md', $text);
    }

    private function insideRoot(string $path): bool
    {
        $resolved = realpath($path);
        return $resolved !== false && ($resolved === $this->root || str_starts_with($resolved, $this->root . DIRECTORY_SEPARATOR));
    }

    private function relative(string $path): string
    {
        return ltrim(str_replace('\\', '/', substr($path, strlen($this->root))), '/');
    }

    private function lineAt(string $content, int $offset): int
    {
        return substr_count(substr($content, 0, $offset), "\n") + 1;
    }

    private function mime(string $path): ?string
    {
        return function_exists('mime_content_type') ? (mime_content_type($path) ?: null) : null;
    }

    private function removeTree(string $directory): void
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($iterator as $item) {
            $item->isDir() && !$item->isLink() ? rmdir($item->getPathname()) : unlink($item->getPathname());
        }
        rmdir($directory);
    }
}

function collectorRun(string $outputName): array
{
    return (new SiteBrandCollector(__DIR__, $outputName))->run();
}

if (PHP_SAPI === 'cli') {
    try {
        $summary = collectorRun($argv[1] ?? DEFAULT_OUTPUT);
        fwrite(STDOUT, json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n");
        exit($summary['counts']['errors'] > 0 ? 1 : 0);
    } catch (Throwable $error) {
        fwrite(STDERR, 'Collection failed: ' . $error->getMessage() . "\n");
        exit(1);
    }
}

$result = null;
$errorMessage = null;
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    try {
        $result = collectorRun((string) ($_POST['output'] ?? DEFAULT_OUTPUT));
    } catch (Throwable $error) {
        $errorMessage = $error->getMessage();
    }
}
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="noindex,nofollow"><title>Website Brand Collector</title>
<style>body{margin:0;background:#101114;color:#f5f5f5;font:16px/1.55 system-ui,sans-serif}main{max-width:760px;margin:8vh auto;padding:2rem}section{background:#1b1d22;border:1px solid #343740;border-radius:16px;padding:1.5rem;box-shadow:0 18px 70px #0008}h1{margin-top:0}code{color:#ffcf66}label{display:block;font-weight:700;margin:1rem 0 .35rem}input{box-sizing:border-box;width:100%;padding:.75rem;border:1px solid #555b68;border-radius:8px;background:#101114;color:#fff}button{margin-top:1rem;padding:.8rem 1.1rem;border:0;border-radius:8px;background:#ef7b2d;color:#160a02;font-weight:800;cursor:pointer}.ok{color:#8ce99a}.error{color:#ff8787}small{color:#adb5bd}</style></head>
<body><main><section><h1>Website Brand Collector</h1>
<p>This scans <code><?= htmlspecialchars(__DIR__, ENT_QUOTES, 'UTF-8') ?></code> and its children. It never follows symlinks or scans a parent folder.</p>
<?php if ($result !== null): ?><h2 class="ok">Collection complete</h2><pre><?= htmlspecialchars(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES), ENT_QUOTES, 'UTF-8') ?></pre><?php endif; ?>
<?php if ($errorMessage !== null): ?><p class="error"><strong>Collection failed:</strong> <?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
<form method="post"><label for="output">Collection folder name</label><input id="output" name="output" value="<?= htmlspecialchars(DEFAULT_OUTPUT, ENT_QUOTES, 'UTF-8') ?>" pattern="[A-Za-z0-9_.-]+" required><small>An existing collection with this name is replaced. Use only a simple folder name.</small><br><button type="submit">Run collection</button></form>
</section></main></body></html>
