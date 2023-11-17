// efeito do botão cadastrar

document.addEventListener("DOMContentLoaded", function () {
  const btnEntrar = document.querySelector(".btn-entrar");
  const btnCadastrar = document.querySelector(".btn-cadastrar");

  btnEntrar.addEventListener("mouseover", function () {
    // Adicione a classe 'active' ao botão "Entrar" quando o mouse passa sobre ele
    btnEntrar.classList.add("active");

    // Remova a classe 'active' do botão "Cadastrar"
    btnCadastrar.classList.remove("active");

    // Execute a função removeActive após 3 segundos
    setTimeout(() => removeActive(btnEntrar), 5000);
  });

  btnCadastrar.addEventListener("mouseover", function () {
    // Adicione a classe 'active' ao botão "Cadastrar" quando o mouse passa sobre ele
    btnCadastrar.classList.add("active");

    // Remova a classe 'active' do botão "Entrar"
    btnEntrar.classList.remove("active");

    // Execute a função removeActive após 3 segundos
    setTimeout(() => removeActive(btnCadastrar), 5000);
  });

  function removeActive(btn) {
    // Remova a classe 'active' do botão
    btn.classList.remove("active");
  }
});