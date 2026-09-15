# Priority Board Model

The Priority Board is a read-only first-pass owner command layer. It exists to keep notes, questions, current work, later work, finished items, and recovery items visible before full persistence exists.

Columns: `Notes`, `Questions`, `Now`, `Next`, `Later`, `Finished`, `Recovery`.

Required card fields: `record_id`, `title`, `module`, `type`, `classification`, `status`, `priority`, `owner_role`, `next_action`, `due_or_target`, `source_files`, `linked_records`, `summary`, `details`, `last_updated`.

Movement semantics: `Questions` suggests `needs_decision`; `Now` suggests `in_progress`; `Finished` requires a closing note; deletion moves to `Recovery` first. All changes require future auth, audit, backups, and rollback before runtime writes are allowed.
