<?php

namespace src\controllers;

use src\models\User;

class Validation
{
    function isTel(string $tel): bool// Введенное значение состоит только из цифр и является телефонным номером
    {
        return ctype_digit($tel);
    }
    function isEmail($email):bool//веденный логин является email-ом
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function isName($name): bool
    {
        return preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]+$/u", $name);
    }

    function isPasswordsMatch($pass1, $pass2): bool
    {
        //return password_verify($pass1, $pass2);
        if (password_verify($pass1, $pass2)) {
            return true;
        } else {
            return $pass1 === $pass2;
        }
    }

    function IsUserInDatabase($tel, $email): bool
    {
        $user = new User();
        $currentUser = $user->user($tel, $email);
        if(!empty($currentUser)){
            return true;
        }
        return false;
    }

    function isPositiveNumber($amount): bool
    {
        if (is_numeric($amount) && $amount > 0) {
                return true;
        }
        return false;
    }

    function isCorrectText($text): bool
    {
        return preg_match('/^[a-zA-ZА-яёЁ\s\d.,!?\"]+$/u', $text);
    }

}
