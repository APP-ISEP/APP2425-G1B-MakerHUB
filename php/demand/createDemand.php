<?php
require_once "./php/connectToDB.php";
function createDemand(string $title, string $description, int $userId): ?bool
{
    try {
        $pdo = connectToDB();
        $sql = "INSERT INTO `produit_demande` (reference, titre, description, demandeur_id) VALUES (
            :valReference,
            :valTitle,
            :valDescription,
            :valUserId
        )";

        // 3 octets donnent 6 caractères hexadécimaux
        $bytes = random_bytes(3);
        $randomRef = bin2hex($bytes);
        $reference = "REF-" . strtoupper($randomRef);

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valReference", $reference);
        $stmt->bindParam(":valTitle", $title);
        $stmt->bindParam(":valDescription", $description);
        $stmt->bindParam(":valUserId", $userId);

        $bool = $stmt->execute();
        $stmt->closeCursor();

        return $bool;
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
