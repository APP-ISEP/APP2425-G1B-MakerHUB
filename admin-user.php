<?php
session_start();

$title = "Administration User | Makerhub";

ob_start();

include_once 'views/admin-user.html';

$body = ob_get_clean();

include_once "views/components/template.php";
