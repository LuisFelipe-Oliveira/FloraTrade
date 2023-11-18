<?php


// Certifique-se de que o ID do cliente foi fornecido
if (isset($_GET['id'])) {
    $clienteId = $_GET['id'];

    require_once('config/connect.php');

    // Verifique se o cliente existe antes de exibir o formulário de exclusão
    $check_query = "SELECT * FROM Cliente WHERE IdCliente = :id";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bindParam(':id', $clienteId);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        // O cliente existe, obtenha os detalhes
        $clienteDetailsQuery = "SELECT * FROM Cliente WHERE IdCliente = :id";
        $clienteDetailsStmt = $conn->prepare($clienteDetailsQuery);
        $clienteDetailsStmt->bindParam(':id', $clienteId);
        $clienteDetailsStmt->execute();
        $clienteDetails = $clienteDetailsStmt->fetch(PDO::FETCH_ASSOC);

        // Processar o formulário de exclusão
        if (isset($_POST['enviar'])) {
            $delete_query = "DELETE FROM Cliente WHERE IdCliente = :id";
            $delete_stmt = $conn->prepare($delete_query);
            $delete_stmt->bindParam(':id', $clienteId);

            if ($delete_stmt->execute()) {
                $msg = "delete success";
                $msgerror = "";
                header("Location: cliente.php?msg={$msg}&msgerror={$msgerror}");
                exit();
            } else {
                $msg = "";
                $msgerror = $delete_stmt->errorInfo()[2];
            }
        }
    } else {
        // O cliente não existe
        $msg = "";
        $msgerror = "cliente não encontrado.";
        header("Location: cliente.php?msg={$msg}&msgerror={$msgerror}");
        exit();
    }

    $conn = null;
} else {
    // ID do cliente não fornecido na URL
    header("Location: cliente.php?msg=&msgerror=ID do cliente não fornecido.");
    exit();
}

require("header.php");
?>

<div class="container">
    <h2>Clientes</h2>
    <p>Exclusão do cadastro do cliente.</p>
    <hr>    
    <div class="wrapper">
        <form method="post">
            <input type="hidden" name="id" value="<?= $clienteId; ?>">
            <label for="nome">&nbsp;Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" readonly value="<?= $clienteDetails['Nome']; ?>"><br>
            <label for="cpf">&nbsp;CPF</label>
            <input type="text" name="cpf" id="cpf" class="form-control" readonly value="<?= $clienteDetails['CPF']; ?>"><br>
            <label for="telefone">&nbsp;Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control" readonly value="<?= $clienteDetails['Telefone']; ?>"><br>
            <label for="email">&nbsp;Email</label>
            <input type="text" name="email" id="email" class="form-control" readonly value="<?= $clienteDetails['Email']; ?>"><br>
            <input type="submit" name="enviar" value="Excluir" class="btn btn-danger">
            

            <a href="cliente.php"><button type="button" class="btn btn-primary">Cancelar</button></a>
        </form>
    </div>
</div>

<?php require("footer.php"); ?>