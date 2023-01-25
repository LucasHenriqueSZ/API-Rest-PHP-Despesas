<?php

namespace Repository;

use Repository\RepositoryGenerico;
use DB\DBconnection;
use Exception;

class CategoriaRepository
{

    const tabelaCategoria = "categorias";

    public static function findAllCategorias()
    {
        return RepositoryGenerico::findAll(self::tabelaCategoria);
    }

    public static function findCategoriaById($id)
    {
        return RepositoryGenerico::findById(self::tabelaCategoria, $id);
    }

    public static function deleteCategoria($id)
    {
        return RepositoryGenerico::delete(self::tabelaCategoria, $id);
    }

    public static function findCategoriaByNome($nome)
    {
        return RepositoryGenerico::findByColumn(self::tabelaCategoria, 'nome', $nome);
    }

    public static function insertCategoria($categoria)
    {
        try {
            if ($categoria['nome'] == '' || $categoria['descricao'] == '') {
                throw new Exception("Todos os campos devem ser preenchidos");
            }

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
