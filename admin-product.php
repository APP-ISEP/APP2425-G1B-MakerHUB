<?php
session_start();

$title = "Administration Product | Makerhub";

ob_start();

include_once 'views/admin-product.html';

$body = ob_get_clean();

include_once "views/components/template.php";
