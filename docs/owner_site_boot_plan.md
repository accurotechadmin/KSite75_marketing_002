# Just One KISS - Owner Site Boot Plan

**Purpose:** Define the immediate build posture for the private owner-facing site before application scaffolding begins.

**Status:** Boot plan / ready-to-build preparation.

**Timeline classification:** `GEN` / GENERAL / NOT TIMELINE-SPECIFIC. The owner site is a project-wide control layer. Records created inside it must still require a Timeline Moment ID or `GEN`.

---

## 1. Build Target

Build a private owner command center first, then use that data layer to power public landing pages, booking pages, marketing pages, and production outputs.

The owner site must help the approved show-control plan manage:

- the draft-to-approved show timeline;
- inventory, media, costumes, lights, fog, strobes, projection, and documents;
- content and safety review before anything becomes public or show-ready;
- website pages, campaign assets, booking materials, and launch tasks;
- emergency states and show-control recovery notes for streamlined execution.

---

## 2. Initial Application Modules

| Build order | Module | Primary outcome | Timeline rule |
|---:|---|---|---|
| 1 | Dashboard | Shows readiness, red flags, next actions, and July 25, 2026 launch focus. | Dashboard cards are `GEN`; linked records keep their own IDs. |
| 2 | Timeline Registry | Creates and edits `SET-###`, `SONG-###`, `TRN-###`, `CST-###`, `VID-###`, `LGT-###`, `FOG-###`, `STR-###`, `FIN-###`, `ENC-###`, `POST-###`, and `GEN` records. | Required per record. |
| 3 | Cue Draft Import | Stages `docs/cue.txt` as proposed records without treating the setlist as final. | Assign proposed IDs before show-ready use. |
| 4 | Asset Inventory | Catalogs physical and digital evidence, including uploaded photos, condition, content, and use cases. | Required per asset. |
| 5 | Media Intake | Converts uploads into asset/media records with website and marketing candidates clearly flagged. | Required per media item. |
| 6 | Contents / Safety Queue | Surfaces unknown, needs-review, venue-dependent, reference-only, unsafe, or prohibited records. | Cross-module; each source record keeps its ID. |
| 7 | Tasks / Launch | Tracks build, rehearsal, venue, marketing, booking, and review work. | `GEN` unless tied to a specific moment. |
| 8 | Website CMS Drafts | Drafts public pages and CTAs from approved data only. | Pages are usually `GEN`; embedded show/media records keep IDs. |
| 9 | Show-Control Outputs | Generates run sheets, emergency sheets, packing lists, and rehearsal checklists. | Output rows inherit source IDs. |

---

## 3. Minimum Data Contract

Every editable owner-site record should include these fields before advanced UI work begins:

| Field | Requirement |
|---|---|
| `record_id` | Stable unique ID. |
| `title` | Human-readable name. |
| `section` | Dashboard, timeline, inventory, media, website, marketing, booking, safety, content, task, or document. |
| `category` | More specific type such as song, costume, fog machine, strobe, CTA, page, cue, task, or PDF. |
| `timeline_moment_id_or_gen` | Required. Use a Timeline Moment ID or `GEN`. |
| `status` | Proposed, draft, needs review, approved, rehearsing, show-ready, publish-ready, published, archived. |
| `priority` | Critical, high, medium, low, parking lot. |
| `owner_or_responsible_role` | Performer, show-control system, owner, venue, vendor, content review, designer, or developer. |
| `public_private_flag` | Private, internal-only, public candidate, public approved. |
| `content_status` | Owned, cleared, needs review, reference only, prohibited, unknown. |
| `safety_status` | Clear, needs review, venue-dependent, unsafe, not applicable. |
| `description` | Plain-language explanation. |
| `linked_files` | Source files, photos, PDFs, videos, or generated outputs. |
| `linked_records` | Related timeline moments, assets, pages, tasks, campaigns, or documents. |
| `last_updated` | Date or timestamp for freshness checks. |

---

## 4. Boot Sequence for Implementation

1. Load `docs/ssot/master_index.json` to discover available project data.
2. Load `docs/ssot/prompt.json` for project rules, streamlined production model, timeline families, and content posture.
3. Load `docs/ssot/owner_admin_build_readiness.json` for admin navigation, dashboard panels, and UX priorities.
4. Load `docs/ssot/timeline_moment_registry.json` and `docs/ssot/cue.json` for timeline and cue-draft data.
5. Load `docs/ssot/inventory_reference.json`, `docs/ssot/rig.json`, and vendor-manual JSON files for technical inventory context.
6. Implement the shared record schema before building decorative page layouts.
7. Gate public-facing website output behind public/private, content, and safety fields.

---

## 5. First Public-Site Spokes to Prepare After Owner Core

These pages should be drafted only after the owner site can distinguish public-approved content from internal research.

| Page | Purpose | Default classification |
|---|---|---|
| Main event landing page | Convert fans and travelers into ticket/RSVP/inquiry actions. | `GEN` |
| Interlochen travel/local page | Help fans understand the July 25, 2026 event focus and travel context. | `GEN` |
| Video/trailer page | Host approved trailers and clips. | `GEN`, with media records inheriting IDs. |
| Costume/spectacle page | Showcase approved original theatrical visuals. | `GEN`, with asset records inheriting IDs. |
| Technical spectacle page | Explain lights, projection, fog, and strobes without overpromising venue-dependent effects. | `GEN` |
| Press/booking page | Convert buyers and venues with EPK-ready material. | `GEN` |
| FAQ/disclaimer page | Clarify tribute posture and reduce affiliation/content confusion. | `GEN` |

---

## 6. Immediate Ready State

The project is booted for owner-site development when the first implementation pass can answer these questions from structured data rather than ad hoc prose:

- What records are timeline-specific, and what records are `GEN`?
- Which records are public-approved, private, internal-only, or public candidates?
- Which records are blocked by content, safety, or venue-dependency risk?
- Which records affect the performer, the show-control system, or both?
- Which assets can appear on a website, in marketing, in booking materials, or only in internal documentation?
- Which next actions matter most for the July 25, 2026 Interlochen-focused launch?

---

## Machine-Readable SSOT Companion

This human-readable document has a paired SSOT JSON companion at `docs/ssot/owner_site_boot_plan.json`. That JSON file is the stable machine-readable seed for website prototypes, owner-admin views, generated checklists, booking materials, marketing materials, and future production data files.

Use the SSOT companion when building software or structured outputs so facts can be reused across multiple website styles without being retyped, forked, or lost. When this document changes, update `docs/ssot/owner_site_boot_plan.json` and `docs/ssot/master_index.json` in the same change.

---

## 7. Priority Surface Build Addendum

The first owner-site build should now open with a priority-board module inside the owner command shell before expanding into deeper module editors. This addendum updates the immediate boot plan without replacing the source-of-truth core modules above.

### 7.1 First visible surface

The first visible owner surface should be a drag-and-drop priority board with these seed columns:

1. `Notes`
2. `Questions`
3. `Now`
4. `Next`
5. `Later`
6. `Finished`

Columns and cards should be editable, reorderable, movable, importable, exportable, recoverable after deletion, and backed by named JSON saves. The default canonical seed board should remain recoverable as a template so owner-managed board sets do not overwrite repository-derived starting truth.

### 7.2 Required card contract

Every priority-board card should use the owner manager shared record shape as early as possible:

- `record_id`
- `title`
- `module`
- `type`
- `classification`
- `status`
- `priority`
- `area`
- `owner_role`
- `next_action`
- `due_or_target`
- `linked_records`
- `source_files`
- `summary`
- `details`
- `last_updated`

Cards should visibly show module, classification, priority, status, next action, source-file count, linked-record count, and last-updated age. Selecting a card should reveal source files, warnings, linked records, review needs, decision history, and quick status controls in the right inspector.

### 7.3 Metadata behavior

Moving cards should update metadata rather than only changing visual position:

- moving to `Questions` should normally set `status: needs_decision`;
- moving to `Now` should normally set `status: in_progress` or ask whether the item is only accepted as `not_started`;
- moving to `Finished` should require a closing note or confirmation that there is no remaining next action;
- deleting a card or column should first move it to a recovery bin;
- all moves should preserve `source_files`, linked records, timestamps, and previous column identity for recovery/history.

### 7.4 Rich module starters

The first build may use stubs or cards for modules that are not fully implemented, but each module should expose a useful starter view:

| Module | Starter expectation |
|---|---|
| Command Dashboard | Readiness pulse, today lane, risk strip, launch focus, and explainable badges. |
| Today / Next Actions | Action-first records grouped by owner role, priority, and blocked state. |
| Notes & Decisions | Raw-note inbox, promotion paths, decision log, and canon-comparison warnings. |
| Timeline / Show Spine | Timeline registry list, cue-draft migration state, and draft warnings. |
| Cue & Run Sheet | Proposed cue rows, safety defaults, fallback fields, and run-sheet export plan. |
| Inventory / Assets | Asset list with condition/storage/source/manual/packing fields. |
| Media & Files | Record-linked files with rights/content/public-private status. |
| Website Manager | Page map, language-token references, public-copy review, and guarded publish readiness. |
| Marketing Manager | Five-stage campaign board, platform creative records, fact chips, and rights guardrails. |
| Booking / Contacts | Lightweight contacts, next follow-ups, and buyer-packet readiness. |
| Rehearsal & Prep | Practice notes linked to timeline/cue/assets and next rehearsal actions. |
| Packing / Maintenance | Road-case mode, maintenance queue, and preflight/postflight export targets. |
| Docs & SSOT Library | Source-document cards loaded from `docs/ssot/master_index.json`. |
| Reports / Exports | Board snapshot, next actions, open questions, cue draft, and docs-health exports. |

### 7.5 Visual and brand rules for implementation

The owner app should look like a dark backstage cockpit, not a generic SaaS dashboard and not an audience-facing poster.

- Use black and near-black as the base.
- Use chrome/gunmetal/steel for panels, dividers, rails, cards, and inspector frames.
- Use red/orange for urgency, active work, primary action, blockers, and destructive-action confirmation.
- Use gold/yellow for source facts, Timeline/`GEN` classification chips, verified claims, and readiness highlights.
- Keep typography theatrical in headings but highly readable in forms, cards, and tables.
- Pair color with labels/icons for statuses and warnings.
- Avoid official KISS logos, exact makeup/costume replication, restricted fonts, outside photos, implied official partnership, and unreviewed likeness/voice claims.
- Treat cue, fog, strobe, fire/spark, venue/camping, AI voice, and public-copy ideas as review-needed until owner/fact/safety/content decisions are recorded.
