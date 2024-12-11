<?php
session_start();

$title = "Accueil";

ob_start();

include_once 'php/catalog/offer/getOffers.php';
include_once 'php/catalog/request/getRequests.php';

$offers = getOffers();
$requests = getRequests();

if (isset($_GET) && isset($_GET['offers-search'])) {
    echo "search filter";
    $offers = getOffers($_GET['min-price'], $_GET['max-price'], $_GET['offers-search']);
}
else if (isset($_GET) && isset($_GET['requests-search'])) {
    $requests = getRequests($_GET['requests-search']);
}

include_once 'main.html';


$body = ob_get_clean();

include_once "views/components/template.php";
