<?php
return [
    [
        'id' => 'dashboard',
        'label' => 'Dashboard',
        'description' => 'Readiness, red flags, next actions, and launch focus.',
        'timeline_rule' => 'GEN cards; linked records keep their own IDs.',
    ],
    [
        'id' => 'timeline-registry',
        'label' => 'Timeline Registry',
        'description' => 'Create and edit Timeline Moment ID families and GEN records.',
        'timeline_rule' => 'Required per record.',
    ],
    [
        'id' => 'cue-draft-import',
        'label' => 'Cue Draft Import',
        'description' => 'Stage docs/cue.txt as proposed records without finalizing the setlist.',
        'timeline_rule' => 'Assign proposed IDs before show-ready use.',
    ],
    [
        'id' => 'asset-inventory',
        'label' => 'Asset Inventory',
        'description' => 'Catalog physical and digital evidence with condition, rights, and uses.',
        'timeline_rule' => 'Required per asset.',
    ],
    [
        'id' => 'media-intake',
        'label' => 'Media Intake',
        'description' => 'Convert uploads into media and asset records with public-use flags.',
        'timeline_rule' => 'Required per media item.',
    ],
    [
        'id' => 'rights-safety-queue',
        'label' => 'Rights / Safety Queue',
        'description' => 'Surface unknown, needs-review, venue-dependent, unsafe, or prohibited records.',
        'timeline_rule' => 'Source records keep their IDs.',
    ],
    [
        'id' => 'tasks-launch',
        'label' => 'Tasks / Launch',
        'description' => 'Track build, rehearsal, venue, marketing, booking, and review work.',
        'timeline_rule' => 'GEN unless tied to a specific moment.',
    ],
    [
        'id' => 'website-cms-drafts',
        'label' => 'Website CMS Drafts',
        'description' => 'Draft public pages and CTAs from approved data only.',
        'timeline_rule' => 'Pages usually GEN; embedded records keep IDs.',
    ],
    [
        'id' => 'operator-outputs',
        'label' => 'Operator Outputs',
        'description' => 'Generate run sheets, emergency sheets, packing lists, and rehearsal checklists.',
        'timeline_rule' => 'Rows inherit source IDs.',
    ],
];
