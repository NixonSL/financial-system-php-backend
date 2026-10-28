<?php
// Arquivo: delete-customer.php
// Deleta um cliente existente

require_once '../database/connection.php';

$database = new Database();
$db = $database->getConnection();

if ($db) {
    try {
        // ID do cliente para deletar
        $id = 6;

        // Prepared statement para deletar
        $stmt = $db->prepare('DELETE FROM customers WHERE id = ?');
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            echo "Cliente deletado com sucesso!\n";
            echo "Linhas afetadas: " . $stmt->rowCount() . "\n";
        } else {
            echo "Erro ao deletar cliente\n";
        }
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage() . "\n";
    }
} else {
    echo "Falha na conexão!\n";
}
?>