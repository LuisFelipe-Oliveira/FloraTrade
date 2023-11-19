<?php

if (isset($_GET['id'])) {
  $IdPedido = $_GET['id'];

  if (isset($_POST['enviar'])) {

    if (!isset($_POST['IdProduto'])) {
      $msg = "invalid IDs";
      $msgerror = "";
    } else {
      $IdProduto = $_POST['IdProduto'];
      $situacao = $_POST['situacao'];
      require_once('config/connect.php');

      $update_query = "UPDATE pedido SET IdProduto = :IdProduto, Situacao = :situacao WHERE IdPedido = :id";
      $update_stmt = $conn->prepare($update_query);
      $update_stmt->bindParam(':IdProduto', $IdProduto);
      $update_stmt->bindParam(':situacao', $situacao);
      $update_stmt->bindParam(':id', $IdPedido);

      if ($update_stmt->execute()) {
        $msg = "update success";
        $msgerror = "";
      } else {
        $msg = "update error";
        $msgerror = $update_stmt->errorInfo()[2];
      }
    }

    $conn = null;

    header("Location: tabelaPedido.php?msg={$msg}&msgerror={$msgerror}");
  } else {
    // Buscar informações atuais do fornecedor
    require_once('config/connect.php');

    $select_query = "SELECT * FROM pedido WHERE IdPedido = :id";
    $select_stmt = $conn->prepare($select_query);
    $select_stmt->bindParam(':id', $IdPedido);
    $select_stmt->execute();

    $pedido = $select_stmt->fetch(PDO::FETCH_ASSOC);

    $conn = null;

    if (!$pedido) {
      // Fornecedor não encontrado
      header("Location: tabelaPedido.php?msg=&msgerror=Fornecedor não encontrado.");
    }
  }
} else {
  // ID do fornecedor não fornecido na URL
  header("Location: tabelaPedido.php?msg=&msgerror=ID do fornecedor não fornecido.");
}

require("header.php");
?>

<link rel="stylesheet" href="assets\css\tabela.css" />

<div class="container">
  <h2>Pedidos</h2>
  <p>Atualize as informações do pedido.</p>

  <div class="wrapper">
    <form method="post">

      <label for="IdProduto">IdProduto</label>
      <input type="text" name="IdProduto" id="IdProduto" class="form-control"
        value="<?php echo $pedido['IdProduto']; ?>" required><br>

      <label for="situacao">Situação</label>
      <input type="text" name="situacao" id="situacao" class="form-control" value="<?php echo $pedido['Situacao']; ?>"
        required><br>

      <div class="buttons-tabelas">
        <a href="tabelaPedido.php"><button type="button" class="btn btn-danger btn-tamanho">Cancelar</button></a>
        <input type="submit" name="enviar" value="Atualizar" class="btn btn-primary btn-tamanho">
      </div>
    </form>
  </div>
</div>

<?php require("footer.php"); ?>