<?php

namespace App\Models;
use App\Core\Database;
class Interaction {
  private $db;

  public function __construct() {
    $this->db = Database::getInstance();
  }

  public function getAllInteractions() {
    $sql = "SELECT *, customers.name as customer_name FROM interactions LEFT JOIN customers ON interactions.customer_id = customers.customer_id ORDER BY interactions.created_at DESC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $interactions = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $interactions;
  }
    public function getInteractionByCustomerId($customer_id) {
    $sql = "SELECT * FROM interactions WHERE customer_id = :customer_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['customer_id' => $customer_id]);
    $interaction = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $interaction;
  }
  
  public function getInteractionById($interaction_id) {
    $sql = "SELECT * FROM interactions WHERE interaction_id = :interaction_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['interaction_id' => $interaction_id]);
    $interaction = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $interaction;
  }

  # thêm tương tác mới
  public function addInteraction($customer_id, $interaction_type, $interaction_date, $summary) {
    $created_by = $_SESSION['user']['user_id'] ?? 1;
    $sql = "INSERT INTO interactions (customer_id, interaction_type, interaction_date, summary, created_by, created_at) VALUES (:customer_id, :interaction_type, :interaction_date, :summary, :created_by, NOW())";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([
      'customer_id' => $customer_id,
      'interaction_type' => $interaction_type,
      'interaction_date' => $interaction_date,
      'summary' => $summary,
      'created_by' => $created_by
    ]);
    return $this->db->lastInsertId();
  }

  # xóa tương tác
  public function deleteInteraction($interaction_id) {
    $sql = "DELETE FROM interactions WHERE interaction_id = :interaction_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['interaction_id' => $interaction_id]);
    return $stmt->rowCount();
  }

  # cập nhật tương tác
  public function updateInteraction($interaction_id, $data) {
    try {
      if (empty($data)) {
        return false;
      }
      // Build the SET part of the SQL query dynamically
      $setPart = implode(", ", array_map(function($key) {
        return "$key = :$key";
      }, array_keys($data)));

      $sql = "UPDATE interactions SET $setPart, created_at = NOW() WHERE interaction_id = :interaction_id";
      $stmt = $this->db->prepare($sql);
      $data['interaction_id'] = $interaction_id;
      $result = $stmt->execute($data);

      return $result;
    } catch (\PDOException $e) {
      // Log the error or handle it as needed
      error_log("Error updating interaction: " . $e->getMessage());
      return false;
    }
  }
}