<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/luxonauta/luxa@1.1/dist/compressed/luxa.css" />
  <link rel="stylesheet" href="assets\css\style.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
  <title>Flora Trade</title>
</head>

<body>

  <div class="alinhamento">
    <!-- header -->
    <div class="header">
      <!-- menu lateral -->
      <div class="menu">
        <button class="btn-menu-open" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
          aria-controls="offcanvasRight"><i class="fas fa-bars" fill="currentColor"></i></button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <hr class="hr-green">
          <div class="offcanvas-body">
            <ul class="itens-menu">
              <a href=""><li class="button">Entrar</li></a>
              <a href=""><li class="button">Cadastrar</li></a>
              <a onclick="error()"><li>ADM</li></a>
              <a onclick="error()"><li>Tabela usuários</li></a>
              <a onclick="error()"><li>Tabela produtos</li></a>
              <a onclick="error()"><li>Contatos</li></a>
            </ul>
          </div>
        </div>
      </div>
      <!-- botões de login -->
      <div class="btn-login">
        <div class="btn-entrar">
          <h4><a href="">Entrar</a></h4>
        </div>
        <div class="btn-cadastrar">
          <h4><a href="">Cadastrar</a></h4>
        </div>
      </div>
      <!-- Logo -->
      <div class="logo">
        <img class="logo" src="assets/imgs/Logo.png" alt="" />
      </div>
    </div>
  </div>
  <hr class="hr-green" />
  <!-- conteudo -->
  <div class="conteudo">
    <!-- card lado esquerdo (texto e botôes) -->
    <div class="card-esquerdo">
      <!-- Texto principal -->
      <h1>Flora Trade movimentando a sua floricultura</h1>
      <!-- texto secundário -->
      <h5>
        Trazemos a solução para voce que pensa em otimizar o seu negócio
        agilizando e organizando seu estoque e suas vendas.
      </h5>
      <div class="btn-card">
        <button id="btn-comece"><a href="">COMECE AQUI</a></button>
        <button id="btn-saiba"><a href="">SAIBA MAIS</a></button>
      </div>
    </div>
    <!-- card direito (imagem) -->
    <div class="card-direito">
      <img src="assets\imgs\floriculturas-leblon.jpg" alt="Pessoa segurando uma flor." />
    </div>
  </div>
  <hr class="hr-gray" />
  <div class="conteudo-02">
    <div class="content-info">
      <p class="text">
        Sabemos que a gestão eficaz do seu estoque é fundamental para o sucesso do seu negócio, e é por isso que
        desenvolvemos uma solução sob medida para otimizar o seu gerenciamento de flores, plantas e acessórios.
        Não importa o tamanho da sua floricultura, nosso sistema é escalável e fácil de usar, proporcionando uma gestão
        de estoque descomplicada e eficiente. Desfrute de um maior controle, menos estresse e mais tempo para se
        concentrar em encantar seus clientes com as flores mais deslumbrantes.
        Simplifique a gestão do seu estoque, melhore a eficiência operacional e impulsione o sucesso do seu negócio com
        o nosso sistema de controle de estoque para floriculturas.
      </p>
    </div>
  </div>
  <hr class="hr-gray" />
  <!-- conteúdo 03 -->
  <div class="conteudo-03">
    <h3>Nossa equipe</h3>
    <!-- card de membros da equipe -->
    <div class="card-equipe">
      <div class="membro">
        <img src="assets/imgs/felipe-perfil.jpeg" alt="">
        <p>Felipe</p>
      </div>
      <div class="membro">
        <img src="assets/imgs/henri-perfil.jpg" alt="">
        <p>Henri</p>
      </div>
      <div class="membro">
        <img src="assets/imgs/luis-perfil.png" alt="">
        <p>Luis</p>
      </div>
      <div class="membro">
        <img src="assets/imgs/joao-perfil.jpg" alt="">
        <p>João</p>
      </div>
      <div class="membro">
        <img src="assets/imgs/jose-perfil.jpg" alt="">
        <p>José</p>
      </div>
    </div>
    <div class="sobre-nos">
      <button class="btn-sobre">SOBRE NÓS</button>
    </div>
  </div>

  <?php
  require_once "footer.php";
  ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.all.min.js
"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/alert.js"></script>

</html>