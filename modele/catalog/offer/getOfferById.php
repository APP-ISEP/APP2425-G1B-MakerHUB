<?php
require_once(__DIR__ . '/../../connectToDB.php');


if (isset($_POST['show_product'])){
    $id = $_POST['show_product'];
    $product = getOfferById($id);
    header('Location: ./../../../admin-product.php?product='.json_encode($product).'#supprimer-produit');
    die();
}

function getOfferById(string $id): ?array{
    try {
        $pdo = connectToDB();
        $sql = "SELECT pf.titre AS titre, pf.prix AS prix, pf.`description` AS `description`, pf.chemin_image AS chemin_image , u.mail AS vendeur  FROM `produit_fini` AS pf LEFT JOIN utilisateur AS u ON u.id_utilisateur = pf.vendeur_id WHERE pf.id_produit_fini=:valId";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valId", $id);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $product = "null";
        if (count($results) > 0){
            $product = $results[0];
        }        
        $stmt->closeCursor();
        
        return $product;
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}