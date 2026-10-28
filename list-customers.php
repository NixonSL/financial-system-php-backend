<?php
// Arquivo: list-customers.php
// Lista todos os clientes do banco de dados

require_once 'src/database/connection.php';

$database = new Database();
$db = $database->getConnection();

if ($db) {
    try {
        // Query para listar clientes
        $stmt = $db->query('SELECT * FROM customers ORDER BY name ASC');
        $customers = $stmt->fetchAll();

        echo "=== LISTA DE CLIENTES ===\n\n";
        echo "Total: " . count($customers) . " clientes\n\n";

        foreach ($customers as $customer) {
            echo "ID: " . $customer['id'] . "\n";
            echo "Nome: " . $customer['name'] . "\n";
            echo "Tipo: " . $customer['type'] . "\n";
            echo "CNPJ: " . ($customer['cnpj'] ?? 'N/A') . "\n";
            echo "CPF: " . ($customer['cpf'] ?? 'N/A') . "\n";
            echo "Email: " . ($customer['email'] ?? 'N/A') . "\n";
            echo "Telefone: " . ($customer['phone'] ?? 'N/A') . "\n";
            echo "Cidade: " . ($customer['city'] ?? 'N/A') . "\n";
            echo "Estado: " . ($customer['state'] ?? 'N/A') . "\n";
            echo "----------------------------------------\n";
        }
    } catch(PDOException $e) {
        echo "Erro ao listar clientes: " . $e->getMessage() . "\n";
    }
} else {
    echo "Falha na conexão!\n";
}
?>