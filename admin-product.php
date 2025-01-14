<?php
session_start();

$title = "Administration Produits | Makerhub";

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
}

ob_start();
require('modele/catalog/offer/getOffers.php'); 
$products = getOffers();
include_once 'views/admin/admin-product.html';

$body = ob_get_clean();

include_once "views/components/template.php";

?>