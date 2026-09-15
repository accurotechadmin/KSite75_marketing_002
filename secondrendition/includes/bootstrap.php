<?php
require_once __DIR__ . '/functions.php';
$config = sr_config();
$navigation = sr_nav();
$currentPage = sr_current_page();
$currentMeta = sr_meta($currentPage);
$records = sr_records();
