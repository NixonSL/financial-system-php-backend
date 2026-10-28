<?php
// Arquivo: update-customer.php
// Atualiza um cliente existente

require_once '../database/connection.php';

$database = new Database();
$db = $database->getConnection();

if ($db) {
    try {
        // Dados para atualizar
        $id = 6; // ID do cliente que acabamos de inserir
        $new_phone = '11966665555';
        $new_email = 'novoemail@php.com';

        // Prepared statement para atualizar
        $stmt = $db->prepare('
            UPDATE customers 
            SET phone = ?, email = ? 
            WHERE id = ?
        ');

        $stmt->bindParam(1, $new_phone);
        $stmt->bindParam(2, $new_email);
        $stmt->bindParam(3, $id);

        if ($stmt->execute()) {
            echo "Cliente atualizado com sucesso!\n";
            echo "Linhas afetadas: " . $stmt->rowCount() . "\n";
        } else {
            echo "Erro ao atualizar cliente\n";
        }
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage() . "\n";
    }
} else {
    echo "Falha na conexão!\n";
}
?>