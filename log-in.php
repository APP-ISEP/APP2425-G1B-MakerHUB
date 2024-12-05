<?php
include 'config/constants.php';
include 'autoload.php';

use Config\Log;
use Config\LogFileSingleton;
use Config\LogLevel;

session_start();

$title = "Se connecter";
$errors = array();
$isAuthPage = true;
$logFile = LogFileSingleton::getInstance();

ob_start();

if (isset($_SESSION['account'])) {
    header("Location: index.php");
}

if (isset($_POST) && count($_POST) > 0) {
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        $errors['fields'] = "Veuillez remplir tous les champs";
    }

    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);

    include_once("./php/user/checkLogin.php");
    $account = areCrendentialsCorrect($email, $password);

    if (!$account) {
        $errors['login'] = "Erreur lors de l'identification. Login ($email) et/ou mot de passe incorrects.";
    }

    if (empty($errors)) {
        include_once("./php/user/roles/getUserRoles.php");

        $_SESSION['account'] = $account;
        $_SESSION['username'] = $account['pseudonyme'];
        $_SESSION['roles'] = getUserRoles($account['id_utilisateur']);

        $logFile->addLog(new Log(LogLevel::INFO, "L'utilisateur " . $account['pseudonyme'] . " s'est connecté depuis " . $_SERVER['REMOTE_ADDR'] . "."));
        header("Location: index.php");
    }
}

include_once 'views/log-in.html';

$body = ob_get_clean();

include_once "views/components/template.php";
