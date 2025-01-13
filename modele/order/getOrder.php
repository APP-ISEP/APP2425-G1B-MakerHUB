<?php

$account = $_SESSION['account'];
$id_account = $account['id_utilisateur'];


require_once("connectToDB.php");

function getOrder($id_account)
{


    $db = connectToDB();
    $query = "SELECT commande.cree_a,id_produit_fini,chemin_image,prix,description,titre
    FROM commande 
    left join produit_fini on produit_fini.commande_id = commande.id_commande 
    left join id_statut_commande on statut_commande.id_statut_commande =commande.statut_commande_id
    WHERE commande.utilisateur_id = ? ORDER BY commande.cree_a desc";
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