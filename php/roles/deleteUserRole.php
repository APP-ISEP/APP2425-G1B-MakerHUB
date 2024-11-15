<?php
require_once "./php/connectToDB.php";

function deleteUserRole(int $userId, int $roleId): bool
{
    try {
        $pdo = connectToDB();
        $sql = "DELETE FROM `role_utilisateur` WHERE utilisateur_id = :valUserId AND role_id = :valRoleId";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUserId", $userId);
        $stmt->bindParam(":valRoleId", $roleId);

        $bool = $stmt->execute();
        $stmt->closeCursor();

        return $bool;
    } catch (PDOException $e) {
        // Erreur à l'exécution de la requête
        $erreur = $e->getMessage();
        echo mb_convert_encoding("Erreur d'accès à la base de données : $erreur \n", 'UTF-8', 'UTF-8');
        return false;
    }
}
