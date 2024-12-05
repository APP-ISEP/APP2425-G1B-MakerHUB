<?php

namespace Config;

use DateTime;
use DateTimeZone;

class Log
{
    private LogLevel $logLevel;
    private DateTime $date;
    private string $message;

    /**
     * @throws \DateMalformedStringException
     */
    public function __construct(LogLevel $logLevel, string $message)
    {
        $this->logLevel = $logLevel;
        $this->date = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $this->message = $message;
    }

    /**
     * @return LogLevel
     */
    public function getLogLevel(): LogLevel
    {
        return $this->logLevel;
    }

    /**
     * @param LogLevel $logLevel
     */
    public function setLogLevel(LogLevel $logLevel): void
    {
        $this->logLevel = $logLevel;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function toString(): string
    {
        return $this->getDate()->format('Y-m-d H:i:s') . ' [' . $this->getLogLevel()->value . '] ' . $this->getMessage();
    }
}