<?php

session_start();
error_reporting(E_ALL);//показывать ошибки
ini_set('display_errors', 1);
echo "controller Login";

$user = new User();
$queryLoginEmail = $user->loginEmail($login);
$queryLoginPhone = $user->loginPhone($login);

//$_SESSION['auth']
//$_SESSION['user']

//namespace controllers;

use models\User;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}
$login = $_POST['login'];
$password = $_POST['password'];

if (!empty($login) && !empty($password)) {
    echo json_encode(['status' => 'fail', 'message' => 'Все поля обязательны для заполнения']);
    exit();
}

$notValid = validation($login);
if ($notValid) {
    exit();
}

function validation(string $login) //валидация введенных данных
{
    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {//веденный логин является email-ом
//        $query = "SELECT * FROM users WHERE email = '$login'";
//        return $query;
        return $queryLoginEmail;
    } elseif (ctype_digit($login)) { // Введенный логин является телефонным номером и состоит только из цифр
//        $query = "SELECT * FROM users WHERE tel = '$login'";
//        return $query;
        return $queryLoginPhone;
    } else {
        echo json_encode(
            [
                'status' => 'fail',
                'message' => 'Авторизация возможна по телефону, например 89289999999, или email, например test@test.ru'
            ]
        );
        return false;
    }
}







