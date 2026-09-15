<?php
$inventory = tr_inventory_records();
$cues = tr_cue_records();
$runbooks = tr_runbook_records();
$sections = tr_section_groups();
$rights = array_filter($records, fn($r) => preg_match('/unknown|needs|review|prohibited/i', $r['rights_status']));
$safety = array_filter($records, fn($r) => preg_match('/needs|review|venue|unsafe/i', $r['safety_status']));
tr_hero('Third rendition owner console', 'Production data you can actually use', 'Open DMX fixtures, cue sheets, run books, project sections, source JSON, and individual records from the front page. Every card and row drills into a detail page.');
?>
<section class="metrics">
<?php tr_metric('All records', (string)count($records), '?page=explore', 'Search everything'); ?>
<?php tr_metric('DMX / rig items', (string)count($inventory), '?page=inventory', 'Fixtures, manuals, patch, channels'); ?>
<?php tr_metric('Cue-sheet items', (string)count($cues), '?page=cues', 'Songs, sets, transitions, finale'); ?>
<?php tr_metric('Run-book items', (string)count($runbooks), '?page=runbooks', 'Operator and owner execution'); ?>
<?php tr_metric('Project sections', (string)count($sections), '?page=sections', 'Source-based work areas'); ?>
</section>
<section class="panel"><h2>Owner workbench</h2><div class="action-grid">
<a href="?page=inventory"><b>See every DMX fixture and rig item</b><span>Inventory reference, rig records, manuals, fixture/channel notes, and safety gates.</span></a>
<a href="?page=cues"><b>Open cue sheets and show flow</b><span>Draft songs, sets, transitions, finale/encore, operator-linked timeline records.</span></a>
<a href="?page=runbooks"><b>Open run books</b><span>Operator outputs, website system plan, admin readiness, rig digest, safety/rights work.</span></a>
<a href="?page=sections"><b>Browse all project segments</b><span>Each JSON/document source becomes a section with records and data health indicators.</span></a>
<a href="?page=explore"><b>Find anything</b><span>Search by plain language, Timeline family, source file, status, rights, and safety.</span></a>
<a href="?page=integrity"><b>Check data integrity</b><span>Duplicates, missing universal fields, invalid Timeline/GEN values, broken links.</span></a>
</div></section>
<section class="panel"><h2>Needs owner review before public/show use</h2><p>Rights and safety gates stay visible. Draft cue records are not public-safe or show-ready by default.</p><div class="cards"><?php $urgent=[]; foreach (array_merge(array_values($rights), array_values($safety)) as $r) $urgent[$r['record_id']]=$r; foreach (array_slice(array_values($urgent),0,8) as $r) tr_record_card($r); ?></div></section>
