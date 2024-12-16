<?php
session_start();

$title = "Administration | Makerhub";

ob_start();

include_once 'views/admin-menu.html';

$body = ob_get_clean();

include_once "views/components/template.php";
