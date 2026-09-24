# 🛒 Sistema de Pedidos

Sistema web criado para gerenciar pedidos, feito com Laravel. O projeto ajuda a controlar categorias, clientes, produtos e pedidos, usando uma organização que segue o padrão MVC.

> Projeto feito para estudar e praticar desenvolvimento web com Laravel, PHP, banco de dados e organização de aplicações no padrão MVC.

---

## 📌 Sobre o Projeto

O Sistema-Pedido é uma aplicação web criada para simular o gerenciamento de pedidos de uma empresa.

A aplicação permite:

* Cadastrar clientes

* Cadastrar categorias

* Cadastrar produtos

* Criar pedidos

* Adicionar itens aos pedidos

* Visualizar pedidos

* Editar registros

* Excluir registros

O projeto segue a arquitetura padrão do Laravel, separando responsabilidades entre **Models, Controllers, Views e Routes**.

---

## 🚀 Tecnologias Utilizadas

* **PHP 8.3+**

* **Laravel 13**

* **SQLite**

* **Blade**

* **Vite**

* **Tailwind CSS**

* **Composer**

* **Node.js / NPM**

O `composer.json` do projeto atualmente exige PHP `^8.3` e Laravel `^13.17`.

O frontend utiliza Vite, Tailwind CSS e o plugin do Laravel para Vite.

---

## 🏗️ Arquitetura

O projeto segue o padrão **MVC — Model, View, Controller**, utilizado pelo Laravel.

```text

Usuário

│

▼

Routes

│

▼

Controller

│

├──► Model

│       │

│       ▼

│    Database

│

▼

View

│

▼

Usuário

```

### Model

Representa os dados e as regras relacionadas às entidades do sistema.

Exemplos:

* Cliente

* Produto

* Categoria

* Pedido

### Controller

Recebe as requisições, executa a lógica necessária e direciona a resposta.

O projeto possui controllers específicos para:

* Categorias

* Clientes

* Produtos

* Pedidos

### View

Responsável pela interface apresentada ao usuário.

As páginas são construídas utilizando o sistema de templates do Laravel, principalmente através do **Blade**.

### Routes

As rotas definem quais URLs estão disponíveis e qual controller será responsável por processar cada requisição.

---

# 📂 Estrutura do Projeto

A estrutura principal do projeto segue a organização padrão do Laravel:

```text

Sistema-Pedido/

│

├── app/

│   ├── Http/

│   │   └── Controllers/

│   │

│   └── Models/

│

├── bootstrap/

│

├── config/

│

├── database/

│   ├── factories/

│   ├── migrations/

│   └── seeders/

│

├── public/

│

├── resources/

│   └── views/

│

├── routes/

│   └── web.php

│

├── storage/

│

├── tests/

│

├── .env.example

├── artisan

├── composer.json

├── package.json

└── vite.config.js

```

---

# ⚙️ Funcionalidades

## 👥 Clientes

O sistema permite realizar operações de gerenciamento de clientes.

### Operações disponíveis

* Listar clientes

* Cadastrar cliente

* Editar cliente

* Atualizar cliente

* Excluir cliente

Rotas utilizadas:

```text

GET     /clientes

POST    /clientes

GET     /clientes/{cliente}/edit

PUT     /clientes/{cliente}

DELETE  /clientes/{cliente}

```

---

## 🏷️ Categorias

As categorias são utilizadas para organizar os produtos cadastrados no sistema.

### Operações disponíveis

* Listar categorias

* Cadastrar categoria

* Editar categoria

* Atualizar categoria

* Excluir categoria

Rotas:

```text

GET     /categorias

POST    /categorias

GET     /categorias/{categoria}/edit

PUT     /categorias/{categoria}

DELETE  /categorias/{categoria}

```

---

## 📦 Produtos

O módulo de produtos permite controlar os produtos disponíveis no sistema.

### Operações disponíveis

* Listar produtos

* Cadastrar produto

* Editar produto

* Atualizar produto

* Excluir produto

Rotas:

```text

GET     /produtos

POST    /produtos

GET     /produtos/{produto}/edit

PUT     /produtos/{produto}

DELETE  /produtos/{produto}

```

---

# 🧾 Pedidos

O módulo de pedidos cuida de todas as vendas que são feitas.

### Operações disponíveis

* Listar pedidos

* Criar pedido

* Visualizar um pedido

* Adicionar itens

* Editar pedido

* Atualizar pedido

* Excluir pedido

Rotas:

```text

GET     /pedidos

POST    /pedidos

GET     /pedidos/{pedido}

POST    /pedidos/{pedido}/itens

GET     /pedidos/{pedido}/edit

PUT     /pedidos/{pedido}

DELETE  /pedidos/{pedido}

```

As rotas acima são definidas no arquivo `routes/web.php` do projeto.

---

# 🔄 Fluxo de um Pedido

O funcionamento básico do sistema pode ser mostrado assim:

```text

Cliente

│

▼

Criação do Pedido

│

▼

Seleção dos Produtos

│

▼

Adição dos Itens

│

▼

Pedido

│

▼

Visualização / Edição

```

Um pedido pode receber produtos através da rota:

```text

POST /pedidos/{pedido}/itens

```

permite adicionar itens a um pedido que já existe.

---

# 🌐 Rotas da Aplicação

A rota inicial da aplicação é:

```text

GET /

```

Ela direciona o usuário para a página principal:

```php

return view('web.index');

```

As demais rotas estão organizadas por recurso:

| Recurso    | Prefixo       |

| ---------- | ------------- |

| Categorias | `/categorias` |

| Clientes   | `/clientes`   |

| Produtos   | `/produtos`   |

| Pedidos    | `/pedidos`    |

---

# 🗄️ Banco de Dados

O arquivo `.env.example` atualmente está configurado para utilizar **SQLite**:

```env

DB_CONNECTION=sqlite

```

As configurações de MySQL também aparecem como exemplo, mas estão comentadas no arquivo de configuração.

Para utilizar SQLite, o banco pode ser mantido dentro de:

```text

database/database.sqlite

```

O processo padrão do Laravel já cria esse arquivo e executa as migrations.

---

# 🛠️ Instalação

## 1. Clonar o repositório

```bash

git clone https://github.com/joaopascoal1v-sudo/Sistema-Pedido.git

```

Entrar na pasta:

```bash

cd Sistema-Pedido

```

## 2. Instalar dependências PHP

```bash

composer install

```

## 3. Configurar o ambiente

Copie o arquivo:

```text

.env.example

```

para:

```text

.env

```

No Linux:

```bash

cp .env.example .env

```

No Windows:

```bash

copy .env.example .env

```

## 4. Gerar a chave da aplicação

```bash

php artisan key:generate

```

## 5. Configurar o banco

Para utilizar SQLite:

```env

DB_CONNECTION=sqlite

```

Crie o arquivo:

```text

database/database.sqlite

```

Caso necessário:

```bash

touch database/database.sqlite

```

No Windows, o arquivo pode ser criado manualmente dentro da pasta `database`.

## 6. Executar as migrations

```bash

php artisan migrate

```

## 7. Instalar dependências do frontend

```bash

npm install

```

## 8. Iniciar o Vite

Durante o desenvolvimento:

```bash

npm run dev

```

## 9. Iniciar o Laravel

Em outro terminal:

```bash

php artisan serve

```

A aplicação ficará disponível normalmente em:

```text

http://localhost:8000

```

---

# 💻 Desenvolvimento Frontend

O projeto utiliza **Vite** para o processo de desenvolvimento e build dos arquivos frontend.

Comando para desenvolvimento:

```bash

npm run dev

```

Segue a contribuição do usuário:

Para gerar os arquivos de produção:

```bash

npm run build

```

Esses scripts estão definidos no `package.json`.

---

# 🧪 Testes

O projeto possui a estrutura de testes padrão do Laravel dentro da pasta:

```text

tests/

```

Para executar os testes:

```bash

php artisan test

```

O comando também está configurado no `composer.json`.

---

# 📁 Principais Diretórios

| Diretório               | Responsabilidade                |

| ----------------------- | ------------------------------- |

| `app/`                  | Código principal da aplicação   |

| `app/Http/Controllers/` | Controllers                     |

| `app/Models/`           | Models                          |

| `bootstrap/`            | Inicialização do framework      |

| `config/`               | Configurações                   |

| `database/`             | Migrations, factories e seeders |

| `public/`               | Arquivos públicos               |

| `resources/`            | Views e recursos frontend       |

| `routes/`               | Rotas da aplicação              |

| `storage/`              | Arquivos gerados pela aplicação |

| `tests/`                | Testes automatizados            |

---

# 🎯 Objetivos de Aprendizado

Este projeto permite praticar conceitos importantes do desenvolvimento web utilizando Laravel:

- Estrutura MVC

- PHP

- Laravel

- Rotas

- Controllers

- Models

- Views

- Blade

- CRUD

- Banco de dados

- Migrations

- Relacionamentos entre entidades

- Formulários

- Requisições HTTP

- Vite

- Tailwind CSS

- Composer

- NPM

- Git e GitHub

---

# 📚 Conceitos Praticados

O projeto também permite compreender o fluxo de uma aplicação web:

```text

Requisição HTTP

↓

Route

↓

Controller

↓

Model

↓

Database

↓

Controller

↓

View

↓

Resposta HTTP

```

Esse fluxo representa uma das ideias fundamentais do desenvolvimento de aplicações utilizando Laravel.

---

# 🚧 Melhorias Futuras

Algumas funcionalidades que podem ser adicionadas futuramente:

- [ ] Sistema de autenticação

- [ ] Controle de usuários

- [ ] Controle de permissões

- [ ] Validação mais completa dos formulários

- [ ] Paginação

- [ ] Busca de produtos

- [ ] Filtros de pedidos

- [ ] Controle de estoque

- [ ] Status dos pedidos

- [ ] Integração com pagamentos

- [ ] Dashboard

- [ ] Relatórios

- [ ] Testes automatizados mais abrangentes

- [ ] API REST

- [ ] Documentação da API com Swagger/OpenAPI

---

# 📌 Status

**Em desenvolvimento / projeto de estudo.**

O projeto está sendo utilizado para praticar o desenvolvimento de aplicações web utilizando Laravel e conceitos relacionados ao desenvolvimento backend.

---

## 👨‍💻 Autor

**João Victor Pascoal De Oliveira**

GitHub:

`https://github.com/joaopascoal1v-sudo`

---

## 📄 Licença

Este projeto utiliza a estrutura do framework Laravel, que é distribuído sob a licença MIT.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
