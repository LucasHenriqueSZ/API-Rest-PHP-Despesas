<?php

namespace Repository;

use DB\DBconnection;
use Exception;

class RepositoryGenerico
{

    //metodo para buscar todos os dados de uma tabela
    public static function findAll($tabela)
    {
        try {
            $sql = "SELECT * FROM " . $tabela;
            $stmt = DBconnection::prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();

            //verifica se o resultado é um array e se tem registros
            if (is_array($result) && count($result) > 0) {
                return $result;
            } else {
                throw new Exception("Nenhum registro encontrado");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //metodo para excliur um registro de uma tabela
    public static function delete($tabela, $id)
    {
        try {
            $sql = "DELETE FROM " . $tabela . " WHERE id = :id";
            $stmt = DBconnection::prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            //verifica se o registro foi excluido
            if ($stmt->rowCount() > 0) {
                $retorno['mensagem'] = "Registro excluido com sucesso";
                return $retorno;
            } else {
                throw new Exception("Erro ao excluir registro");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //metodo para buscar um registro de uma tabela por id
    public static function findById($tabela, $id)
    {
        try {
            $sql = "SELECT * FROM " . $tabela . " WHERE id = :id";
            $stmt = DBconnection::prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();

            //verifica se o resultado é um objeto e se tem registros
            if (is_object($result) && empty($result) == false) {
                return $result;
            } else {
                throw new Exception("Nenhum registro encontrado");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //metodo para buscar um registro de uma tabela por coluna e valor
    public static function findByColumn($tabela, $coluna, $valor)
    {
        try {
            $sql = "SELECT * FROM " . $tabela . " WHERE " . $coluna . " = :valor";
            $stmt = DBconnection::prepare($sql);
            $stmt->bindParam(':valor', $valor);
            $stmt->execute();
            $result = $stmt->fetch();

            //verifica se o resultado é um objeto e se tem registros
            if (is_object($result) && empty($result) == false) {
                return $result;
            }
            throw new Exception("Nenhum registro encontrado na tabela " . $tabela . " com o valor " . $valor . " na coluna " . $coluna);
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}
