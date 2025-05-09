<?php
namespace App\models;
use App\Core\Database;

class Project {
  private $db;
 
  public function __construct() {
    $this->db = Database::getInstance();
  }

  public function getAllProjects() {
    $sql = "SELECT *, projects.status as status, customers.name as customer_name FROM projects LEFT JOIN customers ON projects.customer_id = customers.customer_id ORDER BY projects.created_at DESC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $projects = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $projects;
  }

  public function getProjectById($id) {
    $sql = "SELECT * FROM projects WHERE project_id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
  }

  public function getProjectByCustomerId($customer_id) {
    $sql = "SELECT * FROM projects WHERE customer_id = :customer_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['customer_id' => $customer_id]);
    $project = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $project;
  }
}