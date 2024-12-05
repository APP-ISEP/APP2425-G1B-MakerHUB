<?php
require_once "./php/connectToDB.php";

function InsertUser( string $nom , string $prenom, string $pseudonyme, string $email, string $motDePasse, string $telephone)
{
    try {
        $pdo = connectToDB();
        $sql = "INSERT INTO `utilisateur` (nom, prenom,pseudonyme, mail, mot_de_passe,telephone) VALUES (:valnom,:valprenom,:valpseudo,:valmail,:valmotPasse,:valtel)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valnom", $nom);
        $stmt->bindParam(":valprenom", $prenom);
        $stmt->bindParam(":valpseudo", $pseudonyme);
        $stmt->bindParam(":valmail", $email);
        $stmt->bindParam(":valmotPasse", $motDePasse);
        $stmt->bindParam(":valtel", $telephone);


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


function VerifiePseudonyme(string $pseudonyme){ //REVOIR COMPLETEMENT, C'EST JUSTE UN RAPPEL POUR QUE JE LE FASSE.
    try{
        $pdo=connectToDB();
        $sql="Select * FROM utilisateur WHERE pseudonyme = :valPseudo";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valPseudo", $pseudonyme);
    }
}
?>