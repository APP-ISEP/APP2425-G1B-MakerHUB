<?php
function connectToDB()
{
    $host = 'makerhoadmin.mysql.db';
    $db = 'makerhoadmin';
    $user = 'makerhoadmin';
    $pass = 'P3Lv3ceaNFhJ';
    $port = "3306";
    $charset = 'utf8mb4';

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}