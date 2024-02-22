<?php

session_start();

if (!empty($_SESSION['auth'])):
    header('Location: main.php');
else: ?>
<h1>Login</h1>
<form id="loginForm" action="/controllers/login.php" method="POST">
    <label for="login">Введите логин:</label>
    <input type="text" id="login" name="login" required
           pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,4}|[0-9]{10,12}"
           placeholder="89289999999 или test@test.ru"><br><br>

    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required placeholder="Пароль"><br><br>

    <button type="submit" class="btn btn-primary">Войти</button>
</form>

<?php
    endif; ?>
