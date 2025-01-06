<?php
session_start();

$title = "Administration Product | Makerhub";

ob_start();
require('php/catalog/offer/getOffers.php'); 
$products = getOffers();
include_once 'views/admin-product.html';

$body = ob_get_clean();

include_once "views/components/template.php";

?>