<?php
return [
    ['finding_id'=>'IC-GEN-001','title'=>'Navigation templates exist','timeline_moment_id_or_gen'=>'GEN','severity'=>'blocking','check'=>'Every center/data/navigation.php template resolves under center/pages/.','status'=>'covered by validate.php','open_inquiry_ids'=>['OI-020']],
    ['finding_id'=>'IC-GEN-002','title'=>'Deprecated pending-review marker is blocked in app seeds','timeline_moment_id_or_gen'=>'GEN','severity'=>'blocking','check'=>'App seed data should not introduce the deprecated pending-review marker; ambiguous rows use GEN plus needs_timeline_review.','status'=>'covered by validate.php','open_inquiry_ids'=>['OI-008','OI-009']],
    ['finding_id'=>'IC-GEN-003','title'=>'Release gates include generic evidence','timeline_moment_id_or_gen'=>'GEN','severity'=>'blocking','check'=>'Each release-gate row includes evidence_summary, evidence_source_files, evidence_status, review_state, reviewer_role, last_reviewed, blocking_reason, and next_action.','status'=>'covered by validate.php','open_inquiry_ids'=>['OI-013']],
    ['finding_id'=>'IC-GEN-004','title'=>'Open inquiries are traceable','timeline_moment_id_or_gen'=>'GEN','severity'=>'warning','check'=>'Module contracts and seeds carry open_inquiry_ids when owner-answered decisions affect them.','status'=>'covered by validate.php','open_inquiry_ids'=>['OI-022']],
];
