<?php
// Arquivo: practice-syntax.php
// Prática de sintaxe básica do PHP

// 1. Variáveis e tipos
$nome = "João Silva";
$idade = 30;
$salario = 5000.50;
$ativo = true;
echo "=== DADOS PESSOAIS ===\n";
echo "Nome: $nome\n";
echo "Idade: $idade\n";
echo "Salário: R$ " . number_format($salario, 2, ',', '.') . "\n";
echo "Ativo: " . ($ativo ? 'Sim' : 'Não') . "\n\n";

// 2. Arrays
$frutas = ['maçã', 'banana', 'laranja'];
$usuario = [
    'nome' => 'Maria',
    'idade' => 25,
    'email' => 'maria@example.com'
];

echo "=== FRUTAS ===\n";
foreach ($frutas as $fruta) {
    echo "- $fruta\n";
}
echo "\n=== DADOS USUÁRIO ===\n";
echo "Nome: " . $usuario['nome'] . "\n";
echo "Email: " . $usuario['email'] . "\n\n";

// 3. Condicionais
$nota = 85;
echo "=== CONDICIONAIS ===\n";
if ($nota >= 90) {
    echo "Conceito A\n";
} elseif ($nota >= 80) {
    echo "Conceito B\n";
} elseif ($nota >= 70) {
    echo "Conceito C\n";
} else {
    echo "Conceito D\n";
}
echo "\n";

// 4. Loops
echo "=== NÚMEROS DE 1 A 5 ===\n";
for ($i = 1; $i <= 5; $i++) {
    echo "$i ";
}
echo "\n\n";

// 5. Funções
function saudacao($nome) {
    return "Olá, $nome!";
}

function calcularDesconto($valor, $percentual = 10) {
    return $valor - ($valor * $percentual / 100);
}

echo "=== FUNÇÕES ===\n";
echo saudacao($nome) . "\n";
echo "Desconto 10%: R$ " . number_format(calcularDesconto(1000), 2, ',', '.') . "\n";
echo "Desconto 20%: R$ " . number_format(calcularDesconto(1000, 20), 2, ',', '.') . "\n\n";

// 6. Arrays avançados
$numeros = [5, 2, 8, 1, 9];
echo "=== ARRAYS ===\n";
echo "Total: " . array_sum($numeros) . "\n";
echo "Média: " . (array_sum($numeros) / count($numeros)) . "\n";
echo "Maior: " . max($numeros) . "\n";
echo "Menor: " . min($numeros) . "\n";
sort($numeros);
echo "Ordenado: " . implode(', ', $numeros) . "\n\n";

echo "=== PRÁTICA CONCLUÍDA ===\n";
?>