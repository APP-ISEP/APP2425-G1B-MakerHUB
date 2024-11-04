<?php
session_start();

$title = "Accueil";
$isAuthPage = false;

ob_start();

include_once 'main.html';

$body = ob_get_clean();

include_once "views/components/template.php";
