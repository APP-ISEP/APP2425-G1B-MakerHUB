<?php

include_once "constants.php";

// PENSER A INCLURE AUTOLOAD.PHP DANS CHAQUE FICHIER QUI UTILISE DES CLASSES (POO)

/* Autoload - exemple : transforme la classe Config\Ftp\FTP.php en le chemin config/ftp/FTP.php */
spl_autoload_register(function ($class) {
    $pathParts = explode('\\', $class);

    // mettre le nom de tous les dossiers en minuscule
    $pathPartsCount = count($pathParts);
    for ($i = 0; $i < $pathPartsCount - 1; $i++) {
        $pathParts[$i] = strtolower($pathParts[$i]);
    }

    // chemin relatif
    $filePath = implode('/', $pathParts) . '.php';

    // chemin absolu
    $file = PROJECT_ROOT . '/' . $filePath;

    // charge le fichier s'il existe
    if (file_exists($file)) {
        require_once $file;
    }
});