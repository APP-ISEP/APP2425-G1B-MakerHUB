<?php
session_start();

$title = "Éditer le profil";
$errors = array();
$isAuthPage = true;

ob_start();

if (!isset($_SESSION) || !isset($_SESSION['account'])) {
    header("Location: ./log-in.php");
    die();
};

$user = null;
if (isset($_SESSION['account'])) {
    $user = $_SESSION['account'];
}

if (isset($_POST) && count($_POST) > 0) {
    if (
        !isset($_POST['firstname']) ||
        !isset($_POST['name']) ||
        !isset($_POST['username']) ||
        !isset($_POST['email'])
    ) {
        $errors['fields'] = "Veuillez remplir tous les champs";
    }

    $firstname = htmlentities($_POST['firstname']);
    $name = htmlentities($_POST['name']);
    $username = htmlentities($_POST['username']);
    $description = htmlentities($_POST['description']);
    $email = htmlentities($_POST['email']);
    $phone = htmlentities($_POST['phone']);

    include_once("./php/user/updateUser.php");
    $account = updateUser($firstname, $name, $username, $description, $email, $phone);

    if (!$account) {
        $errors['save'] = "Erreur lors de la modification de votre profil.";
    }

    if (empty($errors)) {
        $_SESSION['account'] = $account;
        $_SESSION['username'] = $account['pseudonyme'];

        header("Location: index.php");
    }
}

include_once 'views/edit-profile.html';

$body = ob_get_clean();

include_once "views/components/template.php";