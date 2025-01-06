<?php
//controller : C'est l'intermédiaire entre le modèle et la vue. 
//Il reçoit les actions de l'utilisateur, traite les données via le modèle et renvoie les résultats à la vue.

// Lorsque les données arrivent à la page contact-page.php, elles sont accessibles via les variables globales $_POST['pseudo'],
// $_POST['email'], et $_POST['message']. Ensuite, dans ton contrôleur, tu peux utiliser ces données 
// pour appeler la fonction addInfosInTheForm() du modèle et les insérer dans la base de données.
// dès qu'on voit $ c'est qu'on déclare ou qu'on utilise une variable

session_start();
$title = "Contactez-nous";

ob_start();

include_once 'views/contact-page.html';

$body = ob_get_clean();

include_once "views/components/template.php";

require_once "php/contact/createFormEntry.php";

if (isset($_SESSION['account'])) {
    if($_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){ //Cela permet de vérifier si la méthode de la requête est bien POST avant de traiter le formulaire.
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL); 
    $message = htmlspecialchars(trim($_POST['message']));

    if (strlen($pseudo)>30) {
        echo "le pseudo est trop long";
    }
    if (strlen($email)>255) {
        echo "le mail est trop long";
    }
    if (strlen($message)>300) {
        echo "le message est trop long";
    }
    

    /// on call la fonction du modèle pour ajouter ces informations dans la base de données
    $result = addInfosInTheForm($pseudo,$email,$message);
    // Afficher un message de confirmation ou d'erreur
    if ($result) {
        echo "Message envoyé avec succès !";
    } else {
        echo "Une erreur est survenue. Veuillez réessayer.";
    }
}


?>