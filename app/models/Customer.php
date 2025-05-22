<?php

namespace App\Models;
use App\Core\Database;
class Customer {
   private $db;
   public function __construct() {
      $this->db = Database::getInstance();
   }

   public function getAllCustomers() {
      $sql = "SELECT * FROM customers";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      $customers = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $customers;
   }

   public function getCustomerById($id) {
      $sql = "SELECT * FROM customers WHERE customer_id = :id";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(['id' => $id]);
      return $stmt->fetch(\PDO::FETCH_ASSOC);
   }

   public function updateCustomer($id, $data) {
    // Make sure there's data to update
    if (empty($data)) {
        return false;
    }
    
    $pdo = $this->db->getConnection();
  
    // Tạo câu SET kiểu: name = :name, email = :email
    $setPart = implode(", ", array_map(function($key) {
      return "$key = :$key";
    }, array_keys($data)));
    
    // Ensure we have something in the SET clause
    if (empty($setPart)) {
        return false;
    }
  
    $sql = "UPDATE customers SET $setPart WHERE customer_id = :id";
    $stmt = $pdo->prepare($sql);
  
    // Thêm id vào mảng dữ liệu
    $data['id'] = $id;
    
    $result = $stmt->execute($data);
    return $result;
  }

   public function deleteCustomer($id) {
      $sql = "DELETE FROM customers WHERE customer_id = :id";
      $stmt = $this->db->prepare($sql);
      return $stmt->execute(['id' => $id]);
   }

   public function addCustomer($data) {
      $sql = "INSERT INTO customers (name, email, phone, company, birthday, status, created_at) 
              VALUES (:name, :email, :phone, :company, :birthday, :status, NOW())";
      $stmt = $this->db->prepare($sql);
      return $stmt->execute([
          'name' => $data['name'],
          'email' => $data['email'],
          'phone' => $data['phone'],
          'company' => $data['company'],
          'birthday' => $data['birthday'],
          'status' => $data['status'] ?? 'active'
      ]);
   }


}