<?php

namespace src\Core;

class Router
{

    private $controller;

    private $method;

    private $controllerMethod;

    private $params = [];

    function __construct()
    {
        // ajustando para definir como url padrão ou 'raiz'  esta url sem o uso do virtual host
        // http://localhost/php/Api_PHP_3/public/
        $base_url = "localhost/php/Api_PHP_3/public/";
        $urlServer = (explode("/", $base_url));
        // pega url atual já separada por /
        $url = $this->parseURL();
        // compara diferenças de url atual com o array definido como 'raiz',
        // a diferença de / é um item a mais no array, porem a chave retornada é o index no array antigo
        // ou seja, se um item de index 5 for diferente do array a ser comparado, ira retornar '5' => 'valor';
        $diff = array_diff($url, $urlServer);
        // chave é a index
        $raiz = count($url) - count($diff);
        // var_dump($diff[$raiz]);

        // verifica se controller existe, passa a primiera letra como maiuscula
        if (empty($diff)) {
            // caso não haja parametro
            echo "Home";
            return;
        } else if (file_exists("../src/Controller/" . ucfirst($diff[$raiz]) . ".php")) {
            // define controller
            $this->controller = $diff[$raiz];
            unset($diff[$raiz]);
        } else {
            // cao nao exista controller
            http_response_code(404);
            echo json_encode(["erro" => "Recurso não encontrado"]);
            return;
        }
        // se existir, instancia controller
        require_once "../src/Controller/" . ucfirst($this->controller) . ".php";
        $this->controller = new $this->controller;
        // -

        // pegando metodo
        $this->method = $_SERVER["REQUEST_METHOD"];

        switch ($this->method) {
            case "GET":
                // se houver param 
                if (isset($diff[$raiz + 1])) {
                    $this->controllerMethod = "find";
                    $this->params = [$diff[$raiz + 1]];
                } else {
                    $this->controllerMethod = "index";
                }

                break;

            case "POST":
                $this->controllerMethod = "store";
                break;

            case "PUT":
                $this->controllerMethod = "update";
                // VERIFICA PARAM - ID
                if (isset($diff[$raiz + 1]) && is_numeric($diff[$raiz + 1])) {
                    $this->params = [$diff[$raiz + 1]];
                } else {
                    http_response_code(400);
                    echo json_encode(["erro" => "É necessário informar um id"]);
                    exit;
                }
                break;

            case "DELETE":
                $this->controllerMethod = "delete";
                if (isset($diff[$raiz + 1]) && is_numeric($diff[$raiz + 1])) {
                    $this->params = [$diff[$raiz + 1]];
                } else {
                    http_response_code(400);
                    echo json_encode(["erro" => "É necessário informar um id"]);
                    exit;
                }
                break;

            default:
                echo "Método não suportado";
                // exit;
                break;
        }
        // passa o controller, com metodo e param
        call_user_func_array([$this->controller, $this->controllerMethod], $this->params);
    }

    private function parseURL()
    {
        // pega url e separa por / em um array
        return explode("/", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
    }
}
