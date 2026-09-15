# 09_owner_admin_and_cms — Owner Admin and CMS

> **SCAFFOLD SECTION — NO EXTRACTED OR APPROVED FACTS**

This folder was generated from
`extract/ssot_compendium_document_inventory.md`. It contains 15
planned documents (authority: 3, plan: 3, record: 1, registry: 4, schema: 3, view: 1). Do not treat an empty shell as an approved record.

## Planned documents

- `owner_application_registry.json` — `registry` — App/rendition ID; purpose; status; document root; data sources; persistence; limitations; supersession.
- `owner_module_registry.json` — `registry` — Module ID; canonical purpose; data dependencies; actions; readiness; source rendition lineage.
- `owner_navigation_view.json` — `view` — Role-appropriate grouping/order/labels for modules.
- `universal_owner_record_model.json` — `schema` — Required fields; statuses; roles; visibility; rights/safety; readiness; links; provenance; timeline rules.
- `owner_role_and_permission_model.json` — `authority` — Developer/Owner/other roles; view/edit/approve/publish rights; authentication prerequisites.
- `priority_board_model.json` — `schema` — Columns; movement semantics; card fields; blocker/dependency rules; filters.
- `priority_item_registry.json` — `registry` — Work item; lane/status; priority; owner; due date; evidence; dependencies; linked decisions/gates.
- `task_and_launch_registry.json` — `registry` — Task/lane; launch scope; acceptance; owner; dependency; evidence; status.
- `integrity_rule_catalog.json` — `schema` — Duplicate IDs; required fields; timeline syntax; links; sources; status combinations; release checks.
- `integrity_finding_register.json` — `record` — Rule; affected record; severity; evidence; owner; remediation; closure.
- `cms_editing_contract_registry.json` — `authority` — Editable public field; canonical owner; source target; validation; preview; gate; rollback; prohibited direct writes.
- `cms_draft_registry.json` — `plan` — Proposed content/media/structure edits; source refs; preview; status; reviewers; release target.
- `public_release_gate_policy.json` — `authority` — Public/private, factual, content, rights, safety, accessibility, integrity, backup, approval gates.
- `persistence_backup_and_recovery_plan.json` — `plan` — Canonical storage; overlays; uploads; exports; cache; DB/API migration; backups; retention; restore tests.
- `authentication_and_audit_plan.json` — `plan` — Identity; sessions; authorization; audit events; privileged operations; deployment prerequisites.
