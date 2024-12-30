<?php

namespace Config\Ftp;

class FTPSingleton
{
    private static $instance = null;

    public static function getInstance(): ?FTP
    {
        if (self::$instance == null) {
            self::$instance = new FTP();
        }
        return self::$instance;
    }
}
