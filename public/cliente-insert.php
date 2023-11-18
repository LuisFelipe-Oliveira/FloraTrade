<?php 

if(isset($_POST['enviar'])) {
    $nome = "";
    $cpf = "";
    $telefone = "";
    $nome = $_POST['nome'];
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);
    if(strlen($cpf) !== 11) {
        $msg = "invalid cnpj";
        $msgerror = "";
    } else {
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        require_once('config/connect.php');

        $insert_query = "INSERT INTO Cliente (Nome, CPF, Telefone, Email)
                                    VALUES (:nome, :cpf, :telefone, :email)";

        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bindParam(':nome', $nome);
        $insert_stmt->bindParam(':cpf', $cpf);
        $insert_stmt->bindParam(':telefone', $telefone);
        $insert_stmt->bindParam(':email', $email);

        if($insert_stmt->execute()){
            $msg = "insert success";
            $msgerror = "";
        } else {
            $msg = "insert error";
            $msgerror = $conn->errorInfo()[2];
        }
    }
    
    $conn = null;

    header("Location: cliente.php?msg={$msg}&msgerror={$msgerror}");
}

require("header.php"); 
?>

<link rel="stylesheet" href="assets\css\tabela.css">

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
            <div class="buttons-tabelas">
                <a href="cliente.php"><button type="button"
                        class="btn btn-danger btn-tamanho">Cancelar</button></a>
                        <input type="submit" name="enviar" value="Inserir" class="btn btn-primary btn-tamanho">

            </div>
			
		</form>
    </div>


</div>

<?php require("footer.php"); ?>