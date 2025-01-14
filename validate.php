<?php
require_once 'config/constants.php';
require_once 'modele/connectToDB.php';
include 'config/autoload.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $pdo = connectToDB();
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE token = :valtoken AND is_verified = 0");
    $stmt->execute([
        ':valtoken' => $token
    ]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur) {
        $stmt = $pdo->prepare("UPDATE utilisateur SET is_verified = 1, token = NULL WHERE token = :valtoken");
        $stmt->execute([
            ':valtoken' => $token
        ]);
    $to = $utilisateur['mail'];
    $subject = 'Compte validé';
    $message = "<html>
                    <head>
                        <title>Inscription</title>
                    </head>
        
                    <body>
                        <h1>Validation de votre inscription</h1><br>
                        <p>Votre compte a été confirmé. Maintenant vous pouvez vous connecter.</p><br><br>
                        <p>Merci de votre confiance.</p><br>
                        <p>L'équipe de MakerHub.</p>
                    </body>
                </html>";
    $from = "fazi.serena04@gmail.com";
    $headers = "From: " . $from . "\r\n" . 
                        "Content-Type: text/html; charset=UTF-8\r\n" .
                        "MIME-Version: 1.0\r\n";
    mail($to, $subject, $message, $headers);
        header("Location: log-in.php"); 
    } else {
        echo "Lien de validation invalide ou déjà utilisé.";
    }
} else {
    echo "Aucun jeton fourni.";
}
