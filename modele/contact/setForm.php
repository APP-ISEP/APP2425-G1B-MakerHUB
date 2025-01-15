<?php
require_once(__DIR__ . '/../connectToDB.php');

if (isset($_POST['id']) && isset($_POST['answer']) && $_POST['email']) {
    if (!empty($_POST['answer']) && !empty($_POST['id']) && !empty($_POST['email'])) {
        $id = $_POST['id'];
        $answer = $_POST['answer'];
        $email = $_POST['email'];
        setForm($id, $answer, $email);
    } else {
        header("Location: /admin-contact.php");
    }
}
else {
    header("Location: /admin-contact.php");
}

function setForm($id, $answer, $email) {

    $db = connectToDB();

    $query = $db->prepare("UPDATE `form` SET reponse = :answer, est_actif = 0, inactif_depuis = current_timestamp() WHERE id_formulaire =:id;");
    $query->bindParam(':id', $id);
    $query->bindParam(':answer', $_POST['answer']);
    $query->execute();

    mail($email, "[MAKERHUB]Réponse à votre demande de contact", "Bonjour, \n\nVoici la réponse: \n\n$answer\n\nCordialement, \nL'équipe Makerhub");
}

?>


$_SESSION