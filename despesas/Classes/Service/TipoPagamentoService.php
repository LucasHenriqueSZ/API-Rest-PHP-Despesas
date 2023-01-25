<?php

namespace Service;

use Repository\Tipo_PagamentoRepository;
use Exception;

class TipoPagamentoService
{

    //lista todas as categorias
    public static function getListTiposPagamento()
    {
        return Tipo_PagamentoRepository::findAllTiposPagamentos();
    }

    //busca categoria por id
    public static function getTipoPagamentoById($id)
    {
        if ($id == null) {
            throw new Exception("Id nao pode ser nulo");
        }

        return Tipo_PagamentoRepository::findTipoPagamentoById($id);
    }
}
