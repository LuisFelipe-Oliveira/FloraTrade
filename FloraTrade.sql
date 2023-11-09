CREATE DATABASE FloraTrade;

USING FloraTrade;

CREATE TABLE
    Pessoa{IdPessoa INT NOT NULL,
    Nome VARCHAR(255),
    Tipo VARCHAR(7),
    CPF INT,
    Telefone VARCHAR(15),
    Email VARCHAR(70),
    PRIMARY KEY(IdPessoa)};

CREATE TABLE
    Produto{IdProduto INT NOT NULL,
    Nome VARCHAR(45),
    Preco DOUBLE,
    Quantidade INT,
    PRIMARY KEY(IdProduto)};

CREATE TABLE
    Venda{IdVenda INT NOT NULL,
    DataVenda DATE,
    Total DOUBLE,
    IdPessoa INT,
    PRIMARY KEY(IdVenda),
    FOREIGN KEY (IdPessoa) REFERENCES Pessoa (IdPessoa)};

CREATE TABLE
    ItemVenda{IdItemVenda INT NOT NULL,
    Quantidade INT,
    ValorUnitario DOUBLE,
    Desconto DOUBLE,
    Subtotal DOUBLE,
    IdProduto INT,
    IdVenda INT,
    PRIMARY KEY (IdItemVenda),
    FOREIGN KEY (IdProduto) REFERENCES Produto (IdProduto),
    FOREIGN KEY (IdVenda) REFERENCES Venda (IdVenda)};

CREATE TABLE
    Lote{IdProduto INT,
    IdFornecedor INT,
    DataEntrega DATE,
    Situacao VARCHAR(45),
    FOREIGN KEY (IdProduto) REFERENCES Produto (IdProduto),
    FOREIGN KEY (IdFornecedor) REFERENCES Fornecedor (IdFornecedor)};

CREATE TABLE
    Fornecedor{IdFornecedor INT NOT NULL,
    NomeFornecedor VARCHAR(45),
    DataCadastro DATE,
    Situacao VARCHAR(10),
    CNPJ INT,
    PRIMARY KEY (IdFornecedor)};

CREATE TABLE