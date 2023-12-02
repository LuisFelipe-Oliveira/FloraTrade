<?php

require('config/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["favorito"])) {
      $IdFornecedor = $_POST["id_fornecedor"];
      $favorito = '';
      $sql_code = "UPDATE Fornecedor SET favorito = :favorito where IdFornecedor = :id";
      $stmt = $conn->prepare($sql_code);
      $stmt->bindParam(":favorito", $favorito, PDO::PARAM_STR);
      $stmt->bindParam(":id", $IdFornecedor, PDO::PARAM_STR);

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