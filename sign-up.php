<?php
$title = "Inscription";

ob_start();

include_once 'views/sign-up.html';

$body = ob_get_clean();

include_once "views/components/template.php";