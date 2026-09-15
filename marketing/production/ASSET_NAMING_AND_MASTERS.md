# Asset Naming and Canonical Masters

## Identifier

`JOK_AUD-[A-E]_S[01-05]_C[01-99]_[TYPE]_[RATIO]_[DURATION]_[LOCALE]_V[NN].[ext]`

Examples:

- `JOK_AUD-D_S01_C01_VIDEO_9x16_15S_EN-US_V01.mp4`
- `JOK_AUD-B_S02_C02_CAROUSEL_1x1_NA_EN-US_V03.pdf`
- `JOK_AUD-A_S01_C01_STILL_4x5_V01.svg`

Use `NA` for duration only when a fixed slot is required. Never use “final”; the immutable release ID identifies what shipped.

## Universal visual kit

Create 9:16, 4:5, 1:1, 16:9, 1.91:1, and 2:3 only when the channel plan needs them. Create :06, :15, and :30 motion plus :15 and :30 audio from source material designed for those adaptations.

## Production model

> **Story component → canonical master → placement adaptation**

The master contains controlled live typography, crop/safe-zone guides, source asset links, proof ID, alt-text draft, and rights ID. Placement adaptation may recompose but may not silently change facts, disclaimer meaning, advisory meaning, CTA, or destination.

## Included concept masters

The five SVG files in `../assets/social/` are original 1080×1350 / 4:5 editable concept masters. They demonstrate distinct lens grammars without external images. They are not proof photographs and are not public release packages.
