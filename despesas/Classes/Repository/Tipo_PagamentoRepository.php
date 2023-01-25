<?php

namespace Repository;

use Repository\RepositoryGenerico;


class Tipo_PagamentoRepository
{

    const tabelaTipoPagamento = "tipos_pagamento";

    //lista de todas os tipos de pagamento
    public static function findAllTiposPagamentos()
    {
        return RepositoryGenerico::findAll(self::tabelaTipoPagamento);
    }

    //busca o tipos de pagamento por id
    public static function findTipoPagamentoById($id)
    {
        return RepositoryGenerico::findById(self::tabelaTipoPagamento, $id);
    }

    //busca o tipos de pagamento por nome
    public static function findTipoPagamentoByNome($nome)
    {
        return RepositoryGenerico::findByColumn(self::tabelaTipoPagamento, 'tipo', $nome);
    }
}
