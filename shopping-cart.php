<?php

use Config\Ftp\FTP;

require_once 'config/constants.php';
include 'config/autoload.php';

session_start();
$ftpInstance = FTP::getInstance();
$title = "Mon panier";

ob_start();

if (isset($_SESSION['account'])) {
    if ($_SESSION['role'] === 'admin') {
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

include_once("./modele/shopping-cart/getProductsByUserId.php");
$products = getProductsByUserId($_SESSION['account']['id_utilisateur']);

if (!is_null($products)) {
    foreach ($products as $product) {
        $ftpInstance->getFile($product['chemin_image']);
    }
}

if (isset($_POST) && count($_POST) > 0) {
    include_once("./modele/shopping-cart/deleteProduct.php");

    // supprime le produit du panier de l'utilisateur
    $productId = $_POST['productId'];
    $isDeleted = deleteProduct($productId, $_SESSION['account']['id_utilisateur']);

    // supprimer le produit de la liste des produits à afficher
    if ($isDeleted) {
        $products = array_filter(
            $products,
            fn($product) => $product['id_produit_fini'] != $productId
        );
    }
}

include_once 'views/shopping-cart.html';

$body = ob_get_clean();

include_once "views/components/template.php";
