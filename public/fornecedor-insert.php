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
        $situacao = $_POST['situacao'];

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

<link rel="stylesheet" href="assets\css\tabela.css">

<div class="container">

    <h2>Fornecedores</h2>
    <p>Cadastro de fornecedores.</p>

    <div class="wrapper">
        <form method="post">
			<label for="nome">&nbsp;Nome</label>
			<input type="text" name="nome" id="nome" class="form-control" required><br>
			<label for="cnpj">&nbsp;CNPJ</label>
			<input type="text" name="cnpj" id="cnpj" class="form-control" required><br>
			<label for="situacao">&nbsp;Situação</label>
            <select name="situacao" id="situacao" class="form-control" required>
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select><br>
            <div class="buttons-tabelas">
                <a href="fornecedor.php"><button type="button"
                        class="btn btn-danger btn-tamanho">Cancelar</button></a>
                <input type="submit" name="enviar" value="Inserir" class="btn btn-primary btn-tamanho">
            </div>
		</form>
    </div>


</div>

<?php require("footer.php"); ?>