<?php
session_start();
$title = "Paiement";
//Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['account'])){
     header("Location: log-in.php");
     exit();
}
//vérifier si l'utilisateur est un admin
if($_SESSION['role'] === ['admin']) {
    header("Location: admin.php");
    exit();
}
//Récupérer les produits de l'utilisateur
include_once 'modele/shopping-cart/getProductsByUserId.php';
$products = getProductsByUserId($_SESSION['account']['id_utilisateur']);


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //récup les données du form 
    
    $cardNumber = htmlspecialchars($_POST['card-number']);
    $expiryDate = htmlspecialchars($_POST['expiry-date']);
    $cvv = htmlspecialchars($_POST['cvv']);
    $totalPrice = htmlspecialchars($_POST['total-price']);
    $userId = $_SESSION['account']['id_utilisateur'];

    //connexion à la bdd
    include_once 'modele/connectToDB.php';
    $pdo = connectToDB();

    //stocker les infos de paiement dans la bdd
    $sql = "INSERT INTO paiements (user_id, card_number, expiry-date, cvv, total-price) VALUES (:user_id, :card-number, :expiry-date, :cvv, :total-price)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":card-number", $cardNumber);
    $stmt->binParam(":expiry-date", $expiryDate);
    $stmt->bindParam(":cvv", $cvv);
    $stmt->bindParam(":total-price", $totalPrice);
    $stmt->execute();

    //metttre à jour l'étatde la commande
    $sql = "UPDATE commandes SET etat='payée', data_paiement=NOW() WHere user_id=:user_id AND etat='en attente'";
    $stmt =$pdo->prepare($sql);
    $stmt->bindParam(":user_id", $userId);
    $stmt->execute();

    //rediriger vers la page de confirmantion de la commande


}

ob_start();

include_once './views/paymentPage.html';

$body = ob_get_clean();

include_once "./views/components/template.php";
?>