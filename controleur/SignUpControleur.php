<?php
require_once "modele/connexionDB.php";
require_once "modele/SignUpModele.php";

$telephone ="0612345678";
$nom = $email =$telephone = $prenom = $motDePasse =$pseudonyme =  "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function validateEmail($email): bool
{
if (isset($_POST['email'])){
	if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "A valid email: ".$email."</br>";
        return true;
    }
    else {
        echo " Not a valid email"."</br>";
        return false;
    }
}
}

if (isset($_POST['telephone']) && $_POST['telephone']!=""){
	if(!preg_match('#^[0]{1}[0-9]{9}$#', $telephone)){ 
	echo "Votre téléphone est ".$_POST['telephone']."</br>";
	}else {
		echo "Votre téléphone est invalide"."</br>";
	}
}

function HashPassword($motDePasse){
    $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);
}

/*if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nom = test_input($_POST["nom"]);
  $prenom = test_input($_POST["prenom"]);
  $motDePasse = test_input($_POST["mot_de_passe"]);
  $pseudonyme = test_input($_POST["pseudonymr"]);
  $email = test_input($_POST["email"]);
  $telephone = test_input($_POST["telephone"]);



$validateemail = validateEmail($email);

if($validateemail == true){
  try{
    $hashedPassword = HashPassword($motDePasse);
    $result = InsertUser(string $nom , string $prenom, string $pseudonyme, string $email, string $motDePasse, string $telephone);
    if ($result){
    echo "Data inserted successfully.</br>";
  } else{
    echo "Error data inserting.</br>";

  }
  catch (PDOException $e) {
      echo "Error inserting data: " . $e->getMessage();
  }
}
}
}*/
