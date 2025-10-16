<?php
// Конфигурация базы данных
define('DB_HOST', 'localhost');
define('DB_NAME', 'phone_directory');
define('DB_USER', 'root');
define('DB_PASS', '');

// Подключение к базе данных
function getDB() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        die("Ошибка подключения к базе данных: " . $e->getMessage());
    }
}

// Старт сессии
session_start();
?>