<?php
function ac_config(): array { static $c; return $c ??= require __DIR__.'/../config/site.php'; }
function ac_nav(): array { return require __DIR__.'/../data/navigation.php'; }
function ac_schema(): array { return require __DIR__.'/../data/schema.php'; }
function ac_options(): array { return require __DIR__.'/../data/status_options.php'; }
function ac_e($v): string { return htmlspecialchars(is_scalar($v)?(string)$v:json_encode($v), ENT_QUOTES, 'UTF-8'); }
function ac_page_ids(): array { return array_column(ac_nav(),'id'); }
function ac_requested_page(): string { return (string)($_GET['page'] ?? ac_config()['default_page']); }
function ac_current_page(): string { $p=ac_requested_page(); return in_array($p, ac_page_ids(), true)?$p:ac_config()['default_page']; }
function ac_route_was_invalid(): bool { return !in_array(ac_requested_page(), ac_page_ids(), true); }
function ac_page_meta(string $id): array { foreach(ac_nav() as $n){ if($n['id']===$id) return $n; } return ac_nav()[0]; }
function ac_status_class(string $v): string { return 'is-'.preg_replace('/[^a-z0-9]+/','-',strtolower($v)); }
function ac_arr($v): array { if (is_array($v)) return array_values(array_filter($v,fn($x)=>$x!==''&&$x!==null)); if ($v===null||$v==='') return []; return [$v]; }
function ac_lines($v): array { if(is_array($v)) return ac_arr($v); return ac_arr(preg_split('/\R/', (string)$v)); }
function ac_text($v): string { if (is_array($v)) return implode("\n", array_map('ac_text',$v)); return (string)$v; }
function ac_family(string $id): string { if ($id==='GEN'||str_starts_with($id,'GEN')) return 'GEN'; if(preg_match('/^([A-Z]+)/',$id,$m)) return $m[1]; return str_contains($id,'TIMELINE')?'DRAFT':'GEN'; }
function ac_public_gate(array $r): string { $pub=strtolower($r['public_private_flag']??''); $rights=strtolower($r['rights_status']??''); $safety=strtolower($r['safety_status']??''); return (str_contains($pub,'approved') && preg_match('/owned|licensed|approved/',$rights) && preg_match('/clear|venue-approved/',$safety))?'open':'blocked'; }
function ac_ensure_dir(string $dir): void { if(!is_dir($dir)) mkdir($dir, 0775, true); }
function ac_flash(?string $message=null, string $type='success'): ?array { if($message!==null){ $_SESSION['flash']=['message'=>$message,'type'=>$type]; return null; } $f=$_SESSION['flash']??null; unset($_SESSION['flash']); return $f; }
function ac_redirect(string $url): never { header('Location: '.$url, true, 303); exit; }
function ac_upload_url(string $relative): string { return rtrim(ac_config()['upload_url'],'/').'/'.ltrim($relative,'/'); }
