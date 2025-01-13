<?php
require_once 'config/constants.php';
include 'config/autoload.php';

use Config\Log\Log;
use Config\Log\LogFile;
use Config\Log\LogLevel;

session_start();

$title = "Inscription";
$errors = array();
$isAuthPage = true;
$logFile = LogFile::getInstance();

ob_start();

if (isset($_SESSION['account'])) {
    header("Location: index.php");
}

require_once 'modele/user/insertUser.php';
require_once 'modele/user/checkCredentials.php';
require_once 'modele/user/getUser.php';

$nom = $email = $telephone = $prenom = $motDePasse = $pseudonyme = "";

if (isset($_POST) && count($_POST) > 0) {
    $nom = test_input(data: $_POST["nom"]);
    $prenom = test_input($_POST["prenom"]);
    $motDePasse = test_input($_POST["motDePasse"]);
    $motDePasseConfirmed = test_input($_POST["motDePasseConfirmed"]);
    $pseudonyme = test_input($_POST["pseudonyme"]);
    $email = test_input($_POST["email"]);
    $telephone = test_input($_POST["telephone"]);
    $description = test_input($_POST["description"]);
    $role = isset($_POST['makerCheckbox']) && $_POST['makerCheckbox'] === 'on' ? 'vendeur' : 'acheteur'; // est set si la case est cochée

    $validateEmail = validateEmail($email);
    $validateEmailUnique = uniqueMail($email);
    $validatePhone = validateTelephone($telephone);
    $validatePassword = validatePassword($motDePasse);
    $hashedPassword = validatePassword($motDePasse);
    $validateLengthNom = lengthNom($nom);
    $validateLengthPrenom = lengthPrenom($prenom);
    $validateLengthPseudonyme = lengthPseudonyme($pseudonyme);
    $validatePseudonymeUnique = uniquePseudonyme($pseudonyme);

    if (!$validateEmail) {
        $errors['email'] = "Veuillez saisir un mail valide.";
    }
    if (!$validateEmailUnique) {
        $errors['email'] = "Ce mail existe déjà";
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
    if (!$validateLengthNom) {
        $errors['nom'] = "Veuillez saisir un nom avec moins de 50 caractères";
    }
    if (!$validateLengthPrenom) {
        $errors['prenom'] = "Veuillez saisir un prénom avec moins de 50 caractères";
    }
    if (!$validateLengthPseudonyme) {
        $errors['pseudonyme'] = "Veuillez saisir un pseudonyme avec moins de 50 caractères";
    }
    if (!$validatePseudonymeUnique) {
        $errors['pseudonymeUnique'] = "Ce pseudonyme existe déjà, veuillez en créer un nouveau";
    }
    if ($motDePasse !== $motDePasseConfirmed) {
        $errors['ConfirmdPassword'] = "Les mots de passe ne correspondent pas";
    }

    if (empty($_POST['is18More'])) {
        $errors['checkbox1'] = "Veullez confirmer d'avoir plus de 18 ans";
    }

    if (empty($_POST['AcceptCGU'])) {
        $errors['checkbox2'] = "Veullez accepter les CGU.";
    }

    if (empty($_POST['AcceptCGPS'])) {
        $errors['checkbox3'] = "Veullez accepter les CGPS";
    }
    if (!isset($_POST['prenom'])) {
        $errors['prenom'] = "Le champ est obligatoire";
    }
    if (!isset($_POST['nom'])) {
        $errors['nom'] = "Le champ est obligatoire";
    }
    if (!isset($_POST['pseudonyme'])) {
        $errors['pseudonyme'] = "Le champ est obligatoire";
    }
    if (!isset($_POST['email'])) {
        $errors['email'] = "Le champ est obligatoire";
    }


    if (empty($errors)) {
        if ($validateEmail && $validatePhone && $validatePassword) {
            $hashedPassword = hashPassword($motDePasse);
            $token = bin2hex(random_bytes(16));
            $result = insertUser($nom, $prenom, $pseudonyme, $email, $hashedPassword, $telephone, $description, $role,$token);
            $headers = "From:no-reply@makerhub.fr\r\n";
            $validationLink = "http://makerhub.fr/validate.php?token=$token";        
            mail($email, "Inscription", "Bonjour, vous avez bien été inscrit sur notre site. Votre pseudo est : " . $pseudonyme, $headers, $validationLink);
            mail('berylronget@gmail.com', 'test', 'test');
            $account = getUser($email);

            $logFile->addLog(new Log(LogLevel::INFO, "L'utilisateur " . $account['pseudonyme'] . " (id: " . $account["id_utilisateur"] . ") a été créé depuis " . $_SERVER['REMOTE_ADDR'] . "."));
            header("Location: log-in.php");
        }
    }
}


include_once 'views/sign-up.html';

$body = ob_get_clean();

include_once 'views/components/template.php';
