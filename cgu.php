<?php
session_start();
$title = "CGU";

ob_start();

if (isset($_SESSION['account'])) {
    if($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    }
}

include_once 'views/cgu.html';

$body = ob_get_clean();

include_once "views/components/template.php";
