<?php

$account = $_SESSION['account'];
$id_account = $account['id_utilisateur'];



require_once(__DIR__ . '/../connectToDB.php');

function getDevis($id_account)
{


    $db = connectToDB();
    $query = "select *
    from devis d
    join produit_demande pd on pd.id_produit_demande = d.produit_demande_id
    join statut_commande sc on sc.id_statut_commande = d.statut_devis_id
    WHERE pd.demandeur_id = :id_account OR d.fournisseur_id = :id_account
    ORDER BY d.cree_a desc";
    
    try {
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_account', $id_account, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    } catch (PDOException $e) {
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }

}
?>