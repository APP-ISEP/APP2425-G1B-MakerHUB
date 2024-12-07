<?php
session_start();

$title = "Inscription";
$errors = array();
$isAuthPage = true;

ob_start();

if (isset($_SESSION['account'])) {
    header("Location: index.php");
}

require_once 'php/user/insertUser.php';
require_once 'php/user/checkCredentials.php';
require_once 'php/user/getUser.php';

$nom = $email = $telephone = $prenom = $motDePasse = $pseudonyme = "";

if (isset($_POST) && count($_POST) > 0) {
    $nom = test_input($_POST["nom"]);
    $prenom = test_input($_POST["prenom"]);
    $motDePasse = test_input($_POST["motDePasse"]);
    $pseudonyme = test_input($_POST["pseudonyme"]);
    $email = test_input($_POST["email"]);
    $telephone = test_input($_POST["telephone"]);

    $validateEmail = validateEmail($email);
    $validatePhone = validateTelephone($telephone);
    $validatePassword = validatePassword($motDePasse);
    $validateLengthNom = lengthNom($nom);
    $validateLengthPrenom = lengthPrenom($prenom);
    $validateLengthPseudonyme = lengthPseudonyme($pseudonyme);
    $validatePseudonymeUnique = uniquePseudonyme($pseudonyme);


    if (!$validateEmail) {
        $errors['email'] = "Veuillez saisir un mail valide.";
    }
    if (!$validatePhone) {
        $errors['telephone'] = "Veuillez saisir un téléphone valide";
    }
    if (!$validatePassword) {
        $errors['motDePasse'] = "Veuillez saisir un mot de passe valide.</br> Il doit contenir au moins :</br>"
            . '- Un chiffre.</br>'
            . "- Une majuscule.</br>"
            . "- Une minuscule.</br>"
            . "- Un caractère spécial (#?!@$%^&*-).</br>"
            . "- Longueur minimale de 8 caractères.";
    }
    if(!$validateLengthNom){
        $errors['nom']="Veuillez saisir un nom avec moins de 50 caractères";
    }
    if(!$validateLengthPrenom){
        $errors['prenom']="Veuillez saisir un prenom avec moins de 50 caractères";
    }
    if(!$validateLengthPseudonyme){
        $errors['pseudonyme']="Veuillez saisir un pseudonyme avec moins de 50 caractères";
    }
    if(!$validatePseudonymeUnique){
        $errors['pseudonymeUnique']="Ce pseudonyme existe déjà, veuillez en créer un nouveau";
    }


    if (empty($errors)) {
        if ($validateEmail && $validatePhone && $validatePassword) {
            $hashedPassword = hashPassword($motDePasse);
            $result = insertUser($nom, $prenom, $pseudonyme, $email, $hashedPassword, $telephone);
            $account = getUser($email);
            $_SESSION['account'] = $account;
            $_SESSION['username'] = $account['pseudonyme'];

            header("Location: index.php");
        }
    }
}

include_once 'views/sign-up.html';

$body = ob_get_clean();

include_once 'views/components/template.php';