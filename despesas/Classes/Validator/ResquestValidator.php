<?php

namespace Validator;

use Exception;
use Util\JsonUtil;
use Util\Constantes;
use Service\DespesaService;
use Service\CategoriaService;
use Service\TipoPagamentoService;

class ResquestValidator
{

  const GET = 'GET';
  const POST = 'POST';
  const PUT = 'PUT';
  const DELETE = 'DELETE';

  private $requisicao;
  private array $dadosRequisicao;

  public function __construct($requisicao)
  {
    $this->requisicao = $requisicao;
  }


  public function processarRequisicao()
  {

    //verifica se a requisição é permitida(POST, GET, PUT, DELETE)
    if (in_array($this->requisicao['metodo'], Constantes::requisicoes, true)) {
      $retorno = $this->direcionaRequisicao();
    } else {
      header('HTTP/1.1 405 Requisicao nao permitida');
      throw new Exception('Requisicao nao permitida');
    }

    return $retorno;
  }

  private function direcionaRequisicao()
  {
    //verifica se o metodo é post ou put e trata o json da requisição
    if ($this->requisicao['metodo'] !== self::GET && $this->requisicao['metodo'] !== self::DELETE
     && in_array($this->requisicao['rota'], Constantes::requisicoesPost, true) 
     || in_array($this->requisicao['rota'], Constantes::requisicoesPut, true)) {
      
      $this->dadosRequisicao = JsonUtil::tratarBody();
    }

    $metodo = $this->requisicao['metodo'];
    //metodo dinamico, chama o metodo correspondente ao metodo da requisição| GET -> GET() | POST -> POST() ...
    return $this->$metodo();
  }


  private function POST()
  {
    //verifica se a rota é permitida, se esta declarada no arquivo de constantes
    if (in_array($this->requisicao['rota'], Constantes::requisicoesPost, true)) {

      //verifica qual a rota e chama o metodo correspondente
      switch ($this->requisicao['rota']) {
        case Constantes::requisicoesPost[0]: // ''
          $retorno = DespesaService::cadastrarDespesa($this->dadosRequisicao);
          break;

        case Constantes::requisicoesPost[1]: // '/cadastrarCategoria'
          $retorno = CategoriaService::cadastrarCategoria($this->dadosRequisicao);
          break;
      }
      return $retorno; //retorna a resposta da requisição
    } else {
      throw new Exception('Rota nao permitida');
    }
  }

  private function PUT()
  {

    if (in_array($this->requisicao['rota'], Constantes::requisicoesPut, true)) {


      switch ($this->requisicao['rota']) {
        case Constantes::requisicoesPut[0]: // '/editarDespesa'
          $retorno = DespesaService::editarDespesa($this->dadosRequisicao, $this->requisicao['parametro1']);
          break;

        case Constantes::requisicoesPut[1]: // '/editarCategoria'
          $retorno = CategoriaService::editarCategoria($this->dadosRequisicao, $this->requisicao['parametro1']);
          break;
      }
      return $retorno;
    } else {
      throw new Exception('Rota nao permitida');
    }
  }

  private function GET()
  {

    if (in_array($this->requisicao['rota'], Constantes::requisicoesGet, true)) {

      switch ($this->requisicao['rota']) {
        case Constantes::requisicoesGet[0]: // ''
          $retorno = DespesaService::getListDespesas();
          break;

        case Constantes::requisicoesGet[1]: // '/consultar'
          $retorno = DespesaService::getDespesaPorId($this->requisicao['parametro1']);
          break;

        case Constantes::requisicoesGet[2]: // '/listarCategorias'
          $retorno = CategoriaService::getListCategorias();
          break;

        case Constantes::requisicoesGet[3]: // '/categoria'
          $retorno = CategoriaService::getCategoriaById($this->requisicao['parametro1']);
          break;

        case Constantes::requisicoesGet[4]: // '/tipopagamento'
          $retorno = tipoPagamentoService::getTipoPagamentoById($this->requisicao['parametro1']);
          break;

        case Constantes::requisicoesGet[5]: // '/listarTiposPagamento'
          $retorno = tipoPagamentoService::getListTiposPagamento();
          break;

        case Constantes::requisicoesGet[6]: // '/listaDespesas'
          $retorno = DespesaService::getListDespesasPaginacao($this->requisicao['parametro1'], $this->requisicao['parametro2']);
          break;
          // pdfdespesas
        case Constantes::requisicoesGet[7]: // '/pdfdespesas'
          $retorno = DespesaService::gerarDadosPdfDespesas($this->requisicao['parametro1'], $this->requisicao['parametro2']);
          break;

        case Constantes::requisicoesGet[8]: // '/excelDespesas'
          $retorno = DespesaService::gerarDadosExcelDespesas();
          break;
      }
      return $retorno;
    } else {
      throw new Exception('Rota nao permitida');
    }
  }

  private function DELETE()
  {

    if (in_array($this->requisicao['rota'], Constantes::requisicoesDelete, true)) {


      switch ($this->requisicao['rota']) {
        case Constantes::requisicoesDelete[0]: // '/excluirDespesa'
          $retorno = DespesaService::excluirDespesa($this->requisicao['parametro1']);
          break;

        case Constantes::requisicoesDelete[1]: // '/excluirCategoria'
          $retorno = CategoriaService::excluirCategoria($this->requisicao['parametro1']);
          break;
      }
      return $retorno;
    } else {
      throw new Exception('Rota nao permitida');
    }
  }
}
