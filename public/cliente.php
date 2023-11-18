<?php

require("header.php");

require('config/connect.php');

$mysql_query = "SELECT * FROM cliente ORDER BY Nome";
$result = $conn->query($mysql_query);

$conn = null;
?>

<div class="container">
  <h2>Contatos</h2>
  <p>Listagem de Clientes cadastrados.</p>
  <hr>
  <div class="float-right p-1">
    <a href="cliente-insert.php"><button type="button" class="btn btn-primary">Novo</button></a>
  </div>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-info" style="text-align:center">
        <th scope="col" style="width: 5%;">#</th>
        <th scope="col">Nome</th>
        <th scope="col" style="width: 20%;">CPF</th>
        <th scope="col" style="width: 20%;">Telefone</th>
        <th scope="col" style="width: 20%;">Email</th>
        <th scope="col" style="width: 20%;">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = $result->fetch(PDO::FETCH_ASSOC)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['IdCliente']; ?></th>
        <td><?php echo $data['Nome']; ?></td> 
        <td><?php echo $data['CPF']; ?></td> 
        <td style="text-align:center"><?=$data['Telefone']?></td>
        <td><?php echo $data['Email']; ?></td>
        <td style="text-align:center">
          <a href="cliente-update.php?id=<?php echo $data['IdCliente']; ?>">
            <button type="button" class="btn btn-primary">Editar</button></a>
          <a href="cliente-delete.php?id=<?php echo $data['IdCliente']; ?>">
            <button type="button" class="btn btn-danger">Excluir</button></a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>

<?php require("footer.php"); ?>