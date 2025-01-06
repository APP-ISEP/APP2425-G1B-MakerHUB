<?php
// INCLURE CE FICHIER AU DEBUT DE CHAQUE FICHIER QUI UTILISE LES CONSTANTES DEFINIES CI-DESSOUS

define("PROJECT_ROOT", dirname(__DIR__));
const LOG_FILE_PATH = PROJECT_ROOT . '/log/makerhub.log';
const DB_HOST = 'sql3.minestrator.com';
const DB_NAME = 'minesr_moBQkITL';
const DB_USER = 'minesr_moBQkITL';
const DB_PASS = 'gObeWJtKcGGA8AvS';
const DB_PORT = '3306';
const DB_CHARSET = 'utf8mb4';
const FTP_HOST = 'ftp.cluster029.hosting.ovh.net';
const FTP_USER = 'makerho';
const FTP_PASS = 'Hog7Fudb25Vp';
const LOCAL_IMG_DIR = PROJECT_ROOT . '/uploads/';
const REMOTE_IMG_DIR = '/imgs/';
const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 Mo
