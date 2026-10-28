<?php
// Arquivo: test-connection.php
// Testa a conexão com MySQL

require_once 'src/database/connection.php';

$database = new Database();
$db = $database->getConnection();

if ($db) {
    echo "Teste de conexão bem-sucedido!\n";
    
    // Testar uma query simples
    try {
        $stmt = $db->query('SELECT COUNT(*) as total FROM customers');
        $result = $stmt->fetch();
        echo "Total de clientes no banco: " . $result['total'] . "\n";
    } catch(PDOException $e) {
        echo "Erro na query: " . $e->getMessage() . "\n";
    }
} else {
    echo "Falha na conexão!\n";
}
?>