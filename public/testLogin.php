<?php 

// login

    session_start();

    if(isset($_POST['submit']) && !empty($_POST['Email']) && !empty($_POST['Senha'])){
        //Acessa

        include_once('./config/connect.php');

        $email = $_POST['Email'];
        $senha = md5($_POST['Senha']);

        $sql = "SELECT * FROM `Usuario` WHERE Email = '$email' AND Senha = '$senha'";

        $nome = $_POST['Nome'];
        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();

        if (count($result) < 1){
            unset($_SESSION['Email']);
            unset($_SESSION['Senha']);
            header('Location: login.php');
            $msg = "invalido";
        }else{
            foreach($result as $row){
                $_SESSION["loggedin"] = true;
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['Id'] = $row['IdUsuario'];
                $_SESSION['Nome'] = $row['Nome'];
                $_SESSION['Telefone'] = $row['Telefone'];
                $_SESSION['DataCriacao'] = $row['DataCriacao'];
                $_SESSION['FotoPerfil'] = $row['FotoPerfil'];
                $_SESSION['Senha'] = $senha;
                header('Location: index.php');
            }
        }
        
    }
    else{
        //Não acessa
        $msg = "invalido";
        header('Location: login.php');
    }



?>