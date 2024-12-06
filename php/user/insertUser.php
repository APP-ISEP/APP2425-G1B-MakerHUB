<?php
require_once "./php/connectToDB.php";

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

// TODO à faire le truc là
function VerifiePseudonyme(string $pseudonyme){ //REVOIR COMPLETEMENT, C'EST JUSTE UN RAPPEL POUR QUE JE LE FASSE.
    try{
        $pdo=connectToDB();
        $sql="Select * FROM utilisateur WHERE pseudonyme = :valPseudo";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valPseudo", $pseudonyme);
    }
    catch(PDOException $e) {   
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}