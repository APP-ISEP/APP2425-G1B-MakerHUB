<?php
session_start();

$title = "Accueil";

ob_start();

include_once 'main.html';

$body = ob_get_clean();

include_once "views/components/template.php";