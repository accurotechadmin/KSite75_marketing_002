<?php
require __DIR__.'/includes/bootstrap.php';
include __DIR__.'/partials/header.php';
$pageFile=__DIR__.'/pages/'.$currentPage.'.php';
if(is_readable($pageFile)) include $pageFile; else include __DIR__.'/pages/dashboard.php';
include __DIR__.'/partials/footer.php';
