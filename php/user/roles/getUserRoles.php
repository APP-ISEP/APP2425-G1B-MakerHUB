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

        $userRoles = null;
        if (count($results) > 0)
            $userRoles = $results;
        $stmt->closeCursor();

        return $userRoles;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
