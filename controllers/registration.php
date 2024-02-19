<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "controller reg";

use src\models\User;

var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}

$name = $_POST['name'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

if (empty($name) && empty($tel) && empty($email) && empty($password) && empty($confirmPassword)) { // поля, заполняемые пользователем не пустые
    echo json_encode(['status' => 'fail', 'message' => 'Все поля обязательны для заполнения']);
    exit();
}

//$notValid = validation($password, $confirmPassword, $email, $tel, $name);
//if ($notValid) {
//    return;
//}

$user = new User();

$registration_result = $user->register($name, $tel, $email, $password);

//// Обработка результатов регистрации
//if ($registration_result) {
//    echo "Пользователь успешно зарегистрирован.";
//} else {
//    echo "Ошибка при регистрации пользователя.";
//}



if ($registration_result) {
    $_SESSION['auth'] = true;
    $_SESSION['user'] = $name;
    echo json_encode(['status' => 'successfully']);//редирект на главную registration.js/ checkStatusWithoutAlert.js
    exit();
} else {
    echo json_encode(['status' => 'fail', 'message' => 'Ошибка при регистрации пользователя']
    );
    exit();
}
