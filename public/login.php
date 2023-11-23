<?php

session_start();

$flag_msg = null;

$msg = "";

if (isset($_POST["enviar"])) {
    require("./config/connect.php");

    $nome = $_POST["Nome"];
    $email = $_POST["Email"];
    $senha = md5($_POST["Senha"]);
    // $conf_senha = md5($_POST["Conf_Senha"]);
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
                $msg = "sucesso";
                header("Location: login.php?msg={$msg}&msgerror={$msgerror}"); // Redireciona para a página de login
                exit();
            }

            $flag_msg = true; // Sucesso 
            $msg = "sucesso";
            header("Location: login.php?msg={$msg}&msgerror={$msgerror}");


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
    <link rel="icon"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'%3E%3Cstyle%3Esvg { fill: %23528265 } %3C/style%3E%3Cpath d='M512 32c0 113.6-84.6 207.5-194.2 222c-7.1-53.4-30.6-101.6-65.3-139.3C290.8 46.3 364 0 448 0h32c17.7 0 32 14.3 32 32zM0 96C0 78.3 14.3 64 32 64H64c123.7 0 224 100.3 224 224v32V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V320C100.3 320 0 219.7 0 96z' /%3E%3C/svg%3E"
        type="image/svg+xml">
    <title>FloraTrade - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets\css\styleLogin1.css">
</head>

<body>
    <div id="logo">
        <a href="index.php"><img src="assets/imgs/Logo.png" alt=""></a>
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
                <?php if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    $msgerror = $_GET['msgerror'];
                    if ($msg == 'sucesso') {
                        echo "<div class='avisoSucesso' role='alert'>Conta criada com sucesso!</div>";
                    }
                }
                ?>
                <h1>Crie uma conta</h1>
                <br>
                <input type="text" placeholder="Nome" id="nome" name="Nome" required />
                <input type="tel" placeholder="Telefone" id="telefone" name="Telefone" required />
                <input type="email" placeholder="E-mail" id="email" name="Email" required />
                <input type="password" placeholder="Senha" id="senha" name="Senha" required />
                <input type="password" placeholder="Confirme a senha" id="conf_senha" name="Conf_Senha" required />
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
                    $msgerror = $_GET['msgerror'];
                    if ($msg == 'invalido') {
                        echo "<div class='aviso' role='alert'>E-mail ou senha inválidos!</div>";
                    }
                }
                ?>
                <h1>Entre</h1>
                <br>
                <input type="text" name="Email" placeholder="E-mail" required />
                <input type="password" name="Senha" placeholder="Senha" required />
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
                    <p>Introduza os seus dados e conheça o FloraTrade</p>
                    <button class="ghost" id="signUp">Cadastre-se</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/login.js"></script>
</body>

</html>