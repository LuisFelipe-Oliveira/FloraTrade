<?php

$host = "localhost";

$data_base = "FloraTrade";

$user = "root";

$password = "";

try {
  $conn = new PDO("mysql:host=$host;dbname=$data_base", $user, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $th) {
  echo "erro na conexão: " . $th->getMessage();
}

?>