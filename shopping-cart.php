<?php

use Config\Ftp\FTP;

require_once 'config/constants.php';
include 'autoload.php';

session_start();
$ftpInstance = FTP::getInstance();
$title = "Mon panier";

ob_start();

if (isset($_SESSION['account'])) {
    if($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    }
    if ($_SESSION['role'] !== 'acheteur') {
        header("Location: index.php");
    }
}

if (!isset($_SESSION) || !isset($_SESSION['account'])) {
    header("Location: ./log-in.php");
    die();
};

include_once("./php/shopping-cart/getProductsByUserId.php");
$products = getProductsByUserId($_SESSION['account']['id_utilisateur']);

foreach($products as $product) {
    $ftpInstance->getFile($product['chemin_image']);
}

if (isset($_POST) && count($_POST) > 0) {
    include_once("./php/shopping-cart/deleteProduct.php");

    // delete the product in the shopping-cart then refresh products array
    $isDeleted = deleteProduct($_POST['productId'], $_SESSION['account']['id_utilisateur']);
    $products = getProductsByUserId($_SESSION['account']['id_utilisateur']);
}


include_once 'views/shopping-cart.html';

$body = ob_get_clean();

include_once "views/components/template.php";
