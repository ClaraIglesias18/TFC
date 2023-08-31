<?php

class Database {
    private static $host = 'localhost';
    private static $username = 'tfc';
    private static $password = 'abc123.';
    private static $dbname = 'tfc';
    private static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            try {
                self::$connection = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$username, self::$password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$connection;
    }
}
