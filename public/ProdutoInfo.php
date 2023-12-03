<?php

require_once('config/connect.php');

if (isset($_GET['id'])) {
    $produtoId = $_GET['id'];

    // Buscar informações atuais do produto
    $select_query = "SELECT * FROM Produto WHERE IdProduto = :id";
    $select_stmt = $conn->prepare($select_query);
    $select_stmt->bindParam(':id', $produtoId);
    $select_stmt->execute();

    $produto = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        // Produto não encontrado
        header("Location: tabelaProduto.php?msg=&msgerror=produto não encontrado.");
    }
}

require_once("header.php");
?>

</body>

<style>
    .dados-venda {
        display: flex;
        flex-wrap: wrap;
        background-color: #d4edda;
        /* Cor verde da classe table-success */
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

<link rel="stylesheet" href="assets\css\tabela.css" />
<div class="container">
    <h2>Informações do produto</h2>

    <div class="dados-venda">
        <label><span>Id:</span>
            <?php echo $produto['IdProduto']; ?>
        </label>
        <label><span>Nome:</span>
            <?php echo $produto['Nome']; ?>
        </label>
        <label><span>Preço: </span>R$
            <?php echo $produto['Preco']; ?>
        </label>
        <label><span>Quantidade:</span>
            <?php echo $produto['Quantidade']; ?>
        </label>
    </div>

    <br>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="table-success" style="text-align:center">
                <th scope="col" style="width: 5%;">Id</th>
                <th scope="col">Nome</th>
                <th scope="col" style="width: 30%;">Preço</th>
                <th scope="col" style="width: 15%;">Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row" style="text-align:center">
                    <?php echo $produto['IdProduto']; ?>
                </th>
                <td>
                    <?php echo $produto['Nome']; ?>
                </td>
                <td>
                    R$
                    <?php echo number_format($produto['Preco'], 2, ',', '.'); ?>
                </td>
                <td scope="row" style="text-align:center">
                    <?php echo $produto['Quantidade']; ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="buttons-tabelas">
        <a href="tabelaProduto.php"><button type="button" class="btn btn-success btn-tamanho">Retornar</button></a>
    </div>
    <form action="produto-favorite.php" method="post" style="display: flex; justify-content: end;">
        <input type="hidden" name="id_produto" value="<?php echo $produto['IdProduto']; ?>">
        <button type="submit" class="btn btn-warning" style="margin-top: 5px;" name="favorito">
            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 24 24">
                <style>
                    svg {
                        fill: #ffffff;
                    }
                </style>
                <path
                    d="M12 2L15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
            </svg>
        </button>
    </form>
    <br>
</div>

<?php require("footer.php"); ?>