<?php
require_once(__DIR__ . '/../connectToDB.php');

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    deleteUser($id);
}

function deleteUser(int $id): ?bool
{
    try {
        $pdo = connectToDB();
        $sql = "UPDATE `utilisateur` SET inactif_depuis = current_timestamp(), est_actif = 0 WHERE id_utilisateur = :valId";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":valId", $id);

        $bool = $stmt->execute();
        $stmt->closeCursor();
        return $bool;

    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return false;
    }
}
