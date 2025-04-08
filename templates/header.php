<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/index.php');
UserActions::signOut();
$currentUser = UserLogic::currentUser();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon_32x32.png">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Образовательная программа «Прикладная математика и информатика» — Национальный исследовательский университет
        «Высшая школа экономики»</title>
</head>

<body>

<div class="background-container">
    <header class="bg-opacity-0">
        <div class="container-fluid">
            <div class="row d-flex align-items-stretch border-bottom border-1 border-light">
                <div class="col-auto flex-shrink-0 d-flex">
                    <a class="text-decoration-none  d-flex align-items-center border-end border-1 border-light pe-3"
                       href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black"
                             class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </a>

                    <a class="navbar-brand ps-3 d-flex align-items-center" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 309 309"
                             fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M68.4423 26.0393C93.7686 9.06174 123.545 0 154.005 0C194.846 0 234.015 16.275 262.896 45.2451C291.777 74.2153 308.005 113.508 308.01 154.481C308.013 185.039 298.984 214.911 282.065 240.321C265.145 265.731 241.094 285.537 212.953 297.234C184.813 308.931 153.847 311.993 123.972 306.034C94.0966 300.074 66.6537 285.361 45.1138 263.755C23.5739 242.148 8.90442 214.619 2.96053 184.649C-2.98335 154.678 0.0653089 123.612 11.721 95.3799C23.3767 67.1476 43.1159 43.0168 68.4423 26.0393ZM180.336 140.561C212.051 151.8 224.284 177.329 224.284 215.345V255.047H99.593V48.1729H154.908C175.847 48.1729 184.602 51.8575 194.493 59.5386C208.902 70.8654 211.166 87.3096 211.166 95.5561C211.299 106.453 207.484 117.028 200.43 125.316C195.128 132.023 188.214 137.269 180.336 140.561ZM196.038 211.485C196.038 168.722 182.396 145.328 147.339 145.328V134.927H147.553C152.962 134.963 158.306 133.751 163.173 131.385C168.041 129.018 172.301 125.561 175.624 121.28C182.066 113.463 183.387 106.093 183.688 99.5137H147.582V89.3566H183.378C182.573 82.4432 179.883 75.8863 175.604 70.4072C167.413 60.1917 155.812 58.4761 148.175 58.4761H127.771V243.779H147.582V174.57H173.554V243.652H196.038V211.485Z"
                                  fill="black"></path>
                        </svg>
                    </a>
                </div>

                <div class="col">
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '\2192';">
                        <ul class="breadcrumb justify-content-start mb-0">
                            <li class="breadcrumb-item small"><a href="#" class="">Национальный
                                    исследовательский университет «Высшая школа экономики»</a></li>
                            <li class="breadcrumb-item small"><a href="#" class="">Образовательные
                                    программы
                                    бакалавриата</a></li>
                            <li class="breadcrumb-item small"><a href="#" class="">Факультет
                                    компьютерных
                                    наук</a></li>
                            <li class="breadcrumb-item small active"><a href="#"
                                                                              class="">Образовательная
                                    программа «Прикладная математика и информатика»</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-auto flex-shrink-0 d-flex align-items-center offset-1">

                    <?php if (empty($currentUser)): ?>
                        <div class="d-flex flex-column align-items-end">
                            <span>Вы не авторизованы</span>
                            <div class="d-flex">
                                <a class="text-orange hover-darkorange" href="../pages/login.php">Ввести логин и пароль</a>
                                <span class="mx-1">или</span>
                                <a class="text-orange hover-darkorange" href="../pages/register.php">зарегистрироваться</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="d-flex align-items-center gap-2">
                            <span>Вы авторизованы как <span class="text-orange"><?php echo $currentUser['email'] ?></span></span>
                            <form method="POST">
                                <input type="hidden" name="action" value="signOut">
                                <button type="submit" class="btn btn-dark hover-orange py-1" style="font-size: 14px;">
                                    Выйти
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </header>
