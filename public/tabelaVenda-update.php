<?php

require("header.php");

require('config/connect.php');

  if(isset($_GET['id'])){
    $row = "";
    $idVenda = $_GET['id'];
    $venda_query = "SELECT * FROM Venda where idVenda = :id";
    $stmt_venda = $conn->prepare($venda_query);
    $stmt_venda->bindParam(":id", $idVenda, PDO::PARAM_STR);
    $stmt_venda->execute();

    if($stmt_venda->rowCount() > 0){
      $data_venda = $stmt_venda->fetch(PDO::FETCH_ASSOC);
    }

    $mysql_query = "SELECT * FROM itemvenda WHERE idVenda = :id";
    $stmt_itemVenda = $conn->prepare($mysql_query);
    $stmt_itemVenda->bindParam(":id", $idVenda, PDO::PARAM_STR);
    $stmt_itemVenda->execute();

    if($stmt_itemVenda->rowCount() > 0){
      $data_itemVenda = $stmt_itemVenda->fetchAll(PDO::FETCH_ASSOC);
      //print_r($data_itemVenda);
    } else {
      $row = "<tr>
                <td colspan='7'>Nenhum item venda cadastrado.</td>
              </tr>";

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

  function selectProduto($conn, $prodId){
    try {
      $query = "SELECT Nome FROM Produto WHERE IdProduto = :id";
      $stmt_cliente = $conn->prepare($query);
      $stmt_cliente->bindParam(":id", $prodId);
      $stmt_cliente->execute();

      return $stmt_cliente->fetchColumn();
    } catch (PDOException $e) {
      echo "Erro: " . $e->getMessage();
      return null;
    }
  }

?>

<link rel="stylesheet" href="assets\css\tabela.css"/>
<style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #d4edda; /* Cor verde da classe table-success */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            padding: 10px;
            background-color: #28a745; /* Cor verde do Bootstrap */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
<div class="container">
  <h2>Informações da Venda <label for="IdVenda">#<?=$data_venda['IdVenda']?></label></h2>

  <div class="form-container">
    <form method="post" action="processar_atualizacao.php">
        

        <div class="form-group">
            <label for="DataVenda">Data de Venda:</label>
            <input type="text" id="DataVenda" name="DataVenda" value="<?=$data_venda['DataVenda']?>">
        </div>

        <div class="form-group">
            <label for="Total">Total:</label>
            <input type="text" id="Total" name="Total" value="<?=number_format($data_venda['Total'], 2, ',', '.')?>">
        </div>

        <div class="form-group">
            <label for="Usuario">Usuário:</label>
            <input type="text" name="usuario" id="usuario" value=<?=selectUsuario($conn, $data_venda['IdUsuario'])?> >
        </div>

        <div class="form-group">
            <label for="Cliente">Cliente:</label>
            <input type="text" name="cliente" id="cliente" value="<?=selectCliente($conn, $data_venda['IdCliente'])?>">
        </div>

        <div class="form-group">
            <button type="submit">Atualizar</button>
        </div>
    </form>
</div>
<br>
  
  <div class="buttons-tabelas">
    <a href="tabelaVenda.php"><button type="button" class="btn btn-success btn-tamanho">Retornar</button></a>
  </div>
</div>

<?php require("footer.php"); $conn = null;?>