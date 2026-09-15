# M0 public-site baseline and authority map

Date: 2026-08-18. Classification: `GEN`. Status: `review_ready`.

## Verified runtime and authority

`proto/` is the documented active public application and `proto/public/` is the
only active document root. The public and redirect routes are distinct from the
owner-oriented Site Layer Controls and preserve-backup utilities. Top-level
`proto/*/index.php` copies, backups, historical prompts, runtime records, and
generated views are evidence or compatibility context, not active authority.

Runtime implementation truth comes from route entrypoints and shared PHP, CSS,
and JavaScript. Current website canon comes from `proto/docs/website_ssot.md`,
subject-specific repository authorities, and their governed companions. Runtime
language and section JSON are derived/prototype stores. `/center` release rows
are review contracts, not approval evidence. Scaffold compendium leaves are
planned contracts only.

## Reproducible inventory and boundaries

`python3 scripts/build_website_pipeline_inventory.py` discovers every active
`index.php`, classifies public versus owner-tool surfaces, hashes every recorded
file with SHA-256, and emits the inventory and graph. The inventory covers shared
view/data/language/section loaders, runtime layer adapter, copy/section stores,
CSS/JS, forms, optional database/storage contracts, image assets, settings,
release/validation references, and history. Its validator recomputes hashes and
fails for missing paths, duplicate IDs, or private/runtime inclusions.

Configuration values, submissions, mail-failure logs, saved layer runtime state,
private contacts, and sensitive diagnostics are deliberately excluded. Optional
database and mail paths are implementation contracts, not evidence that services
exist. Deployment assumes a PHP-capable server rooted at `proto/public`; no live
deployment target or successful release is claimed.

## Contradictions and blockers

- The prior rolling baseline said all Section 03 compendium leaves were scaffold;
  the live manifest instead has 10 review leaves. This handoff corrects the
  current statement without rewriting historical logs.
- The public application includes owner utilities under the document root. They
  are explicitly classified as owner tools; authentication, permissions,
  persistent audit, and safe publishing remain absent.
- Public assets render, but no controlled rights/clearance registry is approved.
- Per-fact and per-token authority links, immutable change specifications,
  approval evidence, release history, preview, and rollback are not yet present.

M3 now has a review-ready pinned browser adapter, behavior contracts, exact
affected/unaffected evidence selection, and hermetic negative fixtures. The live
environment lacks pinned Playwright/Chromium, so browser execution and screenshot
evidence remain unavailable rather than claimed complete.
