<?php

namespace src\models;

class Operation extends Abstract_
{
    private \PDO $db;
public function __construct()
{
    $con = new DB();
    $this->db = $con->connection();
}

    public function types()
    {
        $sql = "SELECT DISTINCT type FROM operations";

        $query = $this->db->prepare($sql);
        $query->execute();
        $this->dbCheckError($query);
        return $query->fetchAll();
    }
    public function addOperation($user_id, $amount, $type, $description)
    {
        $sql = "INSERT INTO operations (user_id, amount, type, description) VALUES (:user_id, :amount, :type, :description)";

        $query = $this->db->prepare($sql);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':amount', $amount);
        $query->bindParam(':type', $type);
        $query->bindParam(':description', $description);
        $query->execute();
        $this->dbCheckError($query);

        // Получаем ID только что добавленной операции
        $operationId = $this->db->lastInsertId();

        // Получаем данные только что добавленной операции для возврата
        $sql = "SELECT operations.*, users.name AS user_name FROM operations
            JOIN users ON users.id = operations.user_id WHERE operations.id = :id";
        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $operationId);
        $query->execute();
        $this->dbCheckError($query);
        $operationData = $query->fetch();

        return $operationData;
    }

    public function delOperation($id): bool
    {
        $sql = "DELETE FROM operations WHERE id = :id";

        $query = $this->db->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        $this->dbCheckError($query);

        // Обновление списка строк таблицы
        //return $this->lastTenOperations();
        return true;
    }

    public function lastTenOperations()
    {
        $sql = "SELECT operations.*, users.name AS user_name FROM operations
            JOIN users ON users.id = operations.user_id
            ORDER BY operations.id DESC
            LIMIT 10";
        $query = $this->db->prepare($sql);
        $query->execute();
        $this->dbCheckError($query);
        return $query->fetchAll();
    }

    public function totalIncome()
    {
        $sql = "SELECT SUM(amount) AS total_income FROM operations WHERE type = 'Приход'";
        $query = $this->db->prepare($sql);
        $query->execute();
        $this->dbCheckError($query);
        return $query->fetchColumn();
    }

    public function totalExpense()
    {
        $sql = "SELECT SUM(amount) AS total_expense FROM operations WHERE type = 'Расход'";
        $query = $this->db->prepare($sql);
        $query->execute();
        $this->dbCheckError($query);
        return $query->fetchColumn();
    }
}
