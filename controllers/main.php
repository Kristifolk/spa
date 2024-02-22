<?php
//походу лишний. Удалить
session_start();

if (!empty($_SESSION['auth'])):
    echo "controller main";
    ?>

<!--    //логика-->
<?php
else:
    //header('Location: login.php');
endif; ?>

