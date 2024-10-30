<?php
$title = "Éditer le profil";

ob_start();

include_once 'views/edit-profile.html';

$body = ob_get_clean();

include_once "views/components/template.php";