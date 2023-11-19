<?php

if (isset($_GET['id'])) {
    $fornecedorId = $_GET['id'];

    if (isset($_POST['enviar'])) {
        $nome = $_POST['nome'];
        $cnpj = preg_replace('/[^0-9]/', '', $_POST['cnpj']);
        $situacao = $_POST['situacao'];
        if(strlen($cnpj) !== 14) {
            $msg = "invalid cnpj";
            $msgerror = "";
        } else {
            require_once('config/connect.php');

            $update_query = "UPDATE fornecedor SET NomeFornecedor = :nome, CNPJ = :cnpj, Situacao = :situacao WHERE IdFornecedor = :id";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bindParam(':nome', $nome);
            $update_stmt->bindParam(':cnpj', $cnpj);
            $update_stmt->bindParam(':situacao', $situacao);
            $update_stmt->bindParam(':id', $fornecedorId);

            if ($update_stmt->execute()) {
                $msg = "update success";
                $msgerror = "";
            } else {
                $msg = "update error";
                $msgerror = $update_stmt->errorInfo()[2];
            }
        }
        
        $conn = null;

        header("Location: fornecedor.php?msg={$msg}&msgerror={$msgerror}");
    } else {
        // Buscar informações atuais do fornecedor
        require_once('config/connect.php');

        $select_query = "SELECT * FROM fornecedor WHERE IdFornecedor = :id";
        $select_stmt = $conn->prepare($select_query);
        $select_stmt->bindParam(':id', $fornecedorId);
        $select_stmt->execute();

        $fornecedor = $select_stmt->fetch(PDO::FETCH_ASSOC);

        $conn = null;

        if (!$fornecedor) {
            // Fornecedor não encontrado
            header("Location: fornecedor.php?msg=&msgerror=Fornecedor não encontrado.");
        }
    }
} else {
    // ID do fornecedor não fornecido na URL
    header("Location: fornecedor.php?msg=&msgerror=ID do fornecedor não fornecido.");
}

require("header.php");
?>

<link rel="stylesheet" href="assets\css\tabela.css" />

<div class="container">
    <h2>Fornecedores</h2>
    <p>Atualize as informações do fornecedor.</p>

    <div class="wrapper">
        <form method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $fornecedor['NomeFornecedor']; ?>" required><br>

            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" id="cnpj" class="form-control" value="<?php echo $fornecedor['CNPJ']; ?>" required><br>

            <label for="situacao">Situação</label>
            <select name="situacao" id="situacao" class="form-control" required>
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select><br>

            <div class="buttons-tabelas">
                <a href="fornecedor.php"><button type="button"
                    class="btn btn-danger btn-tamanho">Cancelar</button></a>
                <input type="submit" name="enviar" value="Atualizar" class="btn btn-primary btn-tamanho">
            </div>
        </form>
    </div>
</div>

<?php require("footer.php"); ?>