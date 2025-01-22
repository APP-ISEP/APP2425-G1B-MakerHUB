<?php

session_start();
$title = "Paiement";

//Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['account'])) {
    header("Location: log-in.php");
}
//vérifier si l'utilisateur est un admin
if ($_SESSION['role'] === ['admin']) {
    header("Location: admin.php");
}

ob_start();

//Récupérer les produits de l'utilisateur
include_once 'modele/shopping-cart/getProductsByUserId.php';
$id_acheteur = $_SESSION['account']['id_utilisateur'];
$products = getProductsByUserId($id_acheteur);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //récup les données du form

    $cardNumber = htmlspecialchars($_POST['card-number']);
    $expiryDate = htmlspecialchars($_POST['expiry-date']);
    $cvv = htmlspecialchars($_POST['cvv']);
    $totalPrice = htmlspecialchars($_POST['total-price']);
    $userId = $_SESSION['account']['id_utilisateur'];

    //vérifications
    if (strlen($cardNumber) != 16) {
        echo "Le numéro de carte doit contenir 16 chiffres";
    }

    if (strlen($cvv) != 3) {
        echo "Le CVV doit contenir 3 chiffres";
    }

    if (!preg_match('/^(0[0-9]|1[0-9])\/(2[0-9]|3[0-9])$/', $expiryDate)) {
        echo "Mauvais format";
    }

    //connexion à la bdd
    /*include_once 'modele/connectToDB.php';
    $pdo = connectToDB();


    //metttre à jour l'état de la commande - le brouillon
    $sql = "UPDATE commande SET statut_commande_id='payée', cree_a=NOW()  WHERE user_id=:user_id AND etat='en attente'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":user_id", $userId);
    $stmt->execute();

    //rediriger vers la page de confirmantion de la commande*/
}

include_once './views/paymentPage.html';

$body = ob_get_clean();

include_once "./views/components/template.php";
