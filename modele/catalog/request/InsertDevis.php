<?php
require_once "./php/connectToDB.php";


function insertDevis(int $idProduit,int $fournisseur_id, int $prixProduit, int $prixLivraison, $dateLivraison, string $commentaire)
{
    try {
        $pdo = connectToDB();
        $sql = "INSERT INTO devis (produit_demande_id, fournisseur_id, prix_produit, prix_livraison, date_livraison_estimee, commentaire) VALUES (:idProduit, :idFournisseur, :prixProduit, :prixLivraison, :dateLivraison, :commentaire)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':idProduit' => $idProduit,
            ':idFournisseur' => $fournisseur_id,
            ':prixProduit' => $prixProduit,
            ':prixLivraison' => $prixLivraison,
            ':dateLivraison' => $dateLivraison,
            ':commentaire' => $commentaire,
        ]);
        var_dump( "Record inserted successfully");
        $stmt->closeCursor();
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
function test_input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}