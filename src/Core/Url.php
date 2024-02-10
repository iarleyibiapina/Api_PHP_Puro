<?php

namespace src\Core;

class Url
{
    /**
     * Pegando a URL. 
     * OBS: Necessário definir o PATH padrão do projeto
     */
    public static function getUrl()
    {
        $url_completa = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        $url_temporaria = str_replace($_ENV['BASE_URL'], "", $url_completa);
        $url = (explode("/", $url_temporaria));
        return array_filter($url);
    }
}
