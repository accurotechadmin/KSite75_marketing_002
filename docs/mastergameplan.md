# Just One KISS Master Gameplan

**Version:** 2

**Scope:** Timeline-synchronized production, asset, marketing, and documentation plan

## 1. Purpose

This document is the master planning blueprint for Just One KISS, a Gene Simmons tribute theatrical stage performance inspired by Gene Simmons of KISS.

The purpose of this document is to define everything that must be created, documented, inventoried, rehearsed, marketed, and operated so the project can become a complete, repeatable, bookable theatrical show.

This version includes three important production systems:

A projection screen displaying cued videos.

A fog machine set of 4 fog machines.

A strobe machine set of 8 strobes.

The show is designed for:

The Gene Simmons tribute performer.

Show-control system.

Multiple Gene Simmons-inspired costume changes.

Heavy lighting and effects control.

Cued video/projection content.

A comprehensive documentation system.

A complete physical and digital asset inventory.

Marketing, sales, website, SEO, social, ads, booking, and launch planning.

## 2. Core operating principle

Every specific item in the project must be assigned to one of two categories:

### 2.1 Timeline-specific

The item belongs to a defined moment in the tentative show timeline.

Examples:

A lighting cue.

A video cue.

A fog cue.

A strobe cue.

A costume change.

A song intro.

A transition.

A spoken line.

A projection clip.

A stage movement.

A marketing video captured from a specific scene.

Every timeline-specific item must reference a Timeline Moment ID.

### 2.2 General / not timeline-specific

The item is part of the broader project but does not belong to one exact show moment.

Examples:

Website homepage.

Presentation bible.

Booking one-sheet.

Master costume inventory.

General ad strategy.

SEO plan.

Customer profiles.

General physical inventory.

General digital asset inventory.

Content checklist.

Venue outreach templates.

General items should be labeled:

GENERAL

or

NOT TIMELINE-SPECIFIC

## 3. Source technical reference

The uploaded lighting reference describes the base rig as a single-universe QLC+ / Q Light Controller Plus DMX installation with DMX control as the normal operating policy. The core inventory includes one Chauvet DJ COLORstrip Mini, four plug-control channels, fourteen Honeycomb RGB PAR-style fixtures, eight KISS sign dimmer channels, eight Chauvet Freedom Par RGBA uplights, and eight 14-channel moving-head Rotator fixtures. The reference also emphasizes direct color control, safe setup channels, fixture groups, and isolated utility plug handling.

The added production systems in this version are:

Projection screen with cued videos.

Four fog machines.

Eight strobes.

These should be integrated into the same timeline-based show-control logic as the lighting cues.

## 4. Project identity

### 4.1 Working title

Just One KISS

### 4.2 Project description

Just One KISS is a Gene Simmons tribute theatrical rock inspired by the music, stage mythology, and persona of Gene Simmons of KISS. The show uses costume changes, lighting, projection, fog, strobes, transitions, and structured set architecture to create a large theatrical experience operated by only two people: the approved show-control plan.

### 4.3 Personnel model

Role

Responsibility

Performer

Performs the show, changes costumes, handles vocals/instrument/movement/persona/audience interaction

Show-control system

Runs DMX, lighting, video cues, fog cues, strobe cues, playback if applicable, show-control documents, venue coordination, and emergency recovery


---

## Current Working Cue / Setlist Draft

`docs/cue.txt` is the first concrete working cue and setlist draft in the repository. It currently contains six proposed set blocks, twenty-eight song rows or song-like entries, listed durations, platform-drop and screen-drop notes, costume-change transitions, finale candidates, and encore candidates.

Planning rules for this draft:

| Rule | Requirement |
|---|---|
| Not final approved | Treat the cue draft as working show architecture until approved. |
| Registry migration | Every set block, song, transition, costume change, platform drop, screen drop, finale, and encore item must be migrated to `docs/timeline_moment_registry.md`. |
| Production feasibility | Every cue must be tested against the approved show-control plan before it becomes show-ready. |
| Cue Bible priority | The future Cue Bible should use `docs/cue.txt` as its first source, then add show-control triggers, QLC+ functions, projection files, fog/strobe permissions, fallback states, and rehearsal timing. |
| Content posture | Song titles, album/era labels, and KISS-adjacent terms are internal planning references until public-use content review is complete. |

## 5. Master timeline system

The entire docset should revolve around a central Timeline Moment Registry.

### 5.1 Required document

Document name:Just One KISS - Timeline Moment Registry

### 5.2 Purpose

The Timeline Moment Registry is the master spine of the whole project. It prevents the show from becoming a pile of unrelated songs, costumes, lights, videos, props, and marketing ideas.

Every timeline-specific asset should connect back to this registry.

### 5.3 Suggested Timeline Moment ID format

PRE-001     Pre-show moment
OPEN-001    Opening moment
SET-001     Set-level moment
SONG-001    Song-level moment
TRN-001     Transition moment
CST-001     Costume-change moment
VID-001     Video/projection moment
LGT-001     Lighting moment
FOG-001     Fog moment
STR-001     Strobe moment
SPK-001     Spoken/performance moment
FIN-001     Finale moment
ENC-001     Encore moment
POST-001    Post-show moment
GEN         General / not timeline-specific

### 5.4 Master registry fields

Field

Purpose

Timeline Moment ID

Unique reference code

Moment Type

Song, transition, costume change, lighting, video, fog, strobe, spoken, etc.

Tentative Time

Approximate location in show

Set Number

Which set this belongs to

Song Slot

Blank until setlist is chosen

Costume

Costume assigned to the moment

Performer Action

What the performer does

Show-Control Action

What the show-control does

Lighting State

Lighting cue or look

Video State

Projection/video cue

Fog State

Fog cue or no fog

Strobe State

Strobe cue or no strobe

Audio State

Track, live audio, silence, transition bed

Asset Links

Related physical/digital assets

Notes

Open notes

Status

Draft, testing, approved, retired

## 6. Master inventory of everything to build

Everything below should eventually become a document, spreadsheet, cue sheet, template, showfile, asset folder, checklist, or production packet.

## 7. Core meta documents to create

### 7.1 Master Project Bible

Document: Just One KISS - Master Project BibleTimeline status: GENERAL

Purpose:

Define the show identity.

Define the tribute positioning.

Define the performer/show-control model.

Define the theatrical tone.

Define the documentation system.

Define the show’s relationship to songs, costumes, lighting, video, fog, strobes, marketing, and sales.

Should include:

Project description.

Tribute positioning.

Content notes.

Presentation tone.

Show format.

Set structure.

Costume-change concept.

Lighting concept.

Projection concept.

Fog concept.

Strobe concept.

Marketing concept.

Booking concept.

Document index.

Companion example recommended:

Example - Master Project Bible - Arbitrary Filled Sample

### 7.2 Bird’s-Eye Project Sequence

Document: Just One KISS - Birdseye Project SequenceTimeline status: GENERAL

Purpose:

Show the entire project from idea to public launch.

Main phases:

Presentation and content review.

Master document setup.

Physical inventory.

Digital inventory.

Timeline Moment Registry.

Song candidate research.

Set architecture.

Costume architecture.

Lighting architecture.

Projection/video architecture.

Fog/strobe architecture.

Rehearsal system.

Website system.

Marketing funnel.

Booking system.

Technical rider.

Soft-launch performance.

Public launch.

Post-show refinement.

### 7.3 Master Document Index

Document: Just One KISS - Document IndexTimeline status: GENERAL

Purpose:

Track every document that exists, needs to exist, or has been retired.

Suggested fields:

Document Name

Category

Timeline Status

Related Moment ID

Owner

Status

Last Updated

Notes

### 7.4 Timeline Moment Registry

Document: Just One KISS - Timeline Moment RegistryTimeline status: GENERAL, but used by all timeline-specific documents

Purpose:

This is the central synchronization tool for the entire show.

Every cue, asset, costume, transition, video, fog effect, strobe effect, and show-control action should either point to a Timeline Moment ID or be clearly marked GENERAL.

## 8. Presentation and content documents

### 8.1 Internal KISS Reference Bible

Document: KISS Reference Bible - Internal Use OnlyTimeline status: GENERAL

Purpose:

Capture what makes KISS and Gene Simmons feel recognizable without copying restricted public-facing materials.

Sections:

Gene Simmons persona references.

Costume era observations.

Stage behavior observations.

Lighting observations.

Poster/typography observations.

Audience rituals.

Things to avoid copying directly.

Original alternatives.

### 8.2 Just One KISS Presentation Bible

Document: Just One KISS - Presentation BibleTimeline status: GENERAL

Purpose:

Define the public-facing identity of the show.

Sections:

Name.

Tagline options.

Tone.

Visual language.

Color direction.

Typography direction.

Logo direction.

Photo style.

Video style.

Projection style.

Social voice.

Booking voice.

Disclaimer language.

Prohibited claims.

Content notes.

### 8.3 Public Presentation Checklist

Document: Just One KISS - Content Risk ChecklistTimeline status: GENERAL

Review:

Show name.

Logo.

Makeup.

Costumes.

Posters.

Website.

Merchandise.

Paid ads.

YouTube videos.

Social posts.

Projection videos.

Backing tracks.

Performance recordings.

Public disclaimers.

## 9. Physical asset inventory documents

### 9.1 Master Physical Asset Inventory

Document: Just One KISS - Physical Asset InventoryTimeline status: GENERAL with optional Moment ID links

Categories:

Costumes.

Costume accessories.

Instruments.

Microphones.

Stands.

Cables.

Lighting fixtures.

DMX hardware.

Projection screen.

Projector or video display system.

Video playback hardware.

Fog machines.

Strobe machines.

Power equipment.

Control equipment.

Stage scenic items.

Props.

Cases.

Tools.

Repair supplies.

Storage bins.

Transport equipment.

Suggested fields:

Asset ID

Item

Category

Quantity

Timeline Moment ID

Location

Condition

Owner

Replacement Cost

Notes

### 9.2 Lighting Asset Inventory

Document: Just One KISS - Lighting Asset InventoryTimeline status: GENERAL with Moment ID links

Include:

COLORstrip Mini.

Honeycomb fixtures.

Freedom Par RGBA uplights.

Rotator moving heads.

KISS sign channels.

Plug-control channels.

DMX interfaces.

DMX cables.

Power cables.

Mounting hardware.

Strobe set of 8 strobes.

Any additional manually or DMX-controlled devices.

### 9.3 Projection and Video Asset Inventory

Document: Just One KISS - Projection Video Asset InventoryTimeline status: GENERAL with Moment ID links

Physical items:

Projection screen.

Projector/display device.

Playback computer/media player.

Video output adapters.

HDMI/SDI/other cabling.

Mounting/stand hardware.

Backup playback device.

Power supplies.

Digital items:

Intro videos.

Transition videos.

Costume-change cover videos.

Song-specific videos.

Finale videos.

Logo loops.

Ambient loops.

Emergency holding screen.

Black screen file.

Suggested fields:

Asset ID

Asset Name

Type

Timeline Moment ID

File Location

Runtime

Resolution

Audio?

Status

Notes

### 9.4 Fog Machine Inventory

Document: Just One KISS - Fog Machine InventoryTimeline status: GENERAL with Moment ID links

Include:

Fog Machine 1.

Fog Machine 2.

Fog Machine 3.

Fog Machine 4.

Control method.

Power needs.

Placement.

Fluid type.

Warm-up time.

Safety notes.

Venue restrictions.

Cue assignments.

Suggested fields:

Fog ID

Location

Control Method

Timeline Moment ID

Cue Purpose

Fluid Status

Safety Notes

### 9.5 Strobe Machine Inventory

Document: Just One KISS - Strobe Machine InventoryTimeline status: GENERAL with Moment ID links

Include:

Strobe 1 through Strobe 8.

Control method.

Placement.

Power needs.

Cue assignments.

Safety restrictions.

Audience warning policy.

Suggested fields:

Strobe ID

Location

Control Method

Timeline Moment ID

Cue Purpose

Intensity Limit

Safety Notes

### 9.6 Costume Inventory

Document: Just One KISS - Costume InventoryTimeline status: GENERAL with set/moment links

For each costume:

Costume ID

Costume Name

Inspired Era

Set Assignment

Timeline Moment IDs

Pieces

Change Time

Storage

Repair Notes

Content Review

## 10. Digital asset inventory documents

### 10.1 Master Digital Asset Inventory

Document: Just One KISS - Digital Asset InventoryTimeline status: GENERAL with Moment ID links

Categories:

Logos.

Fonts.

Color palettes.

Photos.

Videos.

Projection files.

Backing tracks.

Click tracks.

QLC+ showfiles.

Lighting cue sheets.

Fog cue sheets.

Strobe cue sheets.

Website assets.

Ad creatives.

Social templates.

YouTube thumbnails.

Booking PDFs.

Press kit files.

Contracts.

Templates.

Suggested fields:

Asset Name

Category

Timeline Moment ID

File Type

Location

Version

Content Status

Approved?

Notes

### 10.2 File Naming and Folder Rules

Document: Just One KISS - File Naming and Folder RulesTimeline status: GENERAL

Recommended folder structure:

Just One KISS/
  00_Admin/
  01_Presentation/
  02_Content_Review/
  03_Master_Gameplan/
  04_Timeline_Moment_Registry/
  05_Songs_and_Sets/
  06_Costumes/
  07_Lighting_DMX/
  08_Projection_Video/
  09_Fog_Strobes/
  10_Stage_and_Blocking/
  11_Rehearsal/
  12_Website/
  13_Marketing/
  14_Social/
  15_Ads/
  16_YouTube/
  17_Sales_and_Booking/
  18_Photos/
  19_Audio/
  20_Venue_Packets/
  21_Post_Show_Reviews/
  99_Archive/

Recommended file pattern:

JOK_Category_DocumentName_MomentID_v##_YYYY-MM-DD

For general files:

JOK_Category_DocumentName_GEN_v##_YYYY-MM-DD

## 11. Show architecture documents

### 11.1 Master Show Architecture

Document: Just One KISS - Master Show ArchitectureTimeline status: GENERAL

Purpose:

Define the structure without choosing arbitrary songs.

Fields:

Show Version:
Total Runtime:
Number of Sets:
Number of Costume Changes:
Projection Used?:
Fog Used?:
Strobes Used?:
Opening Style:
Closing Style:
Venue Type:
Technical Level:
Notes:

### 11.2 Timeline-Based Set Architecture Template

Document: Just One KISS - Set Architecture TemplateTimeline status: Timeline-specific

Template:

Set ID:
Timeline Moment IDs:
Set Name:
Costume:
Set Purpose:
Approximate Runtime:
Song Slots:
Projection Needs:
Lighting Tone:
Fog Use:
Strobe Use:
Performer Notes:
Show-Control Notes:
Transition Into Set:
Transition Out of Set:
Risk Points:

### 11.3 Song Candidate Matrix

Document: Just One KISS - Song Candidate MatrixTimeline status: GENERAL until songs are assigned

Suggested fields:

Song

Era

Gene Association

Familiarity

Deep-Cut Value

Theatrical Value

Costume Fit

Lighting Potential

Projection Potential

Fog Potential

Strobe Potential

Difficulty

Content Notes

Do not choose arbitrary setlists in this document.

### 11.4 Final Setlist Document

Document: Just One KISS - Final SetlistTimeline status: Timeline-specific

Suggested fields:

Order

Timeline Moment ID

Song

Set

Costume

Projection Cue

Lighting Cue

Fog Cue

Strobe Cue

Transition Notes

## 12. Transition documents

### 12.1 Master Transition Map

Document: Just One KISS - Master Transition MapTimeline status: Timeline-specific

Suggested fields:

Transition ID

From Moment ID

To Moment ID

Performer Action

Show-Control Action

Costume Action

Lighting State

Video State

Fog State

Strobe State

Duration

Backup Plan

### 12.2 Costume-Change Transition Sheet

Document pattern:Transition Sheet - Costume Change - [Moment ID]

Template:

Timeline Moment ID:
From Set:
To Set:
From Costume:
To Costume:
Target Duration:
Performer Path:
Costume Pieces Removed:
Costume Pieces Added:
Show-Control Actions:
Projection Cover:
Lighting Cover:
Fog State:
Strobe State:
Audio State:
Ready Signal:
Failure Backup:
Notes:

### 12.3 Between-Song Transition Sheet

Document pattern:Transition Sheet - Song to Song - [Moment ID]

Template:

Timeline Moment ID:
From Song Slot:
To Song Slot:
Transition Type:
Performer Action:
Show-Control Action:
Projection Cue:
Lighting Cue:
Fog Cue:
Strobe Cue:
Audio Cue:
Audience Interaction:
Approximate Duration:
Backup Plan:
Notes:

## 13. Lighting, video, fog, and strobe control documents

### 13.1 Integrated Show Control Plan

Document: Just One KISS - Integrated Show Control PlanTimeline status: GENERAL

Purpose:

Define how the show-control system controls lighting, video, fog, strobes, playback, and emergency states.

Sections:

Show-control station layout.

QLC+ layout.

Video playback method.

Fog control method.

Strobe control method.

Cue naming rules.

Emergency controls.

Pre-show test routine.

Per-song cue routine.

Transition routine.

Shutdown routine.

### 13.2 Lighting Master Plan

Document: Just One KISS - Lighting Master PlanTimeline status: GENERAL with Moment ID links

Sections:

Lighting philosophy.

Fixture group plan.

Color worlds.

Costume-based looks.

Song-based looks.

Transition looks.

Projection-friendly looks.

Fog-compatible looks.

Strobe-safe looks.

Emergency looks.

Show-control notes.

### 13.3 Projection and Video Cue Plan

Document: Just One KISS - Projection Video Cue PlanTimeline status: Timeline-specific

Purpose:

Synchronize projection to specific show moments.

Suggested fields:

Video Cue ID

Timeline Moment ID

File Name

Start Trigger

End Trigger

Screen State

Audio?

Loop?

Backup

Video cue categories:

Pre-show loop.

Opening video.

Song-specific video.

Costume-change cover video.

Transition video.

Finale video.

Emergency hold screen.

Black screen.

### 13.4 Fog Cue Plan

Document: Just One KISS - Fog Cue PlanTimeline status: Timeline-specific

Suggested fields:

Fog Cue ID

Timeline Moment ID

Fog Machines Used

Start Trigger

Duration

Intensity

Purpose

Safety Notes

Fog should be planned as a visual layer, not a constant effect.

### 13.5 Strobe Cue Plan

Document: Just One KISS - Strobe Cue PlanTimeline status: Timeline-specific

Suggested fields:

Strobe Cue ID

Timeline Moment ID

Strobes Used

Trigger

Duration

Rate

Intensity

Safety Notes

Strobe use should be intentional, brief, documented, and venue-approved.

### 13.6 QLC+ Cue Stack Template

Document: Just One KISS - QLC Cue Stack TemplateTimeline status: Timeline-specific

Template:

Timeline Moment ID:
Song Slot:
Set:
Costume:
QLC Cue Stack Name:
Starting Look:
Cue 1:
Cue 2:
Cue 3:
Cue 4:
Cue 5:
Projection Cue:
Fog Cue:
Strobe Cue:
Manual Bumps:
Blackout Point:
End Look:
Transition Out:
Show-control Notes:

### 13.7 Show-Control Run Sheet

Document: Just One KISS - Show-Control Run SheetTimeline status: Timeline-specific

Suggested fields:

Order

Timeline Moment ID

Performer Moment

Show-Control Action

Lighting Cue

Video Cue

Fog Cue

Strobe Cue

Audio Cue

Emergency Option

This is the main live-show document for the show-control system.

### 13.8 Emergency Control Sheet

Document: Just One KISS - Emergency Control SheetTimeline status: GENERAL

Required emergency states:

Visual blackout.

Static safe work light.

Projection black screen.

Projection hold screen.

Fog off.

Strobes off.

Music stop.

System reset.

Performer safe look.

Costume-change hold look.

## 14. Stage and blocking documents

### 14.1 Stage Plot Packet

Document: Just One KISS - Stage Plot PacketTimeline status: GENERAL with Moment ID links

Must show:

Performer zones.

Costume-change zone.

Show-control system station.

Lighting fixture placement.

Projection screen placement.

Projector/display placement.

Fog machine placement.

Strobe placement.

Cable paths.

Power locations.

Audience boundary.

Emergency access.

Versions:

Rehearsal.

Small venue.

Medium stage.

Theater.

Festival/outdoor.

### 14.2 Performer Blocking Map

Document: Just One KISS - Performer Blocking MapTimeline status: Timeline-specific

Template:

Timeline Moment ID:
Song Slot:
Set:
Costume:
Opening Position:
Verse/Section Position:
Chorus/Feature Position:
Projection Interaction:
Lighting Dependency:
Fog Dependency:
Strobe Dependency:
Ending Position:
Notes:

## 15. Costume documents

### 15.1 Costume-to-Set Map

Document: Just One KISS - Costume to Set MapTimeline status: Timeline-specific

Suggested fields:

Set

Timeline Moment IDs

Costume

Costume Purpose

Song Slots

Projection Style

Lighting Style

Change Before

Change After

### 15.2 Costume Readiness Checklist

Document: Just One KISS - Costume Readiness ChecklistTimeline status: GENERAL with Moment ID links

For each costume:

All pieces present.

Repairs complete.

Cleaned.

Packed.

Change order prepared.

Photos taken.

Content reviewed.

Movement tested.

Microphone/instrument compatibility tested.

Lighting visibility tested.

Projection visibility tested.

Fog visibility tested.

Strobe visibility tested.

## 16. Performance documents

### 16.1 Performer Show Script

Document: Just One KISS - Performer Show ScriptTimeline status: Timeline-specific

Template:

Timeline Moment ID:
Set:
Costume:
Song Slot:
Pre-song line:
Audience interaction:
Movement note:
Projection interaction:
Lighting note:
Fog note:
Strobe note:
Post-song line:
Transition note:
Emergency ad-lib:

### 16.2 Rehearsal Log

Document: Just One KISS - Rehearsal LogTimeline status: GENERAL and timeline-specific

Suggested fields:

Date

Timeline Moment IDs Rehearsed

Focus

Costume

Lighting

Projection

Fog

Strobe

Problems

Fixes Needed

### 16.3 Post-Show Review Template

Document: Just One KISS - Post Show Review TemplateTimeline status: GENERAL and timeline-specific

Sections:

Venue.

Date.

Show version.

Timeline moments that worked.

Timeline moments that failed.

Costume notes.

Lighting notes.

Projection notes.

Fog notes.

Strobe notes.

Show-control notes.

Performer notes.

Audience response.

Marketing lessons.

Next fixes.

## 17. Website and SEO documents

### 17.1 Website Strategy

Document: Just One KISS - Website StrategyTimeline status: GENERAL

Purpose:

Define the website’s role in booking, fan engagement, search visibility, and proof-building.

### 17.2 Website Page Inventory

Document: Just One KISS - Website Page InventoryTimeline status: GENERAL with optional Moment ID links

Pages:

Home.

About the show.

Book the show.

Show options.

Media/video.

Photos.

Technical specs.

FAQ.

Press kit.

Contact.

Blog/news.

Tribute disclaimer.

Suggested fields:

Page

Purpose

Audience

CTA

Assets Needed

Related Moment IDs

SEO Target

Status

### 17.3 SEO Plan

Document: Just One KISS - SEO PlanTimeline status: GENERAL

Sections:

Short-term booking keywords.

Long-term tribute-show keywords.

Local/regional keywords.

Video SEO.

Image SEO.

Venue recap SEO.

Blog topic plan.

Backlink plan.

Review/testimonial plan.

## 18. Marketing and sales funnel documents

### 18.1 Customer Profiles

Document: Just One KISS - Customer ProfilesTimeline status: GENERAL

Profiles:

KISS fan.

Gene Simmons fan.

Classic rock fan.

Theater buyer.

Casino buyer.

Bar/club buyer.

Festival buyer.

Private event buyer.

Halloween/seasonal event buyer.

YouTube/social viewer.

### 18.2 Sales Funnel Map

Document: Just One KISS - Sales Funnel MapTimeline status: GENERAL

Stages:

Awareness.

Interest.

Trust.

Inquiry.

Booking conversation.

Contract.

Pre-show preparation.

Performance.

Post-show follow-up.

Rebooking/referral.

Suggested fields:

Funnel Stage

Audience

Asset Needed

Related Moment IDs

Platform

CTA

Measurement

### 18.3 Marketing Asset Matrix

Document: Just One KISS - Marketing Asset MatrixTimeline status: GENERAL and timeline-specific

Purpose:

Connect marketing assets to either general presentation needs or specific show moments.

Suggested fields:

Asset

Platform

Timeline Moment ID

Source Footage Needed

Format

CTA

Status

Examples of asset types:

Costume reveal reel.

Projection teaser.

Lighting cue teaser.

Strobe moment teaser.

Full-show trailer.

Booking trailer.

Venue recap.

Behind-the-scenes clip.

Website hero video.

YouTube short.

Instagram reel.

Facebook event video.

Google ad creative.

### 18.4 Facebook and Instagram Plan

Document: Just One KISS - Facebook Instagram PlanTimeline status: GENERAL with Moment ID links

Content buckets:

Costume reveals.

Lighting clips.

Projection clips.

Rehearsal clips.

Performance moments.

Booking calls.

Venue announcements.

Behind-the-scenes.

Fan engagement.

Post-show recaps.

Every post should be marked either:

GENERAL

or assigned to a Timeline Moment ID.

### 18.5 Google Ads Plan

Document: Just One KISS - Google Ads PlanTimeline status: GENERAL

Include:

Campaign goals.

Search keywords.

Negative keywords.

Landing pages.

Ad copy bank.

Conversion tracking.

Budget tracker.

Test log.

Content review.

### 18.6 YouTube Plan

Document: Just One KISS - YouTube PlanTimeline status: GENERAL with Moment ID links

Video categories:

Promo trailer.

Booking trailer.

Costume reveals.

Projection demos.

Lighting demos.

Rehearsal clips.

Performance clips.

Venue recaps.

Shorts.

Behind-the-scenes.

Each video should include:

Video

Timeline Moment ID

Purpose

Source Footage

Title

Thumbnail

CTA

Status

## 19. Sales and booking documents

### 19.1 Booking One-Sheet

Document: Just One KISS - Booking One SheetTimeline status: GENERAL

Sections:

Show name.

One-sentence pitch.

Show description.

Show length options.

Personnel.

Production highlights.

Lighting/projection/fog/strobe summary.

Venue fit.

Video link.

Contact.

Tribute disclaimer.

### 19.2 Electronic Press Kit

Document: Just One KISS - EPKTimeline status: GENERAL

Include:

About the show.

About the performer.

Photos.

Videos.

Show options.

Technical requirements.

Stage plot.

Testimonials.

Contact.

Disclaimer.

### 19.3 Technical Rider

Document: Just One KISS - Technical RiderTimeline status: GENERAL

Must include:

Personnel.

Stage size.

Power needs.

Sound needs.

Lighting summary.

Projection needs.

Fog machine needs.

Strobe warning and content needs.

Dressing/costume-change area.

Setup time.

Strike time.

Venue restrictions.

Contact info.

## 20. Administrative and tracking documents

### 20.1 Master Task Board

Document: Just One KISS - Master Task BoardTimeline status: GENERAL with Moment ID links

Suggested fields:

Task

Category

Timeline Moment ID

Priority

Owner

Status

Due Date

Notes

### 20.2 Budget Tracker

Document: Just One KISS - Budget TrackerTimeline status: GENERAL with optional Moment ID links

Categories:

Costumes.

Lighting.

Projection.

Video content.

Fog machines.

Strobes.

Sound.

Control hardware.

Website.

Presentation.

Photography.

Video.

Ads.

Printing.

Rehearsal space.

Transport.

Repairs.

Storage.

Content/clearance review.

Insurance.

### 20.3 Booking Tracker

Document: Just One KISS - Booking TrackerTimeline status: GENERAL

Suggested fields:

Venue

Contact

Market

Date Contacted

Status

Follow-Up Date

Offer

Notes

Outcome

## 21. Companion example document policy

Some documents should remain blank templates. Others should have clearly marked arbitrary examples.

Use this label on all examples:

ARBITRARY EXAMPLE ONLY - NOT A FINAL DECISION

Recommended companion examples:

Master Project Bible.

Timeline Moment Registry.

Set Architecture Template.

Costume Inventory.

Lighting Look Book.

Projection Video Cue Plan.

Fog Cue Plan.

Strobe Cue Plan.

Show-Control Run Sheet.

Website Page Inventory.

Sales Funnel Map.

Marketing Calendar.

Physical Asset Inventory.

Digital Asset Inventory.

Do not create arbitrary final examples for:

Final setlist.

Content decisions.

Final content conclusions.

Final pricing.

Final costume designs.

Final public presentation claims.

## 22. Recommended build sequence

Phase 1: Foundation

Create:

Master Project Bible.

Document Index.

Timeline Moment Registry.

Birdseye Project Sequence.

Physical Asset Inventory.

Digital Asset Inventory.

Presentation Bible.

Public Presentation Checklist.

Goal:

Create the project’s central structure and naming system.

Phase 2: Show architecture

Create:

Master Show Architecture.

Song Candidate Matrix.

Set Architecture Template.

Costume Inventory.

Costume-to-Set Map.

Master Transition Map.

Goal:

Design the show before selecting final songs.

Phase 3: Technical integration

Create:

Integrated Show Control Plan.

Lighting Master Plan.

Projection Video Cue Plan.

Fog Cue Plan.

Strobe Cue Plan.

QLC+ Cue Stack Template.

Show-Control Run Sheet.

Emergency Control Sheet.

Goal:

Make all technical elements point to the same timeline moments.

Phase 4: Stage and rehearsal

Create:

Stage Plot Packet.

Performer Blocking Map.

Costume-Change Transition Sheets.

Performer Show Script.

Rehearsal Log.

Stage Reset Checklist.

Post-Show Review Template.

Goal:

Turn the planned timeline into a repeatable streamlined show.

Phase 5: Website and sales system

Create:

Website Strategy.

Website Page Inventory.

Website Copy Templates.

Booking One-Sheet.

EPK.

Technical Rider.

Venue Outreach Templates.

Booking Tracker.

Goal:

Make the show understandable and bookable.

Phase 6: Marketing funnel

Create:

Customer Profiles.

Sales Funnel Map.

Marketing Asset Matrix.

Facebook Instagram Plan.

Google Ads Plan.

YouTube Plan.

Marketing Calendar.

Media Shot Lists.

Goal:

Make the show discoverable, promotable, and measurable.

Phase 7: Launch and refinement

Create:

Soft-launch checklist.

First-performance review.

Audience feedback form.

Venue feedback form.

Improvement tracker.

Updated media assets.

Updated booking packet.

Updated Timeline Moment Registry.

Goal:

Improve the show after real performances.

## 23. Final organizing rule

Every item in the project must answer one question:

Is this tied to a specific moment in the show timeline?

If yes, assign a Timeline Moment ID.

If no, mark it GENERAL.

This rule applies to:

Songs.

Sets.

Costumes.

Lighting cues.

Projection videos.

Fog cues.

Strobe cues.

Show-control actions.

Performer blocking.

Stage plots.

Rehearsal notes.

Marketing clips.

Website media.

YouTube videos.

Social posts.

Booking assets.

Physical inventory.

Digital inventory.

Post-show reviews.

---

## Machine-Readable SSOT Companion

This human-readable document has a paired SSOT JSON companion at `docs/ssot/mastergameplan.json`. That JSON file is the stable machine-readable seed for website prototypes, owner-admin views, generated checklists, booking materials, marketing materials, and future production data files.

Use the SSOT companion when building software or structured outputs so facts can be reused across multiple website styles without being retyped, forked, or lost. When this document changes, update `docs/ssot/mastergameplan.json` and `docs/ssot/master_index.json` in the same change.
