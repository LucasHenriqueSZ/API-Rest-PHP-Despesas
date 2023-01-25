<?php

namespace DB;

use PDO;
use PDOException;
use Exception;

class DBconnection
{
    private static $dbInstancia;

    public static function getInstance()
    {
        if (!isset(self::$dbInstancia)) {
            try {
                self::$dbInstancia = new PDO('mysql:host=' . db_host . ';dbname=' . db_name, db_user, db_pwd);
                self::$dbInstancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$dbInstancia->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return self::$dbInstancia;
        } else return self::$dbInstancia;
    }

    public static function prepare($sql)
    {
        try {
            return self::getInstance()->prepare($sql);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //retorna o id do ultimo registro inserido
    public static function lastInsertId()
    {
        return self::getInstance()->lastInsertId();
    }

}
