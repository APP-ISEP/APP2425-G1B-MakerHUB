<?php
namespace Config;

/**
 * LogLevel enum
 * enum of all log types
 */
enum LogLevel: string
{
    case TRACE = 'TRACE';
    case DEBUG = 'DEBUG';
    case INFO = 'INFO';
    case WARN = 'WARN';
    case ERROR = 'ERROR';
    case FATAL = 'FATAL';
}