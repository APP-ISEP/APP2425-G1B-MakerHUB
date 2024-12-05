<?php
include 'config/constants.php';
include 'autoload.php';

use Config\Log\Log;
use Config\Log\LogFileSingleton;
use Config\Log\LogLevel;

session_start();

$logFile = LogFileSingleton::getInstance();
$logFile->addLog(new Log(LogLevel::INFO, "L'utilisateur " . $_SESSION['username'] . " s'est déconnecté depuis " . $_SERVER['REMOTE_ADDR'] . "."));

$_SESSION = [];

session_unset();
session_destroy();

header("Location: index.php");
