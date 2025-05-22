<?php

namespace App\Models;
use App\Core\Database;

class SiteContent {
  private $db;

  public function __construct() {
    $this->db = Database::getInstance();
  }

  public function getAllContent() {
    $sql = "SELECT * FROM site_content ORDER BY content_id ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $contents = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $contents;
  }

  public function getContentById($content_id) {
    $sql = "SELECT * FROM site_content WHERE content_id = :content_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['content_id' => $content_id]);
    $content = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $content;
  }

  public function getContentByKey($content_key) {
    $sql = "SELECT * FROM site_content WHERE content_key = :content_key";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['content_key' => $content_key]);
    $content = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $content;
  }

  public function addContent($data) {
    try {
      $sql = "INSERT INTO site_content (content_key, content_title, content_value, is_active, created_at) 
              VALUES (:content_key, :content_title, :content_value, :is_active, NOW())";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute([
        'content_key' => $data['content_key'] ?? '',
        'content_title' => $data['content_title'] ?? '',
        'content_value' => $data['content_value'] ?? '',
        'is_active' => $data['is_active'] ?? 1
      ]);
      
      if ($result) {
        return $this->db->lastInsertId();
      }
      
      return false;
    } catch (\PDOException $e) {
      error_log("Error adding site content: " . $e->getMessage());
      return false;
    }
  }

  public function updateContent($content_id, $data) {
    try {
      // Build the SET part of the SQL query dynamically
      $setFields = [];
      $params = ['content_id' => $content_id];

      foreach ($data as $field => $value) {
        // Ensure only valid fields are updated
        if (in_array($field, ['content_key', 'content_title', 'content_value', 'is_active'])) {
          $setFields[] = "$field = :$field";
          $params[$field] = $value;
        }
      }

      // If no valid fields to update, return false
      if (empty($setFields)) {
        return false;
      }

      $setClause = implode(', ', $setFields);
      $sql = "UPDATE site_content SET $setClause, last_updated = NOW() WHERE content_id = :content_id";
      
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute($params);
      
      return $result;
    } catch (\PDOException $e) {
      error_log("Error updating site content: " . $e->getMessage());
      return false;
    }
  }

  public function deleteContent($content_id) {
    try {
      $sql = "DELETE FROM site_content WHERE content_id = :content_id";
      $stmt = $this->db->prepare($sql);
      $result = $stmt->execute(['content_id' => $content_id]);
      
      return $result;
    } catch (\PDOException $e) {
      error_log("Error deleting site content: " . $e->getMessage());
      return false;
    }
  }
}