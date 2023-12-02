<?php

require('config/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["favorito"])) {
      $IdFornecedor = $_POST["id_fornecedor"];
      $favorito = 'S';
      $sql_code = "UPDATE Fornecedor SET favorito = :favorito where IdFornecedor = :id";
      $stmt = $conn->prepare($sql_code);
      $stmt->bindParam(":favorito", $favorito, PDO::PARAM_STR);
      $stmt->bindParam(":id", $IdFornecedor, PDO::PARAM_STR);

      if ($stmt->execute()) {
          $msg = 'new favorite';
          $msgerror = '';
          echo '<script>window.location.href = "fornecedor.php?msg=' . $msg . '&msgerror=' . $msgerror .'"</script>';
      } else {
        $msg = 'favorite error';
        $msgerror = '';
        echo '<script>window.location.href = "fornecedor.php?msg=' . $msg . '&msgerror=' . $msgerror .'"</script>';
      }
    }
}
$conn = null;
?>