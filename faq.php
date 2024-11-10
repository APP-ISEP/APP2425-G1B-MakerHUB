<?php
$title = "FAQ";
$isAuthPage = false;

ob_start();

include_once 'views/faq.html';

$body = ob_get_clean();

include_once "views/components/template.php";