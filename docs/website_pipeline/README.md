# Website-editing pipeline artifacts

Classification: `GEN`. Status: read-only foundation; not approved canon or a CMS.

Run `python3 scripts/validate_repository.py` from the repository root for the
single read-only validation entry point. It exposes each component result and
returns nonzero when a required component fails. It does not generate or update
files; regeneration of the M0/M1 artifacts is the separate, explicit command
`python3 scripts/build_website_pipeline_inventory.py`.

The suite currently validates the compendium, `/center`, active PHP syntax,
governed JSON parsing, inventory path/hash/privacy rules, and impact-graph IDs,
references, coverage, and cycles. It also owns a temporary PHP server, performs
GET-only smoke checks for all 19 inventoried routes, distinguishes 11 public
routes from eight owner tools, verifies runtime storage is unchanged, and tears
the server down. Negative fixtures prove missing paths,
duplicate IDs, broken references, cycles, and forbidden private/runtime paths
fail closed.

`preview_matrix.json` defines 33 deterministic public-route captures across
desktop, mobile/reduced-motion, and desktop/no-JavaScript modes. The dry run
names every intended output under `artifacts/website_pipeline/previews/`, never
under public assets or runtime storage. `validate_preview_evidence.py` validates
exact selected evidence for hash, revision, age, tool, viewport, mode, behavior
errors, naming, and freshness. The optional adapter is pinned by
`requirements-browser.txt`; its probe reports package, executable, and versions.
When available it owns the server, browser, and contexts, checks same-origin GET
navigation, inspects forms without submission, and checks storage non-mutation.
No images are fabricated when the dependency probe fails.

Use `validate_preview_evidence.py --affected route.ID --unaffected route.OTHER
--dry-run` to expand a selection to its exact screenshot/metadata set. HTTP smoke
is transport evidence, screenshots are visual evidence, and navigation/form
assertions are limited behavioral evidence. None is accessibility evidence.

The adapter is review-ready, but this environment does **not** yet prove browser rendering, accessibility, screenshots,
responsive or reduced-motion behavior, no-JavaScript fallback, database/mail/network
services, deployment, approval, release, backup, or rollback. Those remain later
milestones and are printed as explicit warnings.

Files:

- `public_site_inventory.json`: deterministic M0 active-root inventory with
  authority classes, hashes, exclusions, and route/surface distinctions.
- `impact_graph.json`: M1 route/entrypoint/shared dependency foundation. Edges
  point from consumers to dependencies or governing sources; machine-readable
  gaps prevent the foundation from implying complete fact, token, rights, or
  release-history coverage.
- `route_expectations.json`: status, content type, safe-body, and surface contract
  for GET-only HTTP smoke checks.
- `preview_matrix.json`: browser modes, output naming, freshness, console,
  navigation, non-submission, and teardown contract.
- `preview_selection.json`: affected-versus-representative-unaffected selection
  rules now exercised by the evidence validator for a future M4 impact report.
