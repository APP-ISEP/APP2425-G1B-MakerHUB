<?php
require_once "./modele/connectToDB.php";
require_once "./modele/catalog/request/getRequests.php";
require_once "./modele/user/getUser.php";


function insertDevis(int $idProduit,int $fournisseur_id, int $prixProduit, int $prixLivraison, $dateLivraison, string $commentaire)
{
    var_dump($idProduit);
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
        
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }

    $request = getRequestId($idProduit);
    $user = getUserId($request['demandeur_id']);
    $fournisseur = getUserId($fournisseur_id);
    $newDate = new DateTime($dateLivraison);
    $dateLivraison = $newDate->format('d') . " " . strftime('%B', $newDate->getTimestamp()) . ' ' . $newDate->format('Y');

    $to = $user['mail'];
    $from = "no-reply@makerhub.fr";
    $subject = "[MakerHub] Nouveau devis : " . $request['reference'];
    $message = "
        <html>
            <head>
                <title>Devis</title>
            </head>

            <body>
                <h1>Devis</h1><br>
                <p>Vous avez reçu un devis de la part de " . $fournisseur['pseudonyme'] . " d'un montant total de : " . ($prixLivraison + $prixProduit) . " € (livraison incluse).</p>
                <p>Le fournisseur prévoit de l'envoyer vers le " . $dateLivraison . "</p>
                <p>Vous pouvez le consulter dès maintenant depuis votre <a href=\"https://makerhub.fr/devis-history.php\">historique de commande</a>.</p><br><br>
                <p>Merci de votre confiance.</p><br>
                <p>L'équipe de MakerHub.</p>
            </body>
        </html>
        ";

    $headers = "From: " . $from . "\r\n" . 
                "Content-Type: text/html; charset=UTF-8\r\n" .
                "MIME-Version: 1.0\r\n";

    if(mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully.";
    } else {
        echo "Failed to send email.";
    }
}