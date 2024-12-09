<?php
session_start();
$title = "Politique de cookies";

ob_start();

include_once 'views/cookies.html';

$body = ob_get_clean();

include_once "views/components/template.php";
