CREATE DATABASE FloraTrade;

USE FloraTrade;

CREATE TABLE
    Cliente (
        IdCliente INT NOT NULL,
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
        DataCriacao DATETIME DEFAULT current_timestamp(),
        PRIMARY KEY (IdUsuario)
    );

CREATE TABLE
    Produto (
        IdProduto INT NOT NULL,
        Nome VARCHAR(45),
        Preco DOUBLE,
        Quantidade INT,
        PRIMARY KEY (IdProduto)
    );

CREATE TABLE
    Venda (
        IdVenda INT NOT NULL,
        DataVenda DATE,
        Total DOUBLE,
        IdUsuario INT,
        IdCliente INT,
        PRIMARY KEY (IdVenda),
        FOREIGN KEY (IdUsuario) REFERENCES Usuario (IdUsuario),
        FOREIGN KEY (IdCliente) REFERENCES Cliente (IdCliente)
    );

CREATE TABLE
    ItemVenda (
        IdItemVenda INT NOT NULL,
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
        IdFornecedor INT NOT NULL,
        NomeFornecedor VARCHAR(45),
        DataCadastro DATE,
        Situacao VARCHAR(10),
        CNPJ INT,
        PRIMARY KEY (IdFornecedor)
    );
    
CREATE TABLE
    Pedido (
		IdPedido INT NOT NULL,
        IdProduto INT,
        IdFornecedor INT,
        DataEntrega DATE,
        Situacao VARCHAR(45),
        FOREIGN KEY (IdProduto) REFERENCES Produto (IdProduto),
        FOREIGN KEY (IdFornecedor) REFERENCES Fornecedor (IdFornecedor)
    );