# Fresh Coding LLM Prompt: Build the First Full Owner-Site Rendition

You are a fresh expert coding LLM session working in the `Just One KISS` repository. Your task is to build the **first real owner-site rendition** on top of the existing vanilla PHP/HTML/CSS/JS owner-site scaffold, using the repository's Markdown documents and SSOT JSON files as the data and product-design source of truth.

## 0. Required posture

Build this as a serious private owner command center, not as a decorative mockup. The owner must be able to move from:

- project-wide executive overview;
- launch readiness and red flags;
- timeline/set/cue structure;
- asset, inventory, media, rig, content, and safety state;
- public website/page drafting;
- task/launch management;
- show-control outputs and emergency-state references;
- down to individual granular record-edit screens or editable forms.

The result should be a **first-draft working site** with rich structure, realistic data views, and placeholder edit workflows. It does not need a database yet, but it must be designed so the current PHP-array / JSON-file layer can later be swapped for a database or API without rewriting the modules.

Use **vanilla PHP, vanilla JavaScript, HTML, and CSS only** unless the repository already contains other tooling. Do not introduce a framework unless the user explicitly asks for one later.

## 1. Read these files before coding

First review the repo instructions and source documents. Use the machine-readable SSOT JSON wherever possible and the Markdown/text files for nuance.

### Repository orientation and rules

1. `README.md`
2. `docs/knowledge.md`
3. `docs/prompt.md`
4. `docs/qwen_model_routing.md`
5. `docs/ssot/master_index.json`
6. `docs/ssot/readme.json`
7. `docs/ssot/knowledge.json`
8. `docs/ssot/prompt.json`

### Owner-site boot and admin planning

1. `docs/owner_site_boot_plan.md`
2. `docs/owner_admin_build_readiness.md`
3. `docs/website_system_plan.md`
4. `docs/ssot/owner_site_boot_plan.json`
5. `docs/ssot/owner_admin_build_readiness.json`
6. `docs/ssot/website_system_plan.json`

### Timeline, cue, show flow, and record identity

1. `docs/timeline_moment_registry.md`
2. `docs/cue.txt`
3. `docs/ssot/timeline_moment_registry.json`
4. `docs/ssot/cue.json`

### Technical inventory, rig, and manuals

1. `docs/inventory_reference.md`
2. `docs/rig.md`
3. `docs/ssot/inventory_reference.json`
4. `docs/ssot/rig.json`
5. `docs/ssot/colorstrip_manual.json`
6. `docs/ssot/freedompar_manual.json`
7. `docs/ssot/honeycomb_manual.json`

### Creative direction and public-site posture

1. `docs/styleguide.md`
2. `docs/mastergameplan.md`
3. `docs/ssot/styleguide.json`
4. `docs/ssot/mastergameplan.json`

### Existing template scaffold to preserve

Review the current scaffold under `owner/`:

- `owner/README.md`
- `owner/index.php`
- `owner/config/site.php`
- `owner/data/*.php`
- `owner/includes/*.php`
- `owner/partials/*.php`
- `owner/pages/*.php`
- `owner/assets/css/owner.css`
- `owner/assets/js/owner.js`

Treat this folder as the **generic template scaffold**. You may add small bug fixes or compatibility helpers if needed, but do **not** convert it into the first styled rendition. Preserve it as the reusable baseline.

## 2. Create a new rendition folder

Create all new first-rendition site files under a new top-level folder with a style-specific name:

```text
owner_arena_command/
```

This folder name is intentional. The first style should feel like an **arena command center**: black-first, chrome-edged, fire-lit, high-contrast, theatrical, operational, and serious. It should be private/admin-oriented, not a public fan page.

The new folder should be independently runnable, for example:

```bash
php -S 127.0.0.1:8088 -t owner_arena_command
```

Do not require a build step.

## 3. Preserve the template; build the rendition on top of its ideas

Use `owner/` as a conceptual template for routing, data separation, partials, and reusable components, but build a much more complete first-draft owner site in `owner_arena_command/`.

Required architecture:

```text
owner_arena_command/
  README.md
  index.php
  config/
    site.php
  data/
    navigation.php
    schema.php
    status_options.php
    dashboard_cards.php
    module_blueprints.php
  includes/
    bootstrap.php
    functions.php
    ssot.php
    records.php
  partials/
    header.php
    footer.php
    sidebar.php
    topbar.php
    components.php
    forms.php
    tables.php
  pages/
    dashboard.php
    timeline-registry.php
    cue-draft-import.php
    asset-inventory.php
    media-intake.php
    public-readyty-queue.php
    tasks-launch.php
    website-cms-drafts.php
    show-control-outputs.php
    records.php
    record-detail.php
    system-map.php
    ssot-library.php
  assets/
    css/
      arena-command.css
    js/
      arena-command.js
```

You may add additional files if useful, but keep the structure understandable and modular.

## 4. Core product requirements

### 4.1 Global shell

Build a reusable application shell with:

- persistent sidebar navigation;
- topbar with current module, launch focus, and quick search/filter input;
- page hero/summary area;
- dashboard alert strip for content, safety, venue dependency, and incomplete timeline IDs;
- reusable card, table, filter, status-pill, record-form, metric, and detail-panel components;
- mobile-responsive layout.

### 4.2 Data-source strategy

Use the SSOT JSON files as the primary seed layer. Build helpers that can:

- load JSON safely from `docs/ssot/*.json`;
- expose document metadata from `master_index.json`;
- normalize records from each SSOT document into a shared owner-site record shape;
- derive fallback records from `canonical_records`, `content_summary`, `relationships`, `admin_use`, and module-specific arrays when present;
- never mutate the SSOT source files from the web UI in this first draft.

The site may use generated PHP arrays for supplemental dashboard cards or placeholder edit states, but it should prefer facts from `docs/ssot/*.json`.

### 4.3 Universal record schema

Every visible editable/managed item should use or map into this schema:

- `record_id`
- `title`
- `section`
- `category`
- `timeline_moment_id_or_gen`
- `status`
- `priority`
- `owner_or_responsible_role`
- `public_private_flag`
- `content_status`
- `safety_status`
- `description`
- `linked_files`
- `linked_records`
- `last_updated`

When source data lacks a field, derive a sensible placeholder and visibly mark it as needing review rather than pretending it is complete.

### 4.4 Required modules/pages

Build these owner modules as real first-draft pages, not one-line placeholders.

#### Dashboard

Purpose: executive command center.

Include:

- launch focus panel for the July 25, 2026 Interlochen-focused launch;
- readiness metrics;
- critical red flags;
- next actions;
- module status grid;
- content/safety/venue-dependency summary;
- timeline vs `GEN` distribution;
- show-control readiness summary;
- links into the underlying records.

#### Timeline Registry

Purpose: manage timeline-specific and `GEN` records.

Include:

- visible Timeline Moment ID family reference;
- table grouped by ID family (`PRE`, `OPEN`, `SET`, `SONG`, `TRN`, `CST`, `VID`, `LGT`, `FOG`, `STR`, `SPK`, `FIN`, `ENC`, `POST`, `GEN`);
- record list/detail/edit shell;
- filters for status, priority, content, safety, public/private, and owner role;
- clear warning that `docs/cue.txt` is a draft until migrated and reviewed.

#### Cue Draft Import

Purpose: stage `docs/cue.txt` as proposed records.

Include:

- cue-draft import summary;
- proposed set/song/transition rows derived from SSOT where possible;
- draft-only labels;
- proposed ID assignment UI shell;
- migration checklist into Timeline Registry;
- safety/content review gates before show-ready promotion.

#### Asset Inventory

Purpose: catalog physical and digital evidence.

Include:

- asset table/card view;
- physical/digital status;
- website use, marketing use, booking use, internal-only use;
- condition, source, content, needed edits/retakes, priority;
- linked Timeline Moment ID or `GEN`;
- edit shell for a single asset.

#### Media Intake

Purpose: turn uploads/media candidates into managed records.

Include:

- intake queue;
- candidate classification: website, marketing, booking, internal documentation, cue media;
- public/private flag;
- content and safety state;
- linked asset creation shell;
- upload-zone placeholder without implementing unsafe file writes unless intentionally scoped.

#### Contents / Safety Queue

Purpose: make blocked or risky records visible.

Include:

- queue of unknown, needs-review, reference-only, prohibited, venue-dependent, or unsafe records;
- separate content and safety columns;
- venue-dependency flag;
- public-output gate indicator;
- review checklist shell;
- disclaimer/content posture reminders: public-ready, original, no outside partnership/partnership claims unless cleared.

#### Tasks / Launch

Purpose: manage build, rehearsal, venue, marketing, booking, and review tasks.

Include:

- task board/list by priority and status;
- due/freshness placeholder fields;
- owner role assignment: performer, show-control system, owner, venue, vendor, content review, designer, developer;
- relation to `GEN` or Timeline Moment ID;
- July 25, 2026 launch blockers;
- next-action cards.

#### Website CMS Drafts

Purpose: draft public pages and CTAs from approved data only.

Include:

- public page drafts for:
  - Main event landing page;
  - Interlochen travel/local page;
  - Video/trailer page;
  - Costume/spectacle page;
  - Technical spectacle page;
  - Press/booking page;
  - FAQ/disclaimer page;
- source-record content status;
- public/private, content, and safety gates;
- draft section cards and CTA placeholders;
- clear labels that pages are not publish-ready until all embedded records are approved.

#### Show-Control Outputs

Purpose: generate operational views.

Include:

- run sheet shell;
- emergency sheet shell;
- packing list shell;
- rehearsal checklist shell;
- rig patch quick reference;
- show-control recovery notes;
- emergency states: blackout, safe work light, projection black, projection hold, fog off, strobes off, music stop, system reset, performer safe look, costume-change hold look;
- source IDs preserved on output rows.

#### Records

Purpose: cross-module record browser.

Include:

- searchable/filterable master table of normalized records;
- sort/filter controls implemented in vanilla JS;
- links to record detail pages;
- badges for timeline/GEN, content, safety, public/private, owner role, and status.

#### Record Detail

Purpose: granular edit shell.

Include:

- a route such as `?page=record-detail&id=...`;
- full schema form;
- related files and related records panels;
- audit/freshness placeholder;
- save button disabled or marked as prototype-only unless persistence is implemented;
- clear statement of source document and whether the row is SSOT-derived or placeholder-derived.

#### System Map

Purpose: explain how project domains connect.

Include:

- cards/diagram-like layout showing relationship among timeline, cue, inventory, media, content/safety, website drafts, launch tasks, and show-control outputs;
- source-of-truth hierarchy;
- data-flow notes from private owner records to public outputs.

#### SSOT Library

Purpose: inspect source documents.

Include:

- list of SSOT JSON documents from `master_index.json` or the filesystem;
- title, category, source document, timeline classification, and maintenance status;
- links to module pages that use each source;
- document summary cards.

## 5. Design direction for `owner_arena_command/`

Use a private-control-room interpretation of the project style:

- black-first background;
- chrome/steel borders and panels;
- fire red/orange/gold highlights;
- readable admin typography;
- dense but organized information hierarchy;
- high-contrast status badges;
- stage/rig/control-room mood;
- avoid public-fan-page excess in the admin UI.

This is still an owner admin tool. Prioritize clarity, scanning, filters, edit controls, and risk visibility over poster-like decoration.

## 6. Content, safety, and public-output gates

The code and UI must visibly enforce these rules:

- Public-facing material is not publish-ready unless `public_private_flag` is public approved or equivalent.
- Content status must be owned/cleared/approved before public use.
- Safety status must be clear or explicitly venue-approved before show-ready use.
- `docs/cue.txt` is draft/proposed, not final.
- Internal KISS/Gene-inspired research may guide style, but public-facing output must be public-ready, original, review-ready, and must not imply outside partnership, partnership, ownership, content, sponsorship, or clearance unless cleared.
- Avoid adding restricted logos, exact makeup designs, official marks, or claims that sound official.

## 7. Implementation guidance

### 7.1 Routing

Use a simple PHP route based on `?page=` and optional `id=`. Validate page IDs against the navigation registry. Unknown pages should fall back to Dashboard or show a friendly 404 inside the shell.

### 7.2 Components

Build reusable partials/functions for:

- section headers;
- status pills;
- risk badges;
- metric cards;
- record cards;
- record tables;
- filter controls;
- schema forms;
- linked-record panels;
- source-document panels;
- empty states.

### 7.3 JavaScript

Use vanilla JS for progressive enhancement only:

- text search;
- table filtering;
- tab switching if needed;
- collapsible panels;
- local UI state only.

Do not depend on JS for core content rendering.

### 7.4 Accessibility

Include:

- semantic landmarks;
- skip link;
- readable focus states;
- labels for form controls;
- sufficient contrast;
- responsive behavior.

### 7.5 Documentation

Add `owner_arena_command/README.md` explaining:

- how to run it;
- folder structure;
- data-source strategy;
- how it relates to `owner/` template scaffold;
- what is prototype-only;
- next steps for persistence/database/API integration.

## 8. Testing and checks

At minimum run:

```bash
find owner_arena_command -name '*.php' -print0 | xargs -0 -n1 php -l
php -S 127.0.0.1:8088 -t owner_arena_command
```

Then use `curl` to verify every page returns HTTP 200:

```bash
for page in dashboard timeline-registry cue-draft-import asset-inventory media-intake public-readyty-queue tasks-launch website-cms-drafts show-control-outputs records system-map ssot-library; do
  curl -s -o /tmp/owner_arena_${page}.html -w "%{http_code} %{size_download} ${page}\n" "http://127.0.0.1:8088/?page=${page}"
done
```

Also verify at least one record detail URL, for example:

```bash
curl -s -o /tmp/owner_arena_record_detail.html -w "%{http_code} %{size_download} record-detail\n" "http://127.0.0.1:8088/?page=record-detail&id=GEN"
```

If you make a perceptible runnable web-app change and the environment supports screenshots, capture one screenshot of the Dashboard and one of a granular Record Detail page.

## 9. Expected final deliverable

A committed change that:

- preserves the existing `owner/` scaffold as the generic template;
- adds a new `owner_arena_command/` first-rendition site;
- provides rich first-draft owner pages for all required modules;
- loads and normalizes SSOT JSON data where practical;
- includes realistic record detail/edit shells;
- makes content/safety/publication gates obvious;
- documents how to run and extend the rendition;
- passes PHP syntax checks and local HTTP smoke checks.

## 10. Final response requirements for that future coding session

In the final response, include:

- summary of files/folders added;
- notes about SSOT integration and prototype limitations;
- exact test commands run and whether they passed;
- commit hash if a commit was created;
- citations to changed files if required by the active repo instructions.
