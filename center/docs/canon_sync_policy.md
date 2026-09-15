# Canon Sync Policy

`docs/ssot/settings_manifest.json` discovers settings files. Domain JSON in `docs/ssot/` pairs with human-readable canon documents and should be treated as read-only seed truth in `/center`.

App-local PHP seeds are prototype-only scaffolding contracts. If canon changes, update the human-readable source, paired SSOT JSON, and master index together before deriving owner overlays or exports.

Safe-edit rule: seed SSOT JSON is read-only or draft-overlay-only until authentication, backups, permissions, audit trails, and rollback exist.
