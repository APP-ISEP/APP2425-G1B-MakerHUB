<?php
session_start();

$title = "Accueil";

ob_start();

include_once 'php/catalog/offer/getOffers.php';
include_once 'php/catalog/request/getRequests.php';

$offers = getOffers();
$requests = getRequests();

$minPrice = 0;
$maxPrice = 10000;
$offersSearch = "";
$requestsSearch = "";

if (isset($_GET) && isset($_GET['offers-search'])) {
    $minPrice = $_GET['min-price'];
    $maxPrice = $_GET['max-price'];
    $offersSearch = $_GET['offers-search'];
    $offers = getOffers($minPrice, $maxPrice, $offersSearch);
}
else if (isset($_GET) && isset($_GET['requests-search'])) {
    $requestsSearch = $_GET['requests-search'];
    $requests = getRequests($requestsSearch);
}

include_once 'main.html';


$body = ob_get_clean();

include_once "views/components/template.php";
