# Portability Contract

The entire `marketing/` directory is a self-contained campaign package.

## Included authorities and runtime

- Brand truth: `canon/BRAND_CANON.md` + `.json`
- Expression contract: `expression/`
- Five campaigns and 25-cell funnel: `campaigns/`
- Landing page: `site/index.html`, `site/styles.css`, `site/app.js`
- Social concepts: `assets/social/`
- Governance, production, templates, and registers: remaining local folders

## Runtime requirements

None. The landing page uses local HTML, CSS, JavaScript, system fonts, and vector/CSS artwork. It makes no network request, stores no personal data, and can be previewed by opening `site/index.html` or serving this folder with any static file server.

## Historical provenance

`source_library/` records where earlier thinking originated. Those paths may not exist after this folder is copied. They are archival citations only and must never be imported, fetched, or treated as current claim authority.

## Copy test

After copying, validate JSON, check local links, serve `site/`, switch all five lens controls, test keyboard focus and reduced motion, and confirm no production form endpoint or external asset is introduced accidentally.
