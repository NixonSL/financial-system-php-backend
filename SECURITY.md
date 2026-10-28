# Análise de Segurança - Backend PHP

## 🔍 Vulnerabilidades Encontradas

### ✅ SQL Injection: NÃO VULNERÁVEL

**Status:** **SEGURO**

Todos os arquivos usam prepared statements corretamente:
- `insert-customer.php` ✅
- `update-customer.php` ✅
- `delete-customer.php` ✅

**Exemplo de código seguro:**
```php
$stmt = $db->prepare('INSERT INTO customers (name, email) VALUES (?, ?)');
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $email);
$stmt->execute();
```

---

### ⚠️ IDOR (Insecure Direct Object Reference): NÃO APLICÁVEL

**Status:** **NÃO APLICÁVEL (scripts de linha de comando)**

**Análise:**
- IDs estão hardcoded no código
- Não há autenticação/autorização
- Não é uma API web

**Quando seria IDOR:**
- Se fosse uma API REST recebendo `id` via parâmetro
- Se não verificasse permissão do usuário
- Exemplo: `DELETE /api/customers/123` sem verificar ownership

---

## 🔐 Melhorias de Segurança Recomendadas

### 1. Validação de Dados de Entrada

**Problema:** Não há validação dos dados antes de inserir/atualizar.

**Solução:** Adicionar validação de CPF/CNPJ, email, telefone.

```php
function validarCPF($cpf) {
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    // Verifica se tem 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }
    
    // Verifica se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    
    // Validação do dígito verificador
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    
    return true;
}

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validarTelefone($phone) {
    // Valida formato brasileiro (11 ou 10 dígitos)
    $phone = preg_replace('/[^0-9]/', '', $phone);
    return strlen($phone) == 11 || strlen($phone) == 10;
}
```

**Uso:**
```php
if (!validarCPF($cpf)) {
    echo "CPF inválido!\n";
    exit;
}

if (!validarEmail($email)) {
    echo "Email inválido!\n";
    exit;
}
```

---

### 2. Autenticação e Autorização

**Problema:** Não há sistema de autenticação.

**Solução:** Implementar JWT ou sessão para proteger endpoints.

```php
// Exemplo básico de verificação de token
function verificarToken($token) {
    // Validar token JWT ou verificar sessão
    // Retornar true se válido, false caso contrário
    return true;
}

// Verificar permissão de acesso
function verificarPermissao($user_id, $customer_id) {
    // Verificar se o usuário é dono do cliente
    // ou se tem permissão de admin
    return true;
}
```

---

### 3. Prevenção de IDOR em APIs

**Problema:** Se transformar em API, será vulnerável a IDOR.

**Solução:** Verificar ownership antes de operações.

```php
// Exemplo seguro para API
function atualizarCliente($user_id, $customer_id, $data) {
    // Verificar se o usuário tem permissão
    if (!verificarPermissao($user_id, $customer_id)) {
        throw new Exception("Sem permissão para acessar este cliente");
    }
    
    // Executar update
    $stmt = $db->prepare('UPDATE customers SET phone = ?, email = ? WHERE id = ?');
    $stmt->bindParam(1, $data['phone']);
    $stmt->bindParam(2, $data['email']);
    $stmt->bindParam(3, $customer_id);
    $stmt->execute();
}
```

---

### 4. Sanitização de Dados

**Problema:** Dados não são sanitizados antes de inserir.

**Solução:** Usar `htmlspecialchars` para XSS e `filter_var` para sanitização.

```php
function sanitizarDado($dado) {
    return htmlspecialchars(strip_tags(trim($dado)), ENT_QUOTES, 'UTF-8');
}

// Uso
$name = sanitizarDado($_POST['name']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
```

---

### 5. Rate Limiting

**Problema:** Não há proteção contra abuso (ex: muitas tentativas de inserção).

**Solução:** Implementar rate limiting.

```php
function verificarRateLimit($ip, $max_requests = 100, $timeframe = 3600) {
    // Implementar rate limiting baseado em IP
    // Usar Redis ou arquivo para armazenar contagem
    return true;
}
```

---

### 6. Logging de Ações

**Problema:** Não há logs de ações sensíveis.

**Solução:** Adicionar logging de delete/update.

```php
function logAcao($acao, $usuario, $dados) {
    $log = sprintf(
        "[%s] %s - %s: %s\n",
        date('Y-m-d H:i:s'),
        $usuario,
        $acao,
        json_encode($dados)
    );
    file_put_contents('logs/acoes.log', $log, FILE_APPEND);
}

// Uso
logAcao('DELETE_CUSTOMER', 'admin', ['customer_id' => $id]);
```

---

### 7. Validação de Estado (Soft Delete)

**Problema:** Delete permanente pode causar problemas.

**Solução:** Implementar soft delete (marcar como deletado em vez de remover).

```php
// Soft delete
$stmt = $db->prepare('UPDATE customers SET deleted_at = NOW() WHERE id = ?');
$stmt->bindParam(1, $id);
$stmt->execute();

// Queries futuras filtram deleted_at IS NULL
```

---

### 8. Verificação de Duplicatas

**Problema:** Pode inserir CNPJ/CPF duplicados.

**Solução:** Verificar antes de inserir.

```php
function verificarDuplicidade($cnpj, $cpf) {
    $stmt = $db->prepare('SELECT COUNT(*) FROM customers WHERE cnpj = ? OR cpf = ?');
    $stmt->bindParam(1, $cnpj);
    $stmt->bindParam(2, $cpf);
    $stmt->execute();
    $result = $stmt->fetch();
    
    return $result['COUNT(*)'] > 0;
}

// Uso
if (verificarDuplicidade($cnpj, $cpf)) {
    echo "Cliente já existe!\n";
    exit;
}
```

---

## 📊 Resumo

| Vulnerabilidade | Status | Severidade | Prioridade |
|----------------|--------|------------|------------|
| SQL Injection | ✅ SEGURO | - | - |
| IDOR | ⚠️ N/A | - | - |
| Validação de Dados | ❌ FALTANDO | Média | Alta |
| Autenticação | ❌ FALTANDO | Alta | Alta |
| Sanitização | ❌ FALTANDO | Média | Média |
| Rate Limiting | ❌ FALTANDO | Baixa | Baixa |
| Logging | ❌ FALTANDO | Baixa | Média |
| Soft Delete | ❌ FALTANDO | Baixa | Baixa |

---

## 🎯 Próximos Passos (Ordem de Prioridade)

1. **Alta Prioridade**
   - Implementar validação de CPF/CNPJ
   - Implementar verificação de duplicatas
   - Adicionar sanitização de dados

2. **Média Prioridade**
   - Implementar logging de ações
   - Implementar soft delete
   - Adicionar rate limiting

3. **Baixa Prioridade**
   - Implementar autenticação/autorização (quando virar API)
   - Implementar prevenção de IDOR (quando virar API)

---

## 💡 Conclusão

**Status Atual:** **Código está seguro contra SQL injection**

**Observação:** Como são scripts de linha de comando com IDs hardcoded, não há vulnerabilidades críticas de IDOR. Porém, ao transformar em API REST, será necessário implementar:
- Autenticação
- Autorização
- Verificação de ownership
- Validação de entrada

**Para a entrevista:** Você pode mencionar que:
- ✅ Usou prepared statements para prevenir SQL injection
- ✅ Conhece o conceito de IDOR e como prevenir
- ✅ Sabe implementar validação de dados
- ✅ Sobre autenticação e autorização

---

**Gerado como parte da análise de segurança do projeto VISAGIO**
