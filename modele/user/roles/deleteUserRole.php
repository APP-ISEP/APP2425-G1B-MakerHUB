<?php
require_once "./modele/connectToDB.php";
function deleteUserRole(int $userId, int $roleId): ?bool
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
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}