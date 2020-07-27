<?php

class DB
{
    private static $dbHost     = "localhost";
    private static $dbUser     = "syncasho";
    private static $dbPassword = "Fw9N65fyrK(Y4@";
    private static $dbName     = "syncasho_prueba_db";

    public static function conexion()
    {
        setlocale(LC_ALL, 'es_ES.utf8');

        $connection = mysqli_connect(self::$dbHost, self::$dbUser, self::$dbPassword, self::$dbName);
        $connection->query("SET NAMES 'utf8'");

        return $connection;
    }
}