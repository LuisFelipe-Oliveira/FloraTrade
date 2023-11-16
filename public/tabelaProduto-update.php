<?php
require_once("header.php");

if (isset($_GET['id'])) {
    $produtoId = $_GET['id'];

    if (isset($_POST['enviar'])) {
        $nome = $_POST['nome'];
        $preco = preg_replace('/[^0-9.]/', '', $_POST['preco']);
        $quantidade = $_POST['quantidade'];

        require_once('config/connect.php');

        $update_query = "UPDATE Produto SET Nome = :nome, Preco = :preco, Quantidade = :quantidade WHERE IdProduto = :id";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bindParam(':nome', $nome);
        $update_stmt->bindParam(':preco', $preco);
        $update_stmt->bindParam(':quantidade', $quantidade);
        $update_stmt->bindParam(':id', $produtoId);

        if ($update_stmt->execute()) {
            $msg = "update success";
            $msgerror = "";
        } else {
            $msg = "";
            $msgerror = $update_stmt->errorInfo()[2];
        }

        $conn = null;

        header("Location: tabelaProduto.php?msg={$msg}&msgerror={$msgerror}");
    } else {
        // Buscar informações atuais do produto
        require_once('config/connect.php');

        $select_query = "SELECT * FROM Produto WHERE IdProduto = :id";
        $select_stmt = $conn->prepare($select_query);
        $select_stmt->bindParam(':id', $produtoId);
        $select_stmt->execute();

        $produto = $select_stmt->fetch(PDO::FETCH_ASSOC);

        $conn = null;

        if (!$produto) {
            // Produto não encontrado
            header("Location: tabelaProduto.php?msg=&msgerror=produto não encontrado.");
        }
    }
} else {
    // ID do produto não fornecido na URL
    header("Location: tabelaProduto.php?msg=&msgerror=ID do produto não fornecido.");
}

?>

<link rel="stylesheet" href="assets\css\tabela.css" />



<div class="container">
    <h2>Produtos</h2>
    <p>Atualize as informações dos Produtos.</p>

    <div class="wrapper">
        <form method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $produto['Nome']; ?>"
                required><br>

            <label for="preco">Preço</label>
            <input type="number" name="preco" id="preco" class="form-control" value="<?php echo $produto['Preco']; ?>"
                min="0" step="0.01" required><br>

            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" class="form-control"
                value="<?php echo $produto['Quantidade']; ?>" required min="0" step="1"><br>

            <input type="submit" name="enviar" value="Atualizar" class="btn btn-primary w100">
            <a href="tabelaProduto.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
        </form>
    </div>
</div>


<?php
require_once("footer.php");
?>