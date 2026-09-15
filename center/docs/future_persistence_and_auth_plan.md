# Future Persistence and Auth Plan

The first full scaffold is read-only. Runtime editing, uploads, publishing, contact storage, approval stamps, and deletion require authenticated users, permission groups, audit logs, backups, rollback, source revisions, and export controls.

Preferred migration path: keep seed contracts adapter-ready so a future database, API, CMS, or JSON overlay store can replace PHP arrays without changing module vocabulary.
