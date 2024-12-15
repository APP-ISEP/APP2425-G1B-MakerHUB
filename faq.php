<?php
session_start();
$title = "FAQ";

ob_start();

include_once 'php/faq/getFaq.php';

$faq = getFaq();

include_once 'views/faq.html';

$body = ob_get_clean();

include_once "views/components/template.php";
