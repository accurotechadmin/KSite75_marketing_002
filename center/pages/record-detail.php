<?php
/** Purpose: Module scaffold page documenting intended contents, source dependencies, owner actions, gates, Timeline/GEN rule, and future persistence requirements. */
require_once __DIR__ . '/../partials/components.php';
center_placeholder_panel($module['label'] . ' scaffold', [
    'Purpose: ' . $module['description'],
    'Intended contents: source-backed records, concise status summaries, required fields or sub-records, owner next actions, linked records, and read-only previews.',
    'Required source files: settings manifest, relevant docs/ssot JSON, repository canon documents, and future owner-approved overlays; this template must not become canonical data.',
    'Owner actions: review, decide, reconcile, export, or create follow-up cards in the Priority Board; runtime edits remain disabled in this first pass.',
    'Gate warnings: rights, safety, privacy, venue, accessibility, copy, media, technical disclosure, and brand-affiliation gates must be resolved before public or show-ready output.',
    'Timeline/GEN rule: ' . $module['timeline_rule'],
    'Future note: persistence, uploads, publishing, and edits require authentication, permissions, audit trails, backups, rollback, and source-revision tracking.',
]);
