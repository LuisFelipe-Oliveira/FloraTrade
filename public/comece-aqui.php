<?php
require_once("header.php")
    ?>
<!DOCTYPE html>
<link rel="stylesheet" href="assets/css/comece-aqui.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
</head>


<body>
    <div class="content2">
        <div>
            <img id="svg-top" src="images/bg-top.svg" alt="">
            <img id="svg-bottom" src="images/bg-bottom.svg" alt="">
            <div class="top">
                <h2>Nossos preços</h2>
                <div class="btn-slider">
                    <p>Anual</p>
                    <label class="switch">
                        <input type="checkbox" id="btn-interruptor">
                        <span class="slider"></span>
                    </label>
                    <p>Mensal</p>
                </div>
            </div>
            <div class="cards">
                <div class="side-cards" id="left-card">
                    <div class="top-card">
                        <h4>Básico</h4>
                        <h1 class="anual"><span id="dollar">R$</span>1990,99</h1>
                        <h1 class="mensal esconder"><span id="dollar">R$</span>190,99</h1>
                    </div>
                    <div class="content-card">
                        <hr class="hr">
                        <h5>Suporte 8 horas</h5>
                        <hr class="hr">
                        <h5>2 pontos de vendas</h5>
                        <hr class="hr">
                        <h5>3 GB de armazenamento</h5>
                        <hr class="hr">
                    </div>
                    <div>
                        <br>
                        <button class="side-btn-card">SAIBA MAIS</button>
                    </div>
                </div>
                <div class="center-card">
                    <div class="top-card">
                        <h4>Profissional</h4>
                        <h1 class="anual"><span id="dollar">R$</span>2490,99</h1>
                        <h1 class="mensal esconder"><span id="dollar">R$</span>240,99</h1>
                    </div>
                    <div class="content-card">
                        <hr class="center-hr">
                        <h5>Suporte 12 horas</h5>
                        <hr class="center-hr">
                        <h5>5 pontos de vendas</h5>
                        <hr class="center-hr">
                        <h5>7 GB de armazenamento</h5>
                        <hr class="center-hr">
                    </div>
                    <div>
                        <br>
                        <button class="center-btn-card">SAIBA MAIS</button>
                    </div>
                </div>
                <div class="side-cards" id="right-card">
                    <div class="top-card">
                        <h4>Master</h4>
                        <h1 class="anual"><span id="dollar">R$</span>3990,99</h1>
                        <h1 class="mensal esconder"><span id="dollar">R$</span>390,99</h1>
                    </div>
                    <div class="content-card">
                        <hr class="hr">
                        <h5>Plantão de suporte</h5>
                        <hr class="hr">
                        <h5>10 pontos de vendas</h5>
                        <hr class="hr">
                        <h5>15 GB de armazenamento</h5>
                        <hr class="hr">
                    </div>
                    <div>
                        <br>
                        <button class="side-btn-card">SAIBA MAIS</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php

require_once("footer.php")

    ?>

<script src="assets/js/comece-aqui.js"></script>

</html>