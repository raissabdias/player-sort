<p align="center">
  <img src="https://github.com/raissabdias/player-sort/assets/49205283/40663870-1110-462c-8a87-c0b5e5882d7b" />
</p>
<h2 align="center">Player Sort</h2>
<p align="center">
    <img alt="Badge = Laravel Version" src="https://img.shields.io/badge/laravel-v11.9.1-blue">
    <img alt="Badge = Release Date" src="https://img.shields.io/badge/release date-jun 24-yellow">
</p>
<p>
    Uma aplicação para realizar sorteios de time de futebol, a partir do cadastro de jogadores, definição de goleiros e confirmação de presença no sorteio. Desenvolvida com o próposito de testar conhecimentos.
</p>
<h4 align="center"> 
    :construction:  Projeto em construção  :construction:
</h4>

### :hammer: Funcionalidades do projeto

- `Autenticação`: cadastro de usuários que utilizarão o sistema
- `Jogadores`: cadastro de jogadores disponíveis para os sorteios
- `Sorteios`: geração de sorteios, a partir de uma quantidade definida de jogadores por time e confirmação de presença

### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com), [Node.js](https://nodejs.org/en/), e a versão mais recente do [PHP](https://www.php.net/downloads.php).

### 🎲 Rodando a aplicação

```bash
# Clone este repositório
$ git clone https://github.com/raissabdias/player-sort.git

# Acesse a pasta do projeto no terminal/cmd
$ cd player-sort

# Instale o composer
$ composer install

# Instale as dependências
$ npm install

# Criar arquivo de configuração das variáveis de ambiente
$ copy .env.example .env

# Configure os dados do seu banco local 

# Rode as migrações
$ php artisan migrate

# Rode os seeders, para preenchimento inicial do banco
$ php artisan db:seed

# Inicie o servidor
$ php artisan serve

# O servidor inciará na porta:8000 - acesse <http://localhost:8000>
```

### 🛠 Tecnologias

As seguintes ferramentas foram usadas na construção do projeto:

- [PHP](https://www.php.net/downloads.php)
- [Laravel](https://laravel.com/)
- [Laravel Breeze](https://github.com/laravel/breeze)
- [MySQL](https://www.mysql.com/)

