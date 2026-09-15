<?php $rows = tr_page_records(tr_cue_records()); tr_hero('Cue sheets and show flow', 'Songs, sets, transitions, effects, finale, and encore items', 'Cue data remains draft/proposed until migrated, reviewed, and cleared. Click any row for owner summary, gates, linked source files, and raw data.'); tr_collection_filter('cues'); ?>
<section class="panel"><h2>Cue sheet records</h2><?php tr_owner_table($rows, 'No cue records match this filter.'); ?></section>
<section class="panel"><h2>Cue cards</h2><div class="cards"><?php foreach ($rows as $r) tr_record_card($r); ?></div></section>
