<?php

require_once(__DIR__ . '/../connectToDB.php');

if (isset($_POST['show_user'])){
    $id = $_POST['show_user'];
    $account = getUserById($id);
    unset($account['mot_de_passe']);
    unset($account['est_actif']);
    unset($account['inactif_depuis']);
    unset($account['cree_a']);
    unset($account['token']);
    unset($account['is_verified']);
    unset($account['role_id']);
    header('Location: ./../../admin-user.php?user='.json_encode($account).'#supprimer-utilisateur');
    die();
}

function getUser(string $email): ?array
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT * FROM `utilisateur` WHERE mail=:valEmail and est_actif = 1 and is_verified = 1;";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valEmail", $email);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $account = null;
        if (count($results) > 0)
            $account = $results[0];
        
        $stmt->closeCursor();
        return $account;
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}

function getUserById( string $id): ?array
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT * FROM `utilisateur` WHERE id_utilisateur=:valId and est_actif = 1;";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":valId", $id);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $account = null;
        if (count($results) > 0)
            $account = $results[0];
        
        $stmt->closeCursor();
        return $account;
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}

function getUsers(): ?array
{
    try {
        $pdo = connectToDB();
        $sql = "SELECT * FROM `utilisateur` WHERE inactif_depuis IS NULL;";

        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $account = null;
        if (count($results) > 0)
            $account = $results;
        
        $stmt->closeCursor();
        return $account;
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}

?>
