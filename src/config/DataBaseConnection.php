<?php

namespace src\config;

use PDO;

enum DataBaseConnection: string {
    case DATABASE_PATH = __DIR__ . '/../db/';
    case SQLITE_FULLSTACK_FILE_PATH = self::DATABASE_PATH->value . 'fullstack.db';
    case HOST = 'localhost';
    case USER = 'root';
    case DBNAME = 'fullstack';
    case PASSWD = '';

    public static function options(): array
    {
        return [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ];
    }
}
