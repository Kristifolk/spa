<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "controller Login";

use src\models\User;

//var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit();
}

$login = $_POST['login'];
$password = $_POST['password'];

if (empty($login) && empty($password)) {
    echo json_encode(['status' => 'fail', 'message' => 'Все поля обязательны для заполнения']);
    exit();
}

//if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {//веденный логин является email-ом
//    echo json_encode(
//        [
//            'status' => 'fail',
//            'message' => 'Авторизация возможна по телефону, например 89289999999, или email, например test@test.ru'
//        ]
//    );
//}

//if (!filter_var($login, FILTER_VALIDATE_EMAIL || !ctype_digit($login) )) {
//    echo json_encode(
//        [
//            'status' => 'fail',
//            'message' => 'Авторизация возможна по телефону, например 89289999999, или email, например test@test.ru'
//        ]
//    );
//}


//$notValid = validation($login);
//if ($notValid) {
//    exit();
//}

$user = new User();

$LoginEmailResult = $user->loginEmail($login);
$LoginPhoneResult = $user->loginPhone($login);

if (!empty($LoginEmailResult))
{
    authentication($LoginEmailResult);
    var_dump(123);
} else if (!empty($LoginPhoneResult))
{
    authentication($LoginPhoneResult);
    var_dump(456);
}




function authentication($LoginResult):void
{
    var_dump($LoginResult);
    $name = $LoginResult[0]['name'];
    $tel = $LoginResult[0]['tel'];
    $email = $LoginResult[0]['email'];
    $id = $LoginResult[0]['id'];
    $hashedPassword = $LoginResult[0]['password'];
    $_SESSION['auth'] = true;
    $_SESSION['user'] = $name;
    echo json_encode(['status' => 'successfully']);//редирект на main (или index? а оттуда на main)
}


function validation(string $login) // вернет bool?
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
//    if (password_verify($password, $hashedPassword)) {
//        // Пароль совпадает, редирект
//    } else {
//    echo json_encode(['status' => 'fail', 'message' => 'Пароль не совпадает']);
//}
}







