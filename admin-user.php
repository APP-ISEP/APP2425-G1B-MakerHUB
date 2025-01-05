<?php
session_start();

$title = "Administration User | Makerhub";

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
}

ob_start();

include_once 'views/admin/admin-user.html';

$body = ob_get_clean();

include_once "views/components/template.php";
