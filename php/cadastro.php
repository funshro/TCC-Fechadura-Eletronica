<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/cadastro.css">
    <link rel="shortcut icon" href="src/imagens/SLlogo.svg" type="image/svg">
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>

    <title>Cadastro</title>
</head>

<body>
    <main id="container">
        <form action="Cadastrando.php" id="cadastro_form" method="POST" class="form">

            <div id="form_header">
                <h1>Cadastre-se</h1>
                <i id="mode_icon" class="fa-solid fa-moon"></i>
            </div>

            <div id="inputs">

                <div class="input-box">
                    <label for="name">
                        Nome
                        <div class="input-field">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" id="name" name="name" placeholder="Nome completo" class="required" oninput="nameValidate()">
                        </div>
                        <span class="span-required">Nome deve ter no mínimo 3 caracteres</span>
                    </label>
                </div>

                <div class="input-box">
                    <label for="email">
                        E-mail
                        <div class="input-field" id="form">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="text" id="email" name="email" placeholder="E-mail" class="required" oninput="emailValidate()">
                        </div>
                        <span class="span-required" id="verificaEmail">Digite um email válido</span>
                    </label>
                </div>

                <div class="input-box">
                    <label for="senha">
                        Senha
                        <div class="input-field">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" id="password" name="password" placeholder="Senha" class="required" oninput="mainPasswordValidate()">
                        </div>
                        <span class="span-required">Senha com no mínimo 8 caracteres</span>
                    </label>
                </div>
                <div class="input-box">
                    <label for="senha">
                        Confirmar senha
                        <div class="input-field">
                            <i class="fa-solid fa-key"></i>
                            <input type="password" id="password" name="password1" placeholder="Confirmar senha" class="required" oninput="comparePassword()">
                        </div>
                        <span class="span-required">Senhas devem ser compatíveis</span>
                    </label>
                </div>
            </div>
            
            <div id="link_login">
                <a href="login.php">Já possui uma conta?</a>
            </div>

            <button type="submit" id="cadastro_button" name="submit"><span>Cadastre-se</span>
            <i class="fa-solid fa-arrow-right"></i></button>
        </form>
    </main>

    <script type="text/javascript" src="src/js/cadastro.js"></script>
</body>

</html>