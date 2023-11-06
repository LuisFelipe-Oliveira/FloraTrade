<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/luxonauta/luxa@1.1/dist/compressed/luxa.css" />
  <link rel="stylesheet" href="assets\css\style.css" />
  <title>Flora Trade</title>
</head>

<body>
  <div class="alinhamento">
    <!-- header -->
    <div class="header">
      <!-- botões de login -->
      <div class="menu">
        <svg class="icon" id="menuIcon" xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor"
          viewBox="0 0 448 512">
          <path
            d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
        </svg>
        <div class="menu-content">
          <a href="#">Sobre Nós</a>
          <a href="#">Contato</a>
          <a href="#">Entrar</a>
          <a href="#">Cadastrar</a>
          <svg class="icon close" xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor"
            viewBox="0 0 384 512" id="closeIcon">
            <path
              d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z" />
          </svg>
        </div>
      </div>
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
        <img src="assets/imgs/rogerio-perfil.jpg" alt="">
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
        <img src="assets/imgs/avatar.jpg" alt="">
        <p>João</p>
      </div>
      <div class="membro">
        <img src="assets/imgs/avatar.jpg" alt="">
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

<script src="assets/js/script.js"></script>
<script src="assets/js/menu.js"></script>


</html>