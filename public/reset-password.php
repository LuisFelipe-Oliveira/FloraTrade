<?php

require_once("header.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo '<script>window.location.href = "login.php"</script>';
    exit;
}

require("./config/connect.php");

$senha = $senha_confirm = "";
$senha_err = $senha_confirm_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (empty(trim($_POST["senha"]))){
        $senha_err = "Por favor, digite a nova senha.";     
    } else if (strlen(trim($_POST["senha"])) < 6){
        $senha_err = "A senha deve possuir ao menos 6 caracteres.";
    } else {
        $senha = trim($_POST["senha"]);
    }
    
    if (empty(trim($_POST["senha_confirm"]))){
        $senha_confirm_err = "Por favor, confirma a nova senha.";
    } else {
        $senha_confirm = trim($_POST["senha_confirm"]);
        if (empty($senha_err) && ($senha != $senha_confirm)){
            $senha_confirm_err = "As senhas digitadas não conferem.";
        }
    }
        
    if (empty($senha_err) && empty($senha_confirm_err)) {
        $hashed_password = password_hash($senha, PASSWORD_DEFAULT);
        $param_id = $_SESSION['Id'];
        $sql_code = "UPDATE Usuario SET senha = :senha where IdUsuario = :id";
        $stmt = $conn->prepare($sql_code);
        $stmt->bindParam(":senha", $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);

        if ($stmt->execute()) {
            session_destroy();
            $msg = 'changed password';
            $msgerror = '';
            echo '<script>window.location.href = "login.php?msg=' . $msg . '&msgerror=' . $msgerror .'"</script>';
            exit;
        } else {
            echo "Oops! Algo deu errado. Por favor, tente novamente mais tarde.";
        }
    }
}
$conn = null;

?>

<link rel="stylesheet" href="assets\css\tabela.css">

<div class="container">

    <h2>Alterar senha</h2>
    <p>Preencha os campos para alterar a sua senha.</p>

    <div class="wrapper">
        <form method="post"> 
            <label>Nova Senha</label>
            <input type="password" name="senha" class="form-control <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $senha; ?>"><br>
            <span class="invalid-feedback"><?php echo $senha_err; ?></span>
            <label>Confirmação da Senha</label>
            <input type="password" name="senha_confirm" class="form-control <?php echo (!empty($senha_confirm_err)) ? 'is-invalid' : ''; ?>"><br>
            <span class="invalid-feedback"><?php echo $senha_confirm_err; ?></span>
            <div class="buttons-tabelas">
                <a href="perfil.php"><button type="button"
                        class="btn btn-danger btn-tamanho">Cancelar</button></a>
                <input type="submit" name="enviar" value="Redefinir" class="btn btn-success btn-tamanho">
            </div>
        </form>
    </div>    
</div>

<?php require_once("footer.php"); ?>