<?php

require('config/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["favorito"])) {
        $IdCliente = $_POST["id_cliente"];
        $favorito = '';
        $sql_code = "UPDATE Cliente SET favorito = :favorito where IdCliente = :id";
        $stmt = $conn->prepare($sql_code);
        $stmt->bindParam(":favorito", $favorito, PDO::PARAM_STR);
        $stmt->bindParam(":id", $IdCliente, PDO::PARAM_STR);

      if ($stmt->execute()) {
          $msg = 'remove favorite';
          $msgerror = '';
          echo '<script>window.location.href = "favoritos.php?msg=' . $msg . '&msgerror=' . $msgerror .'"</script>';
      } else {
        $msg = 'remove favorite error';
        $msgerror = '';
        echo '<script>window.location.href = "favoritos.php?msg=' . $msg . '&msgerror=' . $msgerror .'"</script>';
      }
    }
}
$conn = null;
?>