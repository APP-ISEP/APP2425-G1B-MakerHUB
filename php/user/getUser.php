<?php
require_once "./php/connectToDB.php";
function getUser($email) {
    try {
        $pdo = connectToDB();
        $sql="SELECT * FROM `utilisateur` WHERE mail=:valEmail";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valEmail", $email);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $account = null;
        if (count ($results) > 0)
            $account = $results[0];
        $stmt->closeCursor();
        return $account;
    }
    catch (PDOException $e) {
        // Erreur à l'exécution de la requête
        $erreur = $e->getMessage();
        echo mb_convert_encoding("Erreur d'accès à la base de données : $erreur \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
