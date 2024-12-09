<?php
require_once "./php/connectToDB.php";
function getFaq() {
    try {
        $pdo = connectToDB();
        $sql="SELECT * FROM `faq`";

        $stmt = $pdo->prepare($sql);
        $bool = $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $faq = null;
        if (count ($results) > 0)
            $faq = $results;
        $stmt->closeCursor();
        return $faq;
    }
    catch (PDOException $e) {
        // Error executing the query
        $error = $e->getMessage();
        echo mb_convert_encoding("Database access error: $error \n", 'UTF-8', 'UTF-8');
        return null;
    }
}