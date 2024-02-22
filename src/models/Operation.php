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
        $sql = "SELECT DISTINCT
            CASE 
                WHEN type = 'income' THEN 'Приход'
                WHEN type = 'expense' THEN 'Расход'
                END AS type
            FROM operations";

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

        return true;
    }


}
