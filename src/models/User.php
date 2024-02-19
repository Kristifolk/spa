<?php

namespace src\models;

class User extends Abstract_
{
    private \PDO $db;

    public function __construct()
    {
        $con = new DB();
        $this->db = $con->connection();
    }

    public function loginEmail($login): array
    {
        $sql = "SELECT * FROM users WHERE email = '$login'";

        $query = $this->db->prepare($sql);
        //bindParam позволяет использовать различные значения для переменной $login и обеспечивает безопасность от SQL-инъекций
        $query->bindParam(':login', $login);
        $query->execute();
        $this->dbCheckError($query);

        return $query->fetchAll();
    }

    public function loginPhone($login)
    {
        $sql = "SELECT * FROM users WHERE tel = '$login'";

        $query = $this->db->prepare($sql);
        $query->bindParam(':login', $login);
        $query->execute();
        $this->dbCheckError($query);
        return $query->fetchAll();
    }

    public function register($name, $tel, $email, $password): bool
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, tel, email, password) VALUES (:name, :tel, :email, :password)";

        $query = $this->db->prepare($sql);

        $query->bindParam(':name', $name);
        $query->bindParam(':tel', $tel);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $hashed_password);

        $query->execute();

        $errorInfo = $this->dbCheckError($query);

        //var_dump($errorInfo);

        return true;
    }
}
