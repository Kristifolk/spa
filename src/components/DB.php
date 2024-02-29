<?php

namespace src\components;

use PDO;
use PDOException;

class DB
{
    public function connection(): PDO
    {
        $driver = 'mysql';
        $host = 'db-spa';
        $db_name = 'spa';
        $db_user = 'root';
        $db_pass = 'root';
        $charset = 'utf8';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            return new PDO(
                "$driver:host=$host;dbname=$db_name; charset=$charset", $db_user, $db_pass, $options
            );
        } catch (PDOException $e) {
            die('Ошибка подключения к базе данных: ' . $e->getMessage());
        }
    }
}
