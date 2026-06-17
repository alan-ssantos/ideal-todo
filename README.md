# Ideal Todo API

API REST para gerenciamento de tarefas (to-do list) com autenticação de usuários utilizando Laravel + Sanctum.

## ✅ O que a API oferece

- Registro e login de usuários
- Logout com invalidação do token atual
- CRUD completo de tarefas por usuário autenticado
- Filtro de tarefas por status via query string
- Validação de entrada com Form Requests
- Respostas JSON padronizadas com API Resources
- Seed com usuários e tarefas de exemplo

## 🧱 Tecnologias utilizadas

- PHP 8.3+
- Laravel 13
- Sanctum
- SQLite (configuração padrão) ou MySQL
- Pest para testes

## 📋 Pré-requisitos

- Composer
- PHP 8.3+
- Node.js e npm
- Banco de dados SQLite ou MySQL

## ⚙️ Instalação

1. Clone o repositório:

```bash
git clone <url-do-repositorio>
cd ideal-todo
```

2. Instale as dependências PHP:

```bash
composer install
```

3. Copie o arquivo de ambiente e configure as variáveis:

```bash
cp .env.example .env
```

4. Gere a chave da aplicação:

```bash
php artisan key:generate
```

4. Execute as migrations e seeders:

```bash
php artisan migrate --seed
```

## ▶️ Como rodar o projeto

### API

```bash
php artisan serve
```

A API ficará disponível em:

```text
http://localhost:8000
```

### Frontend/Vite (se necessário)

```bash
npm run dev
```

## 🔐 Endpoints da API

### Autenticação

#### Registro

```http
POST /api/register
Content-Type: application/json
```

Body:

```json
{
  "name": "João Silva",
  "email": "joao@email.com",
  "password": "12345678",
  "password_confirmation": "12345678"
}
```

#### Login

```http
POST /api/login
Content-Type: application/json
```

Body:

```json
{
  "email": "joao@email.com",
  "password": "12345678"
}
```

Resposta esperada:

```json
{
  "data": {
    "id": 1,
    "name": "João Silva",
    "email": "joao@email.com"
  },
  "token": "..."
}
```

#### Logout

```http
POST /api/logout
Authorization: Bearer <token>
```

### Tarefas

#### Listar tarefas

```http
GET /api/tasks?status=pendente
Authorization: Bearer <token>
```

#### Buscar tarefa pelo ID

```http
GET /api/tasks/{id}
Authorization: Bearer <token>
```

#### Criar tarefa

```http
POST /api/tasks
Authorization: Bearer <token>
Content-Type: application/json
```

Body:

```json
{
  "title": "Comprar leite",
  "description": "Passar no mercado depois do trabalho",
  "due_date": "2026-06-18 18:00:00",
  "status": "pending"
}
```

#### Atualizar tarefa

```http
PUT /api/tasks/{id}
Authorization: Bearer <token>
Content-Type: application/json
```

Body:

```json
{
  "title": "Comprar pão",
  "status": "completed"
}
```

#### Deletar tarefa

```http
DELETE /api/tasks/{id}
Authorization: Bearer <token>
```

## 🧪 Testes

Para rodar a suíte de testes:

```bash
php artisan test
```

O projeto já inclui testes para verificar:

- criação de tarefa por usuário autenticado
- negação de acesso a tarefa de outro usuário

## 🌱 Seeders

O seeder principal cria:

- pelo menos 2 usuários
- 5 tarefas de exemplo

## 📌 Observações importantes

- A autenticação é feita com Sanctum.
- Cada usuário só consegue acessar suas próprias tarefas.
- O status da tarefa deve ser `pending` ou `completed`.
- A data de vencimento deve seguir o formato `Y-m-d H:i:s`.
