#!/usr/bin/env python3
"""Structural and representative validation for the ongoing compendium build."""
from __future__ import annotations
import hashlib,json,re,sys
from pathlib import Path
ROOT=Path(__file__).resolve().parents[2]; COMP=ROOT/'extract/compendium'; S90=COMP/'90_schemas_and_vocabularies'
S00=COMP/'00_control_and_governance'
S01=COMP/'01_project_event_and_people'
S02=COMP/'02_show_program_and_timeline'
S03=COMP/'03_technical_systems_and_stage'
errors=[]; warnings=[]
def fail(msg): errors.append(msg)
def load(p):
 try:return json.loads(p.read_text(encoding='utf-8'))
 except Exception as e: fail(f'{p.relative_to(ROOT)}: JSON parse: {e}'); return {}
files=sorted(COMP.rglob('*.json')); docs={p:load(p) for p in files}
manifest=docs[COMP/'00_control_and_governance/compendium_manifest.json']; entries=manifest.get('data',{}).get('documents',[])
ids=[e.get('document_id') for e in entries]; paths=[e.get('path') for e in entries]
if len(entries)!=209: fail(f'manifest has {len(entries)} documents, expected 209')
if len(ids)!=len(set(ids)): fail('manifest document IDs are not unique')
if len(paths)!=len(set(paths)): fail('manifest paths are not unique')
for e in entries:
 p=COMP/e['path']
 if not p.exists(): fail(f"missing manifest path: {e['path']}"); continue
 if p.suffix=='.json':
  d=docs[p]
  state='empty' if 'scaffold_notice' in d or d.get('data',{}).get('scaffold_state')=='empty' else ('populated' if d.get('status') in ('review','approved','generated') else 'working')
  for k in ('document_id','document_class','status','revision'):
   if e.get(k)!=d.get(k): fail(f'{e["path"]}: manifest {k} mismatch')
  if e.get('scaffold_state')!=state: fail(f'{e["path"]}: manifest scaffold_state mismatch')
  ref=d.get('schema_ref')
  if d.get('document_class')!='schema' and ref and not (p.parent/ref).resolve().exists(): fail(f'{e["path"]}: unresolved schema_ref {ref}')
authored00={'source_authority_policy','document_control_policy','data_classification_policy','source_registry','compendium_manifest','provenance_ledger','conflict_register','open_questions_register','decision_register','change_control_register','document_revision_log','canon_sync_matrix','review_and_freshness_schedule'}
section00=[]
for name in sorted(authored00):
 p=S00/f'{name}.json'; d=docs[p]; section00.append(d)
 if d.get('status')!='review': fail(f'{p.name}: expected review')
 if 'scaffold_notice' in d or d.get('data',{}).get('scaffold_state')=='empty': fail(f'{p.name}: populated leaf retains scaffold state')
 if d.get('effective_date') is not None or d.get('data',{}).get('approval_state')!='pending controlled approval': fail(f'{p.name}: approval boundary is not explicit')
 if not d.get('owner_role','').startswith('role:') or not d.get('approver_role','').startswith('role:'): fail(f'{p.name}: controlled roles required')
 for s in d.get('source_refs',[]):
  sp=ROOT/s.get('path','')
  if not sp.exists(): fail(f'{p.name}: missing source {s.get("path")}')
  elif hashlib.sha256(sp.read_bytes()).hexdigest()!=s.get('sha256'): fail(f'{p.name}: stale source hash {s.get("path")}')
registry=docs[S00/'source_registry.json']['data'].get('records',[])
source_ids=[r.get('source_id') for r in registry]; source_paths=[r.get('path') for r in registry]
if len(source_ids)!=len(set(source_ids)) or len(source_paths)!=len(set(source_paths)): fail('source registry IDs/paths are not unique')
for r in registry:
 p=ROOT/r.get('path','')
 if not p.exists(): fail(f'source registry missing path: {r.get("path")}')
 elif hashlib.sha256(p.read_bytes()).hexdigest()!=r.get('sha256'): fail(f'source registry stale hash: {r.get("path")}')
conflict_ids={r.get('conflict_id') for r in docs[S00/'conflict_register.json']['data'].get('records',[])}
decision_ids={r.get('decision_id') for r in docs[S00/'decision_register.json']['data'].get('records',[])}
for q in docs[S00/'open_questions_register.json']['data'].get('records',[]):
 for x in q.get('linked_conflict_ids',[]):
  if x not in conflict_ids: fail(f'open question unresolved conflict ref: {x}')
 for x in q.get('linked_decision_ids',[]):
  if x not in decision_ids: fail(f'open question unresolved decision ref: {x}')
for r in docs[S00/'provenance_ledger.json']['data'].get('records',[]):
 if r.get('source_id') not in set(source_ids): fail(f'provenance unresolved source ref: {r.get("source_id")}')
changes=docs[S00/'change_control_register.json']['data'].get('records',[])
change_ids={r.get('change_id') for r in changes}
revisions=docs[S00/'document_revision_log.json']['data'].get('records',[])
revision_ids={r.get('revision_id') for r in revisions}
for r in changes:
 if r.get('approval_state')!='pending controlled approval' or r.get('approval_evidence_ref') is not None: fail(f'{r.get("change_id")}: approval boundary is not explicit')
 if not r.get('impact') or not r.get('propagation',{}).get('completed') or not r.get('distribution') or not r.get('supersession'): fail(f'{r.get("change_id")}: incomplete impact/propagation/distribution/supersession control')
 for x in r.get('revision_refs',[]):
  if x not in revision_ids: fail(f'{r.get("change_id")}: unresolved revision ref {x}')
for r in revisions:
 if r.get('approval_state')!='pending controlled approval' or r.get('approved_by') is not None or r.get('effective_date') is not None: fail(f'{r.get("revision_id")}: revision invents approval/effective evidence')
 for x in r.get('change_refs',[]):
  if x not in change_ids: fail(f'{r.get("revision_id")}: unresolved change ref {x}')
routes=docs[S00/'canon_sync_matrix.json']['data'].get('routes',[])
if len(routes)<5: fail('canon_sync_matrix: authority families lack propagation coverage')
for r in routes:
 if not all(r.get(k) for k in ('route_id','authority_family','source_paths','target_paths','mode','owner_role','steps','validation_commands','failure_behavior','safe_edit_boundary')): fail(f'{r.get("route_id")}: incomplete synchronization route')
sync_text=json.dumps(docs[S00/'canon_sync_matrix.json']).lower()
for required in ('prototype','directly edited','fail closed','read-only'):
 if required not in sync_text: fail(f'canon_sync_matrix: missing safe synchronization rule: {required}')
schedule=docs[S00/'review_and_freshness_schedule.json']['data']
coverage=schedule.get('coverage_contract',{}).get('review_leaf_counts',{})
if coverage!={'00_control_and_governance':13,'01_project_event_and_people':12,'02_show_program_and_timeline':14,'03_technical_systems_and_stage':10,'90_schemas_and_vocabularies':24,'total':73}: fail('review_and_freshness_schedule: review-leaf coverage mismatch')
for r in schedule.get('schedules',[]):
 if not all(r.get(k) for k in ('schedule_id','covered_sections','covered_statuses','owner_role','approver_role','cadence','triggers','checks','stale_behavior')): fail(f'{r.get("schedule_id")}: incomplete freshness schedule')
for name in ('source_authority_policy','document_control_policy','data_classification_policy'):
 if not docs[S00/f'{name}.json']['data'].get('policy_rules') and not docs[S00/f'{name}.json']['data'].get('rules'): fail(f'{name}: policy rules required')
privacy=json.dumps(docs[S00/'data_classification_policy.json']).lower()
for forbidden in ('raw_pii_value','secret_value','mail_body_value'):
 if forbidden in privacy: fail(f'data classification policy contains forbidden payload marker: {forbidden}')
authored01={'project_identity','project_scope_and_objectives','roles_and_authorities','organizations_and_partners','event_registry','event_schedule_plan','venue_registry','venue_advance_and_house_interface','travel_parking_camping_and_access','responsibility_matrix','personnel_registry','restricted_contact_directory'}
section01=[]
for name in sorted(authored01):
 p=S01/f'{name}.json'; d=docs[p]; section01.append(d)
 if d.get('status')!='review': fail(f'{p.name}: expected review')
 if 'scaffold_notice' in d or d.get('data',{}).get('scaffold_state')=='empty': fail(f'{p.name}: populated leaf retains scaffold state')
 if d.get('effective_date') is not None or d.get('data',{}).get('approval_state')!='pending controlled approval': fail(f'{p.name}: approval boundary is not explicit')
 if not d.get('owner_role','').startswith('role:') or not d.get('approver_role','').startswith('role:'): fail(f'{p.name}: controlled roles required')
 for s in d.get('source_refs',[]):
  sp=ROOT/s.get('path','')
  if not sp.exists(): fail(f'{p.name}: missing source {s.get("path")}')
  elif hashlib.sha256(sp.read_bytes()).hexdigest()!=s.get('sha256'): fail(f'{p.name}: stale source hash {s.get("path")}')
 for dep in d.get('data',{}).get('dependencies',[]):
  if dep.endswith('.json') and not (p.parent/dep).resolve().exists(): fail(f'{p.name}: unresolved dependency {dep}')
identity=docs[S01/'project_identity.json']['data']
if identity.get('identity',{}).get('affiliation_posture')!='independent_tribute_no_verified_official_affiliation': fail('project_identity: independent-tribute boundary required')
if not identity.get('verification_states') or not identity.get('unresolved_claims'): fail('project_identity: verification and unresolved claims required')
scope01=docs[S01/'project_scope_and_objectives.json']['data']
if not scope01.get('scope_boundaries',{}).get('in_scope') or not scope01.get('scope_boundaries',{}).get('out_of_scope') or len(scope01.get('objective_classes',[]))<4: fail('project_scope_and_objectives: incomplete boundaries/objectives')
roles01=docs[S01/'roles_and_authorities.json']['data']; role_ids={r.get('role_id') for r in roles01.get('records',[])}
for required in ('role:owner_performer','role:production_manager','role:stage_manager','role:safety_authority','role:rights_reviewer','role:privacy_steward'):
 if required not in role_ids: fail(f'roles_and_authorities: missing {required}')
if not any(r.get('may_initiate_safety_stop') for r in roles01.get('records',[])): fail('roles_and_authorities: no safety-stop authority')
org01=docs[S01/'organizations_and_partners.json']['data']
if org01.get('record_count')!=len(org01.get('records',[])) or not org01.get('verified_empty_scope'): fail('organizations_and_partners: record count/verified-empty scope mismatch')
org_text=json.dumps(org01).lower()
for forbidden in ('@example.com','phone_number','raw_contact_value'):
 if forbidden in org_text: fail(f'organizations_and_partners: forbidden contact payload marker {forbidden}')
event01=docs[S01/'event_registry.json']['data']
if event01.get('record_count')!=len(event01.get('records',[])) or not event01.get('publication_gate'): fail('event_registry: record count/publication gate mismatch')
for r in event01.get('records',[]):
 if any(r.get(k) is not None for k in ('event_date','start_time','time_zone','venue_ref','public_fact_block')): fail(f'{r.get("event_id")}: unverified event fact promoted')
schedule01=docs[S01/'event_schedule_plan.json']['data']
if schedule01.get('milestone_count')!=len(schedule01.get('milestones',[])): fail('event_schedule_plan: milestone count mismatch')
for r in schedule01.get('milestones',[]):
 if r.get('time_state')!='unresolved' or r.get('local_time') is not None or r.get('time_zone') is not None: fail(f'{r.get("milestone_id")}: unresolved time boundary violated')
venue01=docs[S01/'venue_registry.json']['data']
if venue01.get('record_count')!=len(venue01.get('records',[])): fail('venue_registry: record count mismatch')
for r in venue01.get('records',[]):
 if r.get('relationship_state')=='verified' or r.get('contact_ref') is not None: fail(f'{r.get("venue_id")}: relationship/contact boundary violated')
advance01=docs[S01/'venue_advance_and_house_interface.json']['data']
if advance01.get('item_count')!=len(advance01.get('advance_items',[])): fail('venue_advance_and_house_interface: item count mismatch')
for r in advance01.get('advance_items',[]):
 if r.get('verification_state')!='unknown_evidence_required' or r.get('value') is not None: fail(f'{r.get("item_id")}: unknown measurement promoted')
logistics01=docs[S01/'travel_parking_camping_and_access.json']['data']
if logistics01.get('record_count')!=len(logistics01.get('records',[])): fail('travel_parking_camping_and_access: record count mismatch')
for r in logistics01.get('records',[]):
 if r.get('public_value') is not None or not r.get('expires_at') is None: fail(f'{r.get("logistics_id")}: unverified logistics fact promoted')
for forbidden in ('raw_contact_value','mail_body_value','secret_value'):
 if forbidden in json.dumps([event01,schedule01,venue01,advance01,logistics01]).lower(): fail(f'Section 01.02: forbidden restricted payload marker {forbidden}')
responsibility01=docs[S01/'responsibility_matrix.json']['data']
for r in responsibility01.get('records',[]):
 if not r.get('accountable_role','').startswith('role:') or not r.get('safety_override'): fail(f"{r.get('responsibility_id')}: incomplete accountability/safety override")
personnel01=docs[S01/'personnel_registry.json']['data']
for r in personnel01.get('required_positions',[]):
 if r.get('holder_ref') is not None or r.get('public_display_name') is not None or r.get('public_display_state')!='withheld': fail(f"{r.get('position_id')}: unverified holder/public identity promoted")
contacts01=docs[S01/'restricted_contact_directory.json']['data']
for r in contacts01.get('records',[]):
 if not r.get('contact_ref','').startswith('contact-ref:') or r.get('redaction_state')!='payload_absent': fail(f"{r.get('contact_ref')}: contact indirection boundary violated")
for forbidden in ('email_address_value','phone_number_value','mail_body_value','secret_value','credential_value'):
 if forbidden in json.dumps([personnel01,contacts01]).lower(): fail(f'Section 01.03: forbidden restricted payload marker {forbidden}')
authored02={'performer_track_registry','actual_performance_timing_log','program_event_registry','program_timing_profiles','set_registry','finale_and_audience_release_registry','special_technical_event_registry','timeline_moment_registry','program_timeline_crosswalk','department_cue_crosswalk','transition_registry','show_state_vocabulary','stage_manager_calling_script','run_of_show'}
section02=[]
for name in sorted(authored02):
 p=S02/f'{name}.json'; d=docs[p]; section02.append(d)
 if d.get('status')!='review': fail(f'{p.name}: expected review')
 if 'scaffold_notice' in d or d.get('data',{}).get('scaffold_state')=='empty': fail(f'{p.name}: populated leaf retains scaffold state')
 if d.get('effective_date') is not None or d.get('data',{}).get('approval_state')!='pending controlled approval': fail(f'{p.name}: approval boundary is not explicit')
 for src in d.get('source_refs',[]):
  sp=ROOT/src.get('path','')
  if not sp.exists(): fail(f'{p.name}: missing source {src.get("path")}')
  elif hashlib.sha256(sp.read_bytes()).hexdigest()!=src.get('sha256'): fail(f'{p.name}: stale source hash {src.get("path")}')
 for dep in d.get('data',{}).get('dependencies',[]):
  if dep.endswith('.json') and not (p.parent/dep).resolve().exists(): fail(f'{p.name}: unresolved dependency {dep}')
program02=docs[S02/'program_event_registry.json']['data']; program_records=program02.get('records',[])
program_ids=[r.get('program_event_id') for r in program_records]
if program_ids!=[f'PGM-{i:03d}' for i in range(1,31)] or program02.get('record_count')!=30: fail('program_event_registry: expected ordered immutable PGM-001 through PGM-030')
for r in program_records:
 if r.get('public_title') is not None or r.get('publication_state')!='withheld' or not r.get('safety_override'): fail(f'{r.get("program_event_id")}: publication/safety boundary violated')
 if not isinstance(r.get('supplied_duration_seconds'),list) or any(not isinstance(v,int) or v<=0 for v in r.get('supplied_duration_seconds',[])): fail(f'{r.get("program_event_id")}: invalid supplied durations')
timing02=docs[S02/'program_timing_profiles.json']['data']; profiles=timing02.get('profiles',[])
if timing02.get('active_profile_id') is not None or {r.get('profile_id') for r in profiles}!={'profile:S','profile:L'}: fail('program_timing_profiles: candidate profiles/selection boundary violated')
if any(r.get('approved') or not r.get('excluded_time_categories') for r in profiles): fail('program_timing_profiles: approval/exclusion boundary violated')
sets02=docs[S02/'set_registry.json']['data']; set_records=sets02.get('records',[])
if [r.get('set_id') for r in set_records]!=[f'SET-{i:03d}' for i in range(1,7)]: fail('set_registry: expected SET-001 through SET-006')
if [x for r in set_records for x in r.get('ordered_program_event_refs',[])]!=program_ids: fail('set_registry: PGM membership/order mismatch')
if any(r.get('public_name') is not None or r.get('publication_state')!='withheld' for r in set_records): fail('set_registry: unapproved public set label promoted')
finale02=docs[S02/'finale_and_audience_release_registry.json']['data']; finale_records=finale02.get('records',[])
if [r.get('finale_event_id') for r in finale_records]!=[f'FIN-{i:03d}' for i in range(1,5)] or finale02.get('sequence')!=[f'FIN-{i:03d}' for i in range(1,5)]: fail('finale registry: FIN identity/order mismatch')
release=next((r for r in finale_records if r.get('finale_event_id')=='FIN-003'),{})
if release.get('audience_release_authorized') is not False or release.get('trigger_state')!='fail_closed_evidence_required' or not {'Stage Manager authorization','FOH authorization','safe-stage confirmation'}<=set(release.get('required_evidence',[])): fail('finale registry: audience release does not fail closed')
if any(not r.get('safety_override') for r in finale_records): fail('finale registry: safety override missing')
tech02=docs[S02/'special_technical_event_registry.json']['data']; tech_records=tech02.get('records',[])
if [r.get('technical_event_id') for r in tech_records]!=[f'TECH-{i:03d}' for i in range(1,4)]: fail('technical registry: TECH identity mismatch')
for r in tech_records:
 if r.get('selected_trigger') is not None or r.get('execution_state')!='withheld' or r.get('duration_seconds') is not None or r.get('duration_state')!='unknown_not_zero': fail(f'{r.get("technical_event_id")}: unresolved trigger/duration boundary violated')
 if not r.get('qualified_concurrence_required') or not r.get('inspection_requirements') or not r.get('recovery_requirements') or not r.get('safety_override'): fail(f'{r.get("technical_event_id")}: incomplete safety/readiness gate')
 for ref in r.get('program_event_refs',[]):
  if ref not in program_ids: fail(f'{r.get("technical_event_id")}: unresolved PGM ref {ref}')
moments02=docs[S02/'timeline_moment_registry.json']['data']; moment_records=moments02.get('records',[])
moment_ids=[r.get('timeline_scope') for r in moment_records]
if len(moment_ids)!=len(set(moment_ids)) or moments02.get('record_count')!=len(moment_records): fail('timeline registry: identity uniqueness/count mismatch')
for r in moment_records:
 if not re.fullmatch(r'^(PRE|OPEN|SET|SONG|TRN|CST|VID|LGT|FOG|STR|SPK|FIN|ENC|POST)-[0-9]{3}$',r.get('timeline_scope','')): fail(f'{r.get("record_id")}: invalid authored Timeline identity')
 if r.get('status')!='proposed_withheld' or r.get('approval_evidence_refs'): fail(f'{r.get("record_id")}: draft/approval withholding boundary violated')
 for ref in r.get('program_event_refs',[]):
  if ref.startswith('PGM-') and ref not in program_ids: fail(f'{r.get("record_id")}: unresolved PGM ref {ref}')
  if ref.startswith('TECH-') and ref not in {x.get('technical_event_id') for x in tech_records}: fail(f'{r.get("record_id")}: unresolved TECH ref {ref}')
  if ref.startswith('FIN-') and ref not in {x.get('finale_event_id') for x in finale_records}: fail(f'{r.get("record_id")}: unresolved FIN ref {ref}')
cross02=docs[S02/'program_timeline_crosswalk.json']['data']; cross_records=cross02.get('records',[])
event_ids=program_ids+[r.get('technical_event_id') for r in tech_records]+[r.get('finale_event_id') for r in finale_records]
if [r.get('source_id') for r in cross_records]!=event_ids: fail('program_timeline_crosswalk: incomplete or unordered controlled-event coverage')
moment_record_ids={r.get('record_id') for r in moment_records}
for r in cross_records:
 if r.get('identity_equivalence') is not False or r.get('approval_state')!='withheld' or r.get('publication_state')!='withheld': fail(f'{r.get("crosswalk_id")}: identity/approval boundary violated')
 if r.get('timeline_moment_ref') not in moment_record_ids: fail(f'{r.get("crosswalk_id")}: unresolved Timeline reference')
cue02=docs[S02/'department_cue_crosswalk.json']['data']; cue_records=cue02.get('records',[])
if [r.get('controlled_event_ref') for r in cue_records]!=event_ids: fail('department_cue_crosswalk: incomplete controlled-event coverage')
cross_ids={r.get('crosswalk_id') for r in cross_records}
for r in cue_records:
 if r.get('program_timeline_crosswalk_ref') not in cross_ids or r.get('timeline_moment_ref') not in moment_record_ids: fail(f'{r.get("crosswalk_id")}: unresolved upstream crosswalk reference')
 for allocation in r.get('department_allocations',[]):
  if allocation.get('department_cue_id') is not None or allocation.get('trigger') is not None or allocation.get('concurrence_state')!='pending': fail(f'{r.get("crosswalk_id")}: fabricated or prematurely concurred department cue')
 if r.get('safety_critical') and r.get('execution_state')!='blocked_pending_approval_and_readiness': fail(f'{r.get("crosswalk_id")}: safety-critical relationship does not fail closed')
trans02=docs[S02/'transition_registry.json']['data']; transition_records=trans02.get('records',[])
if len(transition_records)!=8: fail('transition_registry: expected five set boundaries and three TECH relationships')
for r in transition_records:
 if r.get('duration_seconds') is not None or r.get('duration_state')!='unknown_not_zero' or r.get('trigger') is not None: fail(f'{r.get("transition_id")}: unknown duration/trigger promoted')
 if r.get('transition_type')=='special_technical_event' and r.get('execution_state')!='blocked_pending_approval_readiness_and_trigger_resolution': fail(f'{r.get("transition_id")}: special transition does not fail closed')
state02=docs[S02/'show_state_vocabulary.json']['data']
state_names={r.get('state') for r in state02.get('states',[])}
if not {'PRESET','WARNING','STANDBY','GO','CONFIRM','HOLD','ABORT','STOP','RESET','RESTART_READY','COMPLETE'}<=state_names: fail('show_state_vocabulary: required planned/emergency/recovery states missing')
if 'prohibited' not in state02.get('unknown_transition_rule','').lower() or state02.get('precedence',[])[:3]!=['ABORT','STOP','HOLD']: fail('show_state_vocabulary: fail-closed transition/precedence boundary violated')
for r in state02.get('allowed_transitions',[]):
 if not r.get('authority_roles') or not r.get('required_evidence'): fail(f"show_state_vocabulary: untraceable transition {r.get('from')} -> {r.get('to')}")
calling02=docs[S02/'stage_manager_calling_script.json']['data']; calling_records=calling02.get('records',[])
if calling02.get('call_ready') is not False or calling02.get('publication_status')!='withheld' or [r.get('event_ref') for r in calling_records]!=event_ids: fail('stage_manager_calling_script: controlled coverage/call-ready boundary violated')
for r in calling_records:
 if any(r.get(k) is not None for k in ('standby','warning','go_call','confirmation','entrance_exit','department_cue_ids')): fail(f"{r.get('event_ref')}: invented executable calling fact")
 if r.get('event_type')=='technical_candidate' and r.get('trigger') is not None: fail(f"{r.get('event_ref')}: unresolved TECH trigger promoted")
ros02=docs[S02/'run_of_show.json']['data']; phases=ros02.get('phases',[])
if ros02.get('active_schedule') is not False or ros02.get('generated_view') is not False or ros02.get('publication_status')!='withheld': fail('run_of_show: inactive/unapproved view boundary violated')
if any(r.get('planned_start') is not None or r.get('planned_duration') is not None or r.get('activation_status')!='withheld' for r in phases): fail('run_of_show: unknown operational schedule promoted')
if ros02.get('program_sequence_refs')!=program_ids or ros02.get('transition_refs')!=[r.get('transition_id') for r in transition_records]: fail('run_of_show: upstream sequence references mismatch')
if not any(r.get('phase_id')=='ROS-AUDIENCE-EXIT' and 'FIN-003' in r.get('entry_gate','') for r in phases) or not any(r.get('phase_id')=='ROS-LOAD-OUT' and 'released' in r.get('entry_gate','').lower() for r in phases): fail('run_of_show: audience release/load-out safety gates missing')
performer02=docs[S02/'performer_track_registry.json']['data']; performer_records=performer02.get('records',[])
if performer02.get('execution_ready') is not False or [r.get('event_ref') for r in performer_records]!=event_ids: fail('performer_track_registry: coverage/execution boundary violated')
for r in performer_records:
 if any(r.get(k) is not None for k in ('performer_identity_refs','entrance_cue','exit_cue','onstage_position_or_blocking','costume_state_and_change_route','prop_handoffs','microphone_or_instrument_pickup_return','bow_or_finale_action','readiness_confirmation','department_concurrence')): fail(f"{r.get('event_ref')}: invented performer-track fact")
timinglog02=docs[S02/'actual_performance_timing_log.json']['data']
if timinglog02.get('records')!=[] or timinglog02.get('record_count')!=0 or timinglog02.get('record_state')!='empty_contract_not_active_record' or timinglog02.get('generation_state')!='not_generated': fail('actual_performance_timing_log: fabricated/active actual record')
contract=timinglog02.get('required_record_contract',{})
for k in ('performance_instance_id','source_start_timestamp','source_stop_timestamp','hold_intervals','variance_seconds','evidence_refs','authorization','safety_or_incident_refs'):
 if k not in contract: fail(f'actual_performance_timing_log: missing contract field {k}')
equipment03=docs[S03/'equipment_type_catalog.json']['data']; equipment_records=equipment03.get('records',[])
if equipment03.get('active_configuration') is not False or equipment03.get('record_count')!=len(equipment_records) or not equipment_records: fail('equipment_type_catalog: empty or active catalog boundary violated')
for r in equipment_records:
 if r.get('active_configuration') is not False or r.get('instance_assignment_refs') or r.get('patch_refs') or r.get('safety_approval_refs') or r.get('verification_state')!='unverified': fail(f"{r.get('record_id')}: assignment/approval/verification boundary violated")
 if r.get('manufacturer_claims'): fail(f"{r.get('record_id')}: unsupported manufacturer claim promoted")
 for m in r.get('modes',[]):
  if m.get('channel_count')!=len(m.get('channels',[])) or [c.get('offset') for c in m.get('channels',[])]!=list(range(1,m.get('channel_count',0)+1)): fail(f"{r.get('record_id')}: invalid candidate channel mode")
section03=[docs[S03/f'{name}.json'] for name in ('equipment_type_catalog','equipment_instance_registry','vendor_document_registry','equipment_capability_and_mode_catalog','coordinate_system','pavilion_geometry','stage_geometry','scaffold_and_rigging_geometry','stage_zone_registry','stage_layer_registry')]
for d in section03:
 if d.get('status')!='review' or d.get('effective_date') is not None or d.get('data',{}).get('approval_state') not in {'pending controlled approval','controlled_human_approval_required'}: fail(f"{d.get('document_id')}: review/approval boundary violated")
 for src in d.get('source_refs',[]):
  sp=ROOT/src.get('path','')
  if not sp.exists() or hashlib.sha256(sp.read_bytes()).hexdigest()!=src.get('sha256'): fail(f"{d.get('document_id')}: missing/stale source {src.get('path')}")
instances03=docs[S03/'equipment_instance_registry.json']['data']; instance_records=instances03.get('records',[])
if instances03.get('source_record_count')!=59 or instances03.get('record_count')!=59 or len(instance_records)!=59: fail('equipment_instance_registry: expected complete 59-record coverage')
type_refs={r.get('record_id') for r in equipment_records}
for r in instance_records:
 if r.get('type_ref') not in type_refs or r.get('controlled_status')!='unverified_candidate': fail(f"{r.get('instance_id')}: unresolved type/status boundary")
 if r.get('serial_number') is not None or r.get('active_patch_ref') is not None or r.get('active_configuration') is not False or r.get('safety_approval_refs'): fail(f"{r.get('instance_id')}: unsupported serial/patch/configuration/safety claim")
 verification=r.get('physical_verification',{}); maintenance=r.get('maintenance_state',{})
 if verification.get('state')!='unverified' or verification.get('verified_at') is not None or maintenance.get('clearance') is not None: fail(f"{r.get('instance_id')}: verification/maintenance clearance promoted")
vendors03=docs[S03/'vendor_document_registry.json']['data']; vendor_records=vendors03.get('records',[])
if vendors03.get('record_count')!=3 or len(vendor_records)!=3: fail('vendor_document_registry: expected three manuals')
for r in vendor_records:
 if not r.get('source_file') or not r.get('sha256') or r.get('extracted_claims') or r.get('claim_extraction_status')!='not_extracted_no_page_locator_available': fail(f"{r.get('manual_id')}: vendor identity/claim locator boundary violated")
 if r.get('metadata_companion_role','').startswith('discovery metadata') is False or r.get('applicability_state')!='unverified_pending_model_and_physical_reconciliation': fail(f"{r.get('manual_id')}: metadata/applicability boundary violated")
capabilities03=docs[S03/'equipment_capability_and_mode_catalog.json']['data']; capability_records=capabilities03.get('records',[])
if capabilities03.get('active_configuration') is not False or capabilities03.get('record_count')!=len(equipment_records) or len(capability_records)!=9: fail('equipment capability catalog: coverage/active boundary violated')
for r in capability_records:
 if r.get('equipment_type_ref') not in type_refs or r.get('verified_capabilities') or r.get('verified_modes') or r.get('active_mode_ref') is not None or r.get('active_configuration') is not False or r.get('patch_refs') or r.get('safety_approval_refs'): fail(f"{r.get('record_id')}: candidate/verified/active boundary violated")
 for m in r.get('candidate_modes',[]):
  channels=m.get('channels',[])
  if m.get('mode_state')!='candidate_unverified' or m.get('channel_count')!=len(channels) or [c.get('offset') for c in channels]!=list(range(1,len(channels)+1)): fail(f"{r.get('record_id')} {m.get('mode_id')}: invalid candidate mode shape")
  if any(c.get('default_value') is not None or c.get('home_value') is not None or c.get('range_claims') for c in channels) or m.get('working_mode_selected') or m.get('avoided_mode_selected'): fail(f"{r.get('record_id')} {m.get('mode_id')}: unsupported defaults/ranges/mode selection promoted")
coordinate03=docs[S03/'coordinate_system.json']['data']
if coordinate03.get('units',{}).get('linear')!='feet' or coordinate03.get('handedness',{}).get('convention')!='right_handed': fail('coordinate_system: units/handedness authority missing')
if coordinate03.get('origin',{}).get('verification_state')!='prototype_candidate' or coordinate03.get('candidate_coordinate_policy',{}).get('default_verification_state')!='unverified': fail('coordinate_system: prototype verification boundary violated')
if set(coordinate03.get('axes',{}))!={'x','y','z'} or coordinate03.get('orientation',{}).get('audience_direction')!='+y': fail('coordinate_system: axes/orientation incomplete')
if coordinate03.get('transformations',{}).get('scale','').startswith('prohibited') is False: fail('coordinate_system: unsafe scaling rule missing')
pavilion03=docs[S03/'pavilion_geometry.json']['data']; pavilion_measurements=pavilion03.get('measurements',[])
if pavilion03.get('record_count')!=len(pavilion_measurements) or len(pavilion_measurements)!=16: fail('pavilion_geometry: expected 16 evidence-qualified measurements')
stage03=docs[S03/'stage_geometry.json']['data']; stage_measurements=stage03.get('measurements',[])
if stage03.get('record_count')!=len(stage_measurements) or len(stage_measurements)!=20: fail('stage_geometry: expected 20 evidence-qualified measurements')
for name,records in [('pavilion_geometry',pavilion_measurements),('stage_geometry',stage_measurements)]:
 for r in records:
  if r.get('unit')!='feet' or r.get('evidence_class')!='prototype_record' or r.get('confidence')!='low' or r.get('verification_state')!='unverified' or r.get('approval_state')!='not_approved': fail(f"{name}: measurement boundary violated for {r.get('measurement_id')}")
if pavilion03.get('clearances')!=[] or stage03.get('access_routes')!=[] or stage03.get('clearances')!=[] or stage03.get('structural_capacities')!=[]: fail('geometry registries: unsupported clearance/access/capacity facts promoted')
bounds=stage03.get('candidate_bounds',{})
for name in ('main_stage','rear_platform','center_transition'):
 b=bounds.get(name,{})
 if not (b.get('x_min')<b.get('x_max') and b.get('y_min')<b.get('y_max') and b.get('z_min')<=b.get('z_max')): fail(f'stage_geometry: invalid candidate bounds for {name}')
if bounds.get('audience_floor',{}).get('origin_and_bounds') is not None: fail('stage_geometry: unsupported audience-floor origin promoted')
scaffold03=docs[S03/'scaffold_and_rigging_geometry.json']['data']; scaffold_measurements=scaffold03.get('measurements',[])
if scaffold03.get('record_count')!=len(scaffold_measurements) or len(scaffold_measurements)!=11: fail('scaffold geometry: expected 11 evidence-qualified measurements')
if any(r.get('unit')!='feet' or r.get('verification_state')!='unverified' or r.get('approval_state')!='not_approved' for r in scaffold_measurements): fail('scaffold geometry: candidate evidence boundary violated')
structural=scaffold03.get('structural_and_rigging_facts',{})
if any(structural.get(k) is not None for k in ('load_ratings','attachment_points','roof_capacity','clearances','rigging_approval')): fail('scaffold geometry: unsupported structural/rigging fact promoted')
sb=scaffold03.get('candidate_bounds',{})
if not (sb.get('x_min')<sb.get('x_max') and sb.get('y_min')<sb.get('y_max') and sb.get('z_min')<sb.get('z_max')): fail('scaffold geometry: invalid candidate bounds')
zones03=docs[S03/'stage_zone_registry.json']['data']; zone_records=zones03.get('records',[])
if zones03.get('record_count')!=len(zone_records) or len(zone_records)!=8: fail('stage zones: expected eight prototype zones')
for r in zone_records:
 if r.get('candidate_bounds') is not None or r.get('verification_state')!='unverified' or r.get('operational_activation') is not False or any(v is not None for k,v in r.get('permissions',{}).items() if k!='state'): fail(f"{r.get('zone_id')}: zone permission/verification boundary violated")
layers03=docs[S03/'stage_layer_registry.json']['data']; layer_records=layers03.get('records',[])
if layers03.get('record_count')!=len(layer_records) or len(layer_records)!=13 or [r.get('display_order') for r in layer_records]!=list(range(1,14)): fail('stage layers: coverage/order mismatch')
for r in layer_records:
 if r.get('operational_activation') is not False or r.get('safety_clearance') is not False or r.get('approval_state')!='not_approved' or r.get('generated_view_boundary',{}).get('is_generated_view') is not False: fail(f"{r.get('layer_id')}: visualization/operational boundary violated")
section90=[]
for p in sorted(S90.glob('*.json')):
 d=docs[p]; section90.append(d)
 if d.get('status')!='review': fail(f'{p.name}: expected review')
 if 'scaffold_notice' in d or d.get('data',{}).get('scaffold_state')=='empty': fail(f'{p.name}: populated leaf retains scaffold state')
 for s in d.get('source_refs',[]):
  sp=ROOT/s.get('path','')
  if not sp.exists(): fail(f'{p.name}: missing source {s.get("path")}')
  elif hashlib.sha256(sp.read_bytes()).hexdigest()!=s.get('sha256'): fail(f'{p.name}: stale source hash {s.get("path")}')
 if d.get('document_class')=='schema':
  schema=d.get('data',{}).get('schema',{})
  if schema.get('$schema')!='https://json-schema.org/draft/2020-12/schema': fail(f'{p.name}: wrong/missing dialect')
  if schema.get('$id')!=p.name: fail(f'{p.name}: $id must be local filename')
  def refs(x):
   if isinstance(x,dict):
    for k,v in x.items():
     if k=='$ref': yield v
     yield from refs(v)
   elif isinstance(x,list):
    for v in x: yield from refs(v)
  for ref in refs(schema):
   target,_,pointer=ref.partition('#'); tp=S90/target
   if target and not tp.exists(): fail(f'{p.name}: unresolved $ref file {target}')
   if pointer and pointer!='/data/schema': fail(f'{p.name}: unsupported/unresolved local pointer #{pointer}')
# Representative invariants: identities, domain distinctions, publication evidence, privacy, and DMX shape/bounds.
timeline=re.compile(r'^(GEN|(PRE|OPEN|SET|SONG|TRN|CST|VID|LGT|FOG|STR|SPK|FIN|ENC|POST)-[0-9]{3})$')
event=re.compile(r'^(PGM|TECH|FIN)-[0-9]{3}$')
for good in ('GEN','SONG-001','FIN-999'): assert timeline.fullmatch(good)
for bad in ('GENERAL','SONG-1','PGM-001','GEN-001'): assert not timeline.fullmatch(bad)
for good in ('PGM-001','TECH-003','FIN-001'): assert event.fullmatch(good)
for bad in ('SONG-001','PGM-1','GEN'): assert not event.fullmatch(bad)
def valid_patch(start,footprint): return isinstance(start,int) and isinstance(footprint,int) and 1<=start<=512 and 1<=footprint<=512 and start+footprint-1<=512
assert valid_patch(1,1) and valid_patch(500,13) and not valid_patch(0,1) and not valid_patch(512,2)
form=docs[S90/'form_submission.schema.json']['data']['schema']['properties']; assert form['raw_payload'] is False and form['mail_body'] is False and form['secret'] is False
for name,field,states in [('asset.schema.json','publication_state',{'published'}),('content_token.schema.json','content_state',{'published'}),('campaign.schema.json','release_state',{'released'}),('public_route_section.schema.json','publication_state',{'published'})]:
 schema=docs[S90/name]['data']['schema']; assert schema.get('allOf'), (name,'missing evidence gate'); assert states
try:
 import jsonschema
except ImportError:
 warnings.append('jsonschema unavailable: full Draft 2020-12 metaschema and format-assertion validation not run')
else:
 from referencing import Registry,Resource
 registry=Registry()
 for p in S90.glob('*.schema.json'):
  schema=docs[p]['data']['schema']; registry=registry.with_resource(p.name,Resource.from_contents(schema))
 for p in S90.glob('*.schema.json'):
  schema=docs[p]['data']['schema']; jsonschema.Draft202012Validator.check_schema(schema); jsonschema.Draft202012Validator(schema,registry=registry,format_checker=jsonschema.FormatChecker())
print(f'Validated {len(files)} JSON files, {len(entries)} manifest entries, {len(section00)} authored Section 00 leaves, {len(section01)} authored Section 01 leaves, {len(section02)} authored Section 02 leaves, {len(section03)} authored Section 03 leaves, and {len(section90)} Section 90 leaves.')
for w in warnings: print('WARNING:',w)
for e in errors: print('ERROR:',e,file=sys.stderr)
sys.exit(1 if errors else 0)
