<?php
require_once(__DIR__ . '/../connectToDB.php');

function getProductsByUserId(int $userId): ?array {
    try {
        $pdo = connectToDB();

        $sql = "SELECT pf.id_produit_fini, pf.titre, pf.description, pf.prix
                FROM panier_produits pp
                INNER JOIN produit_fini pf ON pp.id_produit_fini = pf.id_produit_fini
                WHERE pp.id_utilisateur = :valUserId";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUserId", $userId);
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
