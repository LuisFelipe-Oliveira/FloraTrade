<?php

session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/luxonauta/luxa@1.1/dist/compressed/luxa.css" />
    <link rel="stylesheet" href="assets\css\header-footer.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
    <title>FloraTrade</title>
</head>

<body>

    <div class="alinhamento">
        <!-- header -->
        <div class="header">
            <!-- menu lateral -->
            <div class="menu">
                <button class="btn-menu-open" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight"><i class="fas fa-bars" id="icon-menu"
                        fill="currentColor"></i></button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <hr class="hr-green">
                    <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == false) { ?>
                        <div class="offcanvas-body">
                            <ul class="itens-menu">
                                <a class="link2" href="login.php?login">
                                    <li class="button">Entrar</li>
                                </a>
                                <a class="link1" href="login.php?cadastro">
                                    <li class="button">Cadastrar</li>
                                </a>
                                <a onclick="error()">
                                    <li>Usuários</li>
                                </a>
                                <a onclick="error()">
                                    <li>Produtos</li>
                                </a>
                                <a onclick="error()">
                                    <li>Estoque</li>
                                </a>
                                <a onclick="error()">
                                    <li>Clientes</li>
                                </a>
                                <a onclick="error()">
                                    <li>Fornecedores</li>
                                </a>
                                <a onclick="error()">
                                    <li>Pedidos</li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- botões de login -->
                <div class="btn-login">
                    <a class="link2" href="login.php?login">
                        <div class="btn-entrar">
                            <h4>Entrar</h4>
                        </div>
                    </a>
                    <a class="link1" href="login.php?cadastro">
                        <div class="btn-cadastrar">
                            <h4>Cadastrar</h4>
                        </div>
                    </a>
                </div>
            <?php } else { ?>
                <div class="offcanvas-body">
                    <ul class="itens-menu">
                        <div class="btn-perfil-responsive">
                            <div>
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <!-- <img src="assets/imgs/avatar.jpg" alt="Avatar perfil"> -->
                                    <?php
                                    $foto = $_SESSION["FotoPerfil"];
                                    $timestamp = time(); // Adiciona um timestamp único para evitar o cache
                                    $intervalo = 5; // Intervalo em segundos
                                
                                    // Calcula um múltiplo de 30 segundos para garantir uma atualização periódica
                                    $timestamp_atualizado = $intervalo * floor($timestamp / $intervalo);

                                    echo "<img src='$foto?timestamp=$timestamp_atualizado' alt='Foto de Perfil'>";
                                    ?>
                                    Bem vindo
                                    <?php echo ucwords(($_SESSION["Nome"])); ?> !
                                </button>
                                <ul class="dropdown-menu drop">
                                    <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
                                    <li class="btn-sair"><a class="dropdown-item " href="logout.php">
                                            <div class="">
                                                <span>Sair</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor"
                                                    viewBox="0 0 512 512">
                                                    <path
                                                        d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                                                </svg>
                                            </div>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                        <a href="">
                            <li>Usuários</li>
                        </a>
                        <a href="tabelaProduto.php">
                            <li>Produtos</li>
                        </a>
                        <a href="">
                            <li>Estoque</li>
                        </a>
                        <a href="cliente.php">
                            <li>Clientes</li>
                        </a>
                        <a href="fornecedor.php">
                            <li>Fornecedores</li>
                        </a>
                        <a href="tabelaPedido.php">
                            <li>Pedidos</li>
                        </a>
                        <a href="tabelaVenda.php">
                            <li>Vendas</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        <!-- botões de login -->
        <div class="btn-perfil">
            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- <img src="assets/imgs/avatar.jpg" alt="Avatar perfil"> -->
                <?php
                $foto = $_SESSION["FotoPerfil"];
                $timestamp = time(); // Adiciona um timestamp único para evitar o cache
                $intervalo = 5; // Intervalo em segundos
            
                // Calcula um múltiplo de 30 segundos para garantir uma atualização periódica
                $timestamp_atualizado = $intervalo * floor($timestamp / $intervalo);

                echo "<img src='$foto?timestamp=$timestamp_atualizado' alt='Foto de Perfil'>";
                ?>
                Bem vindo
                <?php echo ucwords(($_SESSION["Nome"])); ?> !
            </button>
            <ul class="dropdown-menu drop">
                <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
                <li class="btn-sair"><a class="dropdown-item " href="logout.php">
                        <div class="">
                            <span>Sair</span>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" viewBox="0 0 512 512">
                                <path
                                    d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                            </svg>
                        </div>
                    </a></li>
            </ul>
        </div>
    <?php } ?>
    <!-- Logo -->
    <div class="logo">
        <a href="index.php">
            <img class="logo" src="assets/imgs/Logo.png" alt="" />
        </a>
    </div>
    </div>
    </div>
    <hr class="hr-green" />

    <?php

    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        $msgerror = $_GET['msgerror'];
        if ($msg == 'insert success') {
            echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso!</div>";
        } else if ($msg == 'insert error') {
            echo "<div class='alert alert-danger' role='alert'>Falha ao inserir o registro! {$msgerror}</div>";
        } else if ($msg == 'update success') {
            echo "<div class='alert alert-success' role='alert'>Registro atualizado com sucesso!</div>";
        } else if ($msg == 'update error') {
            echo "<div class='alert alert-danger' role='alert'>Falha ao atualizar o registro! {$msgerror}</div>";
        } else if ($msg == 'delete success') {
            echo "<div class='alert alert-success' role='alert'>Registro excluido com sucesso!</div>";
        } else if ($msg == 'delete error') {
            echo "<div class='alert alert-danger' role='alert'>Falha ao excluir o registro! {$msgerror}</div>";
        } else if ($msg == 'invalid cnpj') {
            echo "<div class='alert alert-danger' role='alert'>CNPJ deve conter 14 números! {$msgerror}</div>";
        } else if ($msg == 'invalid IDs') {
            echo "<div class='alert alert-danger' role='alert'>Informe um ID de fornecedor ou produto existente! {$msgerror}</div>";
        } else if ($msg == 'invalid situacao') {
            echo "<div class='alert alert-danger' role='alert'>Situação do fornecedor é inativo! {$msgerror}</div>";
        } else {
            echo "<div class='alert alert-warning' role='alert'>{$msgerror}</div>";
        }
    }

    ?>