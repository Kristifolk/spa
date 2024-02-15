<?php

namespace controllers;

use models\User;

class Login
{
    private $user;

    public function __construct()
    {
        $user = new User();
    }
    public function login()
    {
        $login =$this->user->loginEmail();
}
}

//session_start();
//error_reporting(E_ALL);//показывать ошибки
//ini_set('display_errors', 1);
//$_SESSION['auth']
//$_SESSION['user']

