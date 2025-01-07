<?php
require_once 'config/constants.php';
include 'autoload.php';

use Config\Ftp\FTP;
use Config\Log\Log;
use Config\Log\LogFile;
use Config\Log\LogLevel;

session_start();

$title = "Créer une demande";
$errors = array();
$isAuthPage = true;
$logFile = LogFile::getInstance();
$ftpInstance = FTP::getInstance();
$imageName = null;
$fileName = null;

ob_start();

if (isset($_SESSION['account'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    }
    if ($_SESSION['role'] !== 'acheteur') {
        header("Location: index.php");
    }
}

if (!isset($_SESSION) || !isset($_SESSION['account'])) {
    header("Location: ./log-in.php");
    die();
};

if (isset($_POST) && count($_POST) > 0) {
    if (empty($_POST['title']) || empty($_POST['description'])) {
        $errors['fields'] = "Veuillez remplir tous les champs.";
    }

    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    if (strlen($title) > 40) {
        $errors['title'] = "Le titre ne doit pas dépasser 40 caractères.";
    }
    if (strlen($description) > 200) {
        $errors['description'] = "La description ne doit pas dépasser 200 caractères.";
    }

    if ($_FILES['illustration'] !== "" && $_FILES['illustration']['size'] > 0) {
        $file = $_FILES['illustration'];

        if ($file['size'] > MAX_FILE_SIZE) {
            $errors['file_size'] = "La taille de l'image ne doit pas dépasser 5 Mo.";
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            die("Erreur lors de l'upload : " . $file['error']);
        }

        $imageName = $ftpInstance->addLocalFile($file); // save l'image dans /uploads/
        $ftpInstance->addFile(LOCAL_IMG_DIR . $imageName); // upload l'image sur le ftp
        $ftpInstance->deleteLocalFile($imageName); // supprime l'image dans /uploads/
    }

    if ($_FILES['fileToPrint'] !== "" && $_FILES['fileToPrint']['size'] > 0) {
        $file = $_FILES['fileToPrint'];

        if ($file['size'] > MAX_FILE_SIZE) {
            $errors['file_size'] = "La taille du fichier 3D ne doit pas dépasser 5 Mo.";
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            die("Erreur lors de l'upload : " . $file['error']);
        }

        $fileName = $ftpInstance->addLocalFile($file); // save l'image dans /uploads/
        $ftpInstance->addFile(LOCAL_IMG_DIR . $fileName); // upload l'image sur le ftp
        $ftpInstance->deleteLocalFile($fileName); // supprime l'image dans /uploads/
    }

    include_once("./modele/catalog/request/createRequest.php");

    if (empty($errors)) {
        $demand = createRequest($title, $description, $_SESSION['account']['id_utilisateur'], $imageName, $fileName);

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
