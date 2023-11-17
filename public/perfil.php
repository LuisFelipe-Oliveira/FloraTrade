<?php
require("header.php");

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<div class="alinhamento">
  <h2>Perfil</h2>
  <p>Olá, <?php echo ($_SESSION["Nome"]); ?></p>
  <hr>  
  <p>Configurações da conta.</p>
  <p>
    <a href="reset-password.php" class="btn btn-warning">Resete a sua senha</a>
    <a href="logout.php" class="btn btn-danger ml-3">Logout</a>
  </p>
</div>

<?php require("footer.php"); ?>