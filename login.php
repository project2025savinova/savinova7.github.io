<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Упрощенная проверка для тестирования
    $test_users = [
        'user1' => ['password' => 'password123', 'name' => 'Иванов И.И.', 'can_search' => true],
        'user2' => ['password' => 'password123', 'name' => 'Петров П.П.', 'can_search' => false],
        'admin' => ['password' => 'password123', 'name' => 'Администратор', 'can_search' => true, 'role' => 'admin']
    ];
    
    if (isset($test_users[$username]) && $test_users[$username]['password'] === $password) {
        $_SESSION['user_id'] = $username;
        $_SESSION['username'] = $test_users[$username]['name'];
        $_SESSION['role'] = $test_users[$username]['role'] ?? 'employee';
        $_SESSION['can_search'] = $test_users[$username]['can_search'];
        
        header('Location: index.php');
        exit;
    } else {
        header('Location: index.php?error=invalid');
        exit;
    }
}
?>