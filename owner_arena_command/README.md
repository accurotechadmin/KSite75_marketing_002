# Owner Arena Command

`owner_arena_command/` is the first full owner-site rendition for the Just One KISS private command center. It preserves `owner/` as the generic reusable scaffold and builds a black-first, chrome-edged, fire-lit operational admin UI on top of the same vanilla PHP/HTML/CSS/JS ideas.

## Run

```bash
php -S 127.0.0.1:8088 -t owner_arena_command
```

Open `http://127.0.0.1:8088/?page=dashboard`.

## Structure

- `index.php` validates `?page=` routes through the navigation registry.
- `config/site.php` stores launch focus, default page, and SSOT path.
- `data/` stores navigation, schema, status options, dashboard cards, and module blueprints.
- `includes/` loads SSOT JSON, normalizes records, and provides reusable helpers.
- `partials/` provides the shell, sidebar, topbar, components, tables, and disabled forms.
- `pages/` contains each owner module.
- `assets/` contains the arena-command CSS and progressive-enhancement JavaScript.

## Data-source strategy

The rendition reads bundled seed files from `owner_arena_command/data/ssot/*.json`, prefers `canonical_records` when present, and falls back to source-document summaries, maintenance metadata, relationships, and source paths when a document has no granular records. Owner edits are stored in `owner_arena_command/data/runtime/records.json`; SSOT seed files are not rewritten by the UI. Every visible row is mapped into the universal owner record schema so the JSON/PHP layer can later be swapped for another data backend if needed.

The web UI never mutates bundled SSOT seed files. Record detail forms save owner-managed overlays to runtime JSON storage.

## Prototype-only limitations

- Authentication and database writes are not implemented; this rendition uses JSON storage only.
- File uploads are stored in the local upload folder; cue migration controls remain placeholders.
- Public page publishing is intentionally disabled until public/private, content, and safety gates are approved.
- `docs/cue.txt` is treated as draft/proposed and not show-ready.

## Next integration steps

1. Add authentication and owner-only deployment controls.
2. Replace normalized PHP arrays with repository-backed database/API records.
3. Implement safe upload storage and media metadata extraction.
4. Add persistence for edit forms and audit/freshness history.
5. Generate printable show-control outputs from approved Timeline Moment IDs.

## Server storage locations

This rendition is self-contained under `owner_arena_command/` for deployment. Copy the whole `owner_arena_command/` folder to the server and keep these writable/runtime folders with it.

- SSOT seed JSON files live in `owner_arena_command/data/ssot/`. These are the bundled read-only source/seed JSON files the site loads at runtime.
- Owner-managed JSON overlays are stored in `owner_arena_command/data/runtime/records.json`. This folder is runtime data and should be writable by PHP on the server.
- Uploaded files live in `owner_arena_command/uploads/` so the site can link to them. This folder should also be writable by PHP.

Back up `owner_arena_command/data/ssot/`, `owner_arena_command/data/runtime/`, and `owner_arena_command/uploads/` together when moving the site or restoring the owner command center.
