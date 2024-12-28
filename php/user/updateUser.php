<?php
require_once "./php/connectToDB.php";
require_once "./php/user/roles/addUserRole.php";
require_once "./php/user/roles/deleteUserRole.php";
require_once "getUser.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
    echo 'Je susi dns le controlleur';
    $est_actif = 0;
    $inactif_depuis = date("Y-m-d H:i:s");
    deleteUser($id);
    header('Location: /admin-user.php');
    die();
} else {
    echo "Error: id not set";
    return false;
}

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
            addUserRole($id, 2);
        } else {
            deleteUserRole($id, 2);
        }

        return getUser($email);
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}

function deleteUser(int $id): bool
{
    try {
        echo 'Je suis dans la function';
        $pdo = connectToDB();

        $sql = "UPDATE `utilisateur`
            SET est_actif = 0,
                inactif_depuis = ?,
            WHERE id_utilisateur= ?";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(1, date("Y-m-d H:i:s"));
        $stmt->bindParam(2, $id);

        $bool = $stmt->execute();
        $stmt->closeCursor();

        return $bool;
    } catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return false;
    }
}