<?php

namespace Service;

use Repository\Tipo_PagamentoRepository;
use Exception;

class TipoPagamentoService
{

    public static function getListTiposPagamento()
    {
        return Tipo_PagamentoRepository::findAllTiposPagamentos();
    }

    public static function getTipoPagamentoById($id)
    {
        if ($id == null) {
            throw new Exception("Id nao pode ser nulo");
        }

        return Tipo_PagamentoRepository::findTipoPagamentoById($id);
    }
}
