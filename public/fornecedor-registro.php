<?php
require_once("header.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  echo '<script>window.location.href = "login.php"</script>';
  exit;
}

require_once('config/connect.php');

if (isset($_GET['id'])) {
    $IdFornecedor = $_GET['id'];

    // Buscar informações atuais do produto
    $select_query = "SELECT * FROM Fornecedor WHERE IdFornecedor = :id";
    $select_stmt = $conn->prepare($select_query);
    $select_stmt->bindParam(':id', $IdFornecedor);
    $select_stmt->execute();

    $fornecedor = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$fornecedor) {
        header("Location: fornecedor.php?msg=&msgerror=fornecedor não encontrado.");
    }
}


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
    <h2>Informações do fornecedor</h2>

    <div class="dados-venda">
        <label><span>Id:</span>
            <?php echo $fornecedor['IdFornecedor']; ?>
        </label>
        <label><span>Nome:</span>
            <?php echo $fornecedor['NomeFornecedor']; ?>
        </label>
        <label><span>Data de cadastro: </span>
            <?php echo $fornecedor['DataCadastro']; ?>
        </label>
        <label><span>Situação:</span>
            <?php echo $fornecedor['Situacao']; ?>
        </label>
        <label><span>CNPJ:</span>
            <?php echo $fornecedor['CNPJ']; ?>
        </label>
    </div>

    <br>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="table-success" style="text-align:center">
                <th scope="col" style="width: 5%;">Id</th>
                <th scope="col">Nome</th>
                <th scope="col" style="width: 15%;">Data de cadastro</th>
                <th scope="col" style="width: 15%;">Situação</th>
                <th scope="col" style="width: 15%;">CNPJ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row" style="text-align:center">
                    <?php echo $fornecedor['IdFornecedor']; ?>
                </th>
                <td scope="row" style="text-align:center">
                    <?php echo $fornecedor['NomeFornecedor']; ?>
                </td>
                <td scope="row" style="text-align:center">
                  <?php echo $fornecedor['DataCadastro']; ?>
                </td>
                <td scope="row" style="text-align:center">
                    <?php echo $fornecedor['Situacao']; ?>
                </td>
                <td scope="row" style="text-align:center">
                    <?php echo $fornecedor['CNPJ']; ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="buttons-tabelas">
        <a href="fornecedor.php"><button type="button" class="btn btn-success btn-tamanho">Retornar</button></a>
    </div>
    <form action="fornecedor-favorite.php" method="post" style="display: flex; justify-content: end;">
        <input type="hidden" name="id_fornecedor" value="<?php echo $fornecedor['IdFornecedor']; ?>">
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