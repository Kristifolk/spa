<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use src\components\Validation;
use src\models\User;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}

$name = $_POST['name'] ?? '';
$tel = $_POST['tel'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

if (empty($name) && empty($tel) && empty($email) && empty($password) && empty($confirmPassword)) {
    echo "Все поля обязательны для заполнения";
    exit();
}

$validation = new Validation();

if (!$validation->isName($name)) {
    echo 'Некорректный формат имени';
    exit();
}

if (!$validation->isTel($tel)) {
    echo 'Некорректный формат телефона';
    exit();
}

if (!$validation->isEmail($email)) {
    echo 'Некорректный формат email';
    exit();
}

if (!$validation->isPasswordsMatch($password, $confirmPassword)) {
    echo 'Пороли не совпадают';
    exit();
}

if ($validation->IsUserInDatabase($tel, $email)) {
    echo 'Пользователь с таким телефоном или email уже существует. Введите другие данные';
    exit();
}

$user = new User();

$registrationResult = $user->register($name, $tel, $email, $password);
$currentUser = $user->user($tel, $email);

if ($registrationResult) {
    $_SESSION['auth'] = true;
    $_SESSION['user'] = $name;
    $_SESSION['user_id'] = $currentUser["id"];
    header('Location: /');
} else {
    echo "Ошибка при регистрации пользователя";
    exit();
}
