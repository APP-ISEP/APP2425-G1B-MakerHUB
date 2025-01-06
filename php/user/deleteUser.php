<?php
require_once(__DIR__ . '/../connectToDB.php');

if (isset($_POST['id'])) 
{
    $id = $_POST['id'];
    deleteUser($id);
}else{
    echo 'id non défini';
}

function deleteUser(int $id): bool
{
    try {
        echo 'Je suis dans la function';
        $pdo = connectToDB();

        $sql = "UPDATE utilisateur
            SET est_actif = 0,
                inactif_depuis = ?
            WHERE id_utilisateur = ?;";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(1, date("Y-m-d H:i:s"));
        $stmt->bindParam(2, $id);

        $bool = $stmt->execute();
        $stmt->closeCursor();

        echo $stmt;

        //return $bool;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return false;
    }
}