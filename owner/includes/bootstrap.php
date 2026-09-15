<?php
require_once __DIR__ . '/functions.php';

$config = owner_config();
$navigation = owner_navigation();
$currentPage = owner_current_page();
$currentMeta = owner_page_meta($currentPage);
$schemaFields = owner_schema_fields();
$publicSpokes = owner_public_spokes();
$bootPlan = owner_ssot_json('owner_site_boot_plan.json');
