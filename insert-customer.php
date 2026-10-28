<?php
// Arquivo: insert-customer.php
// Insere um novo cliente no banco de dados usando prepared statement

require_once 'src/database/connection.php';

$database = new Database();
$db = $database->getConnection();

if ($db) {
    try {
        // Dados do novo cliente
        $name = 'Empresa Exemplo PHP';
        $type = 'pessoa_juridica';
        $cnpj = '99988877000155';
        $email = 'exemplo@php.com';
        $phone = '11955554444';
        $address = 'Rua PHP, 123';
        $city = 'Rio de Janeiro';
        $state = 'RJ';
        $zip_code = '20040-002';

        // Prepared statement (seguro contra SQL injection)
        $stmt = $db->prepare('
            INSERT INTO customers (name, type, cnpj, email, phone, address, city, state, zip_code)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ');

        // Bind dos parâmetros
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $type);
        $stmt->bindParam(3, $cnpj);
        $stmt->bindParam(4, $email);
        $stmt->bindParam(5, $phone);
        $stmt->bindParam(6, $address);
        $stmt->bindParam(7, $city);
        $stmt->bindParam(8, $state);
        $stmt->bindParam(9, $zip_code);

        // Executar
        if ($stmt->execute()) {
            echo "Cliente inserido com sucesso!\n";
            echo "ID do novo cliente: " . $db->lastInsertId() . "\n";
        } else {
            echo "Erro ao inserir cliente\n";
        }
    } catch(PDOException $e) {
        echo "Erro: " . $e->getMessage() . "\n";
    }
} else {
    echo "Falha na conexão!\n";
}
?>