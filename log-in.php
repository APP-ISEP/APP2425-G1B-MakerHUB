<?php
$title = "Se connecter";

ob_start();

include_once 'views/log-in.html';

$body = ob_get_clean();

include_once "views/components/template-login-signup.php";