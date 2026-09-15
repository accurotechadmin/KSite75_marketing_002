# Just One KISS `/proto` — Fresh Expert Coding LLM Boot Prompt

You are a fresh expert coding LLM session booting into the `Just One KISS` public website project. Your first job is to study the documentation set and the `/proto` codebase deeply enough to understand the public website architecture, visual system, content model, routes, forms, assets, and launch guardrails before you answer questions or make changes.

## Boot objectives

1. Build an accurate mental model of the active `/proto` website.
2. Understand the documentation canon and how the documents relate to each other.
3. Understand the public PHP architecture, shared render helpers, routes, forms, language tokens, assets, CSS, JavaScript, and optional database layer.
4. Identify the current public facts and guardrails for the July 25, 2026 event.
5. When booting is complete, report what you know and state that you are ready to answer questions and work on the codebase.

## Required study order

Read these documents first, in this order:

1. `proto/README.md`
   - Understand the active deployment root, local server command, runtime notes, and prototype/admin warnings.
2. `proto/docs/website_ssot.md`
   - Treat this as the current canon for active app truth, homepage sections, public claims, route jobs, form behavior, and launch blockers.
3. `proto/docs/website_inventory.md`
   - Use this as the implementation inventory for routes, components, assets, docs, forms, CSS, JS, database files, and operational guardrails.
4. `proto/docs/routes_and_supporting_pages.md`
   - Confirm route jobs and implementation status.
5. `proto/docs/launch_checklist.md`
   - Understand local verification requirements and public launch blockers.
6. `proto/docs/asset_placeholders.md`
   - Understand approved media slot filenames.
7. `proto/docs/image_generation_inventory.md`
   - Understand image style/content constraints and generation inventory.
8. `proto/docs/image_generation_requests.txt`
   - Understand route-specific future image requests and placeholder policy.
9. `proto/docs/language_map.md`
   - Skim to understand how public copy is tokenized and where major text groups occur.
10. `proto/docs/language.json`
    - Inspect structure enough to understand runtime entries, tokens, canonical text, roles, components, and flags.

## Required codebase study

After reading the documents, study the active `/proto` implementation. Prefer `rg --files` to list files. Do not use `ls -R` or `grep -R`.

Study these files and directories:

1. Public route files:
   - `proto/public/index.php`
   - `proto/public/july-25-2026/index.php`
   - `proto/public/what-is-just-one-kiss/index.php`
   - `proto/public/spectacle/index.php`
   - `proto/public/directions/index.php`
   - `proto/public/faq-disclaimer/index.php`
   - `proto/public/contact/index.php`
   - `proto/public/vault/index.php`
   - `proto/public/video/index.php`
   - `proto/public/technical/index.php`
   - `proto/public/contact-press/index.php`
2. Shared PHP application files:
   - `proto/app/view.php`
   - `proto/app/site_data.php`
   - `proto/app/language.php`
   - `proto/app/helpers.php`
   - `proto/app/csrf.php`
   - `proto/app/db.php`
   - `proto/app/mailer.php`
   - `proto/app/forms/lead_submit.php`
   - `proto/app/forms/inquiry_submit.php`
   - `proto/app/config.example.php`
3. Front-end assets:
   - `proto/public/assets/css/site.css`
   - `proto/public/assets/js/site.js`
   - `proto/public/assets/img/README.md`
   - the filenames under `proto/public/assets/img/`
   - the font filenames under `proto/public/assets/font/`
4. Optional database files:
   - `proto/database/schema.sql`
   - `proto/database/seed.sql`
5. Legacy/top-level route copies under `proto/`:
   - Notice they exist, but do not treat them as the active deployment root unless explicitly instructed.

## Key project facts to retain

- Active app: `proto/`.
- Active document root: `proto/public/`.
- Active homepage: `proto/public/index.php`.
- Main public event: Just One KISS free show on July 25, 2026.
- Location: Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643.
- Admission: free show; no ticket required; RSVP/update-list appreciated.
- Camping: `$10/night/person` for one night before and one night after the show; electric hookup is `$35/person`.
- Parking: outside the gate; overflow and handicap parking available.
- Safety: loud sound, bright lights, fog, flashing patterns/strobe-style looks may be used.
- Content: independent theatrical tribute only; no outside partnership is claimed.
- Image policy: homepage uses approved generated background assets; supporting pages keep route-specific visible placeholders until new images are generated, reviewed, and approved.
- Forms: validate server-side; database persistence is optional; DB-disabled fallback is expected.
- Admin language editor: prototype tooling only; secure or disable before launch.

## Architecture model to understand

Be able to explain:

- How `render_header()` and `render_footer()` wrap all public pages.
- How `site_pages()` controls navigation and route metadata.
- How `page_url()` and `rel_url()` keep links relative and nested-route safe.
- How `asset_style()` passes `.webp` background images through `--asset-image`.
- How `render_inline_asset()` inlines CSS/JS fallback content.
- How `language.php` loads `proto/docs/language.json` and renders editable tokens for admin sessions.
- How `render_lead_form()` and `render_inquiry_form()` map to their submit handlers.
- How `jok_pdo()` makes DB persistence optional.
- How `site.js` enhances countdowns, form status, checkbox groups, lightweight tracking, inline language editing, and relic-card hover states.
- How `site.css` defines the dark theatrical rock visual system, responsive grids, panel/card styles, image placeholders, and the current varied border shimmer animations with reduced-motion support.

## Boot completion report instructions

When you are finished booting, respond with a concise but thorough report containing:

1. **Active app summary** — what app is active, where it is served from, and what the site is for.
2. **Documentation understanding** — list the documents you studied and the role of each.
3. **Architecture understanding** — summarize routes, shared PHP, forms, language system, assets, CSS, JS, and optional DB.
4. **Design understanding** — summarize the appearance, visual tone, image policy, and animation/shimmer system.
5. **Guardrails and launch blockers** — summarize safety/content/privacy/DB/admin/security considerations.
6. **Readiness statement** — explicitly say: `I am ready to answer questions and work on the /proto codebase.`

Do not modify files during boot unless the user explicitly asks you to make changes. If you later make code changes, run relevant checks, commit your changes on the current branch, and prepare a PR summary according to the repository instructions.
