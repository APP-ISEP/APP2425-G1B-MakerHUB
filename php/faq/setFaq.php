<?php
require_once "../php/connectToDB.php";

$id = $_GET['id'];
$question = $_GET['question'];
$reponse = $_GET['reponse'];
$est_actif = $_GET['est_actif'];
$inactif_depuis = $_GET['inactif_depuis'];

setFAQ($id, $question, $reponse, $est_actif, $inactif_depuis);

function setFAQ(int $id, string $question, string $reponse, bool $est_actif, date $inactif_depuis): bool
{
    try {
        $pdo = connectToDB();

        $query = "UPDATE faq 
        SET question = :valQuestion,
         reponse = :valReponse, 
         est_actif = :valActif,
         inactif_depuis = :valInactif
         WHERE id_faq = :valId";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":valQuestion", $question);
        $stmt->bindParam(":valReponse", $reponse);
        $stmt->bindParam(":valActif", $est_actif);
        $stmt->bindParam(":valInactif", $inactif_depuis);

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