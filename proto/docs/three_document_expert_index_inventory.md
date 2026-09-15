# Expert Index and Inventory for the Three Site Reports

**Prepared:** 2026-09-14  
**Purpose:** give a fresh expert coding LLM a compact map of every subject in the three reports, the authority of each report, and the precise section to consult before changing the Just One KISS public site  
**Companion synthesis:** `proto/docs/three_document_high_level_overview.md`

---

## Total index

### Document A — implementation and operations

**File:** `proto/docs/public_site_expert_engineering_handoff.md`  
**Length:** 888 lines  
**Use first for:** active runtime, routes, rendering, content systems, forms, persistence, security, deployment, and safe-change procedure

1. Read this first
2. Authority and study order
3. Repository map
4. Local and production runtime
5. Request and rendering lifecycle
   - 5.1 Normal GET
   - 5.2 Output buffer
   - 5.3 Public POST
6. URL and asset helpers
7. Public route inventory
   - Homepage order
   - External integrations
8. Shared presentation components
9. Language/copy subsystem
   - Inline language administration
10. Managed page sections
11. Site Layer Controls
   - State files
   - HTML transformation fragility
   - Critical access-control defect
   - Upload validation defect
12. Admin and owner utilities
   - Hard-coded credentials
   - Preserve Backup
13. Public forms
   - Shared security baseline
   - Lead/update form
   - Inquiry form
   - Missing controls
14. JSON storage mechanics
15. Optional database
16. Mail delivery
17. CSS and visual system
18. JavaScript
19. Images and media
20. Public facts and non-negotiable guardrails
21. Security priority list
   - Critical — block launch
   - High
   - Medium
22. Safe change recipes
   - Change copy
   - Add a route
   - Add an image
   - Change a form
   - Change route section markup
23. Recommended architectural evolution
24. Verification playbook
   - Syntax and structured files
   - Manual route smoke
   - Form matrix
   - Visual/accessibility matrix
   - Existing generic script caveat
25. Definition of done for future work
26. Immediate questions for the owner before substantive development
27. Readiness statement

### Document B — screenshot and visual engineering evidence

**File:** `proto/docs/currsite_visual_engineering_report.md`  
**Length:** 383 lines  
**Use first for:** screenshot mapping, page composition, visual language, responsive expectations, accessibility, performance, and regression review

1. Purpose and evidence boundary
2. Capture-set facts
   - Reconstructed page groups
3. Individual screenshot descriptions
   - 3.1 Landing page — screenshots 1–7
   - 3.2 Free Show page — screenshots 8–13
   - 3.3 The Ritual page — screenshots 14–18
   - 3.4 Spectacle page — screenshots 19–22
   - 3.5 Directions page — screenshots 23–26
   - 3.6 FAQ page — screenshots 27–30
   - 3.7 Contact page — screenshots 31–35
4. Overall visual system
   - 4.1 Brand vocabulary
   - 4.2 Emotional structure
   - 4.3 Layout grammar
5. Implementation correlation
   - 5.1 Active runtime
   - 5.2 Route-to-capture mapping
   - 5.3 Approved image assets
   - 5.4 CSS design tokens
   - 5.5 Responsive behavior observed in code
   - 5.6 Client-side behaviors
6. Engineering findings inferred from the visual baseline
   - 6.1 Screenshot/source drift risks
   - 6.2 Accessibility considerations
   - 6.3 Performance considerations
   - 6.4 Layout and maintainability considerations
   - 6.5 Forms, privacy, and security
   - 6.6 Legal/content integrity
7. Recommended workflow for a coding LLM
8. Visual regression checklist
9. Suggested automated and manual checks
10. Overall assessment

### Document C — historical server architecture snapshot

**File:** `SITE_ARCHITECTURE_REPORT_20260914_150852.txt`  
**Length:** 4,183 lines  
**Use first for:** historical server contents, file discovery, old deployment residue, file sizes, hashes, manifests, entrypoints, and dependency clues

1. Host / tooling
2. Git status
3. Directory / file map
4. File counts / extensions
5. Largest files
6. SHA-256 file manifest
7. Important project / deployment files
8. Contents of safe high-value manifests / configs
   - `cam/composer.json`
   - `proto/public/composer.json`
   - `proto/public/test/composer.json`
   - vendored PHPMailer `composer.json`
9. Environment variable names only
10. Likely entrypoints / routes / pages / middleware
11. Routing / API / server clues
12. Import / dependency clues
13. Environment / config references in source
14. Under-construction / maintenance-mode clues
15. Web / deployment-specific files
16. Possible secret-like filenames

---

## Fast lookup: question to source

| Question | Primary location | Secondary location | Important caution |
| --- | --- | --- | --- |
| Which web root is active? | A §1, §3–4 | B §5.1 | Do not serve `proto/` or trust legacy siblings. |
| Which route file should I edit? | A §7 | B §2, §5.2 | C lists historical and experimental entrypoints too. |
| Why does rendered HTML differ from PHP? | A §5, §9–11 | B §5.1 | Check token, section, and layer state. |
| Where does visible copy originate? | A §9 | B §5.1, §7 | Synchronize JSON canonical copy and PHP fallback. |
| How do managed insertions work? | A §10 | B §5.1, §7 | Current documented state has zero records. |
| How do layer mutations work? | A §11 | B §5.1, §5.3 | Draft state appears public; regex handles are fragile. |
| What pages appear in screenshots? | B §2–3 | A §7 | `/vault/`, `/video/`, `/technical/` lack capture coverage. |
| What visual system should be preserved? | B §4, §6.4, §10 | A §17, §19 | Preserve spectacle plus practical clarity. |
| Which asset maps to a visual? | B §5.3 | A §19 | Layer uploads create a second approval model. |
| Which breakpoints require testing? | B §5.5, §7–8 | A §17, §24 | Desktop captures do not prove mobile quality. |
| What accessibility work remains? | B §6.2, §8 | A §8, §17, §24 | Measure contrast and verify behavior; do not infer. |
| How does the lead form persist? | A §13–14 | B §6.5 | JSON is primary; mail failure does not roll it back. |
| Why can inquiries be lost? | A §13, §21 | B §6.5 | No durable inquiry without PDO in documented default. |
| What DB drift exists? | A §15 | C §3, §6 | Treat UI, whitelist, seed, and ENUM as one migration. |
| What mail system is active? | A §16 | C §8 | Historical Composer/PHPMailer artifacts are not current authority. |
| What blocks launch? | A §11–13, §21 | B §6.5–6.6 | Authentication and authorization issues are critical. |
| Which event facts are protected? | A §20 | B §6.1, §6.6 | Event date is past; never invent a replacement. |
| What did the old server contain? | C §3–8, §10 | A §2–3 | Inventory presence does not equal active dependency. |
| Where are hashes for old files? | C §6 | — | Hashes identify snapshot contents, not current truth. |
| How should a change be verified? | A §22–25 | B §7–9 | Use affected-route, responsive, form, and visual coverage. |

---

## Document A detailed inventory

### Identity, scope, and authority — §§1–2

- Declares itself implementation-backed and scoped to `proto/public/` plus material dependencies.
- Establishes `proto/public/` as the only correct public root.
- Identifies route copies directly beneath `proto/` as legacy.
- Defines the layered render model.
- Warns that the site has persistence, mail, editors, and file-writing utilities.
- Records the audit state: PHP lint and route rendering succeeded, 526 language entries existed, managed sections were empty, layer states were essentially seeds, and the event date had passed.
- Defines the conflict-resolution hierarchy and recommended reading sequence.
- Notes known documentation drift and instructs maintainers to prefer current canon plus observed behavior.

**Consult when:** beginning any task, resolving contradictions, selecting files, or determining whether an older artifact is authoritative.

### Repository and deployment topology — §§3–4

- Maps active routes, shared application modules, admin/editor locations, content-state files, storage, and SQL files.
- Distinguishes public code from utilities outside the document root.
- States that the active marketing runtime itself needs PHP, filesystem access, sessions, and optionally PDO/MySQL and mail transport.
- Gives the local server command and explains directory-index routing.
- Establishes PHP 8.x as the intended baseline.
- Lists production expectations: exact document root, HTTPS, access denial, minimal write permissions, secure cookies, headers, and caching.

**Consult when:** deploying, configuring a server, investigating PHP compatibility, or deciding whether an apparent dependency belongs to this runtime.

### Request lifecycle and URL mechanics — §§5–6

- Describes GET, POST, shared rendering, output buffering, and final transformation.
- Explains that ordinary public requests indirectly load `layer_controls.php`.
- Documents absence of POST/Redirect/GET and form repopulation.
- Explains `public_depth()`, `rel_url()`, `page_url()`, `asset_base_url()`, and `asset_style()`.
- Preserves subdirectory deployment via relative paths.
- Identifies duplicated external and inline CSS/JS, duplicated initialization risk, payload overhead, and CSP difficulty.

**Consult when:** debugging response output, links, nested routes, missing assets, duplicated events, CSP, or form refresh behavior.

### Routes, navigation, integrations, and shared UI — §§7–8

- Inventories all primary and supporting public routes and the redirect.
- Describes the homepage section order and its image assignments.
- Notes compatibility aliases for homepage managed slots.
- Inventories external browser integrations: Google Maps, mail, telephone, and social URL.
- States that no analytics SDK, tag manager, CDN, hosted webfont, or public JS library is active.
- Defines shared header, footer, mobile CTA, event-information block, and conditional footer behavior.
- Identifies existing accessibility strengths and unverified areas.

**Consult when:** adding routes, changing navigation/footer, altering homepage order, adding integrations, or performing accessibility review.

### Copy administration — §9

- Defines the default language file and environment override.
- Explains loader fallbacks and request caching.
- Inventories language metadata and helper escaping contracts.
- Requires canonical JSON and PHP fallback synchronization.
- Explains inline editing, authenticated save endpoint, CSRF, backups, auto-registration, and concurrency risk.

**Consult when:** changing any visible text, adding a token, diagnosing stale copy, or modifying inline administration.

### Managed page sections — §10

- Defines state file and environment override.
- Lists supported types, states, styles, alignments, and widths.
- Explains public filtering, ordering, and image allowlisting.
- Records zero current managed records.
- Identifies two management UIs, shared session state, hard-coded credentials, and backups.

**Consult when:** inserting CMS-like blocks, changing editor behavior, or determining whether a section is hard-coded.

### Site Layer Controls — §11

- Separates this system from managed sections.
- Inventories structure, copy, media, style, behavior, and review capabilities.
- Lists draft, published, snapshot, backup, and custom-write files.
- Exposes the draft-versus-published runtime defect.
- Explains regex/sequence fragility, global replacement risk, CSS-order limitations, and hidden-section behavior.
- Identifies unauthenticated, non-CSRF mutation as a critical blocker.
- Identifies inadequate image validation and decompression limits.

**Consult when:** output differs from templates, sections move or disappear, imagery changes unexpectedly, or any layer/editor endpoint is touched.

### Administrative and backup utilities — §12

- Records plaintext `admin1` / `adminpw` credentials and shared login state.
- Explains why correct document-root configuration currently shields sibling admin directories.
- Documents public backup selection, archive, download, and restore operations.
- Explains why CSRF is not authorization.
- Warns that ignored backups can still be exposed or compromised.

**Consult when:** deploying, authenticating admin tools, changing sessions, handling backups, or reviewing public attack surface.

### Forms and JSON persistence — §§13–14

- Defines common validation: server-side checks, CSRF, honeypot, limits, whitelists, and consent.
- Inventories lead fields, locations, validation, JSON-first persistence, optional DB mirror, notifications, and notices.
- Inventories inquiry fields and the PDO-only persistence defect.
- Lists missing anti-abuse, UX, opt-in, unsubscribe, and privacy lifecycle controls.
- Explains monthly JSON append mechanics, locking, directory creation, decode safety, full rewrites, and limitations.

**Consult when:** changing a form, investigating missing submissions, setting permissions, handling PII, or adding rate limits and lifecycle controls.

### Database and mail — §§15–16

- Describes optional cached PDO connection and suppressed connection failures.
- Lists database tables.
- Documents vocabulary drift among lead tags, seed data, inquiry categories, and SQL ENUM values.
- States that active mail uses PHP `mail()` and that the config mail block is inert.
- Describes error logging and monthly mail-failure records.
- Identifies configuration and secret-handling hazards.
- Lists production mail requirements including SPF, DKIM, DMARC, bounce, suppression, and unsubscribe considerations.

**Consult when:** enabling PDO, changing form vocabulary, configuring mail, investigating delivery, or migrating secrets.

### CSS, JavaScript, and media — §§17–19

- Describes the dark stage, bone/chrome, fire-accent, and purple-vault design system.
- Notes coupling of public and operational CSS.
- Lists responsive QA widths and visual test concerns.
- Inventories public JavaScript responsibilities and in-memory-only tracking.
- Calls for countdown review because the event date passed.
- Lists nine allowlisted WebP assets and distinguishes uploaded layer images.
- States media rights guardrails and performance opportunities.

**Consult when:** making visual changes, adding behavior, changing countdowns, adding images, or optimizing delivery.

### Canonical facts and risk priorities — §§20–21

- Centralizes date, admission, signup, venue, address, phone, camping, electric, parking, safety, and independent-status facts.
- Requires warnings and legal status near conversion points.
- Prioritizes critical, high, and medium security/correctness risks.
- Recommends CSP, nosniff, referrer, permissions, framing, and HSTS headers.

**Consult when:** changing content facts, preparing launch, triaging security work, or defining headers.

### Change recipes and future architecture — §§22–23

- Gives synchronized procedures for copy, routes, images, forms, and section markup.
- Recommends separating public rendering from write-capable administration.
- Recommends centralized auth, published-state enforcement, stable handles, one content model, transactional persistence, durable inquiry storage, real mail abstraction, externalized configuration, single asset-delivery strategy, split CSS, and regression tests.

**Consult when:** planning implementation rather than merely diagnosing the current system.

### Verification, completion, and owner questions — §§24–27

- Supplies PHP lint, JSON parse, CSS brace, local-server, route, form, and visual test recipes.
- Warns that the generic root smoke script does not match the `/proto` app contract.
- Defines a change-specific definition of done.
- Lists owner decisions required before substantive work.
- Ends with an expert-readiness expectation.

**Consult when:** building a work plan, testing a patch, determining completion, or identifying blocked product decisions.

---

## Document B detailed inventory

### Evidence boundary and capture metadata — §§1–2

- Defines the source set as 35 PNG screenshots under repository-root `currsite/`.
- Establishes that they are overlapping scroll captures of seven pages.
- Records uniform 2,878-pixel width, varying height, desktop scrollbars, and likely session order.
- Warns against inferring CSS pixels or responsive breakpoints from bitmap dimensions.
- Maps timestamp groups to Landing, Free Show, The Ritual, Spectacle, Directions, FAQ, and Contact.

**Consult when:** locating the visual reference for a route or deciding what screenshots do and do not prove.

### Screenshot-by-screenshot inventory — §3

#### Landing page — captures 1–7

- Header and performer/portal hero.
- Admission and camping badges, actions, quote, and event details.
- About/proof cards over chrome imagery.
- Update form beside control-table imagery.
- Stage-backed event recap.
- Six-card equipment-case Fan Vault.
- Five practical cards and legal/footer close.

#### Free Show — captures 8–13

- July 25 free-show hero and actions.
- Fiery guitarist portal.
- Four signal/fact cards.
- Family-friendly expectations and safety warning.
- Empty lighting-rig spectacle image.
- Update signup and production-equipment image.
- Practical information and standard footer.

#### The Ritual — captures 14–18

- Backstage control station and figurine tableau.
- Extended control-equipment detail.
- Four-card fan/song/place/memory manifesto.
- Chrome, leather, buckle, and armor close-up.
- Closing anti-lecture statement and practical footer.

#### Spectacle — captures 19–22

- Fog-filled empty-stage hero.
- Three fan-memory cards.
- Four crowd-energy cards and bulb wordmark.
- Show-up conclusion, lighting rig, and footer.

#### Directions — captures 23–26

- Custom mission-control Interlochen map.
- Address card plus conventional embedded map.
- Road, parking, camping, and update cards.
- Packing advice and glowing road-case image.

#### FAQ — captures 27–30

- FAQ hero with road-case visual.
- First eight-question grid.
- Second eight-question grid.
- Short event recap and custom map.

#### Contact — captures 31–35

- Contact hero with candid campground portrait.
- Email, phone, social, and routing cards.
- Update form and portrait repeat.
- Full inquiry form and privacy warning.
- Stage/wordmark conclusion, practical cards, and footer.

**Consult when:** reproducing page sequence, image placement, composition, or screenshot parity.

### Brand, emotion, and layout — §4

- Inventories palette, materials, typography, imagery, panels, cards, and CTA treatment.
- Defines the essential fantasy-versus-community contrast.
- Describes shared header, content rail, headings, section shells, numbered grids, feature imagery, practical block, and footer.

**Consult when:** evaluating whether a new design fits the established identity.

### Runtime and asset correlation — §5

- Restates the active PHP render model and legacy-file distinction.
- Maps each capture group to its active template.
- Maps nine named WebPs to visual roles.
- Warns that layer uploads can supersede hard-coded image assumptions.
- Records approximate CSS tokens, 1,180-pixel maximum, and local fonts.
- Lists responsive breakpoints and desktop-evidence limitations.
- Inventories navigation, tracking, countdown, form, editor, and Fan Vault behaviors not validated by screenshots.

**Consult when:** translating visual evidence into code and assets.

### Drift, accessibility, performance, and maintainability — §6

- Identifies historical parking-copy contradictions and the expired event date.
- Evaluates display-font readability, heading wrapping, focus, contrast, semantic warnings, forms, maps, alt text, and reduced motion.
- Distinguishes documentation PNGs from production media.
- Recommends responsive imagery, dimensions, loading strategy, font optimization, and GPU profiling.
- Recommends extending shared primitives, centralizing facts, respecting the content rail, and managing cutout stacking and focal custom properties.
- Connects visual work to PII, mail, rate limiting, privacy, authorization, cookies, and headers.
- Separates independent-tribute language from actual asset-rights permission.

**Consult when:** reviewing design quality beyond superficial screenshot matching.

### Workflow and regression coverage — §§7–10

- Gives the expert reading and implementation sequence.
- Lists visual comparison points for header, typography, shells, images, grids, controls, copy, cutouts, warnings, map, forms, footer, and overflow.
- Provides syntax, repository validation, unit-test, local-server, and fact-search commands.
- Adds `/vault/`, `/video/`, and `/technical/` to manual coverage despite their absence from screenshots.
- Concludes that semantic hierarchy, truthful facts, accessibility, responsiveness, focal control, and safe operations must accompany the visual personality.

**Consult when:** preparing or reviewing any perceptible change.

---

## Document C detailed inventory

### Nature and limitations

- Generated on 2026-09-14 at 15:08:52-04:00.
- Scanned `/home/sitkaotw/justonekiss.org`.
- Reported that the scanned root was not itself a Git working tree.
- Is primarily machine-generated inventory rather than interpretation.
- Contains paths from a historical host that may be absent, moved, ignored, or intentionally removed in the current repository.

**Consult when:** conducting archaeology or comparing a deployment snapshot with the repository. Do not use it alone to establish active behavior.

### Host and tooling — §§1–2

- Linux 4.18 host.
- Bash 4.4.20.
- Git 2.48.2.
- Python 3.6.8.
- PHP 8.3.33 CLI.
- Composer 2.10.2.
- Ruby 2.5.9.
- Root not recognized as a Git working tree.

**Consult when:** reproducing the old host or explaining environment-specific behavior.

### Complete directory map — §3

The bulk of the report enumerates the scanned filesystem. Major families include:

- root construction asset and landing entrypoint;
- `bobl/` bobblehead experiment;
- `cam/` ONVIF/RTSP camera capability tool;
- `coll/` collected architecture, language, images, and styling;
- `fire/` effect prototypes;
- `owner/` owner knowledge and control application;
- `proto/` active, legacy, staged, administrative, marketing, stage-control, data, docs, storage, and archive material;
- `sign/` multiple signage iterations;
- `staged/` additional stage-control application copies.

Within `proto/`, the map exposes:

- active and legacy marketing routes;
- admin/editor and layer-control files;
- fixture/global/profile JSON data;
- numerous documentation and backup files;
- many layer-upload images;
- stage photos;
- Composer/vendor artifacts;
- diagnostics and tests;
- nested staging trees;
- archives and an embedded `.git` directory.

**Consult when:** locating a historical filename, duplicate, archive, upload, test tool, or staging copy.

### Counts, sizes, and hashes — §§4–6

- Counts 1,360 files by extension.
- Shows JSON and PHP as the dominant recognized extensions.
- Lists large archives, Git objects, uploads, production assets, and duplicated collection files by byte size.
- Provides a SHA-256 manifest for snapshot identity and duplicate comparison.

**Consult when:** prioritizing cleanup, locating storage bloat, proving snapshot identity, or detecting duplicated binaries.

### Deployment and manifest evidence — §§7–8

- Lists `.htaccess`, README, Composer, lock, storage, and related deployment files.
- Captures selected safe manifest contents.
- Shows the camera lab requires PHP 8.2 plus OpenSSL and JSON.
- Shows a historical `proto/public/composer.json` describing a “September 26” landing page with PHPMailer.
- Captures vendored PHPMailer package metadata.

**Consult when:** examining old dependency or deployment claims. Cross-check against Document A before applying conclusions to the active marketing runtime.

### Environment, entrypoints, and dependency clues — §§9–14

- The environment-variable-name section contains no reported names.
- Enumerates likely entrypoints across all application families.
- The routing/server-clue section contains no reported matches.
- Shows Three.js and local ES-module imports in stage/staged code.
- Shows Python imports in marketing validation tooling and documentation examples.
- The environment/config-reference section contains no reported matches.
- The maintenance search is largely populated by stage-fixture maintenance terminology, not website maintenance-mode proof.

**Consult when:** locating an old entrypoint or dependency. Interpret search output in its application context.

### Deployment-specific and secret-filename scan — §§15–16

- Lists deployment-specific `.htaccess` and manifest files.
- Reports no possible secret-like filenames.
- The empty secret-filename result is only a filename-heuristic outcome; it is not a content-level secret audit.

**Consult when:** starting a deployment or secret review, not when attempting to conclude one is complete.

---

## Cross-document reconciliation notes

### Active runtime versus historical dependency artifacts

Document A states that the active marketing runtime does not require Composer, a framework, or a front-end dependency and that mail uses PHP `mail()`. Document C records historical Composer, vendor, and PHPMailer files. Treat those as old or adjacent deployment artifacts unless active code proves otherwise.

### Active source versus screenshots

Document B explicitly treats screenshots as visual evidence rather than byte-for-byte runtime truth. If text, imagery, or structure differs, inspect the active template, language JSON, managed sections, and layer state before deciding which artifact is stale.

### Active public root versus historical filesystem breadth

Document C inventories many entrypoints, but Document A restricts the active public root to `proto/public/`. Presence in the server tree does not confer public or production status.

### Repeated facts versus centralized truth

The screenshots deliberately repeat operational information, while both expert reports warn that duplicated source text can drift. Preserve visual repetition but centralize the underlying facts when architecture work permits.

### Published content versus draft layer state

Managed sections honor published status, but Site Layer Controls appear to feed public rendering from draft state. Do not assume the word “publish” has consistent meaning across these two systems.

### Rights versus repository presence

An image appearing in a screenshot, allowlist, upload folder, archive, or collection does not establish approval or legal rights. Technical availability and rights provenance are separate questions.

---

## Minimum briefing checklist for a new expert coding session

Before editing, the session should be able to answer:

- What is the correct public document root?
- Which route and shared modules produce the affected page?
- Does visible copy come from JSON, PHP fallback, or a layer mutation?
- Could a managed section or draft layer state alter the output?
- Which screenshot group is relevant, and what does it fail to prove?
- Which existing component and design tokens should be reused?
- Which event, venue, price, parking, safety, or legal facts are implicated?
- Does the change touch PII, persistence, mail, uploads, authentication, backups, or writes?
- Which desktop, responsive, accessibility, and no-JavaScript states require testing?
- Is an apparent dependency current, legacy, staged, or merely present in the historical server inventory?

If any answer is unclear, consult the fast-lookup table above and then the identified source section before changing code.

