<?php
require_once(__DIR__ . '/../connectToDB.php');

function getForms() {
    $db = connectToDB();

    $query = $db->prepare("SELECT * FROM `form` WHERE est_actif = 1;");
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

?>