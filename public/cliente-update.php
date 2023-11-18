<?php


if (isset($_GET['id'])) {
    $clienteId = $_GET['id'];

    if (isset($_POST['enviar'])) {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        require_once('config/connect.php');

        $update_query = "UPDATE Cliente SET Nome = :nome, CPF = :cpf, Telefone = :telefone, Email = :email WHERE IdCliente = :id";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bindParam(':nome', $nome);
        $update_stmt->bindParam(':cpf', $cpf);
        $update_stmt->bindParam(':telefone', $telefone);
        $update_stmt->bindParam(':email', $email);
        $update_stmt->bindParam(':id', $clienteId);

        if ($update_stmt->execute()) {
            $msg = "update success";
            $msgerror = "";
        } else {
            $msg = "";
            $msgerror = $update_stmt->errorInfo()[2];
        }

        $conn = null;

        header("Location: cliente.php?msg={$msg}&msgerror={$msgerror}");
    } else {
        // Buscar informações atuais do cliente
        require_once('config/connect.php');

        $select_query = "SELECT * FROM cliente WHERE IdCliente = :id";
        $select_stmt = $conn->prepare($select_query);
        $select_stmt->bindParam(':id', $clienteId);
        $select_stmt->execute();

        $cliente = $select_stmt->fetch(PDO::FETCH_ASSOC);

        $conn = null;

        if (!$cliente) {
            // cliente não encontrado
            header("Location: cliente.php?msg=&msgerror=Cliente não encontrado.");
        }
    }
} else {
    // ID do cliente não fornecido na URL
    header("Location: cliente.php?msg=&msgerror=ID do cliente não fornecido.");
}

require("header.php");
?>

<link rel="stylesheet" href="assets\css\tabela.css">

<div class="container">
    <h2>Clientes</h2>
    <p>Atualize as informações do cliente.</p>

    <div class="wrapper">
        <form method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $cliente['Nome']; ?>" required><br>

            <label for="cpf">cpf</label>
            <input type="text" name="cpf" id="cpf" class="form-control" value="<?php echo $cliente['CPF']; ?>" required><br>

            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control" value="<?php echo $cliente['Telefone']; ?>" required><br>

            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="<?php echo $cliente['Email']; ?>" required><br>

            <div class="buttons-tabelas"><a href="cliente.php"><button type="button"
                        class="btn btn-danger btn-tamanho">Cancelar</button></a>
                <input type="submit" name="enviar" value="Atualizar" class="btn btn-primary btn-tamanho">
            </div>
        </form>
    </div>
</div>

<?php require("footer.php"); ?>