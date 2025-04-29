# Cadastro de Clientes

> API RESTful desenvolvida em Laravel, com separação de responsabilidades (Repository Pattern) e cobertura de testes automatizados.

---

## Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Design Patterns Aplicados](#design-patterns-aplicados)
- [Arquitetura e Organização](#arquitetura-e-organizacao)
- [Como Instalar](#como-instalar)
- [Como Usar](#como-usar)
- [Endpoints da API](#endpoints-da-api)
- [Seeders e Factory](#seeders-e-factory)
- [Validação com Form Requests](#validacao-com-form-requests)
- [Testes](#testes)
- [Autor](#autor)
- [Licença](#licenca)

---

## Sobre o Projeto

API para cadastro e gerenciamento de clientes, com arquitetura limpa, separação entre persistência e lógica de negócio, e testes automatizados.

---

## Tecnologias Utilizadas

- PHP (>=8.1)
- Laravel
- PostgreSQL (ou outro banco suportado)
- Docker
- Composer

---

## Design Patterns Aplicados

- Repository Pattern
- Service Layer

---

## Arquitetura e Organização

```
app/
 ├── Http/
 │    ├── Controllers/
 │    └── Requests/
 ├── Models/
 ├── Services/
 └── Repositories/
      └── Contracts/
database/
 ├── factories/
 ├── migrations/
 └── seeders/
routes/
 └── api.php
```

---

## Como Instalar

```bash
# Clonar o repositório
git clone https://github.com/danielandrade-dev/cadastro-de-clientes.git

# Acessar o diretório
cd cadastro-de-clientes

# Subir o ambiente Docker
docker-compose up -d

# Acessar o container e rodar migrations e seeders
docker exec -it nome_container_php bash
php artisan migrate --seed
```

> As variáveis de ambiente estão no arquivo `.env`.

---

## Como Usar

Acesse a API via Postman, Insomnia ou similar:

```
http://localhost:8000/api/clients
```

---

## Endpoints da API

| Método | Rota                | Descrição                |
|:------:|:--------------------|:-------------------------|
| GET    | /api/clients        | Listar todos os clientes |
| POST   | /api/clients        | Criar novo cliente       |
| GET    | /api/clients/{id}   | Buscar cliente específico|
| PUT    | /api/clients/{id}   | Atualizar cliente        |
| DELETE | /api/clients/{id}   | Remover cliente (soft)   |

**Exemplo de payload para criação:**
```json
{
  "name": "João da Silva",
  "email": "joao@email.com",
  "phone": "11999999999",
  "address": "Rua Exemplo, 123"
}
```

---

## Seeders e Factory
- **Factory:** `database/factories/ClientFactory.php` para geração de clientes fake.
- **Seeder:** `database/seeders/ClientSeeder.php` popula a tabela com 20 clientes fictícios.
- Para popular o banco:
```bash
php artisan migrate:fresh --seed
```

---

## Validação com Form Requests
- `app/Http/Requests/StoreClientRequest.php`: Validação para criação de cliente.
- `app/Http/Requests/UpdateClientRequest.php`: Validação para atualização de cliente.
- O controller utiliza esses requests para garantir dados válidos.

---

## Testes

O projeto possui testes automatizados de **feature** (API) e **unitários** (Service e Repository):

```bash
# Rodar todos os testes
php artisan test

# Rodar apenas testes unitários
php artisan test --testsuite=Unit

# Rodar apenas testes de feature
php artisan test --testsuite=Feature
```

- Testes de feature: `tests/Feature/ClientApiTest.php`
- Testes unitários: `tests/Unit/ClientServiceTest.php`, `tests/Unit/ClientRepositoryTest.php`

---

## Autor

| Nome           | Perfil                                                                 |
|:---------------|:----------------------------------------------------------------------|
| Daniel Moreira | [LinkedIn](https://www.linkedin.com/in/danielandrade-dev) · [GitHub](https://github.com/danielandrade-dev) |

---

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.

---
