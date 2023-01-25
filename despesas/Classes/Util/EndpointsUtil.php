<?php

namespace Util;

class EndpointsUtil
{

    //retorna um array com os valores da url
    public static function getEndpoint()
    {

        $urls = self::getUrls();

        $endpoint = [];
        $endpoint['rota'] = $urls[0];
        $endpoint['parametro1'] = $urls[1];
        $endpoint['parametro2'] = $urls[2];
        $endpoint['metodo'] = $_SERVER['REQUEST_METHOD'];

        return $endpoint;
    }

    public static function getUrls()
    {

        //pega a url e filtra a requisição 
        //ex: /api/despesas/categoria/editarDespesa/1
        //retorna: /editarDespesa/1
        $uri = str_replace('/' . DIR_PROJETO, '', $_SERVER['REQUEST_URI']);

        //retorna um array com os valores da url
        return explode('/', trim($uri, '/'));
    }
}
