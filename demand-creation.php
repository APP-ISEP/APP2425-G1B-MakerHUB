<?php
session_start();

$title = "Créer une demande";
$errors = array();
$isAuthPage = true;

ob_start();

if (!isset($_SESSION) || !isset($_SESSION['account'])) {
    header("Location: ./log-in.php");
    die();
};

$user = $_SESSION['account'];


if (isset($_POST) && count($_POST) > 0) {
    if (empty($_POST['title']) || empty($_POST['description'])) {
        $errors['fields'] = "Veuillez remplir tous les champs.";
    }

    $title = htmlentities($_POST['title']);
    $description = htmlentities($_POST['description']);

    if (strlen($title) > 40) {
        $errors['title'] = "Le titre de la demande ne doit pas dépasser 40 caractères.";
    }
    if (strlen($description) > 200) {
        $errors['description'] = "La description de la demande ne doit pas dépasser 200 caractères.";
    }
    


}


include_once 'views/demand-creation.html';

$body = ob_get_clean();

include_once "views/components/template.php";