<?php


require_once('config/connect.php');
// select * produtos
$sql_code_produto = "SELECT * FROM Produto ORDER BY Nome";
$stmt_produto = $conn->prepare($sql_code_produto);
$stmt_produto->execute();
/*

$sql_code_cliente = "SELECT * FROM Cliente ORDER BY Nome";
$stmt_cliente = $conn->prepare($sql_code_cliente);
$stmt_cliente->execute(); */

if(isset($_POST['enviar'])){

    //print_r($_POST);die;
    $idUsuario = $_POST['idUsuario'];
    $idCliente = $_POST['idCliente'];
    $total = 0; // Você pode calcular o total ao iterar pelos itens do carrinho

    $sql_usuario = "SELECT Nome FROM Usuario WHERE IdUsuario = :idUsuario";
    $stmt_usuario = $conn->prepare($sql_usuario);
    $stmt_usuario->bindParam(':idUsuario', $idUsuario);
    $stmt_usuario->execute();
    $usuario = $stmt_usuario->fetchColumn();

    // Consulta para obter o nome do cliente
    $sql_cliente = "SELECT Nome FROM Cliente WHERE IdCliente = :idCliente";
    $stmt_cliente = $conn->prepare($sql_cliente);
    $stmt_cliente->bindParam(':idCliente', $idCliente);
    $stmt_cliente->execute();
    $cliente = $stmt_cliente->fetchColumn();
}

if(isset($_POST['inserir'])){

    $stms_produto_get = $conn->prepare("SELECT * FROM Produto");
    if($stms_produto_get->execute()){
        $data_produto = $stms_produto_get->fetch(PDO::FETCH_ASSOC);
    }
    
    $dataAtual = new DateTime();
    $dataFormatada = $dataAtual->format('Y-m-d');

    $insert_venda = "INSERT INTO VENDA (DataVenda, Total, IdUsuario, IdCliente) 
                        VALUES (:dataV, :total, :iduser, :idclient)";
    
    $stmt_venda = $conn->prepare($insert_venda);
    $stmt_venda->bindParam(':dataV',$dataFormatada);
    $stmt_venda->bindParam(':total',$_POST['total']);
    $stmt_venda->bindParam(':iduser',$_POST['idUsuario']);
    $stmt_venda->bindParam(':idclient',$_POST['idCliente']);

    $stmt_venda->execute();

    
    if($stmt_venda->rowCount() > 0){
        $vendaId = $conn->lastInsertId();

        foreach($_POST['itensCarrinho'] as $key => $item){
            $stmt_itemVenda = "INSERT INTO ItemVenda (Quantidade, ValorUnitario, Desconto, IdProduto, IdVenda)
                                    VALUES (:qtde, :valorun, :desconto, :idProduto, :idVenda)";
            $stmt_itemVenda = $conn->prepare($stmt_itemVenda);
            $stmt_itemVenda->bindParam(":qtde",$item['quantidade']);
            $stmt_itemVenda->bindParam(':valorun',$item['preco']);
            $stmt_itemVenda->bindParam(':desconto',$item['desconto']);
            $stmt_itemVenda->bindParam(':idProduto',$key);
            $stmt_itemVenda->bindParam(':idVenda',$vendaId);

            $stmt_itemVenda->execute();

            if($stmt_itemVenda->rowCount() > 0){
                $newqtde = $data_produto['Quantidade'] - $item['quantidade'];

                $sql = "UPDATE Produto SET Quantidade = :newqtde WHERE IdProduto = :idproduto";
                $stmt_save_produto = $conn->prepare($sql);
                $stmt_save_produto->bindParam(":newqtde",$newqtde);
                $stmt_save_produto->bindParam(":idproduto",$key);

                if( $stmt_save_produto->execute()){
                    $msg = "insert success";
                    $msgerror = "";
                } else {
                    $msg = "insert error";
                    $msgerror = $conn->errorInfo()[2];
                }

                $msg = "insert success";
                $msgerror = "";
            } else {
                $msg = "insert error";
                $msgerror = $conn->errorInfo()[2];
            }
        }
        
        $msg = "insert success";
        $msgerror = "";
    } else {
        $msg = "insert error";
        $msgerror = $conn->errorInfo()[2];
    }
    
    header("Location: tabelaVenda.php?msg={$msg}&msgerror={$msgerror}");

    
}

require_once("header.php");

?>

<link rel="stylesheet" href="assets\css\tabela.css" />



<body>
  <div class="container">
    <h2>Tela de Venda</h2>
    <p>Aqui será registrada a venda</p>
    <br>
<form method="post">
    <h4>Carrinho</h4>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr class="table-success" style="text-align:center">
                <th>Produto</th>
                <th>Valor Unitário</th>
                <th>Quantidade</th>
                <th>Desconto</th>
                <th>Sub Total</th>
                <th>Ação</th>
                </tr>
            </thead>
            <tbody id="carrinho">
                <?php
                    foreach ($_POST['produtosSelecionados'] as $produtoId) {
                        $quantidade = $_POST["quantidade_$produtoId"];
                        $preco = $_POST["preco_$produtoId"];
                        $desconto = $_POST["desconto_$produtoId"] != "" ? $_POST["desconto_$produtoId"] : 0;

                        $subtotal = ($quantidade * $preco) - $desconto;
                        
                        $sql_produto = "SELECT Nome FROM Produto WHERE IdProduto = :produtoId";
                        $stmt_produto = $conn->prepare($sql_produto);
                        $stmt_produto->bindParam(':produtoId', $produtoId);
                        $stmt_produto->execute();
                        $nomeProduto = $stmt_produto->fetchColumn();
                    
                        echo "<tr style='text-align:center'><td>$nomeProduto</td><td>R$". number_format($preco, 2, ',', '.') . "</td><td>$quantidade</td><td>R$". number_format($desconto, 2, ',', '.') ."</td><td>R$" . number_format($subtotal, 2, ',', '.'). "</td><td>Ação</td></tr>";
                
                        $total += $subtotal;
                    }
                ?>
            </tbody>
        </table>
        <h3>Informações da Venda</h3>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr class="table-success" style="text-align:center">
                    <th>Usuario</th>
                    <th>Cliente</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody >
                <?php
                    echo "<tr style='text-align:center'><td>$usuario</td><td>$cliente</td><td>R$" . number_format($total, 2, ',', '.') ."</td></tr>";
                ?>
            </tbody>   
        </table>
    <br>

    <br>
    <!-- Carrinho -->
    
    <br>
</form>

<form method="post">
    <input type="hidden" name="idUsuario" value="<?=$_SESSION['loggedin']?>">
    <input type="hidden" name="total" id="totalInput" value="<?=$total?>"> <!-- Inclua o total da venda -->
    <input type="hidden" name="idCliente" id="idClienteInput" value="<?=$idCliente?>"> <!-- Inclua o ID do cliente -->

    <?php
        foreach ($_POST['produtosSelecionados'] as $produtoId) {
            $quantidade = $_POST["quantidade_$produtoId"];
            $preco = $_POST["preco_$produtoId"];
            $desconto = $_POST["desconto_$produtoId"] != "" ? $_POST["desconto_$produtoId"] : 0;

            echo "
                <input type='hidden' name='itensCarrinho[$produtoId][quantidade]' value='$quantidade'>
                <input type='hidden' name='itensCarrinho[$produtoId][preco]' value='$preco'>
                <input type='hidden' name='itensCarrinho[$produtoId][desconto]' value='$desconto'>
            ";
        }
    ?>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="table-success" style="text-align:center">
                <th>Ação</th>

            </tr>
        </thead>
        <tbody>
            <td style="text-align:center">
                <div class="text-right">
                    <a href="tabelaVenda.php"><button class="btn btn-danger" >Cancelar Compra</button></a>
                    <a href="tabelaVenda-compra.php"><input type="button" class="btn btn-warning btn-tamanho" value="Retornar"></a>
                    <button class="btn btn-success" type="submit" name="inserir">Finalizar</button>
                    
                </div>
            </td>
        </tbody>
    </table>
</form>


  </div>
</body>


<?php
$conn = null;
require_once("footer.php");
?>