<?php

session_start();

$title = "Mon panier";
$isAuthPage = true;

ob_start();

if (!isset($_SESSION) || !isset($_SESSION['account'])) {
    header("Location: ./log-in.php");
    die();
};

include_once("./php/shopping-cart/getProductsByUserId.php");
$products = getProductsByUserId($_SESSION['account']['id_utilisateur']);






include_once 'views/shopping-cart.html';

$body = ob_get_clean();

include_once "views/components/template.php";
