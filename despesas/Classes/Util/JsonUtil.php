<?php

namespace Util;

use JsonException as JsonExceptionAlias;
use Exception;

class JsonUtil
{
    //recebe o body das requisiçoes post e put  
    public static function tratarBody()
    {
        try {
            //Recebe todos os dados de entrada que vao para o PHP e converto para um array
            $json = json_decode(file_get_contents('php://input'), true);

            if (is_array($json) && count($json) > 0) {
                return $json;
            }
        } catch (JsonExceptionAlias $e) {
            throw new Exception("Erro ao tratar o Json da requisição");
        }
    }
}
