<?php
require_once 'config/constants.php';
include 'config/autoload.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE token = :valtoken AND is_verified = 0");
    $stmt->execute([
        ':valtoken' => $token
    ]);
    $utilisateur = $stmt->fetch();

    if ($utilisateur) {
        // Activer le compte
        $stmt = $conn->prepare("UPDATE utilisateur SET is_verified = 1, token = NULL WHERE token = :valtoken");
        $stmt->execute([
            ':valtoken' => $token
        ]);

        echo "Votre compte a été validé avec succès. Vous pouvez maintenant vous connecter.";
        header("Location: log-in.php"); 
    } else {
        echo "Lien de validation invalide ou déjà utilisé.";
    }
} else {
    echo "Aucun jeton fourni.";
}
