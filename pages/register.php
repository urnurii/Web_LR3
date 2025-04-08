<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/LR3/.core/index.php");

$errors = UserActions::signUp();
$from = $_GET['from'] ?? 'wedding.php'; // Если параметр "from" не передан, переходим на wedding.php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/LR3/templates/header.php");
?>

<main class="container-fluid py-3">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <h1 class="text-center pb-3">Регистрация</h1>
            <form class="border border-black rounded-5 py-5 px-5" method="post">
                <!-- Вывод ошибок -->
                <?php
                if (!empty($errors)) {
                    echo "<div class='mb-3 text-danger'>";
                    foreach ($errors as $error) {
                        echo $error . "<br>";
                    }
                    echo "</div>";
                }
                ?>

                <!-- Поле для ввода email -->
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                           value="<?= htmlspecialchars($_POST['email'] ?? $_GET['email'] ?? '') ?>" maxlength="255" required>
                </div>

                <!-- Поле для ввода пароля -->
                <div class="mb-3 position-relative">
                    <label for="exampleInputPassword1" class="form-label">Пароль</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password1" maxlength="255" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            👁️
                        </button>
                    </div>
                </div>

                <!-- Повторный пароль -->
                <div class="mb-3 position-relative">
                    <label for="exampleInputPassword2" class="form-label">Пароль еще раз</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="exampleInputPassword2" name="password2" maxlength="255" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword1">
                            👁️
                        </button>
                    </div>
                </div>

                <!-- Поле для ввода ФИО -->
                <div class="mb-3">
                    <label>ФИО</label>
                    <input type="text" class="form-control" name="fio"
                           value="<?= htmlspecialchars($_POST['fio'] ?? '') ?>" placeholder="Иванов Иван Иванович" maxlength="255" required>
                </div>

                <!-- Поле для ввода ссылки на профиль ВК -->
                <div class="mb-3">
                    <label>Профиль ВК</label>
                    <input type="url" class="form-control" name="vk_profile"
                           value="<?= htmlspecialchars($_POST['vk_profile'] ?? '') ?>" placeholder="https://vk.com/username" maxlength="255" required>
                </div>

                <!-- Поле для выбора группы крови -->
                <div class="mb-3">
                    <select class="form-select" aria-label="Группа крови" name="blood_type" required>
                        <option value="">Группа крови</option>
                        <?php
                        $blood_types = ['1' => 'I', '2' => 'II', '3' => 'III', '4' => 'IV'];
                        foreach ($blood_types as $type => $name) {
                            $selected = (isset($_POST['blood_type']) && $_POST['blood_type'] == $type) ? 'selected' : '';
                            echo "<option value={$type} " . $selected . ">{$name}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Поле для выбора резус-фактора -->
                <div class="mb-3">
                    <select class="form-select" aria-label="Резус-фактор" name="Rh_factor" required>
                        <option value="">Резус-фактор</option>
                        <?php
                        $rh_factors = ['+' => '+', '-' => '-'];
                        foreach ($rh_factors as $rh_factor => $name) {
                            $selected = (isset($_POST['Rh_factor']) && $_POST['Rh_factor'] === $rh_factor) ? 'selected' : '';
                            echo "<option value={$rh_factor} " . $selected . ">{$name}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" name="action" value="signUp" class="btn btn-primary">Зарегистрироваться</button>
                    <div class="d-flex align-items-center">
                        <label class="me-2">Уже зарегистрированы?</label>
                        <a id="loginBtn" href="login.php?from=<?= htmlspecialchars($from) ?>" class="link-dark link-opacity-75-hover link-underline-opacity-75-hover">Войти</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    document.getElementById("loginBtn").addEventListener("click", function (event) {
        event.preventDefault();
        window.location.href = "login.php?from=" + encodeURIComponent("<?= htmlspecialchars($from) ?>");
    });

    document.getElementById("togglePassword").addEventListener("click", function () {
        let passwordField = document.getElementById("exampleInputPassword1");
        passwordField.type = passwordField.type === "password" ? "text" : "password";
    });

    document.getElementById("togglePassword1").addEventListener("click", function () {
        let passwordField = document.getElementById("exampleInputPassword2");
        passwordField.type = passwordField.type === "password" ? "text" : "password";
    });
</script>

<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/LR3/templates/footer.php");
?>
