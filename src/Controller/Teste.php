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

    public function find($id)
    {
        $noticias = new Noticias();
        $noticia = null;
        $noticia = $noticias->view($id);
        if (!$noticia) {
            echo json_encode(['message' => 'id indisponivel']);
            return;
        }
        echo json_encode($noticia);
    }

    public function store()
    {
        echo $this->getRequestBody();
    }
}
