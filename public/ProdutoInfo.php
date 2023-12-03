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

    $conn = null;

    if (!$produto) {
        // Produto não encontrado
        header("Location: tabelaProduto.php?msg=&msgerror=produto não encontrado.");
    }
}

require_once("header.php");
?>
<link rel="stylesheet" href="assets\css\tabela.css" />

<body>

    <div class="container">

        <h2>Produto</h2>

        <div class="wrapper">

            <p for="nome">Nome
                <?php echo $produto['Nome']; ?>
            </p>

            <p for="preco">Preço
                <?php echo $produto['Preco']; ?>
            </p>

            <p for="quantidade">Quantidade
                <?php echo $produto['Quantidade']; ?>
            </p>

        </div>

    </div>
</body>

<?php

require_once("footer.php");
?>