<?php
require_once "./modele/connectToDB.php";
/**
 * Retourne le rôle de l'utilisateur
 * Attention, ne marche que si l'utilisateur n'a qu'un seul role
 * @param int $userId
 * @return string|null
 */
function getUserRole(int $userId): ?string
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT r.nom
        FROM `role_utilisateur`
        JOIN role r on role_utilisateur.role_id = r.id_role
        WHERE utilisateur_id=:valUserId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUserId", $userId);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $userRole = $results[0]['nom'];
        $stmt->closeCursor();
        return $userRole;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}