<?php
$errors = array();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function validateEmail($email): bool
{ global $errors;

	if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        return true;
    }
    else {
      $errors['Mail'] ="Veuillez saisir un mail valide";
        return false;
    }
}

function validateTelephone($telephone) : bool{

	if(!preg_match('#^[0]{1}[0-9]{9}$#', $telephone)){ 
    return true;
  }else {
    $errors['Telephone'] ="Veuillez saisir un téléphone valide";
    return false;
	}

}

function HashPassword($motDePasse){
    $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);
}

function validatePassword($motDePasse): bool{
    if(isset($_POST['mot_de_passe']) && $_POST['mot_de_passe']!=""){
        if(!preg_match('#^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$#', $motDePasse)){ 
        return true;
      }else {
        $errors['Mot_de_passe'] ="Veuillez saisir un mot de passe valide.</br> Il doit contenir au moins.</b>
        - Un chiffre.</b>
        - Une majuscule.</b>
        - Une minuscule.</b>
        - Un character spécial.</b>
        - Longueur minimale de 8 characters";
        return false;
        }
    }
}
