<?php

namespace Repository;

use Repository\RepositoryGenerico;


class Tipo_PagamentoRepository
{

    const tabelaTipoPagamento = "tipos_pagamento";

    public static function findAllTiposPagamentos()
    {
        return RepositoryGenerico::findAll(self::tabelaTipoPagamento);
    }

    public static function findTipoPagamentoById($id)
    {
        return RepositoryGenerico::findById(self::tabelaTipoPagamento, $id);
    }

    public static function findTipoPagamentoByNome($nome)
    {
        return RepositoryGenerico::findByColumn(self::tabelaTipoPagamento, 'tipo', $nome);
    }
}
