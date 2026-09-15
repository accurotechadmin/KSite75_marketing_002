# Three-Document High-Level Overview

**Prepared:** 2026-09-14  
**Audience:** expert coding LLM sessions, senior engineers, designers, accessibility reviewers, security reviewers, and maintainers  
**Documents synthesized:**

1. `proto/docs/public_site_expert_engineering_handoff.md`
2. `proto/docs/currsite_visual_engineering_report.md`
3. `SITE_ARCHITECTURE_REPORT_20260914_150852.txt`

## Readiness statement

The three documents have been studied as complementary evidence. Together they explain the active public application, its visual baseline, and the larger historical server filesystem in which it existed. They do not have equal authority: the implementation-backed handoff is the current application guide, the visual report is screenshot evidence and design guidance, and the architecture report is a point-in-time server inventory.

An expert coding session should use `three_document_expert_index_inventory.md` as the navigation layer for the source documents and this file as the short conceptual briefing.

## 1. Authority model

Use this precedence when facts disagree:

1. Explicit current owner instruction.
2. Active code and JSON actually read by the active code.
3. `proto/docs/website_ssot.md` for product and content canon.
4. `proto/README.md` for current deployment fundamentals.
5. The implementation-backed engineering handoff.
6. The visual report as screenshot and design evidence.
7. The generated architecture report as historical filesystem evidence.
8. Older inventories, planning documents, staging trees, and legacy route copies.

Never resolve a conflict merely by choosing the largest or oldest document. Establish whether a statement describes the active application, visual intent, or a historical deployment snapshot.

## 2. Active product and runtime

The active public site is a server-rendered, dependency-light PHP application for the Just One KISS event. Its only correct public document root is `proto/public/`. Similarly named routes directly beneath `proto/` are legacy copies.

The effective response is composed from:

```text
PHP route template
  + shared render helpers
  + language.json canonical copy
  + page_sections.json published insertions
  + Site Layer Controls output-buffer mutations
  + site.css and site.js
  = final browser response
```

The final HTML may therefore differ from literal template output. Investigation of unexpected copy, classes, section visibility, order, images, or overlays must include the language file, managed-section state, and Site Layer Controls state.

The application is not static. It includes public forms, session CSRF, JSON storage, optional database persistence, mail handoff, multiple editing systems, uploads, backups, restores, and source/content-writing utilities.

## 3. Public route model

The core navigation and screenshot-supported routes are:

- `/`
- `/july-25-2026/`
- `/what-is-just-one-kiss/`
- `/spectacle/`
- `/directions/`
- `/faq-disclaimer/`
- `/contact/`

Additional public supporting routes are `/vault/`, `/video/`, and `/technical/`. `/contact-press/` permanently redirects to `/contact/`.

Operational routes and endpoints—including `/site-layers/`, `/site-layer-save.php`, and `/preserve-backup/`—are not marketing content and must not be exposed without robust protection.

Relative URL helpers intentionally support subdirectory deployment. A casual conversion to root-relative URLs can break the deployment contract.

## 4. Content and editing systems

### Language tokens

`proto/docs/language.json` is the canonical runtime copy layer, while PHP templates retain fallback strings. Both must be synchronized during copy changes. The handoff recorded 526 unique runtime entries.

### Managed sections

`proto/docs/page_sections.json` supports typed, styled, positioned records with draft, published, and archived status. At the handoff audit point it contained no managed section records, so the visible site was dominated by hard-coded templates.

### Site Layer Controls

This separate system can mutate structure, copy, media, style, behavior, and review metadata after rendering. It can also upload assets and write to content, CSS, and constrained source locations.

The public runtime appears to consume draft state rather than the nominal published state. Publishing therefore is not a reliable promotion boundary. Regex- and sequence-based section discovery is also brittle; section additions or nesting can shift control handles.

## 5. Visual system

The visual report describes 35 wide desktop screenshots that reconstruct seven full page journeys. The screenshots are a baseline, not proof of byte-identical current output and not evidence of mobile success.

The core design contrast is:

1. **Fantasy and spectacle:** black stages, fire, ember gradients, chrome, leather, armor, portals, lighting rigs, fog, control consoles, tactical maps, and poster-like symmetry.
2. **Community and practicality:** admission, parking, camping, maps, forms, contact information, safety warnings, and a candid campground portrait.

The layout uses a black global header, angular branding, a prominent update CTA, oversized display headings, an approximately 1,180-pixel content rail, rounded dark panels, numbered card grids, cinematic feature imagery, and repeated practical event information.

Major responsive transitions occur near 980 and 640 pixels, with additional component rules around 1,180, 1,100, 760, 720, 700, 480, and 360 pixels.

## 6. Event facts that require verification before change

The documents preserve these operational facts:

- Event date: July 25, 2026.
- Admission: free; no ticket required.
- Update-list signup or RSVP: appreciated, not required.
- Venue: Cycle Moore Legacy.
- Address: 11075 US 31 South, Interlochen, MI 49643.
- Public phone: 231-276-9091.
- Camping: $10 per night per person, one night before and one night after.
- Electric hookup: $35 per person.
- Parking: outside the gate; overflow and handicap parking are available.
- Safety: loud sound, bright lights, fog, flashing, and strobe-style patterns may be used.
- Status: independent theatrical tribute with no claimed official affiliation, sponsorship, authorization, endorsement, ownership, or approval.

The advertised date was already in the past when the reports were prepared. A future session must not invent a replacement. It must ask whether the site is archival or obtain a newly verified event date before changing countdowns or campaign copy.

## 7. Forms and persistence

The lead/update form validates email, consent, approved interests, CSRF, length limits, and a honeypot. It stores a monthly JSON record first, optionally mirrors it to a database, and then attempts owner and visitor email. Mail failure does not undo the lead record.

The inquiry form is materially weaker under the default database-disabled configuration: it can validate successfully but does not durably save or send without PDO. This can produce reassuring UI while losing a real inquiry.

Missing controls include rate limiting, idempotency, double opt-in, unsubscribe handling, retention/deletion tooling, POST/Redirect/GET, and safe field repopulation after validation errors.

## 8. Principal security blockers

The three most urgent launch blockers are:

1. `public/site-layer-save.php` exposes write-capable operations without authentication or CSRF enforcement.
2. `public/preserve-backup/index.php` is inside the public root and provides archive/download/restore behavior without authorization; public-form CSRF is not authorization.
3. The admin and editor use checked-in plaintext credentials (`admin1` / `adminpw`).

Other serious concerns include extension-only upload validation, public coupling to the write-capable control layer, tracked/inconsistent configuration, undefined PII governance, missing abuse controls, brittle regex transformations, duplicate JavaScript initialization, and incomplete security headers.

## 9. Accessibility and performance posture

Positive accessibility patterns include semantic headings, a skip link, explicit labels, native controls, map titles, navigation ARIA state, and reduced-motion rules. Formal testing remains necessary for contrast over imagery, keyboard focus, notices, alt text, long-token wrapping, zoom, flashing effects, and editor behavior.

Performance work should address large media, responsive sources, intrinsic dimensions, below-fold lazy loading, font loading, GPU-heavy effects, and duplicate external-plus-inline CSS/JavaScript delivery. JavaScript initialization must be idempotent if dual delivery remains.

## 10. Meaning of the architecture snapshot

The architecture report scanned a non-Git server root containing 1,360 files and many systems beyond the active marketing site: camera tooling, stage and fixture applications, signage and fire experiments, owner tooling, staging copies, vendor dependencies, diagnostics, uploads, archives, embedded Git data, and duplicated media.

It is valuable for historical archaeology, residue discovery, security review, deployment cleanup, and tracing old dependencies. It is not proof that all listed files belong to the active public runtime. For example, it records Composer and PHPMailer artifacts from a differently named September 26 landing page, while the current handoff says the active marketing runtime does not require Composer and its mailer uses PHP `mail()`.

## 11. Working rules for future expert sessions

- Work in active `proto/public/` routes and their actual `proto/app/` and `proto/docs/` dependencies.
- Check active runtime state before trusting screenshots or historical inventories.
- Synchronize token copy and PHP fallbacks.
- Check layer state before diagnosing rendered output.
- Reuse existing design tokens and component primitives.
- Treat form, editor, backup, upload, and mutation changes as security-sensitive.
- Preserve safety, independent-status, venue, price, admission, and parking facts until verified.
- Review section handles after changing `<section>` structure.
- Test relevant routes, responsive widths, keyboard behavior, reduced motion, form outcomes, and no-JavaScript behavior.
- Capture screenshots for perceptible UI changes.
- Never commit PII, secrets, backups, runtime logs, or diagnostics.

## 12. Owner decisions still required

1. Is July 25, 2026 now historical, or is there a verified replacement event?
2. Should update-list capture remain active?
3. Which administrative tools, if any, must exist in production?
4. Should Site Layer Controls be retained, redesigned, or removed?
5. Which durable persistence model is intended for production?
6. Which mail transport and sender domain are approved?
7. What privacy, retention, deletion, unsubscribe, and backup policies apply?
8. Which uploaded assets have documented approval and provenance?
9. Must subdirectory deployment remain supported?

