<?php
require_once "./php/connectToDB.php";

function InsertUser( string $nom, string $prenom, string $pseudonyme, string $email, string $motDePasse, string $telephone)
{
    try {
        $pdo = connectToDB();

        $nom = $_REQUEST['nom'];
        $prenom = $_REQUEST['prenom'];
        $pseudonyme = $_REQUEST['pseudonyme'];
        $email = $_REQUEST['email'];
        $motDePasse = $_REQUEST['motDePasse'];
        $telephone = $_REQUEST['telephone'];

        $sql = "INSERT INTO `utilisateur` (nom, prenom,pseudonyme, mail, mot_de_passe,telephone) VALUES ('$nom','$prenom','$pseudonyme','$email','$motDePasse','$telephone')";

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