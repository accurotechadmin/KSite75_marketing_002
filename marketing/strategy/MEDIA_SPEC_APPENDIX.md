# Living Media Specification Appendix

**Review status:** planning targets supplied for production architecture; verify official requirements immediately before export or spend.  
**Last internal review:** 2026-09-11.

## Canonical masters

| Master | Planning canvas | Primary use |
| --- | ---: | --- |
| Vertical full screen | 1080×1920 / 9:16 | Reels, Stories, Shorts, TikTok, Snapchat |
| Portrait feed | 1080×1350 / 4:5 | Mobile feeds, Meta, LinkedIn, Reddit |
| Square | 1080×1080 or 1200×1200 / 1:1 | Carousels, feeds, companions |
| Landscape social/display | 1200×628 / 1.91:1 | Display and landscape social |
| HD landscape | 1920×1080 / 16:9 | Web video, YouTube, CTV planning |
| Pinterest portrait | 1000×1500 / 2:3 | Pinterest planning |
| Audio | :30 plus :15 | Streaming audio and podcasts |
| Video cuts | :30 / :15 / :06 | Adapted from native-safe masters |

Compose source photography/video for 9:16, 4:5, and 16:9 at capture time. Never assume a centered 16:9 shot can be blindly cropped to vertical.

## Placement decision map

| Environment | Best lens/jobs | Preferred masters | Release-time check |
| --- | --- | --- | --- |
| Meta / Instagram | A, C, D; awareness through conversion | 9:16, 4:5, 1:1 | safe zones, audio, text, policy, destination |
| Google Search / visual inventory | B, C; intent and consideration | copy bank, 1:1, 1.91:1, 4:5, 9:16 | current character/asset rules and claims |
| YouTube | A, B, E; awareness and explanation | 16:9, 9:16, 1:1; :06/:15/:30 | format, duration, captions, audio rights |
| TikTok / creators | D, A, C; discovery and social proof | native 9:16; :06/:15/:30 | safe zone, disclosure, creator usage rights |
| LinkedIn | E, B; professional proof | 1:1, 1.91:1, 4:5, video | format, lead terms, public-safe claims |
| Pinterest | A, C; inspiration and planning | 2:3, 1:1, vertical video | format and destination |
| Reddit | B, D; skeptical/niche consideration | 1:1, 4:5, 16:9 | community fit, substance, policy |
| Snapchat | A, C, D; mobile awareness | 9:16, short cut | safe zone, duration, format |
| X | B, D; real-time conversation | 1:1, 4:5, 9:16 | current format and policy |
| Streaming audio / podcasts | A, E; frequency and trust | :15/:30, optional :60 host read | loudness, music/voice rights, publisher spec |
| CTV | A, E; premium awareness | 16:9 :06/:15/:30 | publisher/DSP codec, bitrate, slate, audio |
| Programmatic display | B, C; contextual/retargeting | 1:1, 1.91:1 plus vendor banners | DSP sizes, weight, animation, privacy |
| Email / CRM | all; nurture and WOM | 600–700 CSS px live-text layout | consent, rendering, image blocking, links |

## Official verification starting points

- Meta Reels Ads: <https://www.facebook.com/business/ads/facebook-instagram-reels-ads>
- Google responsive search: <https://support.google.com/google-ads/answer/7684791>
- Google Demand Gen: <https://support.google.com/google-ads/answer/17091672>
- YouTube video requirements: <https://support.google.com/google-ads/answer/13547298>
- TikTok auction in-feed: <https://ads.tiktok.com/resources/help/article/tiktok-auction-in-feed-ads>
- LinkedIn single-image specs: <https://www.business.linkedin.com/advertise/ads/sponsored-content/single-image-ads-specs>
- Pinterest product specs: <https://help.pinterest.com/en/business/article/pinterest-product-specs>
- Snapchat formats: <https://forbusiness.snapchat.com/advertising/ad-formats>
- X creative specs: <https://business.x.com/en/help/campaign-setup/creative-ad-specifications>
- Spotify audio specs: <https://ads-web.spotify.com/en-GB/ad-specs/audio-ad-specs/>

Links are references, not runtime dependencies. Archive the reviewed requirement or release evidence when a placement is approved.
