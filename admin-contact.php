<?php
session_start();

$title = "Administration Contact | Makerhub";

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
}

ob_start();
require('modele/contact/getForm.php');

$forms = getForms();

include_once 'views/admin/admin-contact.html';

$body = ob_get_clean();

include_once "views/components/template.php";

?>