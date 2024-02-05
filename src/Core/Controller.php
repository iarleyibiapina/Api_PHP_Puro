<?php

namespace App\Core;

class Controller
{

    public function model($model)
    {
        require_once "../App/Models/" . $model . ".php";
        return new $model;
    }

    protected function getRequestBody()
    {
        // pegando dados enviados pelo request
        $json = file_get_contents("php://input");
        // esses dados sao pegos em json 
        $obj = json_decode($json);

        return $obj;
    }
}
