<?php

require_once "./modele/connectToDB.php";
require_once "./modele/user/roles/updateUserRole.php";
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

        // update current user role
        $roleDictionary = ["admin" => 1, "acheteur" => 2, "vendeur" => 3];
        $newRole = $isMaker ? $roleDictionary['vendeur'] : $roleDictionary['acheteur'];
        $updateRole = updateUserRole($id, $newRole);

        $updatedUser = getUser($email);
        return $updatedUser;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}
