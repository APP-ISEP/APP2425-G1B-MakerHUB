<?php
require_once 'config/constants.php';
include 'config/autoload.php';

use Config\Log\Log;
use Config\Log\LogFile;
use Config\Log\LogLevel;

session_start();

$title = "Se connecter";
$errors = array();
$isAuthPage = true;
$logFile = LogFile::getInstance();

ob_start();

if (isset($_SESSION['account'])) {
    if($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: index.php");
    }
}

if (isset($_POST) && count($_POST) > 0) {
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        $errors['fields'] = "Veuillez remplir tous les champs";
    }

    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);

    include_once("./modele/user/checkLogin.php");
    $account = areCrendentialsCorrect($email, $password);

    if (!$account) {
        $errors['login'] = "Erreur lors de l'identification. Login ($email) et/ou mot de passe incorrects.";
    }

    if (empty($errors)) {
        include_once("./modele/user/roles/getUserRole.php");

        $_SESSION['account'] = $account;
        $_SESSION['username'] = $account['pseudonyme'];
        $_SESSION['role'] = getUserRole($account['id_utilisateur']);

        $logFile->addLog(new Log(LogLevel::INFO, "L'utilisateur " . $account['pseudonyme'] . " (id: " . $_SESSION["account"]["id_utilisateur"] . ") s'est connecté depuis " . $_SERVER['REMOTE_ADDR'] . "."));

        if($_SESSION['role'] === 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
    }
}

include_once 'views/log-in.html';

$body = ob_get_clean();

include_once "views/components/template.php";
