<?php
require_once(__DIR__ . '/../../connectToDB.php');


if (isset($_POST['id'])){
    $id = $_POST['id'];
    deleteOffer($id);
}

function deleteOffer(string $id): ?bool{
    try {
        $pdo = connectToDB();
        $sql = "UPDATE `produit_fini` SET `est_actif` = 0, inactif_depuis = ? WHERE `id_produit_fini` = ?";
        
        $date= date("Y-m-d H:i:s");
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $date);
        $stmt->bindParam(2, $id);
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