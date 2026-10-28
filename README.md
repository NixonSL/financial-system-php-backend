# Sistema Financeiro - Backend PHP

Sistema de gerenciamento financeiro com emissão de notas fiscais (NF) desenvolvido como portfólio para vaga de Desenvolvedor Fullstack Junior.

## 🎯 Funcionalidades

- ✅ Conexão com MySQL usando PDO
- ✅ CRUD completo de clientes (Create, Read, Update, Delete)
- ✅ Prepared statements (segurança contra SQL injection)
- ✅ Validação de dados
- ✅ Transações MySQL
- ✅ Estrutura MVC organizada

## 🛠️ Tecnologias

- **PHP 8.0+** - Linguagem de backend
- **MySQL 8.0** - Banco de dados relacional
- **PDO (PHP Data Objects)** - Abstração de banco de dados
- **XAMPP** - Ambiente de desenvolvimento

## 📁 Estrutura do Projeto

```
backend-php/
├── src/
│   ├── controllers/         # Controladores (lógica de negócio)
│   │   ├── test-connection.php
│   │   ├── list-customers.php
│   │   ├── insert-customer.php
│   │   ├── update-customer.php
│   │   ├── delete-customer.php
│   │   └── practice-syntax.php
│   ├── models/             # Modelos (estrutura de dados)
│   ├── services/            # Serviços (lógica de serviço)
│   └── database/
│       └── connection.php  # Classe de conexão com MySQL
├── README.md               # Este arquivo
└── .gitignore              # Arquivos ignorados pelo Git
```

## 🚀 Como Executar

### Pré-requisitos
- XAMPP instalado (MySQL + PHP)
- Banco de dados `financial_system` criado no MySQL
- Terminal (PowerShell ou Command Prompt)

### Passo 1: Iniciar o MySQL no XAMPP
1. Abra o XAMPP Control Panel
2. Clique em **Start** ao lado de **MySQL**
3. Aguarde ficar verde (Running)

### Passo 2: Navegar até o diretório do projeto
```bash
cd C:\Users\mn-ca\Projects\revisao-visagio\projects\financial-system\backend-php
```

### Passo 3: Executar os arquivos PHP
```bash
# Testar conexão com MySQL
C:\xampp\php\php.exe src/controllers/test-connection.php

# Listar todos os clientes
C:\xampp\php\php.exe src/controllers/list-customers.php

# Inserir novo cliente
C:\xampp\php\php.exe src/controllers/insert-customer.php

# Atualizar cliente existente
C:\xampp\php\php.exe src/controllers/update-customer.php

# Deletar cliente
C:\xampp\php\php.exe src/controllers/delete-customer.php

# Praticar sintaxe PHP
C:\xampp\php\php.exe src/controllers/practice-syntax.php
```

## 📊 Banco de Dados

### Tabelas

- **customers** - Clientes (pessoa física e jurídica)
- **products** - Produtos e serviços
- **invoices** - Notas fiscais
- **invoice_items** - Itens das notas fiscais
- **users** - Usuários do sistema
- **invoice_logs** - Logs de emissão de NF

### Configuração de Conexão

```php
$host = 'localhost';
$port = 3306;
$database = 'financial_system';
$username = 'root';
$password = ''; // Senha vazia no XAMPP
```

## 🔐 Segurança

### Prepared Statements
Todos os comandos SQL usam prepared statements para prevenir SQL injection:

```php
$stmt = $db->prepare('INSERT INTO customers (name, email) VALUES (?, ?)');
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $email);
$stmt->execute();
```

### Validação de Dados
- Validação de tipos no banco de dados
- Validação de CPF/CNPJ (a ser implementado)
- Validação de email e telefone

## 📝 Exemplos de Uso

### 1. Testar Conexão
```bash
C:\xampp\php\php.exe src/controllers/test-connection.php
```
**Saída esperada:**
```
Conexão com MySQL estabelecida com sucesso!
Teste de conexão bem-sucedido!
Total de clientes no banco: 5
```

### 2. Listar Clientes
```bash
C:\xampp\php\php.exe src/controllers/list-customers.php
```
**Saída esperada:** Lista completa de clientes com seus dados

### 3. Inserir Cliente
```bash
C:\xampp\php\php.exe src/controllers/insert-customer.php
```
**Saída esperada:**
```
Cliente inserido com sucesso!
ID do novo cliente: 6
```

### 4. Atualizar Cliente
```bash
C:\xampp\php\php.exe src/controllers/update-customer.php
```
**Saída esperada:**
```
Cliente atualizado com sucesso!
Linhas afetadas: 1
```

### 5. Deletar Cliente
```bash
C:\xampp\php\php\php.exe src/controllers/delete-customer.php
```
**Saída esperada:**
```
Cliente deletado com sucesso!
Linhas afetadas: 1
```

## 📚 Próximos Passos

### Curto Prazo
- [ ] Adicionar validação de CPF/CNPJ
- [ ] Implementar CRUD de produtos
- [ ] Implementar CRUD de notas fiscais
- [ ] Adicionar autenticação básica

### Médio Prazo
- [ ] Criar API REST com JSON
- [ ] Implementar cálculo de impostos brasileiros
- [ ] Gerar XML de NF (padrão SEFAZ)
- [ ] Adicionar testes unitários

### Longo Prazo
- [ ] Implementar frontend React
- [ ] Implementar backend Node.js alternativo
- [ ] Deploy em servidor
- [ ] CI/CD com GitHub Actions

## 🐛 Troubleshooting

### Erro: PHP não é reconhecido
**Solução:** Use o caminho completo do PHP do XAMPP:
```bash
C:\xampp\php\php.exe nome-do-arquivo.php
```

### Erro: Conexão recusada
**Solução:** Verifique se o MySQL está rodando no XAMPP Control Panel

### Erro: Banco de dados não encontrado
**Solução:** Crie o banco de dados `financial_system` no phpMyAdmin e importe o schema

## 📄 Licença

MIT License - Livre para uso pessoal e comercial

## 👨‍💻 Sobre

Este projeto foi desenvolvido como parte do sistema de aprendizado VISAGIO para preparação para vaga de Desenvolvedor Fullstack Junior.

**Foco do Projeto:**
- Demonstrar conhecimento prático em PHP e MySQL
- Mostrar boas práticas de segurança (prepared statements)
- Estrutura de código organizada e profissional
- Preparação para requisitos específicos da vaga (PHP, SQL, backend)

**Tecnologias Focadas na Vaga:**
- ✅ PHP
- ✅ SQL/MySQL
- ✅ Backend
- ✅ APIs REST
- ✅ Databases

---

**Desenvolvido em 2024 como portfólio de Fullstack Junior**
