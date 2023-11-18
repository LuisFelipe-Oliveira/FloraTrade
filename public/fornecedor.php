<?php

require("header.php");

require('config/connect.php');

$mysql_query = "SELECT * FROM fornecedor ORDER BY IdFornecedor";
$result = $conn->query($mysql_query);

$conn = null;
?>

<div class="container">
  <h2>Fornecedores</h2>
  <p>Listagem de fornecedores cadastrados.</p>
  <hr>
  <div class="float-right p-1">
    <a href="fornecedor-insert.php"><button type="button" class="btn btn-primary">Novo</button></a>
  </div>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="table-info" style="text-align:center">
        <th scope="col" style="width: 5%;">#</th>
        <th scope="col">Nome</th>
        <th scope="col" style="width: 20%;">CNPJ</th>
        <th scope="col" style="width: 20%;">Data Cadastro</th>
        <th scope="col" style="width: 20%;">Situação</th>
        <th scope="col" style="width: 20%;">Ação</th>
      </tr>
    </thead>
    <tbody>
      <?php while($data = $result->fetch(PDO::FETCH_ASSOC)) { ?> 
      <tr> 
        <th scope="row" style="text-align:center"><?php echo $data['IdFornecedor']; ?></th>
        <td><?php echo $data['NomeFornecedor']; ?></td> 
        <td><?php echo $data['CNPJ']; ?></td> 
        <td style="text-align:center"><?php echo date('d/m/Y', strtotime($data['DataCadastro'])); ?></td>
        <td><?php echo $data['Situacao']; ?></td>
        <td style="text-align:center">
          <a href="fornecedor-update.php?id=<?php echo $data['IdFornecedor']; ?>">
            <button type="button" class="btn btn-primary">Editar</button></a>
          <a href="fornecedor-delete.php?id=<?php echo $data['IdFornecedor']; ?>">
            <button type="button" class="btn btn-danger">Excluir</button></a>
        </td> 
      </tr> 
      <?php } ?>       
    </tbody>
  </table>
</div>

<?php require("footer.php"); ?>