<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/LR3/.core/Validator.php');

class UserLogic
{
    public static function signUp(
        string $email, string $password, string $password2, string $fio, string $vk_profile, string $blood_type, string $Rh_factor
    ): array
    {
        // Валидируем все поля
        Validator::emptyErrors();
        Validator::validateEmail($email);
        Validator::validatePassword($password, $password2);
        Validator::validateFio($fio);
        Validator::validateVkProfile($vk_profile);
        Validator::validateBloodType($blood_type);
        Validator::validateRHFactor($Rh_factor);

        $errors = Validator::getErrors();
        if (!empty($errors)) {
            return $errors;
        }

        // Хэшируем пароль
        $password = password_hash($password, PASSWORD_DEFAULT);

        try {
            if (!empty(UserTable::getByEmail($email))) {
                return ['Такой email уже используется'];
            }

            // Создаем нового пользователя с дополнительными полями
            UserTable::create($email, $password, $fio, $vk_profile, $blood_type, $Rh_factor);
        } catch (Exception $e) {
            return [$e->getMessage()];
        }

        return [];
    }

    public static function signIn(
        string $email, string $password
    ): string
    {
        if (static::isAuthorized()) {
            return "Вы уже авторизированны";
        }

        $user = UserTable::getByEmail($email);

        if (!$user) {
            return "Пользователь с таким email не найден";
        }

        if (!password_verify($password, $user['hash_password'])) {
            return "Неверно указан пароль";
        }

        $_SESSION['user_id'] = $user['id'];

        return '';
    }

    public static function signOut(): void
    {
        $_SESSION['user_id'] = null;
    }

    public static function isAuthorized(): bool
    {
        return (int)($_SESSION['user_id'] ?? 0) > 0;
    }

    public static function currentUser(): array
    {
        if (!static::isAuthorized()) {
            return [];
        }

        return UserTable::getById($_SESSION['user_id']);
    }
}
