<?php
session_start();

$title = "Administration User | Makerhub";

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
}

ob_start();

require('modele/user/getUser.php'); 
$users = getUsers();

include 'views/admin/admin-user.html';

$body = ob_get_clean();

include "views/components/template.php";

?>
