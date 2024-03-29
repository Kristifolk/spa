<?php

session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>SPA</title>
</head>
<body>
<div class="page">
    <!-- navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!--меню бургер при мобильной версии START-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--меню бургер при мобильной версии END-->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
                        if (!empty($_SESSION['auth'])): ?>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Hi <?= $_SESSION['user'] ?></a>
                            </li>
                            <li class="nav-item">
                                <button type="button" onclick="logout()" class="nav-link" style="border: none; background: none;  cursor: pointer;" >Logout</button>
                            </li>
                        <?php
                        else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/registration">Registration</a>
                            </li>
                    </ul>
                            <h4>Войдите или зарегистрируйтесь</h4>
                        <?php
                        endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
<!--Здесь отображается страница, подгружаемая по fetch согласно routersHref из assets/js/index.js-->
    </div>

<!--отображение ошибок-->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="/assets/images/icons/cat_icon.jpeg" class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
            </div>
        </div>
    </div>

    <footer>
        <div class="footer">
            <div class="footer-col">
                <nav>
                    <ul>
                        <li><a href="#">HOME</a></li>
                        <li><a href="#">EDIT PROFILE</a></li>
                        <li><a href="#">ADD ARTICLE</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer-col">
                <nav>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contacs</a></li>
                        <li><a href="#">Privacy & cookies</a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer-col">
                <div class="logo">
                    <a href="#"><img class="graficlogo" src="/assets/images/icons/favorites.png" alt="logo"></a>
                </div>
                <div class="social">
                    <a href="#" class="fb-link"><img src="/assets/images/icons/fb_gray.png" alt="Facebook"></a>
                    <a href="#" class="insta-link"><img src="/assets/images/icons/insta_gray.png" alt="Instagram"></a>
                    <a href="#" class="youtube-link"><img src="/assets/images/icons/youtube_gray.png" alt="YouTube"></a>
                </div>
            </div>
            <p>Приложение для учета финансов. 2024</p>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossorigin="anonymous"></script>

        <script src="/assets/js/index.js"></script>
        <script src="/assets/js/logout.js"></script>
        <script src="/assets/js/deleteOperation.js"></script>
        <script src="/assets/js/addOperation.js"></script>

    </footer>
</div>

</body>
</html>
