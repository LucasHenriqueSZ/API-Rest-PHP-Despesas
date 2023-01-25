<?php

namespace Classes;

class Categoria
{

    private $id;

    private $nome;

    private $descricao;

    //contrutor
    public function __construct($id = null, $nome = null, $descricao = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
    }

    //metodos get
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    //metodos set
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setDescicao($descricao)
    {
        $this->descricao = $descricao;
    }
}
