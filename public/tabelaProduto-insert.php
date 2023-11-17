<?php
require_once("header.php");

if (isset($_POST['enviar'])) {
    $nome = "";
    $preco = "";
    $quantidade = "";
    $nome = $_POST['nome'];
    $preco = preg_replace('/[^0-9.]/', '', $_POST['preco']);
    $quantidade = $_POST['quantidade'];

    require_once('config/connect.php');

    $mysql_query = "INSERT INTO Produto (Nome, Preco, Quantidade)
                                VALUES ('{$nome}', '{$preco}', '{$quantidade}')";

    $result = $conn->query($mysql_query);

    if ($result === true) {
        $msg = "insert success";
        $msgerror = "";
    } else {
        $msg = "";
        $msgerror = $conn->errorInfo()[2];
    }

    $conn = null;

    // header("Location: tabelaProduto.php?msg={$msg}&msgerror={$msgerror}");
}

?>

<link rel="stylesheet" href="assets\css\tabela.css" />


<div class="container">

    <h2>Fornecedores</h2>
    <p>Cadastro de fornecedores.</p>

    <div class="wrapper">
        <form method="post">
            <label for="nome">&nbsp;Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required><br>
            <label for="preco">&nbsp;Preço</label>
            <input type="number" name="preco" id="preco" class="form-control" min="0" step="0.01" required><br>
            <label for="quantidade">&nbsp;Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" class="form-control" required min="0" step="1"><br>
            <input type="submit" name="enviar" value="Inserir" class="btn btn-primary">
            <a href="tabelaProduto.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
        </form>
    </div>
</div>

<?php

require_once("footer.php");
?>