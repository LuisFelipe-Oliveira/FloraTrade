<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/sobreNos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
    <link rel="icon"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 512 512'%3E%3Cstyle%3Esvg { fill: %23528265 } %3C/style%3E%3Cpath d='M512 32c0 113.6-84.6 207.5-194.2 222c-7.1-53.4-30.6-101.6-65.3-139.3C290.8 46.3 364 0 448 0h32c17.7 0 32 14.3 32 32zM0 96C0 78.3 14.3 64 32 64H64c123.7 0 224 100.3 224 224v32V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V320C100.3 320 0 219.7 0 96z' /%3E%3C/svg%3E"
        type="image/svg+xml">
</head>

<body>
    <section>
        <?php  
        require("header.php");

        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            echo '<script>window.location.href = "login.php"</script>';
            exit;
          }
          ?>
        <hr class="hr-green">
    </section>
    <div class="container1">
        <div class="item">
            <img class="imgDev" src="assets/imgs/felipe-perfil.jpeg" alt="Foto de Perfil do Felipe Rogério">
            <div class="info">
                <h1>Felipe Rogério</h1>
                <h5>19 anos</h5>
                <h4>Estudante de Análise e Desenvolvimento na Fatec Presidente Prudente</h4>
                <h4>Programador PHP</h4>
                <h4>Front-End</h4>
                <div class="icons">
                    <i class="devicon-javascript-plain colored"></i>
                    <i class="devicon-php-plain colored"></i>
                    <i class="devicon-mysql-plain colored"></i>
                    <i class="devicon-html5-plain colored"></i>
                    <i class="devicon-css3-plain colored"></i>
                    <i class="devicon-bootstrap-plain colored"></i>
                    <i class="devicon-python-plain colored"></i>
                    <i class="devicon-csharp-plain colored"></i>
                </div>
                <a href="https://instagram.com/" target="_blank"><img
                        src="https://img.shields.io/badge/-Instagram-%23E4405F?style=for-the-badge&logo=instagram&logoColor=white"
                        target="_blank"></a>
                <a href="https://discord.com/" target="_blank"><img
                        src="https://img.shields.io/badge/Discord-7289DA?style=for-the-badge&logo=discord&logoColor=white"
                        target="_blank"></a>
                <a href="mailto:"><img
                        src="https://img.shields.io/badge/-Gmail-%23333?style=for-the-badge&logo=gmail&logoColor=white"
                        target="_blank"></a>
                <a href="https://www.linkedin.com/" target="_blank"><img
                        src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white"
                        target="_blank"></a>
            </div>
        </div>
    </div>
    <div class="container1">
        <div class="item">
            <img class="imgDev" src="assets/imgs/luis-perfil.png" alt="Foto do Perfil de Luís Felipe ">
            <div>
                <h1>Luis Felipe</h1>
                <h5>19 anos</h5>
                <h4>Estudante de Análise e Desenvolvimento na Fatec Presidente Prudente</h4>
                <h4>Estagiário Front-End na Unoeste de Presidente Prudente</h4>
                <h4>Front-End</h4>
                <div class="icons">
                    <i class="devicon-javascript-plain colored"></i>
                    <i class="devicon-php-plain colored"></i>
                    <i class="devicon-mysql-plain colored"></i>
                    <i class="devicon-html5-plain colored"></i>
                    <i class="devicon-css3-plain colored"></i>
                    <i class="devicon-bootstrap-plain colored"></i>
                    <i class="devicon-python-plain colored"></i>
                    <i class="devicon-csharp-plain colored"></i>
                </div>
                <a href="https://instagram.com/" target="_blank"><img
                        src="https://img.shields.io/badge/-Instagram-%23E4405F?style=for-the-badge&logo=instagram&logoColor=white"
                        target="_blank"></a>
                <a href="https://discord.com/" target="_blank"><img
                        src="https://img.shields.io/badge/Discord-7289DA?style=for-the-badge&logo=discord&logoColor=white"
                        target="_blank"></a>
                <a href="mailto:"><img
                        src="https://img.shields.io/badge/-Gmail-%23333?style=for-the-badge&logo=gmail&logoColor=white"
                        target="_blank"></a>
                <a href="https://www.linkedin.com/" target="_blank"><img
                        src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white"
                        target="_blank"></a>
            </div>
        </div>
    </div>
    <div class="container1">
        <div class="item">
            <img class="imgDev" src="assets/imgs/henri-perfil.jpg" alt="Foto do Perfil de Henri Barboza">
            <div>
                <h1>Henri Barboza</h1>
                <h5>19 anos</h5>
                <h4>Estudante de Análise e Desenvolvimento na Fatec Presidente Prudente</h4>
                <h4>Aprendendo JavaScript e alguns frameworks</h4>
                <h4>Front-End</h4>
                <div class="icons">
                    <i class="devicon-javascript-plain colored"></i>
                    <i class="devicon-react-original colored"></i>
                    <i class="devicon-php-plain colored"></i>
                    <i class="devicon-mysql-plain colored"></i>
                    <i class="devicon-html5-plain colored"></i>
                    <i class="devicon-css3-plain colored"></i>
                    <i class="devicon-bootstrap-plain colored"></i>
                    <i class="devicon-python-plain colored"></i>
                    <i class="devicon-csharp-plain colored"></i>
                </div>
                <a href="https://instagram.com/" target="_blank"><img
                        src="https://img.shields.io/badge/-Instagram-%23E4405F?style=for-the-badge&logo=instagram&logoColor=white"
                        target="_blank"></a>
                <a href="https://discord.com/" target="_blank"><img
                        src="https://img.shields.io/badge/Discord-7289DA?style=for-the-badge&logo=discord&logoColor=white"
                        target="_blank"></a>
                <a href="mailto:"><img
                        src="https://img.shields.io/badge/-Gmail-%23333?style=for-the-badge&logo=gmail&logoColor=white"
                        target="_blank"></a>
                <a href="https://www.linkedin.com/" target="_blank"><img
                        src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white"
                        target="_blank"></a>
            </div>
        </div>
    </div>
    <div class="container1">
        <div class="item">
            <img class="imgDev" src="assets/imgs/joao-perfil.jpg" alt="Foto do Perfil de Jõao Colonna">
            <div>
                <h1>João Colonna</h1>
                <h5>19 anos</h5>
                <h4>Estudante de Análise e Desenvolvimento na Fatec Presidente Prudente</h4>
                <h4>Programador PHP</h4>
                <h4>Front-End</h4>
                <div class="icons">
                    <i class="devicon-php-plain colored"></i>
                    <i class="devicon-codeigniter-plain colored"></i>
                    <i class="devicon-laravel-plain colored"></i>
                    <i class="devicon-javascript-plain colored"></i>
                    <i class="devicon-nodejs-plain colored"></i>
                    <i class="devicon-html5-plain colored"></i>
                    <i class="devicon-css3-plain colored"></i>
                    <i class="devicon-python-plain colored"></i>
                    <i class="devicon-csharp-plain colored"></i>
                    <i class="devicon-bootstrap-plain colored"></i>
                    <i class="devicon-mysql-plain colored"></i>
                    <i class="devicon-git-plain colored"></i>
                </div>
                <a href="https://instagram.com/" target="_blank"><img
                        src="https://img.shields.io/badge/-Instagram-%23E4405F?style=for-the-badge&logo=instagram&logoColor=white"
                        target="_blank"></a>
                <a href="https://discord.com/" target="_blank"><img
                        src="https://img.shields.io/badge/Discord-7289DA?style=for-the-badge&logo=discord&logoColor=white"
                        target="_blank"></a>
                <a href="mailto:"><img
                        src="https://img.shields.io/badge/-Gmail-%23333?style=for-the-badge&logo=gmail&logoColor=white"
                        target="_blank"></a>
                <a href="https://www.linkedin.com/" target="_blank"><img
                        src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white"
                        target="_blank"></a>
            </div>
        </div>
    </div>
    <div class="container1">
        <div class="item">
            <img class="imgDev" src="assets/imgs/jose-perfil.jpg" alt="Foto do Perfil de José Victor">
            <div>
                <h1>José Victor</h1>
                <h5>19 anos</h5>
                <h4>Estudante de Análise e Desenvolvimento na Fatec Presidente Prudente</h4>
                <h4>Front-End</h4>
                <div class="icons">
                    <i class="devicon-javascript-plain colored"></i>
                    <i class="devicon-php-plain colored"></i>
                    <i class="devicon-mysql-plain colored"></i>
                    <i class="devicon-html5-plain colored"></i>
                    <i class="devicon-css3-plain colored"></i>
                    <i class="devicon-bootstrap-plain colored"></i>
                    <i class="devicon-python-plain colored"></i>
                    <i class="devicon-csharp-plain colored"></i>
                </div>
                <a href="https://instagram.com/" target="_blank"><img
                        src="https://img.shields.io/badge/-Instagram-%23E4405F?style=for-the-badge&logo=instagram&logoColor=white"
                        target="_blank"></a>
                <a href="https://discord.com/" target="_blank"><img
                        src="https://img.shields.io/badge/Discord-7289DA?style=for-the-badge&logo=discord&logoColor=white"
                        target="_blank"></a>
                <a href="mailto:"><img
                        src="https://img.shields.io/badge/-Gmail-%23333?style=for-the-badge&logo=gmail&logoColor=white"
                        target="_blank"></a>
                <a href="https://www.linkedin.com/" target="_blank"><img
                        src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white"
                        target="_blank"></a>
            </div>
        </div>
    </div>

    <?php require_once "footer.php"; ?>
</body>

</html>