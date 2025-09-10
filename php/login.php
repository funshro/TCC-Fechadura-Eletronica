<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/login.css">
    <link rel="shortcut icon" href="src/imagens/SLlogo.svg" type="image/svg">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Login</title>
</head>

<body>
    <main id="container">
        <form id="login_form" action="Logando.php" method="POST" class="form">

            <div id="form_header">
                <h1>Login</h1>
                <i id="mode_icon" class="fa-solid fa-moon"></i>
            </div>

            <!-- <div id="social_media">

                 <a href="#">
                    <img src="src/imagens/cadastro/facebook.png" alt="facebook logo">
                </a>
                <a href="#">
                    <img src="src/imagens/cadastro/google.png" alt="facebook logo">
                </a>
                <a href="#">
                    <img src="src/imagens/cadastro/github.png" alt="facebook logo">
                </a> 

            </div> -->

            <div id="inputs">
                <div class="input-box">
                    <label for="email">
                        E-mail
                        <div class="input-field">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="text" id="email" name="email" placeholder="E-mail" class="required">
                        </div>
                        <!-- <span class="span-required" id="verificaEmail">Email invalido</span> -->
                    </label>
                </div>

                <div class="input-box">
                    <label for="senha">
                        Senha
                        <div class="input-field">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" id="password" name="password" placeholder="*******" class="required">
                        </div>
                        <!-- <span class="span-required" id="verificaEmail">Senha invalido</span> -->
                    </label>

                    <div id="forgot_password">
                        <!-- <a href="#">Esqueceu sua senha?</a> -->
                        <a href="cadastro.php">Criar nova conta</a>
                    </div>
                </div>
            </div>

            <button type="submit" id="login_button" name="submit"><span>Entrar</span>
            <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>
    </main>

    <script type="text/javascript" src="src/js/login.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>