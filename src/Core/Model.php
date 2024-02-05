<?php

namespace App\Core;

class Model
{

    private static $conexao;

    public static function getConn()
    {

        $host = $_ENV["localhost"];
        $user = $_ENV["root"];
        $password = $_ENV[""];

        if (!isset(self::$conexao)) {
            self::$conexao = new \PDO("mysql:host=$host;port=3306;
                        dbname=teste;", $user, $password);
        }

        return self::$conexao;
    }
}
