# Inventory Reference Manual: QLC+ / DMX Lighting Installation

**Document filename:** `inventory_reference.md`
**Revision:** 2026-06-30 rebuilt from scratch after unknowns were resolved
**Control platform:** Q Light Controller Plus / QLC+ on Windows
**Primary universe:** Universe 1, 512 DMX slots
**Operating policy for this installation:** DMX control only. Do not intentionally use sound-active, standalone, master/slave, or fixture-run modes during normal QLC+ operation unless a show designer explicitly calls for a controlled exception.

---

## 0. Executive Summary

This document is the working reference manual for a single-universe QLC+ DMX rig that contains:

| QLC+ name family | Physical device / meaning | Count in current universe | DMX footprint per unit | Canonical role |
|---|---:|---:|---:|---|
| `Bright` | Chauvet DJ COLORstrip Mini light bar | 1 physical bar represented by 4 QLC+ channels | 4 channels | Linear RGB/effect bar |
| `1 Plug`–`4 Plug` | 4-channel / 8-outlet AC DMX controller; 2 AC outlets per channel | 1 physical controller, 4 logical channels | 1 channel per plug circuit | AC switched/dimmed utility power |
| `Honeycomb` | U'King ZQ01082 / Par Light B262-style RGB PAR | 14 | 7 channels | RGB PAR wash / accent light |
| `K k I i S s Z z` | KISS sign channels; capitals = outer lights, lowercase = inner lights; `Z/z` denotes the second S to avoid show-control confusion | 8 dimmable logical channels | 1 channel each | Dimmable letter/sign elements |
| `Spot Portable` | Chauvet DJ Freedom Par RGBA battery-powered wireless PAR uplight | 8 | 5 channels | RGBA battery uplight / portable wash |
| `Rotator` | XPCLEOYZ YZ-7LYTYK 7-lens RGBW moving-head wash | 8 | 14 channels | Moving RGBW wash / motion effect |

The universe is intentionally spatially organized in QLC+ rather than simply packed end-to-end. The screenshot shows fixture blocks placed in grouped visual areas. The left-most channel number of each block is the fixture’s DMX start address. The number in square brackets, such as `Honeycomb [26]`, is treated as the QLC+ fixture identifier/name suffix, not the start address.

This revision incorporates the following corrections and confirmations from the user:

1. `Bright 1`–`Bright 4` are the four DMX channels of one **Chauvet COLORstrip Mini**.
2. The COLORstrip Mini uses the official 4-channel DMX chart from the Chauvet QRG.
3. `Rotator` fixtures are the **XPCLEOYZ YZ-7LYTYK** moving heads and are operated in 14-channel mode using the supplied 14-channel chart.
4. `Honeycomb` fixtures are the **U'King ZQ01082 / Par Light B262-style** RGB PARs.
5. `Spot Portable` fixtures are **Chauvet DJ Freedom Par RGBA** fixtures and each is in 5-channel mode.
6. `K k I i S s Z z` channels are dimmable; capitals are outer lights and lowercase names are inner lights.
7. `Z/z` is the intentionally chosen show-control name for the second S of the KISS sign.
8. `1 Plug`–`4 Plug` represent a 4-channel / 8-outlet AC DMX controller, with 2 AC outlets per channel. It can be used as on/off or dimmed AC output, but non-dimmable loads should receive only full off or full on.

---

## 1. Source-of-Truth Hierarchy

Use this order when resolving conflicts:

1. **User-confirmed local rig facts in this document.** Example: `Bright` = COLORstrip Mini, `Rotator` = XPCLEOYZ YZ-7LYTYK, `Spot Portable` = Freedom Par RGBA.
2. **The active QLC+ `.qxw` workspace and `.qxf` fixture definitions**, when available and verified against the physical rig.
3. **Manufacturer manuals / official QRGs.** Example: Chauvet manuals for COLORstrip Mini and Freedom Par RGBA.
4. **Known fixture-library definitions** such as Open Fixture Library, especially for U'King B262-style PAR behavior.
5. **Bench testing in QLC+ Simple Desk**, especially for macro channels and any value ranges not fully specified.
6. **General DMX/QLC+ best practices.**

Known intentional simplifications:

- Power-load calculations, rigging calculations, cable routing, and fail-state engineering are considered outside the scope of this document because the user’s team has separate experts handling those topics.
- Basic safety reminders are retained only when they directly affect programming behavior, such as not dimming equipment that requires full AC power.
- This document is an operational and programming reference, not a substitute for an electrician, rigger, venue engineer, or manufacturer service technician.

---

## 2. Canonical Vocabulary

| Term used by show-control | Meaning in this rig |
|---|---|
| QLight | The user’s shorthand for Q Light Controller Plus / QLC+ |
| Universe | A 512-channel DMX address space in QLC+ |
| Start address | The first DMX slot used by a fixture block |
| Fixture ID / bracket number | The number in square brackets after QLC+ fixture names, such as `[42]`; not a DMX start address by itself |
| Channel | One DMX slot, value 0–255 |
| Personality / mode | The channel layout selected on the fixture, such as 4ch, 5ch, 7ch, or 14ch |
| Scene | A saved QLC+ function containing channel values |
| Chaser | A sequence of scenes/steps |
| EFX | QLC+ automated movement/effect engine, especially useful for moving heads |
| Simple Desk | QLC+ raw manual channel control and bench-test surface |
| DMX Monitor | QLC+ output value viewer |
| Direct color mode | A mode where QLC+ explicitly controls R/G/B/A/W values rather than triggering fixture-native color macros |
| Macro | A fixture’s internal preprogrammed effect or color set triggered by DMX value ranges |
| Blackout | A QLC+ function or state that outputs no visible light and no AC output where appropriate |
| Full-on | DMX value 255 |
| Zero/off | DMX value 0 |

---

## 3. Current Universe Patch Sheet

### 3.1 Whole-rig address map

| Family | QLC+ fixture name | Start | End | Width | Physical identity / purpose |
|---|---|---:|---:|---:|---|
| Bright | `Bright 1`–`Bright 4` | 1 | 4 | 4 | Chauvet COLORstrip Mini, one 4-channel fixture |
| Plug | `1 Plug` | 21 | 21 | 1 | AC DMX controller channel 1, two AC outlets |
| Plug | `2 Plug` | 22 | 22 | 1 | AC DMX controller channel 2, two AC outlets |
| Plug | `3 Plug` | 23 | 23 | 1 | AC DMX controller channel 3, two AC outlets |
| Plug | `4 Plug` | 24 | 24 | 1 | AC DMX controller channel 4, two AC outlets |
| Honeycomb | `Honeycomb [26]` | 9 | 15 | 7 | U'King ZQ01082 / B262 PAR |
| Honeycomb | `Honeycomb [27]` | 33 | 39 | 7 | U'King ZQ01082 / B262 PAR |
| Honeycomb | `Honeycomb [30]` | 49 | 55 | 7 | U'King ZQ01082 / B262 PAR |
| Honeycomb | `Honeycomb [28]` | 57 | 63 | 7 | U'King ZQ01082 / B262 PAR |
| Honeycomb | `Honeycomb [32]` | 65 | 71 | 7 | U'King ZQ01082 / B262 PAR |
| Honeycomb | `Honeycomb [31]` | 73 | 79 | 7 | U'King ZQ01082 / B262 PAR |
| Honeycomb | `Honeycomb [29]` | 81 | 87 | 7 | U'King ZQ01082 / B262 PAR |
| Honeycomb | `Honeycomb [33]` | 89 | 95 | 7 | U'King ZQ01082 / B262 PAR |
| KISS | `K` | 129 | 129 | 1 | Letter K outer lights |
| KISS | `k` | 130 | 130 | 1 | Letter K inner lights |
| KISS | `I` | 131 | 131 | 1 | Letter I outer lights |
| KISS | `i` | 132 | 132 | 1 | Letter I inner lights |
| KISS | `S` | 133 | 133 | 1 | First S outer lights |
| KISS | `s` | 134 | 134 | 1 | First S inner lights |
| KISS | `Z` | 135 | 135 | 1 | Second S outer lights, named Z for show-control clarity |
| KISS | `z` | 136 | 136 | 1 | Second S inner lights, named z for show-control clarity |
| Honeycomb | `Honeycomb [34]` | 169 | 175 | 7 | U'King ZQ01082 / B262 PAR |
| Spot Portable | `Spot Portable [13]` | 177 | 181 | 5 | Chauvet Freedom Par RGBA |
| Spot Portable | `Spot Portable [21]` | 183 | 187 | 5 | Chauvet Freedom Par RGBA |
| Honeycomb | `Honeycomb [35]` | 193 | 199 | 7 | U'King ZQ01082 / B262 PAR |
| Spot Portable | `Spot Portable [18]` | 201 | 205 | 5 | Chauvet Freedom Par RGBA |
| Spot Portable | `Spot Portable [22]` | 207 | 211 | 5 | Chauvet Freedom Par RGBA |
| Honeycomb | `Honeycomb [36]` | 217 | 223 | 7 | U'King ZQ01082 / B262 PAR |
| Spot Portable | `Spot Portable [19]` | 225 | 229 | 5 | Chauvet Freedom Par RGBA |
| Spot Portable | `Spot Portable [23]` | 231 | 235 | 5 | Chauvet Freedom Par RGBA |
| Honeycomb | `Honeycomb [37]` | 241 | 247 | 7 | U'King ZQ01082 / B262 PAR |
| Spot Portable | `Spot Portable [20]` | 249 | 253 | 5 | Chauvet Freedom Par RGBA |
| Spot Portable | `Spot Portable [24]` | 255 | 259 | 5 | Chauvet Freedom Par RGBA |
| Honeycomb | `Honeycomb [38]` | 265 | 271 | 7 | U'King ZQ01082 / B262 PAR |
| Honeycomb | `Honeycomb [39]` | 289 | 295 | 7 | U'King ZQ01082 / B262 PAR |
| Rotator | `Rotator [42]` | 297 | 310 | 14 | XPCLEOYZ YZ-7LYTYK moving head |
| Rotator | `Rotator [43]` | 321 | 334 | 14 | XPCLEOYZ YZ-7LYTYK moving head |
| Rotator | `Rotator [44]` | 337 | 350 | 14 | XPCLEOYZ YZ-7LYTYK moving head |
| Rotator | `Rotator [45]` | 361 | 374 | 14 | XPCLEOYZ YZ-7LYTYK moving head |
| Rotator | `Rotator [46]` | 385 | 398 | 14 | XPCLEOYZ YZ-7LYTYK moving head |
| Rotator | `Rotator [47]` | 409 | 422 | 14 | XPCLEOYZ YZ-7LYTYK moving head |
| Rotator | `Rotator [48]` | 441 | 454 | 14 | XPCLEOYZ YZ-7LYTYK moving head |
| Rotator | `Rotator [49]` | 465 | 478 | 14 | XPCLEOYZ YZ-7LYTYK moving head |

### 3.2 Count summary

| Family | Count |
|---|---:|
| Chauvet COLORstrip Mini physical bars | 1 |
| AC DMX plug-controller physical units | 1 physical controller assumed for current universe |
| AC DMX plug channels | 4 |
| U'King ZQ01082 / Honeycomb PARs | 14 |
| KISS dimmable sign channels | 8 |
| Chauvet Freedom Par RGBA / Spot Portable uplights | 8 |
| XPCLEOYZ YZ-7LYTYK / Rotator moving heads | 8 |

---

## 4. Universal Programming Conventions

### 4.1 Rig-wide DMX value language

| Value | Meaning |
|---:|---|
| 0 | Off, no intensity, no movement contribution, or lowest value |
| 1–9 | Usually near-zero; avoid for on/off AC channels unless intentionally dimming |
| 64 | Low-medium level or slow/moderate parameter value |
| 127/128 | Midpoint |
| 191/192 | High level |
| 255 | Full-on / maximum / fastest unless the fixture defines the channel inversely |

### 4.2 Canonical direct-color approach

For precise QLC+ programming, use direct color control rather than fixture-native color macros whenever possible.

| Fixture family | Direct-color setup |
|---|---|
| COLORstrip Mini / Bright | Set channel 1 to 210–219; channels 2–4 become red, green, blue |
| Honeycomb / U'King PAR | CH1 master dimmer, CH2 red, CH3 green, CH4 blue; CH5 strobe 0, CH6 manual range 0–10, CH7 not needed for direct RGB |
| Spot Portable / Freedom Par RGBA | Set CH1 to 207–215 for RGBA mode; CH2 red, CH3 green, CH4 blue, CH5 amber |
| Rotator / XPCLEOYZ | CH6 dimmer, CH8 red, CH9 green, CH10 blue, CH11 white; keep CH12/CH13/CH14 at safe non-macro values unless intentionally using macros |
| KISS letters | One dimmable channel per inner/outer letter segment |
| Plug controller | One AC output channel per plug circuit; use 0 or 255 for non-dimmable loads |

### 4.3 Show policy: disabled/avoided modes

Normal QLC+ show operation should avoid:

- standalone auto modes,
- sound-active modes,
- master/slave modes,
- IR remote operation,
- fixture-native macros unless explicitly part of a designed scene,
- partial AC values to devices that need full mains voltage.

In this rig, “only DMX modes” means the console/computer is the timing authority. Fixture-native effects are allowed only if the programmer deliberately sets the DMX channels to call them.

---

## 5. Fixture Dossier: Chauvet DJ COLORstrip Mini (`Bright 1`–`Bright 4`)

### 5.1 Identity and physical role

**QLC+ names:** `Bright 1`, `Bright 2`, `Bright 3`, `Bright 4`
**Physical device:** Chauvet DJ COLORstrip Mini
**Current start address:** 1
**Current footprint:** channels 1–4
**Purpose:** linear RGB/effects bar. In this showfile it is represented as four raw DMX channels rather than a named fixture block.

The COLORstrip Mini is a compact multicolor strip light for indoor mobile entertainment use. The official QRG lists power in/out, DMX in/out, LED display, fuse holder, power input, EXT controller port, safety loop, microphone, menu buttons, sensitivity knob, and Master/Slave output. The fixture supports DMX operation and the highest recommended DMX address is 509 because it uses a 4-channel mode.

### 5.2 Current patch

| Absolute DMX channel | QLC+ label | Relative channel | Function in 4ch DMX mode |
|---:|---|---:|---|
| 1 | `Bright 1` | CH1 | Mode / color / effect selector |
| 2 | `Bright 2` | CH2 | Run speed, red, or fade speed depending on CH1 |
| 3 | `Bright 3` | CH3 | Strobe or green depending on CH1 |
| 4 | `Bright 4` | CH4 | Blue when CH1 is in RGB mixing range |

### 5.3 COLORstrip Mini 4-channel DMX chart

| Relative CH | DMX value | Function |
|---:|---:|---|
| 1 | 000–009 | No function / blackout |
| 1 | 010–019 | Red static color |
| 1 | 020–029 | Green static color |
| 1 | 030–039 | Blue static color |
| 1 | 040–049 | Yellow static color |
| 1 | 050–059 | Magenta static color |
| 1 | 060–069 | Cyan static color |
| 1 | 070–079 | White static color |
| 1 | 080–089 | Color Chase 1 |
| 1 | 090–099 | Color Chase 2 |
| 1 | 100–109 | Color Chase 3 |
| 1 | 110–119 | Color Chase 4 |
| 1 | 120–129 | Color Chase 5 |
| 1 | 130–139 | Color Chase 6 |
| 1 | 140–149 | Color Chase 7 |
| 1 | 150–159 | Color Chase 8 |
| 1 | 160–169 | Color Chase 9 |
| 1 | 170–179 | Color Chase 10 |
| 1 | 180–189 | Color Chase 11 |
| 1 | 190–199 | Color Chase 12 |
| 1 | 200–209 | Color Chase 13 |
| 1 | 210–219 | RGB color mixing; CH2 red, CH3 green, CH4 blue |
| 1 | 220–229 | Color fade |
| 1 | 230–255 | Sound-active; normally avoided in this rig |
| 2 | 000–127 | Run speed, slow to fast, when CH1 is 080–209 |
| 2 | 128–255 | Sound-active when CH1 is 080–209; normally avoided |
| 2 | 000–255 | Red 0–100% when CH1 is 210–219 |
| 2 | 000–255 | Fade speed slow to fast when CH1 is 220–229 |
| 3 | 003–249 | Strobe slow to fast when CH1 is 010–119 |
| 3 | 250–255 | Sound-active strobe when CH1 is 010–119; normally avoided |
| 3 | 000–255 | Green 0–100% when CH1 is 210–219 |
| 4 | 000–255 | Blue 0–100% when CH1 is 210–219 |

### 5.4 Preferred QLC+ direct RGB recipes

| Desired output | CH1 | CH2 R | CH3 G | CH4 B |
|---|---:|---:|---:|---:|
| Blackout | 0 | 0 | 0 | 0 |
| Red | 210 | 255 | 0 | 0 |
| Green | 210 | 0 | 255 | 0 |
| Blue | 210 | 0 | 0 | 255 |
| Cyan | 210 | 0 | 255 | 255 |
| Magenta | 210 | 255 | 0 | 255 |
| Yellow | 210 | 255 | 255 | 0 |
| White / RGB white | 210 | 255 | 255 | 255 |
| Dim white | 210 | 96 | 96 | 96 |

### 5.5 Menu map for standalone/reference use

This rig normally uses DMX mode only, but these menu entries are useful during bench testing or address recovery.

| Main | Program | Subvalues | Meaning |
|---|---|---|---|
| `Act` | `A000` | — | Blackout |
| `Act` | `A001` | `F000–F100` | Red with strobe speed |
| `Act` | `A002` | `F000–F100` | Green with strobe speed |
| `Act` | `A003` | `F000–F100` | Blue with strobe speed |
| `Act` | `A004` | `F000–F100` | Yellow with strobe speed |
| `Act` | `A005` | `F000–F100` | Purple with strobe speed |
| `Act` | `A006` | `F000–F100` | Cyan with strobe speed |
| `Act` | `A007` | `F000–F100` | White with strobe speed |
| `Act` | `A008–A011` | `P000–P100`, `F000–F100` | Color chases 1–4, speed and strobe |
| `Act` | `A012–A020` | `P000–P100` | Color chases 5–13, speed |
| `Act` | `A021` | `r000–r100`, `G000–G100`, `b000–b100`, `F000–F100` | Manual color mix + strobe |
| `Act` | `A022` | `P000–P100` | Color fade speed |
| `Act` | `A023` | `P000–P100` | All color chases 1–13 speed |
| `SYS` | `SdAd` | `001–509` | DMX address |
| `SYS` | `SAAd` | — | Reset |

### 5.6 Procedures

**Set COLORstrip Mini to the rig’s address**

1. Power the fixture.
2. Use the display/menu buttons to enter `SYS`.
3. Select `SdAd`.
4. Set address `001`.
5. Save by pressing the required confirmation sequence on the control panel.
6. In QLC+ Simple Desk, set channel 1 to 210 and bring channels 2/3/4 up one by one to confirm red/green/blue.

**Recover from accidental standalone mode**

1. Set DMX channel 1 to 0 in QLC+.
2. Confirm fixture goes dark.
3. If it continues running, use panel menu to exit `Act` modes and return to DMX address mode.
4. Test again with CH1 210 and RGB on channels 2–4.

---

## 6. Fixture Dossier: U'King ZQ01082 / Par Light B262 (`Honeycomb`)

### 6.1 Identity and physical role

**QLC+ family:** `Honeycomb`
**Physical device:** U'King ZQ01082 / Par Light B262-style RGB PAR
**Current footprint:** 7 channels per fixture
**Current count:** 14 fixtures
**Purpose:** RGB PAR wash and accent lighting.

The fixture is a budget compact RGB PAR class device. Its profile is well represented by the Open Fixture Library `U'King Par Light B262` fixture definition. The B262 definition lists a 7-channel mode with master dimmer, RGB, strobe, effect mode, and a switching channel that acts as hue selection or effect speed depending on channel 6.

### 6.2 Honeycomb address list

| QLC+ name | Start | End |
|---|---:|---:|
| `Honeycomb [26]` | 9 | 15 |
| `Honeycomb [27]` | 33 | 39 |
| `Honeycomb [30]` | 49 | 55 |
| `Honeycomb [28]` | 57 | 63 |
| `Honeycomb [32]` | 65 | 71 |
| `Honeycomb [31]` | 73 | 79 |
| `Honeycomb [29]` | 81 | 87 |
| `Honeycomb [33]` | 89 | 95 |
| `Honeycomb [34]` | 169 | 175 |
| `Honeycomb [35]` | 193 | 199 |
| `Honeycomb [36]` | 217 | 223 |
| `Honeycomb [37]` | 241 | 247 |
| `Honeycomb [38]` | 265 | 271 |
| `Honeycomb [39]` | 289 | 295 |

### 6.3 Honeycomb 7-channel map

For a fixture starting at address **B**:

| Relative CH | Absolute address | Function | Values / behavior |
|---:|---:|---|---|
| 1 | B+0 | Master dimmer | 0–255 off to bright |
| 2 | B+1 | Red | 0–255 off to full |
| 3 | B+2 | Green | 0–255 off to full |
| 4 | B+3 | Blue | 0–255 off to full |
| 5 | B+4 | Strobe | 0–7 open/no strobe; 8–255 slow to fast strobe |
| 6 | B+5 | Effect mode | 0–10 manual; 11–60 hue select; 61–110 hue shift; 111–160 hue pulse transform; 161–210 hue transition; 211–255 sound control |
| 7 | B+6 | Hue selection / speed | 0–255 hue selection when CH6 = 0–60; hue/effect speed when CH6 = 61–255 |

### 6.4 Preferred Honeycomb direct RGB recipes

For each Honeycomb fixture, use CH6 = 0 and CH5 = 0 for clean console control.

| Desired output | CH1 dimmer | CH2 R | CH3 G | CH4 B | CH5 strobe | CH6 mode | CH7 |
|---|---:|---:|---:|---:|---:|---:|---:|
| Blackout | 0 | 0 | 0 | 0 | 0 | 0 | 0 |
| Red | 255 | 255 | 0 | 0 | 0 | 0 | 0 |
| Green | 255 | 0 | 255 | 0 | 0 | 0 | 0 |
| Blue | 255 | 0 | 0 | 255 | 0 | 0 | 0 |
| Cyan | 255 | 0 | 255 | 255 | 0 | 0 | 0 |
| Magenta | 255 | 255 | 0 | 255 | 0 | 0 | 0 |
| Yellow | 255 | 255 | 255 | 0 | 0 | 0 | 0 |
| White / RGB white | 255 | 255 | 255 | 255 | 0 | 0 | 0 |
| Dim blue accent | 96 | 0 | 0 | 255 | 0 | 0 | 0 |

### 6.5 Effect-mode cautions

- `CH6 = 211–255` calls sound-controlled behavior. This is normally outside the rig’s “DMX-only, no sound mode” operating policy.
- `CH5` strobe should usually be kept at 0 unless the scene explicitly calls for a strobe effect.
- For QLC+ fades, crossfade CH1/CH2/CH3/CH4. Avoid crossfading CH6 through multiple macro ranges unless the resulting behavior is intentionally chaotic.

### 6.6 Recommended QLC+ groups

| Group name | Members |
|---|---|
| `Honeycomb_All` | all 14 Honeycomb fixtures |
| `Honeycomb_Top` | fixtures [26]–[33], if physically top/front row |
| `Honeycomb_Lower` | fixtures [34]–[39], if physically lower/back row |
| `Honeycomb_Left` / `Honeycomb_Right` | define based on physical stage position |
| `Honeycomb_Odds` / `Honeycomb_Evens` | alternating chase groups |

---

## 7. Fixture Dossier: KISS Sign (`K k I i S s Z z`)

### 7.1 Identity and physical role

**QLC+ channels:** `K`, `k`, `I`, `i`, `S`, `s`, `Z`, `z`
**Physical role:** four illuminated KISS letters.
**Naming rule:** capital letters = outer lights; lowercase letters = inner lights.
**Special naming rule:** `Z/z` refers to the second S, intentionally avoiding two identical `S/s` labels in QLC+.

These are dimmable channels. No further lamp type, voltage, power-source, or construction details are asserted in this document.

### 7.2 KISS channel map

| DMX channel | QLC+ label | Physical element | Range |
|---:|---|---|---|
| 129 | `K` | K outer lights | 0–255 dimmable |
| 130 | `k` | K inner lights | 0–255 dimmable |
| 131 | `I` | I outer lights | 0–255 dimmable |
| 132 | `i` | I inner lights | 0–255 dimmable |
| 133 | `S` | first S outer lights | 0–255 dimmable |
| 134 | `s` | first S inner lights | 0–255 dimmable |
| 135 | `Z` | second S outer lights | 0–255 dimmable |
| 136 | `z` | second S inner lights | 0–255 dimmable |

### 7.3 KISS programming idioms

| Look | K | k | I | i | S | s | Z | z |
|---|---:|---:|---:|---:|---:|---:|---:|---:|
| Blackout | 0 | 0 | 0 | 0 | 0 | 0 | 0 | 0 |
| Outer only | 255 | 0 | 255 | 0 | 255 | 0 | 255 | 0 |
| Inner only | 0 | 255 | 0 | 255 | 0 | 255 | 0 | 255 |
| Full sign | 255 | 255 | 255 | 255 | 255 | 255 | 255 | 255 |
| Soft full sign | 96 | 96 | 96 | 96 | 96 | 96 | 96 | 96 |
| KISS spelling chase step 1 | 255 | 255 | 0 | 0 | 0 | 0 | 0 | 0 |
| KISS spelling chase step 2 | 0 | 0 | 255 | 255 | 0 | 0 | 0 | 0 |
| KISS spelling chase step 3 | 0 | 0 | 0 | 0 | 255 | 255 | 0 | 0 |
| KISS spelling chase step 4 | 0 | 0 | 0 | 0 | 0 | 0 | 255 | 255 |

### 7.4 Recommended QLC+ groups

| Group | Channels |
|---|---|
| `KISS_All` | 129–136 |
| `KISS_Outer` | 129, 131, 133, 135 |
| `KISS_Inner` | 130, 132, 134, 136 |
| `KISS_K` | 129, 130 |
| `KISS_I` | 131, 132 |
| `KISS_S1` | 133, 134 |
| `KISS_S2` | 135, 136 |

---

## 8. Fixture Dossier: 4-Channel / 8-Outlet AC DMX Plug Controller (`1 Plug`–`4 Plug`)

### 8.1 Identity and physical role

**QLC+ names:** `1 Plug`, `2 Plug`, `3 Plug`, `4 Plug`
**Physical device:** 4-channel AC DMX controller with 8 total outlets, 2 outlets per channel
**Current channels:** 21–24
**Behavior:** on/off or dimmed AC output, depending on connected load and operating choice.

The plug controller is treated as a utility power fixture, not a visual light fixture. It can control AC-powered props, lamps, or other devices. Because some devices require full line voltage, the programming rule is conservative: use **0** for off and **255** for full-on unless the connected load is known to be safe and useful on dimmed AC.

### 8.2 Plug channel map

| DMX channel | QLC+ label | Physical output | Programming convention |
|---:|---|---|---|
| 21 | `1 Plug` | Plug controller channel 1, two AC outlets | 0 off, 255 full-on; dim only when safe |
| 22 | `2 Plug` | Plug controller channel 2, two AC outlets | 0 off, 255 full-on; dim only when safe |
| 23 | `3 Plug` | Plug controller channel 3, two AC outlets | 0 off, 255 full-on; dim only when safe |
| 24 | `4 Plug` | Plug controller channel 4, two AC outlets | 0 off, 255 full-on; dim only when safe |

### 8.3 Plug programming rules

- For motors, controllers, power supplies, electronic fixtures, foggers, chargers, or anything that expects full AC, use only 0 and 255 unless the technical team explicitly authorizes dimmed operation.
- For incandescent or approved dimmable loads, intermediate values may be useful.
- Do not use plug channels as a substitute for proper fixture dimmer control unless the load has been confirmed compatible.
- Put plug channels in their own QLC+ group and show-control surfaces so a lighting color chase cannot accidentally ramp utility power.

### 8.4 Recommended QLC+ controls

| Control | Type | Behavior |
|---|---|---|
| `Plug 1 Full` | Button / Scene | CH21 = 255 |
| `Plug 1 Off` | Button / Scene | CH21 = 0 |
| `All Plugs Off` | Button / Scene | CH21–24 = 0 |
| `All Plugs Full` | Button / Scene | CH21–24 = 255, only when safe |
| `Plug Lockout` | Virtual Console label/frame convention | Keeps utility power separate from color/effect programming |

---

## 9. Fixture Dossier: Chauvet DJ Freedom Par RGBA (`Spot Portable`)

### 9.1 Identity and physical role

**QLC+ family:** `Spot Portable`
**Physical device:** Chauvet DJ Freedom Par RGBA battery-powered wireless PAR uplight
**Current mode:** 5-channel
**Current count:** 8 fixtures
**Purpose:** battery-powered RGBA uplighting, portable wash, warm/pastel color layer.

Important correction: in this fixture’s official 5-channel personality, **channel 1 is not a simple master dimmer**. Channel 1 is a mode/function selector. For direct RGBA control in QLC+, set channel 1 to the **RGBA mode range 207–215**, then use channels 2–5 for red, green, blue, and amber.

### 9.2 Spot Portable address list

| QLC+ name | Start | End |
|---|---:|---:|
| `Spot Portable [13]` | 177 | 181 |
| `Spot Portable [21]` | 183 | 187 |
| `Spot Portable [18]` | 201 | 205 |
| `Spot Portable [22]` | 207 | 211 |
| `Spot Portable [19]` | 225 | 229 |
| `Spot Portable [23]` | 231 | 235 |
| `Spot Portable [20]` | 249 | 253 |
| `Spot Portable [24]` | 255 | 259 |

### 9.3 Freedom Par RGBA 5-channel map

For a fixture starting at **B**:

| Relative CH | Address | Function |
|---:|---:|---|
| 1 | B+0 | Function / mode selector |
| 2 | B+1 | Flash speed, run speed, snap/fade speed, or red, depending on CH1 |
| 3 | B+2 | Green in RGBA mode |
| 4 | B+3 | Blue in RGBA mode |
| 5 | B+4 | Amber in RGBA mode |

#### CH1 mode ranges

| CH1 value | Mode / effect | Other-channel behavior |
|---:|---|---|
| 000–008 | Blackout | Fixture off |
| 009–017 | Red | CH2 controls flash speed 000–249; 250–255 sound-active flash |
| 018–026 | Green | CH2 controls flash speed |
| 027–035 | Blue | CH2 controls flash speed |
| 036–044 | Amber | CH2 controls flash speed |
| 045–053 | Red + Green | CH2 controls flash speed |
| 054–062 | Red + Blue | CH2 controls flash speed |
| 063–071 | Red + Amber | CH2 controls flash speed |
| 072–080 | Green + Blue | CH2 controls flash speed |
| 081–089 | Blue + Amber | CH2 controls flash speed |
| 090–098 | Red + Green + Blue | CH2 controls flash speed |
| 099–107 | Green + Amber | CH2 controls flash speed |
| 108–116 | Red + Green + Amber | CH2 controls flash speed |
| 117–125 | Red + Blue + Amber | CH2 controls flash speed |
| 126–134 | Green + Blue + Amber | CH2 controls flash speed |
| 135–143 | Red + Green + Blue + Amber | CH2 controls flash speed |
| 144–152 | Color Change 1 | CH2 run speed: 000–127 automatic speed, 128–255 sound-active |
| 153–161 | Color Change 2 | CH2 run speed / sound-active |
| 162–170 | Color Chase 1 | CH2 run speed / sound-active |
| 171–179 | Color Chase 2 | CH2 run speed / sound-active |
| 180–188 | Color Chase 3 | CH2 run speed / sound-active |
| 189–197 | Color Chase 4 | CH2 run speed / sound-active |
| 198–206 | Color Change 3 | CH2 run speed / sound-active |
| 207–215 | RGBA mode | CH2 red, CH3 green, CH4 blue, CH5 amber |
| 216–224 | Color Snap | CH2 snap speed |
| 225–233 | Color Fade | CH2 fade speed |
| 234–255 | Auto Run, sound-active only | CH2 run speed / sound-active behavior |

### 9.4 Preferred Spot Portable direct RGBA recipes

Use CH1 = 210 for stable direct RGBA control.

| Desired output | CH1 mode | CH2 R | CH3 G | CH4 B | CH5 A |
|---|---:|---:|---:|---:|---:|
| Blackout | 0 | 0 | 0 | 0 | 0 |
| Red | 210 | 255 | 0 | 0 | 0 |
| Green | 210 | 0 | 255 | 0 | 0 |
| Blue | 210 | 0 | 0 | 255 | 0 |
| Amber | 210 | 0 | 0 | 0 | 255 |
| Warm white | 210 | 180 | 140 | 80 | 180 |
| Cool white | 210 | 160 | 180 | 255 | 32 |
| Pink | 210 | 255 | 48 | 128 | 48 |
| Gold | 210 | 255 | 160 | 0 | 160 |
| Purple | 210 | 160 | 0 | 255 | 0 |
| Event pastel | 210 | 128 | 64 | 255 | 64 |

### 9.5 Freedom Par menu map highlights

| Menu | Item | Meaning |
|---|---|---|
| `SYS` | `SdAd 001–508` | Set DMX start address |
| `SYS` | `d-CH` → `4CH` or `5CH` | Select DMX personality; current rig uses 5CH |
| `SYS` | `S-tr`, `drA.S`, `dr.CH`, `dtA.S`, `dt.CH` | D-Fi wireless transmit/receive setup; normally not used unless intentionally wireless |
| `SYS` | `d-SL SL.00–SL.32` | Sound sensitivity in DMX mode |
| `SYS` | `SAAd` | Software reset |
| `ACt` | `A001–A026` | Standalone auto programs; normally avoided |
| `ACtC` | `AC01–AC14` | Compatibility standalone programs; normally avoided |
| `SLAv` | receiver/sync options | Master/slave; normally avoided |
| `S-Ir` | infrared remote mode | Normally avoided for QLC+ show operation |

### 9.6 Procedures

**Set a Spot Portable to current rig mode**

1. Power on the fixture.
2. Enter `SYS`.
3. Set `d-CH` to `5CH`.
4. Set `SdAd` to the QLC+ start address for that unit.
5. Leave `ACt`, `ACtC`, `SLAv`, and `S-Ir` modes unused for normal QLC+ control.
6. In QLC+ Simple Desk, set the fixture’s first channel to 210, then test red/green/blue/amber on the following four channels.

**Battery/uplight operating notes**

- Confirm battery charge before use.
- If wired DMX is used, verify D-Fi receiver/transmitter settings are not causing unexpected behavior.
- For direct RGBA scenes, always include the mode channel value 210; otherwise the color channels may not behave as red/green/blue/amber.

---

## 10. Fixture Dossier: XPCLEOYZ YZ-7LYTYK Moving Head (`Rotator`)

### 10.1 Identity and physical role

**QLC+ family:** `Rotator`
**Physical device:** XPCLEOYZ YZ-7LYTYK, 7-lens RGBW moving-head wash
**Current mode:** 14-channel
**Current count:** 8 fixtures
**Purpose:** moving color wash, motion, sweeps, dance/show energy.

The user supplied the 14-channel chart for the exact deployed mode. This chart is the local authority for QLC+ programming unless later bench data proves a specific fixture behaves differently.

### 10.2 Rotator address list

| QLC+ name | Start | End |
|---|---:|---:|
| `Rotator [42]` | 297 | 310 |
| `Rotator [43]` | 321 | 334 |
| `Rotator [44]` | 337 | 350 |
| `Rotator [45]` | 361 | 374 |
| `Rotator [46]` | 385 | 398 |
| `Rotator [47]` | 409 | 422 |
| `Rotator [48]` | 441 | 454 |
| `Rotator [49]` | 465 | 478 |

### 10.3 Rotator 14-channel map

For a fixture starting at **B**:

| Relative CH | Address | Function | User-supplied behavior |
|---:|---:|---|---|
| 1 | B+0 | Pan | 000–255 = horizontal movement 0°–540° |
| 2 | B+1 | Pan fine | 000–255 fine adjustment of pan |
| 3 | B+2 | Tilt | 000–255 = vertical movement 0°–180° |
| 4 | B+3 | Tilt fine | 000–255 fine adjustment of tilt |
| 5 | B+4 | Pan/tilt speed | 0 fastest, 255 slowest |
| 6 | B+5 | Master dimmer | 0–255 = 0%–100% brightness |
| 7 | B+6 | Strobe | 0 no strobe, 255 fastest flash rate |
| 8 | B+7 | Red | 0 off, 255 full |
| 9 | B+8 | Green | 0 off, 255 full |
| 10 | B+9 | Blue | 0 off, 255 full |
| 11 | B+10 | White | 0 off, 255 full |
| 12 | B+11 | Color macros | 0–255 pre-programmed static colors and gradients |
| 13 | B+12 | Color speed / sound active | 0–255 color speed / sound-active behavior |
| 14 | B+13 | Movement macros / reset | 0–255 movement macros / reset behavior |

### 10.4 Rotator direct RGBW recipes

Use direct RGBW mode by controlling dimmer and LED colors directly. Keep macro channels at zero unless intentionally calling effects.

| Desired output | Pan | Pan fine | Tilt | Tilt fine | Speed | Dimmer | Strobe | R | G | B | W | Color macro | Color speed | Move macro/reset |
|---|---:|---:|---:|---:|---:|---:|---:|---:|---:|---:|---:|---:|---:|---:|
| Safe blackout | — | — | — | — | — | 0 | 0 | 0 | 0 | 0 | 0 | 0 | 0 | 0 |
| White center look | 128 | 0 | 128 | 0 | 96 | 255 | 0 | 0 | 0 | 0 | 255 | 0 | 0 | 0 |
| Red wash | 128 | 0 | 128 | 0 | 96 | 255 | 0 | 255 | 0 | 0 | 0 | 0 | 0 | 0 |
| Blue wash | 128 | 0 | 128 | 0 | 96 | 255 | 0 | 0 | 0 | 255 | 0 | 0 | 0 | 0 |
| Purple wash | 128 | 0 | 128 | 0 | 96 | 255 | 0 | 180 | 0 | 255 | 0 | 0 | 0 | 0 |
| Slow move visible | variable | variable | variable | variable | 160–220 | 255 | 0 | chosen | chosen | chosen | chosen | 0 | 0 | 0 |
| Fast dance motion | variable | variable | variable | variable | 0–64 | 255 | optional | chosen | chosen | chosen | chosen | 0 | 0 | 0 |

`—` means do not necessarily change the current movement value; for blackout scenes it is often best to kill dimmer but not force the head to move.

### 10.5 Rotator programming notes

- Channel 5 is inverse-speed style: **0 = fastest**, **255 = slowest**.
- Channel 14 contains movement macros/reset behavior. Avoid sweeping this channel through unknown ranges during live cues.
- Use QLC+ EFX for pan/tilt movement only after verifying the channel order and fixture orientation.
- Do not put reset values into a chase unless you want the heads to recalibrate during a show.
- For static looks, set dimmer and color channels, then leave pan/tilt unchanged or set a known focus position.
- For blackout, usually set CH6 dimmer to 0 and leave pan/tilt alone.

### 10.6 Suggested Rotator group strategy

| Group | Purpose |
|---|---|
| `Rotator_All` | all eight movers |
| `Rotator_Left` | physical left-side movers |
| `Rotator_Right` | physical right-side movers |
| `Rotator_Back` | back/overhead movers |
| `Rotator_Front` | front/audience-facing movers |
| `Rotator_Odds` | [43], [45], [47], [49] or physical alternating pattern |
| `Rotator_Evens` | [42], [44], [46], [48] or physical alternating pattern |

Define left/right/front/back from physical placement, not fixture ID alone.

### 10.7 Rotator bench verification checklist

Even with the supplied chart, bench testing is valuable for orientation and macros.

1. Isolate one Rotator.
2. Set it to 14-channel mode.
3. Address it to 001 temporarily or test at its actual patched address.
4. In Simple Desk, set all 14 channels to 0.
5. Raise CH6 dimmer to 255.
6. Raise CH11 white to 255 so movement is visible.
7. Sweep CH1 pan from 0 to 255 and record physical direction.
8. Sweep CH3 tilt from 0 to 255 and record physical direction.
9. Test CH5 speed values: 0, 64, 128, 192, 255.
10. Test CH7 strobe only if strobe is acceptable.
11. Test CH12 color macros and record value ranges only during a controlled session.
12. Test CH13 and CH14 carefully; document ranges that trigger sound-active behavior, movement macros, and reset.
13. Update the QLC+ fixture definition and this manual.

---


## Cue Draft Integration Policy

`docs/cue.txt` contains working show-flow cue seeds, but this manual remains the authority for DMX patching, fixture behavior, direct-control values, fixture groups, and QLC+ programming conventions. Cue-specific looks from the working draft should be added here only when they become reusable programming recipes or verified fixture procedures.

When translating the working cue draft into lighting recipes:

| Cue draft item | Programming requirement |
|---|---|
| Opening intro | Build from approved Timeline Moment IDs and include direct-color setup channels in each scene. |
| Platform drop | Do not program until the physical mechanism, performer position, show-control trigger, and safe-light fallback are approved. |
| Costume-change holds | Use static, low-risk looks; keep fog and strobes off unless explicitly approved for that hold. |
| Screen drop | Coordinate with projection/video state and avoid lighting moves that obscure show visibility or performer safety. |
| Finale / encore | Build high-impact looks only with explicit strobe/fog permissions and blackout/reset states. |

## 11. QLC+ Integration Handbook

### 11.1 QLC+ workspace concepts

QLC+ uses a fixture-oriented architecture. The Fixture Manager is where fixtures are added, removed, edited, grouped, and assigned to universe addresses. Simple Desk can manually control a full 512-channel universe and can override channels controlled by other QLC+ functions. The Fixture Definition Editor is the tool for building or modifying fixture profiles, and custom definitions should be saved either with the workspace or in the user fixtures folder rather than the system fixture folder.

### 11.2 Windows output setup

Typical Windows output setup:

1. Connect USB-DMX interface or network DMX node.
2. Open QLC+.
3. Go to **Input/Output**.
4. Select Universe 1 output.
5. Choose the active output plugin/device.
6. For DMX USB devices, confirm the adapter type if QLC+ does not auto-detect correctly.
7. Open **DMX Monitor** and **Simple Desk** to verify channel output.
8. Test one known fixture first, preferably `Bright` or one `Honeycomb`.

### 11.3 Fixture definition strategy

| Fixture | Recommended QLC+ representation |
|---|---|
| COLORstrip Mini | One 4-channel fixture or four named channels as currently patched; a real QXF is preferred for future clarity |
| Honeycomb | U'King B262-style 7ch fixture definition |
| Spot Portable | Chauvet Freedom Par RGBA 5ch fixture definition with CH1 mode ranges represented correctly |
| Rotator | Custom XPCLEOYZ YZ-7LYTYK 14ch fixture definition based on supplied channel chart and bench-confirmed macro ranges |
| Plug controller | Four generic 1-channel intensity fixtures, grouped as one physical controller |
| KISS sign | Eight generic 1-channel dimmer fixtures with show-control-specific names |

### 11.4 Recommended fixture groups in QLC+

| Group | Contents |
|---|---|
| `All_Lights` | Everything visual except plug outputs unless plugs feed visual-only loads |
| `All_Blackout_Visual` | Bright, Honeycomb, Spot Portable, Rotator dimmers, KISS |
| `Utility_Plugs` | channels 21–24 |
| `Honeycomb_All` | all Honeycomb fixtures |
| `SpotPortable_All` | all Spot Portable fixtures |
| `Rotator_All` | all Rotators |
| `KISS_All` | KISS channels 129–136 |
| `KISS_Outer` | K, I, S, Z |
| `KISS_Inner` | k, i, s, z |
| `RGB_Static` | Honeycomb + Bright + Spot Portable + Rotator color channels, with family-specific mode channels included |

### 11.5 Scene-building procedure

1. Decide the artistic look.
2. Decide whether the look is static, chase-based, mover-based, or utility-power-based.
3. In QLC+ Simple Desk or Scene Editor, set fixture values.
4. Include required mode/setup channels:
   - COLORstrip Mini CH1 = 210 for RGB mixing.
   - Spot Portable CH1 = 210 for RGBA mode.
   - Honeycomb CH6 = 0 for direct RGB.
   - Rotator CH12/CH13/CH14 = 0 unless using macros.
5. Save as a Scene with a name that includes purpose and fixture family.
6. Test scene alone.
7. Test scene while another scene/chaser is running to reveal channel ownership conflicts.
8. Add to a Chaser, Collection, Virtual Console button, or Show Manager timeline as needed.

### 11.6 Naming convention for functions

Use names like:

- `LOOK_All_Blue_Static`
- `LOOK_KISS_Outer_Full`
- `CHASE_Honeycomb_LeftRight_RedBlue_120BPM`
- `EFX_Rotator_SlowCircle_White`
- `BUMP_All_White_250ms`
- `UTILITY_AllPlugs_Off`
- `SAFE_Blackout_AllVisual`

Function naming should answer: **what type is it, who does it affect, what does it do, and how fast/intense is it?**

### 11.7 Virtual Console layout recommendation

Recommended show-control layers:

1. **Top row:** Blackout, Stop All, Safe Look, All Visual Full, Emergency Utility Off.
2. **Color palette:** Red, Green, Blue, Cyan, Magenta, Yellow, White, Amber, Purple, Warm White.
3. **Family masters:** Honeycomb master, Spot Portable master, Rotator dimmer master, KISS master, Bright master.
4. **KISS panel:** Full, Outer, Inner, Spell Chase, Pulse, Sparkle.
5. **Mover panel:** Home, Fan out, Slow circle, Cross sweep, Center up, Blackout movers.
6. **Plug panel:** isolated and clearly labeled; use guarded controls for plug outputs.
7. **Show chasers:** BPM-linked or timed sequences.

---

## 12. Programming Cookbook

### 12.1 Rig-wide blackout

Create a scene named `SAFE_Blackout_AllVisual`.

| Family | Values |
|---|---|
| Bright / COLORstrip | CH1 = 0, CH2–4 = 0 |
| Honeycomb | CH1 dimmer = 0; RGB = 0; strobe = 0; mode = 0 |
| Spot Portable | CH1 = 0; CH2–5 = 0 |
| Rotator | CH6 dimmer = 0; CH7 strobe = 0; do not force pan/tilt unless needed |
| KISS | channels 129–136 = 0 |
| Plugs | only include if blackout is meant to kill plug outputs; otherwise separate utility blackout from visual blackout |

### 12.2 All-blue static look

| Family | Setup |
|---|---|
| Bright | CH1=210, R=0, G=0, B=255 |
| Honeycomb | Dimmer=255, R=0, G=0, B=255, strobe=0, mode=0 |
| Spot Portable | CH1=210, R=0, G=0, B=255, A=0 |
| Rotator | Dimmer=255, strobe=0, R=0, G=0, B=255, W=0, macros=0 |
| KISS | optional: set low blue-compatible accent by using dimmer channels if sign is separate color/white; if sign is single-color, dim level only |

### 12.3 Warm event uplight look

Best carried by the Spot Portable RGBA fixtures because they have amber.

| Family | Suggested values |
|---|---|
| Spot Portable | CH1=210, R=180, G=110, B=40, A=200 |
| Honeycomb | Dimmer=96, R=255, G=100, B=0 |
| Bright | CH1=210, R=255, G=120, B=32 |
| Rotator | Dimmer=64–128, R=255, G=160, B=64, W=64 |
| KISS | 128–255 depending on desired prominence |

### 12.4 KISS spelling chase

Create four scenes:

1. `KISS_Spell_1_K`: K/k full, others off.
2. `KISS_Spell_2_I`: I/i full, others off.
3. `KISS_Spell_3_S1`: S/s full, others off.
4. `KISS_Spell_4_S2`: Z/z full, others off.

Put into a QLC+ Chaser:

| Parameter | Starting value |
|---|---:|
| Step duration | 250–500 ms |
| Fade in | 0–100 ms |
| Fade out | 0–100 ms |
| Direction | Forward loop |
| BPM version at 120 BPM | quarter-note step = 500 ms, eighth-note step = 250 ms |

### 12.5 Honeycomb alternating chase

Create two groups: `Honeycomb_Odds` and `Honeycomb_Evens` by physical alternation.

| Step | Odds | Evens |
|---|---|---|
| 1 | Red full | Blue low |
| 2 | Blue low | Red full |
| 3 | Green full | Purple low |
| 4 | Purple low | Green full |

Use direct RGB mode; do not use CH6 effects unless the chase is intentionally fixture-native.

### 12.6 Rotator slow motion wash

1. Set all Rotators: dimmer 255, strobe 0.
2. Set RGBW color values.
3. Set speed channel to 160–220 for slow movement.
4. Use QLC+ EFX on pan/tilt channels or create step scenes with different pan/tilt positions.
5. Keep CH14 at 0 unless a movement macro is intentionally chosen.

### 12.7 Plug-controlled prop cue

1. Confirm the connected load can safely be switched or dimmed by the plug controller.
2. Create a scene `UTILITY_PlugN_On` with only that plug channel at 255.
3. Create a scene `UTILITY_PlugN_Off` with only that plug channel at 0.
4. Keep plug scenes separate from color-look scenes.
5. Do not include plug channels in broad RGB chasers.

---

## 13. Troubleshooting Index

### 13.1 One fixture does not respond

1. Confirm power.
2. Confirm fixture is in DMX mode, not standalone/sound/master/slave.
3. Confirm start address matches the QLC+ grid.
4. Confirm personality/mode matches QLC+ footprint.
5. Use Simple Desk on the fixture’s exact address range.
6. Test a known direct-output value:
   - Bright: CH1=210, CH2=255.
   - Honeycomb: CH1=255, CH2=255, CH6=0.
   - Spot Portable: CH1=210, CH2=255.
   - Rotator: dimmer CH6=255, white CH11=255.
   - KISS: channel = 255.
   - Plug: channel = 255 with safe test load.
7. If still no response, test the fixture directly with a short DMX cable from the controller/interface.

### 13.2 Fixture responds with wrong colors

Common causes:

- Wrong fixture personality selected on hardware.
- Wrong QLC+ fixture profile.
- COLORstrip or Freedom Par mode channel not set to direct RGB/RGBA range.
- RGB channel order differs from assumed profile.
- Some channels still controlled by another running scene or Simple Desk override.

Fast tests:

- Bright: set CH1=210 and then raise CH2/CH3/CH4 individually.
- Honeycomb: set CH1=255, CH6=0, then raise CH2/CH3/CH4 individually.
- Spot Portable: set CH1=210, then raise CH2/CH3/CH4/CH5 individually.
- Rotator: set CH6=255, then raise CH8/CH9/CH10/CH11 individually.

### 13.3 Mover moves unexpectedly

Common causes:

- CH14 movement macro/reset not at a safe value.
- Pan/tilt channels included in a scene unintentionally.
- EFX still running.
- Simple Desk override is active.
- Fixture address is wrong by 1 or by one fixture block.

Fix:

1. Stop all EFX/chases.
2. Reset Simple Desk overrides.
3. Set Rotator CH6 dimmer to 0.
4. Set CH14 to 0.
5. Bring dimmer up after movement stops.
6. Rebuild motion scene with only intended pan/tilt channels.

### 13.4 A fixture keeps running internal effects

Likely causes:

- Fixture is in standalone mode.
- Sound-active range is being called by DMX.
- Macro channel is set to an effect range.

Family-specific checks:

| Family | Check |
|---|---|
| Bright | CH1 should not be 230–255 unless sound-active is desired |
| Honeycomb | CH6 should not be 211–255 unless sound control is desired |
| Spot Portable | CH1 should be 207–215 for RGBA mode, not 234–255 Auto Run |
| Rotator | CH13/CH14 may call color/movement macro behavior; keep at 0 for direct control |

### 13.5 QLC+ shows output but rig does not respond

1. Check QLC+ Input/Output assignment for Universe 1.
2. Confirm USB-DMX or network DMX interface is selected as output.
3. For FTDI USB-DMX devices, confirm Windows driver/plugin setup.
4. Test with Bright channels 1–4 or one Honeycomb at a known address.
5. Use DMX Monitor to confirm actual transmitted values.
6. Check that Simple Desk is not overriding or zeroing channels.

---

## 14. Maintenance and Documentation Practices

### 14.1 Labeling convention

Use labels like:

`U1-Honeycomb-26-7ch-009`
`U1-SpotPortable-13-5ch-177`
`U1-Rotator-42-14ch-297`
`U1-Bright-COLORstripMini-4ch-001`
`U1-KISS-KOuter-129`

### 14.2 Change log discipline

Every time a fixture is renamed, moved, repatched, or has its mode changed, update:

1. QLC+ workspace.
2. Physical fixture label.
3. This `inventory_reference.md` file.
4. Any printable patch sheets.
5. Any custom GPT knowledge files.

### 14.3 Bench-test log template

| Date | Fixture | Address | Mode | Test | Result | Notes |
|---|---|---:|---|---|---|---|
| YYYY-MM-DD | Rotator [42] | 297 | 14ch | CH1 pan sweep | Pass | pan left-to-right inverted? |
| YYYY-MM-DD | Spot Portable [13] | 177 | 5ch | CH1=210 RGBA | Pass | amber OK |
| YYYY-MM-DD | Honeycomb [26] | 9 | 7ch | RGB/strobe | Pass | CH6 manual OK |

---

## 15. Glossary / Index

**AC dimmer** — A device that varies AC power level. In this rig, plug outputs can be used as dimmers only when the load is appropriate.

**Address** — The first DMX slot used by a fixture. A 14-channel fixture at address 297 occupies 297–310.

**Amber** — Fourth color channel in the Freedom Par RGBA. Useful for warm whites, golds, and pastels.

**Art-Net** — A network DMX protocol supported by QLC+. Be aware that Art-Net universe numbering is commonly 0-based while QLC+ universe display may be 1-based.

**Blackout** — Turning visible output to zero. In this rig, visual blackout and utility plug off should be separate unless the show explicitly wants both.

**BPM** — Beats per minute. The screenshot shows 120 BPM. At 120 BPM, one beat is 500 ms and an eighth note is 250 ms.

**Channel** — One DMX control value from 0 to 255.

**Chaser** — QLC+ function that steps through scenes or cues.

**COLORstrip Mini** — Chauvet linear RGB strip fixture currently represented as `Bright 1`–`Bright 4`.

**Dimmer** — A channel controlling brightness. Some fixtures have a master dimmer; others require RGB values to be scaled manually.

**Direct color** — Programming RGB/RGBA/RGBW values directly instead of calling internal fixture macros.

**DMX** — The 512-channel theatrical lighting control protocol used by this rig.

**DMX Monitor** — QLC+ view that displays transmitted DMX values.

**EFX** — QLC+ automated effect/movement function, especially useful for mover pan/tilt.

**Fixture definition / QXF** — QLC+ fixture profile telling QLC+ what each channel means.

**Fixture ID** — The bracketed number in names like `Rotator [42]`; useful for QLC+ organization but not itself the DMX start address.

**Freedom Par RGBA** — Chauvet battery-powered RGBA PAR represented as `Spot Portable`.

**Honeycomb** — QLC+ family name for U'King ZQ01082 / B262-style RGB PARs.

**KISS letters** — Custom dimmable sign channels 129–136.

**Macro** — Fixture-native preset effect triggered by a DMX range.

**Master/slave** — Fixture-to-fixture synchronized mode. Not used in normal operation here.

**Mode/personality** — The selected DMX channel layout of a fixture.

**Pan** — Horizontal axis of a moving head.

**Pan fine** — Fine-resolution pan adjustment channel.

**QLC+** — Q Light Controller Plus, the Windows lighting control software used here.

**Rotator** — QLC+ family name for XPCLEOYZ YZ-7LYTYK moving heads.

**Scene** — QLC+ function that stores channel values.

**Simple Desk** — QLC+ raw channel control surface for manual operation and testing.

**Sound-active** — Fixture listens to its microphone or sound input. Avoid in this rig’s normal DMX-controlled operation.

**Spot Portable** — QLC+ family name for Chauvet Freedom Par RGBA uplights.

**Strobe** — Rapid flashing output. Keep isolated to dedicated controls.

**Tilt** — Vertical axis of a moving head.

**Universe** — A 512-channel DMX address space.

**White channel** — Dedicated white emitter channel on Rotators. Do not confuse with RGB-mixed white.

**Z/z** — QLC+ name for the second S outer/inner channels in the KISS sign.

---

## 16. Source Notes

This document combines user-confirmed rig facts, uploaded photos/screenshots, and the following external documentation sources:

1. Chauvet DJ, **COLORstrip / COLORstrip Mini Quick Reference Guide Rev. 3**. Official QRG includes DMX values, menu options, control panel description, and physical overview.
2. Chauvet DJ, **Freedom Par RGBA and Strip Mini RGBA User Manual Rev. 4**. Official manual includes 4ch/5ch personalities, RGBA mode behavior, D-Fi, standalone modes, and menu maps.
3. Open Fixture Library, **U'King Par Light B262**. Used for the structured 7-channel Honeycomb/ZQ01082-style profile.
4. Manuals+ / U'King ZQ01082 converted manual page. Used only as secondary/contextual reference; the exact 7ch behavior in this document is primarily from the Open Fixture Library profile and user device photos.
5. QLC+ official documentation: Fixture Manager, Simple Desk, Fixture Definition Editor, Input/Output, and DMX USB plugin documentation.
6. ETC DMX512 information page. Used for general DMX topology, termination, cabling, and troubleshooting concepts.
7. User-supplied local chart for **XPCLEOYZ YZ-7LYTYK 14-channel mode**. Treated as the local authority for Rotator channel order.
8. User-supplied QLC+ universe screenshot. Treated as the local authority for current patch addresses and fixture grouping.

---

## 17. Quick Show-control Cheat Sheet

### Direct-color setup values

| Family | Set this first |
|---|---|
| Bright / COLORstrip | CH1 = 210 |
| Honeycomb | CH1 dimmer > 0; CH6 = 0; CH5 = 0 |
| Spot Portable | CH1 = 210 |
| Rotator | CH6 dimmer > 0; CH12/13/14 = 0 |
| KISS | just set dimmer channel |
| Plugs | 0 or 255 unless dimming is approved |

### Fast tests

| Test | Values |
|---|---|
| Bright red | CH1=210, CH2=255, CH3=0, CH4=0 |
| Honeycomb red | CH1=255, CH2=255, CH3=0, CH4=0, CH5=0, CH6=0 |
| Spot Portable red | CH1=210, CH2=255, CH3=0, CH4=0, CH5=0 |
| Rotator white visible | CH6=255, CH11=255, CH7=0, CH12=0, CH13=0, CH14=0 |
| KISS full | CH129–136 = 255 |
| All plugs off | CH21–24 = 0 |

### Do not accidentally use

| Channel/range | Why |
|---|---|
| Bright CH1 230–255 | Sound-active |
| Honeycomb CH6 211–255 | Sound-control range |
| Spot Portable CH1 234–255 | Auto run / sound-active behavior |
| Rotator CH14 guarded high ranges | Movement macros / reset behavior; bench-test before programming live sweeps |
| Plug channels at partial values | Unsafe for some loads |

---

## Machine-Readable SSOT Companion

This human-readable document has a paired SSOT JSON companion at `docs/ssot/inventory_reference.json`. That JSON file is the stable machine-readable seed for website prototypes, owner-admin views, generated checklists, booking materials, marketing materials, and future production data files.

Use the SSOT companion when building software or structured outputs so facts can be reused across multiple website styles without being retyped, forked, or lost. When this document changes, update `docs/ssot/inventory_reference.json` and `docs/ssot/master_index.json` in the same change.
