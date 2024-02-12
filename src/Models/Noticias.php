<?php

namespace src\Models;

use PDO;
use src\Core\Model;

class Noticias
{
    public $id_noticia_tbn;
    public $nome_noticia_tbn;
    public $conteudo_noticia_tbn;


    /**
     * Retorna todas as noticias
     *
     * @return array | null
     */
    public function getAll()
    {
        $stmt = Model::getConn()->prepare("SELECT * FROM tab_noticias LIMIT 5");
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    /**
     * Armazena noticia, o parametro é enviado pelo controller e pego diretamente pela classe
     *
     * @param string $nome_noticia_tbn
     * @param string $conteudo_noticia_tbn
     * @return bool
     */
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
    }

    /**
     * Retorna uma noticia
     *
     * @param int $id_request
     * @return object | null
     */
    public function show($id_request)
    {
        $stmt = Model::getConn()->prepare("SELECT * FROM tab_noticias WHERE id_noticias_tbn = ?");
        $stmt->bindValue(1, $id_request);
        $results = $stmt->execute();

        if ($results = $stmt->fetch(PDO::FETCH_OBJ)) {
            return $results;
        } else {
            return null;
        }
    }

    /**
     * Atualiza uma noticia, o parametro é enviado pelo controller e pego diretamente pela classe
     *
     * @param int $id_request
     * @param string $request
     * @return bool 
     */
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
            return false;
        }
    }

    /**
     * Deleta uma noticia
     *
     * @param int $id_request
     * @return bool 
     */
    public function delete($id_request)
    {
        $stmt = Model::getConn()->prepare("DELETE FROM tab_noticias WHERE id_noticias_tbn = ? ");
        $stmt->bindValue(1, $id_request);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * funçao para ver se linha existe
     * 
     * @return bool
     */
    public function exists($id)
    {
        $stmt = Model::getConn()->prepare("SELECT * FROM tab_noticias WHERE id_noticias_tbn = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        // verifica se existe com base na qunatidade de linhas encontradas
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
