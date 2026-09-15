# 08_public_website_and_audience_data — Public Website and Audience Data

> **SCAFFOLD SECTION — NO EXTRACTED OR APPROVED FACTS**

This folder was generated from
`extract/ssot_compendium_document_inventory.md`. It contains 15
planned documents (authority: 2, plan: 1, record: 4, registry: 4, release: 1, schema: 2, view: 1). Do not treat an empty shell as an approved record.

## Planned documents

- `public_route_registry.json` — `registry` — Route ID/path; purpose; audience; conversion goal; status; legacy/active; dependencies.
- `page_section_registry.json` — `registry` — Section ID; route; type; order; visibility; required facts/copy/assets; component.
- `navigation_registry.json` — `registry` — Menu/footer link IDs; labels via content refs; destination; order; visibility.
- `page_content_binding_registry.json` — `registry` — Route/section/field to content token, fact, asset, CTA, advisory, and form refs.
- `public_site_architecture.json` — `authority` — Document root; shared renderer; asset behavior; static-effect posture; fallback behavior; legacy boundary.
- `form_definition_registry.json` — `schema` — Lead/inquiry forms; fields; validation; CSRF; messages; destinations; consent refs.
- `consent_and_privacy_policy.json` — `authority` — Purpose; notice; lawful/approved use; retention; access; deletion; mail behavior; sensitive fields.
- `restricted_audience_submission_register.json` — `record` — Restricted lead/inquiry records or external secure references; consent; status; provenance.
- `audience_submission_metrics.json` — `view` — Redacted counts, delivery/failure status, time buckets, conversion summaries.
- `mail_delivery_and_recovery_log.json` — `record` — Restricted delivery attempt/failure metadata; recovery status; no public message bodies.
- `site_layer_definition_registry.json` — `schema` — Structure/copy/media/style/behavior/review layers; allowed controls; validation; ownership.
- `site_layer_draft_state.json` — `plan` — Current editable controls, order, visibility, replacements, labels, overlays, notes.
- `site_publication_release.json` — `release` — Immutable published routes/sections/copy/assets/layers; checksums; gates; publication time.
- `site_layer_change_log.json` — `record` — Ordered changes from 22 backups; actor/reference; field deltas; assets; publish events.
- `public_site_launch_readiness.json` — `record` — Route/content/media/form/accessibility/rights/safety/deployment checks and blockers.
