# Proto CMS Adapter Plan

`/center` is now pointed at a private, deployment-simple CMS-adapter direction for `proto/` without live mutation.

## Boundaries

- No direct writes to `proto/` in this pass.
- No public publishing, authentication, uploads, CRUD, database migrations, package managers, external APIs, or GitHub runtime calls.
- Owner controls are represented as read-only edit specifications and documentation mockups first.

## Future mapping contract

Every future owner edit specification should identify:

1. `proto` route/page.
2. Language token or JSON path.
3. CSS variable or style contract, when applicable.
4. Compound-effect control, when applicable.
5. CTA target.
6. Media/asset reference.
7. Disclosure tier.
8. Release-gate record.
9. Raw JSON review location.
10. Rollback/audit requirement.
11. `timeline_moment_id_or_gen`.
12. `open_inquiry_ids`.

## First adapter records

The starter records live in `center/data/proto_editing_contracts.php` and are displayed on Website CMS Drafts. They are manual review aids only.
