<?php
require_once 'config/database.php';
require_once 'includes/auth.php';
require_once 'includes/functions.php';

session_start();

// Маршрутизация
$page = $_GET['page'] ?? 'home';

// Подключение соответствующей страницы
$allowedPages = ['home', 'departments', 'search', 'login', 'profile'];
if (in_array($page, $allowedPages)) {
    require_once "pages/{$page}.php";
} else {
    require_once "pages/home.php";
}
?>