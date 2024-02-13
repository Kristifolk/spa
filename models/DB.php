<?php

namespace models;

class DB
{
    public function instance()
    {
        $dbHost = 'db-spa';
        $dbUser = 'root';
        $dbPassword = 'root';
        $dbName = 'spa';

        try {
            $connection = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
            if (!$connection) {
                throw new \Exception('Ошибка подключения к базе данных: ' . mysqli_connect_error());
            }
            return $connection;
        } catch (\Exception $e) {
            echo "Ошибка: " . $e->getMessage(), "\n";
        }
    }
}
