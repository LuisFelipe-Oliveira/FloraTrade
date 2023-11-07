// efeito do botão cadastrar

document.addEventListener("DOMContentLoaded", function () {
    const btnEntrar = document.querySelector(".btn-entrar");
    const btnCadastrar = document.querySelector(".btn-cadastrar");

    btnEntrar.addEventListener("mouseover", function () {
      // Adicione a classe 'active' ao botão "Entrar" quando o mouse passa sobre ele
      btnEntrar.classList.add("active");

      // Remova a classe 'active' do botão "Cadastrar"
      btnCadastrar.classList.remove("active");
    });

    btnCadastrar.addEventListener("mouseover", function () {
      // Adicione a classe 'active' ao botão "Cadastrar" quando o mouse passa sobre ele
      btnCadastrar.classList.add("active");

      // Remova a classe 'active' do botão "Entrar"
      btnEntrar.classList.remove("active");
    });
  });
