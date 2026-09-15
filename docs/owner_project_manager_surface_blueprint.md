# Just One KISS — Owner Project Manager Surface Blueprint

**Purpose:** Define the surface-level UI/UX and structural shape of a custom-fitted, streamlined owner-facing project manager application for the one-man / one-operator Just One KISS theatrical stage tribute performance.

**Status:** Planning canon / implementation blueprint.

**Timeline classification:** `GEN` / GENERAL / NOT TIMELINE-SPECIFIC. The manager application is the whole-project control surface. Individual records inside it may be `GEN` or tied to Timeline Moment IDs.

**Scope note:** This document intentionally focuses on the management surface, screens, workflows, panels, information architecture, and structural integrity of the application. Security, accessibility, deployment, authentication, hosting, and compliance details are outside this document.

---

## 1. Product thesis

The owner needs a single cockpit that turns Just One KISS from scattered plans, raw notes, files, cue ideas, marketing drafts, equipment lists, and website copy into one manageable production system.

The application should feel like a streamlined backstage command desk for one person who must think like:

- performer;
- show caller;
- lighting and cue planner;
- inventory manager;
- website editor;
- marketer;
- booking contact;
- document librarian;
- task manager;
- rehearsal captain;
- launch operator.

The core experience should be: **open the app, see what matters, drill into the right module, update the record, and leave with the next action clearer than before.**

---

## 2. Primary design principle: one-man command, not corporate project management

This is not a generic Jira clone, CRM, CMS, or file cabinet. It is a fitted owner console for a theatrical tribute operation built around one performer and one operating brain.

The application should therefore prioritize:

1. **fast triage** over deep bureaucracy;
2. **linked records** over isolated lists;
3. **show readiness** over generic completion percentages;
4. **visual certainty** over spreadsheet clutter;
5. **one-click context switching** between show, assets, tasks, website, notes, and marketing;
6. **clear status language** over vague notes;
7. **surface-level control** that still preserves structured data underneath.

Every major screen should answer one owner question:

> What is this, where does it belong, what state is it in, what does it affect, and what do I do next?

---

## 3. Application shell

### 3.1 Global layout

The app should use a consistent shell on every screen:

| Region | Purpose |
|---|---|
| Top bar | Project name, current event focus, global search, quick add, command shortcuts, current readiness pulse. |
| Left rail | Stable module navigation. |
| Main canvas | Dashboard, board, table, detail, editor, timeline, or planning workspace. |
| Right inspector | Contextual record summary, linked records, warnings, next actions, and quick status controls. |
| Bottom utility strip | Current filter summary, unsaved-change indicator, selected-record count, bulk action hints. |

The app should feel like one system even when modules differ. Tables, cards, detail panels, status chips, filters, linked-record drawers, and quick-add forms should behave the same everywhere.

### 3.2 Left-rail modules

Recommended stable navigation:

1. **Command Dashboard**
2. **Today / Next Actions**
3. **Notes & Decisions**
4. **Timeline / Show Spine**
5. **Cue & Run Sheet**
6. **Inventory / Assets**
7. **Media & Files**
8. **Website Manager**
9. **Marketing Manager**
10. **Booking / Contacts**
11. **Rehearsal & Prep**
12. **Packing / Maintenance**
13. **Docs & SSOT Library**
14. **Reports / Exports**

The rail should show count badges for urgent work: blocked items, owner decisions, missing assets, due tasks, unlinked notes, and unfinished launch items.

### 3.3 Global search

Global search should search every record type from one field:

- note title and body;
- task title and next action;
- Timeline Moment ID;
- song, set, cue, transition, costume change, or finale label;
- asset name;
- file name;
- public-copy phrase;
- website section;
- marketing campaign;
- contact or booking lead;
- document title;
- status, priority, category, or owner field.

Search results should be grouped by module and show enough metadata to act without opening each result: status, priority, linked Timeline ID or `GEN`, owner, next action, and last updated date.

### 3.4 Quick add menu

The top bar needs a universal **Add** button with these options:

- Add note.
- Add task.
- Add decision.
- Add Timeline Moment.
- Add cue.
- Add asset.
- Add media/file.
- Add website section.
- Add marketing item.
- Add booking contact.
- Add rehearsal note.
- Add packing item.
- Add maintenance item.

Quick-add forms should be short. They should create a usable draft record first, then allow richer editing in the detail view.

---

## 4. Shared record shape

Every item in the manager should share enough structure that dashboards and cross-module links stay coherent.

| Field | UI label | Purpose |
|---|---|---|
| `record_id` | ID | Stable internal reference. |
| `title` | Title | Human-readable name. |
| `module` | Module | Dashboard, notes, timeline, cues, inventory, media, website, marketing, booking, rehearsal, packing, docs, reports. |
| `type` | Type | Task, note, decision, asset, cue, page, section, campaign, contact, file, checklist, etc. |
| `classification` | Timeline / GEN | Timeline Moment ID or `GEN`. |
| `status` | Status | Controlled status for the module. |
| `priority` | Priority | Critical, high, medium, low, someday. |
| `area` | Area | Show, performance, technical, website, marketing, booking, inventory, content, logistics, documentation. |
| `owner_role` | Role | Performer, operator, owner, venue, designer, collaborator, unassigned. |
| `next_action` | Next action | The next concrete move. |
| `due_or_target` | Target | Date, milestone, event, or no date. |
| `linked_records` | Links | Related records across the app. |
| `source_files` | Sources | Raw notes, docs, files, images, PDFs, or generated outputs. |
| `summary` | Summary | Plain explanation of the item. |
| `details` | Details | Rich text/body content. |
| `last_updated` | Updated | Freshness and sorting. |

The shared shape lets the app show a note, asset, cue, page section, and task in the same activity feed without losing the details unique to each module.

---

## 5. Status model for a streamlined manager

The owner-facing application should use a single simple status language across most modules:

| Status | Meaning in the UI |
|---|---|
| `inbox` | Captured but not sorted. |
| `not_started` | Accepted into the plan; no work has begun. |
| `in_progress` | Actively being worked. |
| `needs_decision` | Waiting for owner direction. |
| `paused` | Intentionally stopped for timing or strategy. |
| `blocked` | Cannot move until a named dependency is resolved. |
| `ready_for_review` | Work exists and needs review. |
| `approved` | Reviewed and accepted for its intended use. |
| `show_ready` | Ready for performance/rehearsal operation. |
| `publish_ready` | Ready for public website, marketing, or booking use. |
| `finished` | Done for now. |
| `archived` | Kept for history; not active. |

Some modules may add display-specific states, but those states should roll up to this global model so the dashboard stays simple.

---

## 6. Command Dashboard

The Command Dashboard is the home screen. It should be a practical control board, not decoration.

### 6.1 Dashboard header

The top of the dashboard should show:

- current project focus: **July 25, 2026 — Cycle Moore Legacy / Interlochen**;
- current readiness pulse;
- next milestone;
- highest-priority blocker;
- last updated timestamp;
- quick buttons for Add Note, Add Task, Add Asset, Add Cue, and Add Website Copy.

### 6.2 Readiness rings

Use large visual readiness rings or meters for:

| Ring | Meaning |
|---|---|
| Show | Timeline, performance, cue, rehearsal, finale, transitions. |
| Technical | Lighting, fog, strobes, projection, playback, emergency states. |
| Inventory | Owned items, missing items, repairs, photos, packing. |
| Website | Page copy, media, CTA, publish state, public copy readiness. |
| Marketing | Campaigns, social posts, ads, creative, rollout schedule. |
| Booking | Contacts, EPK, rider, venue packet, follow-ups. |
| Notes | Inbox processed, decisions made, stale items archived. |
| Launch | Critical path to show date and public promotion. |

Each ring should click into the filtered list that explains the score.

### 6.3 Dashboard panels

Recommended panels:

| Panel | Contents |
|---|---|
| Today | Items due now, decisions needed, next actions. |
| Blocked | Blocked records grouped by dependency. |
| Owner decisions | Items that need a yes/no/choose-lane decision. |
| Recent notes | Newly captured or unprocessed notes. |
| Show spine health | Timeline moments by status and missing cue/fallback/asset links. |
| Cue readiness | Cues needing timing, assets, rehearsal, or final approval. |
| Inventory flags | Missing photos, repairs, storage unknown, purchase needed. |
| Website flags | Draft copy, missing media, incomplete CTA, publish-ready sections. |
| Marketing rollout | Campaign pieces by funnel stage and platform. |
| Rehearsal prep | Next rehearsal checklist and unresolved rehearsal notes. |
| Packing prep | Loadout readiness, cases, maintenance, consumables. |
| Activity feed | Latest edits and status changes across modules. |

---

## 7. Today / Next Actions

This module is the owner's daily operating list. It should strip away everything except what can be acted on.

### 7.1 Views

| View | Purpose |
|---|---|
| Today | Items due today or manually pinned. |
| This week | Current working horizon. |
| Before next rehearsal | Performance and technical prep. |
| Before public launch | Website, marketing, booking, and public-copy work. |
| Before show day | Event-critical tasks. |
| Waiting / blocked | Items that cannot advance. |
| Someday / parking lot | Useful but non-urgent ideas. |

### 7.2 Task card

A task card should show:

- title;
- priority;
- status;
- next action;
- linked record;
- due or target milestone;
- owner role;
- reason it matters;
- one-click status change;
- quick note field.

The task list should support drag-and-drop reorder inside a view so the owner can make a manual hit list.

---

## 8. Notes & Decisions

This is where raw ideas, compiled notes, owner thoughts, and decision records become structured work.

### 8.1 Notes inbox

The notes inbox should ingest or manually capture:

- raw `.txt` note fragments;
- owner voice notes transcribed later;
- show ideas;
- website changes;
- marketing phrases;
- asset reminders;
- bug reports;
- rehearsal observations;
- venue/logistics notes;
- future app ideas.

Each inbox item should be triaged into one of these outcomes:

| Outcome | Meaning |
|---|---|
| Promote to task | This needs action. |
| Promote to decision | Owner must choose. |
| Link to existing record | This explains or updates something already in the system. |
| Convert to asset idea | This needs media, design, purchase, or production. |
| Convert to website copy proposal | This may become public language. |
| Archive | Useful history but not active. |
| Delete from active inbox | Not useful for the manager surface. |

### 8.2 Decision log

Decisions should be first-class records. Each decision should show:

- decision question;
- options;
- chosen answer;
- why it was chosen;
- affected records;
- date decided;
- whether it changes a source-of-truth document;
- follow-up tasks created.

The decision log prevents the owner from re-deciding the same thing repeatedly.

### 8.3 Notes-to-canon view

For public-copy notes, the app should show:

- raw note phrase;
- matching `language.json` token if any;
- exact match, partial match, absent phrase, or conflict;
- proposed public wording;
- owner decision status;
- linked website section or campaign item.

---

## 9. Timeline / Show Spine

The Timeline / Show Spine is the heart of the stage-performance side of the app.

### 9.1 Timeline structure

The timeline should be organized into families:

- pre-show;
- opening;
- set blocks;
- songs;
- transitions;
- costume changes;
- video/projection moments;
- lighting moments;
- fog moments;
- strobe moments;
- spoken/performance moments;
- finale;
- encore;
- post-show;
- general items.

### 9.2 Timeline board

The board should show ordered cards for each moment. Each card should include:

- Timeline Moment ID;
- title;
- parent set or segment;
- estimated duration;
- status;
- performer action;
- operator/show-control action;
- linked cues;
- linked assets;
- linked media;
- linked tasks;
- rehearsal status;
- fallback state;
- notes.

### 9.3 Timeline detail page

A detail page should include tabs:

1. **Overview** — title, purpose, placement, status, duration.
2. **Performance** — performer action, costume, prop, movement, spoken cue.
3. **Show Control** — lighting, projection, fog, strobe, playback, trigger, operator notes.
4. **Assets** — costumes, props, fixtures, media, files.
5. **Rehearsal** — rehearsal notes, problems, fixes, readiness.
6. **Tasks** — linked to-dos and blockers.
7. **Public Use** — whether this moment can feed website, marketing, booking, or fan content.

### 9.4 Show spine map

The owner should have a horizontal or vertical visual map that makes the show feel like a single chain. It should show the flow from pre-show to post-show and make gaps obvious.

Useful map markers:

- missing cue;
- missing asset;
- missing fallback;
- unrehearsed;
- needs decision;
- show-ready;
- public-safe candidate;
- not for public use.

---

## 10. Cue & Run Sheet

The cue module should be a practical surface for turning timeline ideas into operator-ready rows.

### 10.1 Cue matrix

The cue matrix should use rows for timeline moments and columns for operational layers:

| Column | Contents |
|---|---|
| Moment | ID, title, order, duration. |
| Trigger | What starts the cue. |
| Performer | What the performer does. |
| Operator | What the operator does. |
| Lighting | Look, fixture group, intensity, color, movement. |
| Projection | Clip, still, blackout, hold screen. |
| Fog | On/off, density, cue point, notes. |
| Strobe | Use state, intensity feel, caution note. |
| Audio/playback | Track, timing note, source, backup. |
| Costume/prop | Needed item and preset. |
| Fallback | What to do if it fails. |
| Status | Proposed, rehearsing, show-ready, etc. |

### 10.2 Run-sheet builder

The owner should be able to generate simplified outputs from approved cue rows:

- full run sheet;
- operator-only run sheet;
- performer cheat sheet;
- rehearsal run sheet;
- transition-only sheet;
- emergency/fallback sheet;
- packing list generated from cues and assets.

### 10.3 Rehearsal feedback loop

After rehearsal, each cue row should allow fast notes:

- worked;
- too slow;
- too busy;
- needs brighter look;
- needs less fog;
- trigger unclear;
- performer load too high;
- operator load too high;
- simplify;
- retest;
- approved.

---

## 11. Inventory / Assets

The inventory module should make the physical and digital production visible and manageable.

### 11.1 Inventory categories

Recommended categories:

- costumes;
- makeup and transformation supplies;
- props;
- stage set pieces;
- lighting fixtures;
- DMX/control gear;
- fog and atmosphere gear;
- strobe/effect units;
- projection/video gear;
- audio/playback gear;
- cables/adapters/power;
- cases/bins/storage;
- tools/repair supplies;
- marketing graphics;
- photos/videos;
- documents/PDFs/manuals;
- consumables;
- purchase candidates.

### 11.2 Asset detail page

Each asset page should include:

- photo gallery or file preview;
- asset facts;
- condition;
- storage location;
- used in timeline moments;
- used on website pages;
- used in marketing pieces;
- used in booking materials;
- linked tasks;
- maintenance notes;
- packing location;
- replacement or purchase notes;
- readiness status.

### 11.3 Inventory views

| View | Purpose |
|---|---|
| All assets | Master searchable inventory. |
| Needs photo | Assets that need evidence images. |
| Needs repair | Repair and maintenance list. |
| Pack for show | Case/bin loadout view. |
| Timeline-linked | Assets used in show moments. |
| Website candidates | Assets that may support public pages. |
| Marketing candidates | Assets that may support ad/social/print. |
| Missing / purchase | Needed items not yet acquired. |
| Manuals and references | Fixture manuals, PDFs, cue docs, spec docs. |

---

## 12. Media & Files

The media module should prevent photos, videos, PDFs, prompts, mockups, and clips from becoming a loose file pile.

### 12.1 Media intake card

Each uploaded or registered file should capture:

- file title;
- file type;
- source;
- visual/content summary;
- suggested use;
- linked asset;
- linked timeline moment or `GEN`;
- linked website page;
- linked marketing campaign;
- edit needed;
- crop/export needed;
- status.

### 12.2 Media workbench

The workbench should support:

- grid view;
- list view;
- by-use view;
- duplicate/near-duplicate grouping;
- missing-caption queue;
- needs-edit queue;
- approved-for-use collection;
- rejected/reference-only collection;
- prompt/source pairing for generated images.

### 12.3 File relationship principle

A file should not exist only as a file. It should either:

1. become an asset;
2. attach to an asset;
3. attach to a timeline moment;
4. attach to a website section;
5. attach to a marketing item;
6. attach to a booking/contact record;
7. attach to a task or decision;
8. live in the Docs & SSOT Library.

---

## 13. Website Manager

The Website Manager should let the owner see and edit public-site structure without thinking in code.

### 13.1 Website map

The first screen should show the page tree:

- home / event landing page;
- July 25 free show page;
- what is Just One KISS page;
- spectacle page;
- directions page;
- FAQ/disclaimer page;
- contact page;
- Fan Vault page;
- video page;
- technical/booking-facing page;
- future campaign landing pages.

Each page card should show draft state, publish state, missing media, missing CTA, copy status, and linked campaign use.

### 13.2 Page editor

The page editor should be section-based:

- page metadata;
- hero;
- fact chips;
- CTA band;
- body sections;
- media slots;
- FAQ blocks;
- disclaimer blocks;
- form blocks;
- final CTA;
- footer-specific notes.

Each section should have:

- visible title;
- internal label;
- copy fields;
- media slots;
- linked language tokens;
- linked assets;
- status;
- notes;
- preview.

### 13.3 Public-copy workbench

The Website Manager should include a public-copy workbench that shows:

- current canonical phrase;
- proposed replacement;
- source note or reason;
- affected pages;
- affected forms/buttons;
- status;
- owner decision;
- whether the proposal should update `language.json`.

This workbench should make public copy feel like reusable inventory, not scattered text boxes.

---

## 14. Marketing Manager

The Marketing Manager should organize the promotional system around the fan journey and the July 25 event.

### 14.1 Campaign dashboard

Campaign stages:

1. Awareness.
2. Interest.
3. Consideration.
4. Conversion.
5. Retention / nurture.

Each stage should show:

- message goal;
- headline/copy status;
- image/asset status;
- platform variants;
- CTA;
- landing page;
- launch timing;
- tasks;
- owner notes.

### 14.2 Marketing item detail

A marketing card should include:

- campaign stage;
- platform;
- format/dimensions;
- headline;
- body copy;
- CTA;
- linked page;
- linked media;
- prompt or creative brief;
- status;
- next action;
- export notes.

### 14.3 Calendar view

The owner should be able to see:

- planned post dates;
- campaign rollout sequence;
- asset deadlines;
- website dependencies;
- booking follow-ups;
- show-date countdown milestones;
- reminders to share, repost, or refresh public details.

---

## 15. Booking / Contacts

The Booking / Contacts module should support venue, press, buyer, collaborator, and sponsor-style follow-up without turning into a complicated sales suite.

### 15.1 Contact record

Each contact should include:

- name;
- organization;
- role;
- relationship type;
- contact notes;
- linked inquiry;
- linked booking packet;
- linked follow-up tasks;
- last contact date;
- next action;
- status.

### 15.2 Booking packet builder

The owner should be able to assemble a packet from approved pieces:

- short show description;
- performer/project summary;
- approved photos;
- technical summary;
- stage/spectacle summary;
- event history or proof points;
- contact information;
- downloadable one-sheet;
- follow-up checklist.

### 15.3 Inquiry board

Simple lanes:

- new;
- needs reply;
- replied;
- waiting;
- interested;
- booked;
- not a fit;
- archived.

---

## 16. Rehearsal & Prep

The rehearsal module should translate plans into practice work.

### 16.1 Rehearsal session record

Each rehearsal should include:

- rehearsal date;
- focus area;
- run scope;
- timeline moments rehearsed;
- cues tested;
- assets used;
- problems found;
- fixes made;
- tasks created;
- readiness result;
- next rehearsal focus.

### 16.2 Prep checklists

Useful checklists:

- costume preset;
- makeup preset;
- prop preset;
- lighting test;
- projection test;
- fog/strobe test;
- playback test;
- opener run;
- transition run;
- finale run;
- full-show run;
- teardown notes.

### 16.3 Problem-to-task flow

A rehearsal problem should become a linked task in one click. The task should remember which rehearsal, cue, asset, or timeline moment produced it.

---

## 17. Packing / Maintenance

This module should turn the show into a repeatable loadout.

### 17.1 Packing views

| View | Purpose |
|---|---|
| By case/bin | What goes in each container. |
| By setup order | What comes out first during load-in. |
| By show system | Costume, lighting, projection, fog, audio, merch/marketing, tools. |
| Missing before show | Items needed but not packed. |
| Consumables | Fog fluid, batteries, tape, makeup supplies, repair parts. |
| Return/reset | What must be reset after a show. |

### 17.2 Maintenance records

Maintenance items should include:

- asset;
- problem;
- fix needed;
- parts needed;
- target date;
- status;
- last checked;
- show impact;
- linked task.

---

## 18. Docs & SSOT Library

The Docs & SSOT Library should be the owner-facing map of project documents.

### 18.1 Document cards

Each document card should show:

- title;
- file path;
- document type;
- source-of-truth role;
- related module;
- last updated;
- summary;
- dependent records;
- update needed flag;
- open/view action.

### 18.2 SSOT map

The app should show which document controls which domain:

- project orientation;
- master gameplan;
- timeline registry;
- cue draft;
- inventory reference;
- rig quick reference;
- website system plan;
- owner admin readiness;
- public language canon;
- notes tracking super SSOT;
- marketing campaign docs;
- prompt templates;
- vendor manuals.

### 18.3 Update reminders

When an app record claims to update a source-of-truth area, it should create a reminder to update the appropriate document or JSON companion.

---

## 19. Reports / Exports

The reports module should turn records into useful owner outputs.

Recommended exports:

- daily next-action list;
- blocked item report;
- owner decision report;
- show readiness report;
- cue readiness report;
- rehearsal report;
- packing list;
- maintenance list;
- website content status report;
- marketing rollout report;
- booking follow-up report;
- notes inbox processing report;
- public-copy proposal report;
- full project snapshot.

Every report should include date, filters used, record counts, and next actions.

---

## 20. Cross-module workflows

### 20.1 Raw note to finished work

1. Capture note in Notes Inbox.
2. Triage as task, decision, asset, website copy, cue, or archive.
3. Link to Timeline Moment ID or `GEN`.
4. Assign status and priority.
5. Add next action.
6. Work item in its native module.
7. Review or approve if needed.
8. Mark finished.
9. Update related SSOT document if the decision changes canon.

### 20.2 Cue idea to show-ready moment

1. Capture cue idea.
2. Link or create Timeline Moment ID.
3. Add performer action and operator action.
4. Attach assets/media/files.
5. Add fallback state.
6. Create rehearsal task.
7. Test in rehearsal.
8. Update cue notes.
9. Mark show-ready.
10. Include in run-sheet export.

### 20.3 Asset to public website use

1. Add or upload asset.
2. Fill asset detail fields.
3. Link to website section or marketing item.
4. Add edit/crop task if needed.
5. Review public-use readiness.
6. Mark publish-ready.
7. Place in Website Manager.
8. Include in marketing or booking outputs as needed.

### 20.4 Marketing phrase to canonical copy proposal

1. Capture phrase in Notes Inbox or Marketing Manager.
2. Compare to existing public-language canon.
3. Link exact or partial token if present.
4. Create proposal if absent.
5. Owner decides keep, revise, reject, or promote.
6. Apply to website/marketing record.
7. Update source-of-truth document only through an explicit canon-update task.

---

## 21. Structural integrity rules

These rules keep the manager cohesive:

1. Every item must belong to a module.
2. Every item must have a status.
3. Every actionable item must have a next action.
4. Every show-related item must be tied to a Timeline Moment ID or `GEN`.
5. Files should attach to records, not float alone.
6. Notes should be processed into decisions, tasks, records, or archive.
7. Website and marketing items should link back to source copy, media, and campaign purpose.
8. Timeline moments should link to cues, assets, rehearsal notes, and run-sheet output.
9. Dashboard counts should always be explainable by filtered record lists.
10. Finished work should remain visible through history, reports, and linked records.
11. The app should favor fewer better screens over many isolated pages.
12. The owner should always be able to answer: what matters next?

---

## 22. Surface style and interaction tone

The manager can borrow the Just One KISS visual atmosphere without becoming theatrical clutter.

Recommended internal UI style:

- black/dark interface base;
- chrome or gunmetal dividers;
- red/orange emphasis for urgent or active work;
- gold/yellow chips for facts and statuses;
- compact cards;
- large readable module headings;
- high-contrast readiness meters;
- stage-cockpit feel;
- practical labels over decorative language in form fields;
- occasional project-flavored section names where useful, such as Command Dashboard, Show Spine, Road Case, Launch Countdown, Fan Vault Pipeline.

The internal app should feel exciting enough to belong to the show, but calm enough to manage real work.

---

## 23. Minimum viable surface

The first usable version should include:

1. Command Dashboard.
2. Today / Next Actions.
3. Notes Inbox and Decision Log.
4. Timeline / Show Spine list and detail views.
5. Cue Matrix draft view.
6. Inventory / Assets list and detail views.
7. Media & Files intake.
8. Website Manager page map and section editor.
9. Marketing Manager campaign board.
10. Docs & SSOT Library.
11. Reports / Exports for next actions, blocked items, and project snapshot.

Do not start with advanced automation. Start with clean records, clear statuses, strong linking, and owner-friendly views.

---

## 24. Definition of a successful manager surface

The owner-facing project manager is successful when the owner can open it and immediately know:

- what needs attention today;
- what is blocked;
- what decisions need to be made;
- what is already finished;
- what is ready for the show;
- what is ready for the website;
- what is ready for marketing;
- what inventory is missing or broken;
- what cues need rehearsal;
- what notes still need processing;
- what documents are the current source of truth;
- what one next action will move the project forward.

The final product should feel like a single streamlined command surface for building, rehearsing, promoting, packing, and operating Just One KISS as a one-man/one-operator theatrical stage tribute performance.

---

## 25. Priority-board richness requirements

The priority board is the first visible owner surface, but it must behave like a canon-aware triage cockpit rather than a generic task board.

### 25.1 Board behavior

- Columns represent owner attention states by default: `Notes`, `Questions`, `Now`, `Next`, `Later`, and `Finished`.
- Column labels and order may be changed, but the default canonical board should remain recoverable as a template.
- Cards may be created, edited, deleted, reordered, and moved between columns by drag/drop or accessible move controls.
- Deleted cards and columns should enter a recovery bin before permanent deletion.
- Dropping a card should update order indexes, timestamps, and context metadata immediately.
- Dropping into `Questions` should normally set `status: needs_decision`.
- Dropping into `Now` should normally set `status: in_progress`, or ask whether the card is merely accepted as `not_started`.
- Dropping into `Finished` should require confirmation that the card has source links and either no next action or a clear closing note.

### 25.2 Card and inspector behavior

Each card should show enough information to act without opening a separate page:

- title;
- module chip;
- record type;
- classification chip (`GEN` or Timeline Moment ID);
- priority chip;
- status chip;
- next-action line;
- source-file count;
- linked-record count;
- last-updated age.

Selecting a card should populate the right inspector with source files, original note excerpts when available, linked records, review warnings, decision history, classification, and quick status/priority controls.

### 25.3 Source-backed seed board

The initial board must be populated from repository-derived records, not placeholder cards. Seed items should come from the blueprint, admin-readiness docs, owner boot plan, SSOT JSON companions, public prototype docs, marketing/campaign docs, and raw notes/status reports. Every seed card must include `source_files`, module, type, classification, status, priority, summary/details, and next action.

### 25.4 Rich existing-module behavior

The first implementation may use stubs for large modules, but those stubs should still describe useful owner workflows:

| Module | Richness expected in the first coherent surface |
|---|---|
| Command Dashboard | Readiness pulse, today lane, launch focus, risk strip, recent activity, and explainable count badges. |
| Today / Next Actions | Action-first list, owner-role filters, fast closure, and staleness warnings. |
| Notes & Decisions | Raw-note preservation, promotion paths, decision log, and canon comparison for public copy. |
| Timeline / Show Spine | Registry-first IDs, cue migration state, performer/show-control detail, and draft warnings. |
| Cue & Run Sheet | Operator-ready rows, run-sheet export, safety defaults, and no false show-readiness. |
| Inventory / Assets | Asset details, fixture/manual links, packing connection, and evidence intake. |
| Media & Files | Record-linked media, creative lifecycle states, and prompt/spec linkage. |
| Website Manager | Page map, token-aware public-copy workbench, and guarded publish readiness. |
| Marketing Manager | Campaign-stage board, platform adaptation records, fact chips, and creative guardrails. |
| Booking / Contacts | Lightweight relationship view, follow-up cards, and buyer-packet readiness. |
| Rehearsal & Prep | Practice-to-record links, readiness checklists, and one-operator next practice action. |
| Packing / Maintenance | Road-case mode, maintenance queue, and preflight/postflight exports. |
| Docs & SSOT Library | Source document cards, health states, and traceability from every board card. |
| Reports / Exports | Board snapshot, next actions, open questions, cue/run-sheet drafts, and docs-health exports. |

---

## 26. Visual presentation, styling, and brand-awareness rules

The owner manager should feel like Just One KISS without becoming a noisy public landing page. The visual target is a dark backstage cockpit: theatrical enough to belong to the project, calm enough to manage real work.

### 26.1 Visual thesis

- **Backstage cockpit, not public poster:** borrow the public system's black/chrome/fire/gold language, but reduce spectacle density for readability and speed.
- **Black first:** use deep black and near-black stage-void backgrounds.
- **Chrome/gunmetal second:** use chrome, gunmetal, and steel neutrals for rails, dividers, cards, inspectors, and structure.
- **Fire third:** use red/orange for urgency, active work, destructive confirmations, blockers, and primary actions.
- **Gold/yellow as fact/status light:** use gold/yellow for source facts, Timeline/`GEN` chips, verified details, and readiness highlights.
- **Mythic restraint:** use project-flavored names sparingly; do not let theme reduce clarity.

### 26.2 Layout and component rules

- The persistent shell must include top bar, left rail, main canvas, right inspector, and bottom utility strip.
- Cards should be compact, readable, and metadata-rich.
- Filters, chips, tables, board cards, detail drawers, warnings, and buttons should behave consistently across modules.
- Source files, linked records, warnings, and edit controls should live in the inspector or detail drawer so the main canvas stays fast.
- Count badges must open the filtered list that created them.
- Drag/drop must have keyboard-accessible or button-based alternatives.

### 26.3 Color-role guidance

| UI role | Suggested treatment | Meaning |
|---|---|---|
| App background | Deep black / stage void | Persistent backstage base. |
| Panel surfaces | Near-black, charcoal, gunmetal | Working surfaces and cards. |
| Borders/dividers | Muted chrome / steel | Structure without glare. |
| Primary action | Hot red to orange | Create, save, act now. |
| Dangerous action | Darker red with confirmation | Delete/archive/destructive flow. |
| Verified fact/source chip | Gold/yellow | Canonical fact, source, classification. |
| Draft/review warning | Amber | Owner/content/safety/fact review needed. |
| Blocked/critical | Saturated red | Dependency or immediate risk. |
| Finished/approved | Restrained green or cool steel with clear label | Accepted/closed without breaking the brand. |
| Show-ready/publish-ready | Gold plus explicit label | Ready for performance/public use only when supported. |

### 26.4 Typography, copy, and rights guardrails

- Headings may feel bold, condensed, and theatrical, but body text, forms, and tables should prioritize legibility.
- Statuses must use explicit text labels and not rely on color alone.
- Microcopy should use owner-command language such as “Next action,” “Needs decision,” “Source missing,” “Draft cue,” “Review before public,” “Load saved board,” and “Export snapshot.”
- Public marketing claims must not be treated as internal truth unless they are source-linked and review-cleared.
- Do not label anything `show_ready` or `publish_ready` unless source and review metadata support that label.
- Preserve tribute posture: original, theatrical, fan-facing, and not implying official partnership.
- Avoid official KISS logos, exact makeup replication, exact official costumes, album-art copying, restricted fonts, outside photos, or unreviewed likeness/voice claims in app-generated public materials.
- Treat AI announcer/Gene-style voice notes, catchphrases, fire/spark/fog/strobe concepts, and venue/camping claims as review-needed until owner/fact/safety decisions are recorded.
- Avoid constant flashing, pulsing, or strobe-like UI effects; theatrical energy should come from structure, contrast, color, labels, and hierarchy.

---

## 27. Rich first-build acceptance criteria

A first implementation of the priority surface is acceptable when:

1. the priority board can be used without rereading raw notes;
2. every seeded card has `source_files`, classification, module, type, status, priority, and next action;
3. drag/drop updates order and context metadata in a visible, reversible way;
4. named JSON board saves, imports, exports, and canonical seed reload are available;
5. left-rail modules exist with coherent counts and source-backed starter cards or stubs;
6. the right inspector explains source, links, warnings, and next action for the selected record;
7. visual presentation follows the backstage-cockpit rules rather than generic SaaS or noisy fan-poster styling;
8. cue, public-copy, marketing, rights-sensitive, and safety-sensitive records cannot be marked ready without supporting source/review metadata.
