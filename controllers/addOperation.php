<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use src\models\Operation;
$operation = new Operation();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}

$amount = $_POST['amount'];
$type = $_POST['type'];
$description = $_POST['description'];
$user_id = $_SESSION['user_id'];

$addOperation = $operation->addOperation($user_id, $amount, $type, $description);

if(!$addOperation){//false
    echo "Ошибка добавления операции";
    exit();
}

header('Location: ../');
