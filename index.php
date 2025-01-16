<?php

use Config\Ftp\FTP;

require_once 'config/constants.php';
include __DIR__ . '/config/autoload.php';
include __DIR__ . '/modele/user/checkCredentials.php';
include __DIR__ . '/modele/catalog/request/insertDevis.php';

session_start();

$ftpInstance = FTP::getInstance();
$title = "Accueil";

// Rediriger l'utilisateur sur le panel admin s'il est admin
if (isset($_SESSION['account'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    }
}

ob_start();

include_once 'modele/catalog/offer/getOffers.php';
include_once 'modele/catalog/request/getRequests.php';


if (isset($_SESSION['account']['id_utilisateur'])) {
    $idFournisseur = $_SESSION['account']['id_utilisateur'];

} else {
    $errors['user'] = "Utilisateur non connecté.";
}

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

if (isset($_GET['offers-search'])) {
    $minPrice = $_GET['min-price'];
    $maxPrice = $_GET['max-price'];
    $offersSearch = $_GET['offers-search'];
    $offers = getOffers($minPrice, $maxPrice, $offersSearch);
} else if (isset($_GET['requests-search'])) {
    $requestsSearch = $_GET['requests-search'];
    $requests = getRequests($requestsSearch);
}
if (isset($_POST) && count($_POST) > 0) {

    $prixProduit = intval($_POST["prixProduit"]);
    $prixLivraison = intval($_POST["prixLivraison"]);
    $dateLivraison = $_POST["dateLivraison"];
    $commentaire = test_input($_POST["Commentaire"]);
    $idProduit = intval($_POST['idProduit']);

    if (!isset($_POST['prixProduit'])) {
        var_dump($prixProduit);
        $errors['prixProduit'] = "Le champ est obligatoire";
    }
    if (!isset($_POST['prixLivraison'])) {
        var_dump($prixLivraison);
        $errors['prixLivraison'] = "Le champ est obligatoire";
    }
    if (!isset($_POST['dateLivraison'])) {
        var_dump($prixLivraison);
        $errors['dateLivraison'] = "Le champ est obligatoire";
    }
    if (!isset($_POST['idProduit'])) {
        var_dump($idProduit);
        $errors['Id'] = "Produit pas trouvé";
    }
    if ($prixProduit <= $minPrice || $prixProduit >= $maxPrice) {
        $errors['prixProduit1'] = "Le prix doit être compris entre $minPrice et $maxPrice";
    }
    if ($prixLivraison <= $minPrice || $prixLivraison >= $maxPrice) {
        $errors['prixProduit2'] = "Le prix doit être compris entre $minPrice et $maxPrice";
    }

    if (empty($errors)) {
        $result = insertDevis($idProduit, $idFournisseur, $prixProduit, $prixLivraison, $dateLivraison, $commentaire);
        header("Location: index.php");

    } else {
        var_dump($errors);
    }
}
include_once 'main.html';

$body = ob_get_clean();

include_once "views/components/template.php";
