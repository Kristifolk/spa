<?php

// Удалить сессионные cookie, если они существуют
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Уничтожить сессию
session_unset();
header("Location: views/logout.php");//не редиректит на views/logout.php, а кидает на индекс и дублируется layout
