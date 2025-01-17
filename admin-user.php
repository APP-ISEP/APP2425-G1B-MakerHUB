<?php
session_start();

$title = "Administration Utilisateurs";

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
}

ob_start();

require_once('./modele/user/getUser.php'); 

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    deleteUser($id);
}
if (isset($_POST['show_user'])){
    $id = $_POST['show_user'];
    $account = getUserById($id);
    unset($account['mot_de_passe']);
    unset($account['est_actif']);
    unset($account['inactif_depuis']);
    unset($account['cree_a']);
    unset($account['token']);
    unset($account['is_verified']);
    unset($account['role_id']);
    header('Location: ./../../admin-user.php?user='.json_encode($account).'#supprimer-utilisateur');
    die();
}

$users = getUsers();

include 'views/admin/admin-user.html';

$body = ob_get_clean();

include "views/components/template.php";

?>
