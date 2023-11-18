<?php  

if(isset($_POST['enviar'])) {
    $nome = "";
    $cnpj = "";
    $situacao = "";
    $cnpj = preg_replace('/[^0-9]/', '', $_POST['cnpj']);
    if(strlen($cnpj) !== 14) {
        $msg = "invalid cnpj";
        $msgerror = "";
    } else {
        $nome = $_POST['nome'];
        $situacao = $_POST['situação'];

        require_once('config/connect.php');

        $insert_query = "INSERT INTO fornecedor (NomeFornecedor, CNPJ, Situacao) 
                        VALUES (:nome, :cnpj, :situacao)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bindParam(':nome', $nome);
        $insert_stmt->bindParam(':cnpj', $cnpj);
        $insert_stmt->bindParam(':situacao', $situacao);

        if($insert_stmt->execute()) {
            $msg = "insert success";
            $msgerror = "";
        } else {
            $msg = "insert error";
            $msgerror = $conn->errorInfo()[2];
        }
    }

    $conn = null;

    header("Location: fornecedor.php?msg={$msg}&msgerror={$msgerror}");
}

require("header.php");
?>

<div class="container">

    <h2>Fornecedores</h2>
    <p>Cadastro de fornecedores.</p>

    <div class="wrapper">
        <form method="post">
			<label for="nome">&nbsp;Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" required><br>
			<label for="cnpj">&nbsp;CNPJ</label>
			<input type="text" name="cnpj" id="cnpj" class="form-control" required><br>
			<label for="situação">&nbsp;Situação</label>
			<input type="text" name="situação" id="situação" class="form-control" required><br>
			<input type="submit" name="enviar" value="Inserir" class="btn btn-primary">
		</form>
    </div>


</div>

<?php require("footer.php"); ?>