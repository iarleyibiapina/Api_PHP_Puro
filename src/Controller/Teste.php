<?php

use src\Core\Controller;

class teste extends Controller
{
    public function index()
    {
        echo  json_encode(["chave" => "valor"]);
    }

    public function show()
    {
    }
}
