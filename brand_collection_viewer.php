<?php
declare(strict_types=1);

/**
 * Stand-alone browser for a package made by site_brand_collector.php.
 * Place this file in the package root (beside manifest.json) and open it through PHP.
 * Requires PHP 8.0+.
 */

const VIEWER_VERSION = '1.0.0';
const TEXT_PREVIEW_LIMIT = 524288;

$root = realpath(__DIR__);
if ($root === false) {
    http_response_code(500);
    exit('Unable to resolve the collection directory.');
}

/** Resolve a user-provided relative path without permitting traversal or symlinks. */
function packagePath(string $relative, bool $mustBeFile = true): ?string
{
    global $root;
    if ($relative === '' || str_contains($relative, "\0") || str_starts_with($relative, '/') || preg_match('~(^|[\\/])\.\.([\\/]|$)~', $relative)) {
        return null;
    }
    $resolved = realpath($root . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relative));
    if ($resolved === false || !str_starts_with($resolved, $root . DIRECTORY_SEPARATOR) || is_link($resolved)) {
        return null;
    }
    if ($mustBeFile && !is_file($resolved)) {
        return null;
    }
    return $resolved;
}

function relativePath(string $absolute): string
{
    global $root;
    return str_replace('\\', '/', ltrim(substr($absolute, strlen($root)), DIRECTORY_SEPARATOR));
}

function mimeFor(string $path): string
{
    $mime = function_exists('mime_content_type') ? mime_content_type($path) : false;
    return is_string($mime) ? $mime : 'application/octet-stream';
}

function jsonFile(string $name): array
{
    $path = packagePath($name);
    if ($path === null || filesize($path) > 64 * 1024 * 1024) {
        return [];
    }
    $decoded = json_decode((string) file_get_contents($path), true);
    return is_array($decoded) ? $decoded : [];
}

function formatBytes(int $bytes): string
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $index = 0;
    $value = (float) $bytes;
    while ($value >= 1024 && $index < count($units) - 1) {
        $value /= 1024;
        $index++;
    }
    return ($index === 0 ? (string) $bytes : number_format($value, 1)) . ' ' . $units[$index];
}

function sendJson(array $value, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    echo json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}

// A safe passthrough lets the viewer display assets even when direct directory access is denied.
if (isset($_GET['raw'])) {
    $relative = (string) $_GET['raw'];
    $path = packagePath($relative);
    if ($path === null) {
        http_response_code(404);
        exit('File not found.');
    }
    $mime = mimeFor($path);
    $safeInline = str_starts_with($mime, 'image/') || str_starts_with($mime, 'video/') || str_starts_with($mime, 'audio/') || $mime === 'application/pdf';
    header('Content-Type: ' . $mime);
    header('Content-Length: ' . (string) filesize($path));
    header('Content-Disposition: ' . ($safeInline ? 'inline' : 'attachment') . '; filename="' . rawurlencode(basename($path)) . '"');
    header('X-Content-Type-Options: nosniff');
    // Keep active SVG/PDF content isolated from the viewer's origin.
    header("Content-Security-Policy: sandbox; default-src 'none'; img-src data:; style-src 'unsafe-inline'");
    readfile($path);
    exit;
}

if (isset($_GET['inspect'])) {
    $relative = (string) $_GET['inspect'];
    $path = packagePath($relative);
    if ($path === null) {
        sendJson(['error' => 'File not found or is outside the package.'], 404);
    }
    $mime = mimeFor($path);
    $size = (int) filesize($path);
    $result = [
        'path' => relativePath($path),
        'name' => basename($path),
        'mime' => $mime,
        'bytes' => $size,
        'size' => formatBytes($size),
        'modified_at' => gmdate('c', (int) filemtime($path)),
        'sha256' => hash_file('sha256', $path),
        'raw_url' => '?raw=' . rawurlencode(relativePath($path)),
        'preview_type' => 'binary',
    ];
    if (str_starts_with($mime, 'image/')) {
        $dimensions = @getimagesize($path);
        $result['preview_type'] = 'image';
        $result['width'] = $dimensions[0] ?? null;
        $result['height'] = $dimensions[1] ?? null;
    } elseif (str_starts_with($mime, 'video/')) {
        $result['preview_type'] = 'video';
    } elseif ($mime === 'application/pdf') {
        $result['preview_type'] = 'pdf';
    } elseif ($size <= TEXT_PREVIEW_LIMIT || preg_match('~\.(?:css|html?|js|json|less|md|php|scss|svg|txt|xml|ya?ml)$~i', $path)) {
        $result['preview_type'] = 'text';
        $handle = fopen($path, 'rb');
        $result['text'] = $handle === false ? '' : (string) fread($handle, TEXT_PREVIEW_LIMIT);
        if (is_resource($handle)) {
            fclose($handle);
        }
        $result['truncated'] = $size > TEXT_PREVIEW_LIMIT;
    }
    sendJson($result);
}

$imageExtensions = ['avif', 'bmp', 'gif', 'heic', 'heif', 'ico', 'jfif', 'jpeg', 'jpg', 'png', 'svg', 'tif', 'tiff', 'webp'];
$files = [];
$images = [];
$totalBytes = 0;
$iterator = new RecursiveIteratorIterator(
    new RecursiveCallbackFilterIterator(
        new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS),
        static function (SplFileInfo $item): bool {
            return !$item->isLink() && $item->getFilename() !== basename(__FILE__);
        }
    ),
    RecursiveIteratorIterator::LEAVES_ONLY
);
foreach ($iterator as $item) {
    if (!$item->isFile()) {
        continue;
    }
    $relative = relativePath($item->getPathname());
    $extension = strtolower($item->getExtension());
    $record = [
        'path' => $relative,
        'name' => $item->getFilename(),
        'extension' => $extension !== '' ? $extension : 'file',
        'bytes' => $item->getSize(),
        'size' => formatBytes($item->getSize()),
    ];
    $files[] = $record;
    $totalBytes += $item->getSize();
    if (in_array($extension, $imageExtensions, true)) {
        $images[] = $record;
    }
}
usort($files, static fn(array $a, array $b): int => strnatcasecmp($a['path'], $b['path']));
usort($images, static fn(array $a, array $b): int => strnatcasecmp($a['path'], $b['path']));

$manifest = jsonFile('manifest.json');
$language = jsonFile('language.json');
$visual = jsonFile('visual-elements.json');
$architecture = jsonFile('site-architecture.json');
$languageEntries = is_array($language['entries'] ?? null) ? $language['entries'] : [];
$tokens = is_array($visual['tokens'] ?? null) ? $visual['tokens'] : [];
$counts = is_array($manifest['counts'] ?? null) ? $manifest['counts'] : [];
$missingReferences = array_values(array_filter(
    is_array($manifest['asset_references'] ?? null) ? $manifest['asset_references'] : [],
    static fn($reference): bool => is_array($reference) && ($reference['status'] ?? '') !== 'found'
));

header('Content-Type: text/html; charset=utf-8');
header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; media-src 'self'; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'; frame-src 'self'; object-src 'none'; base-uri 'none'");
header('X-Content-Type-Options: nosniff');
header('X-Robots-Tag: noindex, nofollow');
$pageData = [
    'files' => $files,
    'images' => $images,
    'language' => $languageEntries,
    'tokens' => $tokens,
    'missing' => $missingReferences,
];
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Brand Collection Viewer</title>
<style>
:root{color-scheme:dark;--bg:#090a0d;--panel:#14161b;--line:#30343e;--ink:#f5f2ea;--muted:#aeb3bf;--fire:#ef7b2d;--gold:#f2c230;--tile:180px}*{box-sizing:border-box}body{margin:0;background:radial-gradient(circle at 85% 0,#4a170d55,transparent 32rem),var(--bg);color:var(--ink);font:15px/1.5 system-ui,sans-serif}button,input{font:inherit}.top{position:sticky;top:0;z-index:5;display:flex;align-items:center;gap:1rem;padding:1rem clamp(1rem,4vw,3rem);background:#090a0ded;border-bottom:1px solid var(--line);backdrop-filter:blur(14px)}h1{font-size:clamp(1.15rem,3vw,1.7rem);margin:0;margin-right:auto}.tabs,.sizes{display:flex;gap:.35rem;flex-wrap:wrap}button,.button{border:1px solid var(--line);border-radius:9px;background:#1d2027;color:var(--ink);padding:.55rem .75rem;cursor:pointer;text-decoration:none}button:hover,button.active,.button:hover{border-color:var(--fire);background:#332018}.wrap{max-width:1600px;margin:auto;padding:clamp(1rem,3vw,2.5rem)}.view{display:none}.view.active{display:block}.hero{display:flex;gap:1rem;justify-content:space-between;align-items:end;margin-bottom:1.2rem}.hero h2{font-size:clamp(1.8rem,4vw,3.2rem);margin:.1rem 0}.muted{color:var(--muted)}.cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:.8rem;margin:1rem 0 2rem}.stat,.panel{background:linear-gradient(145deg,#191b21,#111318);border:1px solid var(--line);border-radius:14px;padding:1rem}.stat strong{display:block;color:var(--gold);font-size:1.7rem}.panels{display:grid;grid-template-columns:repeat(auto-fit,minmax(310px,1fr));gap:1rem}.panel h3{margin-top:0}.panel ul{padding-left:1.2rem}.toolbar{display:flex;gap:.6rem;align-items:center;margin:1rem 0;flex-wrap:wrap}.search{min-width:min(100%,360px);flex:1;background:#111318;color:var(--ink);border:1px solid var(--line);border-radius:10px;padding:.7rem}.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(var(--tile),1fr));gap:.8rem}.asset{appearance:none;text-align:left;padding:0;overflow:hidden;min-width:0}.asset img{display:block;width:100%;height:var(--tile);object-fit:contain;background:repeating-conic-gradient(#181a20 0 25%,#20232a 0 50%) 50%/20px 20px}.asset-meta{padding:.65rem}.asset-meta strong,.file strong{display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}.asset-meta small{color:var(--muted)}.files{display:grid;gap:.45rem}.file{display:grid;grid-template-columns:50px 1fr auto;align-items:center;text-align:left;width:100%}.ext{color:var(--gold);font-size:.7rem;font-weight:900;text-transform:uppercase}.language{display:grid;gap:.55rem}.phrase{text-align:left;width:100%;padding:.75rem 1rem}.phrase small{display:block;color:var(--muted)}.empty{padding:3rem;text-align:center;color:var(--muted)}dialog{width:min(1100px,94vw);height:min(850px,92vh);padding:0;border:1px solid #4a4f5c;border-radius:15px;background:#101217;color:var(--ink);box-shadow:0 30px 100px #000}dialog::backdrop{background:#000c}.modal-head{position:sticky;top:0;z-index:2;display:flex;gap:1rem;align-items:center;padding:.8rem 1rem;background:#171920;border-bottom:1px solid var(--line)}.modal-head strong{min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;margin-right:auto}.modal-body{height:calc(100% - 58px);padding:1rem;overflow:auto}.preview{display:block;max-width:100%;max-height:70vh;margin:auto}.video{width:100%;max-height:70vh}.frame{width:100%;height:70vh;border:0;background:#fff}.code{white-space:pre-wrap;overflow-wrap:anywhere;background:#090a0d;border:1px solid var(--line);padding:1rem;border-radius:10px}.details{display:grid;grid-template-columns:max-content 1fr;gap:.3rem 1rem;margin:1rem 0}.color{display:inline-block;width:1em;height:1em;border:1px solid #fff5;border-radius:3px;vertical-align:-.1em;margin-right:.4em}@media(max-width:800px){.top{align-items:flex-start;flex-wrap:wrap}.tabs{order:3;width:100%}.hero{display:block}.desktop-label{display:none}}
</style>
</head>
<body>
<header class="top"><h1>Brand Collection</h1><nav class="tabs" aria-label="Collection sections"><button class="active" data-tab="overview">Overview</button><button data-tab="images">Images <span><?= count($images) ?></span></button><button data-tab="language">Language <span><?= count($languageEntries) ?></span></button><button data-tab="files">All files <span><?= count($files) ?></span></button></nav></header>
<main class="wrap">
<section id="overview" class="view active"><div class="hero"><div><div class="muted">Complete package dashboard</div><h2>Collection overview</h2></div><div class="muted">Viewer <?= VIEWER_VERSION ?></div></div>
<div class="cards"><div class="stat"><strong><?= count($images) ?></strong>Images</div><div class="stat"><strong><?= count($languageEntries) ?></strong>Language entries</div><div class="stat"><strong><?= count($files) ?></strong>Package files</div><div class="stat"><strong><?= formatBytes($totalBytes) ?></strong>Total package size</div><div class="stat"><strong><?= count($missingReferences) ?></strong>Unresolved/remote references</div></div>
<div class="panels">
<article class="panel"><h3>Original scan</h3><div class="details"><span>Scanned files</span><strong><?= htmlspecialchars((string) ($counts['files_scanned'] ?? 'Unknown')) ?></strong><span>Images collected</span><strong><?= htmlspecialchars((string) ($counts['images_collected'] ?? count($images))) ?></strong><span>Visual files</span><strong><?= htmlspecialchars((string) ($counts['visual_files_collected'] ?? 'Unknown')) ?></strong><span>Completed</span><strong><?= htmlspecialchars((string) ($manifest['finished_at_utc'] ?? 'Unknown')) ?></strong></div><button data-inspect="manifest.json">Inspect manifest</button></article>
<article class="panel"><h3>Visual design system</h3><div class="details"><span>Colors</span><strong><?= count($tokens['colors'] ?? []) ?></strong><span>Font declarations</span><strong><?= count($tokens['fonts'] ?? []) ?></strong><span>CSS variables</span><strong><?= count($tokens['custom_properties'] ?? []) ?></strong><span>CSS classes</span><strong><?= count($tokens['classes'] ?? []) ?></strong></div><button data-inspect="visual-elements.json">Inspect visual elements</button></article>
<article class="panel"><h3>Most-used colors</h3><ul><?php foreach (array_slice($tokens['colors'] ?? [], 0, 10, true) as $color => $uses): ?><li><span class="color" style="background:<?= htmlspecialchars((string) $color, ENT_QUOTES) ?>"></span><code><?= htmlspecialchars((string) $color) ?></code> — <?= (int) $uses ?> uses</li><?php endforeach; ?></ul></article>
<article class="panel"><h3>Architecture</h3><div class="details"><span>Directories</span><strong><?= count($architecture['directories'] ?? []) ?></strong><span>File types</span><strong><?= count($architecture['extensions'] ?? []) ?></strong><span>Scan bytes</span><strong><?= formatBytes((int) ($architecture['bytes_scanned'] ?? 0)) ?></strong></div><button data-inspect="site-architecture.json">Inspect architecture</button></article>
<?php if ($missingReferences): ?><article class="panel"><h3>References needing review</h3><p><?= count($missingReferences) ?> references were remote, dynamic, or absent during collection.</p><ul><?php foreach (array_slice($missingReferences, 0, 8) as $reference): ?><li><code><?= htmlspecialchars((string) ($reference['reference'] ?? '')) ?></code></li><?php endforeach; ?></ul><button data-inspect="manifest.json">Review all references</button></article><?php endif; ?>
</div></section>

<section id="images" class="view"><div class="hero"><div><div class="muted">Every image, one screen</div><h2>Image contact sheet</h2></div></div><div class="toolbar"><input class="search" id="image-search" type="search" placeholder="Filter images by name or path"><div class="sizes" aria-label="Tile size"><span class="desktop-label muted">Tile size</span><button data-size="110">Small</button><button class="active" data-size="180">Medium</button><button data-size="300">Large</button></div><span id="image-count" class="muted"></span></div><div id="image-grid" class="grid"></div></section>

<section id="language" class="view"><div class="hero"><div><div class="muted">Phrases, words, mottos, labels, and quotes</div><h2>Language catalog</h2></div></div><div class="toolbar"><input class="search" id="language-search" type="search" placeholder="Search language and source files"><span id="language-count" class="muted"></span></div><div id="language-list" class="language"></div></section>

<section id="files" class="view"><div class="hero"><div><div class="muted">Inspect or download every package item</div><h2>Complete file inventory</h2></div></div><div class="toolbar"><input class="search" id="file-search" type="search" placeholder="Filter by name, path, or extension"><span id="file-count" class="muted"></span></div><div id="file-list" class="files"></div></section>
</main>
<dialog id="inspector"><div class="modal-head"><strong id="modal-title">Inspector</strong><a id="modal-open" class="button" target="_blank" rel="noopener">Open original</a><button id="modal-close" aria-label="Close inspector">Close</button></div><div id="modal-body" class="modal-body"></div></dialog>
<script>
const DATA=<?= json_encode($pageData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_INVALID_UTF8_SUBSTITUTE) ?>;
const esc=value=>String(value??'').replace(/[&<>'"]/g,char=>({'&':'&amp;','<':'&lt;','>':'&gt;',"'":'&#39;','"':'&quot;'}[char]));
const raw=path=>'?raw='+encodeURIComponent(path);let activeTab='overview';
document.querySelectorAll('[data-tab]').forEach(button=>button.addEventListener('click',()=>{activeTab=button.dataset.tab;document.querySelectorAll('[data-tab]').forEach(x=>x.classList.toggle('active',x===button));document.querySelectorAll('.view').forEach(x=>x.classList.toggle('active',x.id===activeTab));if(activeTab==='images')renderImages();if(activeTab==='language')renderLanguage();if(activeTab==='files')renderFiles();history.replaceState(null,'','#'+activeTab)}));
const size=localStorage.getItem('brandTileSize')||'180';document.documentElement.style.setProperty('--tile',size+'px');document.querySelectorAll('[data-size]').forEach(button=>{button.classList.toggle('active',button.dataset.size===size);button.addEventListener('click',()=>{document.documentElement.style.setProperty('--tile',button.dataset.size+'px');localStorage.setItem('brandTileSize',button.dataset.size);document.querySelectorAll('[data-size]').forEach(x=>x.classList.toggle('active',x===button))})});
function renderImages(){const q=document.querySelector('#image-search').value.toLowerCase();const matches=DATA.images.filter(x=>x.path.toLowerCase().includes(q));document.querySelector('#image-count').textContent=`${matches.length} shown`;document.querySelector('#image-grid').innerHTML=matches.length?matches.map(x=>`<button class="asset" data-inspect="${esc(x.path)}"><img src="${raw(x.path)}" alt="" loading="lazy"><span class="asset-meta"><strong title="${esc(x.path)}">${esc(x.name)}</strong><small>${esc(x.size)} · ${esc(x.path)}</small></span></button>`).join(''):'<div class="empty">No matching images.</div>'}
function renderLanguage(){const q=document.querySelector('#language-search').value.toLowerCase();const matches=DATA.language.filter(x=>(String(x.text)+' '+String(x.source)+' '+String(x.key||'')).toLowerCase().includes(q));const shown=matches.slice(0,500);document.querySelector('#language-count').textContent=`${matches.length} matches${matches.length>500?' · first 500 shown':''}`;document.querySelector('#language-list').innerHTML=shown.length?shown.map(x=>`<button class="phrase" data-inspect="${esc(x.source)}"><span>${esc(x.text)}</span><small>${esc(x.source)}${x.line?' · line '+x.line:''}${x.key?' · '+esc(x.key):''}</small></button>`).join(''):'<div class="empty">No matching language.</div>'}
function renderFiles(){const q=document.querySelector('#file-search').value.toLowerCase();const matches=DATA.files.filter(x=>(x.path+' '+x.extension).toLowerCase().includes(q));document.querySelector('#file-count').textContent=`${matches.length} shown`;document.querySelector('#file-list').innerHTML=matches.length?matches.map(x=>`<button class="file" data-inspect="${esc(x.path)}"><span class="ext">${esc(x.extension)}</span><span><strong>${esc(x.name)}</strong><small class="muted">${esc(x.path)}</small></span><span class="muted">${esc(x.size)}</span></button>`).join(''):'<div class="empty">No matching files.</div>'}
document.querySelector('#image-search').addEventListener('input',renderImages);document.querySelector('#language-search').addEventListener('input',renderLanguage);document.querySelector('#file-search').addEventListener('input',renderFiles);
const dialog=document.querySelector('#inspector'),body=document.querySelector('#modal-body'),title=document.querySelector('#modal-title'),open=document.querySelector('#modal-open');
async function inspect(path){dialog.showModal();title.textContent=path;body.innerHTML='<p class="muted">Loading inspection…</p>';try{const response=await fetch('?inspect='+encodeURIComponent(path),{headers:{Accept:'application/json'}});const item=await response.json();if(!response.ok)throw new Error(item.error||'Unable to inspect file');open.href=item.raw_url;let preview='';if(item.preview_type==='image')preview=`<img class="preview" src="${item.raw_url}" alt="">`;else if(item.preview_type==='video')preview=`<video class="video" src="${item.raw_url}" controls></video>`;else if(item.preview_type==='pdf')preview=`<iframe class="frame" src="${item.raw_url}" title="PDF preview"></iframe>`;else if(item.preview_type==='text')preview=`${item.truncated?'<p class="muted">Preview limited to 512 KB. Use Open original for the complete file.</p>':''}<pre class="code">${esc(item.text)}</pre>`;else preview='<p class="muted">No embedded preview is available. Use Open original to download this file.</p>';body.innerHTML=`<div class="details"><span>Type</span><strong>${esc(item.mime)}</strong><span>Size</span><strong>${esc(item.size)}</strong><span>Modified</span><strong>${esc(item.modified_at)}</strong><span>SHA-256</span><code>${esc(item.sha256)}</code>${item.width?`<span>Dimensions</span><strong>${item.width} × ${item.height}</strong>`:''}</div>${preview}`}catch(error){body.innerHTML=`<p class="empty">${esc(error.message)}</p>`}}
document.addEventListener('click',event=>{const target=event.target.closest('[data-inspect]');if(target)inspect(target.dataset.inspect)});document.querySelector('#modal-close').addEventListener('click',()=>dialog.close());dialog.addEventListener('click',event=>{if(event.target===dialog)dialog.close()});
const requested=location.hash.slice(1);if(['images','language','files'].includes(requested))document.querySelector(`[data-tab="${requested}"]`).click();
</script>
</body></html>
