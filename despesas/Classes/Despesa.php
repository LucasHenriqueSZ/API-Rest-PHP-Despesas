<?php

class Despesa
{

    private $id;

    private $valor;

    private $data_compra;

    private $descricao;

    private $tipo_pagamento;

    private $categoria;

    //contrutor
    public function __construct($valor, $dataCompra, $descricao, $tpPagamento, $categoria)
    {
        $this->valor = $valor;
        $this->data_compra = $dataCompra;
        $this->descricao = $descricao;
        $this->tipo_pagamento = $tpPagamento;
        $this->categoria = $categoria;
    }

    //metodos get
    public function getId()
    {
        return $this->id;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getDataCompra()
    {
        return $this->data_compra;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getTipoPagamento()
    {
        return $this->tipo_pagamento;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    //metodos set
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function setDataCompra($dataCompra)
    {
        $this->data_compra = $dataCompra;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setTipoPagamento($tpPagamento)
    {
        $this->tipo_pagamento = $tpPagamento;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
}
