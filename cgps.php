<?php
session_start();
$title = "CGPS";

ob_start();

if (isset($_SESSION['account'])) {
    if($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    }
}

include_once 'views/cgps.html';

$body = ob_get_clean();

include_once "views/components/template.php";
