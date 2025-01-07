<?php

require_once(__DIR__ . '/../connectToDB.php');



function getUser(string $email): ?array
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT * FROM `utilisateur` WHERE mail=:valEmail and est_actif = 1;";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valEmail", $email);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $account = null;
        if (count($results) > 0)
            $account = $results[0];
        
        $stmt->closeCursor();
        return $account;
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}

function getUsers(): ?array
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT * FROM `utilisateur` WHERE est_actif = 1;";

        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $account = null;
        if (count($results) > 0)
            $account = $results[0];
        
        $stmt->closeCursor();
        return $account;
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}

?>
