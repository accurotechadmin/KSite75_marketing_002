# Just One KISS - Website System Plan

**Purpose:** Define the complete website system needed for Just One KISS, including both the owner-facing project command center and the public-facing marketing website.

**Status:** Planning document / implementation blueprint.

**Timeline classification:** `GEN` / GENERAL / NOT TIMELINE-SPECIFIC. The website system is project-wide. Individual public videos, photos, cue clips, testimonials, ad creatives, and show-control media may become timeline-specific when they reference a precise show moment.

---

## 1. System Goal

The Just One KISS website should become two connected but clearly separated systems:

1. **Owner-facing command center** — a private, editable project control system for inventory, documents, show timeline, marketing assets, technical production, booking, tasks, launch readiness, and bird's-eye project oversight.
2. **Public-facing marketing site** — a theatrical, high-conversion landing-page system designed to sell the event, excite fans, support ads and social traffic, answer buyer questions, and communicate the show without implying outside partnership or using unreviewed restricted presentation assets.

The owner-facing system should help the owner see **everything about everything**, then zoom from whole-project overview to section overview to individual entry details. The public-facing system should provide a deliberately abundant marketing draft that can later be cut down manually.

---

## 2. Core Design Principle: Bird's Eye to Microscope

The private owner system should be organized around a repeatable navigation pattern:

| Level | Owner question | Example view |
|---|---|---|
| Whole-project overview | What is the current state of the entire project? | Dashboard with show readiness, inventory status, launch tasks, open risks, next deadlines, and recent changes. |
| Section overview | What is happening inside one major area? | Inventory dashboard, show-control dashboard, website dashboard, marketing dashboard, booking dashboard. |
| Subsection overview | What is happening inside one segment? | Costume inventory, lighting cues, fog machines, social posts, ticket page content, venue packet. |
| Item detail | What exactly is this thing, what does it connect to, and what must happen next? | One costume record, one fog machine, one Timeline Moment ID, one landing-page section, one ad creative, one task. |
| Editable fields | What needs to be changed right now? | Inline text editing, status dropdowns, notes, upload fields, linked records, owner comments. |

Every private module should support the same basic actions: **view, filter, search, sort, edit text, add entry, duplicate entry, attach files, link to Timeline Moment ID or `GEN`, mark status, and add notes**.

---

## 3. Data Architecture

The website should be powered by structured content rather than hard-coded pages wherever practical. A lightweight content management system, database-backed admin panel, or structured flat-file system can work, but the data model should be planned as if each project item is a record.

### 3.1 Required Universal Fields

Every owner-facing record should include these fields:

| Field | Purpose |
|---|---|
| Record ID | Stable internal ID for the entry. |
| Title / name | Human-readable label. |
| Section | Inventory, timeline, marketing, website, booking, technical, finance, etc. |
| Category | More specific type such as costume, fog machine, landing-page block, ad, cue, task. |
| Timeline Moment ID or `GEN` | Required classification. |
| Status | Proposed, active, needs review, approved, retired, archived, show-ready, etc. |
| Priority | High, medium, low, parking lot. |
| Owner / responsible role | Performer, show-control system, owner, designer, venue, vendor, content review, etc. |
| Public/private flag | Whether the item may appear publicly. |
| Content status | Owned, cleared, needs review, reference only, prohibited, unknown. |
| Safety status | Clear, needs review, venue-dependent, unsafe, not applicable. |
| Description | Editable long-form text. |
| Notes | Internal notes and decisions. |
| Linked files | Photos, PDFs, videos, cue files, graphics, documents. |
| Linked records | Related timeline moments, assets, pages, tasks, cues, contacts, or documents. |
| Last updated | Audit and freshness tracking. |

### 3.2 Relationship Model

The system should let records connect to each other instead of living in isolated lists.

| Record type | Should link to |
|---|---|
| Timeline Moment | Songs, cues, costumes, props, media, show-control actions, safety states, rehearsal notes. |
| Physical Asset | Inventory category, storage location, condition, owner/source, timeline moments, website uses. |
| Digital Asset | File location, content status, marketing uses, website pages, timeline moments. |
| Website Page | Page sections, CTAs, media assets, SEO fields, campaign links, content disclaimers. |
| Marketing Asset | Campaign, platform, audience, CTA, landing page, timeline moment or `GEN`. |
| Cue | Timeline moment, show-control action, QLC+ note, projection note, fog note, strobe note, emergency fallback. |
| Booking Asset | Buyer profile, venue packet, technical rider, EPK, inquiry status. |
| Task | Section, priority, due date, blocking issue, linked record, completion status. |

---

## 4. Owner-Facing Command Center

The owner-facing site should be private, login-restricted, and designed for fast editing. It should feel like a project cockpit, not a public website.

### 4.1 Master Dashboard

The master dashboard should answer: **What is the health of the whole show right now?**

Recommended panels:

| Panel | Contents |
|---|---|
| Project readiness score | Weighted status across show, technical, website, marketing, booking, inventory, safety, content, and launch. |
| Next critical dates | July 25, 2026 event date, rehearsal deadlines, content deadlines, venue deadlines, launch dates. |
| Open red flags | Content issues, missing assets, untested cues, unsafe effects, unfinished pages, unconfirmed booking details. |
| Timeline health | Count of approved, proposed, missing, and needs-review Timeline Moment IDs. |
| Inventory health | Missing photos, unconfirmed condition, unassigned storage, needs repair, needs purchase. |
| Website health | Pages drafted, pages published, CTAs missing, media missing, SEO incomplete, disclaimers pending. |
| Marketing health | Ads drafted, clips needed, platform readiness, calendar gaps, audience segments. |
| Technical health | QLC+ readiness, fixture status, fog/strobe safety, projection readiness, emergency states. |
| Task board summary | High-priority tasks, blocked tasks, overdue tasks, recently completed tasks. |
| Recent changes | Latest edited records across all sections. |

### 4.2 Global Search and Command Palette

The owner should be able to search across everything: assets, timeline IDs, songs, documents, pages, tasks, contacts, cues, and notes.

Search results should show:

- Record title.
- Section and category.
- Timeline Moment ID or `GEN`.
- Status.
- Content/safety warnings.
- Last updated date.
- Quick actions: edit, view links, duplicate, archive, add note.

A command palette could support quick commands such as:

- Add new physical asset.
- Add new digital asset.
- Add new Timeline Moment ID.
- Add new website section.
- Add new marketing task.
- Attach file to current record.
- Mark content review needed.
- Mark safety review needed.

### 4.3 Timeline and Show-Control Panel

This panel should turn the Timeline Moment Registry into an interactive project spine.

Views:

| View | Purpose |
|---|---|
| Timeline board | Ordered view of pre-show, opening, songs, transitions, costume changes, finale, encore, post-show. |
| Cue matrix | Rows for moments; columns for performer, show-control, lighting, projection, fog, strobe, costume, safety. |
| Emergency states | One-click reference for blackout, safe work light, projection black, projection hold, fog off, strobes off, music stop, reset, performer safe look. |
| Show-control run-sheet builder | Generate a simplified show-control view from approved timeline records. |
| Rehearsal notes | Attach notes, problems, fixes, and decisions to each moment. |
| Missing-links report | Show moments missing cues, assets, media, fallback states, or safety status. |

Required editing abilities:

- Add or reserve Timeline Moment IDs.
- Change status from proposed to approved to rehearsing to show-ready.
- Attach cues and assets.
- Add performer actions and show-control actions.
- Mark whether a moment is safe for the streamlined production model.
- Add fallback state for each technical cue.


### 4.3.1 Cue Draft Integration

`docs/cue.txt` should feed the private Timeline and Show-Control Panel as a working import source. The owner-facing system should be able to represent the cue draft without treating it as final.

Recommended cue-draft records:

| Record type | Source in `docs/cue.txt` | Required fields before content |
|---|---|---|
| Set block | ALIVE, DESTROYER, LOVE GUN, DYNASTY, MONSTER, END OF THE ROAD | `SET-###`, status, content review, purpose, linked songs. |
| Song row | Each listed song or song-like item | `SONG-###`, parent set, duration, arrangement/version, performer action, show-control action, content/performance-clearance status. |
| Transition / costume change | Scotty D's + KISS costume change; S.D. + KISS 2; Psycho Circus costume-change note | `TRN-###` / `CST-###`, duration, cover audio/video, hold look, fallback state. |
| Spectacle cue seed | Platform drop; screen drop; finale/encore candidates | Proper cue family ID, safety status, show-control trigger, emergency state, venue dependency. |

Public website pages may reference the excitement of the show structure only after public-ready wording is written. The internal set-block labels and song list should not be published automatically.

### 4.4 Inventory Command Center

The inventory area should support both physical and digital assets.

Primary inventory sections:

| Section | Example records |
|---|---|
| Costumes | Armor pieces, boots, capes, accessories, makeup kits, repair supplies. |
| Props | Stage props, handheld items, set dressing, display pieces. |
| Lighting | Fixtures, stands, cables, DMX adapters, controllers, power distribution. |
| Projection | Projector, screen, laptop, adapters, video files, black/hold screens. |
| Fog | Four fog machines, fluid, remotes, power, safety notes. |
| Strobes | Eight strobes, power, control notes, photosensitivity warnings. |
| Audio/playback | Interfaces, laptops, playback tracks, backup devices, cables. |
| Marketing media | Promo photos, trailer clips, social graphics, ad images, press photos. |
| Documents | Riders, checklists, content reviews, booking packets, cue sheets. |
| Storage/packing | Cases, bins, labels, packing order, load-in/load-out notes. |

Each asset detail page should include:

- Photos and file attachments.
- Physical/digital status.
- Condition.
- Storage location.
- Owner/source.
- Content status.
- Safety status.
- Timeline Moment ID or `GEN`.
- Potential website use.
- Potential marketing use.
- Potential documentation use.
- Needed edits or retakes.
- Maintenance notes.
- Replacement/purchase notes.
- Linked tasks.

Useful inventory views:

| View | Purpose |
|---|---|
| Bird's-eye inventory dashboard | Total assets, missing photos, repairs needed, content unknown, safety review needed. |
| Packing view | Cases, bins, load order, checklist status. |
| Maintenance view | Repairs, batteries, cleaning, fluid, cables, firmware/software notes. |
| Website-use view | Assets approved or pending for public pages. |
| Marketing-use view | Assets available for ads, social, press, trailer, retargeting. |
| Timeline-use view | Assets tied to specific show moments. |

### 4.5 Website Content Management Panel

The owner should be able to edit all public-facing text without touching code.

Editable content types:

- Page title.
- Hero headline.
- Hero subheadline.
- CTA text.
- Event date/time/location fields.
- Ticket/RSVP links.
- Section headlines.
- Body copy.
- FAQ entries.
- Disclaimer text.
- SEO title and meta description.
- Social-share title and image.
- Media captions.
- Button labels.
- Form labels and confirmation messages.

Recommended owner views:

| View | Purpose |
|---|---|
| Page inventory | All public pages, status, purpose, CTA, audience, campaign use. |
| Section editor | Edit each page block as modular content. |
| CTA map | See every button/link and where it points. |
| SEO checklist | Track title, meta description, headings, image alt text, schema, local keywords. |
| Content review queue | Pages or assets that need content/public-presentation review. |
| Draft-to-published workflow | Draft, internal review, content review, publish-ready, published, archived. |

### 4.6 Marketing and Campaign Panel

The marketing panel should support Facebook, Instagram, YouTube, Google Ads, organic social, email capture, and venue-buyer outreach.

Useful sections:

| Section | Purpose |
|---|---|
| Campaign calendar | What posts, ads, emails, trailers, and reminders go out when. |
| Audience profiles | KISS fans, classic-rock fans, Interlochen-area locals, travelers, venue buyers. |
| Asset matrix | Which photos/videos/copy support each platform and campaign. |
| Ad library | Headlines, descriptions, images, videos, CTAs, landing-page links, status. |
| Social post library | Draft captions, hashtags, visual assets, platform status. |
| YouTube plan | Trailer page, video descriptions, thumbnails, chapters, end screens. |
| Google Ads plan | Search terms, display concepts, landing pages, conversion events. |
| Performance notes | Manual tracking of what worked, what failed, and what to cut. |

Every marketing record should be either `GEN` or tied to a Timeline Moment ID if the creative is pulled from a specific show moment.

### 4.7 Booking, Sales, and Buyer Panel

This area should support venue buyers, press, sponsors if applicable, and event inquiries.

Recommended views:

| View | Purpose |
|---|---|
| Booking pipeline | Prospects, inquiries, status, next action, contact history. |
| Buyer one-sheet editor | Maintain current public booking summary. |
| EPK manager | Photos, bio, show description, technical highlights, press quotes, disclaimers. |
| Venue requirements | Stage, power, projection, fog/strobe rules, load-in, safety, insurance. |
| Technical rider tracker | What is ready, what is missing, what needs venue confirmation. |
| Follow-up templates | Email and message templates for inquiries and outreach. |

### 4.8 Safety, Content, and Compliance Panel

Because the show uses fog, strobes, projection, tribute positioning, and content-sensitive inspiration, this panel should be highly visible.

Recommended queues:

| Queue | Purpose |
|---|---|
| Content needs review | Logos, fonts, photos, videos, copy claims, persona references, disclaimers. |
| Safety needs review | Fog, strobes, blackout, power, cables, stage movement, costume risks. |
| Venue-dependent items | Effects that require venue content or local rule checks. |
| Public-claim review | Copy that may imply partnership, affiliation, content, or official status. |
| Emergency-state readiness | Blackout, safe work light, projection hold, fog off, strobes off, music stop, reset. |

The system should not pretend to provide content advice. It should flag uncertainty and route items into review.

### 4.9 Task and Launch Panel

The owner needs a practical task system tied to records.

Views:

- Master task board.
- Website launch checklist.
- Soft launch checklist.
- Public launch checklist.
- Rehearsal readiness checklist.
- Venue readiness checklist.
- Inventory readiness checklist.
- Marketing calendar checklist.
- Post-show review checklist.

Task fields should include title, section, linked record, priority, due date, owner, status, blocker, notes, and completed date.

---

## 5. Public-Facing Website System

The public site should feel like a strong theatrical marketing funnel. It should be direct, visually explosive, and intentionally over-supplied with copy and sections so the owner can cut it down later.

### 5.1 Public Site Goals

| Goal | Website response |
|---|---|
| Make the show feel like an event, not a local listing | Huge hero, theatrical copy, countdown, video, spectacle blocks. |
| Convert fans | Clear ticket/RSVP/inquiry CTAs throughout. |
| Explain the Gene Simmons tribute theatrical concept | Dedicated story, spectacle, and FAQ sections. |
| Support paid ads | Fast landing pages for specific audiences and CTAs. |
| Support organic social | Shareable hero visuals, trailer page, photo sections, fan capture. |
| Support venue buyers | Press/booking page, EPK, technical summary, contact forms. |
| Stay review-ready | Public disclaimer, careful tribute language, no official-affiliation claims. |

### 5.2 Public Page Inventory

Recommended public pages:

| Page | Primary audience | Main CTA | Timeline classification |
|---|---|---|---|
| Home / Main Event Landing Page | Fans and ad traffic | Get tickets / RSVP / event inquiry | `GEN` unless using specific show-moment media. |
| Ticket / RSVP Page | High-intent visitors | Claim ticket / RSVP / join list | `GEN`. |
| The Show Page | Fans who need explanation | Watch trailer / get tickets | `GEN`, with timeline links if showing specific cues. |
| Spectacle Page | Fans interested in lights, projection, fog, strobes | See the show / watch trailer | Mostly `GEN`; cue examples may be timeline-specific. |
| Video / Trailer Page | YouTube/social traffic | Watch, share, get tickets | `GEN` or specific `VID-###` references. |
| Photo / Costume Page | Visual browsers and social traffic | View gallery / get tickets | `GEN` or `CST-###` if tied to a costume-change moment. |
| Interlochen / Travel Page | Local and traveling fans | Plan the night / get tickets | `GEN`. |
| About the Performer Page | Fans, press, buyers | Learn more / booking inquiry | `GEN`. |
| Press / Booking Page | Venue buyers, press, partners | Request booking / download EPK | `GEN`. |
| Fan List Page | Fans not ready to buy | Join updates / get reminders | `GEN`. |
| FAQ / Disclaimer Page | Cautious buyers and content clarity | Get tickets / contact | `GEN`. |
| Thank You Page | Form submitters | Share / add calendar / follow | `GEN`. |


### 5.2.1 Cue-Informed Public Content Rules

The working setlist and cue notes in `docs/cue.txt` can inspire page structure, trailer planning, and spectacle language, but they should not be exposed as a raw public setlist. Use these rules:

| Public content decision | Rule |
|---|---|
| Song titles | Publish only after performance clearance, content, and event-copy review. |
| Album/era labels | Treat as internal inspiration unless public-use clearance is confirmed. |
| Platform-drop and screen-drop details | Describe generally as theatrical staging unless safety and venue review approve more detail. |
| Costume-change language | Keep fan-facing and original; avoid implying official persona ownership or partnership. |
| Finale / encore claims | Do not promise final sequence until the show structure is approved. |

### 5.3 Main Landing Page Draft Structure

The main landing page should start with the strongest possible event promise, then stack proof, spectacle, details, urgency, and answers.

#### Section 1: Hero

**Goal:** Make the visitor instantly understand that this is a dark, theatrical, high-voltage tribute event.

Possible elements:

- Giant show title.
- Event date: July 25, 2026.
- Interlochen, Michigan area positioning.
- Gene Simmons tribute theatrical tribute language.
- Fire/chrome/black visual system.
- Primary CTA: tickets, RSVP, or inquiry.
- Secondary CTA: watch trailer.
- Disclaimer link.

Draft copy options:

- **One night. Full fire. The Demon rises near Interlochen.**
- **A Gene Simmons tribute theatrical rock built for KISS fans.**
- **July 25, 2026 — Interlochen, Michigan area.**
- **Lights. Projection. Fog. Strobes. Costume changes. Arena attitude in a focused theatrical package.**

#### Section 2: Immediate CTA Strip

**Goal:** Give the visitor no excuse to miss the core action.

Possible content:

- Date.
- Location.
- Ticket/RSVP status.
- Countdown.
- Reminder signup.
- Share button.

#### Section 3: Trailer / Video Feature

**Goal:** Let the spectacle sell itself.

Possible content:

- Embedded trailer.
- Short copy: “Watch the transformation begin.”
- CTA under video.
- Note if footage is rehearsal, promo, concept, or live.

#### Section 4: What This Is

**Goal:** Explain the concept without sounding academic.

Possible copy:

> Just One KISS is a Gene Simmons tribute theatrical tribute experience inspired by the fire, scale, menace, and larger-than-life stage mythology associated with Gene Simmons and KISS. It is built as a repeatable stage event: costume changes, cued lighting, projection, fog, strobes, and a show structure operated by the approved show-control plan.

Public-ready note: This section should include tribute language without implying outside partnership.

#### Section 5: Why Fans Should Care

**Goal:** Convert emotional recognition into action.

Possible bullets:

- Built for KISS fans who want spectacle, not background music.
- Designed around a theatrical transformation, not a casual cover set.
- Uses lights, video, fog, strobes, and costume changes to create a bigger-than-the-room experience.
- Focused on the approved live-production plan for a tight, repeatable show.
- Created for fans willing to travel, rally, dress up, take photos, and make the night feel like an event.

#### Section 6: The Spectacle Stack

**Goal:** Make production value visible.

Possible feature cards:

| Feature | Public copy angle |
|---|---|
| Lighting | Cued DMX looks designed for impact, shadow, and arena-scale hits. |
| Projection | Video moments and screen states shaped around the show timeline. |
| Fog | Atmosphere, reveals, and transitions controlled for safety and timing. |
| Strobes | High-impact moments used with warning, control, and restraint. |
| Costumes | Multiple Gene-inspired theatrical looks, armor energy, chrome, black, fire. |
| Show-control control | A dedicated show-control keeps the show tight, cued, and recoverable. |

#### Section 7: Event Details

**Goal:** Answer practical questions quickly.

Fields:

- Date.
- Time.
- Venue / location.
- Ticket or RSVP link.
- Age policy if applicable.
- Accessibility note if applicable.
- Fog/strobe notice.
- Parking/travel note.
- Contact link.

#### Section 8: Interlochen / Local Travel Block

**Goal:** Help regional fans decide that travel is worth it.

Possible content:

- Interlochen-area framing.
- Nearby communities to mention if appropriate.
- “Make it a rock night in Northern Michigan” style copy.
- Travel/parking/lodging links if available.

#### Section 9: Photo / Costume / Visual Gallery

**Goal:** Provide scroll-stopping proof and social-share material.

Gallery filters:

- Costume.
- Lighting.
- Fog/strobe.
- Rehearsal.
- Promo.
- Venue.
- Behind the scenes.

Each image should have alt text, content status, public/private flag, caption, and Timeline Moment ID or `GEN`.

#### Section 10: Fan Callout

**Goal:** Make visitors feel invited into a fan ritual.

Possible copy:

- **Built for the faithful. Loud enough for the legends.**
- **Dress loud. Arrive ready. Bring the roar.**
- **This is not background music. This is a night for the fans.**

#### Section 11: FAQ Preview

**Goal:** Remove friction.

Questions:

- Is this an official KISS or Gene Simmons event?
- What kind of show is it?
- Are there fog and strobe effects?
- Is this a full band?
- How long is the show?
- Can I bring kids?
- Where is the venue?
- How do I get tickets or RSVP?
- Can venues book this show?

#### Section 12: Public Disclaimer

**Goal:** Keep tribute posture clear.

Draft disclaimer:

> Just One KISS is an independent theatrical tribute project inspired by classic rock spectacle and Gene Simmons/KISS-style stage mythology. It is not affiliated with, endorsed by, sponsored by, or officially connected to KISS, Gene Simmons, Pophouse, or any related content holder. All public-facing materials are intended to be original public-ready promotional materials and should be reviewed before launch.

#### Section 13: Final CTA

**Goal:** End with direct action.

Possible CTAs:

- Get tickets.
- RSVP / request event info.
- Join the fan list.
- Watch the trailer.
- Book the show.

---

## 6. Public Copy Bank

This copy bank is intentionally excessive. The owner can cut it down later.

### 6.1 Hero Headline Options

- One night. Full fire. Just One KISS.
- The Demon rises near Interlochen.
- A theatrical rock tribute built for the faithful.
- Black first. Chrome second. Fire third. Ordinary never.
- Lights. Fog. Strobes. Costume changes. The Gene Simmons tribute performer. One show-control. One loud night.
- A Gene Simmons-inspired theatrical tribute experience for KISS fans.

### 6.2 Subheadline Options

- A Gene Simmons tribute stage spectacle inspired by the menace, mythology, and arena-scale theatricality of Gene Simmons and KISS.
- Built for fans who want more than a cover set: costume changes, cued lighting, projection, fog, strobes, and a full theatrical structure.
- Coming July 25, 2026 for fans near, or ready to travel to, Interlochen, Michigan.
- A dark, chrome-edged, fire-lit tribute experience designed to feel bigger than the room.

### 6.3 CTA Options

- Get Tickets
- RSVP Now
- Join the Fan List
- Watch the Trailer
- Plan the Night
- Bring the Fire
- Request Booking Info
- Download the EPK
- Send Me Show Updates

### 6.4 Short Ad Copy Options

- KISS fans near Interlochen: July 25, 2026 is not a background-music night.
- The Gene Simmons tribute performer. One show-control. Full theatrical impact.
- Costume changes, lights, projection, fog, strobes, and a tribute built for the faithful.
- A Gene Simmons-inspired theatrical rock tribute is rising in Northern Michigan.
- Black. Chrome. Fire. Loud. July 25, 2026.

### 6.5 Longer Marketing Copy Option

Just One KISS is a Gene Simmons tribute theatrical tribute experience inspired by the music, stage mythology, menace, and spectacle associated with Gene Simmons and KISS. Designed for fans who want a full event instead of a casual cover set, the show combines costume changes, cued lighting, projection, fog, strobes, and a tightly operated streamlined production model. The current promotional focus is July 25, 2026 near Interlochen, Michigan.

---

## 7. Forms and Conversions

Recommended forms:

| Form | Fields | Destination |
|---|---|---|
| Fan reminder form | Name, email, phone optional, city, consent checkbox | Fan list / reminders. |
| Ticket inquiry / RSVP form | Name, email, number of guests, questions | Event inquiry pipeline. |
| Booking inquiry form | Name, organization, venue, date, location, budget range optional, message | Booking pipeline. |
| Press contact form | Name, outlet, deadline, request type | Press queue. |
| Asset upload form | Internal only; file, category, content status, Timeline ID or `GEN` | Owner asset encyclopedia. |

Conversion events to track:

- CTA click.
- Form submit.
- Trailer play.
- Scroll depth.
- External ticket click.
- Booking inquiry.
- EPK download.
- Phone/email click.

---

## 8. Owner Editing Workflow

Recommended workflow for public content:

1. Draft section in the owner panel.
2. Assign page and section type.
3. Attach media.
4. Mark Timeline Moment ID or `GEN`.
5. Set content status.
6. Set safety status if fog/strobes/blackout/physical effects are mentioned.
7. Preview page.
8. Send to public-presentation review.
9. Mark publish-ready.
10. Publish.
11. Track performance.
12. Archive or improve after campaign review.

Recommended workflow for inventory:

1. Add asset.
2. Upload photos or files.
3. Assign category.
4. Add condition and storage location.
5. Assign Timeline Moment ID or `GEN`.
6. Add content/safety status.
7. Add website/marketing/documentation use.
8. Add needed edits, retakes, or maintenance tasks.
9. Link to show moments, pages, campaigns, or packing lists.
10. Review before launch or performance.

---

## 9. Recommended Implementation Modules

A practical build could start with these modules:

| Phase | Module | Reason |
|---|---|---|
| 1 | Public landing page | Immediate marketing value for July 25, 2026. |
| 1 | Editable page sections | Owner can cut and revise copy without code. |
| 1 | Fan/RSVP/booking forms | Converts traffic into contacts. |
| 1 | Basic admin login | Protect owner content. |
| 2 | Inventory database | Organizes physical and digital assets. |
| 2 | Timeline Moment Registry UI | Connects cues, assets, and show structure. |
| 2 | Media library | Tracks public/private status and content. |
| 3 | Marketing campaign panel | Supports ads, social, YouTube, Google traffic. |
| 3 | Task board and launch checklist | Makes readiness visible. |
| 4 | Show-control run-sheet generator | Turns approved timeline data into practical show-control sheets. |
| 4 | Reporting dashboard | Project health, missing data, risks, and readiness. |

---

## 10. Minimum Viable Build

If the first version must be small, build this:

### Public

- Home landing page.
- Ticket/RSVP or inquiry form.
- Trailer/video section.
- FAQ/disclaimer section.
- Press/booking contact section.

### Private

- Login-restricted dashboard.
- Editable page content records.
- Asset inventory records.
- Timeline Moment ID records.
- Task records.
- Content/safety status fields.
- Global search.

This minimum version would already support marketing, owner oversight, inventory growth, and the Timeline Moment ID rule.

---

## 11. Non-Negotiable Requirements

- Every record must have a Timeline Moment ID or `GEN`.
- Public pages must avoid official-affiliation claims unless cleared.
- Cleared fonts or restricted materials must not be redistributed through the system.
- Fog and strobe content must support safety notices and venue review.
- The production model must remain executable by the approved show-control plan.
- Owner-facing text data must be editable without code.
- The owner must be able to add entries intuitively.
- Every major section must support bird's-eye overview and zoom-in detail views.
- Public content should be visually explosive, direct, and conversion-oriented.

---

## Machine-Readable SSOT Companion

This human-readable document has a paired SSOT JSON companion at `docs/ssot/website_system_plan.json`. That JSON file is the stable machine-readable seed for website prototypes, owner-admin views, generated checklists, booking materials, marketing materials, and future production data files.

Use the SSOT companion when building software or structured outputs so facts can be reused across multiple website styles without being retyped, forked, or lost. When this document changes, update `docs/ssot/website_system_plan.json` and `docs/ssot/master_index.json` in the same change.
