<?php

function connectToDB(): PDO
{
    $host = 'ba64n0culhsuwcjyb9ss-mysql.services.clever-cloud.com'; 
    $db = 'ba64n0culhsuwcjyb9ss'; 
    $user = 'u0ju2jbxdcdzmdvc'; 
    $pass = 'C3X9cZMufZY7DyrF6VUZ'; 
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    


    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}