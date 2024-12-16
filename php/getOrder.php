<?php

$account = $_SESSION['account'];
$id_account = $account['id_utilisateur'];


require_once("connectToDB.php");

function getOrder($id_account)
{


    $db = connectToDB();
    $query = "SELECT chemin_image,prix,description,titre,statut_impression 
    FROM commande left join produit_fini on produit_fini.commande_id = commande.id_commande 
    WHERE commande.utilisateur_id = ?";
    try {
        $stmt = $db->prepare($query);
        $stmt->bindparam(1, $id_account);
        $stmt->execute();

        return $stmt;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }

}
?>