<?php

namespace models;

class Abstract_
{

    private $db;
    public function __construct()
    {
        $con = new DB();
        $this->db = $con->connection();
    }
// Проверка выполнения запроса к БД
    function dbCheckError($query)
    {
        $errorInfo = $query->errorInfo();
        if ($errorInfo[0] !== PDO::ERR_NONE) {
            echo $errorInfo[2];
            exit();
        }
        return true;
    }
}