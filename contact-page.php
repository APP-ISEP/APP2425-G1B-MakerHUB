<?php
//controller : C'est l'intermédiaire entre le modèle et la vue. 
//Il reçoit les actions de l'utilisateur, traite les données via le modèle et renvoie les résultats à la vue.

// Lorsque les données arrivent à la page contact-page.php, elles sont accessibles via les variables globales $_POST['pseudo'],
// $_POST['email'], et $_POST['message']. Ensuite, dans ton contrôleur, tu peux utiliser ces données 
// pour appeler la fonction addInfosInTheForm() du modèle et les insérer dans la base de données.
// dès qu'on voit $ c'est qu'on déclare ou qu'on utilise une variable


require_once "/contact/createFormEntry.php"

if ($_SERVER['REQUEST_METHOD'] === 'POST'){ //Cela permet de vérifier si la méthode de la requête est bien POST avant de traiter le formulaire.
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = filter_var(trim($_POST[email]), filter_validate_email); 
    $message = htmlspecialchars(trim($_POST['message']));
}

/// on call la fonction du modèle pour ajouter ces informations dans la base de données
$result = addInfosInTheForm ($pseudo,$email,$message);

  // Afficher un message de confirmation ou d'erreur
  if ($result) {
    echo "Message envoyé avec succès !";
} else {
    echo "Une erreur est survenue. Veuillez réessayer.";
}

?>