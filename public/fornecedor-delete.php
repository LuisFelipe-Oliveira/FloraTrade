<?php
require("header.php");

// Certifique-se de que o ID do fornecedor foi fornecido
if (isset($_GET['id'])) {
    $fornecedorId = $_GET['id'];

    require_once('config/connect.php');

    // Verifique se o fornecedor existe antes de exibir o formulário de exclusão
    $check_query = "SELECT * FROM fornecedor WHERE IdFornecedor = :id";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bindParam(':id', $fornecedorId);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        // O fornecedor existe, obtenha os detalhes
        $fornecedorDetailsQuery = "SELECT * FROM fornecedor WHERE IdFornecedor = :id";
        $fornecedorDetailsStmt = $conn->prepare($fornecedorDetailsQuery);
        $fornecedorDetailsStmt->bindParam(':id', $fornecedorId);
        $fornecedorDetailsStmt->execute();
        $fornecedorDetails = $fornecedorDetailsStmt->fetch(PDO::FETCH_ASSOC);

        // Processar o formulário de exclusão
        if (isset($_POST['enviar'])) {
            $delete_query = "DELETE FROM fornecedor WHERE IdFornecedor = :id";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bindParam(':id', $fornecedorId);

            if ($delete_stmt->execute()) {
                $msg = "delete success";
                $msgerror = "";
                header("Location: fornecedor.php?msg={$msg}&msgerror={$msgerror}");
                exit();
            } else {
                $msg = "";
                $msgerror = $delete_stmt->errorInfo()[2];
            }
        }
    } else {
        // O fornecedor não existe
        $msg = "";
        $msgerror = "Fornecedor não encontrado.";
        header("Location: fornecedor.php?msg={$msg}&msgerror={$msgerror}");
        exit();
    }

    $conn = null;
} else {
    // ID do fornecedor não fornecido na URL
    header("Location: fornecedor.php?msg=&msgerror=ID do fornecedor não fornecido.");
    exit();
}
?>

<div class="container">
    <h2>Fornecedores</h2>
    <p>Exclusão do cadastro de fornecedores.</p>
    <hr>    
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id" value="<?= $fornecedorId; ?>">
            <label for="nome">&nbsp;Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" readonly value="<?= $fornecedorDetails['NomeFornecedor']; ?>"><br>
            <label for="cnpj">&nbsp;CNPJ</label>
            <input type="text" name="cnpj" id="cnpj" class="form-control" readonly value="<?= $fornecedorDetails['CNPJ']; ?>"><br>
            <label for="situação">&nbsp;Situação</label>
            <input type="text" name="situação" id="situação" class="form-control" readonly value="<?= $fornecedorDetails['Situacao']; ?>"><br>
            <input type="submit" name="enviar" value="Excluir" class="btn btn-danger">
            <a href="fornecedor.php"><button type="button" class="btn btn-primary">Cancelar</button></a>
        </form>
    </div>
</div>

<?php require("footer.php"); ?>