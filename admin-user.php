<?php
session_start();

$title = "Administration User | Makerhub";

ob_start();

require('php/user/getUser.php'); 
$users = getUsers();

include 'views/admin-user.html';

$body = ob_get_clean();

include "views/components/template.php";

?>
