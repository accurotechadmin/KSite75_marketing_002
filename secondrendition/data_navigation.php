<?php
return [
    ['id' => 'dashboard', 'label' => 'Home', 'summary' => 'Plain-language project overview and urgent gates.'],
    ['id' => 'explore', 'label' => 'Explore Everything', 'summary' => 'Owner-friendly cards for every normalized JSON record.'],
    ['id' => 'record', 'label' => 'Record Detail', 'summary' => 'Full owner readout plus raw normalized data.', 'hidden' => true],
    ['id' => 'sources', 'label' => 'JSON Library', 'summary' => 'Every source JSON file, record counts, and integrity checks.'],
    ['id' => 'source', 'label' => 'Source Detail', 'summary' => 'Source summary, records, and raw JSON.', 'hidden' => true],
    ['id' => 'integrity', 'label' => 'Data Integrity', 'summary' => 'Schema, duplicate, timeline, and relationship checks.'],
];
