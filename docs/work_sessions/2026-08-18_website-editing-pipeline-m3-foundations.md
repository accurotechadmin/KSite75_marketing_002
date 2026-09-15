# Website-editing pipeline M3 foundations — 2026-08-18

Classification: `GEN`. Operational handoff; not approved canon or release evidence.

## Baseline and authority

- Branch `work`; starting commit `840cb84`; clean starting tree; no remote or
  upstream configured, so no fetch or fast-forward was possible.
- Live inspection confirms `proto/` remains the active application and
  `proto/public/` the document root. The website SSOT remains authority while
  runtime files describe only what renders now.
- M0, M1, and M2 began and remain `review_ready`. M3 began `not_started` and is
  now `in_progress`: HTTP smoke and preview contracts are review-ready, but no
  browser evidence exists. M4–M8 remain `not_started`.

## Work and boundaries

- Added a complete 19-route GET expectation set and an owned PHP-server harness.
  It separates 11 public routes from eight owner tools, follows no redirects,
  submits no forms, checks response/body/header contracts, snapshots restricted
  storage, and always terminates its server.
- Added a 33-capture matrix (desktop, mobile/reduced-motion, desktop/no-JavaScript),
  deterministic safe output names, a browser capability probe, evidence freshness
  validation, and affected/unaffected selection rules. The environment has no
  Playwright/Chromium capability; no screenshots or browser claims were created.
- Public copy, facts, visuals, forms, assets, runtime behavior, private config,
  submission records, mail records, approval state, and compendium leaves were
  intentionally untouched. GET-only route checks did not modify restricted storage.
- These artifacts are validation contracts, not accessibility evidence, rights
  clearance, approval, deployment, backup, rollback, or a functioning CMS.

## Validation evidence

- `python3 scripts/validate_repository.py` passed all required checks, including
  19 HTTP routes and positive/negative route and preview fixtures. It warned that
  browser execution, database, mail, network, deployment, approval, backup,
  rollback, and optional full jsonschema validation remain unavailable.
- `python3 scripts/preview_public_routes.py --require-browser` returned limitation
  status 2 and produced no evidence, as designed.
- Final changed files are confined to M3 contracts/harnesses/tests, the unified
  orchestrator, current pipeline documentation, rolling boot handoff, and this log.

## Next state

M3 is the first unfinished milestone. Next work must implement and pin the browser
adapter, exercise capture metadata/freshness and deterministic teardown with test
fixtures, then add core navigation/form non-submission and console assertions.
Human approval is neither requested nor inferred.
