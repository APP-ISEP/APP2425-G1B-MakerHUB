<?php
require_once 'config/constants.php';
include 'autoload.php';

use Config\Log\Log;
use Config\Log\LogFile;
use Config\Log\LogLevel;
use Config\Ftp\FTP;

session_start();

$title = "Créer une offre";
$errors = array();
$isAuthPage = true;
$logFile = LogFile::getInstance();
$ftpInstance = FTP::getInstance();
$fileName = null;

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
        $errors['price'] = "Le prix ne doit pas dépasser 999 999,99€.";
    }

    if ($_FILES['illustration'] !== "" && $_FILES['illustration']['size'] > 0) {
        $file = $_FILES['illustration'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            die("Erreur lors de l'upload : " . $file['error']);
        }

        $fileName = $ftpInstance->addLocalFile($file); // save l'image dans /uploads/
        $ftpInstance->addFile(LOCAL_IMG_DIR . $fileName); // upload l'image sur le ftp
        $ftpInstance->deleteLocalFile($fileName); // supprime l'image dans /uploads/
    }

    include_once("./php/catalog/offer/createOffer.php");

    if (empty($errors)) {
        $offer = createOffer($title, $description, $price, $_SESSION['account']['id_utilisateur'], $fileName);

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
