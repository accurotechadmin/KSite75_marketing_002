# Just One KISS — Website SSOT Canon

## Document control
| Field | Value |
| --- | --- |
| Owner | Both; performer validates fan tone and public promise, show-control system validates implementation, safety, and feasibility |
| Classification | `GEN` |
| Status | Current active website canon |
| Maturity level | 3 — Operational draft |
| Last updated | 2026-07-09 |
| Next action | Keep this file synchronized whenever homepage sections, event facts, route jobs, form behavior, or launch blockers change. |
| Completion criteria | A future session can identify the active app, homepage section truth, public event claims, form workflow, and immediate launch blockers without reading historical prototypes first. |

## Active app canon
| Topic | Canon truth |
| --- | --- |
| Active website | `proto/` is the active standalone public-facing vanilla PHP website, with `proto/public/` as the document root. |
| Active homepage | `proto/public/index.php`. |
| Supporting routes | `proto/public/*/index.php`. |
| Shared rendering/data/forms | `proto/app/view.php`, `proto/app/site_data.php`, `proto/app/forms/lead_submit.php`, `proto/app/forms/inquiry_submit.php`. |
| Styles/enhancement | `proto/public/assets/css/site.css`, `proto/public/assets/js/site.js`. |
| Historical layer | `site/proto/` is provenance/influence only unless explicitly requested. |

## Homepage section canon
| Section | Current public job | Background/image truth | Notes |
| --- | --- | --- | --- |
| Hero | Announce the free September 26, 2026 at 7:30 PM show and drive updates/directions. | `trailer-poster-stage-portal.webp` | Keep event facts as real text. |
| Event details | Make free admission and camping costs clear. | `spectacle-lighting-rig.webp` | Show admission is free. Camping is $10 per night per person for one night before and one night after the show; electric hookup is $35 per person. |
| About the show | Deliver audacious fan-facing spectacle proof. | `costume-chrome-detail.webp` | Cards 1, 2, and 4 are fan-spectacle copy; card 3 remains “One controlled blast.” |
| Join the rally | Capture update-list leads with consent. | `gear-control-dossier.webp` | Consent row should be visually compact and aligned. DB must remain optional. |
| Final CTA | Repeat September 26, free show, Cycle Moore Legacy, Interlochen on US 31. | `fog-strobe-atmosphere.webp` | Keep practical safety support in surrounding page/footer. |
| Fan Vault | Road-case fan-interaction hub for targeted posts, fan media, arrival tips, Q&A, chats, routing, and useful crowd notes. | `road-case-vault-bg.webp` | Six cards only; no Stage FX card. Layout target is two rows by three columns on desktop and it remains the final homepage section before the shared footer area. |

## Supporting-page image policy

The homepage displays approved generated image backgrounds. Supporting routes now render approved existing image assets instead of visible image placeholder/prompt blocks; the removed placeholder inventory is preserved in `proto/docs/image_placeholder_eradication_report.md`. Future route-specific image ideas remain planning references until generated, reviewed, and intentionally approved for public use.

## Shared public blocks

| Block | Canon truth |
| --- | --- |
| Event information | A shared language-tokenized Event information card grid renders at the bottom of every public route immediately above the shared footer. It carries admission, location/parking, camping, fog/strobe, and event facts so supporting pages do not duplicate that generic grid near the top. |

## Public copy and claims checklist
| Claim area | Approved public wording/status | Guardrail |
| --- | --- | --- |
| Date | September 26, 2026 at 7:30 PM. | Update only with verified newer event facts. |
| Admission | The show is free; no ticket required; RSVP/update-list is appreciated where stated. | Do not imply paid admission for the show. |
| Camping | Camping is $10 per night per person for one night before and one night after the show; electric hookup is $35 per person. | Do not invent detailed campground policy beyond this without verification. |
| Location | Cycle Moore Legacy, 11075 US 31 South, Interlochen, MI 49643. | Keep as selectable/readable text. |
| Parking | Parking is outside the gate; overflow and handicap parking available. | Do not invent traffic-control details. |
| Safety | Loud sound, bright lights, fog, flashing patterns/strobe-style looks may be used. | Keep warnings visible near conversion points and footer. |
| Public presentation | Keep copy focused on the performer, event details, fan experience, and practical visitor information. | Do not expose internal review language in audience-facing copy. |

## Contact and form workflow
| Form | Fields/behavior | Canon status |
| --- | --- | --- |
| Lead/update form | Email, city/ZIP, optional interest tags, required consent, honeypot, CSRF. | Validates server-side; writes a JSON record under `proto/storage/leads/`, optionally mirrors to DB when configured, then sends owner and visitor emails after JSON storage succeeds. |
| Inquiry/contact form | Email, organization/location, category, message, optional details, required consent, honeypot, CSRF. | Validates server-side; stores only when DB is configured; otherwise graceful local fallback. |
| Notifications | `proto/app/mailer.php` uses PHP mail for update-list owner notifications and visitor confirmations; default owner destination is `emaildustin@usa.com`; failed mail handoffs are written to PHP `error_log()`, recorded under `proto/storage/mail-failures/`, surfaced as an error-style form notice, and mirrored to the browser console by `site.js`. | Configure server mail transport and final `mail_from` before relying on production delivery; do not promise instant replies. |

## Supporting page canon
| Route | Current public job |
| --- | --- |
| `/september-26-2026/` | Complete Free Show page for verified event facts, camping cost separation, parking, safety, and update-list conversion. |
| `/what-is-just-one-kiss/` | Complete Ritual page describing the Gene Simmons tribute experience from fan love and passion while preserving the approved live-production stage-and-lighting baseline. |
| `/spectacle/` | Complete capability-oriented Spectacle page presenting the cue-driven, travel-minded show package and Cycle Moore Legacy pavilion/campground appeal through subtle venue-attractive public copy. |
| `/directions/` | Complete arrival page with Cycle Moore Legacy address, phone, Google Maps outbound link, embedded zoom/pan map, camping, parking, and access-routing notes. |
| `/faq-disclaimer/` | Complete FAQ/safety/practical-info page with practical answers and a few deliberately outrageous fan-facing questions kept public-ready. |
| `/contact/` | Complete contact route with update form, inquiry form, editable email/Facebook routing values, location phone, and routing for fan, press, media, access, safety, technical, and location questions. |

## Launch readiness tracker
| Area | Current status | Next action |
| --- | --- | --- |
| PHP syntax | Must be checked after edits. | Run `find proto -name '*.php' -print0 | xargs -0 -n1 php -l`. |
| Route smoke | Must be checked after route/homepage edits. | Serve with PHP built-in server and curl key routes. |
| Visual layout | Homepage Fan Vault and consent row changed. | Review desktop/mobile screenshot where tooling is available. |
| Database | Schema/seed still need MySQL/MariaDB import verification. | Test in a DB-enabled environment before launch. |
| Privacy/contact | Consent language exists; update-list destination is configured, but privacy/retention policy and production mail transport remain launch-sensitive. | Approve privacy, retention, and mail-server settings before public launch. |
| Venue/safety | Fog/strobe/access/camping/direction details must stay reviewed or caveated. | Confirm any details not already verified before launch. |

## Decision log
| Date | Decision | Reversal trigger |
| --- | --- | --- |
| 2026-07-09 | Active app is `proto/`; `proto/public/` is the document root for the standalone public site. | User explicitly asks to revive or rebuild from `site/proto/`. |
| 2026-07-09 | Homepage public gallery remains deleted; assets are used as backgrounds. | User explicitly requests a public gallery return. |
| 2026-07-09 | Homepage Fan Vault uses six cards in a desktop two-row/three-column layout and does not include the Stage FX card. | User asks to restore Stage FX or change the Fan Vault route mix. |
| 2026-07-09 | Event details must distinguish free show admission from paid camping: $10 per night per person for one night before and one night after the show; electric hookup is $35 per person. | Venue/user supplies newer verified pricing or policy. |
| 2026-07-22 | Supporting pages no longer expose visible image placeholder/prompt blocks; they reuse approved existing assets and preserve the removed placeholder list in `proto/docs/image_placeholder_eradication_report.md`. | User approves new route-specific `.webp` images for public use. |
