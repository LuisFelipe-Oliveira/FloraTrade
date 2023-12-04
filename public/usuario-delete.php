<?php

// Certifique-se de que o ID do usuario foi fornecido
if (isset($_GET['id'])) {
    $UsuarioId = $_GET['id'];

    require_once('config/connect.php');

    // Verifique se o usuario existe antes de exibir o formulário de exclusão
    $check_query = "SELECT * FROM Usuario WHERE IdUsuario = :id";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bindParam(':id', $UsuarioId);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        // O Usuario existe, obtenha os detalhes
        $UsuarioDetailsQuery = "SELECT * FROM Usuario WHERE IdUsuario = :id";
        $UsuarioDetailsStmt = $conn->prepare($UsuarioDetailsQuery);
        $UsuarioDetailsStmt->bindParam(':id', $UsuarioId);
        $UsuarioDetailsStmt->execute();
        $UsuarioDetails = $UsuarioDetailsStmt->fetch(PDO::FETCH_ASSOC);

        // Processar o formulário de exclusão
        if (isset($_POST['enviar'])) {
            $delete_query = "DELETE FROM Usuario WHERE IdUsuario = :id";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bindParam(':id', $UsuarioId);

            if ($delete_stmt->execute()) {
                $msg = "delete success";
                $msgerror = "";
                header("Location: tabelaUsuario.php?msg={$msg}&msgerror={$msgerror}");
                exit();
            } else {
                $msg = "delete error";
                $msgerror = $delete_stmt->errorInfo()[2];
            }
        }
    } else {
        // O Usuario não existe
        $msg = "";
        $msgerror = "Usuario não encontrado.";
        header("Location: tabelaUsuario.php?msg={$msg}&msgerror={$msgerror}");
        exit();
    }

    $conn = null;
} else {
    // ID do Usuario não fornecido na URL
    header("Location: tabelaUsuario.php?msg=&msgerror=ID do Usuario não fornecido.");
    exit();
}

require("header.php");
?>

<link rel="stylesheet" href="assets\css\tabela.css" />

<div class="container">
    <h2>Usuario</h2>
    <p>Exclusão do cadastro de Usuario.</p>
    <hr>    
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id" value="<?= $UsuarioId; ?>">
            <label for="nome">&nbsp;Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" readonly value="<?= $UsuarioDetails['Nome']; ?>"><br>
            <label for="cnpj">&nbsp;CNPJ</label>
            <input type="text" name="cnpj" id="cnpj" class="form-control" readonly value="<?= $UsuarioDetails['Email']; ?>"><br>
            <label for="situação">&nbsp;Situação</label>
            <input type="text" name="situação" id="situação" class="form-control" readonly value="<?= $UsuarioDetails['Telefone']; ?>"><br>
            <div class="buttons-tabelas">
                <a href="tabelaUsuario.php"><button type="button"
                    class="btn btn-danger btn-tamanho">Cancelar</button></a>
                <input type="submit" name="enviar" value="Excluir" class="btn btn-primary btn-tamanho">
            </div>
        </form>
    </div>
</div>

<?php require("footer.php"); ?>