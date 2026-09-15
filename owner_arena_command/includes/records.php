<?php
function ac_storage_file(string $name='records.json'): string { return rtrim(ac_config()['runtime_data_root'],'/').'/'.$name; }
function ac_read_json_file(string $path, array $fallback=[]): array { if(!is_readable($path)) return $fallback; $j=json_decode((string)file_get_contents($path), true); return is_array($j)?$j:$fallback; }
function ac_write_json_file(string $path, array $data): void { ac_ensure_dir(dirname($path)); file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES)."\n", LOCK_EX); }
function ac_owner_store(): array { return ac_read_json_file(ac_storage_file(), ['records'=>[], 'deleted'=>[]]); }
function ac_save_owner_store(array $store): void { $store['records']=$store['records']??[]; $store['deleted']=$store['deleted']??[]; ac_write_json_file(ac_storage_file(), $store); }
function ac_normalize_record(array $raw, string $file, array $doc, int $i=0): array {
 $src=$doc['source_document']['path'] ?? ('data/ssot/'.$file); $id=$raw['record_id'] ?? ($doc['ssot_document_id'] ?? pathinfo($file,PATHINFO_FILENAME)).'.'.($i+1);
 $class=$doc['timeline_classification'] ?? 'GEN'; $timeline=$raw['timeline_moment_id_or_gen'] ?? ($class === 'GEN' ? 'GEN' : 'GEN-REVIEW');
 $title=$raw['title'] ?? ac_doc_title($doc,$file); $desc=$raw['description'] ?? ac_doc_summary($doc);
 return [
  'record_id'=>(string)$id,'title'=>(string)$title,'section'=>$raw['section'] ?? pathinfo($file,PATHINFO_FILENAME),'category'=>$raw['category'] ?? ($doc['source_document']['category'] ?? 'source document'),
  'timeline_moment_id_or_gen'=>(string)$timeline,'status'=>$raw['status'] ?? ($doc['maintenance']['status'] ?? 'needs review'),'priority'=>$raw['priority'] ?? (str_contains(strtolower($desc),'launch')?'high':'medium'),
  'owner_or_responsible_role'=>$raw['owner_or_responsible_role'] ?? 'owner','public_private_flag'=>$raw['public_private_flag'] ?? 'internal-only','rights_status'=>$raw['rights_status'] ?? 'needs review','safety_status'=>$raw['safety_status'] ?? 'needs review',
  'description'=>(string)$desc,'notes'=>$raw['notes'] ?? '', 'linked_files'=>array_values(array_unique(array_merge([$src,'data/ssot/'.$file], ac_arr($raw['linked_files'] ?? [])))),'linked_records'=>ac_arr($raw['linked_records'] ?? ($doc['relationships']['depends_on'] ?? [])),
  'last_updated'=>$raw['last_updated'] ?? ($doc['maintenance']['last_reviewed'] ?? ($doc['generated_date'] ?? 'needs freshness review')),'source_file'=>$file,'source_type'=>isset($raw['record_id'])?'SSOT-derived':'placeholder-derived','family'=>ac_family((string)$timeline),
 ];
}
function ac_seed_records(): array { $records=[]; foreach(ac_ssot_files() as $file){ if($file==='master_index.json') continue; $doc=ac_ssot_json($file); $cr=$doc['canonical_records'] ?? []; if(is_array($cr) && array_is_list($cr) && $cr){ foreach($cr as $i=>$r) if(is_array($r)) $records[]=ac_normalize_record($r,$file,$doc,$i); } else { $records[]=ac_normalize_record([],$file,$doc,0); } } return $records; }
function ac_complete_record(array $r): array { foreach(ac_schema() as $f){ if(!array_key_exists($f,$r)) $r[$f]=in_array($f,['linked_files','linked_records'],true)?[]:''; } $r['linked_files']=ac_arr($r['linked_files']); $r['linked_records']=ac_arr($r['linked_records']); $r['family']=ac_family((string)$r['timeline_moment_id_or_gen']); $r['source_file']=$r['source_file'] ?? 'owner-records.json'; $r['source_type']=$r['source_type'] ?? 'owner-managed'; return $r; }
function ac_records(bool $refresh=false): array { static $records; if($records!==null && !$refresh) return $records; $store=ac_owner_store(); $deleted=array_flip($store['deleted']??[]); $by=[]; foreach(ac_seed_records() as $r){ if(!isset($deleted[$r['record_id']])) $by[$r['record_id']]=$r; } foreach(($store['records']??[]) as $r){ if(is_array($r) && !isset($deleted[$r['record_id']??''])) $by[$r['record_id']]=ac_complete_record($r); } $records=array_values($by); usort($records,fn($a,$b)=>strcmp($a['record_id'],$b['record_id'])); return $records; }
function ac_find_record(string $id): ?array { foreach(ac_records() as $r){ if($r['record_id']===$id) return $r; } return null; }
function ac_records_by_timeline(string $timeline): array { return ac_filter_records(fn($r)=>$r['timeline_moment_id_or_gen']===$timeline); }
function ac_filter_records(callable $fn): array { return array_values(array_filter(ac_records(),$fn)); }

function ac_records_for_asset_inventory(): array {
 return ac_filter_records(fn($r)=>in_array($r['source_file'], ['inventory_reference.json','colorstrip_manual.json','freedompar_manual.json','honeycomb_manual.json'], true) || in_array($r['category'], ['dmx patch','vendor_manual','asset','fixture'], true));
}
function ac_records_for_media_intake(): array {
 return ac_filter_records(fn($r)=>in_array($r['category'], ['media','upload','asset'], true) || $r['section']==='media' || $r['source_file']==='owner-records.json');
}
function ac_records_for_website_drafts(): array {
 return ac_filter_records(fn($r)=>in_array($r['source_file'], ['website_system_plan.json','owner_site_boot_plan.json','styleguide.json'], true) || in_array($r['category'], ['website','website_admin','brand_style','page'], true));
}
function ac_records_for_operator_outputs(): array {
 return ac_filter_records(fn($r)=>$r['source_file']==='rig.json' || $r['section']==='operator' || in_array($r['category'], ['emergency state','dmx patch'], true));
}
function ac_records_for_launch_tasks(): array {
 return ac_filter_records(fn($r)=>in_array($r['source_file'], ['owner_admin_build_readiness.json','website_system_plan.json','owner_site_boot_plan.json'], true) || in_array($r['category'], ['website_admin','task','launch'], true));
}
function ac_records_for_cue_draft(): array { return ac_filter_records(fn($r)=>$r['source_file']==='cue.json'); }
function ac_validate_record(array $r, ?string $original=null): array { $errors=[]; if(trim($r['record_id']??'')==='') $errors[]='Record ID is required.'; if(trim($r['title']??'')==='') $errors[]='Title is required.'; if(trim($r['timeline_moment_id_or_gen']??'')==='') $errors[]='Timeline Moment ID or GEN is required.'; foreach(ac_records() as $existing){ if($existing['record_id']===($r['record_id']??'') && $existing['record_id']!==$original){ $errors[]='Record ID already exists.'; break; } } return $errors; }
function ac_save_record(array $input, ?string $original=null): array { $r=[]; foreach(ac_schema() as $field){ $r[$field]=in_array($field,['linked_files','linked_records'],true)?ac_lines($input[$field]??[]):trim((string)($input[$field]??'')); } $r['last_updated']=date('Y-m-d'); $r['source_file']='owner-records.json'; $r['source_type']='owner-managed'; $errors=ac_validate_record($r,$original); if($errors) return [false,$errors]; $store=ac_owner_store(); $records=$store['records']??[]; $records=array_values(array_filter($records,fn($x)=>($x['record_id']??'')!==($original??$r['record_id']))); $records[]=ac_complete_record($r); if($original && $original!==$r['record_id']) $store['deleted']=array_values(array_unique(array_merge($store['deleted']??[],[$original]))); $store['records']=$records; ac_save_owner_store($store); ac_records(true); return [true,[]]; }
function ac_delete_record(string $id): void { $store=ac_owner_store(); $store['records']=array_values(array_filter($store['records']??[],fn($x)=>($x['record_id']??'')!==$id)); $store['deleted']=array_values(array_unique(array_merge($store['deleted']??[],[$id]))); ac_save_owner_store($store); ac_records(true); }
function ac_store_uploaded_file(array $file, string $subdir): ?string { if(($file['error']??UPLOAD_ERR_NO_FILE)!==UPLOAD_ERR_OK) return null; $name=preg_replace('/[^A-Za-z0-9._-]+/','-',basename($file['name'])); $name=date('Ymd-His').'-'.$name; $dir=rtrim(ac_config()['upload_root'],'/').'/'.trim($subdir,'/'); ac_ensure_dir($dir); if(!move_uploaded_file($file['tmp_name'],$dir.'/'.$name)) return null; return trim($subdir,'/').'/'.$name; }
function ac_handle_post(): void { if(($_SERVER['REQUEST_METHOD']??'')!=='POST') return; $action=$_POST['action']??''; if($action==='save_record'){ [$ok,$errors]=ac_save_record($_POST, $_POST['original_record_id']??null); if($ok) ac_flash('Record saved.'); else ac_flash(implode(' ', $errors),'error'); ac_redirect('?page=record-detail&id='.rawurlencode($_POST['record_id']??'')); }
 if($action==='delete_record'){ ac_delete_record((string)$_POST['record_id']); ac_flash('Record archived/deleted from owner data.'); ac_redirect('?page=records'); }
 if($action==='upload_record_file'){ $id=(string)($_POST['record_id']??''); $record=ac_find_record($id); $rel=isset($_FILES['record_file'])?ac_store_uploaded_file($_FILES['record_file'],'records'):null; if($record && $rel){ $record['linked_files'][]=ac_upload_url($rel); ac_save_record($record,$id); ac_flash('File uploaded and linked to record.'); } else ac_flash('Upload failed.','error'); ac_redirect('?page=record-detail&id='.rawurlencode($id)); }
 if($action==='upload_fixture_image'){ $id=(string)($_POST['record_id']??''); $record=ac_find_record($id); $rel=isset($_FILES['fixture_image'])?ac_store_uploaded_file($_FILES['fixture_image'],'fixtures'):null; if($record && $rel){ $record['linked_files'][]=ac_upload_url($rel); $record['notes']=trim(($record['notes']??'')."\nFixture image: ".ac_upload_url($rel)); ac_save_record($record,$id); ac_flash('Fixture image uploaded.'); } else ac_flash('Fixture image upload failed.','error'); ac_redirect('?page=asset-inventory'); }
}
