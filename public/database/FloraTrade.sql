-- SQLBook: Code

CREATE DATABASE FloraTrade;

USE FloraTrade;

CREATE TABLE
    Cliente (
        IdCliente INT NOT NULL AUTO_INCREMENT,
        Nome VARCHAR(255),
        CPF INT,
        Telefone VARCHAR(15),
        Email VARCHAR(70),
        PRIMARY KEY (IdCliente)
    );

CREATE TABLE
    Usuario (
        IdUsuario INT NOT NULL AUTO_INCREMENT,
        Nome VARCHAR(255) NOT NULL,
        Telefone VARCHAR(11) NOT NULL,
        Email VARCHAR(60) NOT NULL,
        SENHA VARCHAR(60) NOT NULL,
        DataCriacao DATETIME DEFAULT CURRENT_TIMESTAMP(),
        PRIMARY KEY (IdUsuario)
    );

CREATE TABLE
    Produto (
        IdProduto INT NOT NULL AUTO_INCREMENT,
        Nome VARCHAR(45),
        Preco DOUBLE,
        Quantidade INT,
        PRIMARY KEY (IdProduto)
    );

CREATE TABLE
    Venda (
        IdVenda INT NOT NULL AUTO_INCREMENT,
        DataVenda DATETIME DEFAULT CURRENT_TIMESTAMP(),
        Total DOUBLE,
        IdUsuario INT,
        IdCliente INT,
        PRIMARY KEY (IdVenda),
        FOREIGN KEY (IdUsuario) REFERENCES Usuario (IdUsuario),
        FOREIGN KEY (IdCliente) REFERENCES Cliente (IdCliente)
    );

CREATE TABLE
    ItemVenda (
        IdItemVenda INT NOT NULL AUTO_INCREMENT,
        Quantidade INT,
        ValorUnitario DOUBLE,
        Desconto DOUBLE,
        Subtotal DOUBLE,
        IdProduto INT,
        IdVenda INT,
        PRIMARY KEY (IdItemVenda),
        FOREIGN KEY (IdProduto) REFERENCES Produto (IdProduto),
        FOREIGN KEY (IdVenda) REFERENCES Venda (IdVenda)
    );

CREATE TABLE
    Fornecedor (
        IdFornecedor INT NOT NULL AUTO_INCREMENT,
        NomeFornecedor VARCHAR(45),
        DataCadastro DATETIME DEFAULT CURRENT_TIMESTAMP(),
        Situacao VARCHAR(10),
        CNPJ VARCHAR(14),
        PRIMARY KEY (IdFornecedor)
    );

CREATE TABLE
    Pedido (
        IdPedido INT NOT NULL AUTO_INCREMENT,
        IdProduto INT,
        IdFornecedor INT,
        DataEntrega DATETIME DEFAULT CURRENT_TIMESTAMP(),
        Situacao VARCHAR(45),
        PRIMARY KEY(IdPedido),
        FOREIGN KEY (IdProduto) REFERENCES Produto (IdProduto),
        FOREIGN KEY (IdFornecedor) REFERENCES Fornecedor (IdFornecedor)
    );