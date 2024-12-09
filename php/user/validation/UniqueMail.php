
<?php
require_once './checkCredentials.php';

$fonction = $_POST['fonction'];
unset($_POST['fonction']);
$fonction($_POST[$email]);
?>