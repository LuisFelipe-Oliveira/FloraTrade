<?php

require('config/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["favorito"])) {
      $IdVenda = $_POST["id_venda"];
      $favorito = '';
      $sql_code = "UPDATE Venda SET favorito = :favorito where IdVenda = :id";
      $stmt = $conn->prepare($sql_code);
      $stmt->bindParam(":favorito", $favorito, PDO::PARAM_STR);
      $stmt->bindParam(":id", $IdVenda, PDO::PARAM_STR);

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