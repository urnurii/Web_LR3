<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/LR3/.core/index.php');

UserActions::requireAuth($_SERVER['SCRIPT_NAME']);

// Получаем данные для фильтров и списка организаторов
WeddingActions::clearFilters();
$weddingItems = WeddingActions::getWeddingItemsTable();
$hostsOptions = WeddingActions::getHostsOptions();
$minMaxBudget = WeddingActions::getBudgetRange();
$minBudget = $minMaxBudget['min_budget'];
$maxBudget = $minMaxBudget['max_budget'];

require_once($_SERVER['DOCUMENT_ROOT'] . "/LR3/templates/header.php");
?>

<div class="container-fluid" style="width: 1200px">
    <form id="filter" class="text-center align-items-center justify-content-center mb-3">
        <label class="fs-5 mt-3 mb-3">Фильтрация</label>

        <!-- Фильтр по ФИО невесты -->
        <div class="mb-3">
            <label for="fio_bride" class="form-label">ФИО невесты:</label>
            <input type="text" id="fio_bride" name="fio_bride" placeholder="Александрова Александра Александровна" class="form-control me-2"
                   value="<?php echo isset($_GET['fio_bride']) ? htmlspecialchars($_GET['fio_bride']) : ''; ?>">
        </div>

        <!-- Фильтр по ФИО жениха -->
        <div class="mb-3">
            <label for="fio_groom" class="form-label">ФИО жениха:</label>
            <input type="text" id="fio_groom" name="fio_groom" placeholder="Иванов Иван Иванович" class="form-control me-2"
                   value="<?php echo isset($_GET['fio_groom']) ? htmlspecialchars($_GET['fio_groom']) : ''; ?>">
        </div>

        <!-- Фильтр по бюджету -->
        <div class="row">
            <div class="col">
                <label for="min_budget" class="form-label">Минимальный бюджет</label>
                <input type="number" name="min_budget" id="min_budget" class="form-control" placeholder="Минимальный бюджет" value="<?= isset($_GET['min_budget']) ? htmlspecialchars($_GET['min_budget']) : '' ?>" min="<?= $minBudget ?>">
            </div>
            <div class="col">
                <label for="max_budget" class="form-label">Максимальный бюджет</label>
                <input type="number" name="max_budget" id="max_budget" class="form-control" placeholder="Максимальный бюджет" value="<?= isset($_GET['max_budget']) ? htmlspecialchars($_GET['max_budget']) : '' ?>" max="<?= $maxBudget ?>" min="<?= $minBudget ?>">
            </div>
        </div>

        <!-- Фильтр по организатору -->
        <div class="mb-3">
            <label for="host_id">ФИО организатора:</label>
            <select name="host_id" class="form-control" id="host_id">
                <option value=""
                    <?php echo (!(isset($_GET['host_id'])) || $_GET['host_id'] === '') ? 'selected' : ''; ?>>
                    Все организаторы
                </option>
                <?php echo $hostsOptions; ?>
            </select>
        </div>

        <input type="submit" value="Применить фильтр" class="btn btn-primary me-2 mb-3">
        <a href="wedding.php#filter" class="btn btn-danger mb-3">Очистить фильтр</a>
    </form>

    <!-- Таблица с результатами -->
    <table class="table table-bordered">
        <thead>
        <tr class="table-light">
            <th scope="col" class="fw-medium">Фото пары</th>
            <th scope="col" class="fw-medium">Невеста</th>
            <th scope="col" class="fw-medium">Жених</th>
            <th scope="col" class="fw-medium">Текст приглашения</th>
            <th scope="col" class="fw-medium">Бюджет</th>
            <th scope="col" class="fw-medium">Организатор</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($weddingItems)): ?>
            <?php foreach ($weddingItems as $row): ?>
                <tr>
                    <th scope="row">
                        <img src="/LR3/photo_couple/<?php echo htmlspecialchars($row['photo_couple']); ?>.jpg" style="max-width: 200px;" alt="фото пары">
                    </th>
                    <td class="fw-light"><?php echo htmlspecialchars($row['fio_bride']); ?></td>
                    <td class="fw-light"><?php echo htmlspecialchars($row['fio_groom']); ?></td>
                    <td class="fw-light"><?php echo htmlspecialchars($row['text_invitation']); ?></td>
                    <td class="fw-light"><?php echo htmlspecialchars($row['budget']); ?></td>
                    <td class="fw-light"><?php echo htmlspecialchars($row['fio_host']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Нет данных</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    const minBudgetInput = document.getElementById('min_budget');
    const maxBudgetInput = document.getElementById('max_budget');

    // Обновление максимального значения для поля min_budget
    maxBudgetInput.addEventListener('input', function () {
        const max = parseInt(this.value);
        if (!isNaN(max)) {
            minBudgetInput.max = max;
            if (parseInt(minBudgetInput.value) > max) {
                minBudgetInput.value = max;
            }
        }
    });

    // Обновление минимального значения для поля max_budget
    minBudgetInput.addEventListener('input', function () {
        const min = parseInt(this.value);
        if (!isNaN(min)) {
            maxBudgetInput.min = min;
            if (parseInt(maxBudgetInput.value) < min) {
                maxBudgetInput.value = min;
            }
        }
    });
</script>

<script>
    document.getElementById("filter").addEventListener("submit", function(event) {
        let form = event.target;
        let submitter = event.submitter; // Узнаем, какая кнопка отправила форму

        // Если нажата кнопка очистки фильтров — не изменяем параметры
        if (submitter && submitter.name === "clearFilter") {
            return;
        }

        event.preventDefault(); // Останавливаем стандартную отправку формы

        let formData = new FormData(form);
        let params = new URLSearchParams();

        // Убираем пустые поля из запроса
        for (let [key, value] of formData.entries()) {
            if (value.trim() !== "") {
                params.append(key, value);
            }
        }

        // Перенаправляем на тот же URL, но без пустых параметров
        let actionUrl = form.getAttribute("action") || window.location.pathname;
        if (params.toString()) {
            window.location.href = actionUrl + "?" + params.toString();
        } else {
            window.location.href = actionUrl
        }
    });
</script>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/LR3/templates/footer.php");
?>
