<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use src\models\User;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}

$name = $_POST['name'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

if (empty($name) && empty($tel) && empty($email) && empty($password) && empty($confirmPassword)) {
    echo "Все поля обязательны для заполнения";
    //echo json_encode(['status' => 'fail', 'message' => 'Все поля обязательны для заполнения']);
    exit();
}

//$notValid = validation($password, $confirmPassword, $email, $tel, $name);
//if ($notValid) {
//    return;
//}

$user = new User();

$registrationResult = $user->register($name, $tel, $email, $password);
$currentUser = $user->user($tel, $email);

if ($registrationResult) {
    $_SESSION['auth'] = true;
    $_SESSION['user'] = $name;
    $_SESSION['user_id'] = $currentUser["id"];
    header('Location: /login');//не работает
    //echo json_encode(['status' => 'successfully']);//редирект на главную registration.js/ checkStatusWithoutAlert.js
} else {
    echo "Ошибка при регистрации пользователя";
    //echo json_encode(['status' => 'fail', 'message' => 'Ошибка при регистрации пользователя']);
    exit();
}
