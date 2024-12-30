<?php

require_once '../constants.php';
include '../../autoload.php';

use Config\Ftp\FTPSingleton;

$ftp = FTPSingleton::getInstance();

ftp_pasv($ftp->getFtpConnection(), true);

// affiche tous les fichiers dans le répertoire distant
$a = array_values(array_diff(ftp_nlist($ftp->getFtpConnection(), REMOTE_IMG_DIR), array('..', '.')));
print_r($a);

// affiche tous les fichiers dans le répertoire local
$b = array_values(array_diff(scandir(LOCAL_IMG_DIR), array('..', '.')));
print_r($b);



// save l'img dans le dir local
// l'upload sur le serveur distant
// suppr l'img du dir local
