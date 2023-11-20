<?php

session_start();

$flag_msg = null;

$msg = "";

if (isset($_POST["enviar"])) {
    require("./config/connect.php");

    $nome = $_POST["Nome"];
    $email = $_POST["Email"];
    $senha = md5($_POST["Senha"]);
    $telefone = $_POST["Telefone"];
    $tipo = 2;

    $form = [$nome, $email, $senha, $telefone];

    $aux = 0;

    foreach ($form as $field) {
        if (empty($field)) {
            $aux += 1;
        }
    }

    if ($aux > 0) {
        $flag_msg = false;
        $msg = "preencha todos os campos!";
    } else {

        // $senha_encrypt = md5($senha);

        try {

            $sql = "INSERT INTO Usuario(Nome,Email,Senha,Telefone) 
            VALUES (:Nome,:Email,:Senha,:Telefone)";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(":Nome", $nome);
            $stmt->bindParam(":Email", $email);
            $stmt->bindParam(":Senha", $senha);
            $stmt->bindParam(":Telefone", $telefone);

            $stmt->execute();

            if (!isset($_SESSION['usuario'])) {
                header("Location: login.php"); // Redireciona para a página de login
                exit();
            }

            $flag_msg = true; // Sucesso 
            $msg = "Dados enviados com sucesso!";
            header("location: login.php");


        } catch (PDOException $th) {
            $conn = null;

            $flag_msg = false; //Erro 
            $msg = "Erro na conexão com o Banco de dados: " . $th->getMessage();

        }
    }


    $conn = null;
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatraca - Entrar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets\css\styleLogin1.css">
</head>

<body>
    <div id="logo">
    <a href="index.php" ><img  src="assets/imgs/Logo.png" alt=""></a>
    </div>
    <?php
        // if (!is_null($flag_msg)) {
        //     if ($flag_msg) {
        //         echo "<div class='alert alert-success' role='alert' ></div></div></div>$msg</div>";
        //     } else {
        //         echo "<div class='alert alert-warning' role='alert'>$msg</div>";
        //     }
        // }
        ?>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="post">
                <h1>Crie uma conta</h1>
                <br>
                <input type="text" placeholder="Nome" id="nome" name="Nome" required/>
                <input type="tel" placeholder="Telefone" id="telefone" name="Telefone" required/>
                <input type="email" placeholder="E-mail" id="email" name="Email" required/>
                <input type="password" placeholder="Senha" id="senha" name="Senha" required/>
                <br>
                <button type="submit" name="enviar">Cadastre-se</button>
                <p class="mobile-text">Já tem conta?
                    <a href="#" id="signIn2">Entre</a>
                </p>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="testLogin.php" method="post">
                <?php if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    if ($msg = "invalido"){
                        echo "<div class='alert alert-danger' role='alert'>Falha ao inserir o registro!</div>";
                    }else{}
                    }?>
                <h1>Entre</h1>
                <br>
                <input type="text" name="Email" placeholder="E-mail"required />
                <input type="password" name="Senha" placeholder="Senha" required/>
                <a href="./forgot-password/forgot-password.php">Esqueceu sua senha?</a>
                <button name="submit">Entre</button>
                <p class="mobile-text">Não tem conta?
                    <a href="#" id="signUp2">Cadastre-se</a>
                </p>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bem Vindo Novamente!</h1>
                    <p>Faça o login e se conecte novamente no FloraTrade</p>
                    <button class="ghost" id="signIn">Entre</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Olá, Visitante!</h1>
                    <p>Introduza o seus dados e conheça o FloraTrade</p>
                    <button class="ghost" id="signUp">Cadastre-se</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/login.js"></script>
</body>

</html>