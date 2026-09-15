# Center Owner Management Site

`center/` is the production-intended, deployment-simple Just One KISS private owner command center scaffold. Its immediate direction is to become a vanilla PHP private CMS adapter for `proto/`: a place where the Owner / Performer and Developer can understand intended public-site edits, source files, readiness gates, provenance, and integrity findings before any manual public-site change.

This pass remains scaffolding-first. It does not implement live public publishing, authentication, uploads, full CRUD, database migrations, external API calls, package managers, direct writes to `proto/`, or real private contact storage.

## Deployment model

- Vanilla PHP, HTML, CSS, and JavaScript.
- Local PHP arrays and JSON files remain the starter data contracts.
- `docs/ssot/settings_manifest.json` is the settings discovery manifest.
- `docs/ssot/settings/*.json` and domain SSOT JSON provide read-only starter contracts.
- Runtime overlays, uploads, exports, and cache folders are placeholders until deployment architecture, auth, backups, permissions, audit trails, rollback, and retention are approved.

Run locally from the repository root with:

```bash
php -S 127.0.0.1:8092 -t center
```

## First-class modules for this scaffold

1. Dashboard.
2. Priority Board.
3. Release Gates.
4. Provenance Ledger.
5. Integrity Checks.

All other modules remain reachable through System Map as next-session or deferred surfaces. They should not be treated as finished production utilities.

## Canon and safety rules

- Every managed item uses `timeline_moment_id_or_gen` with a Timeline Moment ID or `GEN`.
- Ambiguous timeline classification uses `timeline_moment_id_or_gen: GEN` plus `status: needs_timeline_review`.
- `show-ready` is a checklist result, not a content status.
- Content statuses are `draft`, `internal-ready`, `venue-ready`, and `public-ready`.
- Owner-side roles are `Developer` / `D` and `Owner / Performer`.
- Cue migration from `docs/cue.txt` is deferred to a dedicated Cue Bible pass.
- Public copy must not imply official affiliation, sponsorship, authorization, endorsement, ownership, clearance, or approval.
