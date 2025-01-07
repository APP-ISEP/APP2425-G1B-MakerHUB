<?php

require_once "./modele/connectToDB.php";

function createOffer(string $title, string $description, float $price, int $userId, ?string $imagePath): ?bool
{
    try {
        $pdo = connectToDB();

        $sql = "INSERT INTO `produit_fini` (titre, description, prix, vendeur_id, chemin_image) VALUES (
            :valTitle,
            :valDescription,
            :valPrix,
            :valUserId,
            :valImagePath
        )";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valTitle", $title);
        $stmt->bindParam(":valDescription", $description);
        $stmt->bindParam(":valPrix", $price);
        $stmt->bindParam(":valUserId", $userId);
        $stmt->bindParam(":valImagePath", $imagePath);

        $bool = $stmt->execute();
        $stmt->closeCursor();

        return $bool;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
