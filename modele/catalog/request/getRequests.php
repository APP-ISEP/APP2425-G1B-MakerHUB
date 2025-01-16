<?php

require_once "./modele/connectToDB.php";

function getRequests($search = null): ?array
{
    try {
        $pdo = connectToDB();

        if (isset($search)) {
            $sql = "SELECT * FROM `produit_demande` WHERE `titre` LIKE '%$search%' OR `description` LIKE '%$search%' AND est_actif = 1";
        }
        else {
            $sql = "SELECT * FROM `produit_demande` WHERE est_actif = 1";
        }

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

function getRequestId(string $id): ?array
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT * FROM `produit_demande` WHERE `id_produit_demande` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $request = null;
        if (count($results) > 0)
            $request = $results[0];
        $stmt->closeCursor();
        return $request;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}