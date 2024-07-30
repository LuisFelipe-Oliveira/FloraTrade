# FloraTrade

## Descrição

FloraTrade é um sistema de controle de estoque desenvolvido para floriculturas. Este sistema permite o gerenciamento eficiente de produtos, incluindo o rastreamento de inventário, registro de vendas e controle de fornecedores. Com uma interface intuitiva, FloraTrade facilita a gestão de estoque, garantindo que as floriculturas possam manter seu inventário atualizado e organizado.

## Tecnologias Utilizadas

* **PHP**: Linguagem de programação usada para o backend.
* **MySQL**: Banco de dados relacional para armazenar e consultar os dados.
* **JavaScript**: Utilizado para a interação e dinamismo no frontend.
* **Bootstrap**: Framework CSS utilizado para estilização e design responsivo.

## Funcionalidades

* **Autenticação**: Cadastro e autenticação de usuários.
* **CRUD**: Adição, edição e remoção de itens essenciais para a floricultura, como produto, cliente, fornecedor, pedido e venda.
* **Interface Responsiva**: Interface amigável e adaptável a diferentes dispositivos, graças ao Bootstrap.

## Como Rodar o Projeto Localmente

Para rodar o FloraTrade localmente usando XAMPP, siga os passos abaixo:

### Pré-requisitos

* [XAMPP](https://www.apachefriends.org/index.html) instalado em sua máquina.

### Passos para Rodar

1. **Clone o Repositório**

   Clone o repositório do FloraTrade para o diretório htdocs do XAMPP. Para isso, navegue até o diretório htdocs e execute o comando:

   
```bash
   git clone https://github.com/LuisFelipe-Oliveira/FloraTrade.git
```   
2. **Configure o banco de dados**

   - Inicie o XAMPP e ative os módulos Apache e MySQL.
   - Acesse o [phpMyAdmin](http://localhost/phpmyadmin) e crie um banco de dados chamado floratrade.
   - Importe o arquivo FloraTrade.sql localizado no diretório do projeto para o banco de dados criado.
   
3. **Inicie o servidor**

   - Acesse o navegador e digite http://localhost/FloraTrade/public para acessar o FloraTrade.
