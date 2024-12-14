<?php
require_once "../connectToDB.php";
echo "hello";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
    if (isset($_GET['question']) && isset($_GET['reponse'])) {
        $question = $_GET['question'];
        $reponse = $_GET['reponse'];
        echo $reponse;
        setFaq($id, $question, $reponse);
    } else {
        $est_actif = 0;
        $inactif_depuis = date("Y-m-d H:i:s");
        deleteFaq($id, $est_actif, $inactif_depuis);
    }
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