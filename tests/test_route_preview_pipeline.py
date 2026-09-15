#!/usr/bin/env python3
from __future__ import annotations
import copy,json,subprocess,sys,tempfile
from pathlib import Path
ROOT=Path(__file__).resolve().parents[1]
def call(script,*args): return subprocess.run([sys.executable,str(ROOT/script),*map(str,args)],stdout=subprocess.DEVNULL,stderr=subprocess.DEVNULL).returncode
def main():
    failures=[]
    if call("scripts/smoke_public_routes.py"): failures.append("positive route smoke failed")
    inv=json.loads((ROOT/"docs/website_pipeline/public_site_inventory.json").read_text()); exp=json.loads((ROOT/"docs/website_pipeline/route_expectations.json").read_text()); matrix=json.loads((ROOT/"docs/website_pipeline/preview_matrix.json").read_text())
    with tempfile.TemporaryDirectory() as d:
        d=Path(d); ip=d/"i.json"; ep=d/"e.json"; mp=d/"m.json"; ip.write_text(json.dumps(inv))
        bad=copy.deepcopy(exp); bad["routes"][0]["status"]=599; ep.write_text(json.dumps(bad))
        if call("scripts/smoke_public_routes.py","--inventory",ip,"--expectations",ep)==0: failures.append("bad status accepted")
        bad=copy.deepcopy(exp); bad["routes"].pop(); ep.write_text(json.dumps(bad))
        if call("scripts/smoke_public_routes.py","--inventory",ip,"--expectations",ep)==0: failures.append("missing expectation accepted")
        bad=copy.deepcopy(matrix); bad["routes"].append(bad["routes"][0]); mp.write_text(json.dumps(bad))
        if call("scripts/preview_public_routes.py","--inventory",ip,"--matrix",mp,"--dry-run")==0: failures.append("duplicate preview route accepted")
        bad=copy.deepcopy(matrix); bad["evidence_root"]="proto/public/assets/previews"; mp.write_text(json.dumps(bad))
        if call("scripts/preview_public_routes.py","--inventory",ip,"--matrix",mp,"--dry-run")==0: failures.append("unsafe evidence path accepted")
    if call("scripts/preview_public_routes.py","--dry-run"): failures.append("preview dry run failed")
    if failures: print("; ".join(failures),file=sys.stderr); return 1
    print("route smoke and preview positive/negative fixtures ok"); return 0
if __name__=="__main__": raise SystemExit(main())
