<?php

include('conexao.php');
session_start();

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['password']) == true)) {

        //Destruindo dados de sessão inexistente
        unset($_SESSION['email']);
        unset($_SESSION['password']);
        header('Location: login.php');
    } else{
    $email = $_SESSION['email'];

    $comandoSql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email'";
    $result = $conn->query($comandoSql);


if ($result->num_rows > 0) {
        $dados = mysqli_fetch_assoc($result);
        // print_r($dados);
            $nome = $dados['NOME_USUARIO'];
            $email = $dados['EMAIL_USUARIO'];
            $imagem = $dados['IMAGEM_USUARIO'];

            //criptografando a senha
            $senha = $dados['SENHA_USUARIO'];
            $tamanho_senha = strlen($senha);
            $senha_hash = str_repeat('*', $tamanho_senha);    
    } 

    }
    
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/sidebar.css">
    <link rel="stylesheet" href="src/css/config.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="shortcut icon" href="src/imagens/SLlogo.svg" type="image/svg">

    <title>Configurações</title>
</head>

<body>
    <?php
    include "sidebar.php";
    ?>

    <div id="main_content">
        <!-- Primeiro componente dentro de content -->
        <div id="geral_config">
            <div id="header_config">
                <div class="image-upload">

                    <img src="<?php echo $imagem ?>" alt="" class="image-preview">
                    <button id="uploadbtn" class="enviar"><i class='bx bx-cloud-upload'></i></button>
                    
                </div>
            <br>
                <h1><?php echo $nome ?></h1>
            </div>
            
            <hr>

            <!-- Segundo componente dentro de content -->
                <div id="description_general">
                <div class="descriptions-all">
                    <div class="description-config">
                        <h3>Nome</h3>
                        <span><?php echo $nome ?></span>
                    </div>
                    <button class="btn-default editar">Editar</button>
                </div>
                <div class="descriptions-all">
                    <div class="description-config">
                        <h3>E-mail</h3>
                        <span><?php echo $email ?></span>
                    </div>
                    <button class="btn-default editar">Editar</button>
                </div>
                <div class="descriptions-all">
                    <div class="description-config">
                        <h3>Senha</h3>
                        <span><?php echo $senha_hash ?></span>
                    </div>
                    <button class="btn-default editar">Editar</button>
                </div>
            </div>
        </div>

        <!-- Modal - Nome -->
        <dialog id="dialog_cadastro">
            <form action="altera_config.php" method="post">
                <div class="header-dialog">
                <h2 class="dialog-title">Novo nome</h2>
                <i class='bx bx-x f'></i>
                </div>
                <div class="dialog-inputs">
                    <input type="text" name="nome" id="nome" placeholder="<?php echo $nome ?>">
                </div>
                <br>
                <div class="botoes">
                <button type="submit" class="btnDialog">Salvar</button>
                </div>
            </form>
        </dialog>
        <!-- Fim Modal -->

        <!-- Modal - Email -->
        <dialog id="dialog_cadastro1">
            <form action="altera_config.php" method="post">
                <div class="header-dialog">
                <h2 class="dialog-title">Novo e-mail</h2>
                <i class='bx bx-x f1'></i>
                </div>
                <div class="dialog-inputs">
                    <input type="text" name="email" id="email" placeholder="<?php echo $email ?>">
                </div>
                <br>
                <div class="botoes">
                <button type="submit" class="btnDialog">Salvar</button>
                </div>
            </form>
        </dialog>
        <!-- Fim Modal -->

        <!-- Modal - Senha -->
        <dialog id="dialog_cadastro2">
            <form action="altera_config.php" method="post">
                <div class="header-dialog">
                <h2 class="dialog-title">Nova senha</h2>
                <i class='bx bx-x f2'></i>
                </div>
                <div class="dialog-inputs">
                    <input type="password" name="senha" id="senha" placeholder="<?php echo $senha_hash ?>">
                </div>
                <br>
                <div class="botoes">
                <button type="submit" class="btnDialog">Salvar</button>
                </div>
            </form>
        </dialog>
        <!-- Fim Modal -->
        
        <!-- Modal - Foto -->
        <dialog id="dialog_cadastro3">
            <form enctype="multipart/form-data" method="POST" action="altera_config.php">
                <div class="header-dialog">
                <h2 class="dialog-title">Foto de Perfil</h2>
                <i class='bx bx-x f3'></i>
                </div>
                <!-- <p><label for="">Seleciona a foto que deseja utilizar de perfil</label><br><br> -->
                <input type="file" name="imagem" accept="image/*" class="image-dialog"></p>
                <br>
                <div class="botoes">
                <button type="submit" class="btnDialog" name="upload">Salvar</button>
                </div>
            </form>
        </dialog>
        <!-- Fim Modal --> 
        <img src="src/imagens/sobre_fundo.svg" alt="" id="fundo_sobre">
    </div>

    <script src="src/js/menu.js"></script>
    <script src="src/js/config.js"></script>
</body>

</html>