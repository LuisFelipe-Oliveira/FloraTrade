<?php

require('config/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["favorito"])) {
      $IdPedido = $_POST["id_pedido"];
      $favorito = '';
      $sql_code = "UPDATE Pedido SET favorito = :favorito where IdPedido = :id";
      $stmt = $conn->prepare($sql_code);
      $stmt->bindParam(":favorito", $favorito, PDO::PARAM_STR);
      $stmt->bindParam(":id", $IdPedido, PDO::PARAM_STR);

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