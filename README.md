# PHP Dashboard Application

## Visão Geral
Este é um sistema de Dashboard (Painel de Controle) desenvolvido em PHP para o gerenciamento de produtos, anotações e usuários. O sistema também inclui um módulo para envio e gerenciamento de SMS, além de contar com controle de autenticação e sessões para acesso seguro.

## Funcionalidades
- **Autenticação e Segurança:** Login, Logout e criação de novos usuários (`auth.php`, `index.php`, `logout.php`).
- **Gestão de Produtos (CRUD):** Adicionar, editar, visualizar e remover produtos (`pages/produtos/`).
- **Gestão de Anotações (CRUD):** Criar, editar, visualizar e excluir anotações (`pages/anotacoes/`).
- **Módulo SMS:** Interface para envio ou listagem de SMS (`pages/sms.php`).
- **Painel Central:** Dashboard principal (`painel.php`) para visão geral e acesso rápido a todos os módulos do sistema.

## Estrutura de Diretórios

```text
Dashboard/
├── actions.php         # Funções de processamento e requisições do sistema
├── auth.php            # Validação e controle de sessão de usuários
├── conn.php            # Configuração de conexão com o Banco de Dados
├── index.php           # Página inicial (Tela de Login)
├── assets/             # Arquivos estáticos (Frontend)
│   ├── css/            # Estilos (style.css, painel.css, add.css, etc.)
│   └── js/             # Scripts JavaScript (painel.js)
└── pages/              # Telas e submódulos do sistema
    ├── anotacoes/      # Scripts CRUD para anotações
    ├── produtos/       # Scripts CRUD para produtos
    ├── usuario/        # Scripts de criação de usuário e logout
    ├── painel.php      # Tela principal após o login
    └── sms.php         # Funcionalidade de SMS
```

## Requisitos do Sistema
- Servidor Web (Apache, Nginx ou soluções locais como XAMPP, WAMP, Laragon)
- PHP (versão 7.x ou superior recomendada)
- Banco de Dados MySQL / MariaDB

## Como Instalar e Executar
1. Coloque a pasta `Dashboard` no diretório público do seu servidor web (ex: `htdocs` no XAMPP ou `/var/www/html/` no Linux).
2. Configure o banco de dados e importe as tabelas necessárias (database.sql).
3. Abra o arquivo `conn.php` e edite as credenciais (`hostname`, `username`, `password`, `database`) para corresponder ao seu banco de dados local.
4. Acesse o sistema pelo navegador através da URL: `http://localhost/Dashboard/`.
