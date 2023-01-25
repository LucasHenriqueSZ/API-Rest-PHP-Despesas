<?php

namespace Util;

use fpdf\FPDF;

class TrataSaida
{

    public function tratarRetorno($retorno)
    {

        $dados = [
            'data' => null,
            'sucess' => false,
        ];

        if (is_array($retorno) || is_object($retorno) && count((array)$retorno) > 0) {
            $dados['sucess'] = true;
            $dados['data'] = $retorno;
        }

        switch ($retorno['tipo']) {
            case 'pdf':
                $this->retornaPdf($retorno);
                break;
            case 'excel':
                $this->retornaExcel($retorno);
                break;
            default:
                $this->retornaJson($dados);
                break;
        }
    }

    private function retornaJson($dados)
    {
        header('Content-Type: application/json');
        echo json_encode($dados);
    }

    private function retornaExcel($dados)
    {

        unset($dados['tipo']);

        //limpa o buffer
        ob_start();

        //aceita arquivos csv e text
        header('Content-Type: text/csv; charset=utf-8');

        //força o download e define o nome do arquivo
        header('Content-Disposition: attachment; filename=relatorioDespesas.csv');

        $excel = fopen('php://output', 'w'); //abre o arquivo para escrita

        //escreve o cabeçalho
        fputcsv($excel, ['Valor', 'Data', 'Pagamento', 'Categoria', mb_convert_encoding('Descrição', 'ISO-8859-1', 'UTF-8')], ';');

        //escreve os dados
        foreach ($dados as $dado) {
            fputcsv($excel, [
                mb_convert_encoding('R$ ' . $dado->valor, 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($dado->data_compra, 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($dado->tipo_pagamento_id->tipo, 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($dado->categoria_id->nome, 'ISO-8859-1', 'UTF-8'),
                mb_convert_encoding($dado->descricao, 'ISO-8859-1', 'UTF-8')
            ], ';');
        }

        fclose($excel); //fecha o arquivo
    }

    private function retornaPdf($dados)
    {
        unset($dados['tipo']);

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
