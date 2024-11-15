<?php
require_once "./php/connectToDB.php";

function getUserRoles(int $userId): ?array
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT * FROM `role_utilisateur` WHERE utilisateur_id=:valUserId";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUserId", $userId);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $user_roles = null;
        if (count($results) > 0)
            $user_roles = $results[0];
        
        $stmt->closeCursor();
        return $user_roles;
    } catch (PDOException $e) {
        // Erreur à l'exécution de la requête
        $erreur = $e->getMessage();
        echo mb_convert_encoding("Erreur d'accès à la base de données : $erreur \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
