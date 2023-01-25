<?php

//mostrar os erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

const db_host = "localhost";
const db_name = "apidespesas";
const db_pwd = "";
const db_user = "root";

const DS = DIRECTORY_SEPARATOR; // constante para separador de diretório "/"
const DIR_APP = __DIR__; //diretório para o autoload

const DIR_PROJETO = 'api/despesas';

if (file_exists('autoload.php')) {
    include 'autoload.php';
} else {
    echo "erro ao incluir configs";
    exit;
}
