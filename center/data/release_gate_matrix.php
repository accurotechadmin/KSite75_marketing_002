<?php
/** Read-only generic release gate matrix. */
$emptyEvidence = [
    'evidence_summary' => '',
    'evidence_source_files' => [],
    'evidence_status' => 'missing',
    'review_state' => 'not reviewed',
    'reviewer_role' => 'Owner / Performer',
    'last_reviewed' => 'TBD',
    'blocking_reason' => '',
    'next_action' => '',
];
return [
    'readiness_statuses' => ['draft','internal-ready','venue-ready','public-ready'],
    'show_ready_rule' => 'show-ready is a separate checklist result and is not assigned by this matrix.',
    'gate_families' => ['brand_affiliation','rights','copy','media','privacy','venue','safety','technical_disclosure'],
    'blocker_rule' => 'No public copy may imply official endorsement, sponsorship, authorization, ownership, clearance, or approval unless written approval exists.',
    'rows' => [
        ['record_id'=>'RG-GEN-001','family'=>'brand_affiliation','readiness_status'=>'draft','timeline_moment_id_or_gen'=>'GEN','disclosure_tier'=>'public-safe','source_files'=>['README.md','docs/website_system_plan.md','proto/docs/language.json'],'owner_action'=>'Keep independent theatrical tribute disclaimers visible before public-ready use.','open_inquiry_ids'=>['OI-005','OI-013'],'inquiry_severity'=>'blocking','evidence'=>array_merge($emptyEvidence,['evidence_summary'=>'Current canon requires independent, rights-aware public posture; written approval is not present in the repository.','evidence_source_files'=>['README.md','docs/website_system_plan.md'],'evidence_status'=>'partial','review_state'=>'needs review','blocking_reason'=>'No written approval source exists for affiliation-sensitive claims.','next_action'=>'Review proto public copy before any public-ready claim.'])],
        ['record_id'=>'RG-GEN-002','family'=>'safety','readiness_status'=>'draft','timeline_moment_id_or_gen'=>'GEN','disclosure_tier'=>'safety-sensitive','source_files'=>['docs/rig.md','docs/cue.txt'],'owner_action'=>'Confirm venue-dependent fog, strobe, blackout, projection, sound, and moving-light limits.','open_inquiry_ids'=>['OI-010','OI-011','OI-013'],'inquiry_severity'=>'blocking','evidence'=>array_merge($emptyEvidence,['evidence_summary'=>'Cue draft and rig notes exist, but Cue Bible migration and venue constraints are deferred.','evidence_source_files'=>['docs/rig.md','docs/cue.txt'],'evidence_status'=>'partial','review_state'=>'needs review','blocking_reason'=>'Cue timings and emergency states are not public-ready or show-ready.','next_action'=>'Defer to dedicated Cue Bible and safety review pass.'])],
        ['record_id'=>'RG-GEN-003','family'=>'technical_disclosure','readiness_status'=>'internal-ready','timeline_moment_id_or_gen'=>'GEN','disclosure_tier'=>'venue-shareable','source_files'=>['docs/ssot/settings/technical_show_control.json'],'owner_action'=>'Separate public-safe summaries from owner/operator mechanics.','open_inquiry_ids'=>['OI-011','OI-013'],'inquiry_severity'=>'safe placeholder allowed','evidence'=>array_merge($emptyEvidence,['evidence_summary'=>'Settings-backed technical disclosure tiers exist as starter contracts.','evidence_source_files'=>['docs/ssot/settings/technical_show_control.json'],'evidence_status'=>'starter contract','review_state'=>'needs review','next_action'=>'Map each technical output to one disclosure tier before export.'])],
        ['record_id'=>'RG-GEN-004','family'=>'privacy','readiness_status'=>'draft','timeline_moment_id_or_gen'=>'GEN','disclosure_tier'=>'owner-private','source_files'=>['center/storage/README.md','center/data/booking_contacts_seed.php'],'owner_action'=>'Keep real private contacts, pricing, approvals, and sensitive notes out of repository storage.','open_inquiry_ids'=>['OI-012','OI-019'],'inquiry_severity'=>'blocking','evidence'=>array_merge($emptyEvidence,['evidence_summary'=>'Storage folders are placeholders only; retention remains TBD until deployment architecture is selected.','evidence_source_files'=>['center/storage/README.md'],'evidence_status'=>'partial','review_state'=>'needs review','blocking_reason'=>'No approved auth, audit, backup, retention, or privacy workflow exists.','next_action'=>'Use placeholder contact roles only.'])],
    ],
];
