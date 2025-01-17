<?php
session_start();

$title = "Administration";

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
}

ob_start();

include_once 'views/admin/admin-menu.html';

$body = ob_get_clean();

include_once "views/components/template.php";
