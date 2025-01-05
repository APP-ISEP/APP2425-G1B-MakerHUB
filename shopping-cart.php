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


if (isset($_POST) && count($_POST) > 0) {
    include_once("./php/shopping-cart/deleteProduct.php");

    // delete the product in the shopping-cart then refresh products array
    $isDeleted = deleteProduct($_POST['productId'], $_SESSION['account']['id_utilisateur']);
    $products = getProductsByUserId($_SESSION['account']['id_utilisateur']);
}


include_once 'views/shopping-cart.html';

$body = ob_get_clean();

include_once "views/components/template.php";
