<?php

require('config/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["favorito"])) {
      $IdVenda = $_POST["id_venda"];
      $favorito = 'S';
      $sql_code = "UPDATE Venda SET favorito = :favorito where IdVenda = :id";
      $stmt = $conn->prepare($sql_code);
      $stmt->bindParam(":favorito", $favorito, PDO::PARAM_STR);
      $stmt->bindParam(":id", $IdVenda, PDO::PARAM_STR);

      if ($stmt->execute()) {
          $msg = 'new favorite';
          $msgerror = '';
          echo '<script>window.location.href = "tabelaVenda.php?msg=' . $msg . '&msgerror=' . $msgerror .'"</script>';
      } else {
        $msg = 'favorite error';
        $msgerror = '';
        echo '<script>window.location.href = "tabelaVenda.php?msg=' . $msg . '&msgerror=' . $msgerror .'"</script>';
      }
    }
}
$conn = null;
?>