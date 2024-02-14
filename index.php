<?php

class index
{
    public function f()
    {
        echo "Привет";
    }
}
$f = new index();
$f->f();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="/">Main</a><br>
<a href="/registration">Registration</a><br>
<a href="/login">Login</a><br>
<!--в футер подключения скриптов-->
<script src="/assets/js/index.js"></script><br>


</body>
</html>
