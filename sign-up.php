<?php
$title = "Inscription";



ob_start();

include_once 'views/sign-up.html';
require_once 'controleur/SignUpControleur.php'
require_once 'modele/SignUpModele.php';
include_once "modele/connexionDB.php"; //essayé aussi avec require once
require_once "modele/SignUpFunction.php";

$telephone ="0612345678";
$nom = $email = $telephone = $prenom = $motDePasse =$pseudonyme =  "";

if (isset($_POST['submit'])) {
  $nom = test_input($_POST["nom"]); //redondance ???
  $prenom = test_input($_POST["prenom"]);
  $motDePasse = test_input($_POST["motDePasse"]);
  $pseudonyme = test_input($_POST["pseudonyme"]);
  $email = test_input($_POST["email"]);
  $telephone = test_input($_POST["telephone"]);

  $validateemail = validateEmail($email);
  $validatePhone = validateTelephone($telephone);


  if($validateemail == true || $validatePhone == true){
    try{
      $hashedPassword = HashPassword($motDePasse);
      $result = InsertUser(string $nom , string $prenom, string $pseudonyme, string $email, string $motDePasse, string $telephone);
      if ($result){
      echo "<p>Tu viens de t'inscrire comme $pseudonyme.</p>";
    } else{
      $errors['inscription'] = "Erreur lors de l' insertion des données.";
  
    }
    catch (PDOException $e) {
        echo "<p>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
    }
  }
  }
}
$body = ob_get_clean();

include_once 'views/components/template.php';




