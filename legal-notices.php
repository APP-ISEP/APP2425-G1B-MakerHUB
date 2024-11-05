<?php
$title = "Mentions légales";

ob_start();

include_once 'views/legal-notices.html';

$body = ob_get_clean();

include_once "views/components/template.php";