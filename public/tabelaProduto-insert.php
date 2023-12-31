<?php

if (isset($_POST['enviar'])) {
    $nome = "";
    $preco = "";
    $quantidade = "";
    $nome = $_POST['nome'];
    $preco = preg_replace('/[^0-9.]/', '', $_POST['preco']);
    $quantidade = $_POST['quantidade'];

    require_once('config/connect.php');

    $insert_query = "INSERT INTO Produto (Nome, Preco, Quantidade) 
                        VALUES (:nome, :preco, :quantidade)";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bindParam(':nome', $nome);
    $insert_stmt->bindParam(':preco', $preco);
    $insert_stmt->bindParam(':quantidade', $quantidade);


    if ($insert_stmt->execute()) {
        $msg = "insert success";
        $msgerror = "";
    } else {
        $msg = "insert error";
        $msgerror = $conn->errorInfo()[2];
    }

    $conn = null;

    header("Location: tabelaProduto.php?msg={$msg}&msgerror={$msgerror}");
}
require_once("header.php");
?>

<link rel="stylesheet" href="assets\css\tabela.css">

<div class="container">

    <h2>Produtos</h2>
    <p>Cadastro de Produtos.</p>

    <div class="wrapper">
        <form method="post">
            <label for="nome">&nbsp;Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required><br>
            <label for="preco">&nbsp;Preço</label>
            <input type="number" name="preco" id="preco" class="form-control" min="0" step="0.01" required><br>
            <label for="quantidade">&nbsp;Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" class="form-control" required min="0" step="1"><br>
            <div class="buttons-tabelas">
                <a href="tabelaProduto.php"><button type="button"
                        class="btn btn-danger btn-tamanho">Cancelar</button></a>
                <input type="submit" name="enviar" value="Inserir" class="btn btn-primary btn-tamanho">
            </div>
        </form>
    </div>
</div>

<?php

require_once("footer.php");
?>