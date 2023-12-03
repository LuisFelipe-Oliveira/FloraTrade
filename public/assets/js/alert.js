function success() {
  Swal.fire({
    title: "Sucesso!",
    text: "Acesso permitido!",
    icon: "success",
  });
}

function error() {
  Swal.fire({
    icon: "error",
    title: "Oops...",
    text: "Você precisa fazer login!",
  });
}

function mostrarDetalhes(idProduto, nomeProduto) {
  Swal.fire({
    title: nomeProduto,
    text: "Detalhes do produto com ID " + idProduto,
    icon: "info",
    confirmButtonText: "Fechar",
  });
}
