<?php
require_once(__DIR__ . '/../connectToDB.php');

if (isset($_POST['productId'])) {
    session_start();

    if (!isset($_SESSION) || !isset($_SESSION['account'])) {
        die();
    };

    $userId = $_SESSION['account']['id_utilisateur'];
    echo addProduct($_POST['productId'], $userId);
}

function addProduct(int $productId, int $userId): ?bool {
    try {
        $pdo = connectToDB();
        
        $sql = "INSERT IGNORE INTO `panier_produits` (id_utilisateur, id_produit_fini) VALUES (:valUserId, :valProductId)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUserId", $userId);
        $stmt->bindParam(":valProductId", $productId);
        $bool = $stmt->execute();
        $stmt->closeCursor();
        
        return $bool;
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
