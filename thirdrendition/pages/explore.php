<?php $rows = tr_filter_records(); tr_hero('Owner browser', 'Explore Everything', 'Search in plain language, filter by show family or source JSON, then open a record to see what it means and where it came from.'); tr_filters(); ?>
<p class="count"><b><?= count($rows); ?></b> matching records</p>
<div class="cards"><?php foreach ($rows as $r) tr_record_card($r); ?></div>
