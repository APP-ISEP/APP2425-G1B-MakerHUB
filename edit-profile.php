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

$user = $_SESSION['account'];
$roles = $_SESSION['roles'];

if (isset($_POST) && count($_POST) > 0) {
    if (empty($_POST['firstname']) || empty($_POST['name']) || empty($_POST['username']) || empty($_POST['email'])) {
        $errors['fields'] = "Veuillez remplir tous les champs.";
    }

    $firstname = htmlentities($_POST['firstname']);
    $name = htmlentities($_POST['name']);
    $username = htmlentities($_POST['username']);
    $isMaker = $_POST['toogleAboutMe'] ? true : false;
    $description = !empty($_POST['description']) ? htmlentities($_POST['description']) : null;
    $email = htmlentities($_POST['email']);
    $phone = !empty($_POST['phone']) ? htmlentities($_POST['phone']) : null;

    if (strlen($firstname) > 50) {
        $errors['firstname'] = "Le prénom ne doit pas dépasser 50 caractères.";
    }
    if (strlen($name) > 50) {
        $errors['name'] = "Le nom ne doit pas dépasser 50 caractères.";
    }
    if (strlen($username) > 30) {
        $errors['username'] = "Le pseudonyme ne doit pas dépasser 30 caractères.";
    }
    if (strlen($description ?? '') > 255) {
        $errors['description'] = "La description ne doit pas dépasser 255 caractères.";
    }
    if (strlen($email) > 255) {
        $errors['email'] = "L'adresse mail ne doit pas dépasser 255 caractères.";
    }
    if (strlen($phone ?? '') > 13) {
        $errors['phone'] = "Le numéro de téléphone ne doit pas dépasser 13 caractères.";
    }

    include_once("./php/user/updateUser.php");

    if (empty($errors)) {
        $account = updateUser($user['id'], $firstname, $name, $username, $isMaker, $description, $email, $phone);

        if (empty($account)) {
            $errors['save'] = "Erreur lors de la modification de votre profil.";
        } else {
            $_SESSION['account'] = $account;
            header("Location: index.php");
        }
    }
}

include_once 'views/edit-profile.html';

$body = ob_get_clean();

include_once "views/components/template.php";