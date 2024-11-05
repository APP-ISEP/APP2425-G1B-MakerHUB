<?php
$title = "FAQ";

ob_start();

include_once 'views/faq.html';

$body = ob_get_clean();

include_once "views/components/template.php";