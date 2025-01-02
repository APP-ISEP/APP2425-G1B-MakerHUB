<?php

require_once '../constants.php';
include '../../autoload.php';

use Config\Ftp\FTP;

if (isset($_POST) && count($_POST) > 0) {
    if (isset($_FILES['fileToUpload'])) {
        $file = $_FILES['fileToUpload'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            die("Erreur lors de l'upload : " . $file['error']);
        }

        $ftpInstance = FTP::getInstance();
        $ftpConnection = @$ftpInstance->getFtpConnection();

        // déplacer le fichier téléchargé dans /uploads
        $fileName = $ftpInstance->addLocalFile($file);

        // ajouter sur ftp
        $ftpInstance->addFile(LOCAL_IMG_DIR . $fileName);

        // supprimer le fichier local après ajout sur ftp
        $ftpInstance->deleteLocalFile($fileName);

        //@$ftpInstance->deleteFile('5a4929a96669401a.jpg');

        $fileToGet = '7e81810b74435301.png';
        //@$ftpInstance->getFile($fileToGet);

        // affiche tous les fichiers dans le répertoire distant
//        $a = array_values(array_diff(ftp_nlist($ftpInstance->getFtpConnection(), REMOTE_IMG_DIR), array('..', '.')));
//        print_r($a);
//
//        // affiche tous les fichiers dans le répertoire local
//        $b = array_values(array_diff(scandir(LOCAL_IMG_DIR), array('..', '.')));
//        print_r($b);
    }
}

// AJOUT IMG
// 1 - envoyer l'img dans le form html (controller)
// FAIT - 2 - save l'img en local au bon endroit
// FAIT - 3 - enregistrer l'image dans le ftp avec un nom généré
// 4 - ajouter ce nom en bd (lors de la soumission formulaire ds modele)
// FAIT - 5 - supprimer l'image en local

// RECUP IMG
// 1 - aller chercher le nom de l'image avec ftp dans la bd (controller / modele)
// FAIT - 2 - appelle à la f° getFile pour save l'img en local
// FAIT - 3 - afficher l'image avec le chemin local (testAffichage.php)

// SUPPRESSION IMG
// FAIT - 1 - à la déconnexion, vider le dossier local



// verif quand on ajt pas dimg que ça crash pas
// limite de taille de fichier