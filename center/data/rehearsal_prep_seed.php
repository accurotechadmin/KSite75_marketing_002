<?php
/** Rehearsal/prep starter seed; private and deferred. */
return [
    'items' => [
        ['record_id'=>'RP-GEN-001','title'=>'Cue migration readiness drill','prep_type'=>'cue fix','timeline_moment_id_or_gen'=>'GEN','status'=>'draft','priority'=>'high','owner_or_responsible_role'=>'Owner / Performer','disclosure_tier'=>'operator-private','next_action'=>'Identify draft cue rows that need Timeline Moment IDs before rehearsal export.','source_records'=>['docs/cue.txt','docs/timeline_moment_registry.md'],'public_private_boundary'=>'Internal-only; do not publish cue timings or emergency states.','safety_gate'=>'Fog/strobe/blackout/projection/sound effects require venue-aware review.','open_inquiry_ids'=>['OI-010','OI-011'],'last_updated'=>'2026-07-19'],
        ['record_id'=>'RP-GEN-002','title'=>'Packing and readiness placeholder','prep_type'=>'packing prep','timeline_moment_id_or_gen'=>'GEN','status'=>'draft','priority'=>'medium','owner_or_responsible_role'=>'Owner / Performer','disclosure_tier'=>'owner-private','next_action'=>'Seed gear, media, costume, lighting, and venue-dependent checklist rows from approved inventory records.','source_records'=>['docs/inventory_reference.md','docs/rig.md'],'public_private_boundary'=>'Public summaries may mention spectacle generally after review; internal gear details remain private.','safety_gate'=>'Electrical, rigging, loud sound, and venue constraints remain safety-gated.','open_inquiry_ids'=>['OI-010','OI-011'],'last_updated'=>'2026-07-19'],
    ],
];
