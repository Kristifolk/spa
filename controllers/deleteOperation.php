<?php

require_once __DIR__ . '/../vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

use src\models\Operation;

$operation = new Operation();

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delOperation = $operation->delOperation($id);

//if(!$delOperation){//false
//    echo "Ошибка удаления операции";
//    exit();
//}

//    if ($delOperation) {
//        echo json_encode(['status' => 'success']);
//    } else {
//        echo json_encode(['status' => 'error', 'message' => 'Ошибка удаления операции']);
//    }
//} else {
//    echo json_encode(['status' => 'error', 'message' => 'Идентификатор операции не был передан']);
}

//header('Location: ../');

$totalIncome = $operation->totalIncome() ?? '';
$totalExpense = $operation->totalExpense()  ?? '';
//$array = [$delOperation, $totalIncome, $totalExpense];
$array = [$totalIncome, $totalExpense];
echo json_encode($array);
