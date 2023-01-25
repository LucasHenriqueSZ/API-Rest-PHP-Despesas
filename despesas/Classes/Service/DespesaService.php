<?php

namespace Service;

use Repository\DespesaRepository;
use Repository\Tipo_PagamentoRepository;
use Repository\CategoriaRepository;
use Exception;

class DespesaService
{

    //converte os ids das chaves estrangeiras para o objeto
    private static function ConverteDespesaFK($despesa)
    {
        $despesa->tipo_pagamento_id = Tipo_PagamentoRepository::findTipoPagamentoById($despesa->tipo_pagamento_id);
        $despesa->categoria_id = CategoriaRepository::findCategoriaById($despesa->categoria_id);

        return $despesa;
    }

    public static function getListDespesas()
    {
        $retorno = DespesaRepository::findAllDespesas();

        //percorre todas as despesas do array e converte 
        for ($i = 0; $i < count($retorno); $i++) {
            $retorno[$i] = self::ConverteDespesaFK($retorno[$i]);
        }

        return $retorno;
    }

    public static function getDespesaPorId($id)
    {
        if ($id == null) {
            throw new Exception("Id nao pode ser nulo");
        }

        $retorno = DespesaRepository::findDespesaById($id);
        return self::ConverteDespesaFK($retorno);
    }

    public static function getListDespesasPaginacao($id1, $id2)
    {

        $retorno = DespesaRepository::findAllDespesasPaginacao($id1, $id2);

        //percorre todas as despesas do array e converte 
        for ($i = 0; $i < count($retorno); $i++) {
            $retorno[$i] = self::ConverteDespesaFK($retorno[$i]);
        }

        return $retorno;
    }

    public static function excluirDespesa($id)
    {
        if ($id == null) {
            throw new Exception("Id nao pode ser nulo");
        }

        return  DespesaRepository::deleteDespesaById($id);
    }

    public static function cadastrarDespesa($despesa)
    {
        return DespesaRepository::insertDespesa($despesa);
    }

    public static function editarDespesa($despesa, $id)
    {
        if ($id == null) {
            throw new Exception("Id nao pode ser nulo");
        }
        return DespesaRepository::updateDespesa($despesa, $id);
    }

    public static function gerarDadosExcelDespesas()
    {

        //busca no banco de dados as despesas do mes vigente
        $dados = DespesaRepository::findDespesasByData(date('Y-m-01'), date('Y-m-t'));

        //percorre todas as despesas do array e converte
        for ($i = 0; $i < count($dados); $i++) {
            $dados[$i] = self::ConverteDespesaFK($dados[$i]);
        }

        $dados['tipo'] = 'excel';

        return $dados;
    }

    public static function gerarDadosPdfDespesas($data1, $data2)
    {

        //valida as datas
        if ($data1 == null || $data2 == null) {
            throw new Exception("Data nao pode ser nula");
        }
        if ($data1 > $data2) {
            throw new Exception("Data inicial nao pode ser maior que a data final");
        }

        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $data1) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $data2)) {
            throw new Exception("Data invalida");
        }

        $dados = DespesaRepository::findDespesasByData($data1, $data2);

        //percorre todas as despesas do array e converte
        for ($i = 0; $i < count($dados); $i++) {
            $dados[$i] = self::ConverteDespesaFK($dados[$i]);
        }

        $dados['tipo'] = 'pdf';

        return $dados;
    }
}
