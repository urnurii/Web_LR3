<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/.core/index.php');

class UserActions
{
    // Функция для проверки авторизации пользователя
    public static function requireAuth(string $from): void
    {
        if (!UserLogic::isAuthorized()) {
            // Если пользователь не авторизован, перенаправляем на страницу входа
            header("Location: login.php?from=$from");
            die();
        }
    }

    public static function signIn(): string
    {
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return '';
        }

        if ('signIn' !== $_POST['action']) {
            return '';
        }

        $errors = UserLogic::signIn($_POST['email'], $_POST['password']);

        if (empty($errors)) {
            header("Location: " . $_GET['from']);
            die();
        }

        return $errors;
    }

    public static function signUp(): array
    {
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return [];
        }

        if ('signUp' !== $_POST['action']) {
            return [];
        }

        // Передаем все необходимые параметры в Users\.core\Users\UserLogic::signUp
        $errors = UserLogic::signUp(
            $_POST['email'], $_POST['password1'], $_POST['password2'], $_POST['fio'], $_POST['vk_profile'], $_POST['blood_type'], $_POST['Rh_factor']
        );

        if (empty($errors)) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=y");
            die();
        }

        return $errors;
    }

    public static function signOut(): void
    {
        if ('POST' !== $_SERVER['REQUEST_METHOD']) {
            return;
        }

        if ('signOut' !== $_POST['action']) {
            return;
        }

        UserLogic::signOut();

        header("Location: " . $_SERVER['REQUEST_URI']);
    }
}
