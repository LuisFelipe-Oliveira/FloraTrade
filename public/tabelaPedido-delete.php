<?php

// Certifique-se de que o ID do fornecedor foi fornecido
if (isset($_GET['id'])) {
    $IdPedido = $_GET['id'];

    require_once('config/connect.php');

    // Verifique se o fornecedor existe antes de exibir o formulário de exclusão
    $check_query = "SELECT * FROM pedido WHERE IdPedido = :id";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bindParam(':id', $IdPedido);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        // O fornecedor existe, obtenha os detalhes
        $pedidoDetailsQuery = "SELECT * FROM pedido WHERE IdPedido = :id";
        $pedidoDetailsStmt = $conn->prepare($pedidoDetailsQuery);
        $pedidoDetailsStmt->bindParam(':id', $IdPedido);
        $pedidoDetailsStmt->execute();
        $pedidoDetails = $pedidoDetailsStmt->fetch(PDO::FETCH_ASSOC);

        // Processar o formulário de exclusão
        if (isset($_POST['enviar'])) {
            $delete_query = "DELETE FROM pedido WHERE IdPedido = :id";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bindParam(':id', $IdPedido);

            if ($delete_stmt->execute()) {
                $msg = "delete success";
                $msgerror = "";
                header("Location: tabelaPedido.php?msg={$msg}&msgerror={$msgerror}");
                exit();
            } else {
                $msg = "delete error";
                $msgerror = $delete_stmt->errorInfo()[2];
            }
        }
    } else {
        // O fornecedor não existe
        $msg = "";
        $msgerror = "Pedido não encontrado.";
        header("Location: tabelaPedido.php?msg={$msg}&msgerror={$msgerror}");
        exit();
    }

    $conn = null;
} else {
    // ID do fornecedor não fornecido na URL
    header("Location: tabelaPedido.php?msg=&msgerror=ID do fornecedor não fornecido.");
    exit();
}

require("header.php");
?>

<link rel="stylesheet" href="assets\css\tabela.css" />

<div class="container">
    <h2>Peidos</h2>
    <p>Exclusão do cadastro de pedidos.</p>
    <hr>    
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id" value="<?= $IdPedido; ?>">
            <label for="IdFornecedor">&nbsp;IdFornecedor</label>
            <input type="text" name="IdFornecedor" id="IdFornecedor" class="form-control" readonly value="<?= $pedidoDetails['IdFornecedor']; ?>"><br>
            <label for="IdProduto">&nbsp;IdProduto</label>
            <input type="text" name="IdProduto" id="IdProduto" class="form-control" readonly value="<?= $pedidoDetails['IdProduto']; ?>"><br>
            <label for="situação">&nbsp;Situação</label>
            <input type="text" name="situação" id="situação" class="form-control" readonly value="<?= $pedidoDetails['Situacao']; ?>"><br>
            <div class="buttons-tabelas">
                <a href="tabelaPedido.php"><button type="button"
                    class="btn btn-danger btn-tamanho">Cancelar</button></a>
                <input type="submit" name="enviar" value="Excluir" class="btn btn-primary btn-tamanho">
            </div>
        </form>
    </div>
</div>

<?php require("footer.php"); ?>