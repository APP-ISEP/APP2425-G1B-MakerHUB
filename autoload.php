<?php

// PENSER A INCLURE AUTOLOAD.PHP DANS CHAQUE FICHIER QUI UTILISE DES CLASSES

/* Autoload */
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
