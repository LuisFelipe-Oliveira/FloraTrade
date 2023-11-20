<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('../config/connect.php');

    require('validation-password.php');

    require('send-email.php');

    // Valide o e-mail
    $email = $_POST["email"];

    // Verifique se o e-mail existe no seu sistema
    if (existeEmailNoBanco($conn, $email)) {
        // Gere um token exclusivo
        $token = bin2hex(random_bytes(32));
        $timetoken = time();
        
        // Armazene o token no banco de dados
        if (armazenarTokenNoBanco($conn, $email, $token, $timetoken)) {
            // Link de redefinição de senha
            $link = "http://localhost/FloraTrade/public/forgot-password/change-password.php?token=$token";

            // Envie o e-mail
            if (sendEmail($email, $link)) {
                // Redirecione para uma página de sucesso de envio
                header("Location: sending-password.php");
                exit();
            } else {
                // Não foi possível enviar o email
                $msg = "sending e-mail error";
                $msgerror = "";
                header("Location: forgot-password.php?msg={$msg}&msgerror={$msgerror}");
                exit();
            }
        } else {
            // Token não armazenado no banco
            $msg = "token error";
            $msgerror = "";
            header("Location: forgot-password.php?msg={$msg}&msgerror={$msgerror}");
            exit();
        }
    } else {
        // E-mail não encontrado
        $msg = "find e-mail error";
        $msgerror = "";
        header("Location: forgot-password.php?msg={$msg}&msgerror={$msgerror}");
        exit();
    }
}

//require("../header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a Senha</title>
</head>
<body>
    <form method="post">
        <label for="email">Digite seu e-mail:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>