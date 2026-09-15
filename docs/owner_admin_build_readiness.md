# Just One KISS - Owner Admin Build Readiness Brief

**Purpose:** Capture the researched, booted-up build stance for the owner-facing internal website before implementation begins.

**Status:** Prepared implementation brief / owner-admin build starting point.

**Timeline classification:** `GEN` / GENERAL / NOT TIMELINE-SPECIFIC. The internal admin system is project-wide. Individual cue, asset, media, rehearsal, or marketing records must still carry a Timeline Moment ID or `GEN` at record level.

---

## 1. Build Mission

The immediate website priority is the **private owner-facing command center**, not the public fan site. The owner needs a backstage cockpit that can show the entire project from a bird's-eye view, then drill into every segment, subsystem, component, cue, asset, document, and task.

The command center should make Just One KISS manageable as a complete streamlined theatrical production:

- the Gene Simmons tribute performer;
- show-control system;
- one central timeline spine;
- one connected inventory and documentation system;
- one content/safety review layer;
- one launch and marketing readiness view.

The public site remains important, but the admin system should come first because it will become the source of truth for inventory, pages, media, campaigns, tasks, and contents.

---

## 2. Non-Negotiable Product Rules

| Rule | Admin-system implication |
|---|---|
| Every record is timeline-specific or `GEN`. | All create/edit forms must require a Timeline Moment ID or `GEN`; uncertain records use `GEN-PENDING-REVIEW`. |
| The show is operated by the approved show-control plan. | Every cue, task, technical state, and rehearsal note should include performer load, show-control load, and recovery/fallback fields. |
| `docs/cue.txt` is current working cue draft, not final show bible. | Admin import views may show draft set blocks/songs/cue seeds, but must label them proposed and content/safety pending. |
| Internal KISS research is not automatically public-safe. | Public/private flags and content statuses must be visible on every asset, page, campaign, and copy block. |
| Uploaded photos are inventory evidence. | Media uploads should create or attach to asset records, not disappear into a generic gallery. |
| Fog/strobes/projection/blackouts require safety control. | Technical records need safety status, venue-dependent flag, emergency fallback, and system reset notes. |

---

## 3. Recommended Admin Navigation

The owner-facing site should use a stable navigation model so every module feels familiar.

| Top-level area | Owner question answered | Core records managed |
|---|---|---|
| Dashboard | What is the state of the whole project today? | Readiness scores, risks, deadlines, recent changes, blocked tasks. |
| Timeline / Show Control | What happens when, and what does the show-control do? | Timeline moments, songs, set blocks, cues, transitions, emergency states, rehearsal notes. |
| Inventory | What do we own, where is it, what condition is it in, and what is it used for? | Physical assets, digital assets, costumes, props, lighting, projection, fog, strobes, cables, cases. |
| Media Library | What photos, videos, graphics, documents, and clips exist? | Media assets, usage contents, captions, alt text, linked timeline moments, public/private status. |
| Website CMS | What public pages and page sections are drafted or publishable? | Pages, sections, CTAs, SEO fields, FAQ entries, disclaimer blocks, campaign landing pages. |
| Marketing | What campaigns, posts, ads, and clips are planned? | Campaigns, social posts, ad variants, audience profiles, platform statuses, performance notes. |
| Booking / Sales | What do venues, buyers, press, and partners need? | Inquiries, contacts, EPK items, one-sheets, rider status, follow-ups. |
| Safety / Contents | What cannot go public or go onstage yet? | Content reviews, safety reviews, venue-dependent effects, prohibited claims, emergency readiness. |
| Tasks / Launch | What has to happen next? | Task board, checklists, blockers, owners, due dates, launch readiness. |
| Documents | Where is the source material and what needs updating? | Gameplans, registries, checklists, cue sheets, manuals, templates. |

---

## 4. Universal Record Schema

Every major admin record should start from this shared shape so search, filtering, dashboards, and linking work across the whole project.

| Field | Required? | Notes |
|---|---:|---|
| Record ID | Yes | Stable ID, separate from display title. |
| Title / name | Yes | Human-readable label. |
| Section | Yes | Timeline, inventory, media, website, marketing, booking, safety, task, document. |
| Category | Yes | Song, fixture, costume, CTA, ad, cue, prop, PDF, etc. |
| Timeline Moment ID or `GEN` | Yes | Required project-wide classification. |
| Status | Yes | Proposed, draft, needs review, approved, rehearsing, show-ready, publish-ready, published, archived. |
| Priority | Yes | Critical, high, medium, low, parking lot. |
| Owner / responsible role | Yes | Performer, show-control system, owner, vendor, venue, designer, content review. |
| Public/private flag | Yes | Private, internal-only, public candidate, public approved. |
| Content status | Yes | Owned, cleared, needs review, reference only, prohibited, unknown. |
| Safety status | Yes | Clear, needs review, venue-dependent, unsafe, not applicable. |
| Description | Yes | Editable long-form explanation. |
| Notes | Optional | Internal notes and decisions. |
| Linked files | Optional | Photos, videos, PDFs, cue files, graphics, manuals. |
| Linked records | Optional | Related assets, timeline moments, tasks, pages, contacts, cue states. |
| Last updated | Yes | Supports freshness and dashboard warnings. |

---

## 5. Initial Data Modules to Build First

### Phase 1: Source-of-Truth Core

Build these first because every other feature depends on them.

1. **Timeline Moment Registry Admin**
   - reserve and edit `SET-###`, `SONG-###`, `TRN-###`, `CST-###`, `VID-###`, `LGT-###`, `FOG-###`, `STR-###`, `FIN-###`, `ENC-###`, `POST-###`, and `GEN` records;
   - import or manually stage `docs/cue.txt` as proposed draft rows;
   - show performer action, show-control action, cue notes, fallback state, content/safety review, and rehearsal status.

2. **Asset / Inventory Admin**
   - catalog physical and digital inventory;
   - separate lighting, projection, fog, strobe, costume, prop, document, media, cable, case, and packing records;
   - require condition, location, owner/source, public/private flag, content status, safety status, and Timeline Moment ID or `GEN`.

3. **Task and Readiness Admin**
   - create linked tasks for missing photos, unconfirmed cue timings, content review, safety review, website copy, booking assets, rehearsals, and launch steps;
   - provide whole-project, section, and record-level task views.

4. **Safety / Contents Queue**
   - aggregate all records with `needs review`, `unknown`, `reference only`, `venue-dependent`, or `unsafe` flags;
   - make these queues visible on the main dashboard.

### Phase 2: Owner Editing Utilities

Build once the core records exist.

1. **Global Search and Command Palette**
   - search by title, ID, section, category, Timeline Moment ID, status, note text, file name, and content/safety status;
   - quick-create assets, tasks, timeline moments, page sections, and review notes.

2. **Media Intake Workflow**
   - uploaded photos/videos become asset records or attach to existing records;
   - intake form captures visual traits, condition evidence, possible website use, possible marketing use, retakes needed, content status, and priority.

3. **Website CMS Draft Layer**
   - page inventory, section editor, CTA map, SEO checklist, disclaimers, and content review queue;
   - public pages should pull only from records that are public-approved or explicitly overridden by the owner after review.

### Phase 3: Operational Outputs

Build after enough records are reliable.

1. **Show-control Run-Sheet Builder**
   - generate simplified cue rows from approved timeline records;
   - include trigger, show-control action, confirmation, fallback, and emergency-state references.

2. **Packing / Maintenance Views**
   - case/bin checklist, load order, repairs, batteries, fog fluid, cable checks, firmware/software notes.

3. **Booking / EPK Builder**
   - assemble approved copy, approved photos, technical summary, disclaimers, contact info, and venue requirements.

---

## 6. Dashboard Health Panels

The first admin dashboard should not be decorative. It should be an actionable triage screen.

| Panel | Displays |
|---|---|
| Project readiness | Weighted completion across show, technical, inventory, website, marketing, booking, safety, content, and launch. |
| Critical dates | July 25, 2026 event focus, rehearsal milestones, asset deadlines, venue deadlines, launch targets. |
| Red flags | Content unknown, safety needs review, venue-dependent effects, missing files, missing photos, untested cues, blocked tasks. |
| Timeline health | Counts for proposed, reserved, approved, rehearsing, show-ready, missing-fallback, and missing-show-control-action moments. |
| Inventory health | Missing condition, missing storage location, needs repair, needs photo, needs retake, missing owner/source. |
| Website health | Draft pages, missing CTAs, missing SEO, missing disclaimers, media pending review, publish-ready pages. |
| Technical health | QLC+ readiness, projection readiness, fog readiness, strobe readiness, emergency-state readiness. |
| Recent changes | Latest edited records across all modules. |
| Next actions | Highest-priority tasks, due dates, and blockers. |

---

## 7. Cue Draft Handling

The admin should treat `docs/cue.txt` as a **working import source**.

| Draft content | Admin treatment |
|---|---|
| Six set blocks | Stage as `SET-001` through `SET-006`, status `Proposed`, content status `Needs review`. |
| Twenty-eight song rows | Stage as `SONG-001` through `SONG-028`, status `Proposed`, clearance/content status `Needs review`. |
| Platform drop | Create pending technical/safety records linked to `SONG-002` until mechanism and show-control trigger are known. |
| Costume changes | Create `CST-###` records with hold look, performer preset, show-control load, and fallback fields. |
| Screen drop | Create `VID-###` / `TRN-###` records with projection state, safety status, and venue dependency. |
| Finale and encore candidates | Keep as proposed until closing sequence is approved. |

Do not let the public CMS automatically publish raw song titles, album/era labels, or KISS-adjacent set-block labels from this draft.

---

## 8. Admin UX Principles

- **Bird's eye first, microscope second:** every module should have overview, filtered table, detail, and edit views.
- **Warnings should follow the record:** content, safety, venue, and public/private warnings must appear wherever a record is used.
- **Fast manual editing matters:** the owner should be able to change statuses, notes, priorities, public flags, and linked records without code.
- **Relationships matter more than isolated lists:** assets should link to timeline moments, pages, tasks, campaigns, and documents.
- **Production feasibility is a first-class field:** cue and task records should expose performer load, show-control load, and recovery path.
- **Public output must be gated:** public pages, ads, EPKs, and downloads should draw from approved material, not raw internal research.

---

## 9. Booted-Up Build Stance

I am prepared to build the owner-facing internal site as a structured project command center with the Timeline Moment Registry at its spine, inventory/media records as evidence-backed assets, and content/safety/task queues as visible management layers.

The next practical implementation move should be to establish the data model and admin routes for:

1. timeline moments;
2. assets/inventory;
3. media uploads;
4. tasks/readiness;
5. safety and content reviews;
6. dashboard summaries;
7. website CMS drafts after the internal records are stable.

---

## Machine-Readable SSOT Companion

This human-readable document has a paired SSOT JSON companion at `docs/ssot/owner_admin_build_readiness.json`. That JSON file is the stable machine-readable seed for website prototypes, owner-admin views, generated checklists, booking materials, marketing materials, and future production data files.

Use the SSOT companion when building software or structured outputs so facts can be reused across multiple website styles without being retyped, forked, or lost. When this document changes, update `docs/ssot/owner_admin_build_readiness.json` and `docs/ssot/master_index.json` in the same change.
