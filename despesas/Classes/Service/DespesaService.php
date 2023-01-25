<?php

namespace Service;

use Repository\DespesaRepository;
use Repository\Tipo_PagamentoRepository;
use Repository\CategoriaRepository;
use Exception;
use fpdf\FPDF;


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

    //gera o pdf com as despesas
    public static function gerarPdfDespesas($data1, $data2)
    {

        //valida as datas
        if ($data1 == null || $data2 == null) {
            throw new Exception("Data nao pode ser nula");
        }
        if ($data1 > $data2) {
            echo "Data inicial nao pode ser maior que a data final";
            exit;
            throw new Exception("Data inicial nao pode ser maior que a data final");
        }

        //valida a data com regex no formato yyyy-mm-dd
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $data1) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $data2)) {
            throw new Exception("Data invalida");
        }

        //busca os dados no banco
        $dados = DespesaRepository::findDespesasByData($data1, $data2);

        //percorre todas as despesas do array e converte
        for ($i = 0; $i < count($dados); $i++) {
            $dados[$i] = self::ConverteDespesaFK($dados[$i]);
        }

        $pdf = new FPDF('p', 'mm', 'A4');
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(190, 10, mb_convert_encoding('Relatório de Despesas', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
        $pdf->Ln(15);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(20, 10, 'Valor', 1, 0, 'C');
        $pdf->Cell(45, 10, 'Data', 1, 0, 'C');
        $pdf->Cell(27, 10, 'Pagamento', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Categoria', 1, 0, 'C');
        $pdf->Cell(66, 10, mb_convert_encoding('Descrição', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Ln();

        foreach ($dados as $dado) {
            $pdf->Cell(20, 10, 'R$ ' . mb_convert_encoding($dado->valor, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
            $pdf->Cell(45, 10, mb_convert_encoding($dado->data_compra, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
            $pdf->Cell(27, 10, mb_convert_encoding($dado->tipo_pagamento_id->tipo, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
            $pdf->Cell(40, 10, mb_convert_encoding($dado->categoria_id->nome, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
            $pdf->Cell(66, 10, mb_convert_encoding($dado->descricao, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
            $pdf->Ln();
        }

        $pdf->Output();
        exit;
    }
}
