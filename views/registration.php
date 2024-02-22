<?php

session_start();

if (!empty($_SESSION['auth'])):
    header('Location: main.php');
else: ?>
<h1>Registration</h1> <!--удалить-->
<h1>Введите данные</h1>
<form id="registrationForm" action="../controllers/registration.php" method="POST">
    <label for="name">Имя:</label>
    <input type="text" name="name" id="name" placeholder="Имя"><br><br>

    <label for="tel">Телефон:</label>
    <input type="tel" name="tel" id="tel" required placeholder="89289999999"><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required placeholder="test@test.ru"><br><br>

    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password" required placeholder="Пароль"><br><br>

    <label for="confirm_password">Повторите пароль:</label>
    <input type="password" name="confirm_password" id="confirm_password" required placeholder="Пароль"><br><br>

    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>

</form>

<div class="error"></div> <!--это где используется-->

<a href="/">Main</a><br>
<?php
    endif; ?>
