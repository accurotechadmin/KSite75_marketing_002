# Website-editing pipeline M3 browser adapter — 2026-08-18

Classification: `GEN`. Operational handoff; not approved canon or release evidence.

## Baseline and authority

- Branch `work`; starting commit `87b9079`; clean starting tree; no remote or
  upstream exists, so fetch/fast-forward was unavailable.
- Live inventory confirms `proto/` is the active app and `proto/public/` the
  document root: 54 governed files, 19 routes (11 public, eight owner tools).
- M0–M2 remain `review_ready`; M3 began and remains `in_progress`; M4–M8 remain
  `not_started`. No approval or public release is inferred.

## Completed slices and boundaries

- Implemented the Playwright 1.54.0-pinned adapter and managed-Chromium probe.
  It reports dependency/executable versions, owns and tears down PHP/browser
  resources, implements all matrix modes, and writes only declared evidence.
- Added console/page-error failure, same-origin GET navigation checks, and form
  inspection without submission. Restricted storage is hashed before/after.
- Added exact affected/unaffected evidence expansion and fail-closed metadata
  checks for route, mode, viewport, JavaScript/motion, revision, timestamp, tool,
  behavior results, naming, safe paths, freshness, and screenshot hashes.
- Hermetic fixtures prove positive evidence, negative metadata classes, browser
  failure propagation, and context/browser/server teardown. Public code, copy,
  facts, visuals, forms, assets, runtime records, and compendium leaves are untouched.

## Evidence and limitations

The pinned package and Chromium are unavailable locally. The probe returns explicit
limitation status 2, and no screenshots or browser/accessibility claims are made.
HTTP behavior and hermetic adapter tests are not substitutes for real visual,
responsive, motion, no-JavaScript, or accessibility evidence. Database, mail,
network, deployment, approval, backup, rollback, and rights evidence remain absent.

## Reconciliation and next state

Touched files are limited to the adapter, pin, evidence validator, tests, unified
orchestrator, current pipeline docs, rolling handoff, and this immutable log. M3
is the first unfinished milestone. Next: execute the pinned browser in a capable
environment, add an accessibility adapter contract, then begin M4's synthetic
change specification/dry-run foundation.
