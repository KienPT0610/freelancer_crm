<?php

namespace App\Models;
use App\Core\Database;
class Contact {
  private $db;

  public function __construct() {
    $this->db = Database::getInstance();
  }
  public function getContactById($id) {
    $sql = "SELECT * FROM contact_submissions WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function getAllContacts() {
    $sql = "SELECT * FROM contact_submissions ORDER BY is_read ASC, submission_date DESC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $contacts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $contacts;
  }

  public function createContact($data) {
    try {
      $sql = "INSERT INTO contact_submissions (name, email, phone, message) VALUES (:name, :email, :phone, :message)";
      $stmt = $this->db->prepare($sql);
      
      // Bind parameters explicitly
      $params = [
        ':name' => $data['name'],
        ':email' => $data['email'],
        ':phone' => $data['phone'] ?? null,
        ':message' => $data['message']
      ];
      
      $stmt->execute($params);
      return $this->db->lastInsertId();
    } catch (\PDOException $e) {
      // Log error
      error_log('Database error: ' . $e->getMessage());
      return false;
    }
  }
  
}