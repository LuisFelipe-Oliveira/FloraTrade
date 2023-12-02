<?php
require_once("header.php");
?>
<link rel="stylesheet" href="assets\css\index.css">

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
      <button id="btn-comece"><a href="comece-aqui.php">COMECE AQUI</a></button>
      <button id="btn-saiba"><a href="saibaMais.php">SAIBA MAIS</a></button>
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
    <a href="sobreNos.php"><button class="btn-sobre">SOBRE NÓS</button></a>
  </div>
</div>

<?php
require_once("footer.php");
?>
</body>

</html>