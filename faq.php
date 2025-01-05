<?php
session_start();
$title = "FAQ";

if (isset($_SESSION['account'])) {
    if($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    }
}

ob_start();

include_once 'php/faq/getFaq.php';

$faq = getFaq();

include_once 'views/faq.html';

$body = ob_get_clean();

include_once "views/components/template.php";
