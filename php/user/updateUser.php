<?php
require_once "./php/connectToDB.php";
require_once "./php/roles/addUserRole.php";
require_once "./php/roles/deleteUserRole.php";
require_once "getUser.php";

function updateUser(int $id, string $firstname, string $name, string $username, bool $isMaker, ?string $description, string $email, ?string $phone): ?array
{
    try {
        $pdo = connectToDB();

        $sql = "UPDATE `utilisateur`
            SET prenom = :valFirstname,
                nom = :valName,
                pseudonyme = :valUsername,
                mail = :valEmail,
                description = :valDescription,
                telephone = :valPhone
            WHERE mail=:valEmail";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":valFirstname", $firstname);
        $stmt->bindParam(":valName", $name);
        $stmt->bindParam(":valUsername", $username);
        $stmt->bindParam(":valEmail", $email);
        $stmt->bindParam(":valDescription", $description);
        $stmt->bindParam(":valPhone", $phone);

        $bool = $stmt->execute();
        $stmt->closeCursor();

        // add or delete the user role `maker`
        if ($isMaker) {
            $bool = addUserRole($id, 2);
        } else {
            $bool = deleteUserRole($id, 2);
        }

        $user = getUser($email);
        return $user;
    } catch (PDOException $e) {
        // Erreur à l'exécution de la requête
        $erreur = $e->getMessage();
        echo mb_convert_encoding("Erreur d'accès à la base de données : $erreur \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
