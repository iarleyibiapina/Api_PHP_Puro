<?php

namespace src\Core;

use src\Core\Url;

class Router
{

    private $controller;

    private $method;

    private $controllerMethod;

    private $params = [];

    function __construct()
    {
        $url = Url::getUrl();
        var_dump($url);

        // verifica se controller existe, passa a primiera letra como maiuscula
        if ($url[0] === "") {
            // caso não haja parametro
            // echo "if / empty Url \r\n";
            // echo "Home";
            $this->controllerMethod = "index";
            return;
        } else if (file_exists("../src/Controller/" . ucfirst($url[0]) . ".php")) {
            // define controller
            $this->controller = $url[0];
            unset($url[0]);
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
                if (isset($url[1])) {
                    $this->controllerMethod = "find";
                    $this->params = [$url[1]];
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
                if (isset($url[1]) && is_numeric($url[1])) {
                    $this->params = [$url[1]];
                } else {
                    http_response_code(400);
                    echo json_encode(["erro" => "É necessário informar um id"]);
                    exit;
                }
                break;

            case "DELETE":
                $this->controllerMethod = "delete";
                if (isset($url[1]) && is_numeric($url[1])) {
                    $this->params = [$url[1]];
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
}
