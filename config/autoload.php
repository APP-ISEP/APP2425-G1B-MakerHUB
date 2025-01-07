<?php

include_once "constants.php";

// PENSER A INCLURE AUTOLOAD.PHP DANS CHAQUE FICHIER QUI UTILISE DES CLASSES (POO)

/* Autoload */
spl_autoload_register(function ($class) {
    $file = PROJECT_ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
