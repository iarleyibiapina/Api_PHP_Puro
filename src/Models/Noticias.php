<?php

namespace src\Models;

use PDO;
use src\Core\Model;

class Noticias
{
    public $id_noticia_tbn;
    public $nome_noticia_tbn;
    public $conteudo_noticia_tbn;

    public function index()
    {
        $stmt = Model::getConn()->prepare("SELECT * FROM tab_noticias");
        $results = $stmt->execute();
        if ($results) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
    public function store()
    {
        $stmt = Model::getConn()->prepare("INSERT INTO tab_noticias (nome_noticia_tbn, conteudo_noticia_tbn) VALUES (?, ?)");
        $stmt->bindValue(1, $this->nome_noticia_tbn);
        $stmt->bindValue(2, $this->conteudo_noticia_tbn);
        $results = $stmt->execute();

        if ($results = $stmt->fetch(PDO::FETCH_OBJ)) {
            // pega ultimo id inserido (update e delete?)
            $this->id_noticia_tbn = Model::getConn()->lastInsertId();
            return $results;
        } else {
            print_r($stmt->errorInfo());
            return null;
        }
    }
    public function view($id_request)
    {
        $stmt = Model::getConn()->prepate("SELECT * FROM tab_noticias WHERE id_noticia_tbn = ?");
        $stmt->bindValue(1, $id_request);
        $results = $stmt->execute();

        if ($results = $stmt->fetch(PDO::FETCH_OBJ)) {

            $this->id_noticia_tbn = $results->id_noticia_tbn;
            $this->nome_noticia_tbn = $results->nome_noticia_tbn;
            $this->conteudo_noticia_tbn = $results->conteudo_noticia_tbn;

            return $results;
        } else {
            return null;
        }
    }
    public function update($id_request)
    {
    }
    public function delete($id_request)
    {
    }
}
