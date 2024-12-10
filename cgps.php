<?php
session_start();
$title = "CGPS";

ob_start();

include_once 'views/cgps.html';

$body = ob_get_clean();

include_once "views/components/template.php";
