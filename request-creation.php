<?php
require_once 'config/constants.php';
include 'autoload.php';

use Config\Log\Log;
use Config\Log\LogFileSingleton;
use Config\Log\LogLevel;

session_start();

$title = "Créer une demande";
$errors = array();
$isAuthPage = true;
$logFile = LogFileSingleton::getInstance();

ob_start();

if (!isset($_SESSION) || !isset($_SESSION['account'])) {
    header("Location: ./log-in.php");
    die();
};

if (isset($_POST) && count($_POST) > 0) {
    if (empty($_POST['title']) || empty($_POST['description'])) {
        $errors['fields'] = "Veuillez remplir tous les champs.";
    }

    $title = htmlentities($_POST['title']);
    $description = htmlentities($_POST['description']);

    if (strlen($title) > 40) {
        $errors['title'] = "Le titre ne doit pas dépasser 40 caractères.";
    }
    if (strlen($description) > 200) {
        $errors['description'] = "La description ne doit pas dépasser 200 caractères.";
    }

    include_once("./php/catalog/request/createRequest.php");

    if (empty($errors)) {
        $demand = createRequest($title, $description, $_SESSION['account']['id_utilisateur']);

        if ($demand) {
            $logFile->addLog(new Log(LogLevel::INFO, "L'utilisateur " . $_SESSION['account']['pseudonyme'] . " (id: " . $_SESSION["account"]["id_utilisateur"] . ") a créé une demande (titre: " . $title . ")."));
            header("Location: index.php");
        } else {
            $errors['save'] = "Erreur lors de la création de la demande.";
        }
    }
}

include_once 'views/request-creation.html';

$body = ob_get_clean();

include_once "views/components/template.php";
