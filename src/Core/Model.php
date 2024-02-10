<?php

namespace src\Core;

class Model
{

    private static $conexao;

    public static function getConn()
    {
        $host = $_ENV["DB_HOST"];
        $user = $_ENV["DB_USER"];
        $password = $_ENV["DB_PASS"];
        $dbname = $_ENV["DB_DB"];

        if (!isset(self::$conexao)) {
            self::$conexao = new \PDO("mysql:host=$host;port=3306;
                        dbname=$dbname;", $user, $password);
        }

        return self::$conexao;
    }
}
