<?php

namespace Config\Log;

class LogFileSingleton
{
    private static ?LogFile $instance = null;

    public static function getInstance(): LogFile
    {
        if (self::$instance === null) {
            self::$instance = new LogFile(LOG_FILE_PATH);
        }
        return self::$instance;
    }
}