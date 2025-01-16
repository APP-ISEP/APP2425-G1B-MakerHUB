<?php

require_once "./modele/connectToDB.php";

function getOffers($minPrice = 0, $maxPrice = 99999.99, $search = null): ?array
{
    try {
        $pdo = connectToDB();
        if (isset($search)) {
            $sql = "SELECT * FROM `produit_fini` WHERE `prix` >= $minPrice AND `prix` <= $maxPrice AND (`titre` LIKE '%$search%' OR `description` LIKE '%$search%') AND est_actif = 1 AND commande_id IS NULL";
        }
        else {
            $sql = "SELECT * FROM `produit_fini` WHERE `prix` >= $minPrice AND `prix` <= $maxPrice AND est_actif = 1 AND commande_id IS NULL";
        }        

        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $offers = null;
        if (count($results) > 0)
            $offers = $results;
        $stmt->closeCursor();
        return $offers;
        
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
