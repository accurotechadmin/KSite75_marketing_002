<?php
$rights = array_filter($records, fn($r) => preg_match('/unknown|needs|reference|prohibited/i', $r['rights_status']));
$safety = array_filter($records, fn($r) => preg_match('/needs|venue|unsafe/i', $r['safety_status']));
$cue = sr_records_by_source('cue.json');
$inventory = array_filter($records, fn($r) => in_array($r['source_file'], ['inventory_reference.json','rig.json','colorstrip_manual.json','freedompar_manual.json','honeycomb_manual.json'], true) || in_array($r['category'], ['dmx patch','vendor_manual','fixture','asset'], true));
sr_hero('Owner-first second rendition', 'Everything findable, every click explainable', 'This version turns the JSON into plain-language cards, owner summaries, source pages, and one-click raw-data inspection without editing or weakening the seed JSON.');
?>
<section class="metrics">
<?php sr_metric('Total owner records', (string)count($records), '?page=explore', 'Normalized from JSON'); ?>
<?php sr_metric('Cue draft records', (string)count($cue), '?page=source&file=cue.json', 'Draft/proposed only'); ?>
<?php sr_metric('Inventory / rig records', (string)count($inventory), '?page=explore&source_file=inventory_reference.json', 'Technical owner lookup'); ?>
<?php sr_metric('Rights review items', (string)count($rights), '?page=explore&rights_status=needs+review', 'Keep internal until cleared'); ?>
<?php sr_metric('Safety review items', (string)count($safety), '?page=explore&safety_status=needs+review', 'Venue-aware gating'); ?>
</section>
<section class="panel"><h2>Start here</h2><div class="action-grid"><a href="?page=explore&q=platform">Find platform / spectacle items</a><a href="?page=explore&family=SONG">Browse songs</a><a href="?page=explore&q=fog">Browse fog and venue safety</a><a href="?page=sources">Open JSON library</a><a href="?page=integrity">Check data integrity</a></div></section>
<section class="panel"><h2>Most urgent owner gates</h2><p>These are not public-safe by default. Open any card to see owner summary, source JSON, linked records, and raw normalized fields.</p><div class="cards"><?php $urgent = []; foreach (array_merge(array_values($rights), array_values($safety)) as $item) { $urgent[$item['record_id']] = $item; } foreach (array_slice(array_values($urgent), 0, 6) as $r) sr_record_card($r); ?></div></section>
