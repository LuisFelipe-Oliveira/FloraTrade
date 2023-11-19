<link rel="stylesheet" href="assets/css/perfil.css">


<?php
require("header.php");
require("config/connect.php");
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}

?>

<div class="container1">
  <h1 class="titulo">Perfil</h1>
  <hr>
  <div class="perfil">
    <div class="img-perfil">
      <?php
      $foto = $_SESSION["FotoPerfil"];
      $timestamp = time(); // Adiciona um timestamp único para evitar o cache
      $intervalo = 5; // Intervalo em segundos
      
      // Calcula um múltiplo de 30 segundos para garantir uma atualização periódica
      $timestamp_atualizado = $intervalo * floor($timestamp / $intervalo);

      echo "<img src='$foto?timestamp=$timestamp_atualizado' alt='Foto de Perfil'>";
      ?>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Alterar imagem do perfil
      </button>
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Alterar foto de perfil</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="upload-foto.php" method="post" enctype="multipart/form-data">
                <input type="file" name="foto" class="btn btn-success"></input>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              <button type="submit" name="Enviar foto" class="btn btn-success">Enviar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <h3><strong>Bem vindo(a),
          <?php echo ucwords(($_SESSION["Nome"])); ?> !
        </strong>
      </h3>
      <hr>
      <h4>E-mail:
        <?php echo (($_SESSION["Email"])); ?>
      </h4>
      <h4>Telefone:
        <?php echo (($_SESSION["Telefone"])); ?>
      </h4>
      <h4>Usuário desde:
        <?php echo date("d/m/Y", strtotime((($_SESSION["DataCriacao"])))); ?>
      </h4>
      <br>
      <hr>
      <p>Configurações da conta.</p>
      <p>
        <a href="reset-password.php" class="btn btn-warning">Resete a sua senha</a>
        <a href="logout.php" class="btn btn-danger ml-3">Logout</a>
      </p>
    </div>
  </div>
</div>
<!-- </div> -->

<?php require("footer.php"); ?>