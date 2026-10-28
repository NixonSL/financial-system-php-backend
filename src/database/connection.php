<?php
// Arquivo: connection.php
// Arquivo de conexão PHP com MySQL

class Database {
    private $host = 'localhost';
    private $db_name = 'financial_system';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            echo "Conexão com MySQL estabelecida com sucesso!\n";
        } catch(PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage() . "\n";
        }

        return $this->conn;
    }
}
?>