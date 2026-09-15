#!/usr/bin/env python3
"""Own a local PHP server and safely GET every inventoried route."""
from __future__ import annotations
import argparse, hashlib, json, socket, subprocess, sys, time
from pathlib import Path
from urllib.error import HTTPError
from urllib.request import Request, urlopen

ROOT = Path(__file__).resolve().parents[1]

def snapshots(root: Path) -> dict[str, str]:
    result = {}
    for rel in ("proto/storage", "proto/docs/site_layer_controls_state.json"):
        path = root / rel
        paths = path.rglob("*") if path.is_dir() else [path]
        for item in paths:
            if item.is_file(): result[str(item.relative_to(root))] = hashlib.sha256(item.read_bytes()).hexdigest()
    return result

def validate_contract(inventory: dict, contract: dict) -> list[str]:
    errors=[]; routes={r["id"]:r for r in inventory["routes"]}; entries=contract.get("routes",[])
    ids=[r.get("id") for r in entries]
    if len(ids)!=len(set(ids)): errors.append("duplicate route expectation ID")
    if set(ids)!=set(routes): errors.append("route expectations must exactly cover inventory routes")
    for entry in entries:
        actual=routes.get(entry.get("id"))
        if actual and entry.get("surface")!=actual.get("surface"): errors.append(f"surface mismatch: {entry.get('id')}")
        if entry.get("status") not in range(100,600): errors.append(f"invalid status: {entry.get('id')}")
    return errors

def main() -> int:
    ap=argparse.ArgumentParser(); ap.add_argument("--root",type=Path,default=ROOT); ap.add_argument("--inventory",type=Path); ap.add_argument("--expectations",type=Path); args=ap.parse_args()
    invp=args.inventory or args.root/"docs/website_pipeline/public_site_inventory.json"; exp=args.expectations or args.root/"docs/website_pipeline/route_expectations.json"
    inventory=json.loads(invp.read_text()); contract=json.loads(exp.read_text()); errors=validate_contract(inventory,contract)
    if errors:
        print("route smoke contract failed: " + "; ".join(errors),file=sys.stderr); return 1
    before=snapshots(args.root)
    with socket.socket() as sock: sock.bind(("127.0.0.1",0)); port=sock.getsockname()[1]
    server=subprocess.Popen(["php","-S",f"127.0.0.1:{port}","-t",str(args.root/"proto/public")],stdout=subprocess.DEVNULL,stderr=subprocess.PIPE,text=True)
    try:
        deadline=time.time()+5
        while time.time()<deadline:
            try: urlopen(f"http://127.0.0.1:{port}/",timeout=.3).close(); break
            except Exception: time.sleep(.05)
        else: errors.append("PHP server did not become ready")
        routes={r["id"]:r for r in inventory["routes"]}; common=contract["all_responses"]
        for expected in contract["routes"]:
            url=f"http://127.0.0.1:{port}{routes[expected['id']]['url']}"
            try:
                response=urlopen(Request(url,method="GET"),timeout=5); status=response.status; body=response.read().decode("utf-8","replace"); headers={k.lower():v for k,v in response.headers.items()}
            except HTTPError as exc: status=exc.code; body=exc.read().decode("utf-8","replace"); headers={k.lower():v for k,v in exc.headers.items()}
            except Exception as exc: errors.append(f"{expected['id']}: request failed: {exc}"); continue
            if status!=expected["status"]: errors.append(f"{expected['id']}: status {status}, expected {expected['status']}")
            if expected["body_contains"].lower() not in body.lower(): errors.append(f"{expected['id']}: missing body marker")
            for pattern in common["forbidden_body_patterns"]:
                if pattern.lower() in body.lower(): errors.append(f"{expected['id']}: runtime error marker {pattern!r}")
            for name,value in common["required_headers"].items():
                if value.lower() not in headers.get(name,"").lower(): errors.append(f"{expected['id']}: header {name} missing {value!r}")
            print(f"PASS {expected['surface']:10} {expected['id']} {status}")
    finally:
        server.terminate()
        try: server.wait(timeout=3)
        except subprocess.TimeoutExpired: server.kill(); server.wait()
    if snapshots(args.root)!=before: errors.append("GET smoke changed restricted runtime storage")
    if errors:
        print("route smoke failed:",file=sys.stderr); [print(f"- {e}",file=sys.stderr) for e in errors]; return 1
    print(f"route smoke passed ({len(contract['routes'])} GET-only routes; server stopped)"); return 0
if __name__=="__main__": raise SystemExit(main())
