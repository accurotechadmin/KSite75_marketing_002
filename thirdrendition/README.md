# Third Rendition Owner Command Center

`thirdrendition/` is an owner-actionable command center for Just One KISS. It keeps the vanilla PHP/HTML/CSS/JS stack and bundled read-only SSOT JSON strategy, but the front page now opens directly into the production areas an owner expects: DMX fixtures, cue sheets, run books, project sections, search, source JSON, and record detail pages.

## Run

```bash
php -S 127.0.0.1:8091 -t thirdrendition
```

Open `http://127.0.0.1:8091/?page=dashboard`.

## Owner-facing sections

- **Production Home** gives actionable counts and direct links to the major work areas.
- **DMX Fixtures** gathers only explicit inventory-reference, vendor-manual, DMX patch, fixture, and asset records; cue songs and emergency/run-book records stay out of this list.
- **Cue Sheets** gathers draft set, song, transition, costume, video, lighting, fog, strobe, finale, encore, and post-show timeline records.
- **Run Books** gathers show-control, emergency, website/admin, launch, timeline-governance, and task records without pulling in cue songs by keyword.
- **Project Sections** turns every loaded source JSON file into its own section with record counts, Timeline families, review counts, section drilldown, and raw source access.
- **Find Anything**, **JSON Library**, and **Data Integrity** remain available for full-search, raw JSON visibility, and schema/link checks.

## Data posture

The app reads `thirdrendition/data/ssot/*.json` first and does not edit seed JSON. It keeps public/private, content, safety, Timeline/GEN, and draft-cue warnings visible. Clicking a row or card opens the normalized record detail page with owner summary, gates, linked files, linked records, normalized fields, and original raw record fragment.
