<?php
session_start();

$title = "Administration Product | Makerhub";

ob_start();
require('php/faq/getProducts.php'); 
$products = getProduct();
include_once 'views/admin-product.html';

$body = ob_get_clean();

include_once "views/components/template.php";

?>