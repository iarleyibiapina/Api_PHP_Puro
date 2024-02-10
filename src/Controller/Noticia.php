<?php

use src\Core\Controller;
use src\Models\Noticias;

class Noticia extends Controller
{
    /**
     * Retorna todas as noticias como padrão
     */
    public function index()
    {
        $noticia = new Noticias();
        echo  json_encode($noticia->getAll());
    }

    /**
     * Retorna uma noticia
     */
    public function find($id)
    {
        $noticias = new Noticias();
        $noticia = null;
        $noticia = $noticias->show($id);
        if (!$noticia) {
            http_response_code(400);
            echo json_encode([
                'message' => 'id indisponivel ou inexistente',
                "method" => "find"
            ]);
            return;
        }
        http_response_code(200);
        echo json_encode($noticia);
    }

    /**
     * Armazena uma noticia
     */
    public function store()
    {
        $request = $_REQUEST;
        $noticia = new Noticias();
        // Envia request para a classe.
        $noticia->nome_noticia_tbn     = $request['nome_noticia_tbn'];
        $noticia->conteudo_noticia_tbn = $request['conteudo_noticia_tbn'];
        if (!$noticia->store()) {
            http_response_code(400);
            echo json_encode([
                "messagem" => "Dados nao enviados ao criar",
                "method" => "store"
            ]);
        }
        http_response_code(201);
        echo json_encode(["messagem" => "Dados enviados"]);
    }

    /**
     * Atualiza uma noticia
     */
    public function update($id)
    {
        $request = $_REQUEST;
        $noticia = new Noticias();
        // Envia request para a classe.
        $noticia->nome_noticia_tbn     = $request['nome_noticia_tbn'];
        $noticia->conteudo_noticia_tbn = $request['conteudo_noticia_tbn'];

        if (!$noticia->update($id, $request)) {
            http_response_code(400);
            echo json_encode([
                "messagem" => "Dados nao enviados ao atualizar",
                "method" => "update"
            ]);
        }
        http_response_code(200);
        echo json_encode(["messagem" => "Dados atualizados"]);
    }

    /**
     * Deleta uma noticia
     */
    public function delete($id)
    {
        $noticia = new Noticias();
        if (!$noticia->delete($id)) {
            http_response_code(400);
            echo json_encode([
                "messagem" => "Dados nao deletados",
                "method" => "delete"
            ]);
        }
        http_response_code(200);
        echo json_encode(["messagem" => "Dados deletados"]);
    }
}
