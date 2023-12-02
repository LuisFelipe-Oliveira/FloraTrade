-- SQLBook: Code

CREATE DATABASE FloraTrade;

USE FloraTrade;

CREATE TABLE
    Cliente (
        IdCliente INT NOT NULL AUTO_INCREMENT,
        Nome VARCHAR(255),
        CPF VARCHAR(11),
        Telefone VARCHAR(15),
        Email VARCHAR(70),
        favorito VARCHAR(1),
        PRIMARY KEY (IdCliente)
    );

CREATE TABLE
    Usuario (
        IdUsuario INT NOT NULL AUTO_INCREMENT,
        Nome VARCHAR(255) NOT NULL,
        Telefone VARCHAR(11) NOT NULL,
        Email VARCHAR(60) NOT NULL,
        SENHA VARCHAR(60) NOT NULL,
        FotoPerfil VARCHAR(255) DEFAULT "./assets/imgs/imgsUpload/avatar.jpg",
        DataCriacao DATETIME DEFAULT CURRENT_TIMESTAMP(),
        token VARCHAR(255),
        timetoken int,
        PRIMARY KEY (IdUsuario)
    );

CREATE TABLE
    Produto (
        IdProduto INT NOT NULL AUTO_INCREMENT,
        Nome VARCHAR(45),
        Preco DOUBLE,
        Quantidade INT,
        favorito VARCHAR(1),
        PRIMARY KEY (IdProduto)
    );

CREATE TABLE
    Venda (
        IdVenda INT NOT NULL AUTO_INCREMENT,
        DataVenda DATETIME DEFAULT CURRENT_TIMESTAMP(),
        Total DOUBLE,
        IdUsuario INT,
        IdCliente INT,
        favorito VARCHAR(1),
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
        Subtotal DECIMAL(10, 2) GENERATED ALWAYS AS (
            valorUnitario * Quantidade - Desconto
        ) STORED,
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
        favorito VARCHAR(1),
        PRIMARY KEY (IdFornecedor)
    );

CREATE TABLE
    Pedido (
        IdPedido INT NOT NULL AUTO_INCREMENT,
        IdProduto INT,
        IdFornecedor INT,
        DataEntrega DATETIME DEFAULT CURRENT_TIMESTAMP(),
        Situacao VARCHAR(45),
        favorito VARCHAR(1),
        PRIMARY KEY(IdPedido),
        FOREIGN KEY (IdProduto) REFERENCES Produto (IdProduto),
        FOREIGN KEY (IdFornecedor) REFERENCES Fornecedor (IdFornecedor)
    );