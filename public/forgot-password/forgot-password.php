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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a Senha</title>
    <link rel="icon"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'%3E%3Cstyle%3Esvg { fill: %23528265 } %3C/style%3E%3Cpath d='M512 32c0 113.6-84.6 207.5-194.2 222c-7.1-53.4-30.6-101.6-65.3-139.3C290.8 46.3 364 0 448 0h32c17.7 0 32 14.3 32 32zM0 96C0 78.3 14.3 64 32 64H64c123.7 0 224 100.3 224 224v32V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V320C100.3 320 0 219.7 0 96z' /%3E%3C/svg%3E"
        type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets\css\styleLogin1.css">
</head>
<body>
    <h1>Redefinir sua senha</h1>
    <form method="post">
        <label for="email">Digite seu e-mail:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>