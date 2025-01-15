<?php
require_once "./modele/connectToDB.php";

function updateUserRole(int $userId, int $roleId): ?bool
{
    try {
        $pdo = connectToDB();
        $sql = "UPDATE `utilisateur` SET role_id = :valRoleId WHERE id_utilisateur = :valUserId";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valRoleId", $roleId);
        $stmt->bindParam(":valUserId", $userId);
        $stmt->execute();
        $stmt->closeCursor();

        $bool = $stmt->execute();
        $stmt->closeCursor();

        return $bool;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}