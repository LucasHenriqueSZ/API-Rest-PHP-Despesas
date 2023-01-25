<?php

class Tipo_Pagamento
{
    private $id;

    private $tipo;

    //metodos get
    public function getId()
    {
        return $this->id;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    //metodos set
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
}
