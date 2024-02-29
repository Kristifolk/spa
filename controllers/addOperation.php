<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use src\components\Validation;
use src\models\Operation;

$operation = new Operation();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}

$amount = $_POST['amount'];
$type = $_POST['type'];
$description = $_POST['description'];
$user_id = $_SESSION['user_id'];

$validation = new Validation();

if(!$validation->isPositiveNumber($amount)){
    echo json_encode(['error' => 'Введите положительное число']);
    exit();
}

if(!$validation->isCorrectText($description)){
    echo json_encode(['error' => 'Некорректный ввод комментария']);
    exit();
}

$operationData = $operation->addOperation($user_id, $amount, $type, $description);

if(!$operationData){
    echo json_encode(['error' => 'Ошибка добавления операции']);
    exit();
}

$totalIncome = $operation->totalIncome();
$totalExpense = $operation->totalExpense();
$array = ['operationData' => $operationData, 'totalIncome' => $totalIncome, 'totalExpense' => $totalExpense];
echo json_encode($array);
