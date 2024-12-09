<?php

require_once "./php/connectToDB.php";
function getRequests(): ?array
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT * FROM `produit_demande`";

        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $requests = null;
        if (count($results) > 0)
            $requests = $results;
        $stmt->closeCursor();
        return $requests;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
