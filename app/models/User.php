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

  // chanage  password
  public function changePassword($userId, $newPassword) {
    $pdo = $this->db->getConnection();
    
    // Mã hóa mật khẩu mới
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    
    // Cập nhật mật khẩu trong cơ sở dữ liệu
    $sql = "UPDATE users SET password_hash = :password WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(['password' => $hashedPassword, 'id' => $userId]);
  }

  public function getUserById($userId) {
    // check connected admin
    if (!isset($_SESSION['user_id'])) {
      return false;
    }
    
    $pdo = $this->db->getConnection();
    
    // Truy vấn thông tin người dùng theo ID
    $sql = "SELECT * FROM users WHERE user_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetch();
  }
}