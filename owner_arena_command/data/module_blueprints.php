<?php
return [
 'timeline-registry'=>['source'=>['timeline_moment_registry.json','cue.json'],'gate'=>'Every row must be Timeline Moment ID or GEN.'],
 'cue-draft-import'=>['source'=>['cue.json','cue.txt'],'gate'=>'Draft only; migrate with rights/safety review.'],
 'asset-inventory'=>['source'=>['inventory_reference.json','rig.json'],'gate'=>'Public use blocked until rights and safety are reviewed.'],
 'website-cms-drafts'=>['source'=>['website_system_plan.json','styleguide.json'],'gate'=>'No protected logos, official marks, or endorsement claims.'],
];
