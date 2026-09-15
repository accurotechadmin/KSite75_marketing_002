# Portable Campaign Landing Page

Open `index.html` directly or run a static server from the `marketing/` directory:

```sh
python3 -m http.server 8000 --directory marketing
```

Then visit `http://localhost:8000/site/`. Add `?lens=A` through `?lens=E` for a campaign-specific entrance. The lens selector changes headline, proposition, CTA, palette, and composition while the invariant story and controls remain shared.

## Measurement adapter

The page stores no personal data and loads no analytics vendor. It pushes structured demonstrations to `window.dataLayer` and dispatches `jok:measurement` custom events. A deployment may connect an approved analytics adapter without changing campaign components. Do not send a form-completion event until an approved endpoint, consent language, and privacy implementation exist.

## Accessibility

The page includes a skip link, semantic landmarks, visible focus, labeled form fields, status announcements, keyboard-operable controls, high contrast, non-color labels, and reduced-motion handling. Validate the final deployment with automated and manual assistive-technology checks.
