<?php
$title = "CGU";

ob_start();

include_once 'views/gcu.html';

$body = ob_get_clean();

include_once "views/components/template.php";