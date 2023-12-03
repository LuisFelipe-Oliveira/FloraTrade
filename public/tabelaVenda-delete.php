<?php

  if(isset($_GET['id'])){

    if(isset($_POST['apagar'])){
      require('config/connect.php');
      
      $idVenda = $_POST['idVenda'];

      $delete_itemvenda_query = "DELETE FROM itemvenda Where IdVenda = :id";
      $delete_itemvenda_stmt = $conn->prepare($delete_itemvenda_query);
      $delete_itemvenda_stmt->bindParam(':id', $idVenda);
      $delete_itemvenda_stmt->execute();

      if ($delete_itemvenda_stmt->rowCount() > 0) {
        $delete_venda_query = "DELETE FROM venda WHERE IdVenda = :id";

        $delete_venda_stmt = $conn->prepare($delete_venda_query);
        $delete_venda_stmt->bindParam(":id", $idVenda);
        $delete_venda_stmt->execute();

        if($delete_venda_stmt->rowCount() > 0 ){
          $msg = "delete success";
          $msgerror = "";
        }
      } else {
          $msg = "";
          $msgerror = $delete_venda_stmt->errorInfo()[2];
      }
      $conn = null;

      header("Location: tabelaVenda.php?msg={$msg}&msgerror={$msgerror}");
    }
    else {

      require('config/connect.php');

      $idVenda = $_GET['id'];
      $venda_query = "SELECT * FROM Venda where idVenda = :id";
      $stmt_venda = $conn->prepare($venda_query);
      $stmt_venda->bindParam(":id", $idVenda, PDO::PARAM_STR);
      $stmt_venda->execute();

      if($stmt_venda->rowCount() > 0){
        $data_venda = $stmt_venda->fetch(PDO::FETCH_ASSOC);
      }
    }
  } 


  function selectUsuario($conn, $usuarioId){
    try {
      $query = "SELECT Nome FROM Usuario WHERE IdUsuario = :id";
      $stmt_user = $conn->prepare($query);
      $stmt_user->bindParam(":id", $usuarioId);
      $stmt_user->execute();

      return $stmt_user->fetchColumn();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        return null;
    }
  }

  function selectCliente( $conn, $clienteId ){
    try {
      $query = "SELECT Nome FROM cliente WHERE IdCliente = :id";
      $stmt_cliente = $conn->prepare($query);
      $stmt_cliente->bindParam(":id", $clienteId);
      $stmt_cliente->execute();

      return $stmt_cliente->fetchColumn();
    } catch (PDOException $e) {
      echo "Erro: " . $e->getMessage();
      return null;
    }
  }

  require("header.php");
?>

<link rel="stylesheet" href="assets\css\tabela.css"/>
<style>
  .dados-venda {
    display: flex;
    flex-wrap: wrap;
    background-color: #d4edda;
    padding: 10px;
    margin: 10px;
    border-radius: 5px;
  }
  .dados-venda label {
    width: 100%;
    margin-bottom: 5px;
  }
  .dados-venda label span {
    font-weight: bold;
    margin-right: 5px;
  }

</style>
    <div class="container">
  <h2>Informações da Venda</h2>
  <div class="dados-venda">
    <label><span>Id:</span><?=$data_venda['IdVenda']?></label>
    <label><span>Data de Venda:</span><?=$data_venda['DataVenda']?></label>
    <label><span>Total:</span>R$<?=number_format($data_venda['Total'], 2, ',', '.')?></label>
    <label><span>Usuário:</span><?=selectUsuario($conn, $data_venda['IdUsuario'])?></label>
    <label><span>Cliente:</span><?=selectCliente($conn,$data_venda['IdCliente'])?></label>
</div>

<br>
  
  <div class="buttons-tabelas">
    <form action="" method="post">
      <button type="submit" class="btn btn-danger btn-tamanho" name='apagar'>Deletar Registro</button>
      <input type="hidden" name="idVenda" value="<?=$data_venda['IdVenda']?>">
    </form>
    <a href="tabelaVenda.php"><button type="button" class="btn btn-primary btn-tamanho">Cancelar</button></a>
  </div>
</div>

<?php require("footer.php"); $conn = null;?>