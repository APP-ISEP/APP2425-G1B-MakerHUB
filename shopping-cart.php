<?php
session_start();
$title = "Panier";

ob_start();

if (!isset($_SESSION) || !isset($_SESSION['account'])) {
    header("Location: ./log-in.php");
    die();
};



include_once 'views/shopping-cart.html';

$body = ob_get_clean();

include_once "views/components/template.php";
