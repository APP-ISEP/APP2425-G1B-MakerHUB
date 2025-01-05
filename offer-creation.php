<?php
require_once 'config/constants.php';
include 'autoload.php';

use Config\Log\Log;
use Config\Log\LogFileSingleton;
use Config\Log\LogLevel;

session_start();

$title = "Créer une offre";
$errors = array();
$isAuthPage = true;
$logFile = LogFileSingleton::getInstance();

ob_start();

if (!isset($_SESSION) || !isset($_SESSION['account'])) {
    header("Location: ./log-in.php");
    die();
};

if (isset($_POST) && count($_POST) > 0) {
    if (empty($_POST['title']) || empty($_POST['description']) || empty($_POST['price'])) {
        $errors['fields'] = "Veuillez remplir tous les champs.";
    }

    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $price = htmlspecialchars($_POST['price']);

    if (strlen($title) > 40) {
        $errors['title'] = "Le titre ne doit pas dépasser 40 caractères.";
    }
    if (strlen($description) > 200) {
        $errors['description'] = "La description ne doit pas dépasser 200 caractères.";
    }
    if ($price > 999999.99) {
        $errors['price'] = "Le prix ne doit pas dépasser 999999,99€.";
    }

    include_once("./php/catalog/offer/createOffer.php");

    if (empty($errors)) {
        $offer = createOffer($title, $description, $price, $_SESSION['account']['id_utilisateur']);

        if ($offer) {
            $logFile->addLog(new Log(LogLevel::INFO, "L'utilisateur " . $_SESSION['account']['pseudonyme'] . " (id: " . $_SESSION["account"]["id_utilisateur"] . ") a créé une offre (titre: " . $title . ")."));
            header("Location: index.php");
        } else {
            $errors['save'] = "Erreur lors de la création de l'offre.";
        }
    }
}

include_once 'views/offer-creation.html';

$body = ob_get_clean();

include_once "views/components/template.php";
