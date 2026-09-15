# Second Rendition Owner Command Center

`secondrendition/` is a new owner-first PHP rendition that studies the generic `owner/` scaffold and the first `owner_arena_command/` implementation, then focuses on findability and trustworthy links.

## Run

```bash
php -S 127.0.0.1:8090 -t secondrendition
```

Open `http://127.0.0.1:8090/?page=dashboard`.

## Data folder

This app is now self-contained for server upload: keep `secondrendition/data/ssot/*.json` beside the PHP files. The loader first checks that local folder, then `secondrendition/data/` for accidental flat copies, then sibling `data/ssot` or `data/` folders, then repository development fallbacks.

## What changed from the first rendition

- The home page starts with owner questions and direct paths instead of an admin table-first workflow.
- Every card title, record ID, source file, Timeline family, and linked record points to a predictable detail, source, or filtered search page.
- Each record detail page shows a plain-language summary first, then the raw normalized record and original canonical record fragment one click away.
- The JSON Library exposes the active data folder, every source file, loaded-record counts, and raw JSON one click away.
- The Data Integrity page reports duplicate IDs, missing universal fields, suspicious Timeline/GEN values, and unresolved linked-record references.

## Data integrity posture

This rendition reads the bundled JSON seed files from `secondrendition/data/ssot/` first and does not edit them. Repository-local fallbacks exist for development only. The goal is to improve visibility and validation while preserving the existing SSOT data until the owner explicitly asks for data migration or authoring workflows.
