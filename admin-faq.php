<?php
session_start();

$title = "Administration FAQ | Makerhub";

ob_start();
require('php/faq/getFaq.php');
require_once 'php/faq/addFaq.php';

$faqs = getFaq();

if (isset($_POST) && count($_POST) > 0) {
    $question = $_POST['question'];
    $reponse = $_POST['reponse'];
    $add = addFaq($question, $reponse);
    if ($add) {
        header("Location: admin-faq.php");
    };
}


include_once 'views/admin-faq.html';

$body = ob_get_clean();

include_once "views/components/template.php";
