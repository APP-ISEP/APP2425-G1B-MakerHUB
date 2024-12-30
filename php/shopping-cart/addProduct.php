<?php
require_once "./php/connectToDB.php";

function addProduct(int $productId): ?bool
{
    try {
        $pdo = connectToDB();

        $sql = "INSERT INTO panier_produit (utilisateur_id, produit_fini_id) VALUES (
            :valUserId,
            :valProduitFiniId
        )";

        $userId = $_SESSION['account']['id_utilisateur'];

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUserId", $userId);
        $stmt->bindParam(":valProduitFiniId", $productId);

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
