<?php
require_once(__DIR__ . '/../connectToDB.php');


function insertUser(string $nom, string $prenom, string $pseudonyme, string $email, string $hashedPassword, string $telephone)
{
    try {
        $pdo = connectToDB();
        $sql = "INSERT INTO utilisateur (nom, prenom, pseudonyme, mail, mot_de_passe, telephone) VALUES (:nom, :prenom, :pseudonyme, :email, :motDePasse, :telephone)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':pseudonyme' => $pseudonyme,
            ':email' => $email,
            ':motDePasse' => $hashedPassword,
            ':telephone' => $telephone
        ]);

        $stmt->closeCursor();
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}


function verifyUsername(string $pseudonyme): ?bool
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT * FROM `utilisateur` WHERE pseudonyme=:valUsername";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valUsername", $pseudonyme);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return count($results) === 0;

    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}

function verifyMail(string $email): ?bool
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT * FROM `utilisateur` WHERE mail=:valMail";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valMail", $email);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        $bool = count($results);

        return $bool === 0;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
