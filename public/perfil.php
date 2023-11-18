<link rel="stylesheet" href="assets/css/perfil.css">


<?php
require("header.php");

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
      <img src="assets/imgs/avatar.jpg" alt="">
    </div>
    <div>
      <h3><strong>Bem vindo(a),
        <?php echo ucwords(($_SESSION["Nome"])); ?> ! </strong>
      </h3>
      <hr>
      <h4>E-mail: <?php echo(($_SESSION["Email"])); ?></h4>
      <h4>Telefone: <?php echo(($_SESSION["Telefone"])); ?></h4>
      <h4>Usuário desde: <?php echo date("d/m/Y",strtotime((($_SESSION["DataCriacao"])))); ?></h4>
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