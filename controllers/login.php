<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use src\models\User;
use src\controllers\Validation;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}

$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($login) && empty($password)) {
    echo "Все поля обязательны для заполнения";
    exit();
}

$validation = new Validation();

if (!($validation->isEmail($login) || $validation->isTel($login))) {
    echo "Авторизация возможна по телефону, например 89289999999, или email, например test@test.ru";
    exit();
}

$user = new User();
$LoginEmailResult = $user->loginEmail($login);
$LoginPhoneResult = $user->loginPhone($login);

if (!empty($LoginEmailResult)) {
    authentication($LoginEmailResult, $password, $validation);
} else {
    if (!empty($LoginPhoneResult)) {
        authentication($LoginPhoneResult, $password, $validation);
    } else {
        echo "Неверный логин или пароль";
        exit();
    }
}

function authentication($LoginResult, $pass, Validation $validation): void
{
    $name = $LoginResult[0]['name'];
    $id = $LoginResult[0]['id'];
    $hashedPassword = $LoginResult[0]['password'];

    if (!$validation->isPasswordsMatch($pass, $hashedPassword)) {
        echo "Пароль не совпадает";
        exit();
    }

    $_SESSION['auth'] = true;
    $_SESSION['user'] = $name;
    $_SESSION['user_id'] = $id;
    header('Location: /');
}
