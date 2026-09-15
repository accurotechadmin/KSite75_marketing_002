# Marketing Expression Layer

## Governing principle

> **The brand story stays fixed; the audience translation, proof type, visual grammar, CTA, and media placement change.**

This layer sits directly below the portable Brand Canon. It turns one brand into five audience translations without creating five brands.

## Required trace chain

> **Brand Truth → Narrative → Audience Lens → Funnel Stage → Message Proposition → Proof → Creative Concept → Asset → Placement → CTA → Landing Destination → Measurement Event**

No public piece is complete while a link is blank. Every campaign record stores stable IDs for all twelve nodes.

| Node | Required answer | Controlled source |
| --- | --- | --- |
| Brand Truth | What cannot change? | `canon/BRAND_CANON.*` |
| Narrative | Which chapter of the five-part story is foregrounded? | `canon/BRAND_CANON.*` |
| Audience Lens | Why does this motivation-based audience care? | `campaigns/campaign_system.json` |
| Funnel Stage | What belief or behavior changes next? | `expression/FUNNEL_MATRIX.md` |
| Message Proposition | What single idea should remain? | Campaign brief/piece record |
| Proof | What cleared, observable evidence earns belief? | Asset-rights record |
| Creative Concept | What visual/verbal mechanism carries it? | Campaign brief |
| Asset | Which canonical master contains it? | Asset manifest |
| Placement | Where and under what constraints does it run? | Release record |
| CTA | What honest action is offered? | Piece record |
| Landing Destination | Does the first view fulfill that action? | `site/` route/anchor |
| Measurement Event | What observable event indicates movement? | Measurement plan |

## Invariants and variables

### Fixed across all campaigns

Brand truth, independent posture, promise, worldview, visual DNA, master narrative, rights posture, factual discipline, accessibility standard, and safety/consent meaning.

### Allowed to vary

Audience reason to care, narrative chapter foregrounded, proof object, composition, pacing, typography behavior, CTA wording, placement mix, funnel objective, and measurement event.

## Five lenses

| ID | Lens | Core question | Native expression | Brand-story translation |
| --- | --- | --- | --- | --- |
| `AUD-A` | Aspirational | Who could I become inside this night? | Cinematic/editorial | Enter something larger than ordinary life. |
| `AUD-B` | Rational Evaluator | Why should I believe the promise? | Evidence/information design | Disciplined original craft makes the spectacle credible. |
| `AUD-C` | Value & Convenience | Is the experience clear and easy to approach? | High-energy direct response | Monumental does not have to mean remote or confusing. |
| `AUD-D` | Social / Community | Do people like me belong here? | Creator-native/documentary | The crowd is not background; it completes the ritual. |
| `AUD-E` | Authority / Premium | Is this a thoughtful, credible choice? | Restrained premium dossier | Spectacle is backed by preparation and original intent. |

## Drift prevention

- A lens may emphasize but never contradict another lens.
- A campaign-specific proposition must map to an approved claim or be held for verification.
- Proof is evidence, not decoration. Placeholder proof must be visibly labeled and cannot ship.
- Every CTA has exactly one matching destination and one primary measurement event.
- Stage 5 cleared stories may become Stage 1–3 proof only when permission scope allows it.
- Learning flows into an experiment record first; it does not automatically modify canon.

## Example trace

`BT-01 → NAR-04 → AUD-D → S01 → PROP-D01 → PROOF-D01 → CON-D01 → JOK_AUD-D_S01_C01_STILL_4x5_V01.svg → META_FEED → JOIN → /site/?lens=D#signal → start_signal_form`

The included site uses a non-submitting demonstration form. A production release must connect an approved consented endpoint before a completion event is enabled.
