<?php
$title = "Inscription";



ob_start();

include_once 'views/sign-up.html';
require_once 'controleur/SignUpControleur.php'
require_once 'modele/SignUpModele.php';
require_once "modele/connexionDB.php";
require_once "modele/SignUpFunction.php";

$telephone ="0612345678";
$nom = $email =$telephone = $prenom = $motDePasse =$pseudonyme =  "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nom = test_input($_POST["nom"]);
  $prenom = test_input($_POST["prenom"]);
  $motDePasse = test_input($_POST["mot_de_passe"]);
  $pseudonyme = test_input($_POST["pseudonymr"]);
  $email = test_input($_POST["email"]);
  $telephone = test_input($_POST["telephone"]);

  $validateemail = validateEmail($email);
  $validatePhone = validateTelephone($telephone);


  if($validateemail == true || $validatePhone == true){
    try{
      $hashedPassword = HashPassword($motDePasse);
      $result = InsertUser(string $nom , string $prenom, string $pseudonyme, string $email, string $motDePasse, string $telephone);
      if ($result){
      echo "Tu viens de t'inscrire comme".$pseudonyme;
    } else{
      $errors['inscription'] ="Error data inserting.</br>";
  
    }
    catch (PDOException $e) {
        echo "Error inserting data: " . $e->getMessage();
    }
  }
  }

$body = ob_get_clean();

include_once "views/components/template.php";




