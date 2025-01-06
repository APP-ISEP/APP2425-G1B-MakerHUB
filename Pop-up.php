<?php
session_start();
$title = "PopUP";
$errors = array();

ob_start();
include_once 'php/catalog/offer/getOffers.php';
include_once 'php/catalog/request/getRequests.php';
include_once 'php/catalog/request/InsertDevis.php';

// if (isset($_SESSION['account']) && isset($_SESSION['account']['id_utilisateur'])) {
//     $idFournisseur = $_SESSION['account']['id_utilisateur'];
//     var_dump('idPresent');
// } else {
//     var_dump('Pas utilisateur');
//     $errors['user'] = "Utilisateur non connecté.";
// }
$idFournisseur = 1;

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
    $prixProduit = intval($_POST["prixProduit"]);
    $prixLivraison = intval($_POST["prixLivraison"]);
    $dateLivraison = $_POST["dateLivraison"];
    $commentaire = test_input($_POST["Commentaire"]);
    $idProduit = intval($_POST['idProduit']);
   
    if(!isset($_POST['prixProduit'])){
        var_dump($prixProduit);
        $errors['prixProduit'] = "Le champ est obligatoire";
    }
    if(!isset($_POST['prixLivraison'])){
        var_dump($prixLivraison);
        $errors['prixLivraison'] = "Le champ est obligatoire";
    }
    if(!isset($_POST['dateLivraison'])){
        var_dump($prixLivraison);
        $errors['dateLivraison'] = "Le champ est obligatoire";
    }
    if(!isset($_POST['idProduit'])){
        var_dump($idProduit);
        $errors['Id'] = "Produit pas trouvé";
    }
   

    if (empty($errors)) {
            $result = insertDevis($idProduit, $idFournisseur, $prixProduit, $prixLivraison, $dateLivraison, $commentaire);
            header("Location: index.php");
        
    }
}



include_once 'views/Pop-up_Devis.html';

$body = ob_get_clean();

include_once "views/components/template.php";