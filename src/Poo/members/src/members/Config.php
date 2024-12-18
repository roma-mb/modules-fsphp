<?php

namespace src\members;

class Config
{
    public const COMPANY = 'Company BD2';
    public const DOMAIN = 'company.bd2.com';
    public const SECTOR = 'Education';

    public static string $company = '';
    public static string $domain = '';
    public static string $sector = '';

    public static function setConfig(string $company, string $domain, string $sector): void
    {
        self::$company = $company;
        self::$domain = $domain;
        self::$sector = $sector;
    }
}