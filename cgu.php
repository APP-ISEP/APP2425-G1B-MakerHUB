<?php
$title = "CGU";
$isAuthPage = false;

ob_start();

include_once 'views/cgu.html';

$body = ob_get_clean();

include_once "views/components/template.php";