<?php

namespace Config\Log;

class LogFile
{
    private static ?LogFile $instance = null;

    /** @var string $filePath */
    private string $filePath;

    private array $logs;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        if (!file_exists($filePath)) {
            file_put_contents($filePath, ''); // Create file if it doesn't exist
        }
        $this->logs = array();
    }

    public static function getInstance(): LogFile
    {
        if (self::$instance === null) {
            self::$instance = new LogFile(LOG_FILE_PATH);
        }
        return self::$instance;
    }

    /**
     * @param Log $log
     * @return void
     * Add a log to the log file
     */
    public function addLog(Log $log): void
    {
        file_put_contents($this->filePath, $log->toString() . PHP_EOL, FILE_APPEND);
        $this->logs[] = $log;
    }

    /**
     * @return void
     * Clear the log file
     */
    public function clearLogs(): void
    {
        file_put_contents($this->filePath, '');
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     */
    public function setFilePath(string $filePath): void
    {
        $this->filePath = $filePath;
    }

    /**
     * @return array
     */
    public function getLogs(): array
    {
        return $this->logs;
    }

    /**
     * @param array $logs
     */
    public function setLogs(array $logs): void
    {
        $this->logs = $logs;
    }
}