<?php

namespace src\Database\connections\source\Providers;

use PDO;
use src\config\DataBaseConnection;

class Connection
{
    private static PDO $instance;

    final private function __construct()
    {
    }

    public static function getInstance(): PDO
    {
        return empty(self::$instance)
            ? self::create()
            : self::$instance;
    }

    private static function create(): PDO
    {
        try {
            $sqliteFilePath = DataBaseConnection::SQLITE_FULLSTACK_FILE_PATH->value;
            self::$instance = new PDO("sqlite:file:{$sqliteFilePath}?mode=rwc",
                null,
                null,
                DataBaseConnection::options()
            );
        } catch(PDOException $exception) {
            die('Connection error: ' . $exception->getMessage());
        }

        return self::$instance;
    }

    final public function __clone(): void
    {
    }
}