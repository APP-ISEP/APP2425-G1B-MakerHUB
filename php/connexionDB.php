<?php
function connectToDB()
{
    $host = 'sql3.minestrator.com';
    $db = 'minesr_moBQkITL';
    $user = 'minesr_moBQkITL';
    $pass = 'gObeWJtKcGGA8AvS';
    $port = "3306";
    $charset = 'utf8mb4';

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";

    try {
        return new PDO($dsn, $user, $pass, $options);
        echo '<script language="javascript">';
echo 'alert("message successfully sent")';
echo '</script>';
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
        echo '<script language="javascript">';
echo 'alert("message NOT successfully sent")';
echo '</script>';
    }
}
?>