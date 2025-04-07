<?php
$host = '127.0.0.1';
$dbname = 'nebo_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем список организаторов для фильтрации
    $hostStmt = $conn->query('SELECT id, fio_host FROM wedding_host');
    $weddingHosts = $hostStmt->fetchAll(PDO::FETCH_ASSOC);


    $min_max_budget = $conn->query("SELECT min(budget), max(budget) FROM wedding")->fetch(PDO::FETCH_ASSOC);

    $min_budget = $min_max_budget['min(budget)'];

    $max_budget = $min_max_budget['max(budget)'];

    $whereConditions = [];
    $params = [];

    // Фильтрация по имени невесты
    if (!empty($_GET['fio_bride'])) {
        $whereConditions[] = 'wedding.fio_bride LIKE :fio_bride';
        $params[':fio_bride'] = '%' . $_GET['fio_bride'] . '%';
    }

    // Фильтрация по имени жениха
    if (!empty($_GET['fio_groom'])) {
        $whereConditions[] = 'wedding.fio_groom LIKE :fio_groom';
        $params[':fio_groom'] = '%' . $_GET['fio_groom'] . '%';
    }

    // Фильтрация по бюджету (диапазон)
    if (!empty($_GET['min_budget'])) {
        $whereConditions[] = 'wedding.budget >= :min_budget';
        $params[':min_budget'] = $_GET['min_budget'];
    }

    if (!empty($_GET['max_budget'])) {
        $whereConditions[] = 'wedding.budget <= :max_budget';
        $params[':max_budget'] = $_GET['max_budget'];
    }

    // Фильтрация по организатору
    if (!empty($_GET['host_id'])) {
        $whereConditions[] = 'wedding.id_host = :host_id';
        $params[':host_id'] = $_GET['host_id'];
    }

    // Формируем запрос для получения данных с фильтрацией
    $query = 'SELECT wedding.id, wedding.fio_bride, wedding.fio_groom, wedding.text_invitation, wedding.photo_couple, wedding.budget, wedding_host.fio_host FROM wedding INNER JOIN wedding_host ON wedding.id_host = wedding_host.id' . (!empty($whereConditions) ? ' WHERE ' . implode(' AND ', $whereConditions) : '');

    $stmt = $conn->prepare($query);
    $stmt->execute($params);

    $weddingItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}