<?php
/** Universal owner-record contract for `/center`. */
return [
    'required_fields' => ['record_id','title','section','category','timeline_moment_id_or_gen','status','priority','owner_or_responsible_role','disclosure_tier','rights_status','safety_status','description','linked_files','linked_records','last_updated','source_file','source_title','source_type','open_inquiry_ids'],
    'timeline_pattern' => '/^(GEN|PRE|OPEN|SET|SONG|TRN|CST|VID|LGT|FOG|STR|SPK|FIN|ENC|POST)-?\d*$/',
    'readiness_statuses' => ['draft','internal-ready','venue-ready','public-ready'],
    'show_ready_rule' => 'show-ready is a checklist result, not a content status.',
    'needs_timeline_review_rule' => 'Ambiguous records use timeline_moment_id_or_gen=GEN with status=needs_timeline_review; this is a warning unless also approved, exported, public-ready, venue-ready, internal-ready, or show-ready.',
    'allowed_roles' => ['Developer','D','Owner / Performer'],
    'disclosure_tiers' => ['public-safe','venue-shareable','owner-private','operator-private','safety-sensitive'],
    'provenance_levels' => ['source canon','machine companion','settings contract','app seed','owner overlay','generated output','archived reference'],
    'inquiry_severities' => ['blocking','safe placeholder allowed','future-pass only'],
    'release_gate_evidence_shape' => ['evidence_summary','evidence_source_files','evidence_status','review_state','reviewer_role','last_reviewed','blocking_reason','next_action'],
    'relationship_edges' => ['blocks','depends_on','uses_asset','appears_on_page','derived_from','requires_review','outputs_to'],
    'integrity_checks_to_scaffold' => ['PHP syntax','JSON syntax','navigation template existence','settings manifest path resolution','SSOT master-index path resolution','missing timeline_moment_id_or_gen','deprecated pending-review marker','needs_timeline_review promoted too far','release gate missing evidence','source conflicts needing Decision Log','missing open_inquiry_ids'],
];
