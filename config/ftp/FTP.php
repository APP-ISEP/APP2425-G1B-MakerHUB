<?php

namespace Config\Ftp;

use FTP\Connection;
use Random\RandomException;

class FTP
{
    private static ?FTP $instance = null;

    private Connection|false $ftp;

    public function __construct()
    {
        $this->ftp = @ftp_connect(FTP_HOST);
        @ftp_login($this->ftp, FTP_USER, FTP_PASS);
        @ftp_pasv($this->getFtpConnection(), true);
    }

    public static function getInstance(): FTP
    {
        if (self::$instance == null) {
            self::$instance = new FTP();
        }
        return self::$instance;
    }

    public function getFtpConnection(): false|Connection
    {
        return $this->ftp;
    }

    /**
     * Generate a random file name
     * @param string $extension, the extension of the file (ex: jpg, png, ...)
     * @return string a random file name with the extension (ex: 8905bf46fff952e6.jpg)
     * @throws RandomException
     */
    function generateRandomFileName(string $extension = ''): string
    {
        $randomString = bin2hex(random_bytes(8));
        return $randomString . ($extension ? '.' . $extension : '');
    }

    /**
     * Save a file locally inside the project in /uploads/
     * @throws RandomException
     */
    public function addLocalFile(array $file): string
    {
        $extension = $this->getFileExtension($file['name']);
        $fileName = $this->generateRandomFileName($extension);
        move_uploaded_file($file['tmp_name'], LOCAL_IMG_DIR . $fileName);

        return $fileName;
    }

    /**
     * Upload a file to the FTP server
     * The uploaded file will have the same name as the local file
     * @param string $localFilePath, the path of the file to upload
     * @return bool true if the file was uploaded successfully, false otherwise
     */
    public function addFile(string $localFilePath): bool
    {
        $remoteFileName = basename($localFilePath);
        return ftp_put($this->getFtpConnection(), REMOTE_IMG_DIR . $remoteFileName, $localFilePath);
    }

    /**
     * Delete a file from the local directory
     * @param string $fileName, the name of the file to delete
     * @return bool true if the file was deleted successfully, false otherwise
     */
    public function deleteLocalFile(string $fileName): bool
    {
        return unlink(LOCAL_IMG_DIR . $fileName);
    }

    public function deleteFile(string $remoteFilePath): bool
    {
        return ftp_delete($this->getFtpConnection(), REMOTE_IMG_DIR . $remoteFilePath);
    }

    /**
     * Download a file from the FTP server. The file will be saved in /uploads/
     * @param string $remoteImageName, name of the file to download with extension (ex: 8905bf46fff952e6.jpg)
     * @return bool true if the file was downloaded successfully, false otherwise
     */
    public function getFile(string $remoteImageName): bool
    {
        return ftp_get($this->getFtpConnection(), LOCAL_IMG_DIR . $remoteImageName,REMOTE_IMG_DIR . $remoteImageName);
    }

    /**
     * Get the extension of a file (ex: jpg, png, ...)
     * @param string $fileName, name of the file
     * @return string the extension of the file (ex: jpg, png, '', ...)
     */
    public function getFileExtension(string $fileName): string
    {
        return pathinfo($fileName, PATHINFO_EXTENSION) ?? '';
    }

    /**
     * Close the FTP connection when outside of scope
     */
    public function __destruct()
    {
        ftp_close($this->getFtpConnection());
    }
}