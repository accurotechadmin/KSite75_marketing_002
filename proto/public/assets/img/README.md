# Just One KISS Image Source

The approved generated/captured image files are hosted at:

`public/assets/img/`

Pages read these files through `asset_base_url()` in `app/view.php`, which returns a relative `assets/img/` URL from the current page depth. Keep the `.webp` files in this directory so the site remains self-contained.

Use the exact filenames documented in `../../docs/image_generation_inventory.md`.
