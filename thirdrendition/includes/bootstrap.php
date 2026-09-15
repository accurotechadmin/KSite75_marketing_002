<?php
require_once __DIR__ . '/functions.php';
$config = tr_config();
$navigation = tr_nav();
$currentPage = tr_current_page();
$currentMeta = tr_meta($currentPage);
$records = tr_records();
