<?php 

if(isset($_POST['enviar'])) {
    $nome = "";
    $cpf = "";
    $telefone = "";
    $nome = $_POST['nome'];
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    require_once('config/connect.php');

    $mysql_query = "INSERT INTO Cliente (Nome, CPF, Telefone, Email)
                                VALUES ('{$nome}', '{$cpf}', '{$telefone}', '{$email}')";

    $result = $conn->query($mysql_query);

    if($result === true) {
        $msg = "insert success";
        $msgerror = "";
    } else {
        $msg = "";
        $msgerror = $conn->errorInfo()[2];
    }

    $conn = null;

    header("Location: cliente.php?msg={$msg}&msgerror={$msgerror}");
}

require("header.php"); 
?>

<div class="container">

    <h2>Clientes</h2>
    <p>Cadastro de Clientes.</p>

    <div class="wrapper">
        <form method="post">
			<label for="nome">&nbsp;Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" required><br>
			<label for="cpf">&nbsp;CPF</label>
			<input type="text" name="cpf" id="cpf" class="form-control" required><br>
			<label for="telefone">&nbsp;Telefone</label>
			<input type="text" name="telefone" id="telefone" class="form-control" required><br>
            <label for="email">&nbsp;Email</label>
			<input type="text" name="email" id="email" class="form-control" required><br>
			<input type="submit" name="enviar" value="Inserir" class="btn btn-primary">
		</form>
    </div>


</div>

<?php require("footer.php"); ?>