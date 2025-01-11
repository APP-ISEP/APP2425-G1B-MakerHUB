<?php
session_start();
$title = "Paiement";

if (isset($_SESSION['account'])){
    if($_SESSION['role'] === 'admin'){
        header("Location: admin.php");
    }
}

ob_start();

include_once 'views/paymentPage.html';

$body = ob_get_clean();

include_once "views/components/template.php";
