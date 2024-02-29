<?php

require_once __DIR__ . '/../vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

use src\models\Operation;

$operation = new Operation();

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    exit();
}

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'Идентификатор операции не был передан']);
}

$id = $_GET['id'];
$delOperation = $operation->delOperation($id);

if (!$delOperation) {
    echo json_encode(['error' => 'Ошибка удаления операции']);
    exit();
}

$totalIncome = $operation->totalIncome() ?? '';
$totalExpense = $operation->totalExpense() ?? '';
$lastTenOperations = $operation->lastTenOperations();
$array = [$totalIncome, $totalExpense, $lastTenOperations];
echo json_encode($array);
