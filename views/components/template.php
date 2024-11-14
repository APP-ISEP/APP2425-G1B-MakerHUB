<?php $title ??= "Accueil"; ?>

<?php if (isset($_SESSION['account'])) {
    $username = $_SESSION['account']['pseudonyme'];
} else {
    $username = null;
} ?>

<?php include_once "header.html"; ?>

<?=
/** @var $body string whole body */
$body
?>

<?php include_once "footer.html"; ?>
