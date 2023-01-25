<?php

use Util\EndpointsUtil;
use Validator\ResquestValidator;
use Util\JsonUtil;

include 'Configs.php';

try {

  $requestValidator = new ResquestValidator(EndpointsUtil::getEndpoint()); //valida a requisição
  $retono = $requestValidator->processarRequisicao();

  $Json = new JsonUtil();
  $Json->tratarRetorno($retono);
} catch (Exception $e) {
  echo mb_convert_encoding(json_encode(["erro" => $e->getMessage()]), 'UTF-8', mb_detect_encoding($e->getMessage()));
  $e->getMessage();
}
