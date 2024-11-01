<?php
$title = "Accueil";

ob_start();

include_once 'views/faq/Faq.html';

$body = ob_get_clean();

include_once "views/components/template.php";