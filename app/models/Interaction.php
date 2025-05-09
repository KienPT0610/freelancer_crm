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
}