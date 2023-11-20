<?php
// Verifique se o token está presente na URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    require('../config/connect.php');

    require('validation-password.php');

    // Verifique se o token é válido
    if (tokenEhValido($conn, $token)) {
        // Exiba o formulário de redefinição de senha
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Redefinir Senha</title>
        </head>
        <body>
            <form method='post'>
                <label for='nova_senha'>Nova Senha:</label>
                <input type='password' id='nova_senha' name='nova_senha' required>
                <label for='nova_senha_confirm'>Repite a nova Senha:</label>
                <input type='password' id='nova_senha_confirm' name='nova_senha_confirm' required>
                <button type='submit'>Redefinir Senha</button>
                <input type='hidden' name='token' value='$token'>
            </form>
        </body>
        </html>";
    } else {
        // Token inválido, redirecione para uma página de erro
        error_log("Token inválido");
        header("Location: /../login.php");
        exit();
    }
} else {
    // Token ausente, redirecione para uma página de erro
    error_log("Token ausente");
    header("Location: /../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha a nova senha e o token do formulário
    $novaSenha = $_POST["nova_senha"];
    $novaSenhaConfirm = $_POST["nova_senha_confirm"];
    $token = $_POST["token"];

    if ($novaSenha === $novaSenhaConfirm) {
        // Atualize a senha no banco de dados 
        if (atualizarSenhaNoBanco($conn, $token, $novaSenha)) {
            // Senha atualizada com sucesso
            $msg = "changed password";
            header("Location: ../login.php?msg={$msg}");
            exit();
        } else {
            // Falha na atualização da senha, redirecione para uma página de erro
            error_log("Falha na atualização da senha");
            header("Location: change-password.php");
            exit();
        }
    } else {
        // Senhas diferentes
        error_log("Senhas diferentes");
        header("Location: change-password.php");
        exit();
    }
   
}
?>