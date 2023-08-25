<?php

class Conexion
{

    private static $instancia;

    private function __construct()
    {
    }

    public static function getConexion()
    {
        if (!isset(self::$instancia)) {

            $dsn = "mysql:dbname=tfc;host=127.0.0.1";
            $usuario = "tfc";
            $password = "abc123.";

            self::$instancia = new PDO($dsn, $usuario, $password);
            self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instancia;
    }
}
