<?php
require_once 'config/constants.php';
include 'config/autoload.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Vérifier le jeton dans la base de données
    $stmt = $conn->prepare("SELECT * FROM users WHERE token = :valtoken AND is_verified = 0");
    $stmt->execute(['token' => $token]);
    $user = $stmt->fetch();

    if ($user) {
        // Activer le compte
        $stmt = $conn->prepare("UPDATE users SET is_verified = 1, validation_token = NULL WHERE validation_token = :token");
        $stmt->execute(['token' => $token]);

        echo "Votre compte a été validé avec succès. Vous pouvez maintenant vous connecter.";
        header("Refresh: 3; URL=log-in.php"); 
    } else {
        echo "Lien de validation invalide ou déjà utilisé.";
    }
} else {
    echo "Aucun jeton fourni.";
}
