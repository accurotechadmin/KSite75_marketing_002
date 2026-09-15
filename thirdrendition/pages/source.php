<?php
$file = basename((string)($_GET['file'] ?? '')); $doc = $file ? tr_read_json($file) : []; if (!$doc) { tr_hero('Missing source', 'Source JSON not found', 'The requested source file is not available.'); echo '<p><a class="button" href="?page=sources">Back to JSON Library</a></p>'; return; }
$rows = tr_records_by_source($file); tr_hero('Source detail', $file, tr_doc_title($doc, $file));
?>
<section class="panel"><h2>Human summary</h2><p><?= nl2br(tr_e(tr_doc_summary($doc))); ?></p><p><b><?= count($rows); ?></b> normalized owner records loaded from this source.</p></section>
<section class="panel"><h2>Records from this JSON</h2><div class="cards"><?php foreach ($rows as $r) tr_record_card($r); ?></div></section>
<?php tr_raw_block($doc, 'Raw source JSON'); ?>
