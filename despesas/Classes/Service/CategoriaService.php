<?php

namespace Service;

use Repository\CategoriaRepository;
use Exception;

class CategoriaService
{

    //lista todas as categorias
    public static function getListCategorias()
    {
        return CategoriaRepository::findAllCategorias();
    }

    //busca categoria por id
    public static function getCategoriaById($id)
    {
        if ($id == null) {
            throw new Exception("Id nao pode ser nulo");
        }

        return CategoriaRepository::findCategoriaById($id);
    }

    //exclui categoria por id
    public static function excluirCategoria($id)
    {
        if ($id == null) {
            throw new Exception("Id nao pode ser nulo");
        }

        return CategoriaRepository::deleteCategoria($id);
    }

    //insere categoria
    public static function cadastrarCategoria($categoria)
    {

        if ($categoria == null) {
            throw new Exception("Categoria nao pode ser nula");
        }

        return CategoriaRepository::insertCategoria($categoria);
    }

    //atualiza categoria
    public static function editarCategoria($categoria, $id)
    {
        if ($id == null) {
            throw new Exception("id nao pode ser nulo");
        }

        return CategoriaRepository::updateCategoria($categoria, $id);
    }
}
