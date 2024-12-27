<?php
require_once "./php/connectToDB.php";
require_once "./php/catalog/request/getRequests.php";


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
        $stmt->closeCursor();

        $request = getRequests($idProduit);
        $user = getUser($request['demandeur_id']);
        $fournisseur = getUser($fournisseur_id);

        $to = $user['email'];
        $from = "no-reply@makerhub.fr";
        $subject = "[MakerHub] Nouveau devis : " . $request['reference'];
        $message = "
            <html>
                <head>
                    <title>Devis</title>
                </head>

                <body>
                    <h1>Devis</h1><br>
                    <p>Vous avez reçu un devis de la part de " . $fournisseur['pseudonyme'] . " d'un montant total de : " . $prixLivraison+$prixProduit . " € (livraison incluse).</p>
                    <p>Le fournisseur prévoit de l'envoyer vers le " . $dateLivraison . "</p>
                    <p>Vous pouvez consulter dès maintenant le devis au lien suivant : <a href=\"{{ route('quote.show', $quote->id) }}\">Voir le devis</a></p><br><br>
                    <p>Merci de votre confiance.</p><br>
                    <p>L'équipe de MakerHub.</p>
                </body>
            </html>
            ";

        $headers = "From: " . $from . "\r\n" . 
                    "To: " . $to . "\r\n" .
                    "Content-Type: text/html; charset=UTF-8\r\n" .
                    "MIME-Version: 1.0\r\n";

        mail($to, $subject, $message, $headers);
        
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