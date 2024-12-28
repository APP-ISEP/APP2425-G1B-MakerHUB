<?php
require_once "../connectToDB.php";

if (isset($_POST['id']) && isset($_POST['question']) && isset($_POST['reponse'])) {
    $id = $_POST['id'];
    echo $id;
    $question = $_POST['question'];
    echo $question;
    $reponse = $_POST['reponse'];
    echo $reponse;
    setFaq($id, $question, $reponse);
    header('Location: /admin-faq.php');
    die();
}
if (isset($_POST['id']) && !isset($_POST['question']) && !isset($_POST['reponse'])) {
    $id = $_POST['id'];
    $est_actif = 0;
    $inactif_depuis = date("Y-m-d H:i:s");
    deleteFaq($id, $est_actif, $inactif_depuis);
    header('Location: /admin-faq.php');
    die();
} else {
    echo "Error: id not set";
    return false;
}

function setFaq(int $id, string $question, string $reponse): bool
{
    try {
        $pdo = connectToDB();

        $query = "UPDATE faq 
        SET question = :valQuestion,
         reponse = :valReponse 
         WHERE id_faq = :valId";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":valQuestion", $question);
        $stmt->bindParam(":valReponse", $reponse);
        $stmt->bindParam(":valId", $id);

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

function deleteFaq(int $id, int $est_actif, string $inactif_depuis): bool
{
    try {
        $pdo = connectToDB();

        $query = "UPDATE faq 
        SET est_actif = :valActif,
         inactif_depuis = :valInactifDepuis 
         WHERE id_faq = :valId";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":valActif", $est_actif);
        $stmt->bindParam(":valInactifDepuis", $inactif_depuis);
        $stmt->bindParam(":valId", $id);

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

?>