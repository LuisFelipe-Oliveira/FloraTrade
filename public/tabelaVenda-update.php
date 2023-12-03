<?php





  if(isset($_GET['id'])){

    if(isset($_POST['enviar'])){

      require('config/connect.php');

      $dataVenda = $_POST['DataVenda'];
      $total = preg_replace('/,/', '.', $_POST['Total']);
      $idUser = $_POST['users'];
      $idCliente = $_POST['clients'];

      $update_query = "UPDATE Venda SET DataVenda = :dv, Total = :total, IdUsuario = :iduser, IdCliente = :idcliente WHERE IdVenda = :id";

      $update_stmt = $conn->prepare($update_query);

      $update_stmt->bindParam(":dv", $dataVenda);
      $update_stmt->bindParam(":total", $total);
      $update_stmt->bindParam(":iduser", $idUser);
      $update_stmt->bindParam(":idcliente", $idCliente); // Corrigido para :idcliente
      $update_stmt->bindParam(":id", $_POST['idvenda']);
      $update_stmt->execute();

      if ($update_stmt->rowCount() > 0) {
        $msg = "update success";
        $msgerror = "";
      } else {
          $msg = "";
          $msgerror = $update_stmt->errorInfo()[2];
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
  
  

  function selectUsuario($conn){
    try {
      $query = "SELECT Nome,IdUsuario as Id FROM Usuario";
      $stmt_user = $conn->prepare($query);
      $stmt_user->execute();

      return $stmt_user->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        return null;
    }
  }

  function selectCliente( $conn){
    try {
      $query = "SELECT Nome,IdCliente as Id FROM cliente";
      $stmt_cliente = $conn->prepare($query);
      $stmt_cliente->execute();
      return $stmt_cliente->fetchAll(PDO::FETCH_ASSOC);
      
    } catch (PDOException $e) {
      echo "Erro: " . $e->getMessage();
      return null;
    }
  }

  require("header.php");
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
  <br>
  <div class="form-container">
    <form method="post">
        <input type="hidden" name="idvenda" value="<?=$data_venda['IdVenda']?>">

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
              <select name="users" id="users">
                <?php $users = selectUsuario($conn);
                    //print_r($users);
                  foreach($users as $user){
                ?>
                <option value="<?=$user['Id']?>" <?=$select = ($data_venda['IdUsuario'] == $user['Id']) ? "selected" : ""?>><?=$user['Nome']?></option>
                <?php 
                  } 
                ?>
              </select>
        </div>

        <div class="form-group">
            <label for="Cliente">Cliente:</label>
            <select name="clients" id="clients">
                <?php $clients = selectCliente($conn);
                  foreach($clients as $client){
                ?>
                <option value="<?=$client['Id']?>"<?=$select = ($data_venda['IdCliente'] == $client['Id']) ? "selected" : ""?>><?=$client['Nome']?></option>
                <?php 
                  } 
                ?>
              </select>
        </div>

        <div class="form-group">
            <button type="submit" name="enviar">Atualizar</button>
        </div>
    </form>
</div>
<br>
  
  <div class="buttons-tabelas">
    <a href="tabelaVenda.php"><button type="button" class="btn btn-danger btn-tamanho">Cancelar</button></a>
  </div>
</div>

<?php require("footer.php"); $conn = null;?>