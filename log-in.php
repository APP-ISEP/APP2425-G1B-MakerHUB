<?php
session_start();

$title = "Se connecter";
$errors = array();

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

    include_once("./php/findAccount.php");

    $account = searchAccount($email, $password);
    if ($account === null) {
        $errors['login'] = "Erreur lors de l'identification. Login ($email) et/ou mot de passe incorrects.";
    }

    if (empty($errors)) {
        $_SESSION['account'] = $account;
        $_SESSION['username'] = $account['pseudonyme']; //TODO set pseudo
        header("Location: index.php");
    }
}

include_once 'views/log-in.html';

$body = ob_get_clean();

include_once "views/components/template-login-signup.php";