<?php

session_start();

if (isset($_POST['submit']) && !empty($_POST['Email']) && !empty($_POST['Senha'])) {
    // Acessa
    include_once('./config/connect.php');

    $email = $_POST['Email'];
    $senha = $_POST['Senha'];

    $sql = "SELECT * FROM `Usuario` WHERE Email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    //error_log($result);
    //error_log(password_verify($senha, $result['Senha']));

    if (!$result || !password_verify($senha, $result['SENHA'])) {
        unset($_SESSION['Email']);
        unset($_SESSION['Senha']);
        $msg = "invalido";
        $msgerror = "";
        header("Location: login.php?msg={$msg}&msgerror={$msgerror}");
    } else {
            $_SESSION["loggedin"] = true;
            $_SESSION['Email'] = $result['Email'];
            $_SESSION['Id'] = $result['IdUsuario'];
            $_SESSION['Nome'] = $result['Nome'];
            $_SESSION['Telefone'] = $result['Telefone'];
            $_SESSION['DataCriacao'] = $result['DataCriacao'];
            $_SESSION['FotoPerfil'] = $result['FotoPerfil'];
            $_SESSION['Senha'] = $senha;
            header('Location: index.php');
        
    }
} else {
    // Não acessa
    $msg = "invalido";
    header('Location: login.php');
}
?>
