<?php
require_once 'config/constants.php';
include 'autoload.php';

use Config\Log\Log;
use Config\Log\LogFile;
use Config\Log\LogLevel;

session_start();

$logFile = LogFile::getInstance();
$logFile->addLog(new Log(LogLevel::INFO, "L'utilisateur " . $_SESSION['username'] . " s'est déconnecté depuis " . $_SERVER['REMOTE_ADDR'] . "."));

// Supprimer tous les fichiers dans le dossier uploads
foreach (glob("uploads/*.*") as $filename) {
    if (is_file($filename)) {
        unlink($filename);
    }
}


$_SESSION = [];

session_unset();
session_destroy();

header("Location: index.php");
