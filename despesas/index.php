<?php

use Util\EndpointsUtil;
use Validator\ResquestValidator;
use Util\TrataSaida;

include 'Configs.php';

try {

  $requestValidator = new ResquestValidator(EndpointsUtil::getEndpoint()); //valida a requisição
  $retono = $requestValidator->processarRequisicao();

  $saida = new TrataSaida();
  $saida->tratarRetorno($retono);
  
} catch (Exception $e) {
  echo mb_convert_encoding(json_encode(["erro" => $e->getMessage()]), 'UTF-8', mb_detect_encoding($e->getMessage()));
  $e->getMessage();
}
