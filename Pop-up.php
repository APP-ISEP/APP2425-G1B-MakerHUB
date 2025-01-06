<?php
session_start();
$title = "PopUP";
$errors = array();

ob_start();
include_once 'php/catalog/offer/getOffers.php';
include_once 'php/catalog/request/getRequests.php';

if (isset($_SESSION['account'])) {
    header("Location: index.php");
}

$offers = getOffers();
$requests = getRequests();

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
if (isset($_POST) && count($_POST) > 0) {
    $prixProduit = test_input($_POST["prixProduit"]);
    $prixLivraison = test_input($_POST["prixLivraison"]);
    $dateLivraison = test_input($_POST["dateLivraison"]);
    $commentaire = test_input($_POST["commentaire"]);

    if(!isset($_POST['prixProduit'])){
        $errors['prixProduit'] = "Le champ est obligatoire";
    }
    if(!isset($_POST['prixLivraison'])){
        $errors['prixLivraison'] = "Le champ est obligatoire";
    }
    if(!isset($_POST['dateLivraison'])){
        $errors['dateLivraison'] = "Le champ est obligatoire";
    }
    if (empty($errors)) {
            $result = insertDevis($prixProduit, $prixLivraison, $dateLivraison, $commentaire);
            $account = getUser($email);
            $_SESSION['account'] = $account;
            $_SESSION['username'] = $account['pseudonyme'];
            header("Location: index.php");
        
    }
}



include_once 'views/Pop-up_Devis.html';

$body = ob_get_clean();

include_once "views/components/template.php";