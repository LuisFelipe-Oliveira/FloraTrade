<?php

if (isset($_POST['enviar'])) {
  // Verificar se os índices existem no array $_POST
  if (isset($_POST['IdFornecedor']) && isset($_POST['IdProduto'])) {
    $IdFornecedor = $_POST['IdFornecedor'];
    $IdProduto = $_POST['IdProduto'];
    $situacao = "";

    require_once('config/connect.php');

    // Verificar se o fornecedor existe
    $queryFornecedor = "SELECT * FROM fornecedor WHERE IdFornecedor = :IdFornecedor";
    $stmtFornecedor = $conn->prepare($queryFornecedor);
    $stmtFornecedor->bindParam(':IdFornecedor', $IdFornecedor);
    $stmtFornecedor->execute();

    // Verificar se o produto existe
    $queryProduto = "SELECT * FROM produto WHERE IdProduto = :IdProduto";
    $stmtProduto = $conn->prepare($queryProduto);
    $stmtProduto->bindParam(':IdProduto', $IdProduto);
    $stmtProduto->execute();

    // Se NÃO existirem fornecedor OU NÃO existirem produto, exibir mensagem de erro
    if (!$stmtFornecedor->rowCount() > 0 || !$stmtProduto->rowCount() > 0) {
      $msg = "invalid IDs";
      $msgerror = "";
    } else {
      $situacao = $_POST['situação']; // Corrigido para 'situação'

      $querySitFornecedor = "SELECT Situacao FROM fornecedor WHERE IdFornecedor = :IdFornecedor";
      $stmtSitFornecedor = $conn->prepare($querySitFornecedor);
      $stmtSitFornecedor->bindParam(':IdFornecedor', $IdFornecedor);
      $stmtSitFornecedor->execute();

      $resultSitFornecedor = $stmtSitFornecedor->fetch(PDO::FETCH_ASSOC);
      $situacaoFornecedor = $resultSitFornecedor['Situacao'];

      if ($situacaoFornecedor === "inativo") {
        $msg = "invalid situacao";
        $msgerror = "";
      } else {
        $insert_query = "INSERT INTO pedido (IdFornecedor, IdProduto, Situacao) 
                                VALUES (:IdFornecedor, :IdProduto, :situacao)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bindParam(':IdFornecedor', $IdFornecedor);
        $insert_stmt->bindParam(':IdProduto', $IdProduto);
        $insert_stmt->bindParam(':situacao', $situacao);

        if ($insert_stmt->execute()) {
          $msg = "insert success";
          $msgerror = "";
        } else {
          $msg = "insert error";
          $msgerror = $conn->errorInfo()[2];
        }
      }
    }

    $conn = null;

    header("Location: tabelaPedido.php?msg={$msg}&msgerror={$msgerror}");
  } else {
    // Índices ausentes no array $_POST, lógica para lidar com isso
    $msg = "invalid IDs";
    $msgerror = "";
    header("Location: tabelaPedido.php?msg={$msg}&msgerror={$msgerror}");
  }
}

require("header.php");
?>

<link rel="stylesheet" href="assets\css\tabela.css">

<div class="container">

  <h2>Pedido</h2>
  <p>Cadastro de Pedido.</p>

  <div class="wrapper">
    <form method="post">
      <label for="IdFornecedor">&nbsp;IdFornecedor</label>
      <input type="text" name="IdFornecedor" id="IdFornecedor" class="form-control" required><br>
      <label for="IdProduto">&nbsp;IdProduto</label>
      <input type="text" name="IdProduto" id="IdProduto" class="form-control" required><br>
      <label for="situação">&nbsp;Situação</label>
      <select name="situação" id="situação" class="form-control" required>
        <option value="aprovado">Aprovado</option>
        <option value="cancelado">Cancelado</option>
        <option value="analisando">Analisando</option>
      </select><br>
      <div class="buttons-tabelas">
        <a href="tabelaPedido.php"><button type="button" class="btn btn-danger btn-tamanho">Cancelar</button></a>
        <input type="submit" name="enviar" value="Inserir" class="btn btn-primary btn-tamanho">
      </div>
    </form>
  </div>

</div>

<?php require("footer.php"); ?>