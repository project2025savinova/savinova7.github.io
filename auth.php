<?php
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function hasSearchPermission() {
    return isset($_SESSION['can_search']) && $_SESSION['can_search'];
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function requireAuth() {
    if (!isLoggedIn()) {
        header('Location: /login.php');
        exit;
    }
}
?>