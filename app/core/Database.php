<?php
namespace App\Core;
require_once __DIR__ . '/../config/config.php';
class Database {
    private static ?Database $instance = null;
    private \PDO $pdo;
    private bool $connected = false;
    private string $error = '';
    
    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->pdo = new \PDO($dsn, DB_USER, DB_PASS, $options);
            $this->connected = true;
            
            // if (DEBUG_MODE) {
            //     echo "<div style='padding: 10px; background-color: #dff0d8; border: 1px solid #d6e9c6; color: #3c763d; border-radius: 4px;'>";
            //     echo "Connected successfully to the database (Host: " . DB_HOST . ":" . DB_PORT . ", Database: " . DB_NAME . ")";
            //     echo "</div>";
            // }
            
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            
            if (DEBUG_MODE) {
                echo "<div style='padding: 10px; background-color: #f2dede; border: 1px solid #ebccd1; color: #a94442; border-radius: 4px;'>";
                echo "Database connection failed: " . $this->error;
                echo "</div>";
            }
        }
    }
    
    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function isConnected(): bool {
        return $this->connected;
    }
    
    public function getError(): string {
        return $this->error;
    }
    
    public function getConnection(): ?\PDO {
        return $this->connected ? $this->pdo : null;
    }
    
    public function query(string $sql): \PDOStatement {
        return $this->pdo->query($sql);
    }
    
    public function prepare(string $sql): \PDOStatement {
        return $this->pdo->prepare($sql);
    }
    
    public function execute(\PDOStatement $stmt, array $params = []): bool {
        return $stmt->execute($params);
    }
    
    public function fetch(\PDOStatement $stmt, array $params = []) {
        if (!empty($params)) {
            $stmt->execute($params);
        }
        return $stmt->fetch();
    }
    
    public function fetchAll(\PDOStatement $stmt, array $params = []): array {
        if (!empty($params)) {
            $stmt->execute($params);
        }
        return $stmt->fetchAll();
    }
    
    public function lastInsertId(): string {
        return $this->pdo->lastInsertId();
    }
    
    public function beginTransaction(): bool {
        return $this->pdo->beginTransaction();
    }
    
    public function commit(): bool {
        return $this->pdo->commit();
    }
    
    public function rollback(): bool {
        return $this->pdo->rollBack();
    }
    
    // Prevents cloning of the instance
    private function __clone() {}
    
    // Prevents unserialization of the instance
    public function __wakeup() {
        throw new \Exception("Cannot unserialize singleton");
    }
}