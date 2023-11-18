<?php
// Certifique-se de que o ID do produto foi fornecido
if (isset($_GET['id'])) {
    $produtoId = $_GET['id'];

    require_once('config/connect.php');

    // Verifique se os produtos existe antes de exibir o formulário de exclusão
    $check_query = "SELECT * FROM Produto WHERE IdProduto = :id";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bindParam(':id', $produtoId);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        // O produtos existe, obtenha os detalhes
        $produtosDetailsQuery = "SELECT * FROM Produto WHERE IdProduto = :id";
        $produtosDetailsStmt = $conn->prepare($produtosDetailsQuery);
        $produtosDetailsStmt->bindParam(':id', $produtoId);
        $produtosDetailsStmt->execute();
        $produtosDetails = $produtosDetailsStmt->fetch(PDO::FETCH_ASSOC);

        // Processar o formulário de exclusão
        if (isset($_POST['enviar'])) {
            $delete_query = "DELETE FROM Produto WHERE IdProduto = :id";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bindParam(':id', $produtoId);

            if ($delete_stmt->execute()) {
                $msg = "delete success";
                $msgerror = "";
                header("Location: tabelaProduto.php");
                exit();
            } else {
                $msg = "";
                $msgerror = $delete_stmt->errorInfo()[2];
            }
        }
    } else {
        // O produtos não existe
        $msg = "";
        $msgerror = "Produto não encontrado.";
        header("Location: tabelaProduto.php?msg={$msg}&msgerror={$msgerror}");
        exit();
    }

    $conn = null;
} else {
    // ID do produtos não fornecido na URL
    header("Location: tabelaProduto.php?msg=&msgerror=ID do produtos não fornecido.");
    exit();
}
require("header.php");
?>
<link rel="stylesheet" href="assets\css\tabela.css" />

<div class="container">
    <h2>Produtos</h2>
    <p>Exclusão do cadastro dos produtos.</p>
    <hr>
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id" value="<?= $produtoId; ?>">
            <label for="nome">&nbsp;Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" readonly
                value="<?= $produtosDetails['Nome']; ?>"><br>
            <label for="Preco">&nbsp;Preço</label>
            <input type="text" name="Preco" id="Preco" class="form-control" readonly
                value="<?= $produtosDetails['Preco']; ?>"><br>
            <label for="Quantidade">&nbsp;Quantidade</label>
            <input type="text" name="Quantidade" id="Quantidade" class="form-control" readonly
                value="<?= $produtosDetails['Quantidade']; ?>"><br>
            <div class="buttons-tabelas">
                <a href="tabelaProduto.php"><button type="button"
                        class="btn btn-primary btn-tamanho">Cancelar</button></a>
                <input type="submit" name="enviar" value="Excluir" class="btn btn-danger btn-tamanho">

            </div>
        </form>
    </div>
</div>

<?php require("footer.php"); ?>