<?php


require_once('config/connect.php');
// select * produtos
$sql_code_produto = "SELECT * FROM Produto ORDER BY Nome";
$stmt_produto = $conn->prepare($sql_code_produto);
$stmt_produto->execute();

$sql_code_cliente = "SELECT * FROM Cliente ORDER BY Nome";
$stmt_cliente = $conn->prepare($sql_code_cliente);
$stmt_cliente->execute();

$conn = null;

require_once("header.php");
?>

<link rel="stylesheet" href="assets\css\tabela.css" />


<body>
  <div class="container">
    <h2>Tela de Venda</h2>
    <p>Aqui serão registradas as vendas</p>
    <br>
<form method="post" action="tabelaVenda-carrinho.php">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="table-success" style="text-align:center">
                <th>Selecione um Cliente</th>
                <th>Não possui cadastro?</th>
            </tr>
            
        </thead>
        <tbody>
            <tr>
                <td>
                    <select class="form-control" id="selectCliente" onchange="atualizarInputHidden()" required>
                        <option value="" style='text-align:center' disabled selected hidden>Escolha um Cliente</option>
                        <?php
                        while ($data_cliente = $stmt_cliente->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option style='text-align:center' name='IdCliente' value='<?=$data_cliente['IdCliente']?>'><?=$data_cliente['Nome']?>
                              
                            </option required>"
                            <!-- //echo "<input type='hidden' name='idCliente' value='{$data_cliente['IdCliente']}'>"; -->
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td style="text-align:center" ><a href="cliente-insert.php"><button type="button" class="btn btn-primary">Cadastrar Cliente</button></a></td>
            </tr>
        </tbody>
    </table>

    <br>
    <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-success" style="text-align:center">
          <th scope="col" style="width: 5%;">Id</th>
          <th scope="col" style="width: 15%;">Produto</th>
          <th scope="col" style="width: 10%;">Preço</th>
          <th scope="col" style="width: 10%;">Estoque</th>
          <th scope="col" style="width: 10%;">Adicionar</th>
          <th scope="col" style="width: 10%;">Quantidade</th>
          <th scope="col" style="width: 10%;">Desconto</th>
          
        </tr>
      </thead>
      <tbody>
        
        <?php while ($data_produto = $stmt_produto->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td style="text-align:center"><?=$data_produto['IdProduto']?></td>
            <td style="text-align:center"><?=$data_produto['Nome']?></td>
            <td style="text-align:center">R$ <?=number_format($data_produto['Preco'], 2, ',', '.')?></td>
            <td style="text-align:center"><?=$data_produto['Quantidade']?></td>
            <td style="text-align:center">
                <input class="form-check-input add" id="add" type="checkbox" name="produtosSelecionados[]" value="<?=$data_produto['IdProduto']?>" style="height: 20px; width: 20px;">
                <input type="hidden" name="quantidade_<?=$data_produto['IdProduto']?>" value="">
                <input type="hidden" name="preco_<?=$data_produto['IdProduto']?>" value="<?=$data_produto['Preco']?>">
            </td>
            <td style="text-align:center">
                <input type="number" min="1" max="<?=$data_produto["Quantidade"]?>" class="form-control quantidade" id="quantidade_<?=$data_produto['IdProduto']?>" name="quantidade_<?=$data_produto['IdProduto']?>" value="">
            </td>
            <td>
            <input type="text" class="form-control desconto" id="desconto_<?=$data_produto['IdProduto']?>" name="desconto_<?=$data_produto['IdProduto']?>" value="">
            </td>
        </tr>
        <?php } ?>

      </tbody>
    </table>
    <br>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="table-success" style="text-align:center">
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <td style="text-align:center">
                <div class="text-right">
                <a href="tabelaVenda.php"><input type="button" class="btn btn-danger btn-tamanho" value="Cancelar Compra"></a>
                    <button class="btn btn-success" type="submit" name="enviar">Ir para o Carrinho</button>
                </div>
            </td>
        </tbody>
    </table>

    <input type="hidden" name="idUsuario" value="<?=$_SESSION['loggedin']?>">
    <input type="hidden" name="idCliente" id="idClienteInput" value="">
    
</form>  
</div>
<script>
/* document.addEventListener('DOMContentLoaded', function () {
    function configurarEventos(checkbox, quantidadeInput, descontoInput) {
        checkbox.addEventListener('change', function () {
            quantidadeInput.disabled = !checkbox.checked;
            descontoInput.disabled = !checkbox.checked;
        });
    }
}); */
</script>
<script src="assets/js/carrinho.js">
    /* configurarEventos(checkbox, quantidadeInput, descontoInput); */
</script>
</body>

<?php
require_once("footer.php");
?>