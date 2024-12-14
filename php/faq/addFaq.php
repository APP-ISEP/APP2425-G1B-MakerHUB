<?php
require_once "../connectToDB.php";

$question = $_POST['question'];
$reponse = $_POST['reponse'];

addFaq($question, $reponse);

function addFaq(string $question, string $reponse): bool
{
    try {
        $pdo = connectToDB();

        $query = "INSERT INTO faq (question, reponse, cree_a, est_actif) VALUES (:valQuestion, :valReponse, :valCreea, :valActif)";

        $stmt = $pdo->prepare($query);
        $isActif = 1;
        $date = date("Y-m-d H:i:s");
        $stmt->bindParam(":valQuestion", $question);
        $stmt->bindParam(":valReponse", $reponse);
        $stmt->bindParam(":valCreea", $date);
        $stmt->bindParam(":valActif", $isActif);

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
header('Location: ../../views/panel_admin_faq.php');
die();
?>