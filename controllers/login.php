<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

use src\models\User;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}

$login = $_POST['login'];
$password = $_POST['password'];

if (empty($login) && empty($password)) {
    echo "Все поля обязательны для заполнения";
    //echo json_encode(['status' => 'fail', 'message' => 'Все поля обязательны для заполнения']);
    exit();
}

$Valid = validation($login);
if (!$Valid) {
    echo "Авторизация возможна по телефону, например 89289999999, или email, например test@test.ru";
    exit();
}

$user = new User();
$LoginEmailResult = $user->loginEmail($login);
$LoginPhoneResult = $user->loginPhone($login);

if (!empty($LoginEmailResult)) {
    authentication($LoginEmailResult);
} else {
    if (!empty($LoginPhoneResult)) {
        authentication($LoginPhoneResult);
    } else {
        echo "Неверный логин или пароль";
        exit();
    }
}

function authentication($LoginResult): void
{
    //var_dump($LoginResult);
    global $password;
    $name = $LoginResult[0]['name'];
    $tel = $LoginResult[0]['tel'];
    $email = $LoginResult[0]['email'];
    $id = $LoginResult[0]['id'];
    $hashedPassword = $LoginResult[0]['password'];

    if (!password_verify($password, $hashedPassword)) {
        echo "Пароль не совпадает";
        exit();
    }

    $_SESSION['auth'] = true;
    $_SESSION['user'] = $name;
    $_SESSION['user_id'] = $id;
    header('Location: http://127.0.0.1:83/');//без js просто редирект на main при успешной регистрации
}

function validation(string $login): bool
{
    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {//веденный логин является email-ом
        return true;
    } elseif (ctype_digit($login)) { // Введенный логин является телефонным номером и состоит только из цифр
        return true;
    } else {
        return false;
    }
}
