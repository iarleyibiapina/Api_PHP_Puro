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
        $request = $this->getRequestBody();
        $noticia = new Noticias();
        $noticia->nome_noticia_tbn = $request['nome_noticia_tbn'];
        $noticia->conteudo_noticia_tbn = $request['conteudo_noticia_tbn'];

        if (!$noticia->store()) {
            echo json_encode(["messagem" => "Dados nao enviados"]);
        }

        echo json_encode(["messagem" => "Dados enviados"]);
        // $request['nome_noticia_tbn']
        // $request['conteudo_noticia_tbn']
    }
    public function update($id)
    {
        echo "update";
    }
}
