<?php
require_once "./php/connectToDB.php";
function createOffer(string $title, string $description, float $price, string $status, int $userId): ?bool
{
    try {
        $pdo = connectToDB();
        $sql = "INSERT INTO `produit_fini` (titre, description, prix, statut_impression, vendeur_id) VALUES (
            :valTitle,
            :valDescription,
            :valPrix,
            :valStatutImpression,
            :valUserId
        )";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valTitle", $title);
        $stmt->bindParam(":valDescription", $description);
        $stmt->bindParam(":valPrix", $price);
        $stmt->bindParam(":valStatutImpression", $status);
        $stmt->bindParam(":valUserId", $userId);

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
