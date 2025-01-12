<?php
require_once(__DIR__ . '/../connectToDB.php');

/**
 * @param string $nom
 * @param string $prenom
 * @param string $pseudonyme
 * @param string $email
 * @param string $hashedPassword
 * @param string $telephone
 * @param string $description
 * @param string $role
 * @param string $token
 * @return int|null
 */
function insertUser(string $nom, string $prenom, string $pseudonyme, string $email, string $hashedPassword, string $telephone, string $description, string $role, string $token): ?int
{
    try {
        $pdo = connectToDB();
        $sql = "INSERT INTO utilisateur (nom, prenom, pseudonyme, mail, mot_de_passe, description, telephone, token, is_verified) VALUES (:nom, :prenom, :pseudonyme, :email, :motDePasse, :description, :telephone, :valToken,0)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':pseudonyme' => $pseudonyme,
            ':email' => $email,
            ':motDePasse' => $hashedPassword,
            ':description' =>$description,
            ':telephone' => $telephone,
            ':valToken' => $token
        ]);

        $sql = "INSERT INTO role_utilisateur (role_id, utilisateur_id) VALUES ((SELECT id_role FROM role WHERE nom = :role), (SELECT id_utilisateur FROM utilisateur WHERE mail = :email))";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':role' => $role,
            ':email' => $email
        ]);

        $stmt->closeCursor();
        return $pdo->lastInsertId(); 
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

        return count($results) === 0;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}