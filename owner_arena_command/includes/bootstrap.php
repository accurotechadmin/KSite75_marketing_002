<?php
session_start();
require_once __DIR__.'/functions.php'; require_once __DIR__.'/ssot.php'; require_once __DIR__.'/records.php';
ac_handle_post();
$config=ac_config(); $navigation=ac_nav(); $currentPage=ac_current_page(); $currentMeta=ac_page_meta($currentPage); $schemaFields=ac_schema(); $records=ac_records();
