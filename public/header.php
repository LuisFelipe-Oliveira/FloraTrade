<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/luxonauta/luxa@1.1/dist/compressed/luxa.css" />
    <link rel="stylesheet" href="assets\css\style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
    <title>Flora Trade</title>
</head>

<body>

    <div class="alinhamento">
        <!-- header -->
        <div class="header">
            <!-- menu lateral -->
            <div class="menu">
                <button class="btn-menu-open" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                    aria-controls="offcanvasRight"><i class="fas fa-bars" fill="currentColor"></i></button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <hr class="hr-green">
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
                            <a href="tabelaProduto.php">
                                <li>Produtos</li>
                            </a>
                            <a onclick="error()">
                                <li>Estoque</li>
                            </a>
                            <a onclick="error()">
                                <li>Clientes</li>
                            </a>
                            <a href="fornecedor.php">
                                <li>Fornecedores</li>
                            </a>
                            <a onclick="error()">
                                <li>Contatos</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- botões de login -->
            <div class="btn-login">
                <div class="btn-entrar">
                    <h4><a class="link2" href="login.php?login">Entrar</a></h4>
                </div>
                <div class="btn-cadastrar">
                    <h4><a class="link1" href="login.php?cadastro">Cadastrar</a></h4>
                </div>
            </div>
            <!-- Logo -->
            <div class="logo">
                <img class="logo" src="assets/imgs/Logo.png" alt="" />
            </div>
        </div>
    </div>
    <hr class="hr-green" />