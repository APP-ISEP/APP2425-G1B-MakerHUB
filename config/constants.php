<?php
// INCLURE CE FICHIER AU DEBUT DE CHAQUE FICHIER QUI UTILISE LES CONSTANTES DEFINIES CI-DESSOUS

define("PROJECT_ROOT", dirname(__DIR__));
const LOG_FILE_PATH = PROJECT_ROOT . '/log/makerhub.log';
const DB_HOST = 'ba64n0culhsuwcjyb9ss-mysql.services.clever-cloud.com';
const DB_NAME = 'ba64n0culhsuwcjyb9ss';
const DB_USER = 'u0ju2jbxdcdzmdvc';
const DB_PASS = 'C3X9cZMufZY7DyrF6VUZ';
const DB_PORT = '3306';
const DB_CHARSET = 'utf8mb4';
const FTP_HOST = 'ftp.cluster029.hosting.ovh.net';
const FTP_USER = 'makerho';
const FTP_PASS = 'Hog7Fudb25Vp';
const LOCAL_IMG_DIR = PROJECT_ROOT . '/uploads/';
const REMOTE_IMG_DIR = '/imgs/';
const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 Mo
