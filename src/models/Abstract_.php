<?php

namespace src\models;

use PDO;
use src\models\DB;

class Abstract_
{
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
