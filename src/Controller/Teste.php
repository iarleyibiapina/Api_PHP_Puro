<?php

use src\Core\Controller;
use src\Models\Noticias;

class teste extends Controller
{
    public function index()
    {
        $noticia = new Noticias();
        echo  json_encode($noticia->getAll());
    }

    public function find()
    {
        $noticias = new Noticias();
        $noticia = null;
        // var_dump($noticias->index());
        $noticia = $noticias->index();

        echo json_encode($noticia);
    }

    public function store()
    {
        echo $this->getRequestBody();
    }
}
