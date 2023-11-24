<?php

session_start();

require_once('config/connect.php');

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Diretório de destino para as imagens
    $diretorio_destino = 'assets/imgs/imgsUpload/';

    // Nome do arquivo
    $nome_arquivo = $_FILES['foto']['name'];

    // Caminho completo do arquivo no servidor
    $caminho_arquivo = $diretorio_destino . $nome_arquivo;

    // Move o arquivo para o diretório de destino
    move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_arquivo);

    $id = ($_SESSION['Id']);

    // Salva o caminho da imagem no banco de dados
    // Substitua as variáveis de conexão e query de acordo com o seu banco de dados
    $query = "UPDATE Usuario SET FotoPerfil = :caminho_arquivo WHERE IdUsuario = $id";
    $insert_img = $conn->prepare($query);

    // Substitua ':id' pelo nome correto do seu placeholder e ajuste o tipo conforme necessário
    $insert_img->bindValue(':caminho_arquivo', $caminho_arquivo, PDO::PARAM_STR);
    // $insert_img->bindValue(':IdUsuario', ($_SESSION["Id"]), PDO::PARAM_INT);

    $insert_img->execute();
    $insert_img->closeCursor();
    $conn = null;
    $_SESSION['FotoPerfil'] = $caminho_arquivo;
    header("Location: perfil.php");

}   

?>