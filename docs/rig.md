# Just One KISS Rig Quick Reference

This rig is a **single-universe QLC+ / Q Light Controller Plus DMX installation**. Its operating policy is **DMX control only**: avoid standalone, sound-active, master/slave, fixture-run, and IR/remote modes during normal QLC+ operation unless intentionally designed into a cue.

## Source confidence

Highest authority is the local rig reference document, then the active QLC+ workspace/fixture definitions when available and verified, then manufacturer manuals, then bench testing. The reference specifically says the bracketed QLC+ numbers such as `Honeycomb [26]` or `Rotator [42]` are fixture IDs/name suffixes, **not** DMX start addresses.

Honeycomb behavior should be treated as coming from the local reference and the B262-style fixture definition; do not override the local patch sheet with sparse or incomplete extracted PDF text without bench testing.

## Rig inventory

| Family            |                          Physical device |                            Count |  Footprint | Role                       |
| ----------------- | ---------------------------------------: | -------------------------------: | ---------: | -------------------------- |
| `Bright`          |               Chauvet DJ COLORstrip Mini |                            1 bar |       4 ch | Linear RGB/effect bar      |
| `1 Plug`–`4 Plug` |   4-channel / 8-outlet AC DMX controller | 1 controller / 4 logical outputs |  1 ch each | Switched/dimmed utility AC |
| `Honeycomb`       |      U’King ZQ01082 / B262-style RGB PAR |                               14 |  7 ch each | RGB wash/accent            |
| `K k I i S s Z z` |                       KISS sign channels |                                8 |  1 ch each | Dimmable sign elements     |
| `Spot Portable`   |              Chauvet DJ Freedom Par RGBA |                                8 |  5 ch each | Battery RGBA uplights      |
| `Rotator`         | XPCLEOYZ / 7-lens RGBW moving head class |                                8 | 14 ch each | Moving RGBW wash/effects   |

The current count summary is 1 COLORstrip Mini, 4 plug channels, 14 Honeycombs, 8 KISS dimmer channels, 8 Freedom Par RGBA uplights, and 8 moving heads.

## Universe 1 patch

| Device / family        | DMX range |
| ---------------------- | --------: |
| `Bright 1`–`Bright 4`  |       1–4 |
| `Honeycomb [26]`       |      9–15 |
| `1 Plug`–`4 Plug`      |     21–24 |
| `Honeycomb [27]`       |     33–39 |
| `Honeycomb [30]`       |     49–55 |
| `Honeycomb [28]`       |     57–63 |
| `Honeycomb [32]`       |     65–71 |
| `Honeycomb [31]`       |     73–79 |
| `Honeycomb [29]`       |     81–87 |
| `Honeycomb [33]`       |     89–95 |
| KISS `K k I i S s Z z` |   129–136 |
| `Honeycomb [34]`       |   169–175 |
| `Spot Portable [13]`   |   177–181 |
| `Spot Portable [21]`   |   183–187 |
| `Honeycomb [35]`       |   193–199 |
| `Spot Portable [18]`   |   201–205 |
| `Spot Portable [22]`   |   207–211 |
| `Honeycomb [36]`       |   217–223 |
| `Spot Portable [19]`   |   225–229 |
| `Spot Portable [23]`   |   231–235 |
| `Honeycomb [37]`       |   241–247 |
| `Spot Portable [20]`   |   249–253 |
| `Spot Portable [24]`   |   255–259 |
| `Honeycomb [38]`       |   265–271 |
| `Honeycomb [39]`       |   289–295 |
| `Rotator [42]`         |   297–310 |
| `Rotator [43]`         |   321–334 |
| `Rotator [44]`         |   337–350 |
| `Rotator [45]`         |   361–374 |
| `Rotator [46]`         |   385–398 |
| `Rotator [47]`         |   409–422 |
| `Rotator [48]`         |   441–454 |
| `Rotator [49]`         |   465–478 |

The universe is intentionally spatially organized, not tightly packed. The gaps are normal and should not be “fixed” without updating QLC+, physical labels, patch sheets, and the reference file.

## Programming doctrine

Use **direct color control** as the default. That means setting each family’s mode/setup channels first, then driving RGB/RGBA/RGBW channels directly. The rig-wide convention is: `0 = off`, `127/128 = midpoint`, `255 = full`, with the exception that some speed channels are inverted or mode-dependent.

The canonical direct-control setup is:

| Family                   | Required setup for direct color                                      |
| ------------------------ | -------------------------------------------------------------------- |
| Bright / COLORstrip Mini | CH1 = 210–219; CH2/3/4 = R/G/B                                       |
| Honeycomb                | CH1 dimmer up, CH5 strobe 0, CH6 manual 0–10, CH2/3/4 = R/G/B        |
| Spot Portable            | CH1 = 207–215, commonly 210; CH2/3/4/5 = R/G/B/A                     |
| Rotator                  | CH6 dimmer up; CH8/9/10/11 = R/G/B/W; keep macro/reset channels safe |
| KISS                     | Direct dimmer channel only                                           |
| Plugs                    | 0 or 255 unless the load is approved for dimming                     |

## Fixture behavior

### Bright / Chauvet COLORstrip Mini

`Bright 1`–`Bright 4` are one physical COLORstrip Mini at address 1. CH1 is a mode/effect selector; CH1 value **210–219** enables RGB color mixing, making CH2 red, CH3 green, and CH4 blue. CH1 value **230–255** is sound-active and should normally be avoided.

Useful tests:

| Look     | CH1 | CH2 | CH3 | CH4 |
| -------- | --: | --: | --: | --: |
| Blackout |   0 |   0 |   0 |   0 |
| Red      | 210 | 255 |   0 |   0 |
| Green    | 210 |   0 | 255 |   0 |
| Blue     | 210 |   0 |   0 | 255 |
| White    | 210 | 255 | 255 | 255 |

### Honeycomb / U’King ZQ01082 B262-style PAR

Each Honeycomb fixture is 7 channels: CH1 master dimmer, CH2 red, CH3 green, CH4 blue, CH5 strobe, CH6 effect mode, CH7 hue/speed. For clean QLC+ control, use **CH6 = 0** and **CH5 = 0**. CH6 value **211–255** is sound-control behavior and should normally be avoided.

Useful direct RGB test:

| Look     | CH1 dimmer | CH2 R | CH3 G | CH4 B | CH5 strobe | CH6 mode | CH7 |
| -------- | ---------: | ----: | ----: | ----: | ---------: | -------: | --: |
| Red      |        255 |   255 |     0 |     0 |          0 |        0 |   0 |
| Green    |        255 |     0 |   255 |     0 |          0 |        0 |   0 |
| Blue     |        255 |     0 |     0 |   255 |          0 |        0 |   0 |
| Blackout |          0 |     0 |     0 |     0 |          0 |        0 |   0 |

### Spot Portable / Chauvet Freedom Par RGBA

Each `Spot Portable` is a Chauvet Freedom Par RGBA in **5-channel mode**. Important: CH1 is **not** a master dimmer. CH1 is a function/mode selector. For direct RGBA, set CH1 to **207–215**, commonly 210, then CH2 = red, CH3 = green, CH4 = blue, CH5 = amber.

Avoid CH1 **234–255**, which calls Auto Run / sound-active behavior. The manual also shows that the fixture supports 4CH and 5CH personalities through `SYS > d-CH`, and DMX address through `SYS > SdAd`.

Useful test:

| Look       | CH1 | CH2 R | CH3 G | CH4 B | CH5 A |
| ---------- | --: | ----: | ----: | ----: | ----: |
| Red        | 210 |   255 |     0 |     0 |     0 |
| Amber      | 210 |     0 |     0 |     0 |   255 |
| Warm white | 210 |   255 |   180 |   120 |   180 |
| Blackout   |   0 |     0 |     0 |     0 |     0 |

### Rotator / moving heads

The Rotators are 14-channel moving RGBW wash heads in this showfile. The moving-head manual confirms 9CH and 14CH modes, pan/tilt control, RGBW LEDs, dimmer/strobe behavior, color mixing, auto/sound functions, and reset behavior.

Local QLC+ mapping to treat as current rig authority:

| Relative CH | Function                        |
| ----------: | ------------------------------- |
|           1 | Pan coarse                      |
|           2 | Pan fine                        |
|           3 | Tilt coarse                     |
|           4 | Tilt fine                       |
|           5 | Pan/tilt speed                  |
|           6 | Master dimmer                   |
|           7 | Strobe                          |
|           8 | Red                             |
|           9 | Green                           |
|          10 | Blue                            |
|          11 | White                           |
|          12 | Color macro / color mixing      |
|          13 | Color speed / function behavior |
|          14 | Movement macro / reset          |

The local reference warns that Rotator speed is inverse-style in the working rig notes, with **0 fastest** and **255 slowest**, and that CH14 can contain movement macro/reset behavior, so it should not be swept casually in live cues.

Safe static white test: set CH6 = 255, CH7 = 0, CH11 = 255, CH12 = 0, CH13 = 0, CH14 = 0.

### KISS sign

The KISS sign is eight 1-channel dimmer elements:

| Channel | Meaning        |
| ------: | -------------- |
| 129 `K` | K outer        |
| 130 `k` | K inner        |
| 131 `I` | I outer        |
| 132 `i` | I inner        |
| 133 `S` | first S outer  |
| 134 `s` | first S inner  |
| 135 `Z` | second S outer |
| 136 `z` | second S inner |

`Z/z` intentionally means the second S, named that way for show-control clarity.

### Plug controller

Channels 21–24 are a 4-channel / 8-outlet AC DMX controller, with two physical AC outlets per DMX channel. Treat these as **utility power**, not normal color channels. For motors, power supplies, chargers, foggers, electronics, and fixtures expecting full AC, use only **0 or 255** unless the technical team approves dimming. Keep plug controls isolated from RGB chases.


## Cue draft integration

`docs/cue.txt` is the current working cue and setlist draft. It identifies likely show-control moments such as the opening intro, platform drop, costume-change holds, screen drop, finale, and encore structure. Do **not** program those as final QLC+ functions from this file alone. First migrate each item into `docs/timeline_moment_registry.md`, assign performer/show-control actions, confirm the safety and content status, then build QLC+ functions and run-sheet entries.

Show-control cue records derived from `docs/cue.txt` should include: Timeline Moment ID, trigger line or musical landmark, active lighting scene/chaser, projection state, fog permission, strobe permission, costume-change hold look if applicable, blackout/safe-light fallback, and reset procedure.

## QLC+ operating model

Recommended QLC+ representations:

| Thing            | Best QLC+ representation                                            |
| ---------------- | ------------------------------------------------------------------- |
| COLORstrip Mini  | One 4-channel fixture, or current four named channels               |
| Honeycomb        | U’King/B262-style 7ch fixture                                       |
| Freedom Par RGBA | Chauvet Freedom Par RGBA 5ch profile                                |
| Rotator          | Custom 14ch fixture definition based on local chart and bench tests |
| Plug controller  | Four generic 1-channel intensity fixtures                           |
| KISS sign        | Eight generic 1-channel dimmers                                     |

Recommended groups include `Honeycomb_All`, `SpotPortable_All`, `Rotator_All`, `KISS_All`, `KISS_Outer`, `KISS_Inner`, `Utility_Plugs`, and a guarded blackout/visual group. The scene-building rule is to include the required setup channels in every scene: Bright CH1 = 210, Spot Portable CH1 = 210, Honeycomb CH6 = 0, and Rotator CH12/13/14 = 0 unless macros are intentional.

## Safety / handling notes from manuals

The Chauvet fixtures and the moving-head manual all emphasize grounded power, indoor use, ventilation, eye-safety, no dimmer-pack power input, fuse replacement with same type/rating, and proper rigging/safety cable when mounted overhead. The Freedom RGBA manual also notes the product has rechargeable batteries and should not be connected to a dimmer.

## Photo/reference observations

The photo set and the reference document’s source notes are used as local evidence for physical fixture identity, labels, control panels, and the QLC+ universe screenshot. I can safely say the photos align with at least the Chauvet/Freedom-style control-panel evidence and the COLORstrip/power-label evidence, but I would not use the photos alone to override the written patch sheet or manufacturer manuals without bench testing.

## Fast “is the rig alive?” tests

| Family        | Test values                                           |
| ------------- | ----------------------------------------------------- |
| Bright        | CH1=210, CH2=255, CH3=0, CH4=0                        |
| Honeycomb     | CH1=255, CH2=255, CH3=0, CH4=0, CH5=0, CH6=0          |
| Spot Portable | first channel=210, second channel=255                 |
| Rotator       | CH6=255, CH11=255, CH7=0, CH12=0, CH13=0, CH14=0      |
| KISS          | CH129–136 = 255                                       |
| Plugs         | CH21–24 = 0 for safe off; 255 only with approved load |

---

## Machine-Readable SSOT Companion

This human-readable document has a paired SSOT JSON companion at `docs/ssot/rig.json`. That JSON file is the stable machine-readable seed for website prototypes, owner-admin views, generated checklists, booking materials, marketing materials, and future production data files.

Use the SSOT companion when building software or structured outputs so facts can be reused across multiple website styles without being retyped, forked, or lost. When this document changes, update `docs/ssot/rig.json` and `docs/ssot/master_index.json` in the same change.
