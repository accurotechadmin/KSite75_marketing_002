<?php
$file = basename((string)($_GET['file'] ?? '')); $doc = $file ? sr_read_json($file) : []; if (!$doc) { sr_hero('Missing source', 'Source JSON not found', 'The requested source file is not available.'); echo '<p><a class="button" href="?page=sources">Back to JSON Library</a></p>'; return; }
$rows = sr_records_by_source($file); sr_hero('Source detail', $file, sr_doc_title($doc, $file));
?>
<section class="panel"><h2>Human summary</h2><p><?= nl2br(sr_e(sr_doc_summary($doc))); ?></p><p><b><?= count($rows); ?></b> normalized owner records loaded from this source.</p></section>
<section class="panel"><h2>Records from this JSON</h2><div class="cards"><?php foreach ($rows as $r) sr_record_card($r); ?></div></section>
<?php sr_raw_block($doc, 'Raw source JSON'); ?>
