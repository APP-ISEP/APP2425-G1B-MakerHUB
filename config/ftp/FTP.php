<?php

namespace Config\Ftp;

use FTP\Connection;

class FTP
{
    private $ftp;

    public function __construct()
    {
        $this->ftp = ftp_connect(FTP_HOST);
        ftp_login($this->ftp, FTP_USER, FTP_PASS);
    }

    public function getFtpConnection(): false|Connection
    {
        return $this->ftp;
    }
}
