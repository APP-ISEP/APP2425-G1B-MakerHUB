<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Title</title>
</head>
<body>
<?php
require_once '../constants.php';
include '../../autoload.php';

use Config\Ftp\FTP;

$ftpInstance = FTP::getInstance();
$imgName = '20220611_005931.jpg';
$ftpInstance->getFile($imgName);
?>

<img src="/uploads/7e81810b74435301.png" alt="Image23">

<img src="<?= '/uploads/' . $imgName ?>" alt="Image">

</body>
</html>