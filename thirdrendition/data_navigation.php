<?php
return [
    ['id' => 'dashboard', 'label' => 'Production Home', 'summary' => 'Actionable owner dashboard with real sections and drilldowns.'],
    ['id' => 'inventory', 'label' => 'DMX Fixtures', 'summary' => 'All lighting, rig, manual, channel, and fixture records.'],
    ['id' => 'cues', 'label' => 'Cue Sheets', 'summary' => 'Show-flow, songs, transitions, finale, and cue draft records.'],
    ['id' => 'runbooks', 'label' => 'Run Books', 'summary' => 'Operator, safety, rig, website, and production run-book sources.'],
    ['id' => 'sections', 'label' => 'Project Sections', 'summary' => 'Every project segment grouped by source and owner category.'],
    ['id' => 'section', 'label' => 'Section Detail', 'summary' => 'Records inside one project segment.', 'hidden' => true],
    ['id' => 'explore', 'label' => 'Find Anything', 'summary' => 'Search and filter every normalized JSON record.'],
    ['id' => 'record', 'label' => 'Record Detail', 'summary' => 'Full owner readout plus raw normalized data.', 'hidden' => true],
    ['id' => 'sources', 'label' => 'JSON Library', 'summary' => 'Every source JSON file, record counts, and integrity checks.'],
    ['id' => 'source', 'label' => 'Source Detail', 'summary' => 'Source summary, records, and raw JSON.', 'hidden' => true],
    ['id' => 'integrity', 'label' => 'Data Integrity', 'summary' => 'Schema, duplicate, timeline, and relationship checks.'],
];
