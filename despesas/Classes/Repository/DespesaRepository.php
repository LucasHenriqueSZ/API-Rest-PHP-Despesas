<?php

namespace Repository;

use Repository\RepositoryGenerico;
use Exception;
use DB\DBconnection;
use Repository\CategoriaRepository;
use Repository\Tipo_PagamentoRepository;

class DespesaRepository
{

    const tabelaDespesa = "despesas";

    public static function findAllDespesas()
    {
        return RepositoryGenerico::findAll(self::tabelaDespesa);
    }

    public static function findDespesaById($id)
    {
        return RepositoryGenerico::findById(self::tabelaDespesa, $id);
    }

    public static function deleteDespesaById($id)
    {
        return RepositoryGenerico::delete(self::tabelaDespesa, $id);
    }

    public static function insertDespesa($despesa)
    {

        try {

            if ($despesa['valor'] == "" || $despesa['data_compra'] == "" || $despesa['descricao'] == "" || $despesa['tipo_pagamento'] == "" || $despesa['categoria'] == "") {
                throw new Exception("Todos os campos devem ser preenchidos");
            }

            $sql = "INSERT INTO " . self::tabelaDespesa . " ( `valor`, `data_compra`, `descricao`, `tipo_pagamento_id`, `categoria_id`) VALUES (:valor,:data, :descricao, :tipo_Pagamento , :categoria_id)";
            $stmt = DBconnection::prepare($sql);
            $stmt->bindParam(':valor', $despesa['valor']);
            $stmt->bindParam(':data', $despesa['data_compra']);
            $stmt->bindParam(':descricao', $despesa['descricao']);

            //busca o id do tipo de pagamento e categoria
            $stmt->bindParam(':tipo_Pagamento', Tipo_PagamentoRepository::findTipoPagamentoByNome(strtolower($despesa['tipo_pagamento']))->id);
            $stmt->bindParam(':categoria_id', CategoriaRepository::findCategoriaByNome(strtolower($despesa['categoria']))->id);

            $stmt->execute();

            //verifica se o registro foi inserido
            if ($stmt->rowCount() > 0) {
                $retorno['id da despesa inserida'] = DBconnection::lastInsertId();
                return $retorno;
            } else {
                throw new Exception("Erro ao inserir registro");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //procura no banco de dados a despesa no intervalo de ids
    public static function findAllDespesasPaginacao($id1, $id2)
    {
        try {

            if ($id1 == null || $id2 == null || $id1 >= $id2) {
                throw new Exception("Os ids nao podem ser nulos e o id1 deve ser menor que o id2");
            }

            $sql = "SELECT * FROM " . self::tabelaDespesa . " WHERE id >= :id1 AND id <= :id2";
            $stmt = DBconnection::prepare($sql);
            $stmt->bindParam(':id1', $id1);
            $stmt->bindParam(':id2', $id2);
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

    //atualiza despesa
    public static function updateDespesa($despesa, $id)
    {
        try {
            $sql = "UPDATE " . self::tabelaDespesa . " SET `valor` = :valor, `data_compra` = :data, `descricao` = :descricao, `tipo_pagamento_id` = :tipo_Pagamento , `categoria_id` = :categoria_id WHERE id = :id";
            $stmt = DBconnection::prepare($sql);
            $stmt->bindParam(':valor', $despesa['valor']);
            $stmt->bindParam(':data', $despesa['data_compra']);
            $stmt->bindParam(':descricao', $despesa['descricao']);

            //busca o id do tipo de pagamento e categoria
            $stmt->bindParam(':tipo_Pagamento', Tipo_PagamentoRepository::findTipoPagamentoByNome(strtolower($despesa['tipo_pagamento']))->id);
            $stmt->bindParam(':categoria_id', CategoriaRepository::findCategoriaByNome(strtolower($despesa['categoria']))->id);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            //verifica se o registro foi atualizado
            if ($stmt->rowCount() > 0) {
                $retorno['id da despesa alterada'] = $id;
                return $retorno;
            } else {
                throw new Exception("Erro ao atualizar registro");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    //busca as despesas no intervalo de datas 
    public static function  findDespesasByData($data1, $data2)
    {
        try {
            $sql = "SELECT * FROM " . self::tabelaDespesa . " WHERE data_compra >= :data1 AND data_compra <= :data2  ORDER BY data_compra ";
            $stmt = DBconnection::prepare($sql);
            $stmt->bindParam(':data1', $data1);
            $stmt->bindParam(':data2', $data2);
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
}
