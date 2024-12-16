<?php
session_start();

$title = "Administration FAQ | Makerhub";

ob_start();
require('php/faq/getFaq.php'); 
$faqs = getFaq();

include_once 'views/admin-faq.html';

$body = ob_get_clean();

include_once "views/components/template.php";
