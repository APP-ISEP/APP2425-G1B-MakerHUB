<?php
session_start();

$title = "Accueil";

ob_start();

include_once 'php/catalog/offer/getOffers.php';
include_once 'php/catalog/request/getRequests.php';

$offers = getOffers();
$requests = getRequests();

include_once 'main.html';

$body = ob_get_clean();

include_once "views/components/template.php";
