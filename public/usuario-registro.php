<?php
require_once("header.php");

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo '<script>window.location.href = "login.php"</script>';
    exit;
}

require_once('config/connect.php');

if (isset($_GET['id'])) {
    $IdUsuario = $_GET['id'];

    // Buscar informações atuais do produto
    $select_query = "SELECT * FROM Usuario WHERE IdUsuario = :id";
    $select_stmt = $conn->prepare($select_query);
    $select_stmt->bindParam(':id', $IdUsuario);
    $select_stmt->execute();

    $Usuario = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if (!$Usuario) {
        header("Location: tabelaUsuario.php?msg=&msgerror=Usuario não encontrado.");
    }
}


?>

</body>

<style>
    .dados-venda {
        display: flex;
        flex-wrap: wrap;
        background-color: #d4edda;
        /* Cor verde da classe table-success */
        padding: 10px;
        margin: 10px;
        border-radius: 5px;
    }

    .dados-venda label {
        width: 100%;
        margin-bottom: 5px;
    }

    .dados-venda label span {
        font-weight: bold;
        margin-right: 5px;
    }
</style>

<link rel="stylesheet" href="assets\css\tabela.css" />
<div class="container">
    <h2>Informações do Usuario</h2>

    <div class="dados-venda">
        <img class="imgPerfilTabela" src="<?php echo$Usuario['FotoPerfil'] ?>" alt="">
        <label>
        <span>Id:</span>
            <?php echo $Usuario['IdUsuario']; ?>
        </label>
        <label><span>Nome:</span>
            <?php echo $Usuario['Nome']; ?>
        </label>
        <label><span>Data de cadastro: </span>
            <?php echo $Usuario['DataCriacao']; ?>
        </label>
        <label><span>E-mail:</span>
            <?php echo $Usuario['Email']; ?>
        </label>
        <label><span>Telefone:</span>
            <?php echo $Usuario['Telefone']; ?>
        </label>
    </div>

    <br>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr class="table-success" style="text-align:center">
                <th scope="col" style="width: 5%;">Id</th>
                <th scope="col" style="width: 15%;">Foto</th>
                <th scope="col">Nome</th>
                <th scope="col" style="width: 25%;">Email</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row" style="text-align:center">
                    <?php echo $Usuario['IdUsuario']; ?>
                </td>
                <td scope="row" style="text-align:center"><img class="imgPerfilTabela"
                        src="<?php echo $Usuario['FotoPerfil']; ?>" alt=""></td>
                <td scope="row" style="text-align:center">
                    <?php echo $Usuario['Nome']; ?>
                </td>
                <td scope="row" style="text-align:center">
                    <?php echo $Usuario['Email']; ?>
                </td>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="buttons-tabelas">
        <a href="tabelaUsuario.php"><button type="button" class="btn btn-success btn-tamanho">Retornar</button></a>
    </div>
    <form action="usuario-favorite.php" method="post" style="display: flex; justify-content: end;">
        <input type="hidden" name="id_Usuario" value="<?php echo $Usuario['IdUsuario']; ?>">
        <button type="submit" class="btn btn-warning" style="margin-top: 5px;" name="favorito">
            <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 24 24">
                <style>
                    svg {
                        fill: #ffffff;
                    }
                </style>
                <path
                    d="M12 2L15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
            </svg>
        </button>
    </form>
    <br>
</div>

<?php require("footer.php"); ?>