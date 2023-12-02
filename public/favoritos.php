<?php 

require("header.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  echo '<script>window.location.href = "login.php"</script>';
  exit;
}

require('config/connect.php');

$sql_code = "SELECT * FROM Produto WHERE favorito = 'S' ORDER BY IdProduto";
$sql_query_produto = $conn->query($sql_code)->fetchAll(PDO::FETCH_ASSOC);

$sql_code = "SELECT * FROM Cliente WHERE favorito = 'S' ORDER BY IdCliente";
$sql_query_cliente = $conn->query($sql_code)->fetchAll(PDO::FETCH_ASSOC);

$sql_code = "SELECT * FROM Fornecedor WHERE favorito = 'S' ORDER BY IdFornecedor";
$sql_query_fornecedor = $conn->query($sql_code)->fetchAll(PDO::FETCH_ASSOC);

$sql_code = "SELECT * FROM Pedido WHERE favorito = 'S' ORDER BY IdPedido";
$sql_query_pedido = $conn->query($sql_code)->fetchAll(PDO::FETCH_ASSOC);

$sql_code = "SELECT * FROM Venda WHERE favorito = 'S' ORDER BY IdVenda";
$sql_query_venda = $conn->query($sql_code)->fetchAll(PDO::FETCH_ASSOC);

function formatarCPF($cpf) {
    $parte1 = substr($cpf, 0, 3);
    $parte2 = substr($cpf, 3, 3);
    $parte3 = substr($cpf, 6, 3);
    $parte4 = substr($cpf, 9, 2);

    return "$parte1.$parte2.$parte3-$parte4";
}

function formatarTel($tel) {
    $parte1 = substr($tel, 0, 2);
    $parte2 = substr($tel, 3, 5);
    $parte3 = substr($tel, 8, 4);

    return "($parte1) $parte2-$parte3";
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
?>

<link rel="stylesheet" href="assets\css\tabela.css" />

<body>

<div class="container">
<h1>Favoritos</h1>
<p>Bem vindo a sua aba de favoritos!</p>
</div>

<div class="container">

    <h2>Produtos</h2>
    <p>Listagem de produtos favoritos.</p>

    <hr>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="table-success" style="text-align:center">
                <th scope="col" style="width: 5%;">Id</th>
                <th scope="col">Nome</th>
                <th scope="col" style="width: 30%;">Preço</th>
                <th scope="col" style="width: 15%;">Quantidade</th>
                <th scope="col" style="width: 8%;">Remover</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (count($sql_query_produto) > 0) {
                    foreach($sql_query_produto as $data) { ?> 
                    <tr>
                        <th scope="row" style="text-align:center">
                            <?php echo $data['IdProduto']; ?>
                        </th>
                        <td>
                            <?php echo $data['Nome']; ?>
                        </td>
                        <td scope="row" style="text-align:center">
                            R$
                            <?php echo number_format($data['Preco'], 2, ',', '.'); ?>
                        </td>
                        <td scope="row" style="text-align:center">
                            <?php echo $data['Quantidade']; ?>
                        </td>
                        <td scope="row" style="text-align:center">
                            <form action="produto-remove-favorite.php" method="post">
                            <input type="hidden" name="id_produto" value="<?php echo $data['IdProduto']; ?>">
                            <button type="submit" class="btn btn-danger" name="favorito">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 24 24">
                                <style>
                                    svg {
                                    fill: #ffffff;
                                    }
                                </style>
                                <path d="M12 2L15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                </svg>
                            </button>
                            </form>
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>

<div class="container">
  <h2>Clientes</h2>
  <p>Listagem de clientes favoritos.</p>
  <hr>

  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-success" style="text-align:center">
        <th scope="col" style="width: 5%;">#</th>
        <th scope="col">Nome</th>
        <th scope="col" style="width: 20%;">CPF</th>
        <th scope="col" style="width: 20%;">Telefone</th>
        <th scope="col" style="width: 20%;">Email</th>
        <th scope="col" style="width: 8%;">Remover</th>
      </tr>
    </thead>
    <tbody>
    <?php
      if (count($sql_query_cliente) > 0) {
        foreach($sql_query_cliente as $data) { ?>  
      <tr> 
        <th scope="row" style="text-align:center"><?=$data['IdCliente']?></th>
        <td style="text-align:center"><?=$data['Nome']?></td> 
        <td style="text-align:center" ><?=formatarCPF($data['CPF'])?></td> 
        <td style="text-align:center"><?=formatarTel($data['Telefone'])?></td>
        <td style="text-align:center"><?=$data['Email']?></td>
        <td scope="row" style="text-align:center">
            <form action="cliente-remove-favorite.php" method="post">
            <input type="hidden" name="id_cliente" value="<?php echo $data['IdCliente']; ?>">
            <button type="submit" class="btn btn-danger" name="favorito">
                <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 24 24">
                <style>
                    svg {
                    fill: #ffffff;
                    }
                </style>
                <path d="M12 2L15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                </svg>
            </button>
            </form>
        </td>
      </tr> 
      <?php } }?>       
    </tbody>
  </table>
</div>

<div class="container">
  <h2>Fornecedores</h2>
  <p>Listagem de fornecedores favoritos.</p>

  <hr>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-success" style="text-align:center">
        <th scope="col" style="width: 5%;">#</th>
        <th scope="col">Nome</th>
        <th scope="col" style="width: 20%;">CNPJ</th>
        <th scope="col" style="width: 20%;">Data Cadastro</th>
        <th scope="col" style="width: 20%;">Situação</th>
        <th scope="col" style="width: 8%;">Remover</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if (count($sql_query_fornecedor) > 0) {
            foreach($sql_query_fornecedor as $data) { ?> 
            <tr> 
                <th scope="row" style="text-align:center"><?php echo $data['IdFornecedor']; ?></th>
                <td scope="row" style="text-align:center"><?php echo $data['NomeFornecedor']; ?></td> 
                <td scope="row" style="text-align:center"><?php echo $data['CNPJ']; ?></td> 
                <td scope="row" style="text-align:center"><?php echo date('d/m/Y', strtotime($data['DataCadastro'])); ?></td>
                <td scope="row" style="text-align:center"><?php echo $data['Situacao']; ?></td>
                <td scope="row" style="text-align:center">
                    <form action="fornecedor-remove-favorite.php" method="post">
                    <input type="hidden" name="id_fornecedor" value="<?php echo $data['IdFornecedor']; ?>">
                    <button type="submit" class="btn btn-danger" name="favorito">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 24 24">
                        <style>
                            svg {
                            fill: #ffffff;
                            }
                        </style>
                        <path d="M12 2L15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                        </svg>
                    </button>
                    </form>
                </td>
            </tr> 
            <?php } 
      }?>       
    </tbody>
  </table>
</div>

<div class="container">
        <h2>Pedidos</h2>
        <p>Listagem de pedidos favoritos.</p>

        <hr>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr class="table-success" style="text-align:center">
                    <th scope="col" style="width: 5%;">#</th>
                    <th scope="col">IdProduto</th>
                    <th scope="col" style="width: 20%;">IdFornecedor</th>
                    <th scope="col" style="width: 20%;">Data de entrega</th>
                    <th scope="col" style="width: 20%;">Situação</th>
                    <th scope="col" style="width: 8%;">Remover</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($sql_query_pedido) > 0) {
                    foreach($sql_query_pedido as $data) { ?> 
                        <tr>
                            <th scope="row" style="text-align:center">
                                <?php echo $data['IdPedido']; ?>
                            </th>
                            <td scope="row" style="text-align:center">
                                <?php echo $data['IdProduto']; ?>
                            </td>
                            <td scope="row" style="text-align:center">
                                <?php echo $data['IdFornecedor']; ?>
                            </td>
                            <td scope="row" style="text-align:center">
                                <?php echo date('d/m/Y', strtotime($data['DataEntrega'])); ?>
                            </td>
                            <td scope="row" style="text-align:center">
                                <?php echo $data['Situacao']; ?>
                            </td>
                            <td scope="row" style="text-align:center">
                                <form action="pedido-remove-favorite.php" method="post">
                                    <input type="hidden" name="id_pedido" value="<?php echo $data['IdPedido']; ?>">
                                    <button type="submit" class="btn btn-danger" name="favorito">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 24 24">
                                        <style>
                                            svg {
                                            fill: #ffffff;
                                            }
                                        </style>
                                        <path d="M12 2L15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
    </div>

<div class="container">
  <h2>Vendas</h2>
  <p>Listagem de vendas favoritas.</p>
  <hr>
  
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-success" style="text-align:center">
        <th scope="col" style="width: 5%;">#</th>
        <th scope="col" style="width: 10%;">Data de Venda</th>
        <th scope="col" style="width: 10%;">Total</th>
        <th scope="col" style="width: 10%;">Usuário</th>
        <th scope="col" style="width: 10%;">Cliente</th>
        <th scope="col" style="width: 8%;">Remover</th>
      </tr>
    </thead>
    <tbody>
    <?php
      if (count($sql_query_venda) > 0) {
        foreach($sql_query_venda as $data) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?=$data['IdVenda']?></th>
        <td style="text-align:center"><?=$data['DataVenda']?></td> 
        <td style="text-align:center">R$<?=number_format($data['Total'], 2, ',', '.')?></td> 
        <td style="text-align:center"><?=selectUsuario($conn, $data['IdUsuario'])?></td>
        <td style="text-align:center"><?=selectCliente($conn, $data['IdCliente'])?></td> 
        <td scope="row" style="text-align:center">
            <form action="venda-remove-favorite.php" method="post">
                <input type="hidden" name="id_venda" value="<?php echo $data['IdVenda']; ?>">
                <button type="submit" class="btn btn-danger" name="favorito">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 24 24">
                    <style>
                        svg {
                        fill: #ffffff;
                        }
                    </style>
                    <path d="M12 2L15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                    </svg>
                </button>
            </form>
        </td>
      </tr> 
      <?php } }?>  
    </tbody>
  </table>
</div>

</body>

<?php require("footer.php"); 
$conn = null;?>