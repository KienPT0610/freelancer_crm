<?php
namespace App\Models;
use App\Core\Database;

class User {
  private $db;
  public function __construct() {
    $this->db = Database::getInstance();
  }

  public function login($email, $password) {
    $pdo = $this->db->getConnection();
    
    // Chỉ truy vấn user theo email/email
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    // echo password_hash('123456', PASSWORD_BCRYPT);
    if ($user && password_verify($password, $user['password_hash'])) {
      // Mật khẩu đúng
      return $user;
    } else {
      // Sai
      return '';
    }
  }
}