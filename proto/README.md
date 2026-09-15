# Just One KISS Landing Site

`proto/` is the standalone public-facing landing page prototype for the Just One KISS July 25, 2026 event site.

## Repository layout

- `proto/public/` — the active public document root for the standalone site.
- `proto/app/` — shared PHP helpers, rendering, language-token loading, forms, JSON lead storage, optional database access, and mail helpers.
- `proto/public/assets/` — active CSS, JavaScript, and approved local `.webp` image assets.
- `proto/docs/` — public-site SSOT notes, launch checklist, language inventory, image-generation references, and language-map review documents.
- `proto/database/` — optional MySQL/MariaDB schema and seed data for form persistence.
- Top-level legacy route copies under `proto/*.php` and `proto/*/index.php` are not the active deployment root; serve `proto/public/` directly.

## Local development

From the repository root:

```bash
php -S 127.0.0.1:8000 -t proto/public
```

Then open `http://127.0.0.1:8000/`.

You can also upload `proto/` to a server subdirectory and point the web document root at `proto/public/`. Links and local CSS/JS are written as relative paths, and the shared template inlines CSS/JS as a fallback so the page remains styled if a server blocks or misroutes static assets.

## Runtime notes

- Public pages read shared copy from `proto/docs/language.json` through helpers in `proto/app/language.php`.
- Approved image assets should live in `proto/public/assets/img/` and match the filenames registered in `proto/app/site_data.php`.
- Database persistence is optional; without `proto/app/config.php`, the app falls back to `proto/app/config.example.php`. Lead/update-list submissions are stored in server-side JSON when `proto/storage/leads/` is writable, while DB mirroring remains optional.
- The admin language editor is prototype tooling only and should be secured or disabled before public deployment.

## Effect posture

The previous browser fire/ember/smoke/heat effect integration and standalone browser-effect lab have been removed. The public site should remain plain/static at runtime: `assets/css/site.css`, approved `.webp` images, and `assets/js/site.js` provide the active presentation without effect canvases, particle emitters, distortion filters, or runtime-driven CSS variables.
