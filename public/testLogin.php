<?php 

// login

    session_start();

    if(isset($_POST['submit']) && !empty($_POST['Nome']) && !empty($_POST['Senha'])){
        //Acessa

        include_once('./config/connect.php');

        $nome = $_POST['Nome'];
        $senha = md5($_POST['Senha']);

        $sql = "SELECT * FROM `Usuario` WHERE Nome = '$nome' AND Senha = '$senha'";

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $result = $stmt->fetchAll();

        if (count($result) < 1){
            unset($_SESSION['Nome']);
            unset($_SESSION['Senha']);
            $msg = "Nome inválido ou senha inválida";
            header('Location: login.php');
        }else{
            foreach($result as $row){
                $_SESSION['Nome'] = $row['Nome'];
                $_SESSION['Senha'] = $senha;
                header('Location: sistema.php');
            }
        }
        
    }
    else{
        //Não acessa
        $msg = "Nome inválido ou senha inválida";
        
        header('Location: login.php');
    }



?>