<?php
require_once "./php/connectToDB.php";

function getByUserId(int $userId): ?array
{
    try {
        $pdo = connectToDB();

        /*
        $sql = "INSERT INTO `produit_fini` (titre, description, prix, vendeur_id) VALUES (
            :valTitle,
            :valDescription,
            :valPrix,
            :valUserId
        )";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valTitle", $title);
        $stmt->bindParam(":valDescription", $description);
        $stmt->bindParam(":valPrix", $price);
        $stmt->bindParam(":valUserId", $userId);
        */

        $sql = ...;

        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = null;
        if (count($results) > 0)
            $products = $results;

        $stmt->closeCursor();
        return $products;
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
