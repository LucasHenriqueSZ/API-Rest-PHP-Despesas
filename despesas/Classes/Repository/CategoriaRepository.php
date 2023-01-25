<?php

namespace Repository;

use Repository\RepositoryGenerico;
use DB\DBconnection;
use Exception;

class CategoriaRepository
{

    const tabelaCategoria = "categorias";

    //lista de todas as categorias
    public static function findAllCategorias()
    {
        return RepositoryGenerico::findAll(self::tabelaCategoria);
    }

    //busca categoria por id
    public static function findCategoriaById($id)
    {
        return RepositoryGenerico::findById(self::tabelaCategoria, $id);
    }

    //deleta categoria por id
    public static function deleteCategoria($id)
    {
        return RepositoryGenerico::delete(self::tabelaCategoria, $id);
    }

    //busca categoria por nome
    public static function findCategoriaByNome($nome)
    {
        return RepositoryGenerico::findByColumn(self::tabelaCategoria, 'nome', $nome);
    }

    //insere categoria
    public static function insertCategoria($categoria)
    {
        try {
            $sql = "INSERT INTO " . self::tabelaCategoria . " ( `nome`, `descricao`) VALUES (:nome, :descricao)";
            $stmt = DBconnection::prepare($sql);
            $stmt->bindParam(':nome', strtolower($categoria['nome']));
            $stmt->bindParam(':descricao', $categoria['descricao']);
            $stmt->execute();

            //verifica se o registro foi inserido
            if ($stmt->rowCount() > 0) {
                $retorno['id da categoria inserida'] = DBconnection::lastInsertId();
                return $retorno;
            } else {
                throw new Exception("Erro ao inserir registro");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //atualiza categoria
    public static function updateCategoria($categoria, $id)
    {
        try {
            $sql = "UPDATE " . self::tabelaCategoria . " SET `nome` = :nome, `descricao` = :descricao WHERE id = :id";
            $stmt = DBconnection::prepare($sql);
            $stmt->bindParam(':nome', strtolower($categoria['nome']));
            $stmt->bindParam(':descricao', $categoria['descricao']);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            //verifica se o registro foi atualizado
            if ($stmt->rowCount() > 0) {
                $retorno['id da categoria atualizada'] = $id;
                return $retorno;
            } else {
                throw new Exception("Erro ao atualizar registro");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
