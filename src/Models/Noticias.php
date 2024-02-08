<?php

namespace src\Models;

use PDO;
use src\Core\Model;

class Noticias
{
    public $id_noticia_tbn;
    public $nome_noticia_tbn;
    public $conteudo_noticia_tbn;

    public function getAll()
    {
        $stmt = Model::getConn()->prepare("SELECT * FROM tab_noticias LIMIT 5");
        if ($stmt->execute()) {
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
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        // if ($results = $stmt->fetch(PDO::FETCH_OBJ)) {
        // pega ultimo id inserido (update e delete?)
        // $this->id_noticia_tbn = Model::getConn()->lastInsertId();
        // return $results;
        // return true;
        // } else {
        // print_r($stmt->errorInfo());
        // return null;
        // }
    }
    public function view($id_request)
    {
        $stmt = Model::getConn()->prepare("SELECT * FROM tab_noticias WHERE id_noticias_tbn = ?");
        $stmt->bindValue(1, $id_request);
        $results = $stmt->execute();

        if ($results = $stmt->fetch(PDO::FETCH_OBJ)) {

            // ideia: salva resultado na classe para futuras consultas direto na classe;
            // $this->id_noticia_tbn = $results->id_noticias_tbn;
            // $this->nome_noticia_tbn = $results->nome_noticia_tbn;
            // $this->conteudo_noticia_tbn = $results->conteudo_noticia_tbn;

            return $results;
        } else {
            return null;
        }
    }
    public function update($id_request, $request)
    {
        // $request['nome_noticia_tbn']
        // $request['conteudo_noticia_tbn']
        $stmt = Model::getConn()->prepare("UPDATE tab_noticias SET  nome_noticia_tbn =  ?,  conteudo_noticia_tbn = ?  WHERE id_noticias_tbn = ? ");
        $stmt->bindValue(1, $request['nome_noticia_tbn']);
        $stmt->bindValue(2, $request['conteudo_noticia_tbn']);
        $stmt->bindValue(3, $id_request);

        if ($stmt->execute()) {
            return true;
        } else {
            return null;
        }
    }
    public function delete($id_request)
    {
    }
}
