<?php

namespace Util;

abstract class Constantes
{

    //requisicoes permitidas
    public const requisicoes = ['GET', 'POST', 'PUT', 'DELETE'];
    public const requisicoesGet = ['', 'consultar', 'listarCategorias', 'categoria', 'tipopagamento', 'listarTiposPagamento', 'listaDespesas', 'pdfdespesas.pdf'];
    public const requisicoesPost = ['', 'cadastrarCategoria'];
    public const requisicoesPut = ['editarDespesa', 'editarCategoria'];
    public const requisicoesDelete = ['excluirDespesa', 'excluirCategoria'];
}
