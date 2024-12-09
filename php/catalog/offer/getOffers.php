<?php

require_once "./php/connectToDB.php";
function getOffers(): ?array
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT * FROM `produit_fini`";

        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $offers = null;
        if (count($results) > 0)
            $offers = $results;
        $stmt->closeCursor();
        return $offers;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
