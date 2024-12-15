<?php
session_start();
$title = "CGU";

ob_start();

include_once 'views/cgu.html';

$body = ob_get_clean();

include_once "views/components/template.php";
