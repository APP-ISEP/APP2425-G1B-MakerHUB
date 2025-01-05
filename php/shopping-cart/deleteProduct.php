<?php
require_once(__DIR__ . '/../connectToDB.php');

function deleteProduct(int $productId, int $userId): ?bool {
    try {
        $pdo = connectToDB();

        $sql = "DELETE FROM `panier_produits` WHERE id_utilisateur = :valUserId AND id_produit_fini = :valProductId";
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
