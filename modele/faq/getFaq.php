<?php
require_once "./modele/connectToDB.php";

if (isset($_GET['id_faq'])) {
    $id = $_GET['id_faq'];
    $faq = getFaqById($id);

    header('Location: /admin-faq.php?id_faq='.$id.'&question='.$faq[0]['question'].'&reponse='.$faq[0]['reponse']);

} else {
    $faqs = getFaq();
}


function getFaq() {
    try {
        $pdo = connectToDB();
        $sql="SELECT * FROM `faq` WHERE est_actif = 1";

        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $faq = null;
        if (count ($results) > 0)
            $faq = $results;
        $stmt->closeCursor();
        return $faq;
        die();
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}

function getFaqById(int $id) {
    try {
        $pdo = connectToDB();
        $sql="SELECT * FROM `faq` WHERE est_actif = 1 AND id_faq = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $id);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $faq = null;
        if (count ($results) > 0)
            $faq = $results;
        $stmt->closeCursor();
        return $faq;
        die();
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}