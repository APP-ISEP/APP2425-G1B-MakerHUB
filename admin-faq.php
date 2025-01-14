<?php
session_start();

$title = "Administration FAQ | Makerhub";

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
}

ob_start();
//require('./modele/faq/getFaq.php');
//require_once 'modele/faq/addFaq.php';

include_once("./modele/faq/getFaq.php");
include_once("./modele/faq/addFaq.php");


$faqs = getFaq();

if (isset($_POST) && count($_POST) > 0) {
    $question = $_POST['question'];
    $reponse = $_POST['reponse'];
    $add = addFaq($question, $reponse);
    if ($add) {
        header("Location: admin-faq.php");
    }
}


include_once 'views/admin/admin-faq.html';

$body = ob_get_clean();

include_once "views/components/template.php";

?>