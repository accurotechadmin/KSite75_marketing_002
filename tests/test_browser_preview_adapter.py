#!/usr/bin/env python3
"""Hermetic browser lifecycle, behavior, and evidence fixtures."""
from __future__ import annotations
import hashlib, importlib.util, json, subprocess, sys, tempfile
from datetime import datetime, timezone
from pathlib import Path
ROOT=Path(__file__).resolve().parents[1]
spec=importlib.util.spec_from_file_location("preview",ROOT/"scripts/preview_public_routes.py"); preview=importlib.util.module_from_spec(spec); spec.loader.exec_module(preview)
espec=importlib.util.spec_from_file_location("evidence",ROOT/"scripts/validate_preview_evidence.py"); evidence=importlib.util.module_from_spec(espec); espec.loader.exec_module(evidence)

class Locator:
    def __init__(self,count=0): self._count=count
    def count(self): return self._count
    def nth(self,index): return self
    def get_attribute(self,name): return None
    def locator(self,query): return Locator(1)
class Page:
    url="http://127.0.0.1:9/"
    def locator(self,q): return Locator()
class Context:
    def __init__(self): self.closed=False
    def new_page(self): raise RuntimeError("synthetic page failure")
    def close(self): self.closed=True
class Browser:
    version="fixture" 
    def __init__(self): self.context=Context(); self.closed=False
    def new_context(self,**kwargs): return self.context
    def close(self): self.closed=True
class Driver:
    def __init__(self,browser): self.chromium=self; self.browser=browser
    def launch(self,headless=True): return self.browser
class Manager:
    def __init__(self,driver): self.driver=driver
    def __enter__(self): return self.driver
    def __exit__(self,*args): pass

def main():
    failures=[]
    nav,forms=preview.inspect_page(Page(),"http://127.0.0.1:9")
    if nav or forms: failures.append("empty navigation/form fixture failed")
    matrix={"evidence_root":"artifacts/previews","required_route_modes":["desktop"],"modes":{"desktop":{"viewport":{"width":10,"height":10},"javascript":True,"reduced_motion":False}},"freshness":{"maximum_age_hours":24}}
    inventory={"routes":[{"id":"route.fixture","surface":"public","url":"/"}]}
    selection={"minimum_representative_unaffected":1}
    if not evidence.validate_selection(inventory,matrix,selection,["route.fixture"],[]): failures.append("missing unaffected accepted")
    with tempfile.TemporaryDirectory() as directory:
        root=Path(directory); base=root/"artifacts/previews"; base.mkdir(parents=True); shot=base/"route.fixture--desktop.png"; shot.write_bytes(b"png")
        now=datetime.now(timezone.utc); meta={"route_id":"route.fixture","mode":"desktop","viewport":{"width":10,"height":10},"javascript":True,"reduced_motion":False,"tool_version":"fixture/1","source_revision":"abc","console_errors":[],"page_errors":[],"navigation_errors":[],"form_errors":[],"captured_at":now.isoformat(),"screenshot":shot.name,"sha256":hashlib.sha256(shot.read_bytes()).hexdigest()}
        mp=shot.with_suffix(".json"); mp.write_text(json.dumps(meta))
        if evidence.validate_evidence(root,matrix,["route.fixture"],"abc",now): failures.append("valid evidence rejected")
        cases={"wrong revision":("source_revision","bad"),"wrong mode":("javascript",False),"console error":("console_errors",["boom"]),"unsafe name":("screenshot","../x.png"),"hash mismatch":("sha256","0"*64)}
        for label,(key,value) in cases.items():
            bad=dict(meta); bad[key]=value; mp.write_text(json.dumps(bad))
            if not evidence.validate_evidence(root,matrix,["route.fixture"],"abc",now): failures.append(f"{label} accepted")
        mp.write_text(json.dumps(meta)); extra=base/"orphan.png"; extra.write_bytes(b"x")
        if not evidence.validate_evidence(root,matrix,["route.fixture"],"abc",now): failures.append("orphan accepted")
    # Inject a fake Playwright module and prove a page failure closes context/browser/server.
    browser=Browser(); stopped=[]
    fake=type(sys)("playwright.sync_api"); fake.sync_playwright=lambda:Manager(Driver(browser)); old=sys.modules.get("playwright.sync_api"); sys.modules["playwright.sync_api"]=fake
    old_start,old_stop,old_version=preview.start_server,preview.stop_server,preview.importlib.metadata.version
    class Server: pass
    preview.start_server=lambda root:(Server(),9); preview.stop_server=lambda server:stopped.append(True); preview.importlib.metadata.version=lambda name:"1.54.0"
    try:
        with tempfile.TemporaryDirectory() as directory:
            root=Path(directory); (root/"proto/storage").mkdir(parents=True); (root/"proto/docs").mkdir(parents=True); (root/"proto/docs/site_layer_controls_state.json").write_text("{}")
            subprocess.run(["git","init","-q"],cwd=root,check=True); subprocess.run(["git","config","user.email","fixture@example.test"],cwd=root,check=True); subprocess.run(["git","config","user.name","Fixture"],cwd=root,check=True); subprocess.run(["git","add","."],cwd=root,check=True); subprocess.run(["git","commit","-qm","fixture"],cwd=root,check=True)
            try: preview.capture(root,inventory,matrix,["route.fixture"]); failures.append("synthetic browser failure accepted")
            except RuntimeError: pass
    finally:
        preview.start_server,preview.stop_server,preview.importlib.metadata.version=old_start,old_stop,old_version
        if old is None: del sys.modules["playwright.sync_api"]
        else: sys.modules["playwright.sync_api"]=old
    if not (browser.context.closed and browser.closed and stopped): failures.append("failure teardown did not close all owned resources")
    if failures: print("; ".join(failures),file=sys.stderr); return 1
    print("browser adapter and evidence positive/negative fixtures ok"); return 0
if __name__=="__main__": raise SystemExit(main())
