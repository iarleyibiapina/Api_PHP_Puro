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
        // pega url já separada por /
        $url = $this->parseURL();

        // verifica se controller existe, passa a primiera letra como maiuscula
        if (file_exists("../src/Controllers/" . ucfirst($url[1]) . ".php")) {
            // define controller
            $this->controller = $url[1];
            unset($url[1]);
        } elseif (empty($url[1])) {
            // caso não haja parametro
            echo "Hello Fast-Parking API";
            exit;
        } else {
            // cao nao exista controller
            http_response_code(404);
            echo json_encode(["erro" => "Recurso não encontrado"]);
            exit;
        }
        // se existir, instancia controller
        require_once "../src/Controllers/" . ucfirst($this->controller) . ".php";
        $this->controller = new $this->controller;
        // -

        // pegando metodo
        $this->method = $_SERVER["REQUEST_METHOD"];

        switch ($this->method) {
            case "GET":
                // se houver param 
                if (isset($url[2])) {
                    $this->controllerMethod = "find";
                    $this->params = [$url[2]];
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
                if (isset($url[2]) && is_numeric($url[2])) {
                    $this->params = [$url[2]];
                } else {
                    http_response_code(400);
                    echo json_encode(["erro" => "É necessário informar um id"]);
                    exit;
                }
                break;

            case "DELETE":
                $this->controllerMethod = "delete";
                if (isset($url[2]) && is_numeric($url[2])) {
                    $this->params = [$url[2]];
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
