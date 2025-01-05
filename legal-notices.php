<?php
session_start();
$title = "Mentions légales";

if (isset($_SESSION['account'])) {
    if($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    }
}

ob_start();

include_once 'views/legal-notices.html';

$body = ob_get_clean();

include_once "views/components/template.php";
