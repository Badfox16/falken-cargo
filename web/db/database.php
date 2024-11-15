<?php

class ConexaoBD
{

    private static $host = "localhost:3306";
    private static $dbname = "bdfalkencargo";
    private static $user = "root";
    private static $password = "";

    public static function getHost(): string
    {
        return self::$host;
    }

    public static function getDbName(): string
    {
        return self::$dbname;
    }

    public static function getUsername(): string
    {
        return self::$user;
    }

    public static function getPassword(): string
    {
        return self::$password;
    }

    public static function conectar()
    {
        try {
            $pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$user, self::$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed " . $e->getMessage());
        }
    }
}