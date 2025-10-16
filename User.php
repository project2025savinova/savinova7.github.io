<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function login($username, $password) {
        $user = $this->db->fetchOne(
            "SELECT * FROM users WHERE username = ?", 
            [$username]
        );
        
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        
        return false;
    }
    
    public function updateLastLogin($userId) {
        // Обновление времени последнего входа
    }
}
?>