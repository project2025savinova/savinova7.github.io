<?php
require_once 'config.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['can_search']) {
    exit('Доступ запрещен');
}

$db = getDB();

// Подготовка условий поиска
$conditions = [];
$params = [];

if (!empty($_POST['lastName'])) {
    $conditions[] = "last_name LIKE ?";
    $params[] = '%' . $_POST['lastName'] . '%';
}

if (!empty($_POST['firstName'])) {
    $conditions[] = "first_name LIKE ?";
    $params[] = '%' . $_POST['firstName'] . '%';
}

if (!empty($_POST['department'])) {
    $conditions[] = "department_id = ?";
    $params[] = $_POST['department'];
}

if (!empty($_POST['position'])) {
    $conditions[] = "position LIKE ?";
    $params[] = '%' . $_POST['position'] . '%';
}

if (!empty($_POST['room'])) {
    $conditions[] = "room_number = ?";
    $params[] = $_POST['room'];
}

// Выполнение поиска
$sql = "SELECT e.*, d.name as department_name 
        FROM employees e 
        LEFT JOIN departments d ON e.department_id = d.id 
        WHERE e.is_active = TRUE";

if (!empty($conditions)) {
    $sql .= " AND " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY e.last_name, e.first_name";

$stmt = $db->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($results)) {
    echo '<p>Сотрудники по заданным критериям не найдены.</p>';
} else {
    echo '<h2>Найдено сотрудников: ' . count($results) . '</h2>';
    echo '<table>';
    echo '<tr><th>ФИО</th><th>Отдел</th><th>Должность</th><th>Телефон</th><th>Кабинет</th><th>Email</th></tr>';
    
    foreach ($results as $emp) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($emp['last_name'] . ' ' . $emp['first_name'] . ' ' . $emp['middle_name']) . '</td>';
        echo '<td>' . htmlspecialchars($emp['department_name']) . '</td>';
        echo '<td>' . htmlspecialchars($emp['position']) . '</td>';
        echo '<td>' . htmlspecialchars($emp['phone']) . '</td>';
        echo '<td>' . htmlspecialchars($emp['room_number']) . '</td>';
        echo '<td>' . htmlspecialchars($emp['email']) . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
}
?>