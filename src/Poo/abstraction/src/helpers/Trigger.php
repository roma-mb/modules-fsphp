<?php

namespace src\helpers;

class Trigger
{
    private const TRIGGER = 'trigger';
    public const ACCEPT = 'accept';
    public const WARNING = 'warning';
    public const ERROR = 'error';
    private static string $errorType;
    private static string $message;
    private static string $error;

    public static function show(string $message, string $errorType = null): string
    {
        self::setError($message, $errorType);
        return self::$error;
    }

    private static function setError(string $message, string $errorType = null): void
    {
        $reflectionClass = new \ReflectionClass(__CLASS__);
        $errorTypes = $reflectionClass->getConstants();

        self::$message = $message;

        self::$errorType = in_array($errorType, $errorTypes, true)
            ? $errorType
            : '';

        self::$error = "<p class='" . self::TRIGGER . ' ' . self::$errorType . "'>" . self::$message . "</p>";
    }
}