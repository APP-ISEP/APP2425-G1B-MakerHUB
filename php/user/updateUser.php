<?php
require_once "./php/connectToDB.php";
function updateUser($firstname, $lastname, $username, $description, $email, $phone) {
    try {
        $pdo = connectToDB();

        $sql = "UPDATE `utilisateur`
            SET nom = :valLastname,
                prenom = :valFirstname,
                pseudonyme = :valUsername,
                mail = :valEmail,
                description = :valDescription,
                telephone = :valPhone
            WHERE id = :valId";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":valLastname", $lastname);
        $stmt->bindParam(":valFirstname", $firstname);
        $stmt->bindParam(":valUsername", $username);
        $stmt->bindParam(":valEmail", $email);
        $stmt->bindParam(":valDescription", $description);
        $stmt->bindParam(":valPhone", $phone);

        $bool = $stmt->execute();
        $stmt->closeCursor();

        $user = getUser($email);
        return $user
    }
    catch (PDOException $e) {
        // Erreur à l'exécution de la requête
        $erreur = $e->getMessage();
        echo mb_convert_encoding("Erreur d'accès à la base de données : $erreur \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
