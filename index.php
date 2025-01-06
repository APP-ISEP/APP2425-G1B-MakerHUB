<?php

use Config\Ftp\FTP;

require_once 'config/constants.php';
include 'autoload.php';

session_start();
$ftpInstance = FTP::getInstance();
$title = "Accueil";

// Rediriger l'utilisateur sur le panel admin s'il est admin
if (isset($_SESSION['account'])) {
    if($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    }
}

ob_start();

include_once 'php/catalog/offer/getOffers.php';
include_once 'php/catalog/request/getRequests.php';


$offers = getOffers();
$requests = getRequests();

// charger toutes les images à l'avance
foreach ($offers as $offer) {
    $ftpInstance->getFile($offer['chemin_image']);
}
foreach ($requests as $request) {
    $ftpInstance->getFile($request['chemin_image']);
}

$minPrice = 0;
$maxPrice = 99999.99;
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
