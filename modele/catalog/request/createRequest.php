<?php

require_once "./modele/connectToDB.php";

function createRequest(string $title, string $description, int $userId, ?string $imagePath, ?string $stlFilePath): ?bool
{
    try {
        $pdo = connectToDB();
        $sql = "INSERT INTO `produit_demande` (reference, titre, description, demandeur_id, chemin_image, chemin_fichier) VALUES (
            :valReference,
            :valTitle,
            :valDescription,
            :valUserId,
            :valImagePath,
            :valStlFilePath
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
        $stmt->bindParam(":valImagePath", $imagePath);
        $stmt->bindParam(":valStlFilePath", $stlFilePath);

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
