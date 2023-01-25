<?php

namespace Service;

use Repository\CategoriaRepository;
use Exception;

class CategoriaService
{

    public static function getListCategorias()
    {
        return CategoriaRepository::findAllCategorias();
    }

    public static function getCategoriaById($id)
    {
        if ($id == null) {
            throw new Exception("Id nao pode ser nulo");
        }

        return CategoriaRepository::findCategoriaById($id);
    }

    public static function excluirCategoria($id)
    {
        if ($id == null) {
            throw new Exception("Id nao pode ser nulo");
        }

        return CategoriaRepository::deleteCategoria($id);
    }

    public static function cadastrarCategoria($categoria)
    {

        if ($categoria == null) {
            throw new Exception("Categoria nao pode ser nula");
        }

        return CategoriaRepository::insertCategoria($categoria);
    }

    public static function editarCategoria($categoria, $id)
    {
        if ($id == null) {
            throw new Exception("id nao pode ser nulo");
        }

        return CategoriaRepository::updateCategoria($categoria, $id);
    }
}
