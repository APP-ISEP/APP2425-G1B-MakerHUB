<?php
session_start();
$title = "Inscription";

ob_start();

include_once 'views/sign-up.html';
require_once 'controleur/SignUpControleur.php'
require_once 'modele/SignUpModele.php';

$body = ob_get_clean();

include_once "views/components/template.php";
