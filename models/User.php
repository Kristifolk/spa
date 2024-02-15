<?php

namespace models;

use \models\DB;
class User extends Abstract_
{
private $db;
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
    dbCheckError($query);
    return $query->fetchAll();
}
}
