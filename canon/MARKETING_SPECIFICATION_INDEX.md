# Just One KISS — Authoritative Marketing Specification Index

**Document purpose:** Central directory of the repository sources that govern how public marketing is planned, written, designed, produced, reviewed, released, measured, and retired.  
**Classification:** `GEN` / GENERAL / NOT TIMELINE-SPECIFIC  
**Index status:** Navigational authority index; it points to controlling sources but does not replace them.  
**Prepared:** 2026-09-15  
**Scope:** Website, social, paid media, print, email, press/booking, imagery, video/audio planning, audience capture, community submissions, measurement, and release operations.

---

## 1. Read This First: Authority Is Layered

No single file governs every marketing decision. Authority is domain-specific, and the most specific current controlled source wins within its domain.

Use this precedence:

1. **Explicit current owner instruction** controls the decision it addresses.
2. **Current campaign canon and synchronized fact record** control event-specific facts, offers, dates, destinations, holds, and campaign approvals.
3. **An immutable release record/manifest** controls the exact piece that was approved and published.
4. **Evergreen brand canon** controls identity, positioning, personality, visual DNA, voice, independence, rights posture, and durable story.
5. **Public website canon and language tokens** control the active `/proto/public` route system and exact runtime-backed website copy.
6. **Discipline specifications** control audience strategy, channel adaptation, production, accessibility, safety, privacy, rights, naming, review, and measurement.
7. **Active code and assets** are implementation evidence. They demonstrate what exists but do not create policy or approval.
8. **Inventories, reports, prompts, prototypes, screenshots, draft registers, and historical copies** are guidance or provenance only unless a controlling source explicitly promotes them.

When sources disagree, **stop the affected work**. Do not resolve a conflict by convenience, file recency, or visual preference. Apply the most conservative rights, safety, privacy, accessibility, affiliation, and approval restriction until the proper owner reconciles the controlling sources.

---

## 2. Minimum Required Reading for Any Marketing Assignment

Read these before creating public-facing work:

| Order | Source | Controlling job |
| ---: | --- | --- |
| 1 | [`README.md`](../README.md) | Repository hierarchy, cross-document rules, public posture, and domain authority. |
| 2 | [`marketing/canon/BRAND_CANON.md`](../marketing/canon/BRAND_CANON.md) + [`BRAND_CANON.json`](../marketing/canon/BRAND_CANON.json) | Portable evergreen brand authority. The Markdown and JSON must remain synchronized. |
| 3 | [`marketing/LAB_CHARTER.md`](../marketing/LAB_CHARTER.md) | Campaign authority model, status vocabulary, roles, separation of canon/campaign/piece/release/learning, and definition of done. |
| 4 | **The active campaign canon and fact record** | The event-specific truth. For the current September campaign, use [`sept26/MARKETING_CAMPAIGN_CANON.md`](../sept26/MARKETING_CAMPAIGN_CANON.md) with [`sept26/campaign_facts.json`](../sept26/campaign_facts.json). It is currently a controlled internal draft and explicitly holds unresolved public claims. |
| 5 | [`proto/docs/website_ssot.md`](../proto/docs/website_ssot.md) + [`proto/docs/language.json`](../proto/docs/language.json) | Active public-site routes, page jobs, runtime event claims, forms, image policy, and exact website copy tokens. Do not silently transplant website facts into a different campaign. |
| 6 | [`marketing/operations/PRODUCTION_AND_RELEASE.md`](../marketing/operations/PRODUCTION_AND_RELEASE.md) | Intake-to-expiry gates. Art existing is not approval to publish. |
| 7 | [`center/docs/public_release_gate_policy.md`](../center/docs/public_release_gate_policy.md) | Mandatory release-gate families: rights, safety, privacy, venue, accessibility, copy, media, technical disclosure, and affiliation. |

**Fast rule:** A piece is not releasable unless its identity, facts, proof, assets, rights, safety/accessibility treatment, consent/privacy behavior, destination, exact export, reviewers, approval, schedule, and expiry are all resolved in the appropriate records.

**Session boot aid:** After reading the controlling sources, use [`JUST_ONE_KISS_MARKETING_SESSION_BOOT.md`](JUST_ONE_KISS_MARKETING_SESSION_BOOT.md) to orient a fresh expert marketing/design/coding session. It is a workflow prompt, not independent fact, rights, or release authority.

---

## 3. Discipline-by-Discipline Specification Map

### 3.1 Governance, Authority, and Change Control

| Authority | Source | What it specifies |
| --- | --- | --- |
| Repository authority | [`README.md`](../README.md) | Source-of-truth hierarchy, Timeline Moment ID versus `GEN`, public/internal separation, and update-the-specific-source-first rule. |
| Portable marketing authority | [`marketing/LAB_CHARTER.md`](../marketing/LAB_CHARTER.md) | Campaign precedence, statuses, roles, controlled layers, conflict behavior, and definition of done. |
| Campaign change control | [`sept26/MARKETING_CAMPAIGN_CANON.md`](../sept26/MARKETING_CAMPAIGN_CANON.md) | Campaign-specific precedence, status vocabulary, fact-change protocol, holds, approvals, and public-use rules. |
| Canon synchronization | [`center/docs/canon_sync_policy.md`](../center/docs/canon_sync_policy.md) | Human-readable canon and paired SSOT JSON must change together; runtime seeds are not allowed to overwrite canon. |
| General source conflict policy | [`extract/compendium/00_control_and_governance/source_authority_policy.json`](../extract/compendium/00_control_and_governance/source_authority_policy.json) | Domain-specific precedence, conservative conflict resolution, implementation-versus-policy distinction, and safety override. **Status is review/pending controlled approval**, so use as a conservative governance reference rather than claiming final approval. |
| Marketing package portability | [`marketing/PORTABILITY.md`](../marketing/PORTABILITY.md) | What is self-contained authority inside `marketing/`, what is runtime, and what remains historical provenance. |

### 3.2 Evergreen Brand Identity, Positioning, and Story

| Authority | Source | What it specifies |
| --- | --- | --- |
| Primary evergreen canon | [`marketing/canon/BRAND_CANON.md`](../marketing/canon/BRAND_CANON.md) + [`BRAND_CANON.json`](../marketing/canon/BRAND_CANON.json) | Brand truth, promise, positioning, personality, narrative, black/chrome/fire visual DNA, voice, independence, rights, accessibility, safety, consent, and drift test. |
| Campaign-facing quick reference | [`marketing/canon/CAMPAIGN_CANON.md`](../marketing/canon/CAMPAIGN_CANON.md) | Concise application of the brand promise, creative formula, productive tensions, minimum viable signal, story arcs, and non-negotiable public controls. Subordinate to `BRAND_CANON.*`. |
| Expressive family system | [`marketing/canon/NINE_FAMILY_PLAYBOOK.md`](../marketing/canon/NINE_FAMILY_PLAYBOOK.md) | Nine approved creative argument families, audience questions, signature compositions, CTA modes, risks, and funnel defaults. |
| Brand-to-campaign model | [`marketing/canon/ssot_brand_canon_marketing_campaign_system.md`](../marketing/canon/ssot_brand_canon_marketing_campaign_system.md) | How stable brand truth is translated across audiences without creating inconsistent brands. |
| Repository public style authority | [`docs/styleguide.md`](../docs/styleguide.md) + [`docs/ssot/styleguide.json`](../docs/ssot/styleguide.json) | Public visual, tonal, layout, page-system, and presentation direction in the parent repository. Where older event facts conflict with current campaign canon, the current campaign canon wins. |

### 3.3 Current Campaign Facts, Offers, Claims, and Copy

| Authority | Source | What it specifies |
| --- | --- | --- |
| Current September campaign | [`sept26/MARKETING_CAMPAIGN_CANON.md`](../sept26/MARKETING_CAMPAIGN_CANON.md) | Strategy, verified/unknown facts, placeholders, copy rules, visual direction, channels, rights, safety, accessibility, privacy, measurement, release controls, and explicit holds. |
| Machine-readable campaign facts | [`sept26/campaign_facts.json`](../sept26/campaign_facts.json) | Structured current fact states. Must remain synchronized with the campaign canon; a disagreement is a stop condition. |
| Exact website language | [`proto/docs/language.json`](../proto/docs/language.json) | Runtime-backed labels, headings, CTAs, descriptions, advisories, disclaimers, and metadata for the active website. Use tokens rather than retyping website copy. |
| Website fact and route policy | [`proto/docs/website_ssot.md`](../proto/docs/website_ssot.md) | Active website facts, claims checklist, section jobs, form behavior, and launch blockers. Website facts are not automatically campaign facts. |
| Copy construction | [`marketing/production/CONTENT_AND_ASSET_SYSTEM.md`](../marketing/production/CONTENT_AND_ASSET_SYSTEM.md) | Copy assembly order, mode-specific literal/theatrical boundaries, claim/proof requirements, asset lifecycle, and accessibility/rights considerations. |
| Draft copy inventory | [`marketing/campaigns/COPY_BANK.md`](../marketing/campaigns/COPY_BANK.md) | Reusable draft patterns and variants. It does **not** confer public approval; bind copy to current verified facts and a release record. |

**Critical event-fact rule:** The September canon confirms only the facts at their recorded status. It explicitly prohibits silently inheriting July 25 venue, location, pricing, camping, parking, phone, or form behavior. A website token being live does not make it valid for a different event campaign.

### 3.4 Visual Identity, Art Direction, and Website Fidelity

| Authority | Source | What it specifies |
| --- | --- | --- |
| Brand visual DNA | [`marketing/canon/BRAND_CANON.md`](../marketing/canon/BRAND_CANON.md) | Black/chrome/fire hierarchy, material vocabulary, dominant-center hierarchy, display versus utility typography, and originality boundaries. |
| Active-site experience | [`proto/public/assets/css/site.css`](../proto/public/assets/css/site.css), [`proto/public/index.php`](../proto/public/index.php), and [`proto/public/assets/img/`](../proto/public/assets/img/) | Runtime implementation evidence for palette, typography, spacing, components, responsive behavior, focus/motion treatment, section rhythm, and approved-site visual families. Evidence does not itself clear an asset for every use. |
| Website experiential synthesis | [`docs/website_style_look_feel_ssot_report.md`](../docs/website_style_look_feel_ssot_report.md) | Detailed description of what visitors see, feel, experience, enjoy, and remember, plus translation to other marketing formats. It consolidates authority; it does not independently approve claims or rights. |
| Image engineering index | [`docs/marketing_image_engineering_inventory.md`](../docs/marketing_image_engineering_inventory.md) + [`marketing_image_engineering_inventory.json`](../docs/marketing_image_engineering_inventory.json) | Per-image technical metadata, visual description, duplicate relationships, marketing fitness, rights risks, accessibility notes, and `/proto/public` fidelity rules. |
| Brand/story crosswalk | [`docs/brand_story_style_guide_inventory.md`](../docs/brand_story_style_guide_inventory.md) + paired JSON | Engineering inventory of copy, CSS, routes, sections, claims, and guardrails. It is explicitly an inventory, not a finished style guide. |

The controlling visual sentence is:

> **Black first. Chrome second. Fire third. Mythic scale always. Ordinary never.**

That means hierarchy, not indiscriminate decoration: one dominant visual center, dark rest space, hard chrome proof, concentrated heat, readable facts, one honest action, and original/cleared execution.

### 3.5 Audience, Funnel, Journey, and Campaign Architecture

| Specification | Source | What it specifies |
| --- | --- | --- |
| Required trace chain | [`marketing/expression/MARKETING_EXPRESSION_LAYER.md`](../marketing/expression/MARKETING_EXPRESSION_LAYER.md) | Brand Truth → Narrative → Audience Lens → Funnel Stage → Proposition → Proof → Concept → Asset → Placement → CTA → Destination → Measurement. No blank links. |
| Five-by-five planning contract | [`marketing/expression/FUNNEL_MATRIX.md`](../marketing/expression/FUNNEL_MATRIX.md) | Five motivation lenses across five funnel stages, message job, desired response, and guardrails. |
| Audience needs/journeys | [`marketing/strategy/AUDIENCES_AND_JOURNEYS.md`](../marketing/strategy/AUDIENCES_AND_JOURNEYS.md) | Segment needs, assumptions to avoid, suitable creative families, proof requirements, exclusions, and journey logic. |
| Campaign planning stack | [`marketing/strategy/CAMPAIGN_ARCHITECTURE.md`](../marketing/strategy/CAMPAIGN_ARCHITECTURE.md) | Objective, audience, funnel job, family, proposition, proof, fact overlay, action, destination, measurement, timing, ownership, budget, and expiry. |
| Five audience-lens briefs | [`marketing/campaigns/README.md`](../marketing/campaigns/README.md) and `marketing/campaigns/CAMPAIGN_[A-E]_*.md` | Aspirational, rational, value/convenience, community, and authority/premium translations. All included copy and visuals remain draft demonstration material until released. |

### 3.6 Channels, Placements, Sizes, Crops, and Platform Rules

| Specification | Source | What it specifies |
| --- | --- | --- |
| Channel decision rules | [`marketing/strategy/CHANNEL_PLAYBOOK.md`](../marketing/strategy/CHANNEL_PLAYBOOK.md) | Communication budget, suitable family, production rule, action/destination behavior, and channel-specific risks across web, social, video, search/display, email, print, press, merchandise, and notifications. |
| Living master-format targets | [`marketing/strategy/MEDIA_SPEC_APPENDIX.md`](../marketing/strategy/MEDIA_SPEC_APPENDIX.md) | Planning canvases for 9:16, 4:5, 1:1, 1.91:1, 16:9, 2:3, audio, and video adaptations plus safe-area/export principles. |
| Legacy dimensions reference | [`docs/ssot/ads_specs.md`](../docs/ssot/ads_specs.md) | Platform dimensions, ratios, file types, file sizes, and copy limits. Treat as a planning reference and verify against current official platform documentation immediately before production or spend. |
| Broad still-placement inventory | [`docs/marketing_still_image_inventory.md`](../docs/marketing_still_image_inventory.md) | Cross-platform, website, print, local, venue, press, email, and physical collateral possibilities. Explicitly inventory-only, not approval. |
| Platform prompt packs | [`docs/marketing_image_prompts/`](../docs/marketing_image_prompts/) | Platform-oriented prompt adaptations for Meta, Instagram, Google, YouTube, TikTok, Snapchat, Pinterest, X, Bluesky, and LinkedIn. Prompts do not override current platform rules or canon. |

**Volatility rule:** Platform requirements and advertising policies change. Verify official platform specifications before export, upload, or spend. Recompose from a canonical master; do not blind-crop or treat an old cheat sheet as permanent policy.

### 3.7 Image, Video, Audio, and Generative Production

| Specification | Source | What it specifies |
| --- | --- | --- |
| Asset and copy production system | [`marketing/production/CONTENT_AND_ASSET_SYSTEM.md`](../marketing/production/CONTENT_AND_ASSET_SYSTEM.md) | Content assembly, proof, source/derivative lifecycle, rights state, accessibility, metadata, and deliverable requirements. |
| Canonical masters and names | [`marketing/production/ASSET_NAMING_AND_MASTERS.md`](../marketing/production/ASSET_NAMING_AND_MASTERS.md) | Asset identifier grammar, versions, ratio/duration/locale notation, source-master rules, and prohibition on filenames such as `final`. |
| Generic generation contract | [`docs/marketing_image_prompt_templates/00_shared_template_contract.md`](../docs/marketing_image_prompt_templates/00_shared_template_contract.md) | Required campaign inputs, verified facts, composition, real-text handling, accessibility, rights, safety, negative prompts, variants, and output records. |
| Stage-specific prompt templates | [`docs/marketing_image_prompt_templates/`](../docs/marketing_image_prompt_templates/) | Awareness, interest, consideration, conversion, and retention/nurture prompt structures. Use only after the shared contract. |
| Legacy filled mockup system | [`docs/marketing_image_mockup_specs/`](../docs/marketing_image_mockup_specs/) | Filled five-stage campaign specs, crop logic, alt-text drafts, filenames, and Facebook briefs. These contain legacy July facts and a “polished suit” direction; rebind facts and theme before reuse. |
| Social vector master contract | [`marketing/assets/social/README.md`](../marketing/assets/social/README.md) | Editable 4:5 master roles, derivative ratios, recompose-not-crop rule, controlled text layers, rights posture, and placement-specific alt text. |
| Current asset audit | [`docs/marketing_image_engineering_inventory.md`](../docs/marketing_image_engineering_inventory.md) | Which repository images are runtime benchmarks, concepts, source photos, screenshots, opaque uploads, duplicates, or third-party references. |

Generated work must not contain unreadable pseudo-type, malformed faces/hands/instruments/hardware/cables, copied official marks, exact protected makeup/costume replication, album art, unlicensed fonts, or fake documentary proof. Critical facts remain editable semantic text whenever the medium permits.

### 3.8 Rights, Likeness, Trademark, Affiliation, and Asset Provenance

| Specification | Source | What it specifies |
| --- | --- | --- |
| Non-negotiable brand rights posture | [`marketing/canon/BRAND_CANON.md`](../marketing/canon/BRAND_CANON.md) | Independent-tribute framing; cleared/original imagery, type, music, footage, marks, likenesses, and fan media; no borrowed authority. |
| Release gate | [`center/docs/public_release_gate_policy.md`](../center/docs/public_release_gate_policy.md) | Public blocker for unsupported affiliation/endorsement and review requirements for rights-sensitive materials/effects. |
| Asset intake and rights workflow | [`marketing/production/CONTENT_AND_ASSET_SYSTEM.md`](../marketing/production/CONTENT_AND_ASSET_SYSTEM.md) | Provenance, usage scope, derivative status, recognizable people, marks, fonts, audio, territory, term, channels, and expiry. |
| Rights record template | [`marketing/templates/ASSET_RIGHTS_RECORD_TEMPLATE.md`](../marketing/templates/ASSET_RIGHTS_RECORD_TEMPLATE.md) | Required evidence structure for an asset’s source, permissions, limitations, reviewer, and status. |
| September rights register | [`sept26/rights/ASSET_RIGHTS_REGISTER.csv`](../sept26/rights/ASSET_RIGHTS_REGISTER.csv) | Campaign-specific working rights ledger. A blank/unknown cell is not clearance. |
| Image-level risk inventory | [`docs/marketing_image_engineering_inventory.json`](../docs/marketing_image_engineering_inventory.json) | File hashes, duplicates, category/status, visual observations, and specific likeness/trademark/source risks. |

Fan submission is not blanket advertising, merchandise, sublicensing, or perpetual-use permission. “In the repository” and “visible on the website” do not mean “cleared for every channel.”

### 3.9 Safety, Effects, Venue Claims, and Technical Disclosure

| Specification | Source | What it specifies |
| --- | --- | --- |
| Public safety gate | [`center/docs/public_release_gate_policy.md`](../center/docs/public_release_gate_policy.md) | Fog, strobe/flashing patterns, bright light, loud sound, projection, blackouts, moving lights, drops, platforms, and other effects remain venue-aware and review-gated. |
| Campaign safety language | [`sept26/MARKETING_CAMPAIGN_CANON.md`](../sept26/MARKETING_CAMPAIGN_CANON.md) | What may be claimed, where warnings belong, unknown/held safety facts, and public versus internal technical detail. |
| Website public advisories | [`proto/docs/website_ssot.md`](../proto/docs/website_ssot.md) + [`proto/docs/language.json`](../proto/docs/language.json) | Exact active-site warnings and their placement near conversion points/footer. |
| Technical fact authority | [`docs/inventory_reference.md`](../docs/inventory_reference.md) | Fixture identity, patch, behavior, and show-control terminology when a marketing capability claim needs technical verification. Do not expose internal control details merely because they are documented. |
| Special-effects planning | [`extract/compendium/03_technical_systems_and_stage/special_effects_cue_and_safety_plan.json`](../extract/compendium/03_technical_systems_and_stage/special_effects_cue_and_safety_plan.json) | Supporting safety/planning evidence; check record status and approval before treating any effect as available or cleared. |

“Fire” normally describes color, light, energy, or metaphor. Never imply literal flame, pyrotechnics, explosions, or a guaranteed effect unless the exact capability, venue permission, safety plan, and public wording are approved.

### 3.10 Accessibility and Inclusive Communication

The controlling requirements are distributed across the brand canon, production system, campaign canon, website implementation, and release gate:

- [`marketing/canon/BRAND_CANON.md`](../marketing/canon/BRAND_CANON.md): semantic text, contrast, focus, alt text, captions, reduced motion, readable hold times, and non-color cues.
- [`marketing/production/CONTENT_AND_ASSET_SYSTEM.md`](../marketing/production/CONTENT_AND_ASSET_SYSTEM.md): asset-level accessibility and content-mode requirements.
- [`marketing/production/CREATIVE_REVIEW_SCORECARD.md`](../marketing/production/CREATIVE_REVIEW_SCORECARD.md): accessibility is a no-zero release criterion.
- [`marketing/operations/PRODUCTION_AND_RELEASE.md`](../marketing/operations/PRODUCTION_AND_RELEASE.md): accessibility review is required before publication.
- [`proto/public/assets/css/site.css`](../proto/public/assets/css/site.css) and [`proto/public/assets/js/site.js`](../proto/public/assets/js/site.js): active implementation evidence for focus, responsive, and reduced-motion behavior.
- [`center/docs/public_release_gate_policy.md`](../center/docs/public_release_gate_policy.md): accessibility is a named release-gate family.

Do **not** treat `extract/compendium/06_brand_content_and_accessibility/accessibility_requirements.json` as approved authority: its section README explicitly labels the compendium section a scaffold with no extracted or approved facts.

### 3.11 Privacy, Consent, Forms, and Community Media

| Specification | Source | What it specifies |
| --- | --- | --- |
| Consent principles | [`marketing/canon/BRAND_CANON.md`](../marketing/canon/BRAND_CANON.md) | Clear collection purpose, consent, response expectations, and no overclaiming reuse rights. |
| Campaign privacy controls | [`sept26/MARKETING_CAMPAIGN_CANON.md`](../sept26/MARKETING_CAMPAIGN_CANON.md) | Pixel/tag, lead capture, retention/deletion, contact, destination, and privacy holds. |
| Website form behavior | [`proto/docs/website_ssot.md`](../proto/docs/website_ssot.md) | Lead/inquiry fields, required consent, storage, mail behavior, fallbacks, and launch-sensitive privacy/mail configuration. |
| Production/release verification | [`marketing/operations/PRODUCTION_AND_RELEASE.md`](../marketing/operations/PRODUCTION_AND_RELEASE.md) | Consent, privacy, destination, tracking, and exact release checks. |
| Contribution rights | [`marketing/production/CONTENT_AND_ASSET_SYSTEM.md`](../marketing/production/CONTENT_AND_ASSET_SYSTEM.md) | Intake, permission scope, moderation, derivative use, and retention for fan/community content. |

No form, tracking pixel, remarketing audience, testimonial, fan image, or community submission may be activated merely because a template or UI exists.

### 3.12 Creative Review, Approval, Release, Expiry, and Archival

| Specification | Source | What it specifies |
| --- | --- | --- |
| Review scorecard | [`marketing/production/CREATIVE_REVIEW_SCORECARD.md`](../marketing/production/CREATIVE_REVIEW_SCORECARD.md) | Fifteen scored criteria; target at least 24/30, with no zero in identity, facts, rights, safety/privacy, accessibility, action, or destination congruence. |
| Production gates | [`marketing/operations/PRODUCTION_AND_RELEASE.md`](../marketing/operations/PRODUCTION_AND_RELEASE.md) | Intake, source lock, brief approval, concept review, production, QA, release approval, scheduling, monitoring, change, expiry, and archival. |
| Release record template | [`marketing/templates/RELEASE_RECORD_TEMPLATE.md`](../marketing/templates/RELEASE_RECORD_TEMPLATE.md) | Immutable exact copy, export checksums, approvals, channel/time, destination, tracking, expiry, and rollback metadata. |
| Piece record template | [`marketing/templates/CAMPAIGN_PIECE_TEMPLATE.md`](../marketing/templates/CAMPAIGN_PIECE_TEMPLATE.md) | One piece’s message, placement, format, assets, variants, CTA, destination, owners, and status. |
| Campaign brief template | [`marketing/templates/CAMPAIGN_BRIEF_TEMPLATE.md`](../marketing/templates/CAMPAIGN_BRIEF_TEMPLATE.md) | Strategy and constraints that must be approved before production. |
| Live working ledgers | [`marketing/registers/`](../marketing/registers/) | Draft/internal campaign, release, and experiment records. Presence in a register is not public approval unless the record state and required evidence say so. |

Never use `final` as the release mechanism. Use a versioned master plus an immutable release ID and checksum. Every time-sensitive piece needs a recheck/expiry rule.

### 3.13 Measurement, Tracking, Testing, and Learning

| Specification | Source | What it specifies |
| --- | --- | --- |
| Measurement system | [`marketing/operations/MEASUREMENT_AND_EXPERIMENTATION.md`](../marketing/operations/MEASUREMENT_AND_EXPERIMENTATION.md) | Stage-specific indicators, diagnostic measures, quality/rights/safety/accessibility guardrails, experiment rules, naming, interpretation, and learning. |
| Trace-to-event model | [`marketing/expression/MARKETING_EXPRESSION_LAYER.md`](../marketing/expression/MARKETING_EXPRESSION_LAYER.md) | Every placement must connect to an action, destination, and measurement event. |
| Experiment record | [`marketing/templates/EXPERIMENT_CARD_TEMPLATE.md`](../marketing/templates/EXPERIMENT_CARD_TEMPLATE.md) | Hypothesis, controlled variable, audience, run conditions, success/stop criteria, observations, and decision. |
| Content calendar | [`marketing/templates/CONTENT_CALENDAR_TEMPLATE.md`](../marketing/templates/CONTENT_CALENDAR_TEMPLATE.md) | Controlled scheduling, dependencies, ownership, channel, release references, and expiry. |

Optimize for the intended audience transition, not vanity engagement. A “winning” variant that creates affiliation confusion, rights exposure, safety misunderstanding, inaccessible delivery, poor-fit inquiries, or low-quality consent is not a win.

### 3.14 Record Schemas and Future Structured SSOT

- [`extract/compendium/90_schemas_and_vocabularies/campaign.schema.json`](../extract/compendium/90_schemas_and_vocabularies/campaign.schema.json) is the schema reference for future governed campaign records.
- [`marketing/campaigns/campaign_system.json`](../marketing/campaigns/campaign_system.json) is the structured five-lens/funnel planning model.
- [`marketing/marketing_lab_manifest.json`](../marketing/marketing_lab_manifest.json) inventories the portable laboratory.
- `extract/compendium/05_assets_media_and_rights/`, `06_brand_content_and_accessibility/`, and `07_marketing_sales_and_booking/` are **future destinations only** where their README files say “SCAFFOLD SECTION — NO EXTRACTED OR APPROVED FACTS.” Their filenames describe intended records, not present authority.

---

## 4. Specifications by Deliverable Type

| Deliverable | Required sources in addition to the minimum reading |
| --- | --- |
| Website or landing page | `proto/docs/website_ssot.md`, `proto/docs/language.json`, active CSS/JS/templates, `CONTENT_AND_ASSET_SYSTEM.md`, release workflow, privacy/accessibility gates. |
| Organic social still/carousel | Brand canon, campaign fact record, family playbook, channel playbook, media appendix, image inventory, rights record, release record. |
| Paid social/display/search | All organic requirements plus current official platform specs/policies, audience/budget approval, destination congruence, tracking/privacy approval, expiry and spend controls. |
| Video/trailer/short | Brand and campaign canon, cleared footage/music/voice/likeness records, captions/transcript, reduced-motion/flash review, readable fact holds, channel specs, release record. |
| Audio/podcast/radio | Brand voice, campaign facts, pronunciation/read script, cleared music/performance/voice, audible disclaimer where required, duration spec, destination and release record. |
| Print/postcard/flyer/poster | Brand/campaign canon, print dimensions/bleed/color/vendor proof, readable factual hierarchy, short URL/verified QR, expiry, disclaimer, asset rights and release record. |
| Billboard/outdoor/signage | One five-second message, verified durable fact/location, extreme-distance legibility, one action, installation/vendor constraints, rights and expiry. |
| Email/SMS/notification | Exact audience permission, sender identity, privacy/consent and unsubscribe behavior, one primary purpose/action, verified facts, destination, send window and suppression/expiry. |
| Press/booking/EPK | Authority-family guidance, verified capability proof, cleared media, direct public contact, technical claims checked against technical authority, and no internal cue/control disclosure. |
| Merchandise | Evergreen identity, item-specific mark/art/font/likeness rights, material/vendor specs, proof, quantities, fulfillment/returns, territory/term, and separate release approval. |
| Fan/community submission | Clear value exchange, submission terms, consent and use scope, moderation, privacy/retention, accessibility, contributor credit preference, and rights record. |

---

## 5. Files Commonly Mistaken for Authority

Do not promote these categories merely because they are detailed or newer:

- **Inventories and synthesis reports:** useful crosswalks, not independent claim/rights approval.
- **Prompt files and expert boot prompts:** workflow aids; they may not create facts or override canon.
- **Prototype posters, SVG concepts, generated imagery, and screenshots:** concept/evidence only until cleared and released.
- **Historical July campaign/mockup files:** contain stale or campaign-specific facts that must not migrate into September work.
- **`secondrendition/`, `thirdrendition/`, `owner/`, `owner_arena_command/`, `center/`, and `proto_prob/` copies or interfaces:** operational/prototype evidence, not automatic public canon.
- **Compendium scaffold sections:** their own README banners state they contain no extracted or approved facts.
- **Draft registers:** a record location is not approval.
- **Runtime implementation:** shows behavior; it cannot establish policy, legal rights, or cross-campaign truth.
- **Third-party reference imagery:** inspiration/provenance only; never assume publication or derivative rights.

---

## 6. Universal Preflight Checklist

Before any public release, answer **yes** to all applicable items:

### Truth and strategy

- [ ] One campaign objective, audience problem, funnel job, lead family, proposition, proof, and action are named.
- [ ] Every volatile fact has a current source, owner, verification time, and recheck/expiry rule.
- [ ] The CTA honestly describes what happens at the destination, and the destination works.
- [ ] No old event fact was inherited without campaign-specific confirmation.

### Brand and creative

- [ ] The work is recognizably Just One KISS, not a generic local-rock flyer or an official-looking imitation.
- [ ] One visual center and one primary action dominate.
- [ ] Black/chrome/fire is used as hierarchy; utility information remains plain and readable.
- [ ] The piece is intentionally recomposed for its placement and safe zones.

### Rights, safety, accessibility, and privacy

- [ ] Image, video, audio, font, logo/mark, performer, photographer, testimonial, fan-media, and derivative rights are recorded for the intended channel, territory, term, and edit.
- [ ] Independent-tribute meaning is clear; no unsupported affiliation, sponsorship, authorization, endorsement, ownership, or clearance is implied.
- [ ] Effect and capability claims are technically true, venue-aware, and approved; required advisories are visible and literal.
- [ ] Semantic text, contrast, focus, alt text, captions/transcript, reduced motion/flash behavior, hold time, reading order, and non-color cues are checked.
- [ ] Data collection, consent, tracking, retention, deletion, contact, opt-out, and fan-contribution permissions are approved and functional.

### Production and release

- [ ] Filename/ID/version follows the canonical master specification and does not rely on `final`.
- [ ] Copy, asset, crop, dimensions, file weight, color, audio level, links, QR, metadata, and responsive/platform previews pass QA.
- [ ] The creative score is at least 24/30 and no protected criterion scores zero.
- [ ] The exact exports and copy are checksummed in an immutable release record with named approvals.
- [ ] Publish time, monitoring owner, stop conditions, rollback, expiry, and archive location are recorded.

---

## 7. Recommended Session Loading Order

For a fresh expert marketing/design/coding LLM session, provide documents in this order:

1. This index.
2. `marketing/canon/BRAND_CANON.md` and `.json`.
3. The active campaign canon and fact JSON.
4. `marketing/LAB_CHARTER.md`.
5. `marketing/expression/MARKETING_EXPRESSION_LAYER.md`.
6. The relevant audience, funnel, family, channel, and deliverable specification.
7. `marketing/production/CONTENT_AND_ASSET_SYSTEM.md` and `ASSET_NAMING_AND_MASTERS.md`.
8. `marketing/operations/PRODUCTION_AND_RELEASE.md` and the review scorecard.
9. For website work, `proto/docs/website_ssot.md`, `proto/docs/language.json`, and the relevant runtime templates/styles.
10. For image work, the Markdown/JSON engineering inventory and the specific approved source assets.
11. The current official platform specification or vendor production specification, verified at production time.
12. The exact campaign/piece/rights/release records for the deliverable.

The session should explicitly state which source controls each fact and which unresolved fields place the work on hold.

---

## 8. Maintenance Rule

Update this index whenever a controlling specification is added, renamed, superseded, or changes status. Update the underlying domain authority first; then update paired structured data, dependent summaries, templates, runtime tokens, and this index. Never use this directory page to conceal a conflict between the actual controlling sources.
